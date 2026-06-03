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
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a>
          <a href="<?php echo base_url();?>index.php/admin/admin/familypooja" class="btn btn-primary"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp; Family Pooja</a></li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/billing" method="post" onsubmit="return validateForm()" id="myform">
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
                  <input type="date" class="sq_form" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" max="<?php echo $today ?>" value="<?php echo $today ?>">
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
               <input type="text" name="search_pooja" class="sq_form" id="searchpooja" placeholder="Type in pooja code and press enter to search" autofocus/>
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
                  <select id="mode" name="mode" class="sq_form" required onchange="openpaydetails()" tabindex="11">
                         
                          <option value="1" selected="selected">Cash</option>
                          <option value="6">QR Code</option>
                                          
                  </select>
           </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                   <button type="submit" class="btn submit pull-right" name="save" id="100" value="print" style="margin:7px 4px;background-color:#90EE90;" onfocus="test();"> Save &amp; Print </button>
                   <button  type="submit" class="btn submit btn-warning pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button>
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
    <script type="text/javascript">
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
          
         window.onload = (event) => {
             $( "#searchpooja" ).focus().select();
         };
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
         var toggleamtreadonly = (data.diety!='9000') ? 'readonly' : '';
         var newRow = $("<tr>");
         var cols = '';
         cols += '<td>' + data.pooja + '('+data.pooja_mal+')<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code" type="hidden" required/>'; 
         cols += '<input type="hidden" name="temple[]" value="'+data.diety+'" /></td>';
         cols += '<td><input class="sq_form name"  name="name[]"  value="'+ name +'" type="text" style="width: 120px;" required/></td>';
         if(starcode==1){
            cols += '<td><input class="sq_form star" value="" type="text" style="width: 3.2cm;" required/>';
            cols += '<input class="sq_form star_id" name="star[]" value="" type="hidden" style="width: 3.2cm;" required/></td>';
         }else{
            cols +='<td><select name="star[]"  class="sq_form star" required style="width: 3.2cm;"><option value="0">Select Star</option>';
            <?php foreach($birth_star as $val){ ?>
            cols +='<option <?php echo ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";}?><?= $val['name_eng']." - ".$val['name_mal']; ?></option>';
            <?php } ?>
         }
         cols += '<td><input class="sq_form qty"  name="qlt[]"  value="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
         cols += '<td><input readonly class="sq_form rate" name="rate[]" value="' + data.rate + '"  style="width: 60px;" required/></td>';
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
            cols +='<td><select name="star[]"  class="sq_form star" required style="width: 3.2cm;"><option value="0">Select Star</option>';
            <?php foreach($birth_star as $val){ ?>
            cols +='<option <?php echo ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";}?><?= $val['name_eng']." - ".$val['name_mal']; ?></option>';
            <?php } ?>
            cols += '<td><input class="sq_form qty"  name="qlt[]"  value="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
            cols += '<td><input readonly class="sq_form rate" name="rate[]" value="0"  style="width: 60px;" required/></td>';
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
       if(e.keyCode == 13) {
              e.preventDefault();
              // if($("#searchpooja").is(':focus') == true){
              //     searchPooja();
              // }
              if($("#dtab .name").is(':focus') == true){
                  var rowindex = $("#dtab .name").closest('tr').index();
                  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').focus().select();
                  return false;
              }
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
              if($("#dtab .qty").is(':focus') == true){
                  var rowindex = $("#dtab .qty").closest('tr').index();
                  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.pdate').focus().select();
                  return false;
              }
              if($("#dtab .pdate").is(':focus') == true){
                  var rowindex = $("#dtab .pdate").closest('tr').index();
                  $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.time').focus().select();
                  return false;
              }
              if($("#dtab .time").is(':focus') == true){
                  $('#searchpooja').focus().select();
                  return false;
              }
              return false;
        }
        else if(e.keyCode == 9){
            e.preventDefault();
            if($("#mode").is(':focus') == true){
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
    	$(obj).closest('tr').remove();
    	calcGrandTotal();
    	return false;
    }
    
   
   
   
    </script>