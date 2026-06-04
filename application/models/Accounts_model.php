<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
    class Accounts_model extends CI_Model {
        
        public function __construct() {
            parent::__construct();
            $this->date=date('Y-m-d');
        }
        
        
        //LEDGER
        
        public function getledger_group()
        {
            $query=$this->db->query("SELECT * FROM `ledger_group` where is_delete=0 order by group_name");
            return $query->result_array();
            
        }
        
        public function addLedgerGroup($data)
        {
            
            $res=$this->db->insert("ledger_group",$data);
            return $res;
            
        }
        public function updateLedgerGroup($id,$data)
        {
            $this->db->where('group_id',$id);
            $this->db->update("ledger_group",$data);
            return true;
        }
        
        public function addLedger($data)
        {
            
            $res=$this->db->insert("ledger",$data);
            return $res;
            
        }
        
        /**public function getledger(){
           
        
            $this->db->select('sum(amount) as lst_balance,ledger.name as name,payment.ledger as led_Id,ledger.created as created,ledger.group as group_id,ledger.name_mal as ledger_mal,ledger_group.group_name as group_name');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger','left');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
             $this->db->where('payment.is_delete',0);
            $this->db->group_by('payment.ledger'); 
            $this->db->order_by("ledger.name", "asc");
           $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        
        }**/
    
    public function getledger($keyword=null, $group=null,$datefrom=null,$dateto=null){
           /** $this->db->select('ledger.*,ledger_group.*,ledger.balance AS lst_balance,ledger.name_mal as ledger_mal');
            $this->db->from('ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->where('ledger.is_delete !=', 1);
           
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }*/

            $this->db->select('sum(amount) as lst_balance,ledger.name as name,payment.ledger as led_Id,ledger.created as created,ledger.group as group_id,ledger.name_mal as ledger_mal,ledger_group.group_name as group_name');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger','left');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            if ($keyword) {
                $this->db->like('name', $keyword);
            }

    		if ($group) {
                $this->db->where('ledger.group', $group);
            }
    if ($datefrom && $dateto) {
    $this->db->where('payment.payment_date >=', $datefrom);
    $this->db->where('payment.payment_date <=', $dateto);
}
             $this->db->where('payment.is_delete',0);
            $this->db->group_by('payment.ledger'); 
            $this->db->order_by("ledger.name", "asc");
           $query = $this->db->get();
    //echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        
        }
     public function ledgerlist(){
            $this->db->select('ledger.*,ledger_group.*,ledger.balance AS lst_balance,ledger.name_mal as ledger_mal');
            $this->db->from('ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->where('ledger.is_delete !=', 1);
     $this->db->where('ledger.`group` !=', 15);
           	$this->db->order_by("ledger.name", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
     }
        public function searchledger($date,$dateto){
            $this->db->select('ledger.*,ledger_group.*,SUM(payment.amount) AS lst_balance');
            $this->db->from('ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->join('payment', 'payment.ledger = ledger.led_Id');
            $this->db->where('ledger.is_delete !=', 1);
            $this->db->where("payment.payment_date BETWEEN '$date' AND '$dateto'");
            $this->db->where('ledger_group.group_name !=', 'bank');
            $this->db->where('ledger_group.group_name !=', 'cash');
            $this->db->group_by('ledger.led_id');
        $this->db->order_by("ledger.name", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getledgerGroup(){
            $this->db->select('*');
            $this->db->from('ledger');
            $this->db->group_by('group');
            $this->db->where('is_delete !=', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
    
//     	from ledger_group table
    	public function getledgergroups(){
            $this->db->select('*');
            $this->db->from('ledger_group');
            $this->db->where('is_delete !=', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getLedgerByKeyword(){
            
            $keyword = $this->input->post('keyword');
            if($keyword!=''){
                $this->db->select('*');
                $this->db->from('ledger');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                $this->db->where("ledger.group LIKE '$keyword%'");
                $this->db->where('ledger.is_delete !=', 1);
                
            }
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function deleteLedger($id){
            
            $data = array(
                'is_delete'         =>1,
                
            );
            $this->db->where('led_Id', $id);
            $result=$this->db->update('ledger',$data);
            return $result;
        }
        
        //RECEIPT
        
        
      /**  public function getmode(){
            
            $query = $this->db->query("SELECT ledger.*, ledger_group.*
	FROM ledger
	INNER JOIN ledger_group
	ON ledger.group=ledger_group.group_id WHERE ledger.is_delete != 1 AND ledger_group.group_name = 'cash' OR ledger_group.group_name = 'bank' ");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        **/
    public function getmode(){
            
            $query = $this->db->query("SELECT ledger.*, ledger_group.*
	FROM ledger
	INNER JOIN ledger_group
	ON ledger.group=ledger_group.group_id WHERE ledger.is_delete != 1 AND ledger_group.group_name = 'cash' OR ledger_group.group_name = 'bank' ");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
public function getmodeamnt(){
            
            $query = $this->db->query("SELECT ledger.*, ledger_group.* FROM ledger INNER JOIN ledger_group ON ledger.group=ledger_group.group_id WHERE ledger.is_delete != 1 AND ledger.group='3' OR ledger.group='2'");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function addReceipt($data)
        {
            
            $res=$this->db->insert("receipt",$data);
            return $res;
            
        }
        public function getlastRecId(){
            $query = $this->db->query("SELECT voucher_no FROM `payment` WHERE type=2 ORDER BY pay_Id desc limit 1");
            return $query->row_array();
        }
    	public function getlastPaymentId(){
            $query = $this->db->query("SELECT voucher_no FROM `payment` WHERE type=1 ORDER BY pay_Id desc limit 1");
            return $query->row_array();
        }
        public function getReceipt(){
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->where('payment.is_delete !=', 1);
            $this->db->where('payment.type', 2);
            $this->db->order_by('payment.payment_date','asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getReceiptData($id){
            
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->where('payment.pay_Id ', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getReceiptByKeyword(){
            $search_date=$this->input->post('search');
			$search_dateto=$this->input->post('searchto');
            $convertDate = date("Y-m-d", strtotime($search_date));
			$convertDateto = date("Y-m-d", strtotime($search_dateto));
            $keyword = $this->input->post('keyword');
        	$this->db->select('*');
                $this->db->from('payment');
                $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            if($search_date!='' and $search_dateto!=''){
                 $this->db->where('payment.payment_date >=', $convertDate);
				$this->db->where('payment.payment_date <=', $convertDateto);
                $this->db->where('payment.type !=', 1);
                $this->db->where('payment.is_delete !=', 1);
            	$this->db->order_by("payment_date", "asc");
                
                
                // $this->db->limit($limit, $start);
            }
            elseif($keyword!=''){
              $this->db->where('payment.type !=', 1);
                $this->db->where("payment.ledger", $keyword);
                //$this->db->where("payment.ledger LIKE '$keyword%'");
            	$this->db->where('payment.is_delete !=', 1);
				$this->db->order_by("payment_date", "asc");
                
                
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function deleteReceipt($id){
        
           
            $query = $this->db->query("SELECT amount,ref_no FROM payment where pay_Id='$id'");
            $row = $query->row();
            $amount=$row->amount;
            $refno=$row->ref_no;
        	$user_id = $this->loggedIn['id'];
            $data = array(
                'is_delete'  => 1,
                'deleted_by' => $user_id,
            );
            $this->db->where('pay_Id', $id);
            $result=$this->db->update('payment',$data);
        if($refno!='')
        {
       // print "update billing set recv_amt=recv_amt-$amount,bal_amt=bal_amt+$amount where id=$refno";exit;
              $this->db->query("update billing set recv_amt=recv_amt-$amount,bal_amt=bal_amt+$amount where id=$refno");
        }
            return $result;
        }
        
        //PAYMENT
        
        public function getcash_bank(){
            $query = $this->db->query("SELECT * FROM ledger where ledger.`group`='2' or ledger.group='3'");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getPayment(){
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->where('payment.is_delete !=', 1);
            $this->db->where('payment.type', 1);
           $this->db->order_by('payment.payment_date','asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        public function getPaymentData($id){
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->where('payment.pay_Id ', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getPaymentByKeyword(){
            $search_date=$this->input->post('search');
			$search_dateto=$this->input->post('searchto');
            $convertDate = date("Y-m-d", strtotime($search_date));
			$convertDateto = date("Y-m-d", strtotime($search_dateto));
            $keyword = $this->input->post('keyword');
            if($search_date!='' and $search_dateto!=''){
                // $this->db->where('customer.department',$category);
                // SELECT EXTRACT(YEAR_MONTH FROM "202-09-29 00:00:00")
                $this->db->select('payment.*,ledger.name');
                $this->db->from('payment');
                $this->db->where('payment.payment_date >=', $convertDate);
				$this->db->where('payment.payment_date <=', $convertDateto);
                $this->db->where('payment.type !=', 2);
                $this->db->where('payment.is_delete !=', 1);
                $this->db->join('ledger', 'payment.ledger = ledger.led_Id');
                // $this->db->limit($limit, $start);
            }
            elseif($keyword!=''){
                $this->db->select('payment.*,ledger.name');
                $this->db->from('payment');
             	$this->db->where('payment.type !=', 2);
                $this->db->where("payment.ledger", $keyword);
                $this->db->where('payment.is_delete !=', 1);
                $this->db->join('ledger', 'payment.ledger = ledger.led_Id');
                
            }
			 $this->db->order_by("payment.payment_date", "asc");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function deletePayment($id){
            
            $user_id = $this->loggedIn['id'];
            $data = array(
                'is_delete'  => 1,
                'deleted_by' => $user_id,
            );
            $this->db->where('pay_Id', $id);
            $result=$this->db->update('payment',$data);
            return $result;
        }
        
        //REPORT
        
        public function dayBook(){
            
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->where('payment.is_delete !=', 1);
            $this->db->order_by('payment.pay_Id','desc');
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function searchDayBook(){
            
            $search_date=$this->input->post('search');
            $convertDate = date("Y-m-d", strtotime($search_date));
            
            
            if($search_date!=''){
                // $this->db->where('customer.department',$category);
                // SELECT EXTRACT(YEAR_MONTH FROM "202-09-29 00:00:00")
                $this->db->select('*');
                $this->db->from('payment');
                $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                $this->db->where('payment.payment_date',$convertDate);
                $this->db->where('payment.is_delete !=', 1);
                
                
                // $this->db->limit($limit, $start);
            }
            
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getincomeExpense(){
            
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->where('payment.is_delete !=', 1);
         
            $this->db->order_by('payment.pay_Id','desc');
            $this->db->last_query(); 
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        
        public function ledgerWiseReport($id){
            
            
            $query = $this->db->query("select `group` from ledger where led_Id='$id'");
            $row = $query->row();
            if($row->group=='2' or $row->group=='3')
            {
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->where('payment.ledger', $id);
            $this->db->where('payment.is_delete','0');
         //    $this->db->where('payment.payment_date<=','2025-08-16'); // adjusted by priyesh for kattakambal
            $this->db->order_by("payment.payment_date", "asc");
        }
        else
         {
       // print_r($_REQUEST);
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->where('payment.ledger', $id);
            $this->db->where('payment.is_delete','0');
           // $this->db->where('payment.payment_date<=','2025-08-16');
            $this->db->order_by("payment.payment_date", "asc");
        
        }
           //  $query = $this->db->query("SELECT *  FROM `payment` where ledger=$id");
         //   if ($query->num_rows() > 0) {
             //   return $query->result_array();
          //  }
          //  else {
          //  }
            // $this->db->group_by('ledger.name');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function searchLedgerWiseReport($id)
        {
            $search_date=$this->input->post('search');
            $search_date1=$this->input->post('search1');
            $convertDate = date("Y-m-d", strtotime($search_date));
            $convertDate1 = date("Y-m-d", strtotime($search_date1));
            $keyword = $this->input->post('keyword');
            $type = $this->input->post('type');
            $query = $this->db->query("select `group` from ledger where led_Id='$id'");
            $row = $query->row();
           
        
          	
            if($search_date!=''){
                // $this->db->where('customer.department',$category);
                // SELECT EXTRACT(YEAR_MONTH FROM "202-09-29 00:00:00")
              if($row->group=='2' or $row->group=='3')
            {
             $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
         
        
           //  $query = $this->db->query("SELECT *  FROM `payment` where ledger=$id");
         //   if ($query->num_rows() > 0) {
             //   return $query->result_array();
          //  }
          //  else {
          //  }
            // $this->db->group_by('ledger.name');

          $this->db->where("payment.payment_date BETWEEN '$convertDate' AND '$convertDate1'");
          $this->db->where('payment.mode', $id);
          $this->db->where('payment.is_delete','0');
          $this->db->order_by("payment.payment_date", "asc");
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
              }
            else
            {
             $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
         
        
           //  $query = $this->db->query("SELECT *  FROM `payment` where ledger=$id");
         //   if ($query->num_rows() > 0) {
             //   return $query->result_array();
          //  }
          //  else {
          //  }
            // $this->db->group_by('ledger.name');
          
                $this->db->where("payment.payment_date BETWEEN '$convertDate' AND '$convertDate1'");
                $this->db->where('payment.ledger', $id);
                $this->db->where('payment.is_delete','0');
                $this->db->order_by("payment.payment_date", "asc");
                $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        
            }
                // $this->db->limit($limit, $start);
            }
            elseif($type!=''){
            
            
                if($row->group=='2' or $row->group=='3')
            {
               $this->db->select('*');
                $this->db->from('payment');
                $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                $this->db->where("payment.type LIKE '$type%'");
                $this->db->where('payment.mode', $id);
                $this->db->where('payment.is_delete','0');
                $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
          
                }
            else
            {
              //  print_r($_REQUEST);exit;
                $this->db->select('*');
                $this->db->from('payment');
                $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                $this->db->where("payment.type LIKE '$type%'");
                $this->db->where('payment.ledger', $id);
               // $this->db->where('payment.payment_date', $id);
                $this->db->where('payment.is_delete','0');
            	$query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
            }
            
            
            }
            
        }
        
        
        
        
        public function getreceiptReport(){
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->where('payment.is_delete !=', 1);
            $this->db->where('payment.type', 2);
            // $this->db->group_by('ledger.name');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getreceiptTotal(){
            $query = $this->db->query("SELECT SUM(amount) as amt FROM `payment` where type=2 AND is_delete!=1");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getpaymentReport(){
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
            $this->db->where('payment.is_delete !=', 1);
            $this->db->where('payment.type', 1);
            // $this->db->group_by('ledger.name');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getpaymentTotal(){
            $query = $this->db->query("SELECT SUM(amount) as amt FROM `payment` where type=1 AND is_delete!=1");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        
        public function getincomeExpenseSearch(){
            $search_date=$this->input->post('search');
            $convertDate = date("Y-m-d", strtotime($search_date));
            $keyword = $this->input->post('keyword');
            $type = $this->input->post('type');
            if($search_date!=''){
                // $this->db->where('customer.department',$category);
                // SELECT EXTRACT(YEAR_MONTH FROM "202-09-29 00:00:00")
                $this->db->select('*');
                $this->db->from('payment');
                $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                $this->db->where('payment.payment_date',$convertDate);
                $this->db->where('payment.is_delete !=', 1);
                
                
                // $this->db->limit($limit, $start);
            }
            elseif($keyword!=''){
                $this->db->select('*');
                $this->db->from('payment');
                $this->db->where("payment.ledger LIKE '$keyword%'");
                $this->db->where('payment.is_delete !=', 1);
                $this->db->join('ledger', 'payment.ledger = ledger.led_Id');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                
            }
            elseif($type!=''){
                $this->db->select('*');
                $this->db->from('payment');
                $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                $this->db->where("payment.type LIKE '$type%'");
                $this->db->where('payment.is_delete !=', 1);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function getincomeExpenseSearch1(){
            $search_date=$this->input->post('search');
            $convertDate = date("Y-m-d", strtotime($search_date));
            $search_date1=$this->input->post('search1');
            $convertDate1 = date("Y-m-d", strtotime($search_date1));
            $keyword = $this->input->post('keyword');
            $type = $this->input->post('type');
            if($search_date!=''){
                // $this->db->where('customer.department',$category);
                // SELECT EXTRACT(YEAR_MONTH FROM "202-09-29 00:00:00")
                /*commented 8-9-2025
                $this->db->select('payment.*,sum(payment.amount) as amount,ledger.*,ledger_group.*');
                $this->db->from('payment');
                $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                $this->db->where("payment.payment_date BETWEEN '$convertDate' AND '$convertDate1'");
                $this->db->where('payment.is_delete !=', 1);
             $this->db->where('payment.type !=', 3);
                $this->db->where('ledger.group !=', 2);
                $this->db->where('ledger.group !=', 3);
             $this->db->order_by('payment.type');
                $this->db->group_by('payment.ledger'); 
                
                */
            
                	$this->db->select('ledger.led_Id, ledger.name, ledger_group.group_name,
    				SUM(CASE WHEN payment.type = 2 THEN payment.amount ELSE 0 END) AS total_receipts,
    				SUM(CASE WHEN payment.type = 1 THEN payment.amount ELSE 0 END) AS total_payments'
					);
					$this->db->from('payment');
					$this->db->join('ledger', 'ledger.led_Id = payment.ledger');
					$this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
					$this->db->where("payment.payment_date BETWEEN '$convertDate' AND '$convertDate1'");
					$this->db->where('payment.is_delete !=', 1);
					$this->db->where('payment.type !=', 3);
					$this->db->where('ledger.group !=', 2);
					$this->db->where('ledger.group !=', 3);
					$this->db->group_by('payment.ledger');
					$this->db->order_by('ledger.name');
            
                //$this->db->last_query();
                // $this->db->limit($limit, $start);
            }
            elseif($keyword!=''){
                $this->db->select('*');
                $this->db->from('payment');
                $this->db->where("payment.ledger LIKE '$keyword%'");
                $this->db->where('payment.is_delete !=', 1);
                $this->db->join('ledger', 'payment.ledger = ledger.led_Id');
                  $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
               $this->db->where('ledger.group !=', 2);
                $this->db->where('ledger.group !=', 3);   
             $this->db->order_by('payment.type');
                $this->db->group_by('payment.ledger'); 
                
            }
            elseif($type!=''){
                $this->db->select('*');
                $this->db->from('payment');
                $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
                $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
                $this->db->where("payment.type LIKE '$type%'");
                $this->db->where('payment.is_delete !=', 1);
             $this->db->where('ledger.group !=', 2);
                $this->db->where('ledger.group !=', 3);
             $this->db->order_by('payment.type');
                $this->db->group_by('payment.ledger'); 
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
        public function addContact($data)
        {
            
            $this->db->select('payment.*,receipt.*,ledger.*');
            $this->db->from('payment');
            $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
            $this->db->join('receipt', 'receipt.led_Id = payment.ledger');
            $this->db->where('payment.is_delete !=', 1);
            $this->db->where('receipt.is_delete !=', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
            
        }
        
        /**public function getincome()
        {
            $today=date('Y-m-d');
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE B.date='$today'  GROUP BY A.pooja");
      
      
       
            //             $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
            
        }**/
    
     public function getincome()
        {
            $today=date('Y-m-d');
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount,B.recv_amt 
                                     FROM billing_dtls A 
                                     JOIN pooja P on A.pooja=P.id
                                     JOIN billing B on A.bill_id=B.id 
                                     JOIN diety d ON A.diety_id=d.id 
                                     WHERE B.date='$today'  
                                     AND B.deleted='0'  
                                     GROUP BY A.pooja");
    
      
       
            //             $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
            
        }
    public function getincomeByDate($date)
        {
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name_mal AS pooja,A.rate AS pooja_rt,d.name AS diety,B.total,sum(A.amount) as amount,B.recv_amt 
                                     FROM billing_dtls A 
                                     JOIN pooja P on A.pooja=P.id
                                     JOIN billing B on A.bill_id=B.id 
                                     JOIN diety d ON A.diety_id=d.id 
                                     WHERE B.date='$date' 
                                     AND B.deleted='0'  
                                     GROUP BY A.pooja");
    
      
       
            //             $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
            
        }
    public function getrecvdamount()
    {
     $today=date('Y-m-d');
    $query=$this->db->query("select sum(recv_amt) as rec from billing where deleted='0' AND date='$today'");
   
  
$ret = $query->row();
return $ret->rec;
    
    }
    
    public function getrecvdamountByDate($date)
    {
    $query=$this->db->query("select sum(recv_amt) as rec from billing where deleted='0' AND date='$date'");
    //print "select sum(recv_amt) as rec from billing where deleted='0' AND date='$date'";exit;
   
  
$ret = $query->row();
return $ret->rec;
    
    }
    
    public function getamountbymode() {
    	$today=date('Y-m-d');
    	$query=$this->db->query("select sum(recv_amt) as rec, mode from billing where deleted='0' AND date='$today' GROUP BY mode");
   
		$ret = $query->result_array();
		return $ret;
    }
    
//     public function getAmountByPaymentMode($date) {
//     	// $query=$this->db->query("select sum(recv_amt) as rec, mode from billing where deleted='0' AND date='$today' GROUP BY mode");
   
//     	$this->db->select('sum(billing.recv_amt) as received, payment_modes.name as mode_name, payment_modes.slug as slug, billing.mode as mode');
//     	$this->db->from('billing');
//     	$this->db->join('payment_modes', 'payment_modes.id=billing.mode', 'left');
//     	$this->db->where('billing.date', $date);
//     	$this->db->where('billing.deleted', 0);
//     	$query = $this->db->get();
// 		$ret = $query->result_array();
// 		return $ret;
//     }
    
    public function getLedgerModes() {
    	$this->db->select('*');
    	$this->db->from('ledger_modes');
    	$query = $this->db->get();
    	$ledger_modes = $query->result();
    
    	return $ledger_modes;
    }
    
    public function getLedgerModeByModeId($mode_id) {
    	$this->db->select('*');
    	$this->db->from('ledger_modes');
    	$this->db->where('mode_id', $mode_id);
    	$query = $this->db->get();
    	$ledger_mode = $query->row();
    
    	return $ledger_mode;
    }
    
    public function getLedgerById($ledger_id) {
    	$this->db->select('*');
    	$this->db->from('ledger');
    	$this->db->where('led_Id', $ledger_id);
    	$query = $this->db->get();
    	$ledger = $query->row();
    
    	return $ledger;
    }
    
    public function getPaymentModeById($mode_id) {
    	$this->db->select('*');
    	$this->db->from('payment_modes');
    	$this->db->where('id', $mode_id);
    	$query = $this->db->get();
    	$mode = $query->row();
    
    	return $mode;
    }
    
    public function getamountbymodeByDate($date) {
    	$query=$this->db->query("select sum(recv_amt) as rec, mode from billing where deleted='0' AND date='$date' GROUP BY mode");
    print "select sum(recv_amt) as rec, mode from billing where deleted='0' AND date='$date' GROUP BY mode";
   
		$ret = $query->result_array();
		return $ret;
    }
        
        public function getonlineincome()
        {
            $today=date('Y-m-d');
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name AS pooja,A.rate AS pooja_rt,d.name AS diety FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE B.date='$today' AND B.status='2' AND B.deleted='0' GROUP BY A.pooja");
            //             $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
            
        }
    
    	public function getonlineincomeByDate($date)
        {
            $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,A.pooja as pooja_id,B.status,P.name AS pooja,A.rate AS pooja_rt,d.name AS diety FROM billing_dtls A JOIN pooja P on A.pooja=P.id
        JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE B.date='$date' AND B.status='2' AND B.deleted='0' GROUP BY A.pooja");
            //             $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
            
        }
        
        public function getjournalandcontra($type){
            $this->db->select('*');
            $this->db->from('journal');
            $this->db->join('ledger', 'ledger.led_Id = journal.ledger');
            $this->db->where('journal.is_delete !=', 1);
            $this->db->where('journal.type', $type);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }
        
      function getopeningbalance($ledgerid)
       {
            
            $search_date=$this->input->post('search');
            $search_date1=$this->input->post('search1');
            $convertDate = date("Y-m-d", strtotime($search_date));
            $convertDate1 = date("Y-m-d", strtotime($search_date1));
      
            $query = $this->db->query("select `group` from ledger where led_Id='$ledgerid'");
            $row2 = $query->row();
          if($search_date!=''){
           
           
      
            /** $this->db->select('sum(payment.amount) as amount');
             $this->db->from('payment');
             $this->db->where('payment.ledger', $ledgerid);        
             $this->db->where("payment.payment_date < '$convertDate'");
             $this->db->where("payment.type = '1'");
        
           
          
             $this->db->order_by("payment.payment_date", "asc");
             return $this->db->get()->row()->amount;*/
                if($row2->group=='2' or $row2->group=='3'){
   			    $query= $this->db->query("select sum(amount) as debit from payment where type=1 and mode=$ledgerid 
    			and payment.payment_date <'$convertDate' and payment.is_delete=0");}else{ $query= $this->db->query("select sum(amount) as debit from payment where type=1 and ledger=$ledgerid 
    			and payment.payment_date <'$convertDate' and payment.is_delete=0");}
          
      
      $row = $query->row();
      $debit=$row->debit;
       if($row2->group=='2' or $row2->group=='3'){
        $query2= $this->db->query("select sum(amount) as credit from payment where type=2 and mode=$ledgerid 
    and payment.payment_date <'$convertDate' and payment.is_delete=0");}else{$query2= $this->db->query("select sum(amount) as credit from payment where type=2 and ledger=$ledgerid 
    and payment.payment_date <'$convertDate' and payment.is_delete=0");}
          
      
      $row2 = $query2->row();
       
      $credit=$row2->credit;
      $balance=$credit-$debit;
            $balance=$credit-$debit;
      
           return number_format($balance,2,'.','');  
            
         
       }
      	  else 
      {
      
        if($row2->group=='2' or $row2->group=='3'){
     		$query3= $this->db->query("select sum(amount) as debit from payment where type=3 and mode=$ledgerid and payment.is_delete=0");
       }else{
       		$query3= $this->db->query("select sum(amount) as debit from payment where type=3 and ledger=$ledgerid and payment.is_delete=0");
       }
      
      
      $row3 = $query3->row();
      
      $opening=$row3->debit;
             /**$this->db->select('sum(payment.amount) as amount');
             $this->db->from('payment');
             $this->db->where('payment.ledger', $ledgerid); 
             $this->db->order_by("payment.payment_date", "asc");*/
       if($row2->group=='2' or $row2->group=='3'){
     		$query= $this->db->query("select sum(amount) as debit from payment where type=1 and mode=$ledgerid and payment.is_delete=0");
       }else{
       		$query= $this->db->query("select sum(amount) as debit from payment where type=1 and ledger=$ledgerid and payment.is_delete=0");
       }
      
      
      $row = $query->row();
      
      $debit=$row->debit;
        if($row2->group=='2' or $row2->group=='3'){
        $query2= $this->db->query("select sum(amount) as credit from payment where type=2 and mode=$ledgerid and payment.is_delete=0 ");
        }else{$query2= $this->db->query("select sum(amount) as credit from payment where type=2 and ledger=$ledgerid and payment.is_delete=0 ");}
      
      $row2 = $query2->row();
       
      $credit=$row2->credit;
          
          
          
      $balance=$opening+$credit-$debit;
     
             return "0";     
            
      }
        
        
    }
       function getclosingbalance($ledgerid)
       {
            
            $search_date=$this->input->post('search');
            $search_date1=$this->input->post('search1');
            $convertDate = date("Y-m-d", strtotime($search_date));
            $convertDate1 = date("Y-m-d", strtotime($search_date1));
         $query = $this->db->query("select `group` from ledger where led_Id='$ledgerid'");
            $row2 = $query->row();
          if($search_date!=''){
           
           
      
            /** $this->db->select('sum(payment.amount) as amount');
             $this->db->from('payment');
             $this->db->where('payment.ledger', $ledgerid);        
             $this->db->where("payment.payment_date < '$convertDate'");
             $this->db->where("payment.type = '1'");
        
           
          
             $this->db->order_by("payment.payment_date", "asc");
             return $this->db->get()->row()->amount;*/
           if($row2->group=='2' or $row2->group=='3'){
   			 $query= $this->db->query("select sum(amount) as debit from payment where type=1 and mode=$ledgerid 
    			and payment.payment_date  BETWEEN '$convertDate' AND '$convertDate1' and payment.is_delete=0");}else{ $query= $this->db->query("select sum(amount) as debit from payment where type=1 and ledger=$ledgerid 
    			and payment.payment_date  BETWEEN '$convertDate' AND '$convertDate1' and payment.is_delete=0");}
          
      
      $row = $query->row();
      $debit=$row->debit;
         if($row2->group=='2' or $row2->group=='3'){
      
        $query2= $this->db->query("select sum(amount) as credit from payment where type=2 and mode=$ledgerid 
    and payment.payment_date BETWEEN '$convertDate' AND '$convertDate1' and payment.is_delete=0");}else{  $query2=$this->db->query("select sum(amount) as credit from payment where type=2 and ledger=$ledgerid 
    and payment.payment_date BETWEEN '$convertDate' AND '$convertDate1' and payment.is_delete=0");}
          
      
      $row2 = $query2->row();
       
      $credit=$row2->credit;
      $balance=$credit-$debit;
      return number_format($balance,2,'.','');     
            
         
       }
      else 
      {
             /**$this->db->select('sum(payment.amount) as amount');
             $this->db->from('payment');
             $this->db->where('payment.ledger', $ledgerid); 
             $this->db->order_by("payment.payment_date", "asc");*/
         if($row2->group=='2' or $row2->group=='3'){
     $query= $this->db->query("select sum(amount) as debit from payment where type=1 and mode=$ledgerid and is_delete=0");}else{
          $query= $this->db->query("select sum(amount) as debit from payment where type=1 and ledger=$ledgerid and is_delete=0");}
          
      
      $row = $query->row();
      $debit=$row->debit;
        if($row2->group=='2' or $row2->group=='3'){
        $query2= $this->db->query("select sum(amount) as credit from payment where type=2 and mode=$ledgerid and is_delete=0");}else{ $query2= $this->db->query("select sum(amount) as credit from payment where type=2 and ledger=$ledgerid and is_delete=0");}
          
      
      $row2 = $query2->row();
       
      $credit=$row2->credit;
      $balance=$credit-$debit;
           return number_format($balance,2,'.','');   
            
      }
        
        
    }
    
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
    
    // Received Amount By Date
	public function getReceivedAmountByDate($date) {
   
    	$this->db->select('recv_amt as rec');
        $this->db->from('billing');
        $this->db->join('billing_dtls', 'billing_dtls.bill_id=billing.id');
		$this->db->where('billing.deleted', 0);
    	$this->db->where('billing_dtls.deleted', 0);
        $this->db->where('billing.date', $date);
		$this->db->group_by('billing.id');
        $query = $this->db->get();

        // Fetching the result
        $result = $query->result();
        $received = 0;
    	foreach($result as $val) {
        	$received += $val->rec;
        }
    
    	return $received;
    }
    
    // Modes and amounts by date
	public function getAmountByModeDate($date) {
    	$this->db->select('billing.recv_amt as rec');
		$this->db->select('mode, payment_modes.name as mode_name');
		$this->db->from('billing');
    	$this->db->join('billing_dtls', 'billing_dtls.bill_id=billing.id');
    	$this->db->join('payment_modes', 'payment_modes.id=billing.mode');
		$this->db->where('billing.deleted', 0);
    	$this->db->where('billing_dtls.deleted', 0);
		$this->db->where('billing.date', $date);
		$this->db->group_by('billing.id');

		$query = $this->db->get();

		$result = $query->result();
    
    	$arr    	= [];
    	$modes = [];
    	foreach($result as $val) {
        	if(!isset($arr[$val->mode])) {
            	$arr[$val->mode] 		  = 0;
            	$modes[$val->mode] = $val->mode_name;
            }
        
        	$arr[$val->mode] += $val->rec;
        }

    	return array($arr, $modes);
    }
    
    // Online income by date
	public function getOnlineIncomeByDate1($date) {
    	$this->db->select('A.bill_id, sum(A.qlt) AS quantity, A.pooja AS pooja_id, B.status, P.name AS pooja, A.rate AS pooja_rt, d.name AS diety');
		$this->db->from('billing_dtls A');
		$this->db->join('pooja P', 'A.pooja = P.id');
		$this->db->join('billing B', 'A.bill_id = B.id');
		$this->db->join('diety d', 'A.diety_id = d.id');
		$this->db->where('B.date', $date);
		$this->db->where('B.status', '2');
		$this->db->where('B.deleted', 0);
    	$this->db->where('A.deleted', 0);
		$this->db->group_by('A.pooja');

		$query = $this->db->get();

    	$result = $query->result();
    
    	return $result;
    }

	// Get Income by Pooja Cat
	public function getAmountByPoojaCatDate($date) {
    	if(!$this->db->table_exists('counter_banks')) {
        	redirect('accounts/createCounterBanks');
        }
    	/*$this->db->select('billing.counter as counter, counter.name as counter_name, cat.name as cat, cat.id as cat_id, payment_modes.id as mode_id, payment_modes.name as mode, payment_modes.slug as mode_slug, counter_banks.ledger_id');
    	$this->db->select('billing.recv_amt as rec');
		$this->db->from('billing');
    	$this->db->join('counter', 'counter.id=billing.counter');
    	$this->db->join('counter_banks', 'counter.id=counter_banks.counter_id', 'left');
    	$this->db->join('billing_dtls', 'billing_dtls.bill_id=billing.id', 'left');
    	$this->db->join('pooja', 'billing_dtls.pooja=pooja.id', 'left');
    	$this->db->join('cat', 'pooja.cat=cat.id');
    	$this->db->join('payment_modes', 'billing.mode=payment_modes.id');
		$this->db->where('billing.deleted', 0);
    	$this->db->where('billing_dtls.deleted', 0);
		$this->db->where('billing.date', $date);
    	$this->db->order_by('cat.id, billing.mode, billing.counter');
		$this->db->group_by('billing.id');*/
       $query=$this->db->query(" 
    SELECT SUM(billing_dtls.amount) AS rec, `billing`.`mode`, `pooja`.`cat` AS `cat_id`, `pooja`.`pooja_cat`, `payment_modes`.`id` AS `mode_id`, `payment_modes`.`name` AS `mode_name`, `payment_modes`.`slug` AS `mode_slug`, `counter`.`name` AS `counter_name`, `counter`.`id` AS `counter`, `cat`.`name` AS `cat`, counter_banks.ledger_id FROM billing_dtls JOIN billing ON billing_dtls.bill_id = billing.id JOIN pooja ON billing_dtls.pooja = pooja.id JOIN payment_modes ON billing.mode = payment_modes.id JOIN counter ON billing.counter = counter.id JOIN cat ON pooja.cat = cat.id LEFT JOIN counter_banks ON counter.id = counter_banks.counter_id
    WHERE billing.date = '$date' and billing.deleted=0 GROUP BY billing.counter, `pooja`.`cat`, `billing`.`mode` ORDER BY `pooja`.`cat`");

		

		$result = $query->result();
    
    	$arr    	= [];
    	$categories = [];
    	$ids		= [];
    	$cash		= [];
    	foreach($result as $val) {
        	 if($val->mode_slug == 'cash') {
             	if(!isset($cash[$val->cat_id])) {
            		$cash[$val->cat_id]['category']	  = $val->cat." - ".$val->mode;
            		$cash[$val->cat_id]['amount'] 	  = 0;
                	$cash[$val->cat_id]['mode_id']    = $val->mode_id;
            		$cash[$val->cat_id]['cat_id']     = $val->cat_id;
             		$cash[$val->cat_id]['counter_id'] = $val->counter;
                }
             
             	$cash[$val->cat_id]['amount'] += $val->rec;
             } else {
        	 	if(!isset($arr[$val->cat_id."-".$val->mode_id."-".$val->counter])) {
            		$categories[$val->cat_id."-".$val->mode_id."-".$val->counter]	  = $val->cat." - ".$val->mode." - ".$val->counter_name;
            		$arr[$val->cat_id."-".$val->mode_id."-".$val->counter]	          = 0;
            		$ids[$val->cat_id."-".$val->mode_id."-".$val->counter]['mode_id'] = $val->mode_id;
            		$ids[$val->cat_id."-".$val->mode_id."-".$val->counter]['cat_id']  = $val->cat_id;
             		$ids[$val->cat_id."-".$val->mode_id."-".$val->counter]['counter_id']  = $val->counter;
             	}
             	$arr[$val->cat_id."-".$val->mode_id."-".$val->counter] += $val->rec;
             }
        }
    	
    	return array($arr, $categories, $ids, $cash);
    }


	public function getLedgerModeByCategoryId($category_ledger_id, $mode_id, $counter_id) {
    	$mode = $this->getPaymentModeById($mode_id);

    	if($mode->slug == 'cash') {
        	$ledger 	  = $this->db->where('label', 'cash')->or_where('name', 'Cash')->get('ledger')->row();
        	
        	$ledger_id	  = $ledger->led_Id;
        	$ledger_group = $this->db->where('group_name', 'cash')->get('ledger_group')->row();
        	$ledger_group_id = $ledger_group->group_id;
        } else {
        	$this->db->select('*');
    		$this->db->from('counter_banks');
    		$this->db->where('counter_id', $counter_id);
    		$query = $this->db->get();
    	
    		$counter_bank = $query->row();
    	
    		$ledger_id	  = $counter_bank->ledger_id;
        	$ledger_group = $this->db->where('group_name', 'bank')->get('ledger_group')->row();
        	$ledger_group_id = $ledger_group->group_id;
        }
    	$this->db->select('*');
    	$this->db->from('ledger_modes');
    	$this->db->join('ledger', 'ledger.led_Id=ledger_modes.ledger_id');
    	$this->db->where('parent_ledger_id', $category_ledger_id);
    	$this->db->where('ledger_id', $ledger_id);
    	$this->db->where('mode_id', $mode_id);
    	$query = $this->db->get();
    
    	if($query->num_rows() > 0) {
        	$ledger_mode = $query->row();
        } else {
    		$this->db->insert('ledger_modes', array(
            	'parent_ledger_id'=> $category_ledger_id,
				'ledger_id'=> $ledger_id,
				'mode_id'=> $mode_id,
            	'ledger_group'=> $ledger_group_id
            ));
			$id = $this->db->insert_id();
                              
			$this->db->select('*');
    		$this->db->from('ledger_modes');
    		$this->db->where('id', $id);
    		$query = $this->db->get();
    		$ledger_mode = $query->row();
        }
    	return $ledger_mode;
    }

	public function getLedgerByCategoryId($category_id) {
    	$this->db->select('ledger_categories.*');
    	$this->db->from('ledger_categories');
    	$this->db->join('ledger', 'ledger.led_Id=ledger_categories.ledger_id');
    	$this->db->where('ledger_categories.category_id', $category_id);
    	$query = $this->db->get();
    	$ledger_mode = $query->row();
   
    	return $ledger_mode;
    }


	public function getPoojaCategoryById($category_id) {
    	$this->db->select('*');
    	$this->db->from('cat');
    	$this->db->where('id', $category_id);
    	$query 	  = $this->db->get();
    	$category = $query->row();
    
    	return $category;
    }
    public function lname($id)
{
    $this->db->select('name');
    $this->db->from('ledger');
    $this->db->where('led_Id', $id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->name; // return only the name
    } else {
        return null; // if not found
    }
}

public function getledgergroup1($id)
{
$this->db->select('group');
    $this->db->from('ledger');
    $this->db->where('led_id', $id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->group; // return only the name
    } else {
        return null; // if not found
    }

}

    public function getCounterSummaryByDate($date) {
        $query = $this->db->query("
            SELECT
                counter.id            AS counter_id,
                counter.name          AS counter_name,
                payment_modes.id      AS mode_id,
                payment_modes.name    AS mode_name,
                SUM(billing.recv_amt) AS total
            FROM billing
            JOIN counter       ON billing.counter = counter.id
            JOIN payment_modes ON billing.mode    = payment_modes.id
            WHERE billing.date    = '$date'
              AND billing.deleted = 0
            GROUP BY billing.counter, billing.mode
            ORDER BY counter.name, payment_modes.id
        ");

        $rows     = $query->result_array();
        $counters = [];
        $modes    = [];

        foreach ($rows as $row) {
            $cid = $row['counter_id'];
            $mid = $row['mode_id'];

            if (!isset($counters[$cid])) {
                $counters[$cid] = [
                    'counter_name' => $row['counter_name'],
                    'modes'        => [],
                    'row_total'    => 0,
                ];
            }
            $counters[$cid]['modes'][$mid]  = (float)$row['total'];
            $counters[$cid]['row_total']   += (float)$row['total'];
            $modes[$mid] = $row['mode_name'];
        }

        return ['counters' => $counters, 'modes' => $modes];
    }

    public function isCounterSummaryPosted($date) {
        $query = $this->db->query(
            "SELECT COUNT(*) AS cnt FROM payment WHERE narration LIKE 'Counter Summary - " . $this->db->escape_like_str($date) . "%' AND is_delete=0"
        );
        return (int)$query->row()->cnt > 0;
    }

    public function postCounterSummaryPayments($date, $mode_totals, $created_by) {
        $vno_row  = $this->db->query("SELECT voucher_no FROM payment WHERE type=2 ORDER BY pay_Id DESC LIMIT 1")->row();
        $next_vno = $vno_row ? ((int)$vno_row->voucher_no + 1) : 1;

        $income_ledger_id = 6; // Income from Counter
        $f_year           = date('Y', strtotime($date));

        foreach ($mode_totals as $mode_id => $amount) {
            if ($amount <= 0) continue;

            $pm        = $this->getPaymentModeById($mode_id);
            $mode_name = $pm ? $pm->name : ('Mode ' . $mode_id);

            $this->db->insert('payment', [
                'ledger'       => $income_ledger_id,
                'amount'       => $amount,
                'mode'         => $mode_id,
                'narration'    => 'Counter Summary - ' . $date . ' (' . $mode_name . ')',
                'type'         => 2,
                'payment_date' => $date,
                'is_delete'    => 0,
                'f_year'       => $f_year,
                'voucher_no'   => $next_vno++,
                'ref_no'       => null,
                'created_by'   => $created_by,
            ]);
        }

        return true;
    }

    }