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
          <h2 class="page_txt"> Temple Timing </h2>
        </div>
        
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add New</h2>
              </div>
           
			 </div>	
       <br>
       <form action="<?php echo base_url(); ?>index.php/cms/addTempleTiming" method="post">
              
		
      <div class="form_body">
        <div class="row">
            <div class="col-lg-12">
            <div class="form-group">
              <div class="row_form">
                <div class="div_label">
                  <label class="text_label">Title <span class="red"></span> </label>
                </div>
                <input class="sq_form" placeholder="" id="title" name="title" value="<?php if(!empty($temple_time)){echo $temple_time[0]['title'];}?>" type="text" >
      
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
             
                <div class="div_label">
                  <label class="text_label">Rules <span class="red"></span></label>
                </div>
                <textarea class="" id="rules" name="rules" rows="6" style="width: 100%;"><span><?php if(!empty($temple_time)){echo $temple_time[0]['rules'];}?></span></textarea>
    			  <?php echo form_error('rules', '<div class="error">', '</div>'); ?>
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
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
