<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt">Gallery </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/addGallery" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Gallery </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">CATEGORY</th>
					  <th scope="col" width="">IMAGE</th>
					  <th scope="col" width="">DESCRIPTION</th>
					  <th scope="col" width="">ACTION</th>
					</tr>
				  </thead>
					<?php if(!empty($gallery)){
	                      $i=0;
	                       foreach($gallery as $val){ 
                               $image=$val['image'];
                               $category=$val['category'];
                               ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"><strong style="margin-bottom: 5px;display: block;text-transform: uppercase;">
					  <?php if($category==1){ echo "Temple Images"; }elseif($category==2){ echo "Festival Images"; }
					        elseif($category==3){ echo "Event Images"; }elseif($category==4){ echo "Other Images"; }?>
			        	</strong>
					  </a></td>
					       
					  <td><?php if(!empty($image)){ ?>
                      <img src="../../uploads/gallery/<?PHP echo $image; ?>" width="50"/>
                      <?php } ?></td>
					  <td><?= $val['description']; ?></td>
					  <td><div class="btn-group">
						   <a href="<?php echo base_url(); ?>index.php/cms/editGallery/<?= $val['gal_Id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						 
						  <a href="<?php echo base_url(); ?>index.php/cms/deleteGallery/<?= $val['gal_Id']; ?>"  onclick="return confirm('Are you sure you want to delete?')"
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