</form>
<?php
  header('Access-Control-Allow-Origin: *');
?>

<style>
div:where(.swal2-container) h2:where(.swal2-title) {
    position: relative;
    max-width: 100%;
    margin: 0;
    padding: .8em 1em 0;
    color: inherit;
    font-size: 1.1em;
    font-weight: 600;
    text-align: center;
    text-transform: none;
    word-wrap: break-word;
    cursor: initial;
}
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
.error {
	display:block;
	font-size: 12px;
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
                        <div>Online Booking</div>
                        
                        
                        <div class="booking_outer">
                        <?php 
                        	$name 		   = '';
                        	$mobile_number = '';
                        	if($this->session->userdata('customer') && is_object($this->session->userdata('customer'))): 
                        		$customer 	   = $this->session->customer;
                        		$name 	  	   = $customer->name; 
                        		$mobile_number = $customer->mobile;
                        	endif;
                        ?>
                        
                        <form action="<?php echo base_url(); ?>index.php/worldline/booking" method="post" id="onlineBookingForm1">
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
        									<input name="name" type="text" id="name" placeholder="Beneficiary Name" class="form-control" value="<?php echo $name; ?>" required>
        									<?php echo form_error('name', '<div class="error">', '</div>'); ?>
      									</div>
    								</div>
  								</div>
							</div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Mobile Number <span class="red">*</span></label>
                              <input name="mobile_no" type="text" id="mobile_no" placeholder="Beneficiary Mobile Number" class="form-control" value="<?php echo $mobile_number; ?>" required>
                              <?php echo form_error('mobile_no', '<div class="error">', '</div>'); ?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Booking for <span class="red">*</span></label>
                              <select name="diety_id" id="diety_id" onChange="changepooja()" class="form-control" style="width:100%;" required>
                                  <option selected="selected" value="0">Please Select</option>
                                  <?php 
                                  foreach ($diety_list as $diety){
                                  ?>
                                  	<option value="<?php echo $diety['id'];?>"><?php echo $diety['name'];?></option>
                                  <?php 
                                  }
                                  ?>
                              </select>
                              <?php echo form_error('diety_id', '<div class="error">', '</div>'); ?>
                            </div>
                          </div>
                        	<div class="col-md-12 text-danger">
                            	<?php 
									echo $this->session->flashdata('error_view');
								?>
                        	</div>

                            <div class="col-md-9" id="multiplyAmount">
                              <div class="form-group">
                                <label>Select Booking <span class="red">*</span></label>
                                <?php if($this->db->field_exists('description', 'pooja')): ?>
                              	<div class="input-group">
                              	<?php endif; ?>
                                <select name="pooja_id" id="pooja_id" onchange="checkpooja()" class="form-control" >
                                  <option value="0">Please Select</option>
                                </select>
                                <?php if($this->db->field_exists('description', 'pooja')): ?>
                                <div class="input-group-append">
                                <button type="button" data-container="body" data-toggle="popover" data-placement="right" data-content="" class="btn btn-outline-info" id="pooja_description"> <i class="fa fa-info"></i> </button>
                                </div>
                              	</div>
                              	<?php endif; ?>
                                <?php echo form_error('pooja_id', '<div class="error">', '</div>'); ?>
                              </div>
                            </div>
                        	<div class="col-md-3" id="ifMultiplyAmount">
                              <div class="form-group ">
                              	<label class="pl-5"> Add Unit </label>
                                <div class="input-group">
                                	<div class="input-group-prepend py-2 mr-4">
                                		X
                                	</div>
                                	
                              		<input name="multiply_count" type="number" id="multiply_count" placeholder="Count" class="form-control" value="1" min="1" required>
                              	</div>
                              	
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
                          <div class="col-sm-8">
                            <div class="form-group">
                              <label>Your participation</label>
                              <br />
                              <div class="form-check my-2 form-check-inline">
  								<input class="form-check-input" type="radio" name="appearance" id="appearance1" value="P" required>
  								<label class="form-check-label" style="font-weight:normal !important" for="appearance1">
    								Physical participation
  								</label>
							  </div>
                            
                              <div class="form-check my-2 form-check-inline">
  								<input class="form-check-input" type="radio" name="appearance" id="appearance2" value="O" required>
  								<label class="form-check-label" style="font-weight:normal !important" for="appearance2">
    								Online participation
  								</label>
							  </div>
                              <?php echo form_error('appearance', '<div class="error">', '</div>'); ?>
                            </div>
                          </div>
                          
                          <div class="col-sm-6" id="pooja_date_div">
                            <div class="form-group" id="pooja_date_group">
                              	<label>Pooja  Date </label>
                            	<?php  $fourth_date = date('Y-m-d', strtotime("+2 day")); ?>
                              	<input type="date" name="main_date" class="form-control" id="main_date" min="<?php echo $fourth_date?>" AutoComplete="off"  value="<?php echo $fourth_date;?>">
                            </div>
                          </div>
                          <div class="col-sm-6" id="schedule_btn_div">
                            <div class="form-group">
                              <div class="schedule_btn" onclick="schedulebtn()">
                                <input id="chkPassport" type="checkbox"/>
                                <label for="chkPassport">Schedule Pooja </label>
                              </div>
                            </div>
                          </div>
                          <div id="dvPassport">
                            <div class="col-lg-12 text-center">
                              <div style="margin-bottom: 10px; font-size: 19px;"> Select Multiple Dates </div>
                              <!--<div class="schedule_date" style="    max-width: 250px;"> <i class="fa fa-list-ul"></i>&nbsp;&nbsp;Schedule Puja&nbsp;&nbsp;</div>--> 
                            </div>
                            <div class="schedule_pooja">
                              <div class="ct_tab text-center">
                                <ul class="text-center pb-1">
                                  <li style="width:24% !important"><a href="#tabs-1" onclick="changeTab('0')">Daily </a></li>
                                  <li style="width:24% !important"><a href="#tabs-2" onclick="changeTab('1')">Weekly</a></li>
                                  <li style="width:24% !important"><a href="#tabs-3" onclick="changeTab('2')">Monthly</a></li>
                                  <li style="width:24% !important"><a href="#tabs-4" onclick="changeTab('3')">Yearly</a></li>
                                </ul>
                                <div id="tabs-1">
                                  <div id="ContentPlaceHolder1_tab1" class="col-lg-12">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <label>From</label>
                                        <div class="form-group">
                                        <input type="date" class="form-control" id="dailyfrom" min="<?php echo $fourth_date;?>" value="<?php echo $fourth_date;?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <label>No. of Days</label>
                                        <div class="form-group">
                                        <input type="number" class="form-control" id="dailydays" min="1" value="" placeholder="No of days">
                                        </div>
                                      </div>
                                      <div class="col-sm-12" id="dailyto_group">
                                        <label>To</label>
                                        <div class="form-group">
                                        <input type="date" class="form-control" readonly id="dailyto" min="<?php echo $fourth_date?>" value="<?php echo $fourth_date;?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                      <input type="button" value="Submit" onclick="dailysub()" class="btn btn-success">
                                        <span class="btn btn-info" onclick="CancelMultiple();">Cancel</span> </div>
                                    </div>
                                  </div>
                                </div>
                                <div id="tabs-2">
                                  <div id="ContentPlaceHolder1_tab2" class="col-lg-12">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <label>From</label>
                                        <div class="form-group">
                                        <input type="date" class="form-control" id="weeklyfrom" min="<?php echo $fourth_date?>" value="<?php echo $fourth_date;?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                    	<div class="col-sm-6">
                                        <label>No of weeks</label>
                                        <div class="form-group">
                                        <input type="number" class="form-control" id="weeklydays" min="1" value="" placeholder="No of weeks">
                                        </div>
                                      </div>
                                      <div class="col-sm-12" id="weeklyto_group">
                                        <label>To</label>
                                        <div class="form-group">
                                          <input type="date" readonly class="form-control" id="weeklyto" min="<?php echo $fourth_date;?>" value="<?php echo $fourth_date;?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                      <div class="col-lg-12 mt-3 mb-3 days">
                                        <div>
                                          <input id="checkAll" type="checkbox" name="ctl00$ContentPlaceHolder1$chkweeklyAll" />
                                          <label for="checkAll">All</label>
                                          <table id="ContentPlaceHolder1_chkweekly">
                                            <tr>
                                              <td><label><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Sunday" id="week">
                                                Sunday</label></td>
                                            </tr>
                                            <tr>
                                              <td><label><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Monday" id="week">
                                                Monday</label></td>
                                            </tr>
                                            <tr>
                                              <td><label><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Tuesday" id="week">
                                                Tuesday</label></td>
                                            </tr>
                                            <tr>
                                              <td><label><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Wednesday" id="week">
                                                Wednesday</label></td>
                                            </tr>
                                            <tr>
                                              <td><label><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Thursday" id="week">
                                                Thursday</label></td>
                                            </tr>
                                            <tr>
                                              <td><label><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Friday" id="week">
                                                Friday</label></td>
                                            </tr>
                                            <tr>
                                              <td><label><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Saturday" id="week">
                                                Saturday</label></td>
                                            </tr>
                                          </table>
                                          <span class="clserror"> <span id="ContentPlaceHolder1_CustomValidator1" style="display:none;">Please Choose Days</span> </span> </div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <hr>
                                      <div class="col-sm-6">
                                        <input type="button" value="Submit" onclick="weeklysub()" class="btn btn-success">
                                        <span class="btn btn-info" onclick="CancelMultiple();">Cancel</span> </div>
                                    </div>
                                  </div>
                                </div>
                                <div id="tabs-3">
                                  <div id="ContentPlaceHolder1_tab3" class="col-lg-12">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <label>From</label>
                                        <div class="form-group">
                                        <input type="date" class="form-control" id="monthlyfrom" min="<?php echo $fourth_date;?>" value="<?php echo $fourth_date;?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                    <div class="col-sm-6">
                                        <label>No. of months</label>
                                        <div class="form-group">
                                        <input type="number" class="form-control" id="monthlydays" min="1" value="" placeholder="No. of months">
                                        </div>
                                      </div>
                                      <div class="col-sm-12"id="monthlyto_group">
                                        <label>To</label>
                                        <div class="form-group">
                                          <input type="date" readonly class="form-control" id="monthlyto" min="<?php echo $fourth_date;?>" value="<?php echo $fourth_date;?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                      <div class="col-lg-12 mt-3 mb-3 pooja_type">
                                        <div>
                                          <input id="checkAll1" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthlyAll" />
                                          <label for="checkAll1">All</label>
                                          <table id="ContentPlaceHolder1_chkmonthly">
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_0" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$0" value="Aswathi" />
                                                <label for="ContentPlaceHolder1_chkmonthly_0">Aswathi</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_1" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$1" value="Bharani" />
                                                <label for="ContentPlaceHolder1_chkmonthly_1">Bharani</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_2" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$2" value="Karthika" />
                                                <label for="ContentPlaceHolder1_chkmonthly_2">Karthika</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_3" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$3" value="Rohini" />
                                                <label for="ContentPlaceHolder1_chkmonthly_3">Rohini</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_4" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$4" value="Makiyeeram" />
                                                <label for="ContentPlaceHolder1_chkmonthly_4">Makiyeeram</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_5" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$5" value="Thiruvathira" />
                                                <label for="ContentPlaceHolder1_chkmonthly_5">Thiruvathira</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_6" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$6" value="Ponartham" />
                                                <label for="ContentPlaceHolder1_chkmonthly_6">Punartham</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_7" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$7" value="Pooyam" />
                                                <label for="ContentPlaceHolder1_chkmonthly_7">Pooyam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_8" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$8" value="Aayilyam" />
                                                <label for="ContentPlaceHolder1_chkmonthly_8">Aayilyam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_9" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$9" value="Pooram" />
                                                <label for="ContentPlaceHolder1_chkmonthly_9">Pooram</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_10" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$10" value="Uthram" />
                                                <label for="ContentPlaceHolder1_chkmonthly_10">Uthram</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_11" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$11" value="Atham" />
                                                <label for="ContentPlaceHolder1_chkmonthly_11">Atham</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_12" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$12" value="Chithra" />
                                                <label for="ContentPlaceHolder1_chkmonthly_12">Chithira</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_13" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$13" value="Chothi" />
                                                <label for="ContentPlaceHolder1_chkmonthly_13">Chothi</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_14" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$14" value="Visakham" />
                                                <label for="ContentPlaceHolder1_chkmonthly_14">Vishakam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_15" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$15" value="Anisham" />
                                                <label for="ContentPlaceHolder1_chkmonthly_15">Anizham</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_16" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$16" value="Trikketta" />
                                                <label for="ContentPlaceHolder1_chkmonthly_16">Thrikketa</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_17" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$17" value="Moolam" />
                                                <label for="ContentPlaceHolder1_chkmonthly_17">Moolam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_18" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$18" value="Pooradam" />
                                                <label for="ContentPlaceHolder1_chkmonthly_18">Pooradam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_19" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$19" value="Uthradam" />
                                                <label for="ContentPlaceHolder1_chkmonthly_19">Uthradam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_20" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$20" value="Thiruvonam" />
                                                <label for="ContentPlaceHolder1_chkmonthly_20">Thiruvonam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_21" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$21" value="Avittam" />
                                                <label for="ContentPlaceHolder1_chkmonthly_21">Avittam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_22" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$22" value="Chathayam" />
                                                <label for="ContentPlaceHolder1_chkmonthly_22">Chathayam</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_23" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$23" value="Poororuttathi" />
                                                <label for="ContentPlaceHolder1_chkmonthly_23">Poororuttathi</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_24" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$24" value="Uthratathi" />
                                                <label for="ContentPlaceHolder1_chkmonthly_24">Uthrattathi</label></td>
                                            </tr>
                                            <tr>
                                              <td><input id="ContentPlaceHolder1_chkmonthly_25" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$25" value="Revathi" />
                                                <label for="ContentPlaceHolder1_chkmonthly_25">Revathi</label></td>
                                            </tr>
                                          </table>
                                          <span class="clserror"> <span id="ContentPlaceHolder1_CustomValidator2" style="display:none;">Please Choose Stars</span> </span> </div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <hr>
                                      <div class="col-sm-6">
                                        <input type="button" value="Submit" onclick="monthlysub()" class="btn btn-success">
                                        <span class="btn btn-info" onclick="CancelMultiple();">Cancel</span> </div>
                                    </div>
                                  </div>
                                </div>
                              	<div id="tabs-4">
                                  <div id="ContentPlaceHolder1_tab4" class="col-lg-12">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <label>From</label>
                                        <div class="form-group">
                                        <input type="date" class="form-control" id="yearlyfrom" min="<?php echo $fourth_date;?>" value="<?php echo $fourth_date;?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <label>No. of Years</label>
                                        <div class="form-group">
                                        <input type="number" class="form-control" id="years" min="1" value="" placeholder="No of years">
                                        </div>
                                      </div>	
                                      <div class="col-sm-6 text-center justify-content-center">
                                      	<input type="button" value="Submit" onclick="yearlysub()" class="btn btn-success">
                                        <span class="btn btn-info" onclick="CancelMultiple();">Cancel</span> </div>
                                    	</div>
                                  </div>
                                </div>
                                <div class="row" id="scheduletable">
                              		<div class="col-sm-12 ">
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
                          <div></div>
                          <div class="col-sm-6 pt-3" id="ticket_no_div">
                            <div class="form-group d-flex flex-row" >
                            	<h4 class="text-orange" id="ticket_no"> </h4>
                              	<h6 class="ml-3 mt-1	"> Tickets Available </h6>
                            </div>
                          </div>
						   <div class="col-md-12 text-center mt-3 ">
                           <p><button type="button" class="btn btn-primary" id="previewModal" >Click here to Avail Discount.
</button></p>
                          </div>
                          <div class="col-md-12 text-center mt-3 " id="submitBtnDIv">
                            <input type="submit" name="ctl00$ContentPlaceHolder1$Button1" value="Add to Tray" id="ContentPlaceHolder1_Button1" class="btn btn-success" />
                          </div>
                        </div>
                        </form>
                        
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="mybooking cart">
                        <div class="title"><i class="fa fa-cart-arrow-down"></i> My Tray </div>
                        <div class="cart_details">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>Pooja </td>
                              <td>Rs <span id="ContentPlaceHolder1_lbltotal1"><?php print_r($this->amount);?></span></td>
                            </tr>
							<?php
							if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {?>
							<tr>
                              <td>Membership Privilege</td>
                              <td>Rs <span id="ContentPlaceHolder1_lbltotal2"><?php if($this->discounttype=='Fixed') { echo $discount=$this->discount; }?><?php if($this->discounttype=='Percentage') { echo $discount=$this->amount/100*$this->discount; }?></span></td>
                            </tr>
							<?php } ?>
                            <tr class="g_total">
                              <td>TOTAL</td>
                              <td>Rs <span id="ContentPlaceHolder1_lbltotal2"><?php print_r($this->amount-@$discount);?></span></td>
                            </tr>
                          </table>
                          <div> <a ID="btn_pay" class="btn_pay" href="<?php echo base_url(); ?>index.php/worldline/review" style="text-align: center;">Review &amp; Pay</a> </div>
                          <div class="text-center"> <a ID="btn_discard" class="btn btn-outline-warning w-100" href="<?php echo base_url(); ?>index.php/worldline/discard" style="text-align: center;">Discard</a> </div>
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
	<!-- Trigger Button -->


<!-- Modal -->


<script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.0"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.3"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$('#previewModal').on('click', () => {
                    	Swal.fire({
  title: 'Sorry, you are not a valid member yet. Register to become a Life Member and enjoy exclusive privileges.',
  text: "If you are already a member, please proceed to the login page.",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Register',
  cancelButtonText: 'Login'
}).then((result) => {
  if (result.isConfirmed) {
//        $.ajax({
//               url:'<?php echo base_url();?>index.php/cms/database_backup_ajax',
//               type: 'get',
//               dataType: "json",
//               success: function( data ) {
//               	   var downloadLink = document.createElement('a');
//             	   downloadLink.href = response.backup_path;
//             	   downloadLink.download = response.backup_name; // Set the desired filename
//             	   downloadLink.click();
                  
//               }                   
//          });
		window.location.href = '<?php echo base_url();?>index.php/membership'; 
  } else {
  	window.location.href = '<?php echo base_url();?>index.php/customer/login';
  }
})
                    })
    
    

var flag = false;
    var availabilityChecked = false;
    
    // Check pooja_availability
    const checkPoojaAvailability = (pooja_id, date, qty, participation, is_submit) => {
        return new Promise((resolve, reject) => {
           $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/worldline/poojaAvailabilityCheck",
                data: {'pooja_id': pooja_id,'date':date, 'qty': qty, 'is_submit': is_submit, 'participation': participation},
           		dataType: "json",
                success: function (response) {
                   let pooja_date = new Date(date)
                   let year = pooja_date.getFullYear()
                   let month = pooja_date.getMonth()
                   let day = pooja_date.getDate()
                   
                   let format2 = day + "/" + month + "/" + year;
                	
                   let data = response
                
                   if(data.exists && data.exists == 1){
                   	  if(data.qty) {
                      	alert('Limit exceeded for '+data.pooja+' on '+pooja_date.toDateString()+'. Current quantity is '+data.qty);
                      } else {
                      	alert('Limit exceeded for '+data.pooja+' on '+pooja_date.toDateString());
                      }
                      
                   	  resolve(false);
                   } else {
                   	  resolve(true);
                   }
                },
          		error: function () {
            		reject(new Error('Failed to check product availability'));
          		}
            });
        })
    }
    
    

