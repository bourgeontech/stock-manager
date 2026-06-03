 	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends CI_Controller {
	public function __construct(){
        parent::__construct();
    
    	if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }

        $this->loggedIn=$this->session->admin;
    
    	$this->load->model('membership_model');
    }

	/***
	 * 	Add Membership 
	 ***/
	public function index() {
    	// Validation
    	$this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('mobile_no', 'Beneficiary Mobile Number', 'required');
        $this->form_validation->set_rules('referral_code', 'Referral Code', 'required');
        $this->form_validation->set_rules('main_date', 'Pooja Date', 'required');
    
    		$this->load->library('razorpay');

       	 	$data['bill_list'] = $this->session->userdata('membership_data');//$this->site_model->getbillsbyrefno($customer_id);

    		$mobileno				 = $this->input->post('mobile_no');
    		$data['payment_gateway'] = $this->site_model->getpaymentgateway();
    		$data['razorpay']		 = $this->site_model->getRazorpayCredentials();
    		$data['worldline']		 = $this->site_model->getWorldlineCredentials();
        	$data['temple_list']	 = $this->site_model->gettemples();
        	$data['user_list']		 = $this->site_model->getuserbymobile($mobileno); 
        	$paymentgateway			 = $this->site_model->getpaymentgateway();
    	
    		$this->db->select('*');
    		$this->db->from('payment_modes');
    		$query = $this->db->get();
    		$payment_modes = $query->result();
    		$data['payment_modes'] = $payment_modes;
    
        	$total_payment = 0;
    		
        	$bill_ids = array();
    		
    		if($data['bill_list']) {
            
    			foreach($data['bill_list'] as $bill) {
        			$total_payment += $bill['total'];
        			$bill_ids[] 	= $bill['billing_online_id'];
        		}

            	//Edit the amount here
    			$data['order'] 		= $this->razorpay->createOrder($total_payment*100, 'INR'); 
        		$bill_ids_string 	= implode(",", $bill_ids);

        		$update_data = array(
    				'order_id' => $data['order']->id
				);

				$this->db->where_in('id', explode(',', $bill_ids_string));
				$this->db->update('billing_online', $update_data);
            } else {
            	$data['order'] 		= $this->razorpay->createOrder(5000*100, 'INR'); 
            }
    
    		$this->session->set_userdata('total_payment', $total_payment);

    	
    	if ($this->form_validation->run() === FALSE) {
			if ($this->db->field_exists('sponser', 'memberships')) {
			$this->db->select('*');
			$this->db->from('membership_sponser');
    		$query = $this->db->get();
    		$sponser = $query->result_array();
			$data['sponsers']    =$sponser;
			}
			else
			{
				$data['sponsers']    ='';
			}
    		$data['star_list'] = $this->site_model->getstars();
			$data['amount']	   = $total_payment;
        
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/membership/index',$data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        	
        	
        	
        	$title			  = $this->input->post('title');
        	$name	   		  = $title.$this->input->post('name');
            $mobile_no 		  = $this->input->post('mobile_no');
        	$email 		  	  = $this->input->post('email');
        	$house 		  	  = $this->input->post('house');
        	$street 		  = $this->input->post('street');
        	$post 		  	  = $this->input->post('post');
        	$district 		  = $this->input->post('district');
        	$state 		  	  = $this->input->post('state');
        	$pincode 		  = $this->input->post('pincode');
        	$referral_code	  = $this->input->post('referral_code');
        	$referred_by	  = $this->input->post('referred_by');
        	$qty	   		  = 1;
			$plan             = $this->input->post('plan');
			@$sponser          = @$this->input->post('sponsered');
        	@$purpose         = $this->input->post('purpose');
			if($plan!=1)
			{
			$currentDate = new DateTime();
			$val_from =date('Y-m-d');
			$currentDate->modify('+1 year');
			$formattedDate = $currentDate->format('Y-m-d');
			$val_to   =$formattedDate;
			}
            $star_id		  = $this->input->post('star_id');
        	$gothram		  = $this->input->post('gothram');
            $main_date		  = $this->input->post('main_date');
            
        $membership_pooja = $this->membership_model->getMembershipPooja($plan);
        	if(!$this->isMembershipIdExists($referral_code)) {
            	// Set flash data
				$this->session->set_flashdata('referral_error', 'Referral code is not valid');
            	redirect('admin/membership');
            }
        
        	if($this->isMemberExists($mobile_no)) {
            	// Set flash data
				$this->session->set_flashdata('mobile_error', 'Mobile number is taken!');
            	redirect('admin/membership');
            }
            
        	if($star_id == 0) { $star_id = 28; }
        
        	$query 			  = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile_no'");
            $exists 		  = $query->num_rows();
            
            if($exists == 0) {
               if ($this->db->field_exists('gothram', 'user_dtl')) {
				$this->db->query("INSERT INTO user_dtl(`name`,`mobile`,`email`, `house`, `street`, `post`, `district`, `state`, `pincode`,`status`,'gothram','star_id') VALUES ('$name','$mobile_no', '$house', '$street', '$post', '$district', '$state', '$pincode','$email','1','$gothram','$star_id')");	
				}
				else {
                $this->db->query("INSERT INTO user_dtl(`name`,`mobile`,`email`, `house`, `street`, `post`, `district`, `state`, `pincode`,`status`) VALUES ('$name','$mobile_no', '$house', '$street', '$post', '$district', '$state', '$pincode','$email','1')");
				}
            	$customer_id = $this->db->insert_id(); 
            
				$this->db->query("UPDATE user_dtl SET customer_id='$customer_id',name='$name', email='$email' WHERE mobile='$mobile_no'");
            }else{
                $result 	 = $query->first_row();
                $customer_id = $result->id;
            
                if ($this->db->field_exists('gothram', 'user_dtl')) {
                $this->db->query("UPDATE user_dtl SET customer_id='$customer_id',name='$name', email='$email',gothram='$gothram',star_id='$star_id' WHERE mobile='$mobile_no'");
				}
				else
				{
				 $this->db->query("UPDATE user_dtl SET customer_id='$customer_id',name='$name', email='$email' WHERE mobile='$mobile_no'");
				}
            }
        
        	$ref_no	= $this->session->reference_no;
        
            $this->session->set_userdata('mobile_no', $mobile_no);
        	if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") { 
			$this->db->select('*');
        	$this->db->from('membership_plans');
			$this->db->where('id',$plan);
        	$query = $this->db->get();
			$pooja_rate = $query->row()->plan_fee;
            }
        	foreach($membership_pooja as $mpooja) {
            	$pooja_id		= $mpooja->pooja_id;
	            $pooja  		= $this->site_model->getpoojasById($pooja_id)[0];
            	if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") { 
                $pooja_rate	=$pooja_rate;
                }
            	else {
            	$pooja_rate		= $pooja['rate'];
            		}
            	$pooja_mal 		= $pooja['name_mal'];
            	$pooja_time 	= $pooja['time'] ?? 'M';
            	
            	$deity_id		= $this->db->select('temple_id')->from('diety_pooja')->where('pooja_id', $pooja_id)->get()->row()->temple_id;
            	$star_eng 		= $this->site_model->getstarbyid($star_id)->star_eng;
            	$existingData   = $this->session->userdata('membership_data');
            
            	$this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`qty`,`rate`,`date`,`status`, `reference_no`) VALUES ('$customer_id','$name','$deity_id','$star_id','$pooja_id','$qty','$pooja_rate','$main_date', '1', '$ref_no')");    
            	$billing_online_id = $this->db->insert_id();
            
            	$newArray = array(
                		'customer_id' 	=> $customer_id,
                    	'name' 		  	=> $name,
                    	'diety_id' 	  	=> $deity_id,
                    	'star_id' 		=> $star_id,
                    	'pooja_id' 		=> $pooja_id,
                    	'rate' 			=> $pooja_rate,
                    	'date' 			=> $main_date,
                    	'status' 		=> 1,
                		'star_eng' 		=> $star_eng,
                    	'pooja_nm' 		=> $pooja_mal,
                    	'pooja_rt' 		=> $pooja_rate,
                		'pooja_time' 	=> $pooja_time,
                		'qty' 			=> 1,
                		'prasadam' 		=> 0,
                		'total'    		=> $pooja_rate,
                		'billing_online_id' => $billing_online_id,
                		'mobile'		=> $mobile_no,
                		'referral_code' => $referral_code,
                		'referred_by'	=> $referred_by,
						'plan'          => @$plan,
						'val_from'      => $val_from,
						'val_to'        => $val_to,
						'sponser'       => @$sponser,
                		'purpose'       => @$purpose
            		);
           
            	if($existingData)
                { 
                    $updatedData = array_push($existingData, $newArray);
                } else {
                	$existingData = array();
                	$updatedData = array_push($existingData, $newArray);
                }
           
            	$this->session->set_userdata('membership_data', $existingData);
            }

            redirect('admin/membership');
        }
    }

	/***
	 * 	Add Membership 
	 ***/
	public function review() {
    	$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required');
    	$this->form_validation->set_rules('order_id', 'Order ID', 'required');
    	
    	if ($this->form_validation->run() === FALSE) {
        	redirect('admin/membership');
        } else {
        	$order_id 			   = $this->input->post('order_id');
        	$payment_method		   = $this->input->post('payment_mode');
        
        	$this->db->select('*');
            $this->db->from('billing_online');
            $this->db->where('order_id', $order_id);
            $details = $this->db->get()->result_array();
            	
            $membership_id 		   = $this->generateMembershipId();
            $membership_data 	   = $this->session->membership_data[0];
			$mode_id 			   = $this->site_model->getPaymentMethodBySlug($payment_method);
        	$counter			   = $this->session->counter ?? 1;
			if ($this->db->field_exists('sponser', 'memberships')) {
            $membershipInsertData  = array(
        								'name'			=> $membership_data['name'], 
        								'mobile_number' => $membership_data['mobile'],
                                		'referral_code' => $membership_data['referral_code'],
                                		'referred_by'	=> $membership_data['referred_by'],
                                		'membership_id'	=> $membership_id,
									    'plan' => $membership_data['plan'],
										'valid_from' =>  $membership_data['val_from'],
										'valid_to' => $membership_data['val_to'],
										'sponser'  =>$membership_data['sponser'],
            'purpose'  => $membership_data['purpose']
            						 );
			}
			else {
			$membershipInsertData  = array(
        								'name'			=> $membership_data['name'], 
        								'mobile_number' => $membership_data['mobile'],
                                		'referral_code' => $membership_data['referral_code'],
                                		'referred_by'	=> $membership_data['referred_by'],
                                		'membership_id'	=> $membership_id
									    //'plan' => $membership_data['plan'],
										//'valid_from' =>  $membership_data['val_from'],
										//'valid_to' => $membership_data['val_to']
									
            						 );	
				
				
			}
				
        	$this->db->insert('memberships', $membershipInsertData);
            $mem_id 			  = $this->db->insert_id();
        
        	$total 				  = $membership_data['total'];
        
        	
        	if($payment_method == 'vip' || $payment_method == 'sponsor'|| $payment_method == 'trustee'|| $payment_method == 'staff'  || $payment_method == 'nominee') {
            	$total = 0;
            }
        
            $today				  = date('Y-m-d');
            $now 				  = date('Y-m-d H:i:s');
        	
        	$orders 			  = $details;
            $temple_list		  = $this->site_model->gettemples();
            $deity				  = $orders[0]['diety_id'];
            $customer_id		  = $orders[0]['customer_id'];
            $count				  = '0';
			$user_id			  = $this->session->admin['id'];
        
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`, `created_at`, `user_id`, `mode`) VALUES ('$deity','$today','---','$total','$customer_id','$count','$total', '1','$total','$counter','0000-00-00 00:00:00','N', '$now', '$user_id', '$mode_id')");
                                             
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
            
            	if($payment_method == 'vip' || $payment_method == 'sponsor' || $payment_method == 'trustee'|| $payment_method == 'staff'  || $payment_method == 'nominee') {
            		$amount = 0;
            	}
            
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','$time','$rate','$data', '1','$amount','$prasadam')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
           	}
        }
            
    	if($bill_id) {
                
            $this->db->insert('membership_transactions', array(
															'transaction_id '    	=> 'N/A',
															'membership_id'			=> $mem_id,
                        									'bill_id'				=> $bill_id,
                        									'amount'				=> $total
                        								));
                
			$customer_query = $this->db->select('*')->from('user_dtl')->where('id', $orders[0]['customer_id'])->get();
			if($customer_query->num_rows() > 0) {
				$customer = $customer_query->row();
				$email	  = $customer->email;
            
				//$this->sendBillPrint($bill_id, $email);
			}
					
        	$this->session->unset_userdata('membership_data');
            redirect('admin/membership/thankyou/'.$bill_id);
        }
    }
	/***
	 * 	Payment for Membership 
	 ***/
	public function payment($key){
        $this->load->library('razorpay');
        $fetch = $this->razorpay->fetch($key);
        $total_payment = $this->session->userdata('total_payment')*100;
    	
    	
    	if ($fetch->captured == 1) {
            	$this->db->select('id');
            	$this->db->from('billing');
            	$this->db->where('place', $key);
        		$query = $this->db->get();
        		
        		$payment = $fetch;
        		
        		if ($query->num_rows() > 0) {
                	$bill_id = $query->row()->id;
                } else {
                	$this->db->select('*');
            		$this->db->from('billing_online');
            		$this->db->where('order_id', $payment['order_id']);
            		$details = $this->db->get()->result_array();
            	
                	$membership_id = $this->generateMembershipId();
            		
                	$membership_data 	   = $this->session->membership_data[0];
                	$membershipInsertData  = array(
        										'name'			=> $membership_data['name'], 
        										'mobile_number' => $membership_data['mobile'],
                    							'referral_code' => $membership_data['referral_code'],
                    							'referred_by'	=> $membership_data['referred_by'],
                    							'membership_id'	=> $membership_id );
                
                	
                
                	// if(!$this->isMemberExists($membership_data['mobile']) ) {
        				$this->db->insert('memberships', $membershipInsertData);
                		$mem_id = $this->db->insert_id();
                    // } 
                	$this->session->set_userdata('membership_id', $membership_id);
                	
                	$payment_id          = $payment['id'];
            		$order_id            = $payment['order_id'];
            		$amount              = $payment['amount'];
                	$payment_method      = $payment['method'];
                	$bank_transaction_id = $payment['acquirer_data']['bank_transaction_id'];
                	$status              = $payment['status'];
            	
                	$mode_id = $this->site_model->getPaymentMethodBySlug($payment_method);
                	
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
                
                	$this->db->insert('razorpay_transactions', $insert_data);
                
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

                	$this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`, `created_at`) VALUES ('$deity','$today','$payment_id','$total','$customer_id','$count','$total', '2','$total','6','0000-00-00 00:00:00','O', '$now')");
                                             
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
                }
            	
            	if($bill_id) {
                		
                        $this->db->insert('membership_transactions', array(
                        	'transaction_id '    	=> $payment_id,
                        	'membership_id'			=> $mem_id,
                        	'bill_id'				=> $bill_id,
                        	'amount'				=> $total
                        ));
                
						$customer_query = $this->db->select('*')->from('user_dtl')->where('id', $orders[0]['customer_id'])->get();
						if($customer_query->num_rows() > 0) {
						$customer = $customer_query->row();
						$email	  = $customer->email;
						if($_SERVER['HTTP_HOST'] != "alathiyoor.templesoftware.in") {	
						//$this->sendBillPrint($bill_id, $email);
						}
						}
					$this->session->unset_userdata('membership_data');
            		redirect(site_url("membership/thankyou/".$bill_id));
                } 
        } 
    	else if($fetch->amount == $total_payment && $fetch->id == $key){
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
        
        	$membership_id = $this->generateMembershipId();
            	
                	$membership_data 	   = $this->session->membership_data[0];
                	$membershipInsertData  = array(
        										'name'			=> $membership_data['name'], 
        										'mobile_number' => $membership_data['mobile'],
                    							'referral_code' => $membership_data['referral_code'],
                    							'referred_by'	=> $membership_data['referred_by'],
                    							'membership_id'	=> $membership_id );
                	
                	if(!$this->isMemberExists($membership_data['mobile']) ) {
        				$this->db->insert('memberships', $membershipInsertData);
                    }
            //$this->site_model->getorderbyrefno($customer_id);
            $temple_list=$this->site_model->gettemples();
            $deity=$orders[0]['diety_id'];
            $count='0';
            $total=$this->session->userdata('total_payment');
            $this->db->query("INSERT INTO billing(`diety_id`,`transaction_date`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`bal_amt`,`counter`,`bill_time`, `bill_type`) VALUES ('$deity','$today','$today','$key','$amd','$customer_id','$count','$total','2','$total','0','6','0000-00-00 00:00:00','O')");

        	$bill_id=$this->db->insert_id();
        	$mookkolakkallu_count = 0;
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
            	if ($poja=="2000"){
                	$this->db->select('date');
                	$this->db->from('mookkolakkallu');
                	$last_mookkolakkallu_data=$this->db->get()->row()->date;
                	$data = date('Y-m-d', strtotime($last_mookkolakkallu_data . ' +1 day'));
                }
                
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','$time','$rate','$data', '1','$amount','$prasadam')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
            }
            $cust_id=$this->loggedIn['id'];
        
        	$this->session->unset_userdata('billing_online');
            $this->db->query("DELETE FROM billing_online WHERE customer_id='$customer_id'");

						// $customer_query = $this->db->select('*')->from('user_dtl')->where('id', $customer_id)->get();
						// if($customer_query->num_rows() > 0) {
						// $customer = $customer_query->row();
						// $email	  = $customer->email;
						// if($_SERVER['HTTP_HOST'] != "alathiyoor.templesoftware.in") {	
						// $this->sendBillPrint($bill_id, $email);
						// }
						// }
			$this->session->unset_userdata('membership_data');
        
        	$customer_query = $this->db->select('*')->from('user_dtl')->where('id', $orders[0]['customer_id'])->get();
        	if($customer_query->num_rows() > 0) {
                    	$customer = $customer_query->row();
                    	$email	  = $customer->email;
						if($_SERVER['HTTP_HOST'] != "alathiyoor.templesoftware.in") {	
                    		//$this->sendBillPrint($bill_id, $email);
                        }
                    }
            redirect(site_url("membership/thankyou/".$bill_id));
        }
    	else{
            redirect(site_url("worldline/payment"));
        }
    
    	
    }

	
	/***
	 * 	Generate Unique Membership ID
	 ***/
	public function generateMembershipId() {
//     	$this->load->helper('string'); // Load CodeIgniter's string helper

//     	$membership_id = random_string('alnum', 16); // Adjust the length as needed

//     	while ($this->isMembershipIdExists($membership_id)) {
//             $membership_id = random_string('alnum', 16); // Generate a new random ID
//     	}

//     	return $membership_id;
		$this->load->helper('string'); // Load CodeIgniter's string helper
		if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org"){
        	$prefix = 'KSMT'; 
        }else{
    		$prefix = 'KSDADT'; // Prefix for the membership ID
        }
    	$random_string_length = 4; // Adjust the length of the random string as needed
    	$random_string = mt_rand(1000, 9999); // Generate a random alphanumeric string

    	$membership_id = $prefix . $random_string; // Concatenate prefix and random string

   		while ($this->isMembershipIdExists($membership_id)) {
        	$random_string = mt_rand(1000, 9999); // Generate a new random alphanumeric string
        	$membership_id = $prefix . $random_string; // Concatenate prefix and new random string
    	}

    	return $membership_id;
    }

	/***
	 * 	Check if Membership ID already exists 
	 ***/
	private function isMembershipIdExists($membership_id) {
    	$this->db->where('membership_id', $membership_id);
    	$query = $this->db->get('memberships');

    	return $query->num_rows() > 0; // Returns true if ID exists, false otherwise
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
	 * 	Check if Member exists 
	 ***/
	private function isCustomerExists($mobile_number) {
    	$this->db->where('mobile', $mobile_number);
    	$query = $this->db->get('user_dtl');

    	return $query->num_rows() > 0; // Returns true if ID exists, false otherwise
	}
	
	/***
	 * 	Thank you page after Membership registration 
	 ***/
	public function thankyou($bill_id=null) {
    	$data['membership_id'] = $this->session->membership_id;
    
        if($bill_id!=null){
            $data['bill_id']=$bill_id;
        
        	$this->db->select('memberships.membership_id as membership_id');
        	$this->db->from('membership_transactions');
        	$this->db->join('memberships', 'membership_transactions.membership_id=memberships.id');
        	$this->db->where('membership_transactions.bill_id', $bill_id);
        	$query = $this->db->get();
        	$row   = $query->row();
        
        	@$data['membership_id'] = @$row->membership_id;
        }else{
            $data['bill_id']="";
        } 

        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/membership/thankyou_membership', $data);
        $this->load->view('admin/layouts/admin_footer');

    	$this->session->unset_userdata('billing_online');
    	$this->session->unset_userdata('membership');
    	$this->session->unset_userdata('donation_online');
    	$this->session->unset_userdata('mobile_number');
    	$this->session->unset_userdata('amount');
    }

	/***
	 * 	Print Membership Certificate
	 ***/
	public function bill_print($id){
    	
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
		$this->db->select('memberships.membership_id as membership_id');
        $this->db->from('membership_transactions');
        $this->db->join('memberships', 'membership_transactions.membership_id=memberships.id');
        $this->db->where('membership_transactions.bill_id', $id);
        $query = $this->db->get();
        $row   = $query->row();
        
        $data['membership_id'] = $row->membership_id;
         
        $data['membership_data'] = $this->general_model->getMembershipById($row->membership_id);
    
        $this->load->library('dpdf');
                
        
       if($_SERVER['HTTP_HOST'] == "ayyappadevalayamtaramattipeta.com"){
        $billprint = $this->load->view('site/bill_print_membership2', $data, true);}else{ $billprint = $this->load->view('site/bill_print_membership', $data, true);} 

        $this->dpdf->createPDF($billprint, 'mypdf', false);
        return; 
    }
	
	/***
	 * 	Send Mail on Membership Creation
	 ***/
	public function sendBillPrint($bill_id, $email) {
    	if(!$email || $email == '') {
        	$recepient = 'kaladyshankaramadomts@gmail.com';
        } else {
        	$recepient = array($email, 'kaladyshankaramadomts@gmail.com');
        }

    	$config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_port'] = 465; // or 587 for TLS
        $config['smtp_crypto'] = 'ssl'; // or 'tls' for TLS
        $config['smtp_user'] = 'webmasteradisankaramadom@gmail.com';
        $config['smtp_pass'] = 'zwra quju ybmq ufuc ';
        $config['mailtype'] = 'html'; // Set mailtype to html
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n"; // Important for Gmail

        // Initialize email config
        $this->email->initialize($config);

        // Set email parameters
        $this->email->from('webmasteradisankaramadom@gmail.com', 'Kalady Adishankara Madom');
        $this->email->to($recepient);
        $this->email->subject('Your  Membership has been confirmed. Stay Blessed');
        
    	$this->db->select('memberships.membership_id as membership_id');
        	$this->db->from('membership_transactions');
        	$this->db->join('memberships', 'membership_transactions.membership_id=memberships.id');
        	$this->db->where('membership_transactions.bill_id', $bill_id);
        	$query = $this->db->get();
        	$row   = $query->row();
        
        $data['membership_id'] = $row->membership_id;
    	$data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($bill_id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($bill_id);
        $data['bill_id']=$bill_id;
		
        // HTML content
        $html_content = $this->load->view('site/thankyou_membership_email', $data, TRUE);

        // Set HTML content as email message
        $this->email->message($html_content);


        // Send email
        if ($this->email->send()) {
            echo 'Email sent successfully.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

	/***
	 * 	Discard temp Membership data
	 ***/
	public function discard($id=null) {
    	if($id) {
        	$this->db->where('id', $id);
        	$this->db->update('billing_online', array('deleted'=> 1, 'deleted_at'=> date('Y-m-d H:i:s')));
        	
        	$this->session->unset_userdata('membership_data');
        }
    
    	redirect('admin/membership');
    }

	
	/***
	 * 	Member  
	 ***/

	// Member Login
	public function memberLogin() {
    	$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'required');
        
    	if ($this->form_validation->run() === FALSE) {
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/membership/member_account');
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        	$mobile_number = $this->input->post('mobile_number'); 
        
        	if(!$this->isCustomerExists($mobile_number)) {
            	redirect('admin/membership/memberLogin');
            } else {
            	$this->session->set_userdata('mobile_number', $mobile_number);
            	redirect('admin/membership/otpForm');
            }
        }
    }


	// Send OTP 
	public function sendOtp($mobile, $otp){
        $message =urlencode("Dear Customer Your verification code is $otp Regards BRGEON");
        
        $url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYEM&route=1&number=$mobile&message=$message&templateid=1707166090573587020";
    	
    	// $message =urlencode("Your $otp will be on $otp for details please contact KALADYSANKARAMADOM REGARDS PUNYEM");
    	// $url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYEM&route=1&number=$mobile&message=$message&templateid=1707165424023889241";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $resp = curl_exec($curl);
    	print_r($resp);
        curl_close($curl);   
    }

	// OTP form
	public function otpForm() {

    	if ($this->session->has_userdata('mobile_number')) {
        	$mobile_number = $this->session->mobile_number;
    	} else {
        	$mobile_number = $this->input->post('mobile_number'); 
    	}
		
    	$mobile_number = $this->input->post('mobile_number');
    
    	$customerExists = $this->isCustomerExists($mobile_number);

    	if ($customerExists) {
        	$otp				= rand(1000, 9999);
        	
        	$data['otp'] 		= $otp;
        	$this->session->set_userdata('otp', $otp);
        		
        	$status = $this->sendOtp('91'.$mobile_number, $otp);
        
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/membership/otp_form');
        	$this->load->view('admin/layouts/admin_footer');
    	} else {
        	echo "No membership found for the provided mobile number and membership ID.";
    	}
	}

	// Verify OTP
	public function verifyOtp() {
    	$this->form_validation->set_rules('otp', 'OTP', 'required');
        
    	if ($this->form_validation->run() === FALSE) {
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/membership/otp_form');
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        	$otp 	  	= $this->input->post('otp'); 
        	$otpSession = $this->session->userdata('otp'); 

    		if($otp != $otpSession) {
        		$this->session->set_flashdata('otp_error', 'OTP mismatch');
            	redirect('admin/membership/verifyOtp');
        	} else {
            	redirect('admin/membership/memberAccount');
            }
        }
	}

	// Member account
	public function memberAccount() {

    	$mobile_number = $this->session->mobile_number;

    	$customer	= $this->isCustomerExists($mobile_number);
    	
    	if ($customer) {
        	$data['customer'] = $customer;
        	$this->session->set_userdata('customer', $customer);
        	$hasMembership = $this->isMemberExists($mobile_number);
        	if ($hasMembership) {
            	$membership_details = $this->memebership_model->getMembershipDetails($mobile_number);
            	$data['membership'] = $membership_details;
            }
        
        	$this->load->view('admin/membership/membership_details', $data);
    	} else {
        	echo "No membership found for the provided mobile number and membership ID.";
    	}
	}

	// Membership Details
	public function membership_details() {
		$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	
    	if ($customer) {
        	$data['customer'] = $customer;
        	$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['membership'] = null;
        	if ($hasMembership) {
            	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);
            	$data['membership'] = $membership_details;
            }
        
        	$this->load->view('admin/membership/membership_details', $data);
    	} else {
        	redirect('customer/login');
    	}
	}


	// 
	public function referFriend() {
    	$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	
    	if ($customer) {
        	$data['customer'] = $customer;
        	$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['membership'] = null;
        	if ($hasMembership) {
            	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);
            	$data['membership'] = $membership_details;
            }
        
        	$this->load->view('admin/membership/refer_friend', $data);
    	} else {
        	redirect('customer/login');
    	}
    }

	public function referByMe() {
    	$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	if ($customer) {
        	$data['customer'] = $customer;
        	$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['membership'] = null;
        	if ($hasMembership) {
            	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);
            	$membership_id 		= $membership_details->membership_id;
            	$referred_members 	= $this->membership_model->getReferredMembers($membership_id);
				$data['membership'] = $membership_details;
        		$data['referredMembers'] = $referred_members;
            }
        
        	$this->load->view('admin/membership/refer_by_me', $data);
    	} else {
        	redirect('customer/login');
    	}

	}


	public function membership_print(){
    	
    	$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	if ($customer) {
        	$data['customer'] = $customer;
        	$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['membership'] = null;
        	if ($hasMembership) {
            	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);
            	$membership_id 		= $membership_details->membership_id;
            	$data['membership_id'] = $membership_id;
         
        		$data['membership_data'] = $this->general_model->getMembershipById($membership_id);
            	$this->load->library('dpdf');
            
               
        		$billprint = $this->load->view('admin/bill_print_membership', $data, true);

        		$this->dpdf->createPDF($billprint, 'mypdf', false);
        		return; 
            }
        
        	
    	} else {
        	redirect('customer/login');
    	}
    }
	
	public function membership_report_print($membership_id){

    	$data['membership_id'] = $membership_id;
    	$data['membership_data'] = $this->general_model->getMembershipById($membership_id);
    
    	$this->load->library('dpdf');
     if($_SERVER['HTTP_HOST']=='ayyappadevalayamtaramattipeta.com')
                {
    	$billprint = $this->load->view('admin/bill_print_membership2', $data, true);}else{
     $billprint = $this->load->view('admin/bill_print_membership', $data, true);
     }
    	$this->dpdf->createPDF($billprint, 'mypdf', false);
    	return; 
	}


	public function swaswatha_pooja() {
    
    	$customer 		= $this->session->customer;
    	$mobile_number  = $this->session->mobile_number;
    	if ($customer) {
        	$data['customer'] = $customer;
        	$hasMembership 		= $this->isMemberExists($mobile_number);
        	$data['membership'] = null;
        	if ($hasMembership) {
            	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);
            	$data['membership'] = $membership_details;
            	$membership_id 		= $membership_details->membership_id;
            	$this->load->model('general_model');

    			$this->db->select('billing_dtls.date'); 
    			$this->db->from('memberships');
    			$this->db->join('membership_transactions', 'memberships.id = membership_transactions.membership_id');
    			$this->db->join('billing', 'membership_transactions.bill_id = billing.id');
    			$this->db->join('billing_dtls', 'billing.id = billing_dtls.bill_id');
    			$this->db->where('memberships.mobile_number', $mobile_number);
    			$this->db->where('memberships.membership_id', $membership_id);
    			$query = $this->db->get();

    			if ($query->num_rows() > 0) {
        			$date = $query->row()->date; 
        			$data['date'] = $date;
        			
    			} else {
        			$data['date'] = null;
    			}
            	$this->load->view('admin/membership/swaswatha_pooja', $data);
            }
        
        	
    	} else {
        	redirect('customer/login');
    	}
	}
		
	public function memberLogout() {
    	$this->session->unset_userdata('mobile_no');
    	$this->session->unset_userdata('membership_id');
    	$this->session->unset_userdata('member');
    
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/membership/member_account');
        $this->load->view('admin/layouts/admin_footer');
    
    }

	public function bookings() {
    	$mobile_number = $this->session->mobile_no;
    	$membership_id = $this->session->membership_id;

    	$this->load->model('general_model');

    	$membership_details = $this->membership_model->getMembershipDetails($mobile_number);

    	if ($membership_details) {
        	$customer_id = $this->membership_model->getCustomerIdByMobile($mobile_number);

        	if ($customer_id) {
            	$bookings = $this->membership_model->getPoojaBookings($customer_id);

            	$data['membership'] = $membership_details;
            	$data['bookings'] = $bookings;
            	$this->load->view('admin/membership/bookings', $data);
        	} else {
            	echo "No customer found with the provided mobile number.";
        	}
    	} else {
        	echo "No membership found for the provided mobile number and membership ID.";
    	}
	}

	public function getCustomerByMobileNo() {
    	$mobile_number = $this->input->post('mobile_number');
    
    	$this->db->select('*');
    	$this->db->from('user_dtl');
    	$this->db->where('mobile', $mobile_number);
    	$query = $this->db->get();

    	if($query->num_rows() > 0) {
        	echo  json_encode($query->row());
        }
    }

	public function members() {
    	$this->db->select('*');
    	$this->db->from('memberships');
    	$query = $this->db->get();
		$data['members'] = $query->result();
    	
    	$this->load->view('admin/layouts/admin_header');
    	$this->load->view('admin/membership/member_list', $data);
    	$this->load->view('admin/layouts/admin_footer');
    }
}