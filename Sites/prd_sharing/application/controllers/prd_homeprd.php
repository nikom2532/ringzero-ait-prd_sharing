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
			// if(isset($this->input->post('start_date'))){
// 				
			// }
			$data['news'] = $this->prd_homeprd_model->get_prd_search_title($this->input->post("news_title"));
		}
		else{
			$data['news'] = $this->prd_homeprd_model->get_prd();
		}
		
		
		//For Test
		// var_dump($data['news']);
		// var_dump($this->input->post());
		// echo $this->input->post("news_title");
		// var_dump($data['rows']);
		// var_dump($this->input->post("news_title"));
		
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/home/header', $data);
		$this->load->view('prdsharing/home/homeprd', $data);
		$this->load->view('prdsharing/templates/footer', $data);
	}
}