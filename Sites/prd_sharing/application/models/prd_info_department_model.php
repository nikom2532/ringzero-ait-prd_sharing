<?php
class PRD_Info_Department_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//##################### New Database #########################
	
	public function get_Department($dep_id = '')
	{
		$return = $this->db->
			SELECT('
				Department.Dep_ID,
				Department.Dep_Name,
				Department.Dep_Status,
				Department.Ministry_ID,
				Department.Dep_Desc,
				Ministry.Minis_ID,
				Ministry.Minis_Name
			')->
			LIMIT('20,0')->	
			join('Ministry', 'Ministry.Minis_ID = Department.Ministry_ID', 'left')->
			where('Department.Dep_ID', $dep_id, 'left')->
			get('Department')->result();
		
		return $return;
	}
	
	public function get_Ministry()
	{
			$return = $this->db->
				SELECT('
					Ministry.Minis_ID,
					Ministry.Minis_Name,
					Ministry.Minis_Status
				')->
				LIMIT('20,0')->	
				get('Ministry')->result();
			
			return $return;
	}
	
	public function check_Department_Name()
	{
		$return = $this->db->
			SELECT('
				Department.Dep_Name,
			')->
			get('Department')->result();
		
		return $return;
	}
}