  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Pending Bill</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Bill </h2>
              </div>
            
			 </div>
	        
	          <div class="table-responsive">
	            <small>&nbsp; Please enter the bill number and press search to view the bill details</small>
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
                      <th scope="col" width="">Customer</th>
					  <th scope="col" width="">Total Pending</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
				  <tbody>
                     <?php 
                  	$totalRows = 0;
                  	
                  	if($customerinvoices != 0) {
                  		foreach($customerinvoices as $key => $bill){
						$bill_id = $bill['bill_id'];
						$query = $this->db->query("SELECT SUM(amount) as paid_amount FROM payment WHERE ref_no='$bill_id'")->row();
						$paid_amount = $query->paid_amount ?? $bill['recv_amt'];
						
                        if($bill['total'] > ($paid_amount)){
                        $totalRows++;
                     ?>
                      <tr>
                       <td><?= $key; ?></td>
                       <td><h4><?= $bill['customername']; ?></h4><p><?= $bill['customerphone']; ?></p></td>
                       <td><?= ($bill['total'] - $paid_amount); ?></td>
                       <td>
                         <form action="<?php echo base_url(); ?>index.php/admin/admin/customerpayments" method="post">
                             <input type="hidden" name="customer_id" value="<?= $bill['customer_id']; ?>" />
                             <button type="submit" class="btn btn-primary" >View Details</button>
                         </form>           
                       </td>
                      </tr>
                     <?php }
                        
                        } 
                     if($totalRows  == 0) { ?>
                     	<tr>
                  			<td colspan="4">
                            <p class="text-center py-4">No data found!</p>
                        	</td>
                  		</tr>
                     <?php }
                    
                    }
                  	else { ?>
                  		<tr>
                  			<td colspan="4">
                            <p class="text-center py-4">No data found!</p>
                        	</td>
                  		</tr>
                   <?php }?>
                  </tbody>
				</table>
             </div>
          
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
   