<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once __DIR__ . '/vendor/autoload.php';
class Report extends CI_Controller {
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }
    $site_settings 	= $this->db->select('*')->from('site_settings')->get()->row();
$language_settings = $this->db->field_exists('language', 'site_settings');
    
    	if($language_settings && $site_settings->language != null) {
           $this->load->language('main', $site_settings->language);
        }
        $this->loggedIn=$this->session->admin;
    	$this->load->model('Report_model');
    	$this->load->model('Pooja_model');
    }

	public function adjustment_report(){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['deities']=$this->general_model->getdietys();
    	$data['temple_list']=$this->general_model->gettemples();

        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/adjustment_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $deity_id=$this->input->post('deity_id');
            $pooja_id=$this->input->post('pooja_id');
            
            
            $this->db->select('adjustment.*,inv_product.name as product_nm, inv_product.id as product_id,inv_unit.name as unit, SUM(adjustment.qty) as qty, SUM(adjustment.rcvd_qty) as rcvd_qty');
            $this->db->from('adjustment');
            $this->db->join('billing', 'adjustment.bill_id=billing.id');
            $this->db->join('billing_dtls', 'billing.id=billing_dtls.bill_id');
            $this->db->join('inv_product','inv_product.id = adjustment.product_id');
            $this->db->join('inv_unit','inv_unit.id = adjustment.unit');
            $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
            if($deity_id) {
                $this->db->where("billing.diety_id='$deity_id'");
            }
            
            if($pooja_id) {
                $this->db->where("billing_dtls.pooja='$pooja_id'");
            }
            
            $this->db->order_by("adjustment.id", "desc");
            $this->db->group_by("inv_product.id");
        	
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $data['purchase_list'] = $query->result_array();
            }
            else {
                $data['purchase_list'] = 0;
            }
            
            // $data['purchase_list']=$this->general_model->getadjustment_data($datef,$datet,$deity_id,$pooja_id);
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['deity_id']=$deity_id;
            $data['pooja_id']=$pooja_id;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/purchase/adjustment_report',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }
    }

	public function pos_user_wise_report() {
    	$this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
    
    	if ($this->form_validation->run() === FALSE){
            $data['datef']= date("Y-m-d");
            $data['datet']=date("Y-m-d");
        	$data['categories'] = $this->Pooja_model->getCategories();
        	$data['summary']	= $this->Report_model->getPOSBills(date("Y-m-d"), date("Y-m-d"));
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/pos_user_wise_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
        	$category_id=$this->input->post('category_id');
        	
            $data['datef']		 = $datef;
            $data['datet']		 = $datet;
        	$data['category_id'] = $category_id;
        
        	$data['categories']  = $this->Pooja_model->getCategories();
        	$data['summary']	 = $this->Report_model->getPOSBills($datef, $datet);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/pos_user_wise_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
	
	public function bill_report() {	
    	$this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
    
    	if ($this->form_validation->run() === FALSE){
            $data['datef']=date("Y-m-d");
            $data['datet']=date("Y-m-d");
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/bill_list',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['datef']=$datef;
            $data['datet']=$datet;
        	
        	
        	if($this->input->post('search') == 'search') {
            	$this->load->view('admin/layouts/admin_header');
            	$this->load->view('admin/reports/bill_list',$data);
            	$this->load->view('admin/layouts/admin_footer');
            } else if ($this->input->post('search') == 'print') {
            	$this->load->view('admin/reports/bill_list_print',$data);
            }
        }
    }

	public function online_bill_report() {
    	$this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
    
    	if ($this->form_validation->run() === FALSE){
             $data['datef']=date("Y-m-d");
            $data['datet']=date("Y-m-d");
        	$data['bills']= $this->Report_model->getapprovedonlinebills(date("Y-m-d"), date("Y-m-d"));
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/online_bill_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['datef']=$datef;
            $data['datet']=$datet;
        	$data['bills']= $this->Report_model->getapprovedonlinebills($datef, $datet);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/online_bill_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

	public function bill_reprint_report() {	
    	$this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
    
    	if ($this->form_validation->run() === FALSE){
            $data['datef']=date("Y-m-d");
            $data['datet']=date("Y-m-d");
        	$data['bills']= $this->Report_model->get_bills(date("Y-m-d"), date("Y-m-d"));
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/bill_reprint_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['datef']=$datef;
            $data['datet']=$datet;
        	$data['bills']= $this->Report_model->get_bills($datef, $datet);
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/bill_reprint_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

	public function schedule_bills() {
    	$this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
    
    	if ($this->form_validation->run() === FALSE){
            $data['datef']=date("Y-m-d");
            $data['datet']=date("Y-m-d");
        	$data['bills']= $this->Report_model->getscheduledbills(date('Y-m-d'), date('Y-m-d'));

            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/scheduled_bills_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
        	$keyword=$this->input->post('keyword');
        
            $data['datef']=$datef;
            $data['datet']=$datet;
        	if( $keyword)
        		$data['bills']= $this->Report_model->getscheduledbills($datef, $datet, $keyword);
        	else 
            	$data['bills']= $this->Report_model->getscheduledbills($datef, $datet);
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/scheduled_bills_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

	public function schedule_bills_details($id) {
    	$data['bills']= $this->Report_model->getscheduledbilldetails($id);

    	$this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/reports/scheduled_bill_details',$data);
        $this->load->view('admin/layouts/admin_footer');
    }

	public function schedule_bill_details_print($id){
        $data['temple_list']=$this->general_model->gettemples();
    	$bill_dtls = $this->Report_model->getbillingdtlsById($id);
    	
        $data['bill_list']=$this->general_model->getbillingById($bill_dtls[0]['bill_id']);
        $data['bill_dtls'] = $this->Report_model->getbillingdtlsByDate($bill_dtls[0]['bill_id'], $bill_dtls[0]['date']);
        $data['bill_id']=$bill_dtls[0]['bill_id'];

				// if($reprint) {
				// $reprint_data = array(
				// 'reprint_count' => 'reprint_count + 1',
				// );
				// $this->db->where('id', $id);
				// $this->db->update('billing', $reprint_data);
				// } 
    
        $bill_id=$bill_dtls[0]['bill_id'];
        
    	$this->load->view('admin/reports/scheduled_bill_print',$data);
    }

	public function counter_wise() {
    	$this->db->select('*');
    	$this->db->from('payment');
    	$this->db->join('ledger', 'payment.ledger=ledger.led_Id');
    	$this->db->where('ledger.group', 15);
    	$this->db->where('payment.payment_date', "2023-08-15");
    	$this->db->group_by('payment.mode');
    	$query = $this->db->get();
    	print_r($query->result_array());
    }

	public function date_wise_kooru_rpt($ids=null){
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
        
      		$data['temple_list']=$this->general_model->gettemples();

            $data['bill_list']=$this->general_model->getbillsummuryforkooru($from,$to,$diety,$type);
            $data['diety_list']=$this->general_model->getdietys();
            $data['user_list']=$this->general_model->getkooru_usr();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/kooru_mng/datewise_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
        
      		$data['temple_list']=$this->general_model->gettemples();

            $data['bill_list']=$this->general_model->getbillsummuryforkooru($from,$to,$diety,$type);
            $data['user_list']=$this->general_model->getkooru_usr();
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/kooru_mng/datewise_report',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/kooru_mng/summary_print',$data);
            }
        }
    }

	public function date_wise_pooja_count_summary() {
    	$this->form_validation->set_rules('date_from', 'Date From', 'required');
        $this->form_validation->set_rules('date_to', 'Date To', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            $data['poojas']		 = $this->general_model->getpoojas();
        	$data['temple_list'] = $this->general_model->gettemples();
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/date_wise_pooja_count_summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $start_date	=	$this->input->post('date_from');
            $end_date	=	$this->input->post('date_to');
            $pooja_id  	=	$this->input->post('pooja_id');
            
        	$this->db->select('*');
        	$this->db->from('pooja');
        	$this->db->where('id', $pooja_id);
        	$pooja = $this->db->get()->row();

        	$data['date_from'] 		= $start_date;
        	$data['date_to']   		= $end_date;
        	$data['pooja_id']   	= $pooja_id;
        	$data['pooja_name']   	= $pooja->name;
            $data['summary']	=$this->Report_model->get_date_wise_pooja_count($start_date, $end_date, $pooja_id);
        	$data['temple_list']=$this->general_model->gettemples();
        
            if($this->input->post('search')=="search") {
                $data['poojas']=$this->general_model->getpoojas();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/reports/date_wise_pooja_count_summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            } elseif($this->input->post('search')=="print") {
                $this->load->view('admin/kooru_mng/summary_print',$data);
            }
        }
    }

	public function pooja_wise_token_summary() {
    	$this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('deity_id', 'Deity', 'required');
        // $this->form_validation->set_rules('pooja_id', 'Pooja', 'nullable');
    
        if ($this->form_validation->run() === FALSE) {
            $data['poojas']		 = $this->general_model->getpoojas();
        	$data['temple_list'] = $this->general_model->gettemples();
        	$data['deities'] 	 = $this->general_model->getdietys();
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/pooja_wise_token_summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $date		=	$this->input->post('date');
            $deity_id	=	$this->input->post('deity_id');
            $pooja_id  	=	$this->input->post('pooja_id');
            
        	if ($pooja_id) {
            	$this->db->select('*');
        		$this->db->from('pooja');
        		$this->db->where('id', $pooja_id);
        		$pooja = $this->db->get()->row();
            
            	$data['pooja_name']   	= $pooja->name;
            }

        	$data['date'] 			= $date;
        	$data['deity_id']   	= $deity_id;
        	$data['pooja_id']   	= $pooja_id;
            $data['summary']		= $this->Report_model->get_pooja_wise_token_summary($date, $deity_id, $pooja_id);
        	$data['temple_list']	= $this->general_model->gettemples();
        	$data['deities'] 	 	= $this->general_model->getdietys();
        
            if($this->input->post('search')=="search") {
                $data['poojas']=$this->general_model->getpoojas();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/reports/pooja_wise_token_summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            } elseif($this->input->post('search')=="print") {
                $this->load->view('admin/reports/pooja_wise_token_summary_print',$data);
            }
        }
    }

	public function set_pooja_wise_token_summary_print() {
    	$date		=	$this->input->post('date');
        $deity_id	=	$this->input->post('deity_id');
        $pooja_id  	=	$this->input->post('pooja_id');
    	
    	$this->Report_model->set_pooja_wise_token_summary_print($date, $deity_id, $pooja_id);
    	redirect('admin/report/pooja_wise_token_summary');
    }

	public function poojaAvailabilityLog() {
    	$this->form_validation->set_rules('date_from', 'Date From', 'required');
    	$this->form_validation->set_rules('date_to', 'Date To', 'required');
    
        if ($this->form_validation->run() === FALSE) {
        	$data['temple']			= $this->general_model->gettemples();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/pooja_availability_log', $data);
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $date_from		        = $this->input->post('date_from');
        	$data['date_from']      = $date_from;
        	$date_to		        = $this->input->post('date_to');
        	$data['date_to']      	= $date_to;
            $data['logs'] 	        = $this->Report_model->getPoojaAvailabilityLog($date_from, $date_to);
			$data['temple']			= $this->general_model->gettemples();
        
            if($this->input->post('search')=="search") {
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/reports/pooja_availability_log',$data);
                $this->load->view('admin/layouts/admin_footer');
            } elseif($this->input->post('search')=="print") {
                $this->load->view('admin/reports/pooja_availability_log_print',$data);
            }
        }
    }

	public function poojaParticipationReportByPoojaDate() {
    	$this->form_validation->set_rules('date_from', 'Date From', 'required');
    	$this->form_validation->set_rules('date_to', 'Date To', 'required');
    
        if ($this->form_validation->run() === FALSE) {
        	
        	$this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/paricipantReportPoojaDate');
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $appearance 			= $this->input->post('appearance');
        	$data['appearance']     = $appearance;	
    		$date_from		        = $this->input->post('date_from');
        	$data['date_from']      = $date_from;
        	$date_to		        = $this->input->post('date_to');
        	$data['date_to']      	= $date_to;

    		$this->db->select('billing.id as bill_id, billing.date as bill_date, billing_dtls.name as name, stars.name_eng as star, pooja.name_mal as pooja_locale, pooja.name as pooja, billing_dtls.pooja as pooja_id, billing_dtls.qlt as qty, pooja.rate as pooja_rate, billing_dtls.amount as amount, billing_dtls.date as pooja_date');
    		$this->db->from('billing_dtls');
        	$this->db->join('billing', 'billing_dtls.bill_id=billing.id');
        	$this->db->join('pooja', 'billing_dtls.pooja=pooja.id');
        	$this->db->join('stars', 'billing_dtls.star=stars.id');
    		$this->db->where('billing.status', 2);
        	$this->db->where('billing.deleted', 0);
    		$this->db->where('billing_dtls.date >=', $date_from);
        	$this->db->where('billing_dtls.date <=', $date_to);
        
        	if($appearance)
    			$this->db->where('billing.appearance', $appearance);
    			$query = $this->db->get();
    	
    		if ($query->num_rows() > 0) {
        		$result = $query->result();
        	} 
        
        	$data['summary'] = $result ?? null;
        
        	$this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/paricipantReportPoojaDate',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

	public function poojaParticipationReport() {
    	$this->form_validation->set_rules('date_from', 'Date From', 'required');
    	$this->form_validation->set_rules('date_to', 'Date To', 'required');
    
        if ($this->form_validation->run() === FALSE) {
        	
        	$this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/paricipantReport');
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $appearance 			= $this->input->post('appearance');
        	$data['appearance']     = $appearance;	
    		$date_from		        = $this->input->post('date_from');
        	$data['date_from']      = $date_from;
        	$date_to		        = $this->input->post('date_to');
        	$data['date_to']      	= $date_to;
        
    		$this->db->select('billing.id as bill_id, billing.date as bill_date, billing_dtls.name as name, stars.name_eng as star, pooja.name_mal as pooja_locale, pooja.name as pooja, billing_dtls.pooja as pooja_id, billing_dtls.qlt as qty, pooja.rate as pooja_rate, billing_dtls.amount as amount, billing_dtls.date as pooja_date');
    		$this->db->from('billing_dtls');
        	$this->db->join('billing', 'billing_dtls.bill_id=billing.id');
        	$this->db->join('pooja', 'billing_dtls.pooja=pooja.id');
        	$this->db->join('stars', 'billing_dtls.star=stars.id');
    		$this->db->where('billing.status', 2);
        	$this->db->where('billing.deleted', 0);
    		$this->db->where('billing.date >=', $date_from);
        	$this->db->where('billing.date <=', $date_to);
        
        	if($appearance)
    			$this->db->where('billing.appearance', $appearance);
    		$query = $this->db->get();
    	
    		if ($query->num_rows() > 0) {
        		$result = $query->result();
        	} 
        
        	$data['summary'] = $result ?? null;
        
        	$this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/paricipantReport',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

	public function postalAddresses() {
    	$this->form_validation->set_rules('date_from', 'Date From', 'required');
    	$this->form_validation->set_rules('date_to', 'Date To', 'required');
    
        if ($this->form_validation->run() === FALSE) {
        	$data['temple']			= $this->general_model->gettemples();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/postal_addresses', $data);
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $date_from		        = $this->input->post('date_from');
        	$data['date_from']      = $date_from;
        	$date_to		        = $this->input->post('date_to');
        	$data['date_to']      	= $date_to;
            $data['addresses'] 	    = $this->Report_model->getCustomerAddresses($date_from, $date_to);
			$data['temple']			= $this->general_model->gettemples();
        	// $data['contract_rate']  = $this->Report_model->getAdvanceContractRate();
        
            if($this->input->post('search')=="search") {
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/reports/postal_addresses',$data);
                $this->load->view('admin/layouts/admin_footer');
            } elseif($this->input->post('search')=="print") {
                $this->load->view('admin/reports/postal_addresses_print',$data);
            }
        }
    }

	public function membershipReport() {
    	$this->db->select('*');
    	$this->db->from('memberships');
    	$q = $this->db->get();
    	print_r($q->result());
    }


	public function membership_report() {
    	$search_term = $this->input->post('search_term');
    	$datef = $this->input->post('datef');
    	$datet = $this->input->post('datet');
		$sponsered = @$this->input->post('sponsered');

    	$this->load->model('general_model');

    	//if ($datef && $datet && $sponsered ) {
        	$memberships = $this->general_model->getAllMemberships($search_term, $datef, $datet,$sponsered);
    	//} else if{
        	//$memberships = $this->general_model->getAllMemberships($search_term);
    	//}

    	$data['memberships'] = $memberships;
    	$data['search_term'] = $search_term;
    	$data['datef'] = $datef;
    	$data['datet'] = $datet;
		if ($this->db->field_exists('sponser', 'memberships')) {
		$this->db->select('*');
		$this->db->from('membership_sponser');
    	$query = $this->db->get();
    	$sponser = $query->result_array();
		$data['sponsers']=$sponser;
		}
    	$this->load->view('admin/layouts/admin_header');
    	$this->load->view('admin/membership/membership_report', $data);
    	$this->load->view('admin/layouts/admin_footer');
	}



	public function customBookings() {
    	$this->form_validation->set_rules('date_from', 'Date From', 'required');
    	$this->form_validation->set_rules('date_to', 'Date To', 'required');
    	$this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
    
    	$data['poojas'] = $this->Report_model->getCustomPoojas();
        if ($this->form_validation->run() === FALSE) {
        	$data['temple']			= $this->general_model->gettemples();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/custom_bookings', $data);
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $date_from		        = $this->input->post('date_from');
        	$data['date_from']      = $date_from;
        	$date_to		        = $this->input->post('date_to');
        	$data['date_to']      	= $date_to;
        	$pooja_id		        = $this->input->post('pooja_id');
        	$data['pooja_id']      	= $pooja_id;
            $data['bookings'] 	    = $this->Report_model->getCustomBookings($date_from, $date_to, $pooja_id);
			$data['temple']			= $this->general_model->gettemples();
        	// $data['contract_rate']  = $this->Report_model->getAdvanceContractRate();
        
            if($this->input->post('search')=="search") {
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/reports/custom_bookings',$data);
                $this->load->view('admin/layouts/admin_footer');
            } elseif($this->input->post('search')=="print") {
                $this->load->view('admin/reports/custom_bookings_print',$data);
            }
        }
    }

public function customReport() {
    	$this->form_validation->set_rules('date_from', 'Date From', 'required');
    	$this->form_validation->set_rules('date_to', 'Date To', 'required');
    	//$this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
    
    	//$data['poojas'] = $this->Report_model->getCustomPoojas();
        if ($this->form_validation->run() === FALSE) {
        	$data['temple']			= $this->general_model->gettemples();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/custom_report', $data);
            $this->load->view('admin/layouts/admin_footer');
        } else {
            $date_from		        = $this->input->post('date_from');
        	$data['date_from']      = $date_from;
        	$date_to		        = $this->input->post('date_to');
        	$data['date_to']      	= $date_to;
        	//$pooja_id		        = $this->input->post('pooja_id');
        	//$data['pooja_id']      	= $pooja_id;
            $data['bookings'] 	    = $this->Report_model->getCustomReport($date_from, $date_to);
			$data['temple']			= $this->general_model->gettemples();
        	// $data['contract_rate']  = $this->Report_model->getAdvanceContractRate();
        
            if($this->input->post('search')=="search") {
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/reports/custom_report',$data);
                $this->load->view('admin/layouts/admin_footer');
            } elseif($this->input->post('search')=="print") {
                $this->load->view('admin/reports/custom_report_print',$data);
            }
        }
    }

public function upi_bill_report() {
    	$this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
    
    	if ($this->form_validation->run() === FALSE){
            $data['datef']=date("Y-m-d");
            $data['datet']=date("Y-m-d");
        	$data['categories'] = $this->Pooja_model->getCategories();
        	$data['summary']	= $this->Report_model->getUpiBills(date("Y-m-d"), date("Y-m-d"));
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/upi_bill_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
        	$category_id=$this->input->post('category_id');
        	
            $data['datef']		 = $datef;
            $data['datet']		 = $datet;
        	$data['category_id'] = $category_id;
        
        	$data['categories']  = $this->Pooja_model->getCategories();
        	$data['summary']	 = $this->Report_model->getUpiBills($datef, $datet, $category_id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/reports/upi_bill_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

}