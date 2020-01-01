<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IzinModel extends CI_Model {

  function __construct() {
    parent::__construct();
        $this->load->model('SiswaModel');
  }

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
    return $this->db->update('tb_izin');
  }

  public function getIzinByNIS($nis){
    $this->db->select('NIS, id_izin, tgl_mulai, bukti, status, keterangan, tanggal_dikirim, jenis_presensi, jenis_izin');
    $this->db->where('NIS', $nis);
    $this->db->from('tb_izin');
    $this->db->join('tb_jenis_presensi', 'tb_izin.jenis_izin = tb_jenis_presensi.id_jenis_presensi');
    $izin = $this->db->get()->result();

    return $izin;
  }

  public function deleteIzin($id){
    $izin = $this->db->where('id_izin', $id)->from('tb_izin')->get()->row();
    $path = './uploads/' . $izin->bukti . '.*';
    array_map( "unlink", glob( $path ) );

    $this->db->where('id_izin', $id)->delete('tb_izin');

    return true;
  }


  public function checkIzinSiswa($nis){
    $tanggal = date('Y-m-d');
    $izin = $this->db->where('tgl_mulai', $tanggal)->where('nis', $nis)->from('tb_izin')->get()->result();

    if(sizeof($izin) == 0){
      return false;
    }else{
      return true;
    }
  }

  public function editIzin($id_izin, $jenis_izin, $keterangan, $bukti){
    $data = array();
    if($bukti != null){
      $data = array(
        'jenis_izin' => $id_izin,
        'keterangan' => $keterangan,
        'bukti' => $bukti);

      $izin = $this->db->where('id_izin', $id_izin)->from('tb_izin')->get()->row();
      $path = './uploads/' . $izin->bukti . '.*';
      array_map( "unlink", glob( $path ) );
    }else{
      $data = array(
        'jenis_izin' => $jenis_izin,
        'keterangan' => $keterangan);
    }

    $this->db->where('id_izin', $id_izin);
    $edit = $this->db->update('tb_izin', $data);

    return $edit;
  }

  public function getSiswaIzin(){
    $date = date('Y-m-d');
    // $this->db->select('tb_siswa.NIS , nama_siswa, tb_izin.status, tb_jenis_presensi.jenis_presensi');
    //
    // $this->db->where('tgl_mulai', $date);
    // $this->db->from('tb_izin');
    // $this->db->join('tb_siswa', 'tb_siswa.NIS = tb_izin.NIS');
    // $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas');
    // $this->db->join('tb_jenis_presensi', 'tb_jenis_presensi.id_jenis_presensi = tb_izin.jenis_izin');
    // $izin = $this->db->get()->result();

    $izin = $this->db->select('id_izin, NIS, tgl_mulai, keterangan, status, jenis_presensi, bukti, jenis_izin')
            ->where('tgl_mulai', $date)
            ->from('tb_izin')
            ->join('tb_jenis_presensi', 'tb_izin.jenis_izin = tb_jenis_presensi.id_jenis_presensi')
            ->get()->result();

    foreach ($izin as $value) {
      $siswa = $this->db->select('nama_siswa, id_kelas')->where('NIS', $value->NIS)->from('tb_siswa')->get()->row();
      $kelas = $this->db->select('tingkat, nama, singkatan')->where('id_kelas', $siswa->id_kelas)
                ->from('tb_kelas')
                ->join('tb_jurusan', 'tb_kelas.id_jurusan = tb_jurusan.id_jurusan')
                ->get()->row();
      $siswa->kelas = $kelas->tingkat . ' ' . $kelas->singkatan . ' ' . $kelas->nama;
      $value->siswa = $siswa;
    }
    return $izin;
  }


}
