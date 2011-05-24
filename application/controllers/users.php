<?php 
class Users extends Controller
{

	function __construct()
	{
		parent::Controller();
	}

	function index()
	{
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>'user_list_dashboard'
										);
		
		$this->load->view('default/index',$data);
	}
	
	function add()
	{
		$data['main_content'] = array(	'tpl'=>'main',
										'dash'=>'user_add_dashboard'
										);
				
		$this->load->view('default/index',$data);
	}
	
	function edit()
	{
		
		
	}
	
	function delete()
	{
	
	}
	
	function groups()
	{
		
	}
	
	function add_group()
	{
		
	}
	
	function delete_group()
	{
		
	}

}


?>