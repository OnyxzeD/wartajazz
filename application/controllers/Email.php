<?php
/**
 * Created by PhpStorm.
 * User: - ASUS -
 * Date: 11/6/2018
 * Time: 11:17 AM
 */

class Email extends CI_Controller
{
    public function send($receiver, $subject, $msg)
    {
        $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'cs.tempati@gmail.com',
            'smtp_pass' => 'tempatin.aja',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('cs.tempati@gmail.com', 'Tempat.in Customer Service');
        $this->email->to($receiver);
        $this->email->subject($subject);
        $this->email->message($msg);
        if (!$this->email->send()) {
            return false;
//            show_error($this->email->print_debugger());
        } else {
//            echo 'Success to send email';
            return true;
        }
    }
}