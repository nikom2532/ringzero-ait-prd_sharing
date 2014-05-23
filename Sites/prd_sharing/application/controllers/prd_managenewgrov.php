<?php
class PRD_ManageNewGROV extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model('prd_managenewgrov_model');
		$this->load->library("pagination");
	}

	public function index()
	{
		$data['title'] = 'Manage News';
		
		if($this->input->post("news_title") != ""){
			if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
				$data['news'] = $this->prd_managenewgrov_model->get_prd_search_title_start_end(($this->input->post("news_title")), ($this->input->post("start_date")), ($this->input->post("end_date")) );
				$data['post_news_title'] = $this->input->post('news_title');
				$data['post_start_date'] = $this->input->post('start_date');
				$data['post_end_date'] = $this->input->post('end_date');
			}
			elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
				$data['news'] = $this->prd_managenewgrov_model->get_prd_search_title_start(($this->input->post("news_title")), ($this->input->post("start_date")) );
				$data['post_news_title'] = $this->input->post('news_title');
				$data['post_start_date'] = $this->input->post('start_date');
			}
			else{
				$data['news'] = $this->prd_managenewgrov_model->get_prd_search_title($this->input->post("news_title"));
				$data['post_news_title'] = $this->input->post('news_title');
			}
		}
		else{
			$data['news'] = $this->prd_managenewgrov_model->get_grov();
		}
		
		$data['ministry'] = $this->prd_managenewgrov_model->get_ministry();
		$data['department'] = $this->prd_managenewgrov_model->get_department();

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/managenewgrov', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}