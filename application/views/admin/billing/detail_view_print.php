 <html>
	<head>
	<style>
    th, td {
        padding: 5px;
    }

    thead.print-only,
    tfoot.print-only {
        display: none;
    }

    @media print {
        thead.print-only {
            display: table-header-group;
        }

        /* Show tfoot only on the last printed page */
        tfoot.print-only {
            display: table-footer-group;
        }
    }
</style>
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
        	<style>
    th, td {
        padding: 5px;
    }

    thead.print-only,
    tfoot.print-only {
        display: none;
    }

    @media print {
        thead.print-only {
            display: table-header-group;
        }

        /* Show tfoot only on the last printed page */
        tfoot.print-only {
            display: table-footer-group;
        }
    }
</style>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead class="print-only">
    				<tr>
    					<td colspan="11" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                        <?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br>
                        Pooja booking done between <?php echo date('d-m-Y',strtotime($from));?> To <?php echo date('d-m-Y',strtotime($to));?></h4>
    					</td>
    				</tr>
    				<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name of the Pooja</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" style="text-align:right">Rate</th>
                      <th scope="col" style="text-align:right">Cash</th>
                      <th scope="col" style="text-align:right">UPI</th>
                     <th scope="col" style="text-align:right">NEFT</th>
                     <th scope="col" style="text-align:right">CARD</th>
                     <th scope="col" style="text-align:right">MO</th>
                     <th scope="col" style="text-align:right">Postal Charges</th>
                      <!--  <th scope="col" style="text-align:right">Received Amount</th>
                      <th scope="col" style="text-align:right">Balance Amount</th>-->
					  <th scope="col" style="text-align:right">Amount</th>
					</tr>
				  </thead>
					<?php 
					$tot="0";$postal_amt_tot=0;$cashtot=0;
             $qrtot=0;$cardtot=0;$nefttot=0;$motot=0;
           // print_r($bill_list);exit;
					if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){ 
	                       // $qty=$val['quantity'];
	                        //$pooja_rt=$val['pooja_rt'];
                            //$postal_amt=$val['postal_amt'];
                            //
                             $qty=$val->quantity;
	                        $pooja_rt=$val->pooja_rt;
                            $postal_amt=$val->postal_amt;
	                             
                         // $amt=$val['amt'];
                         //if($val['diety_id'];
                       // $amt=$val['amt'];
                        if($val->pooja_id=='9000'){$amt=$val->amt;}else{
                        $amt=$val->amt;}
                            $gross=$amt+$postal_amt;
	                        $tot+=$gross;
                            $postal_amt_tot+=$postal_amt;
                        	$recvd_amt = $val->recv_amt;
                        	$bal_amt = $val->bal_amt;
                         
                        
                        
                        
	                        ?>
				 <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					 <td><?= $val->pooja; ?></td>
					 <td><?= $qty;?></td>
					 <td style="text-align:right"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[1] > 0 ){$cashtot+= $val->amount_array[1];echo $val->amount_array[1] ?? 0;}?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[6] > 0 ){$qrtot+=$val->amount_array[6];echo $val->amount_array[6] ?? 0;}?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[5] > 0 ){$nefttot+=$val->amount_array[5];echo $val->amount_array[5] ?? 0;}?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[7] > 0 ){$cardtot+=$val->amount_array[7];echo $val->amount_array[7] ?? 0;}?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[8] > 0 ){$motot+=$val->amount_array[8];echo $val->amount_array[8] ?? 0;}?></td>
                    <td style="text-align:right"><?php echo $postal_amt;?></td>
                  
                    <!--  <td style="text-align:right"><?php echo $recvd_amt;?></td>
                     <td style="text-align:right"><?php echo $bal_amt;?></td>-->
					 <td style="text-align:right"><?= number_format((float)$gross, 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					
    					<tr>
    					   
                       
    					 <th colspan="4">Total</th>
                         <th style="text-align:right"><?= number_format((float)$cashtot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$qrtot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$nefttot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$cardtot, 2, '.', '');?></th>
                                                 <th style="text-align:right"><?= number_format((float)$motot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$postal_amt_tot, 2, '.', '');?></th>
    					    <th style="text-align:right"><?= number_format((float)$tot, 2, '.', '');?></th>
					    </tr>
                    	<tr>
    					 <th colspan="11">Total Cash in Hand: <?= number_format((float)($cashtot+$motot), 2, '.', '');?></th>
                         
					    </tr>
					
				</table>
				<?php if(!empty($bill_listdeleted)){ ?>
				<small>Pooja booking Deleted between <?php echo date('d-m-Y',strtotime($from));?> To <?php echo date('d-m-Y',strtotime($to));?><small>
				<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Diety</th>
					  <th scope="col" width="">Total</th>
                     <th scope="col" width="">Recvd</th>
                     <th scope="col" width="">Balance</th>
                     <th scope="col" width="">Delete Date</th>
                     <th scope="col" width="">Reason</th>
					  
					</tr>
				  </thead>
					<?php 
                        $total=0;$rtot=0;
                        $role=$this->loggedIn['role'];
                        $today=date('Y-m-d');
                        $query1 = $this->db->query("SELECT pay_id FROM `payment` where payment_date='$today' AND (ledger='6' OR ledger='7')")->result_array();
                        if(!empty($bill_list)){
						$i=0;$baltot=0;$rtot=0;
	                    foreach($bill_listdeleted as $val){
	                        $count=$val['count'];
	                        $status=$val['status'];
	                        if ($count=="0"&&$status=="1"){
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }else {
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }
	                        $this->db->select('billing.*,SUM(billing_dtls.amount) as tot');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls ','billing_dtls.bill_id=billing.id');
	                      
	                        $this->db->where('billing.id', $val['id']);
	                        $query = $this->db->get()->result_array();
                       
                        $balance=$query[0]['tot']-$query[0]['recv_amt'];
                    
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></a></td>
					 <td><?= $val['diety']; ?></td>
					 <td><?= $query[0]['tot']; ?></td>
                     <td><?= $query[0]['recv_amt']; $rtot+=$query[0]['recv_amt'] ?></td>
                     <td><?= $balance; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['dl_date'])); ?></td>
					 <td><?= $val['dl_reason']; ?></td>
			 		 
					</tr>
				  </tbody>
					<?php 
					$total=$total+$query[0]['tot'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="12" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="3">Total</th>
							<th><?php echo $total;?></th>
                        <th><?php echo $rtot;?></th>
                        <th><?php echo ($total-$rtot);?></th>
							<th colspan="3"></th>
						</tr>
					</tfoot>	
				</table>
				<?php } ?>
        		<div style="text-align:right"> Print generated at <?php echo date('Y-m-d H:i:s'); ?> </div>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>