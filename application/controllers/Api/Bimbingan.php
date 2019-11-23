<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Bimbingan extends REST_Controller {
  function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('PresensiModel');
        $this->load->model('KeterlambatanModel');
    }

}
