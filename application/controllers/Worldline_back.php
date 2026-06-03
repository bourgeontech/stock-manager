<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worldline extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(empty($this->session->refno)){
            $refno="AB".rand(1000,9999);
            $this->session->set_userdata('refno', $refno);
        }
    
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
    	$this->load->model( 'Cms_model' );
    }
    // Dashboard
//     public function booking(){
//         $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
//         $this->form_validation->set_rules('diety_id', 'Diety', 'required');
//         $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
//         $this->form_validation->set_rules('star_id', 'Star', 'required');
//         if ($this->form_validation->run() === FALSE){
//             $data['diety_list']=$this->site_model->getdietys();
//             $data['pooja_list']=$this->site_model->getpoojas();
//             $data['star_list']=$this->site_model->getstars();
//             $this->load->view('site/layouts/admin_header');
//             $this->load->view('site/booking_wl',$data);
//             $this->load->view('site/layouts/admin_footer');
//         }else{
//             $name=$this->input->post('name');
//             $diety_id=$this->input->post('diety_id');
//             $pooja_id=$this->input->post('pooja_id');
//             $star_id=$this->input->post('star_id');
//             $main_date=$this->input->post('main_date');
//             $dates=$this->input->post('dates');

//             $pooja=$this->site_model->getpoojasById($pooja_id);
//             $amount=$pooja[0]['rate'];
//             $refno=$this->session->refno;
//             if(!empty($dates)){
//                 $i=0;
//                 while ($i<sizeof($dates)){
//                     $data=$dates[$i];
//                     $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja_id','$amount','$data', '1')");
//                     $i++;
//                 }
//             }else{
//                 $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja_id','$amount','$main_date', '1')");
//             }
//             redirect('worldline/booking');
//         }
//     }
//     
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
        	redirect('worldline/booking');
       	} else {
        	redirect('worldline/review');
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
    		redirect('worldline/donation');
    	} else {
    		redirect('worldline/review/donation');
    	}
    }


	public function booking(){
    	$query = $this->db->query("SELECT booking_closing_time FROM site_settings ");
    	$booking_closing_time=$query->row()->booking_closing_time;
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
    	
        
    	$this->db->select('*');
    	$this->db->from('site_settings');
    	$settings = $this->db->get()->row();
    
    	if ($this->db->field_exists('online_booking_code', 'site_settings') && $settings->online_booking_code == 2) {
        	$this->form_validation->set_rules('appearance', 'Participation', 'required');
        
        	$booking_view   = 'booking_new';
        	$booking_header = 'bookingheader_2';
        	$booking_footer = 'admin_footer';
        } else {
        	$booking_view 	= 'booking_wl';
        	$booking_header = 'bookingheader';
        	$booking_footer = 'admin_footer';
        }
    
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->site_model->getonlinedietys();
            $data['pooja_list']=$this->site_model->getonlinepoojas();
            $data['star_list']=$this->site_model->getstars();
        	// $data['gothram_list'] = $this->db->select('*')->from('gothrams')->get()->result_array();

            $this->load->view('site/layouts/'.$booking_header);
            $this->load->view('site/'.$booking_view,$data);
            $this->load->view('site/layouts/'.$booking_footer);
        } else{
        	$title=$this->input->post('title');
            $name=$title.$this->input->post('name');
            $mobile_no=$this->input->post('mobile_no');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
        	$qty=1;

            $star_id= $this->input->post('star_id');
            $main_date=$this->input->post('main_date');
            $dates=$this->input->post('dates');
        	$appearance = $this->input->post('appearance');
        	$multiply_count = $this->input->post('multiply_count');
        	
        
        	if($star_id == 0) { $star_id=28; }
        
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
        
 			$flag = $this->checkPoojaAvailability($main_date, $pooja_id, $qty, 1, $appearance);
            if($flag){
          			 $this->session->set_flashdata('error_view',"Booking for selected pooja is not available on ".$main_date." Please check with a future date.");
        	 		 redirect('worldline/booking');
      		}
      		// if($allowed_qty != 0){
      		// if($allowed_qty <= $input_qty){
      		// $this->session->set_flashdata('error_view',"Booking for selected pooja is not available on ".$main_date." Please check with a future date.");
      		// redirect('worldline/booking');
      		// }
      		// }
        
        	if($booking_closing_time < $cur_time){
                 if($main_date == $cur_date || $main_date == $date_next){
                 	$this->session->set_flashdata('error_view',"Booking closed for selected date. Please check with a future date.");
                 	redirect('worldline/booking');
                 }
        	}
        	
            $now = strtotime($cur_date); // or your date as well
		    $your_date = strtotime($main_date);
		    $datediff = $your_date- $now;

		    $daysdiff= round($datediff / (60 * 60 * 24));

            $pooja=$this->site_model->getpoojasById($pooja_id);
            $amount=$pooja[0]['rate'];
        	if($multiply_count && $multiply_count > 1) {
                 $amount = $multiply_count * $amount;
            }
        
        	
        	$data['amount']=$amount;

        	$existingData = $this->session->userdata('billing_online');
        	$star_eng = $this->site_model->getstarbyid($star_id)->star_eng;
        	$pooja_mal = $this->site_model->getpoojabyid($pooja_id)->pooja_nm;
        	$pooja_rate = $this->site_model->getpoojabyid($pooja_id)->pooja_rt;
        	$pooja_time = $this->site_model->getpoojabyid($pooja_id)->pooja_time ?? 'M';

            if(!empty($dates)){
                $i=0;
                while ($i<sizeof($dates)){
                    $data=$dates[$i];
                	
                	if($this->db->field_exists('appearance', 'billing_online')) {
                		$this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`, `qty`, `rate`,`date`,`status`, `reference_no`, `appearance`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id', '$qty', '$amount','$data', '1', '$ref_no', '$appearance')");
                    } else {
                		$this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`, `qty`, `rate`,`date`,`status`, `reference_no`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id', '$qty', '$amount','$data', '1', '$ref_no')");    
                    }
                
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
            	if($this->db->field_exists('appearance', 'billing_online')) {
                	$appearance = $this->input->post('appearance');

            		$this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`qty`,`rate`,`date`,`status`, `reference_no`, `appearance`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$qty','$amount','$main_date', '1', '$ref_no', '$appearance')");
                } else {
            		$this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`qty`,`rate`,`date`,`status`, `reference_no`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$qty','$amount','$main_date', '1', '$ref_no')");    
                }
            
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
        
            redirect('worldline/booking');
        }
    }
	
	public function donation(){
    	date_default_timezone_set('Asia/Kolkata');
    	$cur_time = date("H:i:s");
        $cur_date = date("Y-m-d");
        $date_next = date('Y-m-d', strtotime("+1 day"));
        $fourth_date = date('Y-m-d', strtotime("+4 day"));
        // next dates 
     
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('mobile_no', 'Beneficiary Mobile Number', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $this->db->select('*');
            $this->db->from('diety');
            $this->db->where('id', 101);
            $this->db->or_like('name', 'Donation Online', 'both');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $deity = $query->result_array();
            }
            else {
                $deity = 0;
            }
            
            $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt');
            $this->db->from('diety_pooja');
            $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
            $this->db->where('diety_pooja.temple_id', 101);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $poojas = $query->result_array();
            }
            else {
                $poojas = 0;
            }
            
            $data['diety_id']=$deity[0]['id'];
            $data['pooja_list']=$poojas;
            $data['star_list']=$this->site_model->getstars();
            
      //  print_r($data);exit;
            $this->load->view('site/layouts/bookingheader');
            $this->load->view('site/donation',$data);
            $this->load->view('site/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $mobile_no=$this->input->post('mobile_no');
            $diety_id=101;
            $pooja_id=$this->input->post('pooja_id');
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
            // redirect('welcome/payment')
        
//             // $refno=$this->session->refno;
            $this->session->set_userdata('mobile_no', $mobile_no);
			
            
            $amount=$this->input->post('amount');
        	$data['amount']=$amount;

            // if(!empty($dates)){
            //     $i=0;
            //     while ($i<sizeof($dates)){
            //         $data=$dates[$i];
            //         $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`total`,`status`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$amount','$data','$amount', '1')");
            //         $i++;
            //     }
            // }else{
            // 	$date = date('Y-m-d');
            //     $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`total`,`status`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$amount','$date','$amount', '1')");
            // }
            // 
            $existingData = $this->session->userdata('donation_online');
        	$star_eng = $this->site_model->getstarbyid($star_id)->star_eng;
        	$pooja_mal = $this->site_model->getpoojabyid($pooja_id)->pooja_nm;
        	$pooja_rate = $amount;
        	$pooja_time = '';
        	$deity_mal = $this->site_model->getdeitybyid(101)->diety_nm;

            if(!empty($dates)){
                $i=0;
                while ($i<sizeof($dates)){
                    $data=$dates[$i];
                	
                	$newArray = array(
                		'customer_id' => $customer_id,
                    	'name' => $name,
                    	'diety_id' => 101,
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
                		'qty' => 1,
                		'prasadam' => 0,
            		);
            		if($existingData)
                	{ 
                    	$updatedData = array_push($existingData, $newArray);
                	} else {
                		$existingData = array();
                		$updatedData = array_push($existingData, $newArray);
                	}
                
                    $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`total`,`status`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$amount','$data','$amount', '1')");
                    $i++;
                }
            }else{
            	$date = date('Y-m-d');
            	$newArray = array(
                		'customer_id' => $customer_id,
                    	'name' => $name,
                    	'diety_id' => 101,
                    	'star_id' => $star_id,
                    	'pooja_id' => $pooja_id,
                    	'rate' => $amount,
                    	'date' => $date,
                    	'status' => 1,
                		'star_eng' => $star_eng,
                    	'pooja_nm' => $pooja_mal,
                    	'pooja_rt' => $pooja_rate,
                		'pooja_time' => $pooja_time,
                		'qty' => 1,
                		'prasadam' => 0,
                    	'diety_nm' => $deity_mal,
                		'total'    => $amount
            		);
                if($existingData)
                { 
                    $updatedData = array_push($existingData, $newArray);
                } else {
                	$existingData = array();
                	$updatedData = array_push($existingData, $newArray);
                }
            	
              	$this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`total`,`status`) VALUES ('$customer_id','$name','$diety_id','$star_id','$pooja_id','$amount','$date','$amount', '1')");
            }

        	$this->session->set_userdata('donation_online', $existingData);
            redirect('worldline/donation');
        }
    }

	public function review($is_donation = null){
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        if ($this->form_validation->run() === FALSE){
        
            // $refno=$this->session->refno;
            
            $mobile_no=$this->session->mobile_no;
        if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
        if($mobile_no!='')
        {
			$query1 = $this->db->query("SELECT * FROM discount_fee where id=1");
            $result1 = $query1->first_row();
			$discountype=$result1->type;
			$discountamount=$result1->amount;
        }
        }
			
			
			if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
			$query = $this->db->query("SELECT * FROM memberships WHERE mobile_number='$mobile_no'");
            @$result = $query->first_row();
        
       
			@$plan=$result->plan; 
			$expirydate=strtotime(@$result->valid_to);
       
            }
        
       
			$currentDate = time();
			
            $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile_no'");
            $result = $query->first_row();
            $customer_id = $result->id;
           
            
            // $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($customer_id);
            $data['temple_list']=$this->site_model->gettemples();
            $data['user_list']=$this->site_model->getuserbyrefno($customer_id);

        	if($is_donation) {
            	$data['bill_list']=$this->session->userdata('donation_online');//$this->site_model->getdonationsbyrefno($customer_id);
            	$data['is_donation'] = 1;
				$data['discount']=0;
            	if(empty($data['bill_list'])){
            		redirect('worldline/donation');
            	}
        	} else {
            	$data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($customer_id);
            	$data['is_donation'] = 0;
				if(@$plan==1)
			{		$data['discountype']=$discountype;
					$data['discount']=$discountamount;
			}
			if(@$plan==2)
			{
				if ($currentDate <= $expirydate) {
					$data['discountype']=$discountype;
					$data['discount']=$discountamount;
				}
				else
				{
				$data['discountype']=0;
				$data['discount']=0;	
				}
			}
            	if(empty($data['bill_list'])){
                	redirect('worldline/booking');
            	}
        	}
        
            // if(empty($data['bill_list'])){
            //     redirect('worldline/booking');
            // }
           
            $this->load->view('site/layouts/bookingheader');
			$this->load->view('site/review_wl',$data);
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
                        redirect('worldline/booking');
                    }
                
                    $this->load->view('site/layouts/admin_header');
					$this->load->view('site/review_wl',$data);
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
                	if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "www.kaladyshankaramadomts.org") {
					$query1 = $this->db->query("SELECT * FROM discount_fee where id=1");
            $result1 = $query1->first_row();
			$discountype=$result1->type;
			$discountamount=$result1->amount;
                    }
                else
                {
                $discountamount=0;
                }
			
			if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
			$query = $this->db->query("SELECT * FROM memberships WHERE mobile_number='$mobile'");
            $result = $query->first_row();
			$plan=$result->plan;
			$expirydate=strtotime($result->valid_to);
			$currentDate = time();
            }
                    
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
            			redirect('worldline/payment/donation');
        			} else {
            			redirect('worldline/payment');
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
                    redirect('worldline/booking');
                }
                $this->load->view('site/layouts/admin_header');
				$this->load->view('site/review_wl',$data);
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
                        redirect('worldline/booking');
                    }
                    $this->load->view('site/layouts/admin_header');
					$this->load->view('site/review_wl',$data);
            		$this->load->view('site/layouts/admin_footer');
                }else {
                    $data['otp']='1';
                    $data['mob']=$mobile;
                    $data['error']='2';
                    $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    if(empty($data['bill_list'])){
                        redirect('worldline/booking');
                    }
                    $this->load->view('site/layouts/admin_header');
					$this->load->view('site/review_wl',$data);
            		$this->load->view('site/layouts/admin_footer');
                }
            }
        }
    }

	public function getUniqueOrderId()
    {
        do {
            // Generate a unique order ID. You can customize the generation logic as needed.
            $orderId = uniqid('order_', true);

            // Check if the generated order ID already exists in the billing_online table
            $this->db->where('order_id', $orderId);
            $query = $this->db->get('billing_online');

        } while ($query->num_rows() > 0);

        return $orderId;
    }

    public function payment($is_donation = null){
        date_default_timezone_set('Asia/Kolkata');
    	$this->load->library('razorpay');
    
        $mobileno=$this->session->mobile_no;
    	$query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobileno'");
        $user_dtl = $query->first_row();
        $customer_id = $user_dtl->customer_id;
		if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
		$query1 = $this->db->query("SELECT * FROM discount_fee where id=1");
            $result1 = $query1->first_row();
			$discountype=$result1->type;
			$discountamount=$result1->amount;
        }
    else {
    $discountamount=0;
    }
			
			if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
			$query = $this->db->query("SELECT * FROM memberships WHERE mobile_number='$mobileno'");
            $result = $query->first_row();
			$plan=$result->plan;
			$expirydate=strtotime($result->valid_to);
			$currentDate = time();
            }
        if($is_donation) {
    	    $data['bill_list']=$this->session->userdata('donation_online');//$this->site_model->getdonationsbyrefno($customer_id);

        	$data['is_donation'] = 1;
        	if(empty($data['bill_list'])){
        	redirect('worldline/donation');
        	}
    	} else {
    	    $data['bill_list']=$this->session->userdata('billing_online');//$this->site_model->getbillsbyrefno($customer_id);
        	$data['is_donation'] = 0;
			
        	if(empty($data['bill_list'])){
            	redirect('worldline/booking');
        	}
    	}
    
    	
        
    	$data['payment_gateway']=$this->site_model->getpaymentgateway();
    	$data['razorpay']=$this->site_model->getRazorpayCredentials();
    	$data['worldline']=$this->site_model->getWorldlineCredentials();
        $data['temple_list']=$this->site_model->gettemples();
        $data['user_list']=$this->site_model->getuserbymobile($mobileno); //$this->site_model->getuserbyrefno($refno);
        if(@$plan==1)
			{		$data['discountype']=$discountype;
					$data['discount']=$discountamount;
			}
			if(@$plan==2)
			{
				if ($currentDate <= $expirydate) {
					$data['discountype']=$discountype;
					$data['discount']=$discountamount;
				}
				else
				{
				$data['discountype']=0;
				$data['discount']=0;	
				}
			}
		$paymentgateway=$this->site_model->getpaymentgateway();
    	$total_payment = 0;
    	$bill_ids = array();
    	foreach($data['bill_list'] as $bill) {
        	$total_payment += $bill['total'];
        	$bill_ids[] = $bill['billing_online_id'];
        }
    $total1=0;
		if(@$data['discount']!=0)
		{
    	if(@$data['discountype']=='Fixed') { 
											$total1=@$data['discount'];
											}
											else
											{
											$total1=$total_payment/100*@$data['discount'];
											
											}
		}								
    	// $total_payment= += ($total_payment*$data['temple_list'][0]['payment_charge']/100);
			echo $total_payment=$total_payment-$total1;
			$bill_ids_string = implode(",", $bill_ids);
    	if($paymentgateway == 1) {
    		$data['order'] = $this->razorpay->createOrder($total_payment*100, 'INR');

        	$update_data = array(
    			'order_id' => $data['order']->id
			);
        } else {
        	$uniqueOrderId = $this->getUniqueOrderId();
        	$update_data = array(
    			'order_id' => $uniqueOrderId
			);
        
        	$data['order'] = (object)[
    			'amount' => $total_payment * 100, // amount in paisa (multiply by 100 for INR)
    			'currency' => 'INR',
    			'receipt' => 'order_rcptid_' . $uniqueOrderId,
    			'id' => $uniqueOrderId,
            	
			];
        }
    
    	

		$this->db->where_in('id', explode(',', $bill_ids_string));
		$this->db->update('billing_online', $update_data);
    
    	$this->session->set_userdata('total_payment', $total_payment);

        $data['settings'] 	= $this->mer_array;
		$data['amount'] 	= $total_payment;
    	$data['host'] 		= $this->host;

        if(empty($data['bill_list'])){
            redirect('worldline/booking');
        }
    if($paymentgateway=='4')
    {
        $this->load->view('site/layouts/bookingheader');
        $this->load->view('site/payment3',$data);
        $this->load->view('site/layouts/admin_footer');
    }
   else{
        $this->load->view('site/layouts/bookingheader');
        $this->load->view('site/online_booking/payment',$data);
        $this->load->view('site/layouts/admin_footer');
    }
    }
	public function do_payment($key){
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
					$this->db->select('sum(rate) as totalamount');
            		$this->db->from('billing_online');
            		$this->db->where('order_id', $payment['order_id']);
            		$totalamount = $this->db->get()->row()->totalamount;
					
                	$this->db->select('*');
            		$this->db->from('billing_online');
            		$this->db->where('order_id', $payment['order_id']);
            		$details = $this->db->get()->result_array();
            	
            		$payment_id          = $payment['id'];
            		$order_id            = $payment['order_id'];
            		$amount              = $payment['amount'];
                	$payment_method      = $payment['method'];
                	$bank_transaction_id = $payment['acquirer_data']['bank_transaction_id'] ?? $payment['acquirer_data']['rrn'] ?? '';
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
					$amount=$amount/100;
                	$this->db->insert('razorpay_transactions', $insert_data);
                
                	$this->db->where('payment_id', $payment_id);
                	$this->db->update('razorpay_transactions', $update_data);
            
            		$total = $amount;
            		$today = date('Y-m-d');
            		$now   = date('Y-m-d H:i:s');
        	
        			$orders      = $details;
            		$temple_list = $this->site_model->gettemples();
            		$deity		 = $orders[0]['diety_id'];
            		$customer_id = $orders[0]['customer_id'];
            		$count		 = '0';
					//$rate=$orders[0]['rate'];
					$discount=$totalamount-$amount;
                	if($this->db->field_exists('appearance', 'billing')) {
                		$appearance = $orders[0]['appearance'];
            			$this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`, `created_at`, `appearance`,discount) VALUES ('$deity','$today','$payment_id','$totalamount','$customer_id','$count','$totalamount', '2','$totalamount','6','0000-00-00 00:00:00','O', '$now', '$appearance','$discount')");
					} else {
                		$this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`, `created_at`) VALUES ('$deity','$today','$payment_id','$totalamount','$customer_id','$count','$totalamount', '2','$totalamount','6','0000-00-00 00:00:00','O', '$now')");
                	}
                                             
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
                			$message = urlencode("Jai Shankara, Dear $customer_name,Your  pooja $pooja_name on $data at Kalady Sri Adi Shankara  Madom, Telangana. We look forward to your participation. For any inquiries, 8350903080 \n Pranavam");
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
            	
            	if($bill_id) {
                	$customer_query = $this->db->select('*')->from('user_dtl')->where('id', $orders[0]['customer_id'])->get();
                	if($customer_query->num_rows() > 0) {
                    	$customer = $customer_query->row();
                    	$email	  = $customer->email;
						if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {	
                    		$this->sendBillPrint2($bill_id, $email);
                        }
                    }
            		redirect(site_url("worldline/thankyou/".$bill_id));
                } 
        } else if($fetch->amount == $total_payment && $fetch->id == $key){
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
            
//             		$pooja_name = $pooja[0]['name'];
//                     $pooja_date = date('d M Y', strtotime($data));
//                     $message =urlencode("Your pooja $pooja_name will be done on $pooja_date For more details please contact 04832833030 Regards PUNYEM SREEVYRAMAHAKALIKAVU");
//                     $send_date = date('Y-m-d', strtotime("-1 day", strtotime($data)));
                    
//                     if ($send_date < date('Y-m-d')) {
//                         $send_time = urlencode(date('Y-m-d')." 06:00pm");
//                     } else {
//                         $send_time = urlencode($send_date." 06:00pm");
//                     }

//             		//New
//             		$message = urlencode("Dear Customer Your verification code is $otp Regards Pranavam");
//     				$url = "http://sms.bourgeoninnovations.com/SMS_API/sendsms.php?apikey=22fae393-3f72-11ef-a4f5-e29d2b69142c&mobile=$mobile&sendername=PRNVMS&message=$message&routetype=1&tid=1607100000000317272";
//                     //------
//             		$url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYEM&route=1&time=$send_time&number=$mobile&message=$message&templateid=1707165424023889241";

//                 	$site_settings = $this->Cms_model->getSitesettings();
                	
//                 	$sms_notification_status = $site_settings[0]->sms_notification;
//                 	if($sms_notification_status == 1) {
//                     	$curl = curl_init($url);
//                     	curl_setopt($curl, CURLOPT_URL, $url);
//                     	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    
//                     	$resp = curl_exec($curl);
//                     	curl_close($curl);
//                     }
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
        
        	
        	$customer_query = $this->db->select('*')->from('user_dtl')->where('id', $customer_id)->get();
                	if($customer_query->num_rows() > 0) {
                    	$customer = $customer_query->row();
                    	$email	  = $customer->email;
						if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {	
                    		$this->sendBillPrint2($bill_id, $email);
                        }
                    }
            redirect(site_url("worldline/thankyou/".$bill_id));
        }else{
            redirect(site_url("worldline/payment"));
        }
    }

