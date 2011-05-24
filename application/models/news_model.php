<?php 

class News_model extends Model{
	
	function __construct()
	{
		parent::Model();
		$this->db->query('SET NAMES utf8');
	}
	
	function get_last_news($offset='20',$user=FALSE)
	{
		$sql = ($user)? " AND news.new_user='".$user."' " : '';
		$query ="SELECT news.*,newc_name,newc_ids 
		FROM news,news_cat 
		WHERE new_status<>0 
		AND LPAD( LPAD( new_st_d, 2, 0 ) , 8, RPAD( new_st_y, 6, LPAD( new_st_m, 2, 0 ) ) ) <=".date("Ymd")." 
		AND news_cat.newc_ids = news.new_type
		".$sql."
		ORDER BY new_ids DESC LIMIT ".$offset.",20";
		//$query = "SELECT * FROM news LIMIT 0,".$limit;
		$result = $this->db->query($query);
		
		if($result->num_rows()>0)
		{
			return $result->result();
		}
	}
	
	function get_last_news_by_categ($id,$offset='20',$user=FALSE)
	{
		$sql = ($user)? " AND news.new_user='".$user."' ":'';
		$query ="SELECT news.*,news_cat.newc_name,news_cat.newc_ids 
		FROM news,news_cat 
		WHERE new_status<>0 
		AND LPAD( LPAD( new_st_d, 2, 0 ) , 8, RPAD( new_st_y, 6, LPAD( new_st_m, 2, 0 ) ) ) <=".date("Ymd")." 
		AND news_cat.newc_ids = news.new_type 
		AND news.new_type='".$id."' 
		".$sql."
		ORDER BY new_ids DESC LIMIT ".$offset.",20";
		//$query = "SELECT * FROM news LIMIT 0,".$limit;
		$result = $this->db->query($query);
		
		if($result->num_rows()>0)
		{
			return $result->result();
		}
	}
	
	function search_news($word='',$offset='0')
	{
		
		$query ="SELECT news.*,newc_name,newc_ids FROM news,news_cat WHERE new_status<>0 AND LPAD( LPAD( new_st_d, 2, 0 ) , 8, RPAD( new_st_y, 6, LPAD( new_st_m, 2, 0 ) ) ) <=".date("Ymd")." AND news_cat.newc_ids = news.new_type AND news.new_name LIKE '%".$word."%' ORDER BY new_ids DESC LIMIT ".$offset.",20";
		//$query = "SELECT * FROM news LIMIT 0,".$limit;
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
	
	function get_total_news($id='',$user=FALSE)
	{
		$this->db->select('new_ids');
		($id !='') ? $this->db->where('new_type',$id):'';
		($user)? $this->db->where('new_user',$user):'';
		$result = $this->db->get('news');
		if($result->num_rows()>0)
		{
			return $result->num_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_news_category()
	{
		$query = "SELECT * FROM news_cat";
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
	
	function get_category_by_id($id='')
	{
		//$id = (int) $this->uri->segment(3);
		$result = $this->db->get_where('news_cat',array('newc_ids'=>$id),'1');
		
		if($result->num_rows()==1)
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
		if($this->db->insert('news_cat',$data))
		{
			return TRUE;
		}
		else
		{
			return false;
		}	
	}
	
	function category_update($data)
	{
		$id = (int) $this->uri->segment(3);
		
		$this->db->where('newc_ids', $id);
		if($this->db->update('news_cat', $data))
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
		
		$this->db->where('newc_ids', $id);
		
		if($this->db->delete('news_cat'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_news_by_id($id='',$user=FALSE)
	{
		//Дополнительное условие выборки 
		$sql = ($user) ? "AND new_user='".$user."'" : '';
		
		
		$query = "SELECT n.*,
		nc.newc_name,
		nc.newc_ids 
		FROM news AS n
		INNER JOIN news_cat AS nc
		ON nc.newc_ids = n.new_type
		WHERE new_ids='".$id."' 
		".$sql."
		";
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
	
	function insert_news($data)
	{
		if($this->db->insert('news',$data))
		{
			return TRUE;
		}
		else
		{
			return false;
		}
	}
	
	function update_news($id,$data)
	{
		//print_r($data);
		
		$this->db->where('new_ids', $id);
		if($this->db->update('news', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function delete_news($id='',$user=FALSE)
	{
		
		$this->db->where('new_ids', $id);
		($user)? $this->db->where('new_user', $user):"";
		if($this->db->delete('news'))
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
		if(file_exists(SDIR.$filename))
		{
			unlink(SDIR.$filename);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	

	

}
?>