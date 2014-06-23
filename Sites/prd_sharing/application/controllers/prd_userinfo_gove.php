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
			
			if($this->input->post('update_member') == "yes"){
				
				//For Update member
				
				if($this->input->post('mem_title') != "อื่นๆ"){
					$mem_title = $this->input->post('mem_title');
				}
				else{
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
					$this->input->post('mem_moble'),
					$this->input->post('group_member'),
					$this->input->post('mem_status')
				);
				
				redirect(base_url().'manageUserGOVE', 'refresh');
			}
			else {
				
				$data['title'] = 'Manage Users';
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
			redirect(base_url().'/', 'refresh');
		}
	}
}