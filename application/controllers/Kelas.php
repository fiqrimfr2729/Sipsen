<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_kelas");
		$this->load->model("M_jurusan");
	}

	public function index()
	{
		$data['menu'] = 'kelas';
		$data['jurusan'] = $this->M_jurusan->getAll();
		$data['kelas'] = $this->M_kelas->getAll();


		//echo var_dump($data['kelas']);
		$this->load->view('admin/kelas/index', $data);
	}

	function edit()
	{
		$id_kelas = $this->input->post('id_kelas');
		$tingkat = $this->input->post('tingkat');
		$kd_alat = $this->input->post('kd_alat');
		$this->M_kelas->edit($id_kelas, $tingkat, $kd_alat);
		redirect('kelas');
	}

	function addKelas()
	{
		$id_jurusan = $this->input->post('id_jurusan');
		$tingkat = $this->input->post('tingkat');
		$nama = $this->input->post('nama');
		$kd_alat = $this->input->post('kd_alat');
		$this->M_kelas->simpan($id_jurusan, $tingkat, $nama, $kd_alat);
		redirect('kelas');
	}

	public function delete($id_kelas = null)
	{
		$id_kelas = $this->input->post('id_kelas');
		$this->M_kelas->delete($id_kelas);
		redirect('kelas');
	}
}
