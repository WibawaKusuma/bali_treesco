<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vote_model extends CI_Model
{
    public function is_transaction_exists($id_pemilih)
    {
        $this->db->where('id_pemilih', $id_pemilih);
        $query = $this->db->get('trhasilVoting');
        return $query->num_rows() > 0;
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows() > 0;
    }

    public function get_all_kandidat($id_prodi)
    {
        $this->db->select('a.*, b.*');
        $this->db->from('macaravotedetail a');
        $this->db->join('macaravote b', 'a.no_acara = b.no_acara', 'inner');
        $this->db->where('b.status', 1);
        $this->db->where('b.id_prodi', $id_prodi);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_kandidat_with_votes($id_prodi = null)
    {
        if (!$id_prodi) {
            return [];
        }

        $this->db->select('a.*, b.*');
        $this->db->from('macaravotedetail a');
        $this->db->join('mAcaraVote b', 'a.no_acara = b.no_acara', 'left');
        $this->db->where('b.id_prodi', $id_prodi);
        $this->db->where('b.status', 1);
        $kandidat_query = $this->db->get();
        $kandidat_data = $kandidat_query->result_array();

        // menghitung jumlah voting
        $this->db->select('b.pilihan, COUNT(b.pilihan) as jumlah_suara');
        $this->db->from('trhasilVoting b');
        $this->db->where('b.id_prodi', $id_prodi);
        $this->db->group_by('b.pilihan');
        $votes_query = $this->db->get();
        $votes_data = $votes_query->result_array();

        // Buat array jumlah suara dengan id_detail sebagai key
        $votes_count = [];
        foreach ($votes_data as $vote) {
            $votes_count[$vote['pilihan']] = $vote['jumlah_suara'];
        }

        // Gabungkan data kandidat dengan jumlah suara
        $total_votes = 0;
        foreach ($kandidat_data as &$kandidat) {
            $kandidat['jumlah_suara'] = isset($votes_count[$kandidat['id_detail']]) ? $votes_count[$kandidat['id_detail']] : 0;
            $total_votes += $kandidat['jumlah_suara'];
        }

        // Hitung persentase suara untuk setiap kandidat
        foreach ($kandidat_data as &$kandidat) {
            $kandidat['persentase'] = ($total_votes > 0)
                ? round(($kandidat['jumlah_suara'] / $total_votes) * 100, 2)
                : 0;
        }

        return $kandidat_data;
    }

    public function update_data($data, $table, $where)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }
}
