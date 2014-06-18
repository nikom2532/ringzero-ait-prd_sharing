<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('crc32_hash'))
{
	function crc32_hash($key, $max = 5000)
	{
		return (crc32($key) & 0x7fffffff) % $max;
	}
}

if( ! function_exists('format_date'))
{
	function format_date($unix, $format = 'Y-m-d')
	{
		if ($unix == '' || ! is_numeric($unix))
		{
			$unix = strtotime($unix);
		}

		return strstr($format, '%') !== FALSE
			? ucfirst(utf8_encode(strftime($format, $unix))) //or? strftime($format, $unix)
			: date($format, $unix);
	}
}

if( ! function_exists('htmlencode'))
{
	function htmlencode($str) 
	{
		return htmlspecialchars(stripcslashes(trim($str)), ENT_QUOTES, 'UTF-8');
	}
}

if( ! function_exists('htmldecode'))
{
	function htmldecode($str) 
	{
		return html_entity_decode($str);
	}
}

if( ! function_exists('form_editor'))
{
	function form_editor($id)
	{
		echo	"<script type='text/javascript'>
					CKEDITOR.replace('$id',{	
							toolbar : [
								['Styles','Format','Font','FontSize'],'/',
								['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],'/',
								['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
								['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
							],
							skin : 'v2',
							extraPlugins : 'uicolor',
							uiColor: '#cccccc',
							filebrowserBrowseUrl : '".base_url()."asset/ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl : '".base_url()."asset/ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl : '".base_url()."asset/ckfinder/ckfinder.html?Type=Flash',
							filebrowserUploadUrl : '".base_url()."asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl : '".base_url()."asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl : '".base_url()."asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' ,
							height:'260',
							width:'100%'
					});
				</script>";
	}
}

if( ! function_exists('user_editor'))
{
	function user_editor($id)
	{
		echo	"<script type='text/javascript'>
					CKEDITOR.replace('$id',{	
							toolbar : [
								/*['Styles','Format','Font','FontSize'],'/',*/
								['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Outdent','Indent'],
								['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
								['Table','-','Link','Smiley','TextColor','BGColor','Source']
							],
							skin : 'v2',
							extraPlugins : 'uicolor',
							uiColor: '#cccccc',
							filebrowserBrowseUrl : '".base_url()."ck/user/ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl : '".base_url()."ck/user/ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl : '".base_url()."ck/user/ckfinder/ckfinder.html?Type=Flash',
							filebrowserUploadUrl : '".base_url()."ck/user/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl : '".base_url()."ck/user/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl : '".base_url()."ck/user/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' ,
							height:'250',
							width:'99%'
					});
				</script>";
	}
}

if( ! function_exists('datediff'))
{
	function datediff($startDate, $lastDate, $interval = 'day') 
	{
		$startDate = strtotime($startDate);
		$lastDate = strtotime($lastDate);

		$differnce = $startDate - $lastDate;

		if($interval == 'day')
		{
			$differnce = ($differnce / (60*60*24));
		}
		else if($interval == 'hour')
		{
			$differnce = ($differnce / (60*60));
		}
		else if($interval == 'minute')
		{
			$differnce = ($differnce / (60));
		}
		else if($interval == 'second')
		{
			return $differnce;
		}
		return $differnce;
	}
}

if( ! function_exists('thai_substr'))
{
	function thai_substr($str = '', $max = 100, $suffix = '...')
	{
		$strcut = mb_substr(html_entity_decode($str), 0, $max);
		$explde = explode(" ", $strcut);
		$slice = array_slice($explde, 0, count($explde) -1);
		return implode(" ", $slice) . $suffix;
	}
}

/**
 * CUT TEXT
 * Function to cut down the string that has charactor length longer than given number
 * and end by '...'
 * @param  $text [required]
 * @param  $len [optional, default 14 chrs]
 *
 */
if ( ! function_exists('cut_text')) {
    function cut_text($text, $len=14) {
        if (strlen($text) > $len) {
            $str = mb_substr($text, 0, $len, 'utf-8');
            return $str . '...';
        } else {
            return $text;
        }
    }
}


/**
 * SIMPLE SWEAR WORD CENSOR
 * Reading the swear words from the config file and
 * replace that word with * instead
 * - config file contains an array
 *
 * @author Anuchit Thiam Uan
 * @param $raw_message
 * @return $politified message
 *
 */
 
function word_censor($text)
{
    $CI =& get_instance();
    
    $CI->config->load('swear_words');
    
    $rude_words = $CI->config->item('swear_words');
    $replacement = ' * ';
    
    foreach($rude_words as $banned)
    {
        $text = preg_replace("/{$banned}/i", $replacement, $text);
    }
    return $text;
}

/*Switching server different files after upload*/
if( ! function_exists('ftp_upload'))
{
	function ftp_upload($full_path)
	{
		$CI =& get_instance();
		$CI->load->helper('string');

		$ip_server = ($_SERVER['SERVER_ADDR'] == '172.17.1.1') ? '172.17.1.2' : '172.17.1.1';

		$segment = explode( '/', trim_slashes($full_path) );
		$dir_destination = implode( '/', array_slice( $segment, 4, (count($segment)-5) ) );
		list($file_name) = array_slice( $segment, -1, 1 );

		passthru(FCPATH . 'upload_ftp.sh '.$ip_server.' '.$dir_destination.' '.$file_name);
	}
}

/*Switching server different files after delete*/
if( ! function_exists('ftp_del'))
{
	function ftp_del($full_path)
	{
		$CI =& get_instance();
		$CI->load->helper('string');

		$ip_server = ($_SERVER['SERVER_ADDR'] == '172.17.1.1') ? '172.17.1.2' : '172.17.1.1';

		$segment = explode( '/', trim_slashes($full_path) );
		$dir_destination = implode( '/', array_slice( $segment, 4, (count($segment)-5) ) );
		list($file_name) = array_slice( $segment, -1, 1 );

		passthru(FCPATH . 'del_ftp.sh '.$ip_server.' '.$dir_destination.' '.$file_name);
	}
}

/*Upload multimedia (audio,video) to streaming server different files after web server uploaded */
if( ! function_exists('ftp_video'))
{
	function ftp_video($full_path)
	{
		$CI =& get_instance();
		$CI->load->helper('string');

		$segment = explode( '/', trim_slashes($full_path) );
		$dir_destination = implode( '/', array_slice( $segment, 3, (count($segment)-4) ) ); //Default CAT SERVER (4, -5), DEMO SERVER (3, -4)
		list($file_name) = array_slice( $segment, -1, 1 );

		passthru(FCPATH . 'upload_vdo.sh '.$dir_destination.' '.$file_name);
	}
}

/*Upload multimedia (audio,video) to streaming server different files after web server uploaded */
if( ! function_exists('ftp_delete_video'))
{
	function ftp_delete_video($full_path)
	{
		$CI =& get_instance();
		$CI->load->helper('string');

		$segment = explode( '/', trim_slashes($full_path) );
		$dir_destination = implode( '/', array_slice( $segment, 3, (count($segment)-4) ) ); //Default CAT SERVER (4, -5), DEMO SERVER (3, -4)
		list($file_name) = array_slice( $segment, -1, 1 );

		passthru(FCPATH . 'del_vdo.sh '.$dir_destination.' '.$file_name);
	}
}

if( ! function_exists('get_breadcrumbs'))
{
    function get_breadcrumbs($rawStack)
    {
        $stack = false;
        if( is_array($rawStack))
        {
            $stack = array();
            foreach($rawStack as $title=>$uri)
            {
                $title = cut_text(htmldecode($title), 40);
                $stack[] = ($uri !== FALSE) ? anchor(site_url($uri), $title) :  $title;
            }
        }

        return implode(' &raquo; ', $stack);
    }
}

function convert_number_thai($number){ 
  $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
  $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
  $number = str_replace(",","",$number); 
  $number = str_replace(" ","",$number); 
  $number = str_replace("บาท","",$number); 
  $number = explode(".",$number); 
  if(sizeof($number)>2){ 
    return 'ทศนิยมหลายตัวนะจ๊ะ'; 
    exit; 
  } 
  $strlen = strlen($number[0]); 
  $convert = ''; 
  for($i=0;$i<$strlen;$i++){ 
    $n = substr($number[0], $i,1); 
    if($n!=0){ 
      if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
      elseif($i==($strlen-2) AND $n==2){ $convert .= 'ยี่'; } 
      elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
      else{ $convert .= $txtnum1[$n]; } 
      $convert .= $txtnum2[$strlen-$i-1]; 
    } 
  } 
  $convert .= 'บาท'; 
  if(empty($number[1])){ 
    $convert .= 'ถ้วน'; 
  }else{ 
    $strlen = strlen($number[1]); 
    for($i=0;$i<$strlen;$i++){ 
      $n = substr($number[1], $i,1); 
      if($n!=0){ 
        if($i==($strlen-1) AND $n==1){$convert .= 'เอ็ด';} 
        elseif($i==($strlen-2) AND $n==2){$convert .= 'ยี่';} 
        elseif($i==($strlen-2) AND $n==1){$convert .= '';} 
        else{ $convert .= $txtnum1[$n];} 
        $convert .= $txtnum2[$strlen-$i-1]; 
      } 
    } 
    $convert .= 'สตางค์'; 
  } 
  return $convert; 
} 

if( ! function_exists('format_thai_longdate'))
{
	function format_thai_longdate($type, $date)
	{
		if($type=='month'){
			$month=$date;
			switch($month){
				case '01' : return 'มกราคม'; break;
				case '02' : return 'กุมภาพันธ์'; break;
				case '03' : return 'มีนาคม'; break;
				case '04' : return 'เมษายน'; break;
				case '05' : return 'พฤษภาคม'; break;
				case '06' : return 'มิถุนายน'; break;
				case '07' : return 'กรกฎาคม'; break;
				case '08' : return 'สิงหาคม'; break;
				case '09' : return 'กันยายน'; break;
				case '10' : return 'ตุลาคม'; break;
				case '11' : return 'พฤศจิกายน'; break;
				case '12' : return 'ธันวาคม'; break;
			}
		}else{
			return $date+543;
		}
	}
}

?>