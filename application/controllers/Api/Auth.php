<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model(array('Auth_model', 'General_model'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    function validationError()
    {
        $errs = "";
        $err = explode("\n", validation_errors());
        foreach ($err as $v) {
            if ($v != "") {
                $errs .= strip_tags($v) . "\n";
            }
        }

        return $errs;
    }

    public function index_get()
    {
        $data = $this->Auth_model->usersList();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($data) {
            $result = [
                'error'  => false,
                'restos' => $data
            ];
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status'  => REST_Controller::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No partners were found'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function users_get()
    {
        $users = $this->Auth_model->usersList();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($users) {
            // Set the response and exit
            $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status'  => FALSE,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $token = $this->post('token');
        $Login = $this->Auth_model->LoginCheck($username, $password, 'mobile', $token);
        if ($Login['error'] == false) {
            $message = [
                'error'   => false,
                'message' => 'Welcome',
                'data'    => $Login['data']
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = [
                'error'   => true,
                'message' => 'Username / Password is incorrect'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        }

    }

    public function register_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $email = $this->post('email');
        $fullname = $this->post('fullname');
        $phone = $this->post('phone');
        $address = $this->post('address');
        $data = [
            'username'     => $username,
            'password'     => $password,
            'email'        => $email,
            'fullname'     => $fullname,
            'phone_number' => $phone,
            'type'         => 2,
            'address'      => $address
        ];

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]',
            array(
                'required'  => 'You have not provided %s.',
                'is_unique' => '%s already exists.'
            ));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]',
            array(
                'required'  => 'You have not provided %s.',
                'is_unique' => '%s already exists.'
            ));
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('fullname', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[12]');

        if ($this->form_validation->run() == FALSE) {
            $message = [
                'error'   => true,
                'message' => $this->validationError()
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $register = $this->Auth_model->register($data);
            if ($register) {
                $message = [
                    'error'   => false,
                    'message' => 'Registration Successful '
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'error'   => true,
                    'message' => 'Something Gone Wrong'
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            }
        }

    }

    public function changePass_post()
    {

        $id = $_POST['id'];
        $current = $_POST['currentpassword'];

        $change = $this->Auth_model->changePass();

        if ($change == "changed") {
            $message = [
                'error'   => false,
                'message' => 'Password Successfully Changed'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else if ($change == "mismatch") {
            $message = [
                'error'   => true,
                'message' => 'Wrong Current Password'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = [
                'error'   => true,
                'message' => 'Something Gone Wrong'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        }
    }

    public function deleteUser_delete($id)
    {
        $delete = $this->Auth_model->delete($id);

        if ($delete) {
            $message = [
                'error'   => false,
                'message' => 'Account Successfully Deleted'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = [
                'error'   => true,
                'message' => 'Something Gone Wrong'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        }
    }

    public function edit_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $fullname = $this->post('fullname');
        $phone = $this->post('phone');
        $address = $this->post('address');

        $data = [
            'username'     => $username,
            'password'     => $password,
            'fullname'     => $fullname,
            'phone_number' => $phone,
            'address'      => $address
        ];

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        $this->form_validation->set_rules('fullname', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[12]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[4]');

        if ($this->form_validation->run() == FALSE) {
            $message = [
                'error'   => true,
                'message' => $this->validationError()
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $register = $this->Auth_model->edit($data);
            if ($register) {
                $message = [
                    'error'   => false,
                    'message' => 'Update Successful '
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'error'   => true,
                    'message' => 'Something Gone Wrong'
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            }
        }

    }

    public function updateToken_post()
    {
        $username = $this->post('username');
        $token = $this->post('token');

        $data = [
            'username' => $username,
            'token'    => $token,
        ];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');

        if ($this->form_validation->run() == FALSE) {
            $message = [
                'error'   => true,
                'message' => $this->form_validation->validation_errors_remaster()
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $register = $this->Auth_model->updateToken($data);
            $this->set_response($register, REST_Controller::HTTP_OK);
        }

    }

    public function googleAuth_post()
    {
        $providerId = $this->post('providerId');
        $email = $this->post('email');
        $displayName = $this->post('displayName');
        $thumb = $this->post('thumbnail');
        $token = $this->post('token');
        $login = $this->Auth_model->googleAuth($providerId, $email, $displayName, $thumb, $token);
        $this->set_response($login, REST_Controller::HTTP_OK);
    }

    public function resetPass_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');

        $data = [
            'email'    => $email,
            'password' => $password
        ];

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', [
            'matches' => 'Password Confirmation is not match',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $message = [
                'error'   => true,
                'message' => $this->validationError()
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $register = $this->Auth_model->resetPass($data);
            if ($register) {
                $message = [
                    'error'   => false,
                    'message' => 'Update Successful '
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'error'   => true,
                    'message' => 'Something Gone Wrong'
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            }
        }

    }

}
