<?php date_default_timezone_set('Asia/Kolkata'); ?><style type="text/css">
  .submit:focus {
     background:blue;
  }
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Billing Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
  
    <div class="row">
	   <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	      <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/schedule" method="post">
               <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $last_id;?> </h2>
                  </div> 
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="radio-inline">
                        <input id="billtype" type="radio" name="billtype" value="1" checked>Cash
                     </label>
                     <label class="radio-inline">
                        <input id="billtype" type="radio" name="billtype" value="2">Credit
                     </label>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3" style="text-align:right;">
                     <p class="page_txt" style="vertical-align: baseline;">Bill Date </p>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3"><?php $today=date("Y-m-d"); ?>
               		<input type="date" class="sq_form" name="datee" id="bill_date" onchange="changedate()" onkeyup="changedate()" max="<?php echo $today ?>" value="<?php echo $today ?>">
                  </div>
			   </div>
               <div class="form_body">
                  <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <div class="row_form">
                            <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                <th>Diety</th>
                                <th>Name</th>
                                <th>Star</th>
                                <th>Pooja</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>Time</th>
<!--                                 <th style="text-align:right;"><span onclick="addRow()"><i class="fa fa-plus" style="padding: 8px;"></i></span></th> -->
                            </tr>
                            </thead>
                            <tbody id="dataTable1">
                            <tr>
                                <td><select name="diety_id" id="diety_100" onChange="changepooja(100)" class="sq_form" style="width:100%;">
                                    <option selected="selected" value="0">Please Select</option>
                                        <?php foreach ($diety_list as $diety){  ?>
                                        <option value="<?php echo $diety['id'];?>"><?php echo $diety['name'];?></option>
                                        <?php  } ?>
                                </select></td>
                                <td><input type="text" name="ben_name" id="name_100" class="sq_form name" placeholder="Name" value="" required style="width: 3.2cm;" onchange="nameadd();"></td>
                                <td><select name="star_id" id="star_100" class=" sq_form js-example-basic-single" required style="width: 3.2cm;">
                                    <option value="">Select Star</option>
                                    <?php foreach($star_list as $val){ ?>  
                                        <option value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";} echo $val['name_eng']." - ".$val['name_mal']; ?></option>
                                    <?php } ?>
                                </select></td>
                                <td><select name="pooja_id" id="pooja_100" onchange="change_rate(100)"  onload="change_rate(100)" class="sq_form js-example-basic-single" style="width: 6.6cm;">
                                    	<option value="0">Please Select</option>
                                	</select>
                            	</td>
                                <td><input type="hidden" value="100" id="row_value">
                                    <input id="qlt_100" type="number" min="1" name="qlt" onchange="change_rate(100),checkallowedqty(100)" onkeyup="change_rate(100),checkallowedqty(100)"  class="sq_form" placeholder="Quatity" value="1" style="width: 1.6cm;" ></td>
                                <td><input id="rate_100" type="text" name="rate"  class="sq_form" placeholder="Rate" readonly value="" style="width: 1.6cm;"></td>
                                <td><input id="amt_100" type="text" name="amt"  class="sq_form" onkeyup="totalgross()" placeholder="Amount" readonly value=""></td>
                                <td><select name="time" id="time_100"  onkeypress="return myKeyPress(event)"  class=" sq_form" required style="width: 1.6cm;">
                                    <option value="M" selected="selected">M</option>
                                    <option value="E">E</option>
                                </select></td>	
