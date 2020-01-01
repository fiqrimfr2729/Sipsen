<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_siswa");
		$this->load->model("M_jurusan");
		$this->load->model("M_kelas");
	}

	public function index()
	{
		$data['menu'] = 'siswa';
		$data["siswa"] = $this->M_siswa->getAll();

		$this->load->view('admin/siswa/index', $data);
		//$this->load->view('admin/siswa/index');
	}

	public function form()
	{
		$data['menu'] = 'siswa';
		$this->load->view('admin/siswa/form', $data);
	}

	//funcion meng edit data siswa
	public function edit()
	{
		$NIS = $this->input->post('NIS');
		$NISN = $this->input->post('NISN');
		$nama = $this->input->post('nama');
		$jk = $this->input->post('jk');
		$id_kelas = $this->input->post('id_kelas');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$nama_ayah = $this->input->post('nama_ayah');
		$nama_ibu = $this->input->post('nama_ibu');
		//$id_wali = $this->input->post('id_wali');
		$id_fp = $this->input->post('id_fp');
		//$passwordx = md5($password);
		$this->M_siswa->edit($NIS, $NISN, $nama, $jk, $id_kelas, $tgl_lahir, $no_hp, $email, $alamat, $nama_ayah, $nama_ibu, $id_fp);
		redirect('siswa');
	}

	//function menambah data siswa
	function addSiswa()
	{
		$NIS = $this->input->post('NIS');
		$NISN = $this->input->post('NISN');
		$nama = $this->input->post('nama');
		$jk = $this->input->post('jk');
		$id_kelas = $this->input->post('id_kelas');
		$tgl_lahir = $this->input->post('tgl_lahir');
		//$status_bk = $this->input->post('status_bk');
		//$status_bk = (isset($_POST['status_bk'])) ? 1 : 0;
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$nama_ayah = $this->input->post('nama_ayah');
		$nama_ibu = $this->input->post('nama_ibu');
		$id_fp = "0";
		$passwordx = "guru123";
		$password = password_hash($passwordx, PASSWORD_DEFAULT);
		//$passwordx = md5($password);
		$this->M_siswa->simpan($NIS, $NISN, $nama, $jk, $id_kelas, $tgl_lahir, $no_hp, $email, $alamat, $nama_ayah, $nama_ibu, $id_fp, $password);
		redirect('siswa');
	}

	//function untuk hapus value
	public function delete($NIS = null)
	{
		$NIS = $this->input->post('NIS');
		$this->M_siswa->delete($NIS);
		redirect('siswa');
	}


	public function resetPWD()
	{
		$NIS = $this->input->post('NIS');
		$password = "guru123";
		$passwordx = password_hash($password, PASSWORD_DEFAULT);
		$this->M_siswa->resetPeWD($NIS, $passwordx);
		redirect('siswa');
	}
}
