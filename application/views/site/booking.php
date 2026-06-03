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
                <h2 class="title1 title1_left">Pooja Booking</h2>
                <div class="inner_pak">
                  <div class="row">
                    <div class="col-lg-8 offset-lg-0">
                      <div class="accordion_d">
                        <div>Pooja Booking</div>
                        
                        
                        <div class="booking_outer">
                        <form action="<?php echo base_url(); ?>index.php/welcome/booking" method="post">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Beneficiary Name <span class="red">*</span></label>
                              <input name="name" type="text" id="name" placeholder="Beneficiary Name" class="form-control">
                              <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Deity <span class="red">*</span></label>
                              <select name="diety_id" id="diety_id" onChange="changepooja()" class="form-control" style="width:100%;">
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
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Pooja <span class="red">*</span></label>
                                <select name="pooja_id" id="pooja_id" onchange="checkpooja()" class="form-control" style="width:100%;">
                                  <option value="0">Please Select</option>
                                </select>
                                <?php echo form_error('pooja_id', '<div class="error">', '</div>'); ?>
                              </div>
                            </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Birth Star (Panchangam). <span class="red">*</span></label>
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
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Pooja  Date </label>
                              <input type="date" name="main_date" class="form-control" min="<?php echo date('Y-m-d');?>" AutoComplete="off" onfocus="blur()" value="<?php echo date('Y-m-d');?>" id="main_date">
                            </div>
                          </div>
                          <div class="col-sm-6">
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
                              <div class="ct_tab">
                                <ul>
                                  <li><a href="#tabs-1" onclick="changeTab('0')">Daily </a></li>
                                  <li><a href="#tabs-2" onclick="changeTab('1')">Weekly</a></li>
                                  <li><a href="#tabs-3" onclick="changeTab('2')">Monthly</a></li>
                                </ul>
                                <div id="tabs-1">
                                  <div id="ContentPlaceHolder1_tab1" class="col-lg-12">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <label>From</label>
                                        <div class="form-group">
                                        <input type="date" class="form-control" id="dailyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <label>To</label>
                                        <div class="form-group">
                                        <input type="date" class="form-control" id="dailyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
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
                                        <input type="date" class="form-control" id="weeklyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <label>To</label>
                                        <div class="form-group">
                                          <input type="date" class="form-control" id="weeklyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
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
                                        <input type="date" class="form-control" id="monthlyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <label>To</label>
                                        <div class="form-group">
                                          <input type="date" class="form-control" id="monthlyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
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
                          <div class="col-lg-12 text-center mt-3">
                            <input type="submit" name="ctl00$ContentPlaceHolder1$Button1" value="Add to Cart" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ContentPlaceHolder1$Button1&quot;, &quot;&quot;, true, &quot;grp1&quot;, &quot;&quot;, false, false))" id="ContentPlaceHolder1_Button1" class="btn btn-success" />
                          </div>
                        </div>
                        </form>
                        
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="mybooking cart">
                        <div class="title"><i class="fa fa-cart-arrow-down"></i> My Booking List </div>
                        <div class="cart_details">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>Pooja</td>
                              <td>Rs <span id="ContentPlaceHolder1_lbltotal1"><?php print_r($this->amount[0]['SUM(rate)']);?></span></td>
                            </tr>
                            <tr class="g_total">
                              <td>TOTAL</td>
                              <td>Rs <span id="ContentPlaceHolder1_lbltotal2"><?php print_r($this->amount[0]['SUM(rate)']);?></span></td>
                            </tr>
                          </table>
                          <div> <a ID="btn_pay" class="btn_pay" href="<?php echo base_url(); ?>index.php/welcome/review" style="text-align: center;">Review &amp; Pay</a> </div>
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
<script>
function checkpooja(){
	var pooja=$('#pooja_id').val();
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
    	var data='<?php echo date('Y-m-d');?>';
    	$('.schedule_btn').css('display','block');
    	$('#main_date').val(data);
        $('#main_date').attr('readonly', false);
    }
}
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
        data: {'from': datefrom,'to': dateto, 'noofdays' : datedays},
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
            data: {'from': datefrom,'to': dateto,'day': day},
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
            data: {'from': datefrom,'to': dateto,'star': star},
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
});
	
	
</script>