$('#pooja_id').on('change', () => {
	var pooja=$('#pooja_id').val();

    var pooja_url = '<?php echo base_url();?>index.php/welcome/getpoojabyid';
    	$.ajax({
            type: "POST",
            url: pooja_url,
            data: {'pooja_id': pooja},
            dataType: "json",
            success: function (data) {
            	$('#pooja_description').data('content', data.description)
            	$('#pooja_description').attr('title', data.description)
            	let date = $('#main_date').val()
                console.log(data)
            	if(data.default_date) {
                	$('#main_date').val(data.default_date);
            		$('#main_date').attr('readonly', true);
                	$('#schedule_btn_div').hide()
                	$('#pooja_date_div').removeClass('col-md-6')
                	$('#pooja_date_div').addClass('col-md-12')
                } else {
                	$('#main_date').val("<?php echo date('Y-m-d', strtotime("+2 day")); ?>");
            		$('#main_date').attr('readonly', false);
                	$('#schedule_btn_div').show()
                	$('#pooja_date_div').addClass('col-md-6')
                	$('#pooja_date_div').removeClass('col-md-12')
                }
            }
     });
	if(pooja=="2000"){
		$('.schedule_btn').css('display','none');
		var url = '<?php echo base_url();?>index.php/welcome/getmokkolakkalludate';
    	$.ajax({
            type: "POST",
            url: url,
            data: {'pooja': pooja},
            dataType: "json",
            success: function (data) {
            	$('#main_date').val(data);
            	$('#main_date').attr('readonly', true);
            }
        });
	}else{
    	// var data='<?php echo date('Y-m-d');?>';
    	$('.schedule_btn').css('display','block');
    	// $('#main_date').val(data);
        $('#main_date').attr('readonly', false);
    }

	let pooja_id = pooja;
	let date 	 		= $('#main_date').val()
    let qty	 	 		= 1;
	let is_submit		= 0;
    let participation	= $('[name="appearance"]:checked').val()

    showAvailableTickets(pooja_id, date, qty, is_submit, participation)
});

