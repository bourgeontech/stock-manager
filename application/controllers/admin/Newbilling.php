<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newbilling extends CI_Controller {

    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
    
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }
  
        $this->loggedIn=$this->session->admin;
        $this->load->model( 'Accounts_model' );
    	$this->load->model( 'pooja_model' );
    	$this->load->model( 'general_model' );
    	$this->load->model( 'payment_model' );
    	$this->load->model( 'site_model' );
    }

    // get pooja by code
    public function getPooja() {
        $keyword = $this->input->post('data');
        
        // Get Pooja By Code
        $this->db->select('diety_pooja.*, donation_deities.deity_id as has_donation, pooja.name as pooja, pooja.code as pooja_code,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.time,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
        $this->db->from('diety_pooja');
        $this->db->join('pooja', 'pooja.id = diety_pooja.pooja_id');
        $this->db->join('diety','diety.id = diety_pooja.temple_id');
        $this->db->join('donation_deities','diety.id = donation_deities.deity_id', 'LEFT');
        $this->db->where('pooja.code', $keyword);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $pooja_data = $query->row();
            $pooja = array(
                            "parent_id"=>$pooja_data->parent_id ?? null, 
                            "code"=>$pooja_data->pooja_code, 
                            "deity_id"=>$pooja_data->temple_id,
                            "pooja_id"=>$pooja_data->pooja_id,
                            "pooja"=>$pooja_data->pooja_code.' | '.$pooja_data->pooja.' - '.$pooja_data->pooja_mal,
                            "rate"=> $pooja_data->pooja_rt,
                            "rowcount"=> $pooja_data->rowcount,
                            "time"=> $pooja_data->time,
                            "is_donation"=> $pooja_data->has_donation ? true : false
                            );
            $this->db->select('diety_pooja.*, donation_deities.deity_id as has_donation, pooja.name as pooja, pooja.code as pooja_code,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.time,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
            $this->db->from('diety_pooja');
            $this->db->join('pooja', 'pooja.id = diety_pooja.pooja_id');
            $this->db->join('pooja_associations', 'pooja.id = pooja_associations.associate_pooja_id');
            $this->db->join('diety','diety.id = diety_pooja.temple_id');
            $this->db->join('donation_deities','diety.id = donation_deities.deity_id', 'LEFT');
            $this->db->where('pooja_associations.main_pooja_id', $pooja_data->pooja_id);
            $query = $this->db->get(); 
                        
            if ($query->num_rows() > 0) {
                $associates_result = $query->result();
                $associates = array();
                foreach($associates_result as $ass) {
                    $associatePooja = array(
                                    "parent_id"=>$ass->parent_id ?? null, 
                                    "code"=>$ass->pooja_code, 
                                    "deity_id"=>$ass->temple_id,
                                    "pooja_id"=>$ass->pooja_id,
                                    "pooja"=>$ass->pooja_code.' | '.$ass->pooja.' - '.$ass->pooja_mal,
                                    "rate"=> $ass->pooja_rt,
                                    "rowcount"=> $ass->rowcount,
                                    "time"=> $ass->time,
                                    "is_donation"=> $ass->has_donation ? true : false
                                );
                    $associates[] = $associatePooja;
                }
            } else {
                $associates = array();
            }
                            
            $result = array(
                'status'       => true,
                'pooja'        => $pooja,
                'associates'   => $associates,
                'statusMessage'=> 'found'
            );
            
            echo json_encode($result, 200);
        } else {
            $result = array(
                'status'       => false,
                'pooja'        => [],
                'statusMessage'=> 'not-found'
            );
            
            echo json_encode($result, 200);
        }
    }
    
    // get star by code
    public function getStar() {
        $keyword = $this->input->post('data');
        
        // Get Pooja By Code
        $this->db->select('*');
        $this->db->from('stars');
        $this->db->where('id', $keyword);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $star_data = $query->row();
            $star = array(
                            "id"         =>$star_data->id, 
                            "name"       =>$star_data->name_eng,
                            "name_locale"=>$star_data->name_mal,
                            "value"      =>$star_data->name_eng.' | '.$star_data->name_mal,
                        );
                        
            $result = array(
                'status'       => true,
                'star'         => $star,
                'statusMessage'=> 'found'
            );
            
            echo json_encode($result, 200);
        } else {
            $result = array(
                'status'       => true,
                'star'         => [],
                'statusMessage'=> 'not-found'
            );
            
            echo json_encode($result, 200);
        }
    }
    
    // other stars
    public function getOtherStar() {
        $keyword = $this->input->post('data');
        
        // Get Pooja By Code
        $this->db->select('*');
        $this->db->from('birth_star');
        $this->db->where('other_code', $keyword);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $star_data = $query->row();
            $star = array(
                            "id"         =>$star_data->other_code, 
                            "name"       =>$star_data->other_detail
                        );
                        
            $result = array(
                'status'       => true,
                'star'         => $star,
                'statusMessage'=> 'found'
            );
            
            echo json_encode($result, 200);
        } else {
            $result = array(
                'status'       => true,
                'star'         => [],
                'statusMessage'=> 'not-found'
            );
            
            echo json_encode($result, 200);
        }
    }
    
    // Generate Order ID
    public function generateOrderId() {
        do {
            $orderId = 'ORD' . uniqid();
            $order_exists = $this->checkOrderExists($orderId);
        } while ($order_exists);
    
        return $orderId;
    }
    
    // Check Order exists
    private function checkOrderExists($orderId) {
        $this->db->where('order_id', $orderId);
        $query = $this->db->get('guest_billing_details');
        return ($query->num_rows() > 0) ? true : false;
    }
    
    // Get Unique reference no
    public function generateReferenceNo() {
        do {
            $referenceNo = 'REF_' . uniqid();
            $exists = $this->checkReferenceNoExists($referenceNo);
        } while ($exists);
    
        return $referenceNo;
    }
    
    // Check if reference no exists 
    private function checkReferenceNoExists($referenceNo) {
        $this->db->where('reference_no', $referenceNo);
        $query = $this->db->get('guest_billing_details');
        return ($query->num_rows() > 0) ? true : false;
    }

    
    // Update Bill No
    public function update_bill_no($bill_id, $year) {
        $year_no = $this->general_model->getCurrentBillNo($year);
        $new_bill_no = $year."/".$year_no;
        
        $this->db->trans_begin();
        try {
            $this->db->set('bill_no', $new_bill_no);
            $this->db->set('bill_year_no', $year_no);
            $this->db->set('bill_year', $year);
            $this->db->where('id', $bill_id);
            $this->db->update('billing');
            $this->db->trans_commit();
            return true;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            if ($e->getCode() == 1062) { // MySQL error code for duplicate entry
                $year_no = $this->general_model->getCurrentBillNo($year);
                $new_bill_no = $year."/".$year_no;
                // Retry the update once with the new values
                return $this->update_bill($bill_id, $year); 
            } else {
                // Handle other types of exceptions
                error_log('Database update error: ' . $e->getMessage());
                return false;
            }
        }
    }
    
    // Billing
    public function billing() {
		// Set timezone
    	date_default_timezone_set("Asia/Calcutta");
    
    	/***
    	 * Set counter
    	 ***/
        $counter = $this->session->userdata("counter");  
        if($counter == ''){
            $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/billing/selectcounter',$data);
            $this->load->view('admin/layouts/admin_footer');
            return;
        }
    	/*** End set counter ***/
    
    	/***
    	 * Logged in user details
    	 ***/
    	$user_id		=	$this->loggedIn['id'];
    	$user_name		=	$this->loggedIn['name'];
    	$user_role		=	$this->loggedIn['role'];
    	$data['username'] = $user_name;
    	/*** End ***/
    
    	$today 			= date('Y-m-d');
        $year           = date('Y');
        
    	/***
    	 * Total Collection - Today
    	 ***/ 
    	$totalCollection 		 = $this->general_model->getTotalCollection($today);
        $data['totalcollection'] = $totalCollection->total ?? 0; 
        $data['totalcredit'] 	 = $totalCollection->totalcre;
    	/*** End total collection ***/
    
    	
    	//  Current bill number 
        $current_bill_no    	 = $this->general_model->getCurrentBillNo($year);
    	$data['current_bill_no'] = $year."/".$current_bill_no;
    
    	/***
    	 * Payment modes
    	 ***/
    	$payment_modes 			= $this->payment_model->getPaymentModes();
    	$data['payment_modes']  = $payment_modes;
    	/*** End payment modes ***/
    
    	// Validation rules
    	$this->form_validation->set_rules('order_id', 'Order ID', 'required');
    
        // Generate order_id if it doesn't exist in session
        if (!$this->session->userdata('order_id')) {
            $order_id = $this->generateOrderId(); // Generate unique order ID
            
            $this->session->set_userdata('order_id', $order_id);
        } else {
            $order_id = $this->session->order_id;
        }
        
        // Default Devotee
        $orders      = $this->db->select('*')->from('guest_billing_details')->where('order_id', $order_id)->where('deleted', 0)->get()->result();
        $customer_id = $orders[0]->customer_id ?? 1;
        $walk_in    = $this->db->select('*')->from('user_dtl')->where('id', $customer_id)->get()->row();

        $data['walk_in'] = $walk_in;
        
    	// If validation error occurs
        if ($this->form_validation->run() === FALSE) {
        	$data['stars']      = $this->general_model->getstars();
            $data['last_id']    = $current_bill_no;
 
			// $this->db->join('pooja', 'pooja_availability.pooja_id=pooja.id');
			// $this->db->select('pooja.name as pooja');
			// $this->db->select('SUM(pooja_availability.issued_qty) as quantity');
			// $this->db->where('pooja_date', $today);
			// $this->db->order_by('pooja_availability.id');
			// $this->db->group_by('pooja_availability.pooja_id');
			// $pooja_availability_query = $this->db->get('pooja_availability');
        	
//         	if($pooja_availability_query->num_rows() > 0 ) {
//             	$pooja_availability_array = $pooja_availability_query->result_array();
//             } else {
//             	$pooja_availability_array = 0;
//             }
        
//         	$data['pooja_availability_array'] = $pooja_availability_array;
        
//         	$last_receipt_no = $this->general_model->get_last_receiptno($counter);
//         	$current_series  = $this->general_model->get_current_series($counter);
//         	$series_start    = $current_series->from_sl ?? 0;
//             $series_end      = $current_series->to_sl ?? 0;
        
//         	$next_series     = $this->general_model->get_next_series($counter, $series_end);
        	
//         	if ((int)$last_receipt_no  < (int)$series_start) {
//             	$last_receipt_no = $series_start - 1;
//             } else if ((int)$last_receipt_no  < (int)$series_end) {
//             	$last_receipt_no = $last_receipt_no;
//             } else {
//             	$this->general_model->set_next_series($current_series->id, $next_series->id);
//             	$next_series_start = $next_series->from_sl ?? 0;
//             	$next_series_end = $next_series->to_sl ?? 0;
//             	if ((int)$last_receipt_no  < (int)$next_series_start) {
//             		$last_receipt_no = $next_series_start - 1;
//             	} else if ((int)$last_receipt_no  < (int)$next_series_end) {
//             		$last_receipt_no = $last_receipt_no;
//            	 	}
//             }
			
//         	$data['next_receipt_no'] = $last_receipt_no+1;
//         	$data['book_receipt_end'] = $series_end;
        
        	$this->db->select('name');
        	$this->db->from('counter');
        	$this->db->where('id', $counter);
        	
        	$data['counter'] = $this->db->get()->row()->name;
        	
            // to check if code based billing or other 
            $query = $this->db->query("select * from site_settings where id =1"); 
            $row = $query->row();
            
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/combinedbilling/billing_combined',$data);
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $order_id    = $this->input->post('order_id');
            $orders      = $this->db->select('*')->from('guest_billing_details')->where('order_id', $order_id)->where('deleted', 0)->get()->result();
            $customer_id = $orders[0]->customer_id;
            $deity_id    = $orders[0]->deity_id;
            $mode        = $this->input->post('mode');
            
            $total       = 0;
            $total_prasadam = 0;
            foreach ($orders as $order) {
                $total += $order->amount;
                // $total_prasadam += $order->prasadam_amount;
            }
            
            $this->db->insert('billing', array(
                    'diety_id'				=> $deity_id, 
                    'date'					=> date('Y-m-d'), 
                    'place'					=> '---', 
                    'amount'				=> $total, 
                    'customer_id'			=> $customer_id, 
                    'count'					=> 0, 
                    'total'					=> $total, 
                    'mode'					=> $mode, 
                    'mode_date'				=> date('Y-m-d'), 
                    'status'				=> 1, 
                    'user_id'				=> $user_id, 
                    'bill_time'				=> date('Y-m-d H:i:s'), 
                    'recv_amt'				=> $total, 
                    'bal_amt'				=> 0, 
                    'counter'				=> $counter, 
                    'deleted'				=> 0, 
                    'prasadam_amt'			=> $total_prasadam, 
                ));
                
            $bill_id    = $this->db->insert_id();
            $year_no    = $current_bill_no;
            $bill_no    = $year."/".$year_no;
            $this->update_bill_no($bill_id, $year);
            
            foreach ($orders as $order) {
                $pooja_products = $this->pooja_model->getPoojaProducts($order->pooja_id);
                    	
                    	
                if($pooja_products != 0) {
                    foreach($pooja_products as $pooja_product) {
                        $product_id = $pooja_product['product_id'];
                    	$coconut_pooja = $this->general_model->getpoojasById(268)[0];
                        $count		= $pooja_product['count'];
                        $stock_qty  = ( $count * $order->quantity );
                        $product    = $this->general_model->getinv_productbyid($product_id);
                        $unit		= $product['unit'];
                        $store_id   = 1;
						$amount     = $stock_qty * $coconut_pooja['rate'];
                    	
                        $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`,`store_id`) VALUES ('$product_id','$unit', '-$stock_qty', 'AD', '$user_id', '$bill_id', '$store_id')");
                    }
                }
                $this->db->insert('billing_dtls', array(
                    'bill_id'       => $bill_id,
                    'name'			=> $order->name, 
                    'diety_id'		=> $order->deity_id, 
                    'star'			=> $order->star_id, 
                    'pooja'			=> $order->pooja_id, 
                    'qlt'			=> $order->quantity, 
                    'time'			=> $order->time, 
                    'rate'			=> $order->rate, 
                    'amount'		=> $order->amount, 
                    'date'			=> $order->pooja_date, 
                    'status'		=> 1, 
                    'type'			=> $order->type == 'S' ? 'S' : '' , 
                    'postal_yes'	=> $order->postal, 
                    'postal_amt'	=> $order->postal_amount ?? 0
                ));
                
                $this->db->where('temp_bill_id', $order->id);
                $this->db->update('auditorium_booking', array(
                        'bill_id'=> $bill_id
                    ));
            }
            
            $this->session->unset_userdata('order_id');
            
            $counter = $this->session->userdata("counter");
            
            $printer = $this->db->select('*')->from('counter')->where('id', $counter)->get()->row()->printer;
                 
            if($printer == 1){ 
                redirect('admin/admin/dmbill_print/'.$bill_id);
            }
            else if($printer == 2){ 
                redirect('admin/admin/bill_print/'.$bill_id);
            }
            else if($printer == 3){ 
                redirect('admin/admin/receipt_print/'.$bill_id);
            }
            else{
                redirect('admin/admin/bill_print/'.$bill_id);
            }
        }
    }
    
    public function viewScheduleBillingDetail($reference_no) {
        $this->db->select('guest_billing_details.id as id, guest_billing_details.reference_no as reference_no, guest_billing_details.name as name, pooja.name as pooja, pooja.name_mal as pooja_locale, stars.name_eng as star, stars.name_mal as star_locale, guest_billing_details.pooja_date as pooja_date, guest_billing_details.quantity as quantity, pooja.rate as rate, guest_billing_details.postal_amount as postal, guest_billing_details.type as type');
        $this->db->from('guest_billing_details');
        $this->db->join('pooja', 'guest_billing_details.pooja_id=pooja.id');
        $this->db->join('stars', 'guest_billing_details.star_id=stars.id');
        $this->db->where('reference_no', $reference_no);
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $orders = $query->result();
        } else {
            $orders = [];
        }
        
        $data['orders'] = $orders;
        
        $this->load->view('admin/combinedbilling/billing_combined_schedule_details', $data);
    }
    
    public function schedule() {
        // Generate reference_no if it doesn't exist in session
        if (!$this->session->userdata('reference_no')) {
            $reference_no = $this->generateReferenceNo(); // Generate unique reference no
            
            $this->session->set_userdata('reference_no', $reference_no);
        }
        
        $this->load->view('admin/combinedbilling/billing_combined_schedule');
    }
    
    public function getTotalByOrderId($order_id) {
        $this->db->select('SUM(amount) as amount, SUM(postal) as postal');
        $this->db->from('guest_billing_details');
        $this->db->where('order_id', $order_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            
            return array(
                    'total'       => $result->amount,
                    'grand_total' => $result->amount + $result->postal
                );
        } else {
            return array(
                    'total'       => 0,
                    'grand_total' => 0
                );
        }
    }
    
    public function getScheduledDates() {
        $query = $this->db->query("select * from temple where id =1"); 
        $temple = $query->row();
            
        $reference_no     = $this->input->post('reference_no');
        $schedule_type    = $this->input->post('schedule_type');
        $schedule_details = $this->input->post('schedule_details');
        $customer_id      = $this->input->post('customer_id');
        $order_id         = $this->input->post('order_id');
        $name             = $this->input->post('name');
        $user_star_id     = $this->input->post('star_id');
        $deity_id         = $this->input->post('deity_id');
        $pooja_id         = $this->input->post('pooja_id');
        $time             = $this->input->post('time');
        $quantity         = $this->input->post('quantity');
        $rate             = $this->input->post('rate');
        $amount           = $rate * $quantity;
        $postal           = $this->input->post('prasadam');
        $postal_count     = $this->input->post('prasadam_count');
        $postal_amount    = $temple->postel_charge;
        
        // var_dump($pooja_id);exit;
        
        if ($schedule_type == 'daily') {
            $from_date = $schedule_details['date_from'];
            $to_date   = $schedule_details['date_to'];
            $days      = $schedule_details['days'];
            
            $details = $this->general_model->getdatestar($from_date, $to_date, $days);
        } else if ($schedule_type == 'weekly') {
            $from_date = $schedule_details['date_from'];
            $to_date   = $schedule_details['date_to'];
            $weeks     = $schedule_details['weeks'];
            $weekday   = $schedule_details['weekday'];
            $day       = strtoupper($weekday); 
            
            $details = $this->general_model->getweekstar($from_date, $to_date, $day, $weeks);
        } else if ($schedule_type == 'monthly') {
            $from_date = $schedule_details['date_from'];
            $to_date   = $schedule_details['date_to'];
            $months    = $schedule_details['months'];
            $star_id   = $schedule_details['star_id'];
            $star      = $this->db->select('name_eng')->from('stars')->where('id', $star_id)->get()->row()->name_eng;

            $details = $this->general_model->getmonthstar($from_date, $to_date, $star, $months);
        } else if ($schedule_type == 'other') {
            $from_date = $schedule_details['date_from'];
            $to_date   = $schedule_details['date_to'];
            $months    = $schedule_details['months'];
            $star_id   = $schedule_details['star_id'];
            
            $details = $this->general_model->getother($from_date, $to_date, $star_id);
        } else {
            $dates = $schedule_details['dates'];
            
            $details = [];
            foreach($dates as $date) {
                $details[] = array('birth_date'=> $date);
            }
        }
        
        

        try {
            $this->db->trans_start();
            $count = $postal_count;
            
            $totalArray = $this->getTotalByOrderId($order_id);
            
            
            if (is_array($pooja_id)) {
                foreach($pooja_id as $id) {
                    if (!$this->session->userdata('reference_no')) {
                        $reference_no = $this->generateReferenceNo(); // Generate unique reference no
                        
                        $this->session->set_userdata('reference_no', $reference_no);
                    }
                    foreach ($details as $detail) {
                        $date       = $detail['birth_date'];
                        
                        $total       = $totalArray['total'] += $amount;
                        if ($count > 0) {
                            $grand_total = $totalArray['grand_total'] += $amount += $postal_amount;
                        } else {
                            $grand_total = $total;
                        }
                           
                        $this->db->insert('guest_billing_details', array(
                                'reference_no'  => $reference_no,
                                'order_id'      => $order_id,
                                'customer_id'   => $customer_id,
                                'name'          => $name, 
                                'name_locale'   => $name, 
                                'star_id'       => $user_star_id,
                                'pooja_date'    => $date, 
                                'type'          => 'S', 
                                'deity_id'      => $deity_id, 
                                'pooja_id'      => $id, 
                                'time'          => $time ?? '', 
                                'quantity'      => $quantity, 
                                'rate'          => $rate, 
                                'amount'        => $amount, 
                                'total'         => $total, 
                                'postal'        => $count > 0 ? 1 : 0, 
                                'postal_amount' => $count > 0 ? $postal_amount : 0, 
                                'grand_total'   => $grand_total
                            ));
                        
                        $count--;
                    }
                    
                    $this->session->unset_userdata('reference_no');
                }
            } else {
                foreach ($details as $detail) {
                    $date       = $detail['birth_date'];
                    
                    $total       = $totalArray['total'] += $amount;
                    if ($count > 0) {
                        $grand_total = $totalArray['grand_total'] += $amount += $postal_amount;
                    } else {
                        $grand_total = $total;
                    }
    
                       
                    $this->db->insert('guest_billing_details', array(
                            'reference_no'  => $reference_no,
                            'order_id'      => $order_id,
                            'customer_id'   => $customer_id,
                            'name'          => $name, 
                            'name_locale'   => $name, 
                            'star_id'       => $user_star_id,
                            'pooja_date'    => $date, 
                            'type'          => 'S', 
                            'deity_id'      => $deity_id, 
                            'pooja_id'      => $pooja_id, 
                            'time'          => $time ?? '', 
                            'quantity'      => $quantity, 
                            'rate'          => $rate, 
                            'amount'        => $amount, 
                            'total'         => $total, 
                            'postal'        => $count > 0 ? 1 : 0, 
                            'postal_amount' => $count > 0 ? $postal_amount : 0, 
                            'grand_total'   => $grand_total
                        ));
                    
                    $count--;
                }
            }
            
        
        
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                $response = array('status' => 'error', 'message' => 'Transaction failed: ' . $this->db->error());
            } else {
                $response = array('status' => 'success', 'message' => 'Transaction successful.');
            }
        } catch (Exception $e) {
            // Handle any exceptions that occur during the transaction
            $response = array('status' => 'error', 'message' => 'Exception during transaction: ' . $e->getMessage());
        
            // Rollback the transaction to maintain data integrity
            $this->db->trans_rollback();
        }
        
        $this->session->unset_userdata('reference_no');

        $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
    }
    
    
    public function addOrderEntry() {
        if (!$this->session->userdata('reference_no')) {
            $reference_no = $this->generateReferenceNo(); // Generate unique reference no
            
            $this->session->set_userdata('reference_no', $reference_no);
        }

        $reference_no = $this->session->reference_no;
        
        $customer_id      = $this->input->post('customer_id');
        $order_id         = $this->input->post('order_id') ?? $this->session->order_id;
        $name             = $this->input->post('name');
        $user_star_id     = $this->input->post('star_id');
        $deity_id         = $this->input->post('deity_id');
        $date             = $this->input->post('pooja_date');
        $pooja_id         = $this->input->post('pooja_id');
        $time             = $this->input->post('time');
        $quantity         = $this->input->post('quantity');
        $rate             = $this->input->post('rate');
        $amount           = $rate * $quantity;

        $totalArray = $this->getTotalByOrderId($order_id);
        $total       = $totalArray['total'] += $amount;
        $grand_total = $total;
        
        try {
            $this->db->trans_start();
            $this->db->insert('guest_billing_details', array(
                        'reference_no'  => $reference_no,
                        'order_id'      => $order_id,
                        'customer_id'   => $customer_id,
                        'name'          => $name, 
                        'name_locale'   => $name, 
                        'star_id'       => $user_star_id,
                        'pooja_date'    => $date, 
                        'type'          => 'N', 
                        'deity_id'      => $deity_id, 
                        'pooja_id'      => $pooja_id, 
                        'time'          => $time ?? '', 
                        'quantity'      => $quantity, 
                        'rate'          => $rate, 
                        'amount'        => $amount, 
                        'total'         => $total, 
                        'postal'        => 0, 
                        'grand_total'   => $grand_total
                    ));
            $billing_id = $this->db->insert_id();
            $first_reference_no = $reference_no;
            
            $this->db->select('diety_pooja.*, donation_deities.deity_id as has_donation, pooja.name as pooja, pooja.code as pooja_code,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.time,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
            $this->db->from('diety_pooja');
            $this->db->join('pooja', 'pooja.id = diety_pooja.pooja_id');
            $this->db->join('pooja_associations', 'pooja.id = pooja_associations.associate_pooja_id');
            $this->db->join('diety','diety.id = diety_pooja.temple_id');
            $this->db->join('donation_deities','diety.id = donation_deities.deity_id', 'LEFT');
            $this->db->where('pooja_associations.main_pooja_id', $pooja_id);
            $query = $this->db->get(); 
                        
            if ($query->num_rows() > 0) {
                $associates_result = $query->result();
                $associates = array();
                foreach($associates_result as $ass) {
                    $this->session->unset_userdata('reference_no');
                    if (!$this->session->userdata('reference_no')) {
                        $reference_no = $this->generateReferenceNo(); // Generate unique reference no
                        
                        $this->session->set_userdata('reference_no', $reference_no);
                    }

                    $total       = $totalArray['total'] += $amount;
            
                    $this->db->insert('guest_billing_details', array(
                        'reference_no'  => $reference_no,
                        'order_id'      => $order_id,
                        'customer_id'   => $customer_id,
                        'name'          => $name, 
                        'name_locale'   => $name, 
                        'star_id'       => $user_star_id,
                        'pooja_date'    => $date, 
                        'type'          => 'N', 
                        'deity_id'      => $ass->temple_id, 
                        'pooja_id'      => $ass->pooja_id, 
                        'time'          => $ass->time ?? '', 
                        'quantity'      => $quantity, 
                        'rate'          => $ass->pooja_rt, 
                        'amount'        => $quantity * $ass->pooja_rt, 
                        'total'         => $total, 
                        'postal'        => 0, 
                        'grand_total'   => $total
                    ));
                }
            } 
            
            $this->db->select('code');
            $this->db->from('pooja');
            $this->db->where('pooja.id', $pooja_id);
            $code = $this->db->get()->row()->code; 
            
            if ($code == 1214) {
                $auditorium = 1;
            } else {
                $auditorium = 0;
            }
            
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                $response = array('status' => 'error', 'message' => 'Transaction failed: ' . $this->db->error());
            } else {
                $response = array('status' => 'success', 'id'=>$billing_id, 'reference_no'=> $first_reference_no, 'associates'=>$query->num_rows(), 'auditorium'=>$auditorium,  'message' => 'Transaction successful.');
            }
        } catch (Exception $e) {
            // Handle any exceptions that occur during the transaction
            $response = array('status' => 'error', 'message' => 'Exception during transaction: ' . $e->getMessage());
        
            // Rollback the transaction to maintain data integrity
            $this->db->trans_rollback();
        }
        
        $this->session->unset_userdata('reference_no');

        $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
    }
    
    
    public function getOrders() {
        $orderId = $this->input->post('order_id');
        
        $this->db->select('guest_billing_details.id as id, guest_billing_details.reference_no as reference_no, guest_billing_details.name as name, pooja.name as pooja, pooja.name_mal as pooja_locale, stars.name_eng as star, stars.name_mal as star_locale, guest_billing_details.pooja_date as pooja_date, MIN(guest_billing_details.pooja_date) as pooja_from, MAX(guest_billing_details.pooja_date) as pooja_to, SUM(guest_billing_details.quantity) as quantity, pooja.rate as rate, SUM(guest_billing_details.postal_amount) as postal, guest_billing_details.type as type');
        $this->db->from('guest_billing_details');
        $this->db->join('pooja', 'guest_billing_details.pooja_id=pooja.id');
        $this->db->join('stars', 'guest_billing_details.star_id=stars.id');
        $this->db->where('order_id', $orderId);
        $this->db->where('deleted', 0);
        $this->db->group_by('reference_no');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $orders = $query->result();
            $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($orders));
        }
    }
    
    public function deleteGuestBillingDetail() {
        $reference_no = $this->input->post('reference_no');
        
        $this->db->trans_start();
        $this->db->where('reference_no', $reference_no);
        $this->db->update('guest_billing_details', array('deleted'=> 1));
        
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            $response = array('status' => 'error', 'message' => 'Transaction failed: ' . $this->db->error());
        } else {
            $response = array('status' => 'success', 'id'=>$reference_no, 'message' => 'Transaction successful.');
        }
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }
    
    public function deleteOrderById() {
        $id = $this->input->post('id');
        
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('guest_billing_details', array('deleted'=> 1));
        
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            $response = array('status' => 'error', 'message' => 'Transaction failed: ' . $this->db->error());
        } else {
            $response = array('status' => 'success', 'id'=>$id, 'message' => 'Transaction successful.');
        }
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }
    
    
    public function combined_bill_print($bill_id) {
        $data['temple_list']  = $this->general_model->gettemples();
        $data['bill_details'] = $this->general_model->getBillById($bill_id);
        $data['bill_id']      = $bill_id;
		$data['prepared_by']  = $this->general_model->getbillinguser($bill_id);
		$data['bill_dtls']   	= $this->general_model->getbillingdtlsById($bill_id);
		$data['bill_list']   	= $this->general_model->getbillingById($bill_id);
		
        $this->load->view('admin/billing/combined_bill_print', $data);
    }
    
    public function viewPoojaList() {
        // Validation rules
    	$this->form_validation->set_rules('keyword', 'Keyword', 'required');
    
    	// If validation error occurs
        if ($this->form_validation->run() === FALSE) {
            $this->db->select('pooja.*, pooja.name as pooja, pooja.name_mal as pooja_locale');
            $this->db->from('pooja');
            $this->db->order_by('pooja.code');
            $query = $this->db->get();
            $data['poojas'] = $query->result();
        } else {
            $keyword = $this->input->post('keyword');
            
            $data['keyword'] = $keyword;
            $this->db->select('pooja.*, pooja.name as pooja, pooja.name_mal as pooja_locale');
            $this->db->from('pooja');
            $this->db->like('pooja.name', $keyword);
            $this->db->order_by('pooja.code');
            $query = $this->db->get();
            $data['poojas'] = $query->result();
        }
        
        $this->load->view('admin/combinedbilling/pooja_list_with_code', $data);
    }

    
    public function getPoojaById() {
        $keyword = $this->input->post('id');
        
        // Get Pooja By Code
        $this->db->select('diety_pooja.*, donation_deities.deity_id as has_donation, pooja.parent_id as parent_id, pooja.name as pooja, pooja.code as pooja_code,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.time,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
        $this->db->from('diety_pooja');
        $this->db->join('pooja', 'pooja.id = IF(pooja.parent_id = 38, 38, IF(pooja.parent_id = 241, 241, diety_pooja.pooja_id))');
        $this->db->join('diety','diety.id = diety_pooja.temple_id');
        $this->db->join('donation_deities','diety.id = donation_deities.deity_id', 'LEFT');
        $this->db->where('pooja.id', $keyword);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $pooja_data = $query->row();
            $pooja = array(
                            "parent_id"=>$pooja_data->parent_id ?? null, 
                            "code"=>$pooja_data->pooja_code, 
                            "deity_id"=>$pooja_data->temple_id,
                            "pooja_id"=>$pooja_data->pooja_id,
                            "pooja"=>$pooja_data->pooja_code.' | '.$pooja_data->pooja.' - '.$pooja_data->pooja_mal,
                            "rate"=> $pooja_data->pooja_rt,
                            "rowcount"=> $pooja_data->rowcount,
                            "time"=> $pooja_data->time,
                            "is_donation"=> $pooja_data->has_donation ? true : false
                            );
            $this->db->select('diety_pooja.*, donation_deities.deity_id as has_donation, pooja.parent_id as parent_id, pooja.name as pooja, pooja.code as pooja_code,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.time,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
            $this->db->from('diety_pooja');
            $this->db->join('pooja', 'pooja.id = diety_pooja.pooja_id');
            $this->db->join('pooja_associations', 'pooja.id = pooja_associations.associate_pooja_id');
            $this->db->join('diety','diety.id = diety_pooja.temple_id');
            $this->db->join('donation_deities','diety.id = donation_deities.deity_id', 'LEFT');
            $this->db->where('pooja_associations.main_pooja_id', $pooja_data->pooja_id);
            $query = $this->db->get(); 
                        
            if ($query->num_rows() > 0) {
                $associates_result = $query->result();
                $associates = array();
                foreach($associates_result as $ass) {
                    $associatePooja = array(
                                    "parent_id"=>$ass->parent_id ?? null, 
                                    "code"=>$ass->pooja_code, 
                                    "deity_id"=>$ass->temple_id,
                                    "pooja_id"=>$ass->pooja_id,
                                    "pooja"=>$ass->pooja_code.' | '.$ass->pooja.' - '.$ass->pooja_mal,
                                    "rate"=> $ass->pooja_rt,
                                    "rowcount"=> $ass->rowcount,
                                    "time"=> $ass->time,
                                    "is_donation"=> $ass->has_donation ? true : false
                                );
                    $associates[] = $associatePooja;
                }
            } else {
                $associates = array();
            }
                            
            $result = array(
                'status'       => true,
                'pooja'        => $pooja,
                'associates'   => $associates,
                'statusMessage'=> 'found'
            );
            
            echo json_encode($result, 200);
        } else {
            $result = array(
                'status'       => false,
                'pooja'        => [],
                'statusMessage'=> 'not-found'
            );
            
            echo json_encode($result, 200);
        }
    }
    
    public function update_auditorium_data() {
        $bill_id = $this->input->post('bill_id');
        
        $this->db->insert('auditorium_booking', array(
                        'temp_bill_id'  => $bill_id,
                        'name'          => $this->input->post('name'), 
                        'marriage_date' => $this->input->post('date'),
                        'address'       => $this->input->post('billing_address'),
                        'bride'         => $this->input->post('bride'),
                        'bride_address' => $this->input->post('bride_address'),
                        'groom'         => $this->input->post('groom'),
                        'groom_address' => $this->input->post('groom_address'),
                        'reception'     => $this->input->post('reception'),
                        'form_no'       => $this->input->post('form_no'),
                        'advance_amount'=> $this->input->post('advance_amount')
                    ));
        echo json_encode("Updated", 200);
        
    }
    
    public function availabilityCalendar() {
        $this->load->view('admin/calendar/availability_calendar');
    }
    
    public function getEvents() {
        $start = date('Y-m-d', strtotime($this->input->get('start')));
        $end   = date('Y-m-d', strtotime($this->input->get('end')));
        
        $this->db->select('pooja.name, billing_dtls.bill_id, billing_dtls.date');
        $this->db->from('billing_dtls');
        $this->db->join('pooja', 'billing_dtls.pooja=pooja.id');
        $this->db->where('billing_dtls.date >=', $start);
        $this->db->where('billing_dtls.date <=', $end);
        $this->db->where('pooja.allowed_qty', 1);
        $query = $this->db->get();
        
        $events = [];
        foreach($query->result() as $result) {
            $events[] = array(
                    'title' => $result->bill_id." - ".$result->name,
                    'start' => $result->date,
                );
        }
        // $events = array(
        //     array(
        //         'title' => '2024/10 - AUDITORIUM',
        //         'start' => '2024-03-05',
        //     ),
        //     array(
        //         'title' => 'Event 2',
        //         'start' => '2024-03-05',
        //     ),
        //     array(
        //         'title' => 'Event 3',
        //         'start' => '2024-03-05',
        //     ),
        //     array(
        //         'title' => 'Event 2',
        //         'start' => '2024-03-10',
        //     )
        // );


        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($events));
    }
}