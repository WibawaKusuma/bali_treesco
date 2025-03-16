<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('General_model');
    }

    public function index()
    {
        $data['title'] = 'Product';
        $data['product'] = $this->General_model->get_data('m_product')->result();

        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('product/datatable', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create Product';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('product/form', $data);
        $this->load->view('templates/footer');
    }

    public function create_product()
    {
        if ($this->input->post()) {
            $data = $this->input->post('p');

            // Konfigurasi upload
            $config['upload_path'] = './assets/img/product';
            $config['allowed_types'] = 'jpeg|jpg|png|gif'; // Pastikan jpg ditambahkan
            $config['file_name'] = $_FILES['image']['name']; // Menggunakan timestamp untuk menghindari nama file duplikat

            // Load library upload
            $this->load->library('upload', $config);

            // Cek apakah ada file yang di-upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Lakukan upload file
                if (!$this->upload->do_upload('image')) {
                    // Jika upload gagal
                    $error = $this->upload->display_errors();
                    echo "Upload image gagal! Error: " . $error;
                    die();
                } else {
                    // Jika upload berhasil
                    $upload_data = $this->upload->data(); // Ambil data file yang di-upload
                    $data['image'] = $upload_data['file_name']; // Simpan nama file ke data
                }
            } else {
                echo "Upload image gagal! Error: Tidak ada file yang dipilih atau file terlalu besar.";
                die();
            }

            // Tambahkan timestamp untuk CreatedAt dan UpdatedAt
            $data['created_at'] = date('Y-m-d H:i:s'); // Gunakan format datetime

            // Simpan ke database
            $this->General_model->insert_data($data, 'm_product');
            $this->session->set_flashdata('success', 'Product berhasil ditambahkan!');
            redirect('product');
        } else {
            // Jika tidak ada data POST, tampilkan form
            $this->load->view('product/form');
        }
    }

    public function update($id_product)
    {
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post()) {
            $data = $this->input->post('p');
            $data['created_at'] = date('Y-m-d H:i:s'); // Set timestamp untuk update

            // Ambil data product lama untuk mendapatkan nama file gambar yang lama
            $old_product = $this->db->get_where('m_product', ['id_product' => $id_product])->row();
            $old_image_path = './assets/img/product/' . $old_product->image; // Path gambar lama

            // Konfigurasi upload
            $config['upload_path'] = './assets/img/product';
            $config['allowed_types'] = 'jpeg|jpg|png|gif'; // Pastikan jpg ditambahkan
            $config['file_name'] = time() . '_' . $_FILES['image']['name']; // Nama file unik

            // Load library upload
            $this->load->library('upload', $config);

            // Cek apakah ada file yang di-upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Lakukan upload file
                if (!$this->upload->do_upload('image')) {
                    // Jika upload gagal
                    $error = $this->upload->display_errors();
                    echo "Upload image gagal! Error: " . $error;
                    die();
                } else {
                    // Jika upload berhasil
                    $upload_data = $this->upload->data(); // Ambil data file yang di-upload
                    $data['image'] = $upload_data['file_name']; // Simpan nama file ke data

                    // Hapus gambar lama jika ada
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path); // Hapus file gambar lama
                    }
                }
            } else {
                // Jika tidak ada gambar baru, tetap gunakan gambar lama
                $data['image'] = $old_product->image; // Tetap menggunakan gambar lama
            }

            // print_r($data);
            // exit;

            // Update data ke database
            $this->db->where('id_product', $id_product);
            $this->General_model->update($data, 'm_product');

            // Set flashdata untuk notifikasi
            $this->session->set_flashdata('success', 'Product berhasil diubah!');
            redirect('product');
        } else {
            // Ambil data product jika tidak ada post
            $data['product'] = $this->db->get_where('m_product', ['id_product' => $id_product])->row();
        }

        // Set judul dan load view
        $data['title'] = 'Edit Product';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('product/form', $data);
        $this->load->view('templates/footer');


        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/topbar', $data);
        // $this->load->view('templates/sidebar_admin', $data);
        // $this->load->view('product/form', $data);
        // $this->load->view('templates/footer');
    }

    public function delete($id_product)
    {
        // Hapus data berdasarkan NoReservasi
        $this->db->where('id_product', $id_product);
        $this->db->delete('m_product');

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('success', 'Product berhasil dihapus!');

        // Redirect ke halaman daftar reservasi
        redirect('product');
    }
}
