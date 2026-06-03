<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Schedulebilling_model extends CI_Model {
		public function getbillsbyrefno($id){
            
            $this->db->select('billing_online.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt,diety.name_mal as diety_nm');
            $this->db->from('billing_online');
            $this->db->join('stars','stars.id = billing_online.star_id');
            $this->db->join('pooja','pooja.id = billing_online.pooja_id');
            $this->db->join('diety','diety.id = billing_online.diety_id');
            $this->db->where('billing_online.reference_no', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
         public function getbillsbyrefno1($id){
            $this->db->select('billing_online.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt,diety.name_mal as diety_nm');
            $this->db->from('billing_online');
            $this->db->join('stars','stars.id = billing_online.star_id');
            $this->db->join('pooja','pooja.id = billing_online.pooja_id');
            $this->db->join('diety','diety.id = billing_online.diety_id');
            $this->db->where('billing_online.reference_no', $id);
            $this->db->group_by('billing_online.name');
            $query = $this->db->get();
            // print_r($this->db->last_query());
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getorderbyrefno($refno){
            $this->db->select('*');
            $this->db->from('billing_online');
            $this->db->where('reference_no', $refno);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getbillsbyrefno2($id){
        	$result = array();
        
            $this->db->select('SUM(billing_online.rate) as rate ,billing_online.total, user_dtl.*');
            $this->db->from('billing_online');
            $this->db->join('user_dtl', 'user_dtl.id=billing_online.customer_id', 'LEFT');
            $this->db->where('billing_online.reference_no', $id);
            $this->db->group_by('billing_online.name,billing_online.pooja_id');
            $this->db->order_by('id','asc');
            $query = $this->db->get();
             //print_r($this->db->last_query());
            
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $val) {
                	$result['orders'][] = $val;
                }
            	return $result;
            }
            else {
                return 0;
            }
        }
        
        public function getbillsbyrefno5($id){
            $this->db->select('billing_online.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt,diety.name_mal as diety_nm');
            $this->db->from('billing_online');
            $this->db->join('stars','stars.id = billing_online.star_id');
            $this->db->join('pooja','pooja.id = billing_online.pooja_id');
            $this->db->join('diety','diety.id = billing_online.diety_id');
            $this->db->where('billing_online.reference_no', $id);
            $this->db->group_by('billing_online.name,billing_online.pooja_id');
            $query = $this->db->get();
            // print_r($this->db->last_query());
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }


		public function generateSlug($text) {
        	// Replace spaces with underscores
        	$slug = str_replace(' ', '_', $text);
        
        	// Remove non-alphanumeric and non-underscore characters
        	$slug = preg_replace('/[^\w_]/', '', $slug);
        
        	// Convert to lowercase
       	 	$slug = strtolower($slug);
        
        	return $slug;
    	}
    	
    	public function translateToLcl($text) {
        	// Replace spaces with underscores
        	$inputText = $this->input->post('search');
        	$curlSession = curl_init(); 
        	curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ml&dt=t&q='.urlencode($text));
        	curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        	curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        	$response = curl_exec($curlSession);
        	$jsonData = json_decode($response);
        	curl_close($curlSession);
    
        	if(isset($jsonData[0][0][0])){
        		$response = array("name"=>$jsonData[0][0][0]);
                return json_encode($response);
        	}else{
            	return $text;
        	}
    	}

		public function changeStatusAdvancedBooking($advanced_id, $status, $date=null) {
            $this->db->select('id');
            $this->db->from('advanced_pooja_status');
            $this->db->where('slug', $status);
            $status_id = $this->db->get()->row()->id;
            
            try {
                if ($status != 'date_allocated') {
                    if (is_array($advanced_id)) {
                        foreach($advanced_id as $id) {
                            $this->db->where('id', $id);
                            $this->db->update('advanced_billing_details', array(
                                'status' => $status_id
                            ));
                        }
                    } else {
                        $this->db->where('id', $advanced_id);
                        $this->db->update('advanced_billing_details', array(
                            'status' => $status_id
                        ));
                    }
                    
                } else {
                    if (is_array($advanced_id)) {
                        foreach($advanced_id as $id) {
                            $this->db->where('id', $id);
                            $this->db->update('advanced_billing_details', array(
                                'status' => $status_id
                            ));
                            
                            $this->db->select('*');
                            $this->db->from('advanced_billing_details');
                            $this->db->where('id', $id);
                            $advanced_detail = $this->db->get()->row();
                                
                            $this->db->where('id', $advanced_detail->billing_detail_id);
                            $this->db->update('billing_dtls', array(
                                    'date' => $date
                                ));
                        }
                    } else {
                        $this->db->where('id', $advanced_id);
                        $this->db->update('advanced_billing_details', array(
                            'status' => $status_id
                        ));
                        
                        $this->db->select('*');
                        $this->db->from('advanced_billing_details');
                        $this->db->where('id', $advanced_id);
                        $advanced_detail = $this->db->get()->row();
                            
                        $this->db->where('id', $advanced_detail->billing_detail_id);
                        $this->db->update('billing_dtls', array(
                                'date' => $date
                            ));
                    }
                        
                }
                
                
                if (is_array($advanced_id)) {
                    foreach($advanced_id as $id) {
                        $this->db->insert('advanced_billing_status_updation_log', array(
                            'advanced_billing_id' => $id,
                            'status' => $status,
                            'date'   => date('Y-m-d')
                        ));
                    }
                } else {
                    $this->db->insert('advanced_billing_status_updation_log', array(
                            'advanced_billing_id' => $advanced_id,
                            'status' => $status,
                            'date'   => date('Y-m-d')
                        ));
                }
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

		public function checkForPayment($bill_id) {
	        $this->db->select('payment.pay_Id as id');
	        $this->db->from('billing');
	        $this->db->join('user_dtl', 'billing.customer_id=user_dtl.id');
	        $this->db->join('payment', 'payment.ledger=user_dtl.led_id');
	        $this->db->where('payment.ref_no', $bill_id);
	        $query = $this->db->get();
	        
	        return $query->row()->id ?? 0;
	    }

		public function getpostalbyrefno($refno) {
	        $this->db->select('billing_online.*');
            $this->db->from('billing_online');
            $this->db->where('billing_online.reference_no', $refno);
            $this->db->where('billing_online.prasadam_amt !=', 0);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->num_rows();
            }
            else {
                return 0;
            }
	    }

		public function getTotalBillAmount($refno) {
	        $this->db->select('*');
            $this->db->from('billing_online');
            $this->db->where('billing_online.reference_no', $refno);
        	$this->db->or_where('billing_online.customer_id', $refno);
            $query = $this->db->get();
       // echo $this->db->last_query(); 
        	$orders = $query->result();
        
        	$total = 0;
        	foreach($orders as $order) {
            	$total += ($order->qty * $order->rate);
            }
        
        	return $total;
	    }
}
