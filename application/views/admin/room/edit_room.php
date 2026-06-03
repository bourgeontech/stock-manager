<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Room Details</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/add_room" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Room Detail </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_room/<?php echo $id;?>" method="post" >
		
      <div class="form_body">
        <div class="row">
		
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Room Number <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Room Number" id="room_no" name="room_no" value="<?php echo $room['room_no'];?>" type="text" >
			<?php echo form_error('room_no', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Room Id Mark </label>
            </div>
            <input class="sq_form" placeholder=" Room Id Mark" name="room_id" value="<?php echo $room['room_id'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Room Door Number <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Room Door Number" name="door_no" value="<?php echo $room['door_no'];?>" type="text" >
			<?php echo form_error('door_no', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Room Address </label>
            </div>
            <input class="sq_form" placeholder=" Room Address" name="room_address" value="<?php echo $room['room_address'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Post </label>
            </div>
            <input class="sq_form" placeholder=" Room Post" name="room_post" value="<?php echo $room['room_post'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Place </label>
            </div>
            <input class="sq_form" placeholder=" Room Place" name="room_place" value="<?php echo $room['room_place'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> District </label>
            </div>
            <input class="sq_form" placeholder=" Room District" name="room_dist" value="<?php echo $room['room_dist'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Pincode </label>
            </div>
            <input class="sq_form" placeholder=" Room Pincode" name="room_pincode" value="<?php echo $room['room_pincode'];?>" type="text" >
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
<div class="clearfix"></div>
<br>
</body>