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

        // Ambil data pesanan dari tr_order dan gabungkan dengan data customer
        $this->db->select('o.*, c.name as customer_name, c.phone as customer_phone');
        $this->db->from('tr_order o');
        $this->db->join('m_customer c', 'o.id_customer = c.id_customer');
        $this->db->where('o.batal', 0); // Hanya ambil yang tidak dibatalkan
        $this->db->order_by('o.created_at', 'DESC');
        $data['selling'] = $this->db->get()->result();

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

    public function update($id_order)
    {
        $user = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post()) {
            // Load model General_model
            $this->load->model('General_model');

            // Generate nomor invoice otomatis
            $no_invoice = $this->General_model->generate_invoice_number();

            // Ambil data dari form
            $qty = $this->input->post('p[qty]');
            $total_price = $this->input->post('p[total_price]');
            $shipping_cost = $this->input->post('p[shipping_cost]') ? $this->input->post('p[shipping_cost]') : 0;

            // Update status pesanan menjadi 'selesai'
            $this->db->where('id_order', $id_order);
            $this->db->update('tr_order', [
                'status' => 'selesai',
                'total_price' => $total_price, // Update total price berdasarkan input form
                'shipping_cost' => $shipping_cost, // Tambahkan ongkir
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Update detail order jika ada perubahan qty
            if ($this->input->post('item_qty')) {
                $item_qty = $this->input->post('item_qty');

                foreach ($item_qty as $id_detail => $new_qty) {
                    // Ambil data detail order
                    $detail = $this->db->get_where('tr_order_detail', ['id_order_detail' => $id_detail])->row();

                    if ($detail) {
                        // Hitung subtotal baru
                        $subtotal = $detail->price * $new_qty;

                        // Update qty dan subtotal
                        $this->db->where('id_order_detail', $id_detail);
                        $this->db->update('tr_order_detail', [
                            'qty' => $new_qty,
                            'subtotal' => $subtotal
                        ]);
                    }
                }
            }

            // Tambahkan ke tabel tr_kasir untuk pencatatan
            $kasir = [
                'id_order'     => $id_order,
                'no_invoice'   => $no_invoice,
                'qty'          => $qty,
                'total_price'  => $total_price,
                'shipping_cost' => $shipping_cost,
                'id_user'      => $user['id_user'],
                'created_at'   => date('Y-m-d H:i:s'),
                'status'       => 1
            ];

            $this->db->insert('tr_kasir', $kasir);

            // Simpan nomor invoice ke session untuk ditampilkan
            $this->session->set_flashdata('invoice_number', $no_invoice);

            $this->session->set_flashdata('success', 'Pesanan berhasil diproses!');
            redirect('selling');
        } else {
            // Ambil data order dan customer
            $this->db->select('o.*, c.name as customer_name, c.phone as customer_phone');
            $this->db->from('tr_order o');
            $this->db->join('m_customer c', 'o.id_customer = c.id_customer');
            $this->db->where('o.id_order', $id_order);
            $data['selling'] = $this->db->get()->row();

            // Jika tidak ada data, tampilkan 404
            if (!$data['selling']) {
                show_404();
            }

            // Ambil detail pesanan dari tr_order_detail
            $this->db->select('od.*, p.name, p.image');
            $this->db->from('tr_order_detail od');
            $this->db->join('m_product p', 'od.id_product = p.id_product');
            $this->db->where('od.id_order', $id_order);
            $data['order_details'] = $this->db->get()->result();

            // Ambil total qty dari order_detail
            $this->db->select_sum('qty');
            $this->db->from('tr_order_detail');
            $this->db->where('id_order', $id_order);
            $qty_result = $this->db->get()->row();

            // Tambahkan qty ke data selling
            $data['selling']->qty = $qty_result->qty;

            // Ambil informasi produk pertama untuk ditampilkan di form
            if (!empty($data['order_details'])) {
                $first_product = $data['order_details'][0];
                $data['selling']->name = $first_product->name;
                $data['selling']->price = $first_product->price;
            }

            // Simpan status asli dari tr_order
            $data['selling']->original_status = $data['selling']->status;

            // Set status untuk kompatibilitas dengan view lama
            if ($data['selling']->status == 'proses') {
                $data['selling']->status = 0;
            } elseif ($data['selling']->status == 'batal') {
                $data['selling']->status = 0;
                $data['selling']->batal = 1;
            } else {
                $data['selling']->status = 1;
            }

            $data['selling']->batal = ($data['selling']->batal == 1) ? 1 : 0;

            // Set id_selling untuk kompatibilitas dengan view
            $data['selling']->id_selling = $id_order;
            $data['selling']->order_number = $data['selling']->order_number;

            $data['user'] = $user;
        }

        $data['title'] = 'Proses Pesanan';
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

    public function cancel($id_order)
    {
        if (!$id_order) {
            show_404();
        }

        // Cek apakah pesanan sudah selesai
        $order = $this->db->get_where('tr_order', ['id_order' => $id_order])->row();

        if ($order && $order->status === 'selesai') {
            $this->session->set_flashdata('error', 'Pesanan yang sudah selesai tidak dapat dibatalkan.');
            redirect('selling');
            return;
        }

        // Update status pesanan menjadi 'batal' dan set batal = 1
        $this->db->where('id_order', $id_order);
        $result = $this->db->update('tr_order', [
            'status' => 'batal',
            'batal' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if ($result) {
            $this->session->set_flashdata('success', 'Pesanan berhasil dibatalkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal membatalkan pesanan.');
        }

        redirect('selling');
    }

    public function print_nota($id_order)
    {
        $this->load->model('General_model');
        $this->load->library('pdf');

        $data['title'] = 'Invoice';

        // Ambil data order, customer, dan nomor invoice
        $this->db->select('o.*, c.name as customer_name, c.phone as customer_phone, c.address, k.no_invoice');
        $this->db->from('tr_order o');
        $this->db->join('m_customer c', 'o.id_customer = c.id_customer');
        $this->db->join('tr_kasir k', 'o.id_order = k.id_order', 'left');
        $this->db->where('o.id_order', $id_order);
        $data['order'] = $this->db->get()->row();

        if (!$data['order']) {
            show_404();
        }

        // Ambil detail order
        $this->db->select('od.*, p.name, p.image, p.price');
        $this->db->from('tr_order_detail od');
        $this->db->join('m_product p', 'od.id_product = p.id_product');
        $this->db->where('od.id_order', $id_order);
        $data['order_details'] = $this->db->get()->result();

        // Hitung subtotal untuk setiap item jika belum ada
        foreach ($data['order_details'] as $item) {
            if (!isset($item->subtotal)) {
                $item->subtotal = $item->price * $item->qty;
            }
        }

        // Format data untuk kompatibilitas dengan template invoice
        $data['selling'] = new stdClass();
        $data['selling']->id_selling = $id_order;
        $data['selling']->tgl_order = $data['order']->created_at;
        $data['selling']->customer_name = $data['order']->customer_name;
        $data['selling']->customer_phone = $data['order']->customer_phone;
        $data['selling']->status = $data['order']->status;
        $data['selling']->total_price = $data['order']->total_price;

        // Gunakan updated_at jika ada, jika tidak gunakan created_at
        $data['selling']->tgl_proses = !empty($data['order']->updated_at) && $data['order']->updated_at != $data['order']->created_at
            ? $data['order']->updated_at
            : $data['order']->created_at;

        // Hitung total qty
        $total_qty = 0;
        foreach ($data['order_details'] as $item) {
            $total_qty += $item->qty;
        }
        $data['selling']->qty = $total_qty;

        // Ambil konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;

        // Set opsi PDF
        $html = $this->load->view('selling/print/invoice.php', $data, true);

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();

        // Nama file yang lebih deskriptif
        $filename = "Invoice-" . $data['order']->order_number . ".pdf";

        // false = preview di browser, true = langsung download
        $this->pdf->stream($filename, array("Attachment" => false));
    }
}
