<?php
class PRD_InfoDepartment_New extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PRD_Info_Department_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';
		
		$data['ministry'] = $this->PRD_Info_Department_model->get_Ministry();
		// $data['department'] = $this->PRD_Info_Department_model->get_Department($this->input->get('dep_id'));
		
		// var_dump($data['department']);
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/infodepartment_new', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}