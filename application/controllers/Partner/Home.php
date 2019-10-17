<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'Partner_Middleware.php';

class Home extends Partner_Middleware
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Partner_model'));
    }

    public function index()
    {
        $vars['header'] = 'Dashboard';
        $vars['View'] = 'Partner/dashboard';
        $vars['session_data'] = $this->Partner_model->getDetail($_SESSION['Account']['Source_Id']);
        $this->load->view('Partner/layout', $vars);
    }
}
