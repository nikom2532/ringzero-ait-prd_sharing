<?php
class PRD_ManageInfo_Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_manageinfo_category_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';
		
		$data['category_old'] = $this->prd_manageinfo_category_model->get_NT02_NewsType();
		$data['category_new'] = $this->prd_manageinfo_category_model->get_Category();
		

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/manageinfocategory', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}