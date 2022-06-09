<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipelomba extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}

		$this->load->helper('functions');
		$this->load->model('TipeLomba_model');
	}

	public function index()
	{
		$data = array();
		$data['tipe_lomba'] = $this->TipeLomba_model->find_all()->result();
		$data['counter'] = 1;
		$data['page'] = 'tipe_lomba';
		load_admin($this->load, 'admin/tipe_lomba/index', $data);
	}

	public function create()
	{
		$data = array();
		$data['page'] = 'tipelomba';

		load_admin($this->load, 'admin/tipe_lomba/form', $data);
	}

	public function store()
	{
		$nama_lomba = $this->input->POST('nama');

		if ($this->TipeLomba_model->save(array(
			'nama' => $nama_lomba
		))) {
			$this->session->set_flashdata('ok', 'Berhasil tersimpan!');
		} else {
			$this->session->set_flashdata('err', 'Gagal menyimpan!');
		}
		return redirect('admin/tipelomba');
	}

	public function edit($id)
	{
		$tipe_lomba = $this->TipeLomba_model->find($id)->result();

		if (count($tipe_lomba) == 0) {
			return show_404();
		}

		$data = array();
		$data['edit'] = true;
		$data['tipe_lomba'] = $tipe_lomba[0];
		$data['page'] = 'tipelomba';
		
		load_admin($this->load, 'admin/tipe_lomba/form', $data);
	}

	public function update($id)
	{
		$this->load->library('upload');
		
		$tipe_lomba = $this->TipeLomba_model->find($id)->result();

		if (count($tipe_lomba) == 0) {
			return show_404();
		}

		$nama = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');

		$insert_data = array(
			'nama' 			=> $nama,
			'deskripsi' 	=> $deskripsi,
			'updated_by' 	=> $this->session->user['username'],
			'updated_at' 	=> date('Y-m-d H:i:s', time()),
		);

		if ($_FILES['file']['size'] > 0) {
			$config = array();
			$config['upload_path']          = './assets/uploads/logo/';
			$config['allowed_types']        = 'jpg|jpeg|png|webp';
			$config['max_size']             = 10240;
			$config['file_name']			= uniqid($nama . '_');
	
			$this->upload->initialize($config);
	
			if (!$this->upload->do_upload('file')) {
				$this->session->set_flashdata('err', $this->upload->display_errors());
				return redirect('admin/tipelomba');
			}
	
			$data = $this->upload->data();

			$insert_data['file'] = $data['file_name'];
		}

		if ($this->TipeLomba_model->update($id, $insert_data)) {
			$this->session->set_flashdata('ok', 'Berhasil mengupdate!');
		} else {
			$this->session->set_flashdata('err', 'Gagal mengupdate!');
		}

		return redirect('admin/tipelomba');
	}

	public function delete($id)
	{
		$tipe_lomba = $this->TipeLomba_model->find($id)->result();

		if (count($tipe_lomba) == 0) {
			return show_404();
		}

		if ($this->TipeLomba_model->delete($id)) {
			$this->session->set_flashdata('ok', 'Berhasil delete!');
		} else {
			$this->session->set_flashdata('err', 'Gagal delete!');
		}
		return redirect('admin/tipelomba');
	}
}
?>
