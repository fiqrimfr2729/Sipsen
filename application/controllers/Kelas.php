<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function index()
	{
    $data['menu']='kelas';
		$this->load->view('admin/kelas/index', $data);
	}
}
