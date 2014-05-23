<?php
class PRD_ManageNewEditGROV_model extends CI_Model {

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
	
	public function get_grov($SendIn_ID)
	{
		// return $this->db->get('SendInformation')->result();
		return $this->db->
			select('
				SendInformation.SendIn_ID,
				SendInformation.SendIn_UpdateDate,
				SendInformation.SendIn_CreateDate,
				
				SendInformation.SendIn_Plan,
				SendInformation.SendIn_Issue,
				SendInformation.SendIn_Detail,
				SendInformation.SendIn_Status,
				
				FileAttach.File_Status
			')->
			join('FileAttach', 'SendInformation.SendIn_ID = FileAttach.SendIn_ID', 'left')->
			where('SendInformation.SendIn_ID', $SendIn_ID)->
			get('SendInformation')->result();
	}
	//##########################
	
	// $this->db->limit($limit, $start);
}