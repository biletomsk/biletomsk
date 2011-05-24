<?php

class Consultation extends Controller{
	
	function __construct()
	{
		parent::Controller();
		if ($this->auth->isAuthorised() == false )
		{
			redirect('login');
		}

		$this->load->model('consult_model');
	}
	
	function index($param='')
	{
		if(is_array($param))
		{
			$consult['message'] = $param['message'];
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
		$config['base_url'] = base_url().'consultation/index/page/';
		$config['total_rows'] = $this->consult_model->get_total_consultant();


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(4))? $this->uri->segment(4):'0';
		//Получаем данные
		$consult['data'] 		= $this->consult_model->get_last_consultant($offset);
		//$discount['category']	= $this->discount_model->get_discount_category();
		$consult['pages'] 		=  $this->pagination->create_links();
		
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'consultation/consult_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$consult																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		$this->output->cache(5);
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
		$config['uri_segment'] = '5';
		$config['base_url'] = base_url().'consultation/show_category/'.$id.'/page/';
		$config['total_rows'] = $this->consult_model->get_total_consultant($id);


		//Инициализация
		$this->pagination->initialize($config); 
		//Выборка начиная с какого ряда
		$offset = ($this->uri->segment(5))? $this->uri->segment(5):'0';
		//Получаем данные
		$consult['data'] 		= $this->consult_model->get_last_consultant_by_categ($id,$offset);
		//$discount['category']	= $this->discount_model->get_discount_category();
		$consult['pages'] 		=  $this->pagination->create_links();
		
		
		//Готовим массив для передачи в шаблон
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'consultation/consult_list_dashboard',
														'data'=>'Быстрый доступ',
														'dash_content'=>$consult																			
														)
										);
		//Вызываем шаблон
		$this->load->view('default/index',$data);
		$this->output->cache(5);
	}
	
	function add()
	{
		
	} 
	function edit()
	{
		
	}
	
	function update()
	{
		
	}
}




?>