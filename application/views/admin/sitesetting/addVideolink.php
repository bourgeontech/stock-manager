
 <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Opening Song </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/viewSitesetting" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update Video Link  </h2>
                  </div>
			   </div>
               <?php echo form_open_multipart("cms/addVideolink"); ?>
		       <form action="" method="post">
		
      <div class="form_body">
        <div class="row">
			

            <div class="col-lg-12">
                <div class="form-group">
                    <div class="row_form">
                        <div class="div_label">
                            <label class="text_label">Video Link <span class="red">*</span> </label>
                        </div>
                        <input class="sq_form" placeholder="Enter video link" id="video_link" name="video_link" type="text">
                        <?php echo form_error('video_link', '<div class="error">', '</div>'); ?>
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