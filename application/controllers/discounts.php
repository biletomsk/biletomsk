<?php

class Discounts extends Controller{
	
	protected $user_action;	
	
	function __construct()
	{
		parent::Controller();
		if ($this->auth->isAuthorised() == false )
		{
			redirect('login');
		}
		$this->load->model('discount_model');
		$this->user_action = $this->auth->myRights(strtolower(__CLASS__));
		$user = $this->auth->getUser();
		$user = ($user['class']=='admin' || $user['class']=='redactor' || $user['class']=='manager') ? FALSE : $user['nick'];
		$this->main_menu = $this->index_model->get_list_category($user);
		
	}
	
	function index($param='')
	{
			//проверка права чтения
		if(in_array('view_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			$user = $user['nick'];
			$sql = " WHERE d.dis_user='".$user."' ";
		}
		elseif(in_array('view',$this->user_action,TRUE))
		{
			$user = FALSE;
			$sql='';
		}
		else
		{
			
		}	
		if(is_array($param))
		{
			$discount['message'] = $param['message'];
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
		$config['base_url'] = base_url().'discounts/index/page/';
		$config['total_rows'] = $this->discount_model->get_total_discount(false,$user);


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(4))? $this->uri->segment(4):'0';
		//Получаем данные
		$discount['data'] 		= $this->discount_model->get_last_discount($offset,$sql);
		//$discount['category']	= $this->discount_model->get_discount_category();
		$discount['pages'] 		=  $this->pagination->create_links();
		
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'discounts/discounts_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$discount,
														'main_category'=>$this->main_menu																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
	
	}
	
	function show_category()
	{
			//проверка права чтения
		if(in_array('view_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			$user = $user['nick'];
			$presql = "  AND d.dis_user='".$user."' ";
		}
		elseif(in_array('view',$this->user_action,TRUE))
		{
			$user = FALSE;
			$presql = '';
		}
		else
		{
			
		}	
		$id = (int) $this->uri->segment(3);
		//Получаем информацию о категории
		$ctype = $this->discount_model->get_category_by_id($id);
		//Определяем режим (подкатегория или родительская категория)
		$sql = ($ctype->dc_parent_id == 0) ? ' WHERE dc_parent_id='.$id.$presql : ' WHERE dc_cat_id='.$id.$presql;
		//Подключаем библиотеку пагинации
		$this->load->library('pagination');
		//КОнфигурируем
		$config['per_page'] = '20'; 
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['uri_segment'] = '5';
		$config['base_url'] = base_url().'discounts/show_category/'.$id.'/page/';
		$config['total_rows'] = $this->discount_model->get_total_discount_by_id($sql);


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(5))? $this->uri->segment(5):'0';
		//Получаем данные
		$discount['data'] 		= $this->discount_model->get_last_discount($offset,$sql);
		//$discount['category']	= $this->discount_model->get_discount_category();
		$discount['pages'] 		= $this->pagination->create_links();
		
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'discounts/discounts_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$discount,
														'main_category'=>$this->main_menu																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
		
	}
	
	function show_index($param='')
	{
		
		if(is_array($param))
		{
			$discount['message'] = $param['message'];
		}
		$discount['dindex']	= $this->discount_model->get_discount_index();
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'discounts/discounts_index_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$discount,
														'main_category'=>$this->main_menu																			
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'discounts');								
		//Вызываем шаблон
		$this->load->view('default/index',$data);
	}
	
