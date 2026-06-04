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

	public function dashboard() {
        $date = $this->input->post('date') ? $this->input->post('date') : date('Y-m-d');
        $data['selected_date']   = $date;
        $data['counter_summary'] = $this->Accounts_model->getCounterSummaryByDate($date);
        $data['is_posted']       = $this->Accounts_model->isCounterSummaryPosted($date);
        $data['gh_summary']      = $this->_fetchGuestHouseSummary($date);
        $data['gh_is_posted']    = $this->Accounts_model->isGuestHouseSummaryPosted($date);

        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/dashboard', $data);
        $this->load->view('admin/layouts/admin_footer');
    }

    private function _fetchGuestHouseSummary($date) {
        $url = 'https://kdgh.simbillsoft.in/reportsapi/daily?date=' . urlencode($date) . '&token=kdghtoken';
        $ch  = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        if (!$response) return null;
        $json = json_decode($response, true);
        return (isset($json['status']) && $json['status'] === 'success') ? $json['summary'] : null;
    }

	public function postGuestHouseSummary() {
        $date = $this->input->post('date');
        if (!$date) {
            echo json_encode(['success' => false, 'message' => 'Date is required']);
            return;
        }

        if ($this->Accounts_model->isGuestHouseSummaryPosted($date)) {
            echo json_encode(['success' => false, 'message' => 'Guest House summary for ' . $date . ' has already been posted to accounts.']);
            return;
        }

        $gh_summary = $this->_fetchGuestHouseSummary($date);
        if (!$gh_summary) {
            echo json_encode(['success' => false, 'message' => 'No Guest House data found for ' . $date]);
            return;
        }

        $total = (float)($gh_summary['total_collection']['total'] ?? 0);
        if ($total <= 0) {
            echo json_encode(['success' => false, 'message' => 'No collections to post for ' . $date]);
            return;
        }

        $this->Accounts_model->postGuestHousePayments($date, $gh_summary, $this->loggedIn['id']);
        echo json_encode(['success' => true, 'message' => 'Guest House summary for ' . $date . ' posted successfully.']);
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

	public function postCounterSummary() {
        $date = $this->input->post('date');
        if (!$date) {
            echo json_encode(['success' => false, 'message' => 'Date is required']);
            return;
        }

        if ($this->Accounts_model->isCounterSummaryPosted($date)) {
            echo json_encode(['success' => false, 'message' => 'Counter summary for ' . $date . ' has already been posted to accounts.']);
            return;
        }

        $summary  = $this->Accounts_model->getCounterSummaryByDate($date);
        $counters = $summary['counters'];
        $modes    = $summary['modes'];

        if (empty($counters)) {
            echo json_encode(['success' => false, 'message' => 'No counter data found for ' . $date]);
            return;
        }

        $mode_totals = [];
        foreach ($modes as $mid => $mname) {
            $mode_totals[$mid] = 0;
        }
        foreach ($counters as $cdata) {
            foreach ($cdata['modes'] as $mid => $amt) {
                $mode_totals[$mid] = ($mode_totals[$mid] ?? 0) + $amt;
            }
        }

        $this->Accounts_model->postCounterSummaryPayments($date, $mode_totals, $this->loggedIn['id']);
        echo json_encode(['success' => true, 'message' => 'Counter summary for ' . $date . ' posted successfully.']);
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