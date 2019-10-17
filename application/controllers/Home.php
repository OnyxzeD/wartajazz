<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wilayah_model');
        $this->load->model('Bank_model');
        $this->load->model('Partner_model');
        $this->load->database();
        $this->load->helper(array('form'));
    }

    public function index()
    {
        $vars['View'] = 'Home/index';
        $this->load->view('Home/layout', $vars);
    }

    public function register()
    {
        $vars['View'] = 'Home/register';
        $vars['JScript'] = base_url('assets/landing/js/register.js');
        $vars['provinsi'] = $this->Wilayah_model->get_all_provinsi();
        $vars['bank'] = $this->Bank_model->get_all_bank();
        $vars['path'] = base_url('assets');
        $this->load->view('Home/layout', $vars);
    }

    public function partners()
    {
        $vars['View'] = 'Home/partner';
        $vars['JScript'] = base_url('assets/landing/js/register.js');
        $vars['partners'] = $this->Partner_model->listData();
        $vars['path'] = base_url('');
        $this->load->view('Home/layout', $vars);
//        echo "<pre>";
//        print_r($vars['partners']);
    }

    function add_ajax_kab($id_prov)
    {
        $query = $query = $this->Wilayah_model->getKabupatenByProv($id_prov);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function about()
    {
        $vars['View'] = 'Home/about';
//        $vars['JScript'] = base_url('assets/landing/js/register.js');
        $this->load->view('Home/layout', $vars);
    }

    public function contact()
    {
        $vars['View'] = 'Home/contact';
//        $vars['JScript'] = base_url('assets/landing/js/register.js');
        $this->load->view('Home/layout', $vars);
    }
}
