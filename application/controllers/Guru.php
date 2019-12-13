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

	public function edit()
	{
		$NUPTK = $this->input->post('NUPTK');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$jk = $this->input->post('jk');
		//$status_bk = $this->input->post('status_bk');
		$status_bk = (isset($_POST['status_bk'])) ? 1 : 0;
		//$password = $this->input->post('password');
		//$token = $this->input->post('token');
		$this->M_guru->edit($NUPTK, $nama, $alamat, $no_hp, $email, $jk, $status_bk);
		redirect('guru');
	}

	function addGuru()
	{
		$NUPTK = $this->input->post('NUPTK');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$jk = $this->input->post('jk');
		//$status_bk = $this->input->post('status_bk');
		$status_bk = (isset($_POST['status_bk'])) ? 1 : 0;
		$password = $this->input->post('password');
		$passwordx = md5($password);
		$token = $this->input->post('token');
		$this->M_guru->simpan($NUPTK, $nama, $alamat, $no_hp, $email, $jk, $status_bk, $passwordx, $token);
		redirect('guru');
	}

	public function delete($NUPTK = null)
	{
		$NUPTK = $this->input->post('NUPTK');
		$this->M_guru->delete($NUPTK);
		redirect('guru');
	}

	public function resetPWD()
	{
		$NUPTK = $this->input->post('NUPTK');
		$password = "guru123";
		$passwordx = md5($password);
		$this->M_guru->resetPeWD($NUPTK, $passwordx);
		redirect('guru');
	}
}
