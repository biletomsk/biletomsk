<?php

class Discount_model extends Model{
	
	function __construct()
	{
		parent::Model();
	}
	
	function get_last_discount($offset='0',$sql='')
	{
		
		$query = "
		SELECT 
				d.dis_id,
				d.dis_cat_id,
				d.dis_type,
				d.dis_name,
				d.dis_begin,
				d.dis_org,
				d.dis_end,
				d.dis_amount,
				d.dis_status,
				dc.dc_cat_name,
				dc.dc_cat_id,
				dc.dc_parent_id,
				o.obj_nam,
				o.obj_ids
		FROM discount AS d	
		INNER JOIN 	discount_categ AS dc
		ON d.dis_cat_id=dc.dc_cat_id
		LEFT JOIN object AS o
		ON d.dis_obj_id=o.obj_ids
		".$sql."
		ORDER BY d.dis_id DESC 		
		LIMIT ".$offset.",20
		";
		/*
		$query = "SELECT 
discount.dis_id,
discount.dis_cat_id,
discount.dis_type,
discount.dis_name,
discount.dis_begin,
discount.dis_end,
discount.dis_status,
discount_categ.dc_cat_name,
discount_categ.dc_cat_id,
discount_categ.dc_parent_id
 FROM discount,discount_categ
 WHERE dis_cat_id=dc_cat_id
 ".$sql."
 ORDER BY discount.dis_id DESC 
				 LIMIT ".$offset.",20";
		*/
		
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
	
	function add_discount($data)
	{
		
	}
	
	function get_parent_category($id='0')
	{
		//$this->db->select('dc_cat_name');
		$result = $this->db->get_where('discount_categ',array('dc_parent_id'=>'0','dc_cat_id'=>$id));
		if($result->num_rows()==1)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_total_discount($id='',$user=FALSE)
	{
		$this->db->select('dis_id');
		($id !='') ? $this->db->where('dis_cat_id',$id) : '';
		($user)? $this->db->where('dis_user',$user) : '';
		$result = $this->db->get('discount');
		if($result->num_rows()>0)
		{
			return $result->num_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_total_discount_by_id($sql)
	{
		
		$query = "
		SELECT 
			d.dis_id,
			dc.dc_cat_name,
			dc.dc_cat_id,
			dc.dc_parent_id
		FROM discount AS d
		INNER JOIN discount_categ AS dc
		ON d.dis_cat_id=dc.dc_cat_id
		 ".$sql."	
		";
		/*
				$query = "SELECT 
			discount.dis_id,
			discount_categ.dc_cat_name,
			discount_categ.dc_cat_id,
			discount_categ.dc_parent_id
			 FROM discount,discount_categ
			 WHERE dis_cat_id=dc_cat_id
			 ".$sql."	";
		*/
		$result = $this->db->query($query);
		if($result->num_rows()>0)
		{
			return $result->num_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_discount_index()
	{
		$query = "	SELECT	di.*,
							d.dis_id,
							d.dis_name,
							d.dis_org,
							d.dis_img,
							o.obj_nam 
					FROM discount_index AS di 
					LEFT JOIN discount AS d 
					ON di.di_dis_id=d.dis_id 
					LEFT JOIN object AS o 
					ON d.dis_obj_id=o.obj_ids
					ORDER BY di.di_id";
		
		$result = $this->db->query($query);
		
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return false;
		}
	}
	
	function get_discount_index_item($id)
	{
			$query = "	SELECT	di.*,
							d.dis_id,
							d.dis_name,
							d.dis_org,
							d.dis_end,
							d.dis_amount,
							d.dis_img,
							d.dis_cat_id,
							d.dis_parentcat_id,
							o.obj_nam 
					FROM discount_index AS di 
					LEFT JOIN discount AS d 
					ON di.di_dis_id=d.dis_id 
					LEFT JOIN object AS o 
					ON d.dis_obj_id=o.obj_ids
					WHERE di.di_id=".$id." 
					LIMIT 1";
		
		$result = $this->db->query($query);
		
		if($result->num_rows()>0)
		{
			return $result->row();
		}
		else
		{
			return false;
		}
	}
	
	function discount_index_update($id,$data)
	{
		$this->db->where('di_id',$id);
		if($this->db->update('discount_index',$data))
		{
			return TRUE;
			
		}
		else
		{
			return FALSE;
		}
	}
	
	function add_discount_index($data)
	{
		
	}
	
	
	function get_discount_category($id='0')
	{
	
		$this->db->order_by('dc_cat_order');
		$result = $this->db->get_where('discount_categ',array('dc_parent_id'=>$id));
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
		$result = $this->db->get_where('discount_categ',array('dc_cat_id'=>$id));
		if($result->num_rows()==1)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function category_add($data)
	{
		if($this->db->insert('discount_categ',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function category_update($id,$data)
	{
		$this->db->where('dc_cat_id',$id);
		if($this->db->update('discount_categ',$data))
		{
			return TRUE;
			
		}
		else
		{
			return FALSE;
		}
	}
	
	function category_delete($id)
	{
		$this->db->where('dc_cat_id',$id);
		if($this->db->delete('discount_categ'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	function get_discount_type()
	{
		$result = $this->db->get('discount_type');
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_discount_pcategory($id)
	{
		$query = "SELECT dc_parent_id FROM discount_categ WHERE dc_cat_id='".$id."' LIMIT 1";
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
	
	function get_discount_by_id($id,$field="*",$user=FALSE)
	{
		$sql = ($user)? " AND dis_user='".$user."' ":'';
		$query = "SELECT ".$field." FROM discount WHERE dis_id='".$id."' ".$sql." LIMIT 1";
		
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
	
	function get_last_id()
	{
		return mysql_insert_id();
	}
	
	function discount_insert($data)
	{
		if($this->db->insert('discount',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function discount_update($id,$data,$user)
	{
		$this->db->where('dis_id',$id);
		($user)? $this->db->where('dis_user',$user):'';
		if($this->db->update('discount',$data))
		{
			return TRUE;
			
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_discount_gallery($id)
	{
		
		$result = $this->db->get_where('discount_gallery',array('dg_dis_id'=>$id));
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_discount_gallery_item($id)
	{
		$result = $this->db->get_where('discount_gallery',array('dg_id'=>$id));
		if($result->num_rows()==1)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_discount_gallery_items($data)
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
	
	function delete_discount_gallery($id)
	{
		if($this->db->delete('discount_gallery',array('dg_dis_id'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_discount($id,$user=FALSE)
	{
		($user) ? $this->db->where('dis_user',$user) : '';
		if($this->db->delete('discount',array('dis_id'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_discount_gallery_item($id)
	{
		$this->db->where('dg_id',$id);
		if($this->db->delete('discount_gallery'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_file_discount_image($file)
	{
		
		if(unlink(SDIR.'_files/discount/_gallery/'.$file->dg_dis_id.'/'.$file->dg_img) AND unlink(SDIR.'_files/discount/_gallery/'.$file->dg_dis_id.'/big/'.$file->dg_img))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function insert_discount_galery($data)
	{
		if($this->db->insert('discount_gallery',$data))
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