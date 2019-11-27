<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Presensi extends REST_Controller {
  function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('PresensiModel');
        $this->load->model('KeterlambatanModel');
        $this->load->model('LiburModel');
        $this->load->model('SiswaModel');
        $this->load->model('AntrianSiswaModel');
        $this->load->library('form_validation');
    }

  function presensi_siswa_masuk_post(){
    $id_fp = $this->post('id_fp');
    $kd_alat = $this->post('kd_alat');
    date_default_timezone_set("Asia/Jakarta");
    $date = date('Y-m-d');

    $this->form_validation->set_rules('id_fp', 'id_fp', 'trim|required|numeric');
    $this->form_validation->set_rules('kd_alat', 'kd_alat', 'trim|required|numeric');

    //get user berdasarkan kode alat dan id fingerprint
    $siswa = $this->PresensiModel->getSiswa($id_fp, $kd_alat);


    if($siswa == null){
      $this->response([
          'atas' => 'Sidik jari',
          'bawah' => 'tidak terdaftar'
      ], 200);
    }

    $nis = $siswa->NIS;

    $jam_masuk = $this->db->get('tb_jam')->row()->jam_masuk;
    $jam_masuk = strtotime($jam_masuk);
    $jam_sekarang_str = date('H:i:s');
    $jam_sekarang = strtotime($jam_sekarang_str);
    $jam_pulang = $this->db->get('tb_jam')->row()->jam_pulang;
    $jam_pulang = strtotime($jam_pulang);//mengubah variabel menjadi int

    //mengecek apakah sudah melakukan presensi sebelumnya
    $presensi = $this->PresensiModel->cekPresensiTanggal($siswa->NIS, $date);

    if($jam_masuk+1800 >= $jam_sekarang){
      if($presensi == null){
        //menghitung waktu keterlambatan
        $keterlambatan = $this->KeterlambatanModel->getKeterlambatanMasuk();
        $this->PresensiModel->presensiSiswa($siswa->NIS, 1, $date, $jam_sekarang_str, $keterlambatan);
        $this->AntrianSiswaModel->insertToAntrian($nis);
        $this->response([
            'atas' => 'Masuk, NIS:',
            'bawah' => "$nis"
        ], 200);
      }

    }else if($jam_pulang <= $jam_sekarang || $jam_sekarang >= $jam_pulang+1800){
      if($presensi != null){
        if($presensi->keluar == '00:00:00'){
          $this->PresensiModel->presensiSiswaKeluar($presensi->id_presensi, $jam_sekarang_str);
          $this->response([
              'atas' => 'Keluar, NIS:',
              'bawah' => "$nis"
          ], 200);
        }
      }
    }

    $this->response([
        'atas' => "NIS anda:",
        'bawah' => "$nis"
    ], 200);

  }

  //untuk get presensi hari ini
  public function presensi_hari_ini_post(){
    $nis = $this->post('nis');
    $libur = $this->LiburModel->getLibur();
    date_default_timezone_set("Asia/Jakarta");

    if($libur != null){
      $this->response([
        'libur'=>[
          'value'   => 1,
          'message' => 'Libur']
        ], 200);
    }

    $presensi=$this->PresensiModel->getPresensiHariIni($nis);
    if($presensi == null){
      $this->response([
        'libur'=> null,
        'presensi' => null
        ], 200);
    }

    $presensi->siswa = $this->SiswaModel->getSiswaByNIS2($nis);
    $presensi->presensi = $this->PresensiModel->getPresensiByID($presensi->id_jenis_presensi)->jenis_presensi;
    $this->response([
      'libur'=> null,
      'presensi' => $presensi
      ], 200);


  }

  public function get_presensi_month_get(){
    $nis = $this->get('nis');
    $month = $this->get('month');

    $presensi = $this->PresensiModel->getPresensiSiswaBulan('1705011', '2019-11');

    $this->response([
      'presensi' => $presensi], 200);
  }

  public function get_presensi_siswa_get(){
    $nis = $this->get('nis');

    $presensi = $this->PresensiModel->getPresensiSiswa($nis);

    $hadir = Array();
    $TH = Array();
    $sakit = Array();
    $izin = Array();
    $kabur = Array();

    foreach ($presensi as $value) {
      if($value->id_jenis_presensi == '1' ){
        $hadir[] = $value;
      }else if($value->id_jenis_presensi == '2' ){
        $TH[] = $value;
      }else if($value->id_jenis_presensi == '3' ){
        $kabur[] = $value;
      }else if($value->id_jenis_presensi == '4' ){
        $izin[] = $value;
      }else if($value->id_jenis_presensi == '5' ){
        $sakit[] = $value;
      }
    }

    $this->response([
      'presensi' => [
        'hadir' => $hadir,
        'TH' => $TH,
        'kabur' => $kabur,
        'izin' => $izin,
        'sakit' => $sakit
        ]], 200);
  }

}
