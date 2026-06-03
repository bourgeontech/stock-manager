<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	public function __construct(){
        parent::__construct();
    	$this->load->model('membership_model');
    	$this->load->model('customer_model');
		ini_set('display_errors', 0);
    }
	
	/***
	 * Customer Login
	 ***/
	public function login() {
    	$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'required');
        
    	if ($this->form_validation->run() === FALSE) {
        	$this->load->view('site/layouts/bookingheader');
        	$this->load->view('site/customer/login');
        	$this->load->view('site/layouts/admin_footer');
        } else {
        	$mobile_number = $this->input->post('mobile_number'); 
        
        	if(!$this->isCustomerExists($mobile_number)) {
            	$this->session->set_flashdata('user_not_found', 'There is no user associated with this number. Please provide a valid number.');
            	redirect('customer/login');
            } else {
            	$customer = $this->customer_model->getCustomerByMobileNumber($mobile_number);
            	$this->session->set_userdata('mobile_number', $mobile_number);
            	$this->session->set_userdata('temp_customer', $customer);
            	
            	redirect('customer/verifyOtp');
            }
        }
    }

	/***
	 * Get OTP form
	 ***/
	public function verifyOtp() {
    	$this->form_validation->set_rules('otp', 'OTP', 'required');
        
    	if ($this->form_validation->run() === FALSE) {
        	$mobile_number 	= $this->session->mobile_number;
        	$otp 			= rand(1000, 9999);
        	$this->session->set_userdata('otp', $otp);
        		
        	$status = $this->sendOtp('91'.$mobile_number, $otp);
        
        	$this->load->view('site/layouts/bookingheader');
        	$this->load->view('site/customer/otp_form');
        	$this->load->view('site/layouts/admin_footer');
        } else {
        	$otp 	  	= $this->input->post('otp'); 
        	$otpSession = $this->session->userdata('otp'); 

    		if($otp != $otpSession) {
        		$this->session->set_flashdata('otp_error', 'OTP mismatch');
            	redirect('customer/verifyOtp');
        	} else {
            	$customer = $this->session->temp_customer;
            	
            	$this->session->set_userdata('customer', $customer);
            	$this->session->unset_userdata('temp_customer');
            	$this->session->unset_userdata('otp');
            	redirect('customer/account');
            }
        }
	}

	/***
	 * Account
	 ***/
	public function account() {
    	$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	
    	if ($customer) {
        	$data['customer']   = $this->db->where('id', $customer->id)->get('user_dtl')->row();
        	$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['membership'] = null;
        	if ($hasMembership) {
            	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);
            	$data['membership'] = $membership_details;
            	$this->session->set_userdata('member', $membership_details);
            }
        
        	$this->load->view('site/customer/dashboard', $data);
    	} else {
        	redirect('customer/login');
    	}
    }

	/***
	 * Account
	 ***/
	public function profile() {
    	$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	
    	if ($customer) {
        	$data['customer'] = $this->db->where('id', $customer->id)->get('user_dtl')->row();
        	$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['membership'] = null;
        	if ($hasMembership) {
            	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);
            	$data['membership'] = $membership_details;
            	$this->session->set_userdata('member', $membership_details);
            }
        
        	$this->load->view('site/customer/profile', $data);
    	} else {
        	redirect('customer/login');
    	}
    }


	public function profile_edit() {
    	$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	
    	if ($customer) {
        	$data['customer']   = $this->db->where('id', $customer->id)->get('user_dtl')->row();
        	$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['membership'] = null;
        
        	$this->form_validation->set_rules('name', 'Name', 'required');
        	$this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
        	if ($this->form_validation->run() === FALSE){
        		$this->load->view('site/customer/profile_edit', $data);
            } else {
            	$customer_id = $customer->id;
            	$insertData	 = $this->input->post();
            	$this->db->where('id', $customer_id);
            	$this->db->update('user_dtl', $insertData);
            	
            	redirect('customer/profile');
            }
    	} else {
        	redirect('customer/login');
    	}
    }

	/***
	 * Bookings
	 ***/
	public function bookings() {
    	$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	
    	if ($customer) {
        	
    		$customer_id 		= $customer->id;
    		$bookings 			= $this->membership_model->getPoojaBookings($customer_id);
    		$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['customer'] 	= $this->db->where('id', $customer->id)->get('user_dtl')->row();
        	$data['membership'] = null;
        	$data['bookings'] 	= $bookings;
        
        	if ($hasMembership) {
            	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);
            	$data['membership'] = $membership_details;
        	}
    
        	$this->load->view('site/customer/bookings', $data);
        } else {
        	redirect('customer/login');
    	}
	}

	/***
	 * Logout
	 ***/
	public function logout() {
    	$this->session->unset_userdata('mobile_number');
    	$this->session->unset_userdata('membership_id');
    	$this->session->unset_userdata('customer');
    	$this->session->unset_userdata('membership');
    
        redirect('customer/login');
    }

	/***
	 * Check if Customer Exists
	 ***/
	private function isCustomerExists($mobile_number) {
    	$this->db->where('mobile', $mobile_number);
    	$query = $this->db->get('user_dtl');

    	return $query->num_rows() > 0; // Returns true if customer with the same mobile number exists, false otherwise
	}

	/***
	 * 	Check if Member exists 
	 ***/
	private function isMemberExists($mobile_number) {
    	$this->db->where('mobile_number', $mobile_number);
    	$query = $this->db->get('memberships');

    	return $query->num_rows() > 0; // Returns true if ID exists, false otherwise
	}

	/***
	 * Send OTP
	 ***/
	public function sendOtp($mobile, $otp){
//         $message =urlencode("Dear Customer Your verification code is $otp Regards BRGEON");
        
//         $url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYEM&route=1&number=$mobile&message=$message&templateid=1707166090573587020";
    	
    	$message = urlencode("Jai Shankara, Your verification code is $otp \nRegards, \nKalady Sri Adi Shankara Madom,Telangana.");
    	$url = "http://sms.bourgeoninnovations.com/SMS_API/sendsms.php?apikey=ba071bc7-2808-11f0-9b8b-e29d2b69142c&mobile=$mobile&sendername=KSASMT&message=$message&routetype=1&tid=1607100000000347249";
    	// $message =urlencode("Your $otp will be on $otp for details please contact KALADYSANKARAMADOM REGARDS PUNYEM");
    	// $url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYEM&route=1&number=$mobile&message=$message&templateid=1707165424023889241";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $resp = curl_exec($curl);
    	print_r($resp);
        curl_close($curl);   
    }
}