<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('form_validation');

        // $this->load->library(['form_validation', 'upload', 'session']);
        // $this->load->helper(['form', 'url']);


        $this->load->model('Admin_model');
        $this->load->model('Vote_model');
    }

    public function index()
    {
        $data['acaravote'] = $this->Admin_model->get_acaravote('mAcaraVote')->result();
        $data['title'] = 'admin';
        // print_r($data);
        // exit;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Create Voting',
            'no_acara' => $this->Admin_model->generate_reservation_number(),
            'dropdown_prodi' => $this->Admin_model->get_prodi(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/form', $data);
        $this->load->view('templates/footer');
    }


    public function create_vote()
    {
        $this->load->model('Admin_model');
        $vote_data = $this->input->post('p');

        if (empty($vote_data['nama_acara']) || empty($vote_data['tanggal'])) {
            $this->session->set_flashdata('error', 'Nama acara dan tanggal wajib diisi!');
            redirect('admin/create_vote');
        }

        $vote_data['created_at'] = date('Y-m-d H:i:s');

        if ($this->Admin_model->save_vote($vote_data)) {
            // Mendapatkan no_acara yang baru saja disimpan
            $no_acara = $this->Admin_model->get_last_insert_id(); // Ambil ID acara yang baru saja disimpan

            $this->session->set_flashdata('success', 'Data acara berhasil disimpan!');

            redirect('admin/create_vote_detail/' . $no_acara);
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data acara!');
            redirect('admin/create_vote');
        }
    }

    public function update_vote($no_acara)
    {
        $this->load->model('Admin_model');
        $detail_kandidat = $this->Admin_model->get_detail_kandidat($no_acara);

        // print_r($detail_kandidat);
        // exit;

        if ($this->input->post()) {

            $vote_data = $this->input->post('p');
            // print_r($vote_data);
            // exit;

            if (empty($vote_data['nama_acara']) || empty($vote_data['tanggal'])) {
                $this->session->set_flashdata('error', 'Nama acara dan tanggal wajib diisi!');
                redirect('admin/update_vote/' . $no_acara);
            }

            $vote_data['updated_at'] = date('Y-m-d H:i:s');


            if ($this->Admin_model->update_vote($no_acara, $vote_data)) {
                $this->session->set_flashdata('success', 'Data acara berhasil disimpan!');
                redirect('admin');
                $this->session->set_flashdata('error', 'Gagal menyimpan data acara!');
                redirect('admin/update_vote/' . $no_acara);
            }
        } else {
            // Jika form belum disubmit, ambil data acara berdasarkan NoAcara
            $vote = $this->Admin_model->get_vote_by_no_acara($no_acara);
            if (!$vote) {
                show_404();
            }

            $data['title'] = 'Update Vote';
            $data['vote'] = $vote;
            $data['no_acara'] = $no_acara;
            $data['detail_kandidat'] = $detail_kandidat;
            $data['dropdown_prodi'] = $this->Admin_model->get_prodi();
            // print_r($vote);
            // exit;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar_admin');
            $this->load->view('admin/form', $data);
            $this->load->view('templates/footer');
        }
    }

    public function create_vote_detail($no_acara)
    {
        $acara = $this->Admin_model->get_vote_by_no_acara($no_acara);
        if (!$acara) {
            $this->session->set_flashdata('error', 'Nomor acara tidak ditemukan!');
            redirect('admin');
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $detail_data = $this->input->post('d');

            $this->form_validation->set_rules('d[nama_kandidat]', 'Nama Kandidat', 'required');
            $this->form_validation->set_rules('d[visi]', 'Visi', 'required');
            $this->form_validation->set_rules('d[misi]', 'Misi', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('admin/create_vote_detail/' . $no_acara);
            }

            $config['upload_path'] = './assets/template/img/kandidat';
            $config['allowed_types'] = 'jpeg|jpg|png|gif';
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];
            $config['overwrite'] = FALSE;
            $config['max_size'] = 2048; // 2MB

            $this->upload->initialize($config);

            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $this->session->set_flashdata('error', 'Tidak ada file yang dipilih atau file terlalu besar.');
                redirect('admin/create_vote_detail/' . $no_acara);
            }

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors('', '');
                $this->session->set_flashdata('error', "Upload image gagal! Error: $error");
                redirect('admin/create_vote_detail/' . $no_acara);
            } else {
                $upload_data = $this->upload->data();
                $detail_data['image'] = $upload_data['file_name'];
            }

            $detail_data['created_at'] = date('Y-m-d H:i:s');
            $detail_data['no_acara'] = $no_acara;


            if ($this->Admin_model->save_vote_detail($detail_data)) {
                $this->session->set_flashdata('success', 'Detail kandidat berhasil disimpan!');
                redirect('admin/update_vote/' . $no_acara);
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan detail kandidat!');
                redirect('admin/create_vote_detail/' . $no_acara);
            }
        }

        $data = [
            'title' => 'Tambah Detail Kandidat',
            'vote' => $this->Admin_model->get_vote_by_no_acara($no_acara),
            'no_acara' => $no_acara
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/form_detail', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_kandidat($id_detail, $no_acara)
    {
        $this->load->model('Admin_model');

        if ($this->Admin_model->delete_kandidat($id_detail)) {
            $this->session->set_flashdata('success', 'Kandidat berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kandidat!');
        }
        redirect('admin/update_vote/' . $no_acara);
    }



    public function update_kandidat($id_detail)
    {
        $detail_kandidat = $this->Admin_model->get_detail_kandidat_by_id($id_detail);

        if (!$detail_kandidat) {
            show_404();
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $data = [
                'nama_kandidat' => $this->input->post('nama_kandidat'),
                'visi' => $this->input->post('visi'),
                'misi' => $this->input->post('misi'),
            ];

            $this->form_validation->set_rules('nama_kandidat', 'Nama Kandidat', 'required');
            $this->form_validation->set_rules('visi', 'Visi', 'required');
            $this->form_validation->set_rules('misi', 'Misi', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(current_url());
                return;
            }

            $old_image_path = './assets/template/img/kandidat/' . $detail_kandidat->image;

            $config['upload_path'] = './assets/template/img/kandidat';
            $config['allowed_types'] = 'jpeg|jpg|png|gif';
            $config['file_name'] = time() . '_' . $_FILES['image']['name']; // Nama file unik
            $config['overwrite'] = FALSE;
            $config['max_size'] = 2048; // 2MB

            $this->load->library('upload', $config);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

                if (!$this->upload->do_upload('image')) {

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', "Upload image gagal! Error: " . $error);
                    redirect(current_url());
                } else {

                    $upload_data = $this->upload->data();
                    $data['image'] = $upload_data['file_name'];


                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
            } else {
                $data['image'] = $detail_kandidat->image;
            }

            $update = $this->Admin_model->update_kandidat($id_detail, $data);

            if ($update) {
                $this->session->set_flashdata('success', 'Data kandidat berhasil diperbarui.');
                redirect('admin/update_vote/' . $detail_kandidat->no_acara);
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data kandidat.');
                redirect(current_url());
            }
        }

        $data['title'] = 'Update Kandidat';
        $data['detail_kandidat'] = $detail_kandidat;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/form_update', $data);
        $this->load->view('templates/footer');
    }

    public function delete($no_acara)
    {
        $this->load->model('Admin_model');

        // Attempt to delete the event (vote) based on no_acara
        if ($this->Admin_model->delete_vote($no_acara)) {
            $this->session->set_flashdata('success', 'Acara berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus acara!');
        }

        // Redirect back to the admin dashboard
        redirect('admin');
    }
}