	function edit_index()
	{
		$pos = (int) $this->uri->segment(3);
		$discount['dposition'] = $this->discount_model->get_discount_index_item($pos);
		if($discount['dposition']->di_dis_id==0)
		{
			$discount['pcategory'] = $this->discount_model->get_discount_category();
			//Готовим массив для передачи в шаблон
			$data['main_content'] = array(	'tpl'=>'main',
											'dash'=>array(	'dash_tpl'=>'discounts/discounts_edit_index',
														'data'=>'Дополнительно',
														'dash_content'=>$discount,
														'main_category'=>$this->main_menu																			
														)
										);
		}
		else
		{
			
			$discount['pcategory'] = $this->discount_model->get_discount_category();
			$discount['category']	= $this->discount_model->get_discount_category($discount['dposition']->dis_parentcat_id);
			$sql = " WHERE dis_cat_id =".$discount['dposition']->dis_cat_id;
			$discount['dislist']	= $this->discount_model->get_last_discount(0,$sql);
			
					//Готовим массив для передачи в шаблон
			$data['main_content'] = array(	'tpl'=>'main',
											'dash'=>array(	'dash_tpl'=>'discounts/discounts_edit_index',
														'data'=>'Дополнительно',
														'dash_content'=>$discount,
														'main_category'=>$this->main_menu																			
														)
										);
		}
		
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'discounts');								
		//Вызываем шаблон
		$this->load->view('default/index',$data);
	}
	
	function update_index()
	{
		$pos = (int) $this->uri->segment(3);
		//Проверка введенных данных			
		if($this->form_validation->run('discounts_index_update') === FALSE )
		{
			echo $this->form_validation->error_string;
			echo 'Заебали ошибки';
			
		}
		else
		{
			$dposition['di_position'] 	= $pos;
			$dposition['di_dis_id']		= $this->input->post('discount');
			$dposition['di_dis_start'] 	= cp_format_date($this->input->post('di_dis_start'),3).cp_format_date($this->input->post('di_dis_start'),2).cp_format_date($this->input->post('di_dis_start'),1);
			$dposition['di_dis_end'] 	= cp_format_date($this->input->post('di_dis_end'),3).cp_format_date($this->input->post('di_dis_end'),2).cp_format_date($this->input->post('di_dis_end'),1);
			$dposition['di_addtime']	= time();
			
			if($this->discount_model->discount_index_update($pos,$dposition) !== false)
			{
				
				$param = array('message'=>alert_successfull('Обновление ','индекса скидки')
							);	
							
				$this->show_index($param);			
				
			}
			else
			{
				$param = array('message'=>alert_fail('Обновление ',' скидки индекса')
							);
				$this->show_index($param);
			}
			
		}
		
		
	}
	
	function reset_index()
	{
		$pos = (int) $this->uri->segment(3);
		if($pos>5 OR $pos<1)
		{
			redirect('discounts/show_index');
		}
		else
		{
			$dposition['di_position'] 	= 0;
			$dposition['di_dis_id']		= 0;
			$dposition['di_dis_start'] 	= 0;
			$dposition['di_dis_end'] 	= 0;
			$dposition['di_addtime']	= time();
			if($this->discount_model->discount_index_update($pos,$dposition)!== false)
			{
				$param = array('message'=>alert_successfull('Сброс ','индекса скидки')
							);	
							
				$this->show_index($param);	
			}
			else
			{
				$param = array('message'=>alert_fail('Сброс ',' индекса')
							);
				$this->show_index($param);
			}	
		}
		
	}
	
	function add()
	{
		
			//проверка прав записи
		if(in_array('add_self',$this->user_action,TRUE))
		{
			
			
		}
		elseif(in_array('add',$this->user_action,TRUE))
		{
			
		}
		else
		{
			//Тут перенаправить на главную
			redirect('discounts/index');
		}
		$discount['pcategory'] 		= $this->discount_model->get_discount_category();
		$discount['objcategory']	= $this->object_model->get_object_category();
		$discount['type']		= $this->discount_model->get_discount_type();
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'discounts/discounts_add_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$discount,
														'main_category'=>$this->main_menu																			
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'discounts');								
		//Вызываем шаблон
		$this->load->view('default/index',$data);
	
	}
	
	function edit()
	{
		$id = (int) $this->uri->segment(3);
		
			//проверка права чтения
		if(in_array('edit_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			$user = $user['nick'];
		}
		elseif(in_array('edit',$this->user_action,TRUE))
		{
			$user = FALSE;
		}
		else
		{
			
		}
		
		$discount['detail']		= $this->discount_model->get_discount_by_id($id,'*',$user);
		if($discount['detail'] != false)
		{
			$discount['type']		= $this->discount_model->get_discount_type();
			$discount['pcat']		= $this->discount_model->get_discount_pcategory($discount['detail']->dis_cat_id);
			$discount['scategory']  = $this->discount_model->get_discount_category($discount['pcat']->dc_parent_id);
			$discount['pcategory']	= $this->discount_model->get_discount_category();
			$discount['objcategory']= $this->object_model->get_object_category();
			$discount['ocat']		= $this->object_model->get_category_of_object($discount['detail']->dis_obj_id);
			
			
			if($discount['detail']->dis_obj_id !=0)
			{
				$discount['objects'] = $this->object_model->get_object_list($discount['ocat'][0]->obj_categ);
			}
					
			//Готовим массив для передачи в шаблон
			$data['main_content'] = array(	'tpl'=>'main',
											'dash'=>array(	'dash_tpl'=>'discounts/discounts_edit_dashboard',
															'data'=>'Быстрый доступ',
															'dash_content'=>$discount,
															'main_category'=>$this->main_menu																			
															)
											);
		}
		else
		{
			//Грузим ошибку
			//Готовим массив для передачи в шаблон
			$data['main_content'] = array(	'tpl'=>'main',
											'dash'=>array(	'dash_tpl'=>'page_permission_denied',
															'data'=>'Быстрый доступ',
															'main_category'=>$this->main_menu																		
															)
											);
		}

		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'discounts');								
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function update()
	{
		

		
		$id = (int) $this->uri->segment(3);
		//Проверяем действие
		if($id !=0)//Обновление
		{
						//проверка прав записи
			if(in_array('edit_self',$this->user_action,TRUE))
			{
				//Получаем информацию о пользователе
				$user = $this->auth->getUser();
				//Заведомом указываем статус
				$discount['dis_status'] = 0;
				//Ник пользователя
				$discount['dis_user']	= $user['nick'];	
				$user = $user['nick'];
				
			}
			elseif(in_array('edit',$this->user_action,TRUE))
			{
				//Если админ или редактор - без ограничений
				$user = FALSE;
				$discount['dis_status'] = $this->input->post('show');	
			}
			else
			{
				
			}
			$action = 'UPDATE';
			$dir = $id;

		}
		else//Добавление
		{
					//проверка прав записи
			if(in_array('add_self',$this->user_action,TRUE))
			{
				//Получаем информацию о пользователе
				$user = $this->auth->getUser();
				//Заведомом указываем статус
				$discount['dis_status'] = 0;
				//Ник пользователя
				$discount['dis_user']	= $user['nick'];	
				
				
			}
			elseif(in_array('add',$this->user_action,TRUE))
			{
				//Если админ или редактор - без ограничений
				$user = FALSE;
				$discount['dis_status'] = $this->input->post('show');	
			}
			else
			{
				
			}
			
			$action = 'ADD';
			//Создаем временное название папки, пока не узнаем id скидки	
			$dir = md5($this->input->post('dis_name').date('his'));	
		}
		
		
		
		
		//Проверка введенных данных			
		if($this->form_validation->run('discounts_update') === FALSE )
		{
			echo $this->form_validation->error_string;
			echo 'Заебали ошибки';
			
		}
		else
		{
			$path = SDIR.'_files/discount/_logo/'.$dir;
			//Проверка на существование папки
			if(!is_dir($path))
			{
				umask('0000');
				mkdir($path,DIR_WRITE_MODE);
				chmod($path, DIR_WRITE_MODE);
			}
			
			if($_FILES)	//Если есть изображения
			{
				if($_FILES['LOGO']['name'] !='') //Если существует большое
				{		
											
					//Загружаем файл изображения во временную папку
					$config['upload_path'] = $path.'/';
					$config['allowed_types'] = 'jpg|gif';
					$config['max_size']	= '100';
					$config['max_width'] = '200';
					$config['max_height'] = '200';
					$config['file_name'] = cp_transliter($this->input->post('dis_name'));
					$config['overwrite'] = TRUE;
							
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('LOGO'))
					{
						//Получаем массив о загруженном файле
						$this->img_array =  $this->upload->data();
						
						
						if($action =='UPDATE')//Если id существует (обновление)
						{
							//Получаем название старого изображения
							$this->old_image = $this->discount_model->get_discount_by_id($id,'dis_img');
														
							if(@$this->old_image->dis_img !='')
							{
								if($this->img_array['file_name'] !==  $this->old_image->dis_img)//...совпадает ли новое имя со старым
								{
									//Если нет, то удаляем старое
									@unlink($config['upload_path'].$this->old_image->dis_img);
								}	
							}
							
						}

						$discount['dis_img']	= $this->img_array['file_name'];
					}
					else
					{
						echo $this->upload->display_errors();
					}
						
				}
				
				if($_FILES['MLOGO']['name'] !='')
				{		
											
					//Загружаем файл изображения
					$config['upload_path'] = $path.'/';
					$config['allowed_types'] = 'jpg|gif';
					$config['max_size']	= '100';
					$config['max_width'] = '200';
					$config['max_height'] = '200';
					$config['file_name'] = 'mini_'.cp_transliter($this->input->post('dis_name'));
					$config['overwrite'] = TRUE;
					
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('MLOGO'))
					{
						//Получаем массив о загруженном файле
						$this->img_array =  $this->upload->data();
						
						if($action =='UPDATE')
						{
							//Получаем название старого изображения
							$this->old_image = $this->discount_model->get_discount_by_id($id,'dis_imgmini');
							//...совпадает ли новое имя со старым
							
							if(@$this->old_image->dis_imgmini !='')
							{
								if($this->img_array['file_name'] !==  $this->old_image->dis_imgmini)
								{
									//Если нет, то удаляем старое
									@unlink($config['upload_path'].$this->old_image->dis_imgmini);
								}	
							}
							
						}


							
						//Если массив существует, то задаем элемент массива
						$discount['dis_imgmini']	= $this->img_array['file_name'];
					}
					else
					{
						echo $this->upload->display_errors();
					}
						
				}
			}
			//Проверяем массивы 
			//Адреса
			foreach($this->input->post('adres') as $key)
			{
				if($key !='')
				{
					$adres[] = $key;
				}
				
				
			}
			//Телефоны
			foreach($this->input->post('phone') as $key)
			{
				if($key !='')
				{
					$phone[] = $key;
				}
				
				
			}
			
			//Формируем из массивов строку с разделителем
			$adress_string 	= implode('|', $adres);
			$phone_string 	= implode('|', $phone);
			
			$discount['dis_name'] 		= addslashes($this->input->post('dis_name'));
			$discount['dis_cat_id'] 	= $this->input->post('scategory');
			$discount['dis_parentcat_id'] = $this->input->post('pcategory');
			
			//Если существует привязка к объекту
			if($this->input->post('object') !='')
			{
				//Вытаскиваем данные из свойств объекта
				$discount['dis_obj_id'] 	= $this->input->post('object');
				$object['data']				= $this->object_model->get_object_by_id('obj_ids,obj_email,obj_www, obj_img, obj_img_mini ',$discount['dis_obj_id']);
				$discount['dis_site']		= $object['data']->obj_www;
				$discount['dis_email']		= $object['data']->obj_email;
				$discount['dis_org']		= '';
				
				//Проверяем наличие загруженных логотипов, загрузка которых возможно только при редактировании
				
				if(!@$discount['dis_img'] AND $action=='ADD')
				{
					if($object['data']->obj_img)
					{
						copy(SDIR.'_object/logo/'.$object['data']->obj_ids.'/'.$object['data']->obj_img,SDIR.'_files/discount/_logo/'.$dir.'/'.$object['data']->obj_img);
						$discount['dis_img']	= $object['data']->obj_img;
					}
					else
					{
						$discount['dis_img']	= '';
					}
						
				}
				
				if(!@$discount['dis_imgmini'] AND $action=='ADD')
				{
					if($object['data']->obj_img_mini)
					{
						copy(SDIR.'_object/logo/'.$object['data']->obj_ids.'/'.$object['data']->obj_img_mini,SDIR.'_files/discount/_logo/'.$dir.'/'.$object['data']->obj_img_mini);
						$discount['dis_imgmini'] = $object['data']->obj_img_mini;
					}
					else
					{
						$discount['dis_imgmini'] = '';
					}
					
				}
				
				
			}
			else
			{
				$discount['dis_obj_id']		= 0;
				$discount['dis_email'] 		= $this->input->post('dis_email');
				$discount['dis_site']		= $this->input->post('dis_site');
				$discount['dis_org']		= addslashes($this->input->post('dis_org'));
			}
			
			
			
			
			$discount['dis_type'] 		= $this->input->post('dis_type');
			
			if($this->input->post('nointerval') != 'on')
			{
				$discount['dis_begin'] 		= cp_format_date($this->input->post('dis_begin'),3).cp_format_date($this->input->post('dis_begin'),2).cp_format_date($this->input->post('dis_begin'),1);
				$discount['dis_end'] 		= cp_format_date($this->input->post('dis_end'),3).cp_format_date($this->input->post('dis_end'),2).cp_format_date($this->input->post('dis_end'),1);
			
			}
			else
			{
				$discount['dis_begin'] 	= '0';
				$discount['dis_end'] 	= '0';
			}
			
			
			$discount['dis_gallery_id'] = ($this->input->post('dis_gallery') =='on') ? $id : '0';
					
			
			$discount['dis_amount'] 	= $this->input->post('dis_amount');
			$discount['dis_dim']		= $this->input->post('dis_item_type');
			
			$discount['dis_text'] 		= addslashes($this->input->post('dis_text'));
			$discount['dis_advtext'] 	= addslashes($this->input->post('dis_advtext'));
			$discount['dis_source']		= $this->input->post('dis_source');
			
			//$discount['dis_status']		= $this->input->post('show');
			$discount['dis_adress']		= addslashes($adress_string);
			$discount['dis_telephone'] 	= $phone_string;
			

			if($action == 'ADD')
			{
				
				$discount['dis_addtime']= time();
				if($this->discount_model->discount_insert($discount))
				{
					$id = $this->discount_model->get_last_id();
					//Переимновываем временное название папки в id
					rename(SDIR.'_files/discount/_logo/'.$dir, SDIR.'_files/discount/_logo/'.$id);
					
					$param = array('message'=>alert_successfull('Создание ',' скидки '.$discount['dis_name'])
								);
					$this->index($param);
					
				}
				else
				{
					$param = array('message'=>alert_fail('Создание ',' скидки '.$discount['dis_name'])
								);
					$this->index($param);
				}
				
			}
			elseif($action == 'UPDATE')
			{
				if($this->discount_model->discount_update($id,$discount,$user))
				{
					
					$param = array('message'=>alert_successfull('Обновление ',' скидки '.$discount['dis_name'])
								);	
								
					$this->index($param);			
					
				}
				else
				{
					$param = array('message'=>alert_fail('Обновление ',' скидки '.$discount['dis_name'])
								);
					$this->index($param);
				}
				
			}

			
			
		}
		
	}
	
	function delete()
	{
		$id = (int) $this->uri->segment(3);
		
		
			//проверка прав удаления
		if(in_array('del_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			
			$user	= $user['nick'];	
			
			
		}
		elseif(in_array('del',$this->user_action,TRUE))
		{
			$user = FALSE;
			
		}
		else
		{
			
		}
		//Путь до папки с файлами галлереи и логотипов
		$gallery = array('path'=>SDIR.'_files/discount/_gallery/'.$id.'/');
		$logotypes = array('path'=>SDIR.'_files/discount/_logo/'.$id.'/');
		
		if($this->discount_model->delete_discount_gallery($id) AND $this->discount_model->delete_discount($id,$user))
		{
			$this->discount_model->delete_discount_gallery_items($gallery);
			$this->discount_model->delete_discount_gallery_items($logotypes);
			
			@rmdir(SDIR.'_files/discount/_gallery/'.$id);
			@rmdir(SDIR.'_files/discount/_logo/'.$id);
			
			$data = array('message'=>alert_successfull('Удаление', 'скидки'));
		}
		else
		{
			$data = array('message'=>alert_fail('Удаление', 'скидки'));
		}
		
		$this->index($data);
		
		
	}
	
	function category($param='')
	{
			
		if(is_array($param))
		{
			$discount['message'] = $param['message'];
		}
		//Получаем данные
		//$discount['data'] 		= $this->discount_model->get_last_discount('30');
		$discount['category']	= $this->discount_model->get_discount_category();
	
		
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'discounts/discounts_list_category_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$discount,
														'main_category'=>$this->main_menu																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		//$this->output->enable_profiler(TRUE);
		//$this->output->cache(1);
		
	}
	

	function category_update()
	{
		$id = (int) $this->uri->segment(3);
		
		//Проверка данных
		if($this->form_validation->run('dis_cat_update') === FALSE)
		{
			
			echo 'Errors';
		}
		else
		{
			
			$category['dc_parent_id'] = $this->input->post('dc_parent_id');
			
			if($this->input->post('dc_cat_nick') =='')
			{
				$category['dc_cat_nick']	= cp_transliter($this->input->post('dc_cat_nick'));
			}
			else
			{
				$category['dc_cat_nick'] 	= $this->input->post('dc_cat_nick');
			}
			
			$category['dc_cat_name']	= $this->input->post('dc_cat_name');
			
			if($this->discount_model->category_update($id,$category))
			{
				$param = array(
				'message'=>alert_successfull('Обновление ',' категории '.$category['dc_cat_name'])
								);	
								
				$this->category($param);	
			}
			else
			{
				$param = array(
				'message'=>alert_fail('Обновление ',' категории '.$category['dc_cat_name'])
								);	
								
				$this->category($param);	
			}
		}

		
		
	}
	function category_edit()
	{
		
		$id = (int) $this->uri->segment(3);
		
		$category['detail'] = $this->discount_model->get_category_by_id($id);
		$category['pcategory'] = $this->discount_model->get_discount_category();
		//$category['scategory'] = $this->discount_model->get_discount		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'discounts/discounts_edit_category_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$category,
														'main_category'=>$this->main_menu																			
														)
										);
				//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'discounts');	
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
		
	}
	
	function category_add()
	{
		
		$category['pcategory'] = $this->discount_model->get_discount_category();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'discounts/discounts_add_category_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$category,
														'main_category'=>$this->main_menu																			
														)
										);
				//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array('jslibrary'=>'discounts');	
		//Вызываем шаблон
		$this->load->view('default/index',$data);	
	}
	
	function category_save()
	{
		//Проверка данных
		if($this->form_validation->run('dis_cat_update') === FALSE)
		{
			
			echo 'Errors';
		}
		else
		{
			//Категория 
			$category['dc_parent_id'] = $this->input->post('dc_parent_id');
			
			//Ник
			if($this->input->post('dc_cat_nick') =='')
			{
				$category['dc_cat_nick']	= cp_transliter($this->input->post('dc_cat_nick'));
			}
			else
			{
				$category['dc_cat_nick'] 	= $this->input->post('dc_cat_nick');
			}
			//Название
			$category['dc_cat_name']	= $this->input->post('dc_cat_name');
			
			
			if($this->discount_model->category_add($category))
			{
				$param = array(
				'message'=>alert_successfull('Создание ',' категории '.$category['dc_cat_name'])
								);	
								
				$this->category($param);	
			}
			else
			{
				$param = array(
				'message'=>alert_fail('Создание ',' категории '.$category['dc_cat_name'])
								);	
								
				$this->category($param);	
			}
			
				
			
		}
		
		
	}
	
	function category_delete()
	{
		
		
	}
	
	function discount_types()
	{
		
	}
	
	function discount_types_add()
	{
		
	}
	
	function ajax()
	{
		if($this->input->post('action')=='setsubcategory')
		{
			$data = $this->discount_model->get_discount_category($this->input->post('id'));
			$answer[] = array('id'=>'','name'=>'Выбрать');
			foreach($data as $row)
			{
				$answer[] = array('id'=>$row->dc_cat_id,'name'=>strip_tags(stripslashes($row->dc_cat_name)));
			}
			
			header('Content-type: application/json');
	
			echo json_encode($answer);	
		}
		
		if($this->input->post('action')=='setdiscount')
		{
			$sql = " WHERE dis_cat_id=".$this->input->post('id');
			$data = $this->discount_model->get_last_discount(0,$sql);
			
			
			foreach($data as $row)
			{
				
				$answer[] = array('id'=>$row->dis_id,'name'=>stripslashes($row->obj_nam).' ['.strip_tags(stripslashes($row->dis_name)).' '.$row->dis_amount.'%]');
			}
			
			header('Content-type: application/json');
	
			echo json_encode($answer);	
		}
		
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
		if($this->input->post('action')=='setlogotypes')
		{
			$id = $this->input->post('id');
			$object['data'] = $this->object_model->get_object_by_id('obj_img,obj_ids, obj_img_mini',$id);
			$this->load->view('default/template/discounts/discounts_logo_block',$object);
			
		}
		
		
		
	}
}


?>