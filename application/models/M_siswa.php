<?php

class M_siswa extends CI_Model
{

    private $_table = "tb_siswa";

    public function getAll()
    {
        $siswa = $this->db->get($this->_table)->result();
        foreach ($siswa as $siswas) {
            $siswas->id_kelas = $this->getIdKelas($siswas->id_kelas);
        }
        return $siswa;
    }

    public function getIdKelas($id_kelas)
    {
        $kelas = $this->db->where('id_kelas', $id_kelas)->from('tb_kelas')->get()->row();
        $jurusan = $this->db->where('id_jurusan', $kelas->id_jurusan)->from('tb_jurusan')->get()->row();
        $kelas->jurusan = $jurusan;
        return $kelas;
    }

    public function simpan($NIS, $NISN, $nama, $jk, $id_kelas, $tgl_lahir, $no_hp, $email, $alamat, $nama_ayah, $nama_ibu, $id_fp, $password)
    {
        $data = array(
            'NIS' => $NIS,
            'NISN' => $NISN,
            'nama_siswa' => $nama,
            'jk' => $jk,
            'id_kelas' => $id_kelas,
            'tgl_lahir' => $tgl_lahir,
            'no_hp' => $no_hp,
            'email' => $email,
            'alamat' => $alamat,
            'nama_ayah' => $nama_ayah,
            'nama_ibu' => $nama_ibu,
            'password' => $password,
            'id_fp' => $id_fp

        );

        $this->db->insert('tb_siswa', $data);
        return true;

        //$hasil = $this->db->query("INSERT INTO tb_guru (NUPTK,nama,alamat,no_hp,email,jk,status_bk,password,token) VALUES ('$NUPTK','$nama','$alamat','$no_hp','$email','$jk','$status_bk','$password','$token')");
        //return $hasil;
    }

    function edit($NIS, $NISN, $nama, $jk, $id_kelas, $tgl_lahir, $no_hp, $email, $alamat, $nama_ayah, $nama_ibu, $id_fp)
    {
        $this->db->set('NISN', $NISN);
        $this->db->set('nama_siswa', $nama);
        $this->db->set('jk', $jk);
        $this->db->set('id_kelas', $id_kelas);
        $this->db->set('tgl_lahir', $tgl_lahir);
        $this->db->set('no_hp', $no_hp);
        $this->db->set('email', $email);
        $this->db->set('alamat', $alamat);
        $this->db->set('nama_ayah', $nama_ayah);
        $this->db->set('nama_ibu', $nama_ibu);

        $this->db->set('id_fp', $id_fp);
        $this->db->where('NIS', $NIS);
        $this->db->update('tb_siswa');

        //$hasil = $this->db->query("UPDATE tb_guru SET nama='$nama',alamat='$alamat',no_hp='$no_hp',email='$email',jk='$jk',status_bk='$status_bk',password='$password',token='$token' WHERE NUPTK='$NUPTK'");
        //return $hasil;
    }

    public function delete($NIS)
    {
        $this->db->delete('tb_siswa', array('NIS' => $NIS));
        //return $hasil;
    }

    public function resetPeWD($NIS, $password)
    {
        $this->db->set('password', $password);
        $this->db->where('NIS', $NIS);
        $this->db->update('tb_siswa');
    }
}
