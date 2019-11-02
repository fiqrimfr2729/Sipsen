<?php

class M_jurusan extends CI_Model
{
    private $_table = "tb_jurusan";

    public $id_jurusan;
    public $nama_jurusan;
    public $singkatan;

    public function rules()
    {
        return [
            [
                'field' => 'id_jurusan',
                'label' => 'id_Jurusan',
                'rules' => 'require'
            ],

            [
                'field' => 'nama_jurusan',
                'label' => 'nama_jurusan',
                'rules' => 'require'
            ],

            [
                'field' => 'singkatan',
                'label' => 'singkatan',
                'rules' => 'require'
            ],

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_jurusan" => $id])->row();
    }

    public function simpan($id_jurusan, $nama_jurusan, $singkatan)
    {
        $hasil = $this->db->query("INSERT INTO tb_jurusan (id_jurusan,nama_jurusan,singkatan) VALUES ('$id_jurusan','$nama_jurusan','$singkatan')");
        return $hasil;
    }

    function edit($id_jurusan, $nama_jurusan, $singkatan)
    {
        $hasil = $this->db->query("UPDATE tb_jurusan SET nama_jurusan='$nama_jurusan',singkatan='$singkatan' WHERE id_jurusan='$id_jurusan'");
        return $hasil;
    }

    public function delete($id_jurusan)
    {
        $hasil = $this->db->query("DELETE FROM tb_jurusan WHERE id_jurusan='$id_jurusan'");
        return $hasil;
    }
}
