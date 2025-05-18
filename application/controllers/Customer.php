<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('General_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
    }

    /**
     * Halaman login
     */
    public function login()
    {
        // Jika sudah login, redirect ke halaman produk
        if ($this->session->userdata('customer_logged_in')) {
            redirect('landing/product');
        }

        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Login';

        // Jika ada POST data
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Validasi input
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi gagal
                $this->load->view('templates/header_landingpage', $data);
                $this->load->view('customer/login');
                $this->load->view('templates/footer_landingpage');
            } else {
                // Coba login
                $customer = $this->Customer_model->login($email, $password);

                if ($customer) {
                    // Jika login berhasil, set session
                    $this->session->set_userdata([
                        'customer_logged_in' => TRUE,
                        'customer_id' => $customer->id_customer,
                        'customer_name' => $customer->nickname ? $customer->nickname : $customer->name,
                        'customer_email' => $customer->email
                    ]);

                    // Redirect ke halaman produk
                    $this->session->set_flashdata('success', 'Login berhasil! Sekarang Anda dapat menambahkan produk ke keranjang.');
                    redirect('landing/product');
                } else {
                    // Jika login gagal
                    $this->session->set_flashdata('error', 'Email atau password salah');
                    redirect('customer/login');
                }
            }
        } else {
            // Tampilkan form login
            $this->load->view('templates/header_landingpage', $data);
            $this->load->view('customer/login');
            $this->load->view('templates/footer_landingpage');
        }
    }

    /**
     * Halaman registrasi
     */
    public function register()
    {
        // Jika sudah login, redirect ke halaman produk
        if ($this->session->userdata('customer_logged_in')) {
            redirect('landing/product');
        }

        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Register';

        // Jika ada POST data
        if ($this->input->post()) {
            // Validasi input
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('nickname', 'Nama Panggilan', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[m_customer.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
            $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi gagal
                $this->load->view('templates/header_landingpage', $data);
                $this->load->view('customer/register');
                $this->load->view('templates/footer_landingpage');
            } else {
                // Data untuk disimpan
                $customer_data = [
                    'name' => $this->input->post('name'),
                    'nickname' => $this->input->post('nickname'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'status' => 1
                ];

                // Simpan data customer
                $id_customer = $this->Customer_model->register($customer_data);

                if ($id_customer) {
                    // Jika registrasi berhasil
                    $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
                    redirect('customer/login');
                } else {
                    // Jika registrasi gagal
                    $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi.');
                    redirect('customer/register');
                }
            }
        } else {
            // Tampilkan form registrasi
            $this->load->view('templates/header_landingpage', $data);
            $this->load->view('customer/register');
            $this->load->view('templates/footer_landingpage');
        }
    }

    /**
     * Halaman profil customer
     */
    public function profile()
    {
        // Cek apakah customer sudah login
        if (!$this->session->userdata('customer_logged_in')) {
            redirect('customer/login');
        }

        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Profil';

        // Ambil data customer
        $id_customer = $this->session->userdata('customer_id');
        $data['customer'] = $this->Customer_model->get_customer_by_id($id_customer);

        // Jika ada POST data
        if ($this->input->post()) {
            // Validasi input
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('nickname', 'Nama Panggilan', 'required');
            $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required|numeric');

            // Jika password diisi, validasi password
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'matches[password]');
            }

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi gagal
                $this->load->view('templates/header_landingpage', $data);
                $this->load->view('customer/profile');
                $this->load->view('templates/footer_landingpage');
            } else {
                // Data untuk diupdate
                $customer_data = [
                    'name' => $this->input->post('name'),
                    'nickname' => $this->input->post('nickname'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address')
                ];

                // Jika password diisi, tambahkan ke data
                if ($this->input->post('password')) {
                    $customer_data['password'] = $this->input->post('password');
                }

                // Update data customer
                $update = $this->Customer_model->update_customer($id_customer, $customer_data);

                if ($update) {
                    // Jika update berhasil
                    $this->session->set_flashdata('success', 'Profil berhasil diupdate.');
                    // Update session name
                    $this->session->set_userdata('customer_name', $customer_data['nickname'] ? $customer_data['nickname'] : $customer_data['name']);
                    redirect('customer/profile');
                } else {
                    // Jika update gagal
                    $this->session->set_flashdata('error', 'Update profil gagal. Silakan coba lagi.');
                    redirect('customer/profile');
                }
            }
        } else {
            // Tampilkan halaman profil
            $this->load->view('templates/header_landingpage', $data);
            $this->load->view('customer/profile');
            $this->load->view('templates/footer_landingpage');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        // Hapus session customer
        $this->session->unset_userdata('customer_logged_in');
        $this->session->unset_userdata('customer_id');
        $this->session->unset_userdata('customer_name');
        $this->session->unset_userdata('customer_email');

        // Redirect ke halaman login
        // redirect('customer/login');
        redirect('landing');
    }

    /**
     * Login via AJAX
     */
    public function ajax_login()
    {
        // Ambil data dari POST
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Validasi input
        if (empty($email) || empty($password)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email dan password harus diisi'
            ]);
            return;
        }

        // Coba login
        $customer = $this->Customer_model->login($email, $password);

        if ($customer) {
            // Jika login berhasil, set session
            $this->session->set_userdata([
                'customer_logged_in' => TRUE,
                'customer_id' => $customer->id_customer,
                'customer_name' => $customer->nickname ? $customer->nickname : $customer->name,
                'customer_email' => $customer->email
            ]);

            // Kirim response sukses
            echo json_encode([
                'status' => 'success',
                'message' => 'Login berhasil'
            ]);
        } else {
            // Jika login gagal
            echo json_encode([
                'status' => 'error',
                'message' => 'Email atau password salah'
            ]);
        }
    }

    /**
     * Register via AJAX
     */
    public function ajax_register()
    {
        // Ambil data dari POST
        $name = $this->input->post('name');
        $nickname = $this->input->post('nickname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');

        // Validasi input
        if (empty($name) || empty($nickname) || empty($email) || empty($password) || empty($confirm_password) || empty($phone)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Semua field harus diisi kecuali alamat'
            ]);
            return;
        }

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Format email tidak valid'
            ]);
            return;
        }

        // Validasi password
        if ($password !== $confirm_password) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Password dan konfirmasi password tidak sama'
            ]);
            return;
        }

        // Cek apakah email sudah terdaftar
        $existing_customer = $this->db->get_where('m_customer', ['email' => $email])->row();
        if ($existing_customer) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email sudah terdaftar'
            ]);
            return;
        }

        // Data untuk disimpan
        $customer_data = [
            'name' => $name,
            'nickname' => $nickname,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'address' => $address,
            'status' => 1
        ];

        // Simpan data customer
        $id_customer = $this->Customer_model->register($customer_data);

        if ($id_customer) {
            // Jika registrasi berhasil
            echo json_encode([
                'status' => 'success',
                'message' => 'Registrasi berhasil'
            ]);
        } else {
            // Jika registrasi gagal
            echo json_encode([
                'status' => 'error',
                'message' => 'Registrasi gagal. Silakan coba lagi.'
            ]);
        }
    }

    /**
     * Halaman lupa password
     */
    public function forgot_password()
    {
        // Jika sudah login, redirect ke halaman produk
        if ($this->session->userdata('customer_logged_in')) {
            redirect('landing/product');
        }

        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Lupa Password';

        // Jika ada POST data
        if ($this->input->post()) {
            $email = $this->input->post('email');

            // Validasi input
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi gagal
                $this->load->view('templates/header_landingpage', $data);
                $this->load->view('customer/forgot_password');
                $this->load->view('templates/footer_landingpage');
            } else {
                // Cek apakah email terdaftar
                $customer = $this->Customer_model->get_customer_by_email($email);

                if ($customer) {
                    // Buat token reset password
                    $token = $this->Customer_model->create_reset_token($email);

                    if ($token) {
                        // Kirim email reset password
                        $reset_link = base_url('customer/reset_password/' . $token);

                        // Konfigurasi email
                        $smtp_user = isset($config_array['company_email']) ? $config_array['company_email'] : 'info.balitreesco@gmail.com';
                        $smtp_pass = isset($config_array['company_email_password']) ? $config_array['company_email_password'] : 'password_email';
                        $company_name = isset($config_array['company_name']) ? $config_array['company_name'] : 'Bali Treesco';

                        $this->email->initialize([
                            'protocol' => 'smtp',
                            'smtp_host' => 'smtp.gmail.com',
                            'smtp_port' => 465,
                            'smtp_user' => $smtp_user,
                            'smtp_pass' => $smtp_pass,
                            'smtp_crypto' => 'ssl',
                            'mailtype' => 'html',
                            'charset' => 'utf-8',
                            'newline' => "\r\n",
                            'wordwrap' => TRUE,
                            'validate' => TRUE
                        ]);

                        $this->email->from($smtp_user, $company_name);
                        $this->email->to($email);
                        $this->email->subject('Reset Password');

                        // Isi email
                        $message = '
                        <html>
                        <head>
                            <title>Reset Password</title>
                        </head>
                        <body>
                            <h2>Reset Password</h2>
                            <p>Halo ' . $customer->name . ',</p>
                            <p>Kami menerima permintaan untuk reset password akun Anda. Silakan klik link di bawah ini untuk reset password:</p>
                            <p><a href="' . $reset_link . '">' . $reset_link . '</a></p>
                            <p>Link ini hanya berlaku selama 1 jam.</p>
                            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
                            <p>Terima kasih,<br>' . $company_name . '</p>
                        </body>
                        </html>';

                        $this->email->message($message);

                        // Coba kirim email
                        try {
                            if ($this->email->send()) {
                                $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda. Silakan cek email Anda.');
                            } else {
                                $this->session->set_flashdata('error', 'Gagal mengirim email reset password. Silakan coba lagi.');
                            }
                        } catch (Exception $e) {
                            $this->session->set_flashdata('error', 'Gagal mengirim email: ' . $e->getMessage());
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Gagal membuat token reset password. Silakan coba lagi.');
                    }
                } else {
                    // Jika email tidak terdaftar, tetap tampilkan pesan sukses untuk keamanan
                    $this->session->set_flashdata('success', 'Jika email terdaftar, link reset password akan dikirim ke email Anda.');
                }

                redirect('customer/forgot_password');
            }
        } else {
            // Tampilkan form lupa password
            $this->load->view('templates/header_landingpage', $data);
            $this->load->view('customer/forgot_password');
            $this->load->view('templates/footer_landingpage');
        }
    }

    /**
     * Halaman reset password
     */
    public function reset_password($token = NULL)
    {
        // Jika sudah login, redirect ke halaman produk
        if ($this->session->userdata('customer_logged_in')) {
            redirect('landing/product');
        }

        // Jika tidak ada token, redirect ke halaman lupa password
        if (!$token) {
            redirect('customer/forgot_password');
        }

        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Reset Password';
        $data['token'] = $token;

        // Validasi token
        $email = $this->Customer_model->validate_reset_token($token);

        if (!$email) {
            // Jika token tidak valid atau kadaluarsa
            $this->session->set_flashdata('error', 'Link reset password tidak valid atau sudah kadaluarsa. Silakan coba lagi.');
            redirect('customer/forgot_password');
        }

        // Jika ada POST data
        if ($this->input->post()) {
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

            // Validasi input
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi gagal
                $this->load->view('templates/header_landingpage', $data);
                $this->load->view('customer/reset_password', $data);
                $this->load->view('templates/footer_landingpage');
            } else {
                // Reset password
                $reset = $this->Customer_model->reset_password($email, $password);

                if ($reset) {
                    // Jika reset berhasil
                    $this->session->set_flashdata('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
                    redirect('customer/login');
                } else {
                    // Jika reset gagal
                    $this->session->set_flashdata('error', 'Gagal mereset password. Silakan coba lagi.');
                    redirect('customer/reset_password/' . $token);
                }
            }
        } else {
            // Tampilkan form reset password
            $this->load->view('templates/header_landingpage', $data);
            $this->load->view('customer/reset_password', $data);
            $this->load->view('templates/footer_landingpage');
        }
    }
}
