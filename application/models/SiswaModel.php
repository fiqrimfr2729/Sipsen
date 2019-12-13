<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiswaModel extends CI_Model {

  public function getSiswaByNIS($id){
    $siswa = $this->db->where('NIS', $id)->from('tb_siswa')->get()->row();

    return $siswa;
  }

  //get siswa hanya nis nisn nama kelas
  public function getSiswaByNIS2($id){
    $siswa = $this->db->select('NIS, nama_siswa, id_kelas, NISN')->where('NIS', $id)->from('tb_siswa')->get()->row();
    if($siswa == null){
      return null;
    }
    $kelas = $this->db->where('id_kelas', $siswa->id_kelas)->from('tb_kelas')->get()->row();
    $jurusan = $this->db->where('id_jurusan', $kelas->id_jurusan)->from('tb_jurusan')->get()->row();

    $siswa->kelas = $kelas->tingkat . " " . $jurusan->singkatan . " " . $kelas->nama ;

    return $siswa;
  }

  public function getSiswaByKelas($idKelas){
    $siswa = $this->db->where('id_kelas', $idKelas)->from('tb_siswa')->get()->result();

    return $siswa;
  }
}
