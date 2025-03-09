<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function get_acaravote($table)
    {
        return $this->db->get($table);
    }

    public function save_vote($data)
    {
        $this->db->insert('mAcaraVote', $data);
        return $this->db->affected_rows() > 0;
    }

    public function update_vote($no_acara, $data)
    {
        $this->db->where('no_acara', $no_acara);
        return $this->db->update('mAcaraVote', $data);
    }

    public function get_vote_by_no_acara($no_acara)
    {
        $this->db->where('no_acara', $no_acara);
        $query = $this->db->get('mAcaraVote');
        return $query->row();
    }

    public function save_vote_detail($data)
    {
        $this->db->insert('mAcaraVoteDetail', $data);
        return $this->db->affected_rows() > 0;
    }

    public function get_last_insert_id()
    {
        return $this->db->insert_id();
    }

    public function generate_reservation_number()
    {
        $today = date('Ymd');

        $this->db->like('no_acara', 'VOTE-' . $today, 'after');
        $this->db->order_by('no_acara', 'DESC');
        $last_reservation = $this->db->get('mAcaraVote')->row();

        if ($last_reservation) {
            $last_number = intval(substr($last_reservation->no_acara, -3)) + 1;
            $no_acara = 'VOTE-' . $today . '-' . sprintf('%03d', $last_number);
        } else {
            $no_acara = 'VOTE-' . $today . '-001';
        }
        return $no_acara;
    }

    public function get_detail_kandidat($no_acara)
    {
        $this->db->select('a.*');
        $this->db->from('macaravotedetail a');
        $this->db->join('macaravote b', 'b.no_acara = a.no_acara', 'inner');
        $this->db->where('b.no_acara', $no_acara);
        $query = $this->db->get();

        return $query->result();
    }

    public function delete_kandidat($id_detail)
    {
        $this->db->where('id_detail', $id_detail);
        return $this->db->delete('mAcaraVoteDetail');
    }

    public function get_all($table)
    {
        return $this->db->get($table);
    }

    public function get_prodi()
    {
        $this->db->select('id_prodi, deskripsi');
        $this->db->from('mProdi');
        $this->db->order_by('id_prodi', 'ASC');
        $this->db->where('deskripsi !=', 'administrasi');
        $query = $this->db->get();

        // kembalikan data sebagai array
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
    }

    public function delete_vote($no_acara)
    {
        $this->db->where('no_acara', $no_acara);
        return $this->db->delete('mAcaraVote');
    }

    public function get_detail_kandidat_by_id($id_detail)
    {
        $this->db->where('id_detail', $id_detail);
        return $this->db->get('mAcaraVoteDetail')->row();
    }

    public function update_kandidat($id_detail, $data)
    {
        $this->db->where('id_detail', $id_detail);
        return $this->db->update('mAcaraVoteDetail', $data);
    }
}
