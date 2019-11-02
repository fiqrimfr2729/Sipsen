<?php

class M_siswa extends CI_Model
{

    private $_table = "tb_siswa";

    public $nis;
    public $nisn;
    public $nama;
    public $id_kelas;
    public $tgl_lahir;
    public $no_hp;
    public $email;
    public $alamat;
    public $nama_ayah;
    public $nama_ibu;
    public $id_wali;
    public $id_fp;
    public $password;

    public function rules()
    {
        return [
            [
                'field' => 'nis',
                'label' => 'NIS',
                'rules' => 'require'
            ],

            [
                'field' => 'nisn',
                'label' => 'NISN',
                'rules' => 'require'
            ],

            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'require'
            ],

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getByNis($nis)
    {
        return $this->db->get_where($this->_table, ["NIS" => $nis])->row();
    }

    public function getById_Kelas($id_kelas)
    {
        return $this->db->get_where($this->_table, ["id_kelas" => $id_kelas])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->NIS = $_POST["nis"];
        $this->NISN = $_POST["nisn"];
        $this->nama = $_POST["nama"];
        $this->jk = $_POST["jk"];
        $this->id_kelas = $_POST["id_kelas"];
        $this->tgl_lahir = $_POST["tgl_lahir"];
        $this->no_hp = $_POST["no_hp"];
        $this->email = $_POST["email"];
        $this->alamat = $_POST["alamat"];
        $this->nama_ayah = $_POST["nama_ayah"];
        $this->nama_ibu = $_POST["nama_ibu"];
        $this->id_wali = $_POST["id_wali"];
        $this->id_fp = $_POST["id_fp"];
        $this->password = $_POST["password"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->NIS = $_POST["nis"];
        $this->NISN = $_POST["nisn"];
        $this->nama = $_POST["nama"];
        $this->jk = $_POST["jk"];
        $this->id_kelas = $_POST["id_kelas"];
        $this->tgl_lahir = $_POST["tgl_lahir"];
        $this->no_hp = $_POST["no_hp"];
        $this->email = $_POST["email"];
        $this->alamat = $_POST["alamat"];
        $this->nama_ayah = $_POST["nama_ayah"];
        $this->nama_ibu = $_POST["nama_ibu"];
        $this->id_wali = $_POST["id_wali"];
        $this->id_fp = $_POST["id_fp"];
        $this->password = $_POST["password"];
        $this->db->insert($this->_table, $this, array('nis' => $post['nis']));
    }

    public function delete($nis)
    {
        return $this->db->delete($this->_table, array("nis" => $nis));
    }
}
