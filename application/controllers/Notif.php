<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    function sendNotf($to, $data)
    {
        $apiKey = "AIzaSyC-57RbhmyrE_cJ5us5Otq_untk6nMNsBk";
        $fields = ['to' => $to, 'notification' => $data];

        $headers = ['Authorization: key='.$apiKey, 'Content-Type: application/json'];
        $url = 'https://fcm.googleapis.com/fcm/send';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    public function index()
    {
        $to = "";
        $data = ['body' => 'Test'];
        print_r($this->sendNotf($to, $data));
    }
}
