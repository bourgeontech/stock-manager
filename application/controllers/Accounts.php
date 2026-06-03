<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
    public function __construct(){
        parent::__construct();
        
        date_default_timezone_set( 'Asia/Calcutta' );
    
    	$site_settings 	= $this->db->select('*')->from('site_settings')->get()->row();
    
    	/***
    	 * Language Settings
    	 ***/
      	$language_settings = $this->db->field_exists('language', 'site_settings');
    
    	if($language_settings && $site_settings->language != null) {
           $this->load->language('main', $site_settings->language);
        }
    	/***
    	 * Language Settings - End
    	 ***/
    
        $this->load->helper( array( 'form', 'url' ) );
        $this->load->library( 'form_validation' );
        $this->load->model( 'Accounts_model' );
        $this->load->library( 'session' );
        $this->load->library( 'pagination' );
        $this->load->database();
        
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }
        $this->loggedIn=$this->session->admin;
    
    	if(!$this->db->table_exists('account_settings')) {
            $this->createAccountSettingsTable();
        }
    }
    
    public function createAccountSettingsTable() {
    	// Load the dbforge library
    	$this->load->dbforge();

   		// Define the table structure
    	$fields = array(
        	'id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
            	'unsigned' => TRUE,
            	'auto_increment' => TRUE
        	),
        	'categorized_dayclosing' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'dayclosing_for_custom_dates' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'created_at timestamp default current_timestamp',
    		'updated_at timestamp default current_timestamp on update current_timestamp',
    	);

    	// Add fields to the table
    	$this->dbforge->add_field($fields);

    	// Define the primary key
    	$this->dbforge->add_key('id', TRUE);

    	// Create the table
    	if ($this->dbforge->create_table('account_settings')) {
        	$this->db->insert('account_settings', array('categorized_dayclosing'=> 0, 'dayclosing_for_custom_dates'=> 0));
        	return;
    	} else {
        	echo 'Failed to create table "account_settings".';
    	}
    }
	public function ledgergroupReport()
    {	
		
 		$group  = $this->input->post('group');
		$fromdate = $this->input->post('search');
		$todate = $this->input->post('search1');
		$this->form_validation->set_rules('search', 'Fromdate', 'required');
		$date=date('Y-m-d');
    	     $data['ledger_groups'] = $this->Accounts_model->getledgergroups();
       	$data['temple_list']=$this->general_model->gettemples();
		$data['fromdate'] = !empty($fromdate) ? $fromdate : $date;
		$data['todate']   = !empty($todate)   ? $todate   : $date;
		$data['group']=!empty($group)   ? $group   : '';
    	if ($this->form_validation->run() === FALSE){
			
			
		$this->load->view('admin/layouts/admin_header');	
		        $this->load->view('admin/accounts/ledgerGroupReport',$data);
		        $this->load->view('admin/layouts/admin_footer');
	}
	else
	{
   
   		
		
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/ledgerGroupReport',$data);
        $this->load->view('admin/layouts/admin_footer');
		}
    }
    // LEDGER
    public function addLedgerGroup()
    {
        $this->form_validation->set_rules('group_name', 'Group Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['ledger_group']=$this->Accounts_model->getledger_group();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/addLedgerGroup',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            
            date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );
            
            
            $data = array(
                'group_name'      =>$this->input->post('group_name'),
                'name_mal'        =>$this->input->post('name_mal'),
                'group_created'         =>$date,
                
            );
            
            $res=$this->Accounts_model->addLedgerGroup($data);
            $msg="Content Saved";
            redirect('accounts/addLedgerGroup');
        }
        
        
    }
    
    public function updateLedgerGroup()
    {
        $this->form_validation->set_Rules("name2","Group Name","required");
        $this->form_validation->set_Rules("pdtp_id","ID","required");
        
        if($this->form_validation->Run()==false)
        {
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/addLedgerGroup',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else
        {
            $id=$this->input->post('pdtp_id');
            $data=array(
                'group_name'   => $this->input->post('name2'),
                'name_mal'        =>$this->input->post('name_mal2'),
            );
            $this->Accounts_model->updateLedgerGroup($id,$data);
            redirect('accounts/addLedgerGroup');
        }
        
    }
    
    public function deleteLedgerGroup($id)
    {
        
        $data=array(
            'is_delete'  =>1,
        );
        
        $res=$this->Accounts_model->updateLedgerGroup($id,$data);
        redirect('accounts/addLedgerGroup');
        
    }
    
    
    public function addLedger(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            
            $data['ledger_group']=$this->Accounts_model->getledger_group();
            
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/addLedger',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            
            date_default_timezone_set( 'Asia/Calcutta' );
            $currentDate = date( 'Y-m-d H:i:s' );
            
            $name=$this->input->post('name');
            $name_mal=$this->input->post('name_mal');
            $group=$this->input->post('group');
            $opening_bal=$this->input->post('opening_bal');
            
            
            $i=0;
            while ($i<sizeof($name)){
                $n=$name[$i];
                $nm=$name_mal[$i];
                $g=$group[$i];
                $o=$opening_bal[$i];
                $this->db->select('*');
                $this->db->from('ledger');
                $this->db->where('name', $n);
                $query = $this->db->get();
                if ($query->num_rows() == 0) {
                    $this->db->query("INSERT INTO ledger(`name`,`name_mal`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$n','$nm','$g','$o','$o','$currentDate')");
                    $led_id = $this->db->insert_id();
                    $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`) VALUES ('$led_id','$o','9','Opening Balance','3','$currentDate','$currentDate')");
                }
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('accounts/viewLedger');
            }
            
        }
        
        
    }
    
    public function updateLedger()
    {
        $this->form_validation->set_Rules("name2","Group Name","required");
        $this->form_validation->set_Rules("pdtp_id","ID","required");
        $this->form_validation->set_Rules("group","Group","required");
        
        if($this->form_validation->Run()==false)
        {
            redirect('accounts/viewLedger');
        }
        else
        {
            $id=$this->input->post('pdtp_id');
            $name=$this->input->post('name2');
            $name_mal=$this->input->post('name_mal2');
            $group=$this->input->post('group');
             $opening=$this->input->post('opening');
            $this->db->query("UPDATE ledger SET name='$name', name_mal='$name_mal', `group`='$group', `opening_bal`='$opening' where led_Id='$id'");
            if ($opening){
                $this->db->query("UPDATE payment SET amount='$opening' where ledger='$id' and narration='Opening Balance'");
            }
            redirect('accounts/viewLedger');
        }
        
    }
    
    public function viewLedger(){
        $data['ledger_group']=$this->Accounts_model->getledger_group();
        $data['ledger']=$this->Accounts_model->ledgerlist();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/viewLedger',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function searchLedger(){
        $data['ledger_group']=$this->Accounts_model->getledger_group();
        $data['ledger']=$this->Accounts_model->getLedgerByKeyword();
        if($data['ledger']!=0){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/viewLedger',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all products');
            redirect('accounts/viewLedger');
        }
        
    }
    
    public function deleteLedger($id){
        $result=$this->Accounts_model->deleteLedger($id);
        $msg="Deleted";
        redirect('accounts/viewLedger');
    }
    
    //RECEIPT
    
    public function addReceipt(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            // $last=$this->Accounts_model->getlastRecId();
            // $last_id=$last['receiptId'];
            // $last_id1=$last_id+1;
            // $this->db->query("ALTER TABLE payment AUTO_INCREMENT=$last_id1");
            $last=$this->Accounts_model->getlastRecId();
            $last_id=$last['voucher_no'];
            // $last_id1=$last_id+1;
            $last_id1 = (int)$last_id + 1;

            $vno = $this->input->post('voucher_no') ? $this->input->post('voucher_no') : $last_id1;

            // $next_voucher_no = $last['voucher_no'] + 1;
            $next_voucher_no = intval($last['voucher_no']) + 1;

			$data['voucher_no'] = intval($last['voucher_no']);
        
            $data['ledger']=$this->Accounts_model->ledgerlist();
            $data['mode']=$this->Accounts_model->getmode();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/addReceipt',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            date_default_timezone_set( 'Asia/Calcutta' );
            $currentDate = date( 'Y-m-d H:i:s' );
            $user_id = $this->loggedIn['id'];
        
            $date=$this->input->post('date');
            $ledger=$this->input->post('led_Id');
            $amount=$this->input->post('amount');
            $mode=$this->input->post('mode');
            $narration=$this->input->post('narration');
            $date1=$this->input->post('date1');
        $vno=$this->input->post('voucher_no');
            
            $i=0;
            while ($i<sizeof($ledger)){
                $led=$ledger[$i];
                $amt=$amount[$i];
                $mo=$mode[$i];
                $na=$narration[$i];
                $data=$date1[$i];
                 $vno=$vno[$i];
                // $rcid = $this->db->query("SELECT receiptId FROM `payment` ORDER BY pay_Id desc limit 1")->result();
                // foreach($rcid as $val){
                // $last_id=$val->receiptId;
                // }
                // $lastid=$last_id+ 1;
                
                $query = $this->db->query("SELECT * FROM `ledger` where led_Id='$led'")->result();
                foreach($query as $val){
                    $ledger_balance=$val->balance;
                    $groupid=$val->group;
                }
               if($groupid=="19")
               {
                $lastvoucherno= $this->db->query("select max(voucher_no) as vno from payment join ledger on payment.ledger=ledger.led_Id  where ledger.group=19");
                $lv = $lastvoucherno->row();
                $finalvno=$lv->vno+1; } else { $finalvno=$vno;}
                $e=$ledger_balance[$i];
                $bal= $ledger_balance - $amt;
                
                $query2 = $this->db->query("SELECT ledger_group.*, ledger.*, payment.*
				FROM ((ledger_group
				INNER JOIN ledger ON ledger_group.group_id = ledger.group)
				INNER JOIN payment ON ledger.led_Id = payment.ledger) WHERE ledger.led_Id='$mo'")->result();
                foreach($query2 as $val){
                    $mod=$val->group_name;
                }
                
                $query3 = $this->db->query("SELECT * FROM `ledger_group` where group_name='cash'")->result();
                foreach($query3 as $val){
                    $cash_balance=$val->cash_bal;
                }
                //    $bal1=$cash_balance[$i];
                $cashbal=$cash_balance + $amt;
                
                $query4 = $this->db->query("SELECT * FROM `ledger_group` where group_name='bank'")->result();
                foreach($query4 as $val){
                    $bank_balance=$val->bank_bal;
                }
                //    $bal2=$bank_balance[$i];
                $bankbal=$bank_balance + $amt;
                
                
                $fyear=date('Y');
            	$timestamp = date('Y-m-d H:i:s');
                $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`voucher_no`,`f_year`,`created_by`, `created_at`, `updated_at`) 
                VALUES ('$led','$amt','$mo','$na','2','$data','$currentDate','$finalvno','$fyear', '$user_id', '$timestamp', '$timestamp')");
                // $this->db->query("INSERT INTO receipt(`led_Id`,`amount`,`narration`,`created_at`) VALUES ('$led','$amt','$na','$currentDate')");
                $this->db->query("UPDATE ledger SET balance='$bal' WHERE led_Id='$led'");
                $this->db->query("UPDATE ledger SET balance=balance+$amt WHERE led_Id='$mo'");
                
                /**if ($mod=='cash') {
                 $this->db->query("UPDATE ledger_group SET cash_bal='$cashbal' WHERE group_name='cash'");
                 }
                 
                 if ($mod=='bank') {
                 $this->db->query("UPDATE ledger_group SET bank_bal='$bankbal' WHERE group_name='bank'");
                 }
                 */
                
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('accounts/viewReceipt');
            }
            
        }
        
    }
    public function editReceipt($id){
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            $last=$this->Accounts_model->getlastRecId();
            $last_id=$last['voucher_no'];
            // $last_id1=$last_id+1;
            $last_id1 = (int)$last_id + 1;

            $vno = $this->input->post('voucher_no') ? $this->input->post('voucher_no') : $last_id1;

            // $next_voucher_no = $last['voucher_no'] + 1;
            $next_voucher_no = intval($last['voucher_no']) + 1;

			$data['voucher_no'] = intval($last['voucher_no']);
        
            $data['ledger']=$this->Accounts_model->ledgerlist();
            $data['mode']=$this->Accounts_model->getmode();
			$data['id']=$id;
			$data['receipt'] = $this->db->get_where('payment', ['pay_Id' => $id])->row();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/editReceipt',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            date_default_timezone_set( 'Asia/Calcutta' );
            $currentDate = date( 'Y-m-d H:i:s' );
            $user_id = $this->loggedIn['id'];
        
            $date=$this->input->post('date');
            $ledger=$this->input->post('led_Id');
            $amount=$this->input->post('amount');
            $mode=$this->input->post('mode');
            $narration=$this->input->post('narration');
            $date1=$this->input->post('date1');
			$vno=$this->input->post('voucher_no');
            
            $i=0;
            while ($i<sizeof($ledger)){
                $led=$ledger[$i];
                $amt=$amount[$i];
                $mo=$mode[$i];
                $na=$narration[$i];
                $data=$date1[$i];
                 $vno=$vno[$i];
               
                
               
                
                
                $fyear=date('Y');
            	$timestamp = date('Y-m-d H:i:s');
							$data1 = [
				'ledger'       => $led,
				'amount'       => $amt,
				'mode'         => $mo,
				'narration'    => $na,
				'type'         => '2',
				'payment_date' => $data,       
				'created_Date' => $currentDate,
				'voucher_no'   => $vno,
				'f_year'       => $fyear,
				'created_by'   => $user_id,
				'updated_at'   => $timestamp,
			];

			$this->db->where('pay_Id', $id);
			$this->db->update('payment', $data1);

                
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('accounts/viewReceipt');
            }
            
        }
        
    }
    public function viewReceipt($all=null){
        $data['ledger']=$this->Accounts_model->getledger();
        if($all!=null){
            $data['receipt']=$this->Accounts_model->getReceipt();
        }
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/viewReceipt',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function searchReceipt(){
    	$data['datefrom']=$this->input->post('search');
		$data['dateto']=$this->input->post('searchto');
        $data['ledger']=$this->Accounts_model->getledger();
        $data['receipt']=$this->Accounts_model->getReceiptByKeyword();

        if($data['receipt']!=0){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/viewReceipt',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all products');
            redirect('accounts/viewReceipt');
        }
        
    }
    
    public function printReceipt($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['receiptData']=$this->Accounts_model->getReceiptData($id);
    	$data['loggedin']=$this->session->admin;
    	if($_SERVER['HTTP_HOST'] == 'sreevadakurumbakavu.com') {
        	$this->load->view('admin/accounts/printReceiptVadakurumba',$data);
        } else if($_SERVER['HTTP_HOST'] == 'narakathshribhagawathi.com') {
        	$this->load->view('admin/accounts/printReceiptVadakurumba',$data);
        } else {
        	$this->load->view('admin/accounts/printReceipt',$data);
        }
    }
    
    public function deleteReceipt($id){
        $result=$this->Accounts_model->deleteReceipt($id);
        $msg="Deleted";
        redirect('accounts/viewReceipt');
    }
    
    //PAYMENT
    
    public function addPayment(){
        
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            
            $data['ledger']=$this->Accounts_model->ledgerlist();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['mode']=$this->Accounts_model->getmode();
        
        	$last=$this->Accounts_model->getlastPaymentId();
            $last_id=$last['voucher_no'];
            // $last_id1=$last_id+1;
            $last_id1 = (int)$last_id + 1;

            $vno = $this->input->post('voucher_no') ? $this->input->post('voucher_no') : $last_id1;

            // $next_voucher_no = $last['voucher_no'] + 1;
            $next_voucher_no = intval($last['voucher_no']) + 1;

			$data['voucher_no'] = intval($last['voucher_no']);
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/addPayment',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            
            date_default_timezone_set( 'Asia/Calcutta' );
            $currentDate = date( 'Y-m-d H:i:s' );
            
        	$user_id = $this->loggedIn['id'];
        
            $date=$this->input->post('date');
         	$vno=$this->input->post('voucher_no');
            $ledger=$this->input->post('led_Id');
            $amount=$this->input->post('amount');
            $mode=$this->input->post('mode');
            $narration=$this->input->post('narration');
            $date1=$this->input->post('date1');
            
            $i=0;
            while ($i<sizeof($ledger)){
                $led=$ledger[$i];
                $amt=$amount[$i];
                $mo=$mode[$i];
                $na=$narration[$i];
                $data=$date1[$i];
            	$vno1=$vno[$i];
                
                
                $query = $this->db->query("SELECT balance FROM `ledger` where led_Id='$led'")->result();
                foreach($query as $val){
                    $ledger_balance=$val->balance;
                }
                // $e=$ledger_balance[$i];
                $bal=$ledger_balance + $amt;
                
                $query2 = $this->db->query("SELECT ledger_group.*, ledger.*, payment.*
				FROM ((ledger_group
				INNER JOIN ledger ON ledger_group.group_id = ledger.group)
				INNER JOIN payment ON ledger.led_Id = payment.ledger) WHERE ledger.led_Id='$mo'")->result();
                foreach($query2 as $val){
                    $mod=$val->group_name;
                }
                
                $query3 = $this->db->query("SELECT * FROM `ledger_group` where group_name='cash'")->result();
                foreach($query3 as $val){
                    $cash_balance=$val->cash_bal;
                }
                //    $bal1=$cash_balance[$i];
                $cashbal=$cash_balance - $amt;
                
                $query4 = $this->db->query("SELECT * FROM `ledger_group` where group_name='bank'")->result();
                foreach($query4 as $val){
                    $bank_balance=$val->bank_bal;
                }
                //    $bal2=$bank_balance[$i];
                $bankbal=$bank_balance +$amt;
                
                $fyear=date('Y');
            	$timestamp = date('Y-m-d H:i:s');
                $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`voucher_no`,`f_year`,`created_by`, `created_at`, `updated_at`) VALUES ('$led','$amt','$mo','$na','1','$data','$currentDate','$vno1','$fyear', '$user_id', '$timestamp', '$timestamp')");
                
                $this->db->query("UPDATE ledger SET balance='$bal' WHERE led_Id='$led'");
                $this->db->query("UPDATE ledger SET balance=balance-$amt WHERE led_Id='$mo'");
                
                /**if ($mod=='cash') {
                 $this->db->query("UPDATE ledger SET cash_bal='$cashbal' WHERE group_name='cash'");
                 }
                 
                 if ($mod=='bank') {
                 $this->db->query("UPDATE ledger_group SET bank_bal='$bankbal' WHERE group_name='bank'");
                 }*/
                
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('accounts/viewPayment');
            }
            
        }
    }
    public function editPayment($id){
        
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            
            $data['ledger']=$this->Accounts_model->ledgerlist();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['mode']=$this->Accounts_model->getmode();
			$data['id']=$id;
			$data['receipt'] = $this->db->get_where('payment', ['pay_Id' => $id])->row();
        	$last=$this->Accounts_model->getlastPaymentId();
            $last_id=$last['voucher_no'];
            // $last_id1=$last_id+1;
            $last_id1 = (int)$last_id + 1;

            $vno = $this->input->post('voucher_no') ? $this->input->post('voucher_no') : $last_id1;

            // $next_voucher_no = $last['voucher_no'] + 1;
            $next_voucher_no = intval($last['voucher_no']) + 1;

			$data['voucher_no'] = intval($last['voucher_no']);
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/editPayment',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            
            date_default_timezone_set( 'Asia/Calcutta' );
            $currentDate = date( 'Y-m-d H:i:s' );
            
        	$user_id = $this->loggedIn['id'];
        
            $date=$this->input->post('date');
         	$vno=$this->input->post('voucher_no');
            $ledger=$this->input->post('led_Id');
            $amount=$this->input->post('amount');
            $mode=$this->input->post('mode');
            $narration=$this->input->post('narration');
            $date1=$this->input->post('date1');
            
            $i=0;
            while ($i<sizeof($ledger)){
                $led=$ledger[$i];
                $amt=$amount[$i];
                $mo=$mode[$i];
                $na=$narration[$i];
                $data=$date1[$i];
            	$vno1=$vno[$i];
                
                
                //$query = $this->db->query("SELECT balance FROM `ledger` where led_Id='$led'")->result();
                //foreach($query as $val){
                    //$ledger_balance=$val->balance;
                //}
                // $e=$ledger_balance[$i];
                //$bal=$ledger_balance + $amt;
                /*
                $query2 = $this->db->query("SELECT ledger_group.*, ledger.*, payment.*
				FROM ((ledger_group
				INNER JOIN ledger ON ledger_group.group_id = ledger.group)
				INNER JOIN payment ON ledger.led_Id = payment.ledger) WHERE ledger.led_Id='$mo'")->result();
                foreach($query2 as $val){
                    $mod=$val->group_name;
                }
                
                $query3 = $this->db->query("SELECT * FROM `ledger_group` where group_name='cash'")->result();
                foreach($query3 as $val){
                    $cash_balance=$val->cash_bal;
                }
                //    $bal1=$cash_balance[$i];
                $cashbal=$cash_balance - $amt;
                
                $query4 = $this->db->query("SELECT * FROM `ledger_group` where group_name='bank'")->result();
                foreach($query4 as $val){
                    $bank_balance=$val->bank_bal;
                }
                //    $bal2=$bank_balance[$i];
                $bankbal=$bank_balance +$amt;
                */
                $fyear=date('Y');
            	$timestamp = date('Y-m-d H:i:s');
                $data = array(
    'ledger'      => $led,
    'amount'      => $amt,
    'mode'        => $mo,
    'narration'   => $na,
    'type'        => '1',
    'payment_date'=> $data,
    'created_Date'=> $currentDate,
    'voucher_no'  => $vno1,
    'f_year'      => $fyear,
    'created_by'  => $user_id,
    'updated_at'  => $timestamp
);

// Update record where voucher_no matches
$this->db->where('pay_Id', $id);
$this->db->update('payment', $data);
                
                //$this->db->query("UPDATE ledger SET balance='$bal' WHERE led_Id='$led'");
                //$this->db->query("UPDATE ledger SET balance=balance-$amt WHERE led_Id='$mo'");
                
                /**if ($mod=='cash') {
                 $this->db->query("UPDATE ledger SET cash_bal='$cashbal' WHERE group_name='cash'");
                 }
                 
                 if ($mod=='bank') {
                 $this->db->query("UPDATE ledger_group SET bank_bal='$bankbal' WHERE group_name='bank'");
                 }*/
                
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('accounts/viewPayment');
            }
            
        }
    }
    public function viewPayment($all=null){
        $data['ledger']=$this->Accounts_model->getledger();
        if($all!=null){
            $data['payment']=$this->Accounts_model->getPayment();
        }
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/viewPayment',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function searchPayment(){
    	$data['datefrom']=$this->input->post('search');
		$data['dateto']=$this->input->post('searchto');
        $data['ledger']=$this->Accounts_model->getledger();
        $data['payment']=$this->Accounts_model->getPaymentByKeyword();
        if($data['payment']!=0){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/viewPayment',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all products');
            redirect('accounts/viewPayment');
        }
        
    }
    
    public function printPayment($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['paymentData']=$this->Accounts_model->getPaymentData($id);
     	$data['loggedin']=$this->session->admin;
    
    	if($_SERVER['HTTP_HOST'] == 'narakathshribhagawathi.com') {
        	$this->load->view('admin/accounts/printPaymentVadakurumba',$data);
        } else {
        	$this->load->view('admin/accounts/paymentPrint',$data);
        }
    }
    
    public function deletePayment($id){
        $result=$this->Accounts_model->deletePayment($id);
        $msg="Deleted";
        redirect('accounts/viewPayment');
    }
    //REPORT
    
    //Day Book
    
    public function dayBook(){
        // $data['daybk']=$this->Accounts_model->dayBook();
        $data['temple_list']=$this->general_model->gettemples();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/dayBook',$data);
        $this->load->view('admin/layouts/admin_footer');
        
        
    }
    
    public function getDayBook(){
        $data['daybk']=$this->Accounts_model->searchDayBook();
        $search_date=$this->input->post('search');
        $data['temple_list']=$this->general_model->gettemples();
        $data['date']=$search_date;
        if($data['daybk']!=0){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/dayBook',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all products');
            redirect('accounts/dayBook');
        }
        
    }
    
    public function cashbook(){
        $data['temple_list']=$this->general_model->gettemples();
        $data['date']="";
        $search_date=$this->input->post('date');
        $search=$this->input->post('search');
        if ($search_date!=""){
            $data['date']=$search_date;
        }else {
            $data['date']=date('Y-m-d');
        }
        if ($search=="print"){
            $this->load->view('admin/accounts/cashbook_print',$data);
        }else if ($search=="excel"){
            $this->load->view('admin/accounts/cashbook_excel',$data);
        }else{
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/cashbook',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

    public function cashbook_twodays(){
        $data['temple_list']=$this->general_model->gettemples();
        $data['date']="";
        $data['dateto']="";
        $search_date=$this->input->post('date');
        $search_dateto=$this->input->post('dateto');
        $search=$this->input->post('search');
    	$sortby=$this->input->post('sortby');
		$data['sortby']=$sortby;
        if ($search_date!=""){
            $data['date']=$search_date;
        }else {
            $data['date']=date('Y-m-d');
        }
        if ($search_dateto!=""){
            $data['dateto']=$search_dateto;
        }else {
            $data['dateto']=date('Y-m-d');
        }
        if ($search=="print"){
            $this->load->view('admin/accounts/cashbook_twodays_print',$data);
        } else if ($search=="excel"){
            $this->load->view('admin/accounts/cashbook_twodays_excel',$data);
        } else{
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/cashbook_twodays',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    
    public function incomeExpense_rprt(){
        $data['temple_list']=$this->general_model->gettemples();
        $data['datef']="";
        $data['datet']="";
        $datef=$this->input->post('datef');
        $datet=$this->input->post('datet');
        $search=$this->input->post('search');
        if ($datef!=""){
            $data['datef']=$datef;
            $data['datet']=$datet;
        }else {
            $data['datef']=date('Y-m-d');
            $data['datet']=date('Y-m-d');
        }
        if ($search=="print"){
        
          if ($_SERVER['HTTP_HOST'] == "azhinhilamthalimahavishnukshethram.com" ) {
        
             $this->load->view('admin/accounts/incomeExpense_print_azhi',$data);
        }  else{
          
          
            $this->load->view('admin/accounts/incomeExpense_rprt',$data);
          
          }
        } else if ($search=="excel"){
            $this->load->view('admin/accounts/incomeExpense_excel',$data);
        }
    else {
            $this->load->view('admin/layouts/admin_header');
            
          if ($_SERVER['HTTP_HOST'] == "azhinhilamthalimahavishnukshethram.com") {
             $this->load->view('admin/accounts/incomeExpense_rprt_azhi',$data);
        }
          else{  
          
          			if ($this->db->field_exists('incomeexpense', 'site_settings')) {
   
    $query = $this->db->select('incomeexpense')
                      ->from('site_settings')
                      ->limit(1)
                      ->get();

    $row = $query->row();

    if ($row && $row->incomeexpense == 0) {
        $this->load->view('admin/accounts/incomeExpense_rprt-zamorins',$data);
        
    } 
} else {
   $this->load->view('admin/accounts/incomeExpense_rprt',$data); 
   
}
          
          
          }
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    
	/***
	 * Normal Day Closing
	 ***/
    public function dayclosing()
    {
    	$account_settings = $this->db->get('account_settings')->row();
    if(@$_REQUEST['date']!=''){ $date = $this->input->post('date');} else{$date=date('Y-m-d');}
    	if($account_settings->categorized_dayclosing == 1) {
        	redirect('accounts/dayClosingByCategories/'.$date.'');
        }
    
    	$this->db->select('dayclosing');
    	$this->db->from('site_settings');
    	$dayclosing = $this->db->get()->row()->dayclosing;
		$data['dayclosing'] = $dayclosing;
    
    	$this->form_validation->set_rules('date', 'Date', 'required');
    
    	
    	if ($this->form_validation->run() === FALSE){
        	$today=date('Y-m-d');
        	$data['income']=$this->Accounts_model->getincome();
        	$data['recvd']=$this->Accounts_model->getrecvdamount();
    		$data['mode']=$this->Accounts_model->getamountbymode(); print_r($data['mode']);
        	$data['onlineincome']=$this->Accounts_model->getonlineincome();
        	$today=date('Y-m-d');
        	$data['closing_date'] = $today;
       		// $today="2023-08-07";
        	$diety="0";
        	$type=null;
        	$data['bill_list']=$this->general_model->getbillsummury($today,$today,$diety,$type);
        	$data['product_list']=$this->general_model->getinv_product();
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/dayclosing',$data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        
        	$data['income']=$this->Accounts_model->getincomeByDate($date);
        	$data['recvd']=$this->Accounts_model->getrecvdamountByDate($date);
    		$data['mode']=$this->Accounts_model->getamountbymodeByDate($date);
        	$data['onlineincome']=$this->Accounts_model->getonlineincomeByDate($date);
			$data['closing_date'] = $date;
        
        	$diety="0";
        	$type=null;
        	$data['bill_list']=$this->general_model->getbillsummury($date,$date,$diety,$type);
        	$data['product_list']=$this->general_model->getinv_product();
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/dayclosing',$data);
        	$this->load->view('admin/layouts/admin_footer');
        }
    
    }
    
public function acc_post()
 {
    	$auth_user = $this->loggedIn;
    	$user_id   = $auth_user['id'];
    	$this->db->select('dayclosing');
    	$this->db->from('site_settings');
    	$dayclosing = $this->db->get()->row()->dayclosing;
    	
    	if($dayclosing == 1) {
        	$date = $this->input->post('closing_date');
        } else {
        	$date = date('Y-m-d');
        }
        
    	$site_settings = $this->db->query("SELECT bank_ledger_id FROM `site_settings`")->row();
    	$bank_ledger_id = $site_settings->bank_ledger_id;
    
    	// Collection from counter
    	$modes 	  = $this->input->post('mode');
    	// Collection from online
    	$online	  = $this->input->post('online_income');
    	$modes[0] = $online;
    
    	$counter_total  = 0;
    	foreach($modes as $mode_id => $amount) {
        	$ledger_mode    = $this->Accounts_model->getLedgerModeByModeId($mode_id);
        	
        	$this->db->select('*');
        	$this->db->from('payment');
        	$this->db->where('ledger', $ledger_mode->parent_ledger_id);
        	$this->db->where('mode', $ledger_mode->ledger_id);
        	$this->db->where('payment_date', $date);
        	$query = $this->db->get();
        
        	if($query->num_rows() > 0) {
            	$payment = $query->row();
            	
            	$this->db->where('pay_Id', $payment->pay_Id);
            	$this->db->delete('payment');
            }
        	
        }
    
    	$receipt_ids = array();
    	foreach($modes as $mode_id => $amount) {
        	$counter_total += $amount;
        	
        	$ledger_mode    = $this->Accounts_model->getLedgerModeByModeId($mode_id);
        
        	if($mode_id == 0) {
            	$mode = 'Online';
            } else {
            	$mode = $this->Accounts_model->getPaymentModeById($mode_id)->name;
            }
        
        	$parent_ledger    = $this->Accounts_model->getLedgerById($ledger_mode->parent_ledger_id);
        	$ledger    		  = $this->Accounts_model->getLedgerById($ledger_mode->ledger_id);
        	
        	$insertData = [
        		'ledger'		=> $ledger_mode->parent_ledger_id,
            	'mode'			=> $ledger_mode->ledger_id,
            	'amount'		=> $amount,
            	'type'			=> 2,
            	'payment_date' 	=> $date,
            	'created_Date' 	=> date('Y-m-d H:i:s'),
            	'narration'	   	=> "Day closing for $date's $mode payment"
           	];
          if($amount >0 ) //added this comment to avoid amount less than zero being entered by priyesh on 15/05 11.58 PM
            { 
        	try {
             
    			$this->db->trans_begin();
         
    			$this->db->insert('payment', $insertData);
    			$receipt_ids[] = $this->db->insert_id();

    			$this->db->trans_commit(); 
			} catch (Exception $e) {
    			$this->db->trans_rollback(); 
    			log_message('error', 'Transaction failed: ' . $e->getMessage()); // Log the error
			}
            }
        }
    
        $dittum_qty=$this->input->post('dittum_qty');
        $product=$this->input->post('product');
        $unit_id=$this->input->post('unit');
        $user=$this->loggedIn['id'];
        $this->db->query("DELETE FROM stock WHERE mode='DT' AND added_date='$date'");
        $j=0;
		
    	if($product) {
         while ($j<sizeof($product)){
            $pro=$product[$j];
            $qty=$dittum_qty[$j];
            $unit=$unit_id[$j];
            $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`added_date`,`user`,`ref_id`) VALUES ('$pro','$unit', '$qty', 'DT','$date', '$user', '$j')");
            $j++;
         }
        }

    	foreach($receipt_ids as $receipt_id) {
    		$this->printReceipt($receipt_id);
    	}
    }
	/***
	 * Normal Day Closing - END
	 ***/




    //Income Expense
    
    public function report(){
        
        
        $data['getincomeExpense']=$this->Accounts_model->getincomeExpense();
        $data['temple_list']=$this->general_model->gettemples();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/incomeExpense',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    
   /** public function ledgerWise(){
        $data['ledger']=$this->Accounts_model->getledger();
        $data['temple_list']=$this->general_model->gettemples();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/ledgerWise',$data);
        $this->load->view('admin/layouts/admin_footer');
    }**/
/*
 public function ledgerWise(){
        $search = $this->input->post('search');
 		$group  = $this->input->post('group');
 		$submit_type  = $this->input->post('submit_type');
 
 		
 		$data['ledger_groups'] = $this->Accounts_model->getledgergroups();
 
        if (!empty($search) || !empty($group)) {
        	if (!empty($group)) {
            	$data['group'] = $group;
            	$data['ledger'] = $this->Accounts_model->getledger('', $group);
        	} else {
            	$data['search'] = $search;
            	$data['ledger'] = $this->Accounts_model->getledger($search);
            }
        } else {
            $data['ledger'] = $this->Accounts_model->getledger();
        }
        $data['temple_list']=$this->general_model->gettemples();
 		if(!$submit_type || $submit_type == 'search') {
        	$this->load->view('admin/layouts/admin_header');
 		
         	if (empty($data['ledger'])) { 
            	$this->load->view('admin/accounts/ledgerWise',$data);
         	} else {
            	$this->load->view('admin/accounts/ledgerWise',$data);
         	}
        	$this->load->view('admin/layouts/admin_footer');
        } else if($submit_type == 'print') {
        	$this->load->view('admin/accounts/ledgerWisePrint',$data);
        }
    }
    */

public function ledgerWise(){
        $search = $this->input->post('search');
 		$group  = $this->input->post('group');
		$fromdate = $this->input->post('fromdate');
		$todate = $this->input->post('todate');
 		$submit_type  = $this->input->post('submit_type');
		$data['fromdate']=$fromdate;
 		$data['todate']=$todate;
 		$data['ledger_groups'] = $this->Accounts_model->getledgergroups();
 
        if (!empty($search) || !empty($group)) {
        	if (!empty($group)) {
            	$data['group'] = $group;
            	$data['ledger'] = $this->Accounts_model->getledger($search, $group,$fromdate,$todate);
        	} else {
            	$data['search'] = $search;
            	$data['ledger'] = $this->Accounts_model->getledger($search,'',$fromdate,$todate);
            }
        } else {
            $data['ledger'] = $this->Accounts_model->getledger('','',$fromdate,$todate);
        }
        $data['temple_list']=$this->general_model->gettemples();
 		if(!$submit_type || $submit_type == 'search') {
        	$this->load->view('admin/layouts/admin_header');
 		
         	if (empty($data['ledger'])) { 
            	$this->load->view('admin/accounts/ledgerWise',$data);
         	} else {
            	$this->load->view('admin/accounts/ledgerWise',$data);
         	}
        	$this->load->view('admin/layouts/admin_footer');
        } else if($submit_type == 'print') {
        	$this->load->view('admin/accounts/ledgerWisePrint',$data);
        }
    }
    public function searchledgerWise(){
        $date=$this->input->post('search');
        $dateto=$this->input->post('search1');
        $data['ledger']=$this->Accounts_model->searchledger($date,$dateto);
        $data['temple_list']=$this->general_model->gettemples();
        $data['date']=$date;
        $data['date1']=$dateto;
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/ledgerWise',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function ledgerwiseReport($id)
    {
        $data['ledger']=$this->Accounts_model->getledger();
        $data['ledgerWiseReport']=$this->Accounts_model->ledgerWiseReport($id);
    	//echo $this->db->last_query();
        $data['lname']=$this->Accounts_model->lname($id);
        $data['lgroup']=$this->Accounts_model->getledgergroup1($id);
        $data['ledgerId']=$id;
        $data['ob']=$this->Accounts_model->getopeningbalance($id);
      	$data['cb']=$this->Accounts_model->getclosingbalance($id);
       	$data['temple_list']=$this->general_model->gettemples();
   		// print_r($data);
        // $data['incomeExpense']=$this->Accounts_model->getincomeExpense();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/ledgerWiseReport',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
public function ledgerwiseReportPdf($id)
    {
ini_set("pcre.backtrack_limit", "5000000");
ini_set('memory_limit', '4000M');
		$data['ledger']=$this->Accounts_model->getledger();
        $data['ledgerWiseReport']=$this->Accounts_model->ledgerWiseReport($id);
        $data['ledgerId']=$id;
        $data['ob']=$this->Accounts_model->getopeningbalance($id);
      	$data['cb']=$this->Accounts_model->getclosingbalance($id);
       	$data['temple_list']=$this->general_model->gettemples();
   		// print_r($data);
        // $data['incomeExpense']=$this->Accounts_model->getincomeExpense();
        //$this->load->view('admin/layouts/admin_header');
        
        //$this->load->view('admin/layouts/admin_footer');
	$mpdf = new \Mpdf\Mpdf([ "mode" => "utf-8",'format' => 'A4']);
           
    $html = $this->load->view('admin/accounts/ledgerWiseReportPrint',$data,true);
              //  print $html;exit;
			  $mpdf->autoPageBreak = true;
			 $mpdf->setFooter('{PAGENO}');

	$mpdf->WriteHTML($html);
	$fname=$id.".pdf";
	$mpdf->Output($fname,'D'); 	
		
	}
    public function ledgerwiseReportPrint($id)
    {
        $data['ledger']=$this->Accounts_model->getledger();
        $data['ledgerWiseReport']=$this->Accounts_model->ledgerWiseReport($id);
        $data['ledgerId']=$id;
        $data['lname']=$this->Accounts_model->lname($id);
        $data['lgroup']=$this->Accounts_model->getledgergroup1($id);
        $data['ob']=$this->Accounts_model->getopeningbalance($id);
      	$data['cb']=$this->Accounts_model->getclosingbalance($id);
       	$data['temple_list']=$this->general_model->gettemples();
   		// print_r($data);
        // $data['incomeExpense']=$this->Accounts_model->getincomeExpense();
        //$this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/ledgerWiseReportPrint',$data);
        //$this->load->view('admin/layouts/admin_footer');
    }
    
    
    public function searchLedgerWiseReport($id)
    {
       $data['temple_list']=$this->general_model->gettemples();
       $data['ledger']=$this->Accounts_model->getledger();
        $search_date=$this->input->post('search');
        $search_date1=$this->input->post('search1');
        $data['datef']=$search_date;
        $data['datet']=$search_date1;
    //  print_r($_REQUEST);
       $data['ledgerWiseReport']=$this->Accounts_model->searchLedgerWiseReport($id);
       $data['ledgerId']=$id;
       $data['ob']=$this->Accounts_model->getopeningbalance($id);
       $data['cb']=$this->Accounts_model->getclosingbalance($id);
       $data['lname']=$this->Accounts_model->lname($id);
       $data['lgroup']=$this->Accounts_model->getledgergroup1($id);
        if($data['ledgerWiseReport']!=0){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/ledgerWiseReport',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all products');
            redirect('accounts/ledgerWise');
        }
        
    }
    public function searchReport(){
        $data['ledger']=$this->Accounts_model->getledger();
        $data['incomeExpense']=$this->Accounts_model->getincomeExpenseSearch();
        $data['temple_list']=$this->general_model->gettemples();
        if($data['incomeExpense']!=0){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/incomeExpense',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all products');
            redirect('accounts/report');
        }
        
    }
    public function searchReport1(){
        $data['ledger']=$this->Accounts_model->getledger();
        $data['incomeExpense']=$this->Accounts_model->getincomeExpenseSearch1();
    //print_r($data);
        $data['temple_list']=$this->general_model->gettemples();
        $search_date=$this->input->post('search');
        $search_date1=$this->input->post('search1');
        $data['datef']=$search_date;
        $data['datet']=$search_date1;
        if($data['incomeExpense']!=0){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/incomeExpense',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all products');
            redirect('accounts/report');
        }
    }
    
    public function cash_bank(){
        $data['cash_bank']=$this->Accounts_model->getcash_bank();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/cash_bank',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function addjournal(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['ledger']=$this->Accounts_model->getledger();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/addjournal',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            
            date_default_timezone_set( 'Asia/Calcutta' );
            $currentDate = date( 'Y-m-d H:i:s' );
            $date=$this->input->post('date');
            $ledger=$this->input->post('led_from');
            $ledger_to=$this->input->post('led_to');
            $amount=$this->input->post('amount');
            $narration=$this->input->post('narration');
            $date1=$this->input->post('date1');
            
            $i=0;
            while ($i<sizeof($ledger)){
                $led=$ledger[$i];
                $amt=$amount[$i];
                $lto=$ledger_to[$i];
                $na=$narration[$i];
                $data=$date1[$i];
                
                
                $query = $this->db->query("SELECT balance FROM `ledger` where led_Id='$led'")->result();
                foreach($query as $val){
                    $ledger_balance=$val->balance;
                }
                $query_to = $this->db->query("SELECT balance FROM `ledger` where led_Id='$lto'")->result();
                foreach($query_to as $val){
                    $ledgerto_balance=$val->balance;
                }
                // $e=$ledger_balance[$i];
                $bal=$ledger_balance - $amt;
                $balto=$ledgerto_balance + $amt;
                $this->db->query("INSERT INTO journal(`ledger`,`amount`,`led_to`,`narration`,`type`,`payment_date`,`created_Date`) VALUES ('$led','$amt','$lto','$na','1','$data','$currentDate')");
                $this->db->query("UPDATE ledger SET balance='$bal' WHERE led_Id='$led'");
                $this->db->query("UPDATE ledger SET balance='$balto' WHERE led_Id='$lto'");
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('accounts/viewjournal');
            }
            
        }
    }
    
    public function viewjournal(){
        $data['payment']=$this->Accounts_model->getjournalandcontra(1);
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/viewjournal',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function printjournal($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['paymentData']=$this->Accounts_model->getPaymentData($id);
        $this->load->view('admin/accounts/paymentPrint',$data);
    }
    /*
    public function deletejournal($id){
        $this->db->query("UPDATE journal SET is_delete='1' WHERE pay_Id='$id'");
        $msg="Deleted";
        redirect('accounts/viewjournal');
    }
    */
public function deletejournal($id){
		$logged				= $this->loggedIn['id'];
        $this->db->query("UPDATE journal SET is_delete='1' WHERE pay_Id='$id'");
        if ($this->db->field_exists('ref_no', 'payment')) {
			$id="J".$id;
		$this->db->query("UPDATE payment SET is_delete='1',deleted_by='$logged' WHERE ref_no='$id'");	
			
		}
		$msg="Deleted";
        redirect('accounts/viewjournal');
    }
    /*
    public function addcontra(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['ledger']=$this->Accounts_model->getmode();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/addcontra',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            
            date_default_timezone_set( 'Asia/Calcutta' );
            $currentDate = date( 'Y-m-d H:i:s' );
            $date=$this->input->post('date');
            $ledger=$this->input->post('led_from');
            $ledger_to=$this->input->post('led_to');
            $amount=$this->input->post('amount');
            $narration=$this->input->post('narration');
            $date1=$this->input->post('date1');
            $vno=$this->input->post('voucher_no');
            
            $i=0;
            while ($i<sizeof($ledger)){
                $led=$ledger[$i];
                $amt=$amount[$i];
                $lto=$ledger_to[$i];
                $na=$narration[$i];
                $data=$date1[$i];
                $vno=$vno[$i];
                
                $query = $this->db->query("SELECT balance FROM `ledger` where led_Id='$led'")->result();
                foreach($query as $val){
                    $ledger_balance=$val->balance;
                }
                $query_to = $this->db->query("SELECT balance FROM `ledger` where led_Id='$lto'")->result();
                foreach($query_to as $val){
                    $ledgerto_balance=$val->balance;
                }
                // $e=$ledger_balance[$i];
                $bal=$ledger_balance - $amt;
                $balto=$ledgerto_balance + $amt;
                $this->db->query("INSERT INTO journal(`ledger`,`amount`,`led_to`,`narration`,`type`,`payment_date`,`created_Date`) VALUES ('$led','$amt','$lto','$na','2','$data','$currentDate')");
                //entering contra entries to payment table
             $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`voucher_no`) VALUES ('$led','$amt','$led','$na','1','$data','$currentDate','$vno')");
             $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`voucher_no`) VALUES ('$lto','$amt','$lto','$na','2','$data','$currentDate','$vno')");
             
                $this->db->query("UPDATE ledger SET balance='$bal' WHERE led_Id='$led'");
                $this->db->query("UPDATE ledger SET balance='$balto' WHERE led_Id='$lto'");
                
            
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('accounts/viewcontra');
            }
            
        }
    }
    */

public function addcontra(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['ledger']=$this->Accounts_model->getmode();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/addcontra',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            
            date_default_timezone_set( 'Asia/Calcutta' );
            $currentDate = date( 'Y-m-d H:i:s' );
            $date=$this->input->post('date');
            $ledger=$this->input->post('led_from');
            $ledger_to=$this->input->post('led_to');
            $amount=$this->input->post('amount');
            $narration=$this->input->post('narration');
            $date1=$this->input->post('date1');
            $vno=$this->input->post('voucher_no');
            
            $i=0;
            while ($i<sizeof($ledger)){
                $led=$ledger[$i];
                $amt=$amount[$i];
                $lto=$ledger_to[$i];
                $na=$narration[$i];
                $data=$date1[$i];
                $vno=$vno[$i];
                
                $query = $this->db->query("SELECT balance FROM `ledger` where led_Id='$led'")->result();
                foreach($query as $val){
                    $ledger_balance=$val->balance;
                }
                $query_to = $this->db->query("SELECT balance FROM `ledger` where led_Id='$lto'")->result();
                foreach($query_to as $val){
                    $ledgerto_balance=$val->balance;
                }
                // $e=$ledger_balance[$i];
                $bal=$ledger_balance - $amt;
                $balto=$ledgerto_balance + $amt;
                $this->db->query("INSERT INTO journal(`ledger`,`amount`,`led_to`,`narration`,`type`,`payment_date`,`created_Date`) VALUES ('$led','$amt','$lto','$na','2','$data','$currentDate')");
				$journal_id = $this->db->insert_id();
				$journal_id="J".$journal_id;
                //entering contra entries to payment table
				$this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`voucher_no`,ref_no) VALUES ('$led','$amt','$led','$na','1','$data','$currentDate','$vno','$journal_id')");
				$this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`voucher_no`,ref_no) VALUES ('$lto','$amt','$lto','$na','2','$data','$currentDate','$vno','$journal_id')");
             
                $this->db->query("UPDATE ledger SET balance='$bal' WHERE led_Id='$led'");
                $this->db->query("UPDATE ledger SET balance='$balto' WHERE led_Id='$lto'");
                
            
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('accounts/viewcontra');
            }
            
        }
    }
    
    public function viewcontra(){
        $data['payment']=$this->Accounts_model->getjournalandcontra(2);
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/viewcontra',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function printcontra($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['paymentData']=$this->Accounts_model->getPaymentData($id);
        $this->load->view('admin/accounts/paymentPrint',$data);
    }
    
    // public function exportReportExcel(){
    
    // 	$spreadsheet = new Spreadsheet();
    // 	$sheet = $spreadsheet->getActiveSheet();
    
    // 	foreach(range('A', 'D') as $columnID) {
    // 		$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    // 	}
    // 	$sheet->setCellValue('A1', 'SL.NO');
    // 	$sheet->setCellValue('B1', 'NAME');
    // 	$sheet->setCellValue('C1', 'EMP ID');
    // 	$sheet->setCellValue('D1', 'DEPARTMENT');
    // 	$sheet->setCellValue('E1', 'DATE & TIME');
    
    // 	$getdata = $this->user_model->getAttendanceForExport();
    // 	$x = 2;
    // 	$i=0;
    // 	foreach($getdata as $get){
    // 		$sheet->setCellValue('A'.$x, ++$i);
    // 		$sheet->setCellValue('B'.$x, $get->name);
    // 		$sheet->setCellValue('C'.$x, $get->empid);
    // 		$sheet->setCellValue('D'.$x, $get->department);
    // 		$sheet->setCellValue('E'.$x, $get->clockindatetime);
    // 	  $x++;
    // 	}
    // 	$writer = new Xlsx($spreadsheet);
    // 	$filename = 'geosenseAttendance - '.date('Y-m-d');
    // 	header('Content-Type: application/vnd.ms-excel');
    // 	header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
    // 	header('Cache-Control: max-age=0');
    // 	$writer->save('php://output');
    
    // }
    
    //TEST
    public function sortbar(){
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('test/sortbar');
        $this->load->view('admin/layouts/admin_footer');
    }
    
     public function dayinvclosing()
    {
        //$today=$this->input->post('invdate');
      if  ($this->input->post('invdate')!=''){$today=$this->input->post('invdate');} else {$today=date("Y-m-d");}
        $data['income']=$this->Accounts_model->getincome();
        $data['recvd']=$this->Accounts_model->getrecvdamount();
        $data['onlineincome']=$this->Accounts_model->getonlineincome();
     if  ($this->input->post('invdate')!=''){$today=$this->input->post('invdate');} else {$today=date("Y-m-d");}
   //  $today=$this->input->post('invdate');
    // echo $today;exit;
    //print $today;
        $diety="0";
        $type=null;
        $data['bill_list']=$this->general_model->getbillsummury($today,$today,$diety,$type);
     $data['today']=$today;
    // print_r($data['bill_list']);
        $data['product_list']=$this->general_model->getinv_product();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/dayinvclosing',$data);
        $this->load->view('admin/layouts/admin_footer');
    
    }
    
    public function inv_post(){
       if  ($this->input->post('invdate')!=''){$today=$this->input->post('invdate');} else {$today=date("Y-m-d");}
        $counter=$this->input->post('tot');
        $online=$this->input->post('tot1');
        $recieved=$this->input->post('tot');
        $ledger=array(6,7);
        $amount=array($recieved,$online);
        $mode="9";
        $date1=array($today,$today);
        $i=0;
      $amt=0;$bal=0;
        while ($i<sizeof($ledger)){
            $led=$ledger[$i];
            $amt=$amount[$i];
            $mo=$mode;
            $data=$date1[$i];
            $query = $this->db->query("SELECT * FROM `ledger` where led_Id='$led'")->result();
            foreach($query as $val){
                $ledger_balance=$val->balance;
            }
            $e=$ledger_balance[$i];
            $bal=$ledger_balance+ $amt;
            $query2 = $this->db->query("SELECT ledger_group.*, ledger.*, payment.*
			FROM ((ledger_group
			INNER JOIN ledger ON ledger_group.group_id = ledger.group)
			INNER JOIN payment ON ledger.led_Id = payment.ledger) WHERE ledger.led_Id='$mo'")->result();
            foreach($query2 as $val){
                $mod=$val->group_name;
            }
            $query3 = $this->db->query("SELECT * FROM `ledger_group` where group_name='cash'")->result();
            foreach($query3 as $val){
                $cash_balance=$val->cash_bal;
            }
            $cashbal=$cash_balance + $amt;
            $query4 = $this->db->query("SELECT * FROM `ledger_group` where group_name='bank'")->result();
            foreach($query4 as $val){
                $bank_balance=$val->bank_bal;
            }
            $query1 = $this->db->query("SELECT pay_id FROM `payment` where ledger='$led' AND payment_date='$data'")->row_array();
            if (isset($query1)){
                $pay_id=$query1['pay_id'];
                $this->db->query("DELETE FROM payment WHERE pay_id='$pay_id'");
               // $this->db->query("UPDATE ledger SET balance=balance-$amt WHERE led_Id='$mo'");
               // $this->db->query("UPDATE ledger SET balance='$bal' WHERE led_Id='$led'");
            }
            $bankbal=$bank_balance + $amt;
            $narration="Day closing for".$today;
          //  $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`) VALUES ('$led','$amt','$mo','$narration','2','$data','$today')");
           // $this->db->query("UPDATE ledger SET balance='$bal' WHERE led_Id='$led'");
          //  $this->db->query("UPDATE ledger SET balance=balance+$amt WHERE led_Id='$mo'");
            $i++;
        }
        $dittum_qty=$this->input->post('dittum_qty');
        $product=$this->input->post('product');
        $unit_id=$this->input->post('unit');
        $user=$this->loggedIn['id'];
        $this->db->query("DELETE FROM stock WHERE mode='DT' AND date='$today'");
        $j=0;
        while ($j<sizeof($product)){
            $pro=$product[$j];
            $qty=$dittum_qty[$j];
            $unit=$unit_id[$j];
            $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`date`,`user`,`ref_id`) VALUES ('$pro','$unit', '$qty', 'DT','$today', '$user', '$j')");
            $j++;
        }
        redirect('accounts/dayinvclosing');
    }

	public function redirect() {
    	 $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'No previous page';

    	return redirect($url);
    }
    
    
	public function exportDataToCSV() {
        // Load the data you want to export, for example, from a model
        $data = $this->Your_model->getData();

        // Set headers for CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="data_export.csv"');

        // Open file handle for output
        $output = fopen('php://output', 'w');

        // Write header row
        fputcsv($output, array_keys($data[0]));

        // Write data rows
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        // Close file handle
        fclose($output);
        exit;
    }

	
	// Expenditure Report
	public function expenditureReport() {
    	$this->form_validation->set_rules('month', 'Month', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/expenditureReport');
            $this->load->view('admin/layouts/admin_footer');
        } else {
        	$dateString 	    = $this->input->post('month');
        	list($monthName, $year) = explode('-', $dateString);
        
        	// Convert month name to month number
        	$date  = DateTime::createFromFormat('F', $monthName);
        	$month = $date->format('m');
        	
       		$this->db->select('ledger.name as ledger, ledger.name_mal as ledger_locale, payment.voucher_no as voucher_no, payment.amount as amount, payment.narration as remarks');
        	$this->db->from('payment');
        	$this->db->join('ledger', 'payment.ledger=ledger.led_Id');
        	$this->db->where('MONTH(payment_date)', $month);
        	$this->db->where('YEAR(payment_date)', $year);
        	$this->db->where('ledger.group', 6);
        	$query = $this->db->get();
        	
        	$expenses = $query->result();
        
        	$data['expenses'] = $expenses;
        	$data['month']	  = $dateString;
        	$this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/accounts/expenditureReport', $data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }


	/***
	 *  If Day closing by categories enabled
	 ***/
	public function dayClosingByCategories($date)
    {
    	if (!$this->checkBanks()) {
        	$this->session->set_flashdata('info', 'Adding Banks...');
            redirect('accounts/createBanks');
        }
    
    	if (!$this->checkCounterBanks()) {
            $this->session->set_flashdata('info', 'Adding Counter Banks...');
            redirect('accounts/createCounterBanks');
        }
        
        if (!$this->checkLedgerModes()) {
            $this->session->set_flashdata('info', 'Adding Ledger Modes...');
           // redirect('accounts/mapLedgerModes');
        }
        
        if (!$this->checkLedgerCategories()) {
            $this->session->set_flashdata('info', 'Adding Ledger Categories...');
            redirect('accounts/mapLedgerCategory');
        }
    
    	$this->db->select('dayclosing');
    	$this->db->from('site_settings');
    	$dayclosing = $this->db->get()->row()->dayclosing;
		$data['dayclosing'] = $dayclosing;
    
    	$this->form_validation->set_rules('date', 'Date', 'required');
    
    	if ($this->form_validation->run() === FALSE){
        	
       
           
           $today	= $date;
        	$diety	= 0;
        	$type	= null;
        	$data['income']			= $this->Accounts_model->getIncomeByDate($today);
        	$data['recvd']			= $this->Accounts_model->getReceivedAmountByDate($today);
    		$data['modes']  		= $this->Accounts_model->getAmountByModeDate($today);
        	$data['categories']  	= $this->Accounts_model->getAmountByPoojaCatDate($today);
        	$data['onlineincome']	= $this->Accounts_model->getOnlineIncomeByDate1($today);
        	$data['closing_date'] 	= $today;
        	
        	$data['bill_list']		= $this->Accounts_model->getbillsummury($today,$today,$diety,$type);
        	$data['product_list']	= $this->general_model->getinv_product();
        
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/categorized_dayclosing',$data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        	$date 	= $this->input->post('date');
        	$diety	= 0;
        	$type	= null;
        	$data['income']			= $this->Accounts_model->getIncomeByDate($date);
        	$data['recvd']			= $this->Accounts_model->getReceivedAmountByDate($date);
    		$data['modes']  		= $this->Accounts_model->getAmountByModeDate($date);
        	$data['categories']  	= $this->Accounts_model->getAmountByPoojaCatDate($date);
        	$data['onlineincome']	= $this->Accounts_model->getOnlineIncomeByDate1($date);
        	$data['closing_date'] 	= $date;

        
        	$data['bill_list']		= $this->general_model->getbillsummury($date,$date,$diety,$type);
        	$data['product_list']	= $this->general_model->getinv_product();
        
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/categorized_dayclosing',$data);
        	$this->load->view('admin/layouts/admin_footer');
        }
    
    }
    
    public function postDayClosingByCategories(){
    	$auth_user = $this->loggedIn;
    	$user_id   = $auth_user['id'];
    	$this->db->select('dayclosing');
    	$this->db->from('site_settings');
    	$dayclosing = $this->db->get()->row()->dayclosing;
    	
    	if($dayclosing == 1) {
        	$date = $this->input->post('closing_date');
        } else {
        	$date = date('Y-m-d');
        }
        
    	$site_settings = $this->db->query("SELECT bank_ledger_id FROM `site_settings`")->row();
    	$bank_ledger_id = $site_settings->bank_ledger_id;
    	
    	$counter_total  = 0;
    
    	// Collection from counter
    	$categories 	  = $this->input->post('category');
    	
    	if(empty($categories)) {
        	redirect('accounts/dayClosingByCategories');
        }
    //print_r($categories);exit;
    $this->db->select('categorized_daily_pooja_summary');
    $this->db->from('site_settings');
    $categorized = $this->db->get()->row()->categorized_daily_pooja_summary;
		if(@$categorized==0)
		{
		$this->db->query("
    DELETE t1 
    FROM payment t1
    JOIN ledger t2 ON t1.ledger = t2.led_Id
    WHERE t2.group = 17 
    AND t1.payment_date = '$date' 
    AND t1.type = 2
");

		}
    	foreach($categories as $category_id => $modes) {
        	$ledger 			    = $this->Accounts_model->getLedgerByCategoryId(12);
        	//print_r($ledger);exit;
            $category_ledger_id		= $ledger->ledger_id;
        
        	foreach($modes as $mode_id => $counters) {

        		foreach($counters as $counter_id => $amount) {
        			$counter_total		+= $amount;
        			$ledger_category     = $this->Accounts_model->getLedgerModeByCategoryId($category_ledger_id, $mode_id, $counter_id);
        		//print_r($ledger_category);
        			$this->db->select('*');
        			$this->db->from('payment');
        			$this->db->where('ledger', $ledger_category->parent_ledger_id);
        			$this->db->where('mode', $ledger_category->ledger_id);
        			$this->db->where('payment_date', $date);
        			$query = $this->db->get();
        
        			if($query->num_rows() > 0) {
            			$payment = $query->row();
            	
            			$this->db->where('pay_Id', $payment->pay_Id);
            			$this->db->delete('payment');
            		}
            	}
            }
        
        }
    
    	$receipt_ids = array();

    	foreach($categories as $category_id => $modes) {
        	$ledger 			    = $this->Accounts_model->getLedgerByCategoryId($category_id);
        	$category_ledger_id		= $ledger->ledger_id;
        
        	foreach($modes as $mode_id => $counters) {

        		foreach($counters as $counter_id => $amount) {
        			$ledger_category     = $this->Accounts_model->getLedgerModeByCategoryId($category_ledger_id, $mode_id, $counter_id);
        
        			$category = $this->Accounts_model->getPoojaCategoryById($category_id)->name;
        			
                	if($mode_id == 0) {
            			$mode = 'Online';
            		} else {
            			$mode = $this->Accounts_model->getPaymentModeById($mode_id)->name;
            		}
            
        			$parent_ledger    = $this->Accounts_model->getLedgerById($ledger_category->parent_ledger_id);
        			$ledger    		  = $this->Accounts_model->getLedgerById($ledger_category->ledger_id);
        	
                	$mode = $this->Accounts_model->getPaymentModeById($mode_id);

    	if($mode->slug == 'cash') {
        	$this->db->select('*');
    		$this->db->from('counter');
    		$this->db->where('id', $counter_id);
    		$query = $this->db->get();
    	
    		$counter = $query->row();
        
        	$counter_mode = $counter->name ?? '';
        } else {
        	$this->db->select('counter_banks.*, ledger.name as ledger');
    		$this->db->from('counter_banks');
        	$this->db->join('ledger', 'counter_banks.ledger_id=ledger.led_Id');
    		$this->db->where('counter_id', $counter_id);
    		$query = $this->db->get();
    	
    		$counter_bank = $query->row();
    	
    		$counter_mode = $counter_bank->ledger ?? '';
        }
                $narrationText = $category." - ".$mode->name." ( ".$counter_mode." ) ";
                
        			$insertData = [
        				'ledger'		=> $ledger_category->parent_ledger_id,
            			'mode'			=> $ledger_category->ledger_id,
            			'amount'		=> $amount,
            			'type'			=> 2,
            			'payment_date' 	=> $date,
            			'created_Date' 	=> date('Y-m-d H:i:s'),
            			'narration'	   	=> "Day closing for $date's $narrationText payment"
           			];
        
            	
            		if($amount > 0 ) //added this comment to avoid amount less than zero being entered by priyesh on 15/05 11.58 PM
            		{ 
        				try {
    						$this->db->trans_begin();
         
    						$this->db->insert('payment', $insertData);
    						$receipt_ids[] = $this->db->insert_id();

    						$this->db->trans_commit(); 
						} catch (Exception $e) {
    						$this->db->trans_rollback(); 
    						log_message('error', 'Transaction failed: ' . $e->getMessage()); // Log the error
						}
            		}
            	
                } 
            }
        }
    	
    
        $dittum_qty=$this->input->post('dittum_qty');
        $product=$this->input->post('product');
        $unit_id=$this->input->post('unit');
        $user=$this->loggedIn['id'];
        $this->db->query("DELETE FROM stock WHERE mode='DT' AND added_date='$date'");
        $j=0;
		
    	if($product) {
         while ($j<sizeof($product)){
            $pro=$product[$j];
            $qty=$dittum_qty[$j];
            $unit=$unit_id[$j];
            $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`added_date`,`user`,`ref_id`) VALUES ('$pro','$unit', '-$qty', 'DT','$date', '$user', '$j')");
            $j++;
         }
        }


    	foreach($receipt_ids as $receipt_id) {
    		$this->printReceipt($receipt_id);
    	}
    }
    
	/*** 
	 * Check Necessary Data Exists 
	 ***/

	// Function to check if banks has data
    private function checkBanks() {
    	if(!$this->db->table_exists('banks')) {
        	$this->createBanksTable();
        }
        $query = $this->db->get('banks');
        return $query->num_rows() > 0;
    }

	// Function to check if counter_banks has data
    private function checkCounterBanks() {
    	if(!$this->db->table_exists('counter_banks')) {
        	$this->createCounterBanksTable();
        }
        $query = $this->db->get('counter_banks');
        return $query->num_rows() > 0;
    }

    // Function to check if ledger_modes has data
    private function checkLedgerModes() {
    	if(!$this->db->table_exists('ledger_modes')) {
        	$this->createLedgerModesTable();
        }
        $query = $this->db->get('ledger_modes');
        return $query->num_rows() > 0;
    }

	// Function to check if ledger_categories has data
    private function checkLedgerCategories() {
    	if(!$this->db->table_exists('ledger_categories')) {
        	$this->createLedgerCategoriesTable();
        }
        $query = $this->db->get('ledger_categories');
        return $query->num_rows() > 0;
    }
	/*** 
	 * Check Necessary Data Exists - END
	 ***/

    
	/*** 
	 * Create Necessary Tables
	 ***/
	// Create Banks
	public function createBanksTable() {
    	// Load the dbforge library
    	$this->load->dbforge();

   		// Define the table structure
    	$fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'unsigned' => TRUE
            ),
            'name' => array(
                'type' => 'CHAR',
                'constraint' => 200,
            ),
            'created_at timestamp default current_timestamp',
    		'updated_at timestamp default current_timestamp on update current_timestamp',
        );

        // Add the primary key
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE); // TRUE means primary key

        // Create the table if it doesn't exist
        if ($this->db->table_exists('banks')) {
            return;
        } else {
            if ($this->dbforge->create_table('banks')) {
               return;
            } else {
                echo 'Failed to create table.';
            }
        }
    }

	// Create Counter Banks
    public function createCounterBanksTable() {
    	// Load the dbforge library
    	$this->load->dbforge();

   		// Define the table structure
    	$fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'unsigned' => TRUE
            ),
            'counter_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'null' => FALSE,
            ),
            'bank_id' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'null' => FALSE,
            ),
            'ledger_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
            'created_at timestamp default current_timestamp',
    		'updated_at timestamp default current_timestamp on update current_timestamp',
        );

        // Add the primary key
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE); // TRUE means primary key

        // Create the table if it doesn't exist
        if ($this->db->table_exists('counter_banks')) {
            return;
        } else {
            if ($this->dbforge->create_table('counter_banks')) {
               return;
            } else {
                echo 'Failed to create table.';
            }
        }
    }
	
	// Create Ledger Categories 
	public function createLedgerCategoriesTable() {
    	// Load the dbforge library
    	$this->load->dbforge();

   		// Define the table structure
    	$fields = array(
        	'id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
            	'unsigned' => TRUE,
            	'auto_increment' => TRUE
        	),
        	'category_id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'parent_ledger_id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'ledger_id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'ledger_group' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'created_at timestamp default current_timestamp',
    		'updated_at timestamp default current_timestamp on update current_timestamp',
    	);

    	// Add fields to the table
    	$this->dbforge->add_field($fields);

    	// Define the primary key
    	$this->dbforge->add_key('id', TRUE);

    	// Create the table
    	if ($this->dbforge->create_table('ledger_categories')) {
        	redirect('accounts/mapLedgerCategory');
    	} else {
        	echo 'Failed to create table "ledger_categories".';
    	}
    }

	// Create Ledger Modes Table
	public function createLedgerModesTable() {
    	// Load the dbforge library
    	$this->load->dbforge();

   		// Define the table structure
    	$fields = array(
        	'id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
            	'unsigned' => TRUE,
            	'auto_increment' => TRUE
        	),
        	'mode_id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'parent_ledger_id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'ledger_id' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'ledger_group' => array(
            	'type' => 'INT',
            	'constraint' => 11,
        	),
        	'created_at timestamp default current_timestamp',
    		'updated_at timestamp default current_timestamp on update current_timestamp',
    	);

    	// Add fields to the table
    	$this->dbforge->add_field($fields);

    	// Define the primary key
    	$this->dbforge->add_key('id', TRUE);

    	// Create the table
    	if ($this->dbforge->create_table('ledger_modes')) {
        	redirect('accounts/mapLedgerModes');
    	} else {
        	echo 'Failed to create table "ledger_modes".';
    	}
    }
	/*** 
	 * Create Necessary Tables - END
	 ***/

	// Create Banks
	public function createBanks() {
    	$this->form_validation->set_rules('name', 'Counter', 'required');
    
    	if ($this->form_validation->run() === FALSE) {
        	if(!$this->db->table_exists('banks')) {
            	redirect('accounts/createBanksTable');
            }
        	$this->db->select('*');
        	$this->db->from('banks');
        	$query = $this->db->get();
        
        	$data['banks'] = $query->result();
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/banks', $data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
			// Inputs        
        	$name 	  	= $this->input->post('name');

        	$this->db->select('*');
        	$this->db->from('banks');
        	$this->db->where('name', $name);
        	$query = $this->db->get();
        
        	if($query->num_rows() > 0) {
            	$this->session->set_flashdata('error', 'You have already added this combination');
            } else {
            	$this->db->insert('banks', [
                	'name'=> $name
                ]);
            
            	$this->session->set_flashdata('success', 'You have successfully added the bank.');
            }
        
        	redirect('accounts/createBanks');
        }
    }

	// Map Ledger to Category
	public function mapLedgerCategory() {
    	$this->form_validation->set_rules('ledger_id', 'Ledger', 'required');
    	$this->form_validation->set_rules('category_id', 'Pooja Category', 'required');
    
    	$data['categories'] 	= $this->db->get('cat')->result();
    	$data['ledgers'] 		= $this->db->join('ledger_group', 'ledger_group.group_id=ledger.group')->where('ledger_group.group_name !=', 'Customer')->get('ledger')->result();
    	$data['parent_ledgers'] = $this->db->join('ledger_group', 'ledger_group.group_id=ledger.group')->where('ledger_group.group_name', 'Income')->get('ledger')->result();
    
    	if ($this->form_validation->run() === FALSE) {
        	if(!$this->db->table_exists('ledger_categories')) {
            	redirect('accounts/createLedgerCategoriesTable');
            }
        	$this->db->select('ledger_categories.id, cat.name as category, ledger.name as ledger, parent_ledger.name as parent_ledger');
        	$this->db->from('ledger_categories');
        	$this->db->join('cat', 'ledger_categories.category_id = cat.id');
        	$this->db->join('ledger', 'ledger_categories.ledger_id = ledger.led_Id');
        	$this->db->join('ledger parent_ledger', 'ledger_categories.parent_ledger_id = parent_ledger.led_Id');
        	$query = $this->db->get();
        
        	$data['ledger_categories'] = $query->result();
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/map_ledger_category', $data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
			// Inputs        
        	$category_id 	  = $this->input->post('category_id');
        	$parent_ledger_id = $this->input->post('parent_ledger_id');
        	$ledger_id 		  = $this->input->post('ledger_id');
        
        	$this->db->select('*');
        	$this->db->from('ledger_categories');
        	$this->db->where('category_id', $category_id);
        	$this->db->where('parent_ledger_id', $parent_ledger_id);
        	$this->db->where('ledger_id', $ledger_id);
        	$query = $this->db->get();
        
        	if($query->num_rows() > 0) {
            	$this->session->set_flashdata('error', 'You have already added this combination');
            } else {
            	$this->db->insert('ledger_categories', [
                	'category_id'=> $category_id,
					'parent_ledger_id'=> $parent_ledger_id,
					'ledger_id'=> $ledger_id
                ]);
            
            	$this->session->set_flashdata('success', 'You have successfully mapped the category with the ledger');
            }
        
        	redirect('accounts/mapLedgerCategory');
        }
    }

	//Map Ledger to Modes
	public function mapLedgerModes() {
    	$this->form_validation->set_rules('ledger_id', 'Ledger', 'required');
    	$this->form_validation->set_rules('mode_id', 'Payment Mode', 'required');
    
    	$data['modes'] 			= $this->db->get('payment_modes')->result();
    	$data['ledgers'] 		= $this->db->join('ledger_group', 'ledger_group.group_id=ledger.group')->where('ledger_group.group_name !=', 'Customer')->get('ledger')->result();
    	$data['parent_ledgers'] = $this->db->join('ledger_group', 'ledger_group.group_id=ledger.group')->where('ledger_group.group_name', 'Income')->get('ledger')->result();
    
    	if ($this->form_validation->run() === FALSE) {
        	if(!$this->db->table_exists('ledger_modes')) {
            	redirect('accounts/createLedgerModesTable');
            }
        	$this->db->select('ledger_modes.id, payment_modes.name as mode, ledger.name as ledger, parent_ledger.name as parent_ledger');
        	$this->db->from('ledger_modes');
        	$this->db->join('payment_modes', 'ledger_modes.mode_id = payment_modes.id');
        	$this->db->join('ledger', 'ledger_modes.ledger_id = ledger.led_Id');
        	$this->db->join('ledger parent_ledger', 'ledger_modes.parent_ledger_id = parent_ledger.led_Id');
        	$query = $this->db->get();
        
        	$data['ledger_modes'] = $query->result();
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/map_ledger_modes', $data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
			// Inputs        
        	$mode_id 	  	  = $this->input->post('mode_id');
        	$parent_ledger_id = $this->input->post('parent_ledger_id');
        	$ledger_id 		  = $this->input->post('ledger_id');
        
        	$this->db->select('*');
        	$this->db->from('ledger_modes');
        	$this->db->where('mode_id', $mode_id);
        	$this->db->where('parent_ledger_id', $parent_ledger_id);
        	$this->db->where('ledger_id', $ledger_id);
        	$query = $this->db->get();
        
        	if($query->num_rows() > 0) {
            	$this->session->set_flashdata('error', 'You have already added this combination');
            } else {
            	$this->db->insert('ledger_modes', [
                	'mode_id'=> $mode_id,
					'parent_ledger_id'=> $parent_ledger_id,
					'ledger_id'=> $ledger_id
                ]);
            
            	$this->session->set_flashdata('success', 'You have successfully mapped the category with the ledger');
            }
        
        	redirect('accounts/mapLedgerModes');
        }
    }

	// Map Counter to Banks
	public function createCounterBanks() {
    	$this->form_validation->set_rules('counter_id', 'Counter', 'required');
    	$this->form_validation->set_rules('bank_id', 'Bank', 'required');
    	$this->form_validation->set_rules('ledger_id', 'Ledger', 'required');
    
    	$data['counters'] 		= $this->db->get('counter')->result();
    	$data['ledgers'] 		= $this->db->join('ledger_group', 'ledger_group.group_id=ledger.group')->where('ledger_group.group_name !=', 'Customer')->get('ledger')->result();
    	$data['banks'] 			= $this->db->get('banks')->result();

    	
    	if ($this->form_validation->run() === FALSE) {
        	if(!$this->db->table_exists('counter_banks')) {
            	redirect('accounts/createCounterBanksTable');
            }
        	$this->db->select('counter_banks.id, counter.name as counter, banks.name as bank, ledger.name as ledger');
        	$this->db->from('counter_banks');
        	$this->db->join('counter', 'counter_banks.counter_id = counter.id');
        	$this->db->join('ledger', 'counter_banks.ledger_id = ledger.led_Id');
        	$this->db->join('banks', 'counter_banks.bank_id = banks.id');
        	$query = $this->db->get();
        
        	$data['counter_banks'] = $query->result();
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/map_counter_banks', $data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
			// Inputs        
        	$counter_id 	  	  = $this->input->post('counter_id');
        	$bank_id = $this->input->post('bank_id');
        	$ledger_id 		  = $this->input->post('ledger_id');
        
        	$this->db->select('*');
        	$this->db->from('counter_banks');
        	$this->db->where('counter_id', $counter_id);
        	$this->db->where('bank_id', $bank_id);
        	$this->db->where('ledger_id', $ledger_id);
        	$query = $this->db->get();
        
        	if($query->num_rows() > 0) {
            	$this->session->set_flashdata('error', 'You have already added this combination');
            } else {
            	$this->db->insert('counter_banks', [
                	'counter_id'=> $counter_id,
					'bank_id'=> $bank_id,
					'ledger_id'=> $ledger_id
                ]);
            
            	$this->session->set_flashdata('success', 'You have successfully mapped the category with the ledger');
            }
        
        	redirect('accounts/createCounterBanks');
        }
    }

	
	
	/***
	 * Daily Account 
	 ***/
	// Open Daily Account for a date
	public function openDailyAccount($id) {
    	$this->db->where('id', $id);
        $query = $this->db->get('daily_account_closures');
        	
    	if ($query->num_rows() > 0) {
            $data = $query->row();
            	
        	$date 		   = $data->date;
        	$formattedDate = date('d/m/Y', strtotime($date));
        
            if($data->closure == 1) {
            	$this->db->where('id', $id);
    			$this->db->update('daily_account_closures', array('closure'=> 0));
            	$this->session->set_flashdata('success', 'You have opened the accounts for the date '.$formattedDate);
            } else {
                $this->session->set_flashdata('error', 'You have already opened accounts for '.$formattedDate);
            }
    	}
    
    	redirect('accounts/closedDailyAccounts');
    }

	// Closed Daily Accounts
	public function closedDailyAccounts() {
       	$query = $this->db->get('daily_account_closures');
    
        $closed_accounts = $query->result();
    	$data['closed_accounts'] = $closed_accounts;
    
    	$this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/accounts/closed_daily_accounts', $data);
        $this->load->view('admin/layouts/admin_footer');
    }
	
	// Daily Account Closure
	public function dailyAccountClosure() {
    	$this->form_validation->set_rules('date', 'Date', 'required');
    
    	if ($this->form_validation->run() === FALSE){
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/accounts/daily_account_closure');
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        	$date 		   = $this->input->post('date');
        	$formattedDate = date('d/m/Y', strtotime($date));
        
        	$this->db->select('SUM(amount) as amount');
    		$this->db->from('payment');
    		$this->db->where('payment_date <=', $date);
    		$amount = $this->db->get()->row()->amount;
    
    		$insertData = [
        				'date'			=> $date,
            			'amount'		=> $amount,
            			'closure'		=> 1
           			];
        
        	$updateData = [
            			'amount'		=> $amount,
            			'closure'		=> 1
           			];
			
        	$this->db->where('date', $date);
        	$query = $this->db->get('daily_account_closures');
        	
    		if ($query->num_rows() > 0) {
            	$data = $query->row();
            	
            	if($data->closure == 1) {
        			$this->session->set_flashdata('error', 'You have already closed accounts for '.$formattedDate);
                } else {
                	$this->db->where('id', $data->id);
                	$this->db->update('daily_account_closures', $updateData);
                
                	$this->session->set_flashdata('success', 'You have updated the closure of accounts for the date '.$formattedDate);
                }
    		}
    		else{
        		$this->db->insert('daily_account_closures', $insertData);
            	$this->session->set_flashdata('success', 'Successfully closed accounts for '.$formattedDate);
    		}
        
        	redirect('accounts/dailyAccountClosure');
        }
    } 	

	// Check If Account closed for the day
	public function checkAccountClosure() {
    	$closed = false;
    	$date = $this->input->post('date');
    
    	$this->db->where('date', $date);
    	$this->db->where('closure', 1);
       	$query = $this->db->get('daily_account_closures');
    
        if ($query->num_rows() > 0) {
            $closed = true;
        } 
    	
    	$response = [
        	'date' 	 => $date,
        	'closed' => $closed
        ];
    	echo json_encode($response);
    }
    /***
	 * Daily Account  - END
	 ***/

// 	public function createLedgerCategories() {
//     	echo '<div style="text-align:center">';
//     	echo "<p>There is no table for mapping ledger to categories. Do you want to create the table and continue?</p>";
//     	echo '<button id="createTableBtn" style="background-color:green; color:white">Yes</button> <button id="cancelBtn" style="background-color:red; color:white">No</button>';
//     	echo '</div>';
    	
//     	echo '<script>
//         	document.getElementById("createTableBtn").onclick = function() {
//             if (confirm("Are you sure you want to create the table?")) {
//                 var xhr = new XMLHttpRequest();
//                 xhr.open("GET", "' . site_url('accounts/createLedgerCategoriesTable') . '", true);
//                 xhr.onreadystatechange = function() {
//                     if (xhr.readyState == 4 && xhr.status == 200) {
//                         alert("Table created successfully!");
//                         location.reload(); 
//                     }
//                 };
//                 xhr.send();
//             }
//         };
//         document.getElementById("cancelBtn").onclick = function() {
//             alert("Table creation canceled.");
//         };
//     	</script>';
//     }
}