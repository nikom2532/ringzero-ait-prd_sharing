<?php
class PRD_UserInfo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('PRD_UserInfo_model');
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
			
			$data['title'] = 'Manage Users';
			$data['Mem_ID'] = $this->input->get('userid');
			
			$data['SC03_User'] = $this->PRD_UserInfo_model->
				get_SC03_User($this->input->get('userid'));
			
			$data['Member'] = $this->PRD_UserInfo_model->
				get_Member($this->input->get('userid'));
			
			$data['Ministry'] = $this->PRD_UserInfo_model->get_Ministry();
			$data['Department'] = $this->PRD_UserInfo_model->get_Department();
			
			$data['CM06_Province'] = $this->PRD_UserInfo_model->get_CM06_Province();
			$data['CM07_Ampur'] = $this->PRD_UserInfo_model->get_CM07_Ampur();
			$data['CM08_Tumbon'] = $this->PRD_UserInfo_model->get_CM08_Tumbon();
			$data['GroupMember'] = $this->PRD_UserInfo_model->get_GroupMember();
			
	
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/manageuser/userinfo', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect('/', 'refresh');
		}
	}
}