<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt">Other Billing</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/paid_billing" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List </h2>
              </div>
			 </div>	
         
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Amount</th>
					  <th scope="col" width="">Mode</th>
					  <th scope="col" width="">Serial No</th>
                      <th scope="col" width="">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($bookings)){
	                      $i=0;
	                       foreach($bookings as $val){ 
                              if($val['mode'] == 2){
                                 $mode = 'Cheque';
                              }
                              else if($val['mode'] == 3){
                                 $mode = 'DD';
                              }
                              else if($val['mode'] == 4){
                                 $mode = 'MO';
                              }
                              else{
                                 $mode = 'Others';
                              }
                
                  ?>
				  <tbody id="myTable">
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['bill_id']; ?></strong></a></td>
					  <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					  <td><?= $val['name']; ?></td>
					  <td><?= $val['amount']; ?></td>
					  <td><?= $mode; ?></td>
					  <td><?= $val['slno']; ?></td>
            <td><div class="btn-group">
						        <a href="<?php echo base_url('index.php/admin/admin/bill_print/'.$val['bill_id']);?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-print"></i></a> 
                        <a href="<?php echo base_url('index.php/admin/admin/donationprint/'.$val['bill_id']);?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-print"></i></a> 
                         <a href="<?php echo base_url('index.php/admin/admin/totalprint/'.$val['bill_id']);?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-print"></i></a> 
                 </div></td>
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
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>