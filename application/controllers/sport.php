<?php


class Sport extends Controller
{
	function __construct()
	{
		parent::Controller();
		
		if ($this->auth->isAuthorised() == false )
		{
			redirect('login');
		}
		
	}
	
	function index($param='')
	{
		
		if(is_array($param))
		{
			$sport['message'] = $param['message'];
		}
		//Получаем данные
		$sport['data'] = $this->sport_model->get_sport();
		
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'sport/sport_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$sport																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function add()
	{
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'sport/sport_add_dashboard',
														'data'=>'Быстрый доступ'																		
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'sport'		
										);						
		
		$this->load->view('default/index',$data);
		
		
	}
	
	function edit()
	{
		
		$sport['detail']= $this->sport_model->get_sport_by_id($this->uri->segment(3));
		$sport['seo']	= $this->sport_model->get_seo_of_sport();
		$sport['stat']	= $this->sport_model->get_sport_stat();
		
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'sport/sport_edit_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$sport																			
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'sport'		
										);						
		
		$this->load->view('default/index',$data);
		
	}
	
	function update()
	{
		$id = (int) $this->uri->segment(3);
		//Проверяем существет ли запись в базе
		if($this->sport_model->get_sport_by_id($id,'sp_ids'))
		{
			$action = 'UPDATE'; //Если да, то производиться обновение
		}
		else
		{
			$action = 'ADD'; //Иначе добавляем
		}
		
		if($this->form_validation->run('sport_update') === FALSE)
		{
			
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			$this->edit();	//Доделать!!!
		}
		else
		{
			if($_FILES)
			{
				if($_FILES['LOGO']['name'] !='')
				{
					
								
					//Загружаем файл изображения
					$config['upload_path'] = '_sport/logo/';
					$config['allowed_types'] = 'jpg|gif';
					$config['max_size']	= '100';
					$config['max_width'] = '200';
					$config['max_height'] = '200';
					$config['file_name'] = cp_transliter($this->input->post('sp_name'));
					$config['overwrite'] = TRUE;
					
									
					//Проверка на существование папки
					if(!is_dir($config['upload_path']))
					{
						mkdir($config['upload_path']);
					}
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('LOGO'))
					{
						$this->img_array =  $this->upload->data();
						
						
						$this->old_image = $this->sport_model->get_sport_by_id($id,'sp_img');
						//...совпадает ли новое имя со старым
						
						if(@$this->old_image->sp_img !='')
						{
							if($this->img_array['file_name'] !==  $this->old_image->sp_img)
							{
								//Если нет, то удаляем старое
								@unlink($config['upload_path'].$this->old_image->sp_img);
							}	
						}
						

							
						//Если массив существует, то задаем элемент массива
						$sport['sp_img']	= $this->img_array['file_name'];
					}
					else
					{
						echo $this->upload->display_errors();
					}
						
				}
				
			}
			
			$sport['sp_name']	= $this->input->post('sp_name');
			$sport['sp_txt'] 	= $this->input->post('sp_txt');
			$sport['sp_transl']	= $this->input->post('sp_transl');
			
			//СЕО
			$seo['par_tile'] = $this->input->post('par_tile');
			$seo['par_keywords'] = strip_tags($this->input->post('par_keywords'));
			$seo['par_description'] = addslashes(strip_tags($this->input->post('par_description')));
			
			
			//Подменю спорта
			for($i=1;$i<6;$i++)
			{
				if($this->input->post('sp_'.$i.'') == 'on')
				{
					$sport['sp_'.$i.'']  = '1';
				}
				else
				{
					$sport['sp_'.$i.'']  = '0';
				}
				
			}
			//Показатели счетчиков
			$stat['cou_type'] = 'SPORT';
			$stat['cou_v'] = $this->input->post('cou_v');
			$stat['cou_vd'] = $this->input->post('cou_vd');
			
			if($action == 'UPDATE')
			{
				
				if($this->sport_model->get_seo_of_sport())
				{
					//Обновляем СЕО-объекта
					$this->sport_model->update_sport_seo($id,$seo);
				}	
				else
				{
					$seo['par_sportid']		= $id;
					$this->sport_model->insert_sport_seo($seo);
				}

				
				//Обновляем статистику
				$this->sport_model->update_sport_stat($id,$stat);
				
		
				//Обновляем основную информацию объекта
				if($this->sport_model->sport_update($id,$sport))
				{
					$param = array(
								'message'=>alert_successfull('Обновление',' спорта '.$sport['sp_name'])
								);
					$this->index($param);
				}
				else
				{
					$param = array(
								'message'=>alert_fail('Обновление',' спорта '.$sport['sp_name'])
								);
					$this->index($param);
				}
				
			}
			if($action == "ADD")
			{		
				//Добавляем основную информацию о спорте
				if($this->sport_model->sport_insert($sport))
				{
					//Получаем последний id
					$id = $this->sport_model->get_last_id();
					//Добавляем статистику
					$stat['cou_for'] = $id;
					$stat['cou_date'] = date("Y-m-d");
					$this->sport_model->insert_sport_stat($stat);
					
					//Добавляем СЕО-объекта
					 
					$seo['par_sportid']	= $id;	
					$this->sport_model->insert_sport_seo($seo);
					
					$param = array(
								'message'=>alert_successfull('Создание ',' спорта '.$sport['sp_name'])
								);
					$this->index($param);
				}
				else
				{
					$param = array(
								'message'=>alert_fail('Создание ',' спорта '.$sport['sp_name'])
								);
					$this->index($param);
				}
			}

			
			
		}
		
	}
	
	function competition($param='')
	{
		if(is_array($param))
		{
			
			$sport['message'] = $param['message'];
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
		$config['base_url'] = base_url().'sport/competition/page/';
		$config['total_rows'] = $this->sport_model->get_total_competition();


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(4))? $this->uri->segment(4):'0';
		
		$this->load->library('pagination');
		
		//Получаем данные
		$sport['competit'] 	= $this->sport_model->get_sport_competition($offset);
		$sport['pages'] 	=  $this->pagination->create_links();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'sport/competition_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$sport																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function show_competition_category()
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
		$config['base_url'] = base_url().'sport/show_competition_category/'.$id.'/page/';
		$config['total_rows'] = $this->sport_model->get_total_competition($id);


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(5))? $this->uri->segment(5):'0';
		
		$this->load->library('pagination');	
		
		//Получаем данные
		$sport['competit'] 	= $this->sport_model->get_sport_competition($offset,$id);
		$sport['pages'] 	=  $this->pagination->create_links();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'sport/competition_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$sport																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
			
	}
	
	function edit_competition()
	{
		$id = (int) $this->uri->segment(3);
		
		$sport['detail'] 	= $this->sport_model->get_competition_by_id($id);
		$sport['ratings']	= $this->sport_model->get_competition_ratings($id);
		$sport['category'] 	= $this->sport_model->get_sport("sp_ids,sp_name");
		$sport['dir']		= $this->sport_model->get_sport_by_id($sport['detail']->sps_for,'sp_transl');		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'sport/competition_edit_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$sport																			
														)
										);
		$data['head_content'] = array(	'jslibrary'=>'sport');	
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		
	}
	
	function add_competition()
	{
		$sport['category'] = $this->sport_model->get_sport("sp_ids,sp_name");
				//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'sport/competition_add_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$sport																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
	}
	
	function update_competition()
	{
		$id = (int) $this->uri->segment(3);
		//Проверяем существет ли запись в базе
		if($this->sport_model->get_competition_by_id($id))
		{
			$action = 'UPDATE'; //Если да, то производиться обновение
		}
		else
		{
			$action = 'ADD'; //Иначе добавляем
			
		}
		
		if($this->form_validation->run('competition_update') === FALSE)
		{
			
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			//Обращаемся к нужному методу
			($action == "UPDATE") ? $this->edit_competition() : $this->add_competition() ;	
		}
		else
		{
			//Формируем массив данных
			$sport['sps_name']	= addslashes($this->input->post('sps_name'));
			$sport['sps_for'] 	= $this->input->post('competit_type');
			$sport['sps_date'] 	= cp_format_date($this->input->post('competit_date'),3).cp_format_date($this->input->post('competit_date'),2).cp_format_date($this->input->post('competit_date'),1);
			$sport['sps_txt']	= $this->input->post('sps_txt');
			
			
			//Проверяем чекбоксы
			if($this->input->post('reglament')=='on')
			{
				$sport['sps_1']=1;
				$sport['sps_reglam'] = $this->input->post('sps_reglam');
			}
			else
			{
				$sport['sps_1']=0;
			}
			
			if($this->input->post('raspisanie')=='on')
			{
				$sport['sps_3']=1;
				$sport['sps_raspisanie'] = $this->input->post('sps_raspisanie');
			}
			else
			{
				$sport['sps_3']=0;
			}
			
			
			$sport['sps_2'] = ($this->input->post('ratings')=='on')? '1':'0';
		
			//Проверяем действие
			if($action == 'ADD')
			{
				//Записываем первичную информацию
				$this->sport_model->add_competition($sport);
				//Получаем последний id
				$id = $this->sport_model->get_last_id();
			}
			
			
			
			
			//Если присутствуют файлы
			if($_FILES['sps_ratings']['name']!='')
			{
				
				//Имя папки вида спорта
				$dir = $this->sport_model->get_sport_by_id($this->input->post('competit_type'),'sp_transl');
				$path = SDIR.'sport/download/';
					
				//Проверяем		
				if(!is_dir($path.$dir->sp_transl))
				{
					umask('0000');
					mkdir($path.$dir->sp_transl, DIR_WRITE_MODE);
					chmod($path.$dir->sp_transl, DIR_WRITE_MODE);
				}
				
				//Проверяем папку с соревнованием
				if(!is_dir($path.$dir->sp_transl.'/'.$id))
				{
					umask('0000');
					
					mkdir($path.$dir->sp_transl.'/'.$id, DIR_WRITE_MODE);
					chmod($path.$dir->sp_transl.'/'.$id, DIR_WRITE_MODE);
				}
				
				
				$config['upload_path'] = $path.$dir->sp_transl.'/'.$id.'/';
				$config['allowed_types'] = 'zip|rar|7z|doc|docx|xslx';
				$config['max_size']	= '2048';
				$config['file_name'] = date('Ymdhis').'_'.cp_transliter($this->input->post('sps_name'));
				
				
				$this->load->library('upload', $config);
			
				if ( ! $this->upload->do_upload('sps_ratings'))
				{
					
					$error = array('error' => $this->upload->display_errors());
					print_r($error);					
				}	
				else
				{
					$file = $this->upload->data();
					$rating['ratxl_xls'] 	= ($file['file_name']) ?  $file['file_name']:'';
					$rating['ratxl_name']	= addslashes($this->input->post('ratxl_name'));
					$rating['ratxl_forid'] 	= $id;	
					
					$this->sport_model->add_competition_rating($rating);			
				}
				
			
				
			}
			
			
			
			
			if($action == "ADD")
			{
				
			
					$param = array(
								'id'=>$sport['sps_for'],
								'message'=>alert_successfull('Создание',' соревнования '.stripslashes($sport['sps_name']))
								);
					$this->competition($param);
				
			}
			else
			{
				
				if($this->sport_model->update_competition($id,$sport))
				{
					$param = array(
								'id'=>$sport['sps_for'],
								'message'=>alert_successfull('Обновление',' соревнования '.stripslashes($sport['sps_name']))
								);
					$this->competition($param);
				}
				else
				{
					$param = array(
								'id'=>$sport['sps_for'],
								'message'=>alert_fail('Обновление',' соревнования  '.stripslashes($sport['sps_name']))
								);
					$this->competition($param);
				}	
			}
			

			
			
			
		}
		
	}
	
	function delete_competition()
	{
		//id соревнования
		$id = (int) $this->uri->segment(3);
		//Выбираем детальную информацию о соревновании
		$data = $this->sport_model->get_competition_by_id($id);
		if($data)
		{
			
			//Получаем имя папки в которой лежат файлы
			$dir = $this->sport_model->get_sport_by_id($data->sps_for,'sp_transl');
					
			$param = array('path'=>SDIR.'sport/download/'.$dir->sp_transl.'/'.$data->sps_ids.'/');
			
			
			if($this->sport_model->delete_competition($id) AND $this->sport_model->delete_files($param) AND $this->sport_model->delete_competition_ratings($id))
			{
				$data = array('message'=>alert_successful('Удаление', 'соревнования'));
			}
			else
			{
				$data = array('message'=>alert_fail('Удаление', 'соревнования'));
			}
			
			$this->competition($data);
			$this->output->enable_profiler(TRUE);
		}
		else
		{
			$data = array('message'=>alert_warning('Данного соревнования '));
			return $this->competition($data);
		}
	}
	
	function ajax()
	{
		if($this->input->post('type')=='delete_rat')
		{
			$id = (int) $this->input->post('id');
			//Необходимо получить id соревнования и имя папки спорта
			$rating = $this->sport_model->get_competition_rating($id);
			$data 	= $this->sport_model->get_competition_by_id($rating->ratxl_forid);
			$dir 	= $this->sport_model->get_sport_by_id($data->sps_for,'sp_transl');
			
			$param = array('path'=>SDIR.'sport/download/'.$dir->sp_transl.'/'.$data->sps_ids.'/','file_name'=>$rating->ratxl_xls);
			
			if($this->sport_model->delete_competition_rating($id) AND $this->sport_model->delete_file($param))
			{
				echo "OK";
			}
		}
	}
	
}


?>