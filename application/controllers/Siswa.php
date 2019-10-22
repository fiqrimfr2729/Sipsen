<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function index()
	{
    $data['menu']='siswa';
		$this->load->view('admin/siswa/index', $data);
	}
}