function  showAvailableTickets(pooja_id, date, qty, is_submit, participation) {
	$.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/worldline/checkPoojaQTY",
                data: {'pooja_id': pooja_id,'date':date, 'qty': qty, 'is_submit': is_submit, 'participation': participation},
           		dataType: "json",
                success: function (response) {
                	console.log(response)
                   if(response.appearance == 'P' && response.allowed_qty > 0) {
                   		if(response.qty > 0) {
                        	$('#ticket_no_div #ticket_no').text(response.qty)
                   		} else if(response.qty == 0) {
                        	$('#ticket_no_div #ticket_no').text("No available tickets")
                        }
                        
                        $('#submitBtnDIv').addClass('col-md-6')
                   		$('#submitBtnDIv').removeClass('col-md-12')
                        $('#ticket_no_div').show()
                   }  else {
                   		 $('#ticket_no_div').hide()
                   		 $('#submitBtnDIv').removeClass('col-md-6')
                   		 $('#submitBtnDIv').addClass('col-md-12')
                   }
                }
            });
}

$(document).on('click', '#pooja_description', function (e) {
    alert($(this).data('content'))
});
// function checkpooja(){
// 	console.log('y');
// 	var pooja=$('#pooja_id').val();
// 	console.log($('#main_date'))
// 	if(pooja=="2000"){
// 		$('.schedule_btn').css('display','none');
// 		var url = '<?php echo base_url();?>index.php/welcome/getmokkolakkalludate';
//     	$.ajax({
//             type: "POST",
//             url: url,
//             data: {'pooja': pooja},
//             dataType: "json",
//             success: function (data) {
//             	console.log(data)
//             	$('#main_date').val(new Date(data));
//             	$('#main_date').attr('readonly', true);
//             }
//         });
// 	}else{
//     	// var data='<?php echo date('Y-m-d');?>';
//     	$('.schedule_btn').css('display','block');
//     	// $('#main_date').val(data);
//         $('#main_date').attr('readonly', false);
//     }
// }

