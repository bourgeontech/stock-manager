<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Slider </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/addSlider" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Sliders </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">TITLE</th>
					  <th scope="col" width="">TYPE</th>
					  <th scope="col" width="">PREVIEW</th>
					  <th scope="col" width="">DESCRIPTION</th>
                      <th scope="col" width="">DISPLAY ORDER</th>
					  <th scope="col" width="">ACTION</th>
					</tr>
				  </thead>
					<?php if(!empty($slider)){
	                      $i=0;
	                       foreach($slider as $val){ 
                               $image=$val['image'];
                               $type=$val['type'] ?? 'image';
                               ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['title']; ?></strong></a></td>
					  <td>
                        <?php if($type == 'video'): ?>
                          <span class="badge badge-info"><i class="fa fa-video-camera"></i> Video</span>
                        <?php else: ?>
                          <span class="badge badge-primary"><i class="fa fa-image"></i> Image</span>
                        <?php endif; ?>
                      </td>
					  <td>
                        <?php if($type == 'video'): ?>
                          <span class="text-muted" style="font-size:12px;word-break:break-all;"><?= htmlspecialchars($val['video_url'] ?? ''); ?></span>
                        <?php elseif(!empty($image)): ?>
                          <img src="<?php echo base_url(); ?>uploads/slider/<?PHP echo $image; ?>" width="100"/>
                        <?php endif; ?>
                      </td>
					  <td><?= $val['description']; ?></td>
                      <td><?= $val['display_order']; ?></td>
					  <td><div class="btn-group">
					      <a href="<?php echo base_url(); ?>index.php/cms/editSlider/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
					  
					      <a href="<?php echo base_url(); ?>index.php/cms/deleteSlider/<?= $val['id']; ?>"  onclick="return confirm('Are you sure you want to delete?')"
						   class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="7">No Data Found</td>
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
