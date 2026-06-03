<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include(APPPATH."third_party/Razorpay/Razorpay.php");

use Razorpay\Api\Api;

class Razorpay extends CI_Controller {
	private $siteval = null;
	private $api_key = "rzp_live_DXCjymOKv4eNz0";
    private $api_secret = "nFCiXvfetpYEof5NHLMeKllx";
    public function __construct(){
        parent::__construct();

        $this->loggedIn=$this->session->admin;
        $this->date = date('Y-m-d h:i:s');
     	$this->siteval= $this->site_model->templatesettings() ? 'site'.$this->site_model->templatesettings() : 'site';
    	header('Access-Control-Allow-Origin: *');
    }

    public function test() {
    	 
      $webhookSecret = '@104trI#PUnyM!()*]'; // Replace with your actual webhook secret
      $webhookUrl = 'https://sreepoornathrayeesatemple.org/index.php/razorpay/get';
        
	  /**
       * Authorized
       **/
      $payload = '{
        "entity": "event",
        "account_id": "acc_BFQ7uQEaa7j2z7",
        "event": "payment.authorized",
        "contains": [
            "payment"
        ],
        "payload": {
            "payment": {
                "entity": {
                    "id": "pay_MkoUXRFRXMuBjX",
                    "entity": "payment",
                    "amount": 100,
                    "currency": "INR",
                    "status": "authorized",
                    "order_id": "order_DESlLckIVRkHWj",
                    "invoice_id": null,
                    "international": false,
                    "method": "netbanking",
                    "amount_refunded": 0,
                    "refund_status": null,
                    "captured": false,
                    "description": null,
                    "card_id": null,
                    "bank": "HDFC",
                    "wallet": null,
                    "vpa": null,
                    "email": "gaurav.kumar@example.com",
                    "contact": "+919876543210",
                    "notes": [],
                    "fee": null,
                    "tax": null,
                    "error_code": null,
                    "error_description": null,
                    "error_source": null,
                    "error_step": null,
                    "error_reason": null,
                    "acquirer_data": {
                        "bank_transaction_id": "0125836177"
                    },
                    "created_at": 1567674599
                  }
              }
        },
        "created_at": 1567674606
      }';

      /**
       * Captured
       **/
      // $payload = '{
      //   "entity": "event",
      //   "account_id": "acc_BFQ7uQEaa7j2z7",
      //   "event": "payment.captured",
      //   "contains": [
      //     "payment"
      //   ],
      //   "payload": {
      //     "payment": {
      //       "entity": {
      //         "id": "pay_DEAU825sJlCbGa",
      //         "entity": "payment",
      //         "amount": 100,
      //         "currency": "INR",
      //         "base_amount": 100,
      //         "status": "captured",
      //         "order_id": "order_DESlLckIVRkHWj",
      //         "invoice_id": null,
      //         "international": false,
      //         "method": "netbanking",
      //         "amount_refunded": 0,
      //         "amount_transferred": 0,
      //         "refund_status": null,
      //         "captured": true,
      //         "description": null,
      //         "card_id": null,
      //         "bank": "HDFC",
      //         "wallet": null,
      //         "vpa": null,
      //         "email": "gaurav.kumar@example.com",
      //         "contact": "+919876543210",
      //         "notes": [],
      //         "fee": 2,
      //         "tax": 0,
      //         "error_code": null,
      //         "error_description": null,
      //         "error_source": null,
      //         "error_step": null,
      //         "error_reason": null,
      //         "acquirer_data": {
      //           "bank_transaction_id": "0125836177"
      //         },
      //         "created_at": 1567674599
      //       }
      //     }
      //   },
      //   "created_at": 1567674606
      // }';

    
      /**
       * Failed
       **/
    
