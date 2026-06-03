<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedulebilling extends CI_Controller {

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
        $this->amount = $this->site_model->billing_online($this->session->refno);
    	$this->load->model( 'schedulebilling_model' );
    	$this->load->model( 'pooja_model' );
    	$this->load->model( 'general_model' );
    	$this->load->model( 'site_model' );
    	$this->load->model( 'Accounts_model' );
    }

//      public function index(){
//         $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
      
//         if ($this->form_validation->run() === FALSE){
//             $last=$this->general_model->getlasbillid();
//             $last_id=$last['id'];
//             $last_id1=$last_id+1;
//             $data['last_id']=$last_id1;
//             $data['diety_list']=$this->general_model->getdietys();
//             $data['pooja_list']=$this->general_model->getpoojas();
//             $data['star_list']=$this->general_model->getstars();
//             $data['site']=$this->general_model->getsite();
//             $data['other_list']=$this->general_model->getothers();
//             $data['birth_star']=$this->general_model->getstars();
//             $query = $this->db->query("select * from site_settings where id =1"); 
//             $row = $query->row();
//             $this->load->view('admin/layouts/admin_header');
//             if($row->code_settings=='0'){
//                  $this->load->view('admin/schedulebilling/schedule_billing1',$data);
//             } else if($row->code_settings=='2'){ 
//                  $this->load->view('admin/schedulebilling/schedule/billing3',$data);
//             }
//             else{
//                  $this->load->view('admin/schedulebilling/schedule/billing',$data);
//             }
//             $this->load->view('admin/layouts/admin_footer');
//         }
//         else{
//             $name      = $this->input->post('name');
//             $house     = $this->input->post('house_name');
//             $street    = $this->input->post('street');
//             $post      = $this->input->post('post');
//             $district  = $this->input->post('district');
//             $state     = $this->input->post('state');
//             $pincode   = $this->input->post('pincode');
//             $mobile    = $this->input->post('mobile');
//             $email     = $this->input->post('email');
//             $bal_amt   = $this->input->post('balance');
        
//             $query = $this->db->query("SELECT * FROM user_dtl WHERE name='$name' AND mobile='$mobile' AND status='1'");
//             $res_count=$query->num_rows();
//             if($res_count==0){
//                 $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
//                 $user_id=$this->db->insert_id();
//                 if($bal_amt>0){
//                     $this->db->select('*');
//                     $this->db->from('ledger_group');
//                     $this->db->where('group_name', 'Customer');
//                     $query1 = $this->db->get();
//                     if ($query1->num_rows() == 0) {
//                         $date = date( 'Y-m-d H:i:s' );
//                         $data1 = array(
//                             'group_name'      =>"Customer",
//                             'group_created'   =>$date,
//                         );
//                         $this->db->insert('ledger_group', $data1);
//                         $g =$this->db->insert_id();
//                     }
//                     else{
//                         $user=$query1->row_array();
//                         $g=$user['group_id'];
//                     }
//                     $this->db->query("INSERT INTO ledger(`name`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$name','$g','$bal_amt','$bal_amt','$currentDate')");
//                     $led_id=$this->db->insert_id();
//                     $this->db->query("UPDATE user_dtl SET led_id=$led_id WHERE id='$user_id'");
//               }
//            }else{
//                 $this->db->query("UPDATE user_dtl SET name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',email='$email' WHERE mobile='$mobile'");
//                 $user=$query->row_array();
//                 $user_id=$user['id'];
//                 if($bal_amt>0){
//                     $this->db->select('*');
//                     $this->db->from('ledger_group');
//                     $this->db->where('group_name', 'Customer');
//                     $query1 = $this->db->get();
//                     if ($query1->num_rows() == 0) {
//                         $date = date( 'Y-m-d H:i:s' );
//                         $data1 = array(
//                             'group_name'      =>"Customer",
//                             'group_created'   =>$date,
//                         );
//                         $this->db->insert('ledger_group', $data1);
//                         $g =$this->db->insert_id();
//                     }else{
//                         $user=$query1->row_array();
//                         $g=$user['group_id'];
//                     }
//                     $ledquery = $this->db->query("SELECT * FROM ledger WHERE `name`='$name' AND `group`='$g'");
//                     $led_count=$ledquery->num_rows();
//                     if($led_count==0){
//                         $this->db->query("INSERT INTO ledger(`name`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$name','$g','$bal_amt','$bal_amt','$currentDate')");
//                         $led_id=$this->db->insert_id();
//                         $this->db->query("UPDATE user_dtl SET led_id=$led_id WHERE id='$user_id'");
//                     }else{
//                         $led=$ledquery->row_array();
//                         $led_id=$led['id'];
//                         $this->db->query("UPDATE ledger SET balance=balance+$bal_amt WHERE led_Id='$led_id'");
//                     }
//                 }
//             }
//             $logged=$this->loggedIn['id'];
//         }
     
