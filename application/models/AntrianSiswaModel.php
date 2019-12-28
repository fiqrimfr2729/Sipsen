<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AntrianSiswaModel extends CI_Model {
  public function insertToAntrian($nis){
    $time = date('i');
    $data = array(
      'NIS' => $nis,
      'waktu' => $time
    );

    $this->db->insert('tb_antrian_siswa', $data);

    return true;
  }

  public function getAntrianSiswa(){
    $time = date('i');
    if($time < 2){
      $time = 60+$time;
    }

    $this->db->select('nama_siswa, token, id_wali');
    $this->db->where('waktu', $time)->or_where('waktu', ($time-1)%60);
    $this->db->from('tb_siswa');
    $this->db->join('tb_antrian_siswa', 'tb_siswa.NIS = tb_antrian_siswa.NIS', 'right');
    $query = $this->db->get()->result();

    $this->db->where('waktu', $time-2);
    $this->db->delete('tb_antrian_siswa');

    return $query;
  }
}
