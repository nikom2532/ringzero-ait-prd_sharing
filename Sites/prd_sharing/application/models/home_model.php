<?php
class Home_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_gove()
	{
		return $this->db->get('test')->row();
	}
}