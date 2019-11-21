<?php

class M_guru extends CI_Model
{
    private $_table = "tb_guru";

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function simpan($NUPTK, $nama, $alamat, $no_hp, $email, $jk, $status_bk, $password, $token)
    {
        $hasil = $this->db->query("INSERT INTO tb_guru (NUPTK,nama,alamat,no_hp,email,jk,status_bk,password,token) VALUES ('$NUPTK','$nama','$alamat','$no_hp','$email','$jk','$status_bk','$password','$token')");
        return $hasil;
    }

    function edit($NUPTK, $nama, $alamat, $no_hp, $email, $jk, $status_bk, $password, $token)
    {
        $hasil = $this->db->query("UPDATE tb_guru SET nama='$nama',alamat='$alamat',no_hp='$no_hp',email='$email',jk='$jk',status_bk='$status_bk',password='$password',token='$token' WHERE NUPTK='$NUPTK'");
        return $hasil;
    }

    public function delete($NUPTK)
    {
        $hasil = $this->db->query("DELETE FROM tb_guru WHERE NUPTK='$NUPTK'");
        return $hasil;
    }
}
