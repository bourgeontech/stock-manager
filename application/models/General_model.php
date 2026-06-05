<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
    class General_model extends CI_Model {
        
        public function __construct() {
            parent::__construct();
            $this->date=date('Y-m-d');
        }
        public function checkLogin($data){
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('username',$data['username']);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row_array();
                if (password_verify($data['password'], $row['password'])) {
                    return $row;
                }
            }
            return 0;
        }
    
        public function getCustomer($id){
            $this->db->select('*');
            $this->db->from('user_dtl');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
     function start_bill($datef,$datet)
     {
     
           $this->db->select('id');
$this->db->from('billing');
$this->db->where('date', $datef);
$this->db->order_by('id', 'ASC');
     $this->db->limit(1);
$query = $this->db->get();
$result = $query->row();
     return @$result->id;
     }
    
     function end_bill($datef,$datet)
     {
     
           $this->db->select('id');
$this->db->from('billing');
$this->db->where('date', $datet);
$this->db->order_by('id', 'desc');
     $this->db->limit(1);
$query = $this->db->get();
$result = $query->row();
     return @$result->id;
     }
        public function getBills($id){
            $this->db->select('*');
            $this->db->from('billing');
            $this->db->where('customer_id',$id);
        	$this->db->where('deleted', 0);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getCustomerBills(){
        	// $this->db->select('billing.id as bill_id, date,billing.customer_id,user_dtl.name as customername,user_dtl.mobile as customerphone,SUM(total) AS total,SUM(recv_amt) AS recv_amt, SUM(bal_amt) AS bal_amt');
        	// $this->db->from('billing');
        	// $this->db->join('user_dtl', 'billing.customer_id = user_dtl.id');
        	// $this->db->where('billing.deleted', '0');
        	// $this->db->where('billing.bal_amt != 0');
        	// $this->db->group_by('billing.customer_id');
        	
        	// Edited by Sherin Oct 17 12:42
        	$this->db->select('billing.*, billing.id as bill_id, user_dtl.name as customername, user_dtl.mobile as customerphone, SUM(total) AS total, SUM(recv_amt) AS recv_amt, SUM(bal_amt) AS bal_amt');
            $this->db->from('billing');
        	$this->db->join('user_dtl', 'billing.customer_id = user_dtl.id');
        	$this->db->where('deleted', 0);
        	$this->db->where('billing.bal_amt >', 0);
        	$this->db->group_by('billing.customer_id');
        
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
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
        
        public function getsite(){
            $this->db->select('*');
            $this->db->from('site_settings');
            $this->db->limit(1);
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
        	$this->db->order_by('name');
         //   $this->db->group_by('name_mal');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    public function getpoojasdortbyname(){
            $this->db->select('*');
            $this->db->from('pooja');
       // $this->db->order_by('code');
            $this->db->order_by('name');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function getpoojacountbycat($data, $counter=null){
            $this->db->select('pooja.id, pooja.name, pooja.name_mal, pooja.rate, SUM(billing_dtls.qlt) as count');
            $this->db->from('billing_dtls');
        	$this->db->join('pooja','billing_dtls.pooja = pooja.id');
        	$this->db->join('billing','billing_dtls.bill_id = billing.id');
            $this->db->where('billing.deleted', 0);
        	if($counter!=null){
                $this->db->where('billing.counter', $counter);
            }
        	if($data['cat']){
                $this->db->where('pooja.cat', $data['cat']);
            }
        	if($data['from']){
                $this->db->where('billing_dtls.date >=', $data['from']);
            }
        	if($data['to']){
                $this->db->where('billing_dtls.date <=', $data['to']);
            }
            $this->db->group_by('billing_dtls.pooja');
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
    
    	public function searchpoojas($keyword){
            
			$this->db->group_start();
			$this->db->like('name', $keyword, 'after');
			$this->db->or_like('code', $keyword, 'after');
			$this->db->group_end();
        	$this->db->where('isimp', 1);
        	// $this->db->where('block', 0);
			$this->db->limit(10);
			$query = $this->db->get('pooja');
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return [];
            }
        }
    
        public function deletepooja($id){
            $this->db->where('id', $id);
            $this->db->delete('pooja');
            return 1;
        }
        public function getbirth_star(){
        	$templedashboarddb = $this->load->database('templedashboard', TRUE);
            
            $templedashboarddb->select('*');
            $templedashboarddb->from('birth_star');
            $templedashboarddb->group_by('name_eng');
            $templedashboarddb->order_by('id');
            $query = $templedashboarddb->get();

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
        public function getothers(){
            $this->db->select('*');
            $this->db->from('birth_star');
            $this->db->where('other_code!=','');
            $this->db->group_by('other_code');
            $this->db->order_by('other_detail');
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
        	$this->db->select('*');
        	$this->db->from('user_dtl');
        	$this->db->where('id', @$data['id']);
        	$query = $this->db->get();
        	
        	if($query->num_rows() > 0) {
            	$this->db->where('id', @$data['id']);
                	$this->db->update('user_dtl', $data);
            	return $query->row()->id;
            } else {
            	if (isset($data['id'])) {
                	$this->db->where('id', @$data['id']);
                	$this->db->update('user_dtl', $data);
            	} else {
                	$this->db->insert('user_dtl', $data);
                	return $this->db->insert_id();
            	}
            }
        }
        
        public function getcustomers(){
            $this->db->select('*');
            $this->db->from('user_dtl');
            $this->db->group_by('name');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getcustomerbydate($datef,$datet){
            $this->db->select('user_dtl.*');
            $this->db->from('user_dtl');
            $this->db->join('billing','user_dtl.id = billing.customer_id','left');
            $this->db->join('billing_dtls','billing_dtls.bill_id = billing.id');
            $this->db->where("billing_dtls.date BETWEEN '$datef' AND '$datet'");
           // $this->db->where('billing.count!=', 0);
           // 
            $this->db->where('billing_dtls.postal_amt >', 0);
           
            $this->db->group_by('billing.id');
          
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
            $this->db->from('user_dtl');
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
        public function getdonations(){
            $this->db->select('donation.*,SUM(`amount`) as total_amt,diety.name as deity_nm');
            $this->db->from('donation');
            $this->db->join('diety','diety.id = donation.diety_id');
            $this->db->group_by('bill_id');
            $this->db->order_by('id','desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getdonationById($id){
            $this->db->select('donation.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt,diety.name_mal as deity_nm');
            $this->db->from('donation');
            $this->db->join('stars','stars.id = donation.star');
            $this->db->join('pooja','pooja.id = donation.pooja');
            $this->db->join('diety','diety.id = donation.diety_id');
            $this->db->where('donation.bill_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getlastdonid(){
            $query = $this->db->query("SELECT id FROM `donation` ORDER BY id desc limit 1");
            return $query->row_array();
        }
        
        public function getbillingById($id){
            $this->db->select('billing.*,diety.name_mal as diety_nm');
            $this->db->from('billing');
            $this->db->join('diety','diety.id = billing.diety_id');
            $this->db->where('billing.id', $id);
           $this->db->where('billing.deleted', '0');
            $query = $this->db->get();
      //  print $query->num_rows();exit;
        //echo $this->db->last_query();exit;
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getbillingdtlsById($id){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.name as name_eng,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
            $this->db->from('billing_dtls');
        	
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->where('billing_dtls.bill_id', $id);
           $this->db->where('billing.deleted', '0');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getbillBydiety($id){
            $query = $this->db->query("SELECT diety.*,billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt FROM diety
	    JOIN billing_dtls ON diety.id = billing_dtls.diety_id
	    JOIN stars ON stars.id = billing_dtls.star JOIN pooja ON pooja.id = billing_dtls.pooja WHERE billing_dtls.bill_id='$id'");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        public function getbill($type,$keyword,$dateto,$bill=null,$user_id=null){
            $this->db->select('billing.*,diety.name as diety,diety.name_mal as diety_mal');
            $this->db->from('billing');
            $this->db->join('diety','diety.id = billing.diety_id');
        	if($type != 'ALL')
            	$this->db->where('billing.mode', $type);
            $this->db->where('billing.deleted', '0');
            if($bill!=null){
                $this->db->where('billing.id', $bill);
            }else{
                $this->db->where("billing.date BETWEEN '$keyword' AND '$dateto'");
            }
            if($user_id!=null){
                $this->db->where('billing.user_id', $user_id);
            }
            $this->db->order_by("billing.id", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getdlbill($keyword=null,$dateto=null){
            $this->db->select('billing.*,diety.name as diety,diety.name_mal as diety_mal');
            $this->db->from('billing');
            $this->db->join('diety','diety.id = billing.diety_id');
            $this->db->where('billing.deleted', '1');
            if($keyword!=null){
                $this->db->where("billing.date BETWEEN '$keyword' AND '$dateto'");
            }
            $this->db->order_by("id", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

        public function getcounterwisebill($type,$keyword,$dateto,$bill=null,$user_id=null){
            $this->db->select('billing.*,diety.name as diety,diety.name_mal as diety_mal');
            $this->db->from('billing');
            $this->db->join('diety','diety.id = billing.diety_id');
        	if($type==0){
                $this->db->where('billing.status', 2);
            }else{
                $this->db->where('billing.mode', $type);
            }
            $this->db->where('billing.deleted', '0');
            if($bill!=null){
                $this->db->where('billing.id', $bill);
            }else{
                $this->db->where("billing.date BETWEEN '$keyword' AND '$dateto'");
            }
            if($user_id!=null){
                $this->db->where('billing.counter', $user_id);
            }
            $this->db->order_by("id", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getbillreport($date,$dateto=null,$diety,$type=null,$ampm=null){
            $this->db->select('billing_dtls.*,stars.name_mal as star_mal,stars.name_eng as star_eng, pooja.name_mal as pooja_nm, pooja.name as pooja_eng,diety.name as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            //$this->db->where('billing_dtls.date', $date);
            $this->db->where('billing_dtls.date =', $date);
            $this->db->where('billing.deleted', '0');
       // $this->db->where('billing_dtls.deleted', '0');
          
            if($diety!='0'){
                $this->db->where('billing_dtls.diety_id', $diety);}
            if($type!=null){
                $this->db->where('billing.date <', $date);
            }
            if($ampm!=null){
                $this->db->where('billing_dtls.time =', $ampm);
            }
        
        	$this->db->order_by('billing.id');
        $this->db->order_by('billing.id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
//     By Pooja Date
      public function getbillreport_poojawise($date,$dateto,$diety,$type=null,$ampm=null,$pooja){
            $this->db->select('billing_dtls.*,billing.date as billingdate,billing_dtls.date as pooja_date,stars.name_mal as star_eng,billing_dtls.rate,pooja.name_mal as pooja_nm,diety.name as deity_nm,billing.total,billing.mode,billing.date as bill_date');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            //$this->db->where('billing_dtls.date', $date);
            $this->db->where('billing_dtls.date >=', $date);
            $this->db->where('billing_dtls.date <=', $dateto);
            $this->db->where('billing.deleted', '0');
      $this->db->order_by("billing_dtls.bill_id", "asc");
    //print $this->db->last_query();
            if($diety!='0'){
                $this->db->where('billing_dtls.diety_id', $diety);}
          
            if($ampm!=null){
                $this->db->where('billing_dtls.time =', $ampm);
            }
        if($pooja!=null){
                $this->db->where('billing_dtls.pooja =', $pooja);
            }
      
       if($type=='A')
           {
             //$this->db->where('billing_dtls.type =', $type);
           }
           else if($type=='N')
           {
             $this->db->where('billing_dtls.type!=','S');
           
           }
          else if($type=='S')
          { $this->db->where('billing_dtls.type =', 'S');} 
           // $this->db->order_by("billing_dtls.date", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
      
//       By Bill Date
      public function getbilldate_report_poojawise($date,$dateto,$diety,$type=null,$ampm=null,$pooja){
     
            $this->db->select('billing_dtls.*,billing.date as bill_date,stars.name_mal as star_eng,billing_dtls.rate,pooja.name_mal as pooja_nm,diety.name as deity_nm,billing.total,billing.mode');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            //$this->db->where('billing_dtls.date', $date);
            $this->db->where('billing.date >=', $date);
            $this->db->where('billing.date <=', $dateto);
            $this->db->where('billing.deleted', '0');
     // print $this->db->last_query();
            if($diety!='0'){
                $this->db->where('billing_dtls.diety_id', $diety);}
           
            if($ampm!=null){
                $this->db->where('billing_dtls.time =', $ampm);
            }
         if($type=='A')
           {
             //$this->db->where('billing_dtls.type =', $type);
           }
           else if($type=='N')
           {
             $this->db->where('billing_dtls.type!=','S');
           }
          else if($type=='S')
          { $this->db->where('billing_dtls.type =', 'S');} 
      
      
      if($pooja!=null){
                $this->db->where('billing_dtls.pooja =', $pooja);
            }
            $this->db->order_by("billing.date", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        /**public function getbillsummury($from,$to,$diety,$type=null){
            if($type!=null){
                $where=" B.status='$type'";
            }else{
                $where=" B.status!='0'";
            }
            if($diety!="0"){
                $where .=" AND A.diety_id='$diety'";
            }
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND $where GROUP BY A.pooja");
            
            // $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }**/
    
//      public function getbillsummury($from,$to,$diety,$type=null){
           
//      if($type!=null){
//                 $where=" B.status='$type'";
//             }else{
//                 $where=" B.status!='0'";
//             }
//             if($diety!="0"){
//                 $where .=" AND A.diety_id='$diety'";
//             }
//             $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,min(A.rate )AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
//         JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND B.deleted!='1' AND $where  GROUP BY A.pooja order by P.name");
         
//             // $query = $this->db->get();
//             if ($query->num_rows() > 0) {
//                 return $query->result_array();
//             }
//             else {
//                 return 0;
//             }
//         }
        public function getbillsummury($from,$to,$diety,$type=null,$cat=null){
           
           		 if($type!=null){
                      $where=" B.status='$type'";
                  }else{
                      $where=" B.status!='0'";
                  }
                  if($diety!="0"){
                      $where .=" AND A.diety_id='$diety'";
                  }
         		  
         		  if($cat!=null) {
                  	$where .=" AND P.cat='$cat'";
                  }
                  $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,min(A.rate )AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount, B.mode as mode  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
              JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id   WHERE A.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND A.rate >0  AND $where  GROUP BY A.pooja, B.mode order by P.name");
 
        		
                  if ($query->num_rows() > 0) {
    $result = $query->result();

    $summary = [];

    foreach ($result as $val) {
        $pooja_id = $val->pooja_id;
        $mode = $val->mode;

        // Check if the summary array already contains the key for this pooja_id and mode
        if (isset($summary[$pooja_id][$mode])) {
            // If the key exists, add the quantity and amount to the existing values
            $summary[$pooja_id][$mode]['quantity'] += $val->quantity;
            $summary[$pooja_id][$mode]['amount'] += $val->amount;
        } else {
            // If the key doesn't exist, create a new entry
            $summary[$pooja_id][$mode] = [
                'bill_id' => $val->bill_id,
                'quantity' => $val->quantity,
                'pooja' => $val->pooja,
            	'pooja_id' => $val->pooja_id,
                'pooja_rt' => $val->pooja_rt,
                'amount' => $val->amount,
                'mode' => $val->mode
            ];
        }
    }	
                  	  $data = [];
					  foreach($summary as $pooja_id => $pooja) {
                      	 
                      	 $qr = 0;
                      	 $cash = 0;
                      	 $quantity = 0;
                      	 $amount = 0;
                         foreach($pooja as $mode => $val) {
                         	$quantity += $val['quantity'];
                         	$amount += $val['amount'];
                         	if ( $mode == 1) 
                         		$cash += $val['amount'];
                        	if ( $mode == 6) 
                         		$qr += $val['amount'];
                         }
                      
                      	 $data[$pooja_id] = $val;
                      	 $data[$pooja_id]['quantity'] = $quantity;
                      	 $data[$pooja_id]['amount'] = $amount;
                      	 $data[$pooja_id]['cash'] = $cash;
                      	 $data[$pooja_id]['qr'] = $qr;
                      }

                      return $data;
                  }
                  else {
                      return 0;
                  }
              }
    
    	public function get_pooja_mode_bill_summury($from,$to,$diety,$type=null,$cat=null){
           
           		 if($type!=null){
                      $where=" B.status='$type'";
                  }else{
                      $where=" B.status!='0'";
                  }
                  if($diety!="0"){
                      $where .=" AND A.diety_id='$diety'";
                  }
         		  
         		  if($cat!=null) {
                  	$where .=" AND P.cat='$cat'";
                  }
                  $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,min(A.rate )AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
              JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id   WHERE A.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND A.rate >0  AND $where  GROUP BY A.pooja order by P.name");
               
         		  
         		
                  if ($query->num_rows() > 0) {
                  		$bill_summary = array();
                  		$result = $query->result_array();
                  
                  		foreach($result as $val) {
							$pooja_id = $val['pooja_id'];
                        	$datef = $from;
                        	$datet = $to;
							
                            $query1=$this->db->query("SELECT sum(A.amount) as amount FROM billing_dtls A JOIN pooja P on A.pooja=P.id
              JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id   WHERE A.date BETWEEN '$datef' AND '$datet' AND B.deleted='0' AND A.rate > 0 AND A.pooja='$pooja_id' AND B.mode=1 AND $where order by P.name");
                        
                        	$cash = $query1->row()->amount;
                        
                        	$query2=$this->db->query("SELECT sum(A.amount) as amount FROM billing_dtls A JOIN pooja P on A.pooja=P.id
              JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id   WHERE A.date BETWEEN '$datef' AND '$datet' AND B.deleted='0' AND A.rate > 0 AND A.pooja='$pooja_id' AND B.mode!=1 AND $where order by P.name");
                        
                        	$other = $query2->row()->amount;
                        	
                        	$record = $val;
                        	$record['cash'] = $cash;
                        	$record['other'] = $other;
                        	$bill_summary[] = $record;
                        }
                  		
                  		
                      	return $bill_summary;
                  }
                  else {
                      return 0;
                  }
              }
    	
    	public function getbills_kooru($from,$to,$diety,$type=null,$cat=null){
           
           		 if($type!=null){
                      $where=" B.status='$type'";
                  }else{
                      $where=" B.status!='0'";
                  }
                  if($diety!="0"){
                      $where .=" AND A.diety_id='$diety'";
                  }
         		  
         		  if($cat!=null) {
                  	$where .=" AND P.cat='$cat'";
                  }
                  $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,min(A.rate )AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
              JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id   WHERE B.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND A.rate >0  AND $where  GROUP BY A.pooja order by P.name");
               
         		  
         
                  if ($query->num_rows() > 0) {
                      return $query->result_array();
                  }
                  else {
                      return 0;
                  }
              }
    
        public function getdetailsummury($from,$to,$diety,$type=null){
            if($type!=null){
                $where=" B.status='$type'";
            }else{
                $where=" B.status!='0'";
            }
            if($diety!="0"){
                $where .=" AND A.diety_id='$diety'";
            }
            $query=$this->db->query("SELECT C.*,A.bill_id,A.date as pooja_dt,A.name,A.time,B.date as booked_dt,B.status,P.name AS pooja,d.name AS diety, B.* FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id JOIN user_dtl C ON B.customer_id=C.id WHERE A.date BETWEEN '$from' AND '$to' AND B.deleted!='1' AND $where");
            
            // $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getdaily_summary($date,$dateto){
            $this->db->select('billing.*,SUM(billing_dtls.amount) AS amount');
            $this->db->from('billing');
            $this->db->join('billing_dtls','billing_dtls.bill_id = billing.id');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->where("billing.date BETWEEN '$date' AND '$dateto'");
            $this->db->where('billing.status',1);
            $this->db->where('billing.deleted', '0');
            $this->db->group_by('billing.date');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getBillList($from,$to,$diety,$type=null){
            if($type!=null){
                $where=" B.status='$type'";
            }else{
                $where=" B.status!='0'";
            }
            if($diety!="0"){
                $where .=" AND A.diety_id='$diety'";
            }
        	
        	$code_setting = $this->db->select('code_settings')->from('site_settings')->get()->row()->code_settings;
        	
        	// if($code_setting > 2) {
        	// $groupBy = 'P.code';
        	// } else {
        	// $groupBy = 'A.pooja';
        	// }
        	$groupBy = 'A.pooja';
        
        if($this->db->field_exists('discount', 'billing'))
		{
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,
            sum(A.postal_amt) as postal_amt,sum(A.amount) as amt,sum(B.discount) as discount1,A.amount,A.diety_id, B.recv_amt as recv_amt, B.bal_amt as bal_amt, B.mode as mode FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id WHERE B.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND 
        $where GROUP BY $groupBy");
		}
		else
		{
			$query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,
            sum(A.postal_amt) as postal_amt,sum(A.amount) as amt,A.amount,A.diety_id, B.recv_amt as recv_amt, B.bal_amt as bal_amt, B.mode as mode FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id WHERE B.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND 
        $where GROUP BY $groupBy");
		}
      
  
            // $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->result();
            	if($this->db->field_exists('discount', 'billing'))
		{
            	$query=$this->db->query("SELECT B.mode as mode,B.discount FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id WHERE B.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND 
        $where GROUP BY B.mode");
		}
		else
		{
		$query=$this->db->query("SELECT B.mode as mode FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id WHERE B.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND 
        $where GROUP BY B.mode");	
		}
            	$modes = $query->result();
            
            	$response = array();
            	foreach($result as $val) {
                	$pooja_id = $val->pooja_id;
                	$mode     = $val->mode;
                	$response[$pooja_id] = $val;
                	
                }
            
            	foreach($response as $key => $val) {
                	foreach($modes as $mode) {
                    	$mode_id = $mode->mode;
                    	$query=$this->db->query("SELECT sum(A.amount) as amt FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id WHERE B.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND A.pooja='$key' AND B.mode='$mode_id' AND 
        $where GROUP BY $groupBy");
                    	$row = $query->row();

                    	$val->amount_array[$mode_id] = $row->amt ?? 0;
                    }
                }
            	return $response;
            }
            else {
                return 0;
            }
        }
        public function getdetailview($from,$to,$diety,$type=null){
            if($type!=null){
                $where=" B.status='$type'";
            }else{
                $where=" B.status!='0'";
            }
            if($diety!="0"){
                $where .=" AND A.diety_id='$diety'";
            }
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,
            sum(A.postal_amt) as postal_amt,sum(A.amount) as amt,A.amount,A.diety_id FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE B.date BETWEEN '$from' AND '$to' AND B.deleted='0' AND 
        $where GROUP BY A.pooja");
       
      
  
            // $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getregister($id,$from,$to,$type=null){
           
            // if($type!=null){
            //     if($type=='GOLD'){
            //         $cond=" pooja.name like 'GOLD%' or pooja.name like 'SWARNAM%'";
            //     } elseif($type=='SILVER'){
            //         $cond=" pooja.name like 'SILVER%' or pooja.name like 'VELLI%'";
            //     }
            //     $where="$cond";
            // }else{
            //     $where=" pooja.name!='GOLD' AND pooja.name!='SILVER'";
            // }
            $query = $this->db->query("SELECT donation.*,pooja.name as poojaname FROM `donation` 
            JOIN pooja on pooja.id=donation.pooja WHERE donation.date >= '$from' AND donation.date <= '$to' 
            AND donation.category='$type' ORDER BY donation.date ASC");
        //print "SELECT donation.*,pooja.name FROM `donation` JOIN pooja on pooja.id=donation.pooja WHERE (donation.date BETWEEN '$from' AND '$to') AND $where";
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        
        public function getlasbillid(){
            $query = $this->db->query("SELECT id FROM `billing` ORDER BY id desc limit 1");
            return $query->row_array();
        }
        
        public function getlastusedbook($user_id){
            $query = $this->db->query("SELECT book_issue_id FROM `billing` WHERE user_id='$user_id' ORDER BY id desc limit 1");
            return $query->row_array();
        }
        
        public function getlastbook($user_id){
            $query = $this->db->query("SELECT book_id FROM `receipt_bookdtl` WHERE is_user='$user_id' ORDER BY id asc limit 1");
            return $query->row_array();
        }
        
        public function delete_bill($id){
            $this->db->where('id', $id);
            $this->db->delete('billing');
            $this->db->where('bill_id', $id);
            $this->db->delete('billing_dtls');
            return 1;
        }
        
        public function getdatestar($from,$to,$days){
            $query = $this->db->query("SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') GROUP BY birth_date");
      //  print "SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') GROUP BY birth_date limit 0,10";
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        
        public function getweekstar($from,$to,$day,$noofweeks){
            $query = $this->db->query("SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') AND day_of_day='$day'  GROUP BY birth_date limit 0,$noofweeks");
  //  print "SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') AND day_of_day='$day'  GROUP BY birth_date";
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        
        
        public function getpoojasbydiety($diety){
            $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,pooja.code');
            $this->db->from('diety_pooja');
            $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
            $this->db->where('diety_pooja.temple_id', $diety);
         $this->db->order_by('pooja.name');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getmonthstar($from,$to,$star,$no_months){
            //$query = $this->db->query("SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') AND name_eng='$star'  GROUP BY birth_date limit  0,$no_months");
            $query = $this->db->query("SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') AND name_eng='$star'  GROUP BY birth_date limit 0,$no_months");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
         public function getother($from,$to,$other){
            $query = $this->db->query("SELECT * FROM `birth_star` WHERE (birth_date BETWEEN '$from' AND '$to') AND other_code='$other'  GROUP BY birth_date");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        
      public function getbillsummuryforkooru($from,$to,$diety,$type=null,$cat=null){
           
           		 if($type!=null){
                      $where=" B.status='$type'";
                  }else{
                      $where=" B.status!='0'";
                  }
                  if($diety!="0"){
                      $where .=" AND A.diety_id='$diety'";
                  }

         		  if($cat!=null) {
                  	$where .=" AND P.cat='$cat'";
                  }
                  $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,min(A.rate )AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
              JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id   WHERE B.date BETWEEN '$from' AND '$to' AND A.rate> 0 and  B.deleted!='1' AND $where and P.id IN ( select pooja_id from  kooru_mng) GROUP BY A.pooja ");
               
          
         
                  if ($query->num_rows() > 0) {
                      return $query->result_array();
                  }
                  else {
                      return 0;
                  }
              }
    
    public function getbillsummuryforkoorubypooja($from,$to,$diety,$type=null,$cat=null){
           
           		 if($type!=null){
                      $where=" B.status='$type'";
                  }else{
                      $where=" B.status!='0'";
                  }
                  if($diety!="0"){
                      $where .=" AND A.diety_id='$diety'";
                  }

         		  if($cat!=null) {
                  	$where .=" AND P.cat='$cat'";
                  }
                  $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,min(A.rate )AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
              JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id   WHERE A.date BETWEEN '$from' AND '$to'  and  B.deleted!='1' and A.rate >0 AND $where and P.id IN ( select pooja_id from  kooru_mng) GROUP BY A.pooja ");
               
          
         
                  if ($query->num_rows() > 0) {
                      return $query->result_array();
                  }
                  else {
                      return 0;
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
        
        //ABOUT US
        
        public function addContent($data)
        {
            
            $res=$this->db->insert("aboutus",$data);
            return $res;
            
        }
        
        public function getcontent(){
            $this->db->select('*');
            $this->db->from('aboutus');
            $this->db->where('is_delete !=', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function deleteContent($id){
            
            $data = array(
                'is_delete'         =>1,
                
            );
            $this->db->where('abtId', $id);
            $result=$this->db->update('aboutus',$data);
            return $result;
        }
        //GALLERY
        public function getgal_category(){
            $this->db->select('*');
            $this->db->from('gallery');
            $this->db->order_by('gal_Id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function addGallery($data)
        {
            
            $res=$this->db->insert("gallery",$data);
            return $res;
            
        }
        public function getGallery(){
            $this->db->select('*');
            $this->db->from('gallery');
            $this->db->where('is_delete !=', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function deleteGallery($id){
            
            $data = array(
                'is_delete'         =>1,
                
            );
            $this->db->where('gal_Id', $id);
            $result=$this->db->update('gallery',$data);
            return $result;
        }
        
        //CONTACT
        public function addContact($data)
        {
            
            $res=$this->db->insert("contact",$data);
            return $res;
            
        }
        
        public function getContact(){
            $this->db->select('*');
            $this->db->from('contact');
            $this->db->order_by('c_Id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function setdeposite($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('deposite', $data);
            } else {
                $this->db->insert('deposite', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getdeposite(){
            $this->db->select('*');
            $this->db->from('deposite');
            $this->db->where('status!=','0');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getdepositebyid($id){
            $this->db->select('*');
            $this->db->from('deposite');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        
        public function getdepositebydate($datef,$datet,$type=null,$status=null){
            $this->db->select('*');
            $this->db->from('deposite');
            $this->db->where("ac_date BETWEEN '$datef' AND '$datet'");
            if ($type!=null){
                $this->db->where('ac_type',$type);
            }
            if ($status!=null){
                $this->db->where('status',$status);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getmatdepositebydate($datef,$datet,$type=null,$status=null){
            $this->db->select('*');
            $this->db->from('deposite');
            $this->db->where("mat_date BETWEEN '$datef' AND '$datet'");
            if ($type!=null){
                $this->db->where('ac_type',$type);
            }
            if ($status!=null){
                $this->db->where('status',$status);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        //ass_cat
        
        public function getass_cat(){
            $this->db->select('*');
            $this->db->from('ass_cat');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getass_catbyid($id){
            $this->db->select('*');
            $this->db->from('ass_cat');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setass_cat($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('ass_cat', $data);
            } else {
                $this->db->insert('ass_cat', $data);
                return $this->db->insert_id();
            }
        }
        
        //Sub Category
        
        public function getass_subcat(){
            $this->db->select('ass_subcat.*,ass_cat.name as cat_nm');
            $this->db->from('ass_subcat');
            $this->db->join('ass_cat','ass_cat.id = ass_subcat.cat_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getass_subcatbyid($id){
            $this->db->select('*');
            $this->db->from('ass_subcat');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setass_subcat($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('ass_subcat', $data);
            } else {
                $this->db->insert('ass_subcat', $data);
                return $this->db->insert_id();
            }
        }
        public function getasssubcat($id){
            $this->db->select('*');
            $this->db->from('ass_subcat');
            $this->db->where('cat_id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        //ass_loc
        
        public function getass_loc(){
            $this->db->select('*');
            $this->db->from('ass_loc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getass_locbyid($id){
            $this->db->select('*');
            $this->db->from('ass_loc');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setass_loc($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('ass_loc', $data);
            } else {
                $this->db->insert('ass_loc', $data);
                return $this->db->insert_id();
            }
        }
        
        //asset
        
        public function setasset($data) {
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('asset', $data);
            } else {
                $this->db->insert('asset', $data);
                return $this->db->insert_id();
            }
        }
        public function getassets($location=null,$ass_cat=null){
            $this->db->select('asset.*,ass_cat.name as cat_nm,ass_subcat.name as scat_nm,ass_loc.name as loc_nm');
            $this->db->from('asset');
            $this->db->join('ass_cat','ass_cat.id = asset.ass_cat');
            $this->db->join('ass_subcat','ass_subcat.id = asset.ass_subcat');
            $this->db->join('ass_loc','ass_loc.id = asset.location');
            if ($location!=null){
                $this->db->where('asset.location',$location);
            }
            if ($ass_cat!=null){
                $this->db->where('asset.ass_cat',$ass_cat);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getassetsbyid($id){
            $this->db->select('asset.*,ass_cat.name as cat_nm,ass_subcat.name as scat_nm,ass_loc.name as loc_nm');
            $this->db->from('asset');
            $this->db->join('ass_cat','ass_cat.id = asset.ass_cat');
            $this->db->join('ass_subcat','ass_subcat.id = asset.ass_subcat');
            $this->db->join('ass_loc','ass_loc.id = asset.location');
            $this->db->where('asset.id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        
        //kooru_usr
        
        public function getkooru_usr(){
            $this->db->select('*');
            $this->db->from('kooru_usr');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getkooru_usrbyid($id){
            $this->db->select('*');
            $this->db->from('kooru_usr');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setkooru_usr($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('kooru_usr', $data);
            } else {
                $this->db->insert('kooru_usr', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getkooruById($id){
            $this->db->select('*');
            $this->db->from('kooru_mng');
            $this->db->where('user_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        //inv_cat
        
        public function getinv_cat(){
            $this->db->select('*');
            $this->db->from('inv_cat');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getinv_catbyid($id){
            $this->db->select('*');
            $this->db->from('inv_cat');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setinv_cat($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('inv_cat', $data);
            } else {
                $this->db->insert('inv_cat', $data);
                return $this->db->insert_id();
            }
        }
        
        //inv_unit
        
        public function getinv_unit(){
            $this->db->select('*');
            $this->db->from('inv_unit');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getinv_unitbyid($id){
            $this->db->select('*');
            $this->db->from('inv_unit');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setinv_unit($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('inv_unit', $data);
            } else {
                $this->db->insert('inv_unit', $data);
                return $this->db->insert_id();
            }
        }
        
        //inv_product
        
        public function getinv_product(){
            $this->db->select('inv_product.*,inv_cat.name as cat_nm,inv_unit.name as unit_nm');
            $this->db->from('inv_product');
            $this->db->join('inv_cat','inv_cat.id = inv_product.cat_id');
            $this->db->join('inv_unit','inv_unit.id = inv_product.unit');
            $this->db->order_by("inv_product.name", "asc");
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getinv_productbyid($id){
            $this->db->select('inv_product.*,inv_cat.name as cat_nm,inv_unit.name as unit_nm');
            $this->db->from('inv_product');
            $this->db->join('inv_cat','inv_cat.id = inv_product.cat_id');
            $this->db->join('inv_unit','inv_unit.id = inv_product.unit');
            $this->db->where('inv_product.id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setinv_product($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('inv_product', $data);
            } else {
                $this->db->insert('inv_product', $data);
                return $this->db->insert_id();
            }
        }
        
        //inv_opening
        
        public function getinv_opening(){
            $this->db->select('inv_opening.*,inv_product.name as pro_nm,inv_product.code as pro_cd');
            $this->db->from('inv_opening');
            $this->db->join('inv_product','inv_product.id = inv_opening.product_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function setinv_opening($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('inv_opening', $data);
            } else {
                $this->db->insert('inv_opening', $data);
                return $this->db->insert_id();
            }
        }
        
        //supplier
        
        public function getsupplier($for=null){
            $this->db->select('*');
            $this->db->from('supplier');
            if ($for!=null){
                $this->db->where('sup_for',$for);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getsupplierbyid($id){
            $this->db->select('*');
            $this->db->from('supplier');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setsupplier($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('supplier', $data);
            } else {
                $this->db->insert('supplier', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getproductdtls($id){
            $this->db->select('inv_product.*,SUM(stock.qty) as qty');
            $this->db->from('inv_product');
            $this->db->join('stock','stock.productid = inv_product.id');
            $this->db->where('inv_product.id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getpurchase($datef,$datet,$suppr=null){
            $this->db->select('purchase.*,purchase.id as purchase_id,supplier.*,supplier.id as sup_id');
            $this->db->from('purchase');
            $this->db->join('supplier','supplier.id = purchase.supplier_id');
            $this->db->where("purchase.date BETWEEN '$datef' AND '$datet'");
            if($suppr!=null){
                $this->db->where('purchase.supplier_id', $suppr);
            }
            $this->db->order_by("purchase.id", "desc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getpurchasebyid($id){
            $this->db->select('purchase.*,purchase.id as purchase_id,supplier.*');
            $this->db->from('purchase');
            $this->db->join('supplier','supplier.id = purchase.supplier_id');
            $this->db->where('purchase.id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        
        public function getpurchasebysup($id,$datef=null,$datet=null){
            $this->db->select('purchase.*,purchase.id as purchase_id,supplier.*,supplier.id as sup_id');
            $this->db->from('purchase');
            $this->db->join('supplier','supplier.id = purchase.supplier_id');
            $this->db->where('purchase.supplier_id', $id);
            if($datef!=null&&$datet!=null){
                $this->db->where("purchase.date BETWEEN '$datef' AND '$datet'");
            }
            $this->db->order_by("purchase.id", "desc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getissue($pro_id=null){
            $this->db->select('issue.*,inv_product.name as product_nm,inv_unit.name as unit,supplier.*');
            $this->db->from('issue');
            $this->db->join('inv_product','inv_product.id = issue.product_id');
            $this->db->join('inv_unit','inv_unit.id = issue.unit');
            $this->db->join('supplier','supplier.id = issue.customer');
            if ($pro_id!=null){
                $this->db->where('issue.product_id', $pro_id);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function mookkolakallu($datef=NULL,$datet=NULL,$key=NULL){
       
            $this->db->select('billing_dtls.*,billing.date as booked_date,billing.customer_id as customer,stars.name_mal as star_eng');
            $this->db->from('billing_dtls');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->join('user_dtl','billing.customer_id = user_dtl.id');
            $this->db->where('billing_dtls.pooja', '2000');
        	$this->db->where('billing.deleted', 0);
            if ($datef!=null && $datet!=null && $key==''){
                $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
            }
        if ($key!=null){
                $this->db->where("billing_dtls.name LIKE  '%$key%' or user_dtl.mobile LIKE '%$key%'");
            }
      //  echo $this->db->last_query();
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function get_stock(){
            $this->db->select('inv_product.id as pro_id,inv_product.name,inv_product.code,SUM(stock.qty) as qty');
            $this->db->from('inv_product');
            $this->db->join('stock','stock.productid = inv_product.id');
            $this->db->group_by('inv_product.name');
            $this->db->order_by('inv_product.id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function get_stock_without_dittum(){
            $this->db->select('inv_product.id as pro_id,inv_product.name,inv_product.code,SUM(stock.qty) as qty');
            $this->db->from('inv_product');
            $this->db->join('stock','stock.productid = inv_product.id');
        
            $this->db->group_by('inv_product.name');
            $this->db->order_by('inv_product.id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function get_stockdtl($id){
            $this->db->select('stock.*,inv_product.name,inv_unit.name as unit_nm');
            $this->db->from('stock');
            $this->db->join('inv_product','stock.productid = inv_product.id');
            $this->db->join('inv_unit','stock.unitid = inv_unit.id');
            $this->db->where('stock.productid', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getdittum(){
            $this->db->select('dittum.*,inv_product.id as pro_id,inv_product.name as pro_nm,inv_unit.name as unit_nm,pooja.name as pooja_nm');
            $this->db->from('dittum');
            $this->db->join('inv_product','dittum.product_id = inv_product.id');
            $this->db->join('inv_unit','dittum.unit_id = inv_unit.id');
            $this->db->join('pooja','dittum.pooja_id = pooja.id');
            $this->db->order_by('dittum.pooja_id');
            $this->db->group_by('dittum.pooja_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        //bandaram
        
        public function getbandaram(){
            $this->db->select('*');
            $this->db->from('bandaram');
        $this->db->order_by("status", "desc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getbandarambyid($id){
            $this->db->select('*');
            $this->db->from('bandaram');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setbandaram($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('bandaram', $data);
            } else {
                $this->db->insert('bandaram', $data);
                return $this->db->insert_id();
            }
        }
        
        //amount
        
        public function getamount(){
            $this->db->select('*');
            $this->db->from('amount');
            $this->db->order_by("order", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
     public function gettransactiontype(){
            $this->db->select('remark');
            $this->db->from('amount');
            $this->db->group_by('remark');
            $this->db->order_by("order", "asc");
            $query = $this->db->get();
          
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getamountbyid($id){
            $this->db->select('*');
            $this->db->from('amount');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function setamount($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('amount', $data);
            } else {
                $this->db->insert('amount', $data);
                return $this->db->insert_id();
            }
        }
        public function gettransbyid($id){
            $this->db->select('transaction.*,bandaram.name as bandaram_nm');
            $this->db->from('transaction');
            $this->db->join('bandaram','transaction.bandaram = bandaram.id');
            $this->db->where('transaction.id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function gettransdtlbyid($id){
            $this->db->select('transaction_dtls.*,amount.name as amount_nm');
            $this->db->from('transaction_dtls');
            $this->db->join('amount','transaction_dtls.amount = amount.id');
            $this->db->where('transaction_dtls.trans_id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function searchcustomer($datef=null,$datet=null,$keyword=null){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->where("billing_dtls.name LIKE '%$keyword%'");
            $this->db->order_by("billing_dtls.date", "desc");
            if ($datef!=null&&$datef!=null){
                $this->db->where("billing_dtls.date BETWEEN '$datef' AND '$datet'");
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        //Adjustment
        
        public function getadjustment($datef,$datet,$product=null){
            $this->db->select('adjustment.*,inv_product.name as product_nm,inv_unit.name as unit');
            $this->db->from('adjustment');
            $this->db->join('inv_product','inv_product.id = adjustment.product_id');
            $this->db->join('inv_unit','inv_unit.id = adjustment.unit');
            $this->db->where("adjustment.date BETWEEN '$datef' AND '$datet'");
            if($product!=null){
                $this->db->where('adjustment.product_id', $product);
            }
            $this->db->order_by("adjustment.id", "desc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getroles(){
            $this->db->select('*');
            $this->db->from('role_master');
            $this->db->order_by("id", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function setrole($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('role_master', $data);
            } else {
                $this->db->insert('role_master', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getpermissionlist(){
            $this->db->select('*');
            $this->db->from('permission');
            $this->db->where('parent', 0);
            $this->db->order_by("id", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function searchscheduled($datef,$datet){
            $this->db->select('billing_dtls.name,billing_dtls.pooja,pooja.name_mal as pooja_nm');
            $this->db->from('billing_dtls');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->where("billing_dtls.date BETWEEN '$datef' AND '$datet'");
            $this->db->where('billing.total!=', '');
            $this->db->where('billing.place', '');
            $this->db->where('billing.deleted', '0');
            $this->db->group_by('billing_dtls.pooja');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function editContact($data){
            
            $result=$this->db->update('contact',$data);
            return $result;
        }
        public function getallowedqty($pooja_id,$date,$qty){
            $this->db->select('allowed_qty')->from('pooja')->where('id',$pooja_id);
            $query = $this->db->get();
     //   $this->db->last_query();
            if ($query->num_rows() > 0) {
                $data = $query->row_array();
                $allowed_qty = $data['allowed_qty']; 
                if($allowed_qty == 0){
                   return 0;
                }
                $this->db->select('count(id) as count');
                $this->db->from('billing_dtls');
                $this->db->where('date', $date);
                $this->db->where('pooja', $pooja_id);
                $query = $this->db->get();
                $d = $query->row_array();
      
        
                $current_qty = ($d['count'] !='') ? $d['count'] : 0;
        //  echo $current_qty."-".$allowed_qty;exit;
                   if($current_qty > $allowed_qty){
                       if($allowed_qty == 0){
                           return 0;
                       }
                       else{
                           return 1;
                       }
                   }
                   else{
                      $all_qty = $current_qty + $qty;
                 
                      if($all_qty > $allowed_qty){
                         return 1;
                      }
                      else{
                        return 0;
                     }
                  }
              
            }
            else {
                return 0;
            }
            
        }

        public function getpoojaregisterbydate($datef,$datet,$mode){
            
            $this->db->select('billing_dtls.*,billing.number,stars.name_eng as starname,diety.name_mal as dietyname,pooja.name_mal as poojaname,billing.mode_date,billing.date as bill_date');
            $this->db->from('billing_dtls');
            $this->db->join('billing','billing_dtls.bill_id = billing.id');
            $this->db->join('pooja','billing_dtls.pooja = pooja.id');
            $this->db->join('stars','billing_dtls.star = stars.id');
            $this->db->join('diety','billing_dtls.diety_id = diety.id');
            $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
            $this->db->where('billing.mode', $mode);
            $this->db->where('billing.deleted', '0');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getscheduledpoojas($keyword=null, $pooja_date=null){
            $this->db->select('billing.id,user_dtl.name,user_dtl.mobile');
            $this->db->from('billing');
            $this->db->join('billing_dtls','billing.id = billing_dtls.bill_id');
            $this->db->join('user_dtl','billing.customer_id = user_dtl.id');
            $this->db->where('billing_dtls.type', 'S');
            $this->db->where('billing.deleted', '0');
            if($keyword!=null){
                $this->db->like('billing.id', $keyword);
                $this->db->or_like('user_dtl.mobile', $keyword);
                $this->db->or_like('user_dtl.name', $keyword);
            }
        
        	if($pooja_date) {
        		$this->db->where('billing_dtls.date', $pooja_date);    	
            }
        
            $this->db->group_by('billing.id');
            $this->db->order_by('billing.id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
    
    	public function getpaginatedscheduledpoojas($per_page, $upto, $keyword=null, $pooja_date=null){
        	if($upto) {
            	$pageNo = $upto/$per_page;
            } else {
            	$pageNo = 1;
            }
        
            $this->db->select('billing.id,user_dtl.name,user_dtl.mobile');
            $this->db->from('billing');
            $this->db->join('billing_dtls','billing.id = billing_dtls.bill_id');
            $this->db->join('user_dtl','billing.customer_id = user_dtl.id');
            $this->db->where('billing_dtls.type', 'S');
            $this->db->where('billing.deleted', '0');
            if($keyword!=null){
                $this->db->like('billing.id', $keyword);
                $this->db->or_like('user_dtl.mobile', $keyword);
                $this->db->or_like('user_dtl.name', $keyword);
            }
        
        	if($pooja_date) {
        		$this->db->where('billing_dtls.date', $pooja_date);    	
            }
        
            $this->db->group_by('billing.id');
            $this->db->order_by('billing.id');
        	$this->db->limit($per_page, $upto);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        public function getscheduledbilldetails($id){
            $this->db->select('billing_dtls.*,pooja.name_mal as pooja_name,diety.name_mal as diety_name,stars.name_mal as star_name');
            $this->db->from('billing_dtls');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->where('billing_dtls.type', 'S');
            $this->db->like('billing_dtls.bill_id', $id);
            $this->db->order_by('billing_dtls.id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return array();
            }
        }
        public function getscheduledbilluserdetails($id){
           $this->db->select('billing.id,user_dtl.*');
           $this->db->from('billing');
           $this->db->join('user_dtl','billing.customer_id = user_dtl.id');
           $this->db->where('billing.id', $id);
           $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return array();
            }
        }
    
    public function get_imp_pooja() {
    	$this->db->select('*');
    	$this->db->from('pooja');
    	$this->db->where('pooja.isimp', '1');
    	$query = $this->db->get();
    	if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return 0;
        }
    }
    
    public function getbillreport_imp($date,$diety,$type=null,$ampm=null){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,diety.name as deity_nm,billing.date as billingdate');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->where('billing_dtls.date', $date);
     		$this->db->where('pooja.isimp', '1'); 
     		$this->db->order_by('pooja.name');
    		// $this->db->group_by('billing.id');
      //      $where = '(pooja.pooja_cat="2" or pooja.pooja_cat = "3")';
         //   $this->db->where($where);
         //   
         	
    
            if($diety!='0'){
            $this->db->where('billing_dtls.diety_id', $diety);}
            if($type!=null){
                $this->db->where('billing.date <', $date);
            }
        	if($ampm!=null){
                $this->db->where('billing_dtls.time =', $ampm);
            }
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function setcounter($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('counter', $data);
            } else {
                $this->db->insert('counter', $data);
                return $this->db->insert_id();
            }
        }
        public function getcounters(){
            $this->db->select('*');
            $this->db->from('counter');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getcountersbyid($id){
            $this->db->select('*');
            $this->db->from('counter');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
    
        public function set_mrg_reg($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('marriage_reg', $data);
            } else {
                $this->db->insert('marriage_reg', $data);
                return $this->db->insert_id();
            }
        }
        public function get_mrg_reg(){
            $this->db->select('*');
            $this->db->from('marriage_reg');
          //  $this->db->group_by('mdate');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getmrgbydate($datef,$datet){
            $this->db->select('marriage_reg.*');
            $this->db->where("mdate BETWEEN '$datef' AND '$datet'");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getmrgById($id){
            $this->db->select('*');
            $this->db->from('marriage_reg');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function getFpooja($id=null){
            $this->db->select('*');
            $this->db->from('fpooja');
        	if($id!=null){
                $this->db->where('id', $id);
            }
            $this->db->order_by("id", "desc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            	if($id!=null){
                	return $query->row_array();
                }else{
                	return $query->result_array();
                }
            }
            else {
                return 0;
            }
        }
    
        public function getFpoojadtl($id){
            $this->db->select('*');
            $this->db->from('fpooja_dtl');
            $this->db->where('f_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            	return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function delete_fpooja($id){
            $this->db->where('id', $id);
            $this->db->delete('fpooja');
            $this->db->where('f_id', $id);
            $this->db->delete('fpooja_dtl');
            return 1;
        }
    
        //room
        
        public function setroom($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('room_dtl', $data);
            } else {
                $this->db->insert('room_dtl', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getrooms(){
            $this->db->select('*');
            $this->db->from('room_dtl');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getroomsById($id){
            $this->db->select('*');
            $this->db->from('room_dtl');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function deleteroom($id){
            $this->db->where('id', $id);
            $this->db->delete('room_dtl');
            return 1;
        }
    
        //room_cust
        
        public function setcust($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('room_cust', $data);
            } else {
                $this->db->insert('room_cust', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getcusts(){
            $this->db->select('*');
            $this->db->from('room_cust');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getcustsById($id){
            $this->db->select('*');
            $this->db->from('room_cust');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function deletecust($id){
            $this->db->where('id', $id);
            $this->db->delete('room_cust');
            return 1;
        }
    
        //room_trans
        
        public function setroom_trans($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('room_trans', $data);
            } else {
                $this->db->insert('room_trans', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getroom_transs(){
            $this->db->select('*');
            $this->db->from('room_trans');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getroom_transsById($id){
            $this->db->select('*');
            $this->db->from('room_trans');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
        public function deleteroom_trans($id){
            $this->db->where('id', $id);
            $this->db->delete('room_trans');
            return 1;
        }
    	
        public function getlasttransid(){
            $query = $this->db->query("SELECT id FROM `room_trans` ORDER BY id desc limit 1");
            return $query->row_array();
        }
    
        //Book
        
        public function setbook($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('receipt_book', $data);
            } else {
                $this->db->insert('receipt_book', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getbooks(){
            $this->db->select('*');
            $this->db->from('receipt_book');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

        public function getbooksById($id){
            $this->db->select('*');
            $this->db->from('receipt_book');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }

        public function deletebook($id){
            $this->db->where('id', $id);
            $this->db->delete('receipt_book');
            return 1;
        }
    
        //Book
        
        public function setissue($data) {
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('receipt_bookdtl', $data);
            } else {
                $this->db->insert('receipt_bookdtl', $data);
                return $this->db->insert_id();
            }
        }
        
        public function getissues(){
            $this->db->select('receipt_bookdtl.*,receipt_book.book_no,admin.name');
            $this->db->from('receipt_bookdtl');
            $this->db->join('receipt_book', 'receipt_bookdtl.Book_id = receipt_book.id');
            $this->db->join('admin', 'receipt_bookdtl.is_user = admin.id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

        public function getissuesByid($id){
            $this->db->select('receipt_bookdtl.*,receipt_book.book_no,admin.name');
            $this->db->from('receipt_bookdtl');
            $this->db->join('receipt_book', 'receipt_bookdtl.Book_id = receipt_book.id');
            $this->db->join('admin', 'receipt_bookdtl.is_user = admin.id');
            $this->db->where('receipt_bookdtl.id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }

        public function getissuebooks($userid){
            $this->db->select('receipt_bookdtl.*,receipt_book.book_no,admin.name');
            $this->db->from('receipt_bookdtl');
            $this->db->join('receipt_book', 'receipt_bookdtl.Book_id = receipt_book.id');
            $this->db->join('admin', 'receipt_bookdtl.is_user = admin.id');
            $this->db->where('receipt_bookdtl.is_user', $userid);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

        public function deletebookissue($id){
            $this->db->where('id', $id);
            $this->db->delete('receipt_bookdtl');
            return 1;
        }
    
     public function getbillsummarybytime($from,$to,$diety,$type=null,$time=null){
            if ($time != null && $type != null) {
   				 $where = "A.time = '$time' AND B.status = '$type'";
			} else if ($time != null) {
   				 $where = "(A.time = '$time'  or A.time='A')";
			} else if ($type != null) {
   				 $where = "B.status = '$type'";
			} else if ($diety != null) {
          		  $where = "A.diety_id = '$diety'";
            } else {
   				 $where = "B.status != '0'";
			}

            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.time as poojatime,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND B.deleted!='1' AND $where GROUP BY A.pooja");
          //  print "SELECT A.bill_id,sum(A.qlt) AS quantity,A.time as poojatime,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        //JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND B.deleted!='1' AND $where GROUP BY A.pooja";
            // $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    public function getcat(){
            $this->db->select('*');
            $this->db->from('cat');
            $this->db->order_by('name');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
       public function getdetailview_cat($from,$to,$diety,$type=null){
            if($type!=null){
                $where=" B.status='$type'";
            }else{
                $where=" B.status!='0'";
            }
            if($diety!="0"){
                $where .=" AND A.diety_id='$diety'";
            }
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,C.name as pooja_category,P.name_mal AS pooja, A.rate AS pooja_rt,d.name AS diety,sum(A.postal_amt) as postal_amt,sum(A.amount) as amt,A.amount FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN cat C on P.pooja_cat=C.id JOIN diety d ON A.diety_id=d.id WHERE B.date BETWEEN '$from' AND '$to'AND B.deleted!='1' AND $where GROUP BY A.pooja");
     
            
            // $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
//     public function get_poojas_by_category() {
//         $this->db->select('billing_dtls.qlt AS quantity,billing_dtls.pooja as pooja_id,billing_dtls.rate AS pooja_rate,cat.name AS category_name, pooja.name AS pooja_name,billing_dtls.postal_amt as postal_amount,billing_dtls.amount as amt');
//         $this->db->from('cat');
//         $this->db->join('pooja', 'pooja.pooja_cat = cat.id');
//         $this->db->join('billing_dtls', 'billing_dtls.pooja = pooja.id');        
//         $this->db->join('billing', 'billing_dtls.bill_id = billing.id');        
     
//         $this->db->order_by('cat.id', 'ASC');
//         $this->db->order_by('pooja.name', 'ASC');        
//         $this->db->group_by('billing_dtls.pooja');

//         $query = $this->db->get();

//         $poojas = array();
//         foreach ($query->result() as $row) {
//             $poojas[$row->category_name][] = array(
//                 'pooja_name' => $row->pooja_name,                
//             	'quantity' => $row->quantity,
//                 'rate' => $row->pooja_rate,                
//             	'postal_amt' => $row->postal_amount,            	
//             	'amount' => $row->amt,


//             );
//         }
//         return $poojas;
//     }
    /*
    public function get_poojas_by_category($from,$to,$diety,$type=null, $cat=null) {
        
        $this->db->select('sum(billing_dtls.qlt) AS quantity,billing_dtls.pooja as pooja_id,billing_dtls.rate AS pooja_rate,cat.name_mal AS category_name, pooja.name_mal AS pooja_name,sum(billing_dtls.postal_amt) as postal_amount,sum(billing_dtls.amount) as amt');
        $this->db->from('billing_dtls');
        // $this->db->join('pooja', 'pooja.cat = cat.id');
        // $this->db->join('billing_dtls', 'billing_dtls.pooja = pooja.id');        
        $this->db->join('billing', 'billing_dtls.bill_id = billing.id');
        $this->db->join('pooja', 'billing_dtls.pooja = pooja.id');
        $this->db->join('cat', 'pooja.cat = cat.id');
        
        $this->db->where('billing.date >=', $from);
        $this->db->where('billing.date <=', $to);
        $this->db->where('billing.deleted', '0');
        if($type == 2){
        	$this->db->where('billing.status', $type);
        } elseif ($type==1) {
        	$this->db->where('billing.status', 1);
        }
        
        if($diety!="0"){
        	$this->db->where('billing.diety_id', $diety);
        }
        
        if($cat!=null) {
        	$this->db->where('pooja.cat', $cat);
        }

        
        $this->db->order_by('cat.id', 'ASC');
        $this->db->order_by('pooja.name_mal', 'ASC');        
        $this->db->group_by('billing_dtls.pooja');

        $query = $this->db->get();
		
        $poojas = array();
        foreach ($query->result() as $row) {
            $poojas[$row->category_name][] = array(
                'pooja_name' => $row->pooja_name,                
            	'quantity' => $row->quantity,
                'rate' => $row->pooja_rate,                
            	'postal_amt' => $row->postal_amount,            	
            	'amount' => $row->amt,


            );
        }
        return $poojas;
    }
    */
    
    public function get_poojas_by_category($from,$to,$diety,$type=null, $cat=null) {
        
			$this->db->select("
			pooja.name_mal AS pooja_name,
			cat.name_mal AS category_name,
			SUM(billing_dtls.qlt) AS quantity,
			billing_dtls.pooja AS pooja_id,
			billing_dtls.rate AS pooja_rate,
			SUM(billing_dtls.postal_amt) AS postal_amount,
			SUM(billing_dtls.amount) AS amt,
			SUM(CASE WHEN payment_modes.name = 'Cash' THEN billing_dtls.amount ELSE 0 END) AS Cash,
			SUM(CASE WHEN payment_modes.name = 'NEFT' THEN billing_dtls.amount ELSE 0 END) AS NEFT,
			SUM(CASE WHEN payment_modes.name = 'QR Code' THEN billing_dtls.amount ELSE 0 END) AS QRCode,
			SUM(CASE WHEN payment_modes.name = 'Card' THEN billing_dtls.amount ELSE 0 END) AS Card
		", false);

		$this->db->from('billing_dtls');
		$this->db->join('billing', 'billing_dtls.bill_id = billing.id');
		$this->db->join('pooja', 'billing_dtls.pooja = pooja.id');
		$this->db->join('cat', 'pooja.cat = cat.id');
		$this->db->join('payment_modes', 'billing.mode = payment_modes.id', 'left');

		$this->db->where('billing.date >=', $from);
		$this->db->where('billing.date <=', $to);
		$this->db->where('billing.deleted', 0);

		if ($type == 2) {
			$this->db->where('billing.status', 2);
		} elseif ($type == 1) {
			$this->db->where('billing.status', 1);
		}

		if ($diety != "0") {
			$this->db->where('billing.diety_id', $diety);
		}

		if (!empty($cat)) {
			$this->db->where('pooja.cat', $cat);
		}

		$this->db->group_by(['billing_dtls.pooja', 'pooja.name_mal', 'cat.name_mal']);
		$this->db->order_by('cat.id', 'ASC');
		$this->db->order_by('pooja.name_mal', 'ASC');

		$query = $this->db->get();
		
        $poojas = array();
        foreach ($query->result() as $row) {
            $poojas[$row->category_name][] = array(
                'pooja_name' => $row->pooja_name,                
            	'quantity' => $row->quantity,
                'rate' => $row->pooja_rate,                
            	'postal_amt' => $row->postal_amount,            	
            	'amount' => $row->amt,
				'cash' => $row->Cash,
				'neft' => $row->NEFT,
				'qrcode' => $row->QRCode,
				'card' => $row->Card,


            );
        }
		

        return $poojas;
    }
    
    public function getpoojarate($pooja){
  
       $this->db->select('rate');
            $this->db->from('pooja');
            $this->db->where('id', $pooja);
  $query = $this->db->get();
  $row = $query->row();
  
            if ($query->num_rows() > 0) {
                return $row->rate;
            }
            else {
                return 0;
            }
  

}
    
    public function getpooja_rowcount($pooja){
  
       		$this->db->select('rowcount');
            $this->db->from('pooja');
            $this->db->where('id', $pooja);
  			$query = $this->db->get();
  			$row = $query->row();
  
            if ($query->num_rows() > 0) {
                return $row->rowcount;
            }
            else {
                return 0;
            }
  

}
    
    
    public function getmuthalkootu(){
            $this->db->select('*');
            $this->db->from('muthalkootu');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
       public function getMuthalkootuById($id){
            $this->db->select('*');
            $this->db->from('muthalkootu');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
        }
    
       public function getPoojasByMuthalkootuId($id){
            $this->db->select('muthalkootu_poojas.*, pooja.name as pooja_name, pooja.name_mal as pooja_name_mal');
            $this->db->from('muthalkootu_poojas');
            $this->db->join('pooja','muthalkootu_poojas.pooja_id = pooja.id');
            $this->db->where('muthalkootu_id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function getmuthalkootusummary($from,$to, $cat=null){
            
            $this->db->select('muthalkootu_poojas.*,pooja.name_mal as pooja_name,pooja.id as pooja_id,SUM(billing_dtls.qlt) as pooja_count, pooja.rate as pooja_rate, SUM(billing_dtls.amount) as amount');
            $this->db->from('muthalkootu_poojas');
        	$this->db->join('muthalkootu','muthalkootu_poojas.muthalkootu_id = muthalkootu.id');
            $this->db->join('pooja','muthalkootu_poojas.pooja_id = pooja.id');
            $this->db->join('billing_dtls','pooja.id = billing_dtls.pooja');
        	$this->db->join('billing','billing_dtls.bill_id = billing.id');
			$this->db->where("billing.date BETWEEN '$from' AND '$to'");
        $this->db->where("billing_dtls.diety_id !=8");
        	$this->db->where("billing.deleted=0");
        	
        	if($cat!=null) {
                 $this->db->where("pooja.cat='$cat'");
            }

            $this->db->group_by('pooja.id');
            $query = $this->db->get();
			
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function getpoojacategories(){
            $this->db->select('*');
            $this->db->from('cat');
            $this->db->order_by('name');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function getBillPrintDetails($bill_id) {
        	$this->db->select('date, time');
        	$this->db->from('billing_dtls');
        	$this->db->where('bill_id', $bill_id);
        	$this->db->order_by('date', 'asc');
        	$this->db->group_by('date', 'time');
        	$dates_query = $this->db->get();
		    $dates = $dates_query->result();
			
        	$bill_list = array();
          	foreach ($dates as $date){
            	$pooja_date = $date->date;
            	$time		= $date->time;
            
	        	$b = $this->db->query("SELECT pooja_cat FROM pooja WHERE id IN (SELECT pooja FROM billing_dtls WHERE bill_id = $bill_id and date='$pooja_date' and time='$time') GROUP BY pooja_cat");
		    	$pooja_cat=$b->result();
          		
		    	foreach ($pooja_cat as $cat){ 
                	$this->db->select('billing_dtls.*,billing_dtls.qlt as quantity, stars.name_mal as star_eng, stars.name_eng as star_name,pooja.name as pooja,pooja.name_mal as pooja_mal,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm, diety.name as deity_name');
        	    	$this->db->from('billing_dtls');
        	    	$this->db->join('stars','stars.id = billing_dtls.star','left');
        	    	$this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    	$this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    	$this->db->where('billing_dtls.bill_id', $bill_id);
        	    	$this->db->where('pooja.pooja_cat', $cat->pooja_cat);
                	$this->db->where('billing_dtls.date', $pooja_date);
                	$this->db->group_by('billing_dtls.id');
        			$query = $this->db->get();
                
            		if ($query->num_rows() > 0) {
                		$bill_list[$pooja_date][$cat->pooja_cat] = $query->result_array();
            		}
                } 
            }
        
        	return $bill_list;
        }

		public function getBillPrintUser($bill_id) {
        	$this->db->select('billing.date as bill_date, admin.id as user_id, admin.name as admin_name, billing.bill_time as bill_time, counter.name as counter');
        	$this->db->from('billing');
        	$this->db->join('admin', 'admin.id=billing.user_id', 'LEFT');
        	$this->db->join('counter', 'billing.counter=counter.id', 'LEFT');
        	$this->db->where('billing.id', $bill_id);
        	$user = $this->db->get()->row();
        
        	return $user;
        }
    
    	public function getBillById($bill_id) {
    			$data = array();
        $query = $this->db->query("SELECT DISTINCT diety_id FROM billing_dtls WHERE bill_id = $bill_id");
    	$deities = $query->result_array();
    	foreach ($deities as $deity) {
    $da = $deity['diety_id'];
    $a = $this->db->query("SELECT DISTINCT date FROM billing_dtls WHERE bill_id = $bill_id AND diety_id = $da");
    $dates = $a->result_array();

    foreach ($dates as $dateArr) {
        $date = $dateArr['date'];
        $b = $this->db->query("SELECT DISTINCT pooja_cat FROM pooja WHERE id IN (SELECT pooja FROM billing_dtls WHERE bill_id = $bill_id AND diety_id = $da AND date = '$date')");
        $pooja_cat = $b->result_array();

        foreach ($pooja_cat as $id) {
            $this->db->select('billing_dtls.*, pooja.*, stars.name_mal as star_eng, pooja.name_mal as pooja_nm, billing_dtls.rate as pooja_rt, diety.name_mal as deity_nm,billing_dtls.name as name,pooja.name as pooja_ne,diety.name as diety_ne,billing_dtls.time');
            $this->db->from('billing_dtls');
            $this->db->join('stars', 'stars.id = billing_dtls.star', 'left');
            $this->db->join('pooja', 'pooja.id = billing_dtls.pooja');
            $this->db->join('diety', 'diety.id = billing_dtls.diety_id');
            $this->db->where('billing_dtls.bill_id', $bill_id);
            $this->db->where('pooja.pooja_cat', $id['pooja_cat']);
            $this->db->where('billing_dtls.date', $date);
            $this->db->where('billing_dtls.diety_id', $da);
            $result = $this->db->get()->result_array();
        	
        	$data[] = $result;
        }
    }
}

    
    			return $data;
    }
    
    public function getbillinguser($bill_id) {
        	$this->db->select('admin.id as user_id, admin.name as admin_name, billing.bill_time as bill_time, counter.name as counter');
        	$this->db->from('billing');
        	$this->db->join('admin', 'admin.id=billing.user_id', 'LEFT');
        	$this->db->join('counter', 'billing.counter=counter.id', 'LEFT');
        	$this->db->where('billing.id', $bill_id);
        	$user = $this->db->get()->row();
        
        	return $user;
        }
    
    	public function getScheduleBillById($bill_id) {
    			$data = array();
        $query = $this->db->query("SELECT DISTINCT diety_id FROM billing_dtls WHERE bill_id = $bill_id");
    	$deities = $query->result_array();
        
    	foreach ($deities as $deity) {
    $da = $deity['diety_id'];
    $a = $this->db->query("SELECT DISTINCT date FROM billing_dtls WHERE bill_id = $bill_id AND diety_id = $da");
    $dates = $a->result_array();

        $b = $this->db->query("SELECT DISTINCT pooja_cat FROM pooja WHERE id IN (SELECT pooja FROM billing_dtls WHERE bill_id = $bill_id AND diety_id = $da)");
        $pooja_cat = $b->result_array();

        foreach ($pooja_cat as $id) {
            $this->db->select("billing_dtls.*, pooja.*, SUM(billing_dtls.qlt) as qty, MIN(billing_dtls.date) as min_date, 
            				   MAX(billing_dtls.date) as max_date,  stars.name_mal as star_eng, pooja.name_mal as pooja_nm, 
                               billing_dtls.rate as pooja_rt, diety.name_mal as deity_nm,billing_dtls.name as name,
                               user_dtl.name as customer, CONCAT_WS('. ', user_dtl.house, user_dtl.street, user_dtl.post) AS address");
            $this->db->from('billing_dtls');
        	$this->db->join('billing', 'billing.id = billing_dtls.bill_id');
            $this->db->join('stars', 'stars.id = billing_dtls.star', 'left');
            $this->db->join('pooja', 'pooja.id = billing_dtls.pooja');
            $this->db->join('diety', 'diety.id = billing_dtls.diety_id');
        	$this->db->join('user_dtl', 'billing.customer_id = user_dtl.id');
            $this->db->where('billing_dtls.bill_id', $bill_id);
            $this->db->where('pooja.pooja_cat', $id['pooja_cat']);
            $this->db->where('billing_dtls.diety_id', $da);
        	$this->db->group_by('billing_dtls.name,billing_dtls.pooja');
            $result = $this->db->get()->result_array();
        	
        	$data[] = $result;
        }
    }


    
    			return $data;
    }
    
    public function get_last_receiptno($counter) {
     	$this->db->select('*');
     	$this->db->from('billing_dtls');
     	$this->db->join('billing', 'billing_dtls.bill_id=billing.id');
     	$this->db->where('billing.counter', $counter);
     	// $this->db->where('billing_dtls.type!=', 'S');
     	$this->db->order_by('billing_dtls.id', 'desc');
     	$this->db->limit(1);
     	$query = $this->db->get();
  		$row = $query->row();

     	if ($query->num_rows() > 0) {
            return $row->reciept_no;
        }
     }
    
     public function get_current_series($counter) {
    	$this->db->select('*');
     	$this->db->from('receipt_bookdtl');
     	$this->db->where('counter', $counter);
     	$this->db->where('book_status', 'Active');
     	$query = $this->db->get();
  		$row = $query->row();

     	if ($query->num_rows() > 0) {
            return $row;
        } else {
        	return 0;
        }
     }
    
    public function get_next_series($counter, $last_id) {
    	$this->db->select('*');
     	$this->db->from('receipt_bookdtl');
     	$this->db->where('counter', $counter);
    	$this->db->where('from_sl >', $last_id);
    	$this->db->where('book_status', 'Issued');
    	$this->db->order_by('id', 'desc');
     	$query = $this->db->get();
  		$row = $query->row();

     	if ($query->num_rows() > 0) {
            return $row;
        } else {
        	return 0;
        }
     }
    
     public function set_next_series($current_id, $next_id) {
     	$this->db->where('id', $current_id);
     	$this->db->update('receipt_bookdtl', array('book_status'=> 'Closed'));
        
        $this->db->where('id', $next_id);
       	$this->db->update('receipt_bookdtl', array('book_status'=> 'Active'));
     }
    
     public function  getTotalCollection($date=null){
     	$user_id = $this->loggedIn['id'];
     	$user_role = $this->loggedIn['role'];
     
     	$this->db->select('sum(billing.total) AS total, sum(billing.bal_amt) as totalcre');
		$this->db->from('billing');
     	
     	if($date) {
        	$this->db->where('date', $date);
        }
		
		$this->db->where('deleted', 0);
						
		if($user_role != 'superadmin') {
             $this->db->where('user_id', $user_id);
        }
     
		$total = $this->db->get()->row();
     
     	return $total;
     }
    
     public function getCurrentBillNo($year) {
     	$this->db->select('bill_year_no');
		$this->db->from('billing');
		$this->db->where('bill_year', $year);
		$this->db->order_by('bill_year_no', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
    		$row = $query->row();
    		$lastRecordId 	= $row->bill_year_no ;
        	$currentBillNo  = $lastRecordId + 1;
    	} else {
    		$currentBillNo = 1;
		}
     
     	return $currentBillNo;
     }
    
    	public function getadjustmentById($id){
            $this->db->select('adjustment.*, inv_product.name as product, inv_unit.name as unit, inv_product.price as rate');
            $this->db->from('adjustment');
        	$this->db->join('inv_product', 'adjustment.product_id = inv_product.id');
        	$this->db->join('inv_unit', 'adjustment.unit = inv_unit.id');
            $this->db->where('adjustment.id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    	public function getdatedstar($date, $dated_type, $end_year=null, $end_month=null){
            $dates = array();
        	
        	if ($dated_type == 'D') {
            	$dates[]['birth_date'] = $date;
            } else if ($dated_type == 'M') {
				$current_date = new DateTime($date);
            	$c_date		  = new DateTime($date);
            	while ($current_date->format('Y') < $end_year || ($current_date->format('Y') == $end_year && $current_date->format('n') <= $end_month)) {
					$dates[]['birth_date'] = $current_date->format('Y-m-d');
    				$current_month = $c_date->format('m');
					$c_date->modify('first day of next month');
					$next_month_number = $c_date->format('m');
                
    				if ($next_month_number == 2 ) {
            			$current_date->modify('last day of next month');
        			} else {
                    	$current_date->modify('+1 month');
                    }
                }
            } else if ($dated_type == 'Y') {
            	$current_date		  = new DateTime($date);
            	while ($current_date->format('Y') < $end_year || ($current_date->format('Y') == $end_year && $current_date->format('n') <= $end_month)) {
					$dates[]['birth_date'] = $current_date->format('Y-m-d');
    				$current_date->modify('+1 year');
					$current_year = $current_date->format('Y');
                }
            }
        
        	return $dates;
        }
    
    	public function book_room($data) {
        	$this->db->insert('room_bookings', $data);
    	}
    
    	public function getroomenquiries(){
            $this->db->select('*');
            $this->db->from('room_bookings');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
    
    	public function getroomenquiriesbydate($datef,$datet){
            $this->db->select('*');
            $this->db->from('room_bookings');
            $this->db->where("room_bookings.checkin_date BETWEEN '$datef' AND '$datet'");

          
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
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
    	
    public function getMembershipDetails($mobile_number, $membership_id) {
        $this->db->select('*');
        $this->db->from('memberships');
        $this->db->where('mobile_number', $mobile_number);
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
    
	public function getMembershipsByDateRange($datef, $datet, $search_term = '') {
    	$this->db->where('created_at >=', $datef);
    	$this->db->where('created_at <=', $datet);
    	if ($search_term) {
        	$this->db->group_start();
        	$this->db->like('name', $search_term);
        	$this->db->or_like('mobile_number', $search_term);
        	$this->db->or_like('membership_id', $search_term);
        	$this->db->group_end();
    	}
    	$this->db->order_by('created_at', 'desc'); 
    	$query = $this->db->get('memberships');

    	if ($query->num_rows() > 0) {
        	return $query->result();
    	} else {
        	return false;
    	}
	}

	public function getAllMemberships($search_term = '', $datef=null, $datet=null,$sponsered=null) {
    	if ($search_term) {
        	$this->db->group_start();
        	$this->db->like('memberships.name', $search_term);
        	$this->db->or_like('memberships.mobile_number', $search_term);
        	$this->db->or_like('memberships.membership_id', $search_term);
        	$this->db->group_end();
    	}
    	$this->db->select('memberships.*, payment_modes.name as mode, billing.id as bill_no, billing_dtls.date as pooja_date');
    	$this->db->join('membership_transactions', 'membership_transactions.membership_id=memberships.id');
    	$this->db->join('billing', 'membership_transactions.bill_id=billing.id');
    	$this->db->join('billing_dtls', 'billing_dtls.bill_id=billing.id');
    	$this->db->join('payment_modes', 'payment_modes.id=billing.mode', 'left');
    	 
    	if($datef && $datet) {
        	$this->db->where('memberships.created_at >=', $datef);
    		$this->db->where('memberships.created_at <=', $datet);
        }
		if ($this->db->field_exists('sponser', 'memberships')) {
		if($sponsered)
		{
			$this->db->where('memberships.sponser=', $sponsered);
		}
		}
    $this->db->where('billing.deleted','0');
    	$this->db->order_by('memberships.created_at', 'desc');
    
    	$query = $this->db->get('memberships');
//echo $this->db->last_query();
    	if ($query->num_rows() > 0) {
        	return $query->result();
    	} else {
        	return false;
    	}
	}

    
    public function get_email_addresses() {
        $this->db->select('name, email');
        $this->db->from('user_dtl');
        $query = $this->db->get();
        return $query->result_array();
    }

public function getbillsummurydatewise($from, $to, $diety, $type = null, $cat = null) {
    if ($type != null) {
        $where = " B.status='$type'";
    } else {
        $where = " B.status!='0'";
    }

    if ($diety != "0") {
        $where .= " AND A.diety_id='$diety'";
    }

    if ($cat != null) {
        $where .= " AND P.cat='$cat'";
    }

    // Added A.date to SELECT and GROUP BY
    $query = $this->db->query("SELECT A.date, A.bill_id, sum(A.qlt) AS quantity, A.pooja as pooja_id, B.status, P.name_mal AS pooja, min(A.rate) AS pooja_rt, d.name AS diety, B.total, sum(A.amount) as amount, B.mode as mode 
        FROM billing_dtls A 
        JOIN pooja P on A.pooja = P.id
        JOIN billing B on A.bill_id = B.id 
        JOIN diety d ON A.diety_id = d.id   
        WHERE A.date BETWEEN '$from' AND '$to' 
        AND B.deleted = '0' 
        AND A.rate > 0 
        AND $where 
        GROUP BY A.date, A.pooja, B.mode 
        ORDER BY A.date ASC, P.name ASC");

    if ($query->num_rows() > 0) {
        $result = $query->result();
        $summary = [];

        foreach ($result as $val) {
            $date = $val->date;
            $pooja_id = $val->pooja_id;
            $mode = $val->mode;

            // Grouping by Date first, then Pooja ID, then Mode
            if (isset($summary[$date][$pooja_id][$mode])) {
                $summary[$date][$pooja_id][$mode]['quantity'] += $val->quantity;
                $summary[$date][$pooja_id][$mode]['amount'] += $val->amount;
            } else {
                $summary[$date][$pooja_id][$mode] = [
                    'date' => $val->date,
                    'bill_id' => $val->bill_id,
                    'quantity' => $val->quantity,
                    'pooja' => $val->pooja,
                    'pooja_id' => $val->pooja_id,
                    'pooja_rt' => $val->pooja_rt,
                    'amount' => $val->amount,
                    'mode' => $val->mode
                ];
            }
        }

        $final_data = [];
        foreach ($summary as $date => $poojas) {
            foreach ($poojas as $pooja_id => $modes) {
                $qr = 0;
                $cash = 0;
                $quantity = 0;
                $amount = 0;

                foreach ($modes as $mode => $val) {
                    $quantity += $val['quantity'];
                    $amount += $val['amount'];
                    if ($mode == 1) $cash += $val['amount'];
                    if ($mode == 6) $qr += $val['amount'];
                }

                // Create record grouped by date and pooja
                $record = $val; // Takes the last mode's basic info
                $record['quantity'] = $quantity;
                $record['amount'] = $amount;
                $record['cash'] = $cash;
                $record['qr'] = $qr;

                // Store in a way that the view can easily loop by date
                $final_data[$date][] = $record;
            }
        }

        return $final_data;
    } else {
        return 0;
    }
}
    
    public function getBillListDatewise($from,$to,$diety,$type=null)
{
    if($type!=null){
        $where=" B.status='$type'";
    } else {
        $where=" B.status!='0'";
    }

    if($diety!="0"){
        $where.=" AND A.diety_id='$diety'";
    }

    $query = $this->db->query("
        SELECT
            B.date,
            A.pooja AS pooja_id,
            P.name_mal AS pooja,

            SUM(A.qlt) AS quantity,
            A.rate AS pooja_rt,
            SUM(A.postal_amt) AS postal_amt,
            SUM(A.amount) AS amt,

           
            SUM(CASE WHEN B.mode = 1 THEN A.amount ELSE 0 END) AS cash_amt,
            SUM(CASE WHEN B.mode = 6 THEN A.amount ELSE 0 END) AS upi_amt,
            SUM(CASE WHEN B.mode = 5 THEN A.amount ELSE 0 END) AS neft_amt,
            SUM(CASE WHEN B.mode = 7 THEN A.amount ELSE 0 END) AS card_amt,
            SUM(CASE WHEN B.mode = 8 THEN A.amount ELSE 0 END) AS mo_amt,

           
            SUM(CASE WHEN B.mode IN (1,8) THEN A.amount ELSE 0 END) AS cash_in_hand

        FROM billing_dtls A
        JOIN billing B ON A.bill_id = B.id
        JOIN pooja P ON A.pooja = P.id
        WHERE B.date BETWEEN '$from' AND '$to'
          AND B.deleted='0'
          AND $where
        GROUP BY B.date, A.pooja
        ORDER BY B.date,A.pooja
    ");

    if ($query->num_rows() == 0) {
        return [];
    }

    $result = $query->result();
	
    $data = [];
    foreach ($result as $row) {

        // maintain old structure
        $row->amount_array = [
            1 => $row->cash_amt,
            6 => $row->upi_amt,
            5 => $row->neft_amt,
            7 => $row->card_amt,
            8 => $row->mo_amt,
        ];

        // EXACT old logic
        $row->cash_in_hand = $row->cash_in_hand;

        $data[$row->date][$row->pooja_id] = $row;
    }

    return $data;
}
    
    
    }
    