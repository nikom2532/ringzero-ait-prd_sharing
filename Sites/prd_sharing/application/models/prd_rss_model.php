<?php
class PRD_rss_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	public function last_rssid()
	{
		$query = "
			SELECT TOP 1 Main_RssID,Main_RssID_Encode
			FROM Main_RSS
			ORDER BY Main_RssID DESC";
		return $this->db->query($query)->result();
	}
	
	/*
	public function get_NT02_NewsType()
	{
		return $this->db_ntt_old->
			// LIMIT('20,0')->	
			get('NT02_NewsType')->result();
	}
	*/
	
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
	
	public function get_NT01_News(
		$page=1, 
		$row_per_page=20,
		$Cate_OldID = '' 
	)
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					MAX(NT01_News.NT01_NewsID) AS NT01_NewsID, 
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_NewsSource) AS NT01_NewsSource,
					MAX(NT01_News.NT01_NewsReferance) AS NT01_NewsReferance,
					MAX(NT01_News.NT01_UpdUserID) AS NT01_UpdUserID,
					MAX(NT01_News.NT01_CreUserID) AS NT01_CreUserID,
					MAX(NT01_News.NT01_Status) AS NT01_Status,
					MAX(NT01_News.NT01_NewsDate) AS NT01_NewsDate,
					MAX(SC03_User.SC03_FName) AS SC03_FName,
					MAX(SC03_User.SC03_LName) AS SC03_LName,
					MAX(NT10_VDO.NT10_FileStatus) AS NT10_FileStatus,
					MAX(NT11_Picture.NT11_FileStatus) AS NT11_FileStatus, 
					MAX(NT12_Voice.NT12_FileStatus) AS NT12_FileStatus, 
					MAX(NT13_OtherFile.NT13_FileStatus) AS NT13_FileStatus,
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsDate) DESC) AS 'RowNumber'
				FROM 
					NT01_News 
				LEFT JOIN 
					SC03_User 
				ON 
					SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
				LEFT JOIN 
					NT10_VDO 
				ON 
					NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
				LEFT JOIN 
					NT11_Picture 
				ON 
					NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
				LEFT JOIN 
					NT12_Voice 
				ON 
					NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
				LEFT JOIN 
					NT13_OtherFile 
				ON 
					NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID 
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
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
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_NT01_News_count($Cate_OldID = '')
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
				SELECT
					COUNT((NT01_News.NT01_NewsID)) AS NUMROW
				FROM NT01_News 
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
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
		";
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_NT01_News_Search(
		$page=1, 
		$row_per_page=20, 
		$News_Title = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$grov_active = '',
		$ReporterID = '',
		$Cate_OldID = ''
	)
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					NT01_News.NT01_NewsID,
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_NewsSource) AS NT01_NewsSource,
					MAX(NT01_News.NT01_NewsReferance) AS NT01_NewsReferance,
					MAX(NT01_News.NT01_UpdUserID) AS NT01_UpdUserID,
					MAX(NT01_News.NT01_CreUserID) AS NT01_CreUserID,
					MAX(NT01_News.NT01_Status) AS NT01_Status,
					MAX(NT01_News.NT01_NewsDate) AS NT01_NewsDate,
					MAX(SC03_User.SC03_FName) AS SC03_FName, 
					MAX(NT10_VDO.NT10_FileStatus) AS NT10_FileStatus, 
					MAX(NT11_Picture.NT11_FileStatus) AS NT11_FileStatus, 
					MAX(NT12_Voice.NT12_FileStatus) AS NT12_FileStatus, 
					MAX(NT13_OtherFile.NT13_FileStatus) AS NT13_FileStatus,
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsDate) DESC) AS 'RowNumber'
				FROM 
					NT01_News 
				LEFT JOIN 
					SC03_User 
				ON 
					SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
				LEFT JOIN 
					NT10_VDO 
				ON 
					NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
				LEFT JOIN 
					NT11_Picture 
				ON 
					NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
				LEFT JOIN 
					NT12_Voice 
				ON 
					NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
				LEFT JOIN 
					NT13_OtherFile 
				ON 
					NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID 
				WHERE 
					NT08_PubTypeID = '11'
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
		if($News_Title != ''){
			$StrQuery .= "
				AND 
					NT01_News.NT01_NewsTitle LIKE '%".$News_Title."%' ESCAPE '!'
			";
		}
		if(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate > '".date("Y-m-d H:i:s", strtotime($startdate))."'
			";
		}
		elseif(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate < '".date("Y-m-d H:i:s", strtotime($enddate))."'
			";
		}
		elseif(
			($startdate != '') &&
			($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate
						BETWEEN 
							'".date("Y-m-d H:i:s", strtotime($startdate))."'
							AND
							'".date("Y-m-d H:i:s", strtotime($enddate)+86399)."'
			";
		}
		if($NewsTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT02_TypeID = '".$NewsTypeID."'
			";
		}
		if($NewsSubTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT03_SubTypeID = '".$NewsSubTypeID."'
			";
		}
		if($grov_active != ""){
			$StrQuery .= "
				AND
					SC03_User.SC07_DepartmentId = '".$grov_active."'
			";
		}
		if($ReporterID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT01_ReporterID = '".$ReporterID."'
			";
		}
		$StrQuery .= "
				group by NT01_News.NT01_NewsID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		// group by NT01_News.NT01_NewsID
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_NT01_News_search_count(
		$News_Title = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$grov_active = '',
		$ReporterID = '',
		$Cate_OldID = ''
	)
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
			SELECT
				COUNT((NT01_News.NT01_NewsID)) AS NUMROW
			FROM 
				NT01_News 
			WHERE 
				NT01_News.NT08_PubTypeID = '11'
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
		if($News_Title != ''){
			$StrQuery .= "
				AND 
					NT01_News.NT01_NewsTitle LIKE '%".$News_Title."%' ESCAPE '!'
			";
		}
		if(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate > '".date("Y-m-d H:i:s", strtotime($startdate))."'
			";
		}
		elseif(
			$startdate != '' && !($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate < '".date("Y-m-d H:i:s", strtotime($enddate))."'
			";
		}
		elseif(
			$startdate != '' && $enddate != ''
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate
						BETWEEN 
							'".date("Y-m-d H:i:s", strtotime($startdate))."'
							AND
							'".date("Y-m-d H:i:s", strtotime($enddate)+86399)."'
			";
		}
		if($NewsTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT02_TypeID = '".$NewsTypeID."'
			";
		}
		if($NewsSubTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT03_SubTypeID = '".$NewsSubTypeID."'
			";
		}
		if($grov_active != ""){
			$StrQuery .= "
				AND
					SC03_User.SC07_DepartmentId = '".$grov_active."'
			";
		}
		if($ReporterID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT01_ReporterID = '".$ReporterID."'
			";
		}
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	
	public function get_news_for_RSS(
		$News_Title = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$grov_active = '',
		$ReporterID = '',
		$Cate_OldID = ''
	)
	{
		$statusArray = array();
		foreach($Cate_OldID as $val){
			// echo $val->Cate_OldID;
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
			SELECT
				(NT01_News.NT01_NewsID) AS NT01_NewsID,
				(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
				ROW_NUMBER() OVER (ORDER BY (NT01_News.NT01_NewsDate) DESC) AS 'RowNumber'
			FROM 
				NT01_News
			WHERE 
				NT01_News.NT08_PubTypeID = '11'
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
		if($News_Title != ''){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsTitle LIKE '%".$News_Title."%' ESCAPE '!'
			";
		}
		if(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate > '".date("Y-m-d H:i:s", strtotime($startdate))."'
			";
		}
		elseif(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate < '".date("Y-m-d H:i:s", strtotime($enddate))."'
			";
		}
		elseif(
			($startdate != '') &&
			($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate
						BETWEEN 
							'".date("Y-m-d H:i:s", strtotime($startdate))."'
							AND
							'".date("Y-m-d H:i:s", strtotime($enddate)+86399)."'
			";
		}
		if($NewsTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT02_TypeID = '".$NewsTypeID."'
			";
		}
		if($NewsSubTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT03_SubTypeID = '".$NewsSubTypeID."'
			";
		}
		if($grov_active != ""){
			$StrQuery .= "
				AND
					SC03_User.SC07_DepartmentId = '".$grov_active."'
			";
		}
		if($ReporterID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT01_ReporterID = '".$ReporterID."'
			";
		}
		// $StrQuery .= "
			// group by NT01_News.NT01_NewsID
		// ";
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		return $query;
	}
	
	//#######################################################################
	
	public function generate_rss(
		$UserID = '',
		$search = '',
		$start_date = '',
		$end_date = '',
		$type = '',
		$subtype = '',
		$grov_active = '',
		$reporter = '',
		$Cate_OldID = ''
	)
	{
		$today = date("Y-m-d H:i:s");
		$mainid = "";
		$query = "
			INSERT INTO Main_RSS(Main_UserID,Main_Date)
			VALUES ('{$UserID}','{$today}');";
		$this->db->query($query);
		$lastid['id'] = $this->prd_rss_model->last_rssid();
		
		foreach($lastid['id'] as $last)
		{
			$mainid = $last->Main_RssID;
		}
		
		$qr = $this->prd_rss_model->get_news_for_RSS(
			$search,
			$start_date,
			$end_date,
			$type,
			$subtype,
			$grov_active,
			$reporter,
			$Cate_OldID
		);
		
		// var_dump($qr);
		// exit;
		
		foreach($qr as $item_qr)
		{
			$sql = "INSERT INTO Detail_RSS (Main_RssID,Detail_NewsID)";
			$sql .= "VALUES ('";
			$sql .= $mainid."','";
			$sql .= $item_qr->NT01_NewsID."');";
			$this->db->query($sql);
		}
		$sql_update = "
			UPDATE Main_RSS 
			SET Main_RssID_Encode = '".md5($mainid)."'
			WHERE Main_RssID = '".$mainid."';";
		$this->db->query($sql_update);
		
		return md5($mainid);
	}
	public function get_rss_newsid($page)
	{
		// $query = "
			// SELECT 
				// Detail_RSS.Detail_NewsID,
				// Detail_RSS.Main_RssID
			// FROM 
				// Detail_RSS
			// INNER JOIN 
				// Main_RSS
			// ON 
				// Detail_RSS.Main_RssID = Main_RSS.Main_RssID
			// WHERE 
				// Main_RSS.Main_RssID_Encode = '$page'
		// ";
		
		/*
		$query = "
			SELECT 
				MAX(Detail_RSS.Detail_NewsID) AS Detail_NewsID,
				MAX(Detail_RSS.Main_RssID) AS Main_RssID,
				MAX(News.News_Date) AS News_Date,
				ROW_NUMBER() OVER (ORDER BY (News.News_Date) DESC) AS 'RowNumber'
			FROM 
				Detail_RSS
			LEFT JOIN 
				Main_RSS
			ON 
				Detail_RSS.Main_RssID = Main_RSS.Main_RssID
			LEFT JOIN
				News
			ON 
				News.News_OldID = Detail_RSS.Detail_NewsID
			WHERE 
				Main_RSS.Main_RssID_Encode = '$page'
			GROUP BY News.News_Date 
		";
		*/
		
		//OLD -- Use News for query the date
		/*
		$query = "
			SELECT 
				(Detail_RSS.Detail_NewsID) AS Detail_NewsID,
				(Detail_RSS.Main_RssID) AS Main_RssID,
				
				(News.News_Date) AS News_Date,
				ROW_NUMBER() OVER (ORDER BY (News.News_Date) DESC) AS 'RowNumber'
			FROM 
				Detail_RSS
			LEFT JOIN
				News
			ON 
				News.News_OldID = Detail_RSS.Detail_NewsID
			LEFT JOIN 
				Main_RSS
			ON 
				Detail_RSS.Main_RssID = Main_RSS.Main_RssID
			WHERE 
				Main_RSS.Main_RssID_Encode = '$page'
		";
		*/
		
		//NEW -- Do not use News_Date to Query Date, but will take News + Detail_RSS table to merge together in the controller.
		$query = "
			SELECT 
				(Detail_RSS.Detail_NewsID) AS Detail_NewsID,
				(Detail_RSS.Main_RssID) AS Main_RssID,
				'News.News_Date' AS News_Date
			FROM 
				Detail_RSS
			LEFT JOIN 
				Main_RSS
			ON 
				Detail_RSS.Main_RssID = Main_RSS.Main_RssID
			WHERE 
				Main_RSS.Main_RssID_Encode = '$page'
		";
		
		// echo $query;
		// exit;
		return $this->db->query($query)->result();
	}
	public function get_NewsNews()
	{
		//For will merge with Detail_RSS Table
		$query = $this->db->
			get('News')->result();
		return $query;
	}
}