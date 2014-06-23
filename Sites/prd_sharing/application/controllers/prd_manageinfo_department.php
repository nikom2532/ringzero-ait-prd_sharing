<?php
class PRD_manageInfo_Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manageinfo_department_model');
	}

	public function index()
	{
		//Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['member_id'] = $this->session->userdata('member_id');
			$data['session_Mem_Username'] = $this->session->userdata('Mem_Username');
			$data['session_Mem_Title'] = $this->session->userdata('Mem_Title');
			$data['session_Mem_Name'] = $this->session->userdata('Mem_Name');
			$data['session_Mem_LasName'] = $this->session->userdata('Mem_LasName');
			$data['session_Mem_EngName'] = $this->session->userdata('Mem_EngName');
			$data['session_Mem_EngLasName'] = $this->session->userdata('Mem_EngLasName');
			
			$data['title'] = 'Manage Info';
			
			
			//For Query Add new
			if($this->input->post('info_department_is_add') == "yes"){
				// echo "save";
				// echo $this->input->post('dep_name');
				$this->prd_manageinfo_department_model->set_Department_New(
					$this->input->post('dep_name'),
					$this->input->post('dep_desc'),
					$this->input->post('dep_status'),
					$this->input->post('ministry_id')
				);
			}
		
		
			//For Query Save
			else if($this->input->post('info_department_is_submit') == "yes"){
				// echo "save";
				// echo $this->input->post('minis_status');
				$this->prd_manageinfo_department_model->set_Department(
					$this->input->post('dep_id'),
					$this->input->post('dep_name'),
					$this->input->post('dep_desc'),
					$this->input->post('dep_status'),
					$this->input->post('ministry_id')
				);
			}
			
			
			else if($this->input->get('del_department') == "1"){
				// echo "deleted";
				// echo $this->input->get('dep_id');
				$this->prd_manageinfo_department_model->del_Department(
					$this->input->get('dep_id')
				);
				
			}
			
			// echo "Asdf";
			// var_dump($manageInfo_Category_is_search);
			
			
			//For Query Show
			if($this->input->post('manageInfo_Category_is_search') == "yes"){
				$data['department'] = $this->prd_manageinfo_department_model->get_Department_search(
					$this->input->post('dep_name'), 
					$this->input->post('dep_status')
				);
				
				if($this->input->post('dep_name') != ""){
					$data['post_dep_name'] = $this->input->post('dep_name');
				}
				if($this->input->post('dep_status') != ""){
					$data['post_dep_status'] = $this->input->post('dep_status');
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
		else{
			redirect(base_url().'/', 'refresh');
		}
	}
}