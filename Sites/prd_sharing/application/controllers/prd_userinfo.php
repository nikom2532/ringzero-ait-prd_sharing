<?php
class PRD_UserInfo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PRD_UserInfo_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Users';
		
		$data['get_SC03_User'] = $this->PRD_UserInfo_model->
			get_SC03_User($this->input->get('userid'));

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageuser/userinfo', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}