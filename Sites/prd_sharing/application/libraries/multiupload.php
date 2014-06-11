<?php 
class Multiupload{

	var $upload_path = "";
	var $allowed_type= "";
	var $max_size  = "";
	var $max_width = "";
	var $max_height = "";
	var $_files = "";
	var $file_name=array();
	var $config= array();

	/*-------------------------------------------------------------------------------
	* TODO : Initialize config upload data
	*-------------------------------------------------------------------------------*/
	public function init(){
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
                        array_push($this->file_name, $data['file_name']);
                }else{
                        $errors = $CI->upload->display_errors();
                }
            }
        }
        return $this->file_name;
	}
}

