<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Destination_model');
        // $this->load->model('Armada_model');
    }

    public function index()
    {
        @$data['title'] = 'Home';
        // $data['destination'] = $this->Destination_model->get_destination('mdestination')->result();
        // $data['config'] = $this->Destination_model->get_config('config')->row();

        // print_r($data);
        // exit;

        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/index');
        $this->load->view('templates/footer_landingpage');
    }
    public function about()
    {
        @$data['title'] = 'About Us';
        // $data['config'] = $this->Destination_model->get_config('config')->row();


        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/about');
        $this->load->view('templates/footer_landingpage');
    }

    public function product()
    {
        $data['title'] = 'Product';
        // $data['destination'] = $this->Destination_model->get_destination('mdestination')->result();
        // $data['config'] = $this->Destination_model->get_config('config')->row();


        // print_r($data);
        // exit;
        $this->load->view('templates/header_landingpage', $data);
        $this->load->view('landing_page/product');
        $this->load->view('templates/footer_landingpage');
    }

    public function contact()
    {
        $data['title'] = 'Contact';
        // $data['config'] = $this->Destination_model->get_config('config')->row();


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
