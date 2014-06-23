<?php
class PRD_Authen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_authen_model');
	}

	public function index()
	{
		if($this->session->userdata('member_id') == ""){
			$data['title'] = 'Login PRD Sharing';
			$this->load->view('prdsharing/templates/header_authen', $data);
			$this->load->view('prdsharing/authen/login', $data);
		}
		else{
			redirect(base_url().'homePRD', 'refresh');
		}
	}
	
	public function authen()
	{
		$data['title'] = 'Login PRD Sharing';
		
		//FOr Test Logout
		// $this->session->unset_userdata('member_id');
		
		if(
			$this->input->post('username') != "" && 
			$this->input->post('password') != ""
		){
			$authen = $this->prd_authen_model->
				get_Member(
					$this->input->post('username'),
					$this->input->post('password')
				);
			
			if($authen != null){
				// echo "can login";
				// $_SESSION["member_id"] = $authen[0]->Mem_Username;
				$member_id = array(
                   'member_id'  => $authen[0]->Mem_ID,
                   'Mem_Username' => $authen[0]->Mem_Username,
                   'Mem_Title' => $authen[0]->Mem_Title,
                   'Mem_Name' => $authen[0]->Mem_Name,
                   'Mem_LasName' => $authen[0]->Mem_LasName,
                   'Mem_EngName' => $authen[0]->Mem_EngName,
                   'Mem_EngLasName' => $authen[0]->Mem_EngLasName,
				);
				$this->session->set_userdata($member_id);
				// echo $this->session->userdata($member_id);
				// var_dump($this->session->all_userdata());
				
				redirect(base_url().'homePRD', 'refresh');
			}
			else{
				$data["error"] = "Username or Password wrong";
			}
		}
		
		$this->load->view('prdsharing/templates/header_authen', $data);
		$this->load->view('prdsharing/authen/login', $data);
	}
}