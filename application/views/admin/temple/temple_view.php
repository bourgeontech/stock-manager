<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"> Temple Master </a></li>
		</ol>
		<div class="ml-auto">
		    <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary btn-icon btn-sm text-white mr-2">
				<span>
					<i class="fa fa-arrow-left"></i>
				</span> Back
			</a>
			<?php if(empty($temple_list)){?>
			<a href="<?php echo base_url();?>index.php/admin/admin/add_temple" class="btn btn-primary btn-icon btn-sm text-white mr-2">
				<span>
					<i class="fa fa-plus"></i>
				</span> Add New
			</a>
			<?php }?>
		</div>
	</div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Temple </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Address</th>
					  <th scope="col" width="">Pincode</th>
					  <th scope="col" width="">Contact </th>
					  <th scope="col" width="">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($temple_list)){
	                      $i=0;
	                       foreach($temple_list as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['name']; ?></strong></a></td>
					  <td ><p style="font-weight: bold"> <?= $val['address']; ?></p></td>
					  <td ><p style="font-weight: bold"> <?= $val['pincode']; ?></p></td>
					  <td ><p style="font-weight: bold"> <?= $val['contact']; ?></p></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_temple/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_temple/<?= $val['id']; ?>"   onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
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