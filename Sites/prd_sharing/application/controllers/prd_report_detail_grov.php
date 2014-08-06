<?php
class PRD_Report_detail_GROV extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_report_detail_grov_model');
	}

	public function index()
	{
		//Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['member_id'] = $this->session->userdata('member_id');
			$data['session_Mem_Username'] = $this->session->userdata('Mem_Username');
			$data['session_Mem_Title'] = $this->session->userdata('Mem_Title');
			$data['session_Mem_Name'] = $this->session->userdata('Mem_Name');
			$data['session_Mem_LasName'] = $this->session->userdata('Mem_LasName');
			$data['session_Mem_EngName'] = $this->session->userdata('Mem_EngName');
			$data['session_Mem_EngLasName'] = $this->session->userdata('Mem_EngLasName');
			
			$data['title'] = 'Report';
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			if($showStatus == "yes"){
			
				$data['news'] = $this->prd_report_detail_grov_model->get_grov($this->input->get('sendinformation_id'));
				$data['get_grov_fileattach'] = $this->prd_report_detail_grov_model->get_grov_fileattach($this->input->get('sendinformation_id'));
				
				$this->prd_report_detail_grov_model->set_gove($data['news']);
				
				$data['NT05_Policy'] = $this->prd_report_detail_grov_model->get_NT05_Policy();
				$CI_stringManagement =& get_instance();
				$CI_stringManagement->load->library('string_management');
				$data["CI_stringManagement"] = $CI_stringManagement;
				
				$this->load->view('prdsharing/templates/header', $data);
				// $this->load->view('prdsharing/reportprd/report_detail_grov', $data);
				$this->load->view('prdsharing/managenew/detail_grov', $data);
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
}