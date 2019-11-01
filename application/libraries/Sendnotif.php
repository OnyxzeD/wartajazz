<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sendnotif
{
    private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('Auth_model');
    }

    function send($registration_ids, $title, $msg)
    {
        $fields = array(
            'registration_ids' => $registration_ids,
            // 'data'             => $message,
            'priority'         => 'high',
            'notification'     => array(
                'title' => $title,
                'body'  => $msg
            )
        );

        // firebase api key
        $apiKey = "AAAAV0ZopOM:APA91bGFmclK3BAGaDz8JMjwearih4wU2Oc-VIqyCcoOP1JFJYjb4SS5LjiJ4NAejcWDxWQEvU6aJNcTn_2rPHx2BQSLHFJLkTh0G5JvY6f8jn9givUswh4-z1dt3-tMW-PxXkyVYoEH";
//        $apiKey = "AIzaSyDib8xCmn2FYVk2-MbZuaTR1Mqh9d6uA2Y";

        //firebase server url to send the curl request
        $url = 'https://fcm.googleapis.com/fcm/send';

        //building headers for the request
        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        //Initializing curl to open a connection
        $ch = curl_init();

        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);

        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);

        //adding headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //disabling ssl support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //adding the fields in json format
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        //finally executing the curl request
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        //Now close the connection
        curl_close($ch);

        //and return the result
        return $result;
    }

    public function sendAll($title, $msg)
    {
        $users = $this->ci->Auth_model->getAllToken();
        $ids = [];
        foreach ($users as $u) {
            $ids[] = $u['token'];
        }
        return $this->send($ids, $title, $msg);
    }
}
