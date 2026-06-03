<div class="choose-us ptb-100 grey-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title bg_grey text-center">
                    <h2 class="templeh1">Pooja Booking</h2>
                    <p>  <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.--></p>
                </div>
            </div>
        </div>


<div class="row">
<form action="<?php echo base_url(); ?>index.php/admin/booking" method="post">
<div class="col-md-7 col-sm-12">
<div class="panel-body poojabooking-bg">        
                          

                         
 <div class="col-sm-12">
  <h3 class="templeh2">Pooja Booking</h3>
  <div class="form-group">
    <label>Beneficiary Name <span class="red">*</span></label>
    <input name="name" type="text" id="name" placeholder="Beneficiary Name" class="form-control">
    <?php echo form_error('name', '<div class="error">', '</div>'); ?>
  </div>
</div>


<div class="col-sm-12">
  <div class="form-group">
    <label>Deity <span class="red">*</span></label>
    <select name="diety_id" onChange="" id="diety_id" class="form-control" style="width:100%;">
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


<div class="col-sm-12">
  <div class="form-group">
    <label>Pooja <span class="red">*</span></label>
    <select name="pooja_id" id="pooja_id" class="form-control" style="width:100%;">
      <option value="0">Please Select</option>
      <?php 
      foreach ($pooja_list as $pooja){
      ?>
      	<option value="<?php echo $pooja['id'];?>"><?php echo $pooja['name']." - ".$pooja['name_mal']." - Rs ".$pooja['rate'];?></option>
      <?php 
      }
      ?>
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
  <input  type="date" name="main_date" class="form-control clickable input-md date_inp" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" id="DtChkIn dp1">
</div> 
</div>


<div class="col-sm-6">
  <div class="form-group">
    <div class="schedule_btn"><label style="color:#FFFFFF;">
      <input type="checkbox" id="chkPassport" style="float:left">
      Schedule Pooja </label>
    </div>
  </div>
</div>


<!-- product details start -->
<div class="row" id="dvPassport">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="product-description-tab mt-60">
     
     
      <div class="description-tab-menu">
        <ul class="clearfix" role="tablist">
          <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Dialy</a></li>
          <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Weekly</a></li>
          <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Monthly</a></li>
        </ul>
      </div>
      
      
      <div class=" tab-content">
      
        <div role="tabpanel" class="tab-pane active" id="description">
        
        <div class="row">
  <div class="col-sm-6">
    <label>From</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp" id="dailyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
  
  
<div class="col-sm-6">
    <label>To</label>
    <div class="form-group" >
      <input type="date"class="form-control clickable input-md date_inp" id="dailyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date" >
    </div>
  </div>
  
  
   <div class="col-sm-4 ">
    <input type="button" value="Submit" onclick="dailysub()" class="btn btn-success cart_btn1">
   </div>
  <div class="col-sm-4">
    <input type="button" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
   </div>

</div>
 </div>
        
        
        
<div role="tabpanel" class="tab-pane" id="specification">
 <div class="row ">
  <div class="col-sm-6">
    <label>From</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp" id="weeklyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
  
  <div class="col-sm-6">
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
   
 
  <div class="col-sm-4 ">
    <input type="button" value="Submit" onclick="weeklysub()" class="btn btn-success cart_btn1">
   </div>
  <div class="col-sm-4">
    <input type="submit" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
   </div>



</div>
        </div>



 <div role="tabpanel" class="tab-pane" id="review">
<div class="row ">
  <div class="col-sm-6">
    <label>From</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp" id="monthlyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
  
  <div class="col-sm-6">
    <label>To</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp" id="monthlyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
  
  <div class="col-sm-12">
    
