<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Konfigurasi email
$config = array(
    'protocol'      => 'smtp',
    'smtp_host'     => 'smtp.gmail.com',
    'smtp_port'     => 465,
    'smtp_user'     => 'madewinada@gmail.com', // Ganti dengan email Anda
    'smtp_pass'     => 'winada31!', // Ganti dengan password email Anda
    'smtp_crypto'   => 'ssl',
    'mailtype'      => 'html',
    'charset'       => 'utf-8',
    'newline'       => "\r\n",
    'wordwrap'      => TRUE,
    'validate'      => TRUE
);
