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
		$page=1,
		$row_per_page=20
	)
	{
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
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					Department.Dep_ID,
					Department.Dep_Name,
					Department.Dep_Status,
					Department.Ministry_ID,
					Ministry.Minis_Name,
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
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_Department_count()
	{
		$StrQuery = "
				SELECT
					COUNT((Department.Dep_ID)) AS NUMROW
				FROM Department 
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
		$dep_status = ''
	)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					Department.Dep_ID,
					Department.Dep_Name,
					Department.Dep_Status,
					Department.Ministry_ID,
					Ministry.Minis_Name,
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
		$dep_status = ''
	)
	{
		$StrQuery = "
				SELECT
					COUNT((Department.Dep_ID)) AS NUMROW
				FROM Department 
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
}