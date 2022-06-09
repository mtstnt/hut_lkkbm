<?php

defined('BASEPATH') or exit('No direct script access allowed');

abstract class Model extends CI_Model
{
	protected $table = '';

	public function find_all($ignore_status = false)
	{
		if (!$ignore_status)
			return $this->db->get_where($this->table, array('status' => 1));
			
		return $this->db->get($this->table);
	}

	public function find($id, $ignore_status = false)
	{
		if (!$ignore_status) {
			return $this->db
				->where('status', 1)
				->where('id', $id)
				->get($this->table);
		}
		return $this->db->get_where(
			$this->table,
			array('id', $id)
		);
	}

	public function save($data) 
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update($this->table, $data);
	}

	public function delete($id, $user = "")
	{
		return $this->db->where('id', $id)->update($this->table, array(
			'status' => 0,
			'deleted_at' => date('Y-m-d H:i:s', time()),
			'deleted_by' => $user,
		));
	}
}