<!--                                 <td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td> -->
                            </tr>
                            </tbody>
                        </table>			
                    </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="form_body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="row_form">
                                    <table class="table table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>D/W/M/O</th>
                                                <th class="weekday">Weekday</th>
                                                <th class="star">Star</th>
                                                <th class="other">Other</th>
                                                <th>From Date</th>
                                                <th class="year">Year</th>
                                                <th class="month">Month</th>
                                                <th class="week">Week</th>
                                                <th class="day">Day</th>
                                                <th class="dateto">Date To</th>
                                                <th>Prasadam</th> 
                                                <th class="amount">Postal Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataTable2">
                                            <tr>
                                                <td><select name="dmyo" id="dmyo" onchange="optionalfield()"  class="sq_form" required >
                                                        <option value="0">Select </option>
                                                        <option value="1">Daily </option>
                                                        <option value="2">Weekly </option>
                                                        <option value="3">Monthly </option>
                                                        <option value="4">Other </option>
                                                    </select></td>
                                                <td class="weekday"><select name="week" id="week"  class="sq_form form-control select2"   multiple>
                                                        <option value="">Select </option>
                                                        <option value="Sunday">Sunday </option>
                                                        <option value="Monday">Monday </option>
                                                        <option value="Tuesday">Tuesday </option>
                                                        <option value="Wednesday">Wednesday </option>
                                                        <option value="Thursday">Thursday </option>
                                                        <option value="Friday">Friday </option>
                                                        <option value="Saturday">Saturday </option>
                                                    </select>
                                                </td>
                                                <td class="star"><select name="star[]" id="month"  class=" sq_form  select2 "  multiple>
                                                        <option value="">Select Star</option>
                                                    <?php foreach($star_list as $val){ ?>  
                                                        <option value="<?= $val['name_eng']; ?>"><?= $val['name_eng']." - ".$val['name_mal']; ?></option>
                                                    <?php } ?>
                                                    </select>  </td>
                                                <td class="other"><select name="other" id="other_id" class="sq_form col-lg-10">
                                                    <option value="0">Please Select</option>
                                                    <?php foreach($other_list as $val){ ?>
                                                    <option value="<?= $val['other_code']; ?>"><?= $val['other_detail']; ?></option>
                                                    <?php } ?>
                                                </select></td>
                                                <td> <input name="main_date" type="date" class="form-control clickable input-md date_inp" id="datefrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date" ></td>
                                                <td class="year"><input style="max-width:60px;"  type="number" name="date" class="form-control dc" min="0" id="years" value="0" /></td>
                                                <td class="month"><input style="max-width:60px;"  type="number" name="date" class="form-control dc" min="0" id="months" value="0" /></td>
                                                <td class="week"><input style="max-width:60px;"  type="number" name="date" class="form-control dc" min="0" id="weeks" value="0" /></td>
                                                <td class="day">
                                                    <input style="max-width:60px;" type="number" name="date" class="form-control dc" min="0" id="days" value="0" />
<!--                                                 <input type="date"  class="form-control clickable input-md date_inp" id="dateto" min="<?php echo date('Y-m-d');?>"
                                                       value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date" > -->
                                                </td>
                                                <td><input id="cdt" type="text" class="form-control dateto" value="" readonly /> </td>
                                                
                                                
                                                
                                                <td><select name="prasadam" id="prasadam" onchange="prasadamfield(),check_dmyo()" onselect="check_dmyo(),totalgross()" onfocusout="totalgross()"  class=" sq_form" required>
                                                        <option value="0">Please Select</option>
                                                        <option value="1">Yes </option>
                                                        <option value="2">No </option>
                                                    </select>  </td>
                                                <td class="amount"><input type="text" name="parcel_amt" id="parsel_amt" class="sq_form" onkeyup="check_dmyo(),totalgross()" placeholder="Amount"  value=""></td>
                                            </tr>
                                        </tbody>
<!--                                         <tfoot>
                                            <tr>
                                                <th colspan="6" style="text-align:left">Total</th>
                                                <th style="text-align:left;padding:10px 25px" id="total">0</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </tfoot> -->
                                    </table>
                                </div>
                            </div>
                            <div class="row" id="scheduletable">
                                <div class="col-sm-12" style="padding:10px;">
                                    <table id="st" class="table display table-hover srp_table" width="100%" border="1" style="display:none;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Star</th>
                                                <th>Prasadam</th>
                                                <th>Postal Amount</th>
                                                <th>Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="mytbody"></tbody>
                                    </table>
