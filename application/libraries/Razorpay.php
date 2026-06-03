<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include(APPPATH."third_party/Razorpay/Razorpay.php");

use Razorpay\Api\Api;

class Razorpay {
	protected $ci;

    public function __construct() {
        // Get CodeIgniter instance
        $this->ci =& get_instance();
        
        // Load the model
        $this->ci->load->model('site_model');
    	$credentials = $this->ci->site_model->getRazorpayCredentials();
    	$this->api_key = $credentials[0]->key_id;
    	$this->api_secret = $credentials[0]->key_secret;
    }
	
    // private $api_key = $this->credentials[0]->key_id; //"rzp_live_5d2La9FhpIFuVu";
    // private $api_secret = $this->credentials[0]->key_secret; //"L8yv2IQTbxYgj38XtMM4ayMd";

	public function createOrder($amount, $currency) {
    	
    	$api = new Api($this->api_key, $this->api_secret);
        $order = $api->order->create([
            'amount' => $amount,
            'currency' => $currency,
        	'payment_capture'=> '1'
        ]);
    
    	return $order;
    }

    public function fetch($key){
        $api = new Api($this->api_key, $this->api_secret);
        $fetch = $api->payment->fetch($key);
        return $fetch;
    }
    
    public function payment($key, $amount){
        $api = new Api($this->api_key, $this->api_secret);
        $fetch = $api->payment->fetch($key);
        $payment = $fetch->capture(array('amount' => $amount));
        return $payment;
    }
    
    public function refund($key, $amount){
        $api = new Api($this->api_key, $this->api_secret);
        $fetch = $api->payment->fetch($key);
        $refund = $fetch->refund(array('amount' => $amount));
        return $refund;
    }

	public function webhook() {
    	$api = new Api($this->api_key, $this->api_secret);
    
    	$webhookBody = $this->input->raw_input_stream;
        $webhookSignature = $this->input->get_request_header('X-Razorpay-Signature');
    	$webhookSecret =  '$-ug8#49h>UR=5)'; //'@104trI#PUnyM!()*]';
    
    	try {
            // Verify the webhook signature
            $api->utility->verifyWebhookSignature($webhookBody, $webhookSignature, $webhookSecret);
			$webhookData = json_decode($webhookBody, true);
			log_message('info', 'Webhook Data: ' . $webhookBody);
            // Send a success response to Razorpay
            http_response_code(200);
        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            http_response_code(400);
            echo "Webhook verification failed: " . $e->getMessage();
        }    	
    }

	public function capturedPayments($startingAt=null){
        $api = new Api($this->api_key, $this->api_secret);
    
    	$pageSize = 50;
        $payments = $api->payment->all(['skip' => $startingAt??0, 'count' => $pageSize]);
        
    	$captured = [];
    	foreach ($payments->items as $payment) {
            if ($payment->status === 'captured') {
                $captured[] = $payment;
            }
        }
    
    	return $captured;
    }
}