<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'Partner_Middleware.php';

class Users extends Partner_Middleware
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Manager_model', 'Partner_model', 'Auth_model', 'General_model'));
        $this->load->library('MY_Library');
    }

    public function index()
    {
        $vars['header'] = 'Manajer';
        $vars['JScript'] = base_url('assets/office/js/Partner/Users.js');
        $vars['View'] = 'Partner/Users/index';
        $vars['Data'] = $this->Manager_model->listData();
        $this->load->view('Partner/layout', $vars);
    }

    public function modalCreate()
    {
        $vars['outlet'] = $this->Manager_model->getOutlet();
        $this->load->view('Partner/Users/modal-entry', $vars);
    }

    public function create()
    {
        $random = $this->General_model->randomPassword();
        $activation_code = $this->General_model->activationCode();

        $this->load->library('upload');

        if ($_FILES['manager_photo']['error'] != 4) {
            $config['upload_path'] = './assets/landing/img/avatar';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2000;
            $config['file_name'] = $_POST['manager_username'] . '-' . $_FILES['manager_photo']['name'];
            $this->upload->initialize($config, TRUE);

            if (!$this->upload->do_upload('manager_photo')) {
                $result = ['error' => true, 'message' => 'Gagal'];
            } else {
                $data = [
                    'username'  => $_POST['manager_username'],
                    'email'     => $_POST['manager_email'],
                    'password'  => $random,
                    'type'      => 2,
                    'outlet_id' => $_POST['outlet_id'],
                    'fullname'  => $_POST['manager_fullname'],
                    'phone'     => $_POST['manager_phone'],
                    'photo'     => $config['file_name'],
                    'token'     => $activation_code
                ];

                $result = $this->Auth_model->register($data, 'Manager');

                if ($result) {
                    $url = "http://localhost/tempat.in/manage/confirm/" . $_POST['manager_username'] . '/' . $activation_code;
                    $data['user'] = [
                        'name'     => $_POST['manager_username'],
                        'password' => $random,
                        'link'     => $url
                    ];
                    $email = $this->my_library->sendEmail($_POST['manager_email'], 'Pendaftaran Berhasil', $data);
                    if ($email) {
                        $result = ['Status' => 'success', 'Msg' => 'Berhasil'];
                    }
                } else {
                    $result = ['Status' => 'error', 'Msg' => 'Proses Gagal'];
                }
            }
        } else {
            $result = ['error' => true, 'message' => 'Gagal'];
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));

    }

    public function modalEdit($id)
    {
        $vars['data'] = $this->Manager_model->getDetail($id);
        $vars['outlet'] = $this->Manager_model->getOutlet(null, 'all');
        $this->load->view('Partner/Users/modal-edit', $vars);
    }

    public function edit($id)
    {
        $result = $this->Manager_model->update($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function modalDelete($id)
    {
        $data = $this->Manager_model->getDetail($id);
        $vars['data'] = "Manager " . $data['Nama'];
        $this->load->view('modals/modal-delete', $vars);
    }

    public function delete($id)
    {
        $result = $this->Manager_model->delete($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
