<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_siswa");
		$this->load->library('form_validation');
	}


	public function index()
	{
		$data['menu'] = 'siswa';
		$data["siswa"] = $this->M_siswa->getAll();
		$this->load->view('admin/siswa/index', $data);
	}

	public function form()
	{
		$data['menu'] = 'siswa';
		$this->load->view('admin/siswa/form', $data);
	}
}
