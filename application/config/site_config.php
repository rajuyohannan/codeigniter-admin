<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| 				SITE NAME
|--------------------------------------------------------------------------
| Value set in the site name variable will be shown on the title as well
|
*/

$config['site_name'] 	 = 'MOBILOITTE';

/*
|--------------------------------------------------------------------------
| 				SITE INITIAL
|--------------------------------------------------------------------------
| Site initial will be shown when the drawer is collapsed / hidden 
| by the logged in user
|
*/

$config['site_initial']  = 'M';


/*
| -----------------------------------------------------------------
|					SITE THEME COLOR						
| -----------------------------------------------------------------
| Change site skin color. Acceptable values for colors are :  
| skin-black, skin-black-light, skin-blue, skin-blue-light, skin-green-light, 
| skin-green, skin-purple-light, skin-purple, skin-red-light, skin-red, 
| skin-yellow-light, skin-yellow
| 
*/

$config['site_theme_color'] = 'skin-purple';

/*
| -----------------------------------------------------------------
|					SITE COLOR PALETTE						
| -----------------------------------------------------------------
| Adjust color palettes on the site. If you have selected green as site theme color
| color palettes would be as follows:
|	
|	bg-green disabled
|	bg-green
| 	bg-green active
*/
$config['site_palette_disabled'] = 'bg-purple disabled color-palette';
$config['site_palette_original'] = 'bg-purple color-palette';
$config['site_palette_active'] 	 = 'bg-purple active color-palette';

/*
|--------------------------------------------------------------------------
| 				SHOW DRAWERS
|--------------------------------------------------------------------------
|
*/

$config['site_show_drawer'] = true;

/*
|--------------------------------------------------------------------------
| 				FOOTER CUSTOMIZATION
|--------------------------------------------------------------------------
| 
*/
