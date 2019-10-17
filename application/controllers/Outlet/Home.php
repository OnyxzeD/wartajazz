<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mid = 'Outlet_Middleware.php';
include $mid;

class Home extends Outlet_Middleware
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Reservasi_model','Outlet_model','Manager_model'));
    }

    public function index()
    {
        $vars['header'] = 'Dashboard';
        $vars['View'] = 'Outlet/dashboard';
        $vars['reservation'] = $this->Reservasi_model->countReservation($_SESSION['Account']['Source_Id']);
        $mgr = $this->Manager_model->getDetail($_SESSION['Account']['Source_Id'], '');
        $vars['available'] = $this->Outlet_model->getKursi($mgr['Outlet_Id'], '');
        $this->load->view('Outlet/layout', $vars);
    }
}
