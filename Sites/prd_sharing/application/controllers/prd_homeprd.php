<?php
class PRD_HomePRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('test_model');
		// var_dump($a);
	}

	public function index()
	{
		
		
$serverName = "localhost"; //serverName\instanceName
$connectionInfo = array( "Database"=>"ringzero_ait_prd_sharing", "UID"=>"nikom2532", "PWD"=>"cominter");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) {
echo "Connection established.<br />";
}else{
echo "Connection could not be established.<br />";
echo "<pre>";
print_r(sqlsrv_errors());
echo "</pre>";
}
		
		
		
		$data['title'] = 'Home PRD';
		
		// $data['test'] = $this->test_model->get_test();
// 		
		// var_dump($data['test']);

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/home/homeprd', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}