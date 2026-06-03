 <html>
	<head>
	    <style>
	        th , td{
	            padding:2px;
               
	        }
            .grid-container {
                display: grid;
                grid-template-columns: auto auto;
            }
    		table td{
        		height:1.5cm;
            	
        	}
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<?php
    
     $search_date=$date;
     if($search_date==""){
         $search_date=date('Y-m-d');
     }
     $convertDate = date("Y-m-d", strtotime($search_date));
	 $search_dateto=$dateto;
     if($search_dateto==""){
         $search_dateto=date('Y-m-d');
     }
     $convertDateto = date("Y-m-d", strtotime($search_dateto));

     $payment = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
  
     $pay=$payment['payment'];
    

        $receipt = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec=$receipt['receipt'];
          
    $open_cash=$rec-$pay;
    
    $payment1 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
    
    $pay1=$payment1['payment'];
    
    
    $receipt1 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
    $rec1=$receipt1['receipt'];
    
    $open_bank=$rec1-$pay1;
        

//TOTAL DEBIT & CREDIT

$payment = $this->db->query("SELECT sum(amount) as payment FROM `payment` WHERE `payment_date` = '$convertDate' and type='1'")->result_array();
  
          foreach($payment as $val){ 
          $total_debit=$val['payment'];
        }

     $receipt = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` = '$convertDate' and type='2'")->result_array();
  
          foreach($receipt as $val){ 
          $total_credit=$val['receipt'];
        }
        $this->db->select('payment.*,ledger.*,ledger.name_mal as led_mal, payment.payment_date as date');
        $this->db->from('payment');
        $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
        $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
        $this->db->where("payment.payment_date BETWEEN '$convertDate' AND '$convertDateto'");
        $this->db->where('payment.type', 2);
        $this->db->where('payment.is_delete !=', 1);
    	$this->db->order_by('payment.payment_date', 'asc');
        $query2 = $this->db->get()->result_array();
        
        $this->db->select('payment.*,ledger.*,ledger.name_mal as led_mal, payment.payment_date as date');
        $this->db->from('payment');
        $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
        $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
        $this->db->where("payment.payment_date BETWEEN '$convertDate' AND '$convertDateto'");
        $this->db->where('payment.type', 1);
        $this->db->where('payment.is_delete !=', 1);
    	$this->db->order_by('payment.payment_date', 'asc');
        $query3 = $this->db->get()->result_array();
        
        $count=count($query2);
        $count1=count($query3);

   ?>
			<div id="printer">
            	<div>
                	<div style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?> <br>
					Cash Book From Date <?php if (isset($date)){echo date('d-m-Y',strtotime($date));};?> to <?php if (isset($dateto)){echo date('d-m-Y',strtotime($dateto));};?></h4>
            		</div>		
            	</div>
            	<div class="grid-container">
                	<div class="grid-item">
                		<div>
                			<table border="1" style="border-collapse: collapse;">
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;">വരവ്</th>
                    				</tr>
                    				<tr>
                    			    	<th>R. No</th>
                                    	<th scope="col" width="">Date</th>
                    			    	<th>ഇനവിവരം</th>
                    			    	<th>ക്യാഷ്</th>
                    			    	<th>ബാങ്ക്</th>
                    		    	</tr>
                		    	</thead>
                		    	<tbody>
                		    		<tr>
                		    			<td></td>
                                    	<td><?php if (isset($date)){echo date('d/m/Y',strtotime($date));};?></td>
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
                	    			    <tr>
											<td><?php echo $val['voucher_no']?></td>
                                        	<td><?php echo $val['date'];?></td>
                	    			    	<td style="width:10%;"><?php echo $val['led_mal'];?><br><?php echo $val['narration']?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($cash, 2, '.', ''));?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($bank, 2, '.', ''));?></td>
                	    			    </tr>
                	    			    <?php
                	    			}
                	    			if ($count<$count1){
                	    			    $diff=abs($count - $count1);
                	    			    for ($i=0;$i<$diff;$i++){
                	    			        echo '<tr><td>#</td><td></td><td></td><td></td><td></td></tr>';
                	    			    }
                	    			}
                	    			?>
                	    			<tr>
                	    				<td></td>
                                    	<td></td>
                	    				<td>ആകെ</td>
                	    				<td style="text-align: right;"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    			</tr>
                	    			<tr>
                	    				<td>#</td>
                                    	<td></td>
                		    			<td></td>
                		    			<td></td>
                		    			<td></td>
                	    			</tr>
                	    			<tr>
                	    				<td></td>
                                    	<td></td>
                	    				<td>ആകെ</td>
                	    				<td style="text-align: right;"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    			</tr>
                		    	</tbody>
                			</table>
                		</div>
                	</div>
                	<div class="grid-item">
                		<div>
                			<table border="1" style="border-collapse: collapse;">
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;">ചിലവ്</th>
                    				</tr>
                    				<tr>
                    			    	<th>Vr. No</th>
                                    	<th>Date</th>
                    			    	<th>ഇനവിവരം</th>
                    			    	<th>ക്യാഷ്</th>
                    			    	<th>ബാങ്ക്</th>
                    		    	</tr>
                		    	</thead>
                		    	<tbody>
                		    		<tr>
                		    			<td>#</td>
                		    			<td></td>
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
                	    			    <tr>
											<td><?php echo $val['voucher_no'];?>
                                            <td><?php echo $val['date'];?></td>
                	    			    	<td  style="10%"><?php echo $val['led_mal'];?><br><?php echo $val['narration']?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($cash, 2, '.', ''));?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($bank, 2, '.', ''));?></td>
                	    			    </tr>
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
                                    	<td></td>
                	    				<td>ആകെ</td>
                	    				<td style="text-align: right;"><?php echo (number_format($c_tot1, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot1, 2, '.', ''));?></td>
                	    			</tr>
                	    			<tr>
                		    			<td></td>
                                    	<td><?php if (isset($date)){echo date('d/m/Y',strtotime($date));};?></td>
                		    			<td>CASH/BANK CLOSING BALANCE(<?php if (isset($date)){echo date('d/m/Y',strtotime($date));};?>)</td>
                		    			<td style="text-align: right;"><?php echo (number_format($c_tot-$c_tot1, 2, '.', ''));?></td>
                		    			<td style="text-align: right;"><?php echo (number_format($b_tot-$b_tot1, 2, '.', ''))?></td>
                	    			</tr>
                	    			<tr>
                	    				<td></td>
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
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/accounts/cashbook_twodays" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/accounts/cashbook_twodays";
}
function printcontend(value) {
	var table = document.getElementById("printer");
        var html = table.outerHTML;

        var blob = new Blob([html], {type: "application/vnd.ms-excel"});
        var url = URL.createObjectURL(blob);

        var a = document.createElement("a");
        a.href = url;
        a.download = "data.xls";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
}

</script>