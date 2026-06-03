<?php
$token = md5(uniqid(rand(), true)); // Generate a unique token
$this->session->set_userdata('form_token', $token); // Store the token in session
?>
<?php date_default_timezone_set('Asia/Kolkata');  ?>

<style type="text/css">
.pooja_row td,
.pooja_row input {
	font-weight:bold;
	font-size:1.1em;
}

.pooja_row input {
	color: #000 !important;
}

tfoot th {
	font-size:1.1em !important;
}
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

        .vertical-center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

#loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.6);
            z-index: 9999;
            text-align: center;
/*             padding-top: 20%; */
        }

	@keyframes load {
    0%{
        opacity: 0.08;
/*         font-size: 10px; */
/* 				font-weight: 400; */
				filter: blur(5px);
				letter-spacing: 3px;
        }
    100%{
/*         opacity: 1; */
/*         font-size: 12px; */
/* 				font-weight:600; */
/* 				filter: blur(0); */
        }
}

#loading-overlay .animate {
	display:flex;
	justify-content: center;
	align-items: center;
	height:50%;
	margin: auto;
/* 	width: 350px; */
/* 	font-size:26px; */
	font-family: Helvetica, sans-serif, Arial;
	animation: load 1.2s infinite 0s ease-in-out;
	animation-direction: alternate;
	text-shadow: 0 0 1px white;
}
    </style>
	<div id="loading-overlay">
    	<h4 class="animate">Processing Payment. Please wait...</h4>
    	<button class="btn btn-purple" id="btn-cancel" data-id=""> Cancel </button>
    </div>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">Billing Master ( <?php echo $username; ?> )</h4>
        </div>
         <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">
           Today's Collection : <?php echo $totalcollection; ?>
          </h4>
        </div>
    
    	<div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt text-center">
           <?php echo $counter; ?>  
          </h4>
        </div>
    
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
	<form action="<?php echo base_url(); ?>index.php/admin/admin/billing" method="post" onsubmit="return validateForm()" id="myform" class="billingForm">
    	<input type="hidden" name="token" value="<?php echo $token; ?>">
       <div class="row">
	     <div class="col-lg-6 col-md-6 col-sm-6 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
            
	        
               <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 ">
                    <div class="d-flex flex-row">
                    	<h2 class=""><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp; </h2>
                    	<h4 class="page_txt">Bill - <?php echo $last_id;?>  </h4>
                  	</div>
                  </div> 
              
               <div class="col-lg-3 col-md-3 col-sm-3">
<!--               <span id="totaltop" style=" width: 150px;
  border: 15px solid red;
  padding: 10px;
  margin:2px;color:red;"> Bill total </span> -->
               <span id="totaltop" style=" min-width: 50px; font-size:18px; font-weight:bold;
  border: 3px solid red;
  padding: 10px 15px;
  margin:2px;color:red;"> Bill total </span>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3" style="text-align:right;"><?php $today=date("Y-m-d"); ?>
                  <input type="date" class="sq_form" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $today ?>">
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
               		<select id="diety_id" class="sq_form" style="height: 40px;">
                         <option value="">Select Diety</option>
                    	 <?php foreach($temple_diety_list as $val){ ?>
                    	 <option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    	 <?php } ?>
                    </select>
               </div>
			   </div>
      			<div class="form_body">
        <div class="row">  
           <div class="col-lg-12">
               <input type="text" name="search_pooja" class="sq_form" id="searchpooja"  placeholder="Type in pooja code and press enter to search"  />
           </div>
		   <div class="col-lg-12">
              <div class="form-group">
                  
			</div>
			</div>

            <div class="col-md-4">
            	<label class="form-label">Payment Mode</label>
                <div class="form-group" style="margin-top: 7px;">
                  <select name="mode" id="mode_100" class="sq_form" required>
                          <option value="1" selected="selected">Cash</option>
                          <option value="6">QR Code</option>
                  </select>
                  
           		</div>
            </div>
        	<div class="col-md-4">
            	<label class="form-label">Cash</label>
           		<input class="sq_form" type="text" id="cash_given" placeholder="Cash" />
           </div>
           	<div class="col-md-4">
            	<label class="form-label">Change</label>
           		<input class="sq_form" type="text" id="change" placeholder="Change" disabled/>
           </div>
        </div>
        <div class="row d-none" id="billing_dtls">
        	<div class="col-md-4">
            	<label class="form-label">Customer Name</label>
           		<input class="sq_form" type="text" name="customer_name" id="customer_name" placeholder="Customer Name" />
            </div>
        	<div class="col-md-4">
            	<label class="form-label">Customer Mobile Number</label>
           		<input class="sq_form" type="text" name="mobile_number" id="mobile_number" placeholder="Customer Mobile Number" />
            </div>
           	<div class="col-md-4">
            	<label class="form-label">Customer Email</label>
           		<input class="sq_form" type="text" name="email" id="email" placeholder="Customer Email" />
            	<input class="sq_form" type="hidden" id="amount_to_pay" placeholder="Amount" />
           </div>
         </div>
         <div class="row">
            <div class="col-md-12">
            	<button type="button" class="btn pull-left" id="calculateButton" style="margin:7px 4px;background-color:cadetblue; color:white"> Calculate Amount</button>
                <div class="form-group">
                   <button type="button" class="btn submit pull-right" name="save" id="100" value="print" style="margin:7px 4px;background-color:#90EE90;"	> Save &amp; Print </button>
