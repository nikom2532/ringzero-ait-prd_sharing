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
		
		if($this->input->post("manageNewEditPRD_record") == "yes"){
			// echo "record";
			$return_manageNewEditPRD_record = $this->prd_managenewgrov_model->set_prd_news(
				$this->input->post("SendIn_ID"),
				$this->input->post("SendIn_Plan"),
				$this->input->post("SendIn_Issue")
			);
			// var_dump($return_manageNewEditPRD_record);
		}
		
		if($this->input->post("sendin_issue") != ""){
			// echo "search";
			if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
				$data['news'] = $this->prd_managenewgrov_model->get_grov_search_title_start_end(($this->input->post("sendin_issue")), ($this->input->post("start_date")), ($this->input->post("end_date")) );
				$data['post_news_title'] = $this->input->post('news_title');
				$data['post_start_date'] = $this->input->post('start_date');
				$data['post_end_date'] = $this->input->post('end_date');
			}
			elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
				$data['news'] = $this->prd_managenewgrov_model->get_grov_search_title_start(($this->input->post("sendin_issue")), ($this->input->post("start_date")) );
				$data['post_news_title'] = $this->input->post('news_title');
				$data['post_start_date'] = $this->input->post('start_date');
			}
			else{
				$data['news'] = $this->prd_managenewgrov_model->get_grov_search_title($this->input->post("sendin_issue"));
				$data['post_news_title'] = $this->input->post('news_title');
			}
		}
		else{
			// echo "no search";
			$data['news'] = $this->prd_managenewgrov_model->get_grov();
		}
		
		$data['ministry'] = $this->prd_managenewgrov_model->get_ministry();
		$data['department'] = $this->prd_managenewgrov_model->get_department();

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/managenewgrov', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}