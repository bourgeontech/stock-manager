<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailer {

    public $mail_config;
    private $sch_setting;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('emailconfig_model');
        $this->CI->mail_config = $this->CI->emailconfig_model->getActiveEmail();
        $this->CI->load->model('setting_model');
        $this->sch_setting = $this->CI->setting_model->get();
    }

    public function send_mail($toemail, $subject, $body) {

        $mail = new PHPMailer();
        $school_name = $this->sch_setting[0]['name'];
       /** if ($this->CI->mail_config->email_type == "smtp") {

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = $this->CI->mail_config->ssl_tls;
            $mail->Host = $this->CI->mail_config->smtp_server;
            $mail->Port = $this->CI->mail_config->smtp_port;
            $mail->Username = $this->CI->mail_config->smtp_username;
            $mail->Password = $this->CI->mail_config->smtp_password;
        }*/
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
         $mail->SMTPSecure = $this->CI->mail_config->ssl_tls;
        $mail->Host = "smtp.sendgrid.net";
        $mail->Port ="587";
        $mail->Username = "apikey";
        $mail->Password = "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";
        $mail->SetFrom("Edunex <noreply@elite-edu.arpnex.com>");
        $mail->From = "noreply@elite-edu.arpnex.com";
        $mail->FromName = "Edunex";
       // $mail->AddReplyTo("Edunex <noreply@elite-edu.arpnex.com>");
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $body;
        $mail->AddAddress($toemail);
        if ($mail->Send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
