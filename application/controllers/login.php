<?php

class Login extends Controller
{
	
	function __conctruct()
	{
		parent::Contoller();
		
	}
	
	function index()
	{
		
		
		if($this->_check_login() == false)
		{	
		 	
			$data['main_content'] = 'login/login_form';
			$this->load->view('default/login',$data);
			
			
		}
		else
		{
			redirect(base_url().'index');
		}
	
	}
	
	
	function check_user()
	{
		if($this->form_validation->run() == FALSE)
		{	
			$this->form_validation->set_error_delimiters('<div id="fail" class="info_div"><span class="ico_cancel">', '</span></div>');
			
			$this->index();
		}
		else 
		{
			if($this->_check_login() == false)
			{
				$this->index();
			}
			else
			{
				redirect(base_url().'index');
			}
			
		}
	}
	
	function _check_login()
	{
		$this->authorised = $this->auth->isAuthorised();
		return $this->authorised; 		
	}
	
}
	
	