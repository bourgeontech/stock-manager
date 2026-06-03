<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once __DIR__ . '/vendor/autoload.php';
class Billing extends CI_Controller {
    public function __construct(){
        parent::__construct();
       date_default_timezone_set("Asia/Calcutta");
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }
        if(empty($this->session->refno)){
            $refno="AB".rand(1000,9999);
            $this->session->set_userdata('refno', $refno);
        }
        $this->loggedIn=$this->session->admin;
        $this->amount = $this->site_model->billing_online($this->session->refno);
        $this->load->model( 'Accounts_model' );
    	$this->load->model( 'Report_model' );
    	$this->load->model( 'pooja_model' );
    	$this->load->model( 'Cms_model' );
    	$this->load->model( 'schedulebilling_model' );
    
    	$site_settings 	= $this->db->select('*')->from('site_settings')->get()->row();
    
    	/***
    	 * Language Settings
    	 ***/
      	$language_settings = $this->db->field_exists('language', 'site_settings');
    
    	if($language_settings && $site_settings->language != null) {
           $this->load->language('main', $site_settings->language);
        }
    }

	public function multy_schedule(){
    	$counter = $this->session->userdata("counter");  
        if($counter == ''){
            $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/billing/selectcounter',$data);
            $this->load->view('admin/layouts/admin_footer');
            return;
        }
    
    	$query = $this->db->query("select * from site_settings where id =1"); 
        $row = $query->row();
            
		if($row->code_settings=='5'){ 
               redirect('admin/schedulebilling/multy_schedule_hierarchical_pooja');
        }
    
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        
    	$site_settings = $row;
    	$site_settings_fields = $this->db->list_fields('site_settings');
		$add_qty = in_array('custom_multi_qty', $site_settings_fields);  
    	
    	$data['site_settings'] = $site_settings;
        if ($this->form_validation->run() === FALSE){
            $refno=$this->session->refno;
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['star_list']=$this->general_model->getstars();
            $data['temple_list']=$this->general_model->gettemples();
            $data['other_list']=$this->general_model->getothers();
            $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
            $data['bill_lists']=$this->site_model->getbillsbyrefno2($refno);
        	$data['total_bill_amount'] = $this->schedulebilling_model->getTotalBillAmount($refno) ?? 0;
            $data['ref']=$refno;

			
        	
            // $data['bill_list']=$this->site_model->getbillsbyrefno($id);
            // if(empty($data['bill_list'])){
            //                 redirect('admin/admin/multy_schedule');
            //             }
            // $id=$this->loggedIn['id'];
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/multy_schedule',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $time=$this->input->post('time');
            $main_date=$this->input->post('main_date');
            $dates=$this->input->post('dates');
            $count=$this->input->post('count');
            $postel_charge=$this->input->post('total');
            // $prasad_amt=$this->input->post('rate');
            $prasadam_yesno=$this->input->post('prasadham');
            $refno=$this->session->refno;
          
        
        	// if($add_qty && $row->custom_multi_qty == 1) {
        	// $qty = $this->input->post('qty') ?? 1;
        	// } else {
        	// $qty = 1;
        	// }
        	$qty = $this->input->post('qty') ?? 1;

            $a=0;
            while ($a<sizeof($pooja_id)){
                $pooja=$pooja_id[$a];
                $pooja_list=$this->site_model->getpoojasById($pooja);
                $rate=$pooja_list[0]['rate'];
                $postel=$pooja_list[0]['postel_charge'];
                $pcharge=$postel*$count;
                if(!empty($dates)&&$pooja!=0&&$pooja!=""){
                    $i=0;
                    while ($i<sizeof($dates)){
                        $data=$dates[$i];
                        $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`qty`,`rate`,`time`,`date`,`status`,`count`,`total`,`prasadam`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja','$qty','$rate','$time','$data', '1','$count','$pcharge','$prasadam_yesno')");
                        // $this->db->query("UPDATE billing_online SET total='$pcharge' WHERE customer_id='$refno'");

                        $i++;
                    }
                }else{
                    $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`qty`,`rate`,`time`,`date`,`status`,`count`,`total`,`prasadam`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja','$qty','$rate','$time','$main_date', '1','$count','$pcharge','$prasadam_yesno')");
                    // $this->db->query("UPDATE billing_online SET count='$count',total='$pcharge' WHERE customer_id='$refno'");

                }
                $a++;
            }
            redirect('admin/billing/multy_schedule');
        }
    }

	public function review(){
        $this->form_validation->set_rules('total', 'total', 'required');
     	$counter = $this->session->userdata("counter");  
    
    	$site_settings_fields = $this->db->list_fields('site_settings');
		$add_qty = in_array('custom_multi_qty', $site_settings_fields);
    
        if ($this->form_validation->run() === FALSE){
            $refno=$this->session->refno;
            $data['bill_list']=$this->site_model->getbillsbyrefno1($refno);
            $data['temple_list']=$this->site_model->gettemples();
            $data['user_list']=$this->site_model->getuserbyrefno($refno);
            $data['mode']=$this->Accounts_model->getmode();
            $data['bill_list_rate']=$this->site_model->getbillsbyrefno($refno);
            $data['bill_list_r']=$this->site_model->getbillsbyrefno5($refno);




            if(empty($data['bill_list'])){
                redirect('admin/admin/multy_schedule');
            }
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/review',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            if ($this->input->post('submit')=='save'){
                $this->form_validation->set_rules('total', 'total', 'required');
                if ($this->form_validation->run() === FALSE){
                    $refno=$this->session->refno;
                    $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    $data['user_list']=$this->site_model->getuserbyrefno($refno);
                    if(empty($data['bill_list'])){
                        redirect('admin/admin/multy_schedule');
                    }
                    $this->load->view('admin/layouts/admin_header');
                    $this->load->view('admin/billing/review',$data);
                    $this->load->view('admin/layouts/admin_footer');
                }else{
                    $logged=$this->loggedIn['id'];
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
                    $mode=$this->input->post('mode');
                    $number=$this->input->post('number');
                    $recv_amnt=$this->input->post('recv_amt');
                    $balance_amt=$this->input->post('bal_amt');
                    $prasadam_rate=$this->input->post('postel_rate');
                    $prasadam_yesno=$this->input->post('postal_yes');
                    $mode_date=$this->input->post('mode_date');
                    $this->db->query("UPDATE billing_online SET count='$count' WHERE customer_id='$refno'");
                    $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile' AND status='1'");
                    $cost=$query->num_rows();
                   // print $cost;exit;
                    if($cost==0){
                        $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                        $user_id=$this->db->insert_id();
                    }else{
                        $this->db->query("UPDATE user_dtl SET name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',mobile='$mobile',email='$email' WHERE customer_id='$refno'");
                        $user=$query->row_array();
                        $user_id=$user['id'];
                    }
                    $today=date('Y-m-d');
                    $orders=$this->site_model->getorderbyrefno($refno);
                    $deity=$orders[0]['diety_id'];
                    $count=$orders[0]['count'];
                    $prasadam_rate = $count * $prasadam_rate;
                    // print_r($orders);exit;

                 $bill_time=date("Y-m-d H:i:s"); 
                
                    $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`mode`,`number`,`mode_date`,`user_id`,`status`,`bill_time`,`recv_amt`,`bal_amt`,`counter`,`prasadam_amt`) VALUES ('$deity','$today','','','$user_id','$count','$total','$mode','$number','$mode_date', '$logged', 
                    '1','$bill_time','$recv_amnt','$balance_amt','$counter','$prasadam_rate')");
                    $bill_id=$this->db->insert_id();
                    for($i=0;$i<count($orders);$i++){
                        $name=$orders[$i]['name'];
                        $dety=$orders[$i]['diety_id'];
                        $ster=$orders[$i]['star_id'];
                        $poja=$orders[$i]['pooja_id'];
                        $time=$orders[$i]['time'];
                        $rate=$orders[$i]['rate'];  
                        $amount=$orders[$i]['total'];
                    	$qult = $orders[$i]['qty'];
                        
                        $data=$orders[$i]['date'];
                        $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_amt`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','M','$rate','$amount','$data', '1','S','$prasadam_rate','$prasadam_yesno')");
                        if ($poja=="2000"){
                            $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                        }
                    }
                    $query=$this->db->query("SELECT id FROM user_dtl WHERE customer_id='$refno'")->result_array();
                    $cust_id=$query[0]['id'];
                    $this->db->query("UPDATE billing SET customer_id='$cust_id' WHERE id='$bill_id'");
                    $this->db->query("DELETE FROM billing_online WHERE customer_id='$refno'");
                    $this->session->unset_userdata('refno');
                    redirect('admin/billing/multische_print2/'.$bill_id);
                }
            }
        }
    }

	public function multische_print2($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;

        $this->load->view('admin/billing/multische_print2',$data);
    }

	public function online_bills($status=null,$date=null) {
   				if($this->input->post('status')) {
            		$status = $this->input->post('status');
                } else {
                	$status = $status;
                }
    
    			if($status) {
            	$data['status'] = $status;
          
            	if($this->input->post('date_from')) {
            		$dateFrom = $this->input->post('date_from');
                } else {
                	$dateFrom = $date;
                }
            
            	if($this->input->post('date_to')) {
            		$dateTo = $this->input->post('date_to');
                } else {
                	$dateTo = $date;
                }
            
            	$this->db->select('billing.*,diety.name as diety,diety.name_mal as diety_mal, user_dtl.name as customer');
            	$this->db->from('billing');
            	$this->db->join('diety','diety.id = billing.diety_id');
            	$this->db->join('user_dtl','user_dtl.id = billing.customer_id');
				$this->db->where('billing.deleted', 0);
            	$this->db->where('billing.status', 2);
            	
    			// if($status) {
    			// $data['status'] = $status;
    			// $this->db->where('billing.status', $status);
    			// }

  				if($dateFrom && $dateTo) {
                	$data['dateFrom'] = $dateFrom;
                	$data['dateTo'] = $dateTo;
                	$this->db->where("billing.date BETWEEN '$dateFrom' AND '$dateTo'");
                }
                
            	$this->db->order_by("id", "asc");
            	$query = $this->db->get();

            	
            	if ($query->num_rows() > 0) {
                	$data['bills'] = $query->result_array();
            	}
            	else {
                	$data['bills'] = 0;
            	}
            } else {
            	$data['message'] = 'No data found';
            }
    
    		$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/billing/online_bills',$data);
        	$this->load->view('admin/layouts/admin_footer');
    }

	// Captured payments with no bill
	public function captured_payments() {
    	$this->load->library('razorpay');
		// $this->razorpay->initialize(array(
		// 'key_id'     => 'rzp_live_DXCjymOKv4eNz0',
		// 'key_secret' => 'nFCiXvfetpYEof5NHLMeKllx',
		// ));

		// $api_key = 'rzp_live_DXCjymOKv4eNz0';
		// $api_secret = 'nFCiXvfetpYEof5NHLMeKllx';
		// $url = 'https://api.razorpay.com/v1/payments/?count=50';

// 		$ch = curl_init($url);
// 		curl_setopt($ch, CURLOPT_USERPWD, $api_key . ':' . $api_secret);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 		$response = curl_exec($ch);
// 		curl_close($ch);

// 		$payments = json_decode($response, true);
    	$payments = $this->razorpay->capturedPayments();
    
    	$captured_payments = [];
    	foreach($payments as $payment) {
        	$b_flag = 0;
        	$o_flag = 0;
			$payment_id = $payment['id'];
        	$reference_no = $payment['notes']['reference_no'] ?? '';
        	$order_id = $payment['order_id'];
        
        	$this->db->select('*');
        	$this->db->from('billing');
        	$this->db->where('place', $payment_id);
        	$query = $this->db->get();
        
        	if($query->num_rows() > 0) {
            	$bill = $query->row();
            	$b_flag = 0;
            } else { 
            	$bill = 0;
            	$b_flag = 1;
            }
        
        	$this->db->select('*');
        	$this->db->from('billing_online');
        	$this->db->where('order_id', $order_id);
        	$query1 = $this->db->get();
        
        	if($query1->num_rows() > 0) {
            	$orders = $query1->result_array();
            	$o_flag = 1;
            } else { 
            	$orders = 0;
            	$o_flag = 0;
            }
        	
        	if($b_flag == 1 && $o_flag == 1) {
            	$captured_payments[] = $payment;
            }
        	
        }
    
    	$data['payments'] = $captured_payments;
    
    	$this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/billing/generate_captured_bills_manually',$data);
        $this->load->view('admin/layouts/admin_footer');
    }

	public function generate_bill($payment_id) {
        	$this->load->library('razorpay');
			//$api_key = "rzp_live_5d2La9FhpIFuVu";
    		//$api_secret = "L8yv2IQTbxYgj38XtMM4ayMd";
    		ob_start();
		ini_set('display_errors',0);
			$url = 'https://api.razorpay.com/v1/payments/'.$payment_id;
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_USERPWD, $api_key . ':' . $api_secret);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
			curl_close($ch);
			
			$payment = json_decode($response, true);
    		
    		$this->db->select('*');
    		$this->db->from('billing');
    		$this->db->where('place', $payment_id);
    		$query = $this->db->get();
    
    		if($query->num_rows() == 0) {
    			$is_present = false;
            } else {
            	$is_present = true;
            }
    
        	$reference_no = $payment['notes']['reference_no'];
			$order_id     = $payment['order_id'];

        	if( !$order_id ) {
            	//redirect('admin/billing/captured_payments');
            }

        	$this->db->select('*');
    		$this->db->from('billing_online');
    		$this->db->where('order_id', $payment_id);
        	$this->db->where('deleted',0);
    		$query = $this->db->get();
    		$bill_list = $query->result_array();
			

        	if( count($bill_list) == 0 ) {
            	redirect('admin/billing/captured_payments');
            }
    

        	if(!$is_present) {
    			$total = $payment['amount']/100;
            	$today=date('Y-m-d', $payment['created_at']);
            	$now = date('Y-m-d H:i:s', $payment['created_at']);
        	
        		$orders = $bill_list;
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
                }
            
            	redirect('admin/admin/bill_print/'.$bill_id);
            }
//         	$transaction_date = 
//     		$key = $payment_id;
//     		$amd = $payment['amount']/100;
//     		$total = $payment['amount']/100;
//     		$deity = $bill_list[0]['diety_id'];
//     		$customer_id = $bill_list[0]['customer_id'];
//     		$count = 0;
//         	$datetime = date('Y-m-d H:i:s');
        	
//     		$this->db->query("INSERT INTO billing(`diety_id`,`transaction_date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`, `bill_type`, `created_at`) VALUES ('$deity','$transaction_date','$key','$amd','$customer_id','$count','$total', '2','$total','6','O', '$datetime')");
//     		$bill_id=$this->db->insert_id();
//     		foreach($bill_list as $bill) {
//     			$name = $bill['name'];
//     			$deity_id = $bill['diety_id'];
//     			$star_id = $bill['star_id'];
//     			$pooja_id = $bill['pooja_id'];
//     			$qty = $bill['qty'];
//     			$rate = $bill['rate'];
//     			$amount = $rate * $qty;
//     			$date = $bill['date'];
//     			$time = $bill['time'];
//     			$prasadam = $bill['prasadam'];
//     			$this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$deity_id','$star_id','$pooja_id','$qty','$time','$rate','$date', '1','$amount','$prasadam')");
//     			if ($pooja_id=="2000"){
//     				$this->db->query("UPDATE mookkolakkallu SET date='$date' WHERE id='1'");
//     			}
//     		}
        
        	
    }












// 	Important Pooja Report
	public function important_pooja_report(){
        $this->form_validation->set_rules('date_from', 'Date From', 'required');
    	$this->form_validation->set_rules('date_to', 'Date To', 'required');
        $this->form_validation->set_rules('pooja', 'Diety', 'required');
   
        if ($this->form_validation->run() === FALSE){
        	$data['pooja_list']=$this->general_model->get_imp_pooja();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/important_pooja_credit_report_1',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $date_from=$this->input->post('date_from');
        	$date_to=$this->input->post('date_to');
        	$pooja=$this->input->post('pooja');
            $data['date_from']=$date_from;
        	$data['date_to']=$date_to;
        	$data['pooja']=$pooja;
         	$data['bill_list']=$this->Report_model->get_important_pooja_report($date_from,$date_to,$pooja);
            if($this->input->post('serch')=="serch"){
            	$data['pooja_list']=$this->general_model->get_imp_pooja();
                $data['bill_list']=$this->Report_model->get_important_pooja_report($date_from,$date_to,$pooja);
           
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/important_pooja_credit_report_1',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $data['pooja_list']=$this->general_model->get_imp_pooja();
            
                $this->load->view('admin/billing/report_print_important',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print',$data);
            }
        }
    }

	public function individual_important_pooja_report(){
        $this->form_validation->set_rules('date_from', 'Date From', 'required');
    	$this->form_validation->set_rules('date_to', 'Date To', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
   
        if ($this->form_validation->run() === FALSE){
        	$data['pooja_list']=$this->general_model->get_imp_pooja();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/individual_important_pooja_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
        	
            $date_from=$this->input->post('date_from');
        	$date_to=$this->input->post('date_to');
        	$pooja_id=$this->input->post('pooja_id');
            $data['date_from']=$date_from;
        	$data['date_to']=$date_to;
        	$data['pooja_id']=$pooja_id;
         	$data['bill_list']=$this->Report_model->get_individual_important_pooja_report($date_from,$date_to,$pooja_id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/individual_important_pooja_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

	public function bill_report_poojawise(){

        $this->form_validation->set_rules('keyword', 'Date', 'required');
        $this->form_validation->set_rules('temple', 'Diety', 'required');
   
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/billdate_report_poojawise',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $dateto=$this->input->post('dateto');
            $bill=$this->input->post('temple');
           // $type=$this->input->post('type');
            $ampm=$this->input->post('ampm');
            $type=$this->input->post('billtype');

            $pooja=$this->input->post('pooja');
            $data['dateto']=$dateto;
            $data['diety']=$bill;
            $data['ampm']=$ampm;
        	$data['keyword']=$keyword;
        	$data['pooja']=$pooja;
            $data['type']=$type;
      
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $data['bill_list']=$this->general_model->getbilldate_report_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/billdate_report_poojawise',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
               $data['bill_list']=$this->general_model->getbilldate_report_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print_single',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
               $data['bill_list']=$this->general_model->getbilldate_report_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print_single',$data);
            }
        }
    }


	public function bill_print($id, $reprint=null){
        $data['temple_list'] = $this->general_model->gettemples();
    	$data['bills']	     = $this->general_model->getBillPrintDetails($id);
        $data['bill_id']	 = $id;
		$data['prepared_by'] = $this->general_model->getBillPrintUser($id);

        $bill_id=$id;
    
        $counter = $this->session->userdata("counter");
             if($counter == ''){
                $this->load->view('admin/billing/kadambuzha_print',$data);
             } else{
              	$till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/kadambuzha_print',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
    }

	function translatetext(){
    	$inputText = $this->input->post('search');
    	$curlSession = curl_init(); 
//   		curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ml&dt=t&q='.urlencode($inputText));
//      	curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
//      	curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
//      	$response = curl_exec($curlSession);
//      	$jsonData = json_decode($response);
//      	curl_close($curlSession);

//      	if(isset($jsonData[0][0][0])){
//      		$response = array("name"=>$jsonData[0][0][0]);
//             echo json_encode($response);
//      	} else{
//          	echo false;
//      	}

		$suggestions = $this->fetchSuggestions($inputText, $curlSession);
	
		curl_close($curlSession);
		echo json_encode($suggestions);
	}

	function fetchSuggestions($text, $curlSession) {
    if($_SERVER['HTTP_HOST'] == "vasai.templesoftware.in"||$_SERVER['HTTP_HOST'] == "dwarakamandirdelhi.templesoftware.in")
	{
		curl_setopt($curlSession, CURLOPT_URL, 'https://inputtools.google.com/request?text='. urlencode($text) .'&itc=hi-t-i0-und&num=3&cp=0&cs=1&ie=utf-8&oe=utf-8&app=demopage');
	}
	else
	{
   	curl_setopt($curlSession, CURLOPT_URL, 'https://inputtools.google.com/request?text='. urlencode($text) .'&itc=ml-t-i0-und&num=3&cp=0&cs=1&ie=utf-8&oe=utf-8&app=demopage');
	}
    
    // curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ml&dt=t&q=' . urlencode($text));
   	//curl_setopt($curlSession, CURLOPT_URL, 'https://inputtools.google.com/request?text='. urlencode($text) .'&itc=ml-t-i0-und&num=3&cp=0&cs=1&ie=utf-8&oe=utf-8&app=demopage');
	curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curlSession);
	
    if ($response) {
    	
        $result = json_decode($response);

        if (isset($result[0]) && is_array($result[1])) {
            $suggestions = [];
            foreach ($result[1][0][1] as $translation) {
                $suggestions[] = $translation;
            }
        	$suggestions[] = $result[1][0][0];
            return $suggestions;
        }
    }

    return [];
	}

//for tamil
//
function translatetext_tamil(){
    	$inputText = $this->input->post('search');
    	$curlSession = curl_init(); 
//   		curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ml&dt=t&q='.urlencode($inputText));
//      	curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
//      	curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
//      	$response = curl_exec($curlSession);
//      	$jsonData = json_decode($response);
//      	curl_close($curlSession);

//      	if(isset($jsonData[0][0][0])){
//      		$response = array("name"=>$jsonData[0][0][0]);
//             echo json_encode($response);
//      	} else{
//          	echo false;
//      	}

		$suggestions = $this->fetchSuggestions_tamil($inputText, $curlSession);
	
		curl_close($curlSession);
		echo json_encode($suggestions);
	}

	function fetchSuggestions_tamil($text, $curlSession) {
    
    // curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ml&dt=t&q=' . urlencode($text));
   	curl_setopt($curlSession, CURLOPT_URL, 'https://inputtools.google.com/request?text='. urlencode($text) .'&itc=ta-t-i0-und&num=3&cp=0&cs=1&ie=utf-8&oe=utf-8&app=demopage');
	curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curlSession);
	
    if ($response) {
    	
        $result = json_decode($response);

        if (isset($result[0]) && is_array($result[1])) {
            $suggestions = [];
            foreach ($result[1][0][1] as $translation) {
                $suggestions[] = $translation;
            }
        	$suggestions[] = $result[1][0][0];
            return $suggestions;
        }
    }

    return [];
	}
//

	public function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    $response = ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    
    echo json_encode($response);
}

	public function searchDevotee() {

		$this->db->select('user_dtl.*, ledger.name as led_name');
		$this->db->from('user_dtl');
    	$this->db->join('ledger','ledger.led_Id = user_dtl.led_id', 'LEFT');
		$this->db->like('mobile', $this->input->post('search'), 'after');
		$query = $this->db->get();

		$devotees = $query->result();
    	$response = array();
	
    	foreach ($devotees as $devotee) {
    		if ($this->db->field_exists('gothram', 'user_dtl')) {
    		$response[] = array(
        	"value" => $devotee->name.' - '.$devotee->mobile,
        	"label" => $devotee->name.' - '.$devotee->mobile,
        	"id" => $devotee->id,
        	"name" => $devotee->name,
        	"house" => $devotee->house,
        	"mobile" => $devotee->mobile ?? '',
        	"email" => $devotee->email,
        	"street" => $devotee->street,
        	"post" => $devotee->post,
        	"district" => $devotee->district,
        	"state" => $devotee->state,
        	"pincode" => $devotee->pincode,
    		"led_id" => $devotee->led_id,
            "led_name" => $devotee->led_name,
			"gothram" => $devotee->gothram,
			"star_id" => $devotee->star_id
    		);
			}
			else
			{
			$response[] = array(
        	"value" => $devotee->name.' - '.$devotee->mobile,
        	"label" => $devotee->name.' - '.$devotee->mobile,
        	"id" => $devotee->id,
        	"name" => $devotee->name,
        	"house" => $devotee->house,
        	"mobile" => $devotee->mobile ?? '',
        	"email" => $devotee->email,
        	"street" => $devotee->street,
        	"post" => $devotee->post,
        	"district" => $devotee->district,
        	"state" => $devotee->state,
        	"pincode" => $devotee->pincode,
    		"led_id" => $devotee->led_id,
            "led_name" => $devotee->led_name
    		);	
				
			}
		}

    	echo json_encode($response);
    }

	public function getStarByKeyword(){
        $keyword=$this->input->post('search');
    
        $sql = "SELECT * FROM stars 
        WHERE id = ? OR name_eng LIKE ? 
        ORDER BY CASE WHEN name_eng = ? THEN 1 ELSE 2 END ASC";

		$query = $this->db->query($sql, array($keyword, "%$keyword%", $keyword));
        //print_r($this->db->last_query());
        if ($query->num_rows() > 0) {
            $pooja_data = $query->row_array();
            $response = array("id"=>$pooja_data['id'],"star"=>$pooja_data['name_eng'].' - '.$pooja_data['name_mal'], "name"=>$pooja_data['name_eng'] );
            echo json_encode($response);
        }
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

	public function getpoojabykeyword() {
    	$search = $this->input->post('search');
    	$date = $this->input->post('date');
    	$pooja = $this->pooja_model->getPoojaByKeyword($search, $date);
    
    	echo json_encode($pooja);
    }

	public function checkPoojaAvailabilityByQty(){
        $pooja_id  = $this->input->post('pooja_id');
    	$quantity  = $this->input->post('quantity');
    	$counter   = $this->session->userdata("counter"); 
   		
		$date=date('Y-m-d');
        
    	$this->db->select('issued_qty as qty');
        $this->db->from('pooja_availability');
        $this->db->where('pooja_id', $pooja_id);
        $this->db->where('pooja_date', $date);
        $query2 = $this->db->get();
    	
    	
    	if ( $query2->num_rows() > 0 ) {
        	$qty	= $query2->row()->qty;
    		if($qty > 0 && $qty >= $quantity) {
    			$response = array("pooja_count"=>$qty, "status"=> "available" );
    			echo json_encode($response);
    		} else {
    			$response = array("pooja_count"=>$qty, "status"=> "not-available" );
    			echo json_encode($response);
    		}
    	}
    }


	public function assign_allowed_quantity() {
	    date_default_timezone_set("Asia/Calcutta");
	    
    	$this->form_validation->set_rules('pooja[]', 'Pooja', 'required');
    	$this->form_validation->set_rules('date[]', 'Date', 'required');
    	$this->form_validation->set_rules('count[]', 'Quantity', 'required');

    	if ($this->form_validation->run() === FALSE){
    		$data['pooja_list']=$this->pooja_model->getotherpoojas();
       		$data['birth_star']=$this->general_model->getstars();
        	$data['temple_diety_list']=$this->general_model->getdietys();
    		$data['site']=$this->general_model->getsite();
    		$this->load->view('admin/layouts/admin_header');  
        	$this->load->view('admin/billing/set_pooja_availability',$data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        	$deities=$this->input->post('temple');
            $dates=$this->input->post('date');
            $poojas=$this->input->post('pooja');
            $count_list=$this->input->post('count');
        	$currentTimestamp = new DateTime();
            $created_at = $currentTimestamp->format('Y-m-d H:i:s');
       // print_r($poojas);exit;
        	foreach($poojas as $key => $pooja) {
            	$this->db->select('*');
            	$this->db->from('diety_pooja');
            	$this->db->where('pooja_id', $pooja);
            	$deity_pooja = $this->db->get()->row();

            	$deity = $deity_pooja->temple_id; //$deities[$key];
            	$date = $dates[$key];
            	$qty = $count_list[$key];
            	
            	$this->db->where('deity_id', $deity); 
				$this->db->where('pooja_id', $pooja); 
            	$this->db->where('pooja_date', $date);
				$query = $this->db->get('pooja_availability');

				if ($query->num_rows() > 0) {
    				$this->db->set('quantity', 'quantity + '.$qty, false);
                	$this->db->set('issued_qty', 'issued_qty + '.$qty, false);
    				$this->db->where('deity_id', $deity); 
					$this->db->where('pooja_id', $pooja); 
            		$this->db->where('pooja_date', $date);
    				$this->db->update('pooja_availability');
				} else {
    				$this->db->query("INSERT INTO pooja_availability(`deity_id`,`pooja_id`,`pooja_date`,`quantity`,`issued_qty`,`status`, `created_at`) VALUES ('$deity','$pooja','$date','$qty','$qty','1','$created_at')");
				}
            
            	$insertData = [
                	'deity_id'=> $deity,
                	'pooja_id'=> $pooja,
                	'pooja_date'=> $date,
                	'quantity'=> $qty,
                	'user_id'=> $this->loggedIn['id']
                ];
            
            	$this->db->insert('pooja_availability_log', $insertData);
            }
        	
        	redirect('admin/billing/assign_allowed_quantity');
        }
    }
}