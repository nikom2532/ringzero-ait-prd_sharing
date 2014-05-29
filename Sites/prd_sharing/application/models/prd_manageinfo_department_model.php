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
	
	public function get_Department()
	{
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
		
		// var_dump($return);
		
		return $return;
	}
	
	
	public function get_Department_search($departmentName = '', $dep_status = '')
	{
		$return = $this->db->
			SELECT('
				Department.Dep_ID,
				Department.Dep_Name,
				Department.Dep_Status,
				Department.Ministry_ID,
				
				Ministry.Minis_Name
			')->
			LIMIT('20,0')->	
			join('Ministry', 'Ministry.Minis_ID = Department.Ministry_ID');
			
		if($departmentName != ''){
			$return = $return->
				like('Department.Dep_Name', $departmentName);
		}
		if($dep_status != ''){
			$return = $return->
				like('Department.Dep_Status', $dep_status);
		}
			
		$return = $return->get('Department')->result();
		
		return $return;
	}
	
	
	// $this->db->limit($limit, $start);
}