<?php
class PRD_ManageNew_detail_PRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}

	public function index()
	{
		$data['title'] = 'Manage News';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/detail_prd', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}