<!--                                     <table>
                                       <tr>
                                                <th colspan="6" style="text-align:left">Total</th>
                                                <th style="text-align:left;padding:10px 25px" id="gtotal">0</th>
                                                <th colspan="2"></th>
                                            </tr>
                                    </table> -->
                                    <table class="table  srp_table" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Payment Type</th>
                                                <th>Bill Amount</th>
                                                <th class="cashdetails">Received Amount</th>
                                                <th class="cashdetails">Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr>
                                           <td><select id="mode" name="mode" class="sq_form" required onchange="openpaydetails()" >
                          <option value="">Select Mode</option>
                          <option value="1" selected="selected">Cash</option>
                          <option value="6">QR Code</option>
                          <option value="5">NEFT</option>
                  		  <option value="7">Card</option>
                  		  <option value="8">MO</option>
                  </select></td>
                                           <td><input id="bill_amount" type="text" name="bill_amount" class="sq_form"  placeholder=""  value="" readonly></td>
                                           <td class="cashdetails"><input id="amount_received" type="text" name="amount_received" onkeyup="checkBal()" class="sq_form"  placeholder=""  value=""></td>
                                           <td class="cashdetails"><input id="balance" type="text" name="balance" class="sq_form"  placeholder=""  value=""></td>
                                        </tr>
                                        <tr class="pay_details">
                                           <th>Ref. Number</th>
                                           <td><input id="number" type="text" name="number" class="sq_form" placeholder="Ref. Number"></td>
                                           <th>Date</th>
                                           <td><input id="mode_date" type="date" name="mode_date"  class="sq_form"></td>
                                        </tr>
                                       </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <br>
                </div>
        <!-- <div style="align: center;" class="form_body">
            <div class="row">
                <div  class="col-lg-6 col-md-6 col-sm-6">		
                    <div class="shadow-sm p-3 mb-2 bg-white" >
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr style="border-bottom: 1px solid black">
                            <th style="padding: 20px;">Pooja</th>
                            <th style="padding: 20px;">Rs <span id="ContentPlaceHolder1_lbltotal1"><?php print_r($this->amount[0]['SUM(rate)']);?></span></th>
                            </tr>
                            <tr class="g_total">
                            <th style="padding: 20px;">TOTAL</th>
                            <th style="padding: 20px;">Rs <span id="ContentPlaceHolder1_lbltotal2"><?php print_r($this->amount[0]['SUM(rate)']);?></span></th>
                            </tr>
                        </table>
                        <div style="padding: 10px;text-align: center;">
                            <a ID="btn_pay" class="btn btn-success" href="<?php echo base_url(); ?>index.php/admin/admin/review" style="text-align: center;">Review &amp; Pay</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    
    
			 <!--form-->
			</div>
          <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative">
               <table class="table  srp_table" width="100%">
                                            <tr>
                                                <th>Name</th>
                                                <th>House Name</th>
                                                <th>Post Office</th>
                                                <th>Place</th>
                                           <tr>
                                           <td><input style="border-color: red;" type="text" name="name" class="sq_form" placeholder="" required  value="" id="namep"></td>
                                           <td><input type="text" name="house_name" class="sq_form" placeholder=""  value=""></td>
                                           <td><input type="text" name="post" class="sq_form" placeholder=""  value=""></td>
                                           <td><input type="text" name="street" class="sq_form" placeholder=""  value=""></td>
                                        </tr>
                                        <tr>
                                                <th>Pincode</th>
                                                <th>District</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                            </tr>
                                         <tr>
                                           <td><input type="text" name="pincode" class="sq_form" placeholder=""  value=""></td>
                                           <td><input type="text" name="district" class="sq_form" placeholder=""  value=""></td>
                                           <td><input style="border-color: red;" type="text" name="mobile" class="sq_form" required placeholder=""  value=""></td>
                                           <td><input type="text" name="email" class="sq_form" placeholder=""  value=""></td>
                                        </tr>
                                    </table>
                                 </div>  
               <div class="col-sm-12 buttons" style="display:none;">
                       
                        <button type="submit" class="btn" name="save"  id="100" value="saveandprint" style="margin:-10px 4px 0 4px;background-color:#90EE90;" onfocus="test();"> Save & Print</button>
         <button type="submit" class="btn btn-success" name="save" value="save" style="margin:-10px 4px 0 4px;"> Save </button>
          
          
          </div>
          </div>
	    </div>

       </div>
	  </div>
