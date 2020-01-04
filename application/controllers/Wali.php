<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wali extends CI_Controller
{
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

	public function edit()
	{
		$id_wali = $this->input->post('id_wali');
		$username = $this->input->post('username');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$nama = $this->input->post('nama');
		$this->WaliModel->edit($id_wali, $username, $no_hp, $email, $nama); //id_wali,);
		//var_dump($id_wali);
		redirect('wali');
	}

	function addWali()
	{
		$username = $this->input->post('username');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$nama = $this->input->post('nama');
		$passwordx = "wali123";
		$password = password_hash($passwordx, PASSWORD_DEFAULT);
		//$passwordx = md5($password);
		$this->WaliModel->simpan($username, $no_hp, $email, $nama, $password);
		redirect('wali');
	}


	public function form()
	{
		$data['menu'] = 'wali';
		$this->load->view('admin/wali/form', $data);
	}
}
