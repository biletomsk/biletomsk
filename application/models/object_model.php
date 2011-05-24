<?php
  
class Object_model extends Model
{
	function __construct()
	{
		parent::Model();
		
	}
	
	function get_object_category($id='')
	{
		if($id !='')
		{
			$sql = " WHERE categ_ids='".$id."' ";
		}
		else
		{
			$sql = '';
		}
		$query = "SELECT * FROM category ".$sql." ORDER BY categ_nam";
		$result = $this->db->query($query);
		
		if($result->num_rows()>0)
		{
			return $result->result();
		}
	}
	
	function get_object_list($category ='')
	{
		if($category =='')
		{
			return false;
		}
		$this->db->query("SET NAMES utf8");
		
		$query = "SELECT obj_ids,obj_nam,obj_img_mini FROM object WHERE obj_categ=".$category." ORDER BY obj_nam";
		$result = $this->db->query($query);
		
		if($result->num_rows() > 0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_category_of_object($object='')
	{
		$query = "SELECT obj_categ FROM object WHERE obj_ids=".$object;
		$result = $this->db->query($query);
		
		if($result->num_rows()>0)
		{
			return $result->result();
		}
	}
	
	function get_object_type($id='')
	{
		$this->db->select('categ_alter');
		$result = $this->db->get_where('category',array('categ_ids'=>$id));
		if($result)
		{
			return $result->row();
		}
		else
		
		{
			return false;
		}
	}
	
	function get_next_object_id()
	{
		$this->db->select_max('obj_ids');
		$result = $this->db->get('object');
		
		if($result)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
						
	}
	
	function get_object_by_category($cat='')
	{
		$query = "	SELECT 	o.obj_ids,
							o.obj_categ,
							o.obj_nam,
							o.obj_stat,
							o.obj_img_size,
							o.obj_img_mini,
							c.categ_ids,
							c.categ_nam
					FROM object AS o,category AS c
					WHERE obj_categ=(SELECT c.categ_ids 
					FROM category AS c 
					WHERE c.categ_alter2='".$cat."') AND c.categ_alter2='".$cat."'";
		
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
	
	function get_object_by_id($field = "*",$id='')
	{
		if($id == '')
		{
			$id = (int) $this->uri->segment(3);
		}
		
		$query = "SELECT ".$field." FROM object WHERE obj_ids=".$id;
		
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
	function get_seo_of_object()
	{
		$id = (int) $this->uri->segment(3);
		$query = "SELECT * FROM parser WHERE par_object=".$id;
		
		$result = $this->db->query($query);
		
		if($result->num_rows()==1)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_object_tab()
	{
		$id = (int) $this->uri->segment(3);
		$query = "SELECT * FROM object_tab WHERE objt_tema=".$id;
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
	function get_menu_of_object($path)
	{
		if(file_exists($path))
		{
			$content = read_file($path);
			return $content;	
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_list_files($path) //Это заменим
	{
		$files = array();
		if(is_dir($path))
		{
			$handle = opendir($path);
			
			while(false !== ($file = readdir($handle)))
			{
				if ($file != "." && $file != "..") { 
					if(is_file($path.$file))
					{
						$files[] = $file;
					}
					
				} 
			}
			return $files;
		}
		
		
	}
	
	function get_object_gallery($id)
	{
		$this->db->distinct();
		$result = $this->db->get_where('gallery',array('gal_for'=>$id));
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
		
	}
	
	function get_object_gallery_item($id)
	{
		$this->db->distinct();
		$result = $this->db->get_where('gallery',array('gal_ids'=>$id));
		if($result->num_rows()>0)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
		
	}
	
	function insert_object_gallery_item($data)
	{
		if($this->db->insert('gallery',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_object_gallery_item($id)
	{
		$result = $this->db->delete('gallery',array('gal_ids'=>$id));
		if($result)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_object_img_menu($id)
	{
		
	}
	
	function get_object_map_podezd($id)
	{
		$result = $this->db->get_where('map_podezd',array('mapz_for'=>$id));
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
		
	}
	function get_object_map_item($id)
	{
		$result = $this->db->get_where('map_podezd',array('mapz_ids'=>$id));
		if($result->num_rows()>0)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
		
	}
	function insert_object_map_item($data)
	{
		if($this->db->insert('map_podezd',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function insert_object_menu_item($data)
	{
		if($this->db->insert('img_menu',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_object_map_item($id)
	{
		$result = $this->db->delete('map_podezd',array('mapz_ids'=>$id));
		if($result)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	
	
	function get_object_map_zall($id)
	{
		$result = $this->db->get_where('map_zal',array('map_for'=>$id));
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_object_sheme_item($id)
	{
		$result = $this->db->get_where('map_zal',array('map_ids'=>$id));
		if($result->num_rows()>0)
		{
			return $result->row();
		}
		else
		{
			return FALSE;
		}
		
	}
	
	function insert_object_sheme_item($data)
	{
		if($this->db->insert('map_zal',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_object_sheme_item($id)
	{
		$result = $this->db->delete('map_zal',array('map_ids'=>$id));
		if($result)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	
	function get_object_stat()
	{
		$id = (int) $this->uri->segment(3);
		$query = "SELECT * FROM coun WHERE cou_for=".$id." LIMIT 1";
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
	
	function update_object_stat($id,$data)
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

	
	function delete_graphic_item($path)
	{
		if(file_exists($path))
		{
			unlink($path);
			return true;
		}
		else
		{
			return FALSE;
		}
	}
	
	function update_html_menu($file,$data)
	{
		if ( ! write_file($file, $data))
		{
		     return FALSE;
		}
		else
		{
		     return TRUE;
		}
	}
	
	function get_feedback($arg='')
	{
		$id = (int)$arg['id'];
		$type = $arg['type'];
		
		
		$query = "SELECT * FROM feedback WHERE feed_for='".$id."' AND feed_type='".$type."' ORDER BY feed_ids DESC;";
		
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
	
	function get_feedback_by_id($id)
	{
		if(!$id){return FALSE;}
		
		$query = "SELECT * FROM feedback WHERE feed_ids='".$id."' LIMIT 1";
		
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
	
	function update_feedback($data)
	{
				
		$this->db->where('feed_ids', $data['feed_ids']);
		if($this->db->update('feedback', $data['new_data']))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function object_tab_update($k,$data)
	{
		$this->db->where('objt_ids',$k);
		if($this->db->update('object_tab', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function object_update($id,$data)
	{
		$this->db->where('obj_ids',$id);
		if($this->db->update('object', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function update_object_seo($id,$data)
	{
		$this->db->where('par_object',$id);
		if($this->db->update('parser', $data))
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
	
	function object_add($data)
	{
		if($this->db->insert('object',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function add_object_seo($data)
	{
		if($this->db->insert('parser',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function object_tab_insert($data)
	{
		if($this->db->insert('object_tab',$data))
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