<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('form_validation');

        // $this->load->library(['form_validation', 'upload', 'session']);
        // $this->load->helper(['form', 'url']);


        $this->load->model('Admin_model');
        $this->load->model('Vote_model');
    }

    public function index()
    {
        $data['module'] = $this->Admin_model->get_acaravote('m_module')->result();
        $data['title'] = 'admin';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        // print_r($data);
        // exit;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }
}
