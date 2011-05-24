<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 		������� ���� �������
 * 
 *		��������� ��������:
 *
 *		view		-	��������
 *		edit		-	��������������
 *		add			-	����������
 *		del			-	��������
 *		opt			-	����������� (�������� ��� ��������)
 *		view_self,
 *		edit_self,
 *		add_self,
 *		del_self	-	��������� ������ �� �����
 *		dissalow	-	������ ������
 *
 *		��� �������� ������� �� ������ ����������.
 *
 *		������ �������:
 *		$config['uaccess'][<��� ������>][<��� ������>] = array(<�������� ����������>);
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