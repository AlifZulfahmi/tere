<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Output extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        user();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('pdfgenerator');
    }

    public function pembayaran($id)
    {
        supreme();
        $pemData = $this->db->get_where('pembayaran', ['id' => $id])->row();
        $pasData = $this->db->get_where('pasien', ['id' => $pemData->id_pasien])->row();

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'invoice_' . strtolower($pemData->invoice),
        ];
        $data['onePem'] = $pemData;
        $data['onePas'] = $pasData;


        $file_pdf = 'invoice_' . strtolower($pemData->invoice);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/pembayaran/index', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function datapembayaran()
    {

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Pembayaran',
            'data1' => $this->db->select('pembayaran.*, pasien.nama, pasien.nik, pasien.id_rm')->join('pasien', 'pembayaran.id_pasien = pasien.id', 'left')->get('pembayaran')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/pembayaran/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function datapengguna()
    {

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Pengguna',
            'data1' => $this->db->get('pengguna')->result(),
        ];


        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/pengguna/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function datapasien()
    {

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Pasien',
            'data1' => $this->db->get('pasien')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Landscape';
        $html = $this->load->view('output/pasien/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function datadokter()
    {

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Dokter',
            'data1' => $this->db->select('dokter.*, pengguna.email')->join('pengguna', 'dokter.id_user = pengguna.id', 'left')->get('dokter')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Landscape';
        $html = $this->load->view('output/dokter/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataregistrasi()
    {

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Registrasi Pasien',
            'data1' => $this->db->select('registrasi.*, pasien.nama, pasien.id_rm, pasien.nik, dokter.nama as dokter')->join('pasien', 'registrasi.id_pasien = pasien.id', 'left')->join('dokter', 'registrasi.id_dokter = dokter.id', 'left')->get('registrasi')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Landscape';
        $html = $this->load->view('output/registrasi/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function datamedik()
    {

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Medik Pasien',
            'data1' => $this->db->select('medik.*, pasien.nama')->join('pasien', 'medik.id_pasien = pasien.id', 'left')->get('medik')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Landscape';
        $html = $this->load->view('output/medik/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataresiko()
    {

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Resiko Penyakit',
            'data1' => $this->db->get('resiko')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/resiko/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    private function print($html, $filename = '', $paper = '', $orientation = '')
    {
        $this->pdfgenerator->generate($html, $filename, $paper, $orientation);
    }

    public function dataPemasukan()
    {
        // Ambil data pemasukan dari database
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Pemasukan',
            'data1' => $this->db->get('pemasukan')->result(),
            'start_date' => strtotime('2024-01-01'), // Ganti dengan tanggal mulai yang sesuai
            'end_date' => strtotime('2024-12-31'),   // Ganti dengan tanggal akhir yang sesuai
            'totalJumlah' => $this->db->select_sum('jumlah')->get('pemasukan')->row()->jumlah
        ];

        // Nama file PDF
        $file_pdf = strtolower($data['title']);
        // Kertas dan orientasi
        $paper = 'A4';
        $orientation = 'Portrait';
        // Load view dan render HTML
        $html = $this->load->view('output/pemasukan/data', $data, true);

        // Panggil fungsi untuk mencetak PDF
        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataPengeluaran()
    {
        // Ambil data pengeluaran dari database
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Pengeluaran',
            'data1' => $this->db->get('pengeluaran')->result(),
            'start_date' => strtotime('2024-01-01'), // Ganti dengan tanggal mulai yang sesuai
            'end_date' => strtotime('2024-12-31'),   // Ganti dengan tanggal akhir yang sesuai
            'totalJumlah' => $this->db->select_sum('jumlah')->get('pengeluaran')->row()->jumlah
        ];

        // Nama file PDF
        $file_pdf = strtolower($data['title']);
        // Kertas dan orientasi
        $paper = 'A4';
        $orientation = 'Portrait';
        // Load view dan render HTML
        $html = $this->load->view('output/pengeluaran/data', $data, true);

        // Panggil fungsi untuk mencetak PDF
        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataPembukuan()
    {
        // Ambil data pemasukan dan pengeluaran dari database
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Pembukuan',
            'pemasukan' => $this->db->get('pemasukan')->result(),
            'pengeluaran' => $this->db->get('pengeluaran')->result(),
            'start_date' => strtotime('2024-01-01'), // Ganti dengan tanggal mulai yang sesuai
            'end_date' => strtotime('2024-12-31'),   // Ganti dengan tanggal akhir yang sesuai
            'totalPemasukan' => $this->db->select_sum('jumlah')->get('pemasukan')->row()->jumlah,
            'totalPengeluaran' => $this->db->select_sum('jumlah')->get('pengeluaran')->row()->jumlah,
            'netto' => $this->db->select_sum('jumlah')->get('pemasukan')->row()->jumlah -
                $this->db->select_sum('jumlah')->get('pengeluaran')->row()->jumlah
        ];

        // Nama file PDF
        $file_pdf = strtolower($data['title']);
        // Kertas dan orientasi
        $paper = 'A4';
        $orientation = 'Portrait';
        // Load view dan render HTML
        $html = $this->load->view('output/pembukuan/data', $data, true);

        // Panggil fungsi untuk mencetak PDF
        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataSantri()
    {
        // Ambil data santri dari database dengan join ke table asrama
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Santri',
            'data1' => $this->db->select('santri.nama, santri.tgl_lahir, santri.jk, asrama.nama as nama_asrama')
                ->join('asrama', 'santri.id_asrama = asrama.id', 'LEFT')
                ->get('santri')
                ->result(),
            'start_date' => strtotime('2024-01-01'), // Ganti dengan tanggal mulai yang sesuai
            'end_date' => strtotime('2024-12-31')   // Ganti dengan tanggal akhir yang sesuai
        ];

        // Nama file PDF
        $file_pdf = strtolower($data['title']);
        // Kertas dan orientasi
        $paper = 'A4';
        $orientation = 'Portrait';
        // Load view dan render HTML
        $html = $this->load->view('output/santri/data', $data, true);

        // Panggil fungsi untuk mencetak PDF
        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataYayasan()
    {
        // Ambil data ustadz dari database dengan join ke table asrama dan pengguna
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Yayasan',
            'data1' => $this->db->select('ustadz.id_user, ustadz.nama, ustadz.bidang, ustadz.jk, asrama.nama as nama_asrama, pengguna.id as id_pengguna')
                ->join('asrama', 'ustadz.id_asrama = asrama.id', 'LEFT')
                ->join('pengguna', 'ustadz.id_user = pengguna.id', 'LEFT')
                ->get('ustadz')
                ->result(),
            'start_date' => strtotime('2024-01-01'), // Ganti dengan tanggal mulai yang sesuai
            'end_date' => strtotime('2024-12-31')   // Ganti dengan tanggal akhir yang sesuai
        ];

        // Nama file PDF
        $file_pdf = strtolower($data['title']);
        // Kertas dan orientasi
        $paper = 'A4';
        $orientation = 'Portrait';
        // Load view dan render HTML
        $html = $this->load->view('output/yayasan/data', $data, true);

        // Panggil fungsi untuk mencetak PDF
        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataAsrama()
    {
        // Ambil data asrama dari database dengan join ke table ustadz
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Asrama',
            'data1' => $this->db->select('asrama.*, ustadz.nama as musyrif')
                ->join('ustadz', 'asrama.id_musyrif = ustadz.id', 'LEFT')
                ->get('asrama')
                ->result(),
            'start_date' => strtotime('2024-01-01'), // Ganti dengan tanggal mulai yang sesuai
            'end_date' => strtotime('2024-12-31')   // Ganti dengan tanggal akhir yang sesuai
        ];

        // Nama file PDF
        $file_pdf = strtolower($data['title']);
        // Kertas dan orientasi
        $paper = 'A4';
        $orientation = 'Portrait';
        // Load view dan render HTML
        $html = $this->load->view('output/asrama/data', $data, true);

        // Panggil fungsi untuk mencetak PDF
        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataJurnal()
    {
        // Ambil parameter tahun dan bulan dari URL atau default ke tahun dan bulan saat ini
        $tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');

        // Set default values jika tidak disediakan
        $tahun = $tahun ? $tahun : date('Y');
        $bulan = $bulan ? $bulan : '';

        // Hitung tanggal mulai dan akhir untuk filter dalam format Unix timestamp
        if ($bulan) {
            // Jika bulan diberikan, gunakan bulan tersebut
            $start_date = strtotime($tahun . '-' . $bulan . '-01'); // Hari pertama bulan
            $end_date = strtotime('last day of ' . $tahun . '-' . $bulan); // Hari terakhir bulan
        } else {
            // Jika bulan tidak diberikan, gunakan seluruh tahun
            $start_date = strtotime($tahun . '-01-01'); // Hari pertama tahun
            $end_date = strtotime($tahun . '-12-31'); // Hari terakhir tahun
        }

        // Tambah satu hari pada end_date agar data akhir bulan inklusif
        $end_date += 86400; // Tambah satu hari dalam detik

        // Debugging: Cek nilai start_date dan end_date
        log_message('debug', 'Start Date Timestamp: ' . $start_date);
        log_message('debug', 'End Date Timestamp: ' . $end_date);

        // Ambil data jurnal dengan filter tahun dan bulan
        $this->db->select('*');
        $this->db->order_by('tanggal', 'ASC');
        $this->db->from('jurnal_umum');
        $this->db->where('tanggal >=', $start_date);
        $this->db->where('tanggal <=', $end_date);
        $data['data1'] = $this->db->get()->result();

        // Debugging: Cek hasil query
        log_message('debug', 'Query Result: ' . print_r($data['data1'], true));

        // Hitung total debet dan kredit
        $this->db->select_sum('debet');
        $this->db->where('tanggal >=', $start_date);
        $this->db->where('tanggal <=', $end_date);
        $data['total_debet'] = $this->db->get('jurnal_umum')->row()->debet;

        $this->db->select_sum('kredit');
        $this->db->where('tanggal >=', $start_date);
        $this->db->where('tanggal <=', $end_date);
        $data['total_kredit'] = $this->db->get('jurnal_umum')->row()->kredit;

        // Menyiapkan variabel start_date dan end_date untuk tampilan PDF
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        // Set title and render HTML for PDF
        $data['title'] = 'Laporan Jurnal Umum';
        $file_pdf = strtolower(str_replace(' ', '_', $data['title']));
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/jurnal/data', $data, true);

        // Panggil fungsi untuk mencetak PDF
        $this->print($html, $file_pdf, $paper, $orientation);
    }



    public function dataNeraca()
    {
        // Ambil data neraca_saldo dari database dengan join ke table pengguna
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Neraca Saldo',
            'data1' => $this->db->select('neraca_saldo.*, pengguna.nama as pengguna_nama')
                ->join('pengguna', 'neraca_saldo.nama_pengguna = pengguna.nama', 'LEFT')
                ->get('neraca_saldo')
                ->result(),
            'start_date' => strtotime('2024-01-01'), // Ganti dengan tanggal mulai yang sesuai
            'end_date' => strtotime('2024-12-31')    // Ganti dengan tanggal akhir yang sesuai
        ];

        // Calculate total debit and credit
        $this->db->select_sum('debit');
        $total_debit = $this->db->get('neraca_saldo')->row()->debit;

        $this->db->select_sum('kredit');
        $total_kredit = $this->db->get('neraca_saldo')->row()->kredit;

        // Add total values to data array
        $data['total_debet'] = $total_debit;
        $data['total_kredit'] = $total_kredit;

        // Nama file PDF
        $file_pdf = strtolower(str_replace(' ', '_', $data['title']));
        // Kertas dan orientasi
        $paper = 'A4';
        $orientation = 'Portrait';
        // Load view dan render HTML
        $html = $this->load->view('output/neraca/data', $data, true);

        // Panggil fungsi untuk mencetak PDF
        $this->print($html, $file_pdf, $paper, $orientation);
    }
}
