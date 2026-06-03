<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Priest Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/addPriest" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Priest </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">NAME</th>
					  <th scope="col" width="">DESIGNATION</th>
					  <th scope="col" width="">IMAGE</th>
                      <th scope="col" width="">DISPLAY ORDER</th>
                      <th scope="col" width="">ACTION</th>
					</tr>
				  </thead>
					<?php if(!empty($priest)){
	                      $i=0;
	                       foreach($priest as $val){ 
                               $image=$val['image'];
                               ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
                      <td><a href="#"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['name']; ?></strong></a></td>
                      <td> <span style="margin-bottom: 5px;display: block;text-transform: capitalize;"><?= $val['designation']; ?></span></td>
					  <td><?php if(!empty($image)){ ?>
                      <img src="../../uploads/priest/<?PHP echo $image; ?>" width="50"/>
                      <?php } ?></td>
					  <td><?= $val['displayOrder']; ?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url(); ?>index.php/cms/editPriest/<?= $val['priestId']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						&nbsp;&nbsp;  <a href="<?php echo base_url(); ?>index.php/cms/deletePriest/<?= $val['priestId']; ?>"  onclick="return confirm('Are you sure you want to delete?')"
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