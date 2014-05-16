<?php
class PRD_HomePRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_homeprd_model');
	}

	public function index()
	{
		$data['title'] = 'Home PRD';
		
		if($this->input->post("news_title") != ""){
			if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
				$data['news'] = $this->prd_homeprd_model->get_prd_search_title_start_end(($this->input->post("news_title")), ($this->input->post("start_date")), ($this->input->post("start_date")) );
			}
			elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
				$data['news'] = $this->prd_homeprd_model->get_prd_search_title_start(($this->input->post("news_title")), ($this->input->post("start_date")) );
			}
			else{
				$data['news'] = $this->prd_homeprd_model->get_prd_search_title($this->input->post("news_title"));
			}
		}
		else{
			$data['news'] = $this->prd_homeprd_model->get_prd();
		}
		
		
		//For Test
		// var_dump($data['news']);
		// var_dump($this->input->post());
		// echo $this->input->post("news_title");
		// var_dump($this->input->post("news_title"));
		// echo ($data["news"]->News_Date);
		
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/home/header', $data);
		$this->load->view('prdsharing/home/homeprd', $data);
		$this->load->view('prdsharing/templates/footer', $data);
	}
}