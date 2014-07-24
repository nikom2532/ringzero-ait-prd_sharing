<?php
class PRD_ManageNewGROV_FileAttach_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_FileAttach()
	{
		$StrQuery = "
			SELECT
				FileAttach.File_Type,
				FileAttach.SendIn_ID,
				FileAttach.File_Status
			FROM
				FileAttach
			WHERE 
				FileAttach.File_Status = 1
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_FileAttach_video()
	{
		$StrQuery = "
			SELECT DISTINCT
				SendInformation.SendIn_ID
			FROM
				SendInformation
			LEFT JOIN
				FileAttach
			ON
				SendInformation.SendIn_ID = FileAttach.SendIn_ID
			WHERE 
				FileAttach.File_Status = 1
			AND
				(
					SendInformation.SendIn_Status = 'y'
					OR
					SendInformation.SendIn_Status = 'n'
					OR
					SendInformation.SendIn_Status = 'w'
				)
			AND
				FileAttach.File_Type LIKE 'video/%'
		";
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_FileAttach_audio()
	{
		$StrQuery = "
			SELECT DISTINCT
				SendInformation.SendIn_ID
			FROM
				SendInformation
			LEFT JOIN
				FileAttach
			ON
				SendInformation.SendIn_ID = FileAttach.SendIn_ID
			WHERE 
				FileAttach.File_Status = 1
			AND
				(
					SendInformation.SendIn_Status = 'y'
					OR
					SendInformation.SendIn_Status = 'n'
					OR
					SendInformation.SendIn_Status = 'w'
				)
			AND
				FileAttach.File_Type LIKE 'audio/%'
		";
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_FileAttach_image()
	{
		$StrQuery = "
			SELECT DISTINCT
				SendInformation.SendIn_ID
			FROM
				SendInformation
			LEFT JOIN
				FileAttach
			ON
				SendInformation.SendIn_ID = FileAttach.SendIn_ID
			WHERE 
				FileAttach.File_Status = 1
			AND
				(
					SendInformation.SendIn_Status = 'y'
					OR
					SendInformation.SendIn_Status = 'n'
					OR
					SendInformation.SendIn_Status = 'w'
				)
			AND
				FileAttach.File_Type LIKE 'image/%'
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_FileAttach_document()
	{
		$StrQuery = "
			SELECT DISTINCT
				SendInformation.SendIn_ID
			FROM
				SendInformation
			LEFT JOIN
				FileAttach
			ON
				SendInformation.SendIn_ID = FileAttach.SendIn_ID
			WHERE 
				FileAttach.File_Status = 1
			AND
				(
					SendInformation.SendIn_Status = 'y'
					OR
					SendInformation.SendIn_Status = 'n'
					OR
					SendInformation.SendIn_Status = 'w'
				)
			AND 
			(
					FileAttach.File_Type NOT LIKE 'video/%'
				AND
					FileAttach.File_Type NOT LIKE 'audio/%'
				AND
					FileAttach.File_Type NOT LIKE 'image/%'
			)
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function filter_AttachFile(
		$filter_vdo = '',
		$filter_sound = '',
		$filter_image = '',
		$filter_other = '',
		$FileAttach_video = '',
		$FileAttach_audio = '',
		$FileAttach_image = '',
		$FileAttach_document = ''
	)
	{
		// echo $filter_image;
		// exit;
		
		if($FileAttach_video != null){
			$statusArray = array();
			foreach($FileAttach_video as $val){
				$statusArray[] = "'".$val->SendIn_ID."'";
			}
			$FileAttach_video = implode(",",$statusArray);
		}
		
		// var_dump($FileAttach_video);
		// exit;
		
		if($FileAttach_audio != null){
			$statusArray = array();
			foreach($FileAttach_audio as $val){
				$statusArray[] = "'".$val->SendIn_ID."'";
			}
			$FileAttach_audio = implode(",",$statusArray);
		}
		
		// var_dump($FileAttach_audio);
		// exit;
		
		if($FileAttach_image != null){
			$statusArray = array();
			foreach($FileAttach_image as $val){
				$statusArray[] = "'".$val->SendIn_ID."'";
			}
			$FileAttach_image = implode(",",$statusArray);
		}
		
		if($FileAttach_document != null){
			$statusArray = array();
			foreach($FileAttach_document as $val){
				$statusArray[] = "'".$val->SendIn_ID."'";
			}
			$FileAttach_document = implode(",",$statusArray);
		}
		
		$StrQuery = "
			SELECT DISTINCT
				SendInformation.SendIn_ID
			FROM
				SendInformation
			LEFT JOIN
				FileAttach
			ON
				SendInformation.SendIn_ID = FileAttach.SendIn_ID
			WHERE 
				FileAttach.File_Status = 1
			AND
				(
					SendInformation.SendIn_Status = 'y'
					OR
					SendInformation.SendIn_Status = 'n'
					OR
					SendInformation.SendIn_Status = 'w'
				)
		";
		if(
			$filter_vdo == 1 ||
			$filter_sound == 1 || 
			$filter_sound == 1 ||
			$filter_other == 1
		){
			$StrQuery .= "
				AND
				(
			";
		}
		if($filter_vdo == 1){
			$StrQuery .= "
				SendInformation.SendIn_ID IN (".$FileAttach_video.")
			";
		}
		if($filter_sound == 1){
			if($filter_vdo == 1){
				$StrQuery .= "
					OR
				";
			}
			$StrQuery .= "
				SendInformation.SendIn_ID IN (".$FileAttach_audio.")
			";
		}
		if($filter_image == 1){
			if($filter_vdo == 1 || $filter_sound == 1){
				$StrQuery .= "
					OR
				";
			}
			$StrQuery .= "
				SendInformation.SendIn_ID IN (".$FileAttach_image.")
			";
		}
		if($filter_other == 1){
			if($filter_vdo == 1 || $filter_sound == 1 || $filter_image == 1){
				$StrQuery .= "
					OR
				";
			}
			$StrQuery .= "
				SendInformation.SendIn_ID IN (".$FileAttach_document.")
			";
		}
		if(
			$filter_vdo == 1 ||
			$filter_sound == 1 || 
			$filter_sound == 1 ||
			$filter_other == 1
		){
			$StrQuery .= "
				)
			";
		}
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	
}