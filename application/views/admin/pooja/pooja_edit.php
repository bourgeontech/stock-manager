  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
   <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Pooja Master </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/pooja_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit Pooja </h2>
                  </div>
			   </div>
				<?php foreach($pooja_list as $val){ ?>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_pooja/<?php echo $val['id']; ?>" method="post" >
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
              <label class="text_label">In Local Language <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Name in Local Language" id="name_mal" name="name_mal" value="<?php echo $val['name_mal']; ?>" type="text" >
			<?php echo form_error('name_mal', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Rate <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Rate" id="rate" name="rate" value="<?php echo $val['rate']; ?>"  type="text" >
			<?php echo form_error('rate', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Code <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Code" id="code" name="code" value="<?php echo $val['code']; ?>"  type="text" >
			<?php echo form_error('code', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Allowed Quantity <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Quantity" id="quantity" name="quantity" value="<?php echo $val['allowed_qty']; ?>"  type="text" >
			<?php echo form_error('quantity', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
              <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Time of Pooja <span class="red">*</span> </label>
            </div>
              <select class="sq_form" name="time" id="time">
                <option value="A">All</option>
                <option value="M">Morning</option>
                <option value="N">Noon</option>
                <option value="E">Evening</option>
              </select>
			<?php echo form_error('time', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <?php if($this->db->field_exists('exact_time', 'pooja')): ?>
     <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Exact Time <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="Time" id="exact_time" name="exact_time"  value="<?php echo $val['exact_time']; ?>" type="time" >
			<?php echo form_error('exact_time', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
	<?php endif; ?>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Category <span class="red">*</span> </label>
            </div>
            <select name="cat" id="cat" class="sq_form" onchange="view_cat()" style="width: 100%">
            	<option value="">Select Category</option>
			<?php foreach($cat_list as $value){ ?>        
				<option <?php echo $value['id'] == $val['cat'] ? 'selected' : ''; ?>  value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
			<?php } ?>
			</select>
    		<?php echo form_error('cat', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Pooja Category </label>
            </div>
            <input class="sq_form" placeholder=" Pooja Category" id="pooja_cat" name="pooja_cat" value="<?php echo $val['pooja_cat'] ?? 0; ?>" type="text" />
			<?php echo form_error('pooja_cat', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
     <?php if($this->db->field_exists('description', 'pooja')): ?>
	 <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Description </label>
            </div>
           <input class="sq_form" placeholder=" Description" id="description" name="description" value="<?php echo $val['description'] ?? ''; ?>" type="text" />
			<?php echo form_error('description', '<div class="error">', '</div>'); ?>
			
          </div>
        </div>
      </div>
      <?php endif; ?>
            
     <?php if($this->db->field_exists('online', 'pooja')): ?>
	 <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
<!--             <div class="div_label">
              <label class="text_label">Is online </label>
            </div>
            <input class="sq_form" id="online" name="online"  type="checkbox" value="1"  <?php if ($val['online']=='1'){ ?> checked="checked" <?php } ?> /> -->
		
          	<div class="form-check mt-5">
  				<input class="form-check-input custom-input" id="online" name="online"  type="checkbox" value="1"  <?php if ($val['online']=='1'){ ?> checked="checked" <?php } ?>>
 	 			<label class="form-check-label" for="online">
    				Is Online
  				</label>
			</div>
			<?php echo form_error('description', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if($this->db->field_exists('default_date', 'pooja')): ?>
	  <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Default Date </label>
            </div>
            <input class="sq_form" placeholder=" Description" id="default_date" name="default_date" value="<?php echo $val['default_date'] ?? ''; ?>" type="date">
			<?php echo form_error('default_date', '<div class="error">', '</div>'); ?>
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
				<?php } ?>
    </div>
			 <!--form-->
			</div> 
          </div>
	    </div>
    <div class="clearfix"></div>
    <br>