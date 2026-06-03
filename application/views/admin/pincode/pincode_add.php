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
            <li> <a href="<?php echo base_url();?>admin/admin/unit_view" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
      <?php 
      $data['active']="6";
      $this->load->view('admin/master_menu',$data);?>
	  <hr>
      <div class="clearfix"></div>
	   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;Pincode </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>admin/admin/pincode_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
	   </div>	
		
	  </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add New Pincode </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>admin/admin/add_pincode" method="post" >
		
      <div class="form_body">
        <div class="row">
		<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">District<span class="red">*</span> </label>
            </div>
            <select class="sq_form"  id="district" name="district">
			<option value=" ">Select District</option>
			  <?php if(!empty($district_list)){ 
			        foreach($district_list as $district){ ?>
					<option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
			  <?php } } ?>		
			</select>
			<?php echo form_error('district', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>	
	    <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Pincode<span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Pincode" id="name" name="name"  type="text" >
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
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