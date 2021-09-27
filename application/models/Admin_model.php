<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Model.php';

class Admin_model extends Model
{
	protected $table = 'm_admins';

	public function authenticate($username, $password)
	{
		$query = $this->db->select('id, username, password')
			->from('m_admins')
			->where('username', $username)
			->get();

		if ($query->num_rows() == 0) {
			return false;
		}

		$user = $query->result()[0];

		if (!password_verify($password, $user->password)) {
			return false;
		}

		return $user->id;
	}
}
