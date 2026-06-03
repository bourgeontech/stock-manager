<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once __DIR__ . '/vendor/autoload.php';
class Email extends CI_Controller {
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }
    $site_settings 	= $this->db->select('*')->from('site_settings')->get()->row();
    
    	/***
    	 * Language Settings
    	 ***/
      	$language_settings = $this->db->field_exists('language', 'site_settings');
    
    	if($language_settings && $site_settings->language != null) {
           $this->load->language('main', $site_settings->language);
        }

        $this->loggedIn=$this->session->admin;
    	$this->load->model('General_model');
    	$this->load->library('bulk_email');
    }

	function is_valid_email($email) {
    // First, check if the email address is valid in format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    // Then, extract the domain part and check if it has a valid MX record
    $domain = substr($email, strpos($email, '@') + 1);
    
    // Check if the domain part is valid
    if (!checkdnsrr($domain, 'MX')) {
        return false;
    }
    
    return true;
}

	public function index() {
    	$email_addresses = $this->general_model->get_email_addresses();
    	
    	$addresses = array();
    	foreach ($email_addresses as $email) {
        	$email1 = $email['email'];
    		if ($this->is_valid_email($email1)) {
        		$addresses[] = $email;
    		} 
		}
    
    	$data['email_addresses'] = $addresses;
    	$this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/email/email_draft_form', $data);
        $this->load->view('admin/layouts/admin_footer');
    }

	public function send_bulk_email() {
    	
    
    	$email		 = $this->input->post('email');
    	$sender_name = $this->input->post('sender_name');
    	$email_subject = $this->input->post('email_subject');
    	$email_content = $this->input->post('email_content');

    	$config['protocol'] = 'smtp';
    	$config['smtp_host'] = 'smtp.gmail.com';
    	$config['smtp_port'] = 465; 
    	$config['smtp_crypto'] = 'ssl'; 
    	$config['smtp_user'] = 'webmasteradisankaramadom@gmail.com';
    	$config['smtp_pass'] = 'zwra quju ybmq ufuc'; 
    	$config['mailtype'] = 'html';
    	$config['charset'] = 'utf-8';
    	$config['newline'] = "\r\n"; 
    
    	$this->load->library('email');
    	$this->email->initialize($config);
    
    	$this->email->set_newline("\r\n");
    	$this->email->set_crlf("\r\n");

    	$success = true;

    	if(!empty($email)) {
        	$email_addresses = $email;
        } else {
        	$email_data = $this->general_model->get_email_addresses();
        	
        	$email_addresses = array();
        	foreach($email_data as $data) {
            	$email_addresses[] = $data['email'];
            }
        }
    
    	
    	foreach ($email_addresses as $email) {
        	
        	$this->email->from($config['smtp_user'], $sender_name);
        	$this->email->to($email);
        	$this->email->subject($email_subject);
        	$this->email->message($email_content);

        	if (!$this->email->send()) {
            	$success = false;
            	log_message('error', 'Email failed to send to ' . $email);
        	}
    	}
    
    	if ($success) {
        	redirect('admin/email/success');
    	} else {
        	redirect('error_page');
    	}
	}
	
	public function success() {
    
    	$this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/email/email_sent_success');
        $this->load->view('admin/layouts/admin_footer');
    }



}