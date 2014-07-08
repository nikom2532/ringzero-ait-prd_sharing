<?php
class PRD_ManageNewGROV extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_managenewgrov_model');
		$this->load->library("pagination");
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
			
			$data['title'] = 'Manage News';
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			if($showStatus == "yes"){
			
				$row_per_page = 20;
				
				
				// elseif ($this->input->post('sentnew_is_add')) {
					// $query_sentnew_record = $this->prd_managenewgrov_model->set_sentnew(
						// $this->input->post('create_date'),
						// $this->input->post('Minis_ID'),
						// $this->input->post('Dep_ID'),
						// $this->input->post('NT05_PolicyID'),
						// $this->input->post('Tar_ID'),
						// $this->input->post('grov_active'),
						// $this->input->post('prd_active'),
						// $this->input->post('SendIn_Plan'),
						// $this->input->post('SendIn_Issue'),
						// $this->input->post('SendIn_Detail')
					// );
				// }
				if($this->input->get('is_del_sendinformation') == "1"){
					$data['delete_News'] = $this->prd_managenewgrov_model->delete_grov(
						$this->input->get('sendin_id')
					);
					redirect(base_url().index_page()."manageNewGROV");
				}
				
				$FileAttach = $this->prd_managenewgrov_model->get_FileAttach();
				
				if($this->input->post("manageNewGROV_is_submit") == "yes"){
					
					$news = $this->prd_managenewgrov_model->get_grov_search(
						$page,
						$row_per_page,
						$this->input->post("sendin_issue"), 
						$this->input->post("start_date"), 
						$this->input->post("end_date"),
						$this->input->post("Ministry_ID"),
						$this->input->post("Dep_ID")
					);
					$count_row = $this->prd_managenewgrov_model->get_grov_search_count(
						$this->input->post("sendin_issue"), 
						$this->input->post("start_date"), 
						$this->input->post("end_date"),
						$this->input->post("Ministry_ID"),
						$this->input->post("Dep_ID")
					);
					
					$data['post_sendin_issue'] = $this->input->post('sendin_issue');
					$data['post_start_date'] = $this->input->post('start_date');
					$data['post_end_date'] = $this->input->post('end_date');
					$data['post_Ministry_ID'] = $this->input->post('Ministry_ID');
					$data['post_Dep_ID'] = $this->input->post('Dep_ID');
					
				}
				else{
					// echo "no search";
					$news = $this->prd_managenewgrov_model->get_grov(
						$page,
						$row_per_page
					);
					
					$count_row = $this->prd_managenewgrov_model->get_grov_count();
					$data['post_sendin_issue'] = "";
					$data['post_start_date'] = "";
					$data['post_end_date'] = "";
					$data['post_Ministry_ID'] = "";
					$data['post_Dep_ID'] = "";
				}
				
				$CI_stringManagement =& get_instance();
				$CI_stringManagement->load->library('string_management');
				$data["CI_stringManagement"] = $CI_stringManagement;
				
				// var_dump($FileAttach);
				// exit;
				
				//###### Add File_Status to News ######
				foreach ($news as $news_item) {
					foreach ($FileAttach as $FileAttach_item) {
						if(
							$news_item->SendIn_ID == $FileAttach_item->SendIn_ID
						){
							// var_dump($news_item);
							// exit;
								if($FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "video/")){
									$news_item->File_Type_video = 1;
								}
								elseif($FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "audio/")){
									$news_item->File_Type_voice = 1;
								}
								elseif($FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "image/")){
									$news_item->File_Type_image = 1;
								}
								elseif(
									!(
										$FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "video/") ||
										$FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "audio/") ||
										$FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "image/")
									)
								){
											$news_item->File_Type_document = 1;
								}
						}
					}
				}
				//###### End Add File_Status to News ######
				
				$data["news"] = $news;
				$data['ministry'] = $this->prd_managenewgrov_model->get_ministry();
				$data['department'] = $this->prd_managenewgrov_model->get_department();
				
				//############## Pagination = For no Search ################
				$data['count_row'] = $count_row;
				$url = "manageNewGROV";
				
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
				$this->load->view('prdsharing/managenew/managenewgrov', $data);
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
	public function get_department($Ministry_ID ='')
	{
		$_data = $this->prd_managenewgrov_model->get_department_Unique($Ministry_ID);
		echo json_encode($_data);
	}
}