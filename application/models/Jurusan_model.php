<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class Jurusan_model extends Model
{
	protected $table = 'jurusan';

	public function get_jurusan() 
	{
		return $this->db->select('id, nama')
			->from($this->table)
			->where('status', 1)
			->order_by('nama', 'asc')
			->get();
	}
}
