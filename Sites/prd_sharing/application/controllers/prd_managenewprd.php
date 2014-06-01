<?php
class PRD_ManageNewPRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model('prd_managenewprd_model');
		$this->load->library("pagination");
	}

	public function index()
	{
		$data['title'] = 'Manage News';
		
		if($this->input->post("manageNewEditPRD_record") == "yes"){
			// echo "record";
			$return = $this->prd_managenewprd_model->set_prd_news(
				$this->input->post("NT01_NewsID"),
				$this->input->post("NT01_NewsTitle"),
				$this->input->post("NT01_NewsDesc"),
				$this->input->post("NT01_NewsSource"),
				$this->input->post("NT01_NewsReferance"),
				$this->input->post("NT01_NewsTag")
			);
			// var_dump($return);
		}
		
		if($this->input->post("news_title") != ""){
			if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
				$data['news'] = $this->prd_managenewprd_model->get_prd_search_title_start_end(($this->input->post("news_title")), ($this->input->post("start_date")), ($this->input->post("start_date")) );
				
				$data['post_start_date'] = $this->input->post('start_date');
				$data['post_end_date'] = $this->input->post('end_date');
			}
			elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
				$data['news'] = $this->prd_managenewprd_model->get_prd_search_title_start(($this->input->post("news_title")), ($this->input->post("start_date")) );
				$data['post_start_date'] = $this->input->post('start_date');
			}
			else{
				$data['news'] = $this->prd_managenewprd_model->get_NT01_News_Search_Title($this->input->post("news_title"));
				$data['post_news_title'] = $this->input->post('news_title');
			}
		}
		else{
			$data['news'] = $this->prd_managenewprd_model->get_NT01_News();
		}
		
		$data['NT02_NewsType'] = $this->prd_managenewprd_model->get_NT02_NewsType();
		$data['NT03_NewsSubType'] = $this->prd_managenewprd_model->get_NT03_NewsSubType();
		
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/managenewprd', $data);
		$this->load->view('prdsharing/templates/footer');
		
		$this->prd_managenewprd_model->set_FirstAddNews($data['news']);
	}
}