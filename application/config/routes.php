<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['/siswa'] = 'siswa';
$route['/login'] = 'login';
$route['Login'] = 'Login/aksilogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
