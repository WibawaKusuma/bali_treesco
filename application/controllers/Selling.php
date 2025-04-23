<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Selling extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_admin();

        $this->load->library('session');

        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('General_model');
    }

    public function index()
    {
        $data['title'] = 'Selling';
        $data['selling'] = $this->General_model->get_data('tr_selling')->result();

        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('selling/datatable', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create Selling';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('selling/form', $data);
        $this->load->view('templates/footer');
    }

    public function create_selling()
    {
        if ($this->input->post()) {
            $data = $this->input->post('p');

            // Konfigurasi upload
            $config['upload_path'] = './assets/img/selling';
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
            $this->General_model->insert_data($data, 'm_selling');
            $this->session->set_flashdata('success', 'selling berhasil ditambahkan!');
            redirect('selling');
        } else {
            // Jika tidak ada data POST, tampilkan form
            $this->load->view('selling/form');
        }
    }

    public function update($id_selling)
    {
        $user = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post()) {
            $input = $this->input->post('p'); // Jangan timpa $data
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['status'] = 1;
            $input['batal'] = 0;

            // Update ke tabel utama
            $this->db->where('id_selling', $id_selling);
            $this->General_model->update($input, 'tr_selling');

            // Tambahkan ke tabel tr_kasir
            $kasir = [
                'id_selling'   => $id_selling,
                'qty'          => $input['qty'],
                'total_price'  => $input['total_price'],
                'id_user'      => $user['id_user'], // pakai dari variabel $user
                'created_at'   => date('Y-m-d H:i:s'),
                'status'       => 1
            ];

            $this->db->insert('tr_kasir', $kasir);

            $this->session->set_flashdata('success', 'Selling berhasil diubah!');
            redirect('selling');
        } else {
            $data['user'] = $user;
            $data['selling'] = $this->db->get_where('tr_selling', ['id_selling' => $id_selling])->row();
        }
        // print_r($data);
        // exit;
        $data['title'] = 'Edit Selling';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('selling/form', $data);
        $this->load->view('templates/footer');
    }


    public function delete($id_selling)
    {
        // Hapus data berdasarkan NoReservasi
        $this->db->where('id_selling', $id_selling);
        $this->db->delete('m_selling');

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('success', 'Selling berhasil dihapus!');

        // Redirect ke halaman daftar reservasi
        redirect('selling');
    }

    public function cancel($id_selling)
    {
        if (!$id_selling) {
            show_404();
        }

        $cancel = $this->General_model->cancelSelling($id_selling);

        if ($cancel) {
            $this->session->set_flashdata('success', 'Transaksi berhasil dibatalkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal membatalkan transaksi.');
        }

        redirect('selling');
    }

    public function print_nota($id)
    {
        $this->load->model('General_model');
        $this->load->library('pdf');

        $data['title'] = 'Invoice';
        $data['selling'] = $this->General_model->get_by_selling_id($id);

        $config_data = $this->General_model->get_config('config')->result();

        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        $data['config'] = $config_array;

        if (!$data['selling']) {
            show_404();
        }

        $html = $this->load->view('selling/print/invoice.php', $data, true);

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();

        // false = preview di browser, true = langsung download
        $this->pdf->stream("nota-$id.pdf", array("Attachment" => false));
    }
}
