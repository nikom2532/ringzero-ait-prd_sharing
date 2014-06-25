<?php
class PRD_rss extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_rss_model');
	}

	public function index($page = 1)
	{
		// Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['member_id'] = $this->session->userdata('member_id');
			$data['session_Mem_Username'] = $this->session->userdata('Mem_Username');
			$data['session_Mem_Title'] = $this->session->userdata('Mem_Title');
			$data['session_Mem_Name'] = $this->session->userdata('Mem_Name');
			$data['session_Mem_LasName'] = $this->session->userdata('Mem_LasName');
			$data['session_Mem_EngName'] = $this->session->userdata('Mem_EngName');
			$data['session_Mem_EngLasName'] = $this->session->userdata('Mem_EngLasName');
			
			$data['title'] = 'RSS Feed';
			$data['New_News'] = $this->prd_rss_model->get_New_News();
			
			$data['SC03_User'] = $this->prd_rss_model->get_SC03_User();
			$data['SC07_Department'] = $this->prd_rss_model->get_SC07_Department();
			$row_per_page = 20;
			
			if($this->input->post("rss_is_search") == "yes"){
				
				$data['news'] = $this->prd_rss_model->
					get_NT01_News_Search(
						$page, 
						$row_per_page,
						$this->input->post('news_title'),
						$this->input->post('start_date'),
						$this->input->post('end_date'),
						$this->input->post('NewsTypeID'),
						$this->input->post('NewsSubTypeID'),
						$this->input->post('grov_active'),
						$this->input->post('reporter_id')
						
					);
				$count_row = $this->prd_rss_model->
					get_NT01_News_search_count(
						$this->input->post('news_title'),
						$this->input->post('start_date'),
						$this->input->post('end_date'),
						$this->input->post('NewsTypeID'),
						$this->input->post('NewsSubTypeID'),
						$this->input->post('grov_active'),
						$this->input->post('reporter_id')
					);
				
				$data['post_news_title'] = $this->input->post('news_title');
				$data['post_start_date'] = $this->input->post('start_date');
				$data['post_end_date'] = $this->input->post('end_date');
				$data['post_News_type_id'] = $this->input->post('NewsTypeID');
				$data['post_News_subtype_id'] = $this->input->post('NewsSubTypeID');
				$data['post_grov_active'] = $this->input->post('grov_active');
				$data['post_reporter_id'] = $this->input->post('reporter_id');
			}
			else{	//## No Search ##
				$data['news'] = $this->prd_rss_model->get_NT01_News($page, $row_per_page);
				$count_row = $this->prd_rss_model->get_NT01_News_count();
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
			$url = "rss";
			
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
			
			$data['NT02_NewsType'] = $this->prd_rss_model->get_NT02_NewsType();
			$data['NT03_NewsSubType'] = $this->prd_rss_model->get_NT03_NewsSubType();
			

			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/rss/rss', $data);
			$this->load->view('prdsharing/templates/footer');
		
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}
	public function rss_feed()
	{
		$this->load->database();
		$this->load->model('prd_rss_model');
		$data['rss'] = $this->prd_rss_model->generate_rss(
			$this->session->userdata('member_id')
		);
		echo $data['rss'];	
	}
	public function view_rss()
	{
		$this->load->database();
		$this->load->model('prd_rss_model');
		$this->load->model('prd_rss_old_model');
		$data['query'] = $this->prd_rss_model->get_rss_newsid($this->uri->segment(3));
		$i = 0;
		foreach($data['query'] as $item)
		{
			$newsid = $item->Detail_NewsID;
			
			//Jay Version 2014/6/24
			$data['title'][$i] = $this->prd_rss_old_model->get_news($newsid);
			
			//Ming
			// $data['title'][$i] = $this->prd_rss_old_model->get_NT01_News_RSS();
			$i++;
		}
		$this->load->view('prdsharing/rss/view_rss',$data);
	}
}