<?php
class upload extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view("upload.html");
	}
	
	function do_upload()
	{
			
		// Import library
		$this->load->library("multiupload");
		$this->multiupload->_files = $_FILES;
		$this->multiupload->upload_path = "./upload";
		$this->multiupload->allowed_types = "jpg|png";
		$this->multiupload->max_size = "2048";
		$this->multiupload->init();
		$file_name = $this->multiupload->do_upload();

		// ใช้ $file_name วนลูปสำหรับเชื่อมโยงกับ Record ในฐานข้อมูล
		print_r($file_name);

	}

}

