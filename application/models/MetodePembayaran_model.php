<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class MetodePembayaran_model extends Model
{
	protected $table = 'metode_pembayaran';
	
	public function get_all_pembayaran() {
        return $this->db->select('id, nama, deskripsi')
			->from($this->table)
			->where('status', 1)
			->get();
    }
}
