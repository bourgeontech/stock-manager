<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
		 //<![CDATA[
		         bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		   //]]>
           </script>
           
           <?php if(!empty($event)){
	                      $i=0;
	                       foreach($event as $val){ 
                               $id=$val['id'];
                               $image=$val['image'];
                               $title=$val['title'];
                           	 
                               $description=$val['description'];
							   if ($this->db->field_exists('pooja_booking', 'event')) {
                               		$pooja_id =  $val['pooja_booking'];
                               }
                           		if ($this->db->field_exists('event_date', 'event')) {
                               		$event_date =  $val['event_date'];
                               }
                           	
                           }
                        }
?>

 <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Event Festival </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/viewEventFestival" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Event Festival </h2>
                  </div>
			   </div>
               <?php echo form_open_multipart("cms/updateEventFestival/$id"); ?>
		       <form action="" method="post">
		
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Event Title <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="title" name="title"  type="text"  value="<?php echo $title; ?>">
  
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Image <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="file" name="file"  type="file"  value="<?php echo $image; ?>">
			<?php echo form_error('file', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">PDF File<span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="pdffile" name="pdffile"  type="file"  value="<?php echo $image; ?>">
			<?php echo form_error('pdffile', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group">
         
            <div class="div_label">
              <label class="text_label">Description <span class="red"></span></label>
            </div>
            <textarea class="" id="content" name="description" rows="6" style="width: 100%;"><span></span><?php echo $description; ?></textarea>
			  <?php echo form_error('description', '<div class="error">', '</div>'); ?>
          </div>
      
      </div>
			
<!-- 		   <?php if($pooja_id): ?>
        		<div class="col-lg-12">
        			<div class="form-group">
            			<div class="div_label">
              				<label class="text_label">Pooja Booking</label>
            			</div>
            			<textarea class="" id="pooja_id" name="pooja_id" rows="6" style="width: 100%;"><span></span><?php echo $pooja_id; ?></textarea>
			  			<?php echo form_error('pooja_id', '<div class="error">', '</div>'); ?>
          			</div>
      
      			</div>
           <?php endif; ?> -->
        <?php if($this->db->field_exists('event_date', 'event')): ?>
        <div class="col-lg-12">
        <div class="form-group">
         
            <div class="div_label">
              <label class="text_label">Event Date <span class="red"></span></label>
            </div>
            <input class="sq_form" type="date" id="event_date" name="event_date" value="<?php echo $event_date; ?>" rows="6" style="width: 100%;" />
			<?php echo form_error('event_date', '<div class="error">', '</div>'); ?>
          </div>
      
      </div>
		<?php endif; ?>
           <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-success pull-right" style="margin-top:7px;">&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;</button>
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