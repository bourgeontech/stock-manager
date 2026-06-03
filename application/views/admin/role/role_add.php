  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Role Managemend </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary">Back &nbsp;&nbsp;<i class="fa fa-left-arrow" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-6 col-md-6 col-sm-6 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add Role </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/add_role" method="post" >
		
      <div class="form_body">
        <div class="row">
			
			<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Role <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Role" id="role" name="role"  type="text" >
			<?php echo form_error('role', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
			
			<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Label <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Label" id="label" name="label"  type="text" >
			<?php echo form_error('label', '<div class="error">', '</div>'); ?>
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
			<div class="col-lg-6 col-md-6 col-sm-6 ">
				<div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
				<div class="table-responsive">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Label</th>
					  <th scope="col" width="">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($role_list)){
	                      $i=0;
	                      foreach($role_list as $role){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td ><p style="font-weight: bold"> <?= $role['role']; ?></p></td>
					  <td ><p style="font-weight: bold"> <?= $role['label']; ?></p></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/role_permission/<?= $role['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-list"></i></a> 
						  </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				</table>
             </div>
			</div>
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>