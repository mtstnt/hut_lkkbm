<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}

		$this->load->helper('functions');
		$this->load->model('Donasi_model');
	}

	public function index()
	{
		$data = array();
		$data['donasi'] = $this->Donasi_model->get_sorted()->result();
		$data['counter'] = 1;
		$data['page'] = 'donasi';

		$this->load->model('TipeUser_model');

		$data['total'] = $this->Donasi_model->get_total_donasi();

		$data['tipe_user'] = $this->TipeUser_model->find_all()->result();

		load_admin($this->load, 'admin/donasi/index', $data);
	}

	public function delete($id)
	{
		if ($this->Donasi_model->delete($id, $this->session->user['username'])) {
			$this->session->set_flashdata('ok', 'Berhasil delete!');
		} else {
			$this->session->set_flashdata('err', 'Gagal delete!');
		}
		return redirect('admin/donasi/index');
	}

	public function simpan()
	{
		$stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
		$request = json_decode($stream_clean);

		$checked = $request->value;
		$id = $request->id;

		if (!$this->Donasi_model->update($id, array(
			'confirmed' => $checked
		))) {
			echo json_encode([
				'error' => 'Gagal update'
			]);
			return;
		}

		$new_total = $this->Donasi_model->get_total_donasi();

		echo json_encode([
			'error' => null,
			'total' => $new_total,
		]);
	}
}
