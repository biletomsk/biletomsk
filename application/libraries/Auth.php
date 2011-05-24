<?php defined('BASEPATH') or die('No direct script access.');
/*
 * 	Библиотека авторизации включает в себя возможности
 * 	не только автоматической авторизации но и проверку
 * 	прав доступа.
 * 
 * 	Для работы необходимы две таблицы.

	Таблица пользователей
	
		CREATE TABLE users (
  			id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  			class_id INTEGER UNSIGNED NOT NULL,
  			nick VARCHAR(255) NULL,
  			passw VARCHAR(255) NULL,
  			PRIMARY KEY(id, class_id),
  			INDEX users_FKIndex1(class_id)
		);

	Таблица классов пользователей

		CREATE TABLE class (
  			id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  			name VARCHAR(255) NULL,
  			description VARCHAR(255) NULL,
  			PRIMARY KEY(id)
		);
*/
class Auth
{
	protected $authorised = false;
	protected $privilegies_table;
	protected $CI = null;
	protected $user;
	protected $config;
	protected $user_access;

	public function __construct()
	{
		//	получаем суперобъект
		$this->CI =& get_instance();
		
		//	массив данных юзера
		$this->user = array(
			'id' => 0,
			'nick' => '',
			'passw' => '',
			'class' => '',
			'class_desc' => '',
			'access' => false
		);
		
		//	устанавливаем дефолтовый конфиг авторизации
		$this->SetAuthConfig();
		//	проверяем авторизацию
		$this->CheckAuth();
		//	загружаем таблицу прав
		$this->CI->load->config('auth_access');
		//	устанавливаем таблицу прав
		$this->SetAccessTable($this->CI->config->item('uaccess'));
	}
	
	//-------------------------------------------------------------------------
	
	/*
	 * 	Возвращаем информацию о пользователе
	 * */
	public function getUser()
	{
		return $this->user;
	}
	
	//-------------------------------------------------------------------------
	
	/*
	 * 	Функция возвращает авторизирован ли юзер
	 * */
	public function isAuthorised()
	{
		return $this->authorised;
	}
	
	//-------------------------------------------------------------------------
	
	/*
	 * 	Проверка на доступ юзера к модулю
	 * */
	public function hasAccess()
	{

			if(isset($this->privilegies_table[$this->user['class']]))
			{
				$this->user['access'] = $this->privilegies_table[$this->user['class']];
				return $this->privilegies_table[$this->user['class']];
			}
			else return false;
	
	}
	
	//-------------------------------------------------------------------------
	
	/*
	 * 	Установка таблицы прав
	 * */
	public function setAccessTable($table)
	{
		if(is_array($table))
		{
			$this->privilegies_table = $table;
		}
	}
	
	
	//-------------------------------------------------------------------------
	
	/*
	 * 	Функция убивает сессии 
	 * 
	 */
	public function logout()
	{
		$session_items = array(
					$this->CI->config->item('auth_nick'),
					$this->CI->config->item('auth_passw')
					);

		$this->CI->session->unset_userdata($session_items);
		$this->CI->session->sess_destroy();
	}
	//-------------------------------------------------------------------------
	
	/*
	 * 	Функция устанавливает конфиг авторизации.
	 * 
	 * 	Если аргумент не указан то параметры загружается из конфига
	 * 	Структура передаваемого конфига:
	 * 		array(
	 * 			'auth_nick' => <...>,
	 *			'auth_passw' => <...>,
	 *			'auth_form_nick' => <...>,
	 *			'auth_form_passw' => <...>
	 * 		)
	 * */
	public function setAuthConfig($config_array = '')
	{
		if(is_array($config_array))
		{
			$this->config = array(
				'auth_nick' => $config_array['auth_nick'],
				'auth_passw' => $config_array['auth_passw'],
				'auth_form_nick' => $config_array['auth_form_nick'],
				'auth_form_passw' => $config_array['auth_form_passw']
			);
		}
		else
		{
			$this->CI->config->load('auth_config');
			$this->config = array(
				'auth_nick' => $this->CI->config->item('auth_nick'),
				'auth_passw' => $this->CI->config->item('auth_passw'),
				'auth_form_nick' => $this->CI->config->item('auth_form_nick'),

				'auth_form_passw' => $this->CI->config->item('auth_form_passw')
			);
		}
	}
	
