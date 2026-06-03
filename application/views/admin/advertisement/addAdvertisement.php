
 <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Advertisement </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/viewAdvertisement" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add Advertisement </h2>
                  </div>
			   </div>
               <?php echo form_open_multipart("cms/addAdvertisement"); ?>
		       <form action="" method="post">
		
      <div class="form_body">
        <div class="row">
			
        <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Title <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="file" name="title"  type="text" >
			<?php echo form_error('title', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Image <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="file" name="file"  type="file" >
			<?php echo form_error('file', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Display Order <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="" name="display_order"  type="number" >
			<?php echo form_error('display_order', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
            
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Expiry Date <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="" name="expiry_date"  type="date" >
			<?php echo form_error('display_order', '<div class="error">', '</div>'); ?>
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
    </div>
			 <!--form-->
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>