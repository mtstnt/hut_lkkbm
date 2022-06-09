<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
		$this->load->model('Donasi_model');
	}

	public function index()
	{
		$data = array();
		$data['page'] = 'dashboard';
		$data['informasi'] = $this->Informasi_model->get();

		$data['total'] = $this->Donasi_model->get_total_donasi();
		$data['total_today'] = $this->Donasi_model->get_total_today();

		load_admin($this->load, 'admin/dashboard', $data);
	}
}
