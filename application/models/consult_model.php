<?php

class Consult_model extends Model{
	
	function __construct()
	{
		parent::Model();
	}
	
	function get_last_consultant($offset='0')
	{
		$query = "	SELECT consultation.id,
					consultation.type_id,
					consultation.organization,
					consult_types.type_name 
					
					FROM consultation,consult_types 
					WHERE consultation.type_id=consult_types.id
					ORDER BY consultation.id DESC 
					LIMIT ".$offset.",20";
		$result = $this->db->query($query);
		if($result->num_rows()>0)
		{
			return $result->result();
		}			
		else
		{
			return FALSE;
		}
	}
	
	function get_last_consultant_by_categ($id='1',$offset='0')
	{
		$query = "	SELECT consultation.id,
					consultation.type_id,
					consultation.organization,
					consult_types.type_name 
					
					FROM consultation,consult_types 
					WHERE consultation.type_id=consult_types.id
					AND consultation.type_id='".$id."'
					ORDER BY consultation.id DESC 
					LIMIT ".$offset.",20";
		$result = $this->db->query($query);
		if($result->num_rows()>0)
		{
			return $result->result();
		}			
		else
		{
			return FALSE;
		}	
	}
	
	function get_total_consultant($id='')
	{
		$this->db->select('id');
		($id !='') ? $this->db->where('type_id',$id):'';
		$result = $this->db->get('consultation');
		if($result->num_rows()>0)
		{
			return $result->num_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	
}


?>