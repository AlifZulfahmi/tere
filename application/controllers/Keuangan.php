<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        supreme();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function pemasukan()
    {

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Pemasukan',
            'dataTab' => $this->db->select('pemasukan.*, asrama.nama as asrama')
                ->join('asrama', 'pemasukan.id_asrama = asrama.id', 'LEFT')
                ->get('pemasukan')
                ->result(),
            'dataMod' => $this->db->get('asrama')->result()
        ];

        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|numeric');
        $this->form_validation->set_rules('sumber', 'Sumber', 'required|trim|in_list[infaq,donasi,orang tua asuh]');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('id_asrama', 'Asrama', 'trim'); // Optional validation

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('keuangan/pemasukan', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $insertData = [
                'tanggal_masuk' => strtotime($this->input->post('tanggal_masuk', true)),
                'jumlah' => $this->input->post('jumlah', true),
                'sumber' => $this->input->post('sumber', true),
                'keterangan' => $this->input->post('keterangan', true),
                'id_asrama' => $this->input->post('id_asrama', true) // Insert asrama ID if needed
            ];

            $this->db->insert('pemasukan', $insertData);

            $this->session->set_flashdata('pemasukan', '<div class="alert alert-success">Pemasukan baru dengan jumlah <strong>' . $this->input->post('jumlah', true) . '</strong> berhasil ditambahkan!!</div>');
            redirect('keuangan/pemasukan');
        }
    }


    public function ubahPemasukan($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Pemasukan',
            'oneData' => $this->db->select('pemasukan.*, asrama.nama as asrama')
                ->join('asrama', 'pemasukan.id_asrama = asrama.id', 'LEFT')
                ->get_where('pemasukan', ['pemasukan.id' => $id])
                ->row(),
            'dataMod' => $this->db->get('asrama')->result()
        ];

        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|trim');
        $this->form_validation->set_rules('sumber', 'Sumber', 'required|trim|in_list[infaq,donasi,orang tua asuh]');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('id_asrama', 'Asrama', 'trim'); // Optional validation

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('keuangan/ubah_pemasukan', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $updateData = [
                'tanggal_masuk' => strtotime($this->input->post('tanggal_masuk', true)),
                'jumlah' => $this->input->post('jumlah', true),
                'sumber' => $this->input->post('sumber', true),
                'keterangan' => $this->input->post('keterangan', true),
                'id_asrama' => $this->input->post('id_asrama', true) // Update asrama ID if needed
            ];

            $this->db->where('id', $id);
            $this->db->update('pemasukan', $updateData);

            $this->session->set_flashdata('pemasukan', '<div class="alert alert-success">Pemasukan dengan ID <strong>' . $id . '</strong> berhasil diubah!!</div>');
            redirect('keuangan/pemasukan');
        }
    }


    public function hapusPemasukan($id)
    {
        // Ambil data sebelum dihapus
        $data = $this->db->get_where('pemasukan', ['id' => $id])->row();

        // Hapus data dari tabel
        $this->db->delete('pemasukan', ['id' => $id]);

        // Set flash message
        $this->session->set_flashdata('pemasukan', '<div class="alert alert-warning">Data Pemasukan dengan ID <strong>' . $id . '</strong> berhasil dihapus!!</div>');

        // Redirect ke halaman pemasukan
        redirect('keuangan/pemasukan');
    }

    public function pengeluaran()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Pengeluaran',
            'dataTab' => $this->db->select('pengeluaran.*, asrama.nama as asrama')
                ->join('asrama', 'pengeluaran.id_asrama = asrama.id', 'LEFT')
                ->get('pengeluaran')
                ->result(),
            'dataMod' => $this->db->get('asrama')->result()
        ];

        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|numeric');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim|in_list[personalia,operasional,pemeliharaan,konsumsi,lainya]');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('id_asrama', 'Asrama', 'trim'); // Tambahkan validasi jika perlu

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('keuangan/pengeluaran', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $insertData = [
                'tanggal_keluar' => strtotime($this->input->post('tanggal_keluar', true)),
                'jumlah' => $this->input->post('jumlah', true),
                'kategori' => $this->input->post('kategori', true),
                'keterangan' => $this->input->post('keterangan', true),
                'id_asrama' => $this->input->post('id_asrama', true) // Simpan data asrama jika diperlukan
            ];

            $this->db->insert('pengeluaran', $insertData);

            $this->session->set_flashdata('pengeluaran', '<div class="alert alert-success">Pengeluaran baru dengan jumlah <strong>' . $this->input->post('jumlah', true) . '</strong> berhasil ditambahkan!!</div>');
            redirect('keuangan/pengeluaran');
        }
    }



    public function ubahPengeluaran($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Pengeluaran',
            'oneData' => $this->db->select('pengeluaran.*, asrama.nama as asrama')
                ->join('asrama', 'pengeluaran.id_asrama = asrama.id', 'LEFT')
                ->get_where('pengeluaran', ['pengeluaran.id' => $id])
                ->row(),
            'dataMod' => $this->db->get('asrama')->result()
        ];

        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim|in_list[personalia,operasional,pemeliharaan,konsumsi,lainya]');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('id_asrama', 'Asrama', 'trim'); // Optional validation for asrama

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('keuangan/ubah_pengeluaran', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $updateData = [
                'tanggal_keluar' => strtotime($this->input->post('tanggal_keluar', true)),
                'jumlah' => $this->input->post('jumlah', true),
                'kategori' => $this->input->post('kategori', true),
                'keterangan' => $this->input->post('keterangan', true),
                'id_asrama' => $this->input->post('id_asrama', true) // Update data asrama if needed
            ];

            $this->db->where('id', $id);
            $this->db->update('pengeluaran', $updateData);

            $this->session->set_flashdata('pengeluaran', '<div class="alert alert-success">Pengeluaran dengan ID <strong>' . $id . '</strong> berhasil diubah!!</div>');
            redirect('keuangan/pengeluaran');
        }
    }





    public function hapusPengeluaran($id)
    {
        // Ambil data sebelum dihapus
        $data = $this->db->get_where('pengeluaran', ['id' => $id])->row();

        // Hapus data dari tabel
        $this->db->delete('pengeluaran', ['id' => $id]);

        // Set flash message
        $this->session->set_flashdata('pengeluaran', '<div class="alert alert-warning">Data Pengeluaran dengan ID <strong>' . $id . '</strong> berhasil dihapus!!</div>');

        // Redirect ke halaman pengeluaran
        redirect('keuangan/pengeluaran');
    }

    public function pembukuan()
    {
        $user = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row();
        $pemasukan = $this->db->select('pemasukan.*, asrama.nama as asrama')
            ->join('asrama', 'pemasukan.id_asrama = asrama.id', 'LEFT')
            ->get('pemasukan')
            ->result();

        $pengeluaran = $this->db->select('pengeluaran.*, asrama.nama as asrama')
            ->join('asrama', 'pengeluaran.id_asrama = asrama.id', 'LEFT')
            ->get('pengeluaran')
            ->result();

        // Combine both pemasukan and pengeluaran into a single array
        $pembukuan = [];
        foreach ($pemasukan as $row) {
            $pembukuan[] = [
                'id' => $row->id,
                'tanggal' => $row->tanggal_masuk,
                'jumlah' => $row->jumlah,
                'sumber_kategori' => $row->sumber,
                'keterangan' => $row->keterangan,
                'asrama' => $row->asrama,
                'jenis' => 'Pemasukan'
            ];
        }
        foreach ($pengeluaran as $row) {
            $pembukuan[] = [
                'id' => $row->id,
                'tanggal' => $row->tanggal_keluar,
                'jumlah' => $row->jumlah,
                'sumber_kategori' => $row->kategori,
                'keterangan' => $row->keterangan,
                'asrama' => $row->asrama,
                'jenis' => 'Pengeluaran'
            ];
        }

        // Sort the array by date (optional)
        usort($pembukuan, function ($a, $b) {
            return $b['tanggal'] - $a['tanggal'];
        });

        // Pass the combined data to the view
        $data = [
            'user' => $user,
            'title' => 'Pembukuan',
            'pembukuan' => $pembukuan
        ];

        $this->load->view('templates/dash/header', $data);
        $this->load->view('templates/dash/sidenav', $data);
        $this->load->view('keuangan/pembukuan', $data);
        $this->load->view('templates/dash/footer');
    }

    public function jurnal()
    {
        // Load helper jika belum di-load
        $this->load->helper('access_helper'); // Ganti 'access' dengan nama helper Anda jika berbeda

        // Mengambil data pengguna dan judul
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Jurnal',
            'dataMod' => $this->db->get('pengguna')->result() // Ambil data pengguna untuk dropdown
        ];

        // Menangani filter
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');

        // Menghitung timestamp awal dan akhir
        $start_date = null;
        $end_date = null;

        if ($tahun && $bulan) {
            // Menghitung timestamp awal dan akhir bulan
            $start_date = strtotime("$tahun-$bulan-01");
            $end_date = strtotime("+1 month", $start_date) - 1;
        } elseif ($tahun) {
            // Menghitung timestamp awal dan akhir tahun
            $start_date = strtotime("$tahun-01-01");
            $end_date = strtotime("+1 year", $start_date) - 1;
        }

        // Query untuk mengambil data jurnal_umum dengan filter tahun dan bulan jika ada
        $this->db->select('jurnal_umum.*');

        if ($start_date && $end_date) {
            $this->db->where('jurnal_umum.tanggal >=', $start_date);
            $this->db->where('jurnal_umum.tanggal <=', $end_date);
        }

        $data['dataTab'] = $this->db->get('jurnal_umum')->result();

        // Validasi form
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('ref', 'Ref', 'trim'); // Menambahkan validasi untuk field ref

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('keuangan/jurnal_umum', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $data_insert = [
                'tanggal' => strtotime($this->input->post('tanggal', true)),
                'keterangan' => $this->input->post('keterangan', true),
                'debet' => $this->input->post('debet', true),
                'kredit' => $this->input->post('kredit', true),
                'ref' => $this->input->post('ref', true) // Menambahkan field ref
            ];

            $this->db->insert('jurnal_umum', $data_insert);

            $this->session->set_flashdata('jurnal', '<div class="alert alert-success">Jurnal baru dengan keterangan <strong>' . $this->input->post('keterangan', true) . '</strong> berhasil ditambahkan!!</div>');
            redirect('keuangan/jurnal');
        }
    }




    public function ubahJurnal($id)
    {
        // Ambil data pengguna
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row();
        $data['title'] = 'Ubah Jurnal Umum';

        // Ambil data jurnal berdasarkan ID
        $data['jurnal'] = $this->db->get_where('jurnal_umum', ['id' => $id])->row();

        if (empty($data['jurnal'])) {
            show_404();
        }

        // Validasi form
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('debet', 'Debet');
        $this->form_validation->set_rules('kredit', 'Kredit');
        $this->form_validation->set_rules('ref', 'Reference', 'trim'); // Menambahkan validasi untuk field ref jika diperlukan

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('keuangan/ubah_jurnal', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $updateData = [
                'tanggal' => strtotime($this->input->post('tanggal', true)),
                'keterangan' => $this->input->post('keterangan', true),
                'debet' => $this->input->post('debet', true),
                'kredit' => $this->input->post('kredit', true),
                'ref' => $this->input->post('ref', true) // Menambahkan field ref ke updateData
            ];

            $this->db->update('jurnal_umum', $updateData, ['id' => $id]);

            $this->session->set_flashdata('jurnal', '<div class="alert alert-success">Jurnal dengan keterangan <strong>' . $this->input->post('keterangan', true) . '</strong> berhasil diubah!!</div>');
            redirect('keuangan/jurnal');
        }
    }
}
