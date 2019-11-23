<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PresensiModel extends CI_Model {

  public function getSiswa($id_fp, $kd_alat){
    $this->db->where('kd_alat', $kd_alat)->where('id_fp', $id_fp);
    $this->db->from('tb_siswa');
    $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas');
    $user = $this->db->get()->row();

    return $user;
  }

  //insert presensi siswa ke table presensi
  public function presensiSiswa($nis, $id_jenis_presensi, $tanggal, $masuk, $keterlambatan){
    $data = array(
        'NIS' => $nis,
        'id_jenis_presensi' => $id_jenis_presensi,
        'tanggal' => $tanggal,
        'masuk' => $masuk,
        'keterlambatan' => $keterlambatan
      );
    $this->db->insert('tb_presensi', $data);
    return true;
  }

  public function presensiSiswaKeluar($id_presensi, $keluar){
    $this->db->set('keluar', $keluar);
    $this->db->where('id_presensi', $id_presensi);
    $this->db->update('tb_presensi');
     return true;
  }

  //mengecek presensi pada hari itu agar data tidak ganda
  public function cekPresensiTanggal($nis, $date){
    $presensi = $this->db->get_where
    ('tb_presensi', ['NIS' => $nis, 'tanggal' => $date])->row();

    return $presensi;
  }

  //mengubah jenis presensi siswa yang awal nya tidak hadir menjadi izin
  public function getSiswaTidakHadir(){
    $date = date('Y-m-d');
    $this->db->where('tanggal', $date);
    $this->db->from('tb_presensi');
    $presensi = $this->db->get()->result();

    $nis = array();
    foreach($presensi as $data){
      $nis[]=$data->NIS;
    }
    $siswaTidakHadir = $this->db->where_not_in('NIS', $nis)->from('tb_siswa')->get()->result();

    return $siswaTidakHadir;
  }

  public function getSiswaHadir(){
    $date = date('Y-m-d');
    $this->db->where('tanggal', $date);
    $this->db->from('tb_presensi');
    $presensi = $this->db->get()->result();

    $nis = array();
    foreach($presensi as $data){
      $nis[]=$data->NIS;
    }
    $siswaHadir = $this->db->where_in('NIS', $nis)->from('tb_siswa')->get()->result();

    return $siswaHadir;
  }

  public function insertSiswaTidakHadir($nis, $tanggal){
    $data = array(
        'NIS' => $nis,
        'id_jenis_presensi' => 2,
        'tanggal' => $tanggal
      );
    $this->db->insert('tb_presensi', $data);
    return true;
  }

  public function getPresensiHariIni($nis){
    $tanggal=date('Y-m-d');

    $presensi = $this->db->where('NIS', $nis)
    ->where('tanggal', $tanggal)->from('tb_presensi')
    ->get()->row();

    return $presensi;
  }

  public function getPresensiByID($id){
    $presensi = $this->db->where('id_jenis_presensi', $id)->from('tb_jenis_presensi')
    ->get()->row();

    return $presensi;
  }

  // mengambil data siswa tidak scan fingerprint pulang
  public function getSiswaKabur(){
    $this->db->where('keluar', '00:00:00');
    $this->db->from('tb_siswa');
    $this->db->join('tb_presensi', 'tb_siswa.NIS = tb_presensi.NIS');
    $siswa = $this->db->get()->result();
    return $siswa;
  }

  public function updateSiswaKabur($id_presensi){
    $this->db->set('id_jenis_presensi', '3');
    $this->db->where('id_presensi', $id_presensi);
    $this->db->update('tb_presensi');
  }
}
