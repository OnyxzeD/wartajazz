<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            $vars['header'] = 'Partner';
            $vars['View'] = 'pages/dashboard';
//            $vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
            $this->load->view('theme/layout', $vars);
        } else {
            $this->load->view('pages/login');
        }
    }

    public function authenticate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $login = $this->Auth_model->LoginCheck($username, $password);
        if ($login['Status'] != 'success') {
            $this->session->set_flashdata('error', $login['Msg']);
        }
        redirect(base_url('/'));
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('join_date');
        session_destroy();
        redirect(base_url('/'));
    }
}
