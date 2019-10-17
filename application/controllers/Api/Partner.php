<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Partner extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('Partner_model');
    }

    public function index_get()
    {
        $data = $this->Partner_model->apiList();
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

    public function cafe_get()
    {
        $data = $this->Partner_model->apiList('cafe');
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($data) {
            $result = [
                'error' => false,
                'cafes' => $data
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

    public function outlet_get($partner_id)
    {
        $this->load->model('Outlet_model');
        $data = $this->Outlet_model->listData($partner_id);
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($data) {
            $result = [
                'error'   => false,
                'message' => 'success',
                'outlets' => $data
            ];
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'error'   => REST_Controller::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No outlets were found',
                'outlets' => []
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function outlet_detail_get($outlet_id)
    {
        $this->load->model('Outlet_model');
        $data = $this->Outlet_model->getDetail($outlet_id);
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($data) {
            $temp = [
                'ID_Outlet'  => $data['ID_Outlet'],
                'Partner_Id' => $data['Partner_Id'],
                'Nama'       => $data['Nama'],
                'Alamat'     => $data['Alamat'],
                'Telp'       => $data['Telp'],
                'Thumbnail'  => $data['Thumbnail']
            ];
            $result = [
                'error'   => false,
                'message' => 'success',
                'outlets' => $data
            ];
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'error'   => REST_Controller::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No outlets were found',
                'outlets' => []
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

}
