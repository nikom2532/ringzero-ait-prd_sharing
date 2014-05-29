<?php
class PRD_ManageInfo_Ministry_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//##################### New Database #########################
	
	
	public function del_Ministry($value='')
	{
		
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
		
		var_dump($data);
		
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
	
	public function get_Ministry_search($MinisName = '', $MinisStatus = '')
	{
		$return = $this->db->
			SELECT('
				Ministry.Minis_ID,
				Ministry.Minis_Name,
				Ministry.Minis_Status
			')->
			LIMIT('20,0');
		
		if($MinisName != ''){
			$return = $return->
				where('Ministry.Minis_Name', $MinisName);
		}
		
		if($MinisStatus != ''){
			$return = $return->
				where('Ministry.Minis_Status', $MinisStatus);
		}
		
		$return = $return->
			get('Ministry')->result();
		
		return $return;
	}
}