 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
            font-size:12px;
	        }
	    </style>
	</head>
 <?php  ?>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					<strong style="margin-bottom: 5px;color: #ea6227;"><?php if ($type=="1"){echo "COUNTER";}elseif ($type=="2"){echo "ONLINE";}?></strong> - DAILY POOJA SUMMARY FOR THE DATE : <?php echo date('d-m-Y',strtotime($date));?></h4>
    					</td>
    				</tr>
    				<tr>
    				    <th style="width: 10%">SL NO </th>
                        <th style="width: 50%">BILL NO</th>
                        <th style="width: 20%">Qrcode</th>
                        <th style="width: 20%">Cash</th>
                     <th style="width: 20%">NEFT</th>
                      <th style="width: 20%">Postal Charges</th>
                        <th style="width: 20%;text-align: right;">BILL AMOUNT</th>
                     <th style="width: 20%;text-align: right;">Recvd Amount</th>
                     <th style="width: 20%;text-align: right;">Bal Amount</th>
    				</tr>
				</thead>
				<?php 
                        $total=0;$rtot=0;
            $i=0;$qrtot=0;$cashtot=0;$postaltot=0;$postalamt=0;$baltot=0;$nefttot=0;
                        if(!empty($bill_list)){
						//$i=0;$qrtot=0;$cashtot=0;$postaltot=0;$postalamt=0;$baltot=0;
	                    foreach($bill_list as $val){
                       
	                        $count=$val['count'];
	                        if ($count=="0"){
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }else {
	                            $href=base_url("index.php/admin/admin/sche_print/".$val['id']);
	                        }
	                        $this->db->select('billing.*,SUM(billing_dtls.qlt),SUM(billing_dtls.rate),SUM(billing_dtls.amount) as tot,SUM(billing_dtls.postal_amt) as postal_amt');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls ','billing_dtls.bill_id=billing.id');
	                        $this->db->where('billing.id', $val['id']);
	                        $query = $this->db->get()->result_array();
                         $po_amt=$query[0]['postal_amt'];
                          if($po_amt==""){$po_amt=0;}
                      //  $postalamt+=$po_amt;
                     $postaltot+=$po_amt;
            $rtot+=$query[0]['recv_amt'];
         
            
            ?>
                        
	                       
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></td>
                     <td style="width: 20%;text-align: right;">
                     <?php if($query[0]['mode'] == 6) {
                    echo $query[0]['tot'];
                            $qrtot+=$query[0]['tot'];
 } ?>              &nbsp;      </td>
                     <td style="width: 20%;text-align: right;">
                     <?php if($query[0]['mode'] == 1) {
                            $cashtot+=$query[0]['tot'];
                    echo $query[0]['tot'];
 } ?>              &nbsp;      </td>
                     <td style="width: 20%;text-align: right;">
                     <?php if($query[0]['mode'] == 5) {
                            $nefttot+=$query[0]['tot'];
                    echo $query[0]['tot'];
 } ?>              &nbsp;      </td>
                     <td style="width: 20%;text-align: right;">
                      <?php echo $po_amt; ?></td>
					 <td style="width: 20%;text-align: right;"><?= ($query[0]['tot']+$po_amt); ?></td>
                     <td style="width: 20%;text-align: right;"><?= $query[0]['recv_amt'];$baltot+=(($query[0]['tot']+$po_amt)-$query[0]['recv_amt']); ?></td>
					 <td style="width: 20%;text-align: right;"><?= (($query[0]['tot']+$po_amt)-$query[0]['recv_amt']); ?></td>
                  </tr>
				  </tbody>
					<?php 
					$total=$total+$query[0]['tot']+$po_amt;
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:right;">No Data Found!</td></tr></tbody>	
					<?php } ?>
                    <tr>
                        <th></th>
                        <th></th>
                    
                     <th style="text-align:right;"><?php echo $qrtot; ?></th>
                        <th style="text-align:right;"><?php echo $cashtot; ?></th>
                     <th style="text-align:right;"><?php echo $nefttot; ?></th>
                     <th><?php echo $postaltot; ?></th>
                        <th style="text-align: right;"><?php echo $total;?></th>
                     <th style="text-align: right;"><?php echo $rtot;?></th>
                      <th style="text-align: right;"><?php echo ($baltot);?></th>
                    </tr>
			</table>
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