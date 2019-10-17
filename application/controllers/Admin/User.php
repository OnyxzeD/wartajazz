<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include 'Middleware.php';

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Partner_model');
        $this->load->library('MY_Library');
    }

    function upload_ktp()
    {
        $config['upload_path'] = './assets/landing/img/identitas';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['file_name'] = strtolower($this->input->post('pemilik')) . '-' . date("YmdHis");
        $this->upload->initialize($config, TRUE);

        if (!$this->upload->do_upload('foto_identitas')) {
            $result = ['Status' => 'error', 'data' => $this->upload->display_errors()];
        } else {
            $result = ['Status' => 'success', 'data' => $this->upload->data()];
        }
        return $result;
    }

    public function index()
    {
        $vars['header'] = 'User';
        $vars['View'] = 'Admin/Users/index';
        $vars['JScript'] = base_url('assets/office/js/Partner/Outlet.js');
        $vars['Data'] = $this->Auth_model->listData();
//        echo "<pre>";
//        print_r($vars['Data']);
        $this->load->view('Admin/layout', $vars);
    }

    public function modalDetail($id)
    {
        $vars['data'] = $this->Auth_model->detail($id);
//        echo "<pre>";
//        print_r($vars);
//        $dt = explode(" ", $vars['data']['join_date']);
//        $expDate = date_create($dt[0]);
//        date_add($expDate, date_interval_create_from_date_string("61 days"));
//        $vars['expDate'] = date_format($expDate, "Y-m-d");
        $this->load->view('Admin/Users/modal-detail', $vars);
    }

    public function modalEdit($id)
    {
        $vars['data'] = $this->Partner_model->getDetail($id);
        $vars['bank'] = $this->Bank_model->get_all_bank();
        $this->load->view('Admin/Partner/modal-entry', $vars);
    }

    public function edit($id)
    {
        $result = $this->Partner_model->update($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function modalDelete($id)
    {
        $data = $this->Auth_model->detail($id);
        $vars['data'] = "Users " . $data['Name'];
        $this->load->view('modals/modal-delete', $vars);
    }

    public function delete($id)
    {
        $result = $this->Auth_model->delete($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
