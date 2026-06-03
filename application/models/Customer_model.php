<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Customer_model extends CI_Model {

    public function getCustomerIdByMobile($mobile_number) {
    	$this->db->select('customer_id');
    	$this->db->from('user_dtl');
    	$this->db->where('mobile', $mobile_number);
    	$query = $this->db->get();

    	if ($query->num_rows() > 0) {
        	return $query->row()->customer_id;
    	} else {
        	return false;
    	}
	}

	public function getCustomerByMobileNumber($mobile_number) {
    	$this->db->select('*');
    	$this->db->from('user_dtl');
    	$this->db->where('mobile', $mobile_number);
    	$query = $this->db->get();

    	if ($query->num_rows() > 0) {
        	return $query->row();
    	} else {
        	return false;
    	}
	}

	public function getPoojaBookings($customer_id) {
    	$this->db->select('billing_dtls.*, billing.created_at, pooja.name as pooja_name'); 
    	$this->db->from('billing_dtls');
    	$this->db->join('billing', 'billing.id = billing_dtls.bill_id');
    	$this->db->join('pooja', 'pooja.id = billing_dtls.pooja'); 
    	$this->db->where('billing.customer_id', $customer_id);
    	$this->db->order_by('billing.created_at', 'desc'); 
    	$query = $this->db->get();

    	return $query->result();
	}
}
