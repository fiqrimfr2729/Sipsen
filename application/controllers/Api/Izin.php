<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Izin extends REST_Controller {
  function __construct() {
    parent::__construct();
        $this->load->model('IzinModel');
        //$this->load->library('upload');
  }

  public function do_upload(){
    $name                           = time();
    $config['file_name']            = $name;
    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|jpeg|png';
    $config['max_size']             = 5012;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('userfile')){
      return false;
    }else{
      return $name;
    }
  }

  public function izin_siswa_post(){
    date_default_timezone_set("Asia/Jakarta");

    $nis = $this->post('nis');
    $tgl_mulai = $this->post('tgl_mulai');
    //$tgl_selesai = $this->post('tgl_selesai');
    $jenis_izin = $this->post('jenis_izin');
    $keterangan = $this->post('keterangan');

    $cek = $this->IzinModel->getIzinByTanggal($nis);
    if($cek){
      $this->response([
        'values' => 1,
        'Message' => 'Anda sudah mengajukan izin hari ini'], 200);
    }

    $upload = $this->do_upload();
    if($upload != false){
      $izin = array(
        'nis' => $nis,
        'tgl_mulai' => $tgl_mulai,
        'tgl_selesai' => $tgl_mulai,
        'jenis_izin' => $jenis_izin,
        'bukti' => $upload,
        'keterangan' => $keterangan,
        'tanggal_dikirim' => date('Y-m-d H:i:s'));
      $this->IzinModel->insertIzin($izin);

      $this->response([
        'values' => 1,
        'Message' => 'Berhasil'], 200);
    }else{
      $this->response([
        'values' => 0,
        'Message' => 'Gagal'], 200);
    }
  }

  public function getIzinByNIS_get(){
    $nis = $this->get('nis');

    $izin = $this->IzinModel->getIzinByNIS($nis);


    $this->response([
      'izin' => $izin], 200);
  }

  public function checkIzin(){
    $nis = $this->get('nis');

    $izin = $this->IzinModel->getIzinByTanggal($nis);

    if($izin){
      $this->response([
        'values' => 1,
        'Message' => 'Anda sudah mengajukan izin hari ini'], 200);
    }else{
      $this->response([
        'values' => 0,
        'Message' => 'Belum mengajukan izin'], 200);
    }
  }

  public function deleteIzin_post(){
    $id = $this->post('id_izin');
    $izin = $this->IzinModel->deleteIzin($id);

    if($izin){
      $this->response([
        'values' => 1,
        'Message' => 'Berhasil'], 200);
    }
  }
}
