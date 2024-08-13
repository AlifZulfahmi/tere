<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UI extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        supreme();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function menu()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Menu',
            'crumb' => 'Interface',
            'dataTab' => $this->db->order_by('order', 'ASC')->get('menu')->result()
        ];

        $this->form_validation->set_rules('menu', 'Nama Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('link', 'Link Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('icon', 'Ikon Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('for', 'Akses Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('status', 'Status Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('ui/menu/index', $data);
            $this->load->view('templates/dash/footer');
        } else {
            if ($this->input->post('submit' . $data['title'], true)) {
                $dataForm = [
                    'menu' => $this->input->post('menu', true),
                    'link' => $this->input->post('link', true),
                    'icon' => $this->input->post('icon', true),
                    'for' => $this->input->post('for', true),
                    'order' => 5,
                    'status' => $this->input->post('status', true),
                ];
                $this->db->insert('menu', $dataForm);
                $this->session->set_flashdata('menu', '<div class="alert alert-success mt-4"><strong>Menu</strong> berhasil ditambahkan!!</div>');
                redirect('ui/menu');
            }
        }
    }


    public function ubahMenu($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Menu',
            'crumb' => 'Interface',
            'oneData' => $this->db->get_where('menu', ['id' => $id])->row(),
        ];

        $this->form_validation->set_rules('menu', 'Nama Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('link', 'Link Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('icon', 'Ikon Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('for', 'Akses Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('order', 'Urutan Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('status', 'Status Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('ui/menu/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $dataForm = [
                'menu' => $this->input->post('menu', true),
                'link' => $this->input->post('link', true),
                'icon' => $this->input->post('icon', true),
                'for' => $this->input->post('for', true),
                'order' => $this->input->post('order', true),
                'status' => $this->input->post('status', true),
            ];
            $this->db->where('id', $this->input->post('id', true));
            $this->db->update('menu', $dataForm);
            $this->session->set_flashdata('menu', '<div class="alert alert-info mt-4"><strong>Menu</strong> berhasil diubah!!</div>');
            redirect('ui/menu');
        }
    }

    public function hapusMenu($id)
    {
        $user = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row();
        $side = $this->db->get_where('menu', ['id' => $id])->row();

        $this->db->delete('menu', ['id' => $id]);

        $this->session->set_flashdata('menu', '<div class="alert alert-warning mt-2">Menu <strong>' . $side->menu . ' </strong>berhasil dihapus!!</div>');
        redirect('ui/menu');
    }

    public function submenu()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Submenu',
            'crumb' => 'Interface',
            'dataTab' => $this->db->select('submenu.id as id, submenu.*, menu.menu as menu')->join('menu', 'menu.id = submenu.menu_id', 'left')->get('submenu')->result(),
            'dataTabModal' => $this->db->get('menu')->result(),
        ];

        $this->form_validation->set_rules('menu_id', 'Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('title', 'Nama Submenu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('url_i', 'Link 1', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('url_ii', 'Link 2', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('status', 'Status Submenu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('ui/submenu/index', $data);
            $this->load->view('templates/dash/footer');
        } else {
            if ($this->input->post('submit' . $data['title'], true)) {
                $dataForm = [
                    'menu_id' => $this->input->post('menu_id', true),
                    'title' => $this->input->post('title', true),
                    'url_i' => $this->input->post('url_i', true),
                    'url_ii' => $this->input->post('url_ii', true),
                    'status' => $this->input->post('status', true),
                ];
                $this->db->insert('submenu', $dataForm);
                $this->session->set_flashdata('submenu', '<div class="alert alert-success mt-4"><strong>Submenu</strong> berhasil ditambahkan!!</div>');
                redirect('ui/submenu');
            }
        }
    }


    public function ubahSubmenu($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Submenu',
            'crumb' => 'Interface',
            'oneData' => $this->db->select('submenu.id as id, submenu.*, menu.menu as menu')->join('menu', 'menu.id = submenu.menu_id', 'left')->get_where('submenu', ['submenu.id' => $id])->row(),
            'dataTab' => $this->db->get('menu')->result()
        ];

        $this->form_validation->set_rules('menu_id', 'Menu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('title', 'Nama Submenu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('url_i', 'Link 1', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('url_ii', 'Link 2', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);
        $this->form_validation->set_rules('status', 'Status Submenu', 'trim|required', [
            'required' => '<strong>{field}</strong> tidak boleh kosong!!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('ui/submenu/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $dataForm = [
                'menu_id' => $this->input->post('menu_id', true),
                'title' => $this->input->post('title', true),
                'url_i' => $this->input->post('url_i', true),
                'url_ii' => $this->input->post('url_ii', true),
                'status' => $this->input->post('status', true),
            ];
            $this->db->where('id', $this->input->post('id', true));
            $this->db->update('submenu', $dataForm);
            $this->session->set_flashdata('submenu', '<div class="alert alert-info mt-4"><strong>Submenu</strong> berhasil diubah!!</div>');
            redirect('ui/submenu');
        }
    }

    public function hapusSubmenu($id)
    {
        $user = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row();
        $side = $this->db->get_where('submenu', ['id' => $id])->row();

        $this->db->delete('submenu', ['id' => $id]);

        $this->session->set_flashdata('submenu', '<div class="alert alert-warning mt-2">Submenu <strong>' . $side->title . ' </strong>berhasil dihapus!!</div>');
        redirect('ui/submenu');
    }
}
