<?php
class PRD_sentNew extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('PRD_SentNew_model');
	}

	public function index()
	{
		//Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['title'] = 'Sent News';
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			// var_dump($getMenuHeader);
			// exit;
			
			if($showStatus == "yes"){
				
				$data['member_id'] = $this->session->userdata('member_id');
				$data['session_Mem_Username'] = $this->session->userdata('Mem_Username');
				$data['session_Mem_Title'] = $this->session->userdata('Mem_Title');
				$data['session_Mem_Name'] = $this->session->userdata('Mem_Name');
				$data['session_Mem_LasName'] = $this->session->userdata('Mem_LasName');
				$data['session_Mem_EngName'] = $this->session->userdata('Mem_EngName');
				$data['session_Mem_EngLasName'] = $this->session->userdata('Mem_EngLasName');
				
				
				$data['Ministry'] = $this->PRD_SentNew_model->get_Ministry();
				$data['Department'] = $this->PRD_SentNew_model->get_Department();
				$data['NT05_Policy'] = $this->PRD_SentNew_model->get_NT05_Policy();
				$data['TargetGroup'] = $this->PRD_SentNew_model->get_TargetGroup();
				$data['SC07_Department'] = $this->PRD_SentNew_model->get_SC07_Department();
				
				$this->load->view('prdsharing/templates/header', $data);
				$this->load->view('prdsharing/sentnew/sentnew', $data);
				$this->load->view('prdsharing/templates/footer');
				
			}
			else{
				redirect(base_url().index_page().'', 'refresh');
			}
			
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}

	public function get_Department($Ministry_ID='')
	{
		$_data = $this->PRD_SentNew_model->get_Department_Unique($Ministry_ID);
		echo json_encode($_data);
	}
	
	public function sentnew_process()
	{
		// $this->load->view('prdsharing/templates/header');
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><?php
		header('Content-Type: text/html; charset=utf-8');
		
		if ($this->input->post('sentnew_is_add')) {
			
			//record a new news
			$query_sentnew_record = $this->PRD_SentNew_model->set_sentnew(
				$this->input->post('create_date'),
				$this->input->post('Minis_ID'),
				$this->input->post('Dep_ID'),
				$this->input->post('NT05_PolicyID'),
				$this->input->post('Tar_ID'),
				$this->input->post('grov_status'),
				$this->input->post('prd_status'),
				$this->input->post('SendIn_Plan'),
				$this->input->post('SendIn_Issue'),
				$this->input->post('SendIn_Detail')
			);
			
			$return_num_files = 0;
			foreach ($_FILES as $file) {
				if($file["name"] != null)
				{
					$return_num_files++;
				}
			}
				
			if($return_num_files > 0){
				// Import library
				$this->load->library("multiupload");
				$this->multiupload->_files = $_FILES;
				$this->multiupload->upload_path = "./uploads";
				$this->multiupload->allowed_types = "jpg|jpeg|gif|png|doc|docx|xls|xlsx|ppt|pptx|pdf|csv|mp3|ogg|mp4|avi|wmv";
				// $this->multiupload->max_size = "2048";
				$this->multiupload->init();
				$file_name = $this->multiupload->do_upload();
				
				// ใช้ $file_name วนลูปสำหรับเชื่อมโยงกับ Record ในฐานข้อมูล
				
				$set_AttachFile = $this->PRD_SentNew_model->set_AttachFile(
					$query_sentnew_record,
					$file_name
				);
			}
			
			redirect(base_url().index_page().'manageNewGROV', 'refresh');
		}
		else{
			redirect(base_url().index_page().'manageNewGROV', 'refresh');
		}
	}
	
	
	/*
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('prdsharing/sentnew/sentnew', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('prdsharing/sentnew/upload_success', $data);
		}
	}
	*/
}