<!--                    <button  type="button" class="btn submit btn-warning pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button> -->
                </div>
          </div>
         
                </div>
        
      </div>
		
    </div>
         	<div class="card p-2" id="calculateBillsTotal">
         		<div class="row">
                	<div class="col-md-4">
                    	<label>Receipt From</label>
                    	<select class="sq_form" id="bill_from">
                    	</select>
                	</div>
                	<div class="col-md-4">
                    	<label>Receipt To</label>
                    	<select class="sq_form" id="bill_to">
                    	</select>
                	</div>
                	<div class="col-md-4">
                    	<label>Amount</label>
                    	<input class="sq_form" id="calculated_amount" />
                	</div>
            	</div>
         	</div>
			 <!--form-->
			</div> 
       	 <div class="col-lg-6 col-md-6 col-sm-6">
         	<div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
       <div class="row_form">
            	     <table id="dtab" class="table table-responsive-sm dataTable2">
            		    <thead>
            			   <tr>
                             <th>Pooja</th>
                			 <th>Name</th>
                           	 <th>Star</th>
                			 <th>Quantity</th>
                			 <th>Rate</th>
                			 <th>Amount</th>
                			 <th style="text-align:right;"></th>
            			</tr>
            		</thead>
            		<tbody>
                		
                	</tbody>
                	<tfoot>
                	    <tr>
                	        <th colspan="4" style="text-align:left">Total</th>
                	        <th style="text-align:left;padding:10px 25px" id="total">0</th>
                	        <th colspan="1"></th>
                	    </tr>
                	</tfoot>
            	</table>			
			  </div>
         </div>
       		</div>
          </div>
    </form>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
	
    <br>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous" defer></script> 
<script>
var flag = false;
var availabilityChecked = false;
var prevSearchValue = '';
		function setDefault() {
            $('#pooja_100').focus().select();
        }
        window.onload = setDefault;

	function getpaymentdetails(e) {
		if(e.target.value == 'bank') {
        	$('#billing_dtls').removeClass('d-none')
        } else {
        	$('#billing_dtls').addClass('d-none')
        }
	}
