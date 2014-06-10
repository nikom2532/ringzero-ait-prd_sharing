<?php
class PRD_UserInfo_Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_userinfo_register_model');
	}

	public function index()
	{
		//Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['title'] = 'Register PRD Sharing';
			$data['Ministry'] = $this->prd_userinfo_register_model->get_Ministry();
			$data['Department'] = $this->prd_userinfo_register_model->get_Department();
			$data['CM06_Province'] = $this->prd_userinfo_register_model->get_CM06_Province();
			$data['CM07_Ampur'] = $this->prd_userinfo_register_model->get_CM07_Ampur();
			$data['CM08_Tumbon'] = $this->prd_userinfo_register_model->get_CM08_Tumbon();
			$data['GroupMember'] = $this->prd_userinfo_register_model->get_GroupMember();
			
			
			$this->load->view('prdsharing/templates/header_authen', $data);
			$this->load->view('prdsharing/manageuser/userinfo_register', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect('/', 'refresh');
		}
	}
	
	public function get_Department($Ministry_ID='')
	{
		$_data = $this->prd_userinfo_register_model->get_Department_Unique($Ministry_ID);
		echo json_encode($_data);
	}
	
	public function get_CM07_Ampur_Unique($ProvinceID = '')
	{
		$_data = $this->prd_userinfo_register_model->get_CM07_Ampur_Unique($ProvinceID);
		echo json_encode($_data);
	}
	
	public function get_CM08_Tumbon_Unique($AmpurID = '')
	{
		$_data = $this->prd_userinfo_register_model->get_CM08_Tumbon_Unique($AmpurID);
		echo json_encode($_data);
	}
}