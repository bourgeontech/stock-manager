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
                <h2 class="title1 title1_left">Donation</h2>
                <div class="inner_pak">
                  <div class="row">
                    <div class="col-lg-8 offset-lg-0">
                      <div class="accordion_d">
                        <div>Donation</div>
                        
                        
                        <div class="booking_outer">
                        <form action="<?php echo base_url(); ?>index.php/welcome/payment" method="post">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Beneficiary Name <span class="red">*</span></label>
                              <input name="name" type="text" id="name" placeholder="Beneficiary Name" class="form-control">
                              <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Mobile Number <span class="red">*</span></label>
                              <input name="mobile_no" type="text" id="mobile_no" placeholder="Beneficiary Mobile Number" class="form-control">
                              <?php echo form_error('mobile_no', '<div class="error">', '</div>'); ?>
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
                          <div class="col-md-12">
                              <div class="form-group mt-3 mb-4">
                                <label class="mr-3">Donation Type <span class="red">*</span></label>
                                <input name="diety_id" type="hidden" value="<?php echo $diety_id;?>">
                                
                                <?php 
                                  if($pooja_list != 0) {
                                  	foreach ($pooja_list as $pooja){
                                  ?>
                                  	<div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pooja_id" id="<?php echo $pooja['pooja_id'];?>" value="<?php echo $pooja['pooja_id'];?>">
                                        <label class="form-check-label" for="<?php echo $pooja['pooja_id'];?>"><?php echo $pooja['pooja'];?></label>
                                    </div>
                                  <?php 
                                  } 
                                  } else { ?>
                                  	
                                 <?php }
                                  ?>
                                <?php echo form_error('pooja_id', '<div class="error">', '</div>'); ?>
                              </div>
                            </div>
                          
                          <div class="col-sm-12">
                            <div class="form-group" >
                              <label>Amount </label>
                              <input type="number" name="amount" class="form-control" min="1" value="" id="amount">
                              
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
                              <td>Pooja </td>
                              <td>Rs <span id="ContentPlaceHolder1_lbltotal1"><?php print_r($this->donation_amount);?></span></td>
                            </tr>
                            <tr class="g_total">
                              <td>TOTAL</td>
                              <td>Rs <span id="ContentPlaceHolder1_lbltotal2"><?php print_r($this->donation_amount);?></span></td>
                            </tr>
                          </table>
                          <div> <a ID="btn_pay" class="btn_pay" href="<?php echo base_url(); ?>index.php/worldline/review/donation" style="text-align: center;">Pay</a> </div>
                          <div class="text-center"> <a ID="btn_discard" class="btn btn-outline-warning w-100" href="<?php echo base_url(); ?>index.php/welcome/discardDonation" style="text-align: center;">Discard</a> </div>
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
<script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
<script>

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

    newDate.setDate(newDate.getDate() + days);
  
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


    newDate.setDate(newDate.getDate() + days);
  
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


});



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
            	//$('#main_date').val(data);
            	//$('#main_date').attr('readonly', true);
            }
        });
	}else{
    	var data='<?php echo date('Y-m-d');?>';
    	$('.schedule_btn').css('display','block');
    	//$('#main_date').val(data);
        //$('#main_date').attr('readonly', false);
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
            data: {'from': datefrom,'to': dateto,'star': star, 'month':datedays},
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