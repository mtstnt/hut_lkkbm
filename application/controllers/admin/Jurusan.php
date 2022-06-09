<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}

		$this->load->helper('functions');
		$this->load->model('Jurusan_model');
	}

	public function index()
	{
		$data = array();
		$data['jurusan'] = $this->Jurusan_model->find_all()->result();
		$data['counter'] = 1;
		$data['page'] = 'jurusan';

		load_admin($this->load, 'admin/jurusan/index', $data);
	}

	public function create()
	{
		$data = array();
		$data['page'] = 'jurusan';

		load_admin($this->load, 'admin/jurusan/form', $data);
	}

	public function store()
	{
		$nama = $this->input->post('nama');

		if ($this->Jurusan_model->save(array(
			'nama' => $nama,
			'created_by' => $this->session->user['username'],
		))) {
			$this->session->set_flashdata('ok', 'Berhasil tersimpan!');
		} else {
			$this->session->set_flashdata('err', 'Gagal menyimpan!');
		}
		return redirect('admin/jurusan');
	}

	public function edit($id)
	{
		$jurusan = $this->Jurusan_model->find($id)->result();

		if (count($jurusan) == 0) {
			return show_404();
		}

		$data = array();
		$data['edit'] = true;
		$data['jurusan'] = $jurusan[0];
		$data['page'] = 'jurusan';
		
		load_admin($this->load, 'admin/jurusan/form', $data);
	}

	public function update($id)
	{
		$jurusan = $this->Jurusan_model->find($id)->result();

		// if (count($jurusan) == 0) {
		// 	return abort(404);
		// }

		$nama = $this->input->post('nama');

		if ($this->Jurusan_model->update($id, array(
			'nama' => $nama,
			'updated_by' => $this->session->user['username'],
			'updated_at' => date('Y-m-d H:i:s', time()),
		))) {
			$this->session->set_flashdata('ok', 'Berhasil mengupdate!');
		} else {
			$this->session->set_flashdata('err', 'Gagal mengupdate!');
		}
		return redirect('admin/jurusan');
	}

	public function delete($id)
	{
		$jurusan = $this->Jurusan_model->find($id)->result();

		// if (count($jurusan) == 0) {
		// 	return abort(404);
		// }

		if ($this->Jurusan_model->update($id, array(
			'status' => 0,
			'deleted_by' => $this->session->user['username'],
			'deleted_at' => date('Y-m-d H:i:s', time()),
		))) {
			$this->session->set_flashdata('ok', 'Berhasil delete!');
		} else {
			$this->session->set_flashdata('err', 'Gagal delete!');
		}
		return redirect('admin/jurusan');
	}
}
