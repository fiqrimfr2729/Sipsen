<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WaliModel extends CI_Model {

  public function getWaliByID($id){
    $wali = $this->db->get_where('tb_wali', ['id_wali', $id])->row();

    return $wali;
  }
}
