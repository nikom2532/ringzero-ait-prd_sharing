<?php
class PRD_rss_Home_GOVE_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
		
		//Find Member What is Department and Ministry
		$Member = $this->session->userdata('member_id');
		$StrQueryMember = "
			SELECT
				Mem_Ministry,
				Mem_Department
			FROM Member
			where Mem_ID = ".$Member."
		";
		$QueryMember = $this->db->query($StrQueryMember)->result();
		$this->case = 0;
		$this->str_case = "";
		foreach ($QueryMember as $Member_item) {
			if($Member_item->Mem_Ministry == "" && $Member_item->Mem_Department == ""){
				$this->case = 1;
				$this->str_case = "";
			}
			elseif($Member_item->Mem_Ministry != "" && $Member_item->Mem_Department == ""){
				$this->case = 2;
				$this->str_case = "
					AND 
						SendInformation.PRD_Status = Member.Mem_Ministry
				";
			}
			elseif($Member_item->Mem_Ministry == "" && $Member_item->Mem_Department != ""){
				$this->case = 3;
				$this->str_case = "
					AND 
						SendInformation.GOVE_Status = Member.Mem_Department
				";
			}
			elseif($Member_item->Mem_Ministry != "" && $Member_item->Mem_Department != ""){
				$this->case = 4;
				$this->str_case = "
					AND 
						SendInformation.PRD_Status = Member.Mem_Ministry
					AND 
						SendInformation.GOVE_Status = Member.Mem_Department
				";
			}
		}
	}
	
	public function last_rssid()
	{
		$query = "
			SELECT TOP 1 
				Main_GOVE_RssID, 
				Main_GOVE_RssID_Encode
			FROM 
				Main_RSS_GOVE
			ORDER BY 
				Main_GOVE_RssID DESC";
		return $this->db->query($query)->result();
	}
	
	public function get_NT03_NewsSubType()
	{
		return $this->db_ntt_old->
			// LIMIT('20,0')->	
			get('NT03_NewsSubType')->result();
	}
	public function get_NT03_NewsSubType_Unique($NT02_TypeID = '')
	{
		$query = $this->db_ntt_old;
			// LIMIT('20,0')->
		if($NT02_TypeID != ""){
			$query = $query->
				where('NT02_TypeID', $NT02_TypeID);
		}
		$query = $query->
			get('NT03_NewsSubType')->result();
		return $query;
	}
	
	public function get_SC07_Department()
	{
		$query = $this->db_ntt_old->
			get('SC07_Department');
			
		return $query->result();
	}
	
	public function get_New_News()
	{
		$query_news = $this->db->
			join('Category', 'News.Cate_ID = Category.Cate_ID', 'left')->
			get('News')->result();
		return $query_news;
	}
	
	public function get_SC03_User()
	{
		return $this->db_ntt_old->
			SELECT("
				SC03_User.SC03_UserId,
				SC03_User.SC03_TName+' '+SC03_User.SC03_FName+' '+SC03_User.SC03_LName AS ReporterName
			")->
			get("SC03_User")->result();
	}
	
	//#########################################################################
	
	public function get_NT02_NewsType()
	{
		return $this->db_ntt_old->
			// SELECT('
				// NT02_NewsType.NT02_TypeID
			// ')->
			where('NT02_NewsType.NT02_Status', 'Y')->
			get('NT02_NewsType')->result();
	}
	
	public function get_Category($NT02_NewsType = '')
	{
		$statusArray = array();
		foreach($NT02_NewsType as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->NT02_TypeID."'";
		}
		$NT02_NewsType = implode(",",$statusArray);
		
		$strQuery = "
			SELECT 
				Category.Cate_OldID
			FROM 
				Category
			WHERE 
				Category.Cate_Status = 'Y'
			AND 
				Category.Cate_OldID IN (".$NT02_NewsType.")
		";
		// exit;
		$query = $this->db->query($strQuery)->result();
		return $query;
	}
	
	//############################ News #############################
	
	public function get_news_for_RSS(
		$news_title = '',
		$startdate = '',
		$enddate = ''
	)
	{
		// $statusArray = array();
		// foreach($Cate_OldID as $val){
			// // echo $val->Cate_OldID;
			// $statusArray[] = "'".$val->Cate_OldID."'";
		// }
		// $Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
			SELECT
				MAX(SendInformation.SendIn_ID) AS SendIn_ID,
				MAX(SendInformation.SendIn_UpdateDate) AS SendIn_UpdateDate,
				MAX(SendInformation.SendIn_CreateDate) AS SendIn_CreateDate,
				MAX(SendInformation.SendIn_Issue) AS SendIn_Issue,
				MAX(SendInformation.Mem_ID) AS Mem_ID,
				MAX(SendInformation.SendIn_view) AS SendIn_view,
				MAX(Member.Mem_Name) AS Mem_Name,
				MAX(Member.Mem_LasName) AS Mem_LasName,
				'0' AS File_Type_video,
				'0' AS File_Type_voice,
				'0' AS File_Type_document,
				'0' AS File_Type_image,
				ROW_NUMBER() OVER (ORDER BY MAX(SendInformation.SendIn_ID) DESC) AS 'RowNumber'
			
			FROM SendInformation 
			LEFT JOIN Member 
				ON SendInformation.Mem_ID = Member.Mem_ID
			WHERE 
				SendInformation.SendIn_Status = 'y'
		";
		$StrQuery .= $this->str_case;
		if($news_title != ""){
			$StrQuery .= "
				AND 
					SendInformation.SendIn_Issue LIKE '%".$news_title."%' ESCAPE '!'
			";
		}
		if($startdate != "" && $enddate == "" ){
			$StrQuery .= "
				AND
					Convert(datetime, '".$startdate."') <
						CASE WHEN SendIn_UpdateDate IS NULL  
							THEN 
								 SendIn_CreateDate
							ELSE
								SendIn_UpdateDate
						END
			";
		}
		elseif($startdate == "" && $enddate != "" ){
			$StrQuery .= "
				AND
					Convert(datetime, '".$enddate."') >
						CASE WHEN SendIn_UpdateDate IS NULL  
							THEN 
								 SendIn_CreateDate
							ELSE
								SendIn_UpdateDate
						END
			";
		}
		elseif($startdate != "" && $enddate != "" ){
			$StrQuery .= "
				AND
					CASE WHEN 
						SendIn_UpdateDate IS NOT NULL  
					THEN 
						SendIn_UpdateDate 
					ELSE
						SendIn_CreateDate
					END
						BETWEEN 
							Convert(datetime, '".$startdate."') 
							AND
							Convert(datetime, '".$enddate."')
			";
		}
		$StrQuery .= "
			group by SendInformation.SendIn_ID
		";
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db->
			query($StrQuery)->result();
		
		return $query;
	}
	
	//#######################################################################
	
	public function generate_rss(
		$UserID = '',
		$search = '',
		$start_date = '',
		$end_date = ''
	)
	{
		$today = date("Y-m-d H:i:s");
		$mainid = "";
		$query = "
			INSERT INTO Main_RSS_GOVE(Main_GOVE_UserID,Main_GOVE_Date)
			VALUES ('{$UserID}','{$today}');";
		$this->db->query($query);
		$lastid['id'] = $this->prd_rss_home_gove_model->last_rssid();
		
		foreach($lastid['id'] as $last)
		{
			$mainid = $last->Main_GOVE_RssID;
		}
		
		$qr = $this->prd_rss_home_gove_model->get_news_for_RSS(
			$search,
			$start_date,
			$end_date
		);
		
		// var_dump($qr);
		// exit;
		
		foreach($qr as $item_qr)
		{
			$sql = "INSERT INTO Detail_RSS_GOVE (Main_GOVE_RssID,Detail_GOVE_NewsID)";
			$sql .= "VALUES ('";
			$sql .= $mainid."','";
			$sql .= $item_qr->SendIn_ID."');";
			$this->db->query($sql);
		}
		$sql_update = "
			UPDATE Main_RSS_GOVE
			SET Main_GOVE_RssID_Encode = '".md5($mainid)."'
			WHERE Main_GOVE_RssID = '".$mainid."';";
		$this->db->query($sql_update);
		
		return md5($mainid);
	}
	
	public function get_rss_newsid($page)
	{
		$query = "
			SELECT 
				(Detail_RSS_GOVE.Detail_GOVE_NewsID) AS Detail_NewsID,
				(Detail_RSS_GOVE.Main_GOVE_RssID) AS Main_RssID,
				(Main_RSS_GOVE.Main_GOVE_Date) AS News_Date
			FROM 
				Detail_RSS_GOVE
			LEFT JOIN 
				Main_RSS_GOVE
			ON 
				Detail_RSS_GOVE.Main_GOVE_RssID = Main_RSS_GOVE.Main_GOVE_RssID
			WHERE 
				Main_RSS_GOVE.Main_GOVE_RssID_Encode = '$page'
		";
		
		// echo $query;
		// exit;
		return $this->db->query($query)->result();
	}
}