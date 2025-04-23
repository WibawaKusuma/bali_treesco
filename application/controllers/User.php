<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_admin();

        $this->load->library('session');

        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('General_model');
    }

    public function index()
    {
        $data['title'] = 'User';
        $data['member'] = $this->General_model->get_data('m_user')->result();

        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('user/datatable', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create User';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('user/form', $data);
        $this->load->view('templates/footer');
    }

    public function create_user()
    {
        if ($this->input->post()) {
            $data = $this->input->post('p');

            // Tambahkan timestamp untuk CreatedAt dan UpdatedAt
            $data['created_at'] = date('Y-m-d H:i:s'); // Gunakan format datetime

            // Simpan ke database
            $this->General_model->insert_data($data, 'm_user');
            $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
            redirect('user');
        } else {
            // Jika tidak ada data POST, tampilkan form
            $this->load->view('user/form');
        }
    }

    public function update($id_user)
    {
        // Ambil user login untuk topbar (as array)
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post()) {
            $post = $this->input->post('p');
            $post['created_at'] = date('Y-m-d H:i:s'); // Set timestamp untuk update

            // Update data ke database
            $this->db->where('id_user', $id_user);
            $this->General_model->update($post, 'm_user');

            // Set flashdata untuk notifikasi
            $this->session->set_flashdata('success', 'User berhasil diubah!');
            redirect('user');
        } else {
            // Ambil data user yang akan diedit (as object untuk form)
            $data['member'] = $this->db->get_where('m_user', ['id_user' => $id_user])->row(); // untuk form edit
        }

        // Set judul dan load view
        $data['title'] = 'Edit User';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('user/form', $data);
        $this->load->view('templates/footer');
    }


    public function delete($id_galery)
    {
        // Hapus data berdasarkan NoReservasi
        $this->db->where('id_galery', $id_galery);
        $this->db->delete('m_galery');

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('success', 'Galery berhasil dihapus!');

        // Redirect ke halaman daftar reservasi
        redirect('galery');
    }
}
