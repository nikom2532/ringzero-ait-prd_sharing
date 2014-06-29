<?php
class PRD_ManageInfo_Ministry_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//##################### New Database #########################
	
	
	public function get_Department()
	{
		// echo $Minis_ID;
		$query = $this->db->
			select('
				Department.Dep_ID,
				Department.Ministry_ID
			')->
			get('Department')->result();
			
		return $query;
	}
	
	
	public function Ministry_children_key($Minis_ID='')
	{
		// echo $Minis_ID;
		$query = $this->db->
			// select('Department.Dep_ID')->
			where('Department.Ministry_ID', $Minis_ID)->
			get('Department')->result();
			
		return $query;
	}
	
	
	public function del_Ministry($Minis_ID='')
	{
		$query = $this->db->
			where('Minis_ID', $Minis_ID)->
			delete('Ministry');
			
		return $query;
	}
	
	
	
	public function set_Minstry_new(
		$Minis_Name = '', 
		$Minis_Desc = '', 
		$Minis_Status = ''
	){
		$data = array(
			'Minis_Name' => $Minis_Name,
			'Minis_Desc' => $Minis_Desc,
			'Minis_Status' => $Minis_Status
		);
		
		// var_dump($data);
		
		$query = $this->db->
			insert('Ministry', $data);
		
		// var_dump($query);
		
		// return $query;
	}
	
	public function set_Minstry(
		$Minis_ID = '', 
		$Minis_Name = '', 
		$Minis_Desc = '', 
		$Minis_Status = ''
	){
		$data = array(
			'Minis_Name' => $Minis_Name,
			'Minis_Desc' => $Minis_Desc,
			'Minis_Status' => $Minis_Status
		);
		
		var_dump($data);
		
		$query = $this->db->
			where('Ministry.Minis_ID', $Minis_ID)->
			Update('Ministry', $data);
		
		// var_dump($query);
		
		// return $query;
	}
	
	public function get_Ministry($page=1, $row_per_page=20)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					Ministry.Minis_ID,
					Ministry.Minis_Name,
					Ministry.Minis_Status,
					ROW_NUMBER() OVER (ORDER BY Ministry.Minis_ID DESC) AS 'RowNumber'
				FROM 
					Ministry
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_Ministry_count()
	{
		$StrQuery = "
				SELECT
					COUNT((Ministry.Minis_ID)) AS NUMROW
				FROM Ministry 
		";
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	//get Ministry that can delete or not
	public function get_Ministry_canDeleted($value='')
	{
		
	}
	
	public function get_Ministry_search($page=1, $row_per_page=20, $MinisName = '', $MinisStatus = '')
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					Ministry.Minis_ID,
					Ministry.Minis_Name,
					Ministry.Minis_Status,
					ROW_NUMBER() OVER (ORDER BY Ministry.Minis_ID DESC) AS 'RowNumber'
				FROM 
					Ministry
		";
		if($MinisName != '' || $MinisStatus != ''){
			$StrQuery .= "
				WHERE
			";
		}
		if($MinisName != ''){
			$StrQuery .= "
				Ministry.Minis_Name = '".$MinisName."'
			";
		}
		if($MinisStatus != ''){
			if($MinisName != ''){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
				Ministry.Minis_Status = '".$MinisStatus."'
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
	
	public function get_Ministry_search_count($MinisName = '', $MinisStatus = '')
	{
		$StrQuery = "
				SELECT
					COUNT((Ministry.Minis_ID)) AS NUMROW
				FROM Ministry 
		";
		if($MinisName != '' || $MinisStatus != ''){
			$StrQuery .= "
				WHERE
			";
		}
		if($MinisName != ''){
			$StrQuery .= "
				Ministry.Minis_Name = '".$MinisName."'
			";
		}
		if($MinisStatus != ''){
			if($MinisName != ''){
				$StrQuery .= "
					AND
				";
			}
			$StrQuery .= "
				Ministry.Minis_Status = '".$MinisStatus."'
			";
		}
		$query = $this->db->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
}