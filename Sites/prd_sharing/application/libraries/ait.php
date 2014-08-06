<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ait
{

	var $queryString      = '';
	var $table_name = '';
	var $condition  = array();
	var $condition2 = array();
	var $update_time = '';
	var $update_user = '';
	var $datetime    = '';
	var $data        = array();
	var $parseData = array();
	function __construct()
	{
		/*
		$CI =& get_instance();
		$CI->load->database();
		date_default_timezone_set('Asia/Bangkok');
		$this->update_time = date("Y-m-d H:i:s");

		$CI->load->helper( 'url' );
		$CI->lang->load( 'common', 'thai' );
		// Load language
		$this->parseData =
		array(
			"base_url"                => base_url(),
			"lbl_welcome"             =>$CI->lang->line( 'lbl_welcome' ),
			"lbl_signout"             =>$CI->lang->line( 'lbl_signout' ),
			"site_title"              => $CI->lang->line( 'site_title' ),
			"default_list"            => $CI->lang->line( 'default_list' ),
			"default_page"            => $CI->lang->line( 'default_page' ),
			"default_total"           => $CI->lang->line( 'default_total' ),
			"default_btn_report"      => $CI->lang->line( 'default_btn_report' ),
			"default_select"          => $CI->lang->line( 'default_select' ),
			"default_date"            => $CI->lang->line( 'default_date' ),
			"default_to"              => $CI->lang->line( 'default_to' ),
			"domain_news_category"    => $CI->lang->line( 'domain_news_category' ),
			"domain_sub_news_category"=> $CI->lang->line( 'domain_sub_news_category' ),
			"domain_group"            => $CI->lang->line( 'domain_group' ),
			"domain_organize"         => $CI->lang->line( 'domain_organize' ),
			"domain_region"           => $CI->lang->line( 'domain_region' ),
			"domain_province"         => $CI->lang->line( 'domain_province' ),
			"domain_portal"           => $CI->lang->line( 'domain_portal' ),
			"domain_presenter"        => $CI->lang->line( 'domain_presenter' ),
		);
		*/
	}

	function init($params = array())
	{
		if(count($params) > 0)
		{
			foreach($params as $key => $val)
			{
				if(isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}

	function keydata($key)
	{
		return $this->$key;
	}

	function findAll()
	{
		$CI =& get_instance();
		//if(isset($this->query)){
		//	$rs['query'] = $CI->db->query($this->query);
		//}else{
		$rs['query'] = $CI->db->get($this->table_name);
		//}

		$rs['row'] = $rs['query']->row();
		$rs['num_row'] = $rs['query']->num_rows();
		$rs['result'] = $rs['query']->result();
		return $rs;
	}


	function query()
	{
		$CI =& get_instance();
		$rs['query'] = $CI->db->query($this->queryString, $this->condition);
		$rs['row'] = $rs['query']->row();
		$rs['num_row'] = $rs['query']->num_rows();
		$rs['result'] = $rs['query']->result();
		return $rs;
	}

	function findBy()
	{
		$CI =& get_instance();
		//if(isset($this->query)){
		//	$rs['query'] = $CI->db->query($this->query);
		//}else{
		$rs['query'] = $CI->db->get_where($this->table_name, $this->condition);
		//}

		$rs['row'] = $rs['query']->row();
		$rs['num_row'] = $rs['query']->num_rows();
		$rs['result'] = $rs['query']->result();
		return $rs;
	}

	function insert()
	{
		$CI =& get_instance();
		if($this->condition != null){
			$CI->db->where($this->condition);
			$checkID = $CI->db->get($this->table_name)->num_rows();
			if($checkID == 0){
				$CI->db->insert($this->table_name, $this->data);
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			$CI->db->insert($this->table_name,$this->data);
		}
		return $CI->db->insert_id();
	}


	function update()
	{
		$CI =& get_instance();
		if($this->condition2 != null){
			$CI->db->where($this->condition);
			$checkID = $CI->db->get($this->table_name)->num_rows();
			if($checkID == 0){
				$CI->db->update($this->table_name,$this->data,$this->condition2);
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			$CI->db->update($this->table_name,$this->data,$this->condition);
		}
	}

	function delete()
	{
		$CI =& get_instance();
		$CI->db->delete($this->table_name,$this->condition);
	}

	function create_captcha()
	{
		$CI   =& get_instance();

		$CI->load->helper('captcha');
		$vals = array(
			'img_path' => './images/captcha/',
			'img_url'  => base_url().'images/captcha/',
			'font_path'=> base_url().'/fonts/niramit-b.ttf',
		);
		$cap = create_captcha($vals);
		$data= array(
			'captcha_time'=> $cap['time'],
			'ip_address'  => $CI->input->ip_address(),
			'word'        => $cap['word']
		);
		$query = $CI->db->insert_string('captcha', $data);
		$CI->db->query($query);

		return $cap['image'];
	}

	function check_captcha($word)
	{
		$CI         =& get_instance();
		$expiration = time() - 3600; // one hour limit
		$CI->db->delete("captcha",array("captcha_time <"=>$expiration));
		$CI->db->where(array("word"          =>$word,"ip_address"    =>$CI->input->ip_address(),"captcha_time >"=>$expiration));
		$count = $CI->db->count_all_results("captcha");
		return $count;
	}
	function makeTime($datetime)
	{
		list($date,$time) = explode(" ",$datetime);
		list($y,$m,$d) = explode("-", $date);
		list($h,$i,$s) = explode(":", $time);
		return mktime($h,$i,$s,$m,$d,$y);
	}
	function dateTH()
	{
		list($date) = explode(" ",$this->datetime);
		list($y,$m,$d) = explode("-", $date);
		$y     = $y + 543;
		$d     = round($d);
		$month = array('01'=>'มกราคม' ,'02'=>'กุมภาพันธ์' ,'03'=>'มีนาคม' ,'04'=>'เมษายน' ,'05'=>'พฤษภาคม' ,'06'=>'มิถุนายน' ,'07'=>'กรกฎาคม' ,'08'=>'สิงหาคม' ,'09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม' );

		return "$d เดือน ".$month[$m]." พ.ศ. ".$y;

	}

	/*=============================================================
	* TODO: Pagination
	* @agument:	$result_array : ArrayList from Table.
	* 			$url : url to link pagination.
	*			$page : current page active.
	* @return: 	setter Array data in Variable $data.
	*=============================================================*/
	public function pagination($count_row,$url = "",$page,$row_per_page=20)
	{
		$total_page   = $count_row / $row_per_page;
		$page_mod     = $count_row % $row_per_page;
		if($page_mod > 0){
			list($unsign) = explode(".",$total_page);
			$total_page = $unsign + 1;
		}
		$currentPage = $page == null?1:$page;
		$page_url = array();
		for($i = 0;$i < $total_page;$i++){
			array_push($page_url,array(
					"page"    =>$i + 1,
					"value"   =>$i + 1,
					"selected"=>($i + 1 == $page?"selected=selected":"")
				));
		}
		
		$this->parseData += array(
			"jump_url"	=> base_url()."index.php/".$url,
			"next_page"   =>($currentPage == $total_page
				? base_url()."index.php/".$url."$total_page"
				: base_url()."index.php/".$url.($currentPage + 1)),
			"prev_page"   =>($currentPage > 1
				? base_url()."index.php/".$url.($currentPage - 1)
				: base_url()."index.php/".$url."1"),
			"total_page"  =>($total_page == 0
				? 1
				: $total_page),
			"page_url"    =>$page_url,
			"first_page"  =>base_url()."index.php/".$url."1",
			"last_page"   =>base_url()."index.php/".$url."$total_page",
			"current_page"=>$page,
			"row_per_page"=>$row_per_page
		);
	}
}