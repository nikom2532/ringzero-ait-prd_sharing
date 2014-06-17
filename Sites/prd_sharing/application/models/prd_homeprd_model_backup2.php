<?php
class PRD_HomePRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	public function get_New_News()
	{
		$query_news = $this->db->
			join('Category', 'News.Cate_ID = Category.Cate_ID', 'left')->
			get('News')->result();
		return $query_news;
	}
	
	public function get_NT01_News_count($Cate_OldID = array())
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
				SELECT
					COUNT((NT01_News.NT01_NewsID)) AS NUMROW
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
				AND
					NT02_NewsType.NT02_Status = 'Y'
				AND
					NT01_News.NT01_Status = 'Y'
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_NT01_News($Cate_OldID = array(), $page=1, $row_per_page=20)
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					MAX(NT01_News.NT01_NewsID) AS NT01_NewsID, 
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_ViewCount) AS NT01_ViewCount, 
					MAX(NT01_News.NT02_TypeID) AS NT02_TypeID,
					MAX(SC03_User.SC03_FName) AS SC03_FName, 
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber'
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				LEFT JOIN SC03_User 
					ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
				AND
					NT01_News.NT01_Status = 'Y'
				AND
					NT02_NewsType.NT02_Status = 'Y'
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		$StrQuery .= "
				group by NT01_News.NT01_NewsID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_Category()
	{
		return $this->db->
			SELECT('
				Category.Cate_OldID,
			')->
			where('Category.Cate_Status', 'Y')->
			get('Category')->result();
	}
	
	//##################### search ###################
	
	public function get_NT01_News_search_title($news_title, $Cate_OldID = array(), $page=1, $row_per_page=20)
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					NT01_News.NT01_NewsID, 
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_ViewCount) AS NT01_ViewCount, 
					MAX(NT01_News.NT02_TypeID) AS NT02_TypeID,
					MAX(SC03_User.SC03_FName) AS SC03_FName, 
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber'
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				LEFT JOIN 
					SC03_User ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
				WHERE 
					NT08_PubTypeID = '11'
				AND
					NT02_NewsType.NT02_Status = 'Y'
				AND
					NT01_News.NT01_Status = 'Y'
			";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		$StrQuery .= "
				AND 
					NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
					
				group by NT01_News.NT01_NewsID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_NT01_News_search_title_count($news_title, $Cate_OldID = array())
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
				SELECT
					COUNT((NT01_News.NT01_NewsID)) AS NUMROW
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
				AND
					NT02_NewsType.NT02_Status = 'Y'
				AND
					NT01_News.NT01_Status = 'Y'
				AND 
					NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_NT01_News_search_title_start($news_title, $startdate, $Cate_OldID = array(), $page=1, $row_per_page=20)
	{
		// $startdate = "2004-06-01 00:00:00.000";
		// echo $startdate;
		
		
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					NT01_News.NT01_NewsID, 
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_ViewCount) AS NT01_ViewCount, 
					MAX(NT01_News.NT02_TypeID) AS NT02_TypeID,
					MAX(SC03_User.SC03_FName) AS SC03_FName, 
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber'
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				LEFT JOIN SC03_User
					ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID
				WHERE
				(
						NT08_PubTypeID = '11'
					AND
						NT02_NewsType.NT02_Status = 'Y'
					AND
						NT01_News.NT01_Status = 'Y'
					AND
						NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
					AND
						NT01_NewsDate > Convert(datetime, '".$startdate."')
				)
					
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		$StrQuery .= "
				group by NT01_News.NT01_NewsID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		return $query;
	}
	
	public function get_NT01_News_search_title_start_count($news_title, $startdate, $Cate_OldID = array())
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
				SELECT
					COUNT((NT01_News.NT01_NewsID)) AS NUMROW
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
				AND
					NT02_NewsType.NT02_Status = 'Y'
				AND
					NT01_News.NT01_Status = 'Y'
				AND
					NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
				AND
					NT01_NewsDate > Convert(datetime, '".$startdate."')
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		$StrQuery .= "
			group by NT01_News.NT01_NewsID
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_NT01_News_search_end_start($news_title, $enddate, $Cate_OldID = array(), $page=1, $row_per_page=20)
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					NT01_News.NT01_NewsID, 
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_ViewCount) AS NT01_ViewCount, 
					MAX(NT01_News.NT02_TypeID) AS NT02_TypeID,
					MAX(SC03_User.SC03_FName) AS SC03_FName, 
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber'
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				LEFT JOIN SC03_User
					ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID
				WHERE
				(
						NT08_PubTypeID = '11'
					AND
						NT02_NewsType.NT02_Status = 'Y'
					AND
						NT01_News.NT01_Status = 'Y'
					AND
						NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
					AND
						NT01_NewsDate < Convert(datetime, '".$startdate."')
				)
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		$StrQuery .= "
				group by NT01_News.NT01_NewsID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		return $query;
	}
	
	public function get_NT01_News_search_title_end_count($news_title, $enddate, $Cate_OldID = array())
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		$StrQuery = "
				SELECT
					COUNT((NT01_News.NT01_NewsID)) AS NUMROW
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
				AND
					NT02_NewsType.NT02_Status = 'Y'
				AND
					NT01_News.NT01_Status = 'Y'
				AND
					NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
				AND
					NT01_NewsDate < Convert(datetime, '".$startdate."')
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		$StrQuery .= "
			group by NT01_News.NT01_NewsID
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_NT01_News_search_title_start_end($news_title, $startdate, $enddate, $Cate_OldID = array(), $page=1, $row_per_page=20)
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					NT01_News.NT01_NewsID, 
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_ViewCount) AS NT01_ViewCount, 
					MAX(NT01_News.NT02_TypeID) AS NT02_TypeID,
					MAX(SC03_User.SC03_FName) AS SC03_FName, 
					MAX(NT10_VDO.NT10_FileStatus) AS NT10_FileStatus, 
					MAX(NT11_Picture.NT11_FileStatus) AS NT11_FileStatus, 
					MAX(NT12_Voice.NT12_FileStatus) AS NT12_FileStatus, 
					MAX(NT13_OtherFile.NT13_FileStatus) AS NT13_FileStatus,
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber'
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				LEFT JOIN SC03_User
					ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID
				LEFT JOIN NT10_VDO
					ON NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID
				LEFT JOIN NT11_Picture
					ON NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID
				LEFT JOIN NT12_Voice
					ON NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID
				LEFT JOIN NT13_OtherFile
					ON NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID
				WHERE 
					NT08_PubTypeID = '11'
				AND
					NT02_NewsType.NT02_Status = 'Y'
				AND
					NT01_News.NT01_Status = 'Y'
				
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		$StrQuery .= "
				
				AND
					NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
				AND
					NT01_NewsDate 
						BETWEEN 
							Convert(datetime, '".$startdate."') 
							AND
							Convert(datetime, '".$enddate."')
				group by NT01_News.NT01_NewsID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_NT01_News_search_title_start_end_count($news_title, $start, $end, $Cate_OldID = array())
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
				SELECT
					COUNT((NT01_News.NT01_NewsID)) AS NUMROW
				FROM NT01_News 
				LEFT JOIN NT02_NewsType 
					ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
				AND
					NT02_NewsType.NT02_Status = 'Y'
				AND
					NT01_News.NT01_Status = 'Y'
				AND
					NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
				AND
					NT01_NewsDate 
						BETWEEN 
							Convert(datetime, '".$start."') 
							AND
							Convert(datetime, '".$end."')
		";
		if($Cate_OldID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN (".$Cate_OldID.")
			";
		}
		else {
			$StrQuery .= "
				AND 
					NT01_News.NT02_TypeID IN ('')
			";
		}
		$StrQuery .= "
			group by NT01_News.NT01_NewsID
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}

	//##################### File Attachments ##########################
