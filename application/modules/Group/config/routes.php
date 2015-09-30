<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#Admin path
$route['admin/groups']		  = 'Group';
$route['admin/groups/(:num)'] = 'Group/index/$1';
$route['admin/groups/(:any)'] = 'Group/$1';
$route['admin/groups/(:any)/(:num)'] = 'Group/$1/$2';