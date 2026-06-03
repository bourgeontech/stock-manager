<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Room Details</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/add_room" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Rooms </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col">SL No</th>
					  <th scope="col">Room No</th>
					  <th scope="col">Room Id</th>
					  <th scope="col">Door No</th>
					  <th scope="col">Address</th>
					  <th scope="col">Place</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($room_list)){
	                      $i=0;
	                      foreach($room_list as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?= $val['room_no']; ?></td>
					  <td><?= $val['room_id']; ?></td>
					  <td><?= $val['door_no']; ?></td>
					  <td><?= $val['room_address']." , ".$val['room_post']." , ".$val['room_pincode']." <br> ".$val['room_dist']; ?></td>
					  <td><?= $val['room_place']; ?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_room/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_room/<?= $val['id']; ?>"   onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="8">No Data Found</td>
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