<?php
class PRD_sentNew extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('PRD_SentNew_model');
	}

	public function index()
	{
		//Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['title'] = 'Sent News';
			
			$data['Ministry'] = $this->PRD_SentNew_model->get_Ministry();
			$data['Department'] = $this->PRD_SentNew_model->get_Department();
			$data['NT05_Policy'] = $this->PRD_SentNew_model->get_NT05_Policy();
			$data['TargetGroup'] = $this->PRD_SentNew_model->get_TargetGroup();
			$data['SC07_Department'] = $this->PRD_SentNew_model->get_SC07_Department();
			
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/sentnew/sentnew', $data);
			$this->load->view('prdsharing/templates/footer');
			
			
		}
		else{
			redirect('/', 'refresh');
		}
	}
	
	public function get_Department($Ministry_ID='')
	{
		$_data = $this->PRD_SentNew_model->get_Department_Unique($Ministry_ID);
		echo json_encode($_data);
	}
	
	public function sentnew_process()
	{
		if ($this->input->post('sentnew_is_add')) {
			
			$query_sentnew_record = $this->PRD_SentNew_model->set_sentnew(
				$this->input->post('create_date'),
				$this->input->post('Minis_ID'),
				$this->input->post('Dep_ID'),
				$this->input->post('NT05_PolicyID'),
				$this->input->post('Tar_ID'),
				$this->input->post('grov_active'),
				$this->input->post('prd_active'),
				$this->input->post('SendIn_Plan'),
				$this->input->post('SendIn_Issue'),
				$this->input->post('SendIn_Detail')
			);
			
			/*
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|doc';
			// $config['max_size']	= '100';
			// $config['max_width']  = '1024';
			// $config['max_height']  = '768';
			$this->load->library('upload', $config);
			
			
			//PHP Upload ธรรมดา 
			
			if ( ! $this->upload->do_upload('fileattach'))
			{
				$error = array('error' => $this->upload->display_errors());
				
				var_dump($error);
				
				// $this->load->view('prdsharing/sentnew/sentnew', $error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
	
				// $this->load->view('prdsharing/sentnew/upload_success', $data);
				
				redirect('/manageNewGROV?aaa=aaa', 'refresh');
			}
			*/
			
			redirect('/manageNewGROV', 'refresh');
		}
		else{
			redirect('/manageNewGROV', 'refresh');
		}
	}
	
	
	/*
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
	*/
}