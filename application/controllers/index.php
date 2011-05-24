<?php 



class Index extends Controller
{
	
	
	
	function __construct()
	{
		parent::Controller();
		
		if ($this->auth->isAuthorised() == false )
		{
			redirect('login');
		}
	
		
		$user = $this->auth->getUser();
		$user = ($user['class']=='admin' || $user['class']=='redactor' || $user['class']=='manager') ? FALSE : $user['nick'];
		$this->main_menu = $this->index_model->get_list_category($user);
		
		
	}
	
	function index()
	{
		
		//print_r($this->auth->hasAccess());
	
		
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>array(	'dash_tpl'=>'default_dashboard',
														'data'=>'Быстрый доступ',
														'main_category'=>$this->main_menu	
														
														)
										);
		
		$this->load->view('default/index',$data);
		

		
	}
	
	function _check_login()
	{
		$this->authorised = $this->auth->isAuthorised();
		return $this->authorised; 	
	}
	
	function logout()
	{
		$this->auth->logout();	
		redirect('login');
	}
}


?>