</script>
<script>
function storePoojaId(poojaId) {
  // Get the existing pooja IDs from localStorage or initialize an empty array
  const existingPoojaIds = JSON.parse(localStorage.getItem('poojaIds')) || [];
  console.log(existingPoojaIds)
  // Check if the pooja ID already exists in the array
  if (existingPoojaIds.includes(poojaId)) {
  	
  	return true;
  } else {
    // Add the new pooja ID to the array
    existingPoojaIds.push(poojaId);

    // Store the updated array in localStorage
    localStorage.setItem('poojaIds', JSON.stringify(existingPoojaIds));

    return false;
  }
}
</script>
<script>
    const checkPoojaAvailability = (pooja_id, date, qty) => {

    return new Promise((resolve, reject) => {
       $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/admin/admin/check_pooja_availability",
            data: {'pooja_id': pooja_id,'date':date, 'qty': qty},
            success: function (response) {
               let pooja_date = new Date(date)
               let year = pooja_date.getFullYear()
               let month = pooja_date.getMonth()
               let day = pooja_date.getDate()
               
               let format2 = day + "/" + month + "/" + year;
            	console.log(response)
               let data = JSON.parse(response)
            
               if(data.exists && data.exists == 1){
               	console.log(data.qty);
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
    
	
     const calculateSumOfBills = (from, to) => {
     	$.ajax({
           type: 'POST',
           url: '<?php echo base_url(); ?>index.php/admin/billing/calculate_bill_sum',
           dataType: "json",
           data: {
           		from: from,
           		to: to
           },
           success: function(data) {
           		console.log(data);
           		$('#calculated_amount').val(data)
           }
        });
     }
     $.noConflict();
    	
     jQuery( document ).ready(function( $ ) {
     	  localStorage.removeItem('poojaIds');
     	  $('.submit').attr('type', 'button');
     	  $('#calculateBillsTotal').hide();
     	  $('#bill_from').empty()
     	  $('#bill_to').empty()
     	  $('#calculated_amount').val()
     
     	  $.ajax({
           type: 'GET',
           url: '<?php echo base_url(); ?>index.php/admin/billing/last_bills',
           dataType: "json",
           success: function(data) {
           		 data.forEach(function(element){
    				$('#bill_from').append('<option value="'+element.receipt_no+'">Receipt-'+element.receipt_no+'</option>');
                 	$('#bill_to').append('<option value="'+element.receipt_no+'">Receipt-'+element.receipt_no+'</option>');
				 });
                 let start_id = $('#bill_from').val();
     	  		 let end_id = $('#bill_to').val();
     	  		 calculateSumOfBills(start_id, end_id)
           }
        });
          $('#cash_given').on('input', (e) => {
          	 let total = $('#total').text()
             let cash  = e.target.value
             let change = cash - total;
          	 change = change > 0 ? change : 0
          	 $('#change').val(change)
          });
         window.onload = (event) => {
             $( "#searchpooja" ).focus().select();
         	 // location.reload(true);
         };
     
     	 document.addEventListener('DOMContentLoaded', function () {
    		$( "#searchpooja" ).focus().select();
         	location.reload(true);
		});

         // $( ".submit" ).click(function() {
         //    $('#global-loader').css('display', 'block');
         // });
         
         var diety = $('#diety_id').val();
         
         //var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaByCodeNameDiety";
         // $( "#searchpooja" ).keyup(function() {
         //     setTimeout(() => { searchPooja(); }, 1500);
         // });
        
         // $('#searchpooja').autocomplete({
         //     source: function(request, response) {
         //        $.ajax({
         //           url:pooja_fetch_url,
         //           type: 'post',
         //           dataType: "json",
         //           data:{ 
         //              search:request.term,
         //              diety:$('#diety_id').val(),
         //           },
         //           success: function( data ) {
         //              if(data.length > 1){
         //                 response(data); 
         //              }
         //              else{
         //                 createrow(data);
         //              }
         //           }                   
         //        });
         //     },
         //     select: function(event, ui) {
         //        var data = ui.item.value;
         //        poojaSearch(data);
         //     }
         // });
     
     	 
         $("#dtab").on('input', '.qty', function(e) {
             var rowindex = $(this).closest('tr').index();
         	 var $row     = $(this).closest('tr');
         	 let pooja_id = $(this).closest('tr').find('.pooja_id').val();
         	 let quantity = e.target.value;
         	
         	 calculateRowPoojaData(rowindex);
         
         	 $.ajax({
         		url:'<?php echo base_url(); ?>index.php/admin/billing/checkPoojaAvailabilityByQty',
         		type: 'post',
         		dataType: "json",
         		data:{ 
         			pooja_id: pooja_id,
         			quantity: quantity,
         		},
         		success: function( data ) {
         			if(data.status == 'not-available') {
                    	$row.find('.qty').val(data.pooja_count)
                    	calculateRowPoojaData(rowindex);
         				alert('Pooja is not available! Please choose a quantity less than or equal to '+data.pooja_count)
         			}
         		}                   
         	});
            
         }); 
     
     	 $('#calculateButton').on('click', () => {
         	$('#calculateBillsTotal').toggle();
         });
     
     	 $('#bill_from').on('change', () => {
         	let bill_from = $('#bill_from').val()
            let bill_to= $('#bill_to').val()
         	calculateSumOfBills(bill_from, bill_to)
         })
     
     	 $('#bill_to').on('change', () => {
         	let bill_from = $('#bill_from').val()
            let bill_to= $('#bill_to').val()
         	calculateSumOfBills(bill_from, bill_to)
         })
     
     
   });
   
	function cancelRS() {
    	let data = document.getElementById('btn-cancel').getAttribute('data-id')
        
    	$.ajax({
              url:'<?php echo base_url(); ?>index.php/admin/billing/cancelRS',
              type: 'post',
              dataType: "json",
              data:{ 
              	   data: data,
              },
              success: function( response ) {
              		if(response) {
               			$('#loading-overlay').hide();
                    }
              }                   
         });
    }

    $('#btn-cancel').on('click', () => {
    	cancelRS()
    });

	function serializeForm(form) {
            var formData = {};
            var formElements = form.elements;

            for (var i = 0; i < formElements.length; i++) {
                var element = formElements[i];
                if (element.name) {
                    if (element.name.endsWith("[]")) {
                        // Handle array fields
                        var fieldName = element.name.slice(0, -2); // Remove the "[]" suffix
                        if (!formData[fieldName]) {
                            formData[fieldName] = [];
                        }
                        formData[fieldName].push(element.value);
                    } else {
                        formData[element.name] = element.value;
                    }
                }
            }

            return formData;
    }

    function checkRS(data) {
		var form = $(".billingForm")[0];
		if (form) {
    		// var formData = new FormData(form);
    		var formData = serializeForm(form);
		} else {
    		console.error("Form not found");
		}
    
    	var interval = setInterval(function() {
            $.ajax({
              url:'<?php echo base_url(); ?>index.php/admin/billing/checkRS',
              type: 'post',
              dataType: "json",
              data:{ 
              	   data: data,
              	   formData: formData
              },
              success: function( response ) {
              		console.log(response);
               		if(response.status == 'expired' || response.status == 'cancelled') {
                    	clearInterval(interval);
        				$('#loading-overlay').hide();
                    	
                    	if(response.status == 'cancelled') {
                        	alert('Transaction has been cancelled');
                        }
                    } else if(response.status == 'success') {
                    	clearInterval(interval);
                    	$('#loading-overlay').hide();
                    	window.location.href = '<?php echo base_url(); ?>index.php/admin/admin/bill_print/'+response.bill_id
                    }
              		
              }                   
         });
        }, 10000); // 10 seconds interval

        // Stop the interval after 150 seconds
        setTimeout(function() {
            clearInterval(interval);
        	cancelRS()
        	$('#loading-overlay').hide();
        }, 150000);
    }

	function initializeR() {
    	$.ajax({
              url:'<?php echo base_url(); ?>index.php/admin/billing/initializeR',
              type: 'post',
              dataType: "json",
              data:{ 
              	   name: $('#customer_name').val(),
              	   mobile_number: $('#mobile_number').val(),
              	   email: $('#email').val(),
                   amount: $('#amount_to_pay').val(),
              },
              success: function( data ) {
              		if(data) {
                    	$('#loading-overlay').show();
              			$('#btn-cancel').attr('data-id', data) 
               			checkRS(data)
                    } else {
                    	$('#loading-overlay').hide();
                    }
              }                   
          });
    }


    function submitFormFn() {
    	var promises = [];
    	
        $('#dtab tr').each((i, e) => {
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
      	let mode = $('#mode').val()
        
        if(mode == 'bank') {
        	$('#loading-overlay').show();
        	let payment_gateway = $('#payment_gateway').val()
            
        	if (payment_gateway == 'razorpay') {
            	initializeR()
            }
        	
        } else {
        	$('button.submit').attr('type', 'submit');
      		$('button.submit').attr('data-availability_check', true);
      		$('button.submit').trigger('click');
        }
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
    
    
   function searchStar(e){
        var star_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getstarByCodeDiety"; 
         $.ajax({
              url:star_fetch_url,
              type: 'post',
              dataType: "json",
              data:{ 
                   search:$(e).find('.star').val(),
              },
              success: function( data ) {
                $(e).find('.star').val(data.star);
                $(e).find('.star_id').val(data.id);
                $(e).find('.qty').focus().select();
              }                   
         });
    } 

   var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaByCodeDiety"; 
   function searchPooja(){
         $.ajax({
              url:pooja_fetch_url,
              type: 'post',
              dataType: "json",
              data:{ 
                   search:$( "#searchpooja" ).val(),
                   diety:$('#diety_id').val(),
              },
              success: function( data ) {
              		createrow(data);
              		// if(data.status == 'found') {
              		// createrow(data);
              		// } else if(data.status == 'not-found') {
              		// alert('No pooja found!')
              		// } else if(data.status == 'not-available') {
              		// alert('Pooja is not available!')
              		// }
              }                   
         });
    } 
    
    // Show pooja in the search bar
    function showSearchedPooja(keyword){
         $.ajax({
              url:pooja_fetch_url,
              type: 'post',
              dataType: "json",
              data:{ 
                   search:keyword,
                   diety:$('#diety_id').val(),
              },
              success: function( data ) {
              		$( "#searchpooja" ).val(data.pooja)
              }                   
         });
    } 
   function poojaSearch(data){
        var pooja_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaByDietyPoojaCode";
        $.ajax({
           type: 'GET',
           url: pooja_url,
           dataType: "json",
           data: {
                data: data
           },
           success: function(data) {
                 createrow(data);
           }
        });
   }
   function createrow(data){
   		 let is_present = storePoojaId(data.pooja_id)
         
		 if(!is_present) {
         var flag = 1;
         if(data.rowcount>1){
            createsecondrow(data);
         }

         var bill_date=$('#bill_date').val();
         var starcode =' <?php echo $site[0]['starcode'];?>';
         var name = $('table.dataTable2 tbody tr:nth-child(1)').find('.name').val();
         var star = $('table.dataTable2 tbody tr:nth-child(1)').find('.star').val();
         name = (typeof name === 'undefined') ? '*' : name;
         star = (typeof star === 'undefined') ? '28' : star;
         console.log(data.diety)
         var toggleamtreadonly = (data.diety!=9000 && data.diety!=8) ? 'readonly' : '';
         var newRow = $('<tr class="pooja_row">');
         var cols = '';
         cols += '<td>' + data.pooja + '<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code pooja_id" type="hidden" required/>'; 
         cols += '<input type="hidden" name="temple[]" value="'+data.diety+'" /></td>';
         cols += '<td><input class="sq_form name"  name="name[]"  value="'+ name +'" type="text" style="width: 120px;" required/></td>';
		 cols += '<td><input class="sq_form star"  name="star[]"  value="1" type="text" style="width: 120;" required/> <input class="sq_form star_id"  name="star_id[]" type="hidden" /> </td>';
         cols += '<td><input class="sq_form qty"  name="qlt[]"  value="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
         cols += '<td><input readonly class="sq_form rate" name="rate[]" value="' + data.rate + '"  style="width: 60px;" required/></td>';
         cols += '<td><input  class="sq_form amt" name="amt[]" value="0.00" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
         cols +='<td><input type="hidden" name="date1[]" class="sq_form datefield" value="'+bill_date+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
         cols +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
         cols +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
         newRow.append(cols);
         $("table.dataTable2 tbody").prepend(newRow);
         rowindex = newRow.index();
         calculateRowPoojaData(rowindex);
         $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
         var obj = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty');
         obj.val(obj.val());
         obj.focus().select();
        // }
        // 
        $('.name').on('input', function() {
   var translate_url = "<?php echo base_url(); ?>index.php/admin/Billing/translatetext";
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
        $('.sq_form.datefield').on('change', (e) => {
    	var $row = $(e.target).closest('tr'); // Get the closest row element
    	var pooja_id = $row.find('.pooja_id').val();
    	var date = e.target.value;
   		var qty = $row.find('.qty').val();
    	checkPoojaAvailability(pooja_id, date, qty)
    });
   } 
   }
    function createsecondrow(data){
        if(data.rowcount>1){
            var bill_date=$('#bill_date').val();
            var starcode =' <?php echo $site[0]['starcode'];?>';
            var name = $('table.dataTable2 tbody tr:nth-child(1)').find('.name').val();
            var star = $('table.dataTable2 tbody tr:nth-child(1)').find('.star').val();
            name = (typeof name === 'undefined') ? '*' : name;
            star = (typeof star === 'undefined') ? '28' : star;
            var toggleamtreadonly = (data.diety!='9000' && data.diety!='8') ? 'readonly' : '';
            var newRow = $("<tr>");
            var cols = '';
            cols += '<td>' + data.pooja + '<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code" type="hidden" required/>'; 
            cols += '<input type="hidden" name="temple[]" value="'+data.diety+'" /></td>';
            cols += '<td><input class="sq_form name"  name="name[]"  value="'+ name +'" type="text" style="width: 120px;" required/></td>';
        	cols += '<td><input class="sq_form star"  name="star[]"  value="'+ star +'" type="text" style="width: 120px;" required/></td>';
			cols += '<td><input class="sq_form star_id"  name="star_id[]"  value="" type="hidden" /></td>';
            cols += '<td><input class="sq_form qty"  name="qlt[]"  value="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
            cols += '<td><input readonly class="sq_form rate" name="rate[]" value="0"  style="width: 60px;" required/></td>';
            cols += '<td><input  class="sq_form amt" name="amt[]" value="0.00" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
            cols +='<td><input type="date" name="date1[]" class="sq_form datefield" value="'+bill_date+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
            cols +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
            cols +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
            cols +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            newRow.append(cols);
            $("table.dataTable2 tbody").prepend(newRow);
            rowindex = newRow.index();
            calculateRowPoojaData(rowindex);
            $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
            var obj = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.name');
            obj.val(obj.val());
            obj.focus().select();
        }
   }
   function calculateRowPoojaData(rowindex) {
        var qty = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
        var rate = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.rate').val();
        var amt = parseFloat(qty) * parseFloat(rate);    
        $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.amt').val(amt);
        calcGrandTotal();
   }
   function calcGrandTotal(){
       var grandTotal = 0;
       $(".amt").each(function() {
           grandTotal += parseFloat($(this).val());
       });
       $('#total').text(grandTotal);
   	   $('#amount_to_pay').val(grandTotal)
       $('#totaltop').text(grandTotal);
    $('#searchpooja').val("");
   }
     
   document.addEventListener("keydown", function(e) {
       if(e.keyCode == 13) {
              e.preventDefault();
              if($("#searchpooja").is(':focus') == true){
                  searchPooja();
              }
              if($("#dtab .name").is(':focus') == true){
                  var rowindex = $("#dtab .name").closest('tr').index();
                  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').focus().select();
                  return false;
              }
              if($("#dtab .star").is(':focus') == true){
                  var rowindex = $("#dtab .star").closest('tr').index();
                  var star =  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val();
                  var starcode = '<?php echo $site[0]['starcode'];?>';
                  var  rowind= $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')');
                  searchStar(rowind);
              }
              if($("#dtab .qty").is(':focus') == true){
                  $('#searchpooja').focus().select();
                  return false;
              }
              return false;
        }
        else if(e.keyCode == 9){
            e.preventDefault();
            if($("#mode").is(':focus') == true){
               $('#cash_given').focus().select();
               // $('#cash_given').css("background-color",'red')
            } else if($("#cash_given").is(':focus') == true){
               $('#100').focus().select();
               $('#100').css("background-color",'red')
            }
            else{
               $('#mode').focus().select();
               $('#100').css("background-color",'#90EE90')
            }
        }
        if ( e.keyCode == 36 ) {
             e.preventDefault();
             $("#myform").submit();
             $('#global-loader').css('display', 'block');
        }
        else if( e.keyCode == 107) {
             e.preventDefault();
             $('#100').click();
             $('#global-loader').css('display', 'block');
        }
        
    }, false); 
    


    
    
    function remove_file_row(obj){
    	let pooja_id = $(obj).closest('tr').find('.pooja_id').val();
    
    	const existingPoojaIds = JSON.parse(localStorage.getItem('poojaIds')) || [];

  		// Check if the pooja ID already exists in the array
  		if (existingPoojaIds.includes(pooja_id)) {
			// Add the new pooja ID to the array
    		existingPoojaIds.splice(existingPoojaIds.indexOf(pooja_id), 1);

    		// Store the updated array in localStorage
    		localStorage.setItem('poojaIds', JSON.stringify(existingPoojaIds));
  		}
    
    	$(obj).closest('tr').remove();
    	calcGrandTotal();
    	return false;
    }
    
    document.addEventListener("DOMContentLoaded", function() {
    	
    	// let searchBar = document.activeElement;
    	// $(document.activeElement).select();
    	setTimeout(function() {
                 console.log("here");
    		     $("#searchpooja").focus().select();
    	   }, 1000);
    	// searchBar.setSelectionRange(0, searchBar.value.length);
    	
	});
    
    
    $(document).on('input', '#searchpooja', (e) => {
//     	const currentSearchValue = e.target.value;
//     	if (currentSearchValue.length >= 1 && currentSearchValue !== prevSearchValue) {
//         	setTimeout(function() {
//   				showSearchedPooja(currentSearchValue)
// 			}, 800);
    		
//         } 

// 		prevSearchValue = currentSearchValue;
    })
    
   
    </script>