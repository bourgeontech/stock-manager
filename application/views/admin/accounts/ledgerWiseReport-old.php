 <style>


.header {
  overflow: hidden;
  background-color: white;
  padding: 8px 4px;
}
.header a {
  float: left;
  /* color: black; */
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 2px;
}


.header a:hover {
  /* background-color: #ddd; */
  color: black;
}

.header a.active {
  background-color: gray;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }

}
<style>
@media print
{
	.narr {display:none!important;}
   .text {width:180px; }
   .text span {text-overflow: ellipsis; 
overflow: hidden; 
white-space: nowrap;display:block;font-size: 10px!important;}
}

</style>
</style>

<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        
    </div>
   

       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Ledger Wise Report</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header">
  <div class="header-right">
<!--  <a href="<?php echo base_url();?>index.php/accounts/ledgerwiseReport/<?= $ledgerId; ?>" class="btn btn btn-outline-secondary" style="font-size: 18px;"><i class="fa fa-list-ul" aria-hidden="true"></i> View All</a>
        -->
  <!-- <a href="<?php echo base_url();?>index.php/accounts/exportReportExcel" class="btn btn btn-outline-success" style="font-size: 18px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a> -->
  
   </div>
   </div>
        </div>
			 </div>	
       <br>
       
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
					

<!-- SEARCH -->

<div class="row">
  
			  
			  <div class="col-lg-4 col-md-4 col-sm-4 ">
                  <form action="<?php echo base_url();?>index.php/accounts/searchLedgerWiseReport/<?= $ledgerId; ?>" method="post">
                  <div class="input-group mb-3">
				  &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="search" value="<?php echo date('Y-m-d');?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                  		<input type="date" class="form-control" name="search1" value="<?php echo date('Y-m-d');?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
			  </div>
               <div class="col-lg-4 col-md-4 col-sm-4 " hidden>
                  <form action="<?php echo base_url();?>index.php/accounts/searchLedgerWiseReport/<?= $ledgerId; ?>" method="post">
                  <div class="input-group mb-3">
				  <!-- <input type="text" class="form-control" name="keyword" value="" required placeholder="Search By Ledger Name" aria-label="Search Ledger Name" aria-describedby="basic-addon2"> -->
          <select name="keyword" class="form-control" aria-label="Search Ledger Name" aria-describedby="basic-addon2">
                                	<option value="">Search By Ledger Name</option>
                    			<?php foreach($ledger as $val){ ?>  
                    				<option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>     
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
			  </div>
              <div class="col-lg-4 col-md-4 col-sm-4 ">
                  <form action="<?php echo base_url();?>index.php/accounts/searchLedgerWiseReport/<?= $ledgerId; ?>" method="post">
                  <div class="input-group mb-3">
                  <select name="type" class="form-control" aria-label="Search By Type" aria-describedby="basic-addon2">
                            <option value="">Search By Type</option>
                    				<option value="1">Payment</option>
                            <option value="2">Receipt</option>
                    			</select>  
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
			  </div>
			  
				<div class="col-lg-1">
                	<button class="btn btn-sm h-75 w-100 btn-outline-primary" id="printBtn"> <i class="fa fa-print" aria-hidden="true"></i> Print </button>
				</div>
			 </div>	<br><br>



	       <div class="table-responsive" id="printer">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
                  	<tr>
    					<td colspan="8" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
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
                     <th scope="col" class="narr" width="180px;">NARRATION</th>
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
					
					$totalpages=$count%30;
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
                 <td><?=$val['name']; ?></td>
                      <td class="text narr"><span style="text-transform: capitalize;font-size: 12px;"><?= $val['narration']; ?></span></td>
                      <td><?php if($val['type']=='1'){ ?> &nbsp;
                    <?php echo number_format($val['amount'],2,'.','');  ?><?php } ?>
                    </td>
                     
                       <td><?php if($val['type']=='2'){ ?>&nbsp; <?php echo number_format($val['amount'],2,'.',''); ?><?php } ?>
                    </td>
                    
                      <!-- <td><?= $receipt_date; ?></td> -->
					
					</tr>
				  
					<?php 
					
					if($k==30)
					{
					$totalpage=$totalpage+1;	
						
						?>
					<tr class="total-row">
                             <th class="text-center" colspan="4">(Page <?php echo $totalpage;?>) Total<br/><?php if($totalpage>=2) { ?> <br/><?php } ?></th>
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
	?>
<tr class="total-row">
                             <th class="text-center" colspan="4">(Page <?php echo $totalpage;?>) Total</th>
                         	  <th> <?php echo number_format($debit,2,'.','');$totaldebit=$totaldebit+$debit; ?> </th>
                         	 <th> <?php echo number_format($credit,2,'.',''); $totalcredit=$totalcredit+$credit;?> </th>
                          </tr>
<?php	
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
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } 
					
					$totalpage=$totalpage+1;
					?>	
<tr class="total-row">
                             <th class="text-center" colspan="4">(Page <?php echo $totalpage;?>) Total</th>
                         	 <th> <?php echo number_format($debit,2,'.','');$totaldebit=$totaldebit+$debit; ?> </th>
                         	 <th> <?php echo number_format($credit,2,'.',''); $totalcredit=$totalcredit+$credit;?> </th>
                          </tr>
<tr>
                             <th class="text-center" colspan="4">Grand Total</th>
                         	 <th> <?php echo number_format($totaldebit,2,'.',''); ?> </th>
                         	 <th> <?php echo number_format($totalcredit,2,'.',''); ?> </th>
                          </tr>							  
                	<tr><td>&nbsp; </td><td>&nbsp;</td><td>&nbsp;</td><td>Closing Balance</td><td><?php if($cb <'0' ) { echo number_format(($cb+$ob),2,'.',''); ;} ?><td><?php if($cb >'0' ) { echo number_format(($cb+$ob),2,'.',''); ;} ?></td></tr>
                 <tfoot>
                
                </tfoot>
				</table>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
       
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