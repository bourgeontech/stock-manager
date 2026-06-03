<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Contact </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/addContact" class="btn btn-primary">Add New &nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Contact </h2>
                  </div>
			   </div>
               <?php 
               if(!empty($contact)){
                   foreach($contact as $val){ ?>
               <?php echo form_open_multipart("cms/editContact"); ?>
		       <form action="" method="post">
		
      <div class="form_body">
        <div class="row">

        <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Temple Name <span class="red">*</span> </label>
            </div>
           <input class="sq_form" placeholder="" id="" name="temp_name"  type="text" value="<?php echo $val['temp_name']; ?>">
			
          </div>
        </div>
      </div>

		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Land Ph Number <span class="red"></span> </label>
            </div>
           <input class="sq_form" placeholder="" id="" name="land_ph"  type="text" value="<?php echo $val['land_ph']; ?>">
			
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Mobile Number <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="" name="mob_ph"  type="text"value="<?php echo $val['mob_ph']; ?>" >
			<?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Email <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="" name="email"  type="email" value="<?php echo $val['email']; ?>">
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
         
            <div class="div_label">
              <label class="text_label">Address <span class="red">*</span></label>
            </div>
            <textarea class="" id="content" name="address" rows="6" style="width: 100%;"><?php echo $val['address']; ?></textarea>
			  <?php echo form_error('address', '<div class="error">', '</div>'); ?>
          </div>
      
      </div>
		
			 <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Location <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="" name="location"  type="text" value="<?php echo $val['location']; ?>">
		    	<?php echo form_error('location', '<div class="error">', '</div>'); ?>
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
        <?php }} ?>
    </div>
			 <!--form-->
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>