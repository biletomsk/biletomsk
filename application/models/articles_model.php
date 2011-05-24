<?php

class Articles_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function get_last_articles($offset='0',$user=FALSE)
	{
		$sql = ($user)? " AND articles.user='".$user."' ": '';
		$query = "SELECT 
		articles.id,
		articles.type,
		articles.date,
		articles.topic,
		articles.views,
		articles.art_status,
		articles_category.*		 
		FROM articles,articles_category 
		WHERE articles.type=articles_category.ac_type 
		".$sql."
		ORDER BY articles.id DESC LIMIT ".$offset.",20";	
		
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
	
	function get_articles_by_categ($id,$offset='20',$user=false)
	{
		$sql = ($user) ? " AND articles.user='".$user."' ":'';
		$query = "SELECT 
		articles.id,
		articles.type,
		articles.date,
		articles.topic,
		articles.views,
		articles.art_status,
		articles_category.*		 
		FROM articles,articles_category 
		WHERE articles.type=articles_category.ac_type 
		AND articles.type='".$id."'
		".$sql." 
		ORDER BY articles.id DESC LIMIT ".$offset.",20";	
		
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
	
	function get_type_by_id($id)
	{
		$this->db->select('ac_type');
		$result = $this->db->get_where('articles_category',array('ac_ids'=>$id));
		if($result->num_rows()==1)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function search_articles($word='',$offset='0')
	{
		$query = "SELECT 
		articles.id,
		articles.type,
		articles.date,
		articles.topic,
		articles.views,
		articles.art_status,
		articles_category.*		 
		FROM articles,articles_category 
		WHERE articles.type=articles_category.ac_type 
		AND articles.topic LIKE '%".$word."%' 
		ORDER BY articles.id DESC LIMIT ".$offset.",20";	
		
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
	
	function get_total_articles($type='',$user=FALSE)
	{
		$this->db->select('id');
		($type !='') ? $this->db->where('type',$type):'';
		($user) ? $this->db->where('user',$user):'';
		$result = $this->db->get('articles');
		if($result->num_rows()>0)
		{
			return $result->num_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_articles_by_id($id='',$user=FALSE)
	{
		$id = (int) $id;
		$sql = ($user) ? " AND articles.user='".$user."' ":'';
		$query = "SELECT * 
		FROM articles,articles_category 
		WHERE articles.type=articles_category.ac_type
		AND articles.id = '".$id."' 
		".$sql."
		ORDER BY articles.id DESC LIMIT 0,1";
		
		$result = $this->db->query($query);
		
		if($result->num_rows()==1)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_articles_category()
	{
		$result = $this->db->get('articles_category');
		
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}

	function insert_category($data)
	{
		if($this->db->insert('articles_category',$data))
		{
			return TRUE;
		}
		else
		{
			return false;
		}	
	}
	
	function get_category_by_id($id='')
	{
		$id = (int) $id;
		$result = $this->db->get_where('articles_category',array('ac_ids'=>$id),'1');
		
		if($result->num_rows()==1)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function category_update($data)
	{
		$id = (int) $this->uri->segment(3);
		
		$this->db->where('ac_ids', $id);
		if($this->db->update('articles_category', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}


	function delete_category()
	{
		$id = (int) $this->uri->segment(3);
		
		$this->db->where('ac_ids', $id);
		
		if($this->db->delete('articles_category'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function insert_articles($data)
	{
		if($this->db->insert('articles',$data))
		{
			return TRUE;
		}
		else
		{
			return false;
		}
	}
	
	function update_articles($id,$data,$user=FALSE)
	{
				
		$this->db->where('id', $id);
		($user)? $this->db->where('user', $user):'';
		if($this->db->update('articles', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function delete_file($filename)
	{
		if(file_exists($filename))
		{
			unlink($filename);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_articles($id,$user=FALSE)
	{
		
		
		$this->db->where('id', $id);
		($user)? $this->db->where('user', $user):'';
		if($this->db->delete('articles'))
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