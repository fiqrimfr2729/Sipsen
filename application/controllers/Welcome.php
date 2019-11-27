<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$data['menu'] = 'dashboard';
		$this->load->view('admin/overview', $data);
	}

	public function tambahLibur(){
		$date = date('Y:m:d');
		$keterangan = 'libur pahlawan';
		$data =  array(
			'tanggal' => $date,
			'keterangan' => $keterangan
		);

		$this->db->insert('tb_libur', $data);
	}
}
