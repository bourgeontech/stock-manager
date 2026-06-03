  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Birth Star</a></li>
		</ol>
		<div class="ml-auto">
			<a href="<?php echo base_url();?>index.php/admin/admin/birth_star" class="btn btn-primary btn-icon btn-sm text-white mr-2">
				<span>
					<i class="fe fe-eye"></i>
				</span> View
			</a>
		</div>
	</div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add Birth Star </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/add_birth_star" method="post" >
		
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Select File <span class="red">*</span> </label>
            </div>
            <input class="sq_form" id="file" name="file" type="file" >
			<?php echo form_error('file', '<div class="error">', '</div>'); ?>
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