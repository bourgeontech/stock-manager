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
            $this->db->where('password',$data['password']);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            else {
                return 0;
            }
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
        public function getBills($id){
            $this->db->select('*');
            $this->db->from('billing');
            $this->db->where('customer_id',$id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getCustomerBills(){
            $this->db->select('date,billing.customer_id,user_dtl.name as customername,user_dtl.mobile as customerphone,SUM(total) AS total,SUM(recv_amt) AS recv_amt', FALSE);
            $this->db->from('billing');
            $this->db->join('user_dtl', 'billing.customer_id = user_dtl.id');
            $this->db->group_by('billing.customer_id');
            $this->db->where('billing.deleted', '0');
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
            
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('user_dtl', $data);
            } else {
                $this->db->insert('user_dtl', $data);
                return $this->db->insert_id();
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
            $this->db->order_by('id');
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
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getbillingdtlsById($id){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->where('billing_dtls.bill_id', $id);
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
            $this->db->where('billing.status', $type);
            $this->db->where('billing.deleted', '0');
            if($bill!=null){
                $this->db->where('billing.id', $bill);
            }else{
                $this->db->where("billing.date BETWEEN '$keyword' AND '$dateto'");
            }
            if($user_id!=null){
                $this->db->where('billing.user_id', $user_id);
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
            $this->db->where('billing.status', $type);
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
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,diety.name as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            //$this->db->where('billing_dtls.date', $date);
            $this->db->where('billing_dtls.date =', $date);
            $this->db->where('billing.deleted', '0');
          
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
    
      public function getbillreport_poojawise($date,$dateto,$diety,$type=null,$ampm=null,$pooja){
            $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,diety.name as deity_nm');
            $this->db->from('billing_dtls');
            $this->db->join('diety','diety.id = billing_dtls.diety_id');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            //$this->db->where('billing_dtls.date', $date);
            $this->db->where('billing_dtls.date >=', $date);
            $this->db->where('billing_dtls.date <=', $dateto);
            $this->db->where('billing.deleted', '0');
            if($diety!='0'){
                $this->db->where('billing_dtls.diety_id', $diety);}
            if($type!=null){
                $this->db->where('billing.date <', $date);
            }
            if($ampm!=null){
                $this->db->where('billing_dtls.time =', $ampm);
            }
        if($pooja!=null){
                $this->db->where('billing_dtls.pooja =', $pooja);
            }
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
    
     public function getbillsummury($from,$to,$diety,$type=null){
            if($type!=null){
                $where=" B.status='$type'";
            }else{
                $where=" B.status!='0'";
            }
            if($diety!="0"){
                $where .=" AND A.diety_id='$diety'";
            }
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount  FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND B.deleted!='1' AND $where GROUP BY A.pooja");
            
            // $query = $this->db->get();
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
            $query=$this->db->query("SELECT C.*,A.bill_id,A.date as pooja_dt,A.name,A.time,B.date as booked_dt,B.status,P.name AS pooja,d.name AS diety FROM billing_dtls A JOIN pooja P on A.pooja=P.id
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
        
        public function getdetailview($from,$to,$diety,$type=null){
            if($type!=null){
                $where=" B.status='$type'";
            }else{
                $where=" B.status!='0'";
            }
            if($diety!="0"){
                $where .=" AND A.diety_id='$diety'";
            }
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,sum(A.postal_amt) as postal_amt,sum(A.amount) as amt,A.amount FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE B.date BETWEEN '$from' AND '$to'AND B.deleted!='1' AND $where GROUP BY A.pooja");
     
            
            // $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getregister($id,$from,$to,$type=null){
           
            if($type!=null){
                if($type=='GOLD'){
                    $cond=" pooja.name like 'GOLD%' or pooja.name like 'SWARNAM%'";
                } elseif($type=='SILVER'){
                    $cond=" pooja.name like 'SILVER%' or pooja.name like 'VELLI%'";
                }
                $where="$cond";
            }else{
                $where=" pooja.name!='GOLD' AND pooja.name!='SILVER'";
            }
            $query = $this->db->query("SELECT donation.*,pooja.name as poojaname FROM `donation` JOIN pooja on pooja.id=donation.pooja WHERE donation.date < '$from' AND donation.date > '$to' AND $where");
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
        
        public function mookkolakallu($datef=NULL,$datet=NULL){
            $this->db->select('billing_dtls.*,billing.date as booked_date,billing.customer_id as customer,stars.name_mal as star_eng');
            $this->db->from('billing_dtls');
            $this->db->join('stars','stars.id = billing_dtls.star');
            $this->db->join('billing','billing.id = billing_dtls.bill_id');
            $this->db->where('billing_dtls.pooja', '2000');
            if ($datef!=null && $datet!=null){
                $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
            }
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
            if ($query->num_rows() > 0) {
                $data = $query->row_array();
                $allowed_qty = $data['allowed_qty'];
                if($allowed_qty == 0){
                   return 0;
                }
                $this->db->select('SUM(id) as count');
                $this->db->from('billing_dtls');
                $this->db->where('date', $date);
                $this->db->where('pooja', $pooja_id);
                $query = $this->db->get();
                $d = $query->row_array();
        
                $current_qty = ($d['count'] !='') ? $d['count'] : 0;
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
            
            $this->db->select('billing_dtls.*,billing.number,birth_star.name_eng as starname,diety.name_mal as dietyname,pooja.name_mal as poojaname,billing.mode_date,billing.date as bill_date');
            $this->db->from('billing_dtls');
            $this->db->join('billing','billing_dtls.bill_id = billing.id');
            $this->db->join('pooja','billing_dtls.pooja = pooja.id');
            $this->db->join('birth_star','billing_dtls.star = birth_star.id');
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
        public function getscheduledpoojas($keyword=null){
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
      //      $where = '(pooja.pooja_cat="2" or pooja.pooja_cat = "3")';
         //   $this->db->where($where);
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
            $this->db->group_by('mdate');
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
       
    }
    