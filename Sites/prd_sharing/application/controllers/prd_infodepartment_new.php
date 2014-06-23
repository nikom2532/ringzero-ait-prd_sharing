<?php
class PRD_InfoDepartment_New extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('PRD_Info_Department_model');
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
			
			$data['title'] = 'Manage Info';
			
			$data['ministry'] = $this->PRD_Info_Department_model->get_Ministry();
			// $data['department'] = $this->PRD_Info_Department_model->get_Department($this->input->get('dep_id'));
			
			// var_dump($data['department']);
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/manageinfocategory/infodepartment_new', $data);
			$this->load->view('prdsharing/templates/footer');
		
		}
		else{
			redirect(base_url().'/', 'refresh');
		}
	}
}