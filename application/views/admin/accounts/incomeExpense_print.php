<html>
	<head>
	    
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<?php
	/**	$search_date=$datef;
		$search_datet=$datet;
		if($search_date==""){
		    $search_date=date('Y-m-d');
		    $search_datet=date('Y-m-d');
		}
		$convertDate = date("Y-m-d", strtotime($search_date));
		$convertDate1 = date("Y-m-d", strtotime($search_datet));
		$payment = $this->db->query("SELECT sum(opening_bal) as payment FROM `ledger` WHERE `group`='2'")->row_array();
		$open_cash=$payment['payment'];
		$receipt = $this->db->query("SELECT sum(opening_bal) as receipt FROM `ledger` WHERE `group`='3'")->row_array();
		$open_bank=$receipt['receipt'];
		$pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
		$pay1=$pay['payment'];
		$rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
		$rec1=$rec['receipt'];
		$close=$rec1-$pay1;
		$close_cash=$open_cash+$close;
		$pay2 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
		$pay3=$pay2['payment'];
		$rec2 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
		$rec3=$rec2['receipt'];
		$bank=$rec3-$pay3;
		$close_bank=$open_bank+$bank;
		
		
		$payments = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` <= '$convertDate' and `type`='1'")->row_array();
		$pays=$payments['payment'];
		$receipts = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` <= '$convertDate' and `type`='2'")->row_array();
		$recs=$receipts['receipt'];
		$closing_cash=$recs-$pays;
		$payments1 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` <= '$convertDate' and `type`='1'")->row_array();
		$pays1=$payments1['payment'];
		$receipts1 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` <= '$convertDate' and `type`='2'")->row_array();
		$recs1=$receipts1['receipt'];
		$closing_bank=$recs1-$pays1;
**/
   ?>
    
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
	
		$pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` < '$convertDate' and `type`='1'")->row_array();
 
        $pay1=$pay['payment'];
		$rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec1=$rec['receipt'];
        $open_cash=$rec1-$pay1;
      
        $pay2 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
        $pay3=$pay2['payment'];
		$rec2 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec3=$rec2['receipt'];
        $open_bank=$rec3-$pay3;
  
      //opening bank & cash ends here
      
		
        $totalpay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` < '$convertDate' and `type`='1'")->row_array();
 
        $totalpay1=$pay['payment'];
		$totalrec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $totalrec1=$rec['receipt'];
        $totalopen_cash=$rec1-$pay1;
      
        $totalpay2 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
        $totalpay3=$pay2['payment'];
		$totalrec2 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
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
            <style>
			@media print {
            @page {
      
        size:  auto;
        margin-bottom:20px;
    }
            body {font-family: Arial, sans-serif;}
             table {
      border-collapse: collapse; /* Makes borders clean and connected */
     
    }
            th, td {
      border: 1px solid grey; /* Black border around cells */
      padding: 5px;
     font-size:11px;
            font-weight:bold;
    }
           


            th {font-weight:bold;}
            footer {
        position: static;       /* not fixed */
    text-align: center;
    font-size: 10px;
    color: #555;
    margin-top: 20px;
    page-break-after: avoid; 
    }

    /* Print page numbers */

			}			
            </style>
            	
                	<div class="col-lg-12 col-md-12 col-sm-12 ">
                	<div style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                			Income Expenditure Report From(<?php if (isset($search_date)){echo date('d-m-Y',strtotime($search_date));}?> To <?php if (isset($search_datet)){echo date('d-m-Y',strtotime($search_datet));}?>)</h4>
            		</div>		
            	</div>
                 
            	<table style="width:100%;" id="table3" border="0">
                <tr>
                <td>
				<table class="table table-hover srp_table" width="100%" style="width:100%;"  id="table2">
                				<thead>
                				
                    				<tr>
                    					<th colspan="9" style="text-align: center;">EXPENDITURE</th>
                    				</tr>
                    				<tr>
                                    <th scope="col" width=""></th>
                    			    	<th scope="col" width="">ITEM</th>
                    			    	<th scope="col" width="">AMOUNT</th>
                    			    	<!--<th scope="col" width="">ബാങ്ക്</th>-->
                    		    	</tr>
                		    	</thead>
                		    	<tbody>
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
                                        $this->db->where('ledger.group !=', 2);
                                           $this->db->where('ledger.group !=', 3);
                               $this->db->order_by('ledger.name');
                	    			$query2 = $this->db->get()->result_array();
                	    			foreach ($query2 as $val){
                	    			    $led_id=$val['led_Id'];
                	    			    $led_mal=$val['name'];
                	    			    $sdf = $this->db->query("SELECT sum(amount) as receipt FROM `payment` join ledger on payment.ledger=ledger.led_Id  WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and payment.is_delete!=1 and `type`='2' and ledger='$led_id'")->row_array();
                	    			//print "SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and  `type`='2' and is_delete!=1 and ledger='$led_id'";   
                                        $amd=$sdf['receipt'];
                	    			    $sdf1 = $this->db->query("SELECT sum(amount) as receipt FROM `payment` join ledger on payment.ledger=ledger.led_Id WHERE `payment_date` <= '$convertDate1' and `type`='2' and ledger='$led_id'  and payment.is_delete!=1")->row_array();
                	    			    $amdtot=$sdf1['receipt'];
                	    			    $c_tot=$c_tot+$amd;
                	    			    $b_tot=$b_tot+$amdtot;
                                    $ledtotr+=$amd;
                                    
                                   //  $totalcashtotal=$open_cash+$amd;print $totalcashtotal;
                	    			    if ($amd!=0) {
                	    			    
                	    			    }
                	    			}
                            $grosscash=$open_cash+$open_bank+$ledtotr;
                	    			?>
                	    			<?php 
                                $i=0;
                	    			$c_tot1=0;
                	    			$b_tot1=0;
                                $exptot=0;$net=0;
                	    			$this->db->select('*');
                	    			$this->db->from('ledger');
                	    			$this->db->where('ledger.is_delete !=', 1);
                                    $this->db->where('ledger.group !=', 2);
                              //  $this->db->where('ledger.incomeexpense', 1);
                                      $this->db->where('ledger.group !=', 3);
                                $this->db->order_by('ledger.name');
                	    			$query2 = $this->db->get()->result_array();
                	    			foreach ($query2 as $val){
                	    			    $led_id=$val['led_Id'];
                	    			    $led_mal=$val['name'];
                	    			    $sdf = $this->db->query("SELECT sum(amount) as receipt FROM `payment` join ledger on payment.ledger=ledger.led_id WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and payment.is_delete!=1 and `type`='1' and ledger='$led_id'")->row_array();
                	    			    $amd=$sdf['receipt'];
                	    			    $sdf1 = $this->db->query("SELECT sum(amount) as receipt FROM `payment`join ledger on payment.ledger=ledger.led_id WHERE `payment_date` <= '$convertDate1' and `type`='1' and ledger='$led_id'  and payment.is_delete!=1")->row_array();
                	    			    $amdtot=$sdf1['receipt'];
                	    			    $c_tot1=$c_tot1+$amd;
                	    			    $b_tot1=$b_tot1+$amdtot;
                                    $exptot+=$amdtot;
                	    			    if ($amd!=0) {
                	    			    ?>
                	    			    <tr>
                                        <td><?php echo ++$i; ?></td>
                	    			    	<td><?php echo $led_mal;?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amd, 2, '.', ''));?></td>
                	    			    	<!--<td style="text-align: right;"><?php echo (number_format($amdtot, 2, '.', ''));?></td>
                	    			   --> </tr>
                	    			    <?php
                	    			    }
                	    			}
                	    			?>
                                <tr><td>&nbsp;</td><td></td><td></td></tr>
                                <tr class="total-row"><td></td>
                	    				<td>TOTAL EXPENSE</td>
                	    				<td style="text-align: right;font-weight: 900;"><?php echo (number_format($exptot, 2, '.', ''));?></td>
                	    				<!--<td style="text-align: right;"><?php echo (number_format($close_cash, 2, '.', ''));?></td>-->
                	    			</tr>
                	    			<tr>
                                    <td></td>
                	    				<td>CASH IN HAND</td>
                	    				<td style="text-align: right;font-weight: 900;"><?php echo (number_format($close_cash, 2, '.', ''));?></td>
                	    				<!--<td style="text-align: right;"><?php echo (number_format($close_cash, 2, '.', ''));?></td>-->
                	    			</tr>
                	    			<tr><td></td>
                		    			<td>BANK BALANCE</td>
                		    			<td style="text-align: right;font-weight: 900;"><?php echo (number_format($closing_bank, 2, '.', ''));?></td>
                		    		<!--	<td style="text-align: right;"><?php echo (number_format($closing_bank, 2, '.', ''))?></td>-->
                	    			</tr>
                	    			
                                
                            		<tr><td></td>
                	    				<td>EXPENDITURE TOTAL</td>
                	    				<td style="text-align: right;font-weight: 900;"><?php echo (number_format($exptot+$close_cash+$closing_bank, 2, '.', ''));?></td>
                	    				<!--<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    	-->		</tr>
                                <?php $netexpense=$exptot+$close_cash+$closing_bank;
                                     
                                ?>
                            <?php  if($grosscash>$netexpense){$net=$grosscash-$netexpense;?>    <tr>
                                <td></td>
                	    				<td>INCOME OVER EXPENDITURE</td>
                	    				<td style="text-align: right;font-weight: 900;"><?php echo (number_format($grosscash-$netexpense, 2, '.', ''));?></td>
                	    				<!--<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>-->
                	    		</tr> <?php } ?>
                                
                                <tr><td></td>
                	    				<td>TOTAL</td>
                	    				<td style="text-align: right;font-weight: 900;"><?php echo (number_format($netexpense+$net, 2, '.', ''));?></td>
                	    				<!--<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    	-->		</tr>
                		    	</tbody>
                			</table>
				
				
				
                		
                </td>
                
                 <td>
                	<table class="table table-hover srp_table" style="width:100%;" width="100%"   id="table1">
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;">INCOME</th>
                    				</tr>
                    				<tr>
                    			    	<th scope="col" width=""></th>
                    			    	<th scope="col" width="">ITEM</th>
                    			    	<th scope="col" width="">AMOUNT</th>
                    			    	<!--<th scope="col" width="">ആകെ തുക</th>-->
                    		    	</tr>
                		    	</thead>
								<tbody>
                		    	<!--	<tr>
                		    			<td></td>
                		    			<td>കയ്യിരുപ്പ്</td>
                                    <td style="text-align: right;"><?php echo (number_format($open_cash, 2, '.', ''))?></td>
                		    		<!--	<td style="text-align: right;"><?php echo (number_format($open_cash, 2, '.', ''));?></td>
                		    	
                	    			</tr>
                	    			<tr>
                		    			<td></td>
                		    			<td>ബാങ്ക് ബാലൻസ്</td>
                                    <td style="text-align: right;"><?php echo (number_format($open_bank, 2, '.', ''))?></td>
                		    	<!--		<td style="text-align: right;"><?php echo (number_format($open_bank, 2, '.', ''));?></td>
                            </tr>                		    	-->		

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
                                        $this->db->where('ledger.group !=', 2);
                                           $this->db->where('ledger.group !=', 3);
                               $this->db->order_by('ledger.name');
                	    			$query2 = $this->db->get()->result_array();
                	    			foreach ($query2 as $val){
                	    			    $led_id=$val['led_Id'];
                	    			    $led_mal=$val['name'];
                	    			    $sdf = $this->db->query("SELECT sum(amount) as receipt FROM `payment` join ledger on payment.ledger=ledger.led_Id  WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and payment.is_delete!=1 and `type`='2' and ledger='$led_id'")->row_array();
                	    			//print "SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and  `type`='2' and is_delete!=1 and ledger='$led_id'";   
                                        $amd=$sdf['receipt'];
                	    			    $sdf1 = $this->db->query("SELECT sum(amount) as receipt FROM `payment` join ledger on payment.ledger=ledger.led_Id WHERE `payment_date` <= '$convertDate1' and `type`='2' and ledger='$led_id'  and payment.is_delete!=1")->row_array();
                	    			    $amdtot=$sdf1['receipt'];
                	    			    $c_tot=$c_tot+$amd;
                	    			    $b_tot=$b_tot+$amdtot;
                                    $ledtotr+=$amd;
                                    
                                   //  $totalcashtotal=$open_cash+$amd;print $totalcashtotal;
                	    			    if ($amd!=0) {
                	    			    ?>
                	    			    <tr>
                	    			    	<td><?php echo ++$i;?></td>
                	    			    	<td><?php echo $led_mal;?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amd, 2, '.', ''));?></td>
                	    			 </tr>
                	    			    <?php
                	    			    }
                	    			}
                            $grosscash=$open_cash+$open_bank+$ledtotr;
                	    			?>
                	    			
                        <tr><td>&nbsp;</td><td></td><td></td></tr>
                            <tr class="total-row">
                		    			<td></td>
                		    			<td>TOTAL INCOME</td>
                                    <td style="text-align: right;font-weight: 900;"><?php echo (number_format($ledtotr, 2, '.', ''))?></td>
                		    	<!--		<td style="text-align: right;"><?php echo (number_format($open_bank, 2, '.', ''));?></td>
                		    	-->		
                	    			</tr>
                            <tr>
                		    			<td></td>
                		    			<td>CASH IN HAND</td>
                                    <td style="text-align: right;font-weight: 900;"><?php echo (number_format($open_cash, 2, '.', ''))?></td>
                		    		<!--	<td style="text-align: right;"><?php echo (number_format($open_cash, 2, '.', ''));?></td>
                		    		-->	
                	    			</tr>
                	    			<tr>
                		    			<td></td>
                		    			<td>BANK BALANCE</td>
                                    <td style="text-align: right;font-weight: 900;"><?php echo (number_format($open_bank, 2, '.', ''))?></td>
                		    	<!--		<td style="text-align: right;"><?php echo (number_format($open_bank, 2, '.', ''));?></td>
                		    	-->		
                	    			</tr>
                            	<tr>
                	    				<td></td>
                	    				<td>INCOME TOTAL</td>
                	    				<td style="text-align: right;font-weight: 900;"><?php echo (number_format($grosscash, 2, '.', ''));?></td>
                	    				<!--<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    		-->	</tr>
                            	 <tr>
                	    				
                	    				<td style="text-align: right;">&nbsp;</td>
                                 <td> EXPENDITURE OVER INCOME</td>
                	    			<td style="text-align: right;font-weight: 900;"><?php //echo (number_format($b_tot, 2, '.', ''));?></td>
                	    		</tr> 
                                
                	    			<tr>
                	    				<td></td>
                	    				<td>TOTAL</td>
                	    				<td style="text-align: right;font-weight: 900;"><?php echo (number_format($grosscash, 2, '.', ''));?></td>
                	    				<!--<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    		-->	</tr>
                		    	</tbody>
                			</table>		
                	
                    </td>
                 </tr>
            </table>
			<br/>
   <footer id="footer">
    Generated on: <span id="printTime"></span>
</footer>

<script>
document.getElementById("printTime").innerText = new Date().toLocaleString();
</script>

                	</div>
       
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script>
$( document ).ready(function() {
    
var count = $('#table1 tr').length;
var count1 = $('#table2 tr').length;
var diff = count1-count;
var a;
if(count>count1){
  for(a=0;a<diff;a++){
   $('#table1').closest('table').find('tr:last').prev().after('<tr><td>&nbsp;</td><td></td><td></td></tr>');
  }
}
else{
  for(a=0;a<diff;a++){
  
   $('#table1').closest('table').find('tr').eq(-7).after('<tr><td>&nbsp;</td><td></td><td></td></tr>');
  }

}
setTimeout(function() {
        window.print();
    }, 300); // 300ms delay
});

</script>
        
	</body>
</html>
     
