<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
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
        $data['title'] = 'Team';
        $data['team'] = $this->General_model->get_data('m_team')->result();

        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('team/datatable', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create Team';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('team/form', $data);
        $this->load->view('templates/footer');
    }

    public function create_team()
    {
        if ($this->input->post()) {
            $data = $this->input->post('p');

            // Konfigurasi upload
            $config['upload_path'] = './assets/img/team';
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
            $this->General_model->insert_data($data, 'm_team');
            $this->session->set_flashdata('success', 'Team berhasil ditambahkan!');
            redirect('team');
        } else {
            // Jika tidak ada data POST, tampilkan form
            $this->load->view('team/form');
        }
    }

    public function update($id_team)
    {
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post()) {
            $data = $this->input->post('p');
            $data['created_at'] = date('Y-m-d H:i:s'); // Set timestamp untuk update

            // Ambil data team lama untuk mendapatkan nama file gambar yang lama
            $old_team = $this->db->get_where('m_team', ['id_team' => $id_team])->row();
            $old_image_path = './assets/img/team/' . $old_team->image; // Path gambar lama

            // Konfigurasi upload
            $config['upload_path'] = './assets/img/team';
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
                $data['image'] = $old_team->image; // Tetap menggunakan gambar lama
            }

            // Update data ke database
            $this->db->where('id_team', $id_team);

            // print_r($data);
            // exit;

            $this->General_model->update($data, 'm_team');

            // Set flashdata untuk notifikasi
            $this->session->set_flashdata('success', 'Team berhasil diubah!');
            redirect('team');
        } else {
            // Ambil data team jika tidak ada post
            $data['team'] = $this->db->get_where('m_team', ['id_team' => $id_team])->row();
        }

        // Set judul dan load view
        $data['title'] = 'Edit Team';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('team/form', $data);
        $this->load->view('templates/footer');


        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/topbar', $data);
        // $this->load->view('templates/sidebar_admin', $data);
        // $this->load->view('team/form', $data);
        // $this->load->view('templates/footer');
    }

    public function delete($id_team)
    {
        // Hapus data berdasarkan NoReservasi
        $this->db->where('id_team', $id_team);
        $this->db->delete('m_team');

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('success', 'Team berhasil dihapus!');

        // Redirect ke halaman daftar reservasi
        redirect('team');
    }
}
