<?php
$token = md5(uniqid(rand(), true)); // Generate a unique token
$this->session->set_userdata('form_token', $token); // Store the token in session
?>
<?php date_default_timezone_set('Asia/Kolkata');  ?>
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
    <div class="page-header mb-2">
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">Billing Master</h4>
        </div>
         <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">
             Today's Collection : <?php echo $totalcollection; ?>
         </h4>
        </div>


        
        <!-- <div class="col-lg-2">
               <input type="text" name="search_bill" class="sq_form" id="searchbill" placeholder="Search bill no" />
        </div>
        <div>    <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Search</a>
          </ul></div> onsubmit="return validateForm()"-->
          <div class="col-lg-2">
          <form action="<?php echo base_url('index.php/admin/admin/search_bill')?>" method="POST">
	<input type="text" for = "billid" class="sq_form" id="billid" name="bill_no" placeholder="Search bill no"/></div>
    <div><ul class="btn_ul" style="float:right;">
	<input class="btn btn-primary" type="submit" value="search" /></ul></div>
 
</form>





        <div class="col-lg-3 col-md-2 col-sm-2 ">
          <ul class="list-inline" style="float:right;">
            <li class="list-inline-item"> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a>
          	<li class="list-inline-item"> <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-primary">Family Pooja</a> </li>
          </ul>
        </div>
    </div>
	
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
                    <div class="card bg-plain py-3 m-0">
                        <h5 class="page_txt text-center my-auto" style="color:red;font-weight:bold;"> <?php print_r($availability['pooja']); ?>: <?php print_r($availability['quantity']); ?> </h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?> 
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/billing" method="post"  id="myform">
            	<input type="hidden" name="token" value="<?php echo $token; ?>">
               <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $last_id;?> </h2>
                </div> 
              
               <div class="col-lg-3 col-md-3 col-sm-3">
              <span id="totaltop" style=" width: 150px;
                border: 15px solid red;
                padding: 10px;
                margin:2px;color:red;"> Bill total </span>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3" style="text-align:right;"><?php $today=date("Y-m-d"); ?>
                  <input type="date" class="sq_form" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>"  value="<?php echo $today ?>">
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
               <input type="text" name="search_pooja" class="sq_form" id="searchpooja" placeholder="Type in pooja code and press enter to search" autofocus="autofocus"  />
           </div>
		   <div class="col-lg-12">
              <div class="form-group">
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
                             <th>Pooja Date</th>
                			 <th>Time</th>
                			 <th style="text-align:right;"></th>
            			</tr>
            		</thead>
            		<tbody>
                		
                	</tbody>
                	<tfoot>
                	    <tr>
                	        <th colspan="7" style="text-align:left">Total</th>
                	        <th style="text-align:left;padding:10px 25px" id="total">0</th>
                	        <th colspan="2"></th>
                	    </tr>
                	</tfoot>
            	</table>			
			  </div>
			</div>
			</div>
        </div>
      <div class="row mt-4">
           <div class="col-md-3">
           		<label class="fw-bold"> <strong> Payment Mode </strong> </label>
                <div class="form-group" >
