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
        $this->form_validation->set_rules('nim', 'NIM', 'trim|required');
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
        $nim = $this->input->post('nim');
        $password = $this->input->post('password');

        $pemilih = $this->db->get_where('mPemilih', ['nim' => $nim])->row_array();
        // print_r($pemilih);
        // exit;

        // Cek jika user ada
        if ($pemilih) {

            // Cek jika user aktif
            if ($pemilih['status'] == 1) {

                // Cek passwordnya
                if ($password === $pemilih['password']) {
                    $data = [
                        'id_pemilih' => $pemilih['id_pemilih'],
                        'nim' => $pemilih['nim'],
                        'id_role' => $pemilih['id_role'],
                        'id_prodi' => $pemilih['id_prodi'],
                    ];
                    $this->session->set_userdata($data);

                    if ($pemilih['id_role'] == 2) {
                        redirect('admin');
                    } else {
                        // Cek id prodi
                        $cek_prodi = $this->db->get_where('mAcaraVote', ['id_prodi' => $pemilih['id_prodi']])->row_array();
                        if ($cek_prodi['status'] == 1) {

                            $cek_pilih = $this->db->get_where('trHasilVoting', ['id_pemilih' => $pemilih['id_pemilih']])->row_array();
                            if ($cek_pilih) {
                                $this->load->view('vote/sudah_memilih');
                            } else {
                                redirect('vote');
                            }
                        } else {
                            $this->session->set_flashdata('sweet_alert', json_encode([
                                'type' => 'info',
                                'title' => 'Tidak Dapat Melanjutkan!',
                                'text' => 'Voting belum dimulai!'
                            ]));
                            redirect('auth');
                        }
                    }
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
                    'text' => 'Pemilih tidak aktif!'
                ]));
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('sweet_alert', json_encode([
                'type' => 'warning',
                'title' => 'Login Gagal!',
                'text' => 'NIM atau password tidak terdaftar!'
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
