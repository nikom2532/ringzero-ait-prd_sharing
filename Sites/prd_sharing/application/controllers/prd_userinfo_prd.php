<?php
class PRD_UserInfo_PRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('PRD_UserInfo_PRD_model');
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
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$data["Group_ID"] = $this->session->userdata('Group_ID');
			$this->authenstatus->Group_ID = $data["Group_ID"];
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			if($showStatus == "yes"){
				
				if($this->input->post('update_member') == "yes"){
					//For Update member
					
					if($this->input->post('mem_title') != "อื่นๆ"){
						$mem_title = $this->input->post('mem_title');
					}
					else{
						$mem_title = $this->input->post('tname_other_text');
					}
					
					//If ther are Admin
					if($data["Group_ID"] == 2){
						$this->PRD_UserInfo_PRD_model->update_Member(
							$this->input->post('member_id'),
							$this->input->post('group_member'),
							$this->input->post('mem_status')
						);
					}
					else{
						$this->PRD_UserInfo_PRD_model->update_Member(
							$this->input->post('member_id'),
							"",
							$this->input->post('mem_status')
						);
					}
					
					redirect(base_url().index_page().'manageUserPRD', 'refresh');
				}
			
				$data['Mem_ID'] = $this->input->get('userid');
				
				$data['SC03_User'] = $this->PRD_UserInfo_PRD_model->
					get_SC03_User($this->input->get('userid'));
				
				$data['Member'] = $this->PRD_UserInfo_PRD_model->
					get_Member($this->input->get('userid'));
					
				$data['Ministry'] = $this->PRD_UserInfo_PRD_model->get_Ministry();
				$data['Department'] = $this->PRD_UserInfo_PRD_model->get_Department();
				
				// $data['CM06_Province'] = $this->PRD_UserInfo_PRD_model->get_CM06_Province();
				// $data['CM07_Ampur'] = $this->PRD_UserInfo_PRD_model->get_CM07_Ampur();
				// $data['CM08_Tumbon'] = $this->PRD_UserInfo_PRD_model->get_CM08_Tumbon();
				$data['GroupMember'] = $this->PRD_UserInfo_PRD_model->get_GroupMember();
				
				
				$this->load->view('prdsharing/templates/header', $data);
				$this->load->view('prdsharing/manageuser/userinfo_prd', $data);
				$this->load->view('prdsharing/templates/footer');
			}
			else{
				redirect(base_url().index_page().'', 'refresh');
			}
			
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}
}