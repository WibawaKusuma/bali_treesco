<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek apakah user sudah login
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }

        // Load model yang diperlukan
        $this->load->model('Report_model');
        $this->load->model('General_model');

        // Load library untuk export
        $this->load->library('pdf');
    }

    /**
     * Halaman dashboard laporan
     */
    public function index()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil parameter tanggal dari form atau default ke bulan ini
        $from_date = $this->input->get('from_date') ? $this->input->get('from_date') : date('Y-m-01');
        $to_date = $this->input->get('to_date') ? $this->input->get('to_date') : date('Y-m-d');

        // Ambil data pendapatan
        $data['total_income'] = $this->Report_model->get_total_income($from_date, $to_date);
        $data['transaction_count'] = $this->Report_model->get_transaction_count($from_date, $to_date);
        $data['average_income'] = $this->Report_model->get_average_income($from_date, $to_date);
        $data['daily_income'] = $this->Report_model->get_daily_income($from_date, $to_date);

        // Ambil data produk terlaris
        $data['product_categories'] = $this->Report_model->get_product_categories($from_date, $to_date);

        // Hitung jumlah customer aktif
        $this->db->where('status', 1);
        $data['customer_count'] = $this->db->count_all_results('m_customer');

        // Hitung jumlah produk aktif
        $this->db->where('status', 1);
        $data['product_count'] = $this->db->count_all_results('m_product');

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('report/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Halaman laporan pendapatan
     */
    public function income()
    {
        $data['title'] = 'Laporan Pendapatan';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil parameter tanggal dari form atau default ke bulan ini
        $from_date = $this->input->get('from_date') ? $this->input->get('from_date') : date('Y-m-01');
        $to_date = $this->input->get('to_date') ? $this->input->get('to_date') : date('Y-m-d');

        // Simpan tanggal untuk form
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;

        // Ambil data laporan
        $data['income_data'] = $this->Report_model->get_income_report($from_date, $to_date);
        $data['total_income'] = $this->Report_model->get_total_income($from_date, $to_date);
        $data['transaction_count'] = $this->Report_model->get_transaction_count($from_date, $to_date);
        $data['average_income'] = $this->Report_model->get_average_income($from_date, $to_date);

        // Ambil data pendapatan harian
        $data['daily_income'] = $this->Report_model->get_daily_income($from_date, $to_date);

        // Jika tidak ada data pendapatan harian, buat data dummy untuk grafik
        if (empty($data['daily_income'])) {
            // Buat array tanggal dari from_date sampai to_date
            $period = new DatePeriod(
                new DateTime($from_date),
                new DateInterval('P1D'),
                (new DateTime($to_date))->modify('+1 day')
            );

            $dummy_data = [];
            foreach ($period as $date) {
                $dummy_data[] = (object)[
                    'date' => $date->format('Y-m-d'),
                    'total' => 0
                ];
            }

            $data['daily_income'] = $dummy_data;
        }

        // Ambil data kategori produk
        $data['product_categories'] = $this->Report_model->get_product_categories($from_date, $to_date);

        // Debug: Tampilkan data produk
        // echo '<pre>'; print_r($data['product_categories']); echo '</pre>'; exit;

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('report/income', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Export laporan ke PDF
     */
    public function export_pdf()
    {
        // Ambil parameter tanggal dari form atau default ke bulan ini
        $from_date = $this->input->get('from_date') ? $this->input->get('from_date') : date('Y-m-01');
        $to_date = $this->input->get('to_date') ? $this->input->get('to_date') : date('Y-m-d');

        // Ambil data laporan
        $data['income_data'] = $this->Report_model->get_income_report($from_date, $to_date);
        $data['total_income'] = $this->Report_model->get_total_income($from_date, $to_date);
        $data['transaction_count'] = $this->Report_model->get_transaction_count($from_date, $to_date);
        $data['average_income'] = $this->Report_model->get_average_income($from_date, $to_date);

        // Format tanggal untuk judul
        $data['from_date_formatted'] = date('d-m-Y', strtotime($from_date));
        $data['to_date_formatted'] = date('d-m-Y', strtotime($to_date));

        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $data['config'] = $config_array;

        // Load view untuk PDF
        $html = $this->load->view('report/pdf_template', $data, true);

        // Buat PDF
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->loadHtml($html);
        $this->pdf->render();

        // Output PDF - Attachment true untuk download, false untuk preview di browser
        $this->pdf->stream("laporan_pendapatan_" . date('Ymd') . ".pdf", ['Attachment' => true, 'compress' => true]);
    }

    /**
     * Halaman laporan customer
     */
    public function customer()
    {
        $data['title'] = 'Laporan Customer';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil data customer
        $this->db->select('c.*, COUNT(o.id_order) as total_orders, SUM(k.total_price) as total_spent');
        $this->db->from('m_customer c');
        $this->db->join('tr_order o', 'c.id_customer = o.id_customer', 'left');
        $this->db->join('tr_kasir k', 'o.id_order = k.id_order', 'left');
        $this->db->where('c.status', 1);
        $this->db->group_by('c.id_customer');
        $this->db->order_by('total_spent', 'DESC');
        $data['customers'] = $this->db->get()->result();

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('report/customer', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Export laporan ke Excel
     */
    public function export_excel()
    {
        // Ambil parameter tanggal dari form atau default ke bulan ini
        $from_date = $this->input->get('from_date') ? $this->input->get('from_date') : date('Y-m-01');
        $to_date = $this->input->get('to_date') ? $this->input->get('to_date') : date('Y-m-d');

        // Ambil data laporan
        $income_data = $this->Report_model->get_income_report($from_date, $to_date);
        $total_income = $this->Report_model->get_total_income($from_date, $to_date);

        // Format tanggal untuk judul
        $from_date_formatted = date('d-m-Y', strtotime($from_date));
        $to_date_formatted = date('d-m-Y', strtotime($to_date));

        // Gunakan metode alternatif untuk export Excel
        // Buat file CSV sementara
        $temp_file = tempnam(sys_get_temp_dir(), 'excel_');
        $file = fopen($temp_file, 'w');

        // Ambil data konfigurasi
        $config_data = $this->General_model->get_config('config')->result();
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }
        $company_name = isset($config_array['company_name']) ? $config_array['company_name'] : 'Bali Treesco';

        // Tulis header
        fputcsv($file, [strtoupper($company_name)]);
        fputcsv($file, ['LAPORAN PENDAPATAN']);
        fputcsv($file, ['Periode: ' . $from_date_formatted . ' s/d ' . $to_date_formatted]);
        fputcsv($file, []); // Baris kosong

        // Header tabel
        fputcsv($file, ['No', 'No. Invoice', 'No. Pesanan', 'Tanggal', 'Nama Customer', 'Kasir', 'Total']);

        // Isi data
        $no = 1;
        $total = 0;

        foreach ($income_data as $data) {
            fputcsv($file, [
                $no,
                $data->no_invoice,
                $data->order_number,
                date('d-m-Y H:i', strtotime($data->created_at)),
                $data->customer_name,
                $data->user_name,
                $data->total_price // Gunakan nilai asli tanpa format
            ]);

            $total += $data->total_price;
            $no++;
        }

        // Total
        fputcsv($file, ['', '', '', '', '', 'TOTAL', $total_income]); // Gunakan nilai asli tanpa format
        fputcsv($file, []); // Baris kosong

        // Informasi tambahan
        fputcsv($file, ['Informasi Tambahan:']);
        fputcsv($file, ['Jumlah Transaksi:', $this->Report_model->get_transaction_count($from_date, $to_date)]);
        fputcsv($file, ['Rata-rata Transaksi:', $this->Report_model->get_average_income($from_date, $to_date)]); // Gunakan nilai asli tanpa format
        fputcsv($file, ['Tanggal Cetak:', date('d-m-Y H:i:s')]);

        fclose($file);

        // Set header untuk download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="laporan_pendapatan_' . date('Ymd') . '.csv"');
        header('Cache-Control: max-age=0');

        // Output file
        readfile($temp_file);
        unlink($temp_file); // Hapus file sementara
        exit;
    }
}
