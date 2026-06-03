<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Marriage Registration </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/marriage_registration_add" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Registration List </h2>
              </div>
			 </div>	
          <form action="<?php echo base_url();?>index.php/admin/admin/marriage_reg_view" method="post">
          	<div class="row" style="padding:10px 0;">
              <!-- <div class="col-lg-6 col-md-6 col-sm-6 ">
                <div class="input-group">
                  <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}?>" name="keyword" required="required">
                  <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}?>" name="datet" required="required">
                  <div class="input-group-append">
                    <button type="submit" name="button" value="search" class="btn btn-outline-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
                </div>
               </div>
              <div class="col-lg-2 col-md-2 col-sm-2 ">
              	<button type="submit" name="button" value="print" class="btn btn-outline-secondary">Print</button>
              </div> -->
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
					  <th scope="col" width="">Groom Name</th>
            <th scope="col" width="">Bride Name</th>
					  <th scope="col" width="">Marriage Date</th>
            <th scope="col" width="">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($mrg_list)){
	                      $i=0;
	                       foreach($mrg_list as $val){ ?>
				  <tbody id="myTable">
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['groom_name']; ?></strong></td>
            <td><strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['bride_name']; ?></strong></td>
					  <td><?= date("d-m-Y", strtotime($val['mdate'])); ?></td>
            <td><div class="btn-group">
						        <a href="<?php echo base_url();?>index.php/admin/admin/marriage_registration_edit/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
                 
						   <a href="<?php echo base_url();?>index.php/admin/admin/print_mrg/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="print"> <i class="fa fa-print"></i></a> 
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