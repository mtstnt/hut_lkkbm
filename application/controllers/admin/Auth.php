<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		if ($this->session->userdata('user')) {
			return redirect('admin/dashboard');
		}

		$this->load->view('admin/auth');
	}

	public function check()
	{
		$this->load->library('form_validation');
		$this->load->model('Admin_model');

		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required|max_length[16]');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('err', validation_errors());
			return redirect('admin/auth');
		}

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$auth_result = $this->Admin_model->authenticate($username, $password);
		if (!$auth_result) {
			$this->session->set_flashdata('err', 'Invalid credentials!');
			return redirect('admin/auth');
		}

		$admin = $this->Admin_model->find($auth_result)->result()[0];
		
		$this->session->user = array(
			'id' 		=> $auth_result,
			'username' 	=> $admin->username
		);

		$this->Admin_model->update($auth_result, array(
			'last_login' => date('Y-m-d H:i:s', time())
		));

		return redirect('admin/dashboard');
	}

	public function logout()
	{
		$this->session->sess_destroy();

		return redirect('admin/auth');
	}
}
