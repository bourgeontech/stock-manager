<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Room Transaction</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/view_trans" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp; View</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add New Room Transaction </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/room_trans" method="post" >
		
      <div class="form_body">
        <div class="row">
		
		<div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Room Number <span class="red">*</span> </label>
            </div>
          	<select class="sq_form" name="room_id" required>
            	<option value=""> Select </option>
            	<?php foreach ($room_list as $room){?>
            	<option value="<?php echo $room['id'];?>"><?php echo $room['room_no'];?></option>
            	<?php }?>
            </select>
			<?php echo form_error('room_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Customer <span class="red">*</span></label>
            </div>
          	<select class="sq_form" name="cust_id" required>
            	<option value=""> Select </option>
            	<?php foreach ($cust_list as $cust){?>
            	<option value="<?php echo $cust['id'];?>"><?php echo $cust['name'];?></option>
            	<?php }?>
            </select>
			<?php echo form_error('cust_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Receipt Number  </label>
            </div>
            <input class="sq_form" placeholder="Receipt Number" name="rec_no"  type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Receipt Date </label>
            </div>
            <input class="sq_form" placeholder=" Receipt Date" name="rec_date" value="<?php echo date('Y-m-d')?>" type="date" >
          </div>
        </div>
      </div>
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
              <label class="text_label"> Rent </label>
            </div>
            <input class="sq_form" placeholder=" Rent" name="rent"  type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Rent Received </label>
            </div>
            <input class="sq_form" placeholder=" Rent Received" name="rent_recv"  type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Rent Received Date </label>
            </div>
            <input class="sq_form" placeholder="Rent Received Date" name="rent_recvdt" value="<?php echo date('Y-m-d')?>" type="date" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Instruction No </label>
            </div>
            <input class="sq_form" placeholder=" Instruction No" name="instru_no"  type="text" >
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Instruction Date </label>
            </div>
            <input class="sq_form" placeholder="Instruction Date" name="instru_date"  type="date" >
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