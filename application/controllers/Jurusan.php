<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_jurusan");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['menu'] = 'jurusan';
		$data["jurusan"] = $this->M_jurusan->getAll();
		$this->load->view('admin/jurusan/index', $data);
	}

	public function add()
	{
		$jurusan = $this->M_jurusan;
		$validation = $this->form_validation;
		$validation->set_rules($jurusan->rules());

		if ($validation->run()) {
			$jurusan->save();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
		}

		$this->load->view("admin/jurusan/index");
	}

	function edit()
	{
		$id_jurusan = $this->input->post('id_jurusan');
		$nama_jurusan = $this->input->post('nama_jurusan');
		$singkatan = $this->input->post('singkatan');
		$this->M_jurusan->edit($id_jurusan, $nama_jurusan, $singkatan);
		redirect('jurusan');
	}

	function addJurusan()
	{
		$id_jurusan = uniqid();
		$nama_jurusan = $this->input->post('nama_jurusan');
		$singkatan = $this->input->post('singkatan');
		$this->M_jurusan->simpan($id_jurusan, $nama_jurusan, $singkatan);
		redirect('jurusan');
	}

	public function delete($id_jurusan = null)
	{
		$id_jurusan = $this->input->post('id_jurusan');
		$this->M_jurusan->delete($id_jurusan);
		redirect('jurusan');
	}
}
