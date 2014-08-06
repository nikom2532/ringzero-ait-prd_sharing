<?php
	
	$serverName = "112.121.129.117, 4000";
	$user = "sa";
	$password = "!NNTDataCenter";
	
$cnx = new PDO("odbc:Driver={SQL Native Client};Server=$serverName;Database=myDataBase; Uid=$user;Pwd=$password;"); 

var_dump($cnx);
	
	/*
	//Test
		
		try{
			$connectionInfo = array( "Database"=>"NNT_PRD_Sharing", "UID"=>"sa", "PWD"=>"!NNTDataCenter");
			$conn = sqlsrv_connect( $serverName, $connectionInfo){
		}
		catch (exception $ex){
			echo $ex;
		}
		exit;
		var_dump($connectionInfo);
		
		if( $conn ) {
			echo "Connection established.<br />";
			
			// $query = "SELECT TOP 1000 [field1]
			      // ,[field2]
			  // FROM [ringzero_ait_prd_sharing].[dbo].[test]";
			// $stmt = sqlsrv_query($conn, $query);
			// // print_r($stmt);
			// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			      // echo $row['field1'].", ".$row['field2']."<br />";
			// }
		}else{
			echo "Connection could not be established.<br />";
			echo "<pre>";
			print_r(sqlsrv_errors());
			echo "</pre>";
		}
	
	
	/*		

  try {
    $hostname = "dblib:host=112.121.129.117:4000;dbname=NNT_PRD_Sharing";
    
    $username = "sa";
    $pw = "!NNTDataCenter";
    $dbh = new PDO ($hostname ,$username,$pw);
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
  $stmt = $dbh->prepare("select name from master..sysdatabases where name = db_name()");
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    print_r($row);
  }
  unset($dbh); unset($stmt);
		
?>