<?php
class PRD_sentNew extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('PRD_SentNew_model');
	}

	public function index()
	{
		$data['title'] = 'Sent News';
		
		$data['Ministry'] = $this->PRD_SentNew_model->get_Ministry();
		$data['Department'] = $this->PRD_SentNew_model->get_Department();
		$data['NT05_Policy'] = $this->PRD_SentNew_model->get_NT05_Policy();
		$data['TargetGroup'] = $this->PRD_SentNew_model->get_TargetGroup();
		
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/sentnew/sentnew', $data);
		$this->load->view('prdsharing/templates/footer');
	}
	
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('prdsharing/sentnew/sentnew', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('prdsharing/sentnew/upload_success', $data);
		}
	}
}