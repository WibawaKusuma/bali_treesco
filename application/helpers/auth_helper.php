<?php
defined('BASEPATH') or exit('No direct script access allowed');

function is_admin()
{
    $CI = &get_instance();
    if ($CI->session->userdata('role') !== 'admin') {
        redirect('auth/blocked'); // redirect ke halaman error jika bukan admin
    }
}
