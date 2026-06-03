<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
    
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }
  
        $this->loggedIn=$this->session->admin;
        $this->amount = $this->site_model->billing_online($this->session->refno);
    	$this->load->model( 'schedulebilling_model' );
    	$this->load->model( 'pooja_model' );
    	$this->load->model( 'general_model' );
    	$this->load->model( 'site_model' );
    	$this->load->model( 'Accounts_model' );
    }

	public function getCustomerCreditReport($from_date, $to_date) {
    		$this->db->select('billing.id as bill_id, user_dtl.name as customer, billing_dtls.name as name, billing.recv_amt as received, billing.bal_amt as balance, SUM(billing_dtls.amount) as total, SUM(billing_dtls.postal_amt) as postal');
    		$this->db->from('billing');
    		$this->db->join('billing_dtls', 'billing_dtls.bill_id=billing.id');
    		$this->db->join('user_dtl', 'user_dtl.id=billing.customer_id');
    		$this->db->where('billing.date >=', $from_date);
        	$this->db->where('billing.date <=', $to_date);
    		$this->db->where('billing_dtls.type', 'S');
    		$this->db->where('billing.deleted', 0);
    		$this->db->group_by('billing.id');
    		$query = $this->db->get();
    
    		$result = $query->result();
    
    		return $result;
    }

	public function index() {
    	$this->form_validation->set_rules('start_date', 'Start date', 'required');
    	$this->form_validation->set_rules('end_date', 'End date', 'required');
    
        if ($this->form_validation->run() === FALSE){
        	$data['bills'] = $this->getCustomerCreditReport(date('Y-m-d'), date('Y-m-d'));
        	
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/customerExpenseReport',$data);  
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        	$from_date = $this->input->post('start_date');
        	$to_date   = $this->input->post('end_date');
    		$data['bills'] = $this->getCustomerCreditReport($from_date, $to_date);
        	
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/customerExpenseReport',$data);  
        	$this->load->view('admin/layouts/admin_footer');
        }
    }
}