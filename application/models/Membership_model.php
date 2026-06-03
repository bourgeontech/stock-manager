<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Membership_model extends CI_Model {

	public function getMembershipPooja($plan=1) {
        	$this->db->select('*');
        	$this->db->from('membership_pooja');
			$this->db->where('id',$plan);
        	$query = $this->db->get();
        
        	if ($query->num_rows() > 0) {
            	return $query->result();
            } else {
            	return 0;
            }
    }
	
	public function getMembershipById($membership_id) {
        $this->db->select('*');
        $this->db->from('memberships');
        $this->db->where('membership_id', $membership_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null; 
        }
    }
    	
    public function getMembershipDetails($mobile_number, $membership_id=null) {
        $this->db->select('*');
        $this->db->from('memberships');
        $this->db->where('mobile_number', $mobile_number);
    	if($membership_id) 
		$this->db->where('membership_id', $membership_id);
        $query = $this->db->get();
		
        if ($query->num_rows() == 1) {
            return $query->row(); 
        } else {
            return false; 
        }
    }
    
	public function getReferredMembers($membership_id) {
    	$this->db->where('referral_code', $membership_id)
             	->order_by('created_at', 'desc');
    	$query = $this->db->get('memberships');
    	return $query->result(); 
	}
    
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

	public function getCustomerByMobile($mobile_number) {
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
    	$this->db->where('billing.deleted', 0);
    	$this->db->order_by('billing.created_at', 'desc'); 
    	$query = $this->db->get();

    	return $query->result();
	}
    
	public function getMembershipsByDateRange($datef, $datet) {
    	$this->db->where('created_at >=', $datef);
    	$this->db->where('created_at <=', $datet);
    	$this->db->order_by('created_at', 'desc'); 
    	$query = $this->db->get('memberships');

    	if ($query->num_rows() > 0) {
        	return $query->result();
    	} else {
        	return false;
    	}
	}

	public function getAllMemberships() {
    	$this->db->order_by('created_at', 'desc');
    	$query = $this->db->get('memberships');

    	if ($query->num_rows() > 0) {
        	return $query->result();
    	} else {
        	return false;
    	}
	}
    
    public function get_email_addresses() {
        $this->db->select('email');
        $this->db->from('user_dtl');
        $query = $this->db->get();
        return $query->result_array();
    }
}
