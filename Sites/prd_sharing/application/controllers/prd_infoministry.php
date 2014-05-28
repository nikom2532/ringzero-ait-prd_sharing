<?php
class PRD_InfoMinistry extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_info_ministry_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';
		
		$data['ministry'] = $this->prd_info_ministry_model->get_Ministry($this->input->get('minis_id'));

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/infoministry', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}