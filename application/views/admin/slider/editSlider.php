<?php if(!empty($slider)){
        foreach($slider as $val){ 
            $id=$val['id'];
            $image=$val['image'] ?? '';
            $title=$val['title'];
            $description=$val['description'];
            $display_order=$val['display_order'];
            $type=$val['type'] ?? 'image';
            $video_url=$val['video_url'] ?? '';
        }
    }
?>
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
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Slider</h2>
                  </div>
			   </div>
               <?php echo form_open_multipart("cms/updateSlider/$id"); ?>
	
      <div class="form_body">
        <div class="row">
		
		<div class="col-lg-12">
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

      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Type <span class="red">*</span></label>
            </div>
            <select class="sq_form" name="type" id="slider_type" onchange="toggleSliderType(this.value)">
              <option value="image" <?php echo ($type == 'image') ? 'selected' : ''; ?>>Image</option>
              <option value="video" <?php echo ($type == 'video') ? 'selected' : ''; ?>>Video</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-lg-12" id="image_field" <?php echo ($type == 'video') ? 'style="display:none;"' : ''; ?>>
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Image File <span class="red"></span> </label>
            </div>
            <input class="sq_form" id="file" name="file"  type="file" accept="image/*" value="<?php echo $image; ?>">
            <?php if (!empty($image)): ?>
                <div style="margin-top: 10px;">
                    <img src="<?php echo base_url(); ?>uploads/slider/<?php echo $image; ?>" width="150" />
                    <p class="text-muted" style="font-size:12px;">Current image. Leave blank to keep it.</p>
                </div>
            <?php endif; ?>
			<?php echo form_error('file', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

      <div class="col-lg-12" id="video_field" <?php echo ($type == 'image') ? 'style="display:none;"' : ''; ?>>
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Video URL </label>
            </div>
            <input class="sq_form" placeholder="https://www.youtube.com/watch?v=..." name="video_url" type="text" value="<?php echo $video_url; ?>">
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
            <textarea class="sq_form" placeholder="Short description for the slider..." name="description"><?php echo $description; ?></textarea>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Display Order </label>
            </div>
            <input class="sq_form" placeholder="0" id="display_order" name="display_order"  type="number" value="<?php echo $display_order; ?>" >
			<?php echo form_error('display_order', '<div class="error">', '</div>'); ?>
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
