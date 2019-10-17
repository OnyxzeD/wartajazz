<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
//        if ($this->session->userdata('username')) {
            $vars['header'] = 'Partner';
            $vars['View'] = 'user/list';
//            $vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
            $this->load->view('theme/layout', $vars);
    }
}
