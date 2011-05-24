<?php

class Sport_model extends Model
{
	function __construct()
	{
		parent::Model();
		
	}
	
	
	function get_sport($field='*')
	{
		
		$query = "SELECT ".$field." FROM sport";
		
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
	
	function sport_insert($data)
	{
		if($this->db->insert('sport',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_sport_by_id($id='',$field = "*")
	{
		if($id == '')
		{
			$id=$this->uri->segment(3);
		}
		
		$query = "SELECT ".$field." FROM sport WHERE sp_ids='".$id."' LIMIT 1";
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
	
	
	
	function get_sport_competition($offset='0',$id='')
	{
		$sql = ($id != '')? " AND sport_sorevnovania.sps_for='".$id."'" : " ";
	
		$query = "SELECT 
		sport_sorevnovania.sps_ids,
		sport_sorevnovania.sps_for,
		sport_sorevnovania.sps_name,
		sport_sorevnovania.sps_date,		
		sport.sp_ids,
		sport.sp_name 
		FROM sport_sorevnovania,sport 
		WHERE sport_sorevnovania.sps_for=sport.sp_ids 
		".$sql."
		ORDER BY sport_sorevnovania.sps_ids DESC 
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
	
	function get_total_competition($id='')
	{
		$this->db->select('sps_ids');
		($id !='') ? $this->db->where('sps_for',$id): '';
		$result = $this->db->get('sport_sorevnovania');
		if($result->num_rows()>0)
		{
			return $result->num_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_competition_by_id($id='')
	{
		
		$query = "SELECT * FROM sport_sorevnovania WHERE sps_ids=".$id." LIMIT 1";
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
	
	
	function get_seo_of_sport()
	{
		$id = (int)$this->uri->segment(3);
		$query = "SELECT * FROM parser WHERE par_sportid = ".$id." LIMIT 1";
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
	
	function insert_sport_seo($data)
	{
		if($this->db->insert('parser', $data))
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
	
	function get_sport_stat()
	{
		$id = (int)$this->uri->segment(3);
		$query = "SELECT * FROM coun WHERE cou_for=".$id." AND cou_type='SPORT' LIMIT 1";
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
	
	function get_competition_ratings($id)
	{
		$result = $this->db->get_where('rating_xls',array('ratxl_forid'=>$id));
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_competition_rating($id)
	{
		$result = $this->db->get_where('rating_xls',array('ratxl_ids'=>$id));
		if($result->num_rows()==1)
		{
			return $result->row();
			
		}
		else
		{
			return FALSE;
		}
	}
	
	function add_competition_rating($data)
	{
		if($this->db->insert('rating_xls',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_competition_ratings($id)
	{
	
		if($this->db->delete('rating_xls', array('ratxl_forid' => $id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_competition_rating($id)
	{
		$this->db->where('ratxl_ids',$id);
		if($this->db->delete('rating_xls'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function insert_sport_stat($data)
	{
		if($this->db->insert('coun',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_competition($id,$data)
	{
		$this->db->where('sps_ids',$id);
		if($this->db->update('sport_sorevnovania', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function add_competition($data)
	{
		if($this->db->insert('sport_sorevnovania',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_competition($id)
	{
		
		$this->db->where('sps_ids',$id);
		if($this->db->delete('sport_sorevnovania'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function delete_file($data)
	{
		if(unlink($data['path'].$data['file_name']))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_files($data)
	{
		if(delete_files($data['path']))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_sport_banners()
	{
		$id = (int) $this->uri->segment(3);
		$result = $this->db->get_where('sport_banners',array('sb_sid'=>$id));
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
		
	}
	
	function get_sport_banner($id='')
	{
		$result = $this->db->get_where('sport_banners',array('sb_id'=>$id));
		if($result->num_rows()==1)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function insert_sport_banners($data)
	{
		if($this->db->insert('sport_banners',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_sport_banners($id)
	{
		$this->db->where('sb_id',$id);
		if($this->db->delete('sport_banners'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_file_sport_banners($file)
	{
		
			if(unlink('_adver/sport/'.$file->sb_sid.'/'.$file->sb_img))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		
	}
	
	function update_sport_seo($id,$data)
	{
		$this->db->where('par_sportid',$id);
		if($this->db->update('parser', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function update_sport_stat($id,$data)
	{
				
		$this->db->where('cou_for', $id);
		if($this->db->update('coun', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function sport_update($id,$data)
	{
		$this->db->where('sp_ids',$id);
		if($this->db->update('sport', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function update_pravila()
	{
		$id = (int) $this->uri->segment(3);
		$query = "UPDATE sport SET sp_pravila='".$this->input->post('html_content')."' WHERE sp_ids=".$id;
		$result = $this->db->query($query);
		if($result)
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