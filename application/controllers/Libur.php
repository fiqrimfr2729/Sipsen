<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Libur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Libur");
    }

    public function index()
    {
        $data['menu'] = 'libur';
        $data['libur'] = $this->M_Libur->getAll();
        //echo var_dump($data['kelas']);
        $this->load->view('admin/libur/index', $data);
    }

    function edit()
    {

        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        $this->M_Libur->edit($id, $tanggal, $keterangan);
        redirect('libur');
    }

    function Tambah()
    {

        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        $this->M_Libur->simpan($tanggal, $keterangan);
        redirect('libur');
    }

    public function delete($id = null)
    {
        $id = $this->input->post('id');
        $this->M_Libur->delete($id);
        redirect('libur');
    }
}
