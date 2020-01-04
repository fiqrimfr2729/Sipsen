<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('IzinModel');
  }

  public function index()
  {
    $data['menu'] = 'wali';
    $data['izin'] = $this->IzinModel->getAll();

    $this->load->view('admin/izin/index', $data);
  }

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
