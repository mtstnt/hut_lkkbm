<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}
		$this->load->helper('functions');
		$this->load->model('Informasi_model');
	}

	public function index()
	{
		$data = array();
		$data['page'] = 'informasi';

		$data['informasi'] = $this->Informasi_model->get();

		load_admin($this->load, 'admin/informasi', $data);
	}

	public function update()
	{
		$this->form_validation->set_rules('tanggal_acara', 'Tanggal Acara', 'required');
		$this->form_validation->set_rules('target_donasi', 'Target Donasi', 'required|is_numeric');
		$this->form_validation->set_rules('start_pendaftaran', 'Start Pendaftaran', 'required');
		$this->form_validation->set_rules('end_pendaftaran', 'Tutup Pendaftaran', 'required');
		$this->form_validation->set_rules('open_registration', 'Pendaftaran', 'required|is_numeric');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('err', validation_errors());
			return redirect('admin/informasi');
		}

		$tanggal_acara 		= htmlspecialchars($this->input->post('tanggal_acara'));
		$target_donasi 		= htmlspecialchars($this->input->post('target_donasi'));
		$start_pendaftaran 	= htmlspecialchars($this->input->post('start_pendaftaran'));
		$end_pendaftaran 	= htmlspecialchars($this->input->post('end_pendaftaran'));
		$open_registration 	= htmlspecialchars($this->input->post('open_registration'));

		if (! $this->Informasi_model->update(1, 
			compact('tanggal_acara', 'target_donasi', 'start_pendaftaran', 'end_pendaftaran', 'open_registration')
		)){
			$this->session->set_flashdata('err', 'Gagal menyimpan!');
			return redirect('admin/informasi');
		}

		$this->session->set_flashdata('ok', 'Berhasil menyimpan!');
		return redirect('admin/informasi');
	}
}