<style>
    .schedule_btn {
        background: #795548;
        padding: 10px;
        text-align: center;
        border: 1px solid #eee;
        border-radius: 6px;
        margin-top: 16px;
        font-weight: bold;
        color: #fff;
        margin-left: 13px;
        position: relative
    }
    .schedule_btn::before {
    	content: "";
    	background: url("images/or_line.png");
    	width: 25px;
    	height: 39px;
    	position: absolute;
    	left: -35px;
    	top: 0
    	
    }
    .schedule_btn input {
        margin-right: 5px;
        position: relative;
        top: 2px;
    }
    #dvPassport { 
        width: 100%;
    }	
    #ContentPlaceHolder1_chkweekly tr,#ContentPlaceHolder1_chkmonthly tr{
        width: 109px;
        float: left;
        height: 23px;
    }
    #ContentPlaceHolder1_chkweekly tr input,#ContentPlaceHolder1_chkmonthly tr input,#ContentPlaceHolder1_chkmonthlyAll,#ContentPlaceHolder1_chkweeklyAll{
        margin-right:5px;
        position: relative;
        top: 2px;
        margin-bottom: 8px;
    }		
    #ContentPlaceHolder1_chkmonthlyAll,#ContentPlaceHolder1_chkweeklyAll {
    	top: 0px;
    }
