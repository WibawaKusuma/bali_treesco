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
}
