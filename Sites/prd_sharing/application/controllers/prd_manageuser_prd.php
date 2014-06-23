<?php
class PRD_ManageUser_PRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manage_user_prd_model');
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
			
			$data['title'] = 'Manage Users';
			
			$data['CM06_Province'] = $this->prd_manage_user_prd_model->get_CM06_Province();
			$data['Department'] = $this->prd_manage_user_prd_model->get_Department();
			
			// if($this->input->post('manage_user_is_search') == "yes"){
	// 			
				// $data['SC03_User'] = $this->prd_manage_user_prd_model->get_SC03_User_search(
					// $this->input->post('search_key'),
					// $this->input->post('sc03_status'),
					// $this->input->post('cm06_province_id')
				// );
				// // $search_key
			// }
			/*else*/if($this->input->post('update_member') == "yes"){
				//For Update member
				
				if($this->input->post('mem_title') != "อื่นๆ"){
					$mem_title = $this->input->post('mem_title');
				}
				else{
					$mem_title = $this->input->post('tname_other_text');
				}
				
				$this->prd_manage_user_prd_model->update_Member(
					$this->input->post('member_id'),
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
			}
			
			if($this->input->post('manage_user_is_search') == "yes"){
				$data['Member'] = $this->prd_manage_user_prd_model->
					get_Member_search(
						$this->input->post('search_key'),
						$this->input->post('mem_status'),
						$this->input->post('province_id')
					);
				$data['post_search_key'] = $this->input->post('search_key');
				$data['post_mem_status'] = $this->input->post('mem_status');
				$data['post_province_id'] = $this->input->post('province_id');
			}
			else{
				$data['Member'] = $this->prd_manage_user_prd_model->get_Member();
				$data['SC03_User'] = $this->prd_manage_user_prd_model->get_SC03_User();
			}
			
			
			$data['SC07_Department'] = $this->prd_manage_user_prd_model->get_SC07_Department();
			
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/manageuser/manageuser_prd', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect(base_url().'/', 'refresh');
		}
	}
}