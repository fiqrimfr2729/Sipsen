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

    public function getAllKelas()
    {
        $kelas = $this->db->get($this->_table)->result();
        return $kelas;
    }

    public function getJurusanId($id_jurusan)
    {

        return $this->db->where('id_jurusan', $id_jurusan)->from('tb_jurusan')->get()->row();
    }

    public function getNamaKelas()
    {
        $this->db->select('id_kelas, tingkat, nama, singkatan');
        $this->db->from('tb_kelas');
        $this->db->join('tb_jurusan', 'tb_kelas.id_jurusan = tb_jurusan.id_jurusan');
        $data = $this->db->get()->result();

        foreach ($data as $kelas) {
            $kelas->kelas = $kelas->tingkat . ' ' . $kelas->singkatan . ' ' . $kelas->nama;
        }

        return $data;
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

    function edit($id_kelas, $tingkat, $kd_alat)
    {
        $this->db->set('tingkat', $tingkat);
        $this->db->set('kd_alat', $kd_alat);
        $this->db->where('id_kelas', $id_kelas);
        $this->db->update('tb_kelas');


        //$hasil = $this->db->query("UPDATE tb_kelas SET id_jurusan='$id_jurusan',tingkat='$tingkat',nama='$nama' WHERE id_jurusan='$id_kelas'");
        //return $hasil;
    }

    public function delete($id_kelas)
    {

        $this->db->delete('tb_kelas', array('id_kelas' => $id_kelas));
        //$hasil = $this->db->query("DELETE FROM tb_kelas WHERE id_kelas='$id_kelas'");
        //return $hasil;
    }

    public function getNamaKelasByID($id_kelas){
      $kelas = $this->db->select('tingkat, nama, singkatan')->where('id_kelas', $id_kelas)
                ->from('tb_kelas')
                ->join('tb_jurusan', 'tb_kelas.id_jurusan = tb_jurusan.id_jurusan')
                ->get()->row();
      $data = $kelas->tingkat . ' ' . $kelas->singkatan . ' ' . $kelas->nama;
      return $data;
    }

    public function getNamaKelas(){
      $this->db->select('id_kelas, tingkat, nama, singkatan');
      $this->db->from('tb_kelas');
      $this->db->join('tb_jurusan', 'tb_kelas.id_jurusan = tb_jurusan.id_jurusan');
      $data = $this->db->get()->result();

      foreach ($data as $kelas) {
        $kelas->kelas = $kelas->tingkat . ' ' . $kelas->singkatan . ' ' . $kelas->nama;
      }

      return $data;
    }
}