</form>
        <div class="clearfix"></div>
        <br>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js" integrity="sha512-/n/dTQBO8lHzqqgAQvy0ukBQ0qLmGzxKhn8xKrz4cn7XJkZzy+fAtzjnOQd5w55h4k1kUC+8oIe6WmrGUYwODA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
        <script>
       
         $('.star').hide();
         $('.other').hide();
         $('.weekday').hide();
         $('.year').hide();
         $('.month').hide();
         $('.week').hide();
         $('.day').hide();
         $('.pay_details').hide();
         $('.dateto').hide();
        
         $(document).on('focus', '.name', function() {
   var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
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
        
        function openpaydetails(){
            var mode = $('#mode').val();
            if(mode == 1){
               $('.pay_details').hide();
               $('.cashdetails').show();
            }
            else{
               $('.pay_details').show();
               $('.cashdetails').hide();
            }
        }
function checkpooja(e){

	var pooja=$('#pooja_'+e).val();

	if(pooja=="2000"){
		//$('#dvPassport').css('display','none');
		//$('#savebtn').css('display','block');
		var url = '<?php echo base_url();?>index.php/welcome/getmokkolakkalludate';
    	$.ajax({
            type: "POST",
            url: url,
            data: {'pooja': pooja},
            dataType: "json",
            success: function (data) {
           
            	$('#datefrom').val(data);
            	$('#datefrom').attr('readonly', true);
            	
            }
        });
	}else{

    	var data='<?php echo date('Y-m-d');?>';
    	//$('#dvPassport').css('display','block');
		//$('#savebtn').css('display','none');
    	$('#main_date').val(data);
        $('#main_date').attr('readonly', false);
    }
}
// function changeamount(){
// 	var rate=document.getElementById('parsel_amt').value;
// 	var count=document.getElementById('count').value;
//     var charge=rate*count;
//     alert(charge);
//     document.getElementById('parsel_amt').innerHTML=charge;
// }
// 
$('#amount_received').on('input', (e) => {
        	if(parseFloat(e.target.value) > parseFloat($('#bill_amount').val())) {
            	$('#amount_received').val($('#bill_amount').val())
            }
        })
function change_rate(e){
        var pooja=$('#pooja_'+e).val();
        var qlt=$('#qlt_'+e).val();                                    
        var url = "<?php echo base_url(); ?>index.php/admin/admin/getpoojarate";
        $.ajax({
            type: "GET",
            url: url,
            data: {'pooja': pooja},
            dataType: "json",
            success: function (data) {
               // console.log(data);
                $.each(data, function (i, obj)
                {
                    var amt=qlt*obj.rate;
                    $('#rate_'+e).val(obj.rate);
                    $('#amt_'+e).val(amt);
                	
                    totalgross();
                });
            }
        });
        checkpooja(e);
    }
function changepooja(e){
   
    var diety=$('#diety_'+e).val();
    var poojacode='<?php echo $site[0]['poojacode']?>';
    $('#pooja_'+e).html("");
    var html='<option value="0">Please Select</option>';
    var url = '<?php echo base_url();?>index.php/admin/admin/getpoojasbydiety';
	$.ajax({
        type: "POST",
        url: url,
        data: {'diety': diety},
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, obj)
            {
            	if(obj.temple_id == 8 || obj.temple_id == 2000) {
                    $('#amt_100').prop('readonly', false)
                }
                if (poojacode=="0"){
                    var pooja=obj.pooja;
                }else{
                    var pooja=obj.code+' - '+obj.pooja;
                }
            	html +='<option value="'+obj.pooja_id+'">'+pooja+' - '+obj.pooja_mal+' - Rs '+obj.pooja_rt+'</option>';
            });
            $('#pooja_'+e).append(html);
        }
    });
}

// function showschedule(id){
//     $('#description').removeClass("active");
//     $('#specification').removeClass("active");
//     $('#review').removeClass("active");
//     $('#description_1').removeAttr('class');
//     $('#specification_1').removeAttr('class');
//     $('#review_1').removeAttr('class');
//     $('#'+id).addClass("active");
//     $('#'+id+"_1").addClass("active");
// }
// 

