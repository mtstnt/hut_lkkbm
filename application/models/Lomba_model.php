<?php 
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class Lomba_model extends Model {
    protected $table = 'peserta_lomba';

	public function get_with_type($id) {
		return $this->db->where('status', 1)
			->where('tipe_lomba_id', $id)
			->get($this->table);
	}

	public function get_info_peserta($id) {
		return $this->db->select('peserta_lomba.*, tl.nama as tipe_lomba, peserta_lomba.bukti_trf')
			->where('peserta_lomba.status', 1)
			->where('peserta_lomba.id', $id)
			->join('tipe_lomba tl', 'tl.id = peserta_lomba.tipe_lomba_id')
			->get($this->table)->result()[0];
	}

	public function get_all() {
		return $this->db->select('peserta_lomba.id, peserta_lomba.nama, peserta_lomba.created_at as tanggal_submit, tl.nama as tipe_lomba, peserta_lomba.judul_karya, peserta_lomba.link_submission, peserta_lomba.tipe_lomba_id, peserta_lomba.bukti_trf')
			->from($this->table)
			->join('tipe_lomba tl', 'tl.id = tipe_lomba_id')
			->where('peserta_lomba.status', 1)
			->get()->result();
	}
}
?>