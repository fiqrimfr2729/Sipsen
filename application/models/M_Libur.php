<?php

class M_Libur extends CI_Model
{

    private $_table = "tb_libur";

    public function getAll()
    {
        $libur = $this->db->get($this->_table)->result();
        return $libur;
    }

    public function simpan($tanggal, $keterangan)
    {
        $data = array(
            'tanggal' => $tanggal,
            'keterangan' => $keterangan,
        );

        $this->db->insert('tb_libur', $data);
        return true;
        //$hasil = $this->db->query("INSERT INTO tb_kelas (id_kelas,id_jurusan,tingkat,nama,kd_alat) VALUES ('$id_kelas', '$id_jurusan', '$tingkat', '$nama','$kd_alat')");
        //return $hasil;
    }

    function edit($id, $tanggal, $keterangan)
    {
        $this->db->set('tanggal', $tanggal);
        $this->db->set('keterangan', $keterangan);
        $this->db->where('id', $id);
        $this->db->update('tb_libur');


        //$hasil = $this->db->query("UPDATE tb_kelas SET id_jurusan='$id_jurusan',tingkat='$tingkat',nama='$nama' WHERE id_jurusan='$id_kelas'");
        //return $hasil;
    }

    public function delete($id)
    {

        $this->db->delete('tb_libur', array('id' => $id));
        //$hasil = $this->db->query("DELETE FROM tb_kelas WHERE id_kelas='$id_kelas'");
        //return $hasil;
    }
}
