<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}

		$this->load->helper('functions');
		$this->load->model('Lk_model');
	}

	public function index()
	{
		$data = array();
		$data['lk'] = $this->Lk_model->get_with_total_count();
		$data['counter'] = 1;
		$data['page'] = 'lk';

		load_admin($this->load, 'admin/lk/index', $data);
	}

	public function create()
	{
		$data = array();
		$data['page'] = 'lk';

		load_admin($this->load, 'admin/lk/form', $data);
	}

	public function store()
	{
		$name = $this->input->post('name');

		$this->load->library('upload');

		$config = array();
		$config['upload_path']          = './assets/uploads/logo/';
		$config['allowed_types']        = 'jpg|jpeg|png|webp';
		$config['max_size']             = 10240;
		$config['file_name']			= uniqid($name . '_');

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file')) {
			$this->session->set_flashdata('err', $this->upload->display_errors());
			return redirect('admin/lk');
		}

		$data = $this->upload->data();

		if ($this->Lk_model->save(array(
			'name' => $name,
			'logo' => $data['file_name'],
			'created_by' => $this->session->user['username'],
		))) {
			$this->session->set_flashdata('ok', 'Berhasil tersimpan!');
		} else {
			$this->session->set_flashdata('err', 'Gagal menyimpan!');
		}
		return redirect('admin/lk');
	}

	public function edit($id)
	{
		$lk = $this->Lk_model->find($id)->result();

		$data = array();
		$data['edit'] = true;
		$data['lk'] = $lk[0];
		$data['page'] = 'lk';

		load_admin($this->load, 'admin/lk/form', $data);
	}

	public function update($id)
	{
		$lk = $this->Lk_model->find($id)->result();

		$name = $this->input->post('name');

		$this->load->library('upload');

		$filename = "";

		if ($_FILES['file'] != null) {
			$config = array();
			$config['upload_path']          = './assets/uploads/logo/';
			$config['allowed_types']        = 'jpg|jpeg|png|webp';
			$config['max_size']             = 10240;
			$config['file_name']			= uniqid($name . '_');

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')) {
				$this->session->set_flashdata('err', $this->upload->display_errors());
				return redirect('admin/lk');
			}

			$data = $this->upload->data();
			$filename = $data['file_name'];
		}

		if ($this->Lk_model->update($id, array(
			'name' => $name,
			'logo' => $filename,
			'updated_by' => $this->session->user['username'],
			'updated_at' => date('Y-m-d H:i:s', time()),
		))) {
			$this->session->set_flashdata('ok', 'Berhasil mengupdate!');
		} else {
			$this->session->set_flashdata('err', 'Gagal mengupdate!');
		}
		return redirect('admin/lk');
	}

	public function delete($id)
	{
		$lk = $this->Lk_model->find($id)->result();

		if ($this->Lk_model->update($id, array(
			'status' => 0,
			'deleted_by' => $this->session->user['username'],
			'deleted_at' => date('Y-m-d H:i:s', time()),
		))) {
			$this->session->set_flashdata('ok', 'Berhasil delete!');
		} else {
			$this->session->set_flashdata('err', 'Gagal delete!');
		}
		return redirect('admin/lk');
	}
}
