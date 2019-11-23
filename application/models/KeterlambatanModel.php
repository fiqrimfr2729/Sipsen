<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KeterlambatanModel extends CI_Model {

  function getKeterlambatanMasuk(){
    date_default_timezone_set("Asia/Jakarta");
    //mengambil jam masuk dari database
    $jam_masuk = $this->db->get('tb_jam')->row()->jam_masuk;
    $jam_masuk = strtotime($jam_masuk);

    //mengambil time saat kode dijalankan
    $jam_sekarang = strtotime(date('H:i:s'));
    //$jam_sekarang = date(H:i:s);

    $diff = $jam_sekarang-$jam_masuk;

    if($diff <= 0){
      return 0;
    }

    $jam   = floor($diff / (60 * 60));

    $menit = floor(($diff - $jam * (60 * 60))/60);

    return $diff;
  }
}
