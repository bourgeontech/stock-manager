<script type="text/javascript" src="https://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
		 //<![CDATA[
		         bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		   //]]>
           </script>
            <?php if(!empty($content)){
	                      $i=0;
	                       foreach($content as $val){ 
                               $image=$val['image'];
                               $short_content=$val['short_content'];
                               $content=$val['content'];
                               $title=$val['title'];
                               $id=$val['abtId'];
                             
                           }}
                               ?>
   <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> About Us </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/viewContent" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Content </h2>
                  </div>
			   </div>
               <?php echo form_open_multipart("cms/updateContent/$id"); ?>
		       <form action="" method="post">
		
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Title <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="title" name="title"  type="text" value="<?php echo $title; ?>">
			<?php echo form_error('title', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Image <span class="red"></span> </label>
            </div>
            <input class="sq_form" placeholder="" id="file" name="file"  type="file" value="<?php echo $image; ?>">
            <?php echo form_error('file', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <!-- <div class="row_form"> -->
            <div class="div_label">
              <label class="text_label">Short Description <span class="red">*</span></label>
            </div>
            <textarea class="" id="content" name="short_content" rows="6" style="width: 100%;"><span></span> <?php echo $short_content; ?></textarea>
			  <?php echo form_error('content', '<div class="error">', '</div>'); ?>
          </div>
        <!-- </div> -->
      </div>

      <div class="col-lg-12">
        <div class="form-group">
          <!-- <div class="row_form"> -->
            <div class="div_label">
              <label class="text_label">Full Description <span class="red">*</span></label>
            </div>
            <textarea class="" id="content" name="content" rows="6" style="width: 100%;"><span></span> <?php echo $content; ?></textarea>
			  <?php echo form_error('content', '<div class="error">', '</div>'); ?>
          </div>
        <!-- </div> -->
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