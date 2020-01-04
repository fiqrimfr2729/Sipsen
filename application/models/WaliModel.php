<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WaliModel extends CI_Model
{

  public function getWaliByID($id)
  {
    $wali = $this->db->get_where('tb_wali', ['id_wali', $id])->row();

    return $wali;
  }

  public function getAll()
  {
    $wali = $this->db->from('tb_wali')->get()->result();
    foreach ($wali as $value) {
      $siswa = $this->db->where('id_wali', $value->id_wali)->from('tb_siswa')->get()->row();
      $value->siswa = $siswa;
    }

    return $wali;
  }

  public function simpan($username, $no_hp, $email, $nama, $password)
  {
    $data = array(
      'username' => $username,
      'nama' => $nama,
      'no_hp' => $no_hp,
      'email' => $email,
      'password' => $password,
    );

    $this->db->insert('tb_wali', $data);
    return true;

    //$hasil = $this->db->query("INSERT INTO tb_guru (NUPTK,nama,alamat,no_hp,email,jk,status_bk,password,token) VALUES ('$NUPTK','$nama','$alamat','$no_hp','$email','$jk','$status_bk','$password','$token')");
    //return $hasil;
  }

  public function edit($id_wali, $username, $no_hp, $email, $nama)
  {
    $this->db->set('username', $username);
    $this->db->set('nama', $nama);
    $this->db->set('no_hp', $no_hp);
    $this->db->set('email', $email);
    $this->db->where('id_wali', $id_wali);
    $this->db->update('tb_wali');

    //$hasil = $this->db->query("UPDATE tb_guru SET nama='$nama',alamat='$alamat',no_hp='$no_hp',email='$email',jk='$jk',status_bk='$status_bk',password='$password',token='$token' WHERE NUPTK='$NUPTK'");
    //return $hasil;
  }
}
