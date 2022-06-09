<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class Lk_model extends Model
{
	protected $table = 'lk';

	public function get_all_lk()
	{
		return $this->db->select('id, name, total_donasi, logo')
			->from($this->table)
			->where('status', 1)
			->get();
	}

	public function get_with_total_count()
	{
		return $this->db->query('
			SELECT lk.id, lk.name, lk.logo, COALESCE(SUM(jumlah), 0) AS total_donasi
			FROM lk LEFT JOIN donasi d ON lk.id = d.lk_id
			WHERE lk.status = 1
			GROUP BY lk.id
		')->result();
	}
}
