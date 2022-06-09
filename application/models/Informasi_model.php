<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class Informasi_model extends Model
{
	protected $table = 'informasi';

	public function is_closed()
	{
		/**
		 * 1. Ikut tanggal
		 * 2. Paksa Buka
		 * 3. Paksa Tutup
		 */

		$model = $this->get();
		if ($model->open_registration == 1) {

			// Check apakah buka?
			$diff_start = time() - strtotime($model->start_pendaftaran);
			$diff_end = time() - strtotime($model->end_pendaftaran);
			if ($diff_start > 0 and $diff_end < 0) {
				return false;
			}
			return true;
		}
		else {
			return !($model->open_registration == 2);
		}
	}

	public function get()
	{
		$query = $this->db->get($this->table);

		if ($query->num_rows() < 1) {
			$this->db->insert($this->table, array(
				'tanggal_acara' => null,
				'target_donasi' => 0
			));
		}

		return $query->result()[0];
	}
}
