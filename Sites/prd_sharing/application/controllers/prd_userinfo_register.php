<?php
class PRD_UserInfo_Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_userinfo_register_model');
	}

	public function index()
	{
		$data['title'] = 'Register PRD Sharing';
		$data['Ministry'] = $this->prd_userinfo_register_model->get_Ministry();
		$data['Department'] = $this->prd_userinfo_register_model->get_Department();
		$data['CM06_Province'] = $this->prd_userinfo_register_model->get_CM06_Province();
		$data['CM07_Ampur'] = $this->prd_userinfo_register_model->get_CM07_Ampur();
		$data['CM08_Tumbon'] = $this->prd_userinfo_register_model->get_CM08_Tumbon();
		

		$this->load->view('prdsharing/templates/header_authen', $data);
		$this->load->view('prdsharing/manageuser/userinfo_register', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}