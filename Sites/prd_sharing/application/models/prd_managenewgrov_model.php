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
	
	
	public function delete_grov($sendin_id = '')
	{
		$isDelete = 0;
		$checkDelete = "
			SELECT
				SendIn_Status
			FROM
				SendInformation
			WHERE 
				SendIn_ID = '".$sendin_id."'
		";
		$checkDeleteQuery = $this->db->
			query($checkDelete)->result();
		foreach ($checkDeleteQuery as $checkDeleteItem) {
			$isDelete = $checkDeleteItem->SendIn_Status;
		}
		if($isDelete == -1){
			$StrQuery = "
				UPDATE SendInformation
				SET 
					SendIn_Status = '1'
				WHERE 
					SendIn_ID = '".$sendin_id."'
			";
		}
		else{
			$StrQuery = "
				UPDATE SendInformation
				SET 
					SendIn_Status = '-1'
				WHERE 
					SendIn_ID = '".$sendin_id."'
			";
		}
		$query = $this->db->
			query($StrQuery);
		return $query;
	}
	
	public function get_FileAttach()
	{
		$StrQuery = "
			SELECT
				FileAttach.File_Type,
				FileAttach.SendIn_ID,
				FileAttach.File_Status
			FROM
				FileAttach
			WHERE 
				FileAttach.File_Status = 1
		";
		
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function filter_AttachFile(
		$filter_vdo = '',
		$filter_sound = '',
		$filter_image = '',
		$filter_other = ''
	)
	{
		// $CI_stringManagement =& get_instance();
		// $CI_stringManagement->load->library('string_management');
		
		// $CI_stringManagement->string_management->startsWith($file->File_Type, "video/")){
		
		$StrQuery = "
			SELECT DISTINCT
				SendInformation.SendIn_ID
			FROM
				SendInformation
			LEFT JOIN
				FileAttach
			ON
				SendInformation.SendIn_ID = FileAttach.SendIn_ID
			WHERE 
				FileAttach.File_Status = 1
		";
		if($filter_vdo == 1){
			$StrQuery .= "
				AND 
					FileAttach.File_Type LIKE 'video/%'
			";
		}
		else{
			$StrQuery .= "
				AND 
					FileAttach.File_Type NOT LIKE 'video/%'
			";
		}
		if($filter_sound == 1){
			$StrQuery .= "
				AND 
					FileAttach.File_Type LIKE 'audio/%'
			";
		}
		else{
			$StrQuery .= "
				AND 
					FileAttach.File_Type NOT LIKE 'audio/%'
			";
		}
		if($filter_image == 1){
			$StrQuery .= "
				AND 
					FileAttach.File_Type LIKE 'image/%'
			";
		}
		else{
			$StrQuery .= "
				AND 
					FileAttach.File_Type NOT LIKE 'image/%'
			";
		}
		if($filter_other == 1){
			$StrQuery .= "
				AND ( 
						FileAttach.File_Type NOT LIKE 'video/%'
					AND
						FileAttach.File_Type NOT LIKE 'audio/%'
					AND
						FileAttach.File_Type NOT LIKE 'image/%'
				)
			";
		}
		else{
			$StrQuery .= "
				AND ( 
						FileAttach.File_Type LIKE 'video/%'
					AND
						FileAttach.File_Type LIKE 'audio/%'
					AND
						FileAttach.File_Type LIKE 'image/%'
				)
			";
		}
		
		// echo $StrQuery;
		// echo "<br/>";
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_grov(
		$page=1, 
		$row_per_page=20
	)
	{
		/*
		if($filter_AttachFile != ""){
			$statusArray = array();
			foreach($filter_AttachFile as $val){
				$statusArray[] = "'".$val->SendIn_ID."'";
			}
			$filter_AttachFile = implode(",",$statusArray);
		}
		*/
		
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		/*
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					MAX(SendInformation.SendIn_ID) AS SendIn_ID,
					MAX(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
					MAX(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					MAX(SendInformation.SendIn_Issue) AS SendIn_Issue,
					MAX(SendInformation.SendIn_view) AS SendIn_view,
					MAX(SendInformation.SendIn_Status) AS SendIn_Status,
					MAX(FileAttach.File_Status) AS File_Status,
					MAX(FileAttach.File_Type) AS File_Type,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM
					SendInformation
				LEFT JOIN
					FileAttach
				ON 
					SendInformation.SendIn_ID = FileAttach.SendIn_ID
				group by SendInformation.SendIn_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		*/
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					(SendInformation.SendIn_ID) AS SendIn_ID,
					(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
					(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					(SendInformation.SendIn_Issue) AS SendIn_Issue,
					(SendInformation.SendIn_view) AS SendIn_view,
					(SendInformation.SendIn_Status) AS SendIn_Status,
					'0' AS File_Type_video,
					'0' AS File_Type_voice,
					'0' AS File_Type_document,
					'0' AS File_Type_image,
					ROW_NUMBER() OVER (ORDER BY (SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM
					SendInformation
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_grov_count()
	{
		/*	
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
		*/
		
		$StrQuery = "
			SELECT
				COUNT((SendInformation.SendIn_ID)) AS NUMROW
			FROM
				SendInformation
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
		$Department_ID = '',
		$filter_AttachFile = ''
	)
	{
		if($filter_AttachFile != null){
			$statusArray = array();
			foreach($filter_AttachFile as $val){
				$statusArray[] = "'".$val->SendIn_ID."'";
			}
			$filter_AttachFile = implode(",",$statusArray);
		}
		else{
			$filter_AttachFile = "''";
		}
		
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		
		/*
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					MAX(SendInformation.SendIn_ID) AS SendIn_ID,
					MAX(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
					MAX(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					MAX(SendInformation.SendIn_Issue) AS SendIn_Issue,
					MAX(SendInformation.SendIn_view) AS SendIn_view,
					MAX(SendInformation.SendIn_Status) AS SendIn_Status,
					MAX(FileAttach.File_Status) AS File_Status,
					ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM SendInformation 
				LEFT JOIN FileAttach
					ON SendInformation.SendIn_ID = FileAttach.SendIn_ID
		";
		*/
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					(SendInformation.SendIn_ID) AS SendIn_ID,
					(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
					(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
					(SendInformation.SendIn_Issue) AS SendIn_Issue,
					(SendInformation.SendIn_view) AS SendIn_view,
					(SendInformation.SendIn_Status) AS SendIn_Status,
					'0' AS File_Type_video,
					'0' AS File_Type_voice,
					'0' AS File_Type_document,
					'0' AS File_Type_image,
					ROW_NUMBER() OVER (ORDER BY (SendInformation.SendIn_ID) DESC) AS 'RowNumber'
				FROM 
					SendInformation 
				WHERE
					SendInformation.SendIn_ID IN (".$filter_AttachFile.")
					
		";
		if($news_title != ""){
			$StrQuery .= "
				AND
					SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
			";
		}
		if($startdate != "" && $enddate == "" ){
			$StrQuery .= "
				AND
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
			$StrQuery .= "
				AND
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
			$StrQuery .= "
				AND
					CASE WHEN 
						SendIn_UpdateDate IS NOT NULL  
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
			$StrQuery .= "
				AND
					Ministry_ID = '".$Ministry_ID."'
			";
		}
		if($Department_ID != ""){
			// if($news_title != "" || $startdate != "" || $enddate != "" || $Ministry_ID != ""){
			$StrQuery .= "
				AND
					Dep_ID = '".$Department_ID."'
			";
		}
		$StrQuery .= "
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		// echo $StrQuery;
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_grov_search_count(
		$news_title = '', 
		$startdate = '', 
		$enddate = '',
		$Ministry_ID = '',
		$Department_ID = '',
		$filter_AttachFile = ''
	)
	{
		if($filter_AttachFile != null){
			$statusArray = array();
			foreach($filter_AttachFile as $val){
				$statusArray[] = "'".$val->SendIn_ID."'";
			}
			$filter_AttachFile = implode(",",$statusArray);
		}
		else{
			$filter_AttachFile = "''";
		}
		
		/*
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
		*/
		$StrQuery = "
			SELECT
				COUNT((SendInformation.SendIn_ID)) AS NUMROW
			FROM
				SendInformation
			WHERE
				SendInformation.SendIn_ID IN (".$filter_AttachFile.")
		";
		if($news_title != ""){
			$StrQuery .= "
				AND 
					SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
			";
		}
		if($startdate != "" && $enddate == "" ){
			$StrQuery .= "
				AND
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
			$StrQuery .= "
				AND
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
			$StrQuery .= "
				AND
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
			$StrQuery .= "
				AND
					Ministry_ID = '".$Ministry_ID."'
			";
		}
		if($Department_ID != ""){
			$StrQuery .= "
				AND
					Dep_ID = '".$Department_ID."'
			";
		}
		
		// echo $StrQuery; 
		
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
}