<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Menambahkan produk ke keranjang
     *
     * @param int $id_customer ID customer
     * @param int $id_product ID produk
     * @param int $qty Jumlah produk
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function add_to_cart($id_customer, $id_product, $qty = 1)
    {
        // Cek apakah produk sudah ada di keranjang
        $this->db->where('id_customer', $id_customer);
        $this->db->where('id_product', $id_product);
        $query = $this->db->get('tr_cart');

        if ($query->num_rows() > 0) {
            // Jika sudah ada, update qty
            $cart_item = $query->row();
            $new_qty = $cart_item->qty + $qty;

            $this->db->where('id_cart', $cart_item->id_cart);
            $this->db->update('tr_cart', [
                'qty' => $new_qty,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            // Jika belum ada, tambahkan baru
            $this->db->insert('tr_cart', [
                'id_customer' => $id_customer,
                'id_product' => $id_product,
                'qty' => $qty,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $this->db->affected_rows() > 0;
    }

    /**
     * Mengupdate jumlah produk di keranjang
     *
     * @param int $id_cart ID keranjang
     * @param int $qty Jumlah produk baru
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function update_cart($id_cart, $qty)
    {
        $this->db->where('id_cart', $id_cart);
        $this->db->update('tr_cart', [
            'qty' => $qty,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->db->affected_rows() > 0;
    }

    /**
     * Menghapus produk dari keranjang
     *
     * @param int $id_cart ID keranjang
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function remove_from_cart($id_cart)
    {
        $this->db->where('id_cart', $id_cart);
        $this->db->delete('tr_cart');

        return $this->db->affected_rows() > 0;
    }

    /**
     * Mengosongkan keranjang customer
     *
     * @param int $id_customer ID customer
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function clear_cart($id_customer)
    {
        $this->db->where('id_customer', $id_customer);
        $this->db->delete('tr_cart');

        return $this->db->affected_rows() > 0;
    }

    /**
     * Mendapatkan isi keranjang customer
     *
     * @param int $id_customer ID customer
     * @return array Data keranjang
     */
    public function get_cart($id_customer)
    {
        $this->db->select('tc.*, mp.name, mp.price, mp.image, (mp.price * tc.qty) as subtotal');
        $this->db->from('tr_cart tc');
        $this->db->join('m_product mp', 'tc.id_product = mp.id_product');
        $this->db->where('tc.id_customer', $id_customer);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Menghitung total item di keranjang
     *
     * @param int $id_customer ID customer
     * @return int Jumlah item di keranjang
     */
    public function count_items($id_customer)
    {
        $this->db->select('SUM(qty) as total_items');
        $this->db->where('id_customer', $id_customer);
        $query = $this->db->get('tr_cart');

        if ($query->num_rows() > 0) {
            return (int) $query->row()->total_items;
        }

        return 0;
    }

    /**
     * Menghitung total harga di keranjang
     *
     * @param int $id_customer ID customer
     * @return float Total harga
     */
    public function get_total($id_customer)
    {
        $this->db->select('SUM(mp.price * tc.qty) as total_price');
        $this->db->from('tr_cart tc');
        $this->db->join('m_product mp', 'tc.id_product = mp.id_product');
        $this->db->where('tc.id_customer', $id_customer);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return (float) $query->row()->total_price;
        }

        return 0;
    }

    /**
     * Membuat order dari keranjang
     *
     * @param int $id_customer ID customer
     * @return int|bool ID order jika berhasil, FALSE jika gagal
     */
    public function checkout($id_customer)
    {
        // Mulai transaksi database
        $this->db->trans_start();

        // Ambil data keranjang
        $cart_items = $this->get_cart($id_customer);

        if (empty($cart_items)) {
            return FALSE;
        }

        // Hitung total harga
        $total_price = $this->get_total($id_customer);

        // Buat nomor order
        $order_number = 'ORD-' . date('YmdHis') . '-' . $id_customer;

        // Insert ke tabel order
        $order_data = [
            'id_customer' => $id_customer,
            'order_number' => $order_number,
            'total_price' => $total_price,
            'status' => 'proses',
            'batal' => 0, // Default tidak dibatalkan
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('tr_order', $order_data);
        $id_order = $this->db->insert_id();

        // Insert ke tabel order detail
        foreach ($cart_items as $item) {
            $order_detail = [
                'id_order' => $id_order,
                'id_product' => $item->id_product,
                'qty' => $item->qty,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('tr_order_detail', $order_detail);
        }

        // Kosongkan keranjang
        $this->clear_cart($id_customer);

        // Selesai transaksi
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return $id_order;
    }
}
