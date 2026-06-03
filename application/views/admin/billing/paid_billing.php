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
</style>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">Other Billing</h4>
        </div>
         <div class="col-lg-3 col-md-3 col-sm-3 ">
        
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
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/paid_billing" method="post" onsubmit="return validateForm()" id="myform">
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $last_id;?> </h2>
                </div> 
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4">
           <label>Name</label>
           <input id="bill_name" name="bill_name" type="text" class="sq_form tabable"  autofocus tabindex="0" />
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4">
           <label>Type</label>
           <select id="mode" name="mode" class="sq_form tabable" onchange="changeslno()" style="height: 40px;">
               <option value="">Select Mode</option>
               <option value="2">Cheque</option>
               <option value="3">DD</option>
               <option value="4">MO</option>
               <option value="5">Others</option>
           </select>
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4">
           <label>Serial No.</label>
           <input id="sl_no" type="text" name="sl_no" class="sq_form tabable"  />
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4">
           <label>Amount No.</label>
           <input id="paid_amount" type="text" name="paid_amount" class="sq_form tabable"  />
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4">
           <label>Reference No.</label>
           <input type="text" name="ref_no"  class="sq_form tabable"/>
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4">
           <label>Bank</label>
           <input type="text" name="bank" class="sq_form tabable"  />
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4">
           <label>Branch</label>
           <input type="text" name="branch" class="sq_form tabable" />
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4"><?php $today=date("Y-m-d"); ?>
            <label>Date</label>
            <input type="date" class="sq_form tabable" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" max="<?php echo $today ?>" value="<?php echo $today ?>" >
       </div>
                
       <div class="col-lg-4 col-md-4 col-sm-4">
           <label>Diety</label>
           <select id="diety_id" class="sq_form tabable" style="height: 40px;" >
               <option value="">Select Diety</option>
               <?php foreach($temple_diety_list as $val){ ?>
                    	 <option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    	 <?php } ?>
                    </select>
        </div>         
        </div>
         </div>    
      <div class="form_body mt-6">
        <div class="row">  
           <div class="col-lg-12">
              Search By :- 
              <input class="filterby ml-3" name="filterby" type="radio" value="1" checked>Pooja Code
              <input class="filterby ml-3" name="filterby" type="radio" value="2">Pooja Name
           </div>
           <div class="col-lg-12">
               <input type="text" name="search_pooja" class="sq_form tabable" id="searchpooja" placeholder="Type in pooja code and press enter to search" />
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
                <p id="todonation"></p>
                <input id="bal" name="bal" type="hidden" class="sq_form" />
           </div> 
            </div>
            <div class="col-md-12">
                <div class="form-group">
                 
                   <button  type="submit" class="btn btn-warning pull-right tabable" name="save" value="save" style="margin:7px 4px;"> Save </button>
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
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script type="text/javascript">
     $.noConflict();
     jQuery( document ).ready(function( $ ) {
        
     
         window.onload = (event) => {
             $( "#bill_name" ).focus().select();
         };
         var diety = $('#diety_id').val();
         
         var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaByCodeNameDiety";
         
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
                      var poojafilter = parseInt($('.filterby').filter(':checked').val());
                       if(poojafilter == 2){ 
                            response(data); 
                       }
                   }
                });
             },
             select: function(event, ui) {
                var data = ui.item.value;
                // alert(value);
                poojaSearch(data);
             }
         });
        
     
         $("#dtab").on('input', '.qty', function() {
             var rowindex = $(this).closest('tr').index();
             calculateRowPoojaData(rowindex);
         }); 
    
   });

   function changeslno(){
        var mode=$('#mode').val();
        var url = "<?php echo base_url(); ?>index.php/admin/admin/getmodeslno";
        $.ajax({
            type: "GET",
            url: url,
            data: {'mode': mode},
            // dataType: "",
            success: function (data) {
                $('#sl_no').val(data);
            }
        });
    }

   var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/admin/getPoojaByCodeDiety"; 
    
   function searchPooja(){
        var pooja_url;
        var poojafilter = parseInt($('.filterby').filter(':checked').val());
        if(poojafilter == 2){ 
            pooja_url="<?php echo base_url(); ?>index.php/admin/admin/getPoojaByCodeNameDiety";
        }else{
            pooja_url="<?php echo base_url(); ?>index.php/admin/admin/getPoojaByCodeDiety";
        }
         $.ajax({
              url:pooja_url,
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
               // alert(data);
                 createrow(data);
           },
        	error: function(err){
        		alert('error');
            },
        });
   }
   function createrow(data){
         var flag = 1;
         // $(".pooja_code").each(function(i) {
         //      if ($(this).val() == data.pooja_id) {
         //             rowindex = i;
         //             flag = 0;
         //      }
         // });
         // $("input[name='search_pooja']").val('');
         // if(flag){
         var bill_date=$('#bill_date').val();
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
         cols +='<td><select name="star[]"  class="sq_form star" required style="width: 3.2cm;"><option value="0">Select Star</option>';
         <?php foreach($birth_star as $val){ ?>
         cols +='<option <?php echo ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?= $val['name_eng']." - ".$val['name_mal']; ?></option>';
         <?php } ?>
         cols += '<td><input class="sq_form qty"  name="qlt[]"  value="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
         cols += '<td><input readonly class="sq_form rate" name="rate[]" value="' + data.rate + '"  style="width: 60px;" required/></td>';
         cols += '<td><input  class="sq_form amt" name="amt[]" value="0.00" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
         cols +='<td><input type="date" name="date1[]" class="sq_form" value="'+bill_date+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
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
        // }
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
       var paid_amount = $('#paid_amount').val(); 
       $(".amt").each(function() {
           grandTotal += parseFloat($(this).val());
       });
       $('#total').text(grandTotal);
       var bal = paid_amount - grandTotal;
       var text = "Balance amount of "+bal+" will be received as donation";
       $('#todonation').text(text);
       $('#bal').text(bal);
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
                  if(star == 0)
                     alert('select star');
                  else
                     $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').focus().select();
                  return false;
              }
              if($("#dtab .qty").is(':focus') == true){
                  $('#searchpooja').focus().select();
                  return false;
              }
              return false;
        }
        // else if(e.keyCode == 9){
        //     e.preventDefault();
        //     if($("#bill_name").is(':focus') == true){
        //         $('#mode').focus().select();
        //     }
        //     if($("#mode").is(':focus') == true){
        //         $('#searchpooja').focus().select();
        //        //$('#100').css("background-color",'red')
        //     }
        //     else{
        //        //$('#diety_id').focus().select();
        //       // $('#100').css("background-color",'#90EE90')
        //     }
        // }
        if ( e.keyCode == 36 ) {
             e.preventDefault();
             $("#myform").submit();
        }
        else if( e.keyCode == 107) {
             e.preventDefault();
             $('#100').click();
        }
        
    }, false); 
    


    
    function remove_file_row(obj){
    	$(obj).closest('tr').remove();
    	calcGrandTotal();
    	return false;
    }
    
    
    var lastTabIndex = 10;
function OnFocusOut()
{
    var currentElement = $get(currentElementId); // ID set by OnFOcusIn
    var curIndex = currentElement.tabIndex; //get current elements tab index
    if(curIndex == lastTabIndex) { //if we are on the last tabindex, go back to the beginning
        curIndex = 0;
    }
    var tabbables = document.querySelectorAll(".tabable"); //get all tabable elements
    for(var i=0; i<tabbables.length; i++) { //loop through each element
        if(tabbables[i].tabIndex == (curIndex+1)) { //check the tabindex to see if it's the element we want
            tabbables[i].focus(); //if it's the one we want, focus it and exit the loop
            break;
        }
    }
}
   
    </script>