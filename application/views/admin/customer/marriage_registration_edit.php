  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Marriage Registration </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/marriage_reg_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <!-- <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Groom Details  </h2> -->
                  </div>
			   </div>
         <?php if(isset($customer)){ foreach($customer as $val){ ?>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/marriage_registration_edit/<?php echo $val['id']; ?>" method="post" >
           <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
			   <?php
	  if ($this->db->field_exists('receipt_no', 'marriage_reg')) {?>
	   <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Receipt Number<span class="red"></span> </label>
            </div>
            <input class="sq_form" placeholder="Enter Receipt Number" value="<?php echo $val['receipt_no']; ?>" id="receipt_no" name="receipt_no"  type="text" >
			
          </div>
        </div>
      </div>
	  <?php } ?>
               <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Marriage Date  <span class="red">*</span> </label>
            </div>
            <input class="sq_form"  id="mdate" name="mdate"  type="date" value="<?php echo $val['mdate']; ?>" >
			<?php echo form_error('mdate', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">From Muhoortham <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['f_muhoortham']; ?>"  id="f_muhoortham" name="f_muhoortham"  type="text" >
			<?php echo form_error('f_muhoortham', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">To Muhoortham <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['to_muhoortham']; ?>"  id="to_muhoortham" name="to_muhoortham"  type="text" >
			<?php echo form_error('to_muhoortham', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Groom Details  </h2>
                  </div>
			   </div>
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_name']; ?>"  id="groom_name" name="groom_name"  type="text" >
			<?php echo form_error('groom_name', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Birth Star <span class="red"></span> </label>
            </div>
            <!-- <input class="sq_form" placeholder=" Birth Star" id="groom_star" name="groom_star"  type="text" > -->
            <select name="groom_star" id="groom_star" class="sq_form" style="width:100%;">
              <option value="0">Please Select</option>
              <?php 
              
              foreach ($star_list as $star){
              ?>
            <option <?php echo ($star['id'] == $val['groom_star']) ? 'selected':'' ; ?> value="<?php echo $star['id'];?>"><?php echo $star['name_eng']." - ".$star['name_mal'];?></option>
              <?php 
              }
              ?>
            </select>
			<?php echo form_error('groom_star', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Date Of Birth <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_DOB']; ?>"  id="groom_DOB" name="groom_DOB"  type="date" >
			<?php echo form_error('groom_DOB', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Age <span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_age']; ?>"  id="groom_age" name="groom_age"  type="text" >
			<?php echo form_error('groom_age', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name of Father <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_fname']; ?>"  id="groom_fname" name="groom_fname"  type="text" >
			<?php echo form_error('groom_fname', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name of Mother<span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_mname']; ?>"  id="groom_mname" name="groom_mname"  type="text" >
			<?php echo form_error('groom_mname', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Permenent Address <span class="red">*</span> </label>
            </div>
            <textarea class="sq_form"   id="groom_address" name="groom_address"  type="text" ><?php echo $val['groom_address']; ?></textarea>
			<?php echo form_error('groom_address', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Phone  <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_phone1']; ?>"  id="groom_phone1" name="groom_phone1"  type="text" >
			<?php echo form_error('groom_phone1', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Phone 2  <span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_phone2']; ?>"  id="groom_phone2" name="groom_phone2"  type="text" >
			<?php echo form_error('groom_phone2', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
     
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">ID Proof <span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_id_proof']; ?>" id="groom_id_proof" name="groom_id_proof"  type="text" >
			<?php echo form_error('groom_id_proof', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">ID Proof Number<span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['groom_id_proof_no']; ?>"  id="groom_id_proof_no" name="groom_id_proof_no"  type="text" >
			<?php echo form_error('groom_id_proof_no', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
			<div class="col-sm-12">
                <div class="form-group"><hr> </div>
      </div>
      <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 "></div>
			   </div>
     
               
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bride Details  </h2>
                  </div>
			 
		       
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_name']; ?>"  id="bride_name" name="bride_name"  type="text" >
			<?php echo form_error('bride_name', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Birth Star <span class="red"></span> </label>
            </div>
            <select name="bride_star" id="bride_star" class="sq_form" style="width:100%;">
              <option value="0">Please Select</option>
              <?php 
              foreach ($star_list as $star){
              ?>
              	 <option <?php echo ($star['id'] == $val['bride_star']) ? 'selected':'' ; ?> value="<?php echo $star['id'];?>"><?php echo $star['name_eng']." - ".$star['name_mal'];?></option>
              <?php 
              }
              ?>
            </select>
			<?php echo form_error('bride_star', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Date Of Birth <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_DOB']; ?>"  id="bride_DOB" name="bride_DOB"  type="date" >
			<?php echo form_error('bride_DOB', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Age <span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_age']; ?>"  id="bride_age" name="bride_age"  type="text" >
			<?php echo form_error('bride_age', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name of Father <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_fname']; ?>"  id="bride_fname" name="bride_fname"  type="text" >
			<?php echo form_error('bride_fname', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name of Mother<span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_mname']; ?>"  id="bride_mname" name="bride_mname"  type="text" >
			<?php echo form_error('bride_mname', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Permenent Address <span class="red">*</span> </label>
            </div>
            <textarea class="sq_form"   id="bride_address" name="bride_address"  type="text" ><?php echo $val['bride_address']; ?></textarea>
			<?php echo form_error('bride_address', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Phone 1  <span class="red">*</span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_phone1']; ?>"  id="bride_phone1" name="bride_phone1"  type="text" >
			<?php echo form_error('bride_phone1', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Phone 2  <span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_phone2']; ?>"  id="bride_phone2" name="bride_phone2"  type="text" >
			<?php echo form_error('bride_phone2', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
    
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">ID Proof <span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_id_proof']; ?>"  id="bride_id_proof" name="bride_id_proof"  type="text" >
			<?php echo form_error('bride_id_proof', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">ID Proof Number<span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['bride_id_proof_no']; ?>"  id="bride_id_proof_no" name="bride_id_proof_no"  type="text" >
			<?php echo form_error('bride_id_proof_no', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
                <div class="form-group"><hr> </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Witness 1 <span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['witness1']; ?>" id="witness1" name="witness1"  type="text" >
			<?php echo form_error('witness1', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Witness 2 <span class="red"></span> </label>
            </div>
            <input class="sq_form" value="<?php echo $val['witness2']; ?>" id="witness2" name="witness2"  type="text" >
			<?php echo form_error('witness2', '<div class="error">', '</div>'); ?>
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
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>