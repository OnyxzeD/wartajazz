<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username')) {
            $this->load->model(array('Auth_model', 'General_model'));
        } else {
            redirect(base_url('/'));
        }
    }

    public function index()
    {
//        if ($this->session->userdata('username')) {
        $vars['header'] = 'Partner';
        $vars['View'] = 'user/list';
        $vars['data'] = $this->Auth_model->userList();
        $vars['JScript'] = base_url('assets/dist/js/User.js');
        $this->load->view('theme/layout', $vars);
    }

    public function modalCreate()
    {
        $vars['roles'] = $this->General_model->getData('role', array('role_id <>' => 0));
        $this->load->view('user/modal-entry', $vars);
    }

    public function create()
    {
        $data = [
            'username'     => $this->input->post('username'),
            'password'     => $this->input->post('password'),
            'email'        => $this->input->post('email'),
            'fullname'     => $this->input->post('fullname'),
            'phone_number' => null,
            'address'      => null,
            'token'        => $this->General_model->activationCode(),
            'device_token' => null,
            'provider_id'  => null,
            'thumbnail'    => null
        ];

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]',
            array(
                'required'  => 'You have not provided %s.',
                'is_unique' => '%s already exists.'
            ));
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', [
            'matches' => 'Password tidak sama dengan Konfirmasi Password',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('fullname', 'Name', 'required|min_length[3]');
//        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[12]');

        if ($this->form_validation->run() == FALSE) {
            $result = [
                'error'   => true,
                'message' => $this->form_validation->validation_errors_remaster()
            ];
        } else {
            $save = $this->Auth_model->register($data, $this->input->post('role'));
            if ($save) {
                $result = [
                    'error'   => false,
                    'message' => 'success'
                ];
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function modalEdit($username)
    {
        $vars['data'] = $this->Auth_model->detail($username);
        $vars['roles'] = $this->General_model->getData('role', array('role_id <>' => 0));
        $this->load->view('user/modal-entry', $vars);
    }

    public function edit()
    {
        $data = [
            'username'     => $this->input->post('username'),
            'password'     => $this->input->post('password'),
            'email'        => $this->input->post('email'),
            'role_id'      => $this->input->post('role'),
            'fullname'     => $this->input->post('fullname'),
            'phone_number' => null,
            'address'      => null,
            'token'        => $this->General_model->activationCode(),
            'device_token' => null,
            'provider_id'  => null,
            'thumbnail'    => null
        ];
        $result = $this->Auth_model->update($data);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function modalDelete($username)
    {
        $data = $this->Auth_model->detail($username);
        $vars['data'] = "Users <strong> " . $data['fullname'] . ' </strong>';
        $this->load->view('modals/modal-delete', $vars);
    }

    public function delete($username)
    {
        $result = $this->Auth_model->delete($username);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
