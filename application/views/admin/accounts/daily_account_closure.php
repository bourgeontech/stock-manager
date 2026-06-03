<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/accounts/closedDailyAccounts" class="btn btn-primary">Closed Accounts&nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li> 
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Account Closure </h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header">

   </div>
        </div>
			 </div>	
               <br>

		       <form action="<?php echo base_url(); ?>index.php/accounts/dailyAccountClosure" method="post" id="myform">
		
      <div class="form_body">
        <div class="row">
		
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Date <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Date" id="date" name="date" value="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d');?>" type="date" >
			<?php echo form_error('date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

           <div class="col-sm-6">
                <div class="form-group pt-1">
                  <button type="submit" class="btn btn-success mt-5 px-5" name="save" value="save" > Save </button>
                  <!-- <button type="submit" class="btn btn-success pull-right" name="save" value="print" style="margin:7px 4px;"> Save &amp; Print </button> -->
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
    <script>
    
  	<?php if($this->session->flashdata('error')) { ?>
    	Swal.fire('Error', "<?php echo $this->session->flashdata('error'); ?>", 'warning');
	<?php } ?>
    
    <?php if($this->session->flashdata('success')) { ?>
    	Swal.fire('', "<?php echo $this->session->flashdata('success'); ?>", 'success');
	<?php } ?>

    
    </script>