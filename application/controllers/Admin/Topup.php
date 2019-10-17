<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include 'Middleware.php';

class Topup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Topup_model');
        $this->load->library('MY_Library');
    }

    public function index()
    {
        $vars['header'] = 'Topup';
        $vars['View'] = 'Admin/Topup/index';
        $vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
        $vars['Data'] = $this->Topup_model->listData();
        $this->load->view('Admin/layout', $vars);
    }

    public function modalDetail($id)
    {
        $vars['data'] = $this->Topup_model->getDetail($id);
        $this->load->view('Admin/Topup/modal-detail', $vars);
    }

    public function modalVerifikasi($id)
    {
        $vars['data'] = $this->Topup_model->getDetail($id);
        $this->load->view('Admin/Topup/modal-verifikasi', $vars);
    }

    public function verifikasi($id)
    {
        if ($_POST['tindakan'] == '1'){
            $result = $this->Topup_model->verify($id);
        } else {
            $result = $this->Topup_model->reject($id);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
