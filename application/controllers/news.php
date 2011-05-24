<?php 

class News extends Controller
{
	protected $user_action;	
	protected $main_menu;
	
	function __construct()
	{
		parent::Controller();
		
		if ($this->auth->isAuthorised() == false )
		{
			redirect('login');
		}
		
		$this->user_action = $this->auth->myRights(strtolower(__CLASS__));
		
		$user = $this->auth->getUser();
		$user = ($user['class']=='admin' || $user['class']=='redactor' || $user['class']=='manager') ? FALSE : $user['nick'];
		$this->main_menu = $this->index_model->get_list_category($user);
		
	}

	
	function index($param= '')
	{	
		
		//проверка права чтения
		if(in_array('view_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			$user = $user['nick'];
		}
		elseif(in_array('view',$this->user_action,TRUE))
		{
			$user = FALSE;
		}
		else
		{
			
		}
		
		
		//print_r($user);
		if(is_array($param))
		{
			$news['message'] = $param['message'];
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
		$config['base_url'] = base_url().'news/index/page/';
		$config['total_rows'] = $this->news_model->get_total_news(false,$user);


		//пнициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(4))? $this->uri->segment(4):'0';
		
		//Получаем данные
		$news['data'] = $this->news_model->get_last_news($offset,$user);
		$news['category'] = $this->news_model->get_news_category();
		$news['pages'] =  $this->pagination->create_links();
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'news');
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'news/news_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$news,
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
		}
		elseif(in_array('view',$this->user_action,TRUE))
		{
			$user = FALSE;
		}
		else
		{
			
		}
		$id = (int)$this->uri->segment(3);
		//Подключаем библиотеку пагинации
		$this->load->library('pagination');
		//КОнфигурируем
		$config['per_page'] = '20'; 
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['uri_segment'] = '5';
		$config['base_url'] = base_url().'news/show_category/'.$id.'/page/';
		$config['total_rows'] = $this->news_model->get_total_news($id,$user);
		
		//пнициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(5))? $this->uri->segment(5):'0';
		//Получаем данные
		$news['data'] = $this->news_model->get_last_news_by_categ($id,$offset,$user);
		$news['category'] = $this->news_model->get_news_category();
		$news['pages'] =  $this->pagination->create_links();
		
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'news');
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'news/news_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$news,
														'main_category'=>$this->main_menu																				
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function search()
	{
		$word = $this->input->post('search_node');
		
		$news['data']	  = $this->news_model->search_news($word);	
		
		
		$news['category'] = $this->news_model->get_news_category();
		$news['pages'] =  '';
		
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'news');
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'news/news_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$news,
														'main_category'=>$this->main_menu																				
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function add()
	{
		
		//Получаем данные
		$news['category'] = $this->news_model->get_news_category();
		$news['objcategory'] = $this->object_model->get_object_category();
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'news/news_add_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$news,
														'main_category'=>$this->main_menu																				
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'news');						
		
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
		//Получаем данные
		$news['data'] 			= $this->news_model->get_news_by_id($id,$user);
		
