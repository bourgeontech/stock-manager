<html>
	<head>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<table border="1" style="border-collapse:collapse;width:100%;">
			    <thead>
    				<tr>
    					<td colspan="8" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
    					</td>
    				</tr>
    				<tr>
                    <?php date_default_timezone_set( 'Asia/Calcutta' );
                           $currentDate = date( 'd-m-Y' );
                            // print_r(date('d-m-Y',strtotime($paymentData[0]['date'])));
                       ?>
    					<th colspan="8"><label style="float:left;">Date : <?php print_r($currentDate);?></label>
					        <label style="float:center;">PAYMENT DETAILS</label>
    					    <label style="float:right;font-size:bold;">PAY20 - <?php print_r($paymentData[0]['pay_Id']);?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <td style="max-width:1cm;">Sl No</td>
    				    <td>LEDGER</td>
    				    <td>AMOUNT</td>
    				    <td>NARRATION</td>
    				    <td>PAYMENT DATE</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
				    foreach($paymentData as $val){ 
				        $ledger=$val['name'];
				        $amount=$val['amount'];
				        $narration=$val['narration'];
				        
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
				            <td><?php echo $ledger;?></td>
                            <td style="text-align:right"><?php echo $amount;?>/-</td>
				            <td><?php echo $narration;?></td>
				          
				            <td><?php echo date('d-m-Y',strtotime($val['payment_date']));?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				</tbody>
                <br>
				<tfoot>
				    <!-- <tr>
				        <th></th>
				        <th colspan="5" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $total;?>/-</th>
				        <th></th>
				    </tr> -->
				    <tr>
				        <th colspan="8" >For more details please visit <a href="<?= $temple_list[0]['website']; ?>"><?= $temple_list[0]['website']; ?></a>   - </th>
				    </tr>
				</tfoot>
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/accounts/viewPayment" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/accounts/viewPayment";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>