function remove_file_row(obj){
	$(obj).closest('tr').remove();
    totalgross();
    checkBal();
	return false;
}
  /*
 function addRow() {
    	var bill_date=$('#bill_date').val();
        var row_value=$('#row_value').val();
        var diety=$('#diety_'+row_value).val();
        var name=$('#name_'+row_value).val();
        var star=$('#star_'+row_value).val();
        row_value++;
        var html = '<tr>';
        	html +='<td><select name="diety_id[]" id="diety_'+row_value+'" onchange="changepooja('+row_value+')" class="js-example-basic-single sq_form" required "><option value="">Select Diety</option>';
			<?php foreach($diety_list as $val){ ?>
			var id="<?php echo $val['id']; ?>";
            html +='<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form" placeholder="Name" value="" required style="width: 3.2cm;"></td>';
            html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.2cm;"><option value="">Select Star</option>';
			<?php foreach($star_list as $val){ ?>
			html +='<option value="<?= $val['id']; ?>"><?= $val['name_eng']." - ".$val['name_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="js-example-basic-single sq_form sq_form col-lg-10"><option value="">Select Pooja</option>';
            html +='</select></td>';
    		html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+'),checkallowedqty('+row_value+')"  onkeyup="change_rate('+row_value+'),checkallowedqty('+row_value+')" class="sq_form" placeholder="Quatity" value="1"></td>';
            html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form" placeholder="Rate" readonly value=""></td>';
            html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form" placeholder="Amount" readonly value=""></td>';
            html +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
			html +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
           
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
    		$('#dataTable1').append(html);
    		$('#row_value').val(row_value);
    		$('#diety_'+row_value).val(diety);
    		$('#name_'+row_value).val(name);
    		$('#star_'+row_value).val(star);
    		$('#diety_'+row_value).focus();
    		changepooja(row_value);
    		totalcalc();
    } */

function check_dmyo(){
    var dmyo=$('#dmyo').val();
    if(dmyo==1){
        dailysub();
    }
    else if (dmyo==2){
        weeklysub();
    }
    else if (dmyo==3){
        monthlysub();
    }
    else if(dmyo==4){
        othersub();
    }
    totalgross()
}
 function optionalfield(){
        var dmyo=$('#dmyo').val();  
        if(dmyo==1){
           $('.star').hide();
           $('.weekday').hide();
           $('.other').hide();
           $('.day').show();
           $('.month').hide();
           $('.week').hide();
        }
        else if(dmyo==2){
           $('.star').hide();
           $('.other').hide();
           $('.weekday').show();
           $('.week').show();
           $('.month').hide();
           $('.day').hide();
        }
        else if(dmyo==3){
           $('.star').show();
           $('.other').hide();
           $('.weekday').hide();
           $('.month').show();
           $('.day').hide();
           $('.week').hide();
        }
        else if(dmyo==4){
           $('.star').hide();
           $('.other').show();
           $('.weekday').hide();
           $('.day').hide();
           $('.week').hide();
           $('.month').show();
        }
       
    }
        
    function prasadamfield(){  
        var prasadam=$('#prasadam').val();
        if(prasadam==1){
           $('.amount').show();
           totalgross();
        }
        else{
           $('.amount').hide();
           totalgross();
        }
    } 
    function totalcalc(){
        var i;
        var table = document.getElementById('dataTable1');
    	var rowCount = table.rows.length;
        var tpoojacount = parseInt($('#st tr').length) - 1;
        //alert(tpoojacount);
        var tot=0;
        var pr_amt=($('#parsel_amt').val() != '') ?  $('#parsel_amt').val() :  0;
    
        for (i = 100; i < 1000; i++) {
          if (!isNaN(parseInt($('#amt_'+i).val()))){
              tot += parseInt($('#amt_'+i).val());
          }
        }
        tot=tot+parseFloat(pr_amt);
        $('#total').html(tot);
        var grosstotal = tot * tpoojacount;
        $('#gtotal').html(grosstotal);
        $('#bill_amount').val(grosstotal);
     $('#amount_received').val(grosstotal);
    }
    function totalgross(){
        var i;
        var table = document.getElementById('dataTable1');
    	var rowCount = table.rows.length;
        var billtype=$('#billtype:checked').val();
    console.log(billtype);
        var tpoojacount = parseInt($('#st tr').length) - 1;
        //alert(tpoojacount);
        var tot = parseInt($('#amt_100').val());
        var pr_amt=($('#parsel_amt').val() != '') ?  $('#parsel_amt').val() :  0;
        
        tot=tot+parseFloat(pr_amt);
        var pc = (tpoojacount == 0) ? 1 : tpoojacount;
        $('#total').html(tot);
        var grosstotal = tot * pc;
        console.log(pc);
        $('#gtotal').html(grosstotal);
        $('#bill_amount').val(grosstotal);
       $('#amount_received').val(grosstotal);
    	$('#amount_received').attr('max', grosstotal);
        if(billtype == 1){
            $('#amount_received').val(grosstotal);
            $('#balance').val(0);
        }
        else{
           $('#amount_received').val(0);
           $('#balance').val(0);
        }
        
    }
