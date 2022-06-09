<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donation extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('functions');
		$this->load->helper('file');
	}

	public function index()
	{
		$this->load->model('TipeUser_model');
		$this->load->model('Jurusan_model');
		$this->load->model('Lk_model');
		$this->load->model('MetodePembayaran_model');

		$tipe_user 		= $this->TipeUser_model->find_all()->result();
		$jurusan 		= $this->Jurusan_model->get_jurusan()->result();
		$lk 			= $this->Lk_model->find_all()->result();
		$metode 		= $this->MetodePembayaran_model->find_all()->result();

		$data = array();
		$data['use_navbar_bg'] 		= true;
		$data['tipe_user'] 			= $tipe_user;
		$data['jurusan'] 			= $jurusan;
		$data['lk'] 				= $lk;
		$data['metode'] 			= $metode;	
		$data['page']				= 'donasi';

		if ($this->session->flashdata('submit_success')) {
			$flash = $this->session->flashdata('submit_success');

			$data['nama'] = $flash['nama'];
			$data['page'] = 'donasi';
			$data['success'] = true;
			$data['success_img'] = 'THX-CARD-' . strval(rand(1, 3));

			load_main($this->load, 'main/form-donation', $data);
			return;
		}

		load_main($this->load, 'main/form-donation', $data);
	}

	public function submit()
	{
		$this->load->library('form_validation');
		$this->load->library('file_validation');
		$this->load->library('upload');

		$this->load->model('Donasi_model');

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
				'field' => 'tipe',
				'label' => 'tipe',
				'rules' => 'required',
				'errors' => [
					'required' => $required_error,
				]
			],
			[
				'field' => 'nominal',
				'label' => 'nominal donasi',
				'rules' => 'required|numeric',
				'errors' => [
					'required' => $required_error,
				]
			],
		]);

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('err', validation_errors());
			return redirect('donation');
		}

		$allowed_mimes = [
			'application/pdf',
			'image/png',
			'image/jpg',
			'image/jpeg',
		];

		$max_size = 3000000; // 3M
		$validation_result = $this->file_validation->validate_file('bukti_transfer', $allowed_mimes, $max_size);

		$error_msg = [];

		switch ($validation_result) {
			case FILE_VALIDATION_MAX_SIZE_EXCEEDED:
				array_push($error_msg, "Ukuran file melebihi maksimum (3MB)!");
				break;

			case FILE_VALIDATION_MIME_NOT_ALLOWED:
				array_push($error_msg, "Tipe file yang diterima adalah pdf, jpg, jpeg, dan png!");
				break;

			default: break;
		}

		if ($validation_result != FILE_VALIDATION_SUCCESS) {
			$this->session->set_flashdata('err', implode('<br>', $error_msg));
			return redirect('donation');
		}

		$insert_data = [];

		$insert_data['nama'] 				= htmlspecialchars($this->input->post('nama_lengkap'));
		$insert_data['tipe_user_id']		= $this->input->post('tipe');
		$insert_data['jumlah']				= $this->input->post('nominal');
		$insert_data['metode_pembayaran_id']= $this->input->post('metode_pembayaran');

		$tipe = $insert_data['tipe_user_id'];

		if ($tipe == 1) {
			$nrp = $this->input->post('nrp');
			
			if (!$this->validate_input('nrp') or !$this->validate_input('program_studi')) {
				$this->session->set_flashdata('err', 'Harap mengisi semua pertanyaan yang diperlukan.');
				return redirect('donation');
			}

			if (strlen($nrp) != 9 or !preg_match('/^[a-zA-Z]\d{8}$/', $nrp)) {
				$this->session->set_flashdata('err', 'NRP tidak valid!');
				return redirect('donation');
			}

			$insert_data['nrp'] 			= $this->input->post('nrp');
			$insert_data['jurusan_id'] 		= $this->input->post('program_studi');
			$insert_data['lk_id'] 			= (strlen($this->input->post('lk')) == 0) ? null : $this->input->post('lk');

			$identifier = $insert_data['nrp'];
		} 
		else if ($tipe == 2 or $tipe == 3) {
			
			if (!$this->validate_input('program_studi')) {
				$this->session->set_flashdata('err', 'Harap mengisi semua pertanyaan yang diperlukan.');
				return redirect('donation');
			}

			$insert_data['nrp'] 			= null;
			$insert_data['jurusan_id'] 		= $this->input->post('jurusan');
			$insert_data['lk_id'] 			= null;

			$identifier = $insert_data['nama'];
		}
		else {
			$insert_data['nrp'] 			= null;
			$insert_data['jurusan_id'] 		= null;
			$insert_data['lk_id'] 			= null;
			
			$identifier = $insert_data['nama'];
		}

		$config = array();
		$config['upload_path']          = './assets/uploads/bukti-transfer/';
		$config['allowed_types']        = 'jpg|jpeg|png|pdf';
		$config['max_size']             = 5120;
		$config['file_name']			= uniqid('DONASI_' . str_replace(' ', '_', $identifier) . '_');

		$this->upload->initialize($config);

		if (! $this->upload->do_upload('bukti_transfer')) {
			$this->session->set_flashdata('err', $this->upload->display_errors());
			return redirect('donation');
		}

		$insert_data['file'] = $this->upload->data('file_name');

		if (! $this->Donasi_model->save($insert_data)) {
			$this->session->set_flashdata('err', 'Gagal mengirim form!');
			return redirect('donation');
		}

		$this->session->set_flashdata('ok', 'Form donasi terkirim!');
		$this->session->set_flashdata('submit_success', [
			'nama' => $insert_data['nama'],
		]);
		return redirect('donation');
	}

	private function validate_input($field)
	{
		return $this->input->post($field) != '' and $this->input->post($field) != null;
	}
}
