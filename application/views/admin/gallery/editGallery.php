                        <?php if(!empty($gallery)){
	                      $i=0;
	                       foreach($gallery as $val){ 
                               $id=$val['gal_Id'];
                               $image=$val['image'];
                               $category=$val['category'];
                               $title=$val['description'];
                           }
                        }
                               ?>
 <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Gallery </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/viewGallery" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Gallery </h2>
                  </div>
			   </div>
               <?php echo form_open_multipart("cms/updateGallery/$id"); ?>
		       <form action="" method="post">
		
      <div class="form_body">
        <div class="row">
		
		<div class="col-lg-12">
        <div class="form-group">
         
            <div class="div_label">
              <label class="text_label">Title <span class="red"></span></label>
            </div>
             <input class="sq_form" placeholder="Title" id="file" name="description"  type="text" value="<?php echo $title; ?>">
			  <?php echo form_error('description', '<div class="error">', '</div>'); ?>
          </div>
      
      </div>
      
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Category <span class="red">*</span> </label>
            </div>
            <select name="category" id="category" class="js-example-basic-single sq_form" required>
                        <!-- <option value="<?php echo $category; ?>"><?php echo $category; ?></option> -->
            	<?php if ($this->db->table_exists('image_categories')): $categories = $this->db->get('image_categories')->result(); ?>
            	<?php foreach ($categories as $image_category): ?>
            			<option value="<?php echo $image_category->id; ?>"><?php echo $image_category->name; ?></option>
            	<?php endforeach; ?>
            	<?php else: ?>
                        <option value="1">Temple Images</option>
                        <option value="2">Festival Images</option>
                        <option value="3">Event Images</option>
                        <option value="4">Other Images</option>
			                  
            	<?php endif; ?>
                       </select>
  
          </div>
        </div>
      </div>
      
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Image <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="" id="file" name="file"  type="file" value="<?php echo $image; ?>">
			<?php echo form_error('file', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      
			
						
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