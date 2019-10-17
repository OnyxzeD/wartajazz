<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mid = 'Middleware.php';
include $mid;

class Home extends Middleware
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Auth_model'));
    }

    public function index()
    {
        $vars['header'] = 'Dashboard';
        $vars['View'] = 'Admin/dashboard';
        $vars['newComer'] = $this->Auth_model->getNewcomers();
        $vars['newPartner'] = $this->Auth_model->getNewpartners();
        $vars['newTopup'] = $this->Auth_model->getTopup();
        $vars['date'] = date("Y-m-d H:i:s");
        $this->load->view('Admin/layout', $vars);
    }
}
