<html>
	<head>
    	<style>
        	.page-break {
            	page-break-after: always;
        	}
        
        	@media print {
            	@page {
            		size: 210mm 99mm !important;
                	margin: 2px 5px;
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
    					<td colspan="8" style="width:100%; text-align:center;">
                        	<img src="<?php print_r($site_settings->bill_image); ?>" width="50" />
                        	<h4 style="text-align:center; margin:0">
                        	<?php print_r($temple_list[0]['name']);?><br>
    						<small><?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br/>
                            <?php print_r($temple_list[0]['phone']); ?></small>
                            </h4>
                        	<h3 style="text-align:center; margin:5px 0">
                        		<?php print_r($bill_dtls[0]['pooja_nm']);?>
                        	</h3>
    					</td>
                    	
    				</tr>
    				<tr>
                    <?php date_default_timezone_set( 'Asia/Calcutta' );
                           $currentDate = date('d-m-Y' );
                            // print_r(date('d-m-Y',strtotime($paymentData[0]['date'])));
                       ?>
    					<th colspan="8"><label style="float:left;">Bill No: <?php print_r($booking_details->bill_id) ?> </label>
					        <label style="float:center;">RECEIPT</label>
    					    <label style="float:right;font-size:bold;">Bill Date : <?php print $currentDate; ?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <td style="max-width:1cm;">Name</td>
                    	<td>Contact No</td>
                    	<td>Address</td>
    				    <td>Date</td>
                    	<td>Booking No</td>
    				    <td style="text-align:right">Total</td>
                    	<td style="text-align:right">Advance</td>
                    	<td style="text-align:right">Balance</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
                	
                	if($booking_details): 

				    	$name=$booking_details->name;
				        $amount=$booking_details->amount;
                		$booking_number=$booking_details->booking_number;
                		$advance=$booking_details->advance_amount;
                        $contact_number=$booking_details->contact_number_1 ?? $booking_details->contact_number_2;
				        $address=$booking_details->address;
                        $date = date('d-m-Y',strtotime($booking_details->date));
				        $total += $amount;
				        ?>
				        <tr>
				            <td><?php echo $name;?></td>
                        	<td><?php echo $contact_number;?></td>
                        	<td><?php echo $address;?></td>
                        	<td><?php echo $date;?></td>
                        	<td><?php echo $booking_number;?></td>
                            <td style="text-align:right"><?php echo $amount;?>/-</td>
                        	<td style="text-align:right"><?php echo $advance;?>/-</td>
                        	<td style="text-align:right"><?php echo ($amount - $advance);?>/-</td>
				        </tr>
				        
				    <?php 
                	
				   endif;?>
                	
				</tbody>
                <br>
				
<!--            <tr><td colspan="3">Authorised  By <?php print $_SESSION['admin']['name'];?> -->
			</table>
            <div style="margin-top:1em; ">
            	<div style="width:100%; display: -webkit-box !important; display: -ms-flexbox !important; display: flex !important;justify-content: space-between !important;"> 
                	<p class="underline text-right" style="text-align:right; padding-right:20px"><?php echo $advance; ?></p> <p>സംഖ്യ </p>
            	</div>
            	<div style="width:100%; display: -webkit-box !important; display: -ms-flexbox !important; display: flex !important;">
                	<p>കിട്ടി ബോധിച്ചു.</p>
            	</div>
<!--             	<div style="width:100%; display: -webkit-box !important; display: -ms-flexbox !important; display: flex !important;"> 
                	<p>പേരും ഒപ്പും </p> <p class="underline"> </p>
            	</div> -->
        	</div>
        	<div style="text-align:right; margin-top:1em">
            	പ്രസിഡന്റ് / സെക്രട്ടറി 
        	</div>
            <div class="page-break"></div>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing" }, 500); }
function myFunction(){
	console.log(window.history.back());
    window.location = "<?php echo base_url();?>index.php/admin/admin/billing";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>