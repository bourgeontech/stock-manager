<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Pooja Register </h2>
        </div>
        <!-- <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/add_customer" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div> -->
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp; </h2>
              </div>
			 </div>	
          <form action="<?php echo base_url();?>index.php/admin/admin/pooja_register" method="post">
          	<div class="row" style="padding:10px 0;">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <div class="input-group">
                  <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}?>" name="keyword" required="required">
                  <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}?>" name="datet" required="required">
                  <select name="mode"  class="form-control"  id="mode" onchange="change_mode()" >
                            	<option value="">Select Mode</option>
                            	<option <?php if(isset($mode)) { echo ($mode==1) ?  "selected":"" ; } ?> value="1">Cash</option>
                            	<option <?php if(isset($mode)) { echo ($mode==2) ? "selected":"" ; } ?>  value="2">Cheque</option>
                            	<option <?php if(isset($mode)) { echo ($mode==3) ? "selected":"" ; } ?>  value="3">DD</option>
                            	<option  <?php if(isset($mode)) { echo ($mode==4) ? "selected":"" ; } ?> value="4">MO</option>
                            	<option  <?php if(isset($mode)) { echo ($mode==5) ? "selected":"" ; } ?> value="5">Others</option>
                            </select>
                            <input type="text" name="number" class="mode" placeholder="Number" style="padding:0 5px;height:25px;color:black;display: none;">
                            <input type="date" name="mode_date" class="mode" style="padding:0 5px;height:25px;color:black;display: none;">
           
                 
                  <div class="input-group-append">
                    <button type="submit" name="button" value="search" class="btn btn-outline-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
                </div>
               </div>
              

              <div class="col-lg-2 col-md-2 col-sm-2 ">
              	<button type="submit" name="button" value="print" class="btn btn-outline-secondary">Print</button>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 ">
          		<input id="myInput" type="text" class="sq_form" placeholder="Search..">
              </div>
            </div>
            </form>
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					            <th scope="col" width="">SL No</th>
                      <th scope="col" width="">Bill Number</th>
                      <th scope="col" width="">Bill Date</th>
                      <th scope="col" width="">Diety</th>
                      <th scope="col" width="">Name</th>
					            <th scope="col" width="">Star</th>
					            <th scope="col" width="">Pooja</th>
					            <th scope="col" width="">Pooja Date</th>
					            <th scope="col" width="">MO/Cheque No</th>
                      <th scope="col" width="">MO/Cheque Date</th>
                      <th scope="col" width="">Amount</th>
                      <!-- <th scope="col" width="">Action</th> -->
					</tr>
				  </thead>
					<?php if(!empty($poojareg_list)){
	                      $i=0;
	                       foreach($poojareg_list as $val){ ?>
				  <tbody id="myTable">
					<tr>
					            <td><?= ++$i; ?></td>
                      <td><?= $val['bill_id']; ?></td>
                      <td><?= $val['bill_date']; ?></td>
                       <td><?= $val['dietyname']; ?></td>
                      <td><?= $val['name']; ?></td>
                      <td><?= $val['starname']; ?></td>
                      <td><?= $val['poojaname']; ?></td>
                      <td><?= $val['date']; ?></td>
					            <td><?= $val['number']; ?></td>
                      <td><?= $val['mode_date']; ?></td>
					            <td><?= $val['amount']; ?></td>
                      <!-- <td><div class="btn-group">
						        <a href="<?php echo base_url();?>index.php/admin/admin/edit_customer/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
                 </div></td> -->
            </tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="11">No Data Found</td>
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