<?php
class PRD_manageNewEditPRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manageneweditprd_model');
		$this->load->helper('utility_helper');
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
			
			$data['title'] = 'Manage News';
			
			$data['news'] = $this->prd_manageneweditprd_model->get_NT01_News($this->input->get('news_id'));
			
			$data['New_News'] = $this->prd_manageneweditprd_model->get_New_News($this->input->get('news_id'));
	
			
			$data['NT02_NewsType'] = $this->prd_manageneweditprd_model->get_NT02_NewsType();
			$data['NT03_NewsSubType'] = $this->prd_manageneweditprd_model->get_NT03_NewsSubType();
	
			// var_dump($data['news']);
	
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/managenew/manageneweditprd', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}
}