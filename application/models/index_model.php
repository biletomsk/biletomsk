<?php 

class Index_model extends Model{
	
	
	function __construct()
	{
		parent::Model();
	}
	
	function get_list_category($user=FALSE)
	{
		$sql = ($user)? "WHERE o.obj_user='".$user."' " : '';
		$query = "SELECT DISTINCT c.* 
		FROM category AS c 
		LEFT JOIN object AS o  
		ON o.obj_categ = c.categ_ids 
		".$sql."
		ORDER BY c.categ_nam
		";
		
		$result = $this->db->query($query);
		if($result)
		{
			if($result->num_rows()>0)
			{
				return $result->result();
			}
			else
			{
				return  false;
			}
		}
		else
		{
			return false;
		}
		
	}
	
}




?>