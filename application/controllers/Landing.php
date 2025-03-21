<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Destination_model');
        $this->load->model('Admin_model');
        $this->load->model('General_model');
    }

    public function index()
    {
        @$data['title'] = 'Home';
        $data['galery'] = $this->General_model->get_data('m_galery')->result();
        // $data['config'] = $this->Destination_model->get_config('config')->row();
        $config_data = $this->General_model->get_config('config')->result();

        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        $data['config'] = $config_array;

        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/index');
        $this->load->view('templates/footer_landingpage');
    }
    public function about()
    {
        @$data['title'] = 'About Us';
        $data['team'] = $this->General_model->get_data('m_team')->result();
        // $data['config'] = $this->Destination_model->get_config('config')->row();
        $config_data = $this->General_model->get_config('config')->result();

        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        $data['config'] = $config_array;

        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/about');
        $this->load->view('templates/footer_landingpage');
    }

    public function product()
    {
        $data['title'] = 'Product';
        $data['detail'] = $this->Admin_model->get_acaravote('m_product')->result();
        $config_data = $this->General_model->get_config('config')->result();

        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        $data['config'] = $config_array;

        // $data['config'] = $this->Destination_model->get_config('config')->row();

        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/product');
        $this->load->view('templates/footer_landingpage');
    }

    public function contact()
    {
        $data['title'] = 'Contact';
        // Ambil data dari tabel `config`
        $config_data = $this->General_model->get_config('config')->result();

        // Konversi array objek menjadi array asosiatif
        $config_array = [];
        foreach ($config_data as $item) {
            $config_array[$item->name] = $item->value;
        }

        // Simpan ke dalam $data['config']
        $data['config'] = $config_array;

        // print_r($data);
        // exit;


        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/contact');
        $this->load->view('templates/footer_landingpage');
    }

    // public function armada()
    // {
    //     $data['title'] = 'Armada';
    //     $data['armada'] = $this->Armada_model->get_armada('marmada')->result();
    //     $data['config'] = $this->Destination_model->get_config('config')->row();


    //     $this->load->view('templates/header_landingpage', $data);
    //     $this->load->view('landing_page/armada', $data);
    //     $this->load->view('templates/footer_landingpage');
    // }
}
