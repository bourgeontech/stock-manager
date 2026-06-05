  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> User Master </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/user_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit User </h2>
                  </div>
			   </div>
				<?php foreach($user_list as $val){ ?>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_user/<?php echo $val['id']; ?>" method="post" >
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
              <label class="text_label">Email <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" UserName/Email" id="username" name="username" value="<?php echo $val['username']; ?>" type="Email" >
			<?php echo form_error('username', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Password <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="New Password (leave blank to keep current)" id="password" name="password" value="" type="password">
			  <?php echo form_error('password', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>	
		<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Role <span class="red">*</span> </label>
            </div>
            <select name="role" id="role" class="js-example-basic-single sq_form" style="width: 100%">
                <option value="">Select Role</option>
                <?php 
                foreach ($role_list as $role){
                ?>
                <option value="<?php echo $role['label'];?>" <?php if ($val['role']==$role['label']){echo "selected";}?>><?php echo $role['role'];?></option>
                <?php 
                }
                ?>
            </select>
			  <?php echo form_error('role', '<div class="error">', '</div>'); ?>
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