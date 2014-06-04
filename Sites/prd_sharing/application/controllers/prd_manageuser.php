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
		$data['Department'] = $this->prd_manage_user_model->get_Department();
		
		if($this->input->post('manage_user_is_search') == "yes"){
			
			$data['SC03_User'] = $this->prd_manage_user_model->get_SC03_User_search(
				$this->input->post('search_key'),
				$this->input->post('sc03_status'),
				$this->input->post('cm06_province_id')
			);
			// $search_key
		}
		elseif($this->input->post('register_new_member') == "yes"){
			//For register a new Member
			
			if($this->input->post('mem_title') != "อื่นๆ"){
				$mem_title = $this->input->post('mem_title');
			}
			else{
				$mem_title = $this->input->post('tname_other_text');
			}
			
			$this->prd_manage_user_model->set_Member(
				$this->input->post('sex'),
				$mem_title,
				$this->input->post('fname'),
				$this->input->post('lname'),
				$this->input->post('engfname'),
				$this->input->post('englname'),
				$this->input->post('mem_username'),
				$this->input->post('mem_password1'),
				$this->input->post('mem_card_id'),
				$this->input->post('mem_ministry'),
				$this->input->post('mem_department'),
				$this->input->post('mem_province'),
				$this->input->post('mem_ampur'),
				$this->input->post('mem_tumbon'),
				$this->input->post('mem_address'),
				$this->input->post('mem_email'),
				$this->input->post('mem_postcode'),
				$this->input->post('mem_nickname'),
				$this->input->post('mem_tel'),
				$this->input->post('mem_moble'),
				$this->input->post('group_member'),
				$this->input->post('mem_status')
			);
			
			$data['Member'] = $this->prd_manage_user_model->get_Member();
			$data['SC03_User'] = $this->prd_manage_user_model->get_SC03_User();
		}
		else{
			$data['Member'] = $this->prd_manage_user_model->get_Member();
			$data['SC03_User'] = $this->prd_manage_user_model->get_SC03_User();
		}
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageuser/manageuser', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}