<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Billing_model extends CI_Model {

	public function getCurrentFinancialYear() {
        	$date = date('Y-m-d');

        	$this->db->select('*');
        	$this->db->from('financial_years');
        	$this->db->where('start_date <=', $date);
        	$this->db->where('end_date >=', $date);
        	$query = $this->db->get();
        
        	if ($query->num_rows() > 0) {
    			return $query->result(); // Fetch the first row from the result set
			} else {
    			return null; // No matching financial year found
			}
        }

		public function getCurrentFyId() {
        	$fy = $this->getCurrentFinancialYear()[0];
        	$fy_id     = $fy->id;
        
        	return $fy_id;
        } 
	
		public function getCurrentFy() {
        	$fy = $this->getCurrentFinancialYear()[0];
  
        	return $fy->financial_year;
        } 

		public function getCurrentFyNo() {
        	$fy_id	= $this->getCurrentFyId();
        	
        	$this->db->select('fy_bill_no');
        	$this->db->from('billing');
        	$this->db->where('fy_id', $fy_id);
        	$this->db->order_by('fy_bill_no','desc');
        	$this->db->limit(1);
        	$query = $this->db->get()->row();
        
        	$last_fy_no    = $query->fy_bill_no ?? 0;
        	$current_fy_no = $last_fy_no + 1;
        	
        	return $current_fy_no;
        } 

		public function getCurrentFyBillNo() {
        	$current_fy_no = $this->getCurrentFyNo();
        	$fy_prefix     = $this->getCurrentFy();
        
        	return $fy_prefix.'/'.$current_fy_no;
        }    	
}
