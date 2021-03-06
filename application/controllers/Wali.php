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
		$data['kelas'] = $this->M_kelas->getAll();
		$data['siswa'] = $this->M_siswa->getAll();

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
		$nis = $this->input->post('siswa');
		$passwordx = "Wali123";
		$password = password_hash($passwordx, PASSWORD_DEFAULT);
		//$passwordx = md5($password);
		$this->WaliModel->simpan($username, $no_hp, $email, $nama, $password, $nis);
		redirect('wali');
	}

	public function resetPWD()
	{
		$id_wali = $this->input->post('id_wali');
		$password = "Wali123";
		$passwordx = password_hash($password, PASSWORD_DEFAULT);
		$this->WaliModel->resetPeWD($id_wali, $passwordx);
		redirect('wali');
	}

	public function delete($id_wali = null)
	{
		$this->load->library('form_validation');
		$config = array(
			array(
				'field' => 'id_wali',
				'label' => 'id_wali',
				'rules' => 'is_unique[tb_siswa.id_wali]',
				'errors' => [
					'is_unique' => 'tidak bisa menghapus wali karena id_wali masih digunakan'
				]
			)
		);
		$id_wali = $this->input->post('id_wali');
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == false) {
			$data['menu'] = 'wali';
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger">
				<h4>Gagal</h4>
				<p>tidak bisa menghapus wali karena id_wali masih digunakan pada tabel siswa </p>
			</div>'
			);
			$this->load->view('admin/wali/index', $data);
		} else {
			$this->WaliModel->delete($id_wali);
			redirect('wali');
		}

		redirect('wali');
	}

	public function listSiswa()
	{
		// Ambil data ID kelas yang dikirim via ajax post
		$id_kelas = $this->input->post('id_kelas');
		$siswa = $this->M_siswa->getByKelas($id_kelas);
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>Pilih</option>";
		$siswa = $this->M_siswa->getAll();
		foreach ($siswa as $data) {
			$lists .= "<option value='" . $data->NIS . "'>" . $data->nama_siswa . "</option>"; // Tambahkan tag option ke variabel $lists
		}

		$callback = array('list_siswa' => $lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
		echo json_encode($callback); // konversi varibael $callback menjadi JSON

	}


	public function form()
	{
		$data['menu'] = 'wali';
		$this->load->view('admin/wali/form', $data);
	}
}
