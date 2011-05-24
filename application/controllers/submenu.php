<?php

class Submenu extends Controller
{
	function __construct()
	{
		parent::Controller();
				
		if ($this->auth->isAuthorised() == false )
		{
			redirect('login');
		}
		//$this->output->enable_profiler(TRUE);
		$this->load->model('discount_model');
	}
	
	//Редактирование меню объекта
	function edit_menu($param='')
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
											'dash_tpl'=>'objects/submenu/edit_menu',
											'dash_content'=>$submenu
																					
										)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'object');	
		$this->load->view('default/submenu',$data);
		
	}
	
	/*
	 * Функция обновления меню объекта
	 */
	
	function update_menu()
	{
		
		//Извлекаем данные
		$id = (int) $this->uri->segment(3);
		$method = $this->input->post('method');
		$param ='';
	
		if($method == 'html')	//Если html меню
		{
			//Формируем массив с параметрами
			$data = array(
						'id'=>$id,
						'path'=>SDIR.'_object/meny/html/'
						);
						
			//Обновляем			
			if($this->html_manipulation($data))
			{
				$param = array('message'=>alert_successfull('Обновление','html меню'));
			}
			else
			{
				$param = array(	'message'=>alert_fail('Обновление','html меню'));	
			}
			
		}
		elseif($method == "graphic") //Если графическое меню
		{
				
			
			$path = SDIR.'_object/meny/gallery/'.$id;
			
			if(!is_dir($path))
			{
				
				umask(0000);
				mkdir($path,DIR_WRITE_MODE);
				chmod($path,DIR_WRITE_MODE);
				
				mkdir($path.'/big',DIR_WRITE_MODE);
				chmod($path.'/big',DIR_WRITE_MODE);
			}
			//Массив параметров
			$data = array(		
							'config'=>array(
											'upload_path'=>$path.'/big/',
											'allowed_types'=>'jpg|gif',
											'file_name'=>date("Ymdhis").'_'.$id.'_menu_item'
											),
							'id'=>	$id,
							'thumb_path'=>$path.'/',
							'resize'=>TRUE,
							'height'=>'160',
							'width'=>'180',				
							'big_resize'=>TRUE, //Если надо уменьшить большие изображения
							'big_width'=>640,
							'big_height'=>480	
							);			

			$upload_info = $this->image_manipulation($data);
			$upload_descript = $this->input->post('ftxt');				
							
				//Если существует массив с данными
		if($upload_info)
		{
			$i = 0;
			//Перебираем его
			foreach($upload_info as $key)
			{
				$newrow['men_img'] 	= $key['file_name'];
				$newrow['men_alt'] 	= addslashes($upload_descript[$i]);
				$newrow['men_txt'] 	= addslashes($upload_descript[$i]);
				$newrow['men_for'] 	= $id;
				$newrow['men_w']		= $data['width'];
				$newrow['men_h']		= $data['height'];
				$newrow['men_big_w']		= $key['image_width'];
				$newrow['men_big_h']		= $key['image_height'];
				
				
				//Вставляем в базу запись
				$this->object_model->insert_object_menu_item($newrow);
				$i++;
			}
			
			
			$param = array('message'=>alert_successfull('Обновление','графического меню объекта'));
		}
		else
		{
			$param = array(	'message'=>alert_fail('Обновление','графического меню объекта'));	
		}
		}
		
		$this->edit_menu($param);
		
	}
	
	//Редактирование прайса
	function edit_price($param ='')
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		//id объекта
		$id = (int) $this->uri->segment(3);
		$path	=	SDIR.'_object/uslugi-prices/'.$id.'/'.$id.'.txt';
		$submenu['price']   = $this->object_model->get_menu_of_object($path);
		
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
													'dash_tpl'=>'objects/submenu/edit_price',
													'dash_content'=>$submenu											
													)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'objects');	
		$this->load->view('default/submenu',$data);	
	}
	
	function update_price()
	{
		$data = array(
					'id'=>(int) $this->uri->segment(3),
					'path'=>SDIR.'_object/uslugi-prices/'
					);
		
		if($this->html_manipulation($data))
		{
			$param = array('message'=>alert_successfull('Обновление','прайс листа'));
		}
		else
		{
			$param = array(	'message'=>alert_fail('Обновление','прайс листа'));	
		}
		
		$this->edit_price($param);
	}
	
	
	/*
	 * Функция отображения галереи объекта
	 * 
	 */
	
	function add_gallery($param='')
	{
		
	}
	
	function edit_gallery($param='')
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		//id объекта
		$id = (int) $this->uri->segment(3);
		//Путь до папки
		
		//Готовим массив данных
		$submenu['path']	= base_site_url().'_gallery/'.$id.'/';
		$submenu['photos'] 	= $this->object_model->get_object_gallery($id);
		//Массив параметров
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
											'dash_tpl'=>'objects/submenu/edit_gallery',
											'dash_content'=>$submenu
										)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'object');	
		//Передаем в шаблон
		$this->load->view('default/submenu',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	/*
	 * Функция обновления галереи объекта
	 */
	function update_gallery()
	{

		$id = (int)$this->uri->segment(3);
		$path = SDIR.'_gallery/'.$id;
		
		if(!is_dir($path))
		{

			umask(0000);
			mkdir($path,DIR_WRITE_MODE);
			chmod($path,DIR_WRITE_MODE);
			
			mkdir($path.'/big',DIR_WRITE_MODE);
			chmod($path.'/big',DIR_WRITE_MODE);
		}
		//Массив параметров
		$data = array(		
						'config'=>array(
										'upload_path'=>$path.'/big/',
										'allowed_types'=>'jpg|gif',
										'file_name'=>date("Ymdhis").'_'.$id.'_gallery'
										),
						'id'=>	(int) $this->uri->segment(3),
						'thumb_path'=>$path.'/',
						'resize'=>TRUE,
						'height'=>'160',
						'width'=>'180',				
						'big_resize'=>TRUE, //Если надо уменьшить большие изображения
						'big_width'=>640,
						'big_height'=>480					
		
						);	
						
						
		$upload_info = $this->image_manipulation($data);
		$upload_descript = $this->input->post('ftxt');
		//Если существует массив с данными
		if($upload_info)
		{
			$i = 0;
			//Перебираем его
			foreach($upload_info as $key)
			{
				$newrow['gal_img'] 	= $key['file_name'];
				$newrow['gal_alt'] 	= addslashes($upload_descript[$i]);
				$newrow['gal_txt'] 	= addslashes($upload_descript[$i]);
				$newrow['gal_for'] 	= $id;
				$newrow['gal_w']		= $data['width'];
				$newrow['gal_h']		= $data['height'];
				$newrow['gal_bw']		= $key['image_width'];
				$newrow['gal_bh']		= $key['image_height'];
				$newrow['gal_feedb']	= 1;
				$newrow['gal_date']	= date("Ymd");
				//Вставляем в базу запись
				$this->object_model->insert_object_gallery_item($newrow);
				$i++;
			}
			
			
			$param = array('message'=>alert_successfull('Обновление','галереи объекта'));
		}
		else
		{
			$param = array(	'message'=>alert_fail('Обновление','галереи объекта'));	
		}
		
		
		
		$this->edit_gallery($param);
		
		
	}
	
	function edit_feedback($param='')
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		$id = (int)$this->uri->segment(3);
		$type = $this->uri->segment(4);
		
		
		$arg = array(
					'id'=>$id,
					'type'=>$type
					);
		
		$submenu['feedback'] = $this->object_model->get_feedback($arg);
		
		//Массив параметров
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
													'dash_tpl'=>'objects/submenu/edit_feedback',
													'dash_content'=>$submenu
													)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>strtolower($type));	
		//Передаем в шаблон
		$this->load->view('default/submenu',$data);
		$this->output->enable_profiler(TRUE);
	}
	
	function edit_banners($param='')
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		$id = (int)$this->uri->segment(3);
		$type = $this->uri->segment(4);
		
		$submenu['path']	= SDIR.'_adver/sport/'.$id.'/';
		$submenu['banners'] = $this->sport_model->get_sport_banners();
		
		//Массив параметров
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
													'dash_tpl'=>'sport/submenu/edit_banners',
													'dash_content'=>$submenu
													)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>strtolower($type));	
		//Передаем в шаблон
		$this->load->view('default/submenu',$data);
		
		
	}
	
	function update_banners()
	{
		$id = (int)$this->uri->segment(3);
		$path = SDIR.'_adver/sport/'.$id;
		
		if(!is_dir($path))
		{
			mkdir($path);
		}
		//Массив параметров
		$data = array(		
						'config'=>array(
										'upload_path'=>$path.'/',
										'allowed_types'=>'jpg|gif',
										'file_name'=>date('Ymd').'_'.$id.'_banner',
										'max_size' =>1024
										),
						'id'=>	$id,
						'resize'=>false				
		
						);
		

		$data2 = $this->image_manipulation($data);	
		$data3 = $this->input->post('ftxt');		
		if($data2)
		{
			$i = 0;
			foreach($data2 as $key)
			{
				$newrow['sb_img'] = $key['file_name'];
				$newrow['sb_url'] = $data3[$i];
				$newrow['sb_sid'] = $id;
				
				$this->sport_model->insert_sport_banners($newrow);
				$i++;
			}
			
			
			$param = array('message'=>alert_successfull('Обновление','банеров'));
		}
		else
		{
			$param = array(	'message'=>alert_fail('Обновление','банеров'));	
		}
		
		
		
		$this->edit_banners($param);			
	}
		
	
	/*
	 * Функция обновления/добавления схемы проезда объекта
	 */
	function edit_sheme_of_hall($param='')
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		
		$id = (int)$this->uri->segment(3);
		$path = SDIR.'_object/shemy-zalov/'.$id.'/';
 
		$submenu['path'] = '_object/shemy-zalov/'.$id.'/';
		$submenu['image_hall'] = $this->object_model->get_object_map_zall($id);
		//Массив параметров
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
													'dash_tpl'=>'objects/submenu/edit_hall',
													'dash_content'=>$submenu
													)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'object');	
		//Передаем в шаблон
		$this->load->view('default/submenu',$data);
		
	}
	
	
	function update_sheme_of_hall()
	{

		$id = (int)$this->uri->segment(3);
		$path = SDIR.'_object/shemy-zalov/'.$id;
		
			//Если не существует папки, то создаем
		if(!is_dir($path))
		{

			umask(0000);
			mkdir($path,DIR_WRITE_MODE);
			chmod($path,DIR_WRITE_MODE);
			
			mkdir($path.'/big',DIR_WRITE_MODE);
			chmod($path.'/big',DIR_WRITE_MODE);

		}
		
		
		//Массив параметров
		$data = array(		
						'config'=>array(//Конфиг отвечающий за загрузку изображений
										'upload_path'=>$path.'/big/',
										'allowed_types'=>'jpg|gif',
										'file_name'=>$id.'_shema_zala'									
										
										),
						'id'=>	(int) $this->uri->segment(3),
						'thumb_path'=>$path.'/',
						'resize'=>TRUE,
						'height'=>'160',
						'width'=>'180',
						'big_resize'=>TRUE, //Если надо уменьшить большие изображения
						'big_width'=>640,
						'big_height'=>480									
								
						);	

		$upload_info = $this->image_manipulation($data);
		$upload_descript = $this->input->post('ftxt');
		//Если существует массив с данными
		if($upload_info)
		{
			$i = 0;
			//Перебираем его
			foreach($upload_info as $key)
			{
				$newrow['map_img'] 	= $key['file_name'];
				$newrow['map_alt'] 	= addslashes($upload_descript[$i]);
				$newrow['map_txt'] 	= addslashes($upload_descript[$i]);
				$newrow['map_for'] 	= $id;
				$newrow['map_w']		= $data['width'];
				$newrow['map_h']		= $data['height'];
				$newrow['map_bw']		= $data['big_width'];
				$newrow['map_bh']		= $data['big_height'];
				$newrow['map_feedb']	= 1;
				$newrow['map_date']	= date("Ymd");
				//Вставляем в базу запись
				$this->object_model->insert_object_sheme_item($newrow);
				$i++;
			}
			
			
			$param = array('message'=>alert_successfull('Обновление','схемы зала'));
		}
		else
		{
			$param = array(	'message'=>alert_fail('Обновление','схемы зала'));	
		}
		
		$this->edit_sheme_of_hall($param);
		
	}
	
	
	/*
	 * Функция добавления/обновления схем проезда
	 */
	function edit_scheme_of_map($param)
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		
		$id = (int)$this->uri->segment(3);
		$path = SDIR.'_object/shemy-podezda/'.$id.'/';
 
		$submenu['path'] = '_object/shemy-podezda/'.$id.'/';
		$submenu['image_map'] = $this->object_model->get_object_map_podezd($id);
		//Массив параметров
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
											'dash_tpl'=>'objects/submenu/edit_map',
											'dash_content'=>$submenu
										)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'object');	
		//Передаем в шаблон
		$this->load->view('default/submenu',$data);
		
	}
	
	function update_scheme_of_map()
	{
		$id = (int)$this->uri->segment(3);
		$path = SDIR.'_object/shemy-podezda/'.$id;
		//Если не существует папки, то создаем
		if(!is_dir($path))
		{
			
			
			umask(0000);
			mkdir($path,DIR_WRITE_MODE);
			chmod($path,DIR_WRITE_MODE);
			
			mkdir($path.'/big',DIR_WRITE_MODE);
			chmod($path.'/big',DIR_WRITE_MODE);
			
			//mkdir($path,'0777');
			//mkdir($path.'/big','0777');
		}
		//Массив параметров
		$data = array(		
						'config'=>array(//Конфиг отвечающий за загрузку изображений
										'upload_path'=>$path.'/big/',
										'allowed_types'=>'jpg|gif',
										'file_name'=>$id.'_shema_proezda'									
										
										),
						'id'=>	(int) $this->uri->segment(3),
						'thumb_path'=>$path.'/',
						'resize'=>TRUE,
						'height'=>'160',
						'width'=>'180',
						'big_resize'=>TRUE, //Если надо уменьшить большие изображения
						'big_width'=>640,
						'big_height'=>480									
								
						);	
		
		$upload_info = $this->image_manipulation($data);
		$upload_descript = $this->input->post('ftxt');
		//Если существует массив с данными
		if($upload_info)
		{
			$i = 0;
			//Перебираем его
			foreach($upload_info as $key)
			{
				$newrow['mapz_img'] 	= $key['file_name'];
				$newrow['mapz_alt'] 	= addslashes($upload_descript[$i]);
				$newrow['mapz_txt'] 	= addslashes($upload_descript[$i]);
				$newrow['mapz_for'] 	= $id;
				$newrow['mapz_w']		= $data['width'];
				$newrow['mapz_h']		= $data['height'];
				$newrow['mapz_bw']		= $data['big_width'];
				$newrow['mapz_bh']		= $data['big_height'];
				$newrow['mapz_feedb']	= 1;
				$newrow['mapz_date']	= date("Ymd");
				//Вставляем в базу запись
				$this->object_model->insert_object_map_item($newrow);
				$i++;
			}
			
			
			$param = array('message'=>alert_successfull('Обновление','схемы расположения'));
		}
		else
		{
			$param = array(	'message'=>alert_fail('Обновление','схемы расположения'));	
		}
		
	
			
		$this->edit_scheme_of_map($param);
		
		
		
	}
	
	//Спорт
	
	function edit_pravila($param='')
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		//id объекта
		$id = (int) $this->uri->segment(3);
		
		$submenu['pravila']   = $this->sport_model->get_sport_by_id($id,"sp_pravila");
		
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
													'dash_tpl'=>'sport/submenu/edit_pravila',
													'dash_content'=>$submenu											
													)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'sport');	
		$this->load->view('default/submenu',$data);		
	}
	
	function update_pravila()
	{
		
		
		if($this->sport_model->update_pravila())
		{
			$param = array('message'=>alert_successfull('Обновление','правил спорта'));
		}
		else
		{
			$param = array(	'message'=>alert_fail('Обновление','правил спорта'));	
		}
		
		$this->edit_pravila($param);
	}
	
	//Скидки
	
	function edit_dis_gallery($param='')
	{
		$submenu =array();
		
		if(is_array($param))
		{
			$submenu['message'] = $param['message'];
		}
		$id = (int) $this->uri->segment(3);
		$path = '_files/discount/_gallery/'.$id.'/';
		$submenu['path'] = $path;
		$submenu['gallery']   = $this->discount_model->get_discount_gallery($id);
		
		$data['main_content'] = array(	'tpl'=>'light_main',
										'dash'=>array(
													'dash_tpl'=>'discounts/submenu/edit_gallery',
													'dash_content'=>$submenu											
													)
		);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'discounts');	
		$this->load->view('default/submenu',$data);		
		
	}
	
	function update_dis_gallery()
	{
		$id = (int)$this->uri->segment(3);
		$path = SDIR.'_files/discount/_gallery/'.$id;
		
		if(!is_dir($path))
		{
			umask(0000);
			mkdir($path,DIR_WRITE_MODE);
			chmod($path,DIR_WRITE_MODE);
			
			mkdir($path.'/big',DIR_WRITE_MODE);
			chmod($path.'/big',DIR_WRITE_MODE);

		}
		
		
		//Массив параметров
		$data = array(		
						'config'=>array(
										'upload_path'=>$path.'/big/',
										'allowed_types'=>'jpg|gif',
										'file_name'=>date('Ymd').'_'.$id.'_item',
										'max_size' =>1024
										),
						'id'=>	$id,
						'thumb_path'=>$path.'/',
						'resize'=>TRUE,
						'height'=>'147',
						'width'=>'210',
						'big_resize'=>false				
		
						);
		

		$data2 = $this->image_manipulation($data);	
		$data3 = $this->input->post('ftxt');		
		if($data2)
		{
			$i = 0;
			foreach($data2 as $key)
			{
				$newrow['dg_img'] 			= $key['file_name'];
				$newrow['dg_description'] 	= $data3[$i];
				$newrow['dg_dis_id'] 		= $id;
				
				$this->discount_model->insert_discount_galery($newrow);
				$i++;
			}
			
			
			$param = array('message'=>alert_successfull('Обновление','галереи'));
		}
		else
		{
			$param = array(	'message'=>alert_fail('Обновление','галереи'));	
		}
		
		$this->edit_dis_gallery($param);
		
	}


