<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/*
 * Роуты для админ панели
 */

//var_dump($expression);die();

$route['default_controller'] = 'Main/index';

$route['fasadm'] = 'admin/Admin/index';
$route['fasadm/avtoris'] = 'admin/Admin/avtoris';
$route['fasadm/loggout'] = 'admin/Admin/loggout';

$route['fasadm/([a-zA-Z]+)'] = 'admin/$1/index';    
$route['fasadm/([a-zA-Z]+)/add'] = 'admin/$1/addItem';  
$route['fasadm/([a-zA-Z]+)/addCat'] = 'admin/$1/addCat';  
$route['fasadm/([a-zA-Z]+)/edit/(:any)'] = 'admin/$1/editItem/$2';  
$route['fasadm/([a-zA-Z]+)/delite/(:any)'] = 'admin/$1/delitItem/$2'; 

$route['fasadm/LoadImage'] = 'admin/LoadImage/load'; 
$route['uploadimage'] = 'floara/Floara/uploadImage';
$route['imageManager'] = 'floara/Floara/imageManager';
$route['fileUpload'] = 'floara/Floara/fileUpload';

/*
 * Роуты для клиентской части
 */

$route['([a-zA-Z]+)/item/(:any)'] = 'site/$1/item/$2';    
$route['([a-zA-Z]+)/getInfo/(:any)'] = 'site/$1/getInfo/$2'; 
$route['([a-zA-Z]+)'] = 'site/$1/index'; 
$route['Form/([a-zA-Z]*)'] = 'site/Form/$1';
$route['([a-zA-Z]+)/([a-zA-Z\-0-9]*)'] = 'site/$1/index/$2';  
$route['([a-zA-Z]+)/([a-zA-Z\-0-9]*)/([a-zA-Z\-0-9]*)'] = 'site/$1/index/$2/$3'; 
$route['([a-zA-Z]+)/([a-zA-Z\-0-9]*)/([a-zA-Z\-0-9]*)/([a-zA-Z\-0-9]*)'] = 'site/$1/index/$2/$3/$4'; 



$route['404_override'] = 'Content/index';
//$route['translate_uri_dashes'] = FALSE;
