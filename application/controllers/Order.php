<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->model('General_model');
        $this->load->library('session');

        // Cek apakah customer sudah login
        if (!$this->session->userdata('customer_logged_in')) {
            redirect('customer/login');
        }
    }

    /**
     * Halaman daftar pesanan
     */
    public function index()
    {
        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Pesanan Saya';

        // Ambil data pesanan
        $id_customer = $this->session->userdata('customer_id');
        $data['orders'] = $this->Order_model->get_customer_orders($id_customer);

        // Tampilkan halaman daftar pesanan
        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('order/index');
        $this->load->view('templates/footer_landingpage');
    }

    /**
     * Halaman detail pesanan
     */
    public function detail($id_order)
    {
        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;
        $data['title'] = 'Detail Pesanan';

        // Ambil data pesanan
        $data['order'] = $this->Order_model->get_order_by_id($id_order);

        // Cek apakah pesanan milik customer yang login
        if (!$data['order'] || $data['order']->id_customer != $this->session->userdata('customer_id')) {
            $this->session->set_flashdata('error', 'Pesanan tidak ditemukan');
            redirect('order');
        }

        // Ambil detail pesanan
        $data['order_details'] = $this->Order_model->get_order_details($id_order);

        // Jika status selesai, ambil nomor invoice
        if ($data['order']->status === 'selesai') {
            $this->db->select('no_invoice');
            $this->db->from('tr_kasir');
            $this->db->where('id_order', $id_order);
            $invoice = $this->db->get()->row();

            if ($invoice) {
                $data['invoice'] = $invoice->no_invoice;
            }
        }

        // Tampilkan halaman detail pesanan
        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('order/detail');
        $this->load->view('templates/footer_landingpage');
    }

    /**
     * Batalkan pesanan
     */
    public function cancel($id_order)
    {
        // Ambil data pesanan
        $order = $this->Order_model->get_order_by_id($id_order);

        // Cek apakah pesanan milik customer yang login
        if (!$order || $order->id_customer != $this->session->userdata('customer_id')) {
            $this->session->set_flashdata('error', 'Pesanan tidak ditemukan');
            redirect('order');
        }

        // Cek apakah pesanan masih bisa dibatalkan (status proses)
        if ($order->status != 'proses') {
            $this->session->set_flashdata('error', 'Pesanan tidak dapat dibatalkan');
            redirect('order/detail/' . $id_order);
        }

        // Batalkan pesanan
        // Ubah status menjadi batal
        $result1 = $this->Order_model->update_order_status($id_order, 'batal');

        // Set kolom batal menjadi 1
        $result2 = $this->Order_model->cancel_order($id_order);

        // Set flashdata
        if ($result1 && $result2) {
            $this->session->set_flashdata('success', 'Pesanan berhasil dibatalkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal membatalkan pesanan');
        }

        // Redirect ke halaman detail pesanan
        redirect('order/detail/' . $id_order);
    }

    /**
     * Cetak invoice pesanan
     */
    public function print_invoice($id_order)
    {
        // Load library dan model yang diperlukan
        $this->load->library('pdf');
        $this->load->model('General_model');

        // Ambil data pesanan
        $this->db->select('o.*, c.name as customer_name, c.phone as customer_phone, c.address, k.no_invoice');
        $this->db->from('tr_order o');
        $this->db->join('m_customer c', 'o.id_customer = c.id_customer');
        $this->db->join('tr_kasir k', 'o.id_order = k.id_order', 'left');
        $this->db->where('o.id_order', $id_order);
        $data['order'] = $this->db->get()->row();

        // Cek apakah pesanan milik customer yang login
        if (!$data['order'] || $data['order']->id_customer != $this->session->userdata('customer_id')) {
            $this->session->set_flashdata('error', 'Pesanan tidak ditemukan');
            redirect('order');
        }

        // Cek apakah pesanan sudah selesai
        if ($data['order']->status !== 'selesai') {
            $this->session->set_flashdata('error', 'Invoice hanya tersedia untuk pesanan yang sudah selesai');
            redirect('order/detail/' . $id_order);
        }

        // Ambil detail pesanan
        $this->db->select('od.*, p.name');
        $this->db->from('tr_order_detail od');
        $this->db->join('m_product p', 'od.id_product = p.id_product');
        $this->db->where('od.id_order', $id_order);
        $data['order_details'] = $this->db->get()->result();

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

        // Set judul
        $data['title'] = 'Invoice';

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
