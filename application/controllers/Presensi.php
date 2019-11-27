<?php
defined('BASEPATH');

class Presensi extends CI_Controller{
  function __construct() {
    parent::__construct();
        $this->load->model('PresensiModel');
        $this->load->model('KeterlambatanModel');
        $this->load->model('NotifikasiModel');
        $this->load->model('WaliModel');
        $this->load->model('LiburModel');
        $this->load->model('AntrianSiswaModel');
  }

  function insertSiswaTidakHadir(){
    date_default_timezone_set("Asia/Jakarta");
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

    //mengirim notifikasi pada siswa yang tidak hadir
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

  public function notifPresensi(){
    $antrian = $this->AntrianSiswaModel->getAntrianSiswa();
    if(sizeof($antrian) == 0){
      return false;
    }

    $tokenSiswa = array();
    $tokenWali = array();

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
            'judul' => 'Informasi kehadiran',
            'isi' => "$nama sudah berada dilingkungan sekolah"
          ];
          $tokenWali[] = $data;
        }
      }
    }

    if(sizeof($tokenSiswa) !=0){
      $judul = 'Informasi kehadiran';
      $isi = 'Selamat Datang di Sekolah';
      $this->NotifikasiModel->notifMultipleSiswa($tokenSiswa,$judul, $isi);
    }

    if(sizeof($tokenWali) != 0){
      $this->NotifikasiModel->notifMultipleWali($tokenWali);
    }
    echo "berhasil";
  }

  function insertSiswaKabur(){
    $siswa = $this->PresensiModel->getSiswaKabur();

    foreach ($siswa as $siswaa) {
      $this->PresensiModel->updateSiswaKabur($siswaa->id_presensi);
    }

    echo var_dump($siswa);
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

}
