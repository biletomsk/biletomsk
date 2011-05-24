<?php defined('BASEPATH') or die('No direct script access.');
/*
 * 		Конфигурационный файл для библиотеки авторизации
 * */

//	имя переменной куки, хранящей имя юзера
$config['auth_nick'] = "user";
//	имя переменной куки, хранящей хэш пароля
$config['auth_passw'] = "token";

//	имя поля формы, хранящего имя юзера
$config['auth_form_nick'] = "log";
//	имя поля формы, хранящего пароль юзера
$config['auth_form_passw'] = "pwd";

$config['encryption_key'] = "superkey";
?>