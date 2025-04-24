<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_admin();

        $this->load->library('session');

        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('General_model');
    }

    public function index()
    {
        $data['title'] = 'User';
        $data['member'] = $this->General_model->get_data('m_user')->result();

        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('user/datatable', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create User';
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['modules'] = $this->General_model->get_data('m_module')->result();

        // print_r($data['module']);
        // exit;


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('user/form', $data);
        $this->load->view('templates/footer');
    }

    // public function create_user()
    // {
    //     if ($this->input->post()) {
    //         $data = $this->input->post('p');

    //         // Hash password sebelum disimpan
    //         if (!empty($data['password'])) {
    //             $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    //         }

    //         // Tambahkan timestamp untuk CreatedAt dan UpdatedAt
    //         $data['created_at'] = date('Y-m-d H:i:s'); // Gunakan format datetime

    //         // Simpan ke database
    //         $this->General_model->insert_data($data, 'm_user');
    //         $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
    //         redirect('user');
    //     } else {
    //         // Jika tidak ada data POST, tampilkan form
    //         $this->load->view('user/form');
    //     }
    // }

    // Form untuk membuat user baru
    public function create_user()
    {
        if ($this->input->post()) {
            $data = $this->input->post('p');                  // Data user
            $modules = $this->input->post('modules');         // ID module yang dicentang
            $confirm_password = $this->input->post('confirm_password'); // Konfirmasi password

            // Validasi sisi server: cek password dan konfirmasi password
            if (!empty($data['password']) && $data['password'] !== $confirm_password) {
                $this->session->set_flashdata('error', 'Password dan konfirmasi password tidak cocok!');
                redirect('user/create_user');
                return;
            }

            // Set id_role secara statis
            $id_role = 1;

            // Validasi id_role: pastikan id_role ada di tabel m_role
            $role = $this->db->get_where('m_role', ['id' => $id_role])->row();
            if (!$role) {
                $this->session->set_flashdata('error', 'Role dengan ID ' . $id_role . ' tidak ditemukan di tabel m_role!');
                redirect('user/create_user');
                return;
            }

            // Mulai transaksi untuk memastikan integritas data
            $this->db->trans_start();

            // Hash password sebelum disimpan
            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            // Tambah timestamp untuk data user (master)
            $data['created_at'] = date('Y-m-d H:i:s');

            // Tambahkan id_role ke data
            $data['id_role'] = $id_role;

            // Debug: cek data sebelum insert
            // print_r($data);
            // exit;

            // Simpan user ke database (master)
            $this->General_model->insert_data($data, 'm_user');

            // Ambil ID user yang baru ditambahkan
            $user_id = $this->db->insert_id();

            // Simpan permissions sebagai "detail"
            if (!empty($modules)) {
                $detail_data = [];
                foreach ($modules as $module_id) {
                    // Validasi id_module: pastikan id_module ada di tabel m_module
                    if (!$this->db->get_where('m_module', ['id_module' => $module_id])->row()) {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('error', 'Module dengan ID ' . $module_id . ' tidak valid atau tidak ditemukan!');
                        redirect('user');
                        return;
                    }

                    $detail_data[] = [
                        'id_user' => $user_id,
                        'id_module' => $module_id,
                        // 'created_at' => date('Y-m-d H:i:s') // Pastikan created_at diisi
                    ];
                }

                // Debug: cek detail data sebelum insert
                // print_r($detail_data);
                // exit;

                // Insert batch untuk detail permissions
                $this->db->insert_batch('m_role_permissions', $detail_data);
            }

            // Selesaikan transaksi
            $this->db->trans_complete();

            // Cek apakah transaksi berhasil
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Gagal menambahkan user dan permissions!');
            } else {
                $this->session->set_flashdata('success', 'User dan permissions berhasil ditambahkan!');
            }

            // Redirect ke halaman user
            redirect('user');
        } else {
            // Muat data untuk form
            $data['modules'] = $this->db->get('m_module')->result();
            $data['member'] = null; // Untuk form create
            $this->load->view('user/form', $data);
        }
    }

    // public function update($id_user)
    // {
    //     $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

    //     if ($this->input->post()) {
    //         $post = $this->input->post('p');
    //         $confirm_password = $this->input->post('confirm_password');

    //         // Hilangkan password jika kosong
    //         if (empty($post['password'])) {
    //             unset($post['password']);
    //         } else {
    //             // Pastikan password dan confirm cocok (validasi ganda)
    //             if ($post['password'] !== $confirm_password) {
    //                 $this->session->set_flashdata('error', 'Password dan konfirmasi tidak cocok.');
    //                 redirect('user/update/' . $id_user);
    //             }
    //             $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT); // hash password
    //         }

    //         $post['created_at'] = date('Y-m-d H:i:s');

    //         $this->db->where('id_user', $id_user);
    //         $this->General_model->update($post, 'm_user');

    //         $this->session->set_flashdata('success', 'User berhasil diubah!');
    //         redirect('user');
    //     } else {
    //         $data['member'] = $this->db->get_where('m_user', ['id_user' => $id_user])->row();
    //     }

    //     $data['title'] = 'Edit User';
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('templates/sidebar_admin', $data);
    //     $this->load->view('user/form', $data);
    //     $this->load->view('templates/footer');
    // }

    public function update($id_user)
    {
        $data['user'] = $this->db->get_where('m_user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post()) {
            $post = $this->input->post('p');                  // Data user
            $modules = $this->input->post('modules');         // ID module yang dicentang
            $confirm_password = $this->input->post('confirm_password'); // Konfirmasi password

            // Validasi sisi server: cek password dan konfirmasi password
            if (!empty($post['password']) && $post['password'] !== $confirm_password) {
                $this->session->set_flashdata('error', 'Password dan konfirmasi password tidak cocok!');
                redirect('user/update/' . $id_user);
                return;
            }

            // Set id_role secara statis
            $id_role = 1;

            // Validasi id_role: pastikan id_role ada di tabel m_role
            $role = $this->db->get_where('m_role', ['id' => $id_role])->row();
            if (!$role) {
                $this->session->set_flashdata('error', 'Role dengan ID ' . $id_role . ' tidak ditemukan di tabel m_role!');
                redirect('user/update/' . $id_user);
                return;
            }

            // Mulai transaksi untuk memastikan integritas data
            $this->db->trans_start();

            // Hash password jika diubah
            if (!empty($post['password'])) {
                $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
            } else {
                unset($post['password']); // Jangan update password jika kosong
            }

            // Tambah timestamp untuk updated_at (jika kolom ini ada)
            $post['updated_at'] = date('Y-m-d H:i:s');

            // Set id_role
            $post['id_role'] = $id_role;

            // Update data user (master)
            $this->User_model->update_data($id_user, $post); // Memanggil method update_data

            // Hapus permissions lama
            $this->db->delete('m_role_permissions', ['id_user' => $id_user]);

            // Simpan permissions baru sebagai "detail"
            if (!empty($modules)) {
                $detail_data = [];
                foreach ($modules as $module_id) {
                    // Validasi id_module: pastikan id_module ada di tabel m_module
                    if (!$this->db->get_where('m_module', ['id_module' => $module_id])->row()) {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('error', 'Module dengan ID ' . $module_id . ' tidak valid atau tidak ditemukan!');
                        redirect('user');
                        return;
                    }

                    $detail_data[] = [
                        'id_user' => $id_user,
                        'id_module' => $module_id,
                        // 'created_at' => date('Y-m-d H:i:s') // Pastikan created_at diisi
                    ];
                }

                // Insert batch untuk detail permissions
                $this->db->insert_batch('m_role_permissions', $detail_data);
            }

            // Selesaikan transaksi
            $this->db->trans_complete();

            // Cek apakah transaksi berhasil
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Gagal mengupdate user dan permissions!');
            } else {
                $this->session->set_flashdata('success', 'User dan permissions berhasil diupdate!');
            }

            // Redirect ke halaman user
            redirect('user');
        } else {
            // Muat data untuk form
            $data['member'] = $this->db->get_where('m_user', ['id_user' => $id_user])->row();
            $data['modules'] = $this->db->get('m_module')->result();

            // Ambil permissions user untuk ditampilkan di checkbox
            $user_permissions = $this->db->get_where('m_role_permissions', ['id_user' => $id_user])->result();
            $user_module_ids = array_column($user_permissions, 'id_module');
            foreach ($data['modules'] as $module) {
                $module->status = in_array($module->id_module, $user_module_ids) ? 1 : 0;
            }

            $data['title'] = 'Edit User';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('user/form', $data);
            $this->load->view('templates/footer');
        }
    }





    public function delete($id_galery)
    {
        // Hapus data berdasarkan NoReservasi
        $this->db->where('id_galery', $id_galery);
        $this->db->delete('m_galery');

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('success', 'Galery berhasil dihapus!');

        // Redirect ke halaman daftar reservasi
        redirect('galery');
    }
}
