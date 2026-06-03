<?php
$token = md5(uniqid(rand(), true)); // Generate a unique token
$this->session->set_userdata('form_token', $token); // Store the token in session
?>
<?php date_default_timezone_set('Asia/Kolkata');  ?><style type="text/css">
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

#suggestions-container {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        width: 120px;
    }

    #suggestions-container ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    #suggestions-container li {
        padding: 8px;
        cursor: pointer;
    }

    #suggestions-container li:hover {
        background-color: #f0f0f0;
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
          <h4 class="page_txt">Billing Master.</h4>
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
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a>
          <a href="<?php echo base_url();?>index.php/admin/admin/familypooja" class="btn btn-primary"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp; Family Pooja</a></li>
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
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/billing" method="post"  id="myform">
            	<input type="hidden" name="token" value="<?php echo $token; ?>">
               <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $last_id;?> </h2>
                </div> 
              
               <div class="col-lg-2 col-md-2 col-sm-2">
              <span id="totaltop" style=" width: 150px;
                border: 15px solid red;
                padding: 10px;
                margin:2px;color:red;"> Bill total </span>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-2" style="text-align:right;"><?php $today=date("Y-m-d"); ?>
                  <input type="date" class="sq_form" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>"  value="<?php echo $today ?>" >
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
               		<select id="diety_id" class="sq_form" style="height: 40px;">
                         <option value="">Select Diety</option>
                    	 <?php foreach($temple_diety_list as $val){ ?>
                    	 <option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    	 <?php } ?>
                    </select>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3" style="text-align:right;">
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
           <div class="col-md-offset-6 col-md-4">
                <div class="form-group" style="margin-top: 7px;">
                <select id="mode" name="mode" class="form-control" required onchange="openpaydetails()" >
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
                   <button type="submit" class="btn submit pull-right" name="save" id="100" value="print" style="margin:7px 4px;background-color:#90EE90;"> Save &amp; Print </button>
                   <button type="submit" onclick="formsubmit('print')" class="btn submit btn-warning pull-right" name="save" value="save" style="margin:7px 4px;"> PDF Generate </button>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">
    
      function formsubmit(val){
   if(val === 'print'){
        setInterval(function () {
            window.location.reload();
        }, 1000);
   }
        $('#100').css("display",'none');
   }
    
     $.noConflict();
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
                   }
                });
             },
             select: function(event, ui) {
                var id = ui.item.id;
                poojaSearch(id)
             }
         });
     
     
     
          
        $( document ).ready(function() {
            setTimeout(function() {
                 console.log("here");
    		     $("#searchpooja").focus().select();
    	   }, 1000);
           //  $( "#searchpooja" ).focus().select();
        });
     
         $( ".submit" ).click(function() {
            $('#global-loader').css('display', 'block');
         });
         
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
             calculateRowPoojaData(rowindex);
         }); 
    
   });
   
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

    $('button.submit').on('submit', (e) => {
    	$('button.submit').prop('disabled', true);
      	$('button.submit').attr('type', 'button');
    })
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
    
   function poojaSearch(id){
   
        var pooja_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaById";
        $.ajax({
           type: 'POST',
           url: pooja_url,
           dataType: "json",
           data: {
                pooja: id
           },
           success: function(data) {
                 createrow(data);
           }
        });
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
         name = (typeof name === 'undefined') ? '*' : name;
         star = (typeof star === 'undefined') ? '28' : star;
         var toggleamtreadonly = (data.diety!='9000' && (data.diety!=8)) ? 'readonly' : '';
         var newRow = $('<tr class="pooja-row">');
         var cols = '';
         cols += '<td>' + data.pooja + '('+data.pooja_mal+')<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code" type="hidden" required/>'; 
         cols += '<input type="hidden" class="temple" name="temple[]" value="'+data.diety+'" /></td>';
         cols += '<td><input class="sq_form name"  name="name[]"  value="'+ name +'" type="text" style="width: 120px;" required/><div id="suggestions-container" class="d-none"></div></td>';
         if(starcode==1){
            cols += '<td><input class="sq_form star" value="" type="text" style="width: 3.2cm;" required/>';
            cols += '<input class="sq_form star_id" name="star[]" value="" type="hidden" style="width: 3.2cm;" required/></td>';
         }else{
            cols +='<td><select name="star[]"  class="sq_form select2 star" required style="width: 3.2cm;"><option value="28">nodata</option>';
            <?php foreach($birth_star as $val){ ?>
            cols +='<option <?php echo ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";}?><?= $val['name_eng']." - ".$val['name_mal']." ( ".$val['id']." ) "; ?></option>';
            <?php } ?>
         }
         cols += '<td><input class="sq_form qty"  name="qlt[]"  value="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
         cols += '<td><input class="sq_form rate" name="rate[]" value="' + data.rate + '"  style="width: 60px;" '+toggleamtreadonly+' required/></td>';
         cols += '<td><input  class="sq_form amt" name="amt[]" value="0.00" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
         cols +='<td><input type="date" name="date1[]" class="sq_form pdate" value="'+bill_date+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
         cols +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form time" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="  ">' + data.time + '</option>';
        //  cols +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
          cols +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
         console.log(data);
         newRow.append(cols);
         $("table.dataTable2 tbody").prepend(newRow);
         rowindex = newRow.index();
         calculateRowPoojaData(rowindex);
         $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
         var obj = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.name');
         obj.val(obj.val());
         obj.focus().select();
         $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').select2();
   
   		 $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').on('select2:select', function (e) {
            var selectedOption = e.params.data; // Get the selected option
            var star = selectedOption.id; // Get the value of the selected option
            // Perform your action here based on the selected value
            if(star == 0 || star == "")
                     alert('select star');
                  else
                  	$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').focus().select();
        });
   		
        // var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