$('#chkPassport').on('change', (e) => {
	if(e.target.checked) {
    	$('#pooja_date_group').hide()
    } else {
    	$('#pooja_date_group').show()
    }
	// 
})

$(document).ready(function() {
  !$('#dailydays').val() ? $('#dailyto_group').hide() :$('#dailyto_group').show()
  !$('#weeklydays').val() ? $('#weeklyto_group').hide() : $('#weeklyto_group').show()
  !$('#monthlydays').val() ? $('#monthlyto_group').hide() : $('#monthlyto_group').show()

  $('#dailyfrom, #dailydays').on('keyup', function() {
  	
    var from_date = $('#dailyfrom').val();
    var days = parseInt($('#dailydays').val());
    // Calculate the new date
    var newDate = new Date(from_date);

    newDate.setDate(newDate.getDate() + (days-1));
  
     var formattedDate = newDate.toISOString().substr(0, 10);
  
    $('#dailyto').val(formattedDate);
  	$('#dailyto_group').show()
  });

$('#weeklyfrom, #weeklydays').on('keyup', function() {
    var from_date = $('#weeklyfrom').val();
    var weeks = parseInt($('#weeklydays').val());
    // Calculate the new date
    var newDate = new Date(from_date);

	var days = weeks * 7;


    newDate.setDate(newDate.getDate() + (days-1));
  
     var formattedDate = newDate.toISOString().substr(0, 10);
  	
    $('#weeklyto').val(formattedDate);
	$('#weeklyto_group').show()
  });

$('#monthlyfrom, #monthlydays').on('keyup', function() {
    var from_date = $('#monthlyfrom').val();
    var months = parseInt($('#monthlydays').val());
    // Calculate the new date
    var newDate = new Date(from_date);

    newDate.setMonth(newDate.getMonth() + months);
  
     var formattedDate = newDate.toISOString().substr(0, 10);
  
    $('#monthlyto').val(formattedDate);
	$('#monthlyto_group').show()
  });

	$('#ticket_no_div').hide()
});



