 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
	        }
        	td{
            	height:0.8cm;
        	}
            .grid-container {
                display: grid;
                grid-template-columns: auto auto;
            }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
    
	<?php
		//$search_date=$datef;
		//$search_datet=$datet;
   
      $first_day_this_month = date('m-01-Y'); // hard-coded '01' for first day
      $last_day_this_month  = date('m-t-Y');
    
		if(@$_POST['datef']==""){
		    $search_date=date('Y-m-d');
		    $search_datet=date('Y-m-d');
		}
      else {$search_date=$datef;
            $search_datet=$datet;
           }
		$convertDate = date("Y-m-d", strtotime($search_date));
		$convertDate1 = date("Y-m-d", strtotime($search_datet));
	
		$pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
 
        $pay1=$pay['payment'];
		$rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec1=$rec['receipt'];
        $open_cash=$rec1-$pay1;
      
        $pay2 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
        $pay3=$pay2['payment'];
		$rec2 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate'and `type`='2'")->row_array();
        $rec3=$rec2['receipt'];
        $open_bank=$rec3-$pay3;
  
      //opening bank & cash ends here
      
		
        $totalpay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  payment_date between '$convertDate' and '$convertDate1' and `type`='1'")->row_array();
 
        $totalpay1=$pay['payment'];
		$totalrec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND payment_date between '$convertDate' and '$convertDate1' and `type`='2'")->row_array();
        $totalrec1=$rec['receipt'];
        $totalopen_cash=$rec1-$pay1;
      
        $totalpay2 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND payment_date between '$convertDate' and '$convertDate1' and `type`='1'")->row_array();
        $totalpay3=$pay2['payment'];
		$totalrec2 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND payment_date between '$convertDate' and '$convertDate1'and `type`='2'")->row_array();
        $totalrec3=$rec2['receipt'];
        $totalopen_bank=$rec3-$pay3;
      // total opening bank and cash ends here aakethuka
      // 
      
      $closing_bank=0;
      
      	$close_cash_pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='1'")->row_array();
        $pay4=$close_cash_pay['payment'];
		$close_cash_rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='2'")->row_array();
        $rec4=$close_cash_rec['receipt'];
        $close_cash=($open_cash+$rec4)-$pay4;
      
        $close_bank_pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='1'")->row_array();
        $pay5=$close_bank_pay['payment'];
		$close_bank_rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='2'")->row_array();
        $rec5=$close_bank_rec['receipt'];
        $closing_bank=($open_bank+$rec5)-$pay5;
    //  print "SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='1'";

   ?>
			<div id="printer">
            	<div>
                	<div style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                			വരവ് ചിലവ് കണക്ക്(<?php if (isset($search_date)){echo date('d-m-Y',strtotime($search_date));}?> മുതൽ <?php if (isset($search_datet)){echo date('d-m-Y',strtotime($search_datet));}?> വരെ)</h4>
            		</div>		
            	</div>
            	<div class="grid-container">
                	<div class="grid-item">
                		<div>
                			<table border="1" style="border-collapse: collapse;float: right;" id="table1">
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;">വരവ്</th>
                    				</tr>
									<tr>
                    			    	<th scope="col" width=""></th>
                    			    	<th scope="col" width="">ഇനവിവരം</th>
                    			         <th scope="col" width="">ക്യാഷ്</th>
                    			    	<th scope="col" width="">ബാങ്ക്</th>
                    		    	</tr>
                    				<tr>
                		    			<td></td>
                		    			<td>കയ്യിരുപ്പ്</td>
                		    			<td style="text-align: right;"><?php echo (number_format($open_cash, 2, '.', ''));?></td>
                		    			<td style="text-align: right;">0.00</td>
                	    			</tr>
                	    			<tr>
                		    			<td></td>
                		    			<td>ബാങ്ക് ബാലൻസ്</td>
                                    	<td style="text-align: right;">0.00</td>
                		    			<td style="text-align: right;"><?php echo (number_format($open_bank, 2, '.', ''));?></td>
                		    			
                	    			</tr>
                	    			<?php 
                	    			$i=0;
                	    			$c_tot=0;
                	    			$b_tot=0;
                            $ledtotr=0;
                            $ledtotp=0;
                	    			$c_tot=$c_tot+$open_cash;
                	    			$b_tot=$b_tot+$open_bank;
                	    			$this->db->select('*');
                	    			$this->db->from('ledger');
                	    			$this->db->where('ledger.is_delete !=', 1);
                                        // $this->db->where('ledger.group !=', 2);
                                        //    $this->db->where('ledger.group !=', 3);
                	    			$query2 = $this->db->get()->result_array();
                	    			foreach ($query2 as $val){
                	    			    $led_id=$val['led_Id'];
                	    			    $led_mal=$val['name_mal'];
                	    			    $sdf = $this->db->query("SELECT sum(amount) as receipt FROM `payment`  join ledger on payment.mode=ledger.led_Id WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and payment.is_delete!=1 and `type`='2' and ledger='$led_id' and ledger.group=2 ")->row_array();
                	    			//print "SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and  `type`='2' and is_delete!=1 and ledger='$led_id'";   
                                  //  print  "SELECT sum(amount) as receipt FROM `payment`  join ledger on payment.ledger=ledger.led_Id WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and payment.is_delete!=1 and `type`='2' and ledger='$led_id' and ledger.group=2 ";  
                                    
                                    $amd=$sdf['receipt'];
                	    			    $sdf1 = $this->db->query("SELECT sum(amount) as receipt FROM `payment` join ledger on payment.mode=ledger.led_Id  WHERE `payment_date` >= '$convertDate' and  `payment_date` <= '$convertDate1' and `type`='2' and ledger='$led_id' and ledger.group=3  and payment.is_delete!=1")->row_array();
                	    			    $amdtot=$sdf1['receipt'];
                	    			    $c_tot=$c_tot+$amd;
                	    			    $b_tot=$b_tot+$amdtot;
                                    $ledtotr+=$amd;
                                    
                                   //  $totalcashtotal=$open_cash+$amd;print $totalcashtotal;
                	    			    if ($amd!=""||$amdtot!="") {
                	    			    ?>
                	    			    <tr>
                	    			    	<td><?php echo ++$i;?></td>
                	    			    	<td><?php echo $led_mal;?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amd, 2, '.', ''));?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amdtot, 2, '.', ''));?></td>
                	    			    </tr>
                	    			    <?php
                	    			    }
                	    			}
									$grosscash=$open_cash+$ledtotr;
                	    			?>
              	    			
                	    			<tr>
                	    				<td></td>
                		    			<td></td>
                		    			<td></td>
                		    			<td></td>
                	    			</tr>
                	    			<tr>
                	    				<td></td>
                		    			<td></td>
                		    			<td></td>
                		    			<td></td>
                	    			</tr>
                	    			<tr>
                	    				<td></td>
                	    				<td>ആകെ</td>
                	    				<td style="text-align: right;"><?php echo (number_format($grosscash, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    			</tr>
                		    	</tbody>
                			</table>
                		</div>
                	</div>
                	<div class="grid-item">
                		<div>
                			<table border="1" style="border-collapse: collapse;float: right;" id="table2">
                				<thead>
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;">ചിലവ്</th>
                    				</tr>
                    				<tr>
                    			    	<th scope="col" width="">ഇനവിവരം</th>
                    			    	<th scope="col" width="">ക്യാഷ്</th>
                    			    	<th scope="col" width="">ബാങ്ക്</th>
                    		    	</tr>
                		    	</thead>
                		    	<tbody>
                		    		<tr>
                		    			<td></td>
                		    			<td>&nbsp;<td>
                                
                		    			
                	    			</tr>
                	    			<tr>
                		    			<td></td>
                		    			<td>&nbsp;<td>
                                  
                		    			
                	    			</tr>
                	    			<?php 
                	    			$c_tot1=0;
                	    			$b_tot1=0;
                	    			$this->db->select('*');
                	    			$this->db->from('ledger');
                	    			$this->db->where('ledger.is_delete !=', 1);
                                    // $this->db->where('ledger.group !=', 2);
                                    //        $this->db->where('ledger.group !=', 3);
                	    			$query2 = $this->db->get()->result_array();
                	    			foreach ($query2 as $val){
                	    			    $led_id=$val['led_Id'];
                	    			    $led_mal=$val['name_mal'];
                	    			    $sdf = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and is_delete!=1 and `type`='1' and ledger='$led_id' and mode=9")->row_array();
                	    			    $amd=$sdf['receipt'];
                	    			    $sdf1 = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE  `payment_date` >= '$convertDate' and `payment_date` <= '$convertDate1' and `type`='1' and ledger='$led_id'  and is_delete!=1 and mode!=9")->row_array();
                	    			    $amdtot=$sdf1['receipt'];
                	    			    $c_tot1=$c_tot1+$amd;
                	    			    $b_tot1=$b_tot1+$amdtot;
                	    			    if ($amd!=""||$amdtot!="") {
                	    			    ?>
                	    			    <tr>
                	    			    	<td><?php echo $led_mal;?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amd, 2, '.', ''));?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amdtot, 2, '.', ''));?></td>
                	    			    </tr>
                	    			    <?php
                	    			    }
                	    			}
                	    			?>
                	    			<tr>
                		    			<td>കയ്യിരുപ്പ്</</td>
                		    			<td style="text-align: right;"><?php echo (number_format(($grosscash-$c_tot1), 2, '.', ''));?></td>
                		    			<td style="text-align: right;"><?php echo (number_format(($b_tot-$b_tot1), 2, '.', ''));?>0</td>
                	    			</tr>
                	    			<?php $close_cash=($grosscash-$c_tot1)+$c_tot1; 
                                
                                           $close_bank=(($b_tot-$b_tot1))+$b_tot1; ?>
                                
                            		<tr>
                	    				<td>ആകെ</td>
                	    				<td style="text-align: right;"><?php echo (number_format($close_cash, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    			</tr>
                		    	</tbody>
                			</table>
                		</div>
                	</div>
                </div>
            </div>
	</body>
</html>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/accounts/incomeExpense_rprt" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/accounts/incomeExpense_rprt";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

$( document ).ready(function() {
    var count = $('#table1 tr').length;
    var count1 = $('#table2 tr').length;
    var diff = count1-count;
    var a;
    if(count>count1){
      for(a=0;a<diff;a++){
       $('#table1').closest('table').find('tr:last').prev().after('<tr><td>&nbsp;</td><td></td><td></td><td></td></tr>');
      }
    }
    else{
      for(a=0;a<diff;a++){
       $('#table1').closest('table').find('tr:last').prev().after('<tr><td>&nbsp;</td><td></td><td></td><td></td></tr>');
      }
    }

});
</script>