//     function totalgross(){
//         var i;
//         var table = document.getElementById('dataTable1');
//     	var rowCount = table.rows.length;
//         var tpoojacount = parseInt($('#st tr').length) - 1;
//         //alert(tpoojacount);
//         var tot=0;
//         var pr_amt=($('#parsel_amt').val() != '') ?  $('#parsel_amt').val() :  0;
//         if(pr_amt > 0){
//           for (i = 100; i < 1000; i++) {
//              if (!isNaN(parseInt($('#amt_'+i).val()))){
//                 tot += parseInt($('#amt_'+i).val());
//              }
//           }
//           tot=tot+parseFloat(pr_amt);
//           var pc = (tpoojacount == 0) ? 1 : tpoojacount;
//           $('#total').html(tot);
//           var grosstotal = tot * pc;
//         }
//         else{
//           for (i = 100; i < 1000; i++) {
//              if (!isNaN(parseInt($('#amt_'+i).val()))){
//                 tot += parseInt($('#amt_'+i).val());
//              }
//           }
//           tot=tot+parseFloat(pr_amt);
//           $('#total').html(tot);
//           var grosstotal = tot;
//         }
//         $('#gtotal').html(grosstotal);
//         $('#bill_amount').val(grosstotal);
        
//     }
    function checkBal(){
       var bill_amt =  $('#bill_amount').val();
       var rec_amt =  $('#amount_received').val();
       var bal = bill_amt - rec_amt;
       $('#balance').val(bal);
    }
    function dailysub(){
        var datefrom=$('#datefrom').val();
        var days = parseInt($('#days').val());
        var week = parseInt($('#weeks').val());
        var month = parseInt($('#months').val());
        var year = parseInt($('#years').val());
       // var dateto=$('#dateto').val();
        var date = Date.parse(datefrom).add({ years: year, months: month, weeks:week, days:days-1 });
        var dateto =  date.toString('yyyy-MM-dd');
        if(datefrom==""){
            alert("Date field is required");
        }else if(dateto==""){
            alert("Date field is required");
        }
        $(".display").removeAttr('style');
        $(".buttons").removeAttr('style');
        $("#cdt").val(dateto);
        var url = '<?php echo base_url();?>index.php/admin/admin/getdatestar';
        var html="";
        var pr_amt=$('#parsel_amt').val();
        if($('#prasadam').val() == 1){
           var prasadam_status = 'Yes';
        }
        else if($('#prasadam').val() == 2){
           var prasadam_status = 'No';  
           pr_amt = 0;
        }
        
        var time = $('#time_100').val();
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
                    html +='<td>'+prasadam_status+'</td>';
                    html +='<td>'+pr_amt+'</td>';
                    html +='<td>'+time+'</td>';
                    html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                    a++;
                });
                $('#mytbody').html(html);
                totalgross();
            }
        });
        
    }	
