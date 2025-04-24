<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin();

        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('form_validation');

        // $this->load->library(['form_validation', 'upload', 'session']);
        // $this->load->helper(['form', 'url']);


        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Vote_model');
    }

    // public function index()
    // {
    //     $data['module'] = $this->Admin_model->get_acaravote('m_module')->result();
    //     $data['title'] = 'Admin';
    //     $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

    //     // print_r($data);
    //     // exit;

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('templates/sidebar_admin', $data);
    //     $this->load->view('admin/dashboard');
    //     $this->load->view('templates/footer');
    // }
    public function index()
    {
        // Ambil ID user dari session
        $user_id = $this->session->userdata('id_user');

        // Ambil module yang bisa diakses oleh user ini
        $this->db->select('m_module.*');
        $this->db->from('m_role_permissions');
        $this->db->join('m_module', 'm_module.id_module = m_role_permissions.id_module');
        $this->db->where('m_role_permissions.id_user', $user_id);
        $this->db->where('m_module.status', 1); // Pastikan hanya module dengan status aktif yang ditampilkan
        $query = $this->db->get();
        $data['module'] = $query->result(); // Ambil hasil query dan simpan di $data['module']

        // Ambil data user berdasarkan email yang ada di session
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        // Data untuk title halaman
        $data['title'] = 'Admin';

        // Load view dengan data yang sudah disiapkan
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }


    public function update_password()
    {
        $userId = $this->session->userdata('id_user'); // Sesuaikan dengan session kamu
        $current = $this->input->post('current_password');
        $new = $this->input->post('new_password');
        $confirm = $this->input->post('confirm_password');

        // Ambil data user dari model
        $user = $this->User_model->get_user_by_id($userId);

        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin');
        }

        // Cek password lama (plain text)
        if ($user['password'] !== $current) {
            $this->session->set_flashdata('error', 'Password lama salah!');
            redirect('admin');
        }

        // Validasi password baru & konfirmasi
        if ($new !== $confirm) {
            $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok!');
            redirect('admin');
        }

        // Simpan password baru (plain text)
        $data = ['password' => $new];

        print_r($data);
        exit;

        // Simpan ke database
        $this->User_model->update_user($userId, $data);

        $this->session->set_flashdata('success', 'Password berhasil diubah.');
        redirect('admin');
    }
}
