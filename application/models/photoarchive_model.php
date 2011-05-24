<?php

class Photoarchive_model extends Model{
	
	function __construct()
	{
		parent::Model();
	}
	
	function get_photoarchives($offset='0')
	{
		$query = "SELECT 
		photoarchiv.arch_ids,
		photoarchiv.arch_categ,
		photoarchiv.arch_objid,
		photoarchiv.arch_name,
		photoarchiv.arch_txt,
		photoarchiv.arch_d,
		photoarchiv.arch_m,
		photoarchiv.arch_y,
		photoarchiv.arch_status,		
		photoarchive_categ.name 
		
		AS cat_name FROM photoarchiv,photoarchive_categ 
		WHERE photoarchiv.arch_categ=photoarchive_categ.id 
		ORDER BY  photoarchiv.arch_ids DESC 
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
	
	function get_photoarchive_by_categ($id,$offset ='0')
	{
		$query = "SELECT 
		photoarchiv.arch_ids,
		photoarchiv.arch_categ,
		photoarchiv.arch_objid,
		photoarchiv.arch_name,
		photoarchiv.arch_txt,
		photoarchiv.arch_d,
		photoarchiv.arch_m,
		photoarchiv.arch_y,
		photoarchiv.arch_status,		
		photoarchive_categ.name 
		
		AS cat_name FROM photoarchiv,photoarchive_categ 
		WHERE photoarchiv.arch_categ=photoarchive_categ.id 
		AND photoarchiv.arch_categ='".$id."' 
		ORDER BY  photoarchiv.arch_ids DESC 
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
	
	function get_total_photoarchives($id='')
	{
		
		$this->db->select('arch_ids');
		($id !='') ? $this->db->where('arch_categ',$id):'';
		$result = $this->db->get('photoarchiv');
		if($result->num_rows()>0)
		{
			return $result->num_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_category()
	{
		$result = $this->db->get('photoarchive_categ');
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_category_by_id($id)
	{
		$result = $this->db->get_where('photoarchive_categ',array('id'=>$id));
		if($result->num_rows()==1)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function category_update($id,$data)
	{
		$this->db->where('id', $id);
		if($this->db->update('photoarchive_categ',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function category_add($data)
	{
		if($this->db->insert('photoarchive_categ',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_category($id)
	{
		if($this->db->delete('photoarchive_categ',array('id'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function photoarchive_update($id,$data)
	{
		$this->db->where('arch_ids', $id);
		if($this->db->update('photoarchiv',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function photoarchive_add($data)
	{
		if($this->db->insert('photoarchiv',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_last_id()
	{
		return mysql_insert_id();
	}
	
	function insert_img($data)
	{
		if($this->db->insert('photoarchive_img',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_photoarchive_by_id($id)
	{
		$result = $this->db->get_where('photoarchiv',array('arch_ids'=>$id));
		if($result->num_rows()>0)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_images_by_pid($id)
	{
		$result = $this->db->get_where('photoarchive_img',array('p_id'=>$id));
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_image_by_id($id)
	{
		$result = $this->db->get_where('photoarchive_img',array('id'=>$id));
		if($result->num_rows()==1)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_image_by_id($id)
	{
		if($this->db->delete('photoarchive_img',array('id'=>$id)))
		{
			return TRUE;
			
		}
		else
		{
			return FALSE;
		}
	}
	
	
}


?>