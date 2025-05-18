<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Landing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Destination_model');
        $this->load->model('Admin_model');
        $this->load->model('General_model');
        $this->load->model('Feedback_model'); // Load model Feedback
        $this->load->database(); // Load database
        $this->load->library('form_validation');
        $this->load->library('session'); // Load session
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index()
    {
        @$data['title'] = 'Home';
        $data['galery'] = $this->General_model->get_data('m_galery')->result();
        // $data['config'] = $this->Destination_model->get_config('config')->row();
        $config_data = $this->General_model->get_config('config')->result();

        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        $data['config'] = $config_array;

        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/index');
        $this->load->view('templates/footer_landingpage');
    }

    public function about()
    {
        @$data['title'] = 'About Us';
        $data['team'] = $this->General_model->get_data('m_team')->result();
        // $data['config'] = $this->Destination_model->get_config('config')->row();
        $config_data = $this->General_model->get_config('config')->result();

        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        $data['config'] = $config_array;

        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/about');
        $this->load->view('templates/footer_landingpage');
    }

    public function product()
    {
        $data['title'] = 'Product';
        $data['detail'] = $this->Admin_model->get_acaravote('m_product')->result();
        $config_data = $this->General_model->get_config('config')->result();

        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        $data['config'] = $config_array;

        // $data['config'] = $this->Destination_model->get_config('config')->row();

        // print_r($data);
        // exit;

        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/product');
        $this->load->view('templates/footer_landingpage');
    }

    public function contact()
    {
        $data['title'] = 'Contact';
        // Ambil data dari tabel `config`
        $config_data = $this->General_model->get_config('config')->result();

        // Konversi array objek menjadi array asosiatif
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        // Simpan ke dalam $data['config']
        $data['config'] = $config_array;

        // print_r($data);
        // exit;


        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/contact');
        $this->load->view('templates/footer_landingpage');
    }

    public function get_product_name()
    {
        // Ambil ID produk dari POST
        $id_product = $this->input->post('id_product');

        if (empty($id_product)) {
            echo json_encode(['status' => 'error', 'message' => 'ID produk tidak valid']);
            return;
        }

        // Query untuk mendapatkan nama produk
        $this->db->select('name');
        $this->db->from('m_product');
        $this->db->where('id_product', $id_product);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $product = $query->row();
            echo json_encode(['status' => 'success', 'product_name' => $product->name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
        }
    }

    public function process()
    {
        // Ambil data dari form
        $id_product = $this->input->post('id');
        $qty = $this->input->post('qty');

        // Cek apakah customer sudah login
        if (!$this->session->userdata('customer_logged_in')) {
            // Jika belum login, kembalikan status login_required dan redirect URL
            echo json_encode([
                'status' => 'login_required',
                'message' => 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang',
                'redirect_url' => base_url('customer/login')
            ]);
            return;
        }

        // Jika sudah login, tampilkan konfirmasi dulu
        // Ambil data produk untuk konfirmasi
        $this->db->where('id_product', $id_product);
        $product = $this->db->get('m_product')->row();

        if ($product) {
            // Kembalikan status confirm_order untuk menampilkan konfirmasi
            echo json_encode([
                'status' => 'confirm_order',
                'product_name' => $product->name,
                'product_id' => $id_product,
                'qty' => $qty
            ]);
        } else {
            // Jika produk tidak ditemukan
            echo json_encode([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ]);
        }
    }

    public function add_to_cart()
    {
        // Ambil data dari form
        $id_product = $this->input->post('id');
        $qty = $this->input->post('qty');

        // Cek apakah customer sudah login
        if (!$this->session->userdata('customer_logged_in')) {
            // Jika belum login, kembalikan status login_required
            echo json_encode([
                'status' => 'login_required',
                'message' => 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang'
            ]);
            return;
        }

        // Jika sudah login, proses tambah ke keranjang
        $id_customer = $this->session->userdata('customer_id');

        // Load model Cart
        $this->load->model('Cart_model');

        // Tambahkan ke keranjang
        $result = $this->Cart_model->add_to_cart($id_customer, $id_product, $qty);

        if ($result) {
            // Mengembalikan response sukses dalam bentuk JSON
            echo json_encode([
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan ke keranjang!<br>Silakan cek <a href="' . base_url('cart') . '">keranjang belanja</a> Anda.'
            ]);
        } else {
            // Mengembalikan response error dalam bentuk JSON
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menambahkan produk ke keranjang'
            ]);
        }
    }

    public function send_feedback()
    {
        // Ambil data dari form menggunakan $_POST
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';

        // Validasi input sederhana
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            echo "error";
            return;
        }

        // Validasi email sederhana
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "error";
            return;
        }

        // Email tujuan (admin)
        $admin_email = 'info.balitreesco@gmail.com'; // Email admin yang sama dengan SMTP

        // Simpan data feedback ke database
        $feedback_data = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'is_sent' => 0, // Belum terkirim
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Load autoload untuk PHPMailer
        require_once FCPATH . 'vendor/autoload.php';

        // Kirim email menggunakan PHPMailer
        try {
            // Inisialisasi PHPMailer
            $mail = new PHPMailer(true);

            // Tangkap output debug
            ob_start();

            // Konfigurasi server
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'info.balitreesco@gmail.com'; // Email Gmail Anda
            $mail->Password = 'mljsabpdpxvarxws';    // App Password Gmail
            $mail->SMTPSecure = 'ssl';                // Menggunakan SSL
            $mail->Port = 465;                        // Port untuk SSL
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0;                     // Matikan debug untuk produksi (0 = off, 1 = client messages, 2 = client and server messages)

            // Opsi tambahan untuk mengatasi masalah SSL
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Pengirim dan penerima untuk email admin
            $mail->setFrom('info.balitreesco@gmail.com', 'Bali Treesco Website');
            $mail->addAddress($admin_email);
            $mail->addReplyTo($email, $name);

            // Konten email untuk admin
            $mail->isHTML(true);
            $mail->Subject = 'Feedback dari Website: ' . $subject;

            // Buat isi email untuk admin
            $email_content = "
            <html>
            <head>
                <title>Feedback dari Website</title>
            </head>
            <body>
                <h2>Feedback Baru dari Website</h2>
                <p><strong>Nama:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Subjek:</strong> $subject</p>
                <p><strong>Pesan:</strong></p>
                <p>$message</p>
                <hr>
                <p><small>Pesan ini dikirim dari form kontak website Bali Treesco.</small></p>
            </body>
            </html>
            ";

            $mail->Body = $email_content;

            // Kirim email ke admin
            $admin_email_sent = $mail->send();

            // Ambil output debug dan simpan ke log
            $debug_output = ob_get_clean();
            error_log("Debug PHPMailer (admin): " . $debug_output);

            // Mulai tangkap output debug lagi
            ob_start();

            // Log hasil pengiriman
            error_log("Email ke admin " . ($admin_email_sent ? "berhasil" : "gagal") . " terkirim");

            // Kirim email konfirmasi ke customer
            $customer_email_sent = false;

            if ($admin_email_sent) {
                // Log email customer untuk debugging
                error_log("Mengirim email ke customer: " . $email);

                // Pastikan email valid dan bersih
                $clean_email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);

                // Reset objek email untuk pengiriman baru
                $mail->clearAddresses();
                $mail->clearReplyTos();

                // Set email untuk customer
                $mail->setFrom('info.balitreesco@gmail.com', 'Bali Treesco');
                $mail->addAddress($clean_email, $name);
                $mail->Subject = 'Terima Kasih atas Feedback Anda';

                // Buat isi email untuk customer
                $customer_email_content = "
                <html>
                <head>
                    <title>Terima Kasih atas Feedback Anda</title>
                </head>
                <body>
                    <h2>Terima Kasih, $name!</h2>
                    <p>Kami telah menerima feedback Anda dengan subjek: <strong>$subject</strong></p>
                    <p>Pesan Anda:</p>
                    <p><em>$message</em></p>
                    <p>Kami sangat menghargai masukan Anda dan akan segera meninjau pesan ini. Jika diperlukan, tim kami akan menghubungi Anda dalam waktu 1-2 hari kerja.</p>
                    <hr>
                    <p>Salam hangat,</p>
                    <p><strong>Tim Bali Treesco</strong></p>
                    <p>Website: <a href='https://balitreesco.com'>balitreesco.com</a></p>
                    <p>Email: $admin_email</p>
                    <p><small>Ini adalah email otomatis, mohon jangan membalas email ini.</small></p>
                </body>
                </html>
                ";

                $mail->Body = $customer_email_content;

                // Kirim email ke customer
                try {
                    $customer_email_sent = $mail->send();

                    // Ambil output debug dan simpan ke log
                    $debug_output = ob_get_clean();
                    error_log("Debug PHPMailer (customer): " . $debug_output);

                    error_log("Email ke customer " . ($customer_email_sent ? "berhasil" : "gagal") . " terkirim");
                } catch (Exception $e) {
                    // Ambil output debug jika ada error
                    $debug_output = ob_get_clean();
                    error_log("Debug PHPMailer (customer error): " . $debug_output);

                    error_log("Error saat mengirim email ke customer: " . $e->getMessage());
                    $customer_email_sent = false;
                }
            }

            // Cek hasil pengiriman
            if ($admin_email_sent) {
                // Jika email ke admin berhasil, anggap sukses meskipun email ke customer gagal
                echo "success";

                // Simpan feedback ke database jika email berhasil dikirim
                $is_sent = $admin_email_sent && $customer_email_sent;
                $feedback_data['is_sent'] = $is_sent ? 1 : 0;

                // Simpan ke file log untuk debugging
                error_log("Feedback berhasil dikirim. Data: " . json_encode($feedback_data));

                // Log hasil pengiriman email
                if ($customer_email_sent) {
                    error_log("Email ke customer berhasil terkirim: " . $email);
                } else {
                    error_log("Email ke customer gagal terkirim: " . $email);
                }
            } else {
                echo "error";
                // Log kegagalan pengiriman email
                error_log("Gagal mengirim email ke admin: " . $admin_email);
            }
        } catch (Exception $e) {
            // Log error untuk debugging
            error_log("Error PHPMailer: " . $e->getMessage());

            // Tampilkan pesan error yang lebih sederhana ke pengguna
            echo "Error: Gagal mengirim email. Silakan coba lagi nanti.";
        }
    }


    // public function armada()
    // {
    //     $data['title'] = 'Armada';
    //     $data['armada'] = $this->Armada_model->get_armada('marmada')->result();
    //     $data['config'] = $this->Destination_model->get_config('config')->row();


    //     $this->load->view('templates/header_landingpage', $data);
    //     $this->load->view('landing_page/armada', $data);
    //     $this->load->view('templates/footer_landingpage');
    // }
}
