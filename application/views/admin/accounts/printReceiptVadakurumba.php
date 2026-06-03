<html>
	<head>
    	<style>
        	.page-break {
            	page-break-after: always;
        	}
        
        	@media print {
            	@page {
            		size: 210mm 99mm !important;
                	margin: 5px;
            	}
        	}
        
        	p {
        		margin:0; 
        	}
        
        	p.underline {
    border-bottom: 1px dotted #000; /* 1px dotted line with black color */
    width: 100%; /* Full width */
}
    	</style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<table border="1" style="border-collapse:collapse;width:100%; ">
			    <thead>
    				<tr>
    					<td colspan="8" style="width:100%;">
                        	<h4 style="text-align:center;">
                        	<?php print_r($temple_list[0]['name']);?><br>
    						<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?>
                            </h4>
    					</td>
    				</tr>
    				<tr>
                    <?php date_default_timezone_set( 'Asia/Calcutta' );
                           $currentDate = date( 'd-m-Y' );
                            // print_r(date('d-m-Y',strtotime($paymentData[0]['date'])));
                       ?>
    					<th colspan="8"><label style="float:left;">REC<?php print_r($receiptData[0]['f_year']) ?> - <?php print_r($receiptData[0]['voucher_no']);?></label>
					        <label style="float:center;">RECEIPT</label>
    					    <label style="float:right;font-size:bold;">Date : <?php print date('d-m-Y',strtotime($receiptData['0']['payment_date']))?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <td style="max-width:1cm;">Name</td>
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
				        $total += $amount;
				        ?>
				        <tr>
				            <td><?php echo $ledger;?></td>
                        	<td><?php echo $narration;?></td>
                            <td style="text-align:right"><?php echo $amount;?>/-</td>
				        </tr>
				    <?php 
				        $i++;
				    } endif;?>
                	
				</tbody>
                <br>
				
<!--            <tr><td colspan="3">Authorised  By <?php print $_SESSION['admin']['name'];?> -->
			</table>
            <div style="margin-top:1em; ">
            	<div style="width:100%; display: -webkit-box !important; display: -ms-flexbox !important; display: flex !important;justify-content: space-between !important;"> 
                	<p class="underline"><?php echo $total; ?></p> <p>സംഖ്യ </p>
            	</div>
            	<div style="width:100%; display: -webkit-box !important; display: -ms-flexbox !important; display: flex !important;">
                	<p>കിട്ടി ബോധിച്ചു.</p>
            	</div>
            	<div style="width:100%; display: -webkit-box !important; display: -ms-flexbox !important; display: flex !important;"> 
                	<p>പേരും ഒപ്പും </p> <p class="underline"> </p>
            	</div>
        	</div>
        	<div style="text-align:right; margin-top:1em">
            	പ്രസിഡന്റ് / സെക്രട്ടറി 
        	</div>
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