		//Если новость найдена
		if($news['data'] != false) 
		{ 
			$news['category'] 		= $this->news_model->get_news_category();
			$news['objcategory'] 	= $this->object_model->get_object_category();
			//Определяем вид спорта, если он указан
			if($news['data']->new_sportid AND $news['data']->new_sportid !=0)
			{
				$news['sport']	= $this->sport_model->get_sport('sp_ids,sp_name');
			}
			else
			{
				$news['sport']	= FALSE;
			}
			
			//Определяем категорию объекта, если он указан в новости
			if($news['data']->new_objid AND $news['data']->new_objid !=0)
			{
				
				$category				= $this->object_model->get_category_of_object($news['data']->new_objid);
				$news['objectlist']		= $this->object_model->get_object_list($category[0]->obj_categ);	
				$news['categoryofobject'] = $category[0]->obj_categ;
			}
			else
			{
				$news['objectlist'] = FALSE;
			}
			
			
	
			//Готовим массив для передачи в шаблон
			$data['main_content'] = array(	'tpl'=>'main',
											'dash'=>array(	'dash_tpl'=>'news/news_edit_dashboard',
															'data'=>'Быстрый доступ',
															'dash_content'=>$news,
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
		$data['head_content'] = array(	'jslibrary'=>'news'	
										);	
		$this->load->view('default/index',$data);
	}
	
	function update()
	{
		
		//проверка прав записи
		if(in_array('edit_self',$this->user_action,TRUE))
		{
			//Получаем информацию о пользователе
			$user = $this->auth->getUser();
			//Заведомом указываем статус
			$data['new_status'] = 1;
			//Ник пользователя
			$data['new_user']	= $user['nick'];	
			
		}
		elseif(in_array('edit',$this->user_action,TRUE))
		{
			//Если админ или редактор - без ограничений
			$user = FALSE;
			$data['new_status'] = $this->input->post('new_status');	
		}
		else
		{
			
		}
		$id = (int) $this->uri->segment(3);
		
		//Проверяем введенные данные 
		if($this->form_validation->run('update') == FALSE)
		{
			
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			$this->edit();	
		}
		else
		{

			//Загрузка файла, если был
			if($_FILES['NEWS_LOGO']['name'] != '')
			{
				//Загружаем файл изображения
				$config['upload_path'] = SDIR.'img/news/';
				$config['allowed_types'] = 'jpg';
				$config['max_size']	= '100';
				$config['max_width'] = '200';
				$config['max_height'] = '200';
				$config['file_name'] = cp_transliter($this->input->post('new_name'));
				$config['overwrite'] = TRUE;
				
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('NEWS_LOGO'))
				{
					$this->img_array =  $this->upload->data();
					//Если изображение загружено, проверяем ...
					
					$this->old_image = $this->news_model->get_news_by_id($id);
					
					//...совпадает ли новое имя со старым
					if($this->img_array['file_name'] !==  $this->old_image->new_img)
					{
						//Если нет, то удаляем старое
						unlink($config['upload_path'].$this->old_image->new_img);
					}
						
					//Если массив существует, то задаем элемент массива
					$data['new_img']	= $this->img_array['orig_name'];
				}
				
				
			}
			
			
				//Составляем массив данных для записи в таблицу
				 
				$data['new_name'] 	= addslashes($this->input->post('new_name'));
				$data['new_type'] 	= $this->input->post('new_type');
				$data['new_objid'] 	= $this->input->post('new_object');
				$data['new_sportid']= $this->input->post('new_sportid');
				$data['new_txt'] 	= addslashes($this->input->post('new_preview'));
				$data['new_txt2']	= addslashes($this->input->post('new_fulltext'));
				$data['new_addate_y'] = cp_format_date($this->input->post('new_date'),3);
				$data['new_addate_m'] = cp_format_date($this->input->post('new_date'),2);
				$data['new_addate_d'] = cp_format_date($this->input->post('new_date'),1);	
				$data['new_st_y'] 	= cp_format_date($this->input->post('new_date'),3);
				$data['new_st_m'] 	= cp_format_date($this->input->post('new_date'),2);
				$data['new_st_d'] 	= cp_format_date($this->input->post('new_date'),1);
				//$data['new_status'] = $this->input->post('new_status');	
				
				if($this->news_model->update_news($id,$data) == FALSE)
				{
					//Уведомить об ошибке
						//Уведомить об ошибке
					$param = array('message'=>alert_fail('Обновление ',' новости '.stripcslashes(trim($this->input->post('new_name'))))
								);	
								
					$this->index($param);
				}
				else
				{
					$param = array('message'=>alert_successfull('Обновление ',' новости '.stripcslashes(trim($this->input->post('new_name'))))
								);	
								
					$this->index($param);					
				}	
		}
		
	
	}
	
	function save()
	{
		
		//проверка прав записи
		if(in_array('add_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			$data['new_status'] = 1;
			$data['new_user']	= $user['nick'];	
			
		}
		elseif(in_array('add',$this->user_action,TRUE))
		{
			$user = FALSE;
			$data['new_status'] = $this->input->post('new_status');	
		}
		else
		{
			//Тут перенаправить на главную
			
		}
		//Проверяем введенные данные 
		if($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			$this->add();
		}
		else
		{
			
			//Загружаем файл изображения
			$config['upload_path'] = SDIR.'img/news/';
			$config['allowed_types'] = 'jpg';
			$config['max_size']	= '100';
			$config['max_width'] = '200';
			$config['max_height'] = '200';
			$config['file_name'] = cp_transliter($this->input->post('new_name'));
			$config['overwrite'] = TRUE;
			
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('NEWS_LOGO') == FALSE)
			{
				$this->upload->display_errors('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
				$error = array('error' => $this->upload->display_errors());
				echo 'File upload errors';
				
			}
			else
			{
				$this->img_array =  $this->upload->data();
				
				//Составляем массив данных для записи в таблицу
				$data['new_name'] 	= addslashes(trim($this->input->post('new_name')));
				$data['new_type'] 	= $this->input->post('new_type');
				$data['new_objid'] 	= $this->input->post('new_object');
				$data['new_sportid']= $this->input->post('new_sportid');
				$data['new_txt'] 	= trim($this->input->post('new_preview'));
				$data['new_txt2']	= trim($this->input->post('new_fulltext'));
				$data['new_img']	= $this->img_array['orig_name'];
				$data['new_addate_y'] = cp_format_date($this->input->post('new_date'),3);
				$data['new_addate_m'] = cp_format_date($this->input->post('new_date'),2);
				$data['new_addate_d'] = cp_format_date($this->input->post('new_date'),1);	
				$data['new_st_y'] 	= cp_format_date($this->input->post('new_date'),3);
				$data['new_st_m'] 	= cp_format_date($this->input->post('new_date'),2);
				$data['new_st_d'] 	= cp_format_date($this->input->post('new_date'),1);
				//$data['new_status'] = $this->input->post('new_status');		
				
				if($this->news_model->insert_news($data) == FALSE)
				{
					//Уведомить об ошибке
					$param = array('message'=>alert_fail('Создание ',' новости '.addslashes(trim($this->input->post('new_name'))))
								);	
								
					$this->index($param);
				}
				else
				{
					
					$param = array('message'=>alert_successfull('Создание ',' новости '.addslashes(trim($this->input->post('new_name'))))
								);	
								
					$this->index($param);	
									
				}				
				
			}

			

			
		}
		
	}
	
	function delete()
	{
		$id = (int)$this->uri->segment(3);
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
		//Проверяем наличие новости в базе
		if($this->news_model->get_news_by_id($id,$user) !== FALSE)
		{
			$news = $this->news_model->get_news_by_id($id);
			//Удаляем файл 
			$filename = 'img/news/'.$news->new_img;
			$this->news_model->delete_file($filename);

			//Удаляем новость 
			if($this->news_model->delete_news($id,$user))
			{
				$this->message = '<div id="success" class="info_div"><span class="ico_success">Новость удалена</span></div>';
				$this->index($this->message);
			}
			else 
			{
				$this->message = '<div id="fail" class="info_div"><span class="ico_cancel">Невозможно удалить. Обратитесь к программисту</span></div>';
				$this->index($this->message);
			}
		}
		else
		{
			redirect('news/index');
		}
		
	}
	
	function category($message = '')
	{
		//Существует ли категория
		if($this->news_model->get_news_category() !== FALSE)
		{
			//Проверка параметра
			if($message)
			{
				$news['message'] = $message;
			}
			//Массив данных
			$news['category'] = $this->news_model->get_news_category();
			//Готовим массив для передачи в шаблон
			$data['main_content'] = array(	'tpl'=>'main',
											'dash'=>array(	'dash_tpl'=>'news/news_category_dashboard',
															'data'=>'Быстрый доступ',
															'dash_content'=>$news,
															'main_category'=>$this->main_menu																				
															)
										);
			//Вызываем шаблон
			$this->load->view('default/index',$data);
			
		}
		else
		{
			
		}
		
	}
	
	function category_save()
	{
		//Проверяем введенные данные
		if($this->form_validation->run() === FALSE)
		{
			
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			$this->category();
		}
		else
		{
			//Массив данных
			$data['newc_name'] = addslashes($this->input->post('new_category'));
			$data['newc_type'] = 'temporary';
			
			//Вставляем в таблицу
			if($this->news_model->insert_category($data))
			{
				//Создаем переменную и вызываем метод с параметром
				$message = '<div id="success" class="info_div"><span class="ico_success">категория добавлена</span></div>';
				$this->category($message);
			}
			else
			{
				//Создаем переменную и вызываем метод с параметром
				$message = '<div id="fail" class="info_div"><span class="ico_cancel">Невозможно добавить. Обратитесь к программисту</span></div>';
				$this->category($message);
			}
		}
		
	}
	
	function category_edit()
	{
		$category['data'] = $this->news_model->get_category_by_id($this->uri->segment(3));
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'news/news_category_edit_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$category,
														'main_category'=>$this->main_menu																				
														)
										);
										
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'news'	
										);	
		$this->load->view('default/index',$data);
		
	}
	
	function category_update()
	{
		//Проверяем введенные данные 
		if($this->form_validation->run('category_update') == FALSE)
		{
			echo 'Some problem';
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			$this->category_edit();	
		}
		else
		{
			$data['newc_name'] = $this->input->post('cat_name');
			$data['newc_name2']= $this->input->post('cat_name2');
			
			if($this->news_model->category_update($data))
			{
				$message = '<div id="success" class="info_div"><span class="ico_success">Категория обновлена</span></div>';
				$this->category($message);	
			}
			else
			{
				$message = '<div id="fail" class="info_div"><span class="ico_cancel">Невозможно обновить. Обратитесь к программисту</span></div>';
				$this->category($message);
			}
		}	
	}
	
	function category_delete()
	{
		if($this->news_model->get_category_by_id($this->uri->segment(3)) !== FALSE)
		{
			//Удаляем новость 
			if($this->news_model->delete_category())
			{
				$this->message = '<div id="success" class="info_div"><span class="ico_success">Категория удалена</span></div>';
				$this->category($this->message);	
			}
			else
			{
				$this->message = '<div id="fail" class="info_div"><span class="ico_cancel">Невозможно удалить категорию. Обратитесь к программисту</span></div>';
				$this->category($this->message);
			}
		}
		else
		{
			redirect('news/category');
		}
		
	}
	
	public function ajax()
	{
	
			return $this->ajaxobjectsload();
	
		
		
	}
	
	protected function ajaxobjectsload()
	{
		if($this->input->post('category'))
		{
			$data = $this->object_model->get_object_list($this->input->post('category'));
			
			foreach($data as $row)
			{
				$answer[] = array('id'=>$row->obj_ids,'name'=>strip_tags(stripslashes($row->obj_nam)));
			}
			
			header('Content-type: application/json');
	
			echo json_encode($answer);	
		}	
		
		elseif($this->input->post('newscategory'))
		{
			$data = $this->sport_model->get_sport('sp_ids,sp_name');
			
			foreach($data as $row)
			{
				$answer[] = array('id'=>$row->sp_ids,'name'=>strip_tags(stripslashes($row->sp_name)));
			}
			
			header('Content-type: application/json');
	
			echo json_encode($answer);	
		}
		
		else
		{
			return false;
		}	

	}
	
	
}



?>