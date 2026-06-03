  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Devotee Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/customer_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit Devotee </h2>
                  </div>
			   </div>
				<?php if(isset($customer)){ foreach($customer as $val){ ?>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_customer/<?php echo $val['id']; ?>" method="post" >
      <div class="form_body">
        <div class="row">
        <div class="col-lg-4">
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
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">House <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="House Name" id="house" name="house" value="<?php echo $val['house']; ?>"  type="text" >
			<?php echo form_error('house', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Street <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Street" id="street" name="street" value="<?php echo $val['street']; ?>"   type="text" >
			<?php echo form_error('street', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Post  <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" post" id="post" name="post" value="<?php echo $val['post']; ?>"  type="text" >
			<?php echo form_error('post', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">District <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" district" id="district" name="district" value="<?php echo $val['district']; ?>"  type="text" >
			<?php echo form_error('district', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">State <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" state" id="state" name="state" value="<?php echo $val['state']; ?>"  type="text" >
			<?php echo form_error('state', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Pincode <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" pincode" id="pincode" name="pincode" value="<?php echo $val['pincode']; ?>"  type="text" >
			<?php echo form_error('pincode', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Phone <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Phone" id="phone" name="phone" value="<?php echo $val['mobile']; ?>" type="text" >
			<?php echo form_error('phone', '<div class="error">', '</div>'); ?>
          	<?php if ($this->session->flashdata('mobile_error')): ?>
   					<span class="text-danger">
        				<?php echo $this->session->flashdata('mobile_error'); ?>
    				</span>
			<?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Email <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Email" id="email" name="email" value="<?php echo $val['email']; ?>" type="text" >
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
	  <?php if ($this->db->field_exists('gothram', 'user_dtl')) { ?>
	   <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Gothram  </label>
            </div>
            <input class="sq_form" placeholder=" Gothram" id="gothram" name="gothram" value="<?php echo $val['gothram']; ?>"  type="text" >
			<?php echo form_error('gothram', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
	  
	  
	  <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Star  </label>
            </div>
          <select name="star_id"  class="form-control custom-input" >
                                	<option value="28">Select Star</option>
                    			<?php foreach($birth_star as $val1){ ?>  
                    				<option value="<?= $val1['id']; ?>" <?php if($val1['id']==$val['star_id']) { ?> selected <?php } ?>><?php  echo $val1['name_eng']." - ".$val1['name_mal']; ?> (<?= $val1['id']; ?>)</option>
                    			<?php } ?>
                    			</select>
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		 <?php } ?>	
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
    <div class="clearfix"></div>
    <br>