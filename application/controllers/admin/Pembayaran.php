<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pembayaran extends CI_Controller {
    public function __construct()
	{
		parent::__construct();

		if (! $this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}

		$this->load->helper('functions');
		$this->load->model('MetodePembayaran_model');
	}

	public function index()
	{
		$data = array();
		$data['pembayaran'] = $this->MetodePembayaran_model->find_all()->result();
		$data['counter'] = 1;
		$data['page'] = 'pembayaran';

		load_admin($this->load, 'admin/pembayaran/index', $data);
	}
    public function create() 
    {
        $data = array();
		$data['page'] = 'pembayaran';

		load_admin($this->load, 'admin/pembayaran/form', $data);
    }
    public function store()
    {
        $metode = $this->input->POST('method');
        $deskripsi = $this->input->POST('deskripsi');
        if ($this->MetodePembayaran_model->save(array(
			'nama' => $metode,
			'deskripsi' => $deskripsi,
		))) {
			$this->session->set_flashdata('ok', 'Berhasil tersimpan!');
		} else {
			$this->session->set_flashdata('err', 'Gagal menyimpan!');
		}
		return redirect('admin/pembayaran');
    }
	public function update($id)
	{
		$MetodePembayaran = $this->MetodePembayaran_model->find($id)->result();

		if (count($MetodePembayaran) == 0) {
			return show_404();
		}

		$metode = $this->input->POST('method');
        $deskripsi = $this->input->POST('deskripsi');

		if ($this->MetodePembayaran_model->update($id, array(
			'nama' => $metode,
			'deskripsi' => $deskripsi,
			'updated_by' => $this->session->user['username'],
			'updated_at' => date('Y-m-d H:i:s', time()),
		))) {
			$this->session->set_flashdata('ok', 'Berhasil mengupdate!');
		} else {
			$this->session->set_flashdata('err', 'Gagal mengupdate!');
		}
		return redirect('admin/pembayaran');
	}
    public function edit($id)
	{
		$MetodePembayaran = $this->MetodePembayaran_model->find($id)->result();

		if (count($MetodePembayaran) == 0) {
			return show_404();
		}

		$data = array();
		$data['edit'] = true;
		$data['pembayaran'] = $MetodePembayaran[0];
		$data['page'] = 'pembayaran';
		
		load_admin($this->load, 'admin/pembayaran/form', $data);
	}
    public function delete($id)
	{
		$MetodePembayaran = $this->MetodePembayaran_model->find($id)->result();

		if (count($MetodePembayaran) == 0) {
			return show_404();
		}

		if ($this->MetodePembayaran_model->update($id, array(
			'status' => 0,
			'deleted_by' => $this->session->user['username'],
			'deleted_at' => date('Y-m-d H:i:s', time()),
		))) {
			$this->session->set_flashdata('ok', 'Berhasil delete!');
		} else {
			$this->session->set_flashdata('err', 'Gagal delete!');
		}
		return redirect('admin/pembayaran');
	}
}
?>