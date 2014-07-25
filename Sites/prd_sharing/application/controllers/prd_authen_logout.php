<?php
class PRD_Authen_Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_authen_model');
	}

	public function index()
	{
		$this->prd_authen_model->set_UserLogout(
			$this->session->userdata('member_id'),
			$this->session->userdata('Group_ID')
		);
		//Logout
		$this->session->unset_userdata('member_id');
		$this->session->unset_userdata('Mem_Username');
		$this->session->unset_userdata('Mem_Title');
		$this->session->unset_userdata('Mem_Name');
		$this->session->unset_userdata('Mem_LasName');
		$this->session->unset_userdata('Mem_EngName');
		$this->session->unset_userdata('Mem_EngLasName');
		redirect(base_url().index_page().'', 'refresh');
	}
}