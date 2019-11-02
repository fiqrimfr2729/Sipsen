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

	public function tambah()
	{
		$siswa = $this->m_siswa;
		$validation = $this->form_validation;
		$validation->set_rules($siswa->rules());

		if ($validation->run()) {
			$siswa->save();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
		}

		$this->load->view("admin/siswa/All");
	}


	public function edit($nis = null)
	{
		if (!isset($nis)) redirect('siswa');

		$siswa = $this->m_siswa;
		$validation = $this->form_validation;
		$validation->set_rules($siswa->rules());

		if ($validation->run()) {
			$siswa->update();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
		}

		$data["nis"] = $siswa->getById($nis);
		if (!$data["nis"]) show_404();

		$this->load->view("admin/", $data);
	}
}
