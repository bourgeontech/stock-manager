  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"> Temple Master </a></li>
		</ol>
		<div class="ml-auto">
		    <a href="<?php echo base_url();?>index.php/admin/admin/temple_view" class="btn btn-primary btn-icon btn-sm text-white mr-2">
				<span>
					<i class="fa fa-arrow-left"></i>
				</span> Back
			</a>
			<?php if(empty($temple_list)){?>
			<a href="<?php echo base_url();?>index.php/admin/admin/temple_view" class="btn btn-primary btn-icon btn-sm text-white mr-2">
				<span>
					<i class="fa fa-plus"></i>
				</span> View
			</a>
			<?php }?>
		</div>
	</div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add New Temple </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/add_temple" method="post" >
		
      <div class="form_body">
        <div class="row">
			
			<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Name" id="name" name="name"  type="text" >
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
			
			<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Address</label>
            </div>
            <textarea class="sq_form" id="address" name="address"></textarea>
			  <?php echo form_error('address', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Pincode</label>
            </div>
            <input class="sq_form" placeholder="Pincode" id="pincode" name="pincode"  type="text">
			  <?php echo form_error('pincode', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>	
		<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Location</label>
            </div>
            <input class="sq_form" placeholder="Location" id="location" name="location"  type="text">
			  <?php echo form_error('location', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>	
		<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Contact <span class="red">*</span></label>
            </div>
            <input class="sq_form" placeholder="Contact" id="contact" name="contact"  type="text">
			  <?php echo form_error('contact', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>	
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Phone </label>
            </div>
            <input class="sq_form" placeholder="Phone" id="phone" name="phone"  type="text">
			  <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>	
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Email</label>
            </div>
            <input class="sq_form" placeholder="Email" id="email" name="email"  type="text">
			  <?php echo form_error('email', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>	
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Website</label>
            </div>
            <input class="sq_form" placeholder="Website" id="website" name="website"  type="text">
			  <?php echo form_error('website', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Postel Charge</label>
            </div>
            <input class="sq_form" placeholder="Postel Charge" id="postel_charge" name="postel_charge"  type="text">
			  <?php echo form_error('postel_charge', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Payment Charge</label>
            </div>
            <input class="sq_form" placeholder="Payment Charge" id="payment_charge" name="payment_charge" type="number" min="1" max="100">
			  <?php echo form_error('payment_charge', '<div class="error">', '</div>'); ?>
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