<div class="row" id="poojacontainer">
  <div class="col-sm-12 ">
 

               <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_0" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$0" value="All">
              <label for="ContentPlaceHolder1_chkmonthly_0">All</label></div>
  
              <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_0" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$0" value="Aswathi">
              <label for="ContentPlaceHolder1_chkmonthly_0">Aswathi</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_1" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$1" value="Bharani">
              <label for="ContentPlaceHolder1_chkmonthly_1">Bharani</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_2" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$2" value="Karthika">
              <label for="ContentPlaceHolder1_chkmonthly_2">Karthika</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_3" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$3" value="Rohini">
              <label for="ContentPlaceHolder1_chkmonthly_3">Rohini</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_4" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$4" value="Makiyeeram">
              <label for="ContentPlaceHolder1_chkmonthly_4">Makiyeeram</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_5" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$5" value="Thiruvathira">
              <label for="ContentPlaceHolder1_chkmonthly_5">Thiruvathira</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_6" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$6" value="Ponartham">
              <label for="ContentPlaceHolder1_chkmonthly_6">Ponartham</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_7" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$7" value="Pooyam">
              <label for="ContentPlaceHolder1_chkmonthly_7">Pooyam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_8" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$8" value="Aayilyam">
              <label for="ContentPlaceHolder1_chkmonthly_8">Aayilyam</label></div>
          
          
          <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_9" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$9" value="Makam">
              <label for="ContentPlaceHolder1_chkmonthly_9">Makam</label></div>
          
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_9" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$9" value="Pooram">
              <label for="ContentPlaceHolder1_chkmonthly_9">Pooram</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_10" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$10" value="Uthram">
              <label for="ContentPlaceHolder1_chkmonthly_10">Uthram</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_11" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$11" value="Atham">
              <label for="ContentPlaceHolder1_chkmonthly_11">Atham</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_12" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$12" value="Chithra">
              <label for="ContentPlaceHolder1_chkmonthly_12">Chithra</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_13" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$13" value="Chothi">
              <label for="ContentPlaceHolder1_chkmonthly_13">Chothi</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_14" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$14" value="Visakham">
              <label for="ContentPlaceHolder1_chkmonthly_14">Visakham</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_15" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$15" value="Anisham">
              <label for="ContentPlaceHolder1_chkmonthly_15">Anisham</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_16" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$16" value="Trikketta">
              <label for="ContentPlaceHolder1_chkmonthly_16">Trikketta</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_17" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$17" value="Moolam">
              <label for="ContentPlaceHolder1_chkmonthly_17">Moolam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_18" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$18" value="Pooradam">
              <label for="ContentPlaceHolder1_chkmonthly_18">Pooradam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_19" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$19" value="Uthradam">
              <label for="ContentPlaceHolder1_chkmonthly_19">Uthradam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_20" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$20" value="Thiruvonam">
              <label for="ContentPlaceHolder1_chkmonthly_20">Thiruvonam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_21" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$21" value="Avittam">
              <label for="ContentPlaceHolder1_chkmonthly_21">Avittam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_22" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$22" value="Chathayam">
              <label for="ContentPlaceHolder1_chkmonthly_22">Chathayam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_23" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$23" value="Poororuttathi">
              <label for="ContentPlaceHolder1_chkmonthly_23">Poororuttathi</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_24" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$24" value="Uthratathi">
              <label for="ContentPlaceHolder1_chkmonthly_24">Uthratathi</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_25" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$25" value="Revathi">
              <label for="ContentPlaceHolder1_chkmonthly_25">Revathi</label></div>
     

  </div>

</div>
    
  <div class="col-sm-4 ">
    <input type="button" value="Submit" onclick="monthlysub()" class="btn btn-success cart_btn1">
   </div> 
  <div class="col-sm-4">
    <input type="submit" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
   </div>





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
      
    </div >
  </div >

</div>
<!-- product details start -->

  <div class="col-lg-12" align="center">
    <input  type="submit" name="date" value="Add Cart" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-success cart_btn">
   </div>
</div>
</div> 
</form>


 <!--booking close-->

  
  
 <div class="col-md-4 col-sm-6" >
       
<div class="panel-body poojabooking-bg">        
                          

                         
 <div class="col-sm-12">
  <h3 class="templeh2">Pooja Booking</h3>
  <ul class="list-group">
    <li class="list-group-item">Pooja <span class="badge badge-primary badgesize"><?php print_r($this->amount[0]['SUM(rate)']);?></span></li>
  </ul>
  
   <ul class="list-group">
     <li class="list-group-item">Total<span class="badge badge-primary badgesize"><?php print_r($this->amount[0]['SUM(rate)']);?></span></li>
   </ul> 
<div class="col-lg-12" align="center"> 
      <form action="<?php echo base_url(); ?>index.php/admin/review" method="post">
    <input  type="submit" name="date"  value="Review & Pay" id="" class="btn btn-success cart_btn">
   </form></div>
</div>


   </div>

</div>
                </div>
            </div>
        </div>
        <!--choose us end-->
