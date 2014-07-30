<?php
class PRD_HomePRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("pagination");
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->model('prd_homeprd_model');
		$this->load->model('PRD_rss_Home_PRD_model');
		// $this->load->library('ait');
	}
	
	public function getReporter($reporter){
		return $data['Reporter'] = $this->prd_homeprd_model->get_NT01_News_Reporter($reporter);
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
			
			$data['title'] = 'Home';
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			if($showStatus == "yes"){
			
				$row_per_page = 20;
				
				$NT02_NewsType = $this->prd_homeprd_model->get_NT02_NewsType();
				$category = $this->prd_homeprd_model->get_Category($NT02_NewsType);
				
				if($category != ""){
					$statusArray = array();
					foreach($category as $val){
						$statusArray[] = "'".$val->Cate_OldID."'";
					}
					$category = implode(",",$statusArray);
				}
				
				$get_News_OldID_StatusPublicYes = $this->prd_homeprd_model->get_News_OldID_StatusPublicYes();
				
				if($get_News_OldID_StatusPublicYes != ""){
					$statusArray = array();
					foreach($get_News_OldID_StatusPublicYes as $val){
						$statusArray[] = "'".$val->News_OldID."'";
					}
					$get_News_OldID_StatusPublicYes = implode(",",$statusArray);
				}
				
				
				if($this->input->post("is_homePRD_search") == "yes"){
					$news = $this->prd_homeprd_model->get_NT01_News_search(
						($this->input->post("news_title")), 
						($this->input->post("start_date")), 
						($this->input->post("end_date")),
						$category,
						$get_News_OldID_StatusPublicYes,
						$page,
						$row_per_page
					);
					$count_row = $this->prd_homeprd_model->
						get_NT01_News_search_count(
							$this->input->post("news_title"),
							$this->input->post("start_date"),
							$this->input->post("end_date"),
							$category,
							$get_News_OldID_StatusPublicYes,
							$row_per_page
						);
					$data['post_news_title'] = $this->input->post("news_title");
					$data['post_start_date'] = $this->input->post("start_date");
					$data['post_end_date'] = $this->input->post("end_date");
				}
				else{
					$news = $this->prd_homeprd_model->
						get_NT01_News(
							$category,
							$get_News_OldID_StatusPublicYes,
							$page,
							$row_per_page
						);
					$count_row = $this->prd_homeprd_model->get_NT01_News_count(
						$category, 
						$get_News_OldID_StatusPublicYes,
						$row_per_page
					);
					$data['post_news_title'] = "";
					$data['post_start_date'] = "";
					$data['post_end_date'] = "";
				}
				
				if(isset($_POST["is_homePRD_search"])){
					if($this->input->post("is_homePRD_search") != ""){
						$data["post_is_homePRD_search"] = $this->input->post("is_homePRD_search");
					}
					else{
						$data["post_is_homePRD_search"] = "";
					}
				}
				else{
					$data["post_is_homePRD_search"] = "";
				}
				
				// $newsNoPaging = $this->prd_homeprd_model->get_NT01_News_SaveToNewDatabase();
				$data['news'] = $news;
				
				//############## Pagination = For no Search ################
				// $count_row = $this->prd_homeprd_model->get_NT01_News_count($category);
			 	$data['count_row'] = $count_row;
				// $data_pagination = $this->ait->pagination($count_row,"homePRD/",$page,$row_per_page);
				$url = "homePRD";
				
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
				
				//After Load the Page --> Will insert the UserID from Old Database to New Database
				//Insert News Table from Old Database to New Database
				// $this->prd_homeprd_model->set_News(
					// $newsNoPaging
				// );
				$this->prd_homeprd_model->set_News(
					$news
				);
				
				
				$data['New_News'] = $this->prd_homeprd_model->get_New_News();
				
				$data['home_search'] = "homePRD";
				$this->load->view('prdsharing/templates/header', $data);
				$this->load->view('prdsharing/home/header', $data);
				$this->load->view('prdsharing/home/homeprd', $data);
				$this->load->view('prdsharing/templates/footer', $data);
			}
			else{
				redirect(base_url().index_page().'', 'refresh');
			}
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}
	
	public function rss_feed_home_prd()
	{
		$NT02_NewsType = $this->PRD_rss_Home_PRD_model->get_NT02_NewsType();
		$category = $this->PRD_rss_Home_PRD_model->get_Category($NT02_NewsType);
		
		$data['rss'] = $this->PRD_rss_Home_PRD_model->generate_rss(
			$this->session->userdata('member_id'),
			$this->input->post('search'),
			$this->input->post('start_date'),
			$this->input->post('end_date'),
			$category
		);
		echo $data['rss'];
	}
}