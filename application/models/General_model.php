<?php
defined('BASEPATH') or exit('No direct script access allowed');

class General_model extends CI_Model
{

    public function get_config($table)
    {
        return $this->db->get($table);
    }

    public function get_armada($table)
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

    public function delete($id_armada)
    {
        $this->db->where('id_armada', $id_armada);
        return $this->db->delete('marmada');
    }


    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_order($data)
    {
        return $this->db->insert('tr_selling', $data);
    }

    public function cancelSelling($id_selling)
    {
        if (!$id_selling) {
            return false;
        }

        $this->db->where('id_selling', $id_selling);
        return $this->db->update('tr_selling', ['batal' => 1]);
    }

    public function get_by_selling_id($id)
    {
        return $this->db
            ->select('a.id_selling, 
                  a.name, 
                  a.created_at as tgl_order,
                  a.customer_name, 
                  a.customer_phone, 
                  a.status, 
                  b.qty, 
                  b.created_at as tgl_proses,
                  b.total_price')
            ->from('tr_selling a')  // Alias 'a' untuk tabel tr_selling
            ->join('tr_kasir b', 'a.id_selling = b.id_selling', 'left')  // Alias 'b' untuk tabel tr_kasir
            ->where('a.id_selling', $id)
            ->get()
            ->row();  // Ambil hanya satu hasil
    }

    public function get_by_email($email)
    {
        return $this->db->select('u.id_user, u.name, u.email, u.password, u.status, u.id_role, r.name as role_name')
            ->from('m_user u')
            ->join('m_role r', 'u.id_role = r.id') // Menggabungkan tabel roles
            ->where('u.email', $email)
            ->get()
            ->row_array();
    }


    // public function get_by_selling_id($id)
    // {
    //     return $this->db
    //         ->select('a.id_selling, 
    //     a.name, 
    //     a.created_at as tgl_order, 
    //     a.customer_name, 
    //     a.customer_phone, 
    //     a.status, 
    //     b.qty, 
    //     b.created_at as tgl_proses, 
    //     b.total_price')
    //         ->from('tr_selling a')
    //         ->join('tr_kasir b', 'a.id_selling = b.id_selling', 'left')
    //         ->where('a.id_selling', $id)
    //         ->get()
    //         ->row();
    //     // ->result();
    // }
}
