<?php
class PRD_ManageNewGROV_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//#########  Database New  ##########
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
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					SendInformation.SendIn_ID,
					SendInformation.SendIn_UpdateDate,
					SendInformation.SendIn_CreateDate,
					SendInformation.SendIn_Issue,
					SendInformation.SendIn_view,
					FileAttach.File_Status, 
					ROW_NUMBER() OVER (ORDER BY SendInformation.SendIn_ID DESC) AS 'RowNumber'
				FROM
					SendInformation
				LEFT JOIN
					FileAttach
				ON 
					SendInformation.SendIn_ID = FileAttach.SendIn_ID
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
					SendInformation.SendIn_view,
					FileAttach.File_Status,
					ROW_NUMBER() OVER (ORDER BY SendInformation.SendIn_ID DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
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
	
	//##########################
	
	//For record a new news
	public function set_prd_news(
		$SendIn_ID='',
		$SendIn_Plan='',
		$SendIn_Issue='' 	
	)
	{
			$data = array(
			   'SendIn_Plan' => $SendIn_Plan,
			   'SendIn_Issue' => $SendIn_Issue,
			);
			
			// var_dump($data);
			
			return $this->db->where("SendIn_ID", $SendIn_ID)->
				update("SendInformation", $data);
	}
}