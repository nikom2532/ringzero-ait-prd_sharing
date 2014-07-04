<?php
class PRD_ManageNewEditGROV_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//#########  Database New  ##########
	public function get_ministry()
	{
		return $this->db->
			where('Minis_Status', '1')->
			get('Ministry')->result();
	}
	public function get_department()
	{
		return $this->db->
			where('Dep_Status', '1')->
			get('Department')->result();
	}
	
	public function get_NT05_Policy()
	{
		$query = $this->db_ntt_old->
			where('NT05_Status', 'Y')->
			order_by('NT05_Sequence', 'asc')->
			get('NT05_Policy');
			
		return $query->result();
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
				
			')->
				// FileAttach.File_Status
			// join('FileAttach', 'SendInformation.SendIn_ID = FileAttach.SendIn_ID', 'left')->
			where('SendInformation.SendIn_ID', $SendIn_ID)->
			get('SendInformation')->result();
	}
	
	//For record a new news
	public function set_prd_news(
		$SendIn_ID='',
		$SendIn_Plan='',
		$SendIn_Issue='',
		$Minis_ID = '',
		$Dep_ID = '',
		$NT05_PolicyID = '',
		$Tar_ID = '',
		$GOVE_Status = '',
		$PRD_Status = '',
		$SendIn_Detail = '',
		$Sendin_Status = ''
	)
	{
			if($Tar_ID == ""){
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
				'SendIn_Status' => $Sendin_Status
			);
			
			return $this->db->where("SendIn_ID", $SendIn_ID)->
				update("SendInformation", $data);
	}
	
	public function get_FileAttach($SendIn_ID = '')
	{
		$query = $this->db->
			where('SendIn_ID', $SendIn_ID)->
			where('File_Status', 1)->
			get('FileAttach')->result();
		return $query;
	}
	
	public function delete_FileAttach($File_ID = '')
	{
		//######## find File name ##########
		$query = $this->db->
			SELECT('
				FileAttach.File_Name,
				FileAttach.SendIn_ID
			')->
			WHERE('File_ID', $File_ID)->
			get('FileAttach')->result();
		
		// echo ($query[0]->File_Name);
		// exit;	
		
		
		//######## make delete file name status ##########
		$StrQuery = "
			UPDATE FileAttach
			SET 
				File_Status = '-1'
			WHERE 
				File_ID = '".$File_ID."'
		";
		$query = $this->db->
			query($StrQuery);
		
		
		//########### Delete File ############
		// $file = str_replace("\\","/", FCPATH).'uploads/aa/1403760326.2499.PNG';	
		$FileAttach = FCPATH.'uploads/'.$query[0]->File_Name;
		unlink($FileAttach);
		
		return $query[0]->SendIn_ID;
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
	
	
}