/*
	 * Функция для манипуляции изображениями
	 * 
	 */
	function image_manipulation($param)
	{
		
		$config = $param['config'];
		$id 	= $param['id'];
		
		$this->load->library('upload', $config);
       	$data['upload_data'] = $this->upload->multi_upload('IMAGES',$config);
       	//Если ничего не загружали
       	if(!$data['upload_data']) 
       	{
       		return false;
       	}
       	
       	//Если необходимо уменьшить избражения
		if($param['big_resize']!== FALSE)
		{
			//Запускаем цикл, в котором вызываем функцию уменьшения
			$config['image_library'] = 'gd2'; // выбираем библиотеку
			$config['width']	= (@$param['big_width']) ? $param['big_width'] : '640';
			$config['height']	= (@$param['big_height']) ? $param['big_height'] : '480';
			//$config['width']	 = ; // и задаем размеры
			//$config['height']	 = 120; // и задаем размеры
			$config['master_dim']='auto';
			$this->load->library('image_lib', $config); // загружаем библиотеку 
			
			foreach($data['upload_data'] as $key)
			{
				$config['source_image']	= $param['config']['upload_path'].$key['file_name']; 
				$config['new_image']	= $param['config']['upload_path'].$key['file_name'];
				
				$this->image_lib->initialize($config); 
				$this->image_lib->resize(); // и вызываем функцию
				
			}	
			
		}
	
		//Если необходимо создание табнейлов
		if($param['resize']!== FALSE)
		{
			//Запускаем цикл, в котором вызываем функцию уменьшения и перемещения
			
			$config['image_library'] = 'gd2'; // выбираем библиотеку
			$config['width']	= (@$param['width']) ? $param['width'] : '100';
			$config['height']	= (@$param['height']) ? $param['height'] : '120';
			//$config['width']	 = ; // и задаем размеры
			//$config['height']	 = 120; // и задаем размеры
			$config['master_dim']='auto';
			$this->load->library('image_lib', $config); // загружаем библиотеку 
			
			foreach($data['upload_data'] as $key)
			{
				$config['source_image']	= $param['config']['upload_path'].$key['file_name']; 
				$config['new_image']	= $param['thumb_path'].$key['file_name'];
				
				$this->image_lib->initialize($config); 
				$this->image_lib->resize(); // и вызываем функцию
				
			}	
		}

		
		return $data['upload_data'];
		
	}
	
	/*
	 * Функция манипуляции с html документами ( меню, прайсы)
	 * 
	 */
	function html_manipulation($data)
	{
		$id = (int)$data['id'];
		$path = $data['path'];
		
		//Проверка на существование папки
		if(!is_dir($path.$id))
		{
			//Создаем папки
			umask('0000');
			mkdir($path.$id,DIR_WRITE_MODE);
			chmod($path.$id, DIR_WRITE_MODE);
			
		}
		$data= mb_convert_encoding($this->input->post('html_content'),'CP1251','UTF8');
		$file = $path.$id.'/'.$id.'.txt';
		
		if($this->object_model->update_html_menu($file,$data))
		{
			return TRUE;
		}
	}
	
	
	function ajax()
	{
		$id = (int) $this->input->post('id');	
			
		if($this->input->post('type')=='html')
		{					
			$path	=	SDIR.'_object/meny/html/'.$id.'/'.$id.'.txt';
			$data['menu']   = $this->object_model->get_menu_of_object($path);
			$this->load->view('default/template/objects/ajax/html_menu',$data);
		}
		elseif($this->input->post('type')=='graphic')
		{
			
			$data['path']  	= '_object/meny/gallery/'.$id.'/';
			$data['photos'] = $this->object_model->get_list_files($id);
			$this->load->view('default/template/objects/ajax/graphic_menu',$data);
		}
		
		
		//Удаление схемы проезда
		elseif($this->input->post('type')=='delete_mapitem')
		{
			$id = (int) intval($this->input->post('id'));
			//echo $id;
			//Получаем данные об изображении
			$image = $this->object_model->get_object_map_item($id);
			
			//print_r($image);
			
			$bigimage = SDIR.'_object/shemy-podezda/'.$image->mapz_for.'/big/'.$image->mapz_img;
			$thumbimage = SDIR.'_object/shemy-podezda/'.$image->mapz_for.'/'.$image->mapz_img;
			
			//Удаляем запись и файлы
			if($this->object_model->delete_object_map_item($image->mapz_ids) AND $this->object_model->delete_graphic_item($bigimage) AND $this->object_model->delete_graphic_item($thumbimage))
			{
				echo "OK";
			}
		}
		//Удаление схемы зала
		elseif($this->input->post('type')=='delete_hallitem')
		{
			$id = (int) intval($this->input->post('id'));
			//echo $id;
			//Получаем данные об изображении
			$image = $this->object_model->get_object_sheme_item($id);
			
			//print_r($image);
			
			$bigimage = SDIR.'_object/shemy-zalov/'.$image->map_for.'/big/'.$image->map_img;
			$thumbimage = SDIR.'_object/shemy-zalov/'.$image->map_for.'/'.$image->map_img;
			
			//Удаляем запись и файлы
			if($this->object_model->delete_object_sheme_item($image->map_ids) AND $this->object_model->delete_graphic_item($bigimage) AND $this->object_model->delete_graphic_item($thumbimage))
			{
				echo "OK";
			}
		}
		//Удаление одной фотографии в галерее
		elseif($this->input->post('type')=='delete_gallitem')
		{
			$id = (int) intval($this->input->post('id'));
			//Получаем данные об изображении
			$image = $this->object_model->get_object_gallery_item($id);
			
			$bigimage = SDIR.'_gallery/'.$image->gal_for.'/big/'.$image->gal_img;
			$thumbimage = SDIR.'_gallery/'.$image->gal_for.'/'.$image->gal_img;
			
			//Удаляем запись и файлы
			if($this->object_model->delete_object_gallery_item($image->gal_ids) AND $this->object_model->delete_graphic_item($bigimage) AND $this->object_model->delete_graphic_item($thumbimage))
			{
				echo "OK";
			}
		}
		//Редактирование одной фотки в галерее
		elseif($this->input->post('type')=='edit_gallitem')
		{
			$id = (int) $this->input->post('id');
			$data['image'] = $this->object_model->get_object_gallery_item($id);
			
			
			$this->load->view('default/template/objects/ajax/edit_gallery',$data);
		}
		
		//Редактирование одного отзыва
		elseif($this->input->post('type')=='edit_feedback')
		{
			$id = (int) $this->input->post('id');
			$data['feedback'] = $this->object_model->get_feedback_by_id($id);
			
			$this->load->view('default/template/objects/ajax/edit_feedback',$data);
		
		}
		//Обновление отзыва
		elseif($this->input->post('type')=='update_feedback')
		{
			$data = explode("::",$this->input->post('data'));
			$data['feed_ids'] = $data[0];
			$data['new_data'] = array(
						'feed_stat'=>$data[2],
						'feed_txt'=>$data[1]
						);

			if($this->object_model->update_feedback($data))
			{
				echo "OK";
			}
			
		}
		//Удаление спортивного банера
		elseif($this->input->post('type')=='delete_sb')
		{
			$id = (int) $this->input->post('id');
			$banner = $this->sport_model->get_sport_banner($id);
			
			
			if($this->sport_model->delete_sport_banners($id) AND $this->sport_model->delete_file_sport_banners($banner))
			{
				echo "OK";
			}
		}
		//Удаление фотки от скидки
		elseif($this->input->post('type')=='delete_disitem')
		{
			$id = (int) $this->input->post('id');
			$gallery = $this->discount_model->get_discount_gallery_item($id);
			
			
			if($this->discount_model->delete_discount_gallery_item($id) AND $this->discount_model->delete_file_discount_image($gallery))
			{
				echo "OK";
			}
		}
		

		
	}
}


?>