<style>
	.table td{
    	height:1.5cm;
    white-space: normal;
  word-wrap: break-word;
  word-break: break-word;
    
	}

</style>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Cash Book</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header" hidden>
  <div class="header-right">
  <a href="<?php echo base_url();?>index.php/accounts/report" class="btn btn btn-outline-secondary" style="font-size: 18px;"><i class="fa fa-list-ul" aria-hidden="true"></i> View All</a>
        
  <!-- <a href="<?php echo base_url();?>index.php/accounts/exportReportExcel" class="btn btn btn-outline-success" style="font-size: 18px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a> -->
  
   </div>
   </div>
        </div>
			 </div>	
       <br>
       
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
					

<!-- SEARCH -->

<div class="row">
	
			  
			  <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <form action="<?php echo base_url();?>index.php/accounts/cashbook" method="post">
                  <div class="input-group mb-3">
				  &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="date" value="<?php if (isset($date)){ echo $date;}else{ echo date('Y-m-d');}?>" required placeholder="Search By Date" aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" type="submit" name="search" value="print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      	<button class="btn btn-outline-secondary" type="submit" name="search" value="excel"><i class="fa fa-file" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
			  </div>
               
             
			  
			 </div>	<br><br>

     <?php
          
         $site_settings 	= $this->db->select('*')->from('site_settings')->get()->row();
    	 $language_settings = $this->db->field_exists('language', 'site_settings');
         
     $search_date=$date;
     if($search_date==""){
         $search_date=date('Y-m-d');
     }
     $convertDate = date("Y-m-d", strtotime($search_date));

    /** Added by Sherin Nov 13 2023 **/
//     $query = $this->db->select_sum('payment.amount', 'amount')
//     	          ->from('payment')
//     			  ->join('ledger', 'ledger.led_Id = payment.ledger')
//     			  ->where('DATE(payment_date) <', $convertDate)
//     			  ->where('payment.is_delete', 0)
//     			  ->where('type', 1)
//     			  ->where('ledger.group', 2)
//     			  ->get();

// 	$pay = $query->row()->amount;
          
//     $query = $this->db->select_sum('payment.amount', 'amount')
//     			  ->from('payment')
//     			  ->join('ledger', 'ledger.led_Id = payment.ledger')
//     			  ->where('DATE(payment_date) <', $convertDate)
//     			  ->where('payment.is_delete', 0)
//     			  ->where('type', 2)
//     			  ->where('ledger.group', 2)
//     			  ->get();

// 	$rec = $query->row()->amount;
          
//     $open_cash=$rec-$pay;
          
//     $query = $this->db->select_sum('payment.amount', 'amount')
//     	          ->from('payment')
//     			  ->join('ledger', 'ledger.led_Id = payment.ledger')
//     			  ->where('DATE(payment_date) <', $convertDate)
//     			  ->where('payment.is_delete', 0)
//     			  ->where('type', 1)
//     			  ->where('ledger.group', 3)
//     			  ->get();

// 	$pay1 = $query->row()->amount;
          
//     $query = $this->db->select_sum('payment.amount', 'amount')
//     			  ->from('payment')
//     			  ->join('ledger', 'ledger.led_Id = payment.ledger')
//     			  ->where('DATE(payment_date) <', $convertDate)
//     			  ->where('payment.is_delete', 0)
//     			  ->where('type', 2)
//     			  ->where('ledger.group', 3)
//     			  ->get();

// 	$rec1 = $query->row()->amount;
          
//     $open_bank=$rec1-$pay1;
     /** Added by Sherin Nov 13 2023 - END **/
          
          
     /**********
      * 
      * Commented on Nov 13 by Sherin   
      * 
      ***********/
     	$payment = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete=0 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
  
   //print "SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'";
          
     	$pay=$payment['payment'];
    

        $receipt = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete=0 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec=$receipt['receipt'];
    //	 print "SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'";     
    
    $open_cash=$rec-$pay;
    
    $payment1 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete=0 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
    
         // print "SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete=0 AND `payment_date` < '$convertDate' and `type`='1'";
    $pay1=$payment1['payment'];
    
    
    $receipt1 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete=0 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
    $rec1=$receipt1['receipt'];
    
    $open_bank=$rec1-$pay1;
    /*
    *
    **************/

//TOTAL DEBIT & CREDIT

