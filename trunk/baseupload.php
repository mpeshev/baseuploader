<?php
/**
 * Component for basic file upload. Just pass upload dir and attach to add/edit method
 * 
 * 
 * @author nofearinc
 *
 */
class BaseuploadComponent extends Object {
	private $uploads_dir = '/tmp/uploads';

	/**
	 * Upload function - pass uploads_dir for uploaded file
	 * it will save the file from multipart form and return the filename/path
	 * 
	 * NOTE: using uniqid()!
	 * 
	 * @param string $uploads_dir - the directory for upload (needs write privileges)
	 * @return uploaded file name or NULL if no upload
	 */
	public function upload($uploads_dir = NULL) {
			if(!$uploads_dir) {
				$uploads_dir = $this->uploads_dir; 
			}
			$uploads_visible_dir = '';
			$uploaded_file_name = "";
			 foreach ($_FILES["data"]["error"] as $key => $error) {
			        $tmp_name = $_FILES["data"]["tmp_name"][$key]['file'];
			        $name = $_FILES["data"]["name"][$key]['file'];
			        if(empty($name)) {
			        	return NULL;
			        }
			        $uploaded_file_name = $name;
			        $uploaded_file_name = uniqid(). "-". $uploaded_file_name; 
			        move_uploaded_file($tmp_name, "$uploads_dir/$uploaded_file_name");
			 }
			 
			 if(is_array($uploaded_file_name)) {
			 	return NULL;
			 }
			 
			 return $uploaded_file_name;
	}
}
