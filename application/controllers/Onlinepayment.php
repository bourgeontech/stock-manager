<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onlinepayment extends CI_Controller {
	public function __construct(){
        parent::__construct();
        
   		date_default_timezone_set('Asia/Calcutta');
		$strCurDate = date('d-m-Y');

		if (isset($_SERVER['HTTPS'])) {
    		$this->host = 'https';
		} else {
    		$this->host = 'http';
		}

		$this->documentRoot = $_SERVER['DOCUMENT_ROOT'];

    	$database = $this->db->database;
    	$this->database = $database;
		$admin_data = @file_get_contents("$this->documentRoot/worldline/New/worldline_AdminData_$database.json");
    	
    	if ($admin_data === false) {
        	$admin_data = file_get_contents("$this->documentRoot/worldline/New/worldline_AdminData.json");
        }
    
		$this->mer_array = json_decode($admin_data, true);
    
    	$this->date = date('Y-m-d h:i:s');
        $query = $this->db->query("SELECT reference_no FROM billing_online WHERE deleted=0 ORDER BY id DESC LIMIT 1");

    	if ($query->num_rows() > 0) {
        	
			$lastRecord = $query->row();
			$last_reference_no = $lastRecord->reference_no;
        	$varWithoutPrefix = (int)substr($last_reference_no, 3);
        	$varWithoutPrefix++;
        	
        	$ref_no = 'PNY' . str_pad($varWithoutPrefix, 14, '0', STR_PAD_LEFT);
        	
		} else {
			$prefix = 'PNY';
			$zeros = '00000000000000';
			$serialNumber = $prefix . $zeros;
			$ref_no = $serialNumber;
		}
		
    	$this->session->set_userdata('reference_no', $ref_no);
    
  		$this->billing_online = $this->session->billing_online;
    	
    	$sum = 0;

		if($this->billing_online){
        	foreach ($this->billing_online as $item) {
    			$sum += $item['total'];
			}
        }
    
    	$this->amount = $sum;
    
    	$this->donation_online = $this->session->donation_online;
    	
    	
    	$donation = 0;

		if($this->donation_online){	
        	foreach ($this->donation_online as $item) {
    			$donation += $item['total'];
			}
        }
    
    	$this->donation_amount = $donation;
    }
	
	public function booking(){
    	// $query = $this->db->query("SELECT booking_closing_time FROM site_settings ");
    	// $booking_closing_time=$query->row()->booking_closing_time;
    	date_default_timezone_set('Asia/Kolkata');
    	$cur_time = date("H:i:s");
        $cur_date = date("Y-m-d");
        $date_next = date('Y-m-d', strtotime("+1 day"));
        $fourth_date = date('Y-m-d', strtotime("+2 day"));
     
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('mobile_no', 'Beneficiary Mobile Number', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->site_model->getonlinedietys();
            $data['pooja_list']=$this->site_model->getonlinepoojas();
            $data['star_list']=$this->site_model->getstars();

            $this->load->view('site/layouts/bookingheader');
            $this->load->view('site/online_booking/booking',$data);
            $this->load->view('site/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $mobile_no=$this->input->post('mobile_no');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
        	$qty=1;
            $star_id=$this->input->post('star_id');
            $main_date=$this->input->post('main_date');
            $dates=$this->input->post('dates');
        	
        	$query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile_no'");
            $exists = $query->num_rows();
            
            if($exists==0){
                $this->db->query("INSERT INTO user_dtl(`name`,`mobile`,`status`) VALUES ('$name','$mobile_no','1')");
            	$customer_id=$this->db->insert_id(); // dded by priysh on 07/06
				$this->db->query("UPDATE user_dtl SET customer_id='$customer_id',name='$name' WHERE mobile='$mobile_no'");
            }else{
                
                $result = $query->first_row();
                $customer_id = $result->id;
            
                $this->db->query("UPDATE user_dtl SET customer_id='$customer_id',name='$name' WHERE mobile='$mobile_no'");
            }
        
        	$ref_no=$this->session->reference_no;
        
            $this->session->set_userdata('mobile_no', $mobile_no);
        
            $checkqty=$this->site_model->getallowedquantity($pooja_id,$main_date,$customer_id);
        	$allowed_qty=$checkqty['allowed_pooja_qty'];
            $input_qty=$checkqty['billing_qty'] + $checkqty['online_qty'];
        
 
        	if($allowed_qty != 0){
        		if($allowed_qty <= $input_qty){
          			 $this->session->set_flashdata('error_view',"Booking for selected pooja is not available on ".$main_date." Please check with a future date.");
        	 		 redirect('onlinepayment/booking');
        		}
      		}
        
        	if($booking_closing_time < $cur_time){
                 if($main_date == $cur_date || $main_date == $date_next){
                 	$this->session->set_flashdata('error_view',"Booking closed for selected date. Please check with a future date.");
                 	redirect('onlinepayment/booking');
                 }
        	}
        	
            $now = strtotime($cur_date); // or your date as well
		    $your_date = strtotime($main_date);
		    $datediff = $your_date- $now;

		    $daysdiff= round($datediff / (60 * 60 * 24));

            $pooja=$this->site_model->getpoojasById($pooja_id);
            $amount=$pooja[0]['rate'];
        	$data['amount']=$amount;

        	$existingData = $this->session->userdata('billing_online');
        	$star_eng = $this->site_model->getstarbyid($star_id)->star_eng;
        	$pooja_mal = $this->site_model->getpoojabyid($pooja_id)->pooja_nm;
        	$pooja_rate = $this->site_model->getpoojabyid($pooja_id)->pooja_rt;
        	$pooja_time = $this->site_model->getpoojabyid($pooja_id)->pooja_time;
        	$deity_mal = $this->site_model->getdeitybyid($diety_id)->diety_nm;

            if(!empty($dates)){
                $i=0;
                while ($i<sizeof($dates)){
                    $data=$dates[$i];
                	
                	$this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`, `qty`, `rate`,`date`,`status`, `reference_no`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id', '$qty', '$amount','$data', '1', '$ref_no')");
                	$billing_online_id = $this->db->insert_id();
                
                	$newArray = array(
                		'customer_id' => $customer_id,
                    	'name' => $name,
                    	'diety_id' => $diety_id,
                    	'star_id' => $star_id,
                    	'pooja_id' => $pooja_id,
                    	'rate' => $amount,
                    	'date' => $data,
                    	'status' => 1,
                    	'star_eng' => $star_eng,
                    	'pooja_nm' => $pooja_mal,
                    	'pooja_rt' => $pooja_rate,
                    	'diety_nm' => $deity_mal,
                    	'total'    => $amount,
                    	'pooja_time' => $pooja_time,
                		'qty' => $qty,
                		'prasadam' => 0,
                    	'billing_online_id' => $billing_online_id
            		);
            		if($existingData)
                	{ 
                    	$updatedData = array_push($existingData, $newArray);
                	} else {
                		$existingData = array();
                		$updatedData = array_push($existingData, $newArray);
                	}
                
                    // $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`status`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$amount','$data', '1')");
                    $i++;
                }
            }else{
            	$this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`qty`,`rate`,`date`,`status`, `reference_no`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$qty','$amount','$main_date', '1', '$ref_no')");
            	$billing_online_id = $this->db->insert_id();
            
            	$newArray = array(
                		'customer_id' => $customer_id,
                    	'name' => $name,
                    	'diety_id' => $diety_id,
                    	'star_id' => $star_id,
                    	'pooja_id' => $pooja_id,
                    	'rate' => $amount,
                    	'date' => $main_date,
                    	'status' => 1,
                		'star_eng' => $star_eng,
                    	'pooja_nm' => $pooja_mal,
                    	'pooja_rt' => $pooja_rate,
                		'pooja_time' => $pooja_time,
                		'qty' => 1,
                		'prasadam' => 0,
                    	'diety_nm' => $deity_mal,
                		'total'    => $amount,
                		'billing_online_id' => $billing_online_id
            		);
                if($existingData)
                { 
                    $updatedData = array_push($existingData, $newArray);
                } else {
                	$existingData = array();
                	$updatedData = array_push($existingData, $newArray);
                }
                // $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`status`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$amount','$main_date', '1')");
            }
        	
        	$this->session->set_userdata('billing_online', $existingData);
        
            redirect('onlinepayment/booking');
        }
    }

	public function review($is_donation = null){
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        if ($this->form_validation->run() === FALSE){
        
            // $refno=$this->session->refno;
            $mobile_no=$this->session->mobile_no;
            $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile_no'");
            $result = $query->first_row();
            $customer_id = $result->id;
           
            
            // $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($customer_id);
            $data['temple_list']=$this->site_model->gettemples();
            $data['user_list']=$this->site_model->getuserbyrefno($customer_id);

        	if($is_donation) {
            	$data['bill_list']=$this->session->userdata('donation_online');//$this->site_model->getdonationsbyrefno($customer_id);
            	$data['is_donation'] = 1;
            	if(empty($data['bill_list'])){
            		redirect('onlinepayment/donation');
            	}
        	} else {
            	$data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($customer_id);
            	$data['is_donation'] = 0;
            	if(empty($data['bill_list'])){
                	redirect('onlinepayment/booking');
            	}
        	}
        
            // if(empty($data['bill_list'])){
            //     redirect('onlinepayment/booking');
            // }
            $this->load->view('site/layouts/bookingheader');
			$this->load->view('site/online_booking/review',$data);
            $this->load->view('site/layouts/admin_footer');
        } else{
            if ($this->input->post('submit')=='save'){
                $this->form_validation->set_rules('name', 'name', 'required');
                // $this->form_validation->set_rules('house', 'house', 'required');
                // $this->form_validation->set_rules('street', 'street', 'required');
                // $this->form_validation->set_rules('post', 'post', 'required');
                // $this->form_validation->set_rules('district', 'district', 'required');
                // $this->form_validation->set_rules('state', 'state', 'required');
                // $this->form_validation->set_rules('email', 'email', 'required');
                // $this->form_validation->set_rules('pincode', 'pincode', 'required');
                if ($this->form_validation->run() === FALSE){
                    $mobile_no=$this->session->mobile_no;
                    $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile_no'");
                    $result = $query->first_row();
                    $customer_id = $result->id;
            
                    $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($customer_id);
                    $data['temple_list']=$this->site_model->gettemples();
                    $data['user_list']=$this->site_model->getuserbyrefno($customer_id);
                    if(empty($data['bill_list'])){
                        redirect('onlinepayment/booking');
                    }
                
                    $this->load->view('site/layouts/admin_header');
					$this->load->view('site/online_booking/review',$data);
            		$this->load->view('site/layouts/admin_footer');
                }else{
                    $refno=$this->session->refno;
                    $name=$this->input->post('name');
                    $house=$this->input->post('house');
                    $street=$this->input->post('street');
                    $post=$this->input->post('post');
                    $district=$this->input->post('district');
                    $state=$this->input->post('state');
                    $pincode=$this->input->post('pincode');
                    $mobile=$this->input->post('mobile');
                    $email=$this->input->post('email');
                    $count=$this->input->post('count');
                    $total=$this->input->post('total');
                
                
                	$query1 = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
                    $exists=$query1->num_rows();
                	
                    
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
                	if($is_donation) {
                		$bill_list=$this->session->userdata('donation_online');//$this->site_model->getdonationsbyrefno($customer_id);
                		$data['is_donation'] = 1;
                		if(empty($bill_list)){
                    		redirect('welcome/donation');
                		}
            		} else {
                		$bill_list=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($customer_id);
                		$data['is_donation'] = 0;
                		if(empty($bill_list)){
                    		redirect('welcome/booking');
                		}
            		}
                
                	$bill_ids = array();
                	foreach($bill_list as $bill) {
						$bill_ids[] = $bill['billing_online_id'];
                    }
                	$bill_ids_string = implode(",", $bill_ids);
                	$reference_no=$this->session->reference_no;
                	
                	$update_data = array(
    					'count' => $count,
    					'total' => $total
					);

					// Use the CodeIgniter query builder to create the update query.
					$this->db->where_in('id', explode(',', $bill_ids_string));
					$this->db->update('billing_online', $update_data);
                
                	$this->session->set_userdata('mobile_no', $mobile);
                	$this->session->set_userdata('customer_id', $customer_id);
                
             		if($is_donation) {
            			redirect('onlinepayment/payment/donation');
        			} else {
            			redirect('onlinepayment/payment');
        			}
                    
                }
            }elseif ($this->input->post('submit')=='otp'){
                
                $mobile=$this->input->post('mobile');
                $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
                $user_dtl = $query1->first_row();
                $refno = $user_dtl->customer_id;
                        
                $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
                $cost=$query->num_rows();
                if($cost!=0){
                    $otp=rand(100000,999999);
                    
                    /// to send otp
                    //
                    //   $otp_st=$this->sendotp($mobile,$otp);
                    $payload = file_get_contents("https://api.msg91.com/api/v5/otp?authkey=279147AQOnnTr0R0B5fa90d9aP1&template_id=5fb76a1a18e5566b094e7050&mobile=".$mobile."&invisible=1&otp=".$otp."&userip=IPV4 User IP&email=Email ID");
                    // print_r($payload);
                    //
                    $this->db->query("UPDATE mob_otp SET status='0' WHERE mobile='$mobile'");
                    $this->db->query("INSERT INTO mob_otp(`customer_id`,`mobile`,`otp`,`status`)VALUES('$refno','$mobile','$otp','1')");
                    $data['otp']='1';
                    $data['mob']=$mobile;
                    $data['error']='0';
                }else {
                    $data['error']='1';
                }
                $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($refno);
                $data['temple_list']=$this->site_model->gettemples();
                if(empty($data['bill_list'])){
                    redirect('onlinepayment/booking');
                }
                $this->load->view('site/layouts/admin_header');
				$this->load->view('site/online_booking/review',$data);
            	$this->load->view('site/layouts/admin_footer');
            }
        	elseif ($this->input->post('submit')=='check'){
                $mobile=$this->input->post('mobile');
                $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
                $user_dtl = $query1->first_row();
                $refno = $user_dtl->customer_id;
                
                $otp=$this->input->post('otp');
                $query = $this->db->query("SELECT * FROM mob_otp WHERE mobile='$mobile' AND otp='$otp' AND status='1'");
                $cost=$query->num_rows();
                if($cost!=0){
                    $this->db->query("UPDATE mob_otp SET status='0' WHERE mobile='$mobile'");
                    $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    $data['user_list']=$this->site_model->getuserbymobile($mobile);
                    if(empty($data['bill_list'])){
                        redirect('onlinepayment/booking');
                    }
                    $this->load->view('site/layouts/admin_header');
					$this->load->view('site/online_booking/review',$data);
            		$this->load->view('site/layouts/admin_footer');
                }else {
                    $data['otp']='1';
                    $data['mob']=$mobile;
                    $data['error']='2';
                    $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    if(empty($data['bill_list'])){
                        redirect('onlinepayment/booking');
                    }
                    $this->load->view('site/layouts/admin_header');
					$this->load->view('site/online_booking/review',$data);
            		$this->load->view('site/layouts/admin_footer');
                }
            }
        }
    }

	public function payment($is_donation = null){
        date_default_timezone_set('Asia/Kolkata');
    	$this->load->library('razorpay');
    
        $mobileno=$this->session->mobile_no;
    	$query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobileno'");
        $user_dtl = $query->first_row();
        $customer_id = $user_dtl->customer_id;
    
        if($is_donation) {
    	    $data['bill_list']=$this->session->userdata('donation_online');//$this->site_model->getdonationsbyrefno($customer_id);

        	$data['is_donation'] = 1;
        	if(empty($data['bill_list'])){
        	redirect('onlinepayment/donation');
        	}
    	} else {
    	    $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($customer_id);
        	$data['is_donation'] = 0;
        	if(empty($data['bill_list'])){
            	redirect('onlinepayment/booking');
        	}
    	}
    
    	
        
    	$data['payment_gateway']=$this->site_model->getpaymentgateway();
    	$data['razorpay']=$this->site_model->getRazorpayCredentials();
    	$data['worldline']=$this->site_model->getWorldlineCredentials();
        $data['temple_list']=$this->site_model->gettemples();
        $data['user_list']=$this->site_model->getuserbymobile($mobileno); //$this->site_model->getuserbyrefno($refno);
        $paymentgateway=$this->site_model->getpaymentgateway();
    	$total_payment = 0;
    	$bill_ids = array();
    	foreach($data['bill_list'] as $bill) {
        	$total_payment += $bill['total'];
        	$bill_ids[] = $bill['billing_online_id'];
        }
    	
    	// $total_payment += ($total_payment*$data['temple_list'][0]['payment_charge']/100);
    
    	$data['order'] = $this->razorpay->createOrder($total_payment*100, 'INR');
        $bill_ids_string = implode(",", $bill_ids);

        $update_data = array(
    		'order_id' => $data['order']->id
		);

		$this->db->where_in('id', explode(',', $bill_ids_string));
		$this->db->update('billing_online', $update_data);
    
    	$this->session->set_userdata('total_payment', $total_payment);

    	$data['settings'] 	= $this->mer_array;
		$data['amount'] 	= $total_payment;
    	$data['host'] 		= $this->host;
        if(empty($data['bill_list'])){
            redirect('onlinepayment/booking');
        }
    	if($paymentgateway=='4')
    	{
        	$this->load->view('site/layouts/admin_header');
        	$this->load->view('site/payment3',$data);
        	$this->load->view('site/layouts/admin_footer');
    	}
   		else{
        	$this->load->view('site/layouts/admin_header');
        	$this->load->view('site/online_booking/payment',$data);
        	$this->load->view('site/layouts/admin_footer');
    	}
    }

	public function worldline_payment() {
    	$inputs = $this->input->post();
    	$mer_array = $this->mer_array;
    	if($mer_array['typeOfPayment'] == "TEST"){
			$inputs['amount'] = 1;
		}

		if($mer_array['enableEmandate'] == 1 && $mer_array['enableSIDetailsAtMerchantEnd'] == 1){
			$inputs['debitStartDate'] = date("d-m-Y");
			$inputs['debitEndDate'] = date("d-m-Y", strtotime($inputs['debitEndDate']));
		}

        $datastring=$inputs['mrctCode']."|".$inputs['txn_id']."|".$inputs['amount']."|".$inputs['accNo']."|".$inputs['custID']."|".$inputs['mobNo']."|".$inputs['email']."|".$inputs['debitStartDate']."|".$inputs['debitEndDate']."|".$inputs['maxAmount']."|".$inputs['amountType']."|".$inputs['frequency']."|".$inputs['cardNumber']."|".$inputs['expMonth']."|".$inputs['expYear']."|".$inputs['cvvCode']."|".$inputs['SALT'];

		$hashed = hash('sha512',$datastring);  

		$data=array("hash"=>$hashed,"data"=>array($inputs['mrctCode'],$inputs['txn_id'],$inputs['amount'],$inputs['debitStartDate'],$inputs['debitEndDate'],$inputs['maxAmount'],$inputs['amountType'],$inputs['frequency'],$inputs['custID'],$inputs['mobNo'],$inputs['email'],$inputs['accNo'],$inputs['returnUrl'],$inputs['name'],$inputs['scheme'],$inputs['currency'],$inputs['accountName'],$inputs['ifscCode'],$inputs['accountType']));

		echo json_encode($data);
    }

	public function response() {
    	$inputs = $this->input->post();
    	$mer_array = $this->mer_array;
    	$strCurDate = date('d-m-Y');
    
    	$msg 	= $inputs['msg'];
        $response_msg = explode("|", $msg);

        $res_msg = explode("|",$inputs['msg']);
        $arr_req = array(
            "merchant" => [
                "identifier" => $mer_array['merchantCode']
            ],
            "transaction" => [ "deviceIdentifier" => "S","currency" => $mer_array['currency'],"dateTime" => $strCurDate,"token" => $res_msg[5],"requestType" => "S"]
        );

        $finalJsonReq = json_encode($arr_req);

        function callAPI($method, $url, $finalJsonReq){
           $curl = curl_init();
           switch ($method){
              case "POST":
                 curl_setopt($curl, CURLOPT_POST, 1);
                 if ($finalJsonReq)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $finalJsonReq);
                 break;
              case "PUT":
                 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                 if ($finalJsonReq)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $finalJsonReq);                              
                 break;
              default:
                 if ($finalJsonReq)
                    $url = sprintf("%s?%s", $url, http_build_query($finalJsonReq));
           }
           // OPTIONS:
           curl_setopt($curl, CURLOPT_URL, $url);
           curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json',
           ));
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
           curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
           // EXECUTE:
           $result = curl_exec($curl);
           if(!$result){die("Connection Failure !! Try after some time.");}
           curl_close($curl);
           return $result;
        }

        $method = 'POST';
        $url = "https://www.paynimo.com/api/paynimoV2.req";
        $res_result = callAPI($method, $url, $finalJsonReq);
        $dualVerifyData = json_decode($res_result, true);
    
    	if($dualVerifyData['responseType'] == 'S') {
        	$status_code = $dualVerifyData['responseType'];
            $stts = ($status_code == 'S' ? 2 : 0);
            $amd = $dualVerifyData['paymentMethod']['paymentTransaction']['amount'];
        
        	$mobile=$this->session->mobile_no;
            $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
            $user_dtl = $query->first_row();
            $customer_id = $user_dtl->id;
        	
            $key = $dualVerifyData['merchantTransactionIdentifier'];
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
        }
    }
}