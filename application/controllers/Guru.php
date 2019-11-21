<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_guru");
	}

	public function index()
	{
		$data['menu'] = 'guru';
		$data['guru'] = $this->M_guru->getAll();
		$this->load->view('admin/guru/index', $data);
	}

	public function form()
	{
		$data['menu'] = 'siswa';
		$this->load->view('admin/guru/form', $data);
	}

	function edit()
	{
		$NUPTK = $this->input->post('NUPTK');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$jk = $this->input->post('jk');
		$status_bk = $this->input->post('status_bk');
		$password = $this->input->post('password');
		$token = $this->input->post('token');

		$this->M_guru > edit($NUPTK, $nama, $alamat, $no_hp, $email, $jk, $status_bk, $password, $token);
		redirect('guru');
	}

	function addJurusan()
	{
		$NUPTK = $this->input->post('NUPTK');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$jk = $this->input->post('jk');
		$status_bk = $this->input->post('status_bk');
		$password = $this->input->post('password');
		$token = $this->input->post('token');
		$this->M_guru->simpan($NUPTK, $nama, $alamat, $no_hp, $email, $jk, $status_bk, $password, $token);
		redirect('guru');
	}

	public function delete($NUPTK = null)
	{
		$NUPTK = $this->input->post('NUPTK');
		$this->M_guru->delete($NUPTK);
		redirect('guru');
	}
}
