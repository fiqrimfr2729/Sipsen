<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WaliModel extends CI_Model {

  public function getWaliByID($id){
    $wali = $this->db->get_where('tb_wali', ['id_wali', $id])->row();

    return $wali;
  }

  public function getAll(){
    $wali = $this->db->from('tb_wali')->get()->result();
    foreach ($wali as $value) {
      $siswa = $this->db->where('id_wali', $value->id_wali)->from('tb_siswa')->get()->row();
      $value->siswa=$siswa;
    }

    return $wali;
  }
}
