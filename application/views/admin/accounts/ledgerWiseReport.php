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
 @page {
        counter-increment: page;
      }
}
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
                	<button class="btn btn-sm h-75 w-100 btn-outline-primary" type="button" onclick="printcontend('printer')" id="printBtn"> <i class="fa fa-print" aria-hidden="true"></i> Print </button>
				</div>
			 </div>	<br><br>



	       <div class="table-responsive" id="printer">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
                  	<tr>
    					<td colspan="8" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?> <br/>
                        <small><?php print_r($temple_list[0]['phone']);?></small>
                        </h4>
    					</td>
    				</tr>
                    	<tr>
    					<td colspan="8" style="width:100%;"><h4 style="text-align:center;"><?php print_r($ledgerWiseReport[0]['name']);?><br>
    					
                        </h4>
    					</td>
    				</tr>
                 <?php if (!empty($datef) && !empty($datet)) { ?>
                  	<tr>
    					<td colspan="8" style="width:100%;"><h4 style="text-align:center;">Report Date Period 
                        <?php echo date('d-m-Y', strtotime(@$datef));?>-<?php echo date('d-m-Y', strtotime(@$datet));?>
    					
                        </h4>
    					</td>
    				</tr>
                  <?php } ?>
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
				
                
               
			 <?php if($lgroup!='3'){  ?>
                <tr><td>&nbsp; </td><td>&nbsp;</td><td>&nbsp;</td><td>Opening Balance</td><td><?php if($ob <'0' ) { echo $ob ;} ?><td><?php if($ob >'0' ) { echo $ob ;} ?></td></tr>
              <?php } else { ?> 
                 <tr><td>&nbsp; </td><td>&nbsp;</td><td>&nbsp;</td><td>Opening Balance</td><td><?php if($ob >'0' ) { echo $ob ;} ?><td><?php if($ob <'0' ) { echo $ob ;} ?></td></tr><?php } ?>
					<?php 
               
					if(!empty($ledgerWiseReport)){
	                      $i=0;
 						  $total=0;
                    	  $debit = 0;
                          $credit = 0;
                    ?>
                <tbody>
                <?php
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
				  
					<?php } ?>
                    	 <?php if($lgroup!='3'){  ?>< <tr>
                             <th class="text-center" colspan="4">Total</th>
                         	 <th> <?php echo number_format($debit,2,'.',''); ?> </th>
                         	 <th> <?php echo number_format($credit,2,'.',''); ?> </th>
                </tr> <?php } else  { ?> <th class="text-center" colspan="4">Total</th>
                         	 <th> <?php echo number_format($credit,2,'.',''); ?> <th> <?php echo number_format($debit,2,'.',''); ?> </th>
                         	 <?php } ?>
                  		</tbody>
                    <?php } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } ?>	 
                	<tr><td>&nbsp; </td><td>&nbsp;</td><td>&nbsp;</td><td>Closing Balance</td><td><?php if($cb <'0' ) { echo number_format(($cb+$ob),2,'.',''); ;} ?><td><?php if($cb >'0' ) { echo number_format(($cb+$ob),2,'.',''); ;} ?></td></tr>
                 <tfoot>
                 <div class="page-number" id="pageNumber"></div>
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
var dataHtml='';
$.get( "<?php echo base_url();?>index.php/accounts/ledgerWiseReportPrint/<?php echo $ledgerId; ?>", function( data ) {
	//alert(data);
	dataHtml=data;
});
/*
function printcontend(value)
    {
		var restorpage=document.body.innerHTML;
		var printcontend=dataHtml;
		document.body.innerHTML=printcontend;
		window.print();
		document.body.innerHTML=restorpage;
	}
    */
    
    function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}
    </script>