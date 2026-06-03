<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt">Event Festival </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul d-flex flex-row justify-content-end" >
          	<?php if($this->db->table_exists('event_brochure')): ?>
          	<li> <a href="<?php echo base_url();?>index.php/cms/addEventBrochure" class="btn btn-primary mr-2">Add Event Brochure&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          	<?php endif; ?>
            <li> <a href="<?php echo base_url();?>index.php/cms/addEventFestival" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Event </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">TITLE</th>
					  <th scope="col" width="">IMAGE</th>
					  <!-- <th scope="col" width="">PDF</th> -->
					  <th scope="col" width="">DESCRIPTION</th>
                     <?php if($this->db->field_exists('event_date', 'event')): ?>
                       <th scope="col" width="">EVENT DATE</th>
        		      <?php endif; ?>
					  <th scope="col" width="">ACTION</th>
					</tr>
				  </thead>
					<?php if(!empty($event)){
	                      $i=0;
	                       foreach($event as $val){ 
                               $image=$val['image'];
                               ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['title']; ?></strong></a></td>
					  <td><?php if(!empty($image)){ ?>
                      <img src="../../uploads/events/<?PHP echo $image; ?>" width="50"/>
                      <?php } ?></td>

					  <!-- <td>
							<?php if(!empty($pdf)){ ?>
							<a href="../../uploads/events/<?PHP echo $pdf; ?>" target="_blank" style="cursor:pointer">PDF<?= $pdf; ?></a>

							<a href="&lt;?php echo base_url(); ?&gt;site/pdf/&lt;?php echo $item; ?&gt;" style="cursor:pointer">PDF</a>

							<?php } ?>
					  </td> -->

					  <td><?= $val['description']; ?></td>
                    
                      <?php if($this->db->field_exists('event_date', 'event')): ?>
                       <td><?= $val['event_date']; ?></td>
        		      <?php endif; ?>
                    
					  <td><div class="btn-group">
						 <a href="<?php echo base_url(); ?>index.php/cms/editEventFestival/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  
						  <a href="<?php echo base_url(); ?>index.php/cms/deleteEventFestival/<?= $val['id']; ?>"  onclick="return confirm('Are you sure you want to delete?')"
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