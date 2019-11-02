<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['/siswa'] = 'siswa';
$route['/jurusan'] = 'jurusan';
$route['/kelas'] = 'kelas';
$route['/login'] = 'login';
$route['/migration'] = 'migration';
$route['Login/aksi_login'] = 'Login/aksi_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
