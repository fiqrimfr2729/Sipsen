<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	public function index()
	{
    $data['menu']='jurusan';
		$this->load->view('admin/jurusan/index', $data);
	}
}
