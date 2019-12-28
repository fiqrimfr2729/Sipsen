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
        $this->load->model('JamModel');
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

    echo var_dump($siswaKabur);
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
