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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Ledger Group Report</h2>
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
  
			  
			  <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <form action="<?php echo base_url();?>index.php/accounts/ledgerGroupReport" method="post">
                  <div class="input-group mb-3">
				  &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="search" value="<?php if($fromdate!='') { echo $fromdate;} else { echo date('Y-m-d'); }?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                  		<input type="date" class="form-control" name="search1" value="<?php if($todate!='') { echo $todate;} else { echo date('Y-m-d'); }?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
						<select class="form-control" name="group">
                	<option value="">Select a Ledger Group</option>
                	<?php foreach($ledger_groups as $group1): ?>
                	<option value="<?= $group1['group_id'] ?>" <?php if($group1['group_id']==@$group) { echo "selected"; } ?> > <?= $group1['group_name'] ?></option>
                	<?php endforeach; ?>
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
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?> <br/>
                        <small><?php print_r($temple_list[0]['phone']);?></small><br/>
						Ledger Group Report
                        </h4>
    					</td>
    				</tr>
                    	
					<tr>
					 <th scope="col" width="">SL No</th>
                    
                     <th scope="col" width="">LEDGER</th>
					 <th scope="col" width="">GROUP</th>
                    
                     <th scope="col" width="">Debit</th>
                     <th scope="col" width="">Credit</th>
                 
                   
                      <!-- <th scope="col" width="">RECEIPT DATE</th> -->
					 
					</tr>
				  </thead>
				
                
               
			 
					<?php
					
					if(@$group!='') { 
				$this->db->select('
					ledger.led_Id,
					payment.type,
					ledger.name AS ledger_name,
					ledger_group.group_name,
					SUM(payment.amount) AS total_amount
				');
				$this->db->from('payment');
				$this->db->join('ledger', 'ledger.led_Id = payment.ledger');
				$this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
				$this->db->where('ledger_group.group_id', $group);
				$this->db->where('payment.is_delete', '0');
				$this->db->where('payment.payment_date >=', $fromdate);
				$this->db->where('payment.payment_date <=', $todate);
				$this->db->group_by('ledger.led_Id');
				$this->db->order_by('ledger.name', 'ASC');

				$query = $this->db->get();

			$ledgerWiseReport=$query->result_array();
					}
					//echo $this->db->last_query();
					if(!empty($ledgerWiseReport)){
	                      $i=0;
 						  $total=0;
                    	  $debit = 0;
                          $credit = 0;
                    ?>
                <tbody>
                <?php
	                       foreach($ledgerWiseReport as $val){ 
                            //$originalDate = $val['payment_date'];
                            //$newDate = date("d-m-Y", strtotime($originalDate));
                           if($val['total_amount']==''){$v=0;}else{$v=$val['total_amount'];}
                        	
                           if($val['type'] == 1) {
                           	$debit += $v;
                           } else {
                           	$credit += $v;
                           }
                               ?>
				  
					<tr>
					  <td><?= ++$i; ?></td>
				
                 <td><a href="<?php echo base_url("index.php/accounts/ledgerWiseReport/$val[led_Id]"); ?>"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['ledger_name'] ?></a></td>
				 <td><?= $val['group_name'] ?></td>
                     
                     <td><?php if($val['type']=='1'){ ?> &nbsp;
                    <?php echo number_format($val['total_amount'],2,'.','');  ?><?php } ?>
                    </td>
                     
                       <td><?php if($val['type']=='2'){ ?>&nbsp; <?php echo number_format($val['total_amount'],2,'.',''); ?><?php } ?>
                    </td>
                   
                       
                    
					
					</tr>
				  
					<?php } ?>
<tr>
<td colspan="3" style="text-align:right;">
<b>Total</b>
</td>
<td>
<b><?php echo number_format($debit,2,'.','');  ?></b>
</td>
<td>
<b><?php echo number_format($credit,2,'.','');  ?></b>
</td>
</tr>
<?php
					}?>
              
			  

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
    
  </script>   	
<script>
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>