<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Profil extends REST_Controller {
  function __construct() {
    parent::__construct();
        $this->load->model('SiswaModel');
        //$this->load->library('upload');
  }

  function getProfilSiswa_get(){
    $nis = $this->get('nis');

    $siswa = $this->SiswaModel->getSiswaByNIS2($nis);

    $this->response(
      $siswa, 200);
  }

  function getProfilWali_get(){
    $username = $this->get('username');

    $wali = $this->db->select('id_wali, nama, email, username')->where('username', $username)->from('tb_wali')->get()->row();

    $this->response(
      $wali, 200);
  }

  function getProfilGuru_get(){
    $id = $this->get('nuptk');

    $guru = $this->db->select('NUPTK, nama, alamat, no_hp, email')->where('NUPTK', $id)->from('tb_guru')->get()->row();

    $this->response(
      $guru, 200);
  }

}
