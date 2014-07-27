<?php
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
// require APPPATH.'/libraries/REST_Controller.php';

class PRD_Authen_Normal_2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('prd_authen_model');
	}

	public function index()
	{
		$params = array(
			'username' => $this->input->get('username'), 
			'password' => $this->input->get('password'), 
		);
		$this->load->library('curl');
		
		$source = $this->curl->simple_post('http://111.223.32.9/prdservice/api/authenticate', $params, array(CURLOPT_BUFFERSIZE => 10));
		var_dump($source);
		exit;
		
		
		//Is not authen with new Datbase -> Member Table
		//Authen with Old PRD Database
		
		$authen_PRD_DB = $this->prd_authen_model->get_SC03_User_with_SC03_UserID(
			$this->input->post('prd_UserID')
		);
		// var_dump($authen_PRD_DB);
		
		if($authen_PRD_DB != null){
			
			$authen_Member_with_SC03UserID = $this->prd_authen_model->
				get_Member_with_SC03UserID(
					$authen_PRD_DB[0]->SC03_UserID
				);
				// var_dump($authen_Member_with_SC03UserID);
				// exit;
			
			if($authen_Member_with_SC03UserID != null){
				$member_id = array(
                   'member_id'  => $authen_Member_with_SC03UserID[0]->Mem_ID,
                   'Mem_Username' => $authen_PRD_DB[0]->Mem_Username,
                   'Mem_Title' => $authen_PRD_DB[0]->Mem_Title,
                   'Mem_Name' => $authen_PRD_DB[0]->Mem_Name,
                   'Mem_LasName' => $authen_PRD_DB[0]->Mem_LasName,
                   'Mem_EngName' => $authen_PRD_DB[0]->Mem_EngName,
                   'Mem_EngLasName' => $authen_PRD_DB[0]->Mem_EngLasName,
                   'Mem_Status' => $authen_Member_with_SC03UserID[0]->Mem_Status,
                   'Mem_Ministry' => $authen_Member_with_SC03UserID[0]->Mem_Ministry,
                   'Group_ID' => $authen_Member_with_SC03UserID[0]->Group_ID
				);
				$this->session->set_userdata($member_id);
				// echo $this->session->userdata($member_id);
				// var_dump($this->session->all_userdata());
				// exit;
				
				$this->prd_authen_model->set_UserLogin(
					$authen_Member_with_SC03UserID[0]->Mem_ID,
					$authen_Member_with_SC03UserID[0]->Group_ID
				);
				
				redirect(base_url().index_page().'homePRD', 'refresh');
				
			}
			else{
				$member_id = array(
                   'member_id'  => $this->input->post('prd_UserID'),
                   'Mem_Username' => $authen_PRD_DB[0]->Mem_Username,
                   'Mem_Title' => $authen_PRD_DB[0]->Mem_Title,
                   'Mem_Name' => $authen_PRD_DB[0]->Mem_Name,
                   'Mem_LasName' => $authen_PRD_DB[0]->Mem_LasName,
                   'Mem_EngName' => $authen_PRD_DB[0]->Mem_EngName,
                   'Mem_EngLasName' => $authen_PRD_DB[0]->Mem_EngLasName,
                   'Mem_Status' => '',
                   'Mem_Ministry' => '',
                   'Group_ID' => '3'
				);
				$this->session->set_userdata($member_id);
				// echo $this->session->userdata($member_id);
				// var_dump($this->session->all_userdata());
				// exit;
				
				$this->prd_authen_model->set_UserLogin(
					$this->input->post('prd_UserID'),
					'3'
				);
		
				redirect(base_url().index_page().'homePRD', 'refresh');
			}
		}
		else{
			$data["error"] = "Username or Password wrong";
		}
		
		
		
		$data['title'] = 'Login PRD Sharing';
		$this->load->view('prdsharing/templates/header_authen', $data);
		$this->load->view('prdsharing/authen/login', $data);
	}
}