<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    select {
        height: 37.6px !important;
    }
    
    .devotee-card {
        min-height: 189px;
    }
    
    #dvPassport {
        min-height: 470px;
    }

	.ui-autocomplete {
    background-color: #fff; /* Set your desired background color */
    border: 1px solid #ccc; /* Add a border if needed */
    max-width: 820px;
}

.ui-menu-item {
    padding: 5px 10px; /* Adjust padding as needed */
}
</style>
<div class="page-header">
    <div class="col-lg-6 col-md-6 col-sm-6 ">
      <h4 class="page_txt">Billing Master </42>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 ">
      <ul class="btn_ul" style="float:right;">
        <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
      </ul>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <form action="<?php echo base_url(); ?>index.php/admin/schedulebilling/multy_schedule_hierarchical_pooja" method="post" id="multi-schedule-form">
            <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $last_id;?> </h3>
                    </div>
                    <div class="col-md-4">
                        <label>Please enter the money here in case of received already</label>
                        <div class="input-group mb-3">
  							<input id="advance_amount" name="advance_amount" type="text" class="form-control" placeholder="Advance Amount" value="<?php echo $this->session->advance_amount ?? ''; ?>" autofocus tabindex="0" />
						</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative">
                        <div class="form_body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card bg-light h-100 p-2 devotee-card">
                            		        <label>Search Devotee</label>
                            		        <div class="input-group mb-3">
                                		        <div class="form-check form-check-inline">
                                                  <input class="form-check-input search_by" type="radio" name="search_by" id="inlineRadio1" value="mobile_number" checked>
                                                  <label class="form-check-label" for="inlineRadio1">By mobile number</label>
                                                </div>
                                            </div>
                               				<div class="input-group mb-3">
                      							<input id="search_devotee" name="" type="text" class="form-control" placeholder="Search devotee by mobile number"  autofocus tabindex="0" />
                      							<div class="input-group-append">
                        							<button class="btn btn-gray py-0" id="customer-add-btn" style="font-size:1.2em" type="button">+</button>
                      							</div>
                    						</div>
                    						<?php echo form_error('customer_id', '<div class="error">', '</div>'); ?>
                                      		<input type="hidden" id="mobile_number" name="mobile_number" />
                                        	<div id="search-indicator-devotee"></div>
                                        
                                        	<div id="devotee_details">
                                            	<div class="table-responsive">
                                            	    
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Devotee</th>
                                                                <th>Mobile Number</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php  if(isset($devotee)) { ?>
                                          				    <tr>
                                                                <td> <input type="hidden" name="customer_id" value="<?= $devotee['id']; ?>" /> <?php echo $devotee['name']; ?></td>
                                                                <td><?php echo $devotee['mobile']; ?></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                        	</div>
                                      	</div>
                                </div>
                            </div>
                            <div class="row" id="datatable">
                            	<div class="col-md-12">
                                    
                                    <div class="row_form mb-2">
                                        <div class="div_label">
                                          <label class="text_label">Search Pooja <span class="red">*</span> </label>
                                        </div>
                                        <input type="text" class="sq_form search_sub_pooja" style="border: 1.5px solid #111;" placeholder="Search pooja by name/code"  />
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row_form">
                                            <div class="div_label">
                                                <label class="text_label">Name <span class="red">*</span> </label>
                                            </div>
                                            <input class="sq_form" placeholder=" Name" id="name" name="name"  type="text" >
                                            <input id="billno" name="billno" value="<?php echo $last_id;?>" type="hidden" >
                                			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row_form">
                                            <div class="div_label">
                                                <label class="text_label">Name Locale<span class="red">*</span> </label>
                                            </div>
                                            <input class="sq_form name" placeholder=" Name Locale" id="name_locale" name="name_locale"  type="text" >
                                			<?php echo form_error('name_locale', '<div class="error">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <div class="row_form">
                                        <div class="div_label">
                                          <label class="text_label">Birth Star <span class="red">*</span> </label>
                                        </div>
                                      
                                      	<input type="text" class="sq_form" id="search_star" />
                            			<input type="hidden" class="sq_form" id="star_id" name="star_id" />
                                        <?php echo form_error('star_id', '<div class="error">', '</div>'); ?>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row_form">
                                            <div class="div_label">
                                                <label class="text_label">Quantity <span class="red">*</span> </label>
                                            </div>
                                            <input class="sq_form" placeholder=" Quantity" id="qty" name="qty"  type="number" min="1" value="1" >
                                			<?php echo form_error('qty', '<div class="error">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form_body">
                        <div class="row mb-5 card" id="dvPassport">
                            <div class=" h-100 p-2">
                                <?php 
                                    $postal_charge = $temple_list[0]['postel_charge'];
                                    // $airmail_charge = $temple_list[0]['airmail_charge'];
                                ?>
                                        <div class="card bg-light mb-0">
                                            <table class="table table-hover mr-auto mb-0" width="25%">
                                                <tr>  
                                                    <td colspan="6">  <p>Do you need Prasadham?</p>  </td>
                                                    <td colspan="3"> <input type="radio"  name="postal_yes" class="prasadam_check" value="yes">Yes  <input type="radio" name="postal_yes" class="prasadam_check" value="no" checked />No </td>
                                                </tr>
                                                <tr class="ifYes">  
                                                    <td colspan="6">Postal type </td>
                                                    <td colspan="3"> <input type="radio"  name="postal_type" class="postal_type" value="normal" data-rate="<?php print_r($postal_charge);?>" checked /> Normal </td>
                                                </tr>
                                                <tr class="ifYes">
                                        	       <td colspan="6"> Charge ( For one time )
                                                    <input type="text" name="postel_rate" id="postel_rate" value="<?php print_r($temple_list[0]['postel_charge']);?>">
                                                </td><td>  Count
                                                    </td>
                                                    <td colspan="3">
                                                        <input type="number" min="0" id="count" name="prasadam_count" value="0" style="padding:0 5px;widtd:15%;height:50%;color:black;" class="sq_form w-100">
                                                    </td>
                                        	    </tr>
                                            </table>
                                        </div>
                            </div>
                            <div class="product-description-tab p-1 py-3">
                                <div class="description-tab-menu">
                                    <ul class="clearfix" role="tablist">
                                      <li role="presentation" id="description_1" class="active" onclick="showschedule('description')"><a style="font-size:12.5px; " href="#description" aria-controls="description" role="tab" data-toggle="tab">Daily</a></li>
                                      <li role="presentation" id="specification_1" onclick="showschedule('specification')"><a style="font-size:12.5px; " href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Weekly</a></li>
                                      <li role="presentation" id="review_1" onclick="showschedule('review')"><a style="font-size:12.5px; " href="#review" aria-controls="review" role="tab" data-toggle="tab">Monthly</a></li>
                                      <li role="presentation" id="other_1" onclick="showschedule('other')"><a style="font-size:12.5px; " href="#other" aria-controls="others" role="tab" data-toggle="tab">Others</a></li>
                                      <li role="presentation" id="custom_1" onclick="showschedule('custom')"><a style="font-size:12.5px; " href="#custom" aria-controls="custom" role="tab" data-toggle="tab">Custom</a></li>
                                      <li role="presentation" id="dated_1" onclick="showschedule('dated')"><a style="font-size:12.5px; " href="#dated" aria-controls="dated" role="tab" data-toggle="tab">Dated</a></li>
                                   </ul>
                                </div>
                                
                                <div class="tab-content">
                                    <!-- Daily Tab -->
                                    <div role="tabpanel" class="tab-pane active" id="description">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>From</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control clickable input-md date_inp" id="dailyfrom"  value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <label>No Of Days</label>
                                                <div class="form-group" >
                                                    <input type="text" class="form-control clickable input-md date_inp adddays"  id="noofdays" min="1" placeholder="No Of Days" >
                                                </div>
                                            </div>
                                              
                                            <div class="col-sm-4">
                                                <label>To</label>
                                                <div class="form-group" >
                                                    <input type="date" class="form-control clickable input-md date_inp" id="dailyto"  value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date" >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <table width="505" border="0" cellpadding="5" cellspacing="5">
                                                    
                                                </table>
                                            </div>
                                            
                                            <div class="col-sm-10">
                                                <input type="button" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
                                            </div>
                                            
                                            <div class="col-sm-2">
                                           		<input type="button" value="Submit" onclick="dailysub()"  class="btn btn-success cart_btn1">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Weekly Tab -->
                                    <div role="tabpanel" class="tab-pane" id="specification">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>From</label>
                                                <div class="form-group">
                                                 <input type="date" class="form-control clickable input-md date_inp" id="weeklyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <label>No Of Weeks</label>
                                                <div class="form-group">
                                                 <input type="text" class="form-control clickable input-md addweeks" id="noofweeks" min="1" value="" placeholder=" No Of Weeks">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <label>To</label>
                                                <div class="form-group">
                                                 <input type="date" class="form-control clickable input-md date_inp" id="weeklyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <table width="505" height="100" border="0" cellpadding="5" cellspacing="5">
                                                    <tr>
                                                        <th width="26" height="29" scope="row">
                                                          <input class="booking-week-table-input" type="checkbox" name="checkbox" id="checkAll" />
                                                        </th>
                                                        <td width="83">All</td>
                                                        <td width="28">&nbsp;</td>
                                                        <td width="87">&nbsp;</td>
                                                        <td width="24">&nbsp;</td>
                                                        <td width="88">&nbsp;</td>
                                                        <td width="18">&nbsp;</td>
                                                        <td width="101">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <th height="28" scope="row"><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Sunday" id="week"></th>
                                                        <td>Sunday</td>
                                                        <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Monday" id="week"></td>
                                                        <td>Monday</td>
                                                        <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Tuesday" id="week"></td>
                                                        <td>Tuesday</td>
                                                        <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Wednesday" id="week"></td>
                                                        <td>Wednesday</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Thursday" id="week"></th>
                                                        <td>Thursday</td>
                                                        <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Friday" id="week"></td>
                                                        <td>Friday</td>
                                                        <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Saturday" id="week"></td>
                                                        <td>Saturday</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            
                                            <div class="col-sm-2 ">
                                                <input type="button" value="Submit" onclick="weeklysub()" class="btn btn-success cart_btn1">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="submit" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Monthly Tab -->
                                    <div role="tabpanel" class="tab-pane" id="review">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>From</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control clickable input-md date_inp datefrom" id="monthlyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <label>No Of Months</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control addmonths" id="months"  >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <label>To</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control clickable input-md date_inp dateto" id="monthlyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 row">
                                                <div class="form-check-all form-check-inline col-sm-12">
                                                    <input id="checkmonth" type="checkbox" class="checkmonth" name="ctl00$ContentPlaceHolder1$chkmonthly$0" value="All">
                                                    <label for="ContentPlaceHolder1_chkmonthly_0">All</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_0" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$0" value="Aswathi">
                                                    <label for="ContentPlaceHolder1_chkmonthly_0">Aswathi</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_1" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$1" value="Bharani">
                                                    <label for="ContentPlaceHolder1_chkmonthly_1">Bharani</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_2" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$2" value="Karthika">
                                                    <label for="ContentPlaceHolder1_chkmonthly_2">Karthika</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_3" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$3" value="Rohini">
                                                    <label for="ContentPlaceHolder1_chkmonthly_3">Rohini</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_4" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$4" value="Makiyeeram">
                                                    <label for="ContentPlaceHolder1_chkmonthly_4">Makiyeeram</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_5" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$5" value="Thiruvathira">
                                                    <label for="ContentPlaceHolder1_chkmonthly_5">Thiruvathira</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_6" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$6" value="Ponartham">
                                                    <label for="ContentPlaceHolder1_chkmonthly_6">Ponartham</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_7" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$7" value="Pooyam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_7">Pooyam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_8" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$8" value="Aayilyam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_8">Aayilyam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_9" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$9" value="Makam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_9">Makam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_9" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$9" value="Pooram">
                                                    <label for="ContentPlaceHolder1_chkmonthly_9">Pooram</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_10" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$10" value="Uthram">
                                                    <label for="ContentPlaceHolder1_chkmonthly_10">Uthram</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_11" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$11" value="Atham">
                                                    <label for="ContentPlaceHolder1_chkmonthly_11">Atham</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_12" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$12" value="Chithra">
                                                    <label for="ContentPlaceHolder1_chkmonthly_12">Chithra</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_13" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$13" value="Chothi">
                                                    <label for="ContentPlaceHolder1_chkmonthly_13">Chothi</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_14" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$14" value="Visakham">
                                                    <label for="ContentPlaceHolder1_chkmonthly_14">Visakham</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_15" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$15" value="Anisham">
                                                    <label for="ContentPlaceHolder1_chkmonthly_15">Anisham</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_16" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$16" value="Trikketta">
                                                    <label for="ContentPlaceHolder1_chkmonthly_16">Trikketta</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_17" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$17" value="Moolam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_17">Moolam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_18" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$18" value="Pooradam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_18">Pooradam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_19" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$19" value="Uthradam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_19">Uthradam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_20" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$20" value="Thiruvonam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_20">Thiruvonam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_21" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$21" value="Avittam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_21">Avittam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_22" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$22" value="Chathayam">
                                                    <label for="ContentPlaceHolder1_chkmonthly_22">Chathayam</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_23" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$23" value="Poororuttathi">
                                                    <label for="ContentPlaceHolder1_chkmonthly_23">Poororuttathi</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_24" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$24" value="Uthratathi">
                                                    <label for="ContentPlaceHolder1_chkmonthly_24">Uthratathi</label>
                                                </div>
                                                <div class="form-check form-check-inline col-lg-3 col-md-3">
                                                    <input id="ContentPlaceHolder1_chkmonthly_25" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$25" value="Revathi">
                                                    <label for="ContentPlaceHolder1_chkmonthly_25">Revathi</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2 ">
                                                <input type="button" value="Submit" onclick="monthlysub()" class="btn btn-success cart_btn1">
                                            </div> 
                                            <div class="col-sm-2">
                                                <input type="submit" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Other Tab -->
                                    <div role="tabpanel" class="tab-pane" id="other">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>From</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control clickable input-md date_inp otherfrom" id="otherfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>No Of Months</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control addothers" id="others"  >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>To</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control clickable input-md date_inp otherto" id="otherto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 row">
                                                <?php foreach ($other_list as $key => $other){  ?>
                                                    <div class="form-check form-check-inline col-sm-6">
                                                        <input id="ContentPlaceHolder1_chkmonthly_<?= $key; ?>" type="checkbox" class="other_id mr-2" name="ctl00$ContentPlaceHolder1$chkmonthly$<?= $key; ?>" value="<?= $other['other_code']; ?>">
                                                        <label for="ContentPlaceHolder1_chkmonthly_<?= $key; ?>"><?= $other['other_detail']; ?></label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-2 ">
                                                <input type="button" value="Submit" onclick="othersub()" class="btn btn-success cart_btn1">
                                            </div> 
                                            <div class="col-sm-2">
                                                <input type="submit" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Othersubmit" class="btn btn-info cart_btn1">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Custom Tab -->
                                    <div role="tabpanel" class="tab-pane" id="custom">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group date" id="datepicker">
                                                    <input type="text" class="form-control" id="Dates" name="Dates" placeholder="Select days" required />
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <table width="505" border="0" cellpadding="5" cellspacing="5">
                                                    
                                                </table>
                                            </div>
                                            
                                            <div class="col-sm-10">
                                                <input type="button" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
                                            </div>
                                            
                                            <div class="col-sm-2">
                                           		<input type="button" value="Submit" onclick="customsub()" class="btn btn-success cart_btn1">
                                            </div>
                                        </div>
                                    </div>
                                
                                	<!-- Dated Tab -->
                                    <div role="tabpanel" class="tab-pane" id="dated">
                                        <div class="row">
                                            <div class="col-sm-12 mb-2">
<!--                                                 <div class="input-group date" id="datepicker">
                                                    <input type="text" class="form-control" id="Dates" name="Dates" placeholder="Select days" required />
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                                                </div> -->
                                            	<div class="mb-4">
                                                	<div class="form-check form-check-inline col-sm-6">
                                                     	<input id="dated_ot" type="radio" class=" mr-2" name="dated_type" value="D" checked>
                                                      	<label for="dated_ot">One Time</label>
                                                	</div>
                                                	<div class="form-check form-check-inline col-sm-6">
                                                     	<input id="dated_m" type="radio" class=" mr-2" name="dated_type" value="M">
                                                      	<label for="dated_m">Monthly</label>
                                                	</div>
                                                	<div class="form-check form-check-inline col-sm-6">
                                                     	<input id="dated_y" type="radio" class=" mr-2" name="dated_type" value="Y">
                                                      	<label for="dated_y">Yearly</label>
                                                	</div>
                                            	</div>
                                            
                                            	
                                                	<div id="ifDatedMonthlyYearly" class="row mb-2 d-none">
                                                    	<div class="col-md-6">
                                                		<label for="end_year">End Year</label>
        <select id="end_year" name="end_year" class="form-control">
            <?php
            // Get the current year
            $currentYear = date("Y");
            
            // Create options for years from current year to 10 years ahead
            for ($i = $currentYear; $i <= $currentYear + 10; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
		
                                                    </div>
                                                    <div class="col-md-6">
        <label for="end_month">End Month</label>
        <select id="end_month" name="end_month" class="form-control">
            <?php
            // Create options for months
            $months = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
            ];
            
            foreach ($months as $key => $month) {
                echo "<option value='$key'>$month</option>";
            }
            ?>
        </select>
                                                	</div>
                                                </div>
                                            
                                                <label>Date</label>
                                            	<input type="date" class="form-control" id="custom_date" name="custom_date" required />
                                            	
                                            </div>
                                            
                                            <div class="col-sm-10">
                                                <input type="button" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Datedsubmit" class="btn btn-info cart_btn1">
                                            </div>
                                            
                                            <div class="col-sm-2">
                                           		<input type="button" value="Submit" onclick="datedsub()" class="btn btn-success cart_btn1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pooja List -->
                        <div class="row" id="scheduletable">
                      		<div class="col-sm-12" style="padding:10px;">
                      			<table class="table display table-hover srp_table" width="100%" border="1" style="display:none;">
                      				<thead>
                      					<tr>
                      						<th>#</th>
                      						<th>Date</th>
                      						<th>Star</th>
                      						<th>Action</th>
                      					</tr>
                      				</thead>
                      				<tbody id="mytbody">
                      				    
                      				</tbody>
                      			</table>
                      		</div>
                      	</div>
                    </div>
                </div>
            </div>
            
            <div class="row ">
                
                <div class="col-lg-5 col-md-5 col-sm-5 ml-auto">
                    <div class="form_body">
                        <div class="shadow-sm p-3 mb-2 bg-white">
                            <?php
            	                $i=1; $total=0;
            	                foreach($temple_list as $val){ 
                        	        $postel_charge=$val['postel_charge'];
                                	$amt=$total_amount;
                        	        $total=$total+$amt;
                        	        $postal_charge = $temple_list[0]['postel_charge'];
                        	        
            	            ?>
            	                <div class="col-sm-12 " style="display:none;" align="right">
                           			<button type="submit" class="btn btn-success" name="save" value="save" style="margin:10px 4px 0 4px; font-size: 1.5em;"> Save </button>
                        		</div>
                        		
                        		
                                
                        		<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <?php 
                                        $i=1;
                                        $cc=0;
                                        $c=0;
//                                         $postal_charge = $temple_list[0]['postel_charge'];
//                                         $airmail_charge = $temple_list[0]['airmail_charge'];
//                                         if($bill_lists){
//                                        	    foreach($bill_lists['orders'] as $val) {
//                                                 $cc+=$val['rate'];
//                                                 $c+=$val['total'];
//                                             }
                    
//                                             if($bill_lists['mutturakkal_count']) {
//                                       	        $cc += ($bill_lists['mutturakkal_count'] * $coconut_rate);
//                                             }
//                                         }
                                    ?>
                                    <tr class="g_total">
                                        <th style="padding: 25px;">Total rate for pooja</th>
                                        <th style="padding: 0px;">₹ <span id="Cont"><?php echo $total_amount;?></span></th>
                                    </tr>
                                    
                                    
                                </table>
                                
                                
                                <div style="display: flex; justify-content: space-between;">
                                    

                                    <?php if(isset($ref)) { ?>
                                        <div style="padding: 10px;">
                                            <a class="btn btn-info" href="<?php echo base_url()."index.php/admin/schedulebilling/discardbill/". $ref; ?>">Discard Bill</a>
                                        </div>
                                    <?php } ?>
                                
                                    <div style="padding: 10px;">
                                        <a ID="btn_pay" class="btn btn-success" href="<?php echo base_url(); ?>index.php/admin/schedulebilling/review">Review &amp; Pay</a>
                                    </div>
                                </div>
                        	<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="clearfix"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	
    var customDates = [];
    $('#datepicker').datepicker({
        startDate: new Date(),
        multidate: true,
        format: "dd/mm/yyyy",
        language: 'en'
    }).on('changeDate', function (selected) {
        var selectedDate = new Date(selected.date);
        var year = selectedDate.getFullYear();

        // Months are zero-based, so you need to add 1 to get the correct month
        var month = selectedDate.getMonth() + 1;
        month = month < 10 ? '0' + month : month; // prepend 0 if month is less than 10
        
        var day = selectedDate.getDate();
        day = day < 10 ? '0' + day : day; // prepend 0 if day is less than 10
        
        var formattedDate = year + '-' + month + '-' + day;
        
        customDates.push(formattedDate)
     });
     
     

    
    $('.ifYes').hide();
    $('.prasadam_check').on('click', () => {
		var data = $('.prasadam_check:checked').val();
        if(data === 'yes'){
           $('.ifYes').show();
           
           var data = $('.postal_type:checked').val();
           let rate = $('.postal_type:checked').data('rate')
           $('#postel_rate').val(rate)
        }
    	else{
     		$('.ifYes').hide();
    	}
    });
    // Get Parent Poojas
    function changepooja(){
        var diety=$('#diety_id').val();
        $('#parent_pooja_id').html("");
        var html='<option value="0">Please Select</option>';
        var url = '<?php echo base_url();?>index.php/admin/billing/getparentpoojasbyid';
    	$.ajax({
            type: "POST",
            url: url,
            data: {'deity': diety},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	console.log(obj);
                	let is_selected = obj.id == 60 ? 'selected' : ''
                	html +='<option value="'+obj.id+'" "'+is_selected+'">'+obj.pooja+' - '+obj.pooja_mal+' - Rs '+obj.pooja_rt+'</option>';
                });
                $('#parent_pooja_id').append(html);
            }
        });
    }
    
    // Add new sub pooja
    function addRow() {
        var row_value=$('#row_value').val();
        row_value++;
        var html = '<div class="col-lg-4 column_'+row_value+'"><div class="form-group"><div class="row_form"><div class="div_label">';
            html +='<label class="text_label">Pooja <span class="red">*</span> </label></div>';
            html +='<input type="text" class="sq_form" id="search_sub_pooja_'+row_value+'" />';
            html +='<input type="hidden" class="sq_form" id="pooja_id_'+row_value+'" name="pooja_id[]" />';
			html +='</div></div></div>';
    		$('#datatable').append(html);
    		$('#row_value').val(row_value);
    		
		    $('#search_sub_pooja_'+row_value).focus()
    		$('.search_sub_pooja').val('')
    }

    // Display devotee details
    function setDevotee(data){
     	$("#search_devotee").val('')
     	$('#devotee_details  table tbody').empty()
        $('#bill_name').val(data.name)
        $('#user_ledger_id').val(data.led_id)
     	$('#devotee_details').append('<input type="hidden" name="customer_ledger_id" value="'+data.led_id+'"> <input type="hidden" name="customer_id" value="'+data.id+'">');
     	$('#bal_amount_option').data('ledger_id', data.led_id);
     	$('#mobile_number').val(data.mobile);
        $('#name').val(data.name)
     	$('#devotee_details table tbody').append(''+

                                                    '<tr>'+
                                                        '<td>'+data.name+'</td>'+
                                                        '<td>'+data.mobile+'</td>'+
                                                    '</tr>'+
     	                             '');
    
    	$('#name').focus().select()
	}
	
    // Search Devotee
    $('#search_devotee').autocomplete({
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

    
 

    // Add Devotee
    $('#customer-add-btn').on('click', (e) => {
	        Swal.fire({
              title: 'Create Devotee',
              html: `
              <form id="myForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="type" class="form-control custom-input" required>
                                <option value="A"> One Time </option>
                                <option value="B"> Recurring </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="house" placeholder="House" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="street" placeholder="Street" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="post" placeholder="Post" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="district" placeholder="District" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="state" placeholder="State" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="pincode" placeholder="Postal Code" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email" class="form-control custom-input" >
                        </div>
                    </div>
                </div>
            </form>
              `,
              width: '60%',
              showCancelButton: true,
              confirmButtonText: 'Submit',
              preConfirm: () => {
                let form = document.getElementById('myForm');
                
                if (form.checkValidity()) {
                    const formData = new FormData(form);
                    console.log((formData.get('name')))
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/admin/admin/add_customer' ,
                        data: {
                            'user_type' : formData.get('type'),
                            'name'      : formData.get('name'),
                            'house'     : formData.get('house'),
                            'street'    : formData.get('street'),
                            'post'      : formData.get('post'),
                            'district'  : formData.get('district'),
                            'state'     : formData.get('state'),
                            'pincode'   : formData.get('pincode'),
                            'phone'     : formData.get('phone'),
                            'email'     : formData.get('email')
                        },
                        success: function (data) {
                            if (data) {
                                setDevotee(JSON.parse(data))
                            }
                        }
                    });
        
                } else {
                  const invalidInputs = document.querySelectorAll('.custom-input:invalid');
                  $('.custom-input').css('border-color', 'unset');
                  invalidInputs.forEach(input => {
                    $(input).css('border-color', 'red');
                  });
                  
                  Swal.showValidationMessage('Please fill in all required fields.');
                }
              },
              didRender: () => {
                // Bootstrap 4: Apply Bootstrap styling to the modal content
                $('.swal2-container').addClass('bootstrap-4-modal');
              },
              didDestroy: () => {
                // Cleanup input styles after modal is destroyed
                const invalidInputs = document.querySelectorAll('.custom-input');
                invalidInputs.forEach(input => {
                  $(input).css('border-color', 'unset');
                });
              }
            });
	    })
    
    
    $( ".addmonths" ).keyup(function() {
         var x = parseInt($(this).val());
         var datefrom = $('.datefrom').val();
         var datefrom =  new Date(datefrom);
         // var dateto = datefrom.addMonths(x);
         // var date = dateto.toString('yyyy-MM-dd');
         // 
          const dateto = new Date(datefrom.setMonth(datefrom.getMonth()+x));
    	 var date =  dateto.toISOString().slice(0, 10);
         $('.dateto').val(date);
    });
    $( ".addothers" ).keyup(function() {
         var x = parseInt($(this).val());
         var datefrom = $('.otherfrom').val();
         var datefrom =  new Date(datefrom);
         // var dateto = datefrom.addMonths(x);
         // var date = dateto.toString('yyyy-MM-dd');
         const dateto = new Date(datefrom.setMonth(datefrom.getMonth()+x));

    	 var date =  dateto.toISOString().slice(0, 10);
         $('.otherto').val(date);
    });
    $( ".addweeks" ).keyup(function() {
         var x = parseInt($(this).val());
         var datefrom = $('#weeklyfrom').val();
         var datefrom =  new Date(datefrom);
         // var dateto = datefrom.addWeeks(x);
         // var date = dateto.toString('yyyy-MM-dd');
         const dateto = new Date(new Date(datefrom).setDate(datefrom.getDate() + (x * 7)))
    	 var date =  dateto.toISOString().slice(0, 10);
         $('#weeklyto').val(date);
    });
    $( ".adddays" ).keyup(function() {
         var x = parseInt($(this).val());
         var datefrom = $('#dailyfrom').val();
         var datefrom =  new Date(datefrom);
         // var dateto = datefrom.addDays(x);
         const dateto = new Date(new Date(datefrom).setDate(datefrom.getDate() + x - 1))
    	 var date =  dateto.toISOString().slice(0, 10); //dateto.toString('yyyy-MM-dd');
         $('#dailyto').val(date);
    });
    $( ".star" ).change(function() {
         var star = $(this).find(':selected').attr('data-name');
         $('.month').each(function(index,value){
             if(value.value == star){
                $(".month:eq(" + index + ")").prop("checked", true); 
             }
             else{
                $(".month:eq(" + index + ")").prop("checked", false); 
             }
         }); 
    });
    
    
    //  Schedule
    function showschedule(id){
        $('#description').removeClass("active");
        $('#specification').removeClass("active");
        $('#review').removeClass("active");
        $('#other').removeClass("active");
    	$('#custom').removeClass("active");
    	$('#dated').removeClass("active");
        $('#description_1').removeAttr('class');
        $('#specification_1').removeAttr('class');
        $('#review_1').removeAttr('class');
        $('#other_1').removeAttr('class');
    	$('#custom_1').removeAttr('class');
    	$('#dated_1').removeAttr('class');
        $('#'+id).addClass("active");
        $('#'+id+"_1").addClass("active");
    }
    
    // Daily 
    function dailysub(){
    	var datefrom=$('#dailyfrom').val();
    	var dateto=$('#dailyto').val();
        var noofdays=$('#noofdays').val();
        
        if(datefrom==""){
    	    alert("Date field is required");
    	}else if(dateto==""){
    	    alert("Date field is required");
    	}
    	$(".display").removeAttr('style');
    	var url = '<?php echo base_url();?>index.php/admin/admin/getdatestar';
    	var html="";
    	var a="1";
    	$.ajax({
            type: "POST",
            url: url,
            data: {'from': datefrom,'to': dateto,'noofdays':noofdays},
            dataType: "json",
            success: function (data) {
                console.log(data)
                $.each(data, function (i, obj)
                {
                // 	html +='<tr><td>'+a+'</td>';
                // 	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                // 	html +='<td>'+obj.name_eng+'</td>';
                // 	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                    html += '<input type="hidden" name="dates[]" value="'+obj.birth_date+'">';
                	a++;
                });
                $('#mytbody').html(html);
                
                if($('.prasadam_check:checked').val() == 'yes') {
                    let prasadam_count = parseInt($('[name="prasadam_count"]').val())
                    // let message = 'You have added prasadam ('+ $('.postal_type:checked').val() +') for '+ $('[name="prasadam_count"]').val() +' days.'
                    let message = isNaN(prasadam_count) ? "Prasadam count is not specified" : (prasadam_count == 0 ? "Prasadam count is not specified" : "Have you added the prasadam correctly?")
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                } else {
                    // let message = "You haven't choosen prasadam"
                    let message = "Have you added the prasadam correctly?"
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                }
            }
        });
    }
    
    function customsub(){
       console.log(customDates)
    // 	var datefrom=$('#dailyfrom').val();
        
    //     if(datefrom==""){
    // 	    alert("Date field is required");
    // 	}else if(dateto==""){
    // 	    alert("Date field is required");
    // 	}
    	$(".display").removeAttr('style');
    	var url = '<?php echo base_url();?>index.php/admin/admin/getcustomdatestar';
    	var html="";
    	$.each(customDates, function (i, obj)
                {
                    console.log(obj)
                // 	html +='<tr><td>'+a+'</td>';
                // 	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                // 	html +='<td>'+obj.name_eng+'</td>';
                // 	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                    html += '<input type="hidden" name="dates[]" value="'+obj+'">';
                });
                $('#mytbody').html(html);
                
                if($('.prasadam_check:checked').val() == 'yes') {
                    let prasadam_count = parseInt($('[name="prasadam_count"]').val())
                    // let message = 'You have added prasadam ('+ $('.postal_type:checked').val() +') for '+ $('[name="prasadam_count"]').val() +' days.'
                    let message = isNaN(prasadam_count) ? "Prasadam count is not specified" : (prasadam_count == 0 ? "Prasadam count is not specified" : "Have you added the prasadam correctly?")
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                } else {
                    // let message = "You haven't choosen prasadam"
                    let message = "Have you added the prasadam correctly?"
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                }
    // 	var a="1";
    // 	$.ajax({
    //         type: "POST",
    //         url: url,
    //         data: {'dates': customDates},
    //         dataType: "json",
    //         success: function (data) {
                
    //         //     $.each(data, function (i, obj)
    //         //     {
    //         //         obj = obj[0];
    //         //     	html +='<tr><td>'+a+'</td>';
    //         //     	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
    //         //     	html +='<td>'+obj.name_eng+'</td>';
    //         //     	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
    //         //     	a++;
    //         //     });
    //         //     $('#mytbody').html(html);
    //         // 	$("#multi-schedule-form").submit();
            
    //             $.each(data, function (i, obj)
    //             {
    //             // 	html +='<tr><td>'+a+'</td>';
    //             // 	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
    //             // 	html +='<td>'+obj.name_eng+'</td>';
    //             // 	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
    //                 html += '<input type="hidden" name="dates[]" value="'+obj.birth_date+'">';
    //             	a++;
    //             });
    //             $('#mytbody').html(html);
                
    //             if($('.prasadam_check:checked').val() == 'yes') {
    //                 let prasadam_count = parseInt($('[name="prasadam_count"]').val())
    //                 // let message = 'You have added prasadam ('+ $('.postal_type:checked').val() +') for '+ $('[name="prasadam_count"]').val() +' days.'
    //                 let message = isNaN(prasadam_count) ? "Prasadam count is not specified" : (prasadam_count == 0 ? "Prasadam count is not specified" : "Have you added the prasadam correctly?")
    //                 Swal.fire({
    //                   title: "Are you sure?",
    //                   text: message,
    //                   icon: "warning",
    //                   showCancelButton: true,
    //                   confirmButtonColor: "#3085d6",
    //                   cancelButtonColor: "#d33",
    //                   confirmButtonText: "Yes!"
    //                 }).then((result) => {
    //                   if (result.isConfirmed) {
    //                     $("#multi-schedule-form").submit();
    //                   } 
    //                 });
    //             } else {
    //                 // let message = "You haven't choosen prasadam"
    //                 let message = "Have you added the prasadam correctly?"
    //                 Swal.fire({
    //                   title: "Are you sure?",
    //                   text: message,
    //                   icon: "warning",
    //                   showCancelButton: true,
    //                   confirmButtonColor: "#3085d6",
    //                   cancelButtonColor: "#d33",
    //                   confirmButtonText: "Yes!"
    //                 }).then((result) => {
    //                   if (result.isConfirmed) {
    //                     $("#multi-schedule-form").submit();
    //                   } 
    //                 });
    //             }
    //         }
    //     });
    }

	$('[name="dated_type"]').on('click', (e) => {
    	if(e.target.value != 'D') {
    		$('#ifDatedMonthlyYearly').removeClass('d-none')
        } else {
        	$('#ifDatedMonthlyYearly').addClass('d-none')
        }
    });
	// Dated
	function datedsub(){
       	
    	var date	   = $('#custom_date').val();
    	var dated_type = $('[name="dated_type"]:checked').val();
    	var end_year = $('#end_year').val();
    	var end_month = $('#end_month').val();
        if(date==""){
    	    alert("Date field is required");
    	}
    
    	$(".display").removeAttr('style');
    	var url = '<?php echo base_url();?>index.php/admin/schedulebilling/getDatedArray';
    	var html="";
    	var a="1";
    	$.ajax({
            type: "POST",
            url: url,
            data: {'date': date,'dated_type': dated_type, 'end_year': end_year, 'end_month': end_month},
            dataType: "json",
            success: function (data) {

                $.each(data, function (i, obj)
                {
                    html += '<input type="hidden" name="dates[]" value="'+obj.birth_date+'">';
                	a++;
                });
                $('#mytbody').html(html);
                
                if($('.prasadam_check:checked').val() == 'yes') {
                    let prasadam_count = parseInt($('[name="prasadam_count"]').val())
                    // let message = 'You have added prasadam ('+ $('.postal_type:checked').val() +') for '+ $('[name="prasadam_count"]').val() +' days.'
                    let message = isNaN(prasadam_count) ? "Prasadam count is not specified" : (prasadam_count == 0 ? "Prasadam count is not specified" : "Have you added the prasadam correctly?")
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                } else {
                    // let message = "You haven't choosen prasadam"
                    let message = "Have you added the prasadam correctly?"
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                }
            }
        });
    }
    
    // Weekly
    function weeklysub(){
        var datefrom=$('#weeklyfrom').val();
    	var dateto=$('#weeklyto').val();
        var week = parseInt($('#weeks').val());
        var noofweeks=parseInt($('#noofweeks').val());
        if(datefrom==""){
    	    alert("Date field is required");
    	}else if(dateto==""){
    	    alert("Date field is required");
    	}
    	$(".display").removeAttr('style');

    	var url = '<?php echo base_url();?>index.php/admin/admin/getweekstar';
    	var html="";
    	var a="1";
    	var sel=$('#week:checked').map(function(_, el) {
            var day=$(el).val();
            $.ajax({
                type: "POST",
                url: url,
                data: {'from': datefrom,'to': dateto,'day': day,'noofweeks':noofweeks},
                dataType: "json",
                success: function (data) {
                //     $.each(data, function (i, obj)
                //     {
                //     	html +='<tr><td>'+a+'</td>';
                //     	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                //     	html +='<td>'+obj.name_eng+'</td>';
                //     	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                //     	a++;
                //     });
                //     $('#mytbody').html(html);
                // 	$("#multi-schedule-form").submit();
                
                    $.each(data, function (i, obj)
                {
                // 	html +='<tr><td>'+a+'</td>';
                // 	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                // 	html +='<td>'+obj.name_eng+'</td>';
                // 	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                    html += '<input type="hidden" name="dates[]" value="'+obj.birth_date+'">';
                	a++;
                });
                $('#mytbody').html(html);
                
                if($('.prasadam_check:checked').val() == 'yes') {
                    let prasadam_count = parseInt($('[name="prasadam_count"]').val())
                    // let message = 'You have added prasadam ('+ $('.postal_type:checked').val() +') for '+ $('[name="prasadam_count"]').val() +' days.'
                    let message = isNaN(prasadam_count) ? "Prasadam count is not specified" : (prasadam_count == 0 ? "Prasadam count is not specified" : "Have you added the prasadam correctly?")
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                } else {
                    // let message = "You haven't choosen prasadam"
                    let message = "Have you added the prasadam correctly?"
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                }
                }
            });
        }).get();
    }
    
    // Monthly 
    function monthlysub(){
        var datefrom=$('#monthlyfrom').val();
    	var dateto=$('#monthlyto').val();
        var month = parseInt($('#months').val());
    
    	if(datefrom==""){
    	    alert("Date field is required");
    	}else if(dateto==""){
    	    alert("Date field is required");
    	}
    	$(".display").removeAttr('style');

    	var url = '<?php echo base_url();?>index.php/admin/admin/getmonthstar';
    	var html="";
    	var a="1";
    	var sel=$('.month:checked').map(function(_, el) {
            var star=$(el).val();
            $.ajax({
                type: "POST",
                url: url,
                data: {'from': datefrom,'to': dateto,'star': star,'month':month},
                dataType: "json",
                success: function (data) {
                //     $.each(data, function (i, obj)
                //     {
                //     	html +='<tr><td>'+a+'</td>';
                //     	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                //     	html +='<td>'+obj.name_eng+'</td>';
                //     	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                //     	a++;
                //     });
                //     $('#mytbody').html(html);
                //  	$("#monthlyto").show();
                // 	$("#multi-schedule-form").submit();
                
                    $.each(data, function (i, obj)
                {
                // 	html +='<tr><td>'+a+'</td>';
                // 	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                // 	html +='<td>'+obj.name_eng+'</td>';
                // 	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                    html += '<input type="hidden" name="dates[]" value="'+obj.birth_date+'">';
                	a++;
                });
                $('#mytbody').html(html);
                
                if($('.prasadam_check:checked').val() == 'yes') {
                    let prasadam_count = parseInt($('[name="prasadam_count"]').val())
                    // let message = 'You have added prasadam ('+ $('.postal_type:checked').val() +') for '+ $('[name="prasadam_count"]').val() +' days.'
                    let message = isNaN(prasadam_count) ? "Prasadam count is not specified" : (prasadam_count == 0 ? "Prasadam count is not specified" : "Have you added the prasadam correctly?")
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                } else {
                    // let message = "You haven't choosen prasadam"
                    let message = "Have you added the prasadam correctly?"
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                }
                }
            });
        }).get();
    }
    
    // Other
    function othersub(){
    	// var datefrom=$('#otherfrom').val();
    	// var month = parseInt($('#others').val());
    	// var date = Date.parse(datefrom).add({ years: 0, months: month, weeks:0, days:0 });
    	// var dateto =  date.toString('yyyy-MM-dd');
    	var datefrom=$('#otherfrom').val();
    	var dateto=$('#otherto').val();
        var month = parseInt($('#others').val());
    	if(datefrom==""){
    	    alert("Date field is required");
    	}else if(dateto==""){
    	    alert("Date field is required");
    	}
    	$(".display").removeAttr('style');
    	$("#cdt").val(dateto);
    	var url = '<?php echo base_url();?>index.php/admin/admin/getother';
    	var html="";
    	var a="1";
    	var sel=$('.other_id:checked').map(function(_, el) {
            console.log(el);
            var other=$(el).val();
            console.log(other);
            $.ajax({
                type: "POST",
                url: url,
                data: {'from': datefrom,'to': dateto,'other': other},
                dataType: "json",
                success: function (data) {
                    // $.each(data, function (i, obj)
                    // {
                    // 	html +='<tr><td>'+a+'</td>';
                    // 	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                    // 	html +='<td>'+obj.name_eng+'</td>';
                    // 	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                    // 	a++;
                    // });
                    // $('#mytbody').html(html);
                    // $(".dateto").show();
                    // $("#multi-schedule-form").submit();
                    
                    $.each(data, function (i, obj)
                {
                // 	html +='<tr><td>'+a+'</td>';
                // 	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                // 	html +='<td>'+obj.name_eng+'</td>';
                // 	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                    html += '<input type="hidden" name="dates[]" value="'+obj.birth_date+'">';
                	a++;
                });
                $('#mytbody').html(html);
                
                if($('.prasadam_check:checked').val() == 'yes') {
                    let prasadam_count = parseInt($('[name="prasadam_count"]').val())
                    // let message = 'You have added prasadam ('+ $('.postal_type:checked').val() +') for '+ $('[name="prasadam_count"]').val() +' days.'
                    let message = isNaN(prasadam_count) ? "Prasadam count is not specified" : (prasadam_count == 0 ? "Prasadam count is not specified" : "Have you added the prasadam correctly?")
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                } else {
                    // let message = "You haven't choosen prasadam"
                    let message = "Have you added the prasadam correctly?"
                    Swal.fire({
                      title: "Are you sure?",
                      text: message,
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $("#multi-schedule-form").submit();
                      } 
                    });
                }
                }
            });
        }).get();
    }  
    
    // On Page load
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    
    	$('.billtype').val() ? paymentTableControl($('.billtype').val()) : ''
    	
    	$('.billtype').on('change', (e) => {
        	let billtype = e.target.value;
        	paymentTableControl(billtype)
        });
        
        changepooja()
    });
    // On keydown 
    $(document).on('keydown', (e) => {
  		if(e.keyCode == 9) {
        	if($("#name").is(':focus') == true){
            
            	<?php if ($_SERVER['HTTP_HOST'] == 'malaysia.templesoftware.in') {?>
	 var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext_tamil";	
	<?php }
	else {?>
   var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
	<?php 
	}
	?>
            	$.ajax({
                    url: translate_url,
                    type: 'post',
                	dataType: "json",
                	data: {
                    	search: $("#name").val()
                	},
                	success: function(data) {
                    	console.log(data)
                    <?php if ($_SERVER['HTTP_HOST'] == 'malaysia.templesoftware.in') {?>
                    $("#name_locale").val(data.name);
                    <?php }
	else {?>$("#name_locale").val(data.name);	<?php 
	}
	?>
                    	
                	}
            	});
            
            	$("#search_star").focus();
                return false;
        	}
        }
    	if(e.keyCode == 13) {
        	e.preventDefault()
        	if($("#name").is(':focus') == true){
            <?php if ($_SERVER['HTTP_HOST'] == 'malaysia.templesoftware.in') {?>
	 var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext_tamil";	
	<?php }
	else {?>
   var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
	<?php 
	}
	?>
            	$.ajax({
                    url: translate_url,
                    type: 'post',
                	dataType: "json",
                	data: {
                    	search: $("#name").val()
                	},
                	success: function(data) {
                    	console.log(data)
                    	            <?php if ($_SERVER['HTTP_HOST'] == 'malaysia.templesoftware.in') {?>
                    $("#name_locale").val(data.name);
                    <?php }
	else {?>$("#name_locale").val(data.name);	<?php 
	}
	?>
                	}
            	});
            
            	$("#search_star").focus();
                return false;
        	} else if ($("#diety_id").is(':focus') == true) {
            	if ( $("#diety_id").val() == 0 ) {
                	// $("#diety_id").find(":selected").prop("selected", true);
                	alert('Please select a Deity')
                } else {
                	$("#search_star").focus()
                }
                return false;
            } else if ($("#search_star").is(':focus') == true) {
            	var star_search_url = "<?php echo base_url(); ?>index.php/admin/billing/getStarByKeyword";
                    $.ajax({
                        url: star_search_url,
                        type: 'post',
                        dataType: 'json',
                        data: {
                            search: $("#search_star").val()
                        },
                        success: function(data) {
                            $("#search_star").val(data.star)
                        	$("#star_id").val(data.id)
                        	$('.form-check .month').prop('checked', false);
                        	
                        	$('.form-check .month').each(function(e) {
    							if ($(this).val() == data.name) {
        							$(this).prop('checked', true);
    							}
							});
                        }
                    });
            	if ( $("#search_star").val() == 0 ) {
                	alert('Please provide a birth star')
                } else {
                	$(".search_sub_pooja").focus()
                }
                return false;
            } else if ($("#main_date").is(':focus') == true) {
            	if ( $("#main_date").val() == 0 ) {
                	// $("#diety_id").find(":selected").prop("selected", true);
                	alert('Please select a date')
                } else {
                	$("#search_sub_pooja_0").focus()
                }
                return false;
            } else if ($(".search_sub_pooja").is(':focus') == true) {
//             	var $focusedElm = $(document).find(":focus");
//             	console.log($focusedElm)
//             	var $row_value = $focusedElm.closest(".form-group").find('#row_value')
//                 var rowIndex = $('#row_value').val()
//                 var parent_id=$('#parent_pooja_id').val();
// 				var date     = $('#main_date').val();
//             	var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/billing/getpoojabykeyword";
//             	$.ajax({
//             	url: pooja_fetch_url,
//             	type: 'post',
//             	dataType: 'json',
//             	data: {'parent_id': parent_id, search: $focusedElm.val(), date: date},
//             	success: function(data) {
     
//                 	if(data != 0) {
//             		$focusedElm.val(data[0].name+' - '+data[0].name_mal)
//             		$('#pooja_id_'+rowIndex).val(data[0].id)
//                 	addRow()
//                 	} else {
//                 		alert('no pooja found!')
//                 	}
//             	}
//             	});
            	
                return false;
            }
        } else if(e.keyCode == 46) {
        	let row_value = $('#row_value').val()
            
            if(row_value > 0) {
            	$('.column_'+row_value).remove()
            	row_value--
            	$('#row_value').val(row_value)
            	$("#search_sub_pooja_"+row_value).focus()
            }
            console.log(row_value);
        }
    });
    
    $('.search_by').on('change', () => {
        console.log('yes')
    })

	function addPooja(data) {
    	let poojaCol = `<div class="col-md-4">
                                    <input type="hidden" id="row_value" value="0" />
                                    <div class="row_form">
                                        <div class="div_label">
                                          <label class="text_label">Pooja <span class="red">*</span></label>
                                        </div>
                                        <input type="text" class="sq_form" value="${data.value}" />
                                        <input type="hidden" class="sq_form" name="pooja_id[]" value="${data.id}" />
										<input type="hidden" class="sq_form" name="deity_id[]" value="${data.diety_id}" />
                                        <?php echo form_error('pooja_id', '<div class="error">', '</div>'); ?>
                                  </div>
                                </div>`;
    	$('#datatable').append(poojaCol)
    }
	 var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaByCodeNameDietyforbilling";
       $('.search_sub_pooja').autocomplete({
             source: function(request, response) {
                $.ajax({
                   url:pooja_fetch_url,
                   type: 'post',
                   dataType: "json",
                   data:{ 
                      search:request.term,
                      diety:$('#diety_id').val(),
                   },
                   success: function( data ) { 
                            response(data); 
                   }
                });
             },
             select: function(event, ui) {
                var id = ui.item.id;
             	var data = ui.item;
             	var $focusedElm = $(document).find(":focus");
            	var $row_value = $focusedElm.closest(".form-group").find('#row_value')
                var rowIndex = $('#row_value').val()
                console.log($('.search_sub_pooja'))
                $('.search_sub_pooja').val('')
                if(data != 0) {
            		// $focusedElm.val(data.name+' - '+data.name_mal)
            		// $('#pooja_id_'+rowIndex).val(data.id)
            		
                	addPooja(data)
                } else {
                	alert('no pooja found!')
                }
             },
    close: function(event, ui) {
        // Clear the search box when the autocomplete menu closes
        $('.search_sub_pooja').val('');
    }
         });

    
    <?php if($this->session->flashdata('warning')) { ?>
			alert("<?php echo $this->session->flashdata('warning'); ?>")
   <?php } ?>
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
  <script>
$(document).on('focus', '.name', function() {
   var translate_url = "<?php echo base_url(); ?>index.php/admin/billing/translatetext";
  $(this).autocomplete({
    source: function(request, response) {
      $.ajax({
        url: translate_url,
         type: 'post',
        dataType: 'json',
        data: {
          search: request.term
        },
        success: function(data) {
          response(data);
        }
      });
    },
    minLength: 2
  });
});  
</script>