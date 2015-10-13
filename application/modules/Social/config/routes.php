<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#Admin path
#$route['admin/articles/(:any)'] = 'Social/Articles/$1';
$route['admin/articles'] = 'Social/Article';
$route['admin/articles/(:any)'] = 'Social/Article/$1';
$route['admin/articles/(:any)/(:num)'] = 'Social/Article/$1/$2';
$route['admin/articles/(:any)/(:any)/(:num)'] = 'Social/Article/$2/$3';

$route['admin/comments'] = 'Social/Comment';
$route['admin/comments/(:any)'] = 'Social/Comment/$1';
$route['admin/comments/(:any)/(:num)'] = 'Social/Comment/$1/$2';
$route['admin/comments/(:any)/(:any)/(:num)'] = 'Social/Comment/$2/$3';
