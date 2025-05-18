<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->model('General_model');
        $this->load->model('Order_model');
        $this->load->library('session');
        
        // Cek apakah customer sudah login
        if (!$this->session->userdata('customer_logged_in')) {
            redirect('customer/login');
        }
    }

    /**
     * Halaman keranjang belanja
     */
    public function index() {
        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Keranjang Belanja';

        // Ambil data keranjang
        $id_customer = $this->session->userdata('customer_id');
        $data['cart_items'] = $this->Cart_model->get_cart($id_customer);
        $data['total_price'] = $this->Cart_model->get_total($id_customer);

        // Tampilkan halaman keranjang
        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('cart/index');
        $this->load->view('templates/footer_landingpage');
    }

    /**
     * Tambah produk ke keranjang
     */
    public function add() {
        // Ambil data dari POST
        $id_product = $this->input->post('id_product');
        $qty = $this->input->post('qty', TRUE) ? $this->input->post('qty') : 1;
        $id_customer = $this->session->userdata('customer_id');

        // Tambahkan ke keranjang
        $result = $this->Cart_model->add_to_cart($id_customer, $id_product, $qty);

        // Response JSON
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan ke keranjang'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menambahkan produk ke keranjang'
            ]);
        }
    }

    /**
     * Update jumlah produk di keranjang
     */
    public function update() {
        // Ambil data dari POST
        $id_cart = $this->input->post('id_cart');
        $qty = $this->input->post('qty');

        // Update keranjang
        $result = $this->Cart_model->update_cart($id_cart, $qty);

        // Response JSON
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Keranjang berhasil diupdate'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal mengupdate keranjang'
            ]);
        }
    }

    /**
     * Hapus produk dari keranjang
     */
    public function remove($id_cart) {
        // Hapus dari keranjang
        $result = $this->Cart_model->remove_from_cart($id_cart);

        // Set flashdata
        if ($result) {
            $this->session->set_flashdata('success', 'Produk berhasil dihapus dari keranjang');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produk dari keranjang');
        }

        // Redirect ke halaman keranjang
        redirect('cart');
    }

    /**
     * Kosongkan keranjang
     */
    public function clear() {
        // Kosongkan keranjang
        $id_customer = $this->session->userdata('customer_id');
        $result = $this->Cart_model->clear_cart($id_customer);

        // Set flashdata
        if ($result) {
            $this->session->set_flashdata('success', 'Keranjang berhasil dikosongkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengosongkan keranjang');
        }

        // Redirect ke halaman keranjang
        redirect('cart');
    }

    /**
     * Checkout
     */
    public function checkout() {
        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Checkout';

        // Ambil data keranjang
        $id_customer = $this->session->userdata('customer_id');
        $data['cart_items'] = $this->Cart_model->get_cart($id_customer);
        $data['total_price'] = $this->Cart_model->get_total($id_customer);

        // Jika keranjang kosong, redirect ke halaman keranjang
        if (empty($data['cart_items'])) {
            $this->session->set_flashdata('error', 'Keranjang belanja kosong');
            redirect('cart');
        }

        // Jika ada POST data
        if ($this->input->post()) {
            // Proses checkout
            $id_order = $this->Cart_model->checkout($id_customer);

            if ($id_order) {
                // Jika checkout berhasil
                $this->session->set_flashdata('success', 'Pesanan berhasil dibuat. Terima kasih telah berbelanja!');
                redirect('order/detail/' . $id_order);
            } else {
                // Jika checkout gagal
                $this->session->set_flashdata('error', 'Checkout gagal. Silakan coba lagi.');
                redirect('cart/checkout');
            }
        } else {
            // Tampilkan halaman checkout
            $this->load->view('templates/header_landingpage', $data);
            $this->load->view('cart/checkout');
            $this->load->view('templates/footer_landingpage');
        }
    }

    /**
     * Mendapatkan jumlah item di keranjang (untuk AJAX)
     */
    public function count_items() {
        $id_customer = $this->session->userdata('customer_id');
        $count = $this->Cart_model->count_items($id_customer);

        echo json_encode(['count' => $count]);
    }
}
