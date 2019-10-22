<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['menu']='dashboard';
		$this->load->view('admin/v_login', $data);
	}

}
