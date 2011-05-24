<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 		Таблица прав доступа
 * 
 *		Возможные значения:
 *
 *		view		-	просмотр
 *		edit		-	редактирование
 *		add			-	добавление
 *		del			-	удаление
 *		opt			-	опционально (возможно при условиях)
 *		view_self,
 *		edit_self,
 *		add_self,
 *		del_self	-	разрешено только со своим
 *		dissalow	-	полный запрет
 *
 *		Эти значения зависят от логики приложения.
 *
 *		Формат конфига:
 *		$config['uaccess'][<имя класса>][<имя модуля>] = array(<перечень разрешений>);
 * */

//$config['uaccess']['admin'] = array('news','object','afisha','discount','articles');
$config['uaccess']['manager'] = array('view');

$config['uaccess']['admin']['articles']		= array('view','edit','add','del');
$config['uaccess']['admin']['consultation']	= array('view','edit','add','del');
$config['uaccess']['admin']['news']			= array('view','edit','add','del');
$config['uaccess']['admin']['object']		= array('view','edit','add','del');
$config['uaccess']['admin']['discounts']	= array('view','edit','add','del');
$config['uaccess']['admin']['photoarchive']	= array('view','edit','add','del');
$config['uaccess']['admin']['sport']		= array('view','edit','add','del');
$config['uaccess']['admin']['submenu']		= array('view','edit','add','del');
$config['uaccess']['admin']['news']			= array('view','edit','add','del');


$config['uaccess']['redactor']['articles']		= array('view','edit','add','del');
$config['uaccess']['redactor']['consultation']	= array('view','edit','add','del');
$config['uaccess']['redactor']['news']			= array('view','edit','add','del');
$config['uaccess']['redactor']['object']		= array('view','edit','add','del');
$config['uaccess']['redactor']['discounts']		= array('view','edit','add','del');
$config['uaccess']['redactor']['photoarchive']	= array('view','edit','add','del');
$config['uaccess']['redactor']['sport']			= array('view','edit','add','del');
$config['uaccess']['redactor']['submenu']		= array('view','edit','add','del');
$config['uaccess']['redactor']['news']			= array('view','edit','add','del');


$config['uaccess']['user']['articles']		= array('view_self','edit_self','add_self','del_self');
$config['uaccess']['user']['consultation']	= array('view_self','edit_self');
$config['uaccess']['user']['news']			= array('view_self','edit_self','add_self','del_self');
$config['uaccess']['user']['object']		= array('view_self','edit_self','add_self');
$config['uaccess']['user']['discounts']		= array('view_self','edit_self','add_self','del_self');
$config['uaccess']['user']['photoarchive']	= array('view_self','add_self');
$config['uaccess']['user']['sport']			= array('view_self','edit_self','add_self','del_self');
$config['uaccess']['user']['submenu']		= array('view_self','edit_self','add_self','del_self');
$config['uaccess']['user']['news']			= array('view_self','edit_self','add_self','del_self');


?>