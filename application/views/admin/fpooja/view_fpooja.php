<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Family Pooja </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/fpooja" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Family pooja </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Mobile</th>
					  <th scope="col" width="">Email</th>
					  <th scope="col" width="">Address</th>
					  <th scope="col" width="">Member Count</th>
					  <th scope="col" width="">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($fpooja_list)){
	                      $i=0;
	                       foreach($fpooja_list as $val){
                           $f_id=$val['id'];
                			$query = $this->db->query("SELECT * FROM `fpooja_dtl` where f_id='$f_id'")->result_array();
                           $count = count($query);
                ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?= $val['name']; ?></td>
					  <td><?= $val['mobile']; ?></td>
					  <td><?= $val['email']; ?></td>
					  <td><?= $val['address']." , ".$val['city']." , ".$val['pincode']; ?></td>
					  <td><?= $count; ?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_fpooja/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_fpooja/<?= $val['id']; ?>" onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a></div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="10">No Data Found</td>
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