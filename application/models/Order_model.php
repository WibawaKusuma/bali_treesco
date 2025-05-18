<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Mendapatkan data order berdasarkan ID
     *
     * @param int $id_order ID order
     * @return object|bool Data order jika ditemukan, FALSE jika tidak
     */
    public function get_order_by_id($id_order)
    {
        $this->db->where('id_order', $id_order);
        $query = $this->db->get('tr_order');

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return FALSE;
    }

    /**
     * Mendapatkan detail order
     *
     * @param int $id_order ID order
     * @return array Data detail order
     */
    public function get_order_details($id_order)
    {
        $this->db->select('tod.*, mp.name, mp.image');
        $this->db->from('tr_order_detail tod');
        $this->db->join('m_product mp', 'tod.id_product = mp.id_product');
        $this->db->where('tod.id_order', $id_order);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Mendapatkan semua order customer
     *
     * @param int $id_customer ID customer
     * @return array Data order
     */
    public function get_customer_orders($id_customer)
    {
        $this->db->where('id_customer', $id_customer);
        $this->db->where('batal', 0); // Hanya tampilkan yang tidak dibatalkan
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('tr_order');

        return $query->result();
    }

    /**
     * Mengupdate status order
     *
     * @param int $id_order ID order
     * @param string $status Status baru
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function update_order_status($id_order, $status)
    {
        $this->db->where('id_order', $id_order);
        $this->db->update('tr_order', [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->db->affected_rows() > 0;
    }

    /**
     * Membatalkan pesanan dengan mengubah kolom batal menjadi 1
     *
     * @param int $id_order ID order
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function cancel_order($id_order)
    {
        $this->db->where('id_order', $id_order);
        $this->db->update('tr_order', [
            'batal' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->db->affected_rows() > 0;
    }
}
