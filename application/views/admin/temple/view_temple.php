  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt">Temple Master</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url(); ?>index.php/admin/admin/temple_view" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	  <hr>
      <div class="clearfix"></div>
	   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;Temple </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url(); ?>index.php/admin/admin/temple_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
	   </div>	
		
	  </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit Temple </h2>
                  </div>
			   </div>
				<?php foreach($temple_list as $val){ ?>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_temple/<?php echo $val['id']; ?>" method="post" >
      <div class="form_body">
        <div class="row">
        	<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Name" id="name" name="name" value="<?php echo $val['name']; ?>" type="text" >
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
            <textarea class="sq_form" id="address" name="address"> <?php echo $val['address']; ?></textarea>
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
            <input class="sq_form" placeholder="Pincode" id="pincode" name="pincode" value="<?php echo $val['pincode']; ?>" type="text">
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
            <input class="sq_form" placeholder="Location" id="location" name="location" value="<?php echo $val['location']; ?>" type="text">
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
            <input class="sq_form" placeholder="Contact" id="contact" name="contact" value="<?php echo $val['contact']; ?>" type="text">
			  <?php echo form_error('contact', '<div class="error">', '</div>'); ?>
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
    <div class="clearfix"></div>
    <br>