      // $payload = '{
      //   "entity": "event",
      //   "account_id": "acc_BFQ7uQEaa7j2z7",
      //   "event": "payment.failed",
      //   "contains": [
      //     "payment"
      //   ],
      //   "payload": {
      //     "payment": {
      //       "entity": {
      //         "id": "pay_DEAU825sJlCbGa",
      //         "entity": "payment",
      //         "amount": 50000,
      //         "currency": "INR",
      //         "status": "failed",
      //         "order_id": "order_Mk7S0NvyLw2JUG",
      //         "invoice_id": null,
      //         "international": false,
      //         "method": "netbanking",
      //         "amount_refunded": 0,
      //         "refund_status": null,
      //         "captured": false,
      //         "description": null,
      //         "card_id": null,
      //         "bank": "HDFC",
      //         "wallet": null,
      //         "vpa": null,
      //         "email": "gaurav.kumar@example.com",
      //         "contact": "+919876543210",
      //         "notes": [],
      //         "fee": null,
      //         "tax": null,
      //         "error_code": "BAD_REQUEST_ERROR",
      //         "error_description": "Payment failed",
      //         "error_source": "bank",
      //         "error_step": "payment_authorization",
      //         "error_reason": "payment_failed",
      //         "acquirer_data": {
      //           "bank_transaction_id": null
      //         },
      //         "created_at": 1567610214
      //       }
      //     }
      //   },
      //   "created_at": 1567610215
      // }';
    
    
      $ch = curl_init($webhookUrl);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
          'Content-Type: application/json',
          'X-Razorpay-Signature: ' . hash_hmac('sha256', $payload, $webhookSecret)
      ]);

      $response = curl_exec($ch);

      if ($response === false) {
          echo 'Error: ' . curl_error($ch);
      } else {
          echo 'Webhook response: ' . $response;
      }

      curl_close($ch);
    }

	public function get() {
    	
    	date_default_timezone_set('Asia/Kolkata');
    	// $this->load->library('razorpay');
    	// $details = $this->razorpay->webhook();
    	$api = new Api($this->api_key, $this->api_secret);
    
    	$webhookBody = $this->input->raw_input_stream;
    	
        $webhookSignature = $this->input->get_request_header('X-Razorpay-Signature');
    	$webhookSecret = '$-ug8#49h>UR=5)'; //'@104trI#PUnyM!()*]';
    	
    	try {
            // Verify the webhook signature
            $api->utility->verifyWebhookSignature($webhookBody, $webhookSignature, $webhookSecret);
			$webhookData = json_decode($webhookBody, true);
        	$payment = $webhookData['payload']['payment']['entity'];
        	$status   = $payment['status'];
        	$is_captured = $payment['captured'];
        	
        	$should_capture = ($status == 'authorized' && !$is_captured);
        	$captured       = ($status == 'captured' && $is_captured);
        	$failed       = ($status == 'failed' && !$is_captured);
        	
        
        		$this->db->select('*');
            	$this->db->from('billing_online');
            	$this->db->where('order_id', $payment['order_id']);
            	$details = $this->db->get()->result_array();
            
            	$payment_id          = $payment['id'];
            	$order_id            = $payment['order_id'];
            	$amount              = $payment['amount'];
                $payment_method      = $payment['method'];
                $bank_transaction_id = $payment['acquirer_data']['bank_transaction_id'];
                $status              = $payment['status'];
            	
            	$insert_data = array(
                			'payment_id'    		=> $payment_id,
                			'amount'				=> $amount/100,
                			'order_id'				=> $order_id,
                			'payment_method'		=> $payment_method,
                			'bank_transaction_id'	=> $bank_transaction_id,
                			'status'				=> $status
                		);
           
            	$update_data = array(
                			'captured'=> 1
                		);
            
            	// $this->db->select('*');
            	// $this->db->from('razorpay_transactions');
            	// $this->db->where('payment_id', $payment_id);
            	// $query = $this->db->get();

        		$this->db->insert('razorpay_transactions', $insert_data);
            	
        
			if($should_capture) {
            	$fetch = $api->payment->fetch($payment_id);
        		$payment = $fetch->capture(array('amount' => $amount));
            
            	$this->db->where('payment_id', $payment_id);
                $this->db->update('razorpay_transactions', $update_data);
            
            	$total = $amount/100;
            	$today=date('Y-m-d');
            	$now = date('Y-m-d H:i:s');
        	
        		$orders = $details;
            	$temple_list=$this->site_model->gettemples();
            	$deity=$orders[0]['diety_id'];
            	$customer_id=$orders[0]['customer_id'];
            	$count='0';
            	$this->db->query("INSERT INTO billing(`diety_id`,`transaction_date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`, `created_at`) VALUES ('$deity','$today','$payment_id','$total','$customer_id','$count','$total', '2','$total','6','0000-00-00 00:00:00','O', '$now')");

        		$bill_id=$this->db->insert_id();
        

            	for($i=0;$i<count($orders);$i++){
                $name=$orders[$i]['name'];
                $dety=$orders[$i]['diety_id'];
                $ster=$orders[$i]['star_id'];
                $poja=$orders[$i]['pooja_id'];
                $rate=$orders[$i]['rate'];
                $prasadam=$orders[$i]['prasadam'];
                $time=$orders[$i]['time'];
                $qult=$orders[$i]['qty'];
                $amount=$qult*$rate;
                $data=$orders[$i]['date'];
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','$time','$rate','$data', '1','$amount','$prasadam')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
                
                if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
                    
                    	$pooja_name = $this->db->where('id', $poja)->get('pooja')->row()->name;
                    	$customer = $this->db->where('id', $customer_id)->get('user_dtl')->row();
                    	$customer_name = $customer->name;
                    	$mobile = $customer->mobile;
                		$message = urlencode("Jai Shankara, Dear $customer_name,Your  pooja $pooja_name on $data at Kalady Sri Adi Shankara  Madom, Telangana. We look forward to your participation. For any inquiries, 8350903080 n Pranavam");
    					$url = "http://sms.bourgeoninnovations.com/SMS_API/sendsms.php?apikey=22fae393-3f72-11ef-a4f5-e29d2b69142c&mobile=$mobile&sendername=PRNVMS&message=$message&routetype=1&tid=1607100000000317646";
                
                		$curl = curl_init($url);
        				curl_setopt($curl, CURLOPT_URL, $url);
        				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        				$resp = curl_exec($curl);
    					print_r($resp);
        				curl_close($curl);
                    }
            }
            } 
        	else if($captured) {
        		
            	$this->db->where('payment_id', $payment_id);
                $this->db->update('razorpay_transactions', $update_data);
            
            	$total = $amount/100;
            	$today=date('Y-m-d');
            	$now = date('Y-m-d H:i:s');
        	
        		$orders = $details;
            	$temple_list=$this->site_model->gettemples();
            	$deity=$orders[0]['diety_id'];
            	$customer_id=$orders[0]['customer_id'];
            	$count='0';
            	$this->db->query("INSERT INTO billing(`diety_id`,`transaction_date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`, `created_at`) VALUES ('$deity','$today','$payment_id','$total','$customer_id','$count','$total', '2','$total','6','0000-00-00 00:00:00','O', '$now')");

        		$bill_id=$this->db->insert_id();
        

            	for($i=0;$i<count($orders);$i++){
                $name=$orders[$i]['name'];
                $dety=$orders[$i]['diety_id'];
                $ster=$orders[$i]['star_id'];
                $poja=$orders[$i]['pooja_id'];
                $rate=$orders[$i]['rate'];
                $prasadam=$orders[$i]['prasadam'];
                $time=$orders[$i]['time'];
                $qult=$orders[$i]['qty'];
                $amount=$qult*$rate;
                $data=$orders[$i]['date'];
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','$time','$rate','$data', '1','$amount','$prasadam')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
                if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
                    
                    	$pooja_name = $this->db->where('id', $poja)->get('pooja')->row()->name;
                    	$customer = $this->db->where('id', $customer_id)->get('user_dtl')->row();
                    	$customer_name = $customer->name;
                    	$mobile = $customer->mobile;
                		$message = urlencode("Jai Shankara, Dear $customer_name,Your  pooja $pooja_name on $data at Kalady Sri Adi Shankara  Madom, Telangana. We look forward to your participation. For any inquiries, 8350903080 n Pranavam");
    					$url = "http://sms.bourgeoninnovations.com/SMS_API/sendsms.php?apikey=22fae393-3f72-11ef-a4f5-e29d2b69142c&mobile=$mobile&sendername=PRNVMS&message=$message&routetype=1&tid=1607100000000317646";
                
                		$curl = curl_init($url);
        				curl_setopt($curl, CURLOPT_URL, $url);
        				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        				$resp = curl_exec($curl);
    					print_r($resp);
        				curl_close($curl);
                    }
            }
            	
            } 
        	else {
            	
            }
            // Send a success response to Razorpay
            http_response_code(200);
        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            http_response_code(400);
            echo "Webhook verification failed: " . $e->getMessage();
        }  
    }

    public function do_payment($key){
    	date_default_timezone_set('Asia/Kolkata');
        $this->load->library('razorpay');
        $fetch = $this->razorpay->fetch($key);
        $total_payment = $this->session->userdata('total_payment')*100;

        if($fetch->amount == $total_payment && $fetch->id == $key){
            $payment = $this->razorpay->payment($key, $total_payment);
            $stts = $payment['status'];
            $amd = ($payment ['amount']/100);
            $json_encode = json_encode($payment);
            
        	$this->session->unset_userdata('reference_no');
        
        	$mobile=$this->session->mobile_no;
            $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
            $user_dtl = $query->first_row();
            $customer_id = $user_dtl->id;
        	
            $today=date('Y-m-d');
        	
        	if(empty($this->session->userdata('billing_online'))){
            	$orders=$this->session->userdata('donation_online');
        	} else {
            	$orders=$this->session->userdata('billing_online');
            }
            //$this->site_model->getorderbyrefno($customer_id);
            $temple_list=$this->site_model->gettemples();
            $deity=$orders[0]['diety_id'];
            $count='0';
            $total=$this->session->userdata('total_payment');
            $this->db->query("INSERT INTO billing(`diety_id`,`transaction_date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`) VALUES ('$deity','$today','$key','$amd','$customer_id','$count','$total', '2','$total','6','0000-00-00 00:00:00','O')");

        	$bill_id=$this->db->insert_id();
        
            for($i=0;$i<count($orders);$i++){
                $name=$orders[$i]['name'];
                $dety=$orders[$i]['diety_id'];
                $ster=$orders[$i]['star_id'];
                $poja=$orders[$i]['pooja_id'];
                $rate=$orders[$i]['rate'];
                $prasadam=$orders[$i]['prasadam'];
                $time=$orders[$i]['time'];
                $qult=$orders[$i]['qty'];
                $amount=$qult*$rate;
                $data=$orders[$i]['date'];
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','$time','$rate','$data', '1','$amount','$prasadam')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
            }
            $cust_id=$this->loggedIn['id'];
        
        	$this->session->unset_userdata('billing_online');
            $this->db->query("DELETE FROM billing_online WHERE customer_id='$customer_id'");
        	

            redirect(site_url("welcome/thankyou/".$bill_id));
        }else{
            redirect(site_url("welcome/address"));
        }
    }
    
	public function discard($id=null) {
    	
    	$mobile = $this->session->mobile_no;
    	$query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
        $user_dtl = $query->first_row();
    	$customer_id=$user_dtl->id;
    	
    	if($id) {
        	
        	$billingOnline = $this->session->userdata('billing_online');
        	$details = $billingOnline[$id];

        	$this->db->where('id', $details['billing_online_id']);
        	$this->db->update('billing_online', array('deleted'=> 1, 'deleted_at'=> date('Y-m-d H:i:s')));
        	
			unset($billingOnline[$id]);
        	$this->session->set_userdata('billing_online', $billingOnline);
        } else {
        
        	$billingOnline = $this->session->userdata('billing_online');
        	
			foreach($billingOnline as $details) {
        		$this->db->where('id', $details['billing_online_id']);
        		$this->db->update('billing_online', array('deleted'=> 1, 'deleted_at'=> date('Y-m-d H:i:s')));
            }
        	$this->session->unset_userdata('billing_online');
        }
		
    	// $this->db->query("DELETE FROM billing_online WHERE customer_id='$customer_id'");
    	if(empty($this->session->userdata('billing_online'))){
        	redirect('welcome/booking');
       	} else {
        	redirect('welcome/review');
        }
    
    }

	public function discardDonation($id=null) {
    	$mobile = $this->session->mobile_no;
    	$query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
        $user_dtl = $query->first_row();
    	$customer_id=$user_dtl->id;
    	$has_id = $id >= 0;
    
			if($has_id) {
            	$donationOnline = $this->session->userdata('donation_online');
            	$details = $donationOnline[$id];

        		$this->db->where('id', $details['billing_online_id']);
        		$this->db->update('billing_online', array('deleted'=> 1, 'deleted_at'=> date('Y-m-d H:i:s')));
            	unset($donationOnline[$id]);
            	$this->session->set_userdata('donation_online', $donationOnline);
			} else {
            	$donationOnline = $this->session->userdata('donation_online');
        	
				foreach($donationOnline as $details) {
        			$this->db->where('id', $details['billing_online_id']);
        			$this->db->update('billing_online', array('deleted'=> 1, 'deleted_at'=> date('Y-m-d H:i:s')));
            	}
				$this->session->unset_userdata('donation_online');
			}
    	// $this->db->query("DELETE FROM billing_online WHERE customer_id='$customer_id'");

    	if(empty($this->session->userdata('donation_online'))){
    		redirect('welcome/donation');
    	} else {
    		redirect('welcome/review/donation');
    	}
    }

    public function thankyou($bill_id=null){
        if($bill_id!=null){
            $data['bill_id']=$bill_id;
        }else{
            $data['bill_id']="";
        } 

        $this->load->view($this->siteval.'/layout1/header');
        $this->load->view($this->siteval.'/thankyou',$data);
        $this->load->view($this->siteval.'/layout1/footer');

    	$this->session->unset_userdata('billing_online');
    	$this->session->unset_userdata('donation_online');
    	$this->session->unset_userdata('mobile_number');
    	$this->session->unset_userdata('amount');
        // session_unset();     
        // session_destroy(); 
    }
	public function bookingend(){

        $this->load->view($this->siteval.'/layout1/header');
        $this->load->view($this->siteval.'/bookingend',$data);
        $this->load->view($this->siteval.'/layout1/footer');

    }
    
    public function bill_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
        $this->load->view($this->siteval.'/bill_print',$data);
    }
    
    public function summary_print(){
        $data['temple_list']=$this->general_model->gettemples();
        $data['user_id']=$this->loggedIn['id'];
        $this->load->view($this->siteval.'/billsum_print',$data);
    }

    


}