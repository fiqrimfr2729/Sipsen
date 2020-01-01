<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BimbinganModel extends CI_Model {


    public function insertBimbingan($nis, $bimbingan){
      date_default_timezone_set("Asia/Jakarta");
      $date = date('Y-m-d H:i:s');
      $bimbingan = array(
        'NIS' => $nis,
        'bimbingan' => $bimbingan,
        'tgl_kirim' => $date
      );

      return $this->db->insert('tb_bimbingan', $bimbingan);
    }

    public function saran($id, $nuptk, $saran){
      date_default_timezone_set("Asia/Jakarta");
      $date = date('Y-m-d H:i:s');
      $this->db->set('NUPTK', $nuptk);
      $this->db->set('saran', $saran);
      $this->db->set('tgl_balas', $date);
      $this->db->where('id_bimbingan', $id);
      $query = $this->db->update('tb_bimbingan');
      if($query){
        $this->db->select('nama_siswa, token');
        $this->db->where('id_bimbingan', $id);
        $this->db->join('tb_bimbingan', 'tb_siswa.NIS = tb_bimbingan.NIS');
        return $this->db->from('tb_siswa')->get()->row();
      }else{
        return null;
      }
    }

    public function getBimbinganByNIS($nis){
      $bimbingan = $this->db->where('nis', $nis)->from('tb_bimbingan')->get()->result();
      return $bimbingan;
    }

    public function getBimbingan(){
      $bimbingan = $this->db->from('tb_bimbingan')->get()->result();
      return $bimbingan;
    }

}
