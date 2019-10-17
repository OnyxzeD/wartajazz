<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Reservation extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model(array('Reservasi_model', 'Partner_model', 'Outlet_model', 'Auth_model'));
    }

    public function index_get($user_id)
    {
        $data = $this->Reservasi_model->apiList($user_id);
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

    public function active_get($user_id)
    {
        $data = $this->Reservasi_model->activeList($user_id);
        if ($data) {
            $result = [
                'error'   => false,
                'booking' => $data
            ];
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'error' => true,
                'data'  => 'No reservations were found'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function history_get($user_id)
    {
        $data = $this->Reservasi_model->historyList($user_id);
        if ($data) {
            $result = [
                'error' => false,
                'datas' => $data
            ];
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'error' => true,
                'datas' => 'No reservations were found'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function outlet_kursi_get($outlet_id, $date)
    {
        $this->load->model('Outlet_model');
        $data = $this->Outlet_model->getKursi($outlet_id, $date);

        // Check if the users data store contains users (in case the database result returns NULL)
        if ($data > 0) {
            $result = [
                'error'   => false,
                'message' => 'success',
                'kursi'   => $data
            ];
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'error'   => REST_Controller::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Kursi kosong tidak tersedia',
                'kursi'   => 0
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function reserve_post()
    {
        $cust = $this->Auth_model->detail($this->post('customer_id'));
        $outlet_id = $this->post('outlet_id');
        $customer_id = $cust['Source_Id'];
        $orang = $this->post('orang');
        $tanggal = $this->post('tanggal');
        $jam = $this->post('jam');
        $data = [
            'outlet_id'   => $outlet_id,
            'customer_id' => $customer_id,
            'orang'       => $orang,
            'tanggal'     => $tanggal,
            'jam'         => $jam
        ];

        $reserve = $this->Reservasi_model->reserve($data);
        $this->set_response($reserve, REST_Controller::HTTP_OK);
    }

    public function cancel_get($kode_booking)
    {
        $reservation = $this->Reservasi_model->getDetail($kode_booking);
        $dt = explode(" ", $reservation['created_at']);
        $t1 = strtotime($reservation['created_at']);
        $t2 = strtotime(date("Y-m-d H:i:s"));
        $hours = ($t1 - $t2) / 3600;   //$hours = 1.7

        if ($hours < 2) {
            $result = ['error' => true, 'message' => 'Pesanan hanya bisa dibatalkan H-2 jam'];
        } else {
            $result = $this->Reservasi_model->cancel($reservation);
        }

        $this->set_response($result, REST_Controller::HTTP_OK);
    }

}
