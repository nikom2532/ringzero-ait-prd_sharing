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
		//##########################################################
		/*
		//For Test when have no internet
		$member_id = array(
           'member_id'  => 11,
           'Mem_Username' => 'aaa',
           'Mem_Title' => 'Mr.',
           'Mem_Name' => 'admin',
           'Mem_LasName' => 'admin',
           'Mem_Status' => 1,
           'Mem_Ministry' => '',
           'Group_ID' => 2
		);
		
		$this->session->set_userdata($member_id);
		redirect(base_url().index_page().'homePRD', 'refresh');
		
		//End For Test when have no internet
		*/
		//##########################################################
		
		if($this->session->userdata('member_id') == ""){
			$data['title'] = 'Login PRD Sharing';
			$this->load->view('prdsharing/templates/header_authen', $data);
			$this->load->view('prdsharing/authen/login', $data);
		}
		else{
			redirect(base_url().index_page().'homePRD', 'refresh');
		}
	}
	
	public function authen()
	{
		$data['title'] = 'Login PRD Sharing';
		
		//FOr Test Logout
		// $this->session->unset_userdata('member_id');
		
		// var_dump($_POST);
		
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
		           'Mem_Status' => $authen[0]->Mem_Status,
		           'Mem_Ministry' => $authen[0]->Mem_Ministry,
		           'Group_ID' => $authen[0]->Group_ID
				);
				$this->session->set_userdata($member_id);
				// echo $this->session->userdata($member_id);
				// var_dump($this->session->all_userdata());
				
				redirect(base_url().index_page().'homePRD', 'refresh');
			}
			else{
				//Is not authen with new Datbase -> Member Table
				//Authen with Old PRD Database
				
				$authen_PRD_DB = $this->prd_authen_model->get_SC03_User_with_SC03_UserID(
					$this->input->post('prd_UserID')
				);
				
				// var_dump($authen_PRD_DB);
				// exit;
				
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
						redirect(base_url().index_page().'homePRD', 'refresh');
					}
				}
				else{
					$data["error"] = "Username or Password wrong";
				}
				
				/*
				$authen_PRD_DB = $this->prd_authen_model->
					get_SC03_User(
						$this->input->post('username'),
						$this->input->post('password')
					);
					
					// var_dump($authen_PRD_DB);
					// echo $authen_PRD_DB[0]->SC03_UserID;
					// exit;
				
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
						redirect(base_url().index_page().'homePRD', 'refresh');
						
					}
				}
				else{
					$data["error"] = "Username or Password wrong";
				}
				
				*/
			}
		}
		else{
			$data["error"] = "Please enter Username and Password";
		}
		
		$this->load->view('prdsharing/templates/header_authen', $data);
		$this->load->view('prdsharing/authen/login', $data);
	}
}