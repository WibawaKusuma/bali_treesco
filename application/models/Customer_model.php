<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Mendaftarkan customer baru
     *
     * @param array $data Data customer
     * @return int|bool ID customer jika berhasil, FALSE jika gagal
     */
    public function register($data)
    {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Tambahkan timestamp
        $data['created_at'] = date('Y-m-d H:i:s');

        // Insert ke database
        $this->db->insert('m_customer', $data);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    /**
     * Login customer
     *
     * @param string $email Email customer
     * @param string $password Password customer
     * @return object|bool Data customer jika berhasil, FALSE jika gagal
     */
    public function login($email, $password)
    {
        // Cari customer berdasarkan email
        $this->db->where('email', $email);
        $this->db->where('status', 1); // Hanya customer yang aktif
        $query = $this->db->get('m_customer');

        if ($query->num_rows() > 0) {
            $customer = $query->row();

            // Verifikasi password
            if (password_verify($password, $customer->password)) {
                // Hapus password dari data yang dikembalikan
                unset($customer->password);
                return $customer;
            }
        }

        return FALSE;
    }

    /**
     * Mendapatkan data customer berdasarkan ID
     *
     * @param int $id_customer ID customer
     * @return object|bool Data customer jika ditemukan, FALSE jika tidak
     */
    public function get_customer_by_id($id_customer)
    {
        $this->db->where('id_customer', $id_customer);
        $query = $this->db->get('m_customer');

        if ($query->num_rows() > 0) {
            $customer = $query->row();
            // Hapus password dari data yang dikembalikan
            unset($customer->password);
            return $customer;
        }

        return FALSE;
    }

    /**
     * Mengupdate data customer
     *
     * @param int $id_customer ID customer
     * @param array $data Data yang akan diupdate
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function update_customer($id_customer, $data)
    {
        // Jika ada password baru, hash password
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            // Jika password kosong, jangan update password
            unset($data['password']);
        }

        // Tambahkan timestamp
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Update data
        $this->db->where('id_customer', $id_customer);
        $this->db->update('m_customer', $data);

        return $this->db->affected_rows() > 0;
    }

    /**
     * Mendapatkan customer berdasarkan email
     *
     * @param string $email Email customer
     * @return object|bool Data customer jika ditemukan, FALSE jika tidak
     */
    public function get_customer_by_email($email)
    {
        $this->db->where('email', $email);
        $this->db->where('status', 1); // Hanya customer yang aktif
        $query = $this->db->get('m_customer');

        if ($query->num_rows() > 0) {
            $customer = $query->row();
            // Hapus password dari data yang dikembalikan
            unset($customer->password);
            return $customer;
        }

        return FALSE;
    }

    /**
     * Membuat token reset password
     *
     * @param string $email Email customer
     * @return string|bool Token jika berhasil, FALSE jika gagal
     */
    public function create_reset_token($email)
    {
        // Hapus token lama jika ada
        $this->db->where('email', $email);
        $this->db->delete('customer_reset_password');

        // Buat token baru
        $token = bin2hex(random_bytes(32)); // Generate token acak
        $now = date('Y-m-d H:i:s');
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token berlaku 1 jam

        $data = [
            'email' => $email,
            'token' => $token,
            'created_at' => $now,
            'expires_at' => $expires
        ];

        $this->db->insert('customer_reset_password', $data);

        if ($this->db->affected_rows() > 0) {
            return $token;
        }

        return FALSE;
    }

    /**
     * Memvalidasi token reset password
     *
     * @param string $token Token reset password
     * @return string|bool Email jika token valid, FALSE jika tidak
     */
    public function validate_reset_token($token)
    {
        $now = date('Y-m-d H:i:s');

        $this->db->where('token', $token);
        $this->db->where('expires_at >', $now); // Token belum kadaluarsa
        $query = $this->db->get('customer_reset_password');

        if ($query->num_rows() > 0) {
            return $query->row()->email;
        }

        return FALSE;
    }

    /**
     * Reset password customer
     *
     * @param string $email Email customer
     * @param string $password Password baru
     * @return bool TRUE jika berhasil, FALSE jika gagal
     */
    public function reset_password($email, $password)
    {
        // Hash password baru
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update password
        $this->db->where('email', $email);
        $this->db->update('m_customer', [
            'password' => $hashed_password,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Hapus token reset password
        $this->db->where('email', $email);
        $this->db->delete('customer_reset_password');

        return $this->db->affected_rows() > 0;
    }
}
