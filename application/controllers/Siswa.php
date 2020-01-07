<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_siswa");
		$this->load->model("SiswaModel");
		$this->load->model("M_jurusan");
		$this->load->model("M_kelas");
		$this->load->library('form_validation');
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
		$this->load->library('form_validation');
		$config = array(
			array(
				'field' => 'NIS',
				'label' => 'NIS',
				'rules' => 'is_unique[tb_siswa.NIS]',
				'errors' => [
					'is_unique' => 'NIS sudah terdaftar didatabase'
				]
			),
			array(
				'field' => 'NISN',
				'label' => 'NISN',
				'rules' => 'is_unique[tb_siswa.NISN]',
				'errors' => [
					'is_unique' => 'NISN sudah terdaftar didatabase'
				]
			)
		);
		$NIS = $this->input->post('NIS');
		$NISN = $this->input->post('NISN');
		$nama_siswa = $this->input->post('nama_siswa');
		$jk = $this->input->post('jk');
		$id_kelas = $this->input->post('id_kelas');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$nama_ayah = $this->input->post('nama_ayah');
		$nama_ibu = $this->input->post('nama_ibu');
		$id_fp = $this->input->post('id_fp');
		$passwordx = "guru123";
		$password = password_hash($passwordx, PASSWORD_DEFAULT);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == false) {
			$data['menu'] = 'siswa';
			$this->load->view('admin/siswa/form', $data);
		} else {

			$this->M_siswa->simpan($NIS, $NISN, $nama_siswa, $jk, $id_kelas, $tgl_lahir, $no_hp, $email, $alamat, $nama_ayah, $nama_ibu, $id_fp, $password);
			redirect('siswa');
		}
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
		$password = "Siswa123";
		$passwordx = password_hash($password, PASSWORD_DEFAULT);
		$this->M_siswa->resetPeWD($NIS, $passwordx);
		redirect('siswa');
	}

	public function getSiswaByKelas(){
		$id_kelas = $this->input->post('id_kelas');
		//$id_kelas = '1';
		$siswa = $this->SiswaModel->getSiswaNonWali($id_kelas);
		echo json_encode($siswa);
	}
}
