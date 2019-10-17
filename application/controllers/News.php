<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
            $vars['header'] = '';
            $vars['View'] = 'news/list';
//            $vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
            $this->load->view('theme/layout', $vars);
    }
}
