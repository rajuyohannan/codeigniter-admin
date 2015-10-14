<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#Admin path
$route['admin/bdms/estimations'] = 'Bdms/Estimation';
$route['admin/bdms/estimations/(:any)'] = 'Bdms/Estimation/$1';

$route['admin/bdms/doi'] = 'Bdms/Doi';
$route['admin/bdms/doi/(:any)'] = 'Bdms/Doi/$1';

$route['admin/bdms/clients'] = 'Bdms/Clients';
$route['admin/bdms/skills'] = 'Bdms/Skills';