// function checkpooja(){
// 	var pooja=$('#pooja_id').val();
// 	if(pooja=="2000"){
// 		$('.schedule_btn').css('display','none');
// 		var url = '<?php echo base_url();?>index.php/welcome/getmokkolakkalludate';
//     	$.ajax({
//             type: "POST",
//             url: url,
//             data: {'pooja': pooja},
//             dataType: "json",
//             success: function (data) {
//             	//$('#main_date').val(data);
//             	//$('#main_date').attr('readonly', true);
//             }
//         });
// 	}else{
//     	var data='<?php echo date('Y-m-d');?>';
//     	$('.schedule_btn').css('display','block');
//     	//$('#main_date').val(data);
//         //$('#main_date').attr('readonly', false);
//     }
// }
function changepooja(){
    var diety=$('#diety_id').val();
    $('#pooja_id').html("");
    var html='<option value="0">Please Select</option>';
    var url = '<?php echo base_url();?>index.php/welcome/getpoojasbydiety';
	$.ajax({
        type: "POST",
        url: url,
        data: {'diety': diety},
        dataType: "json",
        success: function (data) {	
        	// Change the logic 
        	if(data[0].donation || data[0].pooja_id == 8 || diety==132) {
            	$('#multiplyAmount').addClass('col-md-9')
			    $('#multiplyAmount').removeClass('col-md-12')
				$('#ifMultiplyAmount').show()
            } else {
            	$('#multiplyAmount').removeClass('col-md-9')
				$('#multiplyAmount').addClass('col-md-12')
				$('#ifMultiplyAmount').hide()
            }
            $.each(data, function (i, obj)
            {
            	html +='<option value="'+obj.pooja_id+'">'+obj.pooja+' - '+obj.pooja_mal+' - Rs '+obj.pooja_rt+'</option>';
            });
            $('#pooja_id').append(html);
        }
    });
}

