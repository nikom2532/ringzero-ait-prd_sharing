<?php 
class Multiupload{

	var $upload_path = "";
	var $allowed_type= "";
	var $max_size  = "";
	var $max_width = "";
	var $max_height = "";
	var $_files = "";
	var $config= array();
	
	var $file_name=array();
	var $file_extension = array();
	
	/*-------------------------------------------------------------------------------
	* TODO : Initialize config upload data
	*-------------------------------------------------------------------------------*/
	public function init(){
		/*
		foreach($this->_files as $field => $file){
			var_dump($file['name']);
		}
		*/
		$this->config = array(
			'upload_path' => $this->upload_path,
			'allowed_types' => $this->allowed_types,
			'max_size' => $this->max_size,
			'max_width' => $this->max_width,
			'max_height' => $this->max_height
		);
	}

	/*-------------------------------------------------------------------------------
	* TODO : Upload file
	* @parameter : $_files [multiple images]
	* @return : picture name as Array
	*-------------------------------------------------------------------------------*/
	public function do_upload(){
		$CI=& get_instance();
		$CI->load->library('upload', $this->config);
		
		foreach($this->_files as $field => $file){
			
            if($file['error'] == 0){
                if ($CI->upload->do_upload($field)){
                    $data = $CI->upload->data();
					
					// array_push($this->file_name, iconv("UTF-8", "tis-620", $data['file_name']));
					// $name = microtime(true).$data['file_ext'];
					$name = microtime(true)."_".$data['file_name'];
					
					rename($data['full_path'], $data['file_path']. $name);
					
					$return = array(
						'file_name' => $name,
						'full_path' => './',
						'file_extension' => $data['file_ext'],
						'file_type' => $data["file_type"],
						'file_size' => $data["file_size"]
					);
					
                    array_push($this->file_name, $return);
					
                }else{
                    $errors = $CI->upload->display_errors();
                }
            }
        }
		return $this->file_name;
		// return array(
			// 'file_name' => $this->file_name,
			// 'file_extension' => $this->file_extension
		// );
	}
}

