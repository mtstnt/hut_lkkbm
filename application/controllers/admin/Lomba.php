<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lomba extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}

		$this->load->helper('functions');
		$this->load->model('Lomba_model');
	}

	public function index()
	{
		$this->load->model('TipeLomba_model');

		$data = array();
		$data['lomba'] = $this->Lomba_model->get_all();
		$data['counter'] = 1;
		$data['page'] = 'peserta_lomba';
		$data['tipe_lomba'] = $this->TipeLomba_model->find_all()->result();

		load_admin($this->load, 'admin/lomba/index', $data);

	}

	public function score()
	{
		$score = $this->input->post('score');
		$id = $this->input->post('id');

		if (!$score) {
			$this->session->set_flashdata('err', 'Nilai belum diberikan!');
			return redirect('admin/lomba/index');
		}

		if (!$this->Lomba_model->set_score($id, $score)) {
			$this->session->set_flashdata('err', 'Gagal menyimpan nilai!');
			return redirect('admin/lomba/index');
		}

		$this->session->set_flashdata('ok', 'Berhasil menyimpan nilai!');
		return redirect('admin/lomba/index');
	}

	public function show($id)
	{
		$model = $this->Lomba_model->get_info_peserta($id);
		$data = array();
		$data['page'] = 'lomba';

		if ($model->anggota) {
			$model->kelompok = json_decode($model->anggota, true);
		}
		$data['lomba'] = $model;

		load_admin($this->load, 'admin/lomba/show', $data);
	}
}