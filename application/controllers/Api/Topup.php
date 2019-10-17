<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Topup extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model(array('Topup_model', 'Partner_model', 'Outlet_model', 'Auth_model'));
    }

    public function index_get()
    {
        $data = $this->Topup_model->listData();
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
                'message' => 'No reservations were found'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function topup_post()
    {
        $cust = $this->Auth_model->detail($this->post('user_id'));
        $data = [
            'customer_id' => $cust['Source_Id'],
            'nominal'     => $this->post('nominal')
        ];

        $reserve = $this->Topup_model->topup($data);
        $this->set_response($reserve, REST_Controller::HTTP_OK);
    }

    public function confirm_post()
    {
        $this->load->library('upload');

        if ($_FILES['image']['error'] != 4) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < 15; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $config['upload_path'] = './assets/landing/img/bukti';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2000;
            $config['file_name'] = $randomString . $_FILES['image']['name'];
            $this->upload->initialize($config, TRUE);

            if (!$this->upload->do_upload('image')) {
                $result = ['error' => true, 'message' => 'Gagal'];
            } else {
                $data = [
                    'id'    => $this->post('Id_Topup'),
                    'bukti' => $randomString . $_FILES['image']['name']
                ];

                $result = $this->Topup_model->confirm($data);
            }
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

}