//             $('.sq_form.name').on('keyup', function() {
//     var inputField = $(this);
//             console.log($(this))
//             inputField.autocomplete({
//                 source: function(request, response) {
//                 $.ajax({
//                     url: translate_url,
//                     type: 'post',
//                 dataType: "json",
//                 data: {
//                     search: request.term,
//                 },
//                 success: function(data) {
//                     console.log('e');
//                     response(data);
//                 }
//             });
//         },
//         select: function(event, ui) {
//             var id = ui.item.id;
//             poojaSearch(id)
//         }
//     });
// });
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

         
//      .on('keyup', (e) => {
     	
//      	$.ajax({
//            type: 'POST',
//            url: translate_url,
//            dataType: "json",
//            data: {
//                 pooja: id
//            },
//            success: function(data) {
//                  createrow(data);
//            }
//         });
//      });
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
            var toggleamtreadonly = (data.diety!='9000') ? 'readonly' : '';
            var newRow = $("<tr>");
            var cols = '';
            cols += '<td>' + data.pooja + '<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code" type="hidden" required/>'; 
            cols += '<input type="hidden" name="temple[]" value="'+data.diety+'" /></td>';
            cols += '<td><input class="sq_form name"  name="name[]"  value="'+ name +'" type="text" style="width: 120px;" required/></td>';            
            cols +='<td><select name="star[]"  class="sq_form star" required style="width: 3.2cm;"><option value="28">nodata</option>';
            <?php foreach($birth_star as $val){ ?>
            cols +='<option <?php echo ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";}?><?= $val['name_eng']." - ".$val['name_mal']." ( ".$val['id']." ) " ; ?></option>';
            <?php } ?>
            cols +='</select></td>';
            cols += '<td><input class="sq_form qty"  name="qlt[]"  value="0" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
            cols += '<td><input readonly class="sq_form rate" name="rate[]"  value="0"  style="width: 60px;" required/></td>';
            cols += '<td><input  class="sq_form amt" name="amt[]" value="0.00" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
            cols +='<td><input type="date" name="date1[]" class="sq_form pdate" value="'+bill_date+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
            cols +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form time" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
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
        	$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').select2();
   			
   		 $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').on('select2:select', function (e) {
   		 var selectedOption = e.params.data; // Get the selected option
   		 var star = selectedOption.id; // Get the value of the selected option
   		 // Perform your action here based on the selected value
   		 if(star == 0 || star == "")
   		 alert('select star');
   		 else
   		 $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').focus().select();
   		 });
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
       $('#totaltop').text(grandTotal);
    $('#searchpooja').val("");
   }
     
   document.addEventListener("keydown", function(e) {
       if(e.keyCode == 9) {
              e.preventDefault();

              if($("#dtab .name").is(':focus') == true){
                  var rowindex = $("#dtab .name").closest('tr').index();
              	var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
              	  $.ajax({
					url: translate_url,
					type: 'post',
					dataType: 'json',
					data: {
						search: $("#dtab .name").val()
					},
					success: function(data) {
        				$("#suggestions-container").empty();
						$("#suggestions-container").append($("<p>").text(data.name));
                    	$("#suggestions-container").removeClass('d-none')
        				$("#suggestions-container").show();
                    	
//         // Create and append a list of suggestions
//         var suggestionsList = $("<ul>");
//         suggestions.forEach(function(suggestion) {
//             suggestionsList.append($("<li>").text(suggestion));
//         });
//         $("#suggestions-container").append(suggestionsList);

//         // Show the suggestions container
//         
	
        // Handle suggestion click (optional)
        $("#suggestions-container p").on("click", function() {
            var selectedSuggestion = $(this).text();
            $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.name').val(selectedSuggestion);
			$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').focus().select();
            // Hide the suggestions container after selecting a suggestion
            $("#suggestions-container").hide();
        	
        	$("#suggestions-container").addClass('d-none')
        });
                    $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').focus().select();
        			// $("#suggestions-container").hide();
        			// $("#suggestions-container").addClass('d-none')
    	
	 // $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.name').val(data.name)
	}
	});
                  
                  return false;
              }
        	if($(":focus").is('span.select2-selection') == true){ //$("#dtab .star").is(':focus') 
				  $("#suggestions-container").hide();
        			$("#suggestions-container").addClass('d-none')
                  var rowindex = $("#dtab .star").closest('tr').index();
                  var star =  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val();
                  var starcode = '<?php echo $site[0]['starcode'];?>';

            		$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').focus().select();
                  if(star == 0 || star == "")
                     alert('select star');
                  else
                  	$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').focus().select();
                    if(starcode == 1){
                        var  rowind= $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')');
                        searchStar(rowind);
                    }else{
                        $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').focus().select();
                    }
                    return false;
              }
              if($("#dtab .qty").is(':focus') == true){
                  var rowindex = $("#dtab .qty").closest('tr').index();
                  var code = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.temple').val();
                  if(code=='9000' || code == 8){
                       $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.amt').focus();
                  }
                  else{
                  	$('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.pdate').focus().select();
                  }
                  return false;
              }
              if($("#dtab .pdate").is(':focus') == true){
                  var rowindex = $("#dtab .pdate").closest('tr').index();
                  var code = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.temple').val();
                  if(code=='9000' || code == 8){
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
                  var rowindex = $("#dtab .amt").closest('tr').index();
              	  
                  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.pdate').focus().select();
                  return false;
              }
              if($("#dtab .time").is(':focus') == true){
                  $('#searchpooja').focus().select();
                  return false;
              }
              return false;
        }
        else if(e.keyCode == 13) {
            e.preventDefault();
        	$("#suggestions-container").hide();
        	
        	$("#suggestions-container").addClass('d-none')
        if($("#dtab .star").is(':focus') == true){
                  var rowindex = $("#dtab .star").closest('tr').index();
                  var star =  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val();
                  var starcode = '<?php echo $site[0]['starcode'];?>';
                  if(star == 0 || star == "")
                     alert('select star');
                  else
                    if(starcode == 1){
                        var  rowind= $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')');
                        searchStar(rowind);
                    }else{
                        $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').focus().select();
                    }
                    return false;
              }
        if($("#dtab .time").is(':focus') == true){
            	$("#mode_100").focus();
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
       
        // if( e.keyCode == 120 ) {
        //     let firstElm = $('.pooja-row')[0];
        //     let copyElm = $(firstElm).clone();
        //     $("table.dataTable2 tbody").prepend(copyElm);
        //     calculateRowPoojaData(copyElm.index());
        // }
        if( e.keyCode == 120 ) {
            let firstElm = $('.pooja-row')[0];
            let copyElm = $(firstElm).clone();
            copyElm.find('.name').val(''); 
            copyElm.prependTo('table.dataTable2 tbody');
            calculateRowPoojaData(copyElm.index());
        }

        
    }, false); 
    
  
    function remove_file_row(obj){
    	$(obj).closest('tr').remove();
    	calcGrandTotal();
    	return false;
    }
    
    $(document).on('input', '.amt', () => {
    	calcGrandTotal()
    });
    var star_url = '<?php echo base_url(); ?>index.php/admin/admin/getstarByCodeDiety';
    $( ".star_search" ).autocomplete({
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
  	
    function setDevotee(data){
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
                            <input type="text" name="house" placeholder="House No" class="form-control custom-input" required>
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
					<div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="pan_no" placeholder="Pan Number" class="form-control custom-input" required>
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
                            'email'     : formData.get('email'),
                        	'pan_no'     : formData.get('pan_no')
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