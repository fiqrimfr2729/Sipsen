<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Bimbingan extends REST_Controller {
  function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('BimbinganModel');
        $this->load->model('M_guru');
        $this->load->model('SiswaModel');
        $this->load->model('NotifikasiModel');
    }

    function bimbingan_post(){
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
              'field' => 'bimbingan',
              'label' => 'bimbingan',
              'rules' => 'required',
              'errors' => [
                  'required' => 'Bimbingan tidak boleh kosong',
              ]
          )
      );
      $this->form_validation->set_rules($config);

      if ($this->form_validation->run() != false) {
        $nis = $this->post('nis');
        $bimbingan = $this->post('bimbingan');
        $siswa = $this->db->where('NIS', $nis)->from('tb_siswa')->get()->row();
        if($siswa != null){
          $query = $this->BimbinganModel->insertBimbingan($nis, $bimbingan);
          if($query){
            $gurus = $this->M_guru->getGuruBK();
            $token = array();

            foreach($gurus as $guru){
              if($guru->token != null){
                $token[] = $guru->token;
              }
            }

            if(sizeof($token) !=0){
              $judul = 'Informasi bimbingan';
              $isi = 'Bimbingan baru';
              $this->NotifikasiModel->notifMultipleSiswa($token,$judul, $isi);
            }

            $this->response([
                'value'   => 1,
                'message' => "Upload bimbingan berhasil"
            ], 200);
          }else{
            $this->response([
                'value'   => 0,
                'message' => "Upload bimbingan gagal"
            ], 200);
          }
        }else{
          $this->response([
              'value'   => 0,
              'message' => "NIS tidak terdaftar"
          ], 200);
        }
      } else {
          $this->response([
              'value'   => 0,
              'message' => validation_errors()
          ], 200);
      }

    }

    function saran_post(){
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('', '');

      $config = array(
          array(
              'field' => 'nuptk',
              'label' => 'nuptk',
              'rules' => 'required|numeric',
              'errors' => [
                  'required' => 'nuptk tidak boleh kosong',
                  'numeric' => 'Format NUPTK salah',
                  'min_lenght' => ''
              ]
          ),
          array(
              'field' => 'saran',
              'label' => 'saran',
              'rules' => 'required',
              'errors' =>[
                  'required' => 'saran tidak boleh kosong',
              ]
          )
      );
      $this->form_validation->set_rules($config);

      if ($this->form_validation->run() != false) {
        $nuptk = $this->post('nuptk');
        $saran = $this->post('saran');
        $id = $this->post('id_bimbingan');
        $guru = $this->db->where('NUPTK', $nuptk)->from('tb_guru')->get()->row();
        if($guru != null){
          //get siswa dan insert saran
          $siswa = $this->BimbinganModel->saran($id, $nuptk, $saran);
          if($siswa != null){
            $token = $siswa->token;

            if($token != null){
              $this->NotifikasiModel->notifBimbingan($token);
            }

            $this->response([
                'value'   => 1,
                'message' => "Upload saran berhasil"
            ], 200);
          }else{
            $this->response([
                'value'   => 0,
                'message' => "Upload saran gagal"
            ], 200);
          }
        }else{
          $this->response([
              'value'   => 0,
              'message' => "NUPTK tidak terdaftar"
          ], 200);
        }
      } else {
          $this->response([
              'value'   => 0,
              'message' => validation_errors()
          ], 200);
      }
    }

    function getBimbinganByNIS_post(){
      $nis = $this->post('nis');

      $siswa = $this->db->where('nis', $nis)->from('tb_siswa')->get()->row();

      if($siswa != null){
        $bimbingan = $this->BimbinganModel->getBimbinganByNIS($nis);

        $sudahDibalas = array();
        $belumDibalas = array();

        foreach($bimbingan as $bimbing){
          if($bimbing->saran == null){
            $belumDibalas[] = $bimbing;
          }else{
            $sudahDibalas[] = $bimbing;
          }
        }

        $this->response([
            'sudahDibalas' => $sudahDibalas,
            'belumDibalas' => $belumDibalas
        ], 200);
      }else{
        $this->response([
            []
        ], 200);
      }
    }

    function getBimbingan_get(){
      $bimbingan = $this->BimbinganModel->getBimbingan();

      $sudahDibalas = array();
      $belumDibalas = array();

      foreach($bimbingan as $bimbing){
        $siswa = $this->SiswaModel->getSiswaByNIS2($bimbing->NIS);
        $bimbing->siswa = $siswa;
        if($bimbing->saran == null){
          $belumDibalas[] = $bimbing;
        }else{
          $sudahDibalas[] = $bimbing;
        }
      }

      $this->response([
          'sudahDibalas' => $sudahDibalas,
          'belumDibalas' => $belumDibalas
      ], 200);

    }

}
