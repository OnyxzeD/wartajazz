<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'Partner_Middleware.php';

class Profile extends Partner_Middleware
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Wilayah_model', 'Partner_model', 'Bank_model'));
    }

    public function index()
    {
        $vars['header'] = 'Profile';
        $vars['View'] = 'Partner/Profile/index';
        $vars['row'] = $this->Partner_model->getDetail($_SESSION['Account']['Source_Id']);
        $vars['JScript'] = base_url('assets/office/js/Partner/Profile.js');
        $this->load->view('Partner/layout', $vars);
    }

    public function modalEdit($id)
    {
        $vars['data'] = $this->Partner_model->getDetail($id);
        $this->load->view('Partner/Profile/modal-edit', $vars);
    }

    public function edit($id)
    {
        $detail = $this->Partner_model->getDetail($id);
        $_POST['bank_kode'] = $detail['Kode_Bank'];
        $_POST['no_rekening'] = $detail['Rekening'];
        $_POST['pemilik_rekening'] = $detail['Pemilik_Rekening'];
        $result = $this->Partner_model->update($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function modalRekening($id)
    {
        $vars['bank'] = $this->Bank_model->get_all_bank();
        $vars['data'] = $this->Partner_model->getDetail($id);
        $this->load->view('Partner/Profile/modal-rekening', $vars);
    }

}
