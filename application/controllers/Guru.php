<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function index()
	{
    $data['menu']='guru';
		$this->load->view('admin/guru/index', $data);
	}
}
