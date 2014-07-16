<?php
class PRD_UserInfo_GOVE extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('PRD_UserInfo_GOVE_model');
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
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			if($showStatus == "yes"){
			
				if($this->input->post('update_member') == "yes"){
					
					?><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
					
					// var_dump($_POST);
					// exit;
					
					if($this->input->post('mem_title') == 1){
						$mem_title = "นาย";
					}
					elseif($this->input->post('mem_title') == 2){
						$mem_title = "นาง";
					}
					elseif($this->input->post('mem_title') == 3){
						$mem_title = "นางสาว";
					}
					elseif($this->input->post('mem_title') == 4){
						$mem_title = $this->input->post('tname_other_text');
					}
					
					$this->PRD_UserInfo_GOVE_model->update_Member(
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
						$this->input->post('mem_mobile'),
						$this->input->post('group_member'),
						$this->input->post('mem_status')
					);
					
					redirect(base_url().index_page().'manageUserGOVE', 'refresh');
				}
				else {
					
					$data['Mem_ID'] = $this->input->get('userid');
					
					$data['SC03_User'] = $this->PRD_UserInfo_GOVE_model->
						get_SC03_User($this->input->get('userid'));
					
					$data['Member'] = $this->PRD_UserInfo_GOVE_model->
						get_Member($this->input->get('userid'));
					
					$data['Ministry'] = $this->PRD_UserInfo_GOVE_model->get_Ministry();
					$data['Department'] = $this->PRD_UserInfo_GOVE_model->get_Department();
					
					
					$data['CM06_Province'] = $this->PRD_UserInfo_GOVE_model->get_CM06_Province();
					$data['CM07_Ampur'] = $this->PRD_UserInfo_GOVE_model->get_CM07_Ampur();
					$data['CM08_Tumbon'] = $this->PRD_UserInfo_GOVE_model->get_CM08_Tumbon();
					$data['GroupMember'] = $this->PRD_UserInfo_GOVE_model->get_GroupMember();
					
					$this->load->view('prdsharing/templates/header', $data);
					$this->load->view('prdsharing/manageuser/userinfo_gove', $data);
					$this->load->view('prdsharing/templates/footer');
				}
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