<?php
class Test_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_test()
	{
		return $this->db->get('test')->row();
	}
}