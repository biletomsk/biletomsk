<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');




function alert_successfull($action ='',$string ='')
{
	return '<div id="success" class="info_div"><span class="ico_success">'.$action.' '.$string.' прошло успешно</span></div>';
}

function alert_fail($action ='',$string='')
{
	return '<div id="fail" class="info_div"><span class="ico_cancel">'.$action.' '.$string.' невозможно</span></div>';
}

function alert_warning($string='')
{
	return '<div id="warning" class="info_div"><span class="ico_error">'.$string.' не существует</span></div>';

}


?>