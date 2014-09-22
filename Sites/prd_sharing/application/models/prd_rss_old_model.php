<?php
class PRD_rss_old_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		// $this->load->database('nnt_data_center_old', TRUE);
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	public function get_news_gove($newsid)
	{
	 	$query = "
			SELECT TOP 10 * 
			FROM SendInformation
			WHERE SendInformation.SendIn_ID = '$newsid';";
		return $this->db->query($query)->result();
	}
	
	
	public function get_news($newsid)
	{
	 	$query = "
			SELECT * 
			FROM NT01_News
			WHERE NT01_News.NT01_NewsID = '$newsid';";
		return $this->db_ntt_old->query($query)->result();
	}
}