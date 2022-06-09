<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->session->userdata('user')) {
			$this->session->set_flashdata('err', 'Please log in first');
			return redirect('admin/auth');
		}

		$this->load->helper('functions');
		$this->load->model('Vendor_model');
	}

	public function index()
	{
		$data = array();
		$data['vendor'] = $this->Vendor_model->get_all_vendor()->result();
		$data['counter'] = 1;
		$data['page'] = 'vendor';

		load_admin($this->load, 'admin/vendor/index', $data);
	}

	public function create()
	{
		$data = array();
		$data['page'] = 'vendor';

		load_admin($this->load, 'admin/vendor/form', $data);
	}

	public function store()
	{

		$namaVendor = $this->input->post('namaVendor');
		$desVendor = $this->input->post('desVendor');
		$filename = "";

		$this->load->library('upload');


		if($_FILES['file']['size'] == 0){
			$filename = NULL;
		}
		else{
			$config = array();
			$config['upload_path']			='./assets/uploads/logo/';
			$config['allowed_types']		='jpg|jpeg|png|webp';
			$config['max_size']				=10240;
			$config['file_name']			=uniqid($namaVendor . '_');

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('file')){
				$this->session->set_flashdata('err', $this->upload->display_errors());
				return redirect('admin/vendor');
			}

			$data = $this->upload->data();
			$filename = $data['file_name'];
		}

		if ($this->Vendor_model->save(array(
			'nama' => $namaVendor,
			'logo' => $filename,
			'deskripsi' => $desVendor,
			'created_by' => $this->session->user['username'],
		))) {
			$this->session->set_flashdata('ok', 'Berhasil tersimpan!');
		} else {
			$this->session->set_flashdata('err', 'Gagal menyimpan!');
		}
		return redirect('admin/vendor');
	}

	public function edit($id)
	{
		$vendor = $this->Vendor_model->find($id)->result();

		$data = array();
		$data['edit'] = true;
		$data['vendor'] = $vendor[0];
		$data['page'] = 'vendor';
		
		load_admin($this->load, 'admin/vendor/form', $data);
	}

	public function update($id)
	{
		$vendor = $this->Vendor_model->find($id)->result();

		$namaVendor = $this->input->post('namaVendor');
		$desVendor = $this->input->post('desVendor');
		$filename = null;

		$this->load->library('upload');

		if ($_FILES['file']['size'] > 0) {
			$config = array();
			$config['upload_path']          = './assets/uploads/logo/';
			$config['allowed_types']        = 'jpg|jpeg|png|webp';
			$config['max_size']             = 10240;
			$config['file_name']			= uniqid($namaVendor . '_');

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')) {
				$this->session->set_flashdata('err', $this->upload->display_errors());
				return redirect('admin/vendor');
			}

			$data = $this->upload->data();
			$filename = $data['file_name'];
		}
		else{
			$filename = NULL;
		}

		$data = [
			'nama' => $namaVendor,
			'deskripsi' => $desVendor,
			'updated_by' => $this->session->user['username'],
			'updated_at' => date('Y-m-d H:i:s', time()),
		];

		if ($filename != null) {
			$data['logo'] = $filename;
		}

		if ($this->Vendor_model->update($id, $data)) {
			$this->session->set_flashdata('ok', 'Berhasil mengupdate!');
		} else {
			$this->session->set_flashdata('err', 'Gagal mengupdate!');
		}
		return redirect('admin/vendor');
	}

	public function delete($id)
	{
		$vendor = $this->Vendor_model->find($id)->result();

		if (count($vendor) == 0) {
			return show_404();
		}

		if ($this->Vendor_model->update($id, array(
            'status' => 0,
            'deleted_by' => $this->session->user['username'],
            'deleted_at' => date('Y-m-d H:i:s', time()),
        ))) {
			$this->session->set_flashdata('ok', 'Berhasil delete!');
		} else {
            $this->session->set_flashdata('err', 'Gagal delete!');
        }
		return redirect('admin/vendor');
	}
}
