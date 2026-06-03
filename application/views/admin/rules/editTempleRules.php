<script type="text/javascript" src="https://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
		 //<![CDATA[
		         bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		   //]]>
		   </script>
 <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Temple Rules </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/viewTempleRules" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Temple Rules </h2>
                  </div>
			   </div>
               <?php 
               if(!empty($rules)){
                   foreach($rules as $val){ ?>
               <?php echo form_open_multipart("cms/viewTempleRules"); ?>
		       <form action="" method="post">
		
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Title <span class="red"></span> </label>
            </div>
            <input class="sq_form" placeholder="" id="title" name="title"  type="text" value="<?php echo $val['title']; ?>">
  
          </div>
        </div>
      </div>
      
      <div class="col-lg-12">
        <div class="form-group">
         
            <div class="div_label">
              <label class="text_label">Rules <span class="red"></span></label>
            </div>
            <textarea class="" id="rules" name="rules" rows="10" style="width: 100%;"><?php echo $val['rules']; ?></textarea>
			  <?php echo form_error('description', '<div class="error">', '</div>'); ?>
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
			 <!--form-->
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>