 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
	        }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                        <?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br>
                        Pooja booking done between <?php echo date('d-m-Y',strtotime($from));?> To <?php echo date('d-m-Y',strtotime($to));?></h4>
    					</td>
    				</tr>
    				<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name of the Pooja</th>
					  <th scope="col" width="">Quantity</th>  
					  <th scope="col" style="text-align:right">Rate</th>
					  <th scope="col" style="text-align:right">Amount</th>
                      <th scope="col" style="text-align:right">Postal</th>
                      <th scope="col" style="text-align:right">Total</th>
					</tr>
				  </thead>
					<?php 
					$tot="0";$postal_amt_tot=0;
					if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){ 
	                        $qty=$val['quantity'];
	                        $pooja_rt=$val['pooja_rt'];
                            $postal_amt=$val['postal_amt'];
	                             
                         // $amt=$val['amt'];
                         //if($val['diety_id'];
                       // $amt=$val['amt'];
                       if($val['pooja_id']=='9000'){$amt=$val['amt'];}else{
                        //$amt=$pooja_rt*$qty;}
                       $amt=$val['amt'];
                       }   
                       $gross=$amt;
                        $postal=$val['postal_amt'];
	                        $tot+=$gross;
                            $postal_amt_tot+=$postal_amt;
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					 <td><?= $val['pooja'];?></td>
					 <td><?= $qty;?></td>
					 <td style="text-align:right"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
                  
					 <td style="text-align:right"><?= number_format((float)$gross, 2, '.', '');?></td>
                     <td style="text-align:right"><?= number_format((float)$postal, 2, '.', '');?></td>
                     <td style="text-align:right"><?= number_format((float)($postal+$gross), 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php } }
                     else {
					?>	
					<tbody><tr><td colspan="5" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
    					<tr>
    					    <th></th>
                       
    					    <th colspan="3">Total</th>
                         
    					    <th style="text-align:right"><?= number_format((float)$tot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$postal_amt_tot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)($postal_amt_tot+$tot), 2, '.', '');?></th>
					    </tr>
					</tfoot>
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