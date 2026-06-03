<?php
$token = md5(uniqid(rand(), true)); // Generate a unique token
$this->session->set_userdata('form_token', $token); // Store the token in session
?>
<style type="text/css">
.submit:focus {
  background:blue;
}
.ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;   
    padding: 4px 0;
    margin: 0 0 10px 25px;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
}

.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}

.ui-state-hover, .ui-state-active {
    color: #ffffff;
    text-decoration: none;
    background-color: #0088cc;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    background-image: none;
}
#loading {
   width: 100%;
   height: 100%;
   top: 0px;
   left: 0px;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #fff;
   z-index: 99;
   text-align: center;
}

#loading-content {
  position: absolute;
  top: 50%;
  left: 50%;
  text-align: center;
  z-index: 100;
}

.bg-lightsteelblue {
        background-color: lightsteelblue;
    }
    .text-lightsteelblue {
        color: lightsteelblue;
    }
    
    .bg-lavender {
        background-color: lavender;
    }
    .text-lavender {
        color: lavender;
    }
</style>

<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">Billing Master</h4>
        </div>
         <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">
             Today's Collection : <?php echo $totalcollection; ?>
         </h4>
        </div>
       <!--  <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">
             Total Credit : <?php echo $totalcredit; ?>
         </h4>
        </div>-->
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
   <!-- <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >-->
   <!--   <div class="clearfix"></div>-->
	  <!-- <div class="row">-->
   <!--     <div class="col-lg-6 col-md-6 col-sm-6 ">-->
   <!--       <h2 class="page_txt"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;Billing </h2>-->
   <!--     </div>-->
   <!--     <div class="col-lg-6 col-md-6 col-sm-6 ">-->
   <!--       <ul class="btn_ul">-->
            <!-- <li> <a href="<?php// echo base_url();?>index.php/admin/admin/pooja_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li> -->
   <!--       </ul>-->
   <!--     </div>-->
	  <!-- </div>	-->
		
	  <!--</div>-->
	   <?php if(!empty($pooja_availability_array)): ?>
    <div class="card p-3">
        <div class="row">
            <div class="col-md-2 d-flex flex-column">
                <div class="col-md-12 d-flex flex-row align-items-center">
                    <h3 class="page_txt my-auto"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp; </h3>
                    <h4 class="page_txt my-auto"> Availability </h4>
                </div>
            </div>
            <?php foreach($pooja_availability_array as $availability): ?>
                <div class="col-md-2 d-flex flex-column">
                    <div class="card bg-lavender py-3 m-0">
                        <h5 class="page_txt text-center my-auto"> <?php print_r($availability['pooja']); ?>: <?php print_r($availability['quantity']); ?> </h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/billing" method="post" onsubmit="return validateForm()" id="myform">
            	<input type="hidden" name="token" value="<?php echo $token; ?>">
               <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $last_id;?> </h2>
                </div> 
                <!--<div class="col-lg-2 col-md-2 col-sm-2">
                     <label class="radio-inline">
                        <input type="radio" name="optradio" value="1" checked>Cash
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="optradio" value="2">Credit
                     </label>
                  </div>-->
                <div class="col-lg-1 col-md-2 col-sm-2" style="text-align:right;"> <span id="totaltop" 
                                                                                      style="color:red;font-weight:bold;font-size:20px;border:1px solid red;padding:5px;"> Bill total </span></div>
               <div class="col-lg-2 col-md-2 col-sm-2" style="text-align:right;">
               <p class="page_txt" style="vertical-align: baseline;">Bill Date </p>
               </div> 
               <div class="col-lg-2 col-md-2 col-sm-2"><?php $today=date("Y-m-d"); ?>
               		<input type="date" class="sq_form" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" max="<?php echo date('Y-m-d'); ?>"  value="<?php echo $today ?>" >
               </div>
             <!--  <div class="col-lg-2 col-md-2 col-sm-2">
                   <?php if($last_bookid!=""&&$last_bookid!="0"){?>
               <select class="sq_form" id="book_id" name="book_id">
                <option value="">Select</option>
                <?php foreach($book_list as $book){?>
                    <option value="<?php echo $book['id'];?>" <?php if($last_bookid==$book['id']){ echo "selected";}?>><?php echo $book['book_no'];?></option>
                <?php }?>
                </select><?php }?>
               </div>-->
                 <div class="col-lg-2 col-md-2 col-sm-2">Time
                <?php echo date("h:i:sa");?>
                 <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-primary" style="float:right;">Family Pooja</a>
               </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
