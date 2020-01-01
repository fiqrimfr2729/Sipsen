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
        $data = array(
            'NUPTK' => $NUPTK,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_hp' => $no_hp,
            'email' => $email,
            'jk' => $jk,
            'status_bk' => $status_bk,
            'password' => $password,
            'token' => $token
        );

        $this->db->insert('tb_guru', $data);
        return true;

        //$hasil = $this->db->query("INSERT INTO tb_guru (NUPTK,nama,alamat,no_hp,email,jk,status_bk,password,token) VALUES ('$NUPTK','$nama','$alamat','$no_hp','$email','$jk','$status_bk','$password','$token')");
        //return $hasil;
    }

    function edit($NUPTK, $nama, $alamat, $no_hp, $email, $jk, $status_bk)
    {
        $this->db->set('nama', $nama);
        $this->db->set('alamat', $alamat);
        $this->db->set('no_hp', $no_hp);
        $this->db->set('email', $email);
        $this->db->set('jk', $jk);
        $this->db->set('status_bk', $status_bk);
        $this->db->where('NUPTK', $NUPTK);
        $this->db->update('tb_guru');

        //$hasil = $this->db->query("UPDATE tb_guru SET nama='$nama',alamat='$alamat',no_hp='$no_hp',email='$email',jk='$jk',status_bk='$status_bk',password='$password',token='$token' WHERE NUPTK='$NUPTK'");
        //return $hasil;
    }

    public function delete($NUPTK)
    {
        $this->db->delete('tb_guru', array('NUPTK' => $NUPTK));

        //$hasil = $this->db->query("DELETE FROM tb_guru WHERE NUPTK='$NUPTK'");
        //return $hasil;
    }

    public function tambahBK($NUPTK, $status_bk)
    {
        $this->db->set('status_bk', $status_bk);
        $this->db->where('NUPTK', $NUPTK);
        $this->db->update('tb_guru');
    }

    public function resetPeWD($NUPTK, $password)
    {
        $this->db->set('password', $password);
        $this->db->where('NUPTK', $NUPTK);
        $this->db->update('tb_guru');
    }

    public function getGuruBK(){
      return $this->db->select('token')->where('status_bk', 1)->from('tb_guru')->get()->result();
    }
}
