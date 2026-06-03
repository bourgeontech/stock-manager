<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
    class Site_model extends CI_Model {
        
        public function __construct() {
            parent::__construct();
            $this->date=date('Y-m-d');
        }
        public function checkLogin($data){
            $this->db->select('*');
            $this->db->from('user_dtl');
            $this->db->where('email',$data['username']);
            $this->db->where('password',$data['password']);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getEnquiryCount(){
            $query = $this->db->query("SELECT COUNT(id) as enquiry_count FROM `enquiry` WHERE DATE(date)=CURDATE()");
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getCustomerCount(){
            $query = $this->db->query("SELECT COUNT(id) as customer_count FROM `customer`");
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getProductCount(){
            $query = $this->db->query("SELECT COUNT(id) as product_count FROM `products`");
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getOrderCount(){
            $query = $this->db->query("SELECT COUNT(id) as order_count FROM `order_summary`");
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getOrderCountPending(){
            $query = $this->db->query("SELECT COUNT(id) as order_count_pending FROM `order_summary` WHERE order_status=0");
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getOrderCountDelivered(){
            $query = $this->db->query("SELECT COUNT(id) as order_count_delivered FROM `order_summary` WHERE order_status=1");
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getRating(){
            $query = $this->db->query("SELECT COUNT(id) as order_count_delivered FROM `order_summary` WHERE order_status=1");
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getNotifications(){
            $date=date('Y-m-d');
            $query = $this->db->query("SELECT orderno FROM `order_summary` WHERE order_status=0 AND is_read=0 ORDER BY order_date desc");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getEnquiries(){
            $date=date('Y-m-d');
            $query = $this->db->query("SELECT id,subject FROM `enquiry`  WHERE DATE(date)=CURDATE() ORDER BY date desc");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function markAsReadEnq($id){
            $this->db->set('is_read',1);
            $this->db->where('id',$id);
            $this->db->update('enquiry');
            return 1;
        }
        public function markAsRead($id){
            $this->db->set('is_read',1);
            $this->db->where('orderno',$id);
            $this->db->update('order_summary');
            return 1;
        }
        public function getSettings(){
            $this->db->select('*');
            $this->db->from('app_settings');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        
        //temple
        
        public function settemple($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('temple', $data);
            } else {
                $this->db->insert('temple', $data);
                return $this->db->insert_id();
            }
        }
        
        public function gettemples(){
            $this->db->select('*');
            $this->db->from('temple');
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function gettemplesById($id){
            $this->db->select('*');
            $this->db->from('temple');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function deletetemple($id){
            $this->db->where('id', $id);
            $this->db->delete('temple');
            return 1;
        }
        public function gettempledietyById($id){
            $this->db->select('*');
            $this->db->from('temple_diety');
            $this->db->where('temple_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        //user
        
        public function setuser($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('admin', $data);
            } else {
                $this->db->insert('admin', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getusers(){
            $this->db->select('*');
            $this->db->from('admin');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getusersById($id){
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function deleteuser($id){
            $this->db->where('id', $id);
            $this->db->delete('admin');
            return 1;
        }
        
        //Diety
        
        public function setdiety($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('diety', $data);
            } else {
                $this->db->insert('diety', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getdietys(){
            $this->db->select('*');
            $this->db->from('diety');
            $this->db->order_by('order_', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getdietysById($id){
            $this->db->select('*');
            $this->db->from('diety');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function getonlinedietys(){
            $this->db->select('*');
            $this->db->from('diety');
        	$this->db->where('online', 1);
            $this->db->order_by('order_', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function getonlinepoojas(){
            $this->db->select('*');
            $this->db->from('pooja');
        	$this->db->where('online', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    	
    	public function getonlinepoojasbydiety($diety){
            $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt');
            $this->db->from('diety_pooja');
            $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
        	$this->db->where('pooja.online', 1);
            $this->db->where('diety_pooja.temple_id', $diety);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    	
        public function deletediety($id){
            $this->db->where('id', $id);
            $this->db->delete('diety');
            return 1;
        }
        public function gettemple_diety(){
            $this->db->select('temple_diety.*,temple.name as temple,diety.name as diety');
            $this->db->from('temple_diety');
            $this->db->join('temple','temple.id = temple_diety.temple_id');
            $this->db->join('diety','diety.id = temple_diety.diety_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getdietypoojaById($id){
            $this->db->select('*');
            $this->db->from('diety_pooja');
            $this->db->where('temple_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        //Diety End
        //Pooja
        
        public function setpooja($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('pooja', $data);
            } else {
                $this->db->insert('pooja', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getpoojas(){
            $this->db->select('*');
            $this->db->from('pooja');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getpoojasById($id){
            $this->db->select('*');
            $this->db->from('pooja');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getpoojasbydiety($diety){
        	$exists = $this->db->table_exists('donation_deities');
        
        	if($exists) {
            	$this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt, donation_deities.id as donation');
            } else {
            	$this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt');
            }
            $this->db->from('diety_pooja');
            $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
        	if($exists) {
            	$this->db->join('donation_deities','donation_deities.deity_id = diety_pooja.temple_id', 'left');
            }
        	if($this->session->userdata('member') && is_object($this->session->userdata('member'))) {
            	$this->db->join('membership_pooja','pooja.id = membership_pooja.pooja_id', 'left');
            }
            $this->db->where('diety_pooja.temple_id', $diety);
        $this->db->where('pooja.online', 1);
        
            if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") { 
            	$this->db->where('pooja.online', 1);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            	$result = $query->result_array();
            
//             	if($this->db->table_exists('donation_deities')) {
//                 	foreach($result as $val) {
//                     	$val['donation'] = 0;
                        
//                     	$this->db->select('*');
//                 		$this->db->from('donation_deities');
//                 		$this->db->where('deity_id', $val['temple_id']);
//                     	$query = $this->db->get();
                    	
//                     	if($query->num_rows() > 0) {
//                         	$donationDeity = $query->row();
                        	
//                         	$val['donation'] = 1;
//                         } 
//                     }
//                 }
                return $result;
            }
            else {
                return 0;
            }
        }
        
        public function deletepooja($id){
            $this->db->where('id', $id);
            $this->db->delete('pooja');
            return 1;
        }
        public function getbirth_star(){
            $this->db->select('*');
            $this->db->from('birth_star');
            $this->db->group_by('name_eng');
            $this->db->order_by('id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getstars(){
            $this->db->select('*');
            $this->db->from('stars');
            $this->db->order_by('id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function deletebirth_star($id){
            $this->db->where('id', $id);
            $this->db->delete('birth_star');
            return 1;
        }
        //Pooja End
        //Customer
        
        public function setcustomer($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('customer', $data);
            } else {
                $this->db->insert('customer', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getcustomers(){
            $this->db->select('*');
            $this->db->from('customer');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getcustomersById($id){
            $this->db->select('*');
            $this->db->from('customer');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function deletecustomer($id){
            $this->db->where('id', $id);
            $this->db->delete('customer');
            return 1;
        }
        
        //Customer End
        
        public function billing_online($refno){
            $this->db->select('SUM(rate)');
            $this->db->from('billing_online');
            $this->db->where('customer_id', $refno);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getbillingById($id){
            $this->db->select('billing.*,diety.name_mal as diety_nm');
            $this->db->from('billing');
            $this->db->join('diety','diety.id = billing.diety_id');
            $this->db->where('billing.id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getbillingdtlsById($id){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt');
            $this->db->from('billing_dtls');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->where('billing_dtls.bill_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getbill($type){
            $this->db->select('billing.*,diety.name as diety,diety.name_mal as diety_mal');
            $this->db->from('billing');
            $this->db->join('diety','diety.id = billing.diety_id');
            $this->db->where('billing.status', $type);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getlasbillid(){
            $query = $this->db->query("SELECT id FROM `billing` ORDER BY id desc limit 1");
            return $query->row_array();
        }
        
        public function delete_bill($id){
            $this->db->where('id', $id);
            $this->db->delete('billing');
            $this->db->where('bill_id', $id);
            $this->db->delete('billing_dtls');
            return 1;
        }
        
        public function getbillsbyrefno($id){
            //$this->db->select('billing_online.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt,diety.name_mal as diety_nm');
            $this->db->select('billing_online.*,stars.name_eng as star_eng,pooja.name as pooja_nm,pooja.rate as pooja_rt,diety.name as diety_nm');
        	$this->db->from('billing_online');
            $this->db->join('stars','stars.id = billing_online.star_id');
            $this->db->join('pooja','pooja.id = billing_online.pooja_id');
            $this->db->join('diety','diety.id = billing_online.diety_id');
            $this->db->where('billing_online.customer_id', $id);
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
            $this->db->where('billing_online.customer_id', $id,);
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

        public function getbillsbyrefno2($id){
            $this->db->select('SUM(billing_online.rate) as rate ,billing_online.total');
            $this->db->from('billing_online');
            $this->db->where('billing_online.customer_id', $id,);
            $this->db->group_by('billing_online.name,billing_online.pooja_id');
            $this->db->order_by('id','asc');
            $query = $this->db->get();
             //print_r($this->db->last_query());
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

        public function getbillsbyrefno3($id){
            $this->db->select('billing_online.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt,diety.name_mal as diety_nm,SUM(billing_online.rate) as pooja_rate,SUM(total) as prasad_total');
            $this->db->from('billing_online');
            $this->db->join('stars','stars.id = billing_online.star_id');
            $this->db->join('pooja','pooja.id = billing_online.pooja_id');
            $this->db->join('diety','diety.id = billing_online.diety_id');
            $this->db->where('billing_online.customer_id', $id,);
            $this->db->group_by('billing_online.name,billing_online.pooja_id');
            $query = $this->db->get();
            //  print_r($this->db->last_query());
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

        public function getbillsbyrefno4($id){
            $this->db->select('billing_online.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt,diety.name_mal as diety_nm,SUM(billing_online.rate) as pooja_rate,SUM(total) as prasad_total');
            $this->db->from('billing_online');
            $this->db->join('stars','stars.id = billing_online.star_id');
            $this->db->join('pooja','pooja.id = billing_online.pooja_id');
            $this->db->join('diety','diety.id = billing_online.diety_id');
            $this->db->where('billing_online.customer_id', $id,);
            $this->db->group_by('billing_online.name,billing_online.pooja_id,billing_online.star_id');
            $query = $this->db->get();
            //  print_r($this->db->last_query());
            if ($query->num_rows() > 0) {
                return $query->result_array();
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
            $this->db->where('billing_online.customer_id', $id,);
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


  

        public function getuserbyrefno($refno){
            $this->db->select('*');
            $this->db->from('user_dtl');
            $this->db->where('customer_id', $refno);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getuserbyId($id){
            $this->db->select('*');
            $this->db->from('user_dtl');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function getuserbymobile($refno){
            $this->db->select('*');
            $this->db->from('user_dtl');
            $this->db->where('mobile', $refno);
            $query = $this->db->get();
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
            $this->db->where('customer_id', $refno);
            $query = $this->db->get();
            // print $this->db->last_query();exit;
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

     
          	public function getstarbyid($id) {
        	$this->db->select('stars.name_mal as star_eng');
            $this->db->from('stars');
        	$this->db->where('id', $id);
        
        	$query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }
            else {
                return 0;
            }
        }
    
    	public function getpoojabyid($id) {
        	$this->db->select('pooja.name_mal as pooja_nm,pooja.rate as pooja_rt');
            $this->db->from('pooja');
        	$this->db->where('id', $id);
        
        	$query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }
            else {
                return 0;
            }
        }
    
    	public function getdeitybyid($id) {
        	$this->db->select('diety.name_mal as diety_nm');
            $this->db->from('diety');
        	$this->db->where('id', $id);
        
        	$query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }
            else {
                return 0;
            }
        }
    
        public function getallowedquantity($pooja_id, $date,$refno) {
    		$this->db->select('pooja.allowed_qty as allowed_pooja_qty');
    		$this->db->from('pooja');
    		$this->db->where('pooja.id', $pooja_id);
    		$allowed_pooja_qty = $this->db->get()->row()->allowed_pooja_qty;

    		$this->db->select('SUM(qlt) as billing_qty');
    		$this->db->from('billing_dtls');
    		$this->db->where('pooja', $pooja_id);
    		$this->db->where('date', $date);
    		$billing_qty = $this->db->get()->row()->billing_qty;

    		$this->db->select('SUM(qty) as online_qty');
    		$this->db->from('billing_online');
    		$this->db->where('pooja_id', $pooja_id);
            $this->db->where('customer_id', $refno);
    		$this->db->where('date', $date);
    		$online_qty = $this->db->get()->row()->online_qty;

    		$data = array(
        		'allowed_pooja_qty' => $allowed_pooja_qty,
        		'billing_qty' => $billing_qty,
        		'online_qty' => $online_qty
    		);

    		return $data;
		}
        // 	public function getbillsbyrefno($refno){
        // 		$query = $this->db->query("SELECT * FROM `billing_online` WHERE customer_id='$refno'");
        // 	    if ($query->num_rows() > 0) {
        // 		     return $query->result_array();
        // 	    }
        // 		else {
        // 			 return array();
        // 		}
        // 	}
        
        public function getdatestar($from,$to){
            $query = $this->db->query("SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to')");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        
        public function getweekstar($from,$to,$day){
            $query = $this->db->query("SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') AND day_of_day='$day'");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        
        public function getmonthstar($from,$to,$star){
            $query = $this->db->query("SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') AND name_eng='$star'");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        
        
        public function setSettings($data){
            $this->db->where('id',$data['id']);
            $this->db->update('app_settings',$data);
            return 1;
        }
        public function getEnquiry(){
            $query = $this->db->query("SELECT enquiry.*,customer.name,customer.phone FROM `enquiry` JOIN customer ON enquiry.user_id = customer.id  ORDER BY date desc");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        
        
        //CMS
        public function aboutus_home(){
            $query = $this->db->query("SELECT substring(content,1,800) as about FROM aboutus");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getaboutus(){
            $this->db->select('*');
            $this->db->from('aboutus');
            $this->db->where('is_delete!=',1);
            $this->db->order_by('abtId', 'desc');
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function gettempleTiming()
        {
            $query=$this->db->query("SELECT * FROM `temple_timing`");
            return $query->result_array();
            
        }
        
        public function gettempleTiming_old()
        {
            $query=$this->db->query("SELECT * FROM `temple_timing` where is_delete=0 order by pooja_time");
            return $query->result_array();
            
        }
        public function getBanner(){
            $this->db->select('*');
            $this->db->from('banner');
            $this->db->where('is_delete !=', 1);
            $this->db->order_by('display_order', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getAdvertisement(){
            date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );
            
            $this->db->select('*');
            $this->db->from('advertisement');
            // $this->db->where('expiry_date<=', $date);
            $this->db->where('is_delete !=', 1);
            $this->db->order_by('display_order', 'desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getpriest(){
            $this->db->select('*');
            $this->db->from('priest');
            $this->db->where('is_delete!=',1);
            $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function gettrusteeboard(){
            $this->db->select('*');
            $this->db->from('trustee');
            $this->db->where('is_delete!=',1);
            $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getfestivalCommittee(){
            $this->db->select('*');
            $this->db->from('festivalCommittee');
            $this->db->where('is_delete!=',1);
            $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getparipalanaSamithi(){
            $this->db->select('*');
            $this->db->from('paripalanaSamithi');
            $this->db->where('is_delete!=',1);
            $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function geteventFestivalone(){
        	$exists = $this->db->field_exists('event_date', 'event');
            $this->db->select('*');
            $this->db->from('event');
            $this->db->where('is_delete!=',1);
           // $this->db->where('is_delete!=',1);

        	if( $exists ) {
        		$this->db->where('DATE(event_date) >=',date('Y-m-d'));
            	$this->db->order_by('event_date', 'asc');
        	}
        	
        	// $this->db->limit(1);
             
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
     public function geteventFestival(){
        	$exists = $this->db->field_exists('event_date', 'event');
            $this->db->select('*');
            $this->db->from('event');
            $this->db->where('is_delete!=',1);
     
            if( $exists ) {
        		$this->db->where('DATE(event_date) >=',date('Y-m-d'));
            	$this->db->order_by('event_date', 'asc');
        	}
             
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function geteventDetails($id){
            $this->db->select('*');
            $this->db->from('event');
            $this->db->where('id',$id);
            // $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getnews(){
            $this->db->select('*');
            $this->db->from('news');
            $this->db->where('is_delete!=',1);
            // $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getnewsDetails($id){
            $this->db->select('*');
            $this->db->from('news');
            $this->db->where('id',$id);
            // $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getannouncements(){
            $this->db->select('*');
            $this->db->from('announcements');
            $this->db->where('is_delete!=',1);
            // $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getrules(){
            $this->db->select('*');
            $this->db->from('rules');
            $this->db->where('is_delete!=',1);
            // $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getgallery(){
            $this->db->select('*');
            $this->db->from('gallery');
            $this->db->where('is_delete!=',1);
            $this->db->group_by('category');
            $query = $this->db->get();
       // echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

         public function getsalesproducts(){
            $this->db->select('*');
            $this->db->from('Pooja');
            $this->db->where('forsale=',1);
            $query = $this->db->get();
       // echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
        public function getvideo(){
            $this->db->select('*');
            $this->db->from('video');
            $this->db->where('is_delete!=',1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getgalleryDetails($id){
            $this->db->select('*');
            $this->db->from('gallery');
            $this->db->where('category',$id);
            $this->db->where('is_delete !=', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getcontact(){
            $this->db->select('*');
            $this->db->from('contact');
            
            // $this->db->order_by('displayOrder', 'asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
     public function settings(){
            $query = $this->db->query("SELECT * FROM `site_settings`");
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        
    public function getWorldlineCredentials(){
        $this->db->select('*');
        $this->db->from('worldline');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
                return $query->result();
            }
            else {
                return 0;
            }
    }

    public function getEazypayCredentials(){
        $this->db->select('*');
        $this->db->from('eazypay');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
                return $query->result();
            }
            else {
                return 0;
            }
    }

    public function getRazorpayCredentials(){
        $this->db->select('*');
        $this->db->from('razorpay');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
                return $query->result();
            }
            else {
                return 0;
            }
    }
     public function getpaymentgateway() {
            $query = $this->db->query("SELECT payment_gateway FROM `site_settings`");
            if ($query->num_rows() > 0) {
                return $query->row()->payment_gateway;
            }
            else {
                return 0;
            }
        }
    
    public function templatesettings(){
        	           $query = $this->db->query("SELECT templateval FROM `site_settings`");
            if ($query->num_rows() > 0) {
                return $query->row()->templateval;
            }
            else {
                return 0;
            }
        }
    
    public function getPaymentMethodBySlug($mode_slug) {
    	$this->db->select('*');
    	$this->db->from('payment_modes');
    	$this->db->where('slug', $mode_slug);
    	
    	$query = $this->db->get();
    	if($query->num_rows() > 0) {
        	return $query->row()->id;
        } else {
        	return 6;
        }
    }
    }