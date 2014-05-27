<?php
class PRD_manageInfo_Ministry extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_manageinfo_ministry_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';
		
		$data['ministry'] = $this->prd_manageinfo_ministry_model->get_Ministry();
		
		// var_dump($data['ministry']);
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/manageinfoministry', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}