<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Menyimpan data feedback ke database
     * 
     * @param array $data Data feedback yang akan disimpan
     * @return int|bool ID feedback jika berhasil, FALSE jika gagal
     */
    public function save_feedback($data) {
        $this->db->insert('feedback', $data);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        
        return FALSE;
    }

    /**
     * Memperbarui status pengiriman email
     * 
     * @param int $id ID feedback
     * @param bool $is_sent Status pengiriman (TRUE jika terkirim, FALSE jika gagal)
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function update_sent_status($id, $is_sent) {
        $this->db->where('id', $id);
        $this->db->update('feedback', ['is_sent' => $is_sent ? 1 : 0]);
        
        return $this->db->affected_rows() > 0;
    }

    /**
     * Mengambil semua data feedback
     * 
     * @param int $limit Batas jumlah data yang diambil
     * @param int $offset Offset data
     * @return array Data feedback
     */
    public function get_all_feedback($limit = 10, $offset = 0) {
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('feedback', $limit, $offset);
        
        return $query->result();
    }

    /**
     * Mengambil data feedback berdasarkan ID
     * 
     * @param int $id ID feedback
     * @return object|null Data feedback
     */
    public function get_feedback_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('feedback');
        
        return $query->row();
    }

    /**
     * Menghapus data feedback
     * 
     * @param int $id ID feedback
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function delete_feedback($id) {
        $this->db->where('id', $id);
        $this->db->delete('feedback');
        
        return $this->db->affected_rows() > 0;
    }
}
