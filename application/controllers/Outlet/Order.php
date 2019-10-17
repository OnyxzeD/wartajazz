<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'Outlet_Middleware.php';

class Order extends Outlet_Middleware
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reservasi_model');
    }

    public function index()
    {
        $vars['header'] = 'Order';
        $vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
        $vars['View'] = 'Outlet/Order/index';
        $vars['Data'] = $this->Reservasi_model->listData();
        $this->load->view('Outlet/layout', $vars);
    }

    public function modalVerifikasi($id)
    {
        $vars['Id'] = $id;
        $this->load->view('Outlet/Order/modal-verifikasi', $vars);
    }

    public function verifikasi($id)
    {
        $result = $this->Reservasi_model->verify($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

}
