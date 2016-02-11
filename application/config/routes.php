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

$route['fasadm/Menu'] = 'admin/Menu/index';    
$route['fasadm/Menu/addCat'] = 'admin/Menu/addCat'; 

$route['fasadm/Catalog'] = 'admin/Catalog/index';    
$route['fasadm/Catalog/add'] = 'admin/Catalog/addItem';  
$route['fasadm/Catalog/addCat'] = 'admin/Catalog/addCat';  
$route['fasadm/Catalog/edit/(:any)'] = 'admin/Catalog/editItem/$1';  
$route['fasadm/Catalog/delite/(:any)'] = 'admin/Catalog/delitItem/$1'; 

$route['fasadm/Content'] = 'admin/Content/index';    
$route['fasadm/Content/add'] = 'admin/Content/addItem';   
$route['fasadm/Content/edit/(:any)'] = 'admin/Content/editItem/$1';  
$route['fasadm/Content/delite/(:any)'] = 'admin/Content/delitItem/$1'; 

$route['fasadm/Project'] = 'admin/Project/index';    
$route['fasadm/Project/add'] = 'admin/Project/addItem';   
$route['fasadm/Project/edit/(:any)'] = 'admin/Project/editItem/$1';  
$route['fasadm/Project/delite/(:any)'] = 'admin/Project/delitItem/$1'; 

$route['fasadm/News'] = 'admin/News/index';    
$route['fasadm/News/add'] = 'admin/News/addItem';   
$route['fasadm/News/edit/(:any)'] = 'admin/News/editItem/$1';  
$route['fasadm/News/delite/(:any)'] = 'admin/News/delitItem/$1'; 

$route['fasadm/LoadImage'] = 'admin/LoadImage/load'; 

$route['fasadm/seo'] = 'Admin/seo';
$route['fasadm/seo/add'] = 'Admin/seo_add';
$route['fasadm/seo/edit/(:any)'] = 'Admin/seo_edit/$1';

$route['files/site/all/AjexFileManager/ajax/php/ajax.php'] = 'ckeditor/Ajax/index';

/*
 * Роуты для клиентской части
 */


$route['catalog/item/(:any)']='site/Catalog/item/$1';
$route['catalog']='site/Catalog/index';
$route['catalog/(:any)']='site/Catalog/index/$1';
$route['catalog/(:any)/(:any)']='site/Catalog/index/$1/$2';

$route['news']='site/News/index';
$route['news/item/(:any)']='site/News/item/$1';

$route['project']='site/Project/index';
$route['project/item/(:any)']='site/Project/item/$1';

$route['404_override'] = 'Content/index';
//$route['translate_uri_dashes'] = FALSE;