// 	public function response(){
// 		//create an Object of the above included class
// 		$obj = new AWLMEAPI();
	
// 		/* This is the response Object */
// 		$resMsgDTO = new ResMsgDTO();

// 		/* This is the request Object */
// 		$reqMsgDTO = new ReqMsgDTO();
// 		$enc_key = '6375b97b954b37f956966977e5753ee6';
	
// 		/* Get the Response from the WorldLine */
// 		$responseMerchant = $_REQUEST['merchantResponse'];
	
// 		$response = $obj->parseTrnResMsg( $responseMerchant , $enc_key );
//     	$data['response'] = $response;
    
//     	$total_payment = $this->session->userdata('total_payment')*100;
// 		$key = $response->getPgMeTrnRefNo();
    	
//     	// $testdata= "Reference No: ".$key."<br />"."Status Code: ".$response->getStatusCode()."<br />"
//     	// ."Status Desc: ".$response->getStatusDesc()."<br />"."Transaction Request Date: ".$response->getTrnReqDate()."<br />"
//     	// ."RRN: ".$response->getRrn()."<br />"."AuthZCode: ".$response->getAuthZCode()."<br />";
//     	// print_r($testdata);
//     	// exit;
//         if($response->getTrnAmt() == $total_payment && $response->getStatusCode() == 'S'){
//             $status_code = $response->getStatusCode();
//             $stts = ($status_code == 'S' ? 2 : 0);
//             $amd = ($response->getTrnAmt()/100);
//             $json_encode = json_encode($response);
//             $mobile=$this->session->mobile_no;
//             $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
//             $user_dtl = $query->first_row();
//             $customer_id = $user_dtl->id;
        	
            
//             $today=date('Y-m-d');
        	
//         	if(empty($this->session->userdata('billing_online'))){
//             	$orders=$this->session->userdata('donation_online');
//         	} else {
//             	$orders=$this->session->userdata('billing_online');
//             }
//             //$this->site_model->getorderbyrefno($customer_id);
//             $temple_list=$this->site_model->gettemples();
//             $deity=$orders[0]['diety_id'];
//             $count='0';
//             $total=$this->session->userdata('total_payment');
//             $this->db->query("INSERT INTO billing(`diety_id`,`transaction_date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`) VALUES ('$deity','$today','$key','$amd','$customer_id','$count','$total', '2','$total','6','0000-00-00 00:00:00','O')");

//         	$bill_id=$this->db->insert_id();
        
//             for($i=0;$i<count($orders);$i++){
//                 $name=$orders[$i]['name'];
//                 $dety=$orders[$i]['diety_id'];
//                 $ster=$orders[$i]['star_id'];
//                 $poja=$orders[$i]['pooja_id'];
//                 $rate=$orders[$i]['rate'];
//                 $prasadam=$orders[$i]['prasadam'];
//                 $time=$orders[$i]['time'];
//                 $qult=$orders[$i]['qty'];
//                 $amount=$qult*$rate;
//                 $data=$orders[$i]['date'];
//                 $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','$time','$rate','$data', '1','$amount','$prasadam')");
//                 if ($poja=="2000"){
//                     $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
//                 }
//             }
//             $cust_id=$this->loggedIn['id'];
        
//         	$this->session->unset_userdata('billing_online');
//             $this->db->query("DELETE FROM billing_online WHERE customer_id='$customer_id'");
        
//             redirect(site_url("worldline/thankyou/".$bill_id));
//         }else{
//             redirect(site_url("worldline/payment"));
//         }
//     	// $this->load->view('site/layouts/admin_header');
//         // $this->load->view('site/trnSuccess.php',$data);
//         // redirect(site_url("worldline/thankyou"));
//         // $this->load->view('site/layouts/admin_footer');
//     }

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
    	
    	if($dualVerifyData['responseType'] == 'S' && $dualVerifyData['paymentMethod']['paymentTransaction']['statusMessage'] == 'SUCCESS') {
        	$status_code = $dualVerifyData['responseType'];
            $stts = ($status_code == 'S' ? 2 : 0);
            $amd = ($dualVerifyData['responseType']['amount']/100);
        
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
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`,`bill_time`, `bill_type`) VALUES ('$deity','$today','$key','$amd','$customer_id','$count','$total', '2','$total','6','0000-00-00 00:00:00','O')");

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
        } else{
            redirect(site_url("worldline/payment"));
        }
    }

	public function dksjf(){
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
    	print_r($this->session->userdata('billing_online'));
    	exit;
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
        } else{
            redirect(site_url("worldline/payment"));
        }
    }

	public function thankyou($bill_id=null){

        if($bill_id!=null){
            $data['bill_id']=$bill_id;
        }else{
            $data['bill_id']="";
        } 

        $this->load->view('site/layouts/bookingheader');
        $this->load->view('site/thankyou_worldline', $data);
        $this->load->view('site/layouts/admin_footer');

    	$this->session->unset_userdata('billing_online');
    	$this->session->unset_userdata('donation_online');
    	$this->session->unset_userdata('mobile_number');
    	$this->session->unset_userdata('amount');
        // session_unset();     
        // session_destroy(); 
    }
	public function thankyouqrcode(){
        $name=$_SESSION['billing_online']['0']['name'];
        $referenceno=$_SESSION['reference_no'];
		$data['name']=$name;
		$data['reference_no']=$referenceno;

       // $pooja=$_SESSION['reference_no'];
        $this->db->query("UPDATE billing_online SET paymenttype='3' WHERE reference_no='$referenceno'");
               $this->load->view('site/layouts/admin_header');
        $this->load->view('site/thankyou_worldlineqrcode',$data);
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

        // $this->load->view('site/bill_print_worldline',$data);
        $this->load->library('dpdf');
    	if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "ayyappadevalayamtaramattipeta.com") {	
        	// $billprint = $this->load->view('site/bill_print_kalady', $data, true);
        	// $this->dpdf->createCustomPDF($billprint, 'mypdf', false, 'A4', 'portrait');
        	
			$query1=$this->db->query("select discount from billing  WHERE `id` = '$id'");
			$result1 = $query1->first_row();
			$discount=$result1->discount;
			if($discount=='') $discount=0;
        	if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org")
			{
			$query = $this->db->query("SELECT `billing_dtls`.*,billing.discount, `stars`.`name_eng` as `star_eng`, `pooja`.`name_mal` as `pooja_nm`, `billing_dtls`.`rate` as `pooja_rt`, `diety`.`name_mal` as `deity_nm` FROM `billing_dtls` JOIN `stars` ON `stars`.`id` = `billing_dtls`.`star` JOIN `pooja` ON `pooja`.`id` = `billing_dtls`.`pooja` JOIN `diety` ON `diety`.`id` = `billing_dtls`.`diety_id` JOIN `billing` ON `billing`.`id` = `billing_dtls`.`bill_id` WHERE `billing_dtls`.`bill_id` = '$id'");;	
			}
			else
			{
			$query = $this->db->query("SELECT `billing_dtls`.*, `stars`.`name_eng` as `star_eng`, `pooja`.`name_mal` as `pooja_nm`, `billing_dtls`.`rate` as `pooja_rt`, `diety`.`name_mal` as `deity_nm` FROM `billing_dtls` JOIN `stars` ON `stars`.`id` = `billing_dtls`.`star` JOIN `pooja` ON `pooja`.`id` = `billing_dtls`.`pooja` JOIN `diety` ON `diety`.`id` = `billing_dtls`.`diety_id` WHERE `billing_dtls`.`bill_id` = '$id'");;
        	}
			//$query = $this->db->query("SELECT `billing_dtls`.*, `stars`.`name_eng` as `star_eng`, `pooja`.`name_mal` as `pooja_nm`, `billing_dtls`.`rate` as `pooja_rt`, `diety`.`name_mal` as `deity_nm` FROM `billing_dtls` JOIN `stars` ON `stars`.`id` = `billing_dtls`.`star` JOIN `pooja` ON `pooja`.`id` = `billing_dtls`.`pooja` JOIN `diety` ON `diety`.`id` = `billing_dtls`.`diety_id` WHERE `billing_dtls`.`bill_id` = '$id'");;
        	$details = $query->result_array();
        	
        	$detail_array = array();
        	foreach($details as $detail) {
            	 $pooja_id  = $detail['pooja'];
        		 $detail_array[$pooja_id][] = $detail;
            }
			$data['discount']=$discount;
        	$data['bill_dtls'] = $detail_array;
        	if($_SERVER['HTTP_HOST'] == "ayyappadevalayamtaramattipeta.com"){
            	$data['letterhead'] = 'url("/assets/images/ayyappa/letter_head.jpg")';
            }else{
            	$data['letterhead'] = 'url("/assets/images/kalady/letter_head1.jpg")';
            }
        	$this->load->view('site/bill_print_kalady', $data);
        } else {
        	$billprint = $this->load->view('site/bill_print_worldline', $data, true);
        	$this->dpdf->createPDF($billprint, 'mypdf', false);
        }
        

        
        return; 
    }

	public function getDatedArray() {
        $date	   = $this->input->post('date');
        $dated_type = $this->input->post('dated_type');
    	$end_year  = $this->input->post('end_year');
    	$end_month = $this->input->post('end_month');

        $result=$this->general_model->getdatedstar($date, $dated_type, $end_year, $end_month);
        echo json_encode($result);
    }

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
        $this->email->subject('Your  Seva booking confirmed.Stay Blessed');
        
    	$data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($bill_id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($bill_id);
        $data['bill_id']=$bill_id;

        // HTML content
        $html_content = $this->load->view('site/thankyou_worldline_email', $data, TRUE);

        // Set HTML content as email message
        $this->email->message($html_content);
    
        // Send email
        if ($this->email->send()) {
            echo 'Email sent successfully.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

	private function base64_encode_image($path) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

	public function sendBillPrint2($bill_id, $email) {
    	if(!$email || $email == '') {
    		$recepient = 'kaladyshankaramadomts@gmail.com';
    	} else {
    		$recepient = array($email, 'kaladyshankaramadomts@gmail.com');
    	}
		
    	
    	$query = $this->db->query("SELECT `billing_dtls`.*, `stars`.`name_mal` as `star_eng`, `pooja`.`name` as `pooja_nm`, `billing_dtls`.`rate` as `pooja_rt`, `diety`.`name_mal` as `deity_nm` FROM `billing_dtls` JOIN `stars` ON `stars`.`id` = `billing_dtls`.`star` JOIN `pooja` ON `pooja`.`id` = `billing_dtls`.`pooja` JOIN `diety` ON `diety`.`id` = `billing_dtls`.`diety_id` WHERE `billing_dtls`.`bill_id` = '$bill_id'");
        	$details = $query->result_array();
        	
        	$detail_array = array();
        	foreach($details as $detail) {
            	 $pooja_id  = $detail['pooja'];
        		 $detail_array[$pooja_id][] = $detail;
            }
        
        	$data['bill_dtls'] = $detail_array;
    	
    	$data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($bill_id);
        $data['bill_id']=$bill_id;
    
    	$sign_image_path = FCPATH . 'assets/images/kalady/sign.jpeg';
        $seal_image_path = FCPATH . 'assets/images/kalady/seal.jpeg';
        $background_image_path = FCPATH . 'assets/images/kalady/letter_head1.jpg';

        // Convert images to base64
        $sign_image_base64 = $this->base64_encode_image($sign_image_path);
        $seal_image_base64 = $this->base64_encode_image($seal_image_path);
        $background_image_base64 = $this->base64_encode_image($background_image_path);

        // Pass base64 strings to the view
        $data['sign_image_base64'] = $sign_image_base64;
    	$data['seal_image_base64'] = $seal_image_base64;
    	$data['background_image_base64'] = $background_image_base64;

    	$this->load->model('general_model');

        // Set email configuration
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_port'] = 465; // or 587 for TLS
        $config['smtp_crypto'] = 'ssl'; // or 'tls' for TLS
        $config['smtp_user'] = 'webmasteradisankaramadom@gmail.com';
        $config['smtp_pass'] = 'zwra quju ybmq ufuc ';
        $config['mailtype'] = 'html'; // Set mailtype to html
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n"; // Important for Gmail
    
        $this->email->initialize($config);

        // Set email parameters
        $this->email->from('webmasteradisankaramadom@gmail.com', 'Kalady Adishankara Madom');
        $this->email->to($recepient);
        $this->email->subject('Your Seva booking confirmed. Stay Blessed');
	

        // Load HTML content from the view
        $html_content = $this->load->view('site/thankyou_worldline_email', $data, TRUE);

        // Initialize Dompdf
        // $this->load->view('site/bill_print_worldline',$data);
        $this->load->library('dpdf');
    	$billprint = $this->load->view('site/bill_print_kalady_2', $data, true);
       	$pdf_file_path = $this->dpdf->kaladyCustomPdf($billprint, 'mypdf', false, 'A4', 'portrait');
		
        // Set the HTML content as email message
        $this->email->message($html_content);

        // Attach the PDF file to the email
        $this->email->attach($pdf_file_path);

        // Send the email
        if ($this->email->send()) {
            echo 'Email sent successfully with PDF attachment.';
        } else {
            echo 'Failed to send email.';
            show_error($this->email->print_debugger());
        }

        // Clean up the generated PDF file
        unlink($pdf_file_path);
    }

	public function checkPoojaAvailability($date, $pooja_id, $quantity, $is_submit, $appearance=null) {
        $pooja = $this->general_model->getpoojasById($pooja_id);

		$pooja_ids = array();
    	$flag 	   = false;
    	
    	$pooja_ids[] = $pooja_id;
    
    	foreach($pooja_ids as $pooja_id) {
        	$pooja = $this->general_model->getpoojasById($pooja_id);

        	$temp_qty = 0; 	    
			$query = $this->db->select('SUM(billing_dtls.qlt) as qty')
                ->from('billing')
                ->join('billing_dtls', 'billing.id = billing_dtls.bill_id')
                ->join('pooja', 'billing_dtls.pooja = pooja.id')
                ->where('billing_dtls.pooja', $pooja_id)
                ->where('billing.deleted', 0);
        		
        
           if($appearance) {
           		$query = $query->where('billing.appearance', 'P');
           }
        
           $query = $query->where('billing_dtls.date', $date)
                ->where('pooja.allowed_qty >', 0)
            	->get();
        
           		if($appearance == 'P') {
    				$qty = $query->row()->qty ?? 0;
            	} else {
            		$qty = 0;
            	}
        	
    	

    		if($qty == 0 && $pooja[0]['allowed_qty'] > 0) { 
        		if(($temp_qty + $quantity) > $pooja[0]['allowed_qty']) {
            		$flag = true;
            		$available_qty = ($pooja[0]['allowed_qty'] - $temp_qty);
            	}
            } else if($qty > 0 && $pooja[0]['allowed_qty'] > 0) {
        		if(($qty + $temp_qty + $quantity) >= $pooja[0]['allowed_qty']) {
            		$flag = true;
            		$available_qty = ($pooja[0]['allowed_qty']- ($qty + $temp_qty));
            	}
        	}
    
//     		$this->db->select('*');
//     		$this->db->from('pooja_availability');
//     		$this->db->where('pooja_id', $pooja_id);
//     		$this->db->where('pooja_date', $date);
//     		$availability_query = $this->db->get();

//     		if($availability_query->num_rows() > 0 ) {
//         		$availability = $availability_query->row();
//         		$max_qty 	= $availability->quantity;
//         		$issued_qty = (int)$availability->issued_qty;
        
//         		if($issued_qty > 0 && ($issued_qty - ($quantity+$temp_qty)) < 0 ) {
//             		$flag=true;
//             		$available_qty = ($issued_qty-$temp_qty);
//             	} else if ($issued_qty == 0) {
//             		$flag=true;
//             		$available_qty = 0;
//             	}
//         	}
        }
    
    	return $flag;
    }
	
	public function poojaAvailabilityCheck() {
    	$date 		= $this->input->post('date');
        $pooja_id 	= $this->input->post('pooja_id');
    	$quantity  	= (int)$this->input->post('qty');
    	$is_submit 	= $this->input->post('is_submit');
    	$appearance = $this->input->post('participation');
    
    	$pooja = $this->general_model->getpoojasById($pooja_id);
    	$flag = $this->checkPoojaAvailability($date, $pooja_id, $quantity, $is_submit, $appearance);
    
        if($flag) {
        	echo json_encode([
                    'exists'=> 1,
                    'pooja'=> $pooja[0]['name'],
            		'qty'  => $available_qty ?? null
                ]);
        } else {
        	echo json_encode([
                    'exists'=> 0
                ]);
        } 
    }


	public function checkPoojaQTY() {
    	$date 		= $this->input->post('date');
        $pooja_id 	= $this->input->post('pooja_id');
    	$quantity  	= (int)$this->input->post('qty');
    	$is_submit 	= $this->input->post('is_submit');
    	$appearance = $this->input->post('participation');
    	
    	$pooja 		 = $this->general_model->getpoojasById($pooja_id);
		$allowed_qty = (int)$pooja[0]['allowed_qty'];
		$available_qty=0;
    	$flag 	   = false;
    
        $temp_qty = 0;	    
		$query = $this->db->select('SUM(billing_dtls.qlt) as qty')
                ->from('billing')
                ->join('billing_dtls', 'billing.id = billing_dtls.bill_id')
                ->join('pooja', 'billing_dtls.pooja = pooja.id')
                ->where('billing_dtls.pooja', $pooja_id)
                ->where('billing.deleted', 0)
        		->where('billing.appearance', 'P')
                ->where('billing_dtls.date', $date)
                ->where('pooja.allowed_qty >', 0)
            	->get();
        
    	$qty = $query->row()->qty ?? 0;
    	$total_qty = $qty + $quantity;
    	
        if($appearance == 'P' && $allowed_qty > 0 && $total_qty <= $allowed_qty) {
    		$available_qty += ($allowed_qty - $qty);
		}

    	echo json_encode([
                    'appearance'   => $appearance,
        			'allowed_qty'  => $allowed_qty,
            		'qty'  		   => $available_qty ?? null
                ]);
    }

	public function test() {
    	$poja = 1;
    	$customer_id = 4;
    	$mobile='8590239045';
    	$data = '24/07/2024';
    	if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
                    
                    	$pooja_name = $this->db->where('id', $poja)->get('pooja')->row()->name;
                    	$customer_name = $this->db->where('id', $customer_id)->get('user_dtl')->row()->name;
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