<!--                 <select name="mode" id="mode_100" class="sq_form" required>
                           
                         <?php foreach($mode as $val){ ?>
                        <option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>
                      <?php } ?>
                    		
                    			</select> -->
                	
                 <select id="mode" name="mode" class="form-control" required onchange="openpaydetails()" >
                          <option value="">Select Mode</option>
                 		  <?php foreach($payment_modes as $mode): ?>
                 		  <option value="<?php echo $mode['id']; ?>" <?php if($mode['slug'] == 'cash') echo 'selected'; ?>><?php echo $mode['name']; ?></option>
                 		  <?php endforeach; ?>
                  </select>
           		</div>
            </div>
        	<div class="col-md-3">
            	<label class="fw-bold"> <strong> Remarks </strong> </label>
            	<textarea class="form-control" id="remarks" placeholder="Remarks" name="remarks" rows="1"></textarea>
			</div>
        	<div class="col-md-3">
            	<label class="fw-bold"> <strong> Received Amount </strong> </label>
            	<input class="form-control" id="received_amount" placeholder="Received Amount" name="received_amount" />
			</div>
        	<div class="col-md-3">
            	<label class="fw-bold"> <strong> Change </strong> </label>
            	<input class="form-control" id="balance_amount" placeholder="Change" name="balance_amount" />
			</div>
      </div>
      <div class="row">
            <div class="col-md-12">
            	<input type="hidden" name="save_type" id="save_type" value="save" />
                <div class="form-group">
                	<button type="submit" class="btn pull-right d-none"  name="save" id="add_adjustment_item" value="add_item" style="margin:7px 4px;background-color:#90EE90;" > Add Item </button>
                   	<button type="button" class="btn submit pull-right" name="save" id="100" value="print" style="margin:7px 4px;background-color:#90EE90;" > Save &amp; Print </button>
                  	<button  type="button" class="btn submit btn-warning pull-right" name="save" value="a6_print" id="a6_print_btn" style="margin:7px 4px;"> A6 Print </button>
                </div>
          </div>
         
                </div>
        
      </div>
		</form>
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
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
    <script type="text/javascript">
     $.noConflict();
     var flag = false;
    var availabilityChecked = false;
    
    // Check pooja_availability
    const checkPoojaAvailability = (pooja_id, date, qty, is_submit) => {
        return new Promise((resolve, reject) => {
           $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/admin/admin/poojaAvailabilityCheck",
                data: {'pooja_id': pooja_id,'date':date, 'qty': qty, 'is_submit': is_submit},
                success: function (response) {
                   let pooja_date = new Date(date)
                   let year = pooja_date.getFullYear()
                   let month = pooja_date.getMonth()
                   let day = pooja_date.getDate()
                   
                   let format2 = day + "/" + month + "/" + year;
                	console.log(response)
                   let data = JSON.parse(response)
                
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
    
    function submitFormFn(submitBtnId) {
    	var promises = [];
    	
        $('#dtab tbody tr').each((i, e) => {
        	var $row = $(e)

        	var pooja_id = $row.find('.pooja_code').val();
        	var date = $row.find('input.pdate').val();
        	var qty = $row.find('.qty').val();
        	
			var promise = checkPoojaAvailability(pooja_id, date, qty, 1);
        	promises.push(promise);
        });
   
   		Promise.all(promises)
            .then(results => {
              var flag = results.every(result => result === true);
              if (flag == true) {
              	$('button.submit#'+submitBtnId).attr('type', 'submit');
              	$('button.submit#'+submitBtnId).attr('data-availability_check', true);
              	$('button.submit#'+submitBtnId).trigger('click');
              } 
            })
            .catch(error => {
              console.error(error);
            });
    }
    
    $('button.submit').on('click', (e) => {
         let count = $("table#dtab tbody tr").length;
         if(count > 0) {
         	let saveType = e.target.value
            let submitBtnId = e.target.getAttribute('id')
            console.log(submitBtnId)
            $('#save_type').val(saveType);
         
        	let availabilityChecked = e.target.getAttribute('data-availability_check');
        	if(!availabilityChecked)
        		submitFormFn(submitBtnId)
         } else {
             Swal.fire('Please select atleast one Pooja.')
         }
    	
    })
    function disableKeys(event) {
        // Prevent default behavior for all keys
        event.preventDefault();
        return false;
    }
    
    // Function to handle beforeunload event
    function handleBeforeUnload(event) {
        // Cancel the event
        event.preventDefault();
        // Prompt user to stay on the page
        event.returnValue = 'Are you sure you want to leave this page?';
    }
    
    function handleSubmission() {
        window.addEventListener('keydown', disableKeys);
        // window.addEventListener('beforeunload', handleBeforeUnload);
        var submitButton = $('.submit');
        submitButton.disabled = true;
        submitButton.value = 'Submitting...';
    	$('#global-loader').css('display', 'block');
    }
            
    $('#myform').on('submit', () => {
        handleSubmission()
    })
    
    
     jQuery( document ).ready(function( $ ) {
      var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaByCodeNameDietyforbilling";
       $('#searchpooja').autocomplete({
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
                   		console.log(data)
                   }
                });
             },
       		 open: function(event, ui) {
            	var $menu = $(this).autocomplete("widget");
        		var $firstItem = $menu.find(".ui-menu-item:first");
        		$menu.menu("focus", null, $firstItem);
        		$firstItem.addClass('ui-state-active');
             
             	$menu.on("menufocus", function(event, ui) {
        			if (ui.item[0] !== $firstItem[0]) {
            			$firstItem.removeClass('ui-state-active');
        			}
    			});
        	},
             select: function(event, ui) {
                var id = ui.item.id;
                poojaSearch(id)
             }
         })
          
        $( document ).ready(function() {
            setTimeout(function() {
    		     $("#searchpooja").focus().select();
    	   }, 1000);
        	
        	
        	
           //  $( "#searchpooja" ).focus().select();
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
     
         $("#dtab").on('input', '.qty', function() {
             var rowindex = $(this).closest('tr').index();
         	 var pooja_id = $(this).closest('tr').find('.pooja_code').val();
        	 var date = $(this).closest('tr').find('input.pdate').val();
        	 var qty = $(this).closest('tr').find('.qty').val();
			 var promise = checkPoojaAvailability(pooja_id, date, qty, 0);
             calculateRowPoojaData(rowindex);
         }); 
     
     	 $("#dtab").on('change', '.pdate', function() {
             var rowindex = $(this).closest('tr').index();
         	 var pooja_id = $(this).closest('tr').find('.pooja_code').val();
        	 var date = $(this).closest('tr').find('input.pdate').val();
        	 var qty = $(this).closest('tr').find('.qty').val();
			 var promise = checkPoojaAvailability(pooja_id, date, qty, 0);
             // calculateRowPoojaData(rowindex);
         }); 
     
     	$("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
    
   });
   
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
                	html +='<td>' + obj.pooja_nm + '<input name="pooja[]" value="' + obj.pooja + '" class="pooja_code" type="hidden" required/>';
                	html +='<input type="hidden" class="temple" name="temple[]" value="'+obj.diety+'" /></td>';
            		html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form" placeholder="Name" value="'+obj.name+'" required style="width: 3.2cm;" readonly></td>';
            		html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form star" required style="width: 3.2cm;">';
            		html +='<option value="'+obj.star+'">'+obj.star_nm+'</option>';
            		html +='</select></td>';
    				html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+'),checkallowedqty('+row_value+')"  onkeyup="change_rate('+row_value+'),checkallowedqty('+row_value+')" class="sq_form qty" placeholder="Quatity" readonly value="'+obj.nos+'"></td>';
            		html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form rate" placeholder="Rate" readonly value="'+obj.rate+'"></td>';
            		html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form amt" placeholder="Amount" readonly value="'+obj.amount+'"></td>';
            		html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form datefield" placeholder="Date" value="'+bill_date+'" onchange="checkallowedqty('+row_value+');" onclick="checkallowedqty('+row_value+');"   style="max-width: 4.2cm;"></td>';        
            		html +='<td><select name="time[]" id="time_'+row_value+'" class="js-example-basic-single sq_form" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
					html +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
           
            		html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            		html +='</tr>';
        			row_value++;
                	
                });
                $("table.dataTable2 tbody").prepend(html);
            	$(".star").select2()
            	calcGrandTotal();
            }
        });
    }
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

   var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaByNameDiety"; 
   function searchPooja1(){
  // alert("o");
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
              }                   
         });
    } 
    
   function poojaSearch(id, post_data=null, index=null){
   
        var pooja_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaById";
        $.ajax({
           type: 'POST',
           url: pooja_url,
           dataType: "json",
           data: {
                pooja: id
           },
           success: function(data) {
           		if(post_data) {
           			createPreviousRow(data, post_data, index)
           		} else {
           			createrow(data);
           		}
           		
                let diety = data.diety ?? $('#diety_id').val();
                if(diety == '102' || diety == '103') {
                        $('#add_adjustment_item').removeClass('d-none');
                        $('#100').addClass('d-none');
                } else {
                        $('#add_adjustment_item').addClass('d-none');
                        $('#100').removeClass('d-none');
                }
           }
        });
   }
    
    function createPreviousRow(data, post_data, index) {
         var flag = 1;
         if(data.rowcount>1){
            createsecondrow(data);
         }

         var bill_date=$('#bill_date').val();
         var starcode =' <?php echo $site[0]['starcode'];?>';
         var name = post_data.name[index];
         var star = post_data.star[index];
   		 var star_id = $('table.dataTable2 tbody tr:nth-child(1)').find('.star_id').val();
         name = (typeof name === 'undefined') ? '*' : name;
         star = (typeof star === 'undefined') ? '28' : star;
         var toggleamtreadonly = (data.diety!='8' && data.diety!='9000' && data.diety!='102' && data.diety!='18') ? 'readonly' : '';
    	 var rate_readonly = (data.diety=='102') ? '' : 'readonly';
		 
         var newRow = $("<tr>");
         var cols = '';
         cols += '<td>' + data.pooja + '('+data.pooja_mal+')<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code" type="hidden" required/>'; 
         cols += '<input type="hidden" class="temple" name="temple[]" value="'+data.diety+'" /></td>';
         cols += '<td><input class="sq_form name"  name="name[]"  value="'+ post_data.name[index] +'" type="text" style="width: 120px;" required/></td>';
         if(starcode==1){
         	console.log('starcode')
            cols += '<td><input class="sq_form star" value="" type="text" style="width: 3.2cm;" required/>';
            cols += '<input class="sq_form star_id" name="star[]" value="'+post_data.star[index]+'" type="hidden" style="width: 3.2cm;" required/></td>';
         } else{
         	console.log('starlist')
            cols +='<td><select name="star[]"  class="sq_form star select2" required style="width: 3.2cm;"><option value="0">Select Star</option>';
            <?php foreach($birth_star as $val){ ?>
            cols +='<option <?= ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";}?><?= $val['id'].' | '.$val['name_eng']." - ".$val['name_mal']; ?></option>';
            <?php } ?>
         }
         cols += '<td><input class="sq_form qty w-100"  name="qlt[]"  value="'+post_data.qlt[index]+'" type="number" style="width: 60px;" required/></td>';
         cols += '<td><input class="sq_form rate w-100" name="rate[]" value="' + data.rate + '"  style="width: 60px;" required  '+rate_readonly+'/></td>';
         cols += '<td><input  class="sq_form amt w-100" name="amt[]" value="'+post_data.amt[index]+'" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
         cols +='<td><input type="date" name="date1[]" class="sq_form pdate" value="'+post_data.date1[index]+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
         cols +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form time" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="'+ post_data.time[index] + ' ">' + data.time + '</option><option value="M">M</option><option value="E">E</option>';
        //  cols +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
          cols +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';

         newRow.append(cols);
         $("table.dataTable2 tbody").prepend(newRow);
         rowindex = newRow.index();
         calculateRowPoojaData(rowindex);
   		 // $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
   		 // $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star_id').val(star_id);
   		 // if (starcode != 1) {
   		 // 	$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').select2();
   		 // $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').trigger('change');
   		 // }
   		 
		 $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').select2();

		 // Set the value of the select element
		 $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
		 $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star_id').val(star);
		 // Trigger the change event on the select element
		 $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').trigger('change');

    
         $('.qty').on('input', function() {  this.value = this.value.replace(/[^0-9.]/g, '');});
   
   		// $("#dtab .star").each((i, e) => {
   		// var rowindex = $(e).closest('tr').index();
   		// var star 	 = $(e).val();
   		// var rowind   = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')');
   		// searchStar(rowind);
   		// })
        // }
   }
    
   function createrow(data){
  
         var flag = 1;
         if(data.rowcount>1){
            createsecondrow(data);
         }
         // $(".pooja_code").each(function(i) {
         //      if ($(this).val() == data.pooja_id) {
         //             rowindex = i;
         //             flag = 0;
         //      }
         // });
         // $("input[name='search_pooja']").val('');
         // if(flag){
         var bill_date=$('#bill_date').val();
         var starcode =' <?php echo $site[0]['starcode'];?>';
         var name = $('table.dataTable2 tbody tr:nth-child(1)').find('.name').val();
         var star = $('table.dataTable2 tbody tr:nth-child(1)').find('.star').val();
   		 var star_id = $('table.dataTable2 tbody tr:nth-child(1)').find('.star_id').val();
         name = (typeof name === 'undefined') ? '*' : name;
         star = (typeof star === 'undefined') ? '28' : star;

         var toggleamtreadonly = (data.diety!='8' && data.diety!='9000' && data.diety!='102' && data.diety!='18') ? 'readonly' : '';
    	 var rate_readonly = (data.diety=='102') ? '' : 'readonly';
		 
         var newRow = $("<tr>");
         var cols = '';
         cols += '<td>' + data.pooja + '('+data.pooja_mal+')<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code" type="hidden" required/>'; 
         cols += '<input type="hidden" class="temple" name="temple[]" value="'+data.diety+'" /></td>';
         cols += '<td><input class="sq_form name"  name="name[]"  value="'+ name +'" type="text" style="width: 120px;" required/></td>';
         if(starcode==1){
            cols += '<td><input class="sq_form star" value="" type="text" style="width: 3.2cm;" required/>';
            cols += '<input class="sq_form star_id" name="star[]" value="" type="hidden" style="width: 3.2cm;" required/></td>';
         }else{
            cols +='<td><select name="star[]"  class="sq_form select2 star" required style="width: 3.2cm;"><option value="28">nodata</option>';
            <?php foreach($birth_star as $val){ ?>
            cols +='<option <?php echo ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";}?><?= $val['name_eng']." - ".$val['name_mal']." ( ".$val['id']." ) "; ?></option>';
            <?php } ?>
         }
         cols += '<td><input class="sq_form qty w-100"  name="qlt[]"  value="1" type="number" style="width: 60px;" required/></td>';
         cols += '<td><input class="sq_form rate w-100" name="rate[]" value="' + data.rate + '"  style="width: 60px;" required  '+rate_readonly+'/></td>';
         cols += '<td><input  class="sq_form amt w-100" name="amt[]" value="0.00" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
         cols +='<td><input type="date" name="date1[]" class="sq_form pdate" value="'+bill_date+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
         cols +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form time" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="'+ data.time + ' ">' + data.time + '</option><option value="M">M</option><option value="E">E</option>';
        //  cols +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
          cols +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';

         newRow.append(cols);
         $("table.dataTable2 tbody").prepend(newRow);
         rowindex = newRow.index();
         calculateRowPoojaData(rowindex);
         $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
   		 $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star_id').val(star_id);
   		 if (starcode != 1) {
   		 	$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').select2();
         }
         var obj = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.name');
         obj.val(obj.val());
         obj.focus().select();
         $('.qty').on('input', function() {  this.value = this.value.replace(/[^0-9.]/g, '');});
   
   		 // Commented on 2024-08-26
   		 // $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
   		 // $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star_id').val(star_id);
   		 // if (starcode != 1) {
   		 // 	// $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').select2();
   		 // }
   		 // var obj = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.name');
   		 // obj.val(obj.val());
   		 // obj.focus().select();
   		 // Commented on 2024-08-26

   		// $("#dtab .star").each((i, e) => {
   		// var rowindex = $(e).closest('tr').index();
   		// var star 	 = $(e).val();
   		// var rowind   = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')');
   		// searchStar(rowind);
   		// })
        // }
   }
    
    function createsecondrow(data){
        if(data.rowcount>1){
            var bill_date=$('#bill_date').val();
            var starcode =' <?php echo $site[0]['starcode'];?>';
            var name = $('table.dataTable2 tbody tr:nth-child(1)').find('.name').val();
            var star = $('table.dataTable2 tbody tr:nth-child(1)').find('.star').val();
            name = (typeof name === 'undefined') ? '*' : name;
            star = (typeof star === 'undefined') ? '28' : star;
 
            var toggleamtreadonly = (data.diety!='9000' && data.diety!='102' && data.diety!='18') ? 'readonly' : '';
        	var rate_readonly = (data.diety!='102') ? 'readonly' : '';
            var newRow = $("<tr>");
            var cols = '';
            cols += '<td>' + data.pooja + '<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code" type="hidden" required/>'; 
            cols += '<input type="hidden" name="temple[]" value="'+data.diety+'" /></td>';
            cols += '<td><input class="sq_form name"  name="name[]"  value="'+ name +'" type="text" style="width: 120px;" required/></td>';            
            if(starcode==1){
            cols += '<td><input class="sq_form star" value="" type="text" style="width: 3.2cm;" required/>';
            cols += '<input class="sq_form star_id" name="star[]" value="" type="hidden" style="width: 3.2cm;" required/></td>';
         }else{
            cols +='<td><select name="star[]"  class="sq_form js-example-basic-single star" required style="width: 3.2cm;"><option value="0">Select Star</option>';
            <?php foreach($birth_star as $val){ ?>
            cols +='<option <?= ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";}?><?=  $val['id'].' | '.$val['name_eng']." - ".$val['name_mal']; ?></option>';
            <?php } ?>
         }
            cols += '<td><input class="sq_form qty"  name="qlt[]"  value="0" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
            cols += '<td><input readonly class="sq_form rate" name="rate[]" value="0"  style="width: 60px;" required '+rate_readonly+'/></td>';
            cols += '<td><input  class="sq_form amt" name="amt[]" value="0.00" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
            cols +='<td><input type="date" name="date1[]" class="sq_form pdate" value="'+bill_date+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
            cols +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form time" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
            cols +='<option value="M"  selected="selected">M</option><option value="N">N</option><option value="E">E</option></select></td>';
            cols +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            newRow.append(cols);
            $("table.dataTable2 tbody").prepend(newRow);
            rowindex = newRow.index();
            calculateRowPoojaData(rowindex);
            // $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
        	$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').select2();
        	
            var obj = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.name');
            obj.val(obj.val());
            obj.focus().select();
        	$('.qty').on('input', function() {  this.value = this.value.replace(/[^0-9.]/g, '');});
        
        	// $("#dtab .star").each((i, e) => {
        	// var rowindex = $(e).closest('tr').index();
        	// var star 	 = $(e).val();
        	// var rowind   = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')');
        	// searchStar(rowind);
        	// })
        }
   }
   function calculateRowPoojaData(rowindex) {
        var qty = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
        var rate = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.rate').val();
        var amt = parseFloat(rate) > 0 ? (parseFloat(qty) * parseFloat(rate)) : $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.amt').val();;    
        parseFloat(rate) > 0 ? $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.amt').val(amt) : '';
        calcGrandTotal();
   }
    
   function calcGrandTotal(){
       var grandTotal = 0;
       $(".amt").each(function() {
           grandTotal += parseFloat($(this).val());
       });
       $('#total').text(grandTotal);
       $('#totaltop').text(grandTotal);
       $('#searchpooja').val("");
   
   		$('#received_amount').val(grandTotal);
   	   	$('#received_amount').attr('max', grandTotal);
   }
    $(document).on('input', '#received_amount', function() {
   			var grandTotal     = $('#total').text()
            var receivedAmount = $('#received_amount').val()
            var balanceAmount  = Math.abs(grandTotal - receivedAmount)
            $('#balance_amount').val(balanceAmount)
   	}); 
    
   		$("#dtab").on('input', '.amt', function() {
   			var rowindex = $(this).closest('tr').index();
   			calculateRowPoojaData(rowindex);
   		}); 
     
     	$("#dtab").on('input', '.rate', function() {
             var rowindex = $(this).closest('tr').index();
             calculateRowPoojaData(rowindex);
         });
   document.addEventListener("keydown", function(e) {
       if(e.keyCode == 9) {
              // if($("#searchpooja").is(':focus') == true){
              //     searchPooja();
              // }
              if($("#dtab .name").is(':focus') == true){
              	  e.preventDefault();
                  var rowindex = $("#dtab .name").closest('tr').index();
                  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').focus().select();
				  console.log("Value: "+$("#dtab .star").val())
                  // return false;
              }
        	  
              if($("#dtab .qty").is(':focus') == true){
              		e.preventDefault();
                  var rowindex = $("#dtab .qty").closest('tr').index();
              	 
                  var code = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.temple').val();
                  if(code=='9000'){
                       $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.amt').focus();
                  }
                  else{
                  	$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.pdate').focus().select();
                  }
                  return false;
              }
              if($("#dtab .pdate").is(':focus') == true){
              	  e.preventDefault();
                  var rowindex = $("#dtab .pdate").closest('tr').index();
                  var code = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.temple').val();
                  if(code=='9000'){
                       var amount = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.amt').val();
                       if(amount == 0 ){
                             $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.amt').focus();
                             alert('amount cannot be zero!');
                       }
                       else{
                            $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.time').focus().select();
                        }
                  }
              	  else{
                      $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.time').focus().select();
              	  }
                  return false;
              }
              if($("#dtab .amt").is(':focus') == true){
              		e.preventDefault();
                  var rowindex = $("#dtab .amt").closest('tr').index();
                  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.pdate').focus().select();
                  return false;
              }
              if($("#dtab .time").is(':focus') == true){
              		e.preventDefault();
                  $('#searchpooja').focus().select();
                  return false;
              }
              return false;
        }
        else if(e.keyCode == 13) {
            e.preventDefault();
        if($("#dtab .time").is(':focus') == true){
            	$("#searchpooja").focus();
                return false;
        } else if($("#dtab .star").is(':focus') == true){
            	$("#mode_100").focus();
        		let star_id = e.target.value
                let $row = $(e.target).closest('tr')
               	let $star_id = $row.find('.star_id')
        		$.ajax({
              url:'<?php echo base_url(); ?>index.php/admin/admin/getstarByCodeDiety',
              type: 'post',
              dataType: "json",
              data:{ 
                 search:star_id,
              },
              success: function( data ) {
              	 if(data) {
                 	$(e.target).val(data.star);
                 	$star_id.val(data.id)
                 	$row.find('.qty').focus().select()
                 } 
              }                   
           });
                return false;
        }
        
        
            }
            if($("#mode_100").is(':focus') == true){
                $('#100').focus().select();
                $('#100').css("background-color",'red');
                return false;
            }
            if($("#100").is(':focus') == true){
                $("#myform").submit();
                return false;
            }
//             else{
//                $("#myform").submit();
//                $('#100').css("background-color",'#90EE90')
//             }
//             if($('#100').is(':focus') == true){
//              	$("#myform").submit();
//             }
        
        if ( e.keyCode == 36 ) {
             e.preventDefault();
             
             $('#global-loader').css('display', 'block');
        }
        else if( e.keyCode == 107) {
          e.preventDefault();
             $('#100').click();
             $('#global-loader').css('display', 'block');
        }
       
        
    }, false); 
    
  	$('button.submit').on('submit', (e) => {
    	$('button.submit').prop('disabled', true);
      	$('button.submit').attr('type', 'button');
    })
    
    function remove_file_row(obj){
    	$(obj).closest('tr').remove();
    	calcGrandTotal();
    	return false;
    }
    
    
    var star_url = '<?php echo base_url(); ?>index.php/admin/admin/getstarByCodeDiety';
    $(".star" ).autocomplete({
       source: function(request, response) {
           $.ajax({
              url:star_url,
              type: 'post',
              dataType: "json",
              data:{ 
                 search:request.term,
              },
              success: function( data ) {
                 console.log(data);
                 response(data);   
              }                   
           });
        },
        select: function(event, ui) {
           console.log(ui);
           $('#star_search').val(ui.item.star);
           $('#star_id').val(ui.item.id);
        }
    });
  
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
   <?php if($this->session->flashdata('warning')) { ?>
			alert("<?php echo $this->session->flashdata('warning'); ?>")
   <?php } ?>
    
    <?php if($this->session->flashdata('post_data')) { ?>
			let post_data = JSON.parse('<?php  print_r($this->session->flashdata('post_data')); ?>');
    
    		post_data.pooja.forEach((e, i) => {
            	poojaSearch(e, post_data, i)
            })
   <?php } ?>
    </script>

    
<!-- <script>
    function view_mode(){
		var mode=$('#mode').val();
		$('.radio').prop('checked',false);
		var url = '<?php echo base_url(); ?>index.php/admin/admin/view_mode';
        $('.code').val('');
		$.ajax({
            type: "POST",
            url: url,
            data: {'id': mode},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	$('#radio_'+obj.mode_id).prop('checked',true);
                    $('#code_'+obj.mode_id).val(obj.code);
                });
            }
        });
	}
</script> -->