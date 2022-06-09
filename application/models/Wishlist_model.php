<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class Wishlist_model extends Model
{
	protected $table = 'wishlist';

	public function get($offset, $limit, $search = null) 
	{
		if ($search != null) {
			return $this->db->select(
				'wishlist.id, wishlist.nama as nama, wishlist.nrp as nrp, j.nama as prodi, wishlist.content, t.name as tipe_user'
			)
			->from($this->table)
			->join('jurusan j', 'wishlist.jurusan_id = j.id', 'left')
			->join('tipe_user t', 'wishlist.tipe_user_id = t.id', 'left')
			->where('wishlist.status', 1)
			->like('wishlist.nama', $search)
			->or_like('j.nama', $search)
			->get();
		}

		/**
		 * select w.id, w.nama, t.name as tipe_user, w.content, COALESCE(w.jurusan_id, "") as prodi 
*			from wishlist w
*			join tipe_user t on t.id = w.tipe_user_id
*			left join jurusan j on j.id = w.jurusan_id
		 */

		return $this->db->select(
				"w.id, w.nama, t.name as tipe_user, w.content, j.nama as prodi"
			)
			->from("wishlist w")
			->join('jurusan j', 'w.jurusan_id = j.id', 'left')
			->join('tipe_user t', 'w.tipe_user_id = t.id')
			->where('w.status', 1)
			->limit($limit, $offset)
			->get();
	}
	public function getAdmin() 
	{
		return $this->db->select(
				'wishlist.id, wishlist.nama as nama, wishlist.nrp as nrp, j.nama as jurusan, wishlist.content'
			)
			->from($this->table)
			->where('wishlist.status', 1)
			->join('jurusan j', 'wishlist.jurusan_id = j.id')
			->get();
	}

	public function deleteById($ids) {
		$this->db->where_in('id', $ids);

		if ($this->db->delete($this->table)) {
			return TRUE; 		 
		}
		else {
			return FALSE;
		}
	}
}
