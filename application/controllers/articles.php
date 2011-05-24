<?php 

class Articles extends Controller
{
	protected $user_action;	
	function __construct()
	{
		parent::Controller();
				
		if ($this->auth->isAuthorised() == false )
		{
			redirect('login');
		}
		$this->load->model('articles_model');
		$this->user_action = $this->auth->myRights(strtolower(__CLASS__));
		$user = $this->auth->getUser();
		$user = ($user['class']=='admin' || $user['class']=='redactor' || $user['class']=='manager') ? FALSE : $user['nick'];
		$this->main_menu = $this->index_model->get_list_category($user);
		
	}
	
	function index($param='')
	{
	

		if(is_array($param))
		{
			$articles['message'] = $param['message'];
		}
		
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
		
		//Подключаем библиотеку пагинации
		$this->load->library('pagination');
		//КОнфигурируем
		$config['per_page'] = '20'; 
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['uri_segment'] = '4';
		$config['base_url'] = base_url().'articles/index/page/';
		$config['total_rows'] = $this->articles_model->get_total_articles(false,$user);


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(4))? $this->uri->segment(4):'0';
		//Получаем данные
		$articles['data'] 		= $this->articles_model->get_last_articles($offset,$user);
		$articles['category'] 	= $this->articles_model->get_articles_category();
		$articles['pages']		= $this->pagination->create_links();
		
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'articles');
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'articles/articles_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$articles,
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
		
		$type = $this->uri->segment(3);
		//Подключаем библиотеку пагинации
		$this->load->library('pagination');
		//КОнфигурируем
		$config['per_page'] = '20'; 
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['uri_segment'] = '5';
		$config['base_url'] = base_url().'articles/show_category/'.$type.'/page/';
		$config['total_rows'] = $this->articles_model->get_total_articles($type,$user);
		
		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(5))? $this->uri->segment(5):'0';
		//Получаем данные
		$articles['data'] 		= $this->articles_model->get_articles_by_categ($type,$offset,$user);
		$articles['category'] 	= $this->articles_model->get_articles_category();
		$articles['pages']		= $this->pagination->create_links();
		
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'articles');
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'articles/articles_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$articles,
														'main_category'=>$this->main_menu																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	
	function search()
	{
		$word = addslashes($this->input->post('search_node'));
		//Получаем данные
		$articles['data'] 		= $this->articles_model->search_articles($word);
		$articles['category'] 	= $this->articles_model->get_articles_category();
		$articles['pages']		= '';
		
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'articles');
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'articles/articles_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$articles,
														'main_category'=>$this->main_menu																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
		
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
			redirect('articles/index');
		}
		
		//Получаем данные
		$articles['category'] = $this->articles_model->get_articles_category();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'articles/articles_add_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$articles,
														'main_category'=>$this->main_menu																			
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'articles');						
		
		$this->load->view('default/index',$data);
			
	}
	
	function save()
	{
		
		//проверка прав записи
		if(in_array('add_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			$data['art_status'] = 1;
			$data['user']	= $user['nick'];	
			
		}
		elseif(in_array('add',$this->user_action,TRUE))
		{
			$user = FALSE;
			$data['art_status'] = 2;	
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
			$config['upload_path'] = SDIR.'img/articles/';
			$config['allowed_types'] = 'jpg';
			$config['max_size']	= '100';
			$config['max_width'] = '400';
			$config['max_height'] = '400';
			$config['file_name'] = date("Ymd").'_'.cp_transliter($this->input->post('art_name'));
			$config['overwrite'] = TRUE;
			
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('ART_LOGO') == FALSE)
			{
				$this->upload->display_errors('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
				$error = array('error' => $this->upload->display_errors());
				echo 'File upload errors';
				
			}
			else
			{
				$this->img_array =  $this->upload->data();
				
				//Составляем массив данных для записи в таблицу
				$data['topic'] 	= addslashes(trim($this->input->post('art_name')));
				$data['type'] 	= $this->input->post('art_type');

				$data['article']	= trim($this->input->post('art_fulltext'));
				$data['img_url']	= $this->img_array['orig_name'];
				$data['date']	= cp_format_date($this->input->post('art_date'),3).cp_format_date($this->input->post('art_date'),2).cp_format_date($this->input->post('art_date'),1);
				$data['views'] 	= 0;
				//$data['art_status'] = 2;
				$data['site'] = $this->input->post('art_source');		
				
				if($this->articles_model->insert_articles($data) == FALSE)
				{
					//Уведомить об ошибке
					$param = array('message'=>alert_fail('Создание ',' статьи '.$data['art_topic'])
								);
					$this->index($param);
				}
				else
				{
					$param = array('message'=>alert_successfull('Создание ',' статьи '.$data['art_topic'])
								);
					$this->index($param);
					
				}				
				
			}
				
		}
		
	}
	
	function edit()
	{
		//проверка прав записи
		if(in_array('add_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			$user	= $user['nick'];	
			
		}
		elseif(in_array('add',$this->user_action,TRUE))
		{
			$user = FALSE;
			
		}
		else
		{
			//Тут перенаправить на главную
			redirect('articles/index');
		}
		
		$id = (int)$this->uri->segment(3);
				//Получаем данные
		$articles['data'] 			= $this->articles_model->get_articles_by_id($id,$user);
		
		if($articles['data'] != false)
		{
			$articles['category'] 		= $this->articles_model->get_articles_category();
			//Готовим массив для передачи в шаблон
			$data['main_content'] = array(	'tpl'=>'main',
											'dash'=>array(	'dash_tpl'=>'articles/articles_edit_dashboard',
															'data'=>'Быстрый доступ',
															'dash_content'=>$articles,
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
		$data['head_content'] = array(	'jslibrary'=>'articles'	
										);	
		$this->load->view('default/index',$data);
	}
	
	function update()
	{
		
		//проверка прав записи
		if(in_array('add_self',$this->user_action,TRUE))
		{
			$user = $this->auth->getUser();
			$data['art_status'] = 1;
			$data['user']	= $user['nick'];	
			$user = $user['nick'];
			
		}
		elseif(in_array('add',$this->user_action,TRUE))
		{
			$user = FALSE;
			$data['art_status'] = $this->input->post('new_status');	
		}
		else
		{
			//Тут перенаправить на главную
			
		}
		
		$id = (int)$this->uri->segment(3); 
		
		$action = ($id != 0)? "UPDATE": "ADD";
		
		//Проверяем введенные данные 
		if($this->form_validation->run('art_update') == FALSE)
		{
			
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			
			($id != 0)? $this->edit(): $this->add();
				
		}
		else
		{
			
			//Загрузка файла, если был
			if($_FILES['ART_LOGO']['name'] != '')
			{
				//Загружаем файл изображения
				$config['upload_path'] = SDIR.'img/articles/';
				$config['allowed_types'] = 'jpg';
				$config['max_size']	= '100';
				$config['max_width'] = '400';
				$config['max_height'] = '400';
				$config['file_name'] = date("Ymd").'_'.cp_transliter($this->input->post('art_name'));
				$config['overwrite'] = TRUE;
				
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('ART_LOGO'))
				{
					$this->img_array =  $this->upload->data();
					//Если изображение загружено, проверяем ...
					
					if($action == 'UPDATE')
					{
						$this->old_image = $this->articles_model->get_articles_by_id($id);
						
						//...совпадает ли новое имя со старым
						if($this->img_array['file_name'] !==  $this->old_image->img_url)
						{
							//Если нет, то удаляем старое
							unlink($config['upload_path'].$this->old_image->img_url);
						}	
					}
					
						
					//Если массив существует, то задаем элемент массива
					$data['img_url']	= $this->img_array['file_name'];
				}
				
				
			}
			
				//Составляем массив данных для записи в таблицу
				$data['topic'] 	= addslashes(trim($this->input->post('art_name')));
				$data['type'] 	= $this->input->post('art_type');
				$data['article']	= trim($this->input->post('art_fulltext'));
				$data['date']	= cp_format_date($this->input->post('art_date'),3).cp_format_date($this->input->post('art_date'),2).cp_format_date($this->input->post('art_date'),1);
				
				//$data['art_status'] = $this->input->post('art_status');
				$data['site'] = $this->input->post('art_source');	
				
				
				if($action == "UPDATE")
				{
					if($this->articles_model->update_articles($id,$data,$user) == FALSE)
					{
						//Уведомить об ошибке
						$param = array('message'=>alert_fail('Обновление ',' статьи '.$this->input->post('art_name')));
						$this->index($param);
					}
					else
					{
						$param = array('message'=>alert_successfull('Обновление ',' статьи '.$this->input->post('art_name'))
								);
						$this->index($param);
				
					}
				}
				elseif($action == "ADD")
				{
					
					
					if($this->articles_model->insert_articles($data) == FALSE)
					{
						//Уведомить об ошибке
						$param = array('message'=>alert_fail('Создание ',' статьи '.$this->input->post('art_name'))
									);
						$this->index($param);
					}
					else
					{
						$param = array('message'=>alert_successfull('Создание ',' статьи '.$this->input->post('art_name'))
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
		elseif(in_array('add',$this->user_action,TRUE))
		{
			$user = FALSE;
			
		}
		else
		{
			redirect('articles/index');
		}
		//Проверяем наличие статьи в базе
		if($this->articles_model->get_articles_by_id($id,$user) !== FALSE)
		{
			$articles = $this->articles_model->get_articles_by_id($id,$user);
			//Удаялем файл 
			$filename = SDIR.'img/articles/'.$articles->img_url;
			$this->articles_model->delete_file($filename);

			//Удаляем новость 
			if($this->articles_model->delete_articles($id,$user))
			{
				$this->message = '<div id="success" class="info_div"><span class="ico_success">Статья удалена</span></div>';
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
			redirect('articles/index');
		}
	}
	
	function category($message = '')
	{
		//Существует ли категория
		if($this->articles_model->get_articles_category() !== FALSE)
		{
			//Проверка параметра
			if($message)
			{
				$articles['message'] = $message;
			}
			//Массив данных
			$articles['category'] = $this->articles_model->get_articles_category();
			//Готовим массив для передачи в шаблон
			$data['main_content'] = array(	'tpl'=>'main',
											'dash'=>array(	'dash_tpl'=>'articles/articles_category_dashboard',
															'data'=>'Быстрый доступ',
															'dash_content'=>$articles,
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
			$data['ac_type'] = cp_transliter($this->input->post('art_category'));
			$data['ac_name'] = addslashes($this->input->post('art_category'));
			$data['ac_privilegue'] = 'temporary';
			//Вставляем в таблицу
			if($this->articles_model->insert_category($data))
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
		$category['data'] = $this->articles_model->get_category_by_id($this->uri->segment(3));
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'articles/articles_category_edit_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$category,
														'main_category'=>$this->main_menu																			
														)
										);
										
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'articles'	
										);	
		$this->load->view('default/index',$data);
		
	}
	
	function category_update()
	{
		//Проверяем введенные данные 
		if($this->form_validation->run('art_category_update') == FALSE)
		{
			//echo 'Some problem';
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			$this->category_edit();	
		}
		else
		{
			$data['ac_name'] = $this->input->post('cat_name');
			$data['ac_type'] = $this->input->post('cat_name2');
			
			
			if($this->articles_model->category_update($data))
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
		if($this->articles_model->get_category_by_id($this->uri->segment(3)) !== FALSE)
		{
			//Удаляем новость 
			if($this->articles_model->delete_category())
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
			redirect('articles/category');
		}
		
	}
	
	
}