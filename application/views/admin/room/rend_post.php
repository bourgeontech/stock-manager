<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Rend Post/h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Post rent </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/rend_post" method="post" >
		
      <div class="form_body">
        <div class="row">
		
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Month , Year </label>
            </div>
            <input class="sq_form" name="mnth_yr" value="<?php echo date('Y-m')?>" type="month">
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Receipt Date </label>
            </div>
            <input class="sq_form" name="rec_date" value="<?php echo date('Y-m-d')?>" type="date">
          </div>
        </div>
      </div>
        <div class="col-sm-4">
                
              </div>
           <div class="col-sm-8">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary pull-right" style="margin-top:7px;">&nbsp;&nbsp;&nbsp;Post&nbsp;&nbsp;&nbsp;</button>
                </div>
              </div>
        </div>
      </div>
		</form>
    </div>
			 <!--form-->
			</div> 
			
  </div>
<div class="clearfix"></div>
<br>
</body>