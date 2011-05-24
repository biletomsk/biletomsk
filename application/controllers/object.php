<?php 
class Object extends Controller
{
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
	
	function index($message='')
	{
	
		if($message)
		{
			$news['message'] = $message;
		}
		
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>'object_list_dashboard'
										);
		
		$this->load->view('default/index',$data);
	}
	
	function add()
	{
		$objects['category'] = $this->object_model->get_object_category();
		$objects['nextid']	 = $this->object_model->get_next_object_id();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'objects/objects_add_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$objects,
														'main_category'=>$this->main_menu																				
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'object'		
										);						
		
		$this->load->view('default/index',$data);
		
	}
	
	function show_category($param = '')
	{
		
		if(is_array($param))
		{
			$alt_cat = $this->object_model->get_object_category($param['id']);
			$cat = $alt_cat[0]->categ_alter2;
			$objects['message'] = $param['message'];
		}
		else
		{
			$cat = $this->uri->segment(3);
		}
		
		//Пагинация
			
		$objects['list'] 		= $this->object_model->get_object_by_category($cat);
		$objects['category'] 	= $this->object_model->get_object_category();
		//$objects['pages']		= $this->object_model->get_amount_pages();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'objects/object_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$objects,
														'main_category'=>$this->main_menu																				
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'object'		
										);						
		
		$this->load->view('default/index',$data);
		
	}
	
	function edit()
	{
		
		$objects['detail'] 		= $this->object_model->get_object_by_id();
		$objects['category'] 	= $this->object_model->get_object_category();
		$objects['seo']			= $this->object_model->get_seo_of_object();
		$objects['info']		= $this->object_model->get_object_tab();
		$objects['stat']		= $this->object_model->get_object_stat();
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'objects/object_edit_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$objects,
														'main_category'=>$this->main_menu																				
														)
										);
		//Указываем название дополнительной js-библиотеки								
		$data['head_content'] = array(	'jslibrary'=>'object');						
		
		$this->load->view('default/index',$data);
		
	}
	
	function update()
	{
		$id = (int) $this->uri->segment(3);
		
		//Проверяем существет ли запись в базе
		if($this->object_model->get_object_by_id('obj_ids'))
		{
			$action = 'UPDATE'; //Если да, то производиться обновение
		}
		else
		{
			$action = 'ADD'; //Иначе добавляем
		}
		
		if($this->form_validation->run('object_update') === FALSE)
		{
			
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			($id !=0) ? $this->edit():$this->add();	
		}
		else
		{
			if($_FILES)
			{
				if($_FILES['LOGO']['name'] !='')
				{
					
								
					//Загружаем файл изображения
					$config['upload_path'] = SDIR.'_object/logo/'.$id.'/';
					$config['allowed_types'] = 'jpg';
					$config['max_size']	= '100';
					$config['max_width'] = '200';
					$config['max_height'] = '200';
					$config['file_name'] = cp_transliter($this->input->post('obj_nam'));
					$config['overwrite'] = TRUE;
					
									
					//Проверка на существование папки
					if(!is_dir($config['upload_path']))
					{
						umask(0000);
						mkdir($config['upload_path'],DIR_WRITE_MODE);
						chmod($config['upload_path'],DIR_WRITE_MODE);
					}
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('LOGO'))
					{
						$this->img_array =  $this->upload->data();
						
						
						$this->old_image = $this->object_model->get_object_by_id('obj_img');
						//...совпадает ли новое имя со старым
						
						if(@$this->old_image->obj_img !='')
						{
							if($this->img_array['file_name'] !==  $this->old_image->obj_img)
							{
								//Если нет, то удаляем старое
								@unlink($config['upload_path'].$this->old_image->obj_img);
							}	
						}
						

							
						//Если массив существует, то задаем элемент массива
						$object['obj_img']	= $this->img_array['file_name'];
					}
					else
					{
						echo $this->upload->display_errors();
					}
						
				}
				
				if($_FILES['MLOGO']['name']!='')
				{
					//echo 'mlogo';
					//Загружаем файл изображения
					$config['upload_path'] = SDIR.'_object/logo/'.$id.'/';
					$config['allowed_types'] = 'gif|jpg';
					$config['max_size']	= '100';
					$config['max_width'] = '200';
					$config['max_height'] = '200';
					$config['file_name'] = cp_transliter($this->input->post('obj_nam').'_mini');
					$config['overwrite'] = TRUE;
					
					//Проверка на существование папки
					if(!is_dir($config['upload_path']))
					{
						umask(0000);
						mkdir($config['upload_path'],DIR_WRITE_MODE);
						chmod($config['upload_path'],DIR_WRITE_MODE);
					}
					
					
					//Загружаем библиотеку
					$this->load->library('upload', $config);
					//Инициализируем конфиг
					$this->upload->initialize($config);
					//Если загрузка произошла
					if($this->upload->do_upload('MLOGO'))
					{
						//Прлучаем инфу о загруженном файле
						$this->img_array =  $this->upload->data();
						
						//Получаем из таблицы название старого файла
						$this->old_image = $this->object_model->get_object_by_id('obj_img_mini');
						
						
						if(@$this->old_image->obj_img_mini !='')
						{
							//...совпадает ли новое имя со старым
							if($this->img_array['file_name'] !==  $this->old_image->obj_img_mini)
							{
								//Если нет, то удаляем старое
								@unlink($config['upload_path'].$this->old_image->obj_img_mini);
							}	
						}
						//Указываем имя файла, которое будет добавлено в таблицу
						$object['obj_img_mini'] = $this->img_array['file_name'];
					}
				}	
				


			}

			//Массив с информацией об объекте
			$object['obj_nam'] 		= addslashes($this->input->post('obj_nam'));
			$object['obj_categ'] 	= $this->input->post('obj_categ');
			$o_type = $this->object_model->get_object_type($object['obj_categ']);
			$object['obj_type']		= $o_type->categ_alter;
			$object['obj_transl'] 	= $this->input->post('obj_transl');
			$object['obj_img_alt']	= $this->input->post('obj_img_alt');
			$object['obj_img_url'] 	= $this->input->post('obj_img_url');
			$object['obj_alltxt'] 	= addslashes($this->input->post('obj_alltxt'));
			
			$object['obj_phone'] 	= $this->input->post('obj_phone');
			$object['obj_addr'] 	= $this->input->post('obj_addr');
			$object['obj_email'] 	= $this->input->post('obj_email');
			$object['obj_www'] 		= $this->input->post('obj_www');
			
			
			
			//Подменю объекта
			for($i=1;$i<9;$i++)
			{
								
				if($this->input->post('obj_'.$i.'') == 'on')
				{
					$object['obj_'.$i.'']  = '1';
				}
				else
				{
					$object['obj_'.$i.'']  = '0';
				}
				
			}
			
			//СЕО
			$seo['par_tile'] 		= $this->input->post('par_tile');
			$seo['par_keywords'] 	= strip_tags($this->input->post('par_keywords'));
			$seo['par_description'] = addslashes(strip_tags($this->input->post('par_description')));
			
			//Показатели счетчиков
			$stat['cou_type'] 	= 'OBJECT';
			$stat['cou_v'] 		= $this->input->post('cou_v');
			$stat['cou_vd'] 	= $this->input->post('cou_vd');
			
			//Опрделяем действие
			if($action == 'UPDATE')
			{
							
				//Обновляем СЕО-объекта
				$this->object_model->update_object_seo($id,$seo);
				
				//Обновляем статистику
				$this->object_model->update_object_stat($id,$stat);
				
				//Обновляем дополнительные поля
				foreach($this->input->post('FIELD') as $key=>$value)
				{
					$this->object_model->object_tab_update($key,$value);
				}
				
			
			
			
				//Обновляем основную информацию объекта
				if($this->object_model->object_update($id,$object))
				{
					$param = array(
								'id'=>$object['obj_categ'],
								'message'=>alert_successfull('Обновление',' объекта '.$object['obj_nam'])
								);
					$this->show_category($param);
				}
				else
				{
					$param = array(
								'id'=>$object['obj_categ'],
								'message'=>alert_fail('Обновление',' объекта '.$object['obj_nam'])
								);
					$this->show_category($param);
				}
				
			}
			elseif($action == 'ADD')
			{
				
			  //Создаем папку.
				umask(0000);
				if(@mkdir(_SDIR.'/'.$object['obj_transl'],DIR_WRITE_MODE)){

					//Кидаем в папку поддомена необходимые файлы index.php и .htaccess
					@copy(_SDIR.'/_obrazec/index.php', _SDIR.'/'.$object['obj_transl'].'/index.php');
					@copy(_SDIR.'/_obrazec/.htaccess', _SDIR.'/'.$object['obj_transl'].'/.htaccess');
				 }
				
				//print_r($_POST);
				
				$seo['par_object'] = $id;
				//Обновляем СЕО-объекта
				
				$this->object_model->add_object_seo($seo);
				
				//Обновляем дополнительные поля
				foreach($this->input->post('FIELD') as $key=>$value)
				{
					$value['objt_tema'] = $id;
					$value['objt_type'] = 'OBJECT';
														
					if($value['objt_nam'] !='')
					{
						$this->object_model->object_tab_insert($value);
					}				
					
				}
				
			
			
			
				//Обновляем основную информацию объекта
				if($this->object_model->object_add($object))
				{
					$param = array(
								'id'=>$object['obj_categ'],
								'message'=>alert_successfull('Добавление',' объекта '.$object['obj_nam'])
								);
					$this->show_category($param);
				}
				else
				{
					echo 'Error';
				}	
				
				
				
			}

			
		}
		
	}
	

	

}

?>