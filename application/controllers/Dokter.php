<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        super();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function pasien()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Pasien',
            'dataTab' => $this->db->get('pasien')->result()
        ];

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tpt_lhr', 'Tempat Lahir', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tgl_lhr', 'Tanggal Lahir', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('suku', 'Suku', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('alamat1', 'Alamat Rumah', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('alamat2', 'Alamat Kantor', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('admin/pasien/index', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataUser = [
                'id_rm' => kodeRM($this->input->post('nama', true), $this->input->post('nik', true)),
                'nama' => $this->input->post('nama', true),
                'tpt_lhr' => $this->input->post('tpt_lhr', true),
                'tgl_lhr' => strtotime($this->input->post('tgl_lhr', true)),
                'nik' => $this->input->post('nik', true),
                'suku' => $this->input->post('suku', true),
                'pekerjaan' => $this->input->post('pekerjaan', true),
                'no_telp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_telp', true))),
                'no_hp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_hp', true))),
                'jk' => $this->input->post('jk', true),
                'alamat1' => $this->input->post('alamat1', true),
                'alamat2' => $this->input->post('alamat2', true),
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('pasien', $dataUser);

            $cariPasien = $this->db->get_where('pasien', ['id_rm' => $dataUser['id_rm']])->last_row();

            $dataMedik = [
                'no_rm' => $dataUser['id_rm'],
                'id_pasien' => $cariPasien->id,
            ];
            $this->db->insert('medik', $dataMedik);


            $this->session->set_flashdata('pasien', '<div class="alert alert-success">Pasien baru dengan ID RM <strong>' . $dataUser['id_rm'] . '</strong> berhasil ditambahkan!!</div>');
            redirect('admin/pasien');
        }
    }


    public function ubahPasien($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Pasien',
            'oneData' => $this->db->get_where('pasien', ['id' => $id])->row(),
        ];

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tpt_lhr', 'Tempat Lahir', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tgl_lhr', 'Tanggal Lahir', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('suku', 'Suku', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('alamat1', 'Alamat Rumah', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('alamat2', 'Alamat Kantor', 'required|trim', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('admin/pasien/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataUser = [
                'nama' => $this->input->post('nama', true),
                'tpt_lhr' => $this->input->post('tpt_lhr', true),
                'tgl_lhr' => strtotime($this->input->post('tgl_lhr', true)),
                'nik' => $this->input->post('nik', true),
                'suku' => $this->input->post('suku', true),
                'pekerjaan' => $this->input->post('pekerjaan', true),
                'no_telp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_telp', true))),
                'no_hp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_hp', true))),
                'jk' => $this->input->post('jk', true),
                'alamat1' => $this->input->post('alamat1', true),
                'alamat2' => $this->input->post('alamat2', true),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('pasien', $dataUser);


            $this->session->set_flashdata('pasien', '<div class="alert alert-success">Pasien dengan RM <strong>' . $data['oneData']->id_rm . '</strong> berhasil diubah!!</div>');
            redirect('admin/pasien');
        }
    }

    public function hapusPasien($id)
    {
        $pel = $this->db->get_where('pasien', ['id' => $id])->row();

        $this->db->delete('pasien', ['id' => $id]);

        $this->session->set_flashdata('pasien', '<div class="alert alert-warning">Data Pasien RM <strong>' . $pel->id_rm . '</strong> berhasil dihapus!!</div>');
        redirect('admin/pasien');
    }

    public function registrasi()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Registrasi',
            'dataMod' => $this->db->get('pasien')->result(),
            'dataMod2' => $this->db->get('dokter')->result(),
            'dataTab' => $this->db->get('registrasi')->result()
        ];

        $this->form_validation->set_rules('regis', 'Nomor Registrasi', 'required|trim');
        $this->form_validation->set_rules('id_pasien', 'Pasien', 'required|trim');
        $this->form_validation->set_rules('id_dokter', 'Dokter', 'required|trim');
        $this->form_validation->set_rules('penjamin', 'Penjamin', 'trim');
        $this->form_validation->set_rules('asuransi', 'Asuransi', 'trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('dokter/registrasi/index', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataUser = [
                'regis' => $this->input->post('regis', true),
                'id_pasien' => $this->input->post('id_pasien', true),
                'id_dokter' => $this->input->post('id_dokter', true),
                'penjamin' => $this->input->post('penjamin', true),
                'asuransi' => $this->input->post('asuransi', true),
                'status' => 1,
                'tgl_masuk' => time(),
                'tgl_dibuat' => time()
            ];

            $this->db->insert('registrasi', $dataUser);

            $this->session->set_flashdata('registrasi', '<div class="alert alert-success">Registrasi Pasien dengan Nomor Registrasi <strong>' . $dataUser['regis'] . '</strong> berhasil ditambahkan!!</div>');
            redirect('dokter/registrasi');
        }
    }


    public function ubahRegistrasi($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Registrasi',
            'dataMod' => $this->db->get('pasien')->result(),
            'dataMod2' => $this->db->get('dokter')->result(),
            'oneData' => $this->db->get_where('registrasi', ['id' => $id])->row(),
        ];

        $data['dokter'] = $this->db->get_where('dokter', ['id' => $data['oneData']->id_dokter])->row();
        $data['pasien'] = $this->db->get_where('pasien', ['id' => $data['oneData']->id_pasien])->row();

        $this->form_validation->set_rules('id_pasien', 'Pasien', 'required|trim');
        $this->form_validation->set_rules('id_dokter', 'Dokter', 'required|trim');
        $this->form_validation->set_rules('penjamin', 'Penjamin', 'trim');
        $this->form_validation->set_rules('asuransi', 'Asuransi', 'trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('dokter/registrasi/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataUser = [
                'id_pasien' => $this->input->post('id_pasien', true),
                'id_dokter' => $this->input->post('id_dokter', true),
                'penjamin' => $this->input->post('penjamin', true),
                'asuransi' => $this->input->post('asuransi', true),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('registrasi', $dataUser);


            $this->session->set_flashdata('registrasi', '<div class="alert alert-success">Registrasi Pasien dengan Nomor Registrasi <strong>' . $data['oneData']->regis . '</strong> berhasil diubah!!</div>');
            redirect('dokter/registrasi');
        }
    }

    public function pulangRegistrasi($id)
    {
        $pel = $this->db->get_where('registrasi', ['id' => $id])->row();

        $dataUser = [
            'status' => 1,
            'tgl_keluar' => time()
        ];

        $this->db->where('id', $pel->id);
        $this->db->update('registrasi', $dataUser);

        $this->session->set_flashdata('registrasi', '<div class="alert alert-success">Data Registrasi Pasien dengan Nomor Registrasi <strong>' . $pel->regis . '</strong> berhasil pulang!!</div>');
        redirect('dokter/registrasi');
    }

    public function hapusRegistrasi($id)
    {
        $pel = $this->db->get_where('registrasi', ['id' => $id])->row();

        $this->db->delete('registrasi', ['id' => $id]);

        $this->session->set_flashdata('registrasi', '<div class="alert alert-warning">Data Registrasi Pasien dengan Nomor Registrasi <strong>' . $pel->regis . '</strong> berhasil dihapus!!</div>');
        redirect('dokter/registrasi');
    }

    public function medik()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Medik',
            'dataTab' => $this->db->get('medik')->result()
        ];

        $this->load->view('templates/dash/header', $data);
        $this->load->view('templates/dash/sidenav', $data);
        $this->load->view('dokter/medik/index', $data);
        $this->load->view('templates/dash/footer');
    }


    public function ubahMedik($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Medik',
            'oneData' => $this->db->get_where('medik', ['id' => $id])->row(),
        ];

        $this->form_validation->set_rules('gol_darah', 'Golongan Darah', 'trim');
        $this->form_validation->set_rules('tek_darah', 'Tekanan Darah', 'trim');
        $this->form_validation->set_rules('ind1', 'Karang Gigi', 'trim');
        $this->form_validation->set_rules('ind2', 'Sakit Gigi', 'trim');
        $this->form_validation->set_rules('ind3', 'Radang Gusi', 'trim');
        $this->form_validation->set_rules('ind4', 'Pendarahan', 'trim');
        $this->form_validation->set_rules('ind5', 'Pembengkakan', 'trim');
        $this->form_validation->set_rules('lainnya', 'Penyakit Lainnya', 'trim');
        $this->form_validation->set_rules('alergi_obat', 'Alergi Obat', 'trim');
        $this->form_validation->set_rules('alergi_makanan', 'Alergi Makanan', 'trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('dokter/medik/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $dataUser = [
                'gol_darah' => $this->input->post('gol_darah', true),
                'tek_darah' => $this->input->post('tek_darah', true),
                'karanggigi' => $this->input->post('ind1', true),
                'sakitgigi' => $this->input->post('ind2', true),
                'radanggusi' => $this->input->post('ind3', true),
                'pendarahan' => $this->input->post('ind4', true),
                'bengkak' => $this->input->post('ind5', true),
                'lainnya' => $this->input->post('lainnya', true),
                'alergi_obat' => $this->input->post('alergi_obat', true),
                'alergi_makanan' => $this->input->post('alergi_makanan', true),
                'tgl_dibuat' => time(),
            ];

            // Penerapan Algoritma C4.5
            $resiko = $this->db->get_where('resiko', [
                'ind1' => $this->input->post('ind1', true),
                'ind2' => $this->input->post('ind2', true),
                'ind3' => $this->input->post('ind3', true),
                'ind4' => $this->input->post('ind4', true),
                'ind5' => $this->input->post('ind5', true),
            ])->row();

            if ($resiko == true) {
                $dataUser['resiko'] = $resiko->resiko;
            } else {
                $dataUser['resiko'] = 'Tidak ada';
            }

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('medik', $dataUser);


            $this->session->set_flashdata('medik', '<div class="alert alert-success">Rekam Medik Pasien dengan Nomor Medik <strong>' . $data['oneData']->no_rm . '</strong> berhasil diubah!!</div>');
            redirect('dokter/medik');
        }
    }

    public function hapusMedik($id)
    {
        $pel = $this->db->get_where('medik', ['id' => $id])->row();

        $this->db->delete('medik', ['id' => $id]);

        $this->session->set_flashdata('medik', '<div class="alert alert-warning">Data Rekam Medik Pasien dengan Nomor Medik <strong>' . $pel->no_rm . '</strong> berhasil dihapus!!</div>');
        redirect('dokter/medik');
    }

    public function resiko()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Resiko',
            'dataTab' => $this->db->get('resiko')->result()
        ];

        $this->form_validation->set_rules('ind1', 'Karang Gigi', 'required|trim');
        $this->form_validation->set_rules('ind2', 'Pendarahan', 'required|trim');
        $this->form_validation->set_rules('ind3', 'Sakit Gigi', 'required|trim');
        $this->form_validation->set_rules('ind4', 'Bengkak', 'required|trim');
        $this->form_validation->set_rules('ind5', 'Radang Gusi', 'required|trim');
        $this->form_validation->set_rules('resiko', 'Resiko Penyakit', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('dokter/resiko/index', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $dataUser = [
                'ind1' => $this->input->post('ind1', true),
                'ind2' => $this->input->post('ind2', true),
                'ind3' => $this->input->post('ind3', true),
                'ind4' => $this->input->post('ind4', true),
                'ind5' => $this->input->post('ind5', true),
                'resiko' => $this->input->post('resiko', true),
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('resiko', $dataUser);
            $this->session->set_flashdata('resiko', '<div class="alert alert-success">Resiko Penyakit berhasil ditambahkan!!</div>');
            redirect('dokter/resiko');
        }
    }


    public function ubahResiko($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Resiko',
            'oneData' => $this->db->get_where('resiko', ['id' => $id])->row(),
        ];

        $this->form_validation->set_rules('ind1', 'Karang Gigi', 'required|trim');
        $this->form_validation->set_rules('ind2', 'Pendarahan', 'required|trim');
        $this->form_validation->set_rules('ind3', 'Sakit Gigi', 'required|trim');
        $this->form_validation->set_rules('ind4', 'Bengkak', 'required|trim');
        $this->form_validation->set_rules('ind5', 'Radang Gusi', 'required|trim');
        $this->form_validation->set_rules('resiko', 'Resiko Penyakit', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('dokter/resiko/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $dataUser = [
                'ind1' => $this->input->post('ind1', true),
                'ind2' => $this->input->post('ind2', true),
                'ind3' => $this->input->post('ind3', true),
                'ind4' => $this->input->post('ind4', true),
                'ind5' => $this->input->post('ind5', true),
                'resiko' => $this->input->post('resiko', true),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('resiko', $dataUser);


            $this->session->set_flashdata('resiko', '<div class="alert alert-primary">Resiko Penyakit dengan ID <strong>' . $data['oneData']->no_rm . '</strong> berhasil diubah!!</div>');
            redirect('dokter/resiko');
        }
    }

    public function hapusResiko($id)
    {
        $pel = $this->db->get_where('resiko', ['id' => $id])->row();

        $this->db->delete('resiko', ['id' => $id]);

        $this->session->set_flashdata('resiko', '<div class="alert alert-warning">Data Resiko Penyakit dengan ID <strong>' . $pel->id . '</strong> berhasil dihapus!!</div>');
        redirect('dokter/resiko');
    }
}
