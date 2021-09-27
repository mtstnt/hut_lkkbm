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
	}

	public function index()
	{
		$this->load->helper('admin');

		load_admin($this->load, 'admin/dashboard');
	}
}
