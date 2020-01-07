<?php
defined('BASEPATH');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Presensi extends CI_Controller{
  function __construct() {
    parent::__construct();
        $this->load->model('PresensiModel');
        $this->load->model('KeterlambatanModel');
        $this->load->model('NotifikasiModel');
        $this->load->model('WaliModel');
        $this->load->model('LiburModel');
        $this->load->model('AntrianSiswaModel');
        $this->load->model('JamModel');
        $this->load->model('SiswaModel');
        $this->load->model('M_kelas');
  }

  function index(){
    $data['menu'] = 'presensi';
		//$data["prese"] = $this->M_jurusan->getAll();
		$this->load->view('admin/presensi/index', $data);
  }

  function insertSiswaTidakHadir(){
    date_default_timezone_set("Asia/Jakarta");
    $jam_sekarang = strtotime(date('H:i:s'));
    $jam_masuk = strtotime($this->JamModel->getJamMasuk());
    $jam = floor(($jam_masuk+1800)/60) - floor($jam_sekarang/60);
    echo $jam;

    if($jam != 0){
      return 0;
    }

    $tanggal = date('Y:m:d');
    //token siswa yang tidak hadir
    $token = array();
    $dataWali = array();
    $libur=$this->LiburModel->getLibur();

    if($libur != null){
      return false;
    }

    //mengambil data siswa yang tidak hadir
    $siswaTidakHadir = $this->PresensiModel->getSiswaTidakHadir();

    //echo var_dump($siswaTidakHadir);
    foreach ($siswaTidakHadir as $siswa) {
      //insert data siswa yang tidak hadir ke tabel presensi
      $this->PresensiModel->insertSiswaTidakHadir($siswa->NIS, $tanggal);

      //get token fcm siswa
      if($siswa->token != null){
        $token[]=$siswa->token;
      }

      //get token fcm wali
      if($siswa->id_wali !=null){
        $wali = $this->WaliModel->getWaliByID($siswa->id_wali);
        if($wali->token != null){
          $data = [
            'token' => $wali->token,
            'judul' => 'Informasi kehadiran',
            'isi' => "$siswa->nama_siswa dinyatakan tidak hadir hari ini"
          ];
          $dataWali[] = $data;
        }
      }
    }

    // mengirim notifikasi pada siswa yang tidak hadir
    if(sizeof($token) !=0){
      $judul = 'Informasi kehadiran';
      $isi = 'Mabal Troooozzzz :)';
      $this->NotifikasiModel->notifMultipleSiswa($token,$judul, $isi);
    }

    //mengirim notifikasi pada wali
    if(sizeof($dataWali) != 0){
      $this->NotifikasiModel->notifMultipleWali($dataWali);
    }
    echo "berhasil";
  }

  function getBulan(){
    $semester = $this->input->post('semester');
    if($semester%2==0){
      $data = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
    }else{
      $data = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    }
    echo json_encode($data);
  }

  function getSemester(){
		$id_kelas = $this->input->post('id_kelas');
    //$id_kelas = '1';
		$kelas = $this->M_kelas->getKelasByID($id_kelas);
		$bulan = date('m');
		if($kelas->tingkat == "XII"){
			if($bulan == "01" || $bulan == "02" || $bulan == "03" || $bulan == "04" || $bulan == "05" || $bulan == "06"){
        $data = ['1','2','3','4','5','6'];
			}else{
        $data = ['1','2','3','4','5'];
      }
		}elseif($kelas->tingkat == "XI"){
      if($bulan == "01" || $bulan == "02" || $bulan == "03" || $bulan == "04" || $bulan == "05" || $bulan == "06"){
        $data = ['1','2','3','4'];
			}else{
        $data = ['1','2','3'];
      }
    }else{
      if($bulan == "01" || $bulan == "02" || $bulan == "03" || $bulan == "04" || $bulan == "05" || $bulan == "06"){
        $data = ['1', '2'];
			}else{
        $data = ['1'];
      }
    }
    // $this->load->view('admin/presensi/index', $data);
    // //echo var_dump($data);
    echo json_encode($data);
	}

  public function notifPresensi(){
    date_default_timezone_set("Asia/Jakarta");
    $message;
    $messageWali;
    $antrian = $this->AntrianSiswaModel->getAntrianSiswa();
    if(sizeof($antrian) == 0){
      return 0;
    }

    $tokenSiswa = array();
    $tokenWali = array();

    $jam_pulang = strtotime($this->JamModel->getJamPulang()->jam_pulang);
    $time = strtotime(date('H:i:s'));
    if($jam_pulang-$time >= 0){
      $message = "Selamat Datang di Sekolah";
    }else{
      $message = "Sampai jumpa, Jangan lupa mengerjakan PR :)";
    }

    foreach ($antrian as $siswa) {
      if($siswa->token != null){
        $tokenSiswa[] = $siswa->token;
      }

      if($siswa->id_wali != null){
        $wali = $this->WaliModel->getWaliByID($siswa->id_wali);
        if($wali->token != null){
          $nama = $siswa->nama_siswa;
          $data = [
            'token' => $wali->token,
            'judul' => 'Informasi kehadiran siswa',
            'isi' => "$nama sudah sudah melakukan pemindaian sidik jari"
          ];
          $tokenWali[] = $data;
        }
      }
    }

    if(sizeof($tokenSiswa) !=0){
      $judul = 'SMK PGRI PLUMBON';
      $isi = $message;
      $this->NotifikasiModel->notifMultipleSiswa($tokenSiswa, $judul, $isi);
    }

    if(sizeof($tokenWali) != 0){
      $this->NotifikasiModel->notifMultipleWali($tokenWali);
    }
    echo var_dump($antrian);
  }

  function insertSiswaKabur(){
    date_default_timezone_set("Asia/Jakarta");
    $jam_sekarang = strtotime(date('H:i:s'));
    $jam_pulang = strtotime($this->JamModel->getJamPulang());
    $jam = floor(($jam_pulang+1800)/60) - floor($jam_sekarang/60);
    echo $jam;

    if($jam != 0){
      return 0;
    }

    $tanggal = date('Y:m:d');
    //token siswa yang kabur
    $token = array();
    $dataWali = array();
    $libur=$this->LiburModel->getLibur();

    if($libur != null){
      return 0;
    }

    $siswaKabur = $this->PresensiModel->getSiswaKabur();

    //echo var_dump($siswaTidakHadir);
    foreach ($siswaKabur as $siswa) {
      //Update presensi siswa
      $this->PresensiModel->updateSiswaKabur($siswa->id_presensi);

      //get token fcm siswa
      if($siswa->token != null){
        $token[]=$siswa->token;
      }

      //get token fcm wali
      if($siswa->id_wali !=null){
        $wali = $this->WaliModel->getWaliByID($siswa->id_wali);
        if($wali->token != null){
          $data = [
            'token' => $wali->token,
            'judul' => 'Informasi kehadiran',
            'isi' => "$siswa->nama_siswa tidak melakukan presensi pulang"
          ];
          $dataWali[] = $data;
        }
      }
    }

    // mengirim notifikasi pada siswa yang kabur
    if(sizeof($token) !=0){
      $judul = 'Informasi kehadiran';
      $isi = 'Anda tidak melakukan presensi pulang';
      $this->NotifikasiModel->notifMultipleSiswa($token,$judul, $isi);
    }

    //mengirim notifikasi pada wali
    if(sizeof($dataWali) != 0){
      $this->NotifikasiModel->notifMultipleWali($dataWali);
    }
    //echo "berhasil";

    //echo var_dump($siswaKabur);
  }

  function getPresensiByBulan(){
    $presensi = $this->PresensiModel->getPresensiSiswaBulan('1705011', '2019-11');

    $izin =0; $sakit = 0; $tidakHadir = 0; $kabur = 0; $hadir = 0 ;

    foreach ($presensi as $value) {
      if($value->id_jenis_presensi == '1' ){
        $hadir++;
      }else if($value->id_jenis_presensi == '2' ){
        $tidakHadir++;
      }else if($value->id_jenis_presensi == '3' ){
        $kabur++;
      }else if($value->id_jenis_presensi == '4' ){
        $izin++;
      }else if($value->id_jenis_presensi == '5' ){
        $sakit++;
      }
    }

    $data =  Array(
      'hadir' => $hadir,
      'tidak hadir' => $tidakHadir,
      'kabur' => $kabur,
      'sakit' => $sakit,
      'izin' => $izin
    );

    echo var_dump($data);
  }

  function rekap(){
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    $semester = (int)$this->input->post('semester');
    $bulan = (int)$this->input->post('bulan');
    $id_kelas = $this->input->post('kelas');
    $kelas = $this->M_kelas->getNamaKelasByID($id_kelas);

    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('Sipsen')
                 ->setLastModifiedBy('Sipsen')
                 ->setTitle("Rekap Absensi Siswa")
                 ->setSubject("Rekap Absensi Siswa")
                 ->setDescription("Rekap Absensi Siswa")
                 ->setKeywords("Rekap Absensi Siswa");
// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Absensi Siswa"); // Set kolom A1 dengan tulisan "Rekap Absensi"
    $excel->getActiveSheet()->mergeCells('A1:AJ1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "BULAN"); // Set kolom A3 dengan tulisan "NO"
    $excel->getActiveSheet()->mergeCells('A3:AJ3'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    $excel->setActiveSheetIndex(0)->setCellValue('A4', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
    $excel->getActiveSheet()->mergeCells('A4:A5');
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Absensi Siswa Kelas $kelas"); // Set kolom A1 dengan tulisan "Rekap Absensi"
    $excel->getActiveSheet()->mergeCells('A1:AJ1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3:AK3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

    //Post

    $tahun = $this->getTahun($semester, $id_kelas);
    if($semester%2 == 0){
      $bulan++;
    }else{
      $bulan+=7;
    }

    $namaBulan = $this->getNamaBulan($bulan);
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "Bulan $namaBulan");

    // $tahun = 2019;
    // $bulan = 8;
    $jml = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    $tanggal=1;
    $i=4;
    $j='B';
    //untuk menampilkan tanggal pada excel
    while($tanggal <= $jml){
      $temp = $i+1;
      $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "$tanggal");
      $excel->getActiveSheet()->mergeCells("$j$i:$j$temp");
      $excel->getActiveSheet()->getStyle("$j$i:$j$temp")->applyFromArray($style_col);
      $j++;
      $tanggal++;
    }
    $temp=$j;
    $temp++;$temp++;$temp++;$temp++;
    $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "Total");
    $excel->getActiveSheet()->mergeCells("$j$i:$temp$i");
    $excel->getActiveSheet()->getStyle("$j$i:$temp$i")->applyFromArray($style_col);

    $i++;
    $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "S");
    $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
    $j++;
    $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "TH");
    $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
    $j++;
    $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "K");
    $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
    $j++;
    $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "I");
    $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
    $j++;
    $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "S");
    $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);

    $i=6;
    $siswas = $this->SiswaModel->getSiswaByKelas($id_kelas);
    foreach ($siswas as $siswa) {
      $j='A';
      $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_row);
      $excel->setActiveSheetIndex(0)->setCellValue("$j$i", $siswa->nama_siswa);
      $tanggal=1;

      $H=0;$TH=0;$K=0;$I=0;$S=0;
      while($tanggal <= $jml){
        $j++;
        //get presensi berdasarkan nis dan Tanggal
        $b=$this->number($bulan);
        $t=$this->number($tanggal);
        $presensi = $this->PresensiModel->getRekapPresensi($siswa->NIS, "$tahun-$b-$t");
        if($presensi != null){
          if($presensi->id_jenis_presensi == '1' ){
            $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "H");
            $H++;
          }elseif ($presensi->id_jenis_presensi == '2') {
            $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "TH");
            $TH++;
          }elseif ($presensi->id_jenis_presensi == '3') {
            $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "K");
            $K++;
          }elseif ($presensi->id_jenis_presensi == '4') {
            $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "I");
            $I++;
          }else{
            $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "S");
            $S++;
          }
        }

        $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
        $tanggal++;
      }

      $j++;
      $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "$H");
      $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
      $j++;
      $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "$TH");
      $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
      $j++;
      $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "$K");
      $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
      $j++;
      $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "$I");
      $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);
      $j++;
      $excel->setActiveSheetIndex(0)->setCellValue("$j$i", "$S");
      $excel->getActiveSheet()->getStyle("$j$i")->applyFromArray($style_col);

      $i++;
    }

      // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(3); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(3); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(3); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('J')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('K')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('L')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('M')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('N')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('O')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('P')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('R')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('S')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('T')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('P')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('U')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('V')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('W')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('X')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('Y')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('Z')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AA')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AB')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AC')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AD')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AE')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AF')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AG')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AH')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AI')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(3); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('AK')->setWidth(3); // Set width kolom E

    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Rekap Absensi Siswa");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Rekap Absensi Siswa.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $write->save('php://output');
  }

  function getNamaBulan($bulan){
    $data = ['Januari', 'Februari', 'Maret', 'April', 'Mei',
    'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    return $data[$bulan-1];
  }

  function test(){
    $semester = (int)$this->input->post('semester');
    $bulan = (int)$this->input->post('bulan');
    $id_kelas = $this->input->post('kelas');

    $tahun = $this->getTahun($semester, $id_kelas);

    if($semester%2 == 0){
      $bulan++;
    }else{
      $bulan+=7;
    }

    echo var_dump($bulan);
    echo var_dump($tahun);
    // echo var_dump($bulan);
    // echo var_dump($id_kelas);
  }

  function getTahun($semester, $id_kelas){
    $kelas = $this->M_kelas->getKelasByID($id_kelas);
    $tahunSekarang = (int)date('Y');
    $bulanSekarang = (int)date('m');

    $tahun;
    if($kelas->tingkat == "XII" && $bulanSekarang < 7){
      if($semester == 6){
        $tahun = $tahunSekarang;
      }elseif ($semester == 5 || $semester == 4) {
        $tahun = $tahunSekarang-1;
      }elseif ($semester == 3 || $semester == 2) {
        $tahun = $tahunSekarang-2;
      }else{
        $tahun = $tahunSekarang-3;
      }
    }elseif ($kelas->tingkat == "XII" && $bulanSekarang > 6) {
      if ($semester == 5 || $semester == 4) {
        $tahun = $tahunSekarang;
      }elseif ($semester == 3 || $semester == 2) {
        $tahun = $tahunSekarang-1;
      }else{
        $tahun = $tahunSekarang-2;
      }
    }elseif ($kelas->tingkat == "XI" && $bulanSekarang < 7) {
      if ($semester == 4) {
        $tahun = $tahunSekarang;
      }elseif ($semester == 3 || $semester == 2) {
        $tahun = $tahunSekarang-1;
      }else{
        $tahun = $tahunSekarang-2;
      }
    }elseif ($kelas->tingkat == "XI" && $bulanSekarang > 6) {
      if ($semester == 3 || $semester == 2) {
        $tahun = $tahunSekarang;
      }else{
        $tahun = $tahunSekarang-1;
      }
    }elseif ($kelas->tingkat == "X" && $bulanSekarang < 7) {
      if ($semester == 2) {
        $tahun = $tahunSekarang;
      }else{
        $tahun = $tahunSekarang-1;
      }
    }else{
      $tahun = $tahunSekarang;
    }

    return $tahun;
  }

  function number($num){
    if($num<10){
      return "0$num";
    }else{
      return "$num";
    }
  }

}
