<?php

class M_siswa extends CI_Model
{

    private $_table = "tb_siswa";

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getByTingkat($tingkat)
    {
        return $this->db->get_where($this->_table, ["tingkat" => $tingkat]->row());
    }

    public function simpan($id_kelas, $id_jurusan, $tingkat, $nama)
    {
        $hasil = $this->db->query("INSERT INTO tb_kelas (id_kelas,id_jurusan,tingkat,nama) VALUES ('$id_kelas','$id_jurusan','$tingkat','$nama')");
        return $hasil;
    }

    function edit($id_kelas, $id_jurusan, $tingkat, $nama)
    {
        $hasil = $this->db->query("UPDATE tb_kelas SET id_jurusan='$id_jurusan',tingkat='$tingkat',nama='$nama' WHERE id_kelas='$id_kelas'");
        return $hasil;
    }

    public function delete($id_kelas)
    {
        $hasil = $this->db->query("DELETE FROM tb_kelas WHERE id_jurusan='$id_kelas'");
        return $hasil;
    }
}
