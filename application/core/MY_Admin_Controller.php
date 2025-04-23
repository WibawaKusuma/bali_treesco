<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Admin_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek apakah sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Cek role user
        if ($this->session->userdata('role') !== 'admin') {
            show_error('Akses ditolak. Halaman ini hanya bisa diakses oleh admin.', 403, 'Forbidden');
        }
    }
}
