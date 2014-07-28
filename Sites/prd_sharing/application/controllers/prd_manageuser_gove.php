<?php
class PRD_ManageUser_GOVE extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manage_user_gove_model');
	}

	public function index($page = 1)
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
			
				$data['CM06_Province'] = $this->prd_manage_user_gove_model->get_CM06_Province();
				$data['Department'] = $this->prd_manage_user_gove_model->get_Department();
				$data['Ministry'] = $this->prd_manage_user_gove_model->get_Ministry();
				
				$row_per_page = 20;
				
				// if($this->input->post('manage_user_is_search') == "yes"){
		// 			
					// $data['SC03_User'] = $this->prd_manage_user_gove_model->get_SC03_User_search(
						// $this->input->post('search_key'),
						// $this->input->post('sc03_status'),
						// $this->input->post('cm06_province_id')
					// );
					// // $search_key
				// }
				/*else*/if($this->input->post('register_new_member') == "yes"){
					//For register a new Member
					
					if($this->input->post('mem_title') != "อื่นๆ"){
						$mem_title = $this->input->post('mem_title');
					}
					else{
						$mem_title = $this->input->post('tname_other_text');
					}
					
					$this->prd_manage_user_gove_model->set_Member(
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
					$data['Member'] = $this->prd_manage_user_gove_model->
						get_Member_search(
							$page, 
							$row_per_page,
							$this->input->post('search_key'),
							$this->input->post('mem_status'),
							$this->input->post('province_id')
						);
					$count_row = $this->prd_manage_user_gove_model->count_Member_search(
						$this->input->post('search_key'),
						$this->input->post('mem_status'),
						$this->input->post('province_id')
					);
					$data['post_search_key'] = $this->input->post('search_key');
					$data['post_mem_status'] = $this->input->post('mem_status');
					$data['post_province_id'] = $this->input->post('province_id');
				}
				else{
					$data['Member'] = $this->prd_manage_user_gove_model->get_Member(
						$page, 
						$row_per_page
					);
					$count_row = $this->prd_manage_user_gove_model->count_Member();
					$data['SC03_User'] = $this->prd_manage_user_gove_model->get_SC03_User();
				}
				
				//############## Pagination = For no Search ################
				$data['count_row'] = $count_row;
				$url = "manageUserGOVE";
				
				$total_page   = $count_row / $row_per_page;
				$page_mod     = $count_row % $row_per_page;
				if($page_mod > 0){
					list($unsign) = explode(".",$total_page);
					$total_page = $unsign + 1;
				}
				$currentPage = $page == null?1:$page;
				$page_url = array();
				for($i = 0;$i < $total_page;$i++){
					array_push($page_url,array(
							"page"    =>$i + 1,
							"value"   =>$i + 1,
							"selected"=>($i + 1 == $page?"selected=selected":"")
						));
				}
				$data['total_page'] = $total_page;
				$data['current_page'] = $currentPage;
				$data['jump_url'] = base_url().index_page().$url;
				$data['next_page'] = 
					$currentPage == $total_page
						? base_url().index_page().$url."$total_page"
						: base_url().index_page().$url.($currentPage + 1);
				$data["prev_page"] = 
					($currentPage > 1
					? base_url().index_page().$url.($currentPage - 1)
					: base_url().index_page().$url."1");
				$data["total_page"]  =
					($total_page == 0?1 : $total_page);
				$data["page_url"] = $page_url;
				$data["first_page"] = base_url().index_page().$url."1";
				$data["last_page"] = base_url().index_page().$url."$total_page";
				$data["current_page"] = $page;
				$data["row_per_page"] = $row_per_page;
				
				//#########################################################
				
				$this->load->view('prdsharing/templates/header', $data);
				$this->load->view('prdsharing/manageuser/manageuser_gove', $data);
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