<!--                 Bill Total
             	<th style="text-align:left;padding:10px 25px" id="totaltop">0</th> -->
           				<div class="input-group mb-3">
  							<input id="search_devotee" name="" type="text" class="form-control" placeholder="Search devotee by mobile number"  autofocus tabindex="0" />
  							<div class="input-group-append">
    							<button class="btn btn-gray py-0" id="customer-add-btn" style="font-size:1.2em" type="button">+</button>
  							</div>
						</div>
                  		<input type="hidden" id="mobile_number" name="mobile_number" />
                    	<div id="search-indicator-devotee"></div>
                    
                    	<div id="devotee_details">
                        	
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
                			 <th>Diety</th>
                            <th>Pooja</th>
                			 <th>Name</th>
                			 <th>Star</th>
                			
                			 <th>Quantity</th>
                			 <th>Rate</th>
                			 <th>Amount</th>
                             <th>Pooja Date</th>
                			 <th>Time</th>
                			 <th style="text-align:right;"><span onclick="addRow()"><i class="fa fa-plus" style="padding: 8px;"></i></span></th>
            			</tr>
            		</thead>
            		<tbody id="dataTable2">
                		<tr>
                			<td><select name="temple[]" id="temple_100" onchange="changepooja(100)" class=" sq_form deity" required style="width: 3.2cm;" autofocus="true">
                                	<option disabled value="">Select Diety</option>
                    			<?php foreach($temple_diety_list as $val){ ?>
                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                        <td><select name="pooja[]" id="pooja_100" onchange="change_rate(100)" onload="change_rate(100)" class="sq_form pooja pooja_id" required style="width: 10cm;">
                                	<option value="">Select Pooja</option>
                    			</select>
                			</td>
                			<td><input type="text" name="name[]" id="name_100" class="sq_form name" placeholder="Name" value="*" required style="width: 3.2cm;"></td>
                			<td><select name="star[]" id="star_100" class=" sq_form star" required style="width: 3.2cm;">
                                	<option value="">Select Star</option>
                    			<?php foreach($birth_star as $val){ ?>  
                    				<option value="<?= $val['id']; ?>" <?php if($val['id'] == 28) { echo 'selected'; } ?>><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";} echo $val['name_eng']." - ".$val['name_mal']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			
                			<td>
                            	<input type="hidden" value="100" id="row_value">
                			    <input type="number" min="1" name="qlt[]" onchange="change_rate(100),checkallowedqty(100)" onkeyup="change_rate(100),checkallowedqty(100)" id="qlt_100" class="sq_form qty" placeholder="Quatity" value="1">
                        	</td>
                			<td><input type="text" name="rate[]" id="rate_100" class="sq_form rate" placeholder="Rate" tabindex = "-1" readonly value=""></td>
                			<td><input type="text" name="amt[]" id="amt_100" class="sq_form amount" onkeyup="totalcalc()"  placeholder="Amount" readonly value=""></td>
                			<td><input type="date" name="date1[]" id="date_100" class="sq_form datefield" placeholder="Date" value="<?php echo date('Y-m-d');?>"  onchange="checkallowedqty(100);" onclick="checkallowedqty(100);"  style="max-width: 4.2cm;"></td>
                		    <td><select name="time[]" id="time_100"  onkeypress="return myKeyPress(event)"  class="sq_form timefield" required style="width: 1.6cm;">
                    				<option value="M" selected="selected">M</option>
                    				<option value="E">E</option>
                    			</select>
                			</td>	
                        <td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>
                		</tr>
                	</tbody>
                	<tfoot>
                	    <tr>
                	        <th colspan="6" style="text-align:left">Total</th>
                	        <th style="text-align:left;padding:10px 25px" id="total">0</th>
                	        <th colspan="2"></th>
                	    </tr>
                	</tfoot>
            	</table>			
			  </div>
			</div>
			</div>
            <div class="col-md-offset-6 col-md-4">
            <div class="form-group" style="margin-top: 7px;" id="paymenttable">
                   <select id="mode" name="mode" class="sq_form" required onchange="openpaydetails()" >
                          <option value="">Select Mode</option>
                          <option value="1" selected="selected">Cash</option>
                          <option value="6">QR Code</option>
                          <option value="5">NEFT</option>
                  		  <option value="7">Card</option>
                  		  <option value="8">MO</option>
                  </select>
               </div>
            </div>
        	<div class="col-md-3">
            	<textarea class="form-control" id="remarks" placeholder="Remarks" name="remarks" rows="1"></textarea>
			</div>
             <div class="col-md-12">
                <div class="form-group">
                <button type="submit" class="btn pull-right d-none"  name="save" id="add_adjustment_item" value="add_item" style="margin:7px 4px;background-color:#90EE90;" > Add Item </button>
              <button type="button" onclick="formsubmit('save');" class="btn submit  pull-right" name="save" id="100" value="print" style="margin:7px 4px;background-color:#90EE90;" onfocus="test();"> Save &amp; Print </button>
         <?php   if ($_SERVER['HTTP_HOST'] == "kodikkunnubhagavathi.com" || $_SERVER['HTTP_HOST'] == "www.kodikkunnubhagavathi.com") { ?>    <button type="submit" onclick="formsubmit('print')" class="btn submit btn-warning pull-right" name="save" value="save" style="margin:7px 4px;"> PDF Generate </button>
                <?php } ?>
            
            </div>
          </div>
         
                </div>
        
      </div>
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Invoice Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table card-table table-vcenter table-striped">
                    <thead>
                    	<tr>
                        	<td colspan="5"><input id="myInput" type="text" class="sq_form" placeholder="Search.."></td>
                    	</tr>
                        <tr>
                            <th style="width:20%;">Sl No</th>
                            <th style="width:40%;">Name</th>
                            <th style="width:30%;">Mobile</th>
                            <th style="width:10%;"></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php if(!empty($fpooja_list)){
	                      $i=0;
	                       foreach($fpooja_list as $val){
                           $f_id=$val['id'];
                		?>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?= $val['name']; ?></td>
					  <td><?= $val['mobile']; ?></td>
                      <td><div class="btn-group">
						  <a href="#" onclick="add_family('<?= $f_id; ?>')" class="btn btn-outline-info" style="padding:6px;" title="Add"> <i class="fa fa-plus"></i></a></div>
                      </td>
					</tr>
                    <?php }} 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="10">No Data Found</td>
						  </tr>
				    <?php } ?>
				  </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
<script>
var flag = false;
var availabilityChecked = false;

		function setDefault() {
            $('#pooja_100').focus().select();
        }
        window.onload = setDefault;

</script>
    <script>
       const checkPoojaAvailability = (pooja_id, date, qty) => {
       console.log(pooja_id, date, qty);
    return new Promise((resolve, reject) => {
       $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/admin/admin/check_pooja_availability",
            data: {'pooja_id': pooja_id,'date':date, 'qty': qty},
            success: function (data) {
               let pooja_date = new Date(date)
               let year = pooja_date.getFullYear()
               let month = pooja_date.getMonth()
               let day = pooja_date.getDate()
               
               let format2 = day + "/" + month + "/" + year;
               data = JSON.parse(data)
               console.log()
               if(data.exists && data.exists == 1){
               	  if(data.qty) {
                  	alert('Limit exceeded for '+data.pooja+' on '+format2+'. Current quantity is '+data.qty);
                  } else {
                  	alert('Limit exceeded for '+data.pooja+' on '+format2);
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
   
    // function submitform(){
    //     $('#myform').attr("target","_blank");
    //     $('#myform').submit();
    //     window.location.reload();
    // }
    // 
    // 
  //   $('.pooja_time').on('keydown', function(e) {
  //   if (e.key === 'a' || e.key === 'A') {
  //     $(this).val('A');
  //   }
  // 	else if (e.key === 'm' || e.key === 'M') {
  //     $(this).val('M');
  //   }
  // 	else if (e.key === 'n' || e.key === 'N') {
  //     $(this).val('N');
  //   }
  // 	else if (e.key === 'e' || e.key === 'E') {
  //     $(this).val('E');
  //   }
  // });
  
    
    
    $( document ).ready(function() {
    	setTimeout(function () {
             $('#temple_100').focus().select();
        }, 1000);
        
    });
    
     $('body').on('click','.pdfPrint',function() {
    alert(10);
    $(this).attr("disabled", true);
        setInterval(function () {
            location.reload();
        }, 1000);
    });
    
    function submitFormFn() {
    	var promises = [];
        $('#dataTable2 tr').each((i, e) => {
        	var $row = $(e)
        	var pooja_id = $row.find('.pooja_id').val();
        	var date = $row.find('.datefield').val();
        	var qty = $row.find('.qty').val();
			var promise = checkPoojaAvailability(pooja_id, date, qty);
        	promises.push(promise);
        });
   
   		Promise.all(promises)
    .then(results => {
      var flag = results.every(result => result === true);
      if (flag == true) {
      	$('button.submit').attr('type', 'submit');
      	$('button.submit').attr('data-availability_check', true);
      	$('button.submit').trigger('click');
      	$('button.submit').prop('disabled', true);
      	$('button.submit').attr('type', 'button');
      } 
    })
    .catch(error => {
      console.error(error);
    });
    }
    
    $('button.submit').on('click', (e) => {
    	let availabilityChecked = e.target.getAttribute('data-availability_check');
    	if(!availabilityChecked)
    		submitFormFn()
    })
    
    $('button.submit').on('submit', (e) => {
    	$('button.submit').prop('disabled', true);
      	$('button.submit').attr('type', 'button');
    })
    
    
    
    $('.sq_form.datefield').on('change', (e) => {
    	var $row = $(e.target).closest('tr'); // Get the closest row element
    	var pooja_id = $row.find('.pooja_id').val();
    	var date = e.target.value;
   		var qty = $row.find('.qty').val();
    	checkPoojaAvailability(pooja_id, date, qty)
    });
    
   function formsubmit(val){
   if(val === 'print'){
        setInterval(function () {
            window.location.reload();
        }, 1000);
   }
        // $('#100').css("display",'none');
   }
   function formsubmit(val){
   if(val === 'print'){
        setInterval(function () {
            window.location.reload();
        }, 1000);
   }
        // $('#100').css("display",'none');
   }
    function validateForm() {
      var x = $('#temple').val();
      if (x == "") {
        alert("Diety must be filled out");
        return false;
      }
    }
    $('input[type=radio][name=optradio]').change(function() {
        if (this.value == '2') {
            $('#paymenttable').hide();
        }
        else if (this.value == '1') {
            $('#paymenttable').show();
        }
    });
    function totalcalc(){
        var i;
        var table = document.getElementById('dataTable2');
    	var rowCount = table.rows.length;
        var tot=0;
        // alert(rowCount);
        for (i = 100; i < 1000; i++) {
          if (!isNaN(parseInt($('#amt_'+i).val()))){
              tot += parseInt($('#amt_'+i).val());
          }
        }
        $('#total').html(tot);
        $('#totaltop').html(tot);
    }
    // function myKeyPress(e){
    //     var keynum;
    //     e.preventDefault();
    //     if(window.event) { // IE                    
    //       keynum = e.keyCode;
    //     } else if(e.which){ // Netscape/Firefox/Opera                   
    //       keynum = e.which;
    //     }
    //     if(keynum==13){
    //         e.preventDefault();
    //         addRow();
    //         return false;
    //     }
    // }   
    
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
                console.log(data);
                $.each(data, function (i, obj)
                {
                    var amt=qlt*obj.rate;
                    $('#rate_'+e).val(obj.rate);
                    $('#amt_'+e).val(amt);
               		//$('#time_'+e).val(obj.time);
                    totalcalc();
                });
            }
        });
        checkpooja(e);
        checkRowAdd(e);
        
    }
    
    function change_rate2(e){
        var pooja=$('#pooja_'+e).val();
        var qlt=$('#qlt_'+e).val();
        var url = "<?php echo base_url(); ?>index.php/admin/admin/getpoojarate";
        $.ajax({
            type: "GET",
            url: url,
            data: {'pooja': pooja},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    var amt=qlt*obj.rate;
                    $('#rate_'+e).val(obj.rate);
                    $('#amt_'+e).val(amt);
                    totalcalc();
                });
            }
        });
        checkpooja(e);
        
    }
    
    function checkpooja(e){
    	var pooja=$('#pooja_'+e).val();
    	 if(pooja=="2000"){
    	 	var url = '<?php echo base_url();?>index.php/welcome/getmokkolakkalludate';
    	 $.ajax({
    	 type: "POST",
    	 url: url,
    	 data: {'pooja': pooja},
    	 dataType: "json",
    	 success: function (data) {
    	 $('#date_'+e).val(data);
    	 $('#date_'+e).attr('readonly', true);
          $('#qlt_'+e).attr('readonly', true);
    	 }
    	 });
    	 }else{
    	 	var data='<?php echo date('Y-m-d');?>';
    	 	$('#date_'+e).val(data);
    	 $('#date_'+e).attr('readonly', false);
           $('#qlt_'+e).attr('readonly', false);
    	 }
    }
    
    function changedate(){
    	var bill_date=$('#bill_date').val();
    	$('#date_100').val(bill_date);
    }
    
    function changepooja(e,pooja_selected=null){
        var diety=$('#temple_'+e).val();
        var poojacode='<?php echo $site[0]['poojacode']?>';
        if (diety=="8" || diety=="7"|| diety=="5"|| diety=="9000"|| diety=="9001"){
        	$('#amt_'+e).attr('readonly', false);
        }else{
        	$('#amt_'+e).attr('readonly', true); 
        }
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
                    if (poojacode=="0"){
                        var pooja=obj.pooja;
                    }else{
                        var pooja=obj.code+' - '+obj.pooja;
                    }
                	html +='<option value="'+obj.pooja_id+'">'+pooja+' - '+obj.pooja_mal+'</option>';
                });
                $('#pooja_'+e).append(html);
            	$('#pooja_'+e).val(pooja_selected).trigger('change.select2');
            	let deity = data.diety ?? diety;
                if(deity == '102' || deity == '103') {
                        $('#add_adjustment_item').removeClass('d-none');
                        $('#100').addClass('d-none');
                } else {
                        $('#add_adjustment_item').addClass('d-none');
                        $('#100').removeClass('d-none');
                }
            }
        });
    }
    
    
    
    function addRow() {
    	var bill_date=$('#bill_date').val();
        var row_value=$('#row_value').val();
        var diety=$('#temple_'+row_value).val();
        var name=$('#name_'+row_value).val();
        var star=$('#star_'+row_value).val();
    	var pooja=$('#pooja_'+row_value).val();
        row_value++;
        var html = '<tr>';
        	html +='<td><select name="temple[]" id="temple_'+row_value+'" onchange="changepooja('+row_value+')" class="js-example-basic-single sq_form deity" required style="width: 3.2cm;"><option value="">Select Diety</option>';
			<?php foreach($temple_diety_list as $val){ ?>
			var id="<?php echo $val['id']; ?>";
            html +='<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select></td>';
     html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="select2 sq_form pooja pooja_id" required style="width: 10cm;"><option value="">Select Pooja</option>';
            html +='</select></td>';
            html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form name" placeholder="Name" value="*" required style="width: 3.2cm;"></td>';
            html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form star" required style="width: 3.2cm;"><option value="">Select Star</option>';
			<?php foreach($birth_star as $val){ ?>
			html +='<option value="<?= $val['id']; ?>" <?php if($val['id'] == 28){ echo 'selected'; } ?>><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";} echo $val['name_eng']." - ".$val['name_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
           
    		html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+'),checkallowedqty('+row_value+')"  onkeyup="change_rate('+row_value+'),checkallowedqty('+row_value+')" class="sq_form qty" placeholder="Quatity" value="1"></td>';
            html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form rate" placeholder="Rate" tabindex = "-1" readonly value=""></td>';
            html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form amount" tabindex = "-1" placeholder="Amount" readonly value=""></td>';
            html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form datefield" placeholder="Date" value="'+bill_date+'" onchange="checkallowedqty('+row_value+');" onclick="checkallowedqty('+row_value+');"   style="max-width: 4.2cm;"></td>';        
            html +='<td><select name="time[]" id="time_'+row_value+'" class="js-example-basic-single sq_form timefield" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
			html +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
           
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
    		$('#dataTable2').append(html);
    		$('#row_value').val(row_value);
    		$('#temple_'+row_value).val(diety);
    		$('#name_'+row_value).val(name);
    		$('#star_'+row_value).val(star);
    		$('#temple_'+row_value).focus();
    		changepooja(row_value,pooja);
    		totalcalc();
    }
    
      function addSecondRow(data) {
      var poojacodee='<?php echo $site[0]['poojacode']?>';
    	var bill_date=$('#bill_date').val();
        var row_value=$('#row_value').val();
        var diety=$('#temple_'+row_value).val();
        var name=$('#name_'+row_value).val();
        var star=$('#star_'+row_value).val();
        row_value++;
        var html = '<tr>';
        	html +='<td><select name="temple[]" id="temple_'+row_value+'"  class="js-example-basic-single sq_form deity" required style="width: 3.2cm;"><option value="">Select Diety</option>';
			<?php foreach($temple_diety_list as $val){ ?>
			var id="<?php echo $val['id']; ?>";
            html +='<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select></td>';
        html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="select2 sq_form pooja pooja_id" required style="width: 10cm;"><option value="">Select Pooja</option>';
            html +='</select></td>';
            html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form name" placeholder="Name" value="*" required style="width: 3.2cm;"></td>';
            html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form star" required style="width: 3.2cm;"><option value="">Select Star</option>';
			<?php foreach($birth_star as $val){ ?>
			html +='<option value="<?= $val['id']; ?>" <?php if($val['id'] == 28){ echo 'selected'; } ?>><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";} echo $val['name_eng']." - ".$val['name_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
          
    		html +='<td><input type="number"  name="qlt[]" id="qlt_'+row_value+'" class="sq_form qty" placeholder="Quantity" value="0"></td>';
            html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form rate" placeholder="Rate" readonly value="0"></td>';
            html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form amount" placeholder="Amount" readonly value="0"></td>';
            html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form datefield" placeholder="Date" value="'+bill_date+'" onchange="checkallowedqty('+row_value+');" onclick="checkallowedqty('+row_value+');"   style="max-width: 4.2cm;"></td>';        
            html +='<td><select name="time[]" id="time_'+row_value+'" class="js-example-basic-single sq_form timefield" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
			html +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
           
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
    		$('#dataTable2').append(html);
    		$('#row_value').val(row_value);
    		$('#temple_'+row_value).val(diety);
    		$('#name_'+row_value).val(name);
    		$('#star_'+row_value).val(star);
    		$('#temple_'+row_value).focus();
           
    		//changepooja(row_value);
    		
            var sel;
            sel +='<option selected value="'+data.pooja_id+'">'+data.pooja+' - '+data.pooja_mal+'</option>';  
            $('#pooja_'+row_value).append(sel);
           // change_rate2(row_value);
            totalcalc();
    }
    
    function checkRowAdd(e){
       var pooja=$('#pooja_'+e).val();
       var pooja_id_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaById"; 
       $.ajax({
            type: "POST",
            url: pooja_id_fetch_url,
            data: {'pooja': pooja},
            dataType: "json",
            success: function (data) {
               
                if(data.rowcount>1){
                     addSecondRow(data);
                }
            }
        });
       
    }
    
    function add_family(fid) {
    	var bill_date=$('#bill_date').val();
        var row_value=$('#row_value').val();
        $('#dataTable2').html("");
        var html;
        var url = '<?php echo base_url();?>index.php/admin/admin/getfpoojabyfid';
    	$.ajax({
            type: "POST",
            url: url,
            data: {'fid': fid},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html += '<tr>';
        			html +='<td><select name="temple[]" id="temple_'+row_value+'" onchange="changepooja('+row_value+')" class="js-example-basic-single sq_form" required style="width: 3.2cm;">';
            		html +='<option value="'+obj.diety+'">'+obj.diety_nm+'</option>';
           			html +='</select></td>';
            		html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form" placeholder="Name" value="'+obj.name+'" required style="width: 3.2cm;" readonly></td>';
            		html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.2cm;">';
            		html +='<option value="'+obj.star+'">'+obj.star_nm+'</option>';
            		html +='</select></td>';
            		html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="select2 sq_form" required style="width: 3.2cm;">';
                	html +='<option value="'+obj.pooja+'">'+obj.pooja_nm+'</option>';
            		html +='</select></td>';
    				html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+'),checkallowedqty('+row_value+')"  onkeyup="change_rate('+row_value+'),checkallowedqty('+row_value+')" class="sq_form" placeholder="Quatity" readonly value="'+obj.nos+'"></td>';
            		html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form" placeholder="Rate" readonly value="'+obj.rate+'"></td>';
            		html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form" placeholder="Amount" readonly value="'+obj.amount+'"></td>';
            		html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form datefield" placeholder="Date" value="'+bill_date+'" onchange="checkallowedqty('+row_value+');" onclick="checkallowedqty('+row_value+');"   style="max-width: 4.2cm;"></td>';        
            		html +='<td><select name="time[]" id="time_'+row_value+'" class="js-example-basic-single sq_form" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
					html +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
           
            		html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            		html +='</tr>';
        			row_value++;
                });
                $('#dataTable2').append(html);
            	totalcalc();
            }
        });
    }
    
    function remove_file_row(obj){
    	$(obj).closest('tr').remove();
    	totalcalc()
    	return false;
    }
   
    function deleteRow(tableID) {
    	try {
    	var table = document.getElementById(tableID);
    	var rowCount = table.rows.length;

    	for(var i=0; i<rowCount; i++) {
    		var row = table.rows[i];
    		var chkbox = row.cells[0].childNodes[0];
    		if(null != chkbox && true == chkbox.checked) {
    			if(rowCount <= 1) {
    				alert("Cannot delete all the rows.");
    				break;
    			}
    			table.deleteRow(i);
    			rowCount--;
    			i--;
    		}


    	}
    	}catch(e) {
    		alert(e);
    	}
    }
    
    //for datepicker
    //
//     function checkallowedqty(e){
    
//        var url = '<?php echo base_url();?>index.php/admin/admin/getallowedqty';
//        var pooja_id = $('#pooja_'+e).val();
   
//        var date = $('#date_'+e).val();
//        var qty = $('#qlt_'+e).val();
//        $.ajax({
//             type: "POST",
//             url: url,
//             data: {'pooja_id': pooja_id,'date':date,'qty':qty},
//             success: function (data) {
//            // alert(data);
//                if(data == 1){
//                   alert('Limit Exceeded!');
//                }
//             }
//         });
//     }
    
    function test()
    {
    	$('#100').css("background-color",'red')
    }
    // document.addEventListener("keydown", function(e) {
    //     if($("#mode").is(':focus') == true){
    //        if(e.keyCode == 9){
    //            e.preventDefault();
    //            $('#100').focus().select();
    //            $('#100').css("background-color",'red')
    //        }
    //     }
    //     if($('.datefield').is(':focus') == true){
    //         if(e.keyCode == 13){
    //            e.preventDefault();
    //         }
    //     }
    // });
    
     document.addEventListener("keydown", function(e) {
		if($(':focus').length==0 && e.keyCode == 13){
            e.preventDefault();
        	$('#pooja_100').focus().select();
        } 
     	var index = 0;
     	if(e.target.classList.contains('timefield')) {
        	index = $(".timefield").index(e.target);
        }
     	if($(':focus')[0]!=$("#mode") && $(':focus')[0]!=$("#temple_100") && $(':focus')[0]!=$("#100") && $(':focus')[0]!=$(".timefield")[index] && e.keyCode == 13){
            e.preventDefault();
        }
     
        if($("#mode").is(':focus') == true){
           if(e.keyCode == 9){
               e.preventDefault();
               $('#100').focus().select();
               $('#100').css("background-color",'red')
           }
        }
    	if($("#temple_100").is(':focus') == true){
           if(e.keyCode == 13){
               e.preventDefault();
               $('#pooja_100').focus().select();
           }
        }
     
     	if($("#100").is(':focus') == true){
           if(e.keyCode == 13){
              $('#100').click()
           }
        }
    });
	document.addEventListener("keydown", function(e) {
//     	if(e.keyCode == 13){
//                e.preventDefault();
//         	 if($('.name').is(':focus') == true){
//             e.preventDefault();
//         }
    
//     	if($('.qty').is(':focus') == true){
//             e.preventDefault();
//         }
    
//     	if($('.rate').is(':focus') == true){
//             e.preventDefault();
//         }
    
//     	if($('.amount').is(':focus') == true){
//             e.preventDefault();
//         }
//         }
    	
    
//         if($("#mode").is(':focus') == true){
//            if(e.keyCode == 9){
//                e.preventDefault();
//                $('#100').focus().select();
//                $('#100').css("background-color",'red')
//            }
//         }
    
//         if($('.datefield').is(':focus') == true){
//             if(e.keyCode == 13){
//                e.preventDefault();
//             }
//         }
    
//         if($('#100').is(':focus') == true){
//             if(e.keyCode == 13){
//                e.preventDefault();
//     	       // let availabilityChecked = e.target.getAttribute('data-availability_check');
//     	       // if(!availabilityChecked)
//     		        formsubmit()
//             }
//         }
        
//         if($('#add_adjustment_item').is(':focus') == true){
//             if(e.keyCode == 13){
//                e.preventDefault();
//     	       // let availabilityChecked = e.target.getAttribute('data-availability_check');
//     	       // if(!availabilityChecked)
//     		        formsubmit()
//             }
//         }
        
        if($('.timefield').is(':focus') == true) {
            if(e.keyCode == 13){
               e.preventDefault();
               addRow()
            }
        }
    	
	});
    
$(document).ready(function(){
  $("div").removeClass("container");
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
    
// Name Autocomplete  
$(document).on('focus', '.name', function() {
  <?php if ($_SERVER['HTTP_HOST'] == 'malaysia.templesoftware.in') {?>
	 var translate_url = "<?php echo base_url(); ?>index.php/admin/billing/translatetext_tamil";	
	<?php }
	else {?>
   var translate_url = "<?php echo base_url(); ?>index.php/admin/billing/translatetext";
	<?php 
	}
	?>
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
    
    function setDevotee(data){
     console.log(data)
 	$("#search_devotee").val('')
 	$('#devotee_details').empty()
 	$('#devotee_details').append('<input type="hidden" name="customer_id" value="'+data.id+'">');
 	$('#mobile_number').val(data.mobile);
 
 	$('#devotee_details').append('<div class="mt-5">'+
        			  '<h6>Devotee Name: '+data.name+'</h6>'+
        		  '</div>');
    
	}
    
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
    
    $('#customer-add-btn').on('click', (e) => {
	        Swal.fire({
              title: 'Create Devotee',
              html: `
              <form id="myForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="house" placeholder="House" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="street" placeholder="Street" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="post" placeholder="Post" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="district" placeholder="District" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="state" placeholder="State" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="pincode" placeholder="Postal Code" class="form-control custom-input" required>
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
    </script>