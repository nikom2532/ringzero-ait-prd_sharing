<?php
class PRD_Authen_Normal_1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('curl');
		$this->load->model('prd_authen_model');
	}
	
	public function index()
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
				
				//#############
				//SET USER LOG - IMPORTANT
				// $this->prd_authen_model->set_UserLog($authen[0]->Mem_ID);
				//#############
				
				// $_SESSION["member_id"] = $authen[0]->Mem_Username;
				$member_id = array(
		           'member_id'  => $authen[0]->Mem_ID,
		           'Mem_Username' => $authen[0]->Mem_Username,
		           'Mem_Title' => $authen[0]->Mem_Title,
		           'Mem_Name' => $authen[0]->Mem_Name,
		           'Mem_LasName' => $authen[0]->Mem_LasName,
		           'Mem_EngName' => $authen[0]->Mem_EngName,
		           'Mem_EngLasName' => $authen[0]->Mem_EngLasName,
		           'Mem_Status' => $authen[0]->Mem_Status,
		           'Mem_Ministry' => $authen[0]->Mem_Ministry,
		           'Group_ID' => $authen[0]->Group_ID
				);
				$this->session->set_userdata($member_id);
				// var_dump($this->session->all_userdata());
				$this->prd_authen_model->set_UserLogin(
					$authen[0]->Mem_ID,
					$authen[0]->Group_ID
				);
				
				redirect(base_url().index_page().'homePRD', 'refresh');
			}
			else{
				
				$params = array(
					'username' => $this->input->post('username'), 
					'password' => $this->input->post('password'), 
				);
				$this->load->library('curl');
				
				$authen_PRD_Source = $this->curl->simple_post('http://111.223.32.9/prdservice/api/authenticate', $params, array(CURLOPT_BUFFERSIZE => 10));
				$authen_PRD_Source = json_decode($authen_PRD_Source);
				
				//Is not authen with new Datbase -> Member Table
				//Authen with Old PRD Database
				
				$authen_PRD_DB = $this->prd_authen_model->get_SC03_User_with_SC03_UserID(
					$authen_PRD_Source->UserID
				);
				
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
						// var_dump($this->session->all_userdata());
						
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
						// var_dump($this->session->all_userdata());
						
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
				
			}
		}
		else{
			$data["error"] = "Please enter Username and Password";
			$this->load->view('prdsharing/templates/header_authen');
			$this->load->view('prdsharing/authen/login', $data);
		}
	}
}