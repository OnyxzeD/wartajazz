<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Auth_model', 'Event_model', 'Artist_model'));
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            $vars['header'] = 'Dashboard';
            $vars['View'] = 'pages/dashboard';
            $vars['JScript'] = '';

            // grouping data
            $result = [];
            $data = [];
            $events = $this->Event_model->getMonthly();
            foreach ($events as $ev) {
                $tgl = explode(" ", $ev['date_start']);
                $ev['event_date'] = $tgl[0];
                $data[] = $ev;
            }

            foreach ($data as $element) {
                $result[$element['event_date']][] = $element;
            }

            $vars['events'] = $result;
            $vars['users'] = $this->Auth_model->getMonthly();
            $vars['artists'] = $this->Artist_model->getMonthly();

            $this->load->view('theme/layout', $vars);
        } else {
            $this->load->view('pages/login');
        }
    }

    public function profile()
    {
        $vars['View'] = 'pages/profile';
        $vars['JScript'] = base_url('assets/dist/js/Profile.js');
        $this->load->view('theme/layout', $vars);
    }

    public function authenticate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $login = $this->Auth_model->LoginCheck($username, $password);
        print_r($login);
        if ($login['data'] == null) {
            $this->session->set_flashdata('error', $login['msg']);
            redirect(base_url('/'));
        }

        if ((int)$login['data']['role_id'] <= 1) {
            redirect(base_url('/'));
        } else {
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('level');
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('join_date');
            $this->session->set_flashdata('error', 'Username tidak ditemukan.');
            redirect(base_url('/'));
        }
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

    public function updatePass()
    {
        $username = $this->session->userdata('username');
        $detail = $this->Auth_model->detail($username);
        $password = $this->input->post('password');

        $data = [
            'email'    => $detail['email'],
            'password' => $password
        ];

        $reset = $this->Auth_model->resetPass($data);

        if ($reset){
            $this->session->set_flashdata('sukses', 'Password berhasil diubah');
        } else {
            $this->session->set_flashdata('warning', 'Something gone wrong');
        }

        redirect(base_url('dashboard/profile'));

    }
}
