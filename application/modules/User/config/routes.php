<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['user'] = 'User';
$route['dashboard'] = 'User/dashboard';
$route['user/(:any)'] = 'User/$1';
$route['user/(:any)/(:num)'] = 'User/$1/$2';
$route['user/(:any)/(:num)/(:any)'] = 'User/$1/$2/$3';

