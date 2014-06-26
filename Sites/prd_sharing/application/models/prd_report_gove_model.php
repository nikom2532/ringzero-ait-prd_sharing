<?php
class PRD_Report_GOVE_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
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
	
	public function get_ministry() 
	{
		return $this->db->where('Minis_Status', '1')->
			get('Ministry')->result();
	}
	public function get_department()
	{
		return $this->db->where('Dep_Status', '1')->
			get('Department')->result();
	}
	public function get_department_Unique($Ministry_ID = '')
	{
		$query = $this->db->
			where('Dep_Status', '1');
		if($Ministry_ID != ""){
			$query = $query->where('Ministry_ID', $Ministry_ID);
		}
		$query = $query->
			get('Department')->result();
		return $query;
	}
	
	public function get_grov(
		$page=1, 
		$row_per_page=20
	)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
					// MAX(SendInformation.SendIn_ID) AS SendIn_ID,
					// MAX(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate, 
					// MAX(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					// MAX(SendInformation.SendIn_Issue) AS SendIn_Issue,
					// MAX(SendInformation.SendIn_Detail) AS SendIn_Detail,
					// MAX(SendInformation.SendIn_view) AS SendIn_view,
					// MAX(SendInformation.SendIn_Status) AS SendIn_Status,
					// MAX(Member.Mem_Name) AS Mem_Name,
					// MAX(Member.Mem_LasName) AS Mem_LasName,
					// MAX(FileAttach.File_Status) AS File_Status, 
					// ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
					
					
					
					
					// SendInformation.SendIn_ID,
					// SendInformation.SendIn_UpdateDate,
					// SendInformation.SendIn_CreateDate,
					// SendInformation.SendIn_Issue,
					// SendInformation.SendIn_Detail,
					// SendInformation.SendIn_view,
					// SendInformation.SendIn_Status,
					// Member.Mem_Name,
					// Member.Mem_LasName,
					// FileAttach.File_Status, 
					// ROW_NUMBER() OVER (ORDER BY SendInformation.SendIn_ID DESC) AS 'RowNumber'
					
					
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					SendInformation.SendIn_ID,
					SendInformation.SendIn_UpdateDate,
					SendInformation.SendIn_CreateDate,
					SendInformation.SendIn_Issue,
					SendInformation.SendIn_Detail,
					SendInformation.SendIn_view,
					SendInformation.SendIn_Status,
					Member.Mem_Name,
					Member.Mem_LasName,
					FileAttach.File_Status, 
					ROW_NUMBER() OVER (ORDER BY SendInformation.SendIn_ID DESC) AS 'RowNumber'
				FROM
					SendInformation
				LEFT JOIN
					FileAttach
				ON
					SendInformation.SendIn_ID = FileAttach.SendIn_ID
				LEFT JOIN
					Member
				ON 
					SendInformation.Mem_ID = Member.Mem_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_grov_count()
	{
		$StrQuery = "
			SELECT
				COUNT((SendInformation.SendIn_ID)) AS NUMROW
			FROM
				SendInformation
			LEFT JOIN
				FileAttach
			ON 
				SendInformation.SendIn_ID = FileAttach.SendIn_ID
		";
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_grov_search(
		$page=1, 
		$row_per_page=20, 
		$news_title = '', 
		$startdate = '', 
		$enddate = '',
		$Ministry_ID = '',
		$Department_ID = ''
	)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					SendInformation.SendIn_ID,
					SendInformation.SendIn_UpdateDate,
					SendInformation.SendIn_CreateDate,
					SendInformation.SendIn_Issue,
					SendInformation.SendIn_Detail,
					SendInformation.SendIn_view,
					SendInformation.SendIn_Status,
					Member.Mem_Name,
					Member.Mem_LasName,
					FileAttach.File_Status, 
					ROW_NUMBER() OVER (ORDER BY SendInformation.SendIn_ID DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN
					FileAttach
				ON
					SendInformation.SendIn_ID = FileAttach.SendIn_ID
				LEFT JOIN
					Member
				ON 
					SendInformation.Mem_ID = Member.Mem_ID
		";
		if(!($news_title == "" && $startdate == "" && $enddate == "" && $Ministry_ID == "" && $Department_ID == "")){
			$StrQuery .= "
				WHERE
			";
		}
		if($news_title != ""){
			$StrQuery .= "
						SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
			";
		}
		if($startdate != "" && $enddate == "" ){
			if($news_title != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Convert(datetime, '".$startdate."') <
						CASE WHEN SendIn_UpdateDate IS NULL  
							THEN 
								 SendIn_CreateDate
							ELSE
								SendIn_UpdateDate
						END
			";
		}
		elseif($startdate == "" && $enddate != "" ){
			if($news_title != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Convert(datetime, '".$enddate."') >
						CASE WHEN SendIn_UpdateDate IS NULL  
							THEN 
								 SendIn_CreateDate
							ELSE
								SendIn_UpdateDate
						END
			";
		}
		elseif($startdate != "" && $enddate != "" ){
			if($news_title != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
				CASE WHEN SendIn_UpdateDate IS NOT NULL  
						THEN 
							SendIn_UpdateDate 
						ELSE
							SendIn_CreateDate
					END
								BETWEEN 
									Convert(datetime, '".$startdate."') 
									AND
									Convert(datetime, '".$enddate."')
			";
		}
		if($Ministry_ID != ""){
			if($news_title != "" || $startdate != "" || $enddate != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Ministry_ID = '".$Ministry_ID."'
			";
		}
		if($Department_ID != ""){
			if($news_title != "" || $startdate != "" || $enddate != "" || $Ministry_ID != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Dep_ID = '".$Department_ID."'
			";
		}
		$StrQuery .= "
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_grov_search_count(
		$news_title = '', 
		$startdate = '', 
		$enddate = '',
		$Ministry_ID = '',
		$Department_ID = ''
	)
	{
		$StrQuery = "
			SELECT
				COUNT((SendInformation.SendIn_ID)) AS NUMROW
			FROM
				SendInformation
			LEFT JOIN
				FileAttach
			ON 
				SendInformation.SendIn_ID = FileAttach.SendIn_ID
		";
		if(!($news_title == "" && $startdate == "" && $enddate == "" && $Ministry_ID == "" && $Department_ID == "")){
			$StrQuery .= "
				WHERE
			";
		}
		if($news_title != ""){
			$StrQuery .= "
						SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
			";
		}
		if($startdate != "" && $enddate == "" ){
			if($news_title != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Convert(datetime, '".$startdate."') <
						CASE WHEN SendIn_UpdateDate IS NULL  
							THEN 
								 SendIn_CreateDate
							ELSE
								SendIn_UpdateDate
						END
			";
		}
		elseif($startdate == "" && $enddate != "" ){
			if($news_title != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Convert(datetime, '".$enddate."') >
						CASE WHEN SendIn_UpdateDate IS NULL  
							THEN 
								 SendIn_CreateDate
							ELSE
								SendIn_UpdateDate
						END
			";
		}
		elseif($startdate != "" && $enddate != "" ){
			if($news_title != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
				CASE WHEN SendIn_UpdateDate IS NOT NULL  
						THEN 
							SendIn_UpdateDate 
						ELSE
							SendIn_CreateDate
					END
								BETWEEN 
									Convert(datetime, '".$startdate."') 
									AND
									Convert(datetime, '".$enddate."')
			";
		}
		if($Ministry_ID != ""){
			if($news_title != "" || $startdate != "" || $enddate != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Ministry_ID = '".$Ministry_ID."'
			";
		}
		if($Department_ID != ""){
			if($news_title != "" || $startdate != "" || $enddate != "" || $Ministry_ID != ""){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Dep_ID = '".$Department_ID."'
			";
		}
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	
	
	//##################################################################################################
	//##################################################################################################
	//##################################################################################################
	//##################################################################################################
	//##################################################################################################
	//##################################################################################################
	
}