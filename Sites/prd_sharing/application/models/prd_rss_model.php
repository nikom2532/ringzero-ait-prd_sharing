<?php
class PRD_rss_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function last_rssid()
	{
		$query = "
			SELECT TOP 1 Main_RssID,Main_RssID_Encode
			FROM Main_RSS
			ORDER BY Main_RssID DESC";
		return $this->db->query($query)->result();
	}
	public function get_news()
	{
		$sql = "
			SELECT TOP 20 News_OldID
			FROM News
			ORDER BY News_Date DESC
		";
		return $this->db->query($sql)->result();
	}
	public function generate_rss()
	{
		$today = date("Y-m-d H:i:s");
		$mainid = "";
		$query = "
			INSERT INTO Main_RSS(Main_UserID,Main_Date)
			VALUES ('user','$today');";
		$this->db->query($query);
		$lastid['id'] = $this->prd_rss_model->last_rssid();
		foreach($lastid['id'] as $last)
		{
			$mainid = $last->Main_RssID;
		}
		$qr = $this->prd_rss_model->get_news();
		foreach ($qr as $item_qr)
		{
			$sql = "INSERT INTO Detail_RSS (Main_RssID,Detail_NewsID)";
			$sql .= "VALUES ('";
			$sql .= $mainid."','";
			$sql .= $item_qr->News_OldID."');";
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
		$query = "
			SELECT Detail_RSS.Detail_NewsID,Detail_RSS.Main_RssID
			FROM Detail_RSS
			INNER JOIN Main_RSS
			ON Detail_RSS.Main_RssID = Main_RSS.Main_RssID
			WHERE Main_RSS.Main_RssID_Encode = '$page'";
		return $this->db->query($query)->result();
	}
}