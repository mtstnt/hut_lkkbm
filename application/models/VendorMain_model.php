<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class VendorMain_model extends Model
{
	protected $table = 'vendor';
	
	public function get_all_vendor() {
        return $this->db->select('id, nama, logo, deskripsi')
			->from($this->table)
			->where('status', 1)
			->get();
    }
}
