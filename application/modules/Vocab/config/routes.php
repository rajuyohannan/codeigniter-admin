<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#Admin path
$route['admin/categories/(:any)'] = 'Vocab/Category/$1';
$route['admin/categories/(:any)/(:num)'] = 'Vocab/Category/$1/$2';
$route['admin/categories/(:any)/(:num)'] = 'Vocab/Category/$1/$2';
$route['admin/categories/(:any)/(:any)/(:num)'] = 'Vocab/Category/$2/$3';

#Terms
$route['admin/terms/(:num)'] = 'Vocab/Term/terms/$1';
$route['admin/terms/add/(:num)'] = 'Vocab/Term/add_term/$1';
$route['admin/terms/edit/(:num)'] = 'Vocab/Term/edit_term/$1';
$route['admin/terms/delete/(:num)'] = 'Vocab/Term/delete_term/$1';