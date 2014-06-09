<?php
class PRD_InfoDepartment extends CI_Controller {

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
			
			$data['title'] = 'Manage Info';
			
			$data['ministry'] = $this->PRD_Info_Department_model->get_Ministry();
			$data['department'] = $this->PRD_Info_Department_model->get_Department($this->input->get('dep_id'));
			
			// var_dump($data['department']);
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/manageinfocategory/infodepartment', $data);
			$this->load->view('prdsharing/templates/footer');
		}
		else{
			redirect('/', 'refresh');
		}
	}
}