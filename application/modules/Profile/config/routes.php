<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['user/profile'] = 'Profile';
$route['user/profile/(:num)'] = 'Profile';
$route['profile/(:any)'] = 'Profile/$1';

