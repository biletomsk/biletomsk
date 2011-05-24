<?php 

class Login_model extends Model{
	
	function __construct(){
		
		parent::Model();
	}
	
	function check_login()
	{
		$this->db->select('id');
		$query = $this->db->get_where('tbl_users',array('nick'=>$this->input->post('log'),'passw'=>md5($this->input->post('pwd'))),'1');
		if($query->num_rows()==1)
		{
			return true;			
		}
		else
		{
			return false;
		}
		
	}
	
}