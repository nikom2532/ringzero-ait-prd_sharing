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
	
	public function get_Department_Unique($Ministry_ID = '')
	{
		$query = $this->db->
			where('Dep_Status', '1')->
			where('Ministry_ID', $Ministry_ID)->
			get('Department');
			
		return $query->result();
	}
	
	public function get_NT05_Policy()
	{
		$query = $this->db_ntt_old->
			where('NT05_Status', 'Y')->
			order_by('NT05_Sequence', 'asc')->
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
			order_by('SC07_DepartmentSeq')->
			get('SC07_Department');
			
		return $query->result();
	}
	
	public function set_sentnew(
		$create_date = '',
		$Minis_ID = '',
		$Dep_ID = '',
		$NT05_PolicyID = '',
		$Tar_ID = '',
		$GOVE_Status = '',
		$PRD_Status = '',
		$SendIn_Plan = '',
		$SendIn_Issue = '',
		$SendIn_Detail = '',
		$Mem_ID = ''
	)
	{
			if($Tar_ID == -1){
				$PRD_Active = null;
				$GOVE_Active = null;
			}
			elseif($Tar_ID == 3){
				$PRD_Active = "1";
				$GOVE_Active = "1";
			}
			elseif($Tar_ID == 4){
				$PRD_Active = "1";
				$GOVE_Active = "0";
			}
			
			$data = array(
				'SendIn_CreateDate' => $create_date,
				'Ministry_ID' => $Minis_ID,
				'Dep_ID' => $Dep_ID,
				'Policy_ID' => $NT05_PolicyID,
				'SendIn_Plan' => $SendIn_Plan,
				'SendIn_Issue' => $SendIn_Issue,
				'SendIn_Detail' => $SendIn_Detail,
				'PRD_Active' => $PRD_Active,
				'PRD_Status' => $PRD_Status,
				'GOVE_Active' => $GOVE_Active,
				'GOVE_Status' => $GOVE_Status,
				'SendIn_Status' => 0,
				'Mem_ID' => $Mem_ID
			);
			
			$this->db->
				insert("SendInformation", $data);
				
			return $this->db->insert_id();
	}
	public function set_AttachFile(
		$get_sentnew_SendIn_ID,
		$file_name
	)
	{
		// var_dump($get_sentnew_SendIn_ID);
		
		// var_dump($file_name);
		// exit;
		
		foreach ($file_name as $file_name_item) {
			
			// echo ($file_name_item["file_extension"]);
			// exit;
			
			$data = array(
				'File_Label' => $file_name_item['file_label'],
				'File_Name' => $file_name_item['file_name'], 
				'File_Path' => $file_name_item['full_path'],
				'File_Extension' => $file_name_item['file_extension'], 
				'File_FileSize' => $file_name_item["file_size"],
				'File_Type' => $file_name_item["file_type"],
				'File_Status' => '1',
				'SendIn_ID' => $get_sentnew_SendIn_ID
			);
			
			$query = $this->db->
				insert("FileAttach", $data);
		}
		return $query;
	}
}