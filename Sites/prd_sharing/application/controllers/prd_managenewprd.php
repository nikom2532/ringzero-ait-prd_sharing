<?php
class PRD_ManageNewPRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_managenewprd_model');
		$this->load->library("pagination");
		$this->load->helper('utility_helper');
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
			
			if($this->input->post("manageNewEditPRD_record") == "yes"){
				// echo "record";
				$return = $this->prd_managenewprd_model->set_prd_news(
					$this->input->post("NT01_NewsID"),
					$this->input->post("NT01_NewsTitle"),
					htmldecode($this->input->post("NT01_NewsDesc")),
					$this->input->post("NT01_NewsSource"),
					$this->input->post("NT01_NewsReferance"),
					$this->input->post("NT01_NewsTag"),
					$this->input->post("NewsTypeID"),
					$this->input->post("NewsSubTypeID"),
					$this->input->post("News_UpdateID")
				);
			}
			
			$data['New_News'] = $this->prd_managenewprd_model->get_New_News();
			$data['SC03_User'] = $this->prd_managenewprd_model->get_SC03_User();
			$row_per_page = 20;
			
			if($this->input->post("managenewsprd_is_search") == "yes"){
				
				$data['news'] = $this->prd_managenewprd_model->
					get_NT01_News_Search(
						$page, 
						$row_per_page,
						$this->input->post('news_title'),
						$this->input->post('start_date'),
						$this->input->post('end_date'),
						$this->input->post('NewsTypeID'),
						$this->input->post('NewsSubTypeID'),
						$this->input->post('reporter_id'),
						$this->input->post('filter_vdo'),
						$this->input->post('filter_sound'),
						$this->input->post('filter_image'),
						$this->input->post('filter_other')
					);
				$count_row = $this->prd_managenewprd_model->
					get_NT01_News_search_count(
						$this->input->post('news_title'),
						$this->input->post('start_date'),
						$this->input->post('end_date'),
						$this->input->post('NewsTypeID'),
						$this->input->post('NewsSubTypeID'),
						$this->input->post('reporter_id'),
						$this->input->post('filter_vdo'),
						$this->input->post('filter_sound'),
						$this->input->post('filter_image'),
						$this->input->post('filter_other')
					);
				
				$data['post_news_title'] = $this->input->post('news_title');
				$data['post_start_date'] = $this->input->post('start_date');
				$data['post_end_date'] = $this->input->post('end_date');
				$data['post_News_type_id'] = $this->input->post('NewsTypeID');
				$data['post_News_subtype_id'] = $this->input->post('NewsSubTypeID');
				$data['post_reporter_id'] = $this->input->post('reporter_id');
				$data['post_filter_vdo'] = $this->input->post('filter_vdo');
				$data['post_filter_sound'] = $this->input->post('filter_sound');
				$data['post_filter_image'] = $this->input->post('filter_image');
				$data['post_filter_other'] = $this->input->post('filter_other');
			}
			else{	//## No Search ##
				$data['news'] = $this->prd_managenewprd_model->get_NT01_News($page, $row_per_page);
				$count_row = $this->prd_managenewprd_model->get_NT01_News_count();
				$data['post_news_title'] = "";
				$data['post_start_date'] = "";
				$data['post_end_date'] = "";
				$data['post_News_type_id'] = "";
				$data['post_News_subtype_id'] = "";
				$data['post_reporter_id'] = "";
				$data['post_filter_vdo'] = "";
				$data['post_filter_sound'] = "";
				$data['post_filter_image'] = "";
				$data['post_filter_other'] = "";
			}
			
			//############## Pagination = For no Search ################
			$data['count_row'] = $count_row;
			$url = "manageNewPRD";
			
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
			$data['jump_url'] = base_url().$url;
			$data['next_page'] = 
				$currentPage == $total_page
					? base_url().$url."$total_page"
					: base_url().$url.($currentPage + 1);
			$data["prev_page"] = 
				($currentPage > 1
				? base_url().$url.($currentPage - 1)
				: base_url().$url."1");
			$data["total_page"]  =
				($total_page == 0?1 : $total_page);
			$data["page_url"] = $page_url;
			$data["first_page"] = base_url().$url."1";
			$data["last_page"] = base_url().$url."$total_page";
			$data["current_page"] = $page;
			$data["row_per_page"] = $row_per_page;
			
			//#########################################################
			
			//Query update Old News to New News
			$this->prd_managenewprd_model->set_FirstAddNews($data['news']);
			
			
			$data['NT02_NewsType'] = $this->prd_managenewprd_model->get_NT02_NewsType();
			$data['NT03_NewsSubType'] = $this->prd_managenewprd_model->get_NT03_NewsSubType();
			
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/managenew/managenewprd', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect(base_url().'', 'refresh');
		}
	}
	
	public function get_NT02_TypeID($NT02_TypeID='')
	{
		$_data = $this->prd_managenewprd_model->get_NT03_NewsSubType_Unique($NT02_TypeID);
		echo json_encode($_data);
	}
	
}