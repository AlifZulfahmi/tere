<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		supreme();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function pengguna()
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Pengguna',
			'crumb' => 'Admin',
			'dataTab' => $this->db->get_where('pengguna', ['email !=' => $this->session->userdata('email')])->result()
		];

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[pengguna.email]', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!',
			'valid_email' => 'Gunakan <strong>{field}</strong> yang valid!',
			'is_unique' => '<strong>{field}</strong> "' . $this->input->post('email', true) . '" sudah terdaftar!'
		]);
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('role', 'Akses Pengguna', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('status', 'Status Akun', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/pengguna/index', $data);
			$this->load->view('templates/dash/footer');
		} else {

			$dataUser = [
				'nama' => $this->input->post('nama', true),
				'email' => $this->input->post('email', true),
				'password' => password_hash($this->input->post('email', true), PASSWORD_DEFAULT),
				'image' => 'default',
				'role' => $this->input->post('role', true),
				'no_hp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_hp', true))),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
				'tgl_dibuat' => time(),
				'status' => $this->input->post('status', true)
			];

			$this->db->insert('pengguna', $dataUser);

			$this->session->set_flashdata('pengguna', '<div class="alert alert-success">Pengguna baru dengan email <strong>' . $this->input->post('email', true) . '</strong> berhasil ditambahkan!!</div>');
			redirect('admin/pengguna');
		}
	}


	public function ubahPengguna($id = '')
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Ubah Pengguna',
			'crumb' => 'Admin',
			'oneData' => $this->db->get_where('pengguna', ['id' => $id])->row(),
		];

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('role', 'Akses Pengguna', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('status', 'Status Akun', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
			'required' => '<strong>{field}</strong> tidak boleh kosong!'
		]);
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/pengguna/ubah', $data);
			$this->load->view('templates/dash/footer');
		} else {

			$dataUser = [
				'nama' => $this->input->post('nama', true),
				'role' => $this->input->post('role', true),
				'no_hp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_hp', true))),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
				'status' => $this->input->post('status', true)
			];

			$this->db->where('id', $data['oneData']->id);
			$this->db->update('pengguna', $dataUser);


			$this->session->set_flashdata('pengguna', '<div class="alert alert-success">Pengguna dengan email <strong>' . $data['oneData']->email . '</strong> berhasil diubah!!</div>');
			redirect('admin/pengguna');
		}
	}

	public function hapusPengguna($id)
	{
		$pel = $this->db->get_where('pengguna', ['id' => $id])->row();

		$this->db->delete('pengguna', ['id' => $id]);

		$this->session->set_flashdata('pengguna', '<div class="alert alert-warning">Data Pengguna <strong>' . $pel->email . '</strong> berhasil dihapus!!</div>');
		redirect('admin/pengguna');
	}



	public function santri()
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Santri',
			'dataTab' => $this->db->select('santri.*, asrama.nama as asrama')->join('asrama', 'santri.id_asrama = asrama.id', 'LEFT')->get('santri')->result(),
			'dataMod' => $this->db->get('asrama')->result()
		];

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('id_asrama', 'Asrama', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/santri/index', $data);
			$this->load->view('templates/dash/footer');
		} else {

			$data = [
				'nama' => $this->input->post('nama', true),
				'tgl_lahir' => strtotime($this->input->post('tgl_lahir', true)),
				'jk' => $this->input->post('jk', true),
				'id_asrama' => $this->input->post('id_asrama', true),
			];

			$this->db->insert('santri', $data);

			$this->session->set_flashdata('santri', '<div class="alert alert-success">Santri baru dengan nama <strong>' . $this->input->post('nama', true) . '</strong> berhasil ditambahkan!!</div>');
			redirect('admin/santri');
		}
	}


	public function ubahSantri($id = '')
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Ubah Santri',
			'oneData' => $this->db->select('santri.*, asrama.nama as asrama')->join('asrama', 'santri.id_asrama = asrama.id', 'LEFT')->get_where('santri', ['santri.id' => $id])->row(),
			'dataMod' => $this->db->get('asrama')->result()
		];


		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('id_asrama', 'Asrama', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/santri/ubah', $data);
			$this->load->view('templates/dash/footer');
		} else {

			$data = [
				'nama' => $this->input->post('nama', true),
				'tgl_lahir' => strtotime($this->input->post('tgl_lahir', true)),
				'jk' => $this->input->post('jk', true),
				'id_asrama' => $this->input->post('id_asrama', true),
			];

			$this->db->where('id', $id);
			$this->db->update('santri', $data);


			$this->session->set_flashdata('santri', '<div class="alert alert-success">Santri dengan nama <strong>' . $data['nama'] . '</strong> berhasil diubah!!</div>');
			redirect('admin/santri');
		}
	}

	public function hapusSantri($id)
	{
		$data = $this->db->get_where('santri', ['id' => $id])->row();

		$this->db->delete('santri', ['id' => $id]);

		$this->session->set_flashdata('santri', '<div class="alert alert-warning">Data Santri <strong>' . $data->nama . '</strong> berhasil dihapus!!</div>');
		redirect('admin/santri');
	}

	public function yayasan()
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Yayasan',
			'dataTab' => $this->db->select('ustadz.*, asrama.nama as asrama, pengguna.email, pengguna.image')->join('asrama', 'ustadz.id_asrama = asrama.id', 'LEFT')->join('pengguna', 'ustadz.id_user = pengguna.id', 'LEFT')->get('ustadz')->result(),
			'dataMod' => $this->db->get_where('pengguna', ['role' => 3, 'image' => 'default'])->result(),
			'dataMod2' => $this->db->get('asrama')->result()
		];

		$this->form_validation->set_rules('id_user', 'Akun Pengguna', 'required|trim');
		$this->form_validation->set_rules('id_asrama', 'Asrama', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('bidang', 'Bidang Pengajaran', 'required|trim');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/yayasan/index', $data);
			$this->load->view('templates/dash/footer');
		} else {
			$image = $_FILES['image']['name'];

			if ($image) {

				$config['file_name'] = md5(sha1(time() . '-' . strtolower(str_replace(' ', '', $this->input->post('nama', true))) . "@gmail.com"));
				$config['encrypt_name'] = TRUE;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '5000';
				$config['upload_path'] = './assets/img/user/';

				if (is_dir($config['upload_path']) != true) {
					mkdir($config['upload_path'], 0777, TRUE);
				}

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$img = $this->upload->data('file_name');
				} else {
					$img = 'default';
				}
			}

			if ($this->input->post('id_user', true) == "buatkan") {
				$data1 = [
					'nama' => $this->input->post('nama', true),
					'email' => strtolower(str_replace(' ', '', $this->input->post('nama', true))) . "@gmail.com",
					'password' => password_hash(strtolower(str_replace(' ', '', $this->input->post('nama', true))) . "@gmail.com", PASSWORD_DEFAULT),
					'image' => $img,
					'role' => 3,
					'jenis_kelamin' => 'L',
					'tgl_dibuat' => time(),
					'status' => 1
				];

				$this->db->insert('pengguna', $data1);
				$cariIdUser = $this->db->get_where('pengguna', ['nama' => $this->input->post('nama', true), 'email' => $data1['email'], 'image' => $data1['image']])->last_row()->id;
			} else {
				$cariIdUser = $this->input->post('id_user', true);
			}


			$data = [
				'id_user' => $cariIdUser,
				'id_asrama' => $this->input->post('id_asrama', true),
				'nama' => $this->input->post('nama', true),
				'bidang' => $this->input->post('bidang', true),
				'jk' => $this->input->post('jk', true),
			];

			$this->db->insert('ustadz', $data);

			$this->session->set_flashdata('yayasan', '<div class="alert alert-success">Yayasan baru dengan Nama <strong>' . $data['nama'] . '</strong> berhasil ditambahkan!!</div>');
			redirect('admin/yayasan');
		}
	}


	public function ubahYayasan($id = '')
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Ubah Yayasan',
			'oneData' => $this->db->select('ustadz.*, asrama.nama as asrama, pengguna.email, pengguna.image')->join('asrama', 'ustadz.id_asrama = asrama.id', 'LEFT')->join('pengguna', 'ustadz.id_user = pengguna.id', 'LEFT')->get_where('ustadz', ['ustadz.id' => $id])->row(),
			'dataMod' => $this->db->get_where('pengguna', ['role' => 3, 'image' => 'default'])->result(),
			'dataMod2' => $this->db->get('asrama')->result()
		];


		$this->form_validation->set_rules('id_user', 'Akun Pengguna', 'required|trim');
		$this->form_validation->set_rules('id_asrama', 'Asrama', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('bidang', 'Bidang Pengajaran', 'required|trim');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/yayasan/ubah', $data);
			$this->load->view('templates/dash/footer');
		} else {

			$upload_image = $_FILES['image']['name'];
			if ($data['oneData']->id_user) {
				$email = $this->db->get_where('pengguna', ['id' => $data['oneData']->id_user])->row()->email;
			} else {
				$email = strtolower(str_replace(' ', '', $this->input->post('nama', true))) . "@gmail.com";
			}
			$blabla = $this->db->get_where('pengguna', ['email' => $email])->row();

			if ($upload_image) {

				if ($_FILES['image']['size'] > 5120000) {
					$isiPesan = '
            <div class="alert alert-danger alert-dismissible fade show border border-dark" role="alert">
                        <strong>Ukuran Gambar</strong> tidak bisa melebihi <strong>5 MB</strong>
            </div>';
					$this->session->set_flashdata('yayasan', $isiPesan);
					redirect('yayasan');
				}

				$config['file_name'] = time() . '_' . md5(sha1(base64_encode($email))) . time();
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '5012';
				$config['upload_path'] = './assets/img/user/';

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					$old_image = $blabla->image;

					unlink(FCPATH . 'assets/img/user/' . $old_image);

					$new_image = $this->upload->data('file_name');
					$this->db->where('id', $blabla->id);
					$this->db->update('pengguna', ['image' => $new_image]);
				} else {
					redirect('admin/yayasan');
				}
			}

			$data = [
				'id_asrama' => $this->input->post('id_asrama', true),
				'nama' => $this->input->post('nama', true),
				'bidang' => $this->input->post('bidang', true),
				'jk' => $this->input->post('jk', true),
			];

			$this->db->where('id', $id);
			$this->db->update('ustadz', $data);


			$this->session->set_flashdata('yayasan', '<div class="alert alert-success">Ustadz dengan Nama <strong>' . $data['nama'] . '</strong> berhasil diubah!!</div>');
			redirect('admin/yayasan');
		}
	}

	public function hapusYayasan($id)
	{
		$data = $this->db->get_where('ustadz', ['id' => $id])->row();

		$this->db->delete('ustadz', ['id' => $id]);

		$this->session->set_flashdata('ustadz', '<div class="alert alert-warning">Data Ustadz dengan Nama <strong>' . $data->nama . '</strong> berhasil dihapus!!</div>');
		redirect('admin/yayasan');
	}

	public function asrama()
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'asrama',
			'dataTab' => $this->db->select('asrama.*, ustadz.nama as musyrif')->join('ustadz', 'asrama.id_musyrif = ustadz.id', 'LEFT')->get('asrama')->result(),
		];

		$data['dataMod'] = $this->db->get('ustadz')->result();

		$this->form_validation->set_rules('nama', 'Nama Asrama', 'required|trim');
		$this->form_validation->set_rules('id_musyrif', 'Penjaga', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/asrama/index', $data);
			$this->load->view('templates/dash/footer');
		} else {


			$data = [
				'nama' => $this->input->post('nama', true),
				'id_musyrif' => $this->input->post('id_musyrif', true),
			];

			$this->db->insert('asrama', $data);

			$this->session->set_flashdata('asrama', '<div class="alert alert-success">Asrama baru dengan Nama <strong>' . $data['nama'] . '</strong> berhasil ditambahkan!!</div>');
			redirect('admin/asrama');
		}
	}


	public function ubahAsrama($id = '')
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Ubah asrama',
			'oneData' => $this->db->select('asrama.*, ustadz.nama as musyrif, ustadz.id as idUs')->join('ustadz', 'asrama.id_musyrif = ustadz.id', 'LEFT')->get_where('asrama', ['asrama.id' => $id])->row(),
		];

		$data['dataMod'] = $this->db->get_where('ustadz', ['id !=' => $data['oneData']->id])->result();

		$this->form_validation->set_rules('nama', 'Nama Asrama', 'required|trim');
		$this->form_validation->set_rules('id_musyrif', 'Penjaga', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/asrama/ubah', $data);
			$this->load->view('templates/dash/footer');
		} else {

			$data = [
				'nama' => $this->input->post('nama', true),
				'id_musyrif' => $this->input->post('id_musyrif', true),
			];

			$this->db->where('id', $id);
			$this->db->update('asrama', $data);


			$this->session->set_flashdata('asrama', '<div class="alert alert-success">Asrama dengan Nama <strong>' . $data['nama'] . '</strong> berhasil diubah!!</div>');
			redirect('admin/asrama');
		}
	}

	public function hapusAsrama($id)
	{
		$data = $this->db->get_where('asrama', ['id' => $id])->row();

		$this->db->delete('asrama', ['id' => $id]);

		$this->session->set_flashdata('asrama', '<div class="alert alert-warning">Data Asrama dengan Nama <strong>' . $data->nama . '</strong> berhasil dihapus!!</div>');
		redirect('admin/asrama');
	}

	public function Pembayaran()
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Pembayaran',
			'dataTab' => $this->db->get('pembayaran')->result(),
			'dataMod' => $this->db->get('pasien')->result(),
		];

		$this->form_validation->set_rules('id_pasien', 'Pasien', 'required|trim');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/pembayaran/index', $data);
			$this->load->view('templates/dash/footer');
		} else {

			$dataPasien = $this->db->get_where('pasien', ['id' => $this->input->post('id_pasien', true)])->row();

			$dataUser = [
				'id_pasien' => $this->input->post('id_pasien', true),
				'invoice' => invoiceKode($dataPasien->nama, $dataPasien->id_rm),
				'nominal' => $this->input->post('nominal', true),
				'status' => 0,
				'tgl_dibuat' => time(),
			];

			$this->db->insert('pembayaran', $dataUser);

			$this->session->set_flashdata('pembayaran', '<div class="alert alert-success">Pembayaran dengan Invoice <strong>' . $dataUser['invoice'] . '</strong> berhasil ditambahkan!!</div>');
			redirect('admin/pembayaran');
		}
	}


	public function ubahPembayaran($id = '')
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Ubah Pembayaran',
			'oneData' => $this->db->get_where('pembayaran', ['id' => $id])->row(),
			'dataMod' => $this->db->get('pasien')->result(),
		];
		$data['pasien'] = $this->db->get_where('pasien', ['id' => $data['oneData']->id_pasien])->row();

		$this->form_validation->set_rules('id_pasien', 'Pasien', 'required|trim');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dash/header', $data);
			$this->load->view('templates/dash/sidenav', $data);
			$this->load->view('admin/pembayaran/ubah', $data);
			$this->load->view('templates/dash/footer');
		} else {

			$dataUser = [
				'id_pasien' => $this->input->post('id_pasien', true),
				'nominal' => $this->input->post('nominal', true),
				'status' => $this->input->post('status', true),
			];

			$this->db->where('id', $data['oneData']->id);
			$this->db->update('pembayaran', $dataUser);


			$this->session->set_flashdata('pembayaran', '<div class="alert alert-success">Pembayaran Invoice <strong>' . $data['oneData']->invoice . '</strong> berhasil diubah!!</div>');
			redirect('admin/pembayaran');
		}
	}

	public function selesaiPembayaran($id)
	{
		$pel = $this->db->get_where('pembayaran', ['id' => $id])->row();

		$data = [
			'status' => 2,
		];

		$this->db->where('id', $pel->id);
		$this->db->update('pembayaran', $data);

		$this->session->set_flashdata('pembayaran', '<div class="alert alert-success">Data Pembayaran Invoice <strong>' . $pel->invoice . '</strong> ditandai <strong>Selesai</strong> </div>');
		redirect('admin/pembayaran');
	}

	public function hapusPembayaran($id)
	{
		$pel = $this->db->get_where('pembayaran', ['id' => $id])->row();

		$this->db->delete('pembayaran', ['id' => $id]);

		$this->session->set_flashdata('pembayaran', '<div class="alert alert-warning">Data Pembayaran Invoice <strong>' . $pel->invoice . '</strong> berhasil dihapus!!</div>');
		redirect('admin/pembayaran');
	}
}
