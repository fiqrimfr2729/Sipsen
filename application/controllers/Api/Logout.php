<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Logout extends REST_Controller {
  function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function logout_siswa_post(){
      $nis = $this->post('nis');
      $token = null;

      $this->db->set('token', $token)->where('nis', $nis);
      $this->db->update('tb_siswa');

      $this->response([
          'value'   => 1,
          'message' => 'Berhasil'
      ], 200);

    }

    function logout_wali_post(){
      $username = $this->post('username');
      $token = null;

      $this->db->set('token', $token)->where('username', $username);
      $this->db->update('tb_wali');

      $this->response([
          'value'   => 1,
          'message' => 'Berhasil'
      ], 200);

    }

    function logout_guru_post(){
      $nuptk = $this->post('nuptk');
      $token = null;

      $this->db->set('token', $token)->where('nuptk', $nuptk);
      $this->db->update('tb_guru');

      $this->response([
          'value'   => 1,
          'message' => 'Berhasil'
      ], 200);

    }
}
