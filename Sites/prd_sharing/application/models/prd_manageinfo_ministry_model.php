<?php
class PRD_ManageInfo_Ministry_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//##################### New Database #########################
	
	public function get_Ministry()
	{
		$return = $this->db->
			SELECT('
				Minis_ID,
				Minis_Name,
				Minis_Status
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