//      }
	public function multy_schedule_hierarchical_pooja(){
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        $this->form_validation->set_rules('customer_id', 'Devotee', 'required');
        
    	$counter=$this->session->counter;
    	if($counter == ''){
            $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/billing/selectcounter',$data);
            $this->load->view('admin/layouts/admin_footer');
            return;
        }
    
        if ($this->form_validation->run() === FALSE){
        	$pooja_id = 38;
            $refno=$this->session->refno;
        	
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['star_list']=$this->general_model->getstars();
            $data['temple_list']=$this->general_model->gettemples();
            $data['other_list']=$this->general_model->getothers();
            $data['bill_list']=$this->schedulebilling_model->getbillsbyrefno($refno);
        	  
            $data['bill_lists']=$this->schedulebilling_model->getbillsbyrefno2($refno);
			$site_settings     = $this->db->select('*')->from('site_settings')->get()->row();
            
            $this->db->select('*');
            $this->db->from('billing_online');
            $this->db->where('reference_no', $refno);
            $query = $this->db->get();
    
            $orders = $query->result();

            $total = 0;
            if($orders) {
                $customer_id = $orders[0]->customer_id;
                
                $this->db->select('*');
                $this->db->from('user_dtl');
                $this->db->where('id', $customer_id);
                $query = $this->db->get();
        
                $user = $query->row();
        
                $this->db->select('*');
                $this->db->from('ledger');
                $this->db->where('led_Id', $user->led_id);
                $query = $this->db->get();
        
                $ledger = $query->row();
        
        		$customer_details = array(
                	"value" => $user->name.' - '.$user->mobile,
                	"label" => $user->name.' - '.$user->mobile,
                	"id" => $user->id,
                	"name" => $user->name,
                	"house" => $user->house,
                	"mobile" => $user->mobile ?? '',
                	"email" => $user->email,
                	"street" => $user->street,
                	"post" => $user->post,
                	"district" => $user->district,
                	"state" => $user->state,
                	"pincode" => $user->pincode,
            		"led_id" => $ledger->id ?? 0,
                    "led_name" => $user->led_name ?? '',
                    "balance"  => $ledger->balance ?? 0
        		);
        		
        		$data['devotee'] = $customer_details;
        		$data['customer_id'] = $customer_id;
            
            	foreach($orders as $order) {
                	if( $order->rate > 0) {
                    	$amount = ($order->qty * $order->rate);
                    } else {
                    	$amount = $order->amount;
                    }
                	$total += $amount + $order->prasadam_amt;
                }
            }	
        	
        	$data['total_amount'] = $total;
            $data['ref']=$refno;
        
        
            $this->load->view('admin/layouts/admin_header');
        	if($site_settings->code_settings==5){ 
               $this->load->view('admin/schedulebilling/multi_schedule_pooja',$data);
            } else {
               $this->load->view('admin/schedulebilling/multi_schedule_pooja_screen_6',$data);
            }
            
            $this->load->view('admin/layouts/admin_footer');
        }else{
            
            $data['temple_list']=$this->general_model->gettemples();
            
            $name=$this->input->post('name');
            $name_locale=$this->input->post('name_locale');
            $diety_id=$this->input->post('diety_id') ?? 1;
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $time=$this->input->post('time');
            $main_date=$this->input->post('main_date') ?? date('Y-m-d');
            $dates=$this->input->post('dates');
            $count=$this->input->post('count');
            $postel_charge=$this->input->post('total');
            $customer_id = $this->input->post('customer_id');

            $prasadam_yesno=$this->input->post('postal_yes');
            $postal_type = $this->input->post('postal_type');
            $prasadam_count = $this->input->post('prasadam_count');
            $qty = $this->input->post('qty');
            if ($postal_type == 'normal') {
               // $prasadam_rate = ;
               $prasadam_rate = $this->input->post('postel_rate') ?? $data['temple_list'][0]['postel_charge'];
            } else {
                $prasadam_rate = $this->input->post('postel_rate')  ?? $data['temple_list'][0]['airmail_charge'];
            }
            
            $refno=  $this->session->refno;

            $a=0;
            
            $advance = $this->input->post('advance_amount') ?? 0;
            
            $this->db->select('*');
            $this->db->from('billing_online');
            $this->db->where('reference_no', $refno);
            $query = $this->db->get();
    
            $orders = $query->result();
            
            $order_total = 0;
            $total_order_amount = 0;
            foreach($orders as $order) {
                $order_total += ($order->qty * $order->rate);
            }
            $bill_lists = $this->schedulebilling_model->getbillsbyrefno2($refno);
            
//             $coconut_rate = $this->general_model->getpoojasById(268)[0]['rate'];

//             // if($bill_lists != 0) {
//             //     if($bill_lists['mutturakkal_count']) {
//             // $order_total += ($bill_lists['mutturakkal_count'] * $coconut_rate);
//             //     }
//             // } else {
//             //     $order_total = 0;
//             // }
            
            $p_count = $prasadam_count;
            $total_order_amount += $order_total;
            foreach($pooja_id as $pooja) {
                $pooja_list=$this->site_model->getpoojasById($pooja);
                // print_r($pooja_list[0]);
                // exit;
                $rate      = $pooja_list ? $pooja_list[0]['rate'] : 0;
                // $parent_id = $pooja_list ? $pooja_list[0]['parent_id'] : 0;
                foreach($dates as $date) {
                    $total_order_amount += (1 * $rate);
                    
                    // if ($parent_id == 38) {
                    //     $total_order_amount += (1 * $coconut_rate);
                    // }
                    
                    if ($p_count > 0) {
                        $postel = $prasadam_rate;
                        $p_count--;
                    } else {
                        $postel = 0;
                    }
                    
                    $total_order_amount += $postel;
                }
            }
            
            $this->session->set_userdata('advance_amount', $advance);
            
            $data['advance_amount'] = $advance;
            
            if ($advance > 0 && $total_order_amount > $advance) {
                $this->session->set_flashdata('warning',"Order exceeds the advance amount given.");
                redirect('admin/schedulebilling/multy_schedule_hierarchical_pooja');
            }
            
            while ($a<sizeof($pooja_id)){
                $pooja=$pooja_id[$a];
                
                if ((int)$pooja != 0) {
                    $pooja_list=$this->pooja_model->getDeityPoojaById($pooja);

                    $rate=$pooja_list['rate'];
                    $diety_id=$pooja_list['deity_id'];
                    $time = $pooja_list['time'];
                    $postel=0;
                    $pcharge=$postel*$count;
                    if(!empty($dates)&&$pooja!=0&&$pooja!=""){
                        $i=0;
                        while ($i<sizeof($dates)){
                            $data=$dates[$i];
                            if ($prasadam_count > 0) {
                                $postel = $prasadam_rate;
                            	$has_prasadam = 1;
                                $prasadam_count--;
                            } else {
                            	$has_prasadam = 0;
                                $postel = 0;
                            }

                            $this->db->query("INSERT INTO billing_online(`customer_id`, `reference_no`, `name`, `name_locale`,`diety_id`,`star_id`,`pooja_id`,`qty`,`rate`,`time`,`date`,`status`,`count`,`total`,`prasadam`, `prasadam_amt`) VALUES ('$customer_id', '$refno','$name','$name_locale','$diety_id','$star_id','$pooja','$qty','$rate','$time','$data', '1','$count','$pcharge','$has_prasadam', '$postel')");
                            // $this->db->query("UPDATE billing_online SET total='$pcharge' WHERE customer_id='$customer_id', '$refno'");
    
                            $i++;
                            
                        }
                    }else{
                        $this->db->query("INSERT INTO billing_online(`customer_id`,`reference_no`, `name`,`name_locale`,`diety_id`,`star_id`,`pooja_id`,`qty`,`rate`,`time`,`date`,`status`,`count`,`total`,`prasadam`, `prasadam_amt`) VALUES ('$customer_id', '$refno','$name','$name_locale','$diety_id','$star_id','$pooja', '$qty', '$rate','$time','$main_date', '1','$count','$pcharge','$prasadam_yesno', '$postel')");
                        // $this->db->query("UPDATE billing_online SET count='$count',total='$pcharge' WHERE customer_id='$refno'");
    
                    }
                }
                $a++;
            }

            redirect('admin/schedulebilling/multy_schedule_hierarchical_pooja');
        }
    }
    
    public function discardbill($reference_no) {
        // $this->db->select('*');
        // $this->db->from('billing_online');
        $this->db->where('reference_no', $reference_no);
        // $query = $this->db->get();
        $this->db->delete('billing_online');
        
        redirect('admin/schedulebilling/multy_schedule_hierarchical_pooja');
        
    }

	public function review() {
        $this->form_validation->set_rules('total', 'total', 'required');
     	$counter = $this->session->userdata("counter");  
        if ($this->form_validation->run() === FALSE){
            $refno=$this->session->refno;
            $data['bill_list']=$this->schedulebilling_model->getbillsbyrefno1($refno);
            $data['temple_list']=$this->site_model->gettemples();
            $data['user_list']=$this->site_model->getuserbyrefno($refno);
            $data['mode']=$this->Accounts_model->getmode();
            $data['bill_list_rate']=$this->schedulebilling_model->getbillsbyrefno($refno);
            $data['bill_list_r']=$this->schedulebilling_model->getbillsbyrefno5($refno);
        
        	$data['bill_lists']=$this->schedulebilling_model->getbillsbyrefno2($refno);
			$data['postal_count']=$this->schedulebilling_model->getpostalbyrefno($refno);
        
        	if($this->db->table_exists('payment_modes')) {
            	$payment_modes = $this->db->get('payment_modes')->result_array();
            } else {
            	$payment_modes = array(
  					array('id' => '1','name' => 'Cash','slug' => 'cash'),
  					array('id' => '5','name' => 'NEFT','slug' => 'neft'),
  					array('id' => '6','name' => 'QR Code','slug' => 'qr_code'),
  					array('id' => '7','name' => 'Card','slug' => 'card'),
  					array('id' => '8','name' => 'MO','slug' => 'mo'),
  					array('id' => '10','name' => 'Endowment','slug' => 'endowment'),
  					array('id' => '11','name' => 'Cheaque','slug' => 'Cheaque'),
  					array('id' => '12','name' => 'DD','slug' => 'DD')
			    );
            }
        
        	$data['payment_modes'] = $payment_modes;
        
            if(empty($data['bill_list'])){
                redirect('admin/schedulebilling/multy_schedule_hierarchical_pooja');
            }
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/schedulebilling/multy_schedule_review',$data);
            $this->load->view('admin/layouts/admin_footer');
        } else{
            if ($this->input->post('submit')=='save'){
                $this->form_validation->set_rules('total', 'total', 'required');
                if ($this->form_validation->run() === FALSE){
                    $refno=$this->session->refno;
                    $data['bill_list']=$this->billing_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    $data['user_list']=$this->site_model->getuserbyrefno($refno);
                    
                    if(empty($data['bill_list'])){
                        redirect('admin/schedulebilling/multy_schedule_hierarchical_pooja');
                    }
                    $this->load->view('admin/layouts/admin_header');
                    $this->load->view('admin/schedulebilling/multy_schedule_review',$data);
                    $this->load->view('admin/layouts/admin_footer');
                }else{
                    $logged=$this->loggedIn['id'];
                
                	
                    $refno=$this->session->refno;
                    $reference_no=$this->input->post('reference_no');
                    $user_type=$this->input->post('user_type');
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
                    $mode=$this->input->post('mode');
                    $number=$this->input->post('number');
                    $recv_amnt=$this->input->post('recv_amt');
                    $balance_amt=$this->input->post('bal_amt') ?? 0;
                    $prasadam_rate=$this->input->post('postel_rate');
                    $prasadam_yesno=$this->input->post('postal_yes');
                    $mode_date=$this->input->post('mode_date');

                    
                    $balance_amount_option = $this->input->post('bal_amount_option');
        	        $balance_amount        = $this->input->post('balance_amount');
        	        $customer_ledger_id    = $this->input->post('customer_ledger_id');
        	        $customer_id           = $this->input->post('customer_id');
        	        
        	        $this->db->select('*');
                	$this->db->from('user_dtl');
                	$this->db->where('id', $customer_id);
                	$query = $this->db->get();
                	$customer = $query->row();
                    
                    if($customer->led_id == 0) {
                    		$insert_data = array(
                    			'label'		 => $this->schedulebilling_model->generateSlug($customer->name).'_'.$customer->id,
                        		'name' 		 => $customer->name,
                        		'name_mal'	 => json_decode($this->schedulebilling_model->translateToLcl($customer->name))->name,
                        		'opening_bal'=> 0,
                        		'group'		 => 15,
                        		'balance'	 => 0,
                    		);
                    
                    		$this->db->insert('ledger', $insert_data);
                    	
                    		$customer_ledger_id = $this->db->insert_id();
                        	
                        	$this->db->where('id', $customer->id);
                        	$this->db->update('user_dtl', array('led_id' => $customer_ledger_id));
                        }
                    
            		
                    $customer_id = $customer->id; 
                    
                    $today=date('Y-m-d');
                    $orders=$this->schedulebilling_model->getorderbyrefno($refno);
                    
                    $deity=$orders[0]['diety_id'];
                    $prasadam_count=0;
                    $total_prasadam_rate = $prasadam_count * $prasadam_rate;

                 	$bill_time=date("Y-m-d H:i:s"); 
                    
                    
                    if ($recv_amnt <= $total) {
                        $received = $recv_amnt;
                        $balance  = $balance_amt;
                    } else {
                        $balance  = 0; 
                        $received = $total;
                        $poojaDetail = $this->general_model->getpoojasById($orders[0]['pooja_id']);
                        if ($this->db->field_exists('special_pooja', 'pooja') && $poojaDetail[0]['special_pooja'] == 1) {
                            $received = $recv_amnt;
                            $total    = $recv_amnt;
        
                            $pendingPooja = $this->schedulebilling_model->checkUserHasPendingPooja($customer_id, $orders[0]['pooja_id']);
                            $this->db->select('led_id');
                            $this->db->from('user_dtl');
                            $this->db->where('id', $user_id);
                            $customer_ledger_id = $this->db->get()->row()->led_id;

                            if($pendingPooja) {
                                $this->db->set('balance', 'balance + ' . $balance_amt, false);
                                $this->db->where('led_Id', $customer_ledger_id);
                                $this->db->update('ledger');
    
            				    $today = date('Y-m-d');
                          
                          		$insert_data = array(
                        			'ledger'	 	 => $customer_ledger_id,
                            		'amount' 	 	 => $balance_amt,
                            		'mode'	      	 => 9,
                            		'narration'  	 => 'To devotee account: '.$user->name,
                            		'type'		 	 => 1,
                            		'payment_date'	 => $today,
                                	'created_Date'	 => date('Y-m-d H:i:s'),
                        		);
                        
                        		$this->db->insert('payment', $insert_data);
                        		$payment_id = $this->db->insert_id();
                        		$this->schedulebilling_model->changeStatusAdvancedBooking($pendingPooja->id, 'paid');
                        		$this->session->unset_userdata('refno');
                            
                                if($payment_id) {
                                    redirect('accounts/printPayment/'.$payment_id);
                                }
                        }
                        
                        
                    
                        } 
                    }
                    
                    $poojaDetail = $this->general_model->getpoojasById($orders[0]['pooja_id']);

                	$insertBillingData = ['diety_id'=> $deity ?? 0, 
                                                  'date'=> $today, 
                                                  'customer_id'=> (int)$customer_id, 
                                                  'count'=> $prasadam_count,
                                                  'total'=> $total, 
                                                  'mode'=> $mode, 
                                                  'number'=> $number, 
                                                  'mode_date'=> $mode_date, 
                                                  'user_id'=> $logged,
                                                  'status'=> 1, 
                                                  'bill_time'=> $bill_time, 
                                                  'recv_amt'=> $received, 
                                                  'bal_amt'=> $balance, 
                                                  'counter'=> $counter, 
                                                  'prasadam_amt'=> $total_prasadam_rate
                                                ];
                
                    if($mode != 1) {
                    	$bank_reference_no = $this->input->post('bank_reference_no');
                    	
                    	if($this->db->field_exists('bank_transaction_id', 'billing')) {
                        	$insertBillingData['bank_transaction_id'] = $bank_reference_no;
                        }
                    }
                    
                                                                
                    
                	$this->db->insert('billing', $insertBillingData);
                
                    $bill_id=$this->db->insert_id();
                    
                    
                	$billing_details = [];
                	
                	$this->db->where('id', $bill_id);
                	$this->db->update('billing', array(
                    	'bill_no'=> $bill_id
                    ));
                
                	
                	$count = (int)$prasadam_count;
                	$totalAmount=0;
                    for($i=0;$i<count($orders);$i++) {
                        $name=$orders[$i]['name'];
                        $name_locale=$orders[$i]['name_locale'];
                        $dety=$orders[$i]['diety_id'];
                        $ster=$orders[$i]['star_id'];
                        $poja=$orders[$i]['pooja_id'];
                        $time=$orders[$i]['time'];
                        $rate=$orders[$i]['rate'];  
                        $prasadam_rate = $orders[$i]['prasadam_amt'];
                        $qult=$orders[$i]['qty'] ?? 1;
                    	$amount=$orders[$i]['rate'] * $qult;
                        $data=$orders[$i]['date'];
                    	$pooja_cat = $this->pooja_model->getpoojacat($poja);
                    	
                        $detail = array(
                                                    'name' => $name,
                                                    'name_locale' => $name_locale,
                                                    'deity' => $dety,
                                                    'star' => $ster,
                                                    'pooja' => $poja,
                                                    'qty' => $qult,
                                                    'amount' => $amount,
                                                    'time' => $time,
                                                    'date' => $data,
                                                    'rate' => $rate,
                                                    'cat' => $pooja_cat,
                                                    'prasadam_yesno'=> ($prasadam_rate > 0 ? 1 : 0),
                                                    'prasadam_rate'=> $prasadam_rate ?? 0
                                                );
                            $name = $detail['name'];
                            $name_locale = $detail['name_locale'];
                        	$pooja = $detail['pooja'];
                        	$deity = $detail['deity'];
                        	$star = $detail['star'];
                        	$qty = $detail['qty'];
                        	$rate = $detail['rate'];
                        	$amount = $detail['amount'];
                        	$date = $detail['date'];
                        	$prasadam_amount = $detail['prasadam_rate'];
                        	$has_prasadam = $detail['prasadam_yesno'];
                        	
                    		$this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`name_locale`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`, `type`,`postal_amt`,`postal_yes`) VALUES ('$bill_id','$name','$name_locale', '$deity','$star','$pooja','$qty','$time','$rate','$amount','$date', '1', 'S','$prasadam_amount','$has_prasadam')");
                    		$billing_dtls_id = $this->db->insert_id();
                            
                        	if ($pooja=="2000"){
                        		$this->db->query("UPDATE mookkolakkallu SET date='$date' WHERE id='1'");
                        	}
                            
                             
            
                		
                    }
                    
                
                    
                    
                    if ($recv_amnt > $total) {
                   	  if( $balance_amount_option == 'donation' ) {
                   	    $receipt_no = $receipt_no+1;
                   	    $today= date('Y-m-d');
                      	$this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$name','8','$star','9000','1','','$balance_amt','$balance_amt','$today', '1')");
                      	$this->db->query("UPDATE billing SET total='$recv_amnt',recv_amt='$recv_amnt' WHERE id='$bill_id'");
                      } else if ($balance_amount_option == 'devaswom_fund') {
                          $receipt_no = $receipt_no+1;
                   	    $today= date('Y-m-d');
                      	$this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$name','8','$star','9002','1','','$balance_amt','$balance_amt','$today', '1')");
                      	$this->db->query("UPDATE billing SET total='$recv_amnt',recv_amt='$recv_amnt' WHERE id='$bill_id'");
                      	$this->db->select('*');
                    	$this->db->from('ledger');
                    	$this->db->where('label', 'devaswom_fund');
                    	$query = $this->db->get();
                      	
                      	if( $query->num_rows() > 0 ) {
                        	$ledger_id = $query->row()->led_Id;
                        } else {
                        	$ledger_name = 'Devaswom Fund';
                        	$insert_data = array(
                    			'label'		 => $this->billing_model->generateSlug($ledger_name),
                        		'name' 		 => $ledger_name,
                        		'name_mal'	 => json_decode($this->billing_model->translateToLcl($ledger_name))->name,
                        		'opening_bal'=> 0,
                        		'group'		 => 8,
                        		'balance'	 => 0,
                    		);
                    
                    		$this->db->insert('ledger', $insert_data);
                    	
                    		$ledger_id = $this->db->insert_id();
                        }
                      
                      	$this->db->set('balance', 'balance + ' . $balance_amt, false);
                      	$this->db->where('led_Id', $ledger_id);
                      	$this->db->update('ledger');
        				$today = date('Y-m-d');
                      
                      		$insert_data = array(
                      		    'ref_no'     => $bill_id,
                    			'ledger'	 	 => $ledger_id,
                        		'amount' 	 	 => $balance_amt,
                        		'mode'	      	 => 9,
                        		'narration'  	 => 'Devasom fund from '.$customer->name,
                        		'type'		 	 => 2,
                        		'payment_date'	 => $today,
                            	'created_Date'	 => date('Y-m-d H:i:s'),
                    		);
                    
                    		$this->db->insert('payment', $insert_data);
                    		$payment_id = $this->db->insert_id();
                      	
                      	
                      } else {
                        $this->db->select('led_id');
                        $this->db->from('user_dtl');
                        $this->db->where('id', $user_id);
                        $customer_ledger_id = $this->db->get()->row()->led_id;

                      	$this->db->set('balance', 'balance + ' . $balance_amt, false);
                      	$this->db->where('led_Id', $customer_ledger_id);
                      	$this->db->update('ledger');
        				$today = date('Y-m-d');
                      
                      		$insert_data = array(
                      		    'ref_no'        => $bill_id,
                    			'ledger'	 	 => $customer_ledger_id,
                        		'amount' 	 	 => $balance_amt,
                        		'mode'	      	 => 9,
                        		'narration'  	 => 'To devotee account: '.$customer->name,
                        		'type'		 	 => 1,
                        		'payment_date'	 => $today,
                            	'created_Date'	 => date('Y-m-d H:i:s'),
                    		);
                    
                    		$this->db->insert('payment', $insert_data);
                    		$payment_id = $this->db->insert_id();
                      }
                   }
                
                    $this->db->query("DELETE FROM billing_online WHERE customer_id='$refno'");
                    $this->session->unset_userdata('refno');
                    $this->session->unset_userdata('advance_amount');

                    redirect('admin/schedulebilling/schedule_print/'.$bill_id);
                }
            }
        }
    }

	public function multische_print2($id){
        $data['temple_list'] 	= $this->general_model->gettemples();
        $data['bill_list']   	= $this->general_model->getbillingById($id);
        $data['bill_dtls']   	= $this->general_model->getbillingdtlsById($id);
        $data['bill_id']     	= $id;
        $data['payment_id']     = $this->schedulebilling_model->checkForPayment($id);

    	//$this->load->view('admin/schedulebilling/multi_schedule_bill_print',$data);
         $this->load->view('admin/billing/multische_print2',$data);
    }
	
	public function getparentpoojasbyid() {
    	$deity_id = $this->input->post('deity_id');
    	$poojas = $this->pooja_model->getparentpoojas($deity_id);
    	
    	echo json_encode($poojas);
    }

	public function getchildpoojas() {
    	$parent_id = $this->input->post('parent_id');
    	$poojas = $this->pooja_model->getPoojaByParentId($parent_id);
    	
    	echo json_encode($poojas);
    }

	public function getchildpoojabykeyword() {
    	$parent_id = $this->input->post('parent_id');
    	$search = $this->input->post('search');
    	$date = $this->input->post('date');
    	$pooja = $this->pooja_model->getPoojaByKeyword($parent_id, $search, $date);
    
    	echo json_encode($pooja);
    }

	 public function deletebook() {
        $id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('billing_online');
        
        echo json_encode('Success');
    }

	public function schedule_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
		
    		 $counter = $this->session->userdata("counter");
    
    		 if($_SERVER['HTTP_HOST'] == "pandamangalam.templesoftware.in"){
             	$dm_print = 'admin/billing/schedule_print_pandamangalam';
             } else if($_SERVER['HTTP_HOST'] == "alathiyoor.templesoftware.in"){
             	$dm_print = 'admin/billing/schedule_print_alathiyoor';
             } else if($_SERVER['HTTP_HOST'] == "puthoor.templesoftware.in"){
             	$dm_print = 'admin/billing/schedule_print_a62_nohead';
             } else {
             	$dm_print = 'admin/billing/schedule_print_dm';
             }
    
             if($counter == ''){
                 $this->load->view('admin/billing/schedule_print_a62',$data);
             }
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                
                   if($_SERVER['HTTP_HOST'] == "tripuranthaka.templesoftware.in"){
  
             	  $this->load->view('admin/billing/schedule_print_a62_nohead',$data);}
              	else{
                    $this->load->view('admin/billing/schedule_print_a62',$data);
                }}
                else if($printer == 3){ 
                	$data['temple_list']=$this->general_model->gettemples();
        			$data['bill_list']=$this->general_model->getbillingById($id);
        			$data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        			$data['bill_id']=$id;
					$data['bill_details']=$this->general_model->getScheduleBillById($id);
    
        			$this->load->view('admin/billing/receipt_print_schedule',$data);
                   // $this->load->view('admin/billing/schedule_print_thermal',$data);
                }
                else{
                   $this->load->view($dm_print,$data);
                }
             }
    }

	public function getDatedArray() {
        $date	   = $this->input->post('date');
        $dated_type = $this->input->post('dated_type');
    	$end_year  = $this->input->post('end_year');
    	$end_month = $this->input->post('end_month');

        $result=$this->general_model->getdatedstar($date, $dated_type, $end_year, $end_month);
        echo json_encode($result);
    }
}