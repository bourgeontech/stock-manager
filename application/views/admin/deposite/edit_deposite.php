  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">DEPOSIT MODULE</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/view_deposite" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp; View</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add Deposit </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url();?>index.php/admin/admin/edit_deposite/<?php echo $id;?>" method="post">
		
      <div class="form_body">
        <div class="row">
		
		<div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Account Type <span style="color:red;">*</span> </label>
            </div>
                <select name="ac_type" id="ac_type" class="sq_form" required>
                	<option value="">Select Type</option>
    				<option value="FD" <?php if ($deposite['ac_type']=="FD"){echo "selected";}?>>FD</option>
    				<option value="SB" <?php if ($deposite['ac_type']=="SB"){echo "selected";}?>>SB</option>
    				<option value="CURRENT" <?php if ($deposite['ac_type']=="CURRENT"){echo "selected";}?>>CURRENT</option>
    			</select>
				<?php echo form_error('ac_type', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Account No <span style="color:red;">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Account No" id="ac_no" name="ac_no" value="<?php echo $deposite['ac_no']?>" type="text" >
			<?php echo form_error('ac_no', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Date</label>
            </div>
            <input class="sq_form" id="ac_date" name="ac_date" value="<?php echo $deposite['ac_date']?>" type="date" >
			<?php echo form_error('ac_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
        <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">In the name of<span style="color:red;">*</span></label>
            </div>
            <input class="sq_form" placeholder="In the name of" id="name" name="name" value="<?php echo $deposite['name']?>" type="text" required="required">
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Bank name <span style="color:red;">*</span></label>
            </div>
            <input class="sq_form" placeholder=" Bank name" id="bank_nm" name="bank_nm" value="<?php echo $deposite['bank_nm']?>" type="text" required="required">
			<?php echo form_error('bank_nm', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Bank address <span style="color:red;">*</span></label>
            </div>
            <input class="sq_form" placeholder=" Bank address" id="bank_address" name="bank_address" value="<?php echo $deposite['bank_address']?>" type="text" >
			<?php echo form_error('bank_address', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Amount <span style="color:red;">*</span></label>
            </div>
            <input class="sq_form" placeholder=" Amount" id="amount" name="amount" value="<?php echo $deposite['amount']?>" type="text" >
			<?php echo form_error('amount', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Percentage of Int</label>
            </div>
            <input class="sq_form" placeholder="Percentage of Interest" id="int_perc" name="int_perc" min="0" max="100" value="<?php echo $deposite['int_perc']?>" type="number" >
			<?php echo form_error('int_perc', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Period</label>
            </div>
            <input class="sq_form" placeholder=" Period" id="period" name="period" value="<?php echo $deposite['period']?>" type="text" >
			<?php echo form_error('period', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Maturity Date</label>
            </div>
            <input class="sq_form" placeholder=" " id="mat_date" name="mat_date" value="<?php echo $deposite['mat_date']?>" type="date" >
			<?php echo form_error('mat_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Maturity Amount</label>
            </div>
            <input class="sq_form" placeholder=" Maturity Amount" id="mat_amount" name="mat_amount" value="<?php echo $deposite['mat_amount']?>" type="text" >
			<?php echo form_error('mat_amount', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Remark</label>
            </div>
            <textarea rows="2" class="sq_form" id="remark" name="remark"><?php echo $deposite['remark']?></textarea>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Status</label>
            </div>
            <label class="custom-control custom-radio">
    			<input type="radio" class="custom-control-input" name="status" value="1" <?php if ($deposite['status']=="1"){ echo "checked";}?>>
    			<span class="custom-control-label">Active</span>
    		</label>
    		<label class="custom-control custom-radio">
    			<input type="radio" class="custom-control-input" name="status" value="0" <?php if ($deposite['status']=="0"){ echo "checked";}?>>
    			<span class="custom-control-label">InActive</span>
    		</label>
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
</div>
<div class="clearfix"></div>
<br>
</body>