<?php
class PRD_Info_Department_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//##################### New Database #########################
	
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
				where('Department.Dep_Name', $departmentName);
		}
		if($dep_status != ''){
			$return = $return->
				where('Department.Dep_Status', $dep_status);
		}
			
		$return = $return->get('Department')->result();
		
		return $return;
	}
	
	
	// $this->db->limit($limit, $start);
}