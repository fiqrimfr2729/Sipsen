<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Profil extends REST_Controller {
  function __construct() {
    parent::__construct();
        $this->load->model('SiswaModel');
        //$this->load->library('upload');
  }

  function getProfilSiswa_get(){
    $nis = $this->get('nis');

    $siswa = $this->SiswaModel->getSiswaByNIS2($nis);

    $this->response(
      $siswa, 200);
  }

  function getProfilWali_get(){
    $username = $this->get('username');

    $wali = $this->db->select('id_wali, nama, email, username')->where('username', $username)->from('tb_wali')->get()->row();

    $this->response(
      $wali, 200);
  }

  function getProfilGuru_get(){
    $id = $this->get('nuptk');

    $guru = $this->db->select('NUPTK, nama, alamat, no_hp, email')->where('NUPTK', $id)->from('tb_guru')->get()->row();

    $this->response(
      $guru, 200);
  }

  function ubahPasswordSiswa_post(){
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
                'required' => 'Password tidak boleh kosong'
            ]
        ),
        array(
            'field' => 'passwordBaru',
            'label' => 'passwordBaru',
            'rules' => 'required|regex_match[/(?=.*?[a-z,A-Z])(?=.*?[0-9])/]',
            'errors' => [
                'required' => 'Password baru tidak boleh kosong',
                'regex_match' => 'Password baru harus menggunakan alfabet dan numerik'
            ]
        )
    );
    $this->form_validation->set_rules($config);

    $nis = $this->post('nis');
    $password = $this->post('password');
    $passwordBaru = $this->post('passwordBaru');
    $user =  $this->db->get_where('tb_siswa', ['NIS' => $nis])->row_array();

    if ($this->form_validation->run() != false) {
      if ($user) {
        if (password_verify($password, $user['password'])) {
          $this->db->set('password', password_hash($passwordBaru, PASSWORD_DEFAULT));
          $this->db->where('nis', $nis);
          $query = $this->db->update('tb_siswa');
          if($query){
            $this->response([
                'value'   => 1,
                'message' => 'Password berhasil diubah'
            ], 200);
          }
        } else {
            $this->response([
                'value'   => 0,
                'message' => 'Password lama salah'
            ], 200);
        }
      }else {
          $this->response([
              'value'   => 0,
              'message' => 'NIS tidak terdaftar'
          ], 200);
      }
    }else{
        $this->response([
            'value'   => 0,
            'message' => validation_errors()
        ], 200);
    }
  }

  function ubahPasswordGuru_post(){
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
                'required' => 'Password tidak boleh kosong'
            ]
        ),
        array(
            'field' => 'passwordBaru',
            'label' => 'passwordBaru',
            'rules' => 'required|regex_match[/(?=.*?[a-z,A-Z])(?=.*?[0-9])/]',
            'errors' => [
                'required' => 'Password baru tidak boleh kosong',
                'regex_match' => 'Password baru harus menggunakan alfabet dan numerik'
            ]
        )
    );
    $this->form_validation->set_rules($config);

    $nuptk = $this->post('nuptk');
    $password = $this->post('password');
    $passwordBaru = $this->post('passwordBaru');
    $user =  $this->db->get_where('tb_guru', ['nuptk' => $nuptk])->row_array();

    if ($this->form_validation->run() != false) {
      if ($user) {
        if (password_verify($password, $user['password'])) {
          $this->db->set('password', password_hash($passwordBaru, PASSWORD_DEFAULT));
          $this->db->where('nuptk', $nuptk);
          $query = $this->db->update('tb_guru');
          if($query){
            $this->response([
                'value'   => 1,
                'message' => 'Password berhasil diubah'
            ], 200);
          }
        } else {
            $this->response([
                'value'   => 0,
                'message' => 'Password lama salah'
            ], 200);
        }
      }else {
          $this->response([
              'value'   => 0,
              'message' => 'NUPTK tidak terdaftar'
          ], 200);
      }
    }else{
        $this->response([
            'value'   => 0,
            'message' => validation_errors()
        ], 200);
    }
  }

  function ubahPasswordWali_post(){
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
                'required' => 'Password tidak boleh kosong'
            ]
        ),
        array(
            'field' => 'passwordBaru',
            'label' => 'passwordBaru',
            'rules' => 'required|regex_match[/(?=.*?[a-z,A-Z])(?=.*?[0-9])/]',
            'errors' => [
                'required' => 'Password baru tidak boleh kosong',
                'regex_match' => 'Password baru harus menggunakan alfabet dan numerik'
            ]
        )
    );
    $this->form_validation->set_rules($config);

    $username = $this->post('username');
    $password = $this->post('password');
    $passwordBaru = $this->post('passwordBaru');
    $user =  $this->db->get_where('tb_wali', ['username' => $username])->row_array();

    if ($this->form_validation->run() != false) {
      if ($user) {
        if (password_verify($password, $user['password'])) {
          $this->db->set('password', password_hash($passwordBaru, PASSWORD_DEFAULT));
          $this->db->where('username', $username);
          $query = $this->db->update('tb_wali');
          if($query){
            $this->response([
                'value'   => 1,
                'message' => 'Password berhasil diubah'
            ], 200);
          }
        } else {
            $this->response([
                'value'   => 0,
                'message' => 'Password lama salah'
            ], 200);
        }
      }else {
          $this->response([
              'value'   => 0,
              'message' => 'username tidak terdaftar'
          ], 200);
      }
    }else{
        $this->response([
            'value'   => 0,
            'message' => validation_errors()
        ], 200);
    }
  }

}
