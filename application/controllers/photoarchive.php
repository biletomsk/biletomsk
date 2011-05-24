<?php


class Photoarchive extends Controller{
	
	function __construct()
	{
		parent::Controller();
		if ($this->auth->isAuthorised() == false )
		{
			redirect('login');
		}
		$this->load->model('photoarchive_model');
		
		$user = $this->auth->getUser();
		$user = ($user['class']=='admin' || $user['class']=='redactor' || $user['class']=='manager') ? FALSE : $user['nick'];
		$this->main_menu = $this->index_model->get_list_category($user);
		

	}
	
	function index($param='')
	{
			
		if(is_array($param))
		{
			$photo['message'] = $param['message'];
		}
		//Подключаем библиотеку пагинации
		$this->load->library('pagination');
		//КОнфигурируем
		$config['per_page'] = '20'; 
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['uri_segment'] = '4';
		$config['base_url'] = base_url().'photoarchive/index/page';
		$config['total_rows'] = $this->photoarchive_model->get_total_photoarchives();


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(4))? $this->uri->segment(4):'0';
	
		//Список
		$photo['data'] = $this->photoarchive_model->get_photoarchives($offset);
		$photo['category'] = $this->photoarchive_model->get_category();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'photo/photo_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$photo,
														'main_category'=>$this->main_menu																			
														)
										);
										
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'photo');								
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function show_category()
	{
		$id = (int) $this->uri->segment(3);
		//Подключаем библиотеку пагинации
		$this->load->library('pagination');
		//КОнфигурируем
		$config['per_page'] = '20'; 
		
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['uri_segment'] = '4';
		$config['base_url'] = base_url().'photoarchive/show_category/'.$id.'/';
		$config['total_rows'] = $this->photoarchive_model->get_total_photoarchives($id);


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		
		$offset = ($this->uri->segment(4))? $this->uri->segment(4):'0';
		//Список
		$photo['data'] = $this->photoarchive_model->get_photoarchive_by_categ($id,$offset);
		$photo['category'] = $this->photoarchive_model->get_category();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'photo/photo_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$photo,
														'main_category'=>$this->main_menu																			
														)
										);
										
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'photo');								
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
		
	}
	
	function add()
	{
		$photo['objcategory']	= $this->object_model->get_object_category();
		$photo['category'] 		= $this->photoarchive_model->get_category();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'photo/photo_add_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$photo,
														'main_category'=>$this->main_menu																			
														)
										);
										
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'photo');									
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
		
	}
	
	
	
	function edit()
	{
		$id = (int) $this->uri->segment(3);
		
		$photo['detail']		= $this->photoarchive_model->get_photoarchive_by_id($id);
		$photo['images']		= $this->photoarchive_model->get_images_by_pid($id);
		$photo['objcategory']	= $this->object_model->get_object_category();
		$photo['category'] 		= $this->photoarchive_model->get_category();
		
		$photo['objcategory']	= $this->object_model->get_object_category();
		
		
		
		if($photo['detail']->arch_objid)
		{
			$photo['ocat']		= $this->object_model->get_category_of_object($photo['detail']->arch_objid);
			$photo['objects']	= $this->object_model->get_object_list($photo['ocat'][0]->obj_categ);
		}
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'photo/photo_edit_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$photo,
														'main_category'=>$this->main_menu																			
														)
										);
										
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'photo');									
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function update()
	{
		$id = (int) $this->uri->segment(3);
		if($id != 0)
		{
			$action = "UPDATE";
			//$dir = $id;
		}
		else
		{
			$action = "ADD";
			//Создаем временное название папки, пока не узнаем id фотоотчета	
			//$dir = md5($this->input->post('arch_name').date('his'));	
		}
		
		if($this->form_validation->run('photo_update') == FALSE)
		{
			echo 'Some errors';
		}
		else
		{
			
			
		
			
			$photo['arch_categ'] 	= $this->input->post('arch_categ');
			$photo['arch_objid'] 	= $this->input->post('arch_objid');
			$photo['arch_name'] 	= addslashes($this->input->post('arch_name'));
			$photo['arch_txt'] 		= addslashes($this->input->post('arch_txt'));
			$photo['arch_d'] 		= cp_format_date($this->input->post('arch_date'),1);
			$photo['arch_m'] 		= cp_format_date($this->input->post('arch_date'),2);
			$photo['arch_y'] 		= cp_format_date($this->input->post('arch_date'),3);
			
			
			$photo['arch_status'] 	= '1';
			
			if($action == 'UPDATE')
			{
				$update = $this->photoarchive_model->photoarchive_update($id,$photo);
			}
			elseif($action == 'ADD')
			{
				$add = $this->photoarchive_model->photoarchive_add($photo);
				$id    	= $this->photoarchive_model->get_last_id();
			}
			
			//Проверяем массив на удаление
			if(is_array($this->input->post('TODEL')))
			{
				foreach($this->input->post('TODEL') as $key)
				{
					$old_image = $this->photoarchive_model->get_image_by_id($key);
					//Удаляем старые файлы
					unlink(SDIR.'photoarchive/'.$old_image->p_id.'/'.$old_image->img);
					unlink(SDIR.'photoarchive/'.$old_image->p_id.'/b_'.$old_image->img);
					//Удаляем запись из таблицы
					$this->photoarchive_model->delete_image_by_id($key);
				}
			}
			
			
			
			
			//Какой метод использовался при залитии фоток
			if($this->input->post('up_type')==1)	//По одной пока не работает
			{
				
				if($_FILES)
				{
					
				
					$path = SDIR.'photoarchive/'.$id;
		
					if(!is_dir($path))
					{
						umask(0000);
						mkdir($path, DIR_WRITE_MODE);
						chmod($path, DIR_WRITE_MODE);
										
					}
					//Массив параметров
					$data = array(		
									'config'=>array(
													'upload_path'=>$path.'/',
													'allowed_types'=>'jpg|gif',
													'file_name'=>'b_'.cp_transliter($this->input->post('arch_name')).strtotime("now"),
													'max_size' =>1024
													),
									'id'=>	$id,
									'thumb_path'=>$path.'/',
									'resize'=>TRUE				
					
									);
									
					$output_data = $this->image_manipulation($data);	
					$output_ftxt = $this->input->post('ftxt');
					//Проверяем 
					if($output_data)
					{
						
						
						$i = 0;
						foreach($output_data as $key)
						{
							if($i == ($this->input->post('arch_index')-1))
							{
								$advanced['arch_title_img'] = $key['filename'];
							}
							else
							{
								$advanced['arch_title_img'] = $this->input->post('TOIND');
							}
							
							$newrow['img'] 	= substr($key['file_name'],2);
							$newrow['text']	= $output_ftxt[$i];
							$newrow['p_id'] = $id;
							$newrow['orient'] = ($key['image_width']>$key['image_height'])? 'h':'v';
							
							$this->photoarchive_model->insert_img($newrow);
							$i++;
						}
					}				
					
				}
				
			}
			elseif($this->input->post('up_type')==2)//Оптом
			{
				//Получаем содержимое временной папки
				$map =  get_filenames(SDIR.'photoarchive/tmp/',TRUE);
				$path = SDIR.'photoarchive/'.$id;
		
				if(!is_dir($path))
				{
					umask(0000);
					mkdir($path, DIR_WRITE_MODE);
					chmod($path, DIR_WRITE_MODE);
					//mkdir($path.'/big');
				}
				
				$config['image_library'] = 'gd2'; // выбираем библиотеку
				$config['width']	 = 210; // и задаем размеры
				$config['height']	 = 150; // и задаем размеры
				$config['master_dim']='auto';
				$this->load->library('image_lib', $config); // загружаем библиотеку 
				//Копируем временные файлы в рабочую директорию, меняем имя и создаем thumbnails
				$i = 0;
				foreach($map as $item)
				{
					$newfile = 'b_'.cp_transliter($this->input->post('arch_name')).strtotime("now").$i.$this->_get_extension($item);
					if(copy($item,$path.'/'.$newfile))
					{
						if($i == ($this->input->post('arch_index')-1))
						{
							$advanced['arch_title_img'] = $newfile;
						}
						else
						{
								$advanced['arch_title_img'] = $this->input->post('TOIND');
						}
						
						$config['source_image']	= $path.'/'.$newfile; 
						$config['new_image']	= $path.'/'.substr($newfile,2);
						
						$this->image_lib->initialize($config); 
						$this->image_lib->resize(); // и вызываем функцию
						
						$imgdata =  getimagesize($path.'/'.$newfile);
						
						//Добавляем информацию в таблицу
						$newrow['img'] 	= substr($newfile,2);
						$newrow['p_id'] = $id;
						$newrow['orient'] = ($imgdata[0]>$imgdata[1])? 'h':'v';
						
						$this->photoarchive_model->insert_img($newrow);
						//Удаляем изображение
						unlink($item);
					}
					$i++;
				}
				
					
			}
			else
			{
				if($this->input->post('TOIND'))
				{
					$advanced['arch_title_img'] = $this->input->post('TOIND');
				}
				
				
			}
			
			//Обновляем индекс в таблице
			if($this->photoarchive_model->photoarchive_update($id,$advanced))
			{
				$param = array('message'=>alert_successfull('Создание ',' фотоотчета '.$photo['arch_name'])
								);
				$this->index($param);
			}
			else
			{
				$param = array('message'=>alert_fail('Создание ',' фотоотчета '.$photo['arch_name'])
								);
				$this->index($param);
			}
			
			
		}
		
		
	}
	
	function category($param='')
	{
			
		if(is_array($param))
		{
			$category['message'] = $param['message'];
		}
		
		$category['category'] = $this->photoarchive_model->get_category();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'photo/photo_category_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$category,
														'main_category'=>$this->main_menu																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function category_edit()
	{
		$id = (int) $this->uri->segment(3);		
		$category['data'] = $this->photoarchive_model->get_category_by_id($id);
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'photo/photo_category_edit_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$category,
														'main_category'=>$this->main_menu																			
														)
										);
										
		//Указываем название дополнительной js-библиотеки								

		$this->load->view('default/index',$data);
		
	}
	
	
	function category_update()
	{
		$id = (int) $this->uri->segment(3);
		if($id != 0)
		{
			$action = "UPDATE";
		}
		else
		{
			$action = "ADD";
		}
		
		if($this->form_validation->run('photo_categ') == FALSE)
		{
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			$this->category();
		}
		else
		{
			
			$categ['name'] = addslashes($this->input->post('name'));
			
			if($action == 'UPDATE')
			{
				if($this->photoarchive_model->category_update($id,$categ))
				{
					$param = array('message'=>alert_successfull('Обновление ',' категории '.$categ['name'])
								);
					$this->category($param);
				}
				else
				{
					$param = array('message'=>alert_fail('Обновление ',' категории '.$categ['name'])
								);
					$this->category($param);	
				}
			}
			elseif($action == 'ADD')
			{
				$categ['type'] = 'temporary';
				if($this->photoarchive_model->category_add($categ))
				{
					$param = array('message'=>alert_successfull('Создание ',' категории '.$categ['name'])
								);
					$this->category($param);
				}
				else
				{
					$param = array('message'=>alert_fail('Создание ',' категории '.$categ['name'])
								);
					$this->category($param);	
				}
			}
		}
		
	}
	
	function category_delete()
	{
		$id = (int) $this->uri->segment(3);
		if($this->photoarchive_model->get_category_by_id($id) !== FALSE)
		{
			//Удаляем новость 
			if($this->photoarchive_model->delete_category($id))
			{
				$param = array('message'=>alert_successfull('Удаление ',' категории ')
							);
				$this->category($param);
			}
			else
			{
				$param = array('message'=>alert_fail('Удаление ',' категории ')
							);
				$this->category($param);
			}
		}
		else
		{
			redirect('photoarchive/category');
		}
	}
	
	function _get_extension($filename) {
	   $x = explode('.', $filename);
	   return '.'.end($x);
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
		
		
		//Если необходим ресайз
		if($param['resize']!== FALSE)
		{
			//Запускаем цикл, в котором вызываем функцию уменьшения и перемещения
			
			$config['image_library'] = 'gd2'; // выбираем библиотеку
			$config['width']	 = 210; // и задаем размеры
			$config['height']	 = 150; // и задаем размеры
			$config['master_dim']='auto';
			$this->load->library('image_lib', $config); // загружаем библиотеку 
			
			foreach($data['upload_data'] as $key)
			{
				$config['source_image']	= $param['config']['upload_path'].$key['file_name']; 
				$config['new_image']	= $param['thumb_path'].substr($key['file_name'],2);
				
				$this->image_lib->initialize($config); 
				$this->image_lib->resize(); // и вызываем функцию
				
			}	
		}

		
		return $data['upload_data'];
		
	}
	function ajax()
	{
		
		if($this->input->post('action')=='setobjcategory')
		{
			$data = $this->object_model->get_object_list($this->input->post('id'));
			
			foreach($data as $row)
			{
				$answer[] = array('id'=>$row->obj_ids,'name'=>strip_tags(stripslashes($row->obj_nam)));
			}
			
			header('Content-type: application/json');
	
			echo json_encode($answer);	
		}	
		//Отгрузка нужной формы для загрузки фотоотчета
		if($this->input->post('action') == 'setuploadform')
		{
			//По одной фотке
			if($this->input->post('id')== 1)
			{
				$this->load->view('default/template/photo/ajax/simpleform');
				
			}
			//SWF загрузчик
			elseif($this->input->post('id')== 2)
			{
				$this->load->view('default/template/photo/ajax/swfform');
			}
		}
	}
	
}




?>