<?php

class M_kelas extends CI_Model
{

    private $_table = "tb_kelas";


    public function getAll()
    {
        $kelas = $this->db->get($this->_table)->result();
        foreach ($kelas as $kelass) {
            $kelass->id_jurusan = $this->getJurusanId($kelass->id_jurusan);
        }
        return $kelas;
    }

    public function getJurusanId($id_jurusan)
    {

        return $this->db->where('id_jurusan', $id_jurusan)->from('tb_jurusan')->get()->row();
    }



    public function simpan($id_jurusan, $tingkat, $nama, $kd_alat)
    {
        $data = array(
            'id_jurusan' => $id_jurusan,
            'tingkat' => $tingkat,
            'nama' => $nama,
            'kd_alat' => $kd_alat
        );

        $this->db->insert('tb_kelas', $data);
        return true;
        //$hasil = $this->db->query("INSERT INTO tb_kelas (id_kelas,id_jurusan,tingkat,nama,kd_alat) VALUES ('$id_kelas', '$id_jurusan', '$tingkat', '$nama','$kd_alat')");
        //return $hasil;
    }

    function edit($id_kelas, $id_jurusan, $tingkat, $nama)
    {
        $hasil = $this->db->query("UPDATE tb_kelas SET id_jurusan='$id_jurusan',tingkat='$tingkat',nama='$nama' WHERE id_jurusan='$id_kelas'");
        return $hasil;
    }

    public function delete($id_kelas)
    {
        $hasil = $this->db->query("DELETE FROM tb_kelas WHERE id_kelas='$id_kelas'");
        return $hasil;
    }
}
