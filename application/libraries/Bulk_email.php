<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_email {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('email');
    }

    public function send_email($from, $to, $subject, $message, $sender_name) {
        // Email configuration
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_port'] = 465; // or 587 for TLS
        $config['smtp_crypto'] = 'ssl'; // or 'tls' for TLS
        $config['smtp_user'] = 'your_email@gmail.com';
        $config['smtp_pass'] = 'your_email_password';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";

        $this->CI->email->initialize($config);
        $this->CI->email->from($from, $sender_name);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        return $this->CI->email->send();
    }
}
