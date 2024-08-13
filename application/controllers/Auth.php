<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Halaman Login',
		];

		if ($data['user']) {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
			'required' => 'Email tidak boleh kosong!!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'required' => 'Password tidak boleh kosong!!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth/header', $data);
			$this->load->view('auth/index', $data);
			$this->load->view('templates/auth/footer');
		} else {
			$this->_login();
			redirect('dashboard');
		}
	}



	private function _login()
	{

		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$user = $this->db->get_where('pengguna', ['email' => $email])->row_array();

		// jika usernya ada
		if ($user) {
			// jika usernya aktif
			if ($user['status'] == 1) {
				// cek password
				if (password_verify($password, $user['password'])) {

					$data = [
						'nama' => $user['nama'],
						'email' => $user['email'],
						'role' => $user['role']
					];
					$this->session->set_userdata($data);

					$last_login = [
						'terakhir_login' => time(),
					];

					$this->db->set($last_login);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('pengguna');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diaktivasi!!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!!</div>');
			redirect('auth');
		}
	}



	public function logout()
	{
		$user = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
		$last_login = [
			'terakhir_login' => time(),
		];

		$this->db->set($last_login);
		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('pengguna');

		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah logout!</div>');
		redirect('auth');
	}
}