$payment = $this->db->query("SELECT sum(amount) as payment FROM `payment` WHERE `payment_date` = '$convertDate' and type='1'")->result_array();
  
          foreach($payment as $val){ 
          $total_debit=$val['payment'];
        }

     $receipt = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` = '$convertDate' and type='2'")->result_array();
  
          foreach($receipt as $val){ 
          $total_credit=$val['receipt'];
        }
        $this->db->select('payment.*,ledger.*,ledger.name_mal as led_mal,ledger.name as ledger_name,payment.voucher_no as voucher_no, payment.ref_no as ref_no');
        $this->db->from('payment');
        $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
        $this->db->order_by("payment.pay_Id", "asc");
      //  $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
        $this->db->where('payment.payment_date',$convertDate);
        $this->db->where('payment.type', 2);
        $this->db->where('payment.is_delete !=', 1);
        $this->db->order_by("payment.pay_Id", "asc");
        $query2 = $this->db->get()->result_array();
          //echo $this->db->last_query();
       
        $this->db->select('payment.*,ledger.*,ledger.name_mal as led_mal,ledger.name as ledger_name,payment.voucher_no as voucher_no1, payment.ref_no as ref_no');
        $this->db->from('payment');
        $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
        $this->db->order_by("payment.pay_Id", "asc");
      //  $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
        $this->db->where('payment.payment_date',$convertDate);
        $this->db->where('payment.type', 1);
        $this->db->where('payment.is_delete !=', 1);
        $this->db->order_by("payment.pay_Id", "asc");
        $query3 = $this->db->get()->result_array();
        //echo $this->db->last_query();
        $count=count($query2);
        $count1=count($query3);

   ?>
          
          
			<div id="printer">
                <div class="row">
                	<div class="col-lg-12 col-md-12 col-sm-12 ">
                    	<div style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                			Cash Book On <?php if (isset($date)){echo date('d-m-Y',strtotime($date));};?></h4>
                		</div>		
                	</div>
                	<div class="col-md-6 col-sm-6 h-100">
                		<div class="table-responsive h-100">
                			<table class="table table-hover srp_table h-100" width="100%" border="1" id="table">
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;"> <?php echo $this->lang->line('income'); ?> </th>
                    				</tr>
                    				<tr>
                    			    	<th scope="col" width="">Vr. No</th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('item_details'); ?> </th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('cash'); ?> </th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('bank'); ?> </th>
                    		    	</tr>
                		    	</thead>
                		    	<tbody>
                		    		<tr>
                		    			<td></td>
                		    			<td>CASH/BANK OPENING BALANCE(<?php if (isset($date)){echo date('d/m/Y',strtotime($date));};?>)</td>
                		    			<td style="text-align: right;"><?php echo (number_format($open_cash, 2, '.', '')); ?></td>
                		    			<td style="text-align: right;"><?php echo (number_format($open_bank, 2, '.', '')); ?></td>
                	    			</tr>
                	    			<?php 
                	    			$i=0;
                	    			$c_tot=0;
                	    			$b_tot=0;
                	    			$c_tot=$c_tot+$open_cash;
                	    			$b_tot=$b_tot+$open_bank;
                                
                                	$billed = 0;
                                	$array = array();
                                	foreach($query2 as $entry) {
                                    	if($entry['ref_no']) {
                                        	$billed+=$entry['amount'];
                                        	$billedEntry = $entry;
                                        } else {
                                        	array_push($array, $entry);
                                        }
                                    }
                                	$billedEntry['amount'] = $billed;
                                	$billedEntry['narration'] = 'Rs '.$billed.' received against customer payments';
                                
                                	array_push($array, $billedEntry);
									// $count=count($array);

                	    			foreach ($query2 as $val){
                	    			    $mode=$val['mode'];
                	    			    $this->db->select('group');
                	    			    $this->db->from('ledger');
                	    			    $this->db->where('led_Id', $mode);
                	    			    $query1 = $this->db->get()->row_array();
                                    	
                	    			    if ($query1['group']=='2'){
                	    			        $cash=$val['amount'];
                	    			        $bank="0";
                	    			        $c_tot=$c_tot+$cash;
                	    			    }elseif ($query1['group']=='3'){
                	    			        $bank=$val['amount'];
                	    			        $cash="0";
                	    			        $b_tot=$b_tot+$bank;
                	    			    }
                                    
                                    	
                	    			    ?>
                	    			 <?php if(@$cash >0 || @$bank > 0){?>   <tr>
                                        	<td><?php echo $val['voucher_no']?></td>
                	    			    	<td style="white-space: normal;
  word-wrap: break-word;
  word-break: break-word;width:350px;">
                                            <?php 
                                        		if($language_settings && $site_settings->language != null) {
                									if($site_settings->language == 'english') { 
                                            			echo $val['ledger_name'];
                                            		} else { 
                                                    	echo $val['led_mal']; 
                                                    }
                                                } 
                                            ?>
                                            <br><?php echo $val['narration']; ?></td>
                	    			    	<td style="text-align: right;"><?php if($cash>0){echo (number_format($cash, 2, '.', ''));}?></td>
                	    			    	<td style="text-align: right;"><?php if($bank>0){echo (number_format($bank, 2, '.', ''));}?></td>
                	    			    </tr><?php } ?>
                	    			    <?php
                	    			}
                	    			if ($count<$count1){
                	    			    $diff=abs($count - $count1);
                	    			    for ($i=0;$i<$diff;$i++){
                	    			        echo '<tr><td>#</td><td></td><td></td><td></td></tr>';
                	    			    }
                	    			}
                	    			?>
                	    			<tr>
                	    				<td></td>
                	    				<td> <?php echo $this->lang->line('total'); ?> </td>
                	    				<td style="text-align: right;"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    			</tr>
                	    			<tr>
                	    				<td>#</td>
                		    			<td></td>
                		    			<td></td>
                		    			<td></td>
                	    			</tr>
                	    			<tr>
                	    				<td></td>
                	    				<td> <?php echo $this->lang->line('total'); ?> </td>
                	    				<td style="text-align: right;"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    			</tr>
                		    	</tbody>
                			</table>
                		</div>
                	</div>
                	<div class="col-md-6 col-sm-6 h-100">
                		<div class="table-responsive h-100">
                			<table class="table table-hover srp_table h-100" width="100%" border="1" id="table">
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;"> <?php echo $this->lang->line('expense'); ?> </th>
                    				</tr>
                    				<tr>
                    			    	<th scope="col" width="">Vr. No</th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('item_details'); ?> </th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('cash'); ?> </th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('bank'); ?> </th>
                    		    	</tr>
                		    	</thead>
                		    	<tbody>
                		    		<tr>
                		    			<td>#</td>
                		    			<td></td>
                		    			<td></td>
                		    			<td></td>
                		    		</tr>
                	    			<?php 
                	    			$i=0;
                	    			$c_tot1=0;
                	    			$b_tot1=0;
                	    			foreach ($query3 as $val){
                	    			    $mode=$val['mode'];
                	    			    $this->db->select('group');
                	    			    $this->db->from('ledger');
                	    			    $this->db->where('led_Id', $mode);
                	    			    $query1 = $this->db->get()->row_array();
                	    			    if ($query1['group']=='2'){
                	    			        $cash=$val['amount'];
                	    			        $bank="0";
                	    			        $c_tot1=$c_tot1+$cash;
                	    			    }elseif ($query1['group']=='3'){
                	    			        $bank=$val['amount'];
                	    			        $cash="0";
                	    			        $b_tot1=$b_tot1+$bank;
                	    			    }
                	    			    ?>
                	    			 <?php if($cash >0 || $bank > 0){?>      <tr>
                	    			    	<td><?php echo $val['voucher_no1'];?>
                                        	
                	    			    	<td style="white-space: normal;
  word-wrap: break-word;
  word-break: break-word;width:300px;">
                                            <?php if($language_settings && $site_settings->language != null) {
                	if($site_settings->language == 'english') { ?>
                                            <?php echo $val['ledger_name'] ?? '';?>
                                            <?php } else { ?>
                                            <?php echo $val['led_mal'];
                                            } }  ?>
                                            <br><?php echo nl2br($val['narration']);?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($cash, 2, '.', ''));?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($bank, 2, '.', ''));?></td>
                	    			    </tr> <?php } ?>
                	    			    <?php
                	    			}
                	    			if ($count>$count1){
                	    			    $diff=abs($count - $count1);
                	    			    for ($i=0;$i<$diff;$i++){
                	    			        echo '<tr><td>#</td><td></td><td></td><td></td></tr>';
                	    			    }
                	    			}
                	    			?>
                	    			<tr>
                	    				<td></td>
                	    				<td> <?php echo $this->lang->line('total'); ?> </td>
                	    				<td style="text-align: right;"><?php echo (number_format($c_tot1, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php  echo (number_format($b_tot1, 2, '.', ''));?></td>
                	    			</tr>
                	    			<tr>
                		    			<td></td>
                		    			<td>CASH/BANK CLOSING BALANCE(<?php if (isset($date)){echo date('d/m/Y',strtotime($date));};?>)</td>
                		    			<td style="text-align: right;"><?php echo (number_format($c_tot-$c_tot1, 2, '.', ''));?></td>
                		    			<td style="text-align: right;"><?php echo (number_format($b_tot-$b_tot1, 2, '.', ''))?></td>
                	    			</tr>
                	    			<tr>
                	    				<td></td>
                	    				<td></td>
                	    				<td style="text-align: right;"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    			</tr>
                		    	</tbody>
                			</table>
                		</div>
                	</div>
                </div>
                </div>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
<script>
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>
