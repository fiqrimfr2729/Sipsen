<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('IzinModel');
  }

  function index()
  {
    $data['menu'] = 'izin';
    $data["izin"] = $this->IzinModel->getIzin();
    $this->load->view('admin/izin/index', $data);
  }

  //WEB
  //funcion meng edit data izin
  public function edit()
  {
    $id_izin = $this->input->post('id_izin');
    $this->IzinModel->konfirmasiIzin($id_izin);
    redirect('izin');
  }

  public function delete($id_izin = null)
  {
    $id_izin = $this->input->post('id_izin');
    $this->IzinModel->delete($id_izin);
    redirect('izin');
  }



  //MOBILE

  function konfirmasiIzin()
  {
    $this->IzinModel->konfirmasiIzin(2);
    echo "berhasil";
  }

  function getSiswaIzin()
  {
    $siswa = $this->IzinModel->getSiswaIzin();

    echo var_dump($siswa);
  }
}
