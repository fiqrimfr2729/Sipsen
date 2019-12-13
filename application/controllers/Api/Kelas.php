<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Kelas extends REST_Controller {
  function __construct() {
    parent::__construct();
        $this->load->model('M_kelas');
        //$this->load->library('upload');
  }

  public function get_kelas_get(){
    $kelas = $this->M_kelas->getAll();

    $this->response([
      'kelas' => $kelas], 200);
    }


}
