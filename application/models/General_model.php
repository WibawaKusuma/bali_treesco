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
}
