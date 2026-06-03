  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt">General Settings</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>admin/admin/category_view" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
      <ul class="tp_tab">
        <li><a href="<?php echo base_url();?>admin/admin/category_view" class="active"><i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;Category </a></li>
        <li><a href="<?php echo base_url();?>admin/admin/subcategory_view"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Sub Category </a></li>
        <li><a href="<?php echo base_url();?>admin/admin/unit_view"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;Unit</a></li>
		<li><a href="<?php echo base_url();?>index.php/admin/admin/state_view"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;&nbsp;State </a></li>
		<li><a href="<?php echo base_url();?>index.php/admin/admin/district_view" ><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;District </a></li>
		<li><a href="<?php echo base_url();?>index.php/admin/admin/brand_view" ><i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp;&nbsp;Brand </a></li>
      </ul>
	  <hr>
      <div class="clearfix"></div>
	   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"><i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;Brand </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>admin/admin/brand_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
	   </div>	
		
	  </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit Brand </h2>
                  </div>
			   </div>
				<?php foreach($brand_list as $val){ ?>
		       <form action="<?php echo base_url(); ?>admin/admin/edit_brand/<?=$val['id']; ?>" method="post" enctype="multipart/form-data">
      <div class="form_body">
       <div class="row">
		<div class="col-lg-12">
		   <div class="form-group">
			  <div class="row_form">
				<div class="div_label">
				  <label class="text_label">Name <span class="red">*</span> </label>
				</div>
				<input class="sq_form" placeholder="Name" id="name" name="name"  type="text" value="<?php echo $val['name']; ?>" >
				<?php echo form_error('name', '<div class="error">', '</div>'); ?>
			  </div>
			</div>
		  </div>	  
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Description <span class="red">*</span></label>
            </div>
            <textarea class="sq_form" placeholder="Description" id="description" name="description"  ><?php echo $val['description']; ?></textarea>
			<?php echo form_error('description', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="row">
            <div class="col-lg-8 col-lg-8 col-sm-12">
              <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 text-center">
                  <div style=" height:170px; width: 450px; 
							  background: url(<?php echo base_url(); ?><?= $val['photo']; ?>);    
							  background-size: cover; display: inline-block"></div>
                </div>
                <div class="col-lg-10 col-md-8 col-sm-8">
                  <ul class="quatation_ul" style="margin-top: 5px">
                    <li style="padding-left:80px">
						<a  class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-pencil" aria-hidden="true"></i>
						</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
	  <div class="col-sm-12">
         <div class="form-group">
             <button type="submit" class="btn btn-success pull-right" style="margin-top:7px;">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
         </div>
        </div>
      </div>
    </div>			  
  </form>
				 <?php } ?>
    </div>
			 <!--form-->
			</div> 
          </div>
	    </div>
       </div>
	</div>
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose an image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	 <form action="<?php echo base_url(); ?>admin/admin/change_brand_image/<?= $val['id']; ?>" method="post" enctype="multipart/form-data">	
      <div class="modal-body">
        <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <input class="sq_form" placeholder="Image" id="icon" name="image" required=""  type="file" value="<?php echo set_value('image'); ?>" >
          </div>
        </div>
      </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
		 <input type="hidden"  id="pid"  value="<?php echo $val['id']; ?>" />
	</form>	 
    </div>
  </div>
</div>
		<!-- Modal -->
    <div class="clearfix"></div>
    <br>
    


