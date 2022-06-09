<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('functions');
	}

	public function index()
	{
		$this->load->model('Informasi_model');
		$this->load->model('Donasi_model');
		$this->load->model('TipeLomba_model');
		$this->load->model('Vendor_model');

		$informasi_model = $this->Informasi_model->get();

		$data = array();
		$data['current'] 		= $this->Donasi_model->get_total_donasi();
		$data['tipe_lomba'] 	= $this->TipeLomba_model->find_all()->result();
		$data['target'] 		= $informasi_model->target_donasi;
		$data['rank_donasi'] 	= $this->Donasi_model->get_hima_leaderboard()->result();
		$data['total_umum'] 	= $this->Donasi_model->get_total_umum();
		$data['start_date'] 	= $informasi_model->tanggal_acara;
		$data['percentage'] 	= ($data['current'] / $data['target']) * 100;
		$data['vendor'] 		= $this->Vendor_model->find_all()->result();
		$data['page'] 			= 'home';

		load_main($this->load, 'main/home', $data);
	}
	
	public function search($id)
	{
		$this->load->model('Vendor_model');
		$vendor = $this->Vendor_model->find($id)->result();

		if (count($vendor) == 0) {
			return show_404();
		}

		$data = array();
		$data['vendor'] = $this->Vendor_model->find_all()->result();
		$data['vendorKetemu'] = $vendor[0];
		$data['page'] = 'vendor';
		// load_main($this->load, 'main/home', $data);
		return redirect('home/preview', $data);
	}
}