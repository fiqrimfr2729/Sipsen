<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiburModel extends CI_Model {

  public function getLibur(){
    $date=date('Y-m-d');
    $libur = $this->db->where('tanggal', $date)->from('tb_libur')->get()->row();
    return $libur;
  }

  public function getAllLibur(){
    $libur = $this->db->from('tb_libur')->get()->result();
    return $libur;
  }

  public function createLiburan($date, $keterangan){
    $data = array(
      'tanggal' => $date,
      'keterangan' => $keterangan);
    $query = $this->db->insert($data, 'tb_tanggal');
    return $query;
  }

  public function editLibur($id_libur, $keterangan){
    $this->db->set('keterangan', $keterangan);
    $this->db->where('id_libur', $id_libur);
    $query = $this->update('tb_libur');
    return $query;
  }


}
