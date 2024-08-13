<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembukuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        supreme();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function neraca()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Neraca',
            'dataTab' => $this->db->select('neraca_saldo.*, pengguna.nama as pengguna_nama')
                ->join('pengguna', 'neraca_saldo.nama_pengguna = pengguna.nama', 'LEFT')
                ->get('neraca_saldo')
                ->result(),
            'dataMod' => $this->db->get('pengguna')->result() // Untuk dropdown atau data tambahan lainnya
        ];

        // Validasi form hanya untuk 'nama_pengguna'
        $this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('pembukuan/neraca', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $insertData = [
                'nama_pengguna' => $this->input->post('nama_pengguna', true),
                'ref' => $this->input->post('ref', true),
                'debit' => $this->input->post('debit', true),
                'kredit' => $this->input->post('kredit', true),
            ];

            $this->db->insert('neraca_saldo', $insertData);

            $this->session->set_flashdata('neraca_saldo', '<div class="alert alert-success">Data neraca saldo berhasil ditambahkan!</div>');
            redirect('pembukuan/neraca');
        }
    }

    public function ubahNeracaSaldo($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Neraca ',
            'oneData' => $this->db->select('neraca_saldo.*, pengguna.nama as pengguna_nama')
                ->join('pengguna', 'neraca_saldo.nama_pengguna = pengguna.nama', 'LEFT')
                ->get_where('neraca_saldo', ['neraca_saldo.id' => $id])
                ->row(),
            'dataMod' => $this->db->get('pengguna')->result()
        ];

        // Validation rules
        $this->form_validation->set_rules('nama_pengguna', 'Pengguna', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('pembukuan/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $updateData = [
                'nama_pengguna' => $this->input->post('nama_pengguna', true),
                'ref' => $this->input->post('ref', true),
                'debit' => $this->input->post('debit', true),
                'kredit' => $this->input->post('kredit', true),
            ];

            $this->db->where('id', $id);
            $this->db->update('neraca_saldo', $updateData);

            $this->session->set_flashdata('neraca_saldo', '<div class="alert alert-success">Neraca Saldo dengan ID <strong>' . $id . '</strong> berhasil diubah!</div>');
            redirect('pembukuan/neraca');
        }
    }

    public function hapusNeracaSaldo($id)
    {
        // Ambil data sebelum dihapus
        $data = $this->db->get_where('neraca_saldo', ['id' => $id])->row();

        // Hapus data dari tabel
        $this->db->delete('neraca_saldo', ['id' => $id]);

        // Set flash message
        $this->session->set_flashdata('neraca_saldo', '<div class="alert alert-warning">Data neraca saldo dengan ID <strong>' . $id . '</strong> berhasil dihapus!!</div>');

        // Redirect ke halaman neraca_saldo
        redirect('pembukuan/neraca');
    }
}
