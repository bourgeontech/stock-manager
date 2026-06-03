  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Devotee Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/customer_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add New Devotee </h2>
                  </div>
			   </div>

          
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/add_customer" method="post" >
		        <div class="col-lg-3 col-md-3 col-sm-3" style="text-align:right;">
                  <div class="input-group mb-3">
  							<input id="search_devotee" name="" type="text" class="form-control" placeholder="Search devotee by mobile number"  autofocus tabindex="0" required />
  							<div class="input-group-append">
    							<button class="btn btn-gray py-0" id="customer-add-btn" style="font-size:1.2em" type="button">+</button>
  							</div>
						</div>
                  		<input type="hidden" id="mobile_number" name="mobile_number" required />
                    	<div id="search-indicator-devotee"></div>
                    
                    	<div id="devotee_details">
                        	
                    	</div>
               </div>
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Name" id="name" name="name"  type="text" >
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">House <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="House Name" id="house" name="house"  type="text" >
			<?php echo form_error('house', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Street <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Street" id="street" name="street"  type="text" >
			<?php echo form_error('street', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Post  <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" post" id="post" name="post"  type="text" >
			<?php echo form_error('post', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">District <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" district" id="district" name="district"  type="text" >
			<?php echo form_error('district', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">State <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" state" id="state" name="state"  type="text" >
			<?php echo form_error('state', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Pincode <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" pincode" id="pincode" name="pincode"  type="text" >
			<?php echo form_error('pincode', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Phone <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Phone" id="phone" name="phone"  type="text" >
			<?php echo form_error('phone', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Email <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" email" id="email" name="email"  type="text" >
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
	  <?php if ($this->db->field_exists('gothram', 'user_dtl')) { ?>
	  
	  <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Gothram  </label>
            </div>
            <input class="sq_form" placeholder=" Gothram" id="gothram" name="gothram"  type="text" >
			<?php echo form_error('gothram', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
	  
	  
	  <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Star  </label>
            </div>
          <select name="star_id"  class="form-control custom-input" >
                                	<option value="28">Select Star</option>
                    			<?php foreach($birth_star as $val){ ?>  
                    				<option value="<?= $val['id']; ?>"><?php  echo $val['name_eng']." - ".$val['name_mal']; ?> (<?= $val['id']; ?>)</option>
                    			<?php } ?>
                    			</select>
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
	  <?php } ?>
			
						
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
    <script>
      $(document).on('focus', '#search_devotee', function() {
    $("#search_devotee").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: '<?php echo base_url();?>index.php/admin/billing/searchDevotee',
                type: 'post',
                dataType: "json",
                data:{
                    search: request.term
                },
                beforeSend: function() {
                    $('#devotee-placeholder').html('')
                    $('#search-indicator-devotee').html('<small class="text-primary">Loading...Please Wait!</small><div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" aria-hidden="true"></div>');
                },
                success: function( data ) {
                	
                    if(data.length > 0){
                        response( data );
                    }
                    else{
                        // $('#search_devotee').val('');
                        $('#search-indicator-devotee').html('<small class="text-danger">No Data Found!</small>');
                        return false;
                    }
                }
            });
        },
        select: function (event, ui) {
            setDevotee(ui.item);
            $('#search-indicator-devotee').html('');
            return false;
        }
    });
    })
      </script>