<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Payment Gateway </h2>
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
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update Payment Gateway  </h2>
                  </div>
			   </div>
               
		       <form action="<?php echo base_url();?>index.php/cms/addPaymentgateway" method="post">
		
      <div class="form_body">
        <div class="row">
			

            <div class="col-lg-4">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Payment Gateway <span class="red">*</span> </label>
                  </div>
                  <select class="form-control" id="payment_gateway" name="payment_gateway">
                      <?php foreach($payment_gateways as $gateway): ?>
                            <option value="<?= $gateway->id; ?>" id="<?= $gateway->slug; ?>" <?php echo ($payment_gateway[0]->id == $gateway->id ? 'selected': '') ?>><?= $gateway->name; ?></option>
                      <?php endforeach; ?>
                  </select>
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway razorpay">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Key ID <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="key_id" value="<?= $razorpay[0]->key_id ?? '' ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway razorpay">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Key Secret <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="key_secret" value="<?= $razorpay[0]->key_secret ?? ''; ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway eazypay">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Merchant ID  <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="e_merchant_id" value="<?= $eazypay[0]->merchant_id ?? ''; ?>" />
                      
                  <?php echo form_error('merchant_id', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway eazypay">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Sub Merchant ID <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="e_sub_merchant_id" value="<?= $eazypay[0]->sub_merchant_id ?? ''; ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway eazypay">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Encryption Key <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="e_encryption_key" value="<?= $eazypay[0]->encryption_key ?? ''; ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway eazypay">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Paymode <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="e_paymode" value="<?= $eazypay[0]->paymode ?? ''; ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway eazypay">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Return URL <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="e_return_url" value="<?= $eazypay[0]->return_url ?? ''; ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway worldline">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Merchant ID  <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="merchant_id" value="<?= $worldline[0]->merchant_id ?? ''; ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway worldline">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Transaction Type <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="transaction_type" value="<?= $worldline[0]->transaction_type ?? ''; ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway worldline">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Encryption Key <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="encryption_key" value="<?= $worldline[0]->encryption_key ?? ''; ?>" />
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway worldline">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Currency <span class="red">*</span> </label>
                  </div>
                  <select class="form-control" name="currency">
                      <?php foreach($currencies as $currency) { ?>
                            <option value="<?= $currency->currency_code ?>"> <?= $currency->currency ?> </option>
                      <?php } ?>
                  </select>
                      
                  <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 gateway worldline">
              <div class="form-group">
                <div class="row_form">
                  <div class="div_label">
                    <label class="text_label">Return URL <span class="red">*</span> </label>
                  </div>
                  <input class="form-control" name="return_url" value="<?= $worldline[0]->return_url ?? ''; ?>" />
                      
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