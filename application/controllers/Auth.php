<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
		$this->load->model('Outlet_model');
		$this->load->model('Manager_model');

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