function dailysub(){
	var datefrom=$('#dailyfrom').val();
	var dateto=$('#dailyto').val();
	var datedays=$('#dailydays').val();
    if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	var url = '<?php echo base_url();?>index.php/welcome/getdatestar';
	var html="";
	var a="1";
	$.ajax({
        type: "POST",
        url: url,
        data: {'from': datefrom,'to': dateto ,'noofdays' : datedays},
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, obj)
            {
            	html +='<tr><td>'+a+'</td>';
            	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
            	html +='<td>'+obj.name_eng+'</td>';
            	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
            	a++;
            });
            $('#mytbody').html(html);
        }
    });
}
function weeklysub(){
    var datefrom=$('#weeklyfrom').val();
	var dateto=$('#weeklyto').val();	
    var datedays=$('#weeklydays').val();

	if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	var url = '<?php echo base_url();?>index.php/welcome/getweekstar';
	var html="";
	var a="1";
	var sel=$('#week:checked').map(function(_, el) {
        var day=$(el).val();
        $.ajax({
            type: "POST",
            url: url,
            data: {'from': datefrom,'to': dateto,'day': day, 'noofweeks' : datedays},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                	html +='<td>'+obj.name_eng+'</td>';
                	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                });
                $('#mytbody').html(html);
            }
        });
    }).get();
	
}
function monthlysub(){
    var datefrom=$('#monthlyfrom').val();
	var dateto=$('#monthlyto').val();
	var datedays=$('#monthlydays').val();
	if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	var url = '<?php echo base_url();?>index.php/welcome/getmonthstar';
	var html="";
	var a="1";
	var sel=$('.month:checked').map(function(_, el) {
        var star=$(el).val();
        $.ajax({
            type: "POST",
            url: url,
        	headers: {  'Access-Control-Allow-Origin': '*' },
            data: {'from': datefrom,'to': dateto,'star': star, 'month':datedays},
            crossDomain: true,
   			dataType: 'json',
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                	html +='<td>'+obj.name_eng+'</td>';
                	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                });
                $('#mytbody').html(html);
            }
        });
    }).get();
	
}

function yearlysub(){
	var datefrom=$('#yearlyfrom').val();
	var years	=$('#years').val();
	var end_date = new Date(new Date(datefrom).setFullYear(new Date(datefrom).getFullYear() + parseInt(years)))
	var end_year = end_date.getFullYear();
	var end_month = end_date.getMonth();
    if(datefrom==""){
	    alert("Date field is required");
	}else if(years==""){
	    alert("No of years is required");
	}
	$(".display").removeAttr('style');
	var url = '<?php echo base_url();?>index.php/worldline/getDatedArray';
	var html="";
	var a="1";
	$.ajax({
            type: "POST",
            url: url,
            data: {'date': datefrom,'dated_type': 'Y', 'end_year': end_year, 'end_month': end_month},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	const today = new Date(obj.birth_date);
const yyyy = today.getFullYear();
let mm = today.getMonth() + 1; // Months start at 0!
let dd = today.getDate();

if (dd < 10) dd = '0' + dd;
if (mm < 10) mm = '0' + mm;
                const formattedToday = dd + '/' + mm + '/' + yyyy;

                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+formattedToday+'<input type="hidden" name="dates[]" value="'+formattedToday+'"></td>';
                	html +='<td></td>';
                	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                });
                $('#mytbody').html(html);
            }
        });
}

function remove_file_row(obj){
	$(obj).closest('tr').remove();
	return false;
}
$(document).ready(function() {
    $("#checkAll").change(function() {
        if (this.checked) {
            $(".week").each(function() {
                this.checked=true;
            });
        } else {
            $(".week").each(function() {
                this.checked=false;
            });
        }
    });

    $(".week").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".week").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#checkAll").prop("checked", true);
            }     
        }
        else {
            $("#checkAll").prop("checked", false);
        }
    });

	$('#multiplyAmount').removeClass('col-md-9')
	$('#multiplyAmount').addClass('col-md-12')
	$('#ifMultiplyAmount').hide()
});

// On changing participation 


// On adding to tray, check remaining tickets
$('#ContentPlaceHolder1_Button1').on('click', (e) => {
// 	button ContentPlaceHolder1_Button1
// 	form   onlineBookingForm1

	e.preventDefault();
	
	let date 	 		= $('#main_date').val()
    let qty	 	 		= 1;
	let pooja_id 		= $('#pooja_id').val()
    let participation	= $('[name="appearance"]:checked').val()
    
    showAvailableTickets(pooja_id, date, qty, 1, participation)
    var promises = [];
    var promise = checkPoojaAvailability(pooja_id, date, qty, participation, 1);
    promises.push(promise);
	
	Promise.all(promises)
            .then(results => {
    			
              var flag = results.every(result => result === true);
              if (flag == true) {
                $('#onlineBookingForm1').submit();
              } 
            })
            .catch(error => {
              console.error(error);
            });
})

$('#main_date').on('change', (e) => {
	e.preventDefault();
	
	let date 	 		= $('#main_date').val()
    let qty	 	 		= 1;
	let pooja_id 		= $('#pooja_id').val()
    let participation	= $('[name="appearance"]:checked').val()
    
    showAvailableTickets(pooja_id, date, qty, 0, participation)
    var promises = [];
    var promise = checkPoojaAvailability(pooja_id, date, qty, participation, 0);
})
                   
$('[name="appearance"]').on('change', (e) => {
	e.preventDefault();
	
	let date 	 		= $('#main_date').val()
    let qty	 	 		= 1;
	let pooja_id 		= $('#pooja_id').val()
    let participation	= $('[name="appearance"]:checked').val()
    
    showAvailableTickets(pooja_id, date, qty, 0, participation)
    var promises = [];
    var promise = checkPoojaAvailability(pooja_id, date, qty, participation, 0);
})

$('#ifMultiplyAmount #multiply_count').on('change', (e) => {
	let multiply_count = e.target.value
    let pooja_id = $('#pooja_id').val()
    
})
</script>

</script>

