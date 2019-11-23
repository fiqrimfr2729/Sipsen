<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['/siswa'] = 'siswa';
$route['/jurusan'] = 'jurusan';
$route['/kelas'] = 'kelas';
$route['/login'] = 'login';
$route['/migration'] = 'migration';
$route['Login/aksi_login'] = 'Login/aksi_login';
$route['tambahLibur'] = 'Welcome/tambahLibur';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//API
$route['api/loginSiswa']     = 'api/login/login_siswa';
$route['api/logoutSiswa']    = 'api/logout/logout_siswa';
$route['api/loginGuru']      = 'api/login/login_guru';
$route['api/logoutGuru']     = 'api/logout/logout_guru';
$route['api/loginWali']      = 'api/login/login_wali';
$route['api/logoutWali']     = 'api/logout/logout_wali';


//API izin
$route['api/izin']           = 'api/izin/izin_siswa';
$route['api/getIzin']           = 'api/izin/getIzinByNIS';
$route['api/deleteIzin']           = 'api/izin/deleteIzin';

//presensi
$route['api/presensi'] = 'api/presensi/presensi_siswa_masuk';
$route['api/presensiHariIni'] = 'api/presensi/presensi_hari_ini';
$route['presensiTidakHadir'] = 'presensi/insertSiswaTidakHadir';
$route['presensiKabur'] = 'presensi/insertSiswaKabur';

//firebase
$route['firebase'] = 'FirebaseTest/test';
$route['notifPresensi'] = 'presensi/notifPresensi';