// 	
	// public function get_NT01_News_query_file1($NT01_NewsID = ''){
		// $query = $this->db_ntt_old->select('*')->
			// // where('NewsID', $NT01_NewsID)->
			// get('VW03_Video');
		// return $query->result();
	// }
// 
	// public function get_NT01_News_query_file2($NT01_NewsID = ''){
		// $query = $this->db_ntt_old->select('*')->
			// // where('NewsID', $NT01_NewsID)->
			// get('VW04_Picture');
		// return $query->result();
	// }
// 
	// public function get_NT01_News_query_file3($NT01_NewsID = ''){
		// $query_file1 = $this->db_ntt_old->
			// select("*")->
			// // where('VW05_Voice.NewsID', $NT01_NewsID)->
			// get('VW05_Voice')->result();
		// return $query_file1;
	// }
// 
	// public function get_NT01_News_query_file4($NT01_NewsID = ''){
		// $query = $this->db_ntt_old->select('*')->
			// // where('NewsID', $NT01_NewsID)->
			// get('VW06_OtherFile');
		// return $query->result();
	// }
	
	//##################### Old Database --- Set #########################
	
	
	public function set_News($news='')
	{
		foreach ($news as $news_item) {
			
			$newsCreDate = strtotime($news_item->NT01_CreDate);
			$newsUpdDate = strtotime($news_item->NT01_UpdDate);
			
			if(isset($newsUpdDate)){
				if($newsUpdDate > $newsCreDate){
					$newsDate = $news_item->NT01_UpdDate;
				}
				else{
					$newsDate = $news_item->NT01_CreDate;
				}
			}
			else{
				$newsDate = $news_item->NT01_CreDate;
			}
			
			if($news_item->NT11_FileStatus == "Y"){
				$NT11_FileStatus = "1";
			}
			else{
				$NT11_FileStatus = "0";
			}
			if($news_item->NT10_FileStatus == "Y"){
				$NT10_FileStatus = "1";
			}
			else{
				$NT10_FileStatus = "0";
			}
			if($news_item->NT12_FileStatus == "Y"){
				$NT12_FileStatus = "1";
			}
			else{
				$NT12_FileStatus = "0";
			}
			if($news_item->NT13_FileStatus == "Y"){
				$NT13_FileStatus = "1";
			}
			else{
				$NT13_FileStatus = "0";
			}
			$data = array(
			   'News_OldID' => $news_item->NT01_NewsID,
			   'News_Date' => $newsDate,
			   'News_StatusPhoto' => $NT11_FileStatus,
			   'News_StatusVDO' => $NT10_FileStatus,
			   'News_StatusVoice' => $NT12_FileStatus,
			   'News_StatusOtherFile' => $NT13_FileStatus,
			   'News_Active' => "1" //,
			   // 'News_StatusPublic' => "1"
			);
			$query2 = $this->db->
						where('News_OldID', $data['News_OldID'])->
						get('News');
						
			if(!($query2->num_rows() > 0)){
				$this->db->insert("News", $data);
			}
	    }
	}
	
	//################## New Database #######################
	
	public function get_prd_search_title($news_title)
	{
		return $this->db->
			like('News_Title', $news_title)->
			get('News')->result();
	}
	public function get_prd_search_title_start($news_title, $start)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			get('News')->result();
	}
	public function get_prd_search_title_start_end($news_title, $start, $end)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			get('News')->result();
	}
	
	public function get_prd_record_count()
	{
		return $this->db->count_all('News');
	}
	
	public function get_prd_limit($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get('News');
			
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
}