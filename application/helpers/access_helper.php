<?php
/*
 * 		Privilegies helper. Uses Privilegies library
 * 		programmer: Meshin Dmitriy
 * */
function access($modulename, $accesstype = '')
{
	$CI =& get_instance();
	return $CI->auth->hasAccess($modulename, $accesstype);
}
?>