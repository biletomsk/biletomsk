<?php 

class User_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	/*
	 * Функция на наличия пользователя в базе
	 */
	function is_register()
	{
		$this->db->select('id');
		$query = $this->db->get_where('users',array('nick'=>$this->input->post('nick')),'1');
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

?>