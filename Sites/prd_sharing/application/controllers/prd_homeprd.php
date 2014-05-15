<?php
class PRD_HomePRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('test_model');
	}

	public function index()
	{
		
// $serverName = "localhost";
// $connectionInfo = array( "Database"=>"ringzero_ait_prd_sharing", "UID"=>"nikom2532", "PWD"=>"cominter");
// $conn = sqlsrv_connect( $serverName, $connectionInfo);
// if( $conn ) {
// echo "Connection established.<br />";
// 
// $query = "SELECT TOP 1000 [field1]
      // ,[field2]
  // FROM [ringzero_ait_prd_sharing].[dbo].[test]";
// $stmt = sqlsrv_query($conn, $query);
// // print_r($stmt);
// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
      // echo $row['field1'].", ".$row['field2']."<br />";
// }
// }else{
// echo "Connection could not be established.<br />";
// echo "<pre>";
// print_r(sqlsrv_errors());
// echo "</pre>";
// }
		
		
		$data['title'] = 'Home PRD';
		
		$data['test'] = $this->test_model->get_test();
		
		var_dump($data['test']);
		
		// var_dump($data['test']);
// 		
		// var_dump($data['test']);

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/home/homeprd', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}