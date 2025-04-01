<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Pastikan PHPMailer sudah terinstal dengan Composer

class Contact_email extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['form', 'url']);
    }

    public function send_email()
    {
        // Validasi input
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        // Ambil data dari form
        $name = $this->input->post('name', true);
        $email = $this->input->post('email', true);
        $subject = $this->input->post('subject', true);
        $message = $this->input->post('message', true);

        $mail = new PHPMailer(true);

        try {
            // Konfigurasi SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.your-email.com'; // Ganti dengan SMTP Anda
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@example.com'; // Email Anda
            $mail->Password = 'your-email-password'; // Password email
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Set penerima
            $mail->setFrom($email, $name);
            $mail->addAddress('your-email@example.com'); // Ganti dengan email tujuan

            // Konten email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "Name: $name <br> Email: $email <br> Message: <br> $message";

            $mail->send();
            echo json_encode(['status' => 'success', 'message' => 'Your message has been sent.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
        }
    }
}
