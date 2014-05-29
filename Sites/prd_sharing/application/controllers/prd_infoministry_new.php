<?php
class PRD_InfoMinistry_New extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_info_ministry_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/infoministry_new', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}