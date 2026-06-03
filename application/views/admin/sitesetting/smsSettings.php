<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> SMS Settings </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/cms/viewSitesetting" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update SMS Settings  </h2>
                  </div>
			   </div>
               
	<form action="<?php echo base_url();?>index.php/cms/updateSmsSettings" method="post">
		
      <div class="form_body">
        <div class="row">
			

            <div class="col-lg-6">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Do you need SMS notification feature? <span class="red">*</span> </label>
                  </div>
                  <select class="form-control" id="sms_settings" name="sms_settings">
                  	<option value="yes" >Yes</option>
                  	<option value="no" selected>No</option>
                  </select>
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
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
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
    
        const showCredential = (payment_gateway, gateway_id) => {
             $('.gateway').hide()
            const optionsArray = Array.from(payment_gateway[0].options);
            const filteredOptions = optionsArray.filter(option => option.value === gateway_id);
            const gateway = $(filteredOptions).attr('id');
            $('.'+gateway).show()
        }
        
        $(document).ready(() => {
            let payment_gateway = $('#payment_gateway')
            let gateway_id = payment_gateway.val()
            
            showCredential(payment_gateway, gateway_id)
        })
        
        $('#payment_gateway').on('change', (e) => {
            let payment_gateway = $('#payment_gateway')
            let gateway_id = e.target.value
            showCredential(payment_gateway, gateway_id)
        })
        
    </script>