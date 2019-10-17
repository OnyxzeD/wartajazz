<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Partner_model');
    }

    function isExist($username)
    {
        $cek = $this->Auth_model->get($username);
        if ($cek != null && $cek['Type'] < 3) {
            $this->showLogin($username);
        } else {
            redirect('/');
        }
    }

    public function index()
    {
        redirect('/');
    }

    public function showLogin($username = null)
    {
        if (isset($_POST['login']) && !isset($_SESSION['Account'])) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $Login = $this->Auth_model->LoginCheck($username, $password);
            if ($Login['Status'] == 'success') {
                if ($Login['Data']['Type'] == 0) {
                    redirect('Admin');
                } else {
                    $_SESSION['Account']['Source_Id'] = $Login['Data']['Source_Id'];
                    if ($Login['Data']['Type'] == 1) {
                        redirect('Partner');
                    } else if ($Login['Data']['Type'] == 2) {
                        redirect('Outlet');
                    }
                }
            } else {
                $this->session->set_flashdata('flash', $Login['Msg']);
                redirect('manage/' . $username);
            }
        } else if (isset($_SESSION['Account'])) {
            if ($_SESSION['Account']['Type'] == 0) {
                redirect('Admin');
            } else {
                if ($_SESSION['Account']['Type'] == 1) {
                    redirect('Partner');
                } else if ($_SESSION['Account']['Type'] == 2) {
                    redirect('Outlet');
                }
            }
        } else {
            $data['user'] = $username;
            $this->load->view('Login/index', $data);
        }
    }

    public function confirm($user, $activation, $type = null)
    {
        $data = $this->Auth_model->checkAccount($user, $activation);

        if ($data != false) {
            if ($type == null) {
                $activate = $this->Auth_model->activate($data['Id']);
            } else {
                $activate = $this->Auth_model->activate($data['Id'], "partner");
            }
            if ($activate) {
                $this->showLogin($data['Name']);
            } else {
                redirect('/');
            }
        }
    }
}
