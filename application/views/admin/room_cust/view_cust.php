<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Room Customer</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/add_cust" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Room Customer </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col">SL No</th>
					  <th scope="col">Name</th>
					  <th scope="col">Mobile</th>
					  <th scope="col">Door No</th>
					  <th scope="col">Address</th>
					  <th scope="col">Id Type</th>
					  <th scope="col">Id Number</th>
					  <th scope="col">Rent Period</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($cust_list)){
	                      $i=0;
	                      foreach($cust_list as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?= $val['name']; ?></td>
					  <td><?= $val['mobile']; ?></td>
					  <td><?= $val['door_no']; ?></td>
					  <td><?= $val['address']." , ".$val['place']." , ".$val['post']." , ".$val['pincode']." <br> ".$val['dist']; ?></td>
					  <td><?= $val['id_type']; ?></td>
					  <td><?= $val['id_no']; ?></td>
					  <td><?= date('d-m-Y',strtotime($val['rent_stdate']))." to ".date('d-m-Y',strtotime($val['rent_due'])); ?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_cust/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_cust/<?= $val['id']; ?>"   onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="12">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				</table>
             </div>
			</div> 
          </div>
          </div>
  </div>
<div class="clearfix"></div>
<br>
</body>