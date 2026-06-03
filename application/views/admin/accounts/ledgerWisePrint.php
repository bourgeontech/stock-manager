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
    					<th colspan="8"><label style="float:left;">From Date : <?php print_r($fromdate);?></label><label style="float:left;"> To Date : <?php print_r($todate);?></label>
					        <label style="float:center;">Ledger Wise</label>
    					    <label style="float:right;font-size:bold;"></label>
    				    </th>
    				</tr>
    				<tr>
					  <th scope="col" width="">SL No</th>
                      <th scope="col" width="">LEDGER NAME</th>
                      <th scope="col" width="">BALANCE</th>
					</tr>
				</thead>
				<?php if(!empty($ledger)){

	                      $i=0;
	                      $total=0;
	                       foreach($ledger as $val){ 
                            $originalDate = $val['created'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            $led_Id = $val['led_Id'];
                            $total=$total+$val['lst_balance'];
                            
                             $query= $this->db->query("select sum(amount) as debit from payment where type=1 and ledger=$led_Id and is_delete=0");
   							 $row = $query->row();
    						 $debit=$row->debit;
                             $query2= $this->db->query("select sum(amount) as credit from payment where type=2 and ledger=$led_Id  and is_delete=0");
                             $row2 = $query2->row();
     					 	 $credit=$row2->credit;
                           
                           	 $query3= $this->db->query("select sum(amount) as debit from payment where type=3 and ledger=$led_Id and is_delete=0");
   							 $row3 = $query3->row();
    						 $opening_balance=$row3->debit;
                           
      						 $balance=$opening_balance + $credit-$debit;
          
      
      
                        
                               ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="<?php echo base_url("index.php/accounts/ledgerWiseReport/$led_Id"); ?>"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['name']; ?></strong></a></td>
                      <td style="text-align: right;"><?= (number_format($balance, 2, '.', '')); ?></td>
                    
                     
                    
					
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } ?>
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/accounts/ledgerWise" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/accounts/ledgerWise";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>