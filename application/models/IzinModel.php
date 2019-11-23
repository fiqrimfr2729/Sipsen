<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IzinModel extends CI_Model {

  public function insertIzin($izin){
    $this->db->insert('tb_izin', $izin);

    return true;
  }

  public function konfirmasiIzin($id_izin){
    $izin = $this->db->where('id_izin', $id_izin)->from('tb_izin')->get()->row();

    if($izin==null){
      return false;
    }

    //mengubah tb presensi izin jika ada
    $presensi = $this->db->where('NIS', $izin->NIS)
    ->where('tanggal', $izin->tgl_mulai)
    ->from('tb_presensi')->get()->row();

    echo var_dump($presensi);
    if($presensi!=null){
      $this->db->set('id_jenis_presensi', $izin->jenis_izin);
      $this->db->where('id_presensi', $presensi->id_presensi);
      $this->db->update('tb_presensi');
    }

    $this->db->set('status', '1');
    $this->db->where('id_izin', $izin->id_izin);
    $this->db->update('tb_izin');

    echo "berhasil";
  }

  public function getIzinByNIS($nis){
    $this->db->select('NIS, id_izin, tgl_mulai, bukti, status, keterangan, tanggal_dikirim, jenis_presensi');
    $this->db->where('NIS', $nis);
    $this->db->from('tb_izin');
    $this->db->join('tb_jenis_presensi', 'tb_izin.jenis_izin = tb_jenis_presensi.id_jenis_presensi');
    $izin = $this->db->get()->result();


    return $izin;
  }

  public function deleteIzin($id){
    $izin = $this->db->where('id_izin', $id)->from('tb_izin')->get()->row();

    $path = 'uploads/' . $izin->bukti;
    $this->load->helper("file"); // load the helper
    delete_files($path, true); // delete all files/folders

    $this->db->where('id_izin', $id)->delete('tb_izin');

    return true;
  }

  public function getIzinByTanggal($nis){
    $tanggal = date('yyyy-MM-dd');
    $izin = $this->db->where('tgl_mulai', $tanggal)->where('nis', $nis)->from('tb_izin')->get()->result();

    if(sizeof($izin) == 0){
      return false;
    }else{
      return true;
    }

  }


}
