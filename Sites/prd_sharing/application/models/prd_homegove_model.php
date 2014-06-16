<?php
class PRD_HomeGOVE_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	public function get_gove($page=1, $row_per_page=20)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					MAX(SendInformation.SendIn_ID) AS SendIn_ID,
					MAX(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
					MAX(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					MAX(SendInformation.SendIn_Issue) AS SendIn_Issue,
					MAX(SendInformation.Mem_ID) AS Mem_ID,
					MAX(SendInformation.SendIn_view) AS SendIn_view,
					MAX(FileAttach.File_Status) AS File_Status,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_gove_count()
	{
		$StrQuery = "
				SELECT
					COUNT((SendInformation.SendIn_ID)) AS NUMROW
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
		";
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	//#######################################################################
	
	public function get_gove_search_title($page=1, $row_per_page=20, $news_title = '')
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					MAX(SendInformation.SendIn_ID) AS SendIn_ID,
					MAX(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
					MAX(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					MAX(SendInformation.SendIn_Issue) AS SendIn_Issue,
					MAX(SendInformation.Mem_ID) AS Mem_ID,
					MAX(SendInformation.SendIn_view) AS SendIn_view,
					MAX(FileAttach.File_Status) AS File_Status,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendInformation.SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_gove_search_title_count($news_title = '')
	{
		$StrQuery = "
				SELECT
					COUNT((SendInformation.SendIn_ID)) AS NUMROW
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendInformation.SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
		";
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	
	public function get_gove_search_title_start($page=1, $row_per_page=20, $news_title = '', $startdate = '')
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					MAX(SendInformation.SendIn_ID) AS SendIn_ID,
					MAX(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
					MAX(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					MAX(SendInformation.SendIn_Issue) AS SendIn_Issue,
					MAX(SendInformation.Mem_ID) AS Mem_ID,
					MAX(SendInformation.SendIn_view) AS SendIn_view,
					MAX(FileAttach.File_Status) AS File_Status,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
				And
					Convert(datetime, '".$startdate."') <
									CASE WHEN SendIn_UpdateDate IS NULL  
										THEN 
											 SendIn_CreateDate
										ELSE
											SendIn_UpdateDate
									END
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_gove_search_title_start_count($news_title = '', $startdate = '')
	{
		$StrQuery = "
				SELECT
					COUNT((SendInformation.SendIn_ID)) AS NUMROW
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendInformation.SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
				And
					Convert(datetime, '".$startdate."') <
									CASE WHEN SendIn_UpdateDate IS NULL  
										THEN 
											 SendIn_CreateDate
										ELSE
											SendIn_UpdateDate
									END
		";
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_gove_search_title_start_end($page=1, $row_per_page=20, $news_title, $startdate, $enddate)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					MAX(SendInformation.SendIn_ID) AS SendIn_ID,
					MAX(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
					MAX(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					MAX(SendInformation.SendIn_Issue) AS SendIn_Issue,
					MAX(SendInformation.Mem_ID) AS Mem_ID,
					MAX(SendInformation.SendIn_view) AS SendIn_view,
					MAX(FileAttach.File_Status) AS File_Status,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
				And
					CASE WHEN SendIn_UpdateDate IS NULL  
						THEN 
							SendIn_CreateDate
						ELSE
							SendIn_UpdateDate
					END
								BETWEEN 
									Convert(datetime, '".$startdate."') 
									AND
									Convert(datetime, '".$enddate."')
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_gove_search_title_start_end_count($news_title = '', $startdate = '', $enddate = '')
	{
		$StrQuery = "
				SELECT
					COUNT((SendInformation.SendIn_ID)) AS NUMROW
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendInformation.SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
				And
					CASE WHEN SendIn_UpdateDate IS NULL  
						THEN 
							SendIn_CreateDate
						ELSE
							SendIn_UpdateDate
					END
								BETWEEN 
									Convert(datetime, '".$startdate."') 
									AND
									Convert(datetime, '".$enddate."')
		";
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	//##########################################################
	
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