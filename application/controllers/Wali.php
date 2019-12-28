<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wali extends CI_Controller{
  public function __construct()
	{
		parent::__construct();
		$this->load->model("M_siswa");
		$this->load->model("M_jurusan");
		$this->load->model("M_kelas");
    $this->load->model("WaliModel");
	}

  public function index()
	{
    $data['menu'] = 'wali';
    $data['wali'] = $this->WaliModel->getAll();

		$this->load->view('admin/wali/index', $data);
	}

  public function form()
	{
		$data['menu'] = 'wali';
		$this->load->view('admin/wali/form', $data);
	}

}
