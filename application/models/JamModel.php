<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JamModel extends CI_Model {

  public function setJam($jam_masuk, $jam_pulang){
    $this->set('jam_masuk', $jam_masuk);
    $this->set('jam_pulang', $jam_pulang);
    $this->where('id_jam', 1);
    $this->update('tb_jam');
  }

  public function getJamPulang(){
    $jam = $this->db->where('id_jam', 1)->from('tb_jam')->get()->row();
    return $jam->jam_pulang;
  }

  public function getJamMasuk(){
    $jam = $this->db->where('id_jam', 1)->from('tb_jam')->get()->row();
    return $jam->jam_masuk;
  }
}
