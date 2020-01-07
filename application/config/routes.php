<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['/siswa'] = 'siswa';
$route['/wali'] = 'wali';
$route['/jurusan'] = 'jurusan';
$route['/kelas'] = 'kelas';
$route['/login'] = 'login';
$route['/izin'] = 'izin';
$route['/migration'] = 'migration';
$route['Login/aksi_login'] = 'Login/aksi_login';
$route['tambahLibur'] = 'Welcome/tambahLibur';

$route['getSemester'] = 'presensi/getSemester';
$route['getBulan'] = 'presensi/getBulan';


$route['/siswa/form'] = 'siswa/addSiswa';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//API
$route['api/loginSiswa']     = 'api/login/login_siswa';
$route['api/logoutSiswa']    = 'api/logout/logout_siswa';
$route['api/loginGuru']      = 'api/login/login_guru';
$route['api/logoutGuru']     = 'api/logout/logout_guru';
$route['api/loginWali']      = 'api/login/login_wali';
$route['api/logoutWali']     = 'api/logout/logout_wali';
$route['api/profilSiswa']    = 'api/profil/getProfilSiswa';
$route['api/profilWali']    = 'api/profil/getProfilWali';
$route['api/profilGuru']    = 'api/profil/getProfilGuru';
$route['api/ubahPasswordSiswa'] = 'api/profil/ubahPasswordSiswa';
$route['api/ubahPasswordGuru'] = 'api/profil/ubahPasswordGuru';
$route['api/ubahPasswordWali'] = 'api/profil/ubahPasswordWali';

//API izin
$route['api/izin']              = 'api/izin/izin_siswa';
$route['api/getIzin']           = 'api/izin/getIzinByNIS';
$route['api/deleteIzin']        = 'api/izin/deleteIzin';
$route['api/editIzin']          = 'api/izin/editIzin';
$route['api/getSiswaIzin']      = 'api/izin/getSiswaIzin';

//API presensi
$route['api/presensi'] = 'api/presensi/presensi_siswa_masuk';
$route['api/presensiHariIni'] = 'api/presensi/presensi_hari_ini';
$route['api/getPresensiBulan'] = 'api/presensi/getPresensiBulan';
$route['api/getPresensiSiswa'] = 'api/presensi/getPresensiSiswa';
$route['api/getPresensiKelas'] = 'api/presensi/getPresensiByKelas';
$route['api/getLaporanPresensiKelas'] = 'api/presensi/getLaporanPresensiKelas';
$route['presensiTidakHadir'] = 'presensi/insertSiswaTidakHadir';
$route['presensiKabur'] = 'presensi/insertSiswaKabur';

//API kelas
$route['api/getKelas'] = 'api/kelas/get_kelas';

//API bimbingan
$route['api/bimbingan'] = 'api/bimbingan/bimbingan';
$route['api/saran'] = 'api/bimbingan/saran';
$route['api/getBimbinganByNIS'] = 'api/bimbingan/getBimbinganByNIS';
$route['api/getBimbingan'] = 'api/bimbingan/getBimbingan';

//firebase
$route['firebase'] = 'FirebaseTest/test';
$route['notifPresensi'] = 'presensi/notifPresensi';
$route['insertSiswaTidakHadir'] = 'presensi/insertSiswaTidakHadir';
$route['insertSiswaKabur'] = 'presensi/insertSiswaKabur';
