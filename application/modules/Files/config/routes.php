<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#Admin path
$route['admin/files'] = 'Files/File';


$route['files/(:any)'] = 'Files/File/$1';