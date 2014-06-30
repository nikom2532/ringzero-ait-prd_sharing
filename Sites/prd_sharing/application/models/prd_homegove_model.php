<?php
class PRD_HomeGOVE_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
		
		//Find Member What is Department and Ministry
		
		$Member = $this->session->userdata('member_id');
		$StrQueryMember = "
			SELECT
				Mem_Ministry,
				Mem_Department
			FROM Member
			where Mem_ID = ".$Member."
		";
		$QueryMember = $this->db->query($StrQueryMember)->result();
		$this->case = 0;
		$this->str_case = "";
		foreach ($QueryMember as $Member_item) {
			if($Member_item->Mem_Ministry == "" && $Member_item->Mem_Department == ""){
				$this->case = 1;
				$this->str_case = "";
			}
			elseif($Member_item->Mem_Ministry != "" && $Member_item->Mem_Department == ""){
				$this->case = 2;
				$this->str_case = "
					AND 
						SendInformation.PRD_Status = Member.Mem_Ministry
				";
			}
			elseif($Member_item->Mem_Ministry == "" && $Member_item->Mem_Department != ""){
				$this->case = 3;
				$this->str_case = "
					AND 
						SendInformation.GOVE_Status = Member.Mem_Department
				";
			}
			elseif($Member_item->Mem_Ministry != "" && $Member_item->Mem_Department != ""){
				$this->case = 4;
				$this->str_case = "
					AND 
						SendInformation.PRD_Status = Member.Mem_Ministry
					AND 
						SendInformation.GOVE_Status = Member.Mem_Department
				";
			}
		}
		
	}
	
	public function get_grov_fileattach(){
		
		return $this->db->
			select('
				FileAttach.File_Name,
				FileAttach.File_Path,
				FileAttach.File_Extension,	
				FileAttach.File_Status,
				FileAttach.File_Type,
				FileAttach.SendIn_ID
			')->
			join('SendInformation', 'SendInformation.SendIn_ID = FileAttach.SendIn_ID', 'left')->
			get('FileAttach')->result();
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
					MAX(Member.Mem_Name) AS Mem_Name,
					MAX(Member.Mem_LasName) AS Mem_LasName,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$StrQuery .= "
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
				WHERE 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
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
					MAX(Member.Mem_Name) AS Mem_Name,
					MAX(Member.Mem_LasName) AS Mem_LasName,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendInformation.SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$StrQuery .= "
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
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
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
					MAX(Member.Mem_Name) AS Mem_Name,
					MAX(Member.Mem_LasName) AS Mem_LasName,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
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
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$StrQuery .= "
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
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_gove_search_title_end($page=1, $row_per_page=20, $news_title = '', $enddate = '')
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
					MAX(Member.Mem_Name) AS Mem_Name,
					MAX(Member.Mem_LasName) AS Mem_LasName,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
				And
					Convert(datetime, '".$enddate."') >
									CASE WHEN SendIn_UpdateDate IS NULL  
										THEN 
											 SendIn_CreateDate
										ELSE
											SendIn_UpdateDate
									END
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$StrQuery .= "
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_gove_search_title_end_count($news_title = '', $enddate = '')
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
					Convert(datetime, '".$enddate."') >
									CASE WHEN SendIn_UpdateDate IS NULL  
										THEN 
											 SendIn_CreateDate
										ELSE
											SendIn_UpdateDate
									END
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_gove_search_title_start_end($page=1, $row_per_page=20, $news_title = '', $startdate = '', $enddate = '')
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
					MAX(Member.Mem_Name) AS Mem_Name,
					MAX(Member.Mem_LasName) AS Mem_LasName,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
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
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$StrQuery .= "
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
					AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_gove_search_start($page=1, $row_per_page=20, $startdate = '')
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
					MAX(Member.Mem_Name) AS Mem_Name,
					MAX(Member.Mem_LasName) AS Mem_LasName,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					Convert(datetime, '".$startdate."') <
									CASE WHEN SendIn_UpdateDate IS NULL  
										THEN 
											 SendIn_CreateDate
										ELSE
											SendIn_UpdateDate
									END
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$StrQuery .= "
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_gove_search_start_count($startdate = '')
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
					Convert(datetime, '".$startdate."') <
									CASE WHEN SendIn_UpdateDate IS NULL  
										THEN 
											 SendIn_CreateDate
										ELSE
											SendIn_UpdateDate
									END
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_gove_search_end($page=1, $row_per_page=20, $enddate = '')
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
					MAX(Member.Mem_Name) AS Mem_Name,
					MAX(Member.Mem_LasName) AS Mem_LasName,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
					Convert(datetime, '".$enddate."') >
									CASE WHEN SendIn_UpdateDate IS NULL  
										THEN 
											 SendIn_CreateDate
										ELSE
											SendIn_UpdateDate
									END
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$StrQuery .= "
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_gove_search_end_count($enddate = '')
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
					Convert(datetime, '".$enddate."') >
									CASE WHEN SendIn_UpdateDate IS NULL  
										THEN 
											 SendIn_CreateDate
										ELSE
											SendIn_UpdateDate
									END
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_gove_search_start_end($page=1, $row_per_page=20, $startdate = '', $enddate = '')
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
					MAX(Member.Mem_Name) AS Mem_Name,
					MAX(Member.Mem_LasName) AS Mem_LasName,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation
				LEFT JOIN Member 
					ON SendInformation.Mem_ID = Member.Mem_ID 
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
				WHERE 
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
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$StrQuery .= "
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_gove_search_start_end_count($startdate = '', $enddate = '')
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
				AND 
					SendInformation.SendIn_Status = '1'
		";
		$StrQuery .= $this->str_case;
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function set_gove($news='')
	{
		foreach ($news as $news_item) {
			
			if($news_item->SendIn_view == 0 || $news_item->SendIn_view == null){
				$data = array(
				   'SendIn_view' => 1
				);
			}
			else{
				$data = array(
				   'SendIn_view' => 1+($news_item->SendIn_view)
				);
			}
			$this->db->
				where('SendInformation.SendIn_ID', $news_item->SendIn_ID)->
				update("SendInformation", $data);
		}
	}
	
	//########################### Other test #############################
	
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