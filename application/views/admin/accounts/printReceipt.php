<html>
	<head>
    	<style>
        .page-break {
            page-break-after: always;
        }
    </style>
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
    					<th colspan="8"><label style="float:left;">Date : <?php print date('d-m-Y',strtotime($receiptData['0']['payment_date']))?></label>
					        <label style="float:center;">RECEIPT</label>
    					    <label style="float:right;font-size:bold;">REC<?php print_r($receiptData[0]['f_year']) ?> - <?php print_r($receiptData[0]['voucher_no']);?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <td style="max-width:1cm;">Sl No</td>
    				    <td>Particulars</td>
    				    <td>Amount</td>
    				  
    				   
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
                	
                	if($receiptData):

				    foreach($receiptData as $val){ 
				        $ledger=$val['name'];
				        $amount=$val['amount'];
				        $narration=$val['narration'];
				        
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
                        <td><?php echo $ledger;?><br><i><?php echo $narration;?></i></td>
                            <td style="text-align:right"><?php echo $amount;?>/-</td>
				          
				          
				           
				        </tr>
				    <?php 
				        $i++;
				    } endif;?>
                	
				</tbody>
                <br>
				<tfoot>
				    <!-- <tr>
				        <th></th>
				        <th colspan="5" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $total;?>/-</th>
				        <th></th>
				    </tr> -->
				  
				</tfoot>
           <tr><td colspan="3">Authorised  By <?php print $_SESSION['admin']['name'];?>
			</table>
            
            <div class="page-break"></div>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/accounts/viewReceipt" }, 500); }
function myFunction(){
	console.log(window.history.back());
    window.location = "<?php echo base_url();?>index.php/accounts/viewReceipt";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>