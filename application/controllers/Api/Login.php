<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {
  function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function login_siswa_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $config = array(
            array(
                'field' => 'nis',
                'label' => 'nis',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'NIS tidak boleh kosong',
                    'numeric' => 'Format NIS salah',
                    'min_lenght' => ''
                ]
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                ]
            )
        );
        $this->form_validation->set_rules($config);

        $nis = $this->post('nis');
        $password = $this->post('password');
        $token = $this->post('token');
        $user =  $this->db->get_where('tb_siswa', ['NIS' => $nis])->row_array();

        if ($this->form_validation->run() != false) {
            if ($user) {
                    //cek password
                    if (password_verify($password, $user['password'])) {
                      $this->db->set('token', $token)->where('nis', $nis);
                      $this->db->update('tb_siswa');
                        $this->response([
                            'value'   => 1,
                            'message' => 'Berhasil'
                        ], 200);
                    } else {
                        $this->response([
                            'value'   => 0,
                            'message' => 'Password salah'
                        ], 200);
                    }
            } else {
                $this->response([
                    'value'   => 0,
                    'message' => 'NIS tidak terdaftar'
                ], 200);
            }
        } else {
            $this->response([
                'value'   => 0,
                'message' => validation_errors()
            ], 200);
        }
    }

    function login_guru_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $config = array(
            array(
                'field' => 'nuptk',
                'label' => 'nuptk',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'NUPTK tidak boleh kosong',
                    'numeric' => 'Format NUPTK salah',
                    'min_lenght' => ''
                ]
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                ]
            )
        );
        $this->form_validation->set_rules($config);

        $nuptk = $this->post('nuptk');
        $password = $this->post('password');
        $token = $this->post('token');
        $user =  $this->db->get_where('tb_guru', ['NUPTK' => $nuptk])->row_array();

        if ($this->form_validation->run() != false) {
            if ($user) {
                    //cek password
                    if (password_verify($password, $user['password'])) {
                      $this->db->set('token', $token)->where('nuptk', $nuptk);
                      $this->db->update('tb_guru');
                        $this->response([
                            'value'   => 1,
                            'message' => 'Berhasil'
                        ], 200);
                    } else {
                        $this->response([
                            'value'   => 0,
                            'message' => 'Password salah'
                        ], 200);
                    }
            } else {
                $this->response([
                    'value'   => 0,
                    'message' => 'NUPTK tidak terdaftar'
                ], 200);
            }
        } else {
            $this->response([
                'value'   => 0,
                'message' => validation_errors()
            ], 200);
        }
    }

    function login_wali_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $config = array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'alpha_numeric' => 'Format username salah',
                    'min_lenght' => ''
                ]
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                ]
            )
        );
        $this->form_validation->set_rules($config);

        $username = $this->post('username');
        $password = $this->post('password');
        $token = $this->post('token');
        $user =  $this->db->get_where('tb_wali', ['username' => $username])->row_array();

        if ($this->form_validation->run() != false) {
            if ($user) {
                    //cek password
                    if (password_verify($password, $user['password'])) {
                      $siswa = $this->db->select('NIS, NISN, nama_siswa')->where('id_wali', $user['id_wali'])->from('tb_siswa')->get()->row();
                      $this->db->set('token', $token)->where('username', $username);
                      $this->db->update('tb_wali');
                        $this->response([
                            'value'   => 1,
                            'message' => 'Berhasil',
                            'siswa' => $siswa
                        ], 200);
                    } else {
                        $this->response([
                            'value'   => 0,
                            'message' => 'Password salah'
                        ], 200);
                    }
            } else {
                $this->response([
                    'value'   => 0,
                    'message' => 'Username tidak terdaftar'
                ], 200);
            }
        } else {
            $this->response([
                'value'   => 0,
                'message' => validation_errors()
            ], 200);
        }
    }
}
