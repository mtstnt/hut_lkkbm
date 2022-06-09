<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('functions');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->model('Donasi_model');

		$data = array();
		$data['use_navbar_bg'] = true;
		$data['page'] = 'wishlist';
		
		load_main($this->load, 'main/wishlist', $data);
	}

	public function form()
	{
		$this->load->model('Jurusan_model');
		$this->load->model('TipeUser_model');
		$this->load->model('Lk_model');

		$data = array();

		$data['use_navbar_bg'] = true;
		$data['page'] = 'wishlist';
		$data['jurusan'] = $this->Jurusan_model->get_jurusan()->result();
		$data['tipe_user'] = $this->TipeUser_model->find_all()->result();
		$data['lk'] = $this->Lk_model->find_all()->result();

		load_main($this->load, 'main/form-wishlist', $data);
	}

	public function get_data()
	{
		$stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
		$request = json_decode($stream_clean, true);
		
		$offset = $request['offset'];
		$count = 9;

		$this->load->model('Wishlist_model');

		$wishlists = $this->Wishlist_model->get($offset, $count, null)->result();

		$res = [];
		$res['data'] = $wishlists;

		echo json_encode($res);
	}

	public function search()
	{
		$stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
		$request = json_decode($stream_clean, true);

		$this->load->model('Wishlist_model');

		$search = $request['search'];

		$wishlists = $this->Wishlist_model->get(0, 0, $search)->result();

		$res = [];
		$res['data'] = $wishlists;

		echo json_encode($res);
	}

	public function submit()
	{
		$this->load->model('Wishlist_model');

		$required_error = 'Harap mengisikan %s di form';

		$this->form_validation->set_rules([
			[
				'field' => 'nama_lengkap',
				'label' => 'nama lengkap',
				'rules' => 'required|max_length[255]',
				'errors' => [
					'required' => $required_error,
				]
			],
			[
				'field' => 'nrp',
				'label' => 'NRP',
				'rules' => 'regex_match[/^[a-zA-Z]\d{8}$/]',
				'errors' => [
					'regex_match' => "NRP tidak valid"
				]
			],
			[
				'field' => 'tipe',
				'label' => 'Asal',
				'rules' => 'required',
				'errors' => [
					'required' => $required_error,
				]
			],
			[
				'field' => 'note',
				'label' => 'note',
				'rules' => 'required|max_length[255]',
				'errors' => [
					'required' => $required_error,
					'max_length' => 'Note yang dikirimkan melebihi batas (255 karakter)'
				]
			],
		]);

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('err', validation_errors());
			return redirect('wishlist/form');
		}

		$nama_lengkap 	= htmlspecialchars($this->input->post('nama_lengkap'));
		$nrp 			= htmlspecialchars($this->input->post('nrp'));
		$program_studi 	= $this->input->post('program_studi');
		$note 			= htmlspecialchars($this->input->post('note'));
		$tipe 			= $this->input->post('tipe');

		$insert_data = [];

		if ($tipe == 1) // Mahasiswa
		{
			$insert_data = [
				'nama' => $nama_lengkap,
				'nrp' => $nrp,
				'jurusan_id' => $program_studi,
			];
		}
		else if ($tipe == 2 or $tipe == 3) // Dosen
		{
			$insert_data = [
				'nama' => $nama_lengkap,
				'jurusan_id' => $program_studi,
			];
		}
		else if ($tipe == 4) // Umum
		{
			$insert_data = [
				'nama' => $nama_lengkap,
			];
		}
		else {
			$this->session->set_flashdata('err', 'Ada kesalahan!');
			return redirect('wishlist/form');
		}

		$insert_data['tipe_user_id'] = $tipe;
		$insert_data['content'] = $note;
		$insert_data['status'] = 1;

		if (! $this->Wishlist_model->save($insert_data)) {
			$this->session->set_flashdata('err', 'Gagal menyimpan!');
			return redirect('wishlist/form');
		}

		$this->session->set_flashdata('ok', 'Wishlist berhasil dikirim!');
		return redirect('wishlist/form');
	}
}