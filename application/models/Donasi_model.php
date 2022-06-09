<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class Donasi_model extends Model
{
	protected $table = 'donasi';

	public function get_sorted() 
	{
		return $this->db
			->select('
				donasi.*, 
				tipe_user.name as detail_user, 
				metode_pembayaran.nama as metode_pembayaran')
			->from($this->table)
			->join('tipe_user', 'tipe_user.id = tipe_user_id')
			->join('metode_pembayaran', 'metode_pembayaran.id = metode_pembayaran_id')
			->where('donasi.status', 1)
			->order_by('time_stamp', 'desc')
			->order_by('confirmed', 'asc')
			->get();
	}

	public function get_hima_leaderboard()
	{
		return $this->db->query(
			"SELECT lk.id, lk.name, lk.logo, COALESCE(SUM(d.jumlah),0) as total
			FROM (SELECT * FROM donasi WHERE status = 1 AND confirmed = 1) d
			RIGHT JOIN lk ON lk.id = d.lk_id 
			WHERE lk.status = 1
			GROUP BY lk.id
			ORDER BY total DESC, lk.name ASC
			");
	}

	public function get_total_umum()
	{
		return $this->db->query("SELECT SUM(jumlah) total FROM donasi WHERE lk_id IS NULL AND status = 1 AND confirmed = 1")->row();
	}

	public function get_total_donasi()
	{
		return $this->db
			->query('SELECT COALESCE(SUM(jumlah), 0) AS total 
					FROM donasi 
					WHERE status = 1 
					AND confirmed = 1
					')
			->row()->total;
	}

	public function get_total_today()
	{
		$date_today = date('Y-m-d', time());
		return $this->db
			->query("SELECT COALESCE(SUM(jumlah), 0) AS total
					FROM donasi 
					WHERE status = 1
					AND DATE(time_stamp) >= '$date_today'
			")->row()->total;
	}
}
