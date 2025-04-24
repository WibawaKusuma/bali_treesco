<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function get_user($table)
    {
        return $this->db->get($table);
    }

    public function get_role($table)
    {
        return $this->db->get($table);
    }

    public function get_company($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update($data, $table)
    {
        $this->db->update($table, $data);
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('m_user', ['id_user' => $id])->row_array(); // sesuaikan nama tabel & kolom
    }

    public function update_user($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('m_user', $data);
    }

    // Fungsi untuk mengupdate data user
    public function update_data($id_user, $data)
    {
        // Pastikan ID user ada
        if (empty($id_user) || empty($data)) {
            return false; // Jika tidak ada data atau ID user
        }

        // Hash password jika ada perubahan password
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']); // Jangan update password jika kosong
        }

        // Tambahkan timestamp updated_at
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Update data di tabel m_user berdasarkan ID user
        $this->db->where('id_user', $id_user);
        $update = $this->db->update('m_user', $data);

        return $update;
    }
}
