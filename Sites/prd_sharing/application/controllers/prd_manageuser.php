<?php
class PRD_ManageUser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_manage_user_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Users';
		
		$data['CM06_Province'] = $this->prd_manage_user_model->get_CM06_Province();
		
		if($this->input->post('manage_user_is_search') == "yes"){
			
			$data['SC03_User'] = $this->prd_manage_user_model->get_SC03_User_search(
				$this->input->post('search_key'),
				$this->input->post('sc03_status'),
				$this->input->post('cm06_province_id')
			);
			// $search_key
		}
		else{
			
			$data['SC03_User'] = $this->prd_manage_user_model->get_SC03_User();
			
		}
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageuser/manageuser', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}