		//-------------------------------------------------------------------------

	/*
	 * 		Проверка 
	 * */
	public function myRights($module='')
	{
		$this->user_access = $this->hasAccess();
		return $this->user_access[$module];
	}
	
	//-------------------------------------------------------------------------

	/*
	 * 		Проверка соответствия данных юзера данным в форме или сессии
	 * */
	public function checkAuth()
	{
		$user = false;
		
		//	строка выборки данных
		/*
		Так было в оригинале:
		$query_string = "SELECT 
							`users`.id,
							`users`.nick,
							`users`.passw,
							`users`.class_id,
							(
								SELECT 
									`class`.name
								FROM
									`class`
								WHERE
									`class`.id = `users`.class_id
							) classname,
							(
								SELECT 
									`class`.description
								FROM
									`class`
								WHERE
									`class`.id = `users`.class_id
							) class_desc
						FROM
							`users`, `class`
						WHERE
							`users`.nick = %s";
		
		Предлагаю заменить на следующее:
		*/
		$query_string = "
			SELECT 
				u.*, c.name AS classname, c.description AS class_desc
			FROM
				adm_users u, adm_user_class c
			WHERE
				u.nick = %s AND
				c.id = u.class_id
			LIMIT
				1";

		
		//$this->CI->load->library('session');
		
		//	если в сессии есть данные
		if	(
		
				$this->CI->session->userdata($this->CI->config->item('auth_passw'))
				&& $this->CI->session->userdata($this->CI->config->item('auth_nick'))
			)
		{
			
			//	подготовка данных для запроса
			$nick = $this->CI->session->userdata($this->CI->config->item('auth_nick'));
			$passw = $this->CI->session->userdata($this->CI->config->item('auth_passw'));
								
			
		}
		//	или данные отправлены из формы
		elseif	(
					$this->CI->input->post($this->CI->config->item('auth_form_nick')) 
					&& $this->CI->input->post($this->CI->config->item('auth_form_passw'))
				)
		{
			$nick = $this->CI->input->post($this->CI->config->item('auth_form_nick'));
			$passw = $this->CI->input->post($this->CI->config->item('auth_form_passw'));
			$passw = md5($passw.$this->CI->config->item('encryption_key'));
				
		}
		//	иначе авторизация не прошла
		else
		{
			$this->authorised = false;
			return false;
		}
		
		//	выбираем из таблиц информацию
		$this->CI->load->database();
		$query_params = array($this->CI->db->escape($nick));
		$result = $this->CI->db->query(vsprintf($query_string, $query_params));
		$user = $result->row_array();
		
		
		//	если такой юзер найден
		if($user)
		{	
			//	и данные верны
			if	(
					
					md5($user['passw'].$this->CI->config->item('encryption_key')) == $passw
					&& $user['nick'] == $nick
				)
			{
				
				//	сохраняем данные в сессии
				$session_data = array(
					$this->CI->config->item('auth_passw') => md5($user['passw'].$this->CI->config->item('encryption_key')),
					$this->CI->config->item('auth_nick') => $user['nick']
				);
				$this->CI->session->set_userdata($session_data);
				
				//	запоминаем данные
				$this->user = array(
					'id' => $user['id'],
					'nick' => $nick,
					'passw' => $passw,
					'class' => $user['classname'],
					'class_desc' => $user['class_desc']
				);
				
				$this->authorised = true;
				
				return true;
				
			}
		}
		else
		{
			$this->authorised = false;
			return false;
		}
	}
}
?>