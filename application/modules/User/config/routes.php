<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['user'] = 'User';
$route['dashboard'] = 'User/dashboard';

# Admin paths
$route['admin/users']        		= 'User/users';
$route['admin/users/(:num)']        = 'User/users/$1';

$route['admin/users/(:any)/(:num)'] = 'User/$1/$2';
$route['admin/users/(:any)/(:any)'] = 'User/$2';
$route['admin/users/(:any)/(:any)/(:num)'] = 'User/$2/$3';
$route['admin/users/(:any)/(:any)/(:num)/(:num)'] = 'User/$2/$3/$4';

$route['user/profile'] = 'User/Profile';
$route['user/profile/(:any)'] = 'User/Profile/$1';

$route['user/(:any)'] = 'User/User/$1';
$route['user/(:any)/(:num)/(:any)'] = 'User/$1/$2/$3';

