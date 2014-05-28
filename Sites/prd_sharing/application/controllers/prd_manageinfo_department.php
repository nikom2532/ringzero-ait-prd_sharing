<?php
class PRD_manageInfo_Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_manageinfo_department_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';
		
		if($this->input->post('manageInfo_Category_is_search') == "yes"){
			$data['department'] = $this->prd_manageinfo_department_model->get_Department_departmentName($this->input->post('dep_name'), $this->input->post('minis_status'));
			
			if($this->input->post('dep_name') != ""){
				$data['post_dep_name'] = $this->input->post('dep_name');
			}
			if($this->input->post('minis_status') != ""){
				$data['post_minis_status'] = $this->input->post('minis_status');
			}
			
		}
		else{
			$data['department'] = $this->prd_manageinfo_department_model->get_Department();
		}
		
		// $data['department'] = $this->prd_manageinfo_department_model->get_Department();
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/manageinfodepartment', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}