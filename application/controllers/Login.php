<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index()
	{
		$data['menu'] = 'dashboard';
		$this->load->view('admin/v_login', $data);
	}

	public function password_check($str)
	{
		if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
			return TRUE;
		}
		return FALSE;
	}

	public function aksilogin()
	{
		//$this->form_validation->set_rules('username', 'Username', 'trim|required');
		//$this->form_validation->set_rules('password', 'Password', 'trim|required|numeric');

		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|required',
			array('required' => 'Username tidak boleh kosong')
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|required|alpha_numeric|regex_match[/(?=.*?[a-z,A-Z])(?=.*?[0-9])/]',
			array(
				'regex_match' => 'Password harus menggunakan alfabet dan numerik',
				'required' => 'Password tidak boleh kosong '
			)
		);

		if ($this->form_validation->run() != false) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array(
				'username' => $username,
				'password' => md5($password)
			);
			$cek = $this->m_login->cek_login("tb_admin", $where)->num_rows();
			if ($cek > 0) {

				$data_session = array(
					'nama' => $username,
					'status' => "login"
				);

				$this->session->set_userdata($data_session);
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success">
                    <h4>Gagal</h4>
                    <p>Username atau Password yang anda masukkan salah!</p>
                </div>'
				);

				redirect(base_url("welcome"));
			} else {

				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger">
                    <h4>Gagal</h4>
                    <p>Username atau Password yang anda masukkan salah!</p>
                </div>'
				);
				$this->load->view('admin/v_login');
			}
		} else {

			$this->load->view('admin/v_login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}
}
