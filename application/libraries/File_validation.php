<?php
defined('BASEPATH') or exit('No direct script access allowed');

define('FILE_VALIDATION_SUCCESS', 0);
define('FILE_VALIDATION_MIME_NOT_ALLOWED', 1);
define('FILE_VALIDATION_MAX_SIZE_EXCEEDED', 2);

class File_validation
{
	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('file');
	}

	public function validate_file($field_name, $allowed_mimes = [], $max_size_bytes = 0)
	{
		$file = $_FILES[$field_name];

		$file_ext = get_mime_by_extension($file['name']);

		if (! in_array($file_ext, $allowed_mimes)) {
			return FILE_VALIDATION_MIME_NOT_ALLOWED;
		}

		if ($max_size_bytes != 0 and $file['size'] > $max_size_bytes) {
			return FILE_VALIDATION_MAX_SIZE_EXCEEDED;
		}

		return FILE_VALIDATION_SUCCESS;
	}
}
