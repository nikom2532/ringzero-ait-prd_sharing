<?php
class Testsite_DB2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('test_model');
	}

	public function index()
	{
		// $serverName = "localhost";
		// $connectionInfo = array( "Database"=>"ringzero_ait_prd_sharing", "UID"=>"nikom2532", "PWD"=>"cominter");
		
		$serverName = "localhost";
		$connectionInfo = array( "Database"=>"NNT_DataCenter_2", "UID"=>"nikom2532", "PWD"=>"cominter" ,  "CharacterSet" => "UTF-8" );
		
		// $serverName = "111.223.32.9, 1433";
		// $connectionInfo = array( "Database"=>"NTT_DataCenter", "UID"=>"dbuser_km", "PWD"=>"123456");
		
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if( $conn ) {
			echo "Connection established.<br />";
			
			$query = "
			
				SELECT TOP 20 [SC03_UserId]
			      ,[SC03_HeadUserId]
			      ,[SC03_TName]
			      ,[SC03_FName]
			      ,[SC03_LName]
			      ,[SC03_EngTName]
			      ,[SC03_EngFName]
			      ,[SC03_EngLName]
			      ,[SC03_Gender]
			      ,[SC03_Email]
			      ,[SC03_UserName]
			      ,[SC03_Password]
			      ,[SC03_EmpId]
			      ,[SC03_NickName]
			      ,[SC03_RefId]
			      ,[SC03_PicFile]
			      ,[SC03_Token]
			      ,[UpdUser]
			      ,[UpdDate]
			      ,[CM05_RegionId]
			      ,[CM06_ProvinceId]
			      ,[CM07_AmpurId]
			      ,[CM08_TumbonId]
			      ,[SC06_BranchId]
			      ,[SC07_DepartmentId]
			      ,[SC03_Status]
			      ,[SC03_MacAddress]
			      ,[PRD_USERID]
			      ,[PRD_PWD]
			      ,[TN_USERID]
			      ,[TN_PWD]
			      ,[SC03_Tel]
			      ,[TN_ROLE]
			      ,[SC03_PhoneOffice]
			      ,[SC03_Address]
			      ,[SC03_Career]
			      ,[SC03_PositionType]
			      ,[SC03_Position]
			      ,[SC03_IDCard]
			      ,[SC07_MainDepartmentId]
			      ,[SC03_FullText]
			      ,[SC03_RegisterDate]
			      ,[USR_ID]
			      ,[SC03_ContactName]
			      ,[SC03_OtherDepartment]
			      ,[SC03_ZipCode]
			      ,[CM13_CountryID]
			      ,[SC03_UpdUser]
			      ,[SC03_UpdDate]
			      ,[SC03_LastChangePassword]
			      ,[SC03_NotifyChangePassword]
			      ,[SC17_SystemID]
			  FROM [NNT_DataCenter_2].[dbo].[SC03_User]
			
			";
			$stmt = sqlsrv_query($conn, $query);
			// print_r($stmt);
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			      echo $row['SC03_UserId'].", ".$row['SC03_TName'] ."<br />";
			}
			
			
		}else{
			echo "Connection could not be established.<br />";
			echo "<pre>";
			print_r(sqlsrv_errors());
			echo "</pre>";
		}
		
		// $data['test'] = $this->test_model->get_test();
// 		
		// var_dump($data['test']);
	}
}