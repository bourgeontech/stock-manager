<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Report_model extends CI_Model {

	public function getbills($datef, $datet){
    		
            $this->db->select('billing.*');
            $this->db->from('billing');
            $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
			$this->db->order_by('id', 'asc');
   		 	$this->db->group_by('billing.date');
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
    }

public function getUpiBills($datef, $datet, $category_id=null) {
        $this->db->select('id, name, name_mal');
        $this->db->from('cat');
    	if ($category_id) {
        	$this->db->where('id', $category_id);
        }
        $query = $this->db->get();
        $categories = $query->result();
        $summary = array();
    	
        foreach($categories as $category) {
            $this->db->select('
                billing.bank_transaction_id as bank_transaction_id, 
                billing.id as billing_id,
                billing_dtls.*, 
                pooja.name as pooja, 
                pooja.name_mal as pooja_locale,
                GROUP_CONCAT(billing_dtls.amount) as individual_amounts,
                SUM(billing_dtls.amount) as total_amount,
                SUM(billing_dtls.qlt) as quantity
            ');
            $this->db->from('billing');
            $this->db->join('billing_dtls', 'billing_dtls.bill_id = billing.id');
            $this->db->join('pooja', 'pooja.id = billing_dtls.pooja');
            $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
            $this->db->where('pooja.cat', $category->id);
            $this->db->where('billing.deleted', 0);
            $this->db->where('billing.mode', 6);
            $this->db->order_by('billing.id', 'asc');
            $this->db->group_by('billing.id, billing_dtls.pooja'); 
            $query = $this->db->get();
                
            if ($query->num_rows() > 0) {
                $summary[$category->id]['category'] = $category;
                $summary[$category->id]['bills'] = $query->result_array();
            } 
        }

        return $summary;
    }



	public function getPOSBills($datef, $datet, $category_id=null) {
    	$otherdb    = $this->load->database('otherdb', TRUE);
    	$current_db = $this->db->database;
    	
    	$user_query = $otherdb->select('users.*')
                 			  ->from('users')
                 			  ->join('temples', 'users.punnyam_code = temples.punnyam_code')
        					  ->where('temples.user_db', $current_db)
                 			  ->get();
    
    	$summary = [];
    	if ($user_query->num_rows() > 0) {
        	$users = $user_query->result();
        
        	foreach($users as $user) {
            	$summary[$user->id]['user']  = $user->name;
            	$summary[$user->id]['email'] = $user->email;
            
            	$role=$this->loggedIn['role'];
                
            	$this->db->select('SUM(billing_dtls.amount) as tot_booking,billing.counter,counter.name as counter_name');
                $this->db->from('billing');
                $this->db->join('billing_dtls','billing_dtls.bill_id = billing.id');
                $this->db->join('counter','billing.counter = counter.id');
                $this->db->where('billing.deleted', 0);
                $this->db->where('billing.pos_user_id', $user->id);
                $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
               	$this->db->group_by('billing.counter');
				
            	$query = $this->db->get();
            	$result = $query->result();
            	
            	$counter_wise = array();
            	foreach ($result as $c_wise) {
                	$counter_wise[] = array(
                    					'counter'=> $c_wise->counter_name,
                    					'total_amount'=> $c_wise->tot_booking,
                    				  );
                }
            
            	$summary[$user->id]['report'] = $counter_wise;
            }
        }
    	
    	return $summary;
    }
	
	public function getapprovedonlinebills($datef, $datet) {
    		$this->db->select('billing.*, SUM(billing_dtls.amount) as total, user_dtl.name as customer');
            $this->db->from('billing');
    		$this->db->join('billing_dtls', 'billing_dtls.bill_id=billing.id');
    		$this->db->join('user_dtl', 'user_dtl.id=billing.customer_id');
            $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
    		$this->db->where('billing.status', 2);
    		$this->db->where('billing.deleted', 0);
			$this->db->order_by('billing.id', 'asc');
   		 	$this->db->group_by('billing.id');
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
    
//     		$this->db->select('billing.id,billing.date,billing.transaction_date, SUM(billing_dtls.amount) as total, user_dtl.name as customer');
// 			$this->db->from('billing');
// 			$this->db->join('billing_dtls', 'billing.id = billing_dtls.bill_id');
//     		$this->db->join('user_dtl', 'user_dtl.id = billing.customer_id', 'left');
// 			$this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
// 			$this->db->where('billing.status', 2);
//     		$this->db->where('billing.deleted', 0);
// 			$this->db->order_by('billing.id', 'asc');
//    		 	// $this->db->group_by('billing.date');
//             $query = $this->db->get();
    
//             if ($query->num_rows() > 0) {
//                 return $query->result_array();
//             }
//             else {
//                 return 0;
//             }
    }

	public function getscheduledbills($datef, $datet, $keyword = null) {
    	$this->db->select('billing.id as bill_no, user_dtl.name as customer, user_dtl.id as customer_id, user_dtl.mobile as mobile, billing.total as total');
    	$this->db->from('billing');
    	$this->db->join('billing_dtls', 'billing_dtls.bill_id=billing.id');
    	$this->db->join('user_dtl', 'user_dtl.id=billing.customer_id');
    	$this->db->where('billing_dtls.date>=', $datef);
    	$this->db->where('billing_dtls.date<=', $datet);
    	if($keyword) {
        	$this->db->where('user_dtl.mobile', $keyword);
        	$this->db->or_where('billing.id', $keyword);
        }
    	$this->db->where('billing.deleted', 0);
    	$this->db->where('billing_dtls.type', 'S');
    	$this->db->group_by('billing_dtls.bill_id');
    	$query = $this->db->get();
    
    	if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return 0;
        }
    }

	public function getscheduledbilldetails($id) {
    	$this->db->select('billing_dtls.id as id, billing_dtls.bill_id as bill_id, billing_dtls.name as name, stars.name_eng as star_eng, pooja.name as pooja, diety.name as deity, billing_dtls.date as date, billing_dtls.qlt as qty, billing_dtls.amount as total');
    	$this->db->from('billing_dtls');
    	$this->db->join('pooja', 'pooja.id=billing_dtls.pooja');
    	$this->db->join('diety', 'diety.id=billing_dtls.diety_id');
    	$this->db->join('stars', 'stars.id=billing_dtls.star');
    	$this->db->where('billing_dtls.bill_id', $id);
    	$query = $this->db->get();
    	
    	if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return 0;
        }
    }

 	public function getbillingdtlsById($id){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->where('billing_dtls.id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

	public function getbillingdtlsByDate($id, $date){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->where('billing_dtls.bill_id', $id);
    		$this->db->where('billing_dtls.date', $date);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

	public function get_individual_important_pooja_report($date_from,$date_to,$pooja_id){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,SUM(billing_dtls.qlt) as qlt, pooja.id as pooja_id, diety.name as deity_nm,billing.date as billingdate, (billing.total) as total, (billing.recv_amt) as received');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->where('billing_dtls.date >= ', $date_from);
    		$this->db->where('billing_dtls.date <= ', $date_to);
    
     		$this->db->where('pooja.isimp', '1');
    
    		if($pooja_id!='0'){
            	$this->db->where('billing_dtls.pooja', $pooja_id);
            }
    
     		$this->db->order_by('pooja.name');
    		$this->db->group_by('billing.id');
    
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

	public function get_important_pooja_report($date_from,$date_to,$pooja_id) {
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.id as pooja_id, diety.name as deity_nm,billing.date as billingdate, SUM(billing_dtls.qlt) as qty, SUM(billing.total) as total, SUM(billing.recv_amt) as received');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->where('billing_dtls.date >= ', $date_from);
    		$this->db->where('billing_dtls.date <= ', $date_to);
    
     		$this->db->where('pooja.isimp', '1');
    
    		if($pooja_id!='0'){
            	$this->db->where('billing_dtls.pooja', $pooja_id);
            }
    
     		$this->db->order_by('pooja.name');
    		$this->db->group_by('pooja.name');

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
    }
	
	public function get_date_wise_pooja_count($start_date, $end_date, $pooja_id) {
    	$this->load->helper('date');
    	$this->load->helper('array');
    
		$start_timestamp = strtotime($start_date);
		$end_timestamp = strtotime($end_date);
   		$dates_between = date_range($start_timestamp, $end_timestamp);

    	$result = array();
		foreach ($dates_between as &$date) {
    		$this->db->select('pooja.name as pooja, SUM(billing_dtls.qlt) as quantity, pooja.rate as rate');
        	$this->db->from('billing_dtls');
        	$this->db->join('billing', 'billing_dtls.bill_id=billing.id');
        	$this->db->join('pooja', 'billing_dtls.pooja=pooja.id');
        	$this->db->where('billing_dtls.pooja', $pooja_id);
        	$this->db->where('billing.date', $date);
        	$this->db->where('billing.deleted', 0);
        	$query = $this->db->get();
        
        	$result[$date] = array(
            				'pooja' 	=> $query->row()->pooja,
            				'quantity'  => $query->row()->quantity,
            				'rate'  	=> $query->row()->rate,
            				'amount'  	=> $query->row()->rate * $query->row()->quantity,
            			);
		}
    
    	return $result;
    }

	public function get_pooja_wise_token_summary($date, $deity_id, $pooja_id=null) {
    	$this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,diety.name as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->where('billing_dtls.date =', $date);
            $this->db->where('billing.deleted', '0');
          
            if($deity_id!=0){
                $this->db->where('billing_dtls.diety_id', $deity_id);
            }
    
            if($pooja_id){
                $this->db->where('billing_dtls.pooja =', $pooja_id );
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $bills = $query->result_array();
            	
            	$result_array = [];
            	foreach($bills as $bill) {
                	$bill_id 		= $bill['bill_id'];
                    	$bill_detail_id = $bill['id'];
                    	$pooja_id 		= $bill['pooja'];
   
                    	$data = array('bill_id'=> $bill_id, 'bill_detail_id'=> $bill_detail_id, 'pooja_id'=> $pooja_id, 'date'=> $date);
                    	$this->db->where($data);
        				$query = $this->db->get('pooja_token_print_log');

        				$exists = $query->num_rows() > 0;
                    
                    	if( !$exists ) {
                        	$result_array[] = $bill;
                        } 
                }
            
            	return $result_array;
            }
            else {
                return 0;
            }
    }

	public function set_pooja_wise_token_summary_print($date, $deity_id, $pooja_id=null) {
    	$this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,diety.name as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->where('billing_dtls.date =', $date);
            $this->db->where('billing.deleted', '0');
          
            if($deity_id!=0){
                $this->db->where('billing_dtls.diety_id', $deity_id);
            }
    
            if($pooja_id){
                $this->db->where('billing_dtls.pooja =', $pooja_id );
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $bills = $query->result_array();
            
            	foreach($bills as $bill) {
                	if ($bill['token']) {
                    	$bill_id 		= $bill['bill_id'];
                    	$bill_detail_id = $bill['id'];
                    	$pooja_id 		= $bill['pooja'];
   
                    	$data = array('bill_id'=> $bill_id, 'bill_detail_id'=> $bill_detail_id, 'pooja_id'=> $pooja_id, 'date'=> $date);
                    	$this->db->where($data);
        				$query = $this->db->get('pooja_token_print_log');

        				$exists = $query->num_rows() > 0;
                    
                    	if( !$exists ) {
                        	$this->db->insert('pooja_token_print_log', $data);
                        }
                    }
                }
            }
            else {
                return false;
            }
    }

	public function getPoojaAvailabilityLog($date_from, $date_to) {
    	$this->db->select('pooja_availability_log.*, pooja_availability_log.quantity as quantity, pooja.name as pooja, admin.name as user');
    	$this->db->from('pooja_availability_log');
    	$this->db->join('admin', 'admin.id=pooja_availability_log.user_id');
    	$this->db->join('pooja', 'pooja_availability_log.pooja_id=pooja.id');
    	$this->db->join('pooja_availability', 'pooja_availability_log.pooja_date=pooja_availability.pooja_date');
    	$this->db->where('pooja_availability.pooja_id = pooja_availability_log.pooja_id');
    	$this->db->where('pooja_availability_log.pooja_date >=', $date_from);
    	$this->db->where('pooja_availability_log.pooja_date <=', $date_to);
    	$query = $this->db->get();

    	$result = $query->result();
    
    	$logs = [];
    	foreach ($result as $log) {
        	$log->bill_qty = $this->findBilledQty($log->pooja_date, $log->pooja_id);
        	$logs[] = $log;
        }
    
    	return $logs;
    }

	public function findBilledQty($date, $pooja_id) {
    	$this->db->select('SUM(billing_dtls.qlt) as qty');
    	$this->db->from('billing_dtls');
    	$this->db->join('billing', 'billing_dtls.bill_id=billing.id');
    	$this->db->where('billing_dtls.date', $date);
    	$this->db->where('billing_dtls.pooja', $pooja_id);
    	$this->db->where('billing_dtls.deleted', 0);
    	$this->db->where('billing.deleted', 0);
    	$query = $this->db->get();
    
    	if ($query->num_rows() > 0) {
        	return $query->row()->qty;
        } else {
        	return 0;
        }
    }

	public function getCustomerAddresses($date_from, $date_to) {
    	$this->load->helper('array');
    
    	$this->db->select('user_dtl.*, billing_dtls.name,billing_dtls.postal_amt, temple.postel_charge as LC, T.airmail_charge as FC');
    	$this->db->from('billing_dtls');
    	$this->db->join('billing', 'billing_dtls.bill_id=billing.id');
    	$this->db->join('user_dtl', 'user_dtl.id=billing.customer_id');
    	$this->db->join('temple', 'billing_dtls.postal_amt=temple.postel_charge', 'LEFT');
    	$this->db->join('temple T', 'billing_dtls.postal_amt=T.airmail_charge', 'LEFT');
    	$this->db->where('billing_dtls.date >=', $date_from);
    	$this->db->where('billing_dtls.date <=', $date_to);
    	$this->db->where('billing_dtls.type', 'S');
    	// $this->db->where('billing_dtls.deleted', 0);
    	$this->db->where('billing.deleted', 0);
    	$this->db->where('billing_dtls.postal_amt !=', 0);
    	$query = $this->db->get();

    	if ($query->num_rows() > 0) {
                $customers = $query->result_array();
            	
            	$result = [];
            	foreach($customers as $customer) {
                	$curlSession = curl_init(); 
    			    curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=ml&tl=en&dt=t&q='.urlencode($customer['name']));
    				curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    				curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    				$response = curl_exec($curlSession);
    				$jsonData = json_decode($response);
    				curl_close($curlSession);

    				if(isset($jsonData[0][0][0])){
            			$name = $jsonData[0][0][0];
    				} else{
       					$name = $customer['name'];
    				}
                
                	$result[] = (object)(array(
                    	'id' => $customer['id'],
                    	'name'=> $customer['name'],
                    	'house'=> $customer['house'],
                    	'post'=> $customer['post'],
                    	'street'=> $customer['street'],
                    	'pincode'=> $customer['pincode'],
                    	'district'=> $customer['district'],
                    	'state'=> $customer['state'],
                    	'mobile'=> $customer['mobile'],
                    	'email'=> $customer['email'],
                    	'postal_local'=> $customer['LC'],
                    	'postal_air'=> $customer['FC'],
                        'postal_amt'=> $customer['postal_amt']
                    ));
                }
            
            	return $result;
            }
            else {
                return 0;
            }
    }

	public function getCustomPoojas() {
    	$this->db->select('custom_bookings_poojas.*, pooja.name as pooja_name');
    	$this->db->from('custom_bookings_poojas');
    	$this->db->join('pooja', 'custom_bookings_poojas.pooja_id=pooja.id');
    	$this->db->group_by('custom_bookings_poojas.pooja_id');
    	
    	return $this->db->get()->result();
    }

	public function getCustomBookings($date_from, $date_to, $pooja_id) {
    	$this->db->select('billing.*, billing_dtls.date as pooja_date, user_dtl.name as customer, custom_booking_details.contact_number_1 as contact_number, billing_dtls.name as name, pooja.name as pooja_name');
    	$this->db->from('billing');
    	$this->db->join('user_dtl', 'user_dtl.id=billing.customer_id');
    	$this->db->join('billing_dtls', 'billing_dtls.bill_id=billing.id');
    	$this->db->join('pooja', 'billing_dtls.pooja=pooja.id');
    	$this->db->join('custom_bookings_poojas', 'custom_bookings_poojas.pooja_id=billing_dtls.pooja');
    	$this->db->join('custom_booking_details', 'custom_booking_details.bill_id=billing.id');
    	$this->db->where('billing.date >=', $date_from);
    	$this->db->where('billing.date <=', $date_to);
    	$this->db->where('custom_booking_details.pooja_id', $pooja_id);
    	$this->db->group_by('billing.id');
    	
    	return $this->db->get()->result();
    }

	public function getCustomReport($date_from, $date_to) {
    	$this->db->select('billing.*');
    	$this->db->from('billing');
    	
    	$this->db->where('billing.date >=', $date_from);
    	$this->db->where('billing.date <=', $date_to);
    	
    	
    	
    	return $this->db->get()->result();
    }
}
