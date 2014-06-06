<?php
class PRD_HomeGOVE_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	public function get_gove()
	{
		
		//Test		
		$serverName = "111.223.32.9";
		$connectionInfo = array( "Database"=>"NNT_DataCenter", "UID"=>"dbuser_km", "PWD"=>"123456");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
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
		
		
		
		$query = $this->db->
			select('
				SendInformation.SendIn_ID,
				SendInformation.SendIn_UpdateDate,
				SendInformation.SendIn_CreateDate,
				SendInformation.SendIn_Issue,
				SendInformation.Mem_ID,
				SendInformation.SendIn_view,
				FileAttach.File_Status 
			')->
			join('Member', 'SendInformation.Mem_ID = Member.Mem_ID', 'left')->
			join('FileAttach', 'SendInformation.SendIn_ID = FileAttach.SendIn_ID', 'left')->
			get('SendInformation')->result();
		// var_dump($query);
		return $query;
	}
	public function get_gove_search_title($news_title)
	{
		return $this->db->
			select('
				SendInformation.SendIn_ID,
				SendInformation.SendIn_UpdateDate,
				SendInformation.SendIn_CreateDate,
				SendInformation.SendIn_Issue,
				SendInformation.SendIn_view,
				FileAttach.File_Status
			')->
			join('FileAttach', 'SendInformation.SendIn_ID = FileAttach.SendIn_ID', 'left')->
			like('SendIn_Issue', $news_title)->
			get('SendInformation')->result();
	}
	public function get_gove_search_title_start($news_title, $start)
	{
		return $this->db->
			select('
				SendInformation.SendIn_ID,
				SendInformation.SendIn_UpdateDate,
				SendInformation.SendIn_CreateDate,
				SendInformation.SendIn_Issue,
				SendInformation.SendIn_view,
				FileAttach.File_Status
			')->
			join('FileAttach', 'SendInformation.SendIn_ID = FileAttach.SendIn_ID', 'left')->
			like('SendIn_Issue', $news_title)->
			where("News_Date >=", $start)->
			get('SendInformation')->result();
	}
	public function get_gove_search_title_start_end($news_title, $start, $end)
	{
		return $this->db->
			select('
				SendInformation.SendIn_ID,
				SendInformation.SendIn_UpdateDate,
				SendInformation.SendIn_CreateDate,
				SendInformation.SendIn_Issue,
				SendInformation.SendIn_view,
				FileAttach.File_Status
			')->
			join('FileAttach', 'SendInformation.SendIn_ID = FileAttach.SendIn_ID', 'left')->
			like('SendIn_Issue', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			get('SendInformation')->result();
	}
	
	public function get_gove_record_count()
	{
		return $this->db->count_all('SendInformation');
	}
	
	public function get_gove_limit($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get('SendInformation');
			
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function get_testdb2()
	{
		return $this->db_ntt_old->get('SC03_User')->result();
	}
}