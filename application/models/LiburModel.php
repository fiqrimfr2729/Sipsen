<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiburModel extends CI_Model {

  public function getLibur(){
    $date=date('Y-m-d');
    $libur = $this->db->where('tanggal', $date)->from('tb_libur')->get()->row();
    return $libur;
  }
}
