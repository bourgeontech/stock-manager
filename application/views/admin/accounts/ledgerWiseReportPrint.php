
<div class="table-responsive" id="printer">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
                  	<tr>
    					<td colspan="7" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br/>
                        <small><?php print_r($temple_list[0]['phone']);?></small><br/>
						<?php echo $ledgerWiseReport[0]['name'];?>
                        </h4>
    					</td>
    				</tr>
					<tr>
					 <th scope="col" width="">SL No</th>
                     <th scope="col" width="">DATE</th>
                     <th scope="col" width="">LEDGER</th>
                    <th scope="col" width="">NARRATION</th>
                     <th scope="col" width="">Debit</th>
                     <th scope="col" width="">Credit</th>
                 
                   
                      <!-- <th scope="col" width="">RECEIPT DATE</th> -->
					 
					</tr>
				  </thead>
				
                
               
				
                <tr><td>&nbsp; </td><td>&nbsp;</td><td>&nbsp;</td><td>Opening Balance</td><td><?php if($ob <'0' ) { echo $ob ;} ?><td><?php if($ob >'0' ) { echo $ob ;} ?></td></tr>
               
					<?php 
					$totalpages=0;
					$totalpage=0;
					$count=count($ledgerWiseReport);
					
					$totalpages=$count%25;
					if(!empty($ledgerWiseReport)){
	                      $i=0;
						  $totaldebit=0;
						  $totalcredit=0;
 						  $total=0;
                    	  $debit = 0;
                          $credit = 0;
                    ?>
                <tbody>
                <?php
				$k=1;
				
	                       foreach($ledgerWiseReport as $val){
								
                            $originalDate = $val['payment_date'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                           if($val['amount']==''){$v=0;}else{$v=$val['amount'];}
                        	
                           if($val['type'] == 1) {
                           	$debit += $v;
                           } else {
                           	$credit += $v;
                           }
                               ?>
				  
				<tr>
					  <td><?= ++$i; ?></td>
				     <td><?= $newDate; ?></td>
                 <td><?= $lname ?></td>
                      <td><span style="text-transform: capitalize;font-size: 12px;"><?= $val['narration']; ?></span></td>
                      <?php if($lgroup!='3'){  ?><td><?php if($val['type']=='1'){ ?> &nbsp;
                    <?php echo number_format($val['amount'],2,'.','');  ?><?php } ?>
                    </td>
                     
                       <td><?php if($val['type']=='2'){ ?>&nbsp; <?php echo number_format($val['amount'],2,'.',''); ?><?php } ?>
                    </td>
                    <?php } ?>
                       <?php if($lgroup=='3'){ ?><td><?php if($val['type']=='2'){?> &nbsp;
                    <?php echo number_format($val['amount'],2,'.','');  ?><?php } ?>
                    </td>
                     
                       <td><?php if($val['type']=='1'){ ?>&nbsp; <?php echo number_format($val['amount'],2,'.',''); ?><?php } ?>
                    </td>
                    <?php } ?>
                      <!-- <td><?= $receipt_date; ?></td> -->
					
					</tr>
				  
					<?php 
					
					if($k==25)
					{
					$totalpage=$totalpage+1;	
						
						?>
					<tr class="total-row">
                             <th class="text-center" colspan="4"> Total<br/><br/><?php if($totalpage>=2) { ?><br/><br/><br/><?php } ?></th>
                         	 <th> <?php echo number_format($debit,2,'.','');$totaldebit=$totaldebit+$debit; ?> </th>
                         	 <th> <?php echo number_format($credit,2,'.',''); $totalcredit=$totalcredit+$credit;?> </th>
                          </tr>
						
						  
						
			<?php
$k=0;
$debit=0;
$credit=0;
		

if($totalpages==$totalpage)
{
	$totalpage=$totalpage+1;
	/*
<tr class="total-row">
                             <th class="text-center" colspan="3"> Total</th>
                         	  <th> <?php echo number_format($debit,2,'.','');$totaldebit=$totaldebit+$debit; ?> </th>
                         	 <th> <?php echo number_format($credit,2,'.',''); $totalcredit=$totalcredit+$credit;?> </th>
                          </tr>
						
*/	
}
}
					$k++;
					
					} 
					
				/*
                    	 <tr>
                             <th class="text-center" colspan="4">Total</th>
                         	 <th> <?php echo number_format($debit,2,'.',''); ?> </th>
                         	 <th> <?php echo number_format($credit,2,'.',''); ?> </th>
                          </tr>
                  		</tbody>
						*/
                     } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="5">No Data Found</td>
						  </tr>
				    <?php } 
					
					$totalpage=$totalpage+1;
					?>	
 <?php if($lgroup!='3'){  ?>
                <tr class="total-row">
                             <th class="text-center" colspan="4"> Total</th>
                         	 <th> <?php echo number_format($debit,2,'.','');$totaldebit=$totaldebit+$debit; ?> </th>
                         	 <th> <?php echo number_format($credit,2,'.',''); $totalcredit=$totalcredit+$credit;?> </th>
                          </tr>
<tr>
                             <th class="text-center" colspan="4">Grand Total</th>
                         	 <th> <?php echo number_format($totaldebit,2,'.',''); ?> </th>
                         	 <th> <?php echo number_format($totalcredit,2,'.',''); ?> </th>
                          </tr>	<?php } else { ?>	 <tr class="total-row">
                             <th class="text-center" colspan="4"> Total</th>
                 <th> <?php echo number_format($credit,2,'.',''); $totalcredit=$totalcredit+$credit;?> </th>
                         	 <th> <?php echo number_format($debit,2,'.','');$totaldebit=$totaldebit+$debit; ?> </th>
                         	
                          </tr>
<tr>
                             <th class="text-center" colspan="4">Grand Total</th>
 	 <th> <?php echo number_format($totalcredit,2,'.',''); ?> </th>
                         	 <th> <?php echo number_format($totaldebit,2,'.',''); ?> </th>
                        
                          </tr><?php } ?>					  
                	<tr><td>&nbsp; </td><td>&nbsp;</td><td>&nbsp;</td><td>Closing Balance</td><td><?php if($cb <'0' ) { echo number_format(($cb+$ob),2,'.',''); ;} ?><td><?php if($cb >'0' ) { echo number_format(($cb+$ob),2,'.',''); ;} ?></td></tr>
                 <tfoot>
                
                </tfoot>
				</table>
				 <div id="pageFooter">Page </div>
             </div>
			
       
    <script>
    	$('#printBtn').on('click', (e) => {
        	let printer = $('#printer');
        	
        	printcontend('printer')
        })
    
    	
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