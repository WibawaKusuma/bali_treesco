<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login page';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email', true); // Menghindari XSS
        $password = $this->input->post('password');

        $user_detail = $this->db->get_where('m_user', ['email' => $email])->row_array();
        // print_r($user_detail);
        // exit;
        // Cek jika user ada
        if ($user_detail) {
            // Cek jika user aktif
            if ($user_detail['status'] == 1) {
                // Cek password dengan password_verify
                // if ($user_detail['password']) {
                if ($password == $user_detail['password']) {
                    $data = [
                        'id_user' => $user_detail['id_user'],
                        'email' => $user_detail['email'],
                        'name' => $user_detail['name'],
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('sweet_alert', json_encode([
                        'type' => 'success',
                        'title' => 'Login Berhasil!',
                        'text' => 'Login Berhasil!'
                    ]));
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('sweet_alert', json_encode([
                        'type' => 'error',
                        'title' => 'Login Gagal!',
                        'text' => 'Password salah!'
                    ]));
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('sweet_alert', json_encode([
                    'type' => 'error',
                    'title' => 'Login Gagal!',
                    'text' => 'Akun tidak aktif!'
                ]));
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('sweet_alert', json_encode([
                'type' => 'warning',
                'title' => 'Login Gagal!',
                'text' => 'Email tidak terdaftar!'
            ]));
            redirect('auth');
        }
    }



    public function logout()
    {
        // $this->session->unset_userdata('email');
        // $this->session->unset_userdata('role_id');
        $this->session->sess_destroy();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil logout!</div>');
        redirect('auth');
    }
}
