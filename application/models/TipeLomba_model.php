<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class TipeLomba_model extends Model
{
	protected $table = 'tipe_lomba';

	public function get_all_tipelomba() 
	{
		return $this->db->select('id, nama')
			->from($this->table)
			->where('status', 1)
			->get();
	}
}
?>