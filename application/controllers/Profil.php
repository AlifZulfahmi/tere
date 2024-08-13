<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        user();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Profil',
        ];

        if ($this->input->post('submitPassword', true)) {
            $this->form_validation->set_rules('password', 'Password saat ini', 'required|trim', [
                'required' => '{field} tidak boleh kosong!!'
            ]);
            $this->form_validation->set_rules('newpassword', 'Password baru', 'required|trim|min_length[8]|matches[renewpassword]', [
                'required' => '{field} tidak boleh kosong!!',
                'min_length' => '{field} minimal 8 karakter!!',
                'matches' => '{field} tidak sama dengan Konfirmasi Password Baru!!'
            ]);
            $this->form_validation->set_rules('renewpassword', 'Konfirmasi Password baru', 'required|trim|min_length[8]|matches[newpassword]', [
                'required' => '{field} tidak boleh kosong!!',
                'min_length' => '{field} minimal 8 karakter!!',
                'matches' => '{field} tidak sama dengan Password Baru!!'
            ]);
        }

        if ($this->input->post('submitProfil', true)) {
            $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required|trim', [
                'required' => '{field} tidak boleh kosong!!'
            ]);
            $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|trim', [
                'required' => '{field} tidak boleh kosong!!'
            ]);
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
                'required' => '{field} tidak boleh kosong!!'
            ]);
        }

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('dash/profil/index', $data);
            $this->load->view('templates/dash/footer');
        } else {
            if ($this->input->post('submitPassword')) {
                $current_password = $this->input->post('password', true);
                $new_password = $this->input->post('newpassword', true);
                if (!password_verify($current_password, $data['user']->password)) {
                    $isiPesan = '
                        <div class="alert alert-warning alert-dismissible fade show border border-dark" role="alert">
                                                <strong>Password</strong> saat ini salah!!
                        </div>';
                    $this->session->set_flashdata('profil', $isiPesan);
                    redirect('profil');
                } else {
                    if ($current_password == $new_password) {
                        $isiPesan = '
                        <div class="alert alert-warning alert-dismissible fade show border border-dark" role="alert">
                                                <strong>Password</strong> baru tidak bisa sama dengan <strong>Password</strong> saat ini!!!
                        </div>';
                        $this->session->set_flashdata('profil', $isiPesan);
                        redirect('profil');
                    } else {
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $this->db->set('password', $password_hash);
                        $this->db->where('email', $this->session->userdata('email'));
                        $this->db->update('pengguna');

                        $isiPesan = '
                        <div class="alert alert-success alert-dismissible fade show border border-dark" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        <strong>Password</strong> berhasil diubah!!
                        </div>';
                        $this->session->set_flashdata('profil', $isiPesan);
                        redirect('profil');
                    }
                }
            } else {
                if ($this->input->post('submitProfil', true)) {


                    $upload_image = $_FILES['image']['name'];
                    $email = $this->session->userdata('email');
                    $blabla = $this->db->get_where('pengguna', ['email' => $email])->row();

                    if ($upload_image) {

                        if ($_FILES['image']['size'] > 5120000) {
                            $isiPesan = '
            <div class="alert alert-danger alert-dismissible fade show border border-dark" role="alert">
                        <strong>Ukuran Gambar</strong> tidak bisa melebihi <strong>5 MB</strong>
            </div>';
                            $this->session->set_flashdata('profil', $isiPesan);
                            redirect('profil');
                        }

                        $config['file_name'] = time() . '_' . md5(sha1(base64_encode($email))) . time();
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size']      = '5012';
                        $config['upload_path'] = './assets/img/user/';

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('image')) {
                            $old_image = $blabla->image;

                            unlink(FCPATH . 'assets/img/user/' . $old_image);

                            // if (unlink(FCPATH . 'assets/img/user/' . $old_image) == false) {
                            //     redirect('profil');
                            // }

                            $new_image = $this->upload->data('file_name');
                            $this->db->set('image', $new_image);
                        } else {
                            redirect('profil');
                        }
                    }

                    $dataUser = [
                        'nama' => $this->input->post('nama', true),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                        'no_hp' => $this->input->post('no_hp', true)
                    ];

                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('pengguna', $dataUser);

                    $isiPesan = '
                        <div class="alert alert-success alert-dismissible fade show border border-dark" role="alert">
                        <strong>Profil Anda</strong> telah diubah
                        </div>';
                    $this->session->set_flashdata('profil', $isiPesan);
                    redirect('profil');
                }
            }
        }
    }

    public function aktivitas()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Log Aktivitas Anda',
            'dp' => $this->db->order_by('time_act', 'DESC')->get_where('histori_aktivitas', ['email_act' => $this->session->userdata('email')])->result_array(),
        ];


        $this->load->view('templates2/header', $data);
        $this->load->view('templates/top-sidebar', $data);
        $this->load->view('aktivitas/index', $data);
        $this->load->view('templates2/footer');
    }

    public function pengumuman()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Pengumuman',
            'pengumuman' => $this->db->order_by('dibuat', 'DESC')->get('pengumuman')->result_array(),
        ];


        $this->load->view('templates/header', $data);
        $this->load->view('templates/top-sidebar', $data);
        $this->load->view('pengumuman/index', $data);
        $this->load->view('templates/footer');
    }
}
