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
		$data['title'] = 'Login PRD Sharing';
		$this->load->view('prdsharing/templates/header_authen', $data);
		$this->load->view('prdsharing/authen/login', $data);
	}
	
	public function authen()
	{
		$data['title'] = 'Login PRD Sharing';
		
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
                   'member_id'  => $authen[0]->Mem_Username
				);
				
				// var_dump($member_id);
				
				// $this->session->userdata($member_id);
				$this->session->set_userdata($member_id);
				
				echo $this->session->userdata($member_id);
				
				// var_dump($this->session->all_userdata());
				
				redirect('/homePRD', 'refresh');
			}
			else{
				$data["error"] = "Username or Password wrong";
			}
		}
		
		$this->load->view('prdsharing/templates/header_authen', $data);
		$this->load->view('prdsharing/authen/login', $data);
	}
}