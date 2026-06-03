<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(empty($this->session->refno)){
            $refno="AB".rand(1000,9999);
            $this->session->set_userdata('refno', $refno);
        }
        $this->date = date('Y-m-d h:i:s');
        // $this->amount = $this->site_model->billing_online($this->session->refno);
  		$this->billing_online = $this->session->billing_online;
    	
    	$sum = 0;

		if($this->billing_online){
        	foreach ($this->billing_online as $item) {
    			$sum += $item['rate'];
			}
        }
    
    	$this->amount = $sum;
    
    	$this->donation_online = $this->session->donation_online;
    	
    	
    	$donation = 0;

		if($this->donation_online){	
        	foreach ($this->donation_online as $item) {
    			$donation += $item['rate'];
            	
			}
        }
    
    	$this->donation_amount = $donation;
    
    	$this->kanikka_online = $this->session->kanikka_online;
    
    	include(APPPATH . 'controllers/worldline/AWLMEAPI.php');
    }
   
	public function booking(){
    	date_default_timezone_set('Asia/Kolkata');
    	$cur_time = date("H:i:s");
        $cur_date = date("Y-m-d");
        $date_next = date('Y-m-d', strtotime("+1 day"));
        $fourth_date = date('Y-m-d', strtotime("+4 day"));
     
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('mobile_no', 'Beneficiary Mobile Number', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $this->load->view('site/layouts/admin_header');
            $this->load->view('site/e_kanikka');
            $this->load->view('site/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $mobile=$this->input->post('mobile_no');
            $house=$this->input->post('house');
            $street=$this->input->post('street');
            $post=$this->input->post('post');
            $district=$this->input->post('district');
            $state=$this->input->post('state');
            $pincode=$this->input->post('pincode');
            $email=$this->input->post('email');
            $count=$this->input->post('count');
            $total=$this->input->post('total');
        	
        	$query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
            $exists = $query->num_rows();
            
        	
            if($exists==0){
                    	$this->db->query("INSERT INTO user_dtl(`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                    	
                    	$query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
                        $user_dtl = $query->first_row();
                        $customer_id = $user_dtl->customer_id;
                        
                    	$this->db->query("UPDATE user_dtl SET customer_id='$customer_id' WHERE mobile='$mobile'");
                	}else{
                	    $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
                        $user_dtl = $query->first_row();
                        $customer_id = $user_dtl->customer_id;
                        
                    	$this->db->query("UPDATE user_dtl SET customer_id='$customer_id',name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',email='$email' WHERE mobile='$mobile'");
                	}
        
            $this->session->set_userdata('mobile_no', $mobile);
        	$amount = $this->input->post('amount');
        	$data['amount']=$amount;
        	
        	$existingData = $this->session->userdata('kanikka_online');
			
            $newArray = array(
                		'customer_id' => $customer_id,
                    	'name' => $name,
                    	'diety_id' => 0,
                    	'star_id' => 0,
                    	'pooja_id' => 0,
                    	'rate' => $amount,
                    	'date' => $cur_date,
                    	'status' => 1,
                    	'total'    => $amount,
                		'qty' => 1,
                		'prasadam' => 0,
            		);
        
        			
            		$existingData = $newArray;

                    // $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`status`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$amount','$data', '1')");
        			
        			$this->session->set_userdata('kanikka_online', $existingData);
        
            		redirect('donation/kanikka_payment');
        }
    }
	
	public function kanikka_payment(){
        date_default_timezone_set('Asia/Kolkata');
        $mobileno=$this->session->mobile_no;
    	$query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobileno'");
        $user_dtl = $query->first_row();
        $customer_id = $user_dtl->customer_id;
    
        $data['bill_list']=$this->session->userdata('kanikka_online');//$this->site_model->getbillsbyrefno($customer_id);
        	$data['is_donation'] = 0;
        	if(empty($data['bill_list'])){
            	redirect('donation/booking');
        	}
    
    	$data['payment_gateway']=$this->site_model->getpaymentgateway();
    	$data['razorpay']=$this->site_model->getRazorpayCredentials();
        $data['temple_list']=$this->site_model->gettemples();
        $data['user_list']=$this->site_model->getuserbymobile($mobileno); //$this->site_model->getuserbyrefno($refno);
        $this->session->set_userdata('total_payment', $data['bill_list']['total']/100);

        $obj = new AWLMEAPI();

    	//create an object of Request Message
    	$reqMsgDTO = new ReqMsgDTO();
    
    	$data['obj'] = $obj;
    	$data['reqMsgDTO'] = $reqMsgDTO;

        if(empty($data['bill_list'])){
            redirect('donation/booking');
        }
    
    	
        $this->load->view('site/layouts/admin_header');
        $this->load->view('site/kanikka_payment',$data);
        $this->load->view('site/layouts/admin_footer');
    }

	public function do_payment($key){
        $this->load->library('razorpay');
        $fetch = $this->razorpay->fetch($key);
        $total_payment = $this->session->userdata('total_payment')*100;
    	// print_r($fetch->amount." ".$total_payment." ".$fetch->id." ".$key);
    	// exit;
        if($fetch->amount == $total_payment && $fetch->id == $key){
            $payment = $this->razorpay->payment($key, $total_payment);
            $stts = $payment['status'];
            $amd = ($payment ['amount']/100);
            $json_encode = json_encode($payment);
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
        	
// 			$message =urlencode("You've successfully booked pooja on $today for details please contact 0000000000 REGARDS PUNYEM");
        
//         	$url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYMM&route=1&number=$mobile&message=$message&templateid=1707165416494646355";


//         	$curl = curl_init($url);
//         	curl_setopt($curl, CURLOPT_URL, $url);
//         	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
//         	$resp = curl_exec($curl);
//         	curl_close($curl);
        
        	
            redirect(site_url("worldline/thankyou/".$bill_id));
        }else{
            redirect(site_url("worldline/payment"));
        }
    }

	public function response(){
		//create an Object of the above included class
		$obj = new AWLMEAPI();
	
		/* This is the response Object */
		$resMsgDTO = new ResMsgDTO();

		/* This is the request Object */
		$reqMsgDTO = new ReqMsgDTO();
		$enc_key = '6375b97b954b37f956966977e5753ee6';
	
		/* Get the Response from the WorldLine */
		$responseMerchant = $_REQUEST['merchantResponse'];
	
		$response = $obj->parseTrnResMsg( $responseMerchant , $enc_key );
    	$data['response'] = $response;
    
    	$total_payment = $this->session->userdata('total_payment')*100;
		$key = $response->getPgMeTrnRefNo();
    	
    	// $testdata= "Reference No: ".$key."<br />"."Status Code: ".$response->getStatusCode()."<br />"
    	// ."Status Desc: ".$response->getStatusDesc()."<br />"."Transaction Request Date: ".$response->getTrnReqDate()."<br />"
    	// ."RRN: ".$response->getRrn()."<br />"."AuthZCode: ".$response->getAuthZCode()."<br />";
    	// print_r($testdata);
    	// exit;
        if($response->getTrnAmt() == $total_payment && $response->getStatusCode() == 'S'){
            $status_code = $response->getStatusCode();
            $stts = ($status_code == 'S' ? 2 : 0);
            $amd = ($response->getTrnAmt()/100);
            $json_encode = json_encode($response);
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
        
            redirect(site_url("worldline/thankyou/".$bill_id));
        }else{
            redirect(site_url("worldline/payment"));
        }
    	// $this->load->view('site/layouts/admin_header');
        // $this->load->view('site/trnSuccess.php',$data);
        // redirect(site_url("worldline/thankyou"));
        // $this->load->view('site/layouts/admin_footer');
    }

	public function thankyou($bill_id=null){

        if($bill_id!=null){
            $data['bill_id']=$bill_id;
        }else{
            $data['bill_id']="";
        } 

        $this->load->view('site/layouts/admin_header');
        $this->load->view('site/thankyou_worldline', $data);
        $this->load->view('site/layouts/admin_footer');

    	$this->session->unset_userdata('billing_online');
    	$this->session->unset_userdata('donation_online');
    	$this->session->unset_userdata('mobile_number');
    	$this->session->unset_userdata('amount');
        // session_unset();     
        // session_destroy(); 
    }
    
    public function bill_print($id){
    	
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;

        $this->load->view('site/bill_print_worldline',$data);
    }
}