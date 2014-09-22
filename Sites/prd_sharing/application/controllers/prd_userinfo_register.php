<?php
class PRD_UserInfo_Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		// $this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('prd_userinfo_register_model');
		$this->load->library('email');
	}

	public function index()
	{
		if($this->input->post('register_new_member') == "yes"){
				
				// redirect(base_url().index_page().'PRD_UserInfo_Register/set_register_new_member', 'refresh');
				
				if($this->input->post('mem_title') != "อื่นๆ"){
					$mem_title = $this->input->post('mem_title');
				}
				else{
					$mem_title = $this->input->post('tname_other_text');
				}
				
				$this->prd_userinfo_register_model->set_Member(
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

				$config['protocol'] = 'smtp';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['smtp_host'] = "mail.aitinnovation.co.th";
				$config['smtp_user'] = "no-reply@aitinnovation.co.th";
				$config['smtp_pass'] = "shk,9v[";
				$config['smtp_port'] = 25;

				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('no-reply@aitinnovation.co.th', 'Register email');
				$this->email->to($this->input->post('mem_email')); 
				$this->email->subject('Register email to logon PRDsharing');
				$this->email->message('Waiting for admin to registering username to login');	
				$this->email->send();
				
				redirect(base_url().index_page().'manageUserGOVE', 'refresh');
				
		}
		else{
			
			$data['title'] = 'Register PRD Sharing';
			$data['Ministry'] = $this->prd_userinfo_register_model->get_Ministry();
			$data['Department'] = $this->prd_userinfo_register_model->get_Department();
			$data['CM06_Province'] = $this->prd_userinfo_register_model->get_CM06_Province();
			$data['CM07_Ampur'] = $this->prd_userinfo_register_model->get_CM07_Ampur();
			$data['CM08_Tumbon'] = $this->prd_userinfo_register_model->get_CM08_Tumbon();
			$data['GroupMember'] = $this->prd_userinfo_register_model->get_GroupMember();
			
			
			$this->load->view('prdsharing/templates/header_authen', $data);
			$this->load->view('prdsharing/manageuser/userinfo_register', $data);
			$this->load->view('prdsharing/templates/footer');
		}
	}
	
	public function get_Department($Ministry_ID='')
	{
		$_data = $this->prd_userinfo_register_model->get_Department_Unique($Ministry_ID);
		echo json_encode($_data);
	}
	
	public function get_CM07_Ampur_Unique($ProvinceID = '')
	{
		$_data = $this->prd_userinfo_register_model->get_CM07_Ampur_Unique($ProvinceID);
		echo json_encode($_data);
	}
	
	public function get_CM08_Tumbon_Unique($AmpurID = '')
	{
		$_data = $this->prd_userinfo_register_model->get_CM08_Tumbon_Unique($AmpurID);
		echo json_encode($_data);
	}
}