<?php
class PRD_ManageNew_detail_GROV extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_managenew_detail_grov_model');
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
			
			$data['title'] = 'Home';
			
			$data['news'] = $this->prd_managenew_detail_grov_model->get_grov($this->input->get('sendinformation_id'));
			$data['get_grov_fileattach'] = $this->prd_managenew_detail_grov_model->get_grov_fileattach($this->input->get('sendinformation_id'));
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/managenew/detail_grov', $data);
			$this->load->view('prdsharing/templates/footer');
		
		}
		else{
			redirect('/', 'refresh');
		}
	}
}