<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Event extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model(array('Event_model'));
    }

    public function index_get()
    {
        $data = $this->Event_model->jsonData();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($data) {
            $result = [
                'error'   => false,
                'message' => "Success",
                'data'    => $data
            ];
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status'  => REST_Controller::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No partners were found',
                'data'    => null
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function detail_get($id)
    {
        $data = $this->Event_model->jsonDetail($id);
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($data) {
            $result = [
                'error'   => false,
                'message' => "Success",
                'data'    => $data
            ];
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status'  => REST_Controller::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'No events were found',
                'data'    => null
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

}
