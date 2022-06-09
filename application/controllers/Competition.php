<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Competition extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('functions');

		// Cek apakah lomba masih dibuka (cek registrasi)
		$this->load->model('Informasi_model');
	}

	public function index()
	{
		if ($this->Informasi_model->is_closed()) {

			$start_date = $this->Informasi_model->get()->start_pendaftaran;
			$end_date = $this->Informasi_model->get()->end_pendaftaran;
			$data = compact($start_date, $end_date);
			$data['use_navbar_bg'] = true;
			$data['page'] = 'lomba';
			
			load_main($this->load, 'main/lomba-closed', $data); 

			return;
		}

		$this->load->model('Informasi_model');
		$this->load->model('TipeLomba_model');
		$this->load->model('Jurusan_model');

		$informasi_model = $this->Informasi_model->get();

		$data = array();
		$data['use_navbar_bg'] = true;
		$data['lomba'] = $this->TipeLomba_model->find_all()->result();
		$data['jurusan'] = $this->Jurusan_model->get_jurusan()->result();

		$data['page'] = 'lomba';
		$data['end_date'] = $informasi_model->end_pendaftaran;

		if ($this->session->flashdata('submit_success')) {
			$flash = $this->session->flashdata('submit_success');

			$data['success'] = true;

			load_main($this->load, 'main/form-lomba', $data);
			return;
		}

		load_main($this->load, 'main/form-lomba', $data);
	}

	public function submit()
	{
		$this->load->library('form_validation');
		$this->load->library('upload');

		$this->load->model('Lomba_model');

		if ($this->input->method() != "post") {
			return show_404();
		}

		$this->form_validation->set_rules([
			['field' => 'nama_lengkap',		'label' => 'Nama', 				'rules' => 'required|max_length[255]'],
			['field' => 'nrp', 				'label' => 'NRP', 				'rules' => 'required|regex_match[/^[a-zA-Z]\d{8}$/]'],
			['field' => 'cp', 				'label' => 'Contact Person', 	'rules' => 'required|max_length[255]'],
			['field' => 'email', 			'label' => 'Email', 			'rules' => 'required|max_length[255]'],
			['field' => 'lomba', 			'label' => 'Lomba', 			'rules' => 'required'],
		]);

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('err', validation_errors());
			return redirect('competition');
		}

		$data = $this->input->post();
		$file = $_FILES['bukti_transfer'];

		if (!$file) {
			$this->session->set_flashdata('err', "Bukti pembayaran belum dilampirkan");
			return redirect('competition');
		}

		$data_anggota = null;
		if (isset($data['anggota']) and isset($data['anggota_nrp'])) {
			
			if (count($data['anggota']) != count($data['anggota_nrp'])) {
				$this->session->set_flashdata('err', 'Ada kesalahan pengisian data anggota!');
				return redirect('competition');
			}

			$data_anggota = [];
			for ($i = 0; $i < count($data['anggota']); $i++) {
				array_push($data_anggota, [
					'nama' 	=> htmlspecialchars($data['anggota'][$i]),
					'nrp'	=> htmlspecialchars($data['anggota_nrp'][$i]),
				]);
			}

			$data_anggota = json_encode($data_anggota);
		}

		$identifier = "LOMBA_" . $data['nrp'];

		$config = array();
		$config['upload_path']          = './assets/uploads/pengumpulan-karya/';
		$config['allowed_types']        = 'jpg|jpeg|png|pdf';
		$config['max_size']             = 5120;
		$config['file_name']			= uniqid($identifier . '_');

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('bukti_transfer')) {
			$this->session->set_flashdata('err', $this->upload->display_errors());
			return redirect('competition');
		}

		$filename = $this->upload->data('file_name');

		$insert_data = array(
			'nrp'				=> htmlspecialchars($data['nrp']),
			'nama'				=> htmlspecialchars($data['nama_lengkap']),
			'email'				=> htmlspecialchars($data['email']),
			'contact_person' 	=> htmlspecialchars($data['cp']),
			'tipe_lomba_id' 	=> htmlspecialchars($data['lomba']),
			'bukti_trf' 		=> $filename,
			'anggota'			=> $data_anggota,
			'status' 			=> 1,
		);

		if (!$this->Lomba_model->save($insert_data)) {
			$this->session->set_flashdata('err', 'Gagal mengirimkan form!');
			return redirect('competition');
		}

		$this->session->set_flashdata("ok", 'Pendaftaran berhasil terkirim! Tim kami akan menghubungi Anda melalui nomor CP yang diberikan. Terima kasih!');
		$this->session->set_flashdata('submit_success', [
			'nama' => $insert_data['nama'],
		]);
		return redirect('competition');
	}
}
