<?php
class PRD_Info_Ministry_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//##################### New Database #########################
	
	public function get_Ministry($Minis_ID = '')
	{
		$return = $this->db->
			SELECT('
				Ministry.Minis_ID,
				Ministry.Minis_Name,
				Ministry.Minis_Desc,
				Ministry.Minis_Status
			')->
			LIMIT('20,0')->	
			where('Ministry.Minis_ID', $Minis_ID)->
			get('Ministry')->result();
		
		// var_dump($return);
		return $return;
	}
	
	public function check_Ministry_Name()
	{
		$return = $this->db->
			SELECT('
				Ministry.Minis_Name
			')->
			get('Ministry')->result();
		
		// var_dump($return);
		return $return;
	}
}