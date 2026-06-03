  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Diety Master </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/diety_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add New Diety </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/add_diety" method="post" >
		
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
              <label class="text_label">In Malayalam <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Name in Malayalam" id="name_mal" name="name_mal"  type="text" >
			<?php echo form_error('name_mal', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Display Order <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="Order" id="order" name="order"  type="text">
			  <?php echo form_error('order', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>	
			<?php if($this->db->field_exists('description', 'diety')): ?>
	 <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Description </label>
            </div>
            <textarea class="sq_form" placeholder=" Description" id="description" name="description"></textarea>
			<?php echo form_error('description', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
    <?php endif; ?>	
        <?php if($this->db->field_exists('online', 'diety')): ?>
        <div class="col-lg-6">
        <div class="form-group pt-2">
          <div class="form-check mt-5">
  			<input class="form-check-input" type="checkbox" name="online" value="1" id="flexCheckDefault" style="transform: scale(1.5);">
  			<label class="form-check-label ml-3" for="flexCheckDefault">
    			Available for online booking
  			</label>
		  </div>
        </div>
      </div>
        <?php endif; ?>
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