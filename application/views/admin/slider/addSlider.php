 <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Slider </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/viewSlider" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 ">		 
            <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add Slider </h2>
                  </div>
			   </div>
               <?php echo form_open_multipart("cms/addSlider"); ?>
       <div class="form_body">
        <div class="row">

        <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Title <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="Slider Title" id="title" name="title"  type="text" >
			<?php echo form_error('title', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Type <span class="red">*</span></label>
            </div>
            <select class="sq_form" name="type" id="slider_type" onchange="toggleSliderType(this.value)">
              <option value="image">Image</option>
              <option value="video">Video</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-lg-12" id="image_field">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Image File</label>
            </div>
            <input class="sq_form" id="file" name="file"  type="file" accept="image/*">
			<?php echo form_error('file', '<div class="error">', '</div>'); ?>
            <small class="text-muted">Allowed: jpg, jpeg, png, gif</small>
          </div>
        </div>
      </div>

      <div class="col-lg-12" id="video_field" style="display:none;">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Video URL</label>
            </div>
            <input class="sq_form" placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/..." name="video_url" type="text">
            <small class="text-muted">Paste a YouTube, Vimeo, or direct video URL</small>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Description </label>
            </div>
            <textarea class="sq_form" placeholder="Short description..." name="description"></textarea>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Display Order </label>
            </div>
            <input class="sq_form" placeholder="0" id="display_order" name="display_order"  type="number" >
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
		 
		</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>

<script>
function toggleSliderType(val) {
    if (val === 'video') {
        document.getElementById('image_field').style.display = 'none';
        document.getElementById('video_field').style.display = 'block';
    } else {
        document.getElementById('image_field').style.display = 'block';
        document.getElementById('video_field').style.display = 'none';
    }
}
</script>
