<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Payment_model extends CI_Model {

	public function getRegisteredBankByCounter($counter) {
     	$this->db->select('*, registered_banks.payment_gateway as gateway');
     	$this->db->from('counter_banks');
     	$this->db->join('registered_banks', 'registered_banks.id=counter_banks.bank_id');
    	$this->db->join('razorpay_pos_credentials', 'razorpay_pos_credentials.id=counter_banks.razorpay_pos_credentials_id', 'LEFT');
    	$this->db->join('worldline_pos_credentials', 'worldline_pos_credentials.id=counter_banks.worldline_pos_credentials_id', 'LEFT');
     	$this->db->where('counter_banks.counter_id', $counter);
     	$query = $this->db->get();
  		$row = $query->row();

    	return $row;
     }

	 public function getPaymentModes() {
     	$this->db->select('*');
    	$this->db->from('payment_modes');
    	$payment_modes = $this->db->get()->result_array();
     
     	return $payment_modes;
     }

	 public function getPaymentModeBySlug($mode_slug) {
    	$this->db->select('*');
    	$this->db->from('payment_modes');
    	$this->db->where('slug', $mode_slug);
    	$query = $this->db->get();
  		$row = $query->row();

    	return $row;
    }
}