function weeklysub(){

    var datefrom=$('#datefrom').val();
	//ar dateto=$('#dateto').val();
	    var days = parseInt($('#days').val());
        var week = parseInt($('#weeks').val());
        var month = parseInt($('#months').val());
        var year = parseInt($('#years').val());
        var date = Date.parse(datefrom).add({ years: year, months: month, weeks:week, days:days });
        var dateto =  date.toString('yyyy-MM-dd');
	if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	$(".buttons").removeAttr('style');
    $("#cdt").val(dateto);
	var url = '<?php echo base_url();?>index.php/admin/admin/getweekstar';
	var html="";
     var pr_amt=$('#parsel_amt').val();
        if($('#prasadam').val() == 1){
           var prasadam_status = 'Yes';
        }
        else if($('#prasadam').val() == 2){
           var prasadam_status = 'No';  
           pr_amt = 0;
        }
        
        var time = $('#time_100').val();
	var a="1";
	var sel=$('#week option:selected').map(function(_, el) {
        var days=$(el).val();
        $.ajax({
            type: "POST",
            url: url,
            data: {'from': datefrom,'to': dateto,'day': days,'noofweeks':week},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                	html +='<td>'+obj.name_eng+'</td>';
                	html +='<td>'+prasadam_status+'</td>';
                    html +='<td>'+pr_amt+'</td>';
                    html +='<td>'+time+'</td>';
                    html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                });
                $('#mytbody').html(html);
                totalgross();
            }
        });
    }).get();
	
}
function monthlysub(){
    var datefrom=$('#datefrom').val();
	 var days = parseInt($('#days').val());
        var week = parseInt($('#weeks').val());
        var month = parseInt($('#months').val());
        var year = parseInt($('#years').val());
       // var dateto=$('#dateto').val();
        var date = Date.parse(datefrom).add({ years: year, months: month, weeks:week, days:days });
        var dateto =  date.toString('yyyy-MM-dd');
	if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	$(".buttons").removeAttr('style');
    
	var url = '<?php echo base_url();?>index.php/admin/admin/getmonthstar';
	var html="";
     var pr_amt=$('#parsel_amt').val();
        if($('#prasadam').val() == 1){
           var prasadam_status = 'Yes';
        }
        else if($('#prasadam').val() == 2){
           var prasadam_status = 'No';  
           pr_amt = 0;
        }
        
        var time = $('#time_100').val();
	var a="1";
	var sel=$('#month option:selected').map(function(_, el) {
        console.log(el);
        var star=$(el).val();
        console.log(star);
        $.ajax({
            type: "POST",
            url: url,
            data: {'from': datefrom,'to': dateto,'star': star,'month':month},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                	html +='<td>'+obj.name_eng+'</td>';
                	html +='<td>'+prasadam_status+'</td>';
                    html +='<td>'+pr_amt+'</td>';
                    html +='<td>'+time+'</td>';
                    html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                    $("#cdt").val(obj.date);
                });
                $('#mytbody').html(html);
                $(".dateto").show();
                totalgross();
            }
        });
    }).get();
    
}
function othersub(){

    
    var datefrom=$('#datefrom').val();
	 var days = parseInt($('#days').val());
        var week = parseInt($('#weeks').val());
        var month = parseInt($('#months').val());
        var year = parseInt($('#years').val());
       // var dateto=$('#dateto').val();
        var date = Date.parse(datefrom).add({ years: year, months: month, weeks:week, days:days });
        var dateto =  date.toString('yyyy-MM-dd');
	if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	$(".buttons").removeAttr('style');
     $("#cdt").val(dateto);
	var url = '<?php echo base_url();?>index.php/admin/admin/getother';
	var html="";
     var pr_amt=$('#parsel_amt').val();
        if($('#prasadam').val() == 1){
           var prasadam_status = 'Yes';
        }
        else if($('#prasadam').val() == 2){
           var prasadam_status = 'No';  
           pr_amt = 0;
        }
        
        var time = $('#time_100').val();
	var a="1";
	var sel=$('#other_id option:selected').map(function(_, el) {
        console.log(el);
        var other=$(el).val();
        console.log(other);
        $.ajax({
            type: "POST",
            url: url,
            data: {'from': datefrom,'to': dateto,'other': other},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                	html +='<td>'+obj.name_eng+'</td>';
                	html +='<td>'+prasadam_status+'</td>';
                    html +='<td>'+pr_amt+'</td>';
                    html +='<td>'+time+'</td>';
                    html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                });
                $('#mytbody').html(html);
                totalgross();
            }
        });
    }).get();
    
} function nameadd()
        {
        var name=$('#name_100').val();
      
     $('#namep').val(name)
        
        }
         function test()
    {
    document. getElementById('100'). style. backgroundColor = 'Red';
    
    }
        
     $(document).on('keydown', (e) => {
     	if(e.keyCode == 9) {

        	if($("#name_100").is(':focus') == true){
            	var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
            	$.ajax({
                    url: translate_url,
                    type: 'post',
                	dataType: "json",
                	data: {
                    	search: $("#name_100").val()
                	},
                	success: function(data) {
                    	console.log(data)
                    	$("#name_100").val(data.name);
                	}
            	});
            
            	// $("#firststar").focus();
                return false;
        	}
        }
     })
    
    </script>

</script>