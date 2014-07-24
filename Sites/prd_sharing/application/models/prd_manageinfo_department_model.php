<?php
class PRD_ManageInfo_Department_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//##################### New Database #########################
	
	
	public function del_Department($Dep_ID='')
	{
		$query = $this->db->
			where('Dep_ID', $Dep_ID)->
			delete('Department');
			
		return $query;
	}
	
	
	public function set_Department_New(
		$Dep_Name = '', 
		$Dep_Desc = '', 
		$Dep_Status = '',
		$Ministry_ID = ''
	){
		$data = array(
			'Dep_Name' => $Dep_Name,
			'Dep_Desc' => $Dep_Desc,
			'Dep_Status' => $Dep_Status,
			'Ministry_ID' => $Ministry_ID
		);
		
		// var_dump($data);
		
		$query = $this->db->
			insert('Department', $data);
		
		// var_dump($query);
		
		return $query;
	}
	
	
	public function set_Department(
		$Dep_ID = '', 
		$Dep_Name = '', 
		$Dep_Desc = '', 
		$Dep_Status = '',
		$Ministry_ID = ''
	){
		$data = array(
			'Dep_Name' => $Dep_Name,
			'Dep_Desc' => $Dep_Desc,
			'Dep_Status' => $Dep_Status,
			'Ministry_ID' => $Ministry_ID
		);
		
		// var_dump($data);
		
		$query = $this->db->
			where('Department.Dep_ID', $Dep_ID)->
			Update('Department', $data);
		
		// var_dump($query);
		
		// return $query;
	}
	
	public function get_Department(
		$page = 1,
		$row_per_page = 20,
		$get_grov_for_dep_id = ''
	)
	{
		if($get_grov_for_dep_id != null){
			$statusArray = array();
			foreach($get_grov_for_dep_id as $val){
				$statusArray[] = "'".$val->Dep_ID."'";
			}
			$get_grov_for_dep_id = implode(",",$statusArray);
		}
		
		/*
		$return = $this->db->
		SELECT('
		Department.Dep_ID,
		Department.Dep_Name,
		Department.Dep_Status,
		Department.Ministry_ID,
		Ministry.Minis_Name
		')->
		LIMIT('20,0')-> 
		join('Ministry', 'Ministry.Minis_ID = Department.Ministry_ID')->
		get('Department')->result();
		
		return $return;
		*/
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
			// WHERE
				// Department.Dep_ID NOT IN (".$get_grov_for_dep_id.")
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					Department.Dep_ID,
					Department.Dep_Name,
					Department.Dep_Status,
					Department.Ministry_ID,
					Ministry.Minis_Name,
					'use_dep_id' AS use_dep_id,
					ROW_NUMBER() OVER (ORDER BY Department.Dep_ID DESC) AS 'RowNumber'
				FROM 
					Department
				LEFT JOIN
					Ministry
				ON
					Ministry.Minis_ID = Department.Ministry_ID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_Department_count(
		$get_grov_for_dep_id = ''
	)
	{
		if($get_grov_for_dep_id != null){
			$statusArray = array();
			foreach($get_grov_for_dep_id as $val){
				$statusArray[] = "'".$val->Dep_ID."'";
			}
			$get_grov_for_dep_id = implode(",",$statusArray);
		}
		
		$StrQuery = "
			SELECT
				COUNT((Department.Dep_ID)) AS NUMROW
			FROM 
				Department 
		";
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_Department_search(
		$page=1,
		$row_per_page=20,
		$departmentName = '', 
		$dep_status = '',
		$get_grov_for_dep_id = ''
	)
	{
		if($get_grov_for_dep_id != null){
			$statusArray = array();
			foreach($get_grov_for_dep_id as $val){
				$statusArray[] = "'".$val->Dep_ID."'";
			}
			$get_grov_for_dep_id = implode(",",$statusArray);
		}
		
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					Department.Dep_ID,
					Department.Dep_Name,
					Department.Dep_Status,
					Department.Ministry_ID,
					Ministry.Minis_Name,
					'no' AS use_dep_id,
					ROW_NUMBER() OVER (ORDER BY Department.Dep_ID DESC) AS 'RowNumber'
				FROM 
					Department
				JOIN
					Ministry
				ON
					Ministry.Minis_ID = Department.Ministry_ID
		";
		if($departmentName != '' || $dep_status != ''){
			$StrQuery .= "
				WHERE
			";
		}
		if($departmentName != ''){
			$StrQuery .= "
					Department.Dep_Name LIKE '%".$departmentName."%'
			";
		}
		if($dep_status != ''){
			if($departmentName != ''){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Department.Dep_Status LIKE '%".$dep_status."%'
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
	
	public function get_Department_search_count(
		$departmentName = '', 
		$dep_status = '',
		$get_grov_for_dep_id = ''
	)
	{
		if($get_grov_for_dep_id != null){
			$statusArray = array();
			foreach($get_grov_for_dep_id as $val){
				$statusArray[] = "'".$val->Dep_ID."'";
			}
			$get_grov_for_dep_id = implode(",",$statusArray);
		}
		
		$StrQuery = "
				SELECT
					COUNT((Department.Dep_ID)) AS NUMROW
				FROM 
					Department 
		";
		if($departmentName != '' || $dep_status != ''){
			$StrQuery .= "
				WHERE
			";
		}
		if($departmentName != ''){
			$StrQuery .= "
					Department.Dep_Name LIKE '%".$departmentName."%'
			";
		}
		if($dep_status != ''){
			if($departmentName != ''){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
					Department.Dep_Status LIKE '%".$dep_status."%'
			";
		}
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_grov_for_dep_id()
	{
		$StrQuery = "
			SELECT DISTINCT
				SendInformation.Dep_ID
			FROM
				SendInformation
			WHERE 
			(
				SendInformation.SendIn_Status = 'y'
				OR
				SendInformation.SendIn_Status = 'n'
				OR
				SendInformation.SendIn_Status = null
			)
			and
			(
				SendInformation.Dep_ID <> null
				or
				SendInformation.Dep_ID <> 0
				or
				SendInformation.Dep_ID <> ''
			)
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
}