<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Room Customer</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/view_cust" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp; View</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Room Customer </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_cust/<?php echo $id;?>" method="post" >
		
      <div class="form_body">
        <div class="row">
		
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Customer Name" name="name" value="<?php echo $cust['name'];?>" type="text" required>
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Mobiler Number <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Customer Mobile Number" name="mobile" value="<?php echo $cust['mobile'];?>" type="text" required>
			<?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Door Number </label>
            </div>
            <input class="sq_form" placeholder="Door Number" name="door_no" value="<?php echo $cust['door_no'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Address </label>
            </div>
            <input class="sq_form" placeholder=" Address" name="address" value="<?php echo $cust['address'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Post </label>
            </div>
            <input class="sq_form" placeholder=" Post" name="post" value="<?php echo $cust['post'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Place </label>
            </div>
            <input class="sq_form" placeholder=" Place" name="place" value="<?php echo $cust['place'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> District </label>
            </div>
            <input class="sq_form" placeholder=" District" name="dist" value="<?php echo $cust['dist'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Pincode </label>
            </div>
            <input class="sq_form" placeholder=" Pincode" name="pincode" value="<?php echo $cust['pincode'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Id Type </label>
            </div>
          	<select class="sq_form" name="id_type">
            	<option value=""> Select </option>
            	<option value="Adhar Card" <?php if($cust['id_type']=="Adhar Card"){ echo "selected";}?>>Adhar Card</option>
            	<option value="Voter Id" <?php if($cust['id_type']=="Voter Id"){ echo "selected";}?>>Voter Id</option>
            	<option value="Driving Licence" <?php if($cust['id_type']=="Driving Licence"){ echo "selected";}?>>Driving Licence</option>
            	<option value="Passport" <?php if($cust['id_type']=="Passport"){ echo "selected";}?>>Passport</option>
            	<option value="Pan Card" <?php if($cust['id_type']=="Pan Card"){ echo "selected";}?>>Pan Card</option>
            </select>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Id Number </label>
            </div>
            <input class="sq_form" placeholder="Customer Id Number" name="id_no" value="<?php echo $cust['id_no'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Room No </label>
            </div>
          	<select class="sq_form" name="room_no">
            	<option value=""> Select </option>
            	<?php foreach ($room_list as $room){?>
            	<option value="<?php echo $room['id'];?>" <?php if($cust['room_no']==$room['id']){ echo "selected";}?>><?php echo $room['room_no'];?></option>
            	<?php }?>
            </select>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Room Rent </label>
            </div>
            <input class="sq_form" placeholder=" Room Rent" name="room_rent" value="<?php echo $cust['room_rent'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Rent Start Date </label>
            </div>
            <input class="sq_form" placeholder=" Rent Start Date" name="rent_stdate" value="<?php echo $cust['rent_stdate'];?>" type="date" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Agreement Period </label>
            </div>
            <input class="sq_form" placeholder=" Agreement Period" name="ag_period" value="<?php echo $cust['ag_period'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Rent Due Date </label>
            </div>
            <input class="sq_form" placeholder=" Rent Due Date" name="rent_due" value="<?php echo $cust['rent_due'];?>" type="date" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Agreement No </label>
            </div>
            <input class="sq_form" placeholder=" Agreement Number" name="agr_no" value="<?php echo $cust['agr_no'];?>" type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Agreement Date </label>
            </div>
            <input class="sq_form" placeholder=" Agreement Date" name="agr_date" value="<?php echo $cust['agr_date'];?>" type="date" >
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