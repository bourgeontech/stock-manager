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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Ledger Wise</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header" hidden>
  <div class="header-right">
  <a href="<?php echo base_url();?>index.php/accounts/report" class="btn btn btn-outline-secondary" style="font-size: 18px;"><i class="fa fa-list-ul" aria-hidden="true"></i> View All</a>
        
  <!-- <a href="<?php echo base_url();?>index.php/accounts/exportReportExcel" class="btn btn btn-outline-success" style="font-size: 18px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a> -->
  
   </div>
   </div>
        </div>
			 </div>	

       <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative">
             <form action="<?php echo base_url();?>index.php/accounts/ledgerWise" method="post">
               <div class="input-group mb-3" >
				  &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="fromdate" value="<?php echo @$fromdate; ?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                  		<input type="date" class="form-control" name="todate" value="<?php echo @$todate; ?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      
                    
			
                <input type="text" class="form-control" name="search" value="<?php isset($search) ? $search : '' ?>" placeholder="Search by ledger name" aria-label="Search by ledger name" aria-describedby="basic-addon2">
              	<select class="form-control" name="group">
                	<option value="">Select a Ledger Group</option>
                	<?php foreach($ledger_groups as $group): ?>
                	<option value="<?= $group['group_id'] ?>" <?php (isset($group) && $group == $group['group_id']) ? 'selected' : '' ?> > <?= $group['group_name'] ?></option>
                	<?php endforeach; ?>
              	</select>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" name="submit_type" value="search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                  <button class="btn btn-outline-secondary" name="submit_type" value="print" type="submit"><i class="fa fa-print" aria-hidden="true"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

       <br>
       
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
					

<!-- SEARCH -->

<!--<div class="row">
	
			  
			  <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <form action="<?php echo base_url();?>index.php/accounts/searchledgerWise" method="post">
                  <div class="input-group mb-3">
				  &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="search" value="<?php echo date('Y-m-d');?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
				  <input type="date" class="form-control" name="search1" value="<?php echo date('Y-m-d');?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
			  </div>
               <div class="col-lg-4 col-md-4 col-sm-4 " hidden>
                  <form action="<?php echo base_url();?>index.php/accounts/searchReport" method="post">
                  <div class="input-group mb-3">
				  <!-- <input type="text" class="form-control" name="keyword" value="" required placeholder="Search By Ledger Name" aria-label="Search Ledger Name" aria-describedby="basic-addon2"> -->
          <!--<select name="keyword" class="form-control" aria-label="Search Ledger Name" aria-describedby="basic-addon2">
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
              <div class="col-lg-4 col-md-4 col-sm-4 " hidden>
                  <form action="<?php echo base_url();?>index.php/accounts/searchReport" method="post">
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
			  
			 </div>	<br><br>

-->

	       <div class="table-responsive" id="printer">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
				  <tr>
        			<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
        			<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
        			Ledger Wise Report As on Date <?php if (isset($fromdate)){echo date('d-m-Y',strtotime($fromdate));}?>  <?php if (isset($todate)){echo date('d-m-Y',strtotime($todate));}?></h4>
        			</td>
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
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>
    