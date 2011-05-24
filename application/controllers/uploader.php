<?php
class Uploader extends Controller
{
	function Uploader()
	{
		parent::Controller();
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	
	/*
	*	Display upload form
	*/

	/*
	*	Handles JSON returned from /js/uploadify/upload.php
	*/
	function uploadify()
	{
		
		//Decode JSON returned by /js/uploadify/upload.php
		$file = $this->input->post('filearray');
		$data['json'] = json_decode($file);
		
		$this->load->view('default/template/photo/ajax/uploadify',$data);
	}
	
}
/* End of File /application/controllers/upload.php */