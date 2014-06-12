<?php
class PRD_ManageInfo_Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manageinfo_category_model');
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
			
			if($this->input->post('manageInfo_Category_is_search') == "yes"){
				
				// echo "yes";
				
				$data['category_old'] = $this->prd_manageinfo_category_model->get_NT02_NewsType_search(
					$this->input->post('NT02_TypeName')//,
					// $this->input->post('NT02_Status')
				);
				
				// var_dump($data['category_old']);
				
				$data['category_new'] = $this->prd_manageinfo_category_model->get_Category();
			}
			
			else{
				$data['category_old'] = $this->prd_manageinfo_category_model->get_NT02_NewsType();
				$data['category_new'] = $this->prd_manageinfo_category_model->get_Category();
			}
	
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/manageinfocategory/manageinfocategory', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect('/', 'refresh');
		}
	}
	
	public function set_category($cate_oldid='' )
	{
		if($this->session->userdata('member_id') != ""){
			$_data = $this->prd_manageinfo_category_model->
				set_Category(
					$cate_oldid
				);
				
			echo json_encode($_data);
		}
		else{
			redirect('/', 'refresh');
		}
	}
}