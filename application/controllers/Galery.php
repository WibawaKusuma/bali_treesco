<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galery extends CI_Controller
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
        $data['title'] = 'Galery';
        $data['galery'] = $this->General_model->get_data('m_galery')->result();

        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('galery/datatable', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create Galery';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('galery/form', $data);
        $this->load->view('templates/footer');
    }

    public function create_galery()
    {
        if ($this->input->post()) {
            $data = $this->input->post('p');

            // Konfigurasi upload
            $config['upload_path'] = './assets/img/galery';
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
            $this->General_model->insert_data($data, 'm_galery');
            $this->session->set_flashdata('success', 'Galery berhasil ditambahkan!');
            redirect('galery');
        } else {
            // Jika tidak ada data POST, tampilkan form
            $this->load->view('galery/form');
        }
    }

    public function update($id_galery)
    {
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post()) {
            $data = $this->input->post('p');
            $data['created_at'] = date('Y-m-d H:i:s'); // Set timestamp untuk update

            // Ambil data galery lama untuk mendapatkan nama file gambar yang lama
            $old_galery = $this->db->get_where('m_galery', ['id_galery' => $id_galery])->row();
            $old_image_path = './assets/img/galery/' . $old_galery->image; // Path gambar lama

            // Konfigurasi upload
            $config['upload_path'] = './assets/img/galery';
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
                $data['image'] = $old_galery->image; // Tetap menggunakan gambar lama
            }

            // Update data ke database
            $this->db->where('id_galery', $id_galery);
            $this->General_model->update($data, 'm_galery');

            // Set flashdata untuk notifikasi
            $this->session->set_flashdata('success', 'Galery berhasil diubah!');
            redirect('galery');
        } else {
            // Ambil data galery jika tidak ada post
            $data['galery'] = $this->db->get_where('m_galery', ['id_galery' => $id_galery])->row();
        }

        // Set judul dan load view
        $data['title'] = 'Edit Destination';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('galery/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id_galery)
    {
        // Hapus data berdasarkan NoReservasi
        $this->db->where('id_galery', $id_galery);
        $this->db->delete('m_galery');

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('success', 'Galery berhasil dihapus!');

        // Redirect ke halaman daftar reservasi
        redirect('galery');
    }
}