</style>
    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
              <div class="home_about_block">
           
              	
                <div class="inner_pak">
                  <div class="row">
                  	
                    <div class="col-lg-8 offset-lg-0">
                      <div class="accordion_d">
                        <div>Membership Registration</div>
                        
                        
                        <div class="booking_outer">
                        <form action="<?php echo base_url(); ?>index.php/membership/index" method="post">
                        <div class="row">
                          	<div class="col-sm-12">
  						  		<div class="form-group">
    								<label>Beneficiary Name <span class="red">*</span></label>
    								<div class="row">
      									<div class="col-md-3 col-sm-12">
        									<div class="input-group mb-3">
          										<select class="custom-select" id="inputGroupSelect01" name="title" required>
            										<option selected>Choose Title</option>
            										<option value="Mr. ">Mr.</option>
            										<option value="Mrs. ">Mrs.</option>
            										<option value="Ms. ">Ms.</option>
          										</select>
        									</div>
      									</div>
      									<div class="col-md-9 col-sm-12">
        									<input name="name" type="text" id="name" placeholder="Beneficiary Name" class="form-control" value="" required>
        									<?php echo form_error('name', '<div class="error">', '</div>'); ?>
      									</div>
    								</div>
  								</div>
							</div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Mobile Number <span class="red">*</span></label>
                              <input name="mobile_no" type="text" id="mobile_no" placeholder="Beneficiary Mobile Number" class="form-control" required>
                              <?php echo form_error('mobile_no', '<div class="error">', '</div>'); ?>
                            	<?php if ($this->session->flashdata('mobile_error')): ?>
   								<span class="text-danger">
        							<?php echo $this->session->flashdata('mobile_error'); ?>
    							</span>
								<?php endif; ?>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Email </label>
                              <input name="email" type="text" id="email" placeholder="Email" class="form-control">
                              <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                            </div>
                          </div>
                        	<div class="col-md-12 text-danger">
                            	<?php 
									echo $this->session->flashdata('error_view');
								?>
                        	</div>
                        
                          
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Address</label>
                                <div class="row">
                            		<div class="col-md-6">
                            			<input name="house" id="house" class="form-control mb-1" style="width:100%;" placeholder="House" />
                          			</div>
                                	<div class="col-md-6">
                            			<input name="street" id="street" class="form-control mb-1" style="width:100%;" placeholder="Street" />
                          			</div>
                                	<div class="col-md-6">
                            			<input name="post" id="post" class="form-control mb-1" style="width:100%;" placeholder="Post" />
                          			</div>
                                	<div class="col-md-6">
                            			<input name="district" id="district" class="form-control mb-1" style="width:100%;" placeholder="District" />
                          			</div>
                                	<div class="col-md-6">
                            			<input name="state" id="state" class="form-control mb-1" style="width:100%;" placeholder="State" />
                          			</div>
                                	<div class="col-md-6">
                            			<input name="pincode" id="pincode" class="form-control mb-1" style="width:100%;" placeholder="Pincode" />
                          			</div>
                          		</div>
                               <?php echo form_error('address', '<div class="error">', '</div>'); ?> 
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Birth Star (Panchangam)</label>
                                <select name="star_id" id="star_id" class="form-control" style="width:100%;">
                                  <option value="0">Please Select</option>
                                  <?php 
                                  foreach ($star_list as $star){
                                  ?>
                                  	<option value="<?php echo $star['id'];?>"><?php echo $star['name_eng']." - ".$star['name_mal'];?></option>
                                  <?php 
                                  }
                                  ?>
                                </select>
                                <?php echo form_error('star_id', '<div class="error">', '</div>'); ?> 
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Gothram</label>
                                <input name="gothram" id="gothram" class="form-control" style="width:100%;" placeholder="Gothram" />
                                <?php echo form_error('gothram', '<div class="error">', '</div>'); ?> 
                            </div>
                          </div>
                        
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Referral Code</label>
                                <input name="referral_code" id="referral_code" class="form-control" style="width:100%;" placeholder="Referral Code" required />
                                <?php echo form_error('referral_code', '<div class="error">', '</div>'); ?> 
                            	
                            	<?php if ($this->session->flashdata('referral_error')): ?>
   								<span class="text-danger">
        							<?php echo $this->session->flashdata('referral_error'); ?>
    							</span>
								<?php endif; ?>

                            </div>
                          </div>
                        
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Referred By</label>
                                <input name="referred_by" id="referred_by" class="form-control" style="width:100%;" placeholder="Referred By" />
                                <?php echo form_error('referred_by', '<div class="error">', '</div>'); ?> 
                            </div>
                          </div>
                          
                          <div class="col-sm-12">
                            <div class="form-group" id="pooja_date_group">
                              <label>Pooja  Date </label>
                            	<?php  $fourth_date = date('Y-m-d', strtotime("+2 day")); ?>
                              <input type="date" name="main_date" class="form-control" id="main_date" min="<?php echo $fourth_date?>" AutoComplete="off" onfocus="blur()" value="<?php echo $fourth_date;?>">
                            </div>
                          </div>
						  <div class="col-sm-12">
                            <div class="form-group">
                              <label>Date Speciality <span class="red"></span></label>
                              <input name="purpose" type="text" id="purpose" placeholder="Date Speciality" class="form-control">
                              <?php echo form_error('purpose', '<div class="error">', '</div>'); ?>
                            </div>
                          </div>
						   <div class="col-sm-12">
                            <div class="form-group" id="pooja_date_group">
                              <label>Membership Plan </label>
                            	
                              &nbsp;&nbsp;<input type="radio" name="plan" required  id="plan" value="1" >  Lifetime Membership &nbsp;<input type="radio" name="plan"  id="plan2" value="2"> Annual Membership
                            </div>
                          </div>
                          
                          <div class="col-lg-12 text-center mt-3">
                            <input type="submit" name="ctl00$ContentPlaceHolder1$Button1" value="Add to Tray" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ContentPlaceHolder1$Button1&quot;, &quot;&quot;, true, &quot;grp1&quot;, &quot;&quot;, false, false))" id="ContentPlaceHolder1_Button1" class="btn btn-success" />
                          </div>
                        </div>
                        </form>
                        
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="mybooking cart">
                        <div class="title"><i class="fa fa-cart-arrow-down"></i> Review </div>
                        <div class="cart_details">
                          <?php $data = $this->session->membership_data[0]; ?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>Name </td>
                              <td><span id="ContentPlaceHolder1_lbltotal1"><?php print_r($data['name'] ?? '');?></span></td>
                            </tr>
                          	<tr>
                              <td>Mobile Number </td>
                              <td><span id="ContentPlaceHolder1_lbltotal1"><?php print_r($data['mobile'] ?? '');?></span></td>
                            </tr>
                          	<tr>
                              <td>Birth Star </td>
                              <td><span id="ContentPlaceHolder1_lbltotal1"><?php print_r($data['star_eng'] ?? '');?></span></td>
                            </tr>
                          	<tr>
                              <td>Gothram </td>
                              <td><span id="ContentPlaceHolder1_lbltotal1"><?php print_r($data['gothram'] ?? '');?></span></td>
                            </tr>
                          	<tr>
                              <td>Referral Code </td>
                              <td><span id="ContentPlaceHolder1_lbltotal1"><?php print_r($data['referral_code'] ?? '');?></span></td>
                            </tr>
                          	<tr>
                              <td>Referred By </td>
                              <td><span id="ContentPlaceHolder1_lbltotal1"><?php print_r($data['referred_by'] ?? '');?></span></td>
                            </tr>
                          	<tr>
                              <td>Pooja Date </td>
                              <td><span id="ContentPlaceHolder1_lbltotal1"><?php if($data['date']) { print_r(date('d M Y', strtotime($data['date']))); } else { echo ''; }?></span></td>
                            </tr>
                            <tr class="g_total" style="border:none">
                              <td>Membership fee</td>
                              <td>Rs <span id="ContentPlaceHolder1_lbltotal2"><?php print_r($data['total'] ?? $amount);?></span></td>
                            </tr>
                          </table>
                        	
                          <div class="d-flex flex-row"> 
                          	<input type="button" name="date" value="Pay Amount" id="make_payment_btn" data-gateway="<?= $payment_gateway ?>" class="btn btn-success mr-2 w-100"> 
                          	<a ID="btn_discard" class="btn btn-outline-warning w-100" href="<?php echo base_url(); ?>index.php/membership/discard/<?php print_r($data['billing_online_id'] ?? ''); ?>" style="text-align: center;">Discard</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
	document.getElementById('mobile_no').onchange = function (e) {
        let mobile_number = e.target.value;
        
    	$.ajax({
                url: "/index.php/membership/getCustomerByMobileNo",
                type: "post",
                data: {
                	mobile_number: mobile_number
                },
        		dataType: "json",
                success: function(response) {
                    if(response) {
                    	$('#name').val(response.name)
                    	$('#email').val(response.email)
                    	$('#house').val(response.house)
                    	$('#street').val(response.street)
                    	$('#post').val(response.post)
                    	$('#district').val(response.district)
                    	$('#state').val(response.state)
                    	$('#pincode').val(response.pincode)
                    }
                }
            });
    }


    var options = {
       "key": "<?php echo $razorpay[0]->key_id; ?>", 
		"amount": "<?php echo $order->amount; ?>",
    	"order_id": "<?php echo $order->id; ?>",
    	"currency": "<?php echo $order->currency; ?>",
        "name": "<?php print_r($temple_list[0]['name']);?>",
        "description": "Pooja Booking",
        "image": "<?php echo base_url(); ?>new_site/images/icons/icons5.png",
        "handler": function (response) {
            window.location = "<?php echo site_url("membership/payment/") ?>"+response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?php echo $data['name']; ?>",
            "email": "<?php echo $data['email'] ?? ''; ?>",
            "contact": "<?php echo $data['mobile']; ?>"
        },
        "notes": {
            "address": "<?php echo $user_list[0]['district']." , ".$user_list[0]['state']; ?>",
        	"reference_no": "<?php echo $this->session->reference_no; ?>"
        },
        "theme": {
            "color": "#253237"
        }
    };
    var razorpay = new Razorpay(options);

	
    document.getElementById('make_payment_btn').onclick = function (e) {
        let gateway = e.target.getAttribute('data-gateway');
        razorpay.open();
        
        e.preventDefault();
    }

</script>