<script>
z
$(document).ready(function() {
    $("#dvPassport").hide();
});


$(function () {
    $("#chkPassport").click(function () {
    	if ($(this).is(":checked")) {
    	    $("#dvPassport").show();
        } else {
            $("#dvPassport").hide();
        }
    });
});
function dailysub(){
	var datefrom=$('#dailyfrom').val();
	var dateto=$('#dailyto').val();
    if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	var url = '<?php echo base_url();?>index.php/admin/getdatestar';
	var html="";
	var a="1";
	$.ajax({
        type: "POST",
        url: url,
        data: {'from': datefrom,'to': dateto},
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
	var url = '<?php echo base_url();?>index.php/admin/getweekstar';
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
	var url = '<?php echo base_url();?>index.php/admin/getmonthstar';
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
// $(document).ready(function() {
//     $("#checkAll").click(function () {
//         $('#week').prop('checked', this.checked); 
//     });
// });
//var nowTemp = new Date();
//var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
//
//var checkin = $('#dp1').datepicker({
//
//  beforeShowDay: function(date) {
//    return date.valueOf() >= now.valueOf();
//  },
//  autoclose: true
//
//}).on('changeDate', function(ev) {
//  if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {
//
//    var newDate = new Date(ev.date);
//    newDate.setDate(newDate.getDate() + 1);
//    checkout.datepicker("update", newDate);
//
//  }
//  $('#dp2')[0].focus();
//});
//
//
//var checkout = $('#dp2').datepicker({
//  beforeShowDay: function(date) {
//    if (!checkin.datepicker("getDate").valueOf()) {
//      return date.valueOf() >= new Date().valueOf();
//    } else {
//      return date.valueOf() > checkin.datepicker("getDate").valueOf();
//    }
//  },
//  autoclose: true
//
//}).on('changeDate', function(ev) {});
//
//var checkout = $('#dp2').datepicker({
//  beforeShowDay: function(date) {
//    if (!checkin.datepicker("getDate").valueOf()) {
//      return date.valueOf() >= new Date().valueOf();
//    } else {
//      return date.valueOf() > checkin.datepicker("getDate").valueOf();
//    }
//  },
//  autoclose: true
//
//}).on('changeDate', function(ev) {});
//
//var checkout = $('#dp3').datepicker({
//  beforeShowDay: function(date) {
//    if (!checkin.datepicker("getDate").valueOf()) {
//      return date.valueOf() >= new Date().valueOf();
//    } else {
//      return date.valueOf() > checkin.datepicker("getDate").valueOf();
//    }
//  },
//  autoclose: true
//
//}).on('changeDate', function(ev) {});
//
//var checkout = $('#dp4').datepicker({
//  beforeShowDay: function(date) {
//    if (!checkin.datepicker("getDate").valueOf()) {
//      return date.valueOf() >= new Date().valueOf();
//    } else {
//      return date.valueOf() > checkin.datepicker("getDate").valueOf();
//    }
//  },
//  autoclose: true
//
//}).on('changeDate', function(ev) {});
//
//var checkout = $('#dp5').datepicker({
//  beforeShowDay: function(date) {
//    if (!checkin.datepicker("getDate").valueOf()) {
//      return date.valueOf() >= new Date().valueOf();
//    } else {
//      return date.valueOf() > checkin.datepicker("getDate").valueOf();
//    }
//  },
//  autoclose: true
//
//}).on('changeDate', function(ev) {});
//	
//	
//	var checkout = $('#dp6').datepicker({
//  beforeShowDay: function(date) {
//    if (!checkin.datepicker("getDate").valueOf()) {
//      return date.valueOf() >= new Date().valueOf();
//    } else {
//      return date.valueOf() > checkin.datepicker("getDate").valueOf();
//    }
//  },
//  autoclose: true
//
//}).on('changeDate', function(ev) {});
//
//
//
//var checkout = $('#dp7').datepicker({
//  beforeShowDay: function(date) {
//    if (!checkin.datepicker("getDate").valueOf()) {
//      return date.valueOf() >= new Date().valueOf();
//    } else {
//      return date.valueOf() > checkin.datepicker("getDate").valueOf();
//    }
//  },
//  autoclose: true
//
//}).on('changeDate', function(ev) {});
	
	
	</script>
    

  

</body>

</html>