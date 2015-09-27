<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#Admin path
$route['admin/categories/(:any)'] = 'Category/$1';
$route['admin/categories/(:any)/(:num)'] = 'Category/$1/$2';
$route['admin/categories/(:any)/(:num)'] = 'Category/$1/$2';
$route['admin/categories/(:any)/(:any)/(:num)'] = 'Category/$2/$3';

#Terms
$route['admin/terms/add/(:num)'] = 'Category/add_term/$1';
$route['admin/terms/edit/(:num)'] = 'Category/edit_term/$1';
$route['admin/terms/delete/(:num)'] = 'Category/delete_term/$1';