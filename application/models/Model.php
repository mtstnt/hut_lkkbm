<?php

defined('BASEPATH') or exit('No direct script access allowed');

abstract class Model extends CI_Model
{
	protected $table = '';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	public function find_all($ignore_status = false)
	{
		if (!$ignore_status)
			return $this->db->get_where($this->table, array('status', 1));
		return $this->db->get($this->table);
	}

	public function find($id, $ignore_status = false)
	{
		if (!$ignore_status) {
			return $this->db->get_where(
				$this->table,
				array(
					array('status', 1),
					array('id', $id)
				),
			);
		}
		return $this->db->get_where(
			$this->table,
			array('id', $id)
		);
	}
}
