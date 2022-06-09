<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}

		$this->load->helper('functions');
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$data = array();
		$data['admins'] = $this->Admin_model->find_all()->result();
		$data['counter'] = 1;
		$data['page'] = 'access';

		load_admin($this->load, 'admin/admin_manager/index', $data);
	}

	public function create()
	{
		$data = array();
		$data['page'] = 'access';

		load_admin($this->load, 'admin/admin_manager/form', $data);
	}

	public function store()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->Admin_model->save(array(
			'username' => $username,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'created_by' => $this->session->user['username'],
		))) {
			$this->session->set_flashdata('ok', 'Berhasil tersimpan!');
		} else {
			$this->session->set_flashdata('err', 'Gagal menyimpan!');
		}
		return redirect('admin/access');
	}

	public function edit($id)
	{
		$admin = $this->Admin_model->find($id)->result();

		if (count($admin) == 0) {
			return show_404();
		}

		$data = array();
		$data['edit'] = true;
		$data['admin'] = $admin[0];
		$data['page'] = 'access';
		
		load_admin($this->load, 'admin/admin_manager/form', $data);
	}

	public function update($id)
	{
		$admin = $this->Admin_model->find($id)->result();

		if (count($admin) == 0) {
			return show_404();
		}

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->Admin_model->update($id, array(
			'username' => $username,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'updated_by' => $this->session->user['username'],
			'updated_at' => date('Y-m-d H:i:s', time()),
		))) {
			$this->session->set_flashdata('ok', 'Berhasil mengupdate!');
		} else {
			$this->session->set_flashdata('err', 'Gagal mengupdate!');
		}
		return redirect('admin/access');
	}

	public function delete($id)
	{
		$admin = $this->Admin_model->find($id)->result();

		if (count($admin) == 0) {
			return show_404();
		}

		if ($this->Admin_model->delete($id, $this->session->user['username'])) {
			$this->session->set_flashdata('ok', 'Berhasil delete!');
		} else {
			$this->session->set_flashdata('err', 'Gagal delete!');
		}
		return redirect('admin/access');
	}
}
