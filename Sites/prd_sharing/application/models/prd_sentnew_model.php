<?php
class PRD_SentNew_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	public function get_Ministry()
	{
		$query = $this->db->
			where('Minis_Status', '1')->
			get('Ministry');
			
		return $query->result();
	}
	
	public function get_Department()
	{
		$query = $this->db->
			where('Dep_Status', '1')->
			get('Department');
			
		return $query->result();
	}
	
	public function get_NT05_Policy()
	{
		$query = $this->db_ntt_old->
			get('NT05_Policy');
			
		return $query->result();
	}
	
	public function get_TargetGroup()
	{
		$query = $this->db->
			get('TargetGroup');
			
		return $query->result();
	}
	
	public function get_SC07_Department()
	{
		$query = $this->db_ntt_old->
			get('SC07_Department');
			
		return $query->result();
	}
	
	public function set_sentnew(
		$create_date,
		$Minis_ID,
		$Dep_ID,
		$NT05_PolicyID,
		$Tar_ID,
		$grov_active,
		$prd_active,
		$SendIn_Plan,
		$SendIn_Issue,
		$SendIn_Detail
	)
	{
			$data = array(
				'SendIn_CreateDate' => $create_date, 	
				'Ministry_ID' => $Minis_ID,
				'Dep_ID' => $Dep_ID,
				'Policy_ID' => $NT05_PolicyID,
				'SendIn_Plan' => $SendIn_Plan,
				'SendIn_Issue' => $SendIn_Issue,
				'SendIn_Detail' => $SendIn_Detail
			);
			
			return $this->db->
				insert("SendInformation", $data);
	}
}