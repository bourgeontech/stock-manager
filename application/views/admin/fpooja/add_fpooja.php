<style type="text/css">
.submit:focus {
  background:blue;
}

</style>

<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <h4 class="page_txt">Family Pooja</h4>
        </div>
<!--          <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">
             Today's Collection : 
         </h4>
        </div> -->
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/fpooja_view" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp; View</a> </li>
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
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/fpooja" method="post" id="myform">
               <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Family Pooja</h2>
                </div> 
             
<!--                <div class="col-lg-3 col-md-3 col-sm-3" style="text-align:right;">
               <p class="page_txt" style="vertical-align: baseline;">Bill Date </p>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3"><?php// $today=date("Y-m-d"); ?>
               		<input type="date" class="sq_form" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" max="<?php// echo $today ?>" value="<?php// echo $today ?>">
               </div>
                 <div class="col-lg-3 col-md-3 col-sm-3">Time
                <?php// echo date("h:i:sa");?>
               </div>
                <div class="col-lg-3 col-md-3 col-sm-3">Bill Total
             <th style="text-align:left;padding:10px 25px" id="totaltop">0</th>
               </div> -->
			   </div>
      <div class="form_body">
        <div class="row" style="border:1px solid black;padding:10px;">  
           <div class="col-lg-4">
           	  <div class="form-group">
              	  <label class="form-label">Name</label>
                  <input class="form-control" placeholder="Name" name="fname"  type="text">
              </div>
           </div>
           <div class="col-lg-4">
           	  <div class="form-group">
              	  <label class="form-label">Address</label>
                  <input class="form-control" placeholder="Address" name="address"  type="text">
              </div>
           </div>
           <div class="col-lg-4">
           	  <div class="form-group">
              	  <label class="form-label">City</label>
                  <input class="form-control" placeholder="City" name="city"  type="text">
              </div>
           </div>
           <div class="col-lg-4">
           	  <div class="form-group">
              	  <label class="form-label">Pin Code</label>
                  <input class="form-control" placeholder="Pin Code" name="pincode"  type="text">
              </div>
           </div>
           <div class="col-lg-4">
           	  <div class="form-group">
              	  <label class="form-label">Mobile</label>
                  <input class="form-control" placeholder="Mobile" name="mobile"  type="text">
              </div>
           </div>
           <div class="col-lg-4">
           	  <div class="form-group">
              	  <label class="form-label">Email</label>
                  <input class="form-control" placeholder="Email" name="email"  type="email">
              </div>
           </div>
        </div>
        <div class="row" style="border:1px solid black;padding:10px;">
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
                			 <th>Amount</th>s
                			 <th style="text-align:right;"><span onclick="addRow()"><i class="fa fa-plus" style="padding: 8px;"></i></span></th>
            			</tr>
            		</thead>
            		<tbody id="dataTable2">
                		<tr>
                			<td><select name="temple[]" id="temple_100" onchange="changepooja(100)" class=" sq_form" required style="width: 3.5cm;">
                                	<option value="">Select Diety</option>
                    			<?php foreach($temple_diety_list as $val){ ?>
                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><input type="text" name="name[]" id="name_100" class="sq_form name" placeholder="Name" value="*" required style="width: 3.5cm;"></td>
                			<td><select name="star[]" id="star_100" class=" sq_form" required style="width: 3.5cm;">
                                	<option value="">Select Star</option>
                    			<?php foreach($birth_star as $val){ ?>  
                    				<option value="<?= $val['id']; ?>"><?= $val['name_eng']." - ".$val['name_mal']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><select name="pooja[]" id="pooja_100" onchange="change_rate(100)" onload="change_rate(100)" class="sq_form" required style="width: 3.5cm;">
                                	<option value="">Select Pooja</option>
                    			</select>
                			</td>
                			<td><input type="hidden" value="100" id="row_value">
                			    <input type="number" min="1" name="qlt[]" onchange="change_rate(100)" onkeyup="change_rate(100)" id="qlt_100" class="sq_form" placeholder="Quatity" value="1"></td>
                			<td><input type="text" name="rate[]" id="rate_100" class="sq_form" placeholder="Rate" readonly value=""></td>
                			<td><input type="text" name="amt[]" id="amt_100" class="sq_form" onkeyup="return myKeyPress(event)" placeholder="Amount" readonly value=""></td>
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
<!--             <div class="col-md-offset-6 col-md-4">
            <div class="form-group" style="margin-top: 7px;">
                  <select id="mode" name="mode" class="sq_form" required onchange="openpaydetails()" >
                          <option value="">Select Mode</option>
                          <option value="1" selected="selected">Cash</option>
                          <option value="6">QR Code</option>
                          <option value="5">NEFT</option>
                  </select>
               </div>
            </div> -->
            <div class="col-md-12">
                <div class="form-group">
<!--                    <button tabindex="12" type="submit" class="btn submit pull-right" name="save" id="100" value="print" style="margin:7px 4px;background-color:#90EE90;" onfocus="test();"> Save &amp; Print </button> -->
                   <button tabindex="13" type="submit" class="btn submit btn-warning pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button>
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
    <script>
    // function submitform(){
    //     $('#myform').attr("target","_blank");
    //     $('#myform').submit();
    //     window.location.reload();
    // }
    // 
    
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
    function myKeyPress(e){
        var keynum;
        e.preventDefault();
        if(window.event) { // IE                    
          keynum = e.keyCode;
        } else if(e.which){ // Netscape/Firefox/Opera                   
          keynum = e.which;
        }
        if(keynum==9){
            e.preventDefault();
            addRow();
            return false;
        }
    }   
    
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
                $.each(data, function (i, obj)
                {
                    var amt=qlt*obj.rate;
                    $('#rate_'+e).val(obj.rate);
                    $('#amt_'+e).val(amt);
                    if(obj.rowcount>1) { 
					var bill_date=$('#bill_date').val();
        var row_value=$('#row_value').val();
        var diety=$('#temple_'+row_value).val();
        row_value++;
        var html = '<tr>';
        	html +='<td><select name="temple[]" id="temple_'+row_value+'" onchange="changepooja('+row_value+')" class="js-example-basic-single sq_form" required style="width: 3.5cm;"><option value="">Select Diety</option>';
			<?php foreach($temple_diety_list as $val){ ?>
			var id="<?php echo $val['id']; ?>";
            html +='<option value="<?= $val['id']; ?>"><?= trim($val['name']); ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form name" placeholder="Name" value="" required style="width: 3.5cm;"></td>';
            html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.5cm;"><option value="">Select Star</option>';
			<?php foreach($birth_star as $val){ ?>
			html +='<option value="<?= $val['id']; ?>"><?= $val['name_eng']." - ".$val['name_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><select name="pooja[]" id="pooja_'+row_value+'"  class="select2 sq_form" required style="width: 3.5cm;"><option value="'+obj.id+'">'+obj.name+'</option>';
            html +='</select></td>';
    		html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+')"  onkeyup="change_rate('+row_value+')" class="sq_form" readonly placeholder="Quatity" value="0"></td>';
            html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form" placeholder="Rate" readonly value=""></td>';
            html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="return myKeyPress(event)" class="sq_form" placeholder="Amount" readonly value="0"></td>';
            
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
    		$('#dataTable2').append(html);
    		$('#row_value').val(row_value);
    		$('#temple_'+row_value).val(diety);
    		$('#temple_'+row_value).focus();
    		//changepooja(row_value);
    		totalcalc();
					}
					else
					{
                    totalcalc();
					}
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
    	 }
    	 });
    	 }else{
    	 	var data='<?php echo date('Y-m-d');?>';
    	 	$('#date_'+e).val(data);
    	 $('#date_'+e).attr('readonly', false);
    	 }
    }
    
    function changedate(){
    	var bill_date=$('#bill_date').val();
    	$('#date_100').val(bill_date);
    }
    
 
     function changepooja(e){
        var diety=$('#temple_'+e).val();
        var poojacode='<?php echo $site[0]['poojacode']?>';
        if (diety=="8" || diety=="7"|| diety=="5"){
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
            }
        });
    }
   
    function addRow() {
    	var bill_date=$('#bill_date').val();
        var row_value=$('#row_value').val();
        var diety=$('#temple_'+row_value).val();
        row_value++;
        var html = '<tr>';
        	html +='<td><select name="temple[]" id="temple_'+row_value+'" onchange="changepooja('+row_value+')" class="js-example-basic-single sq_form" required style="width: 3.5cm;"><option value="">Select Diety</option>';
			<?php foreach($temple_diety_list as $val){ ?>
			var id="<?php echo $val['id']; ?>";
            html +='<option value="<?= $val['id']; ?>"><?= trim($val['name']); ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form name" placeholder="Name" value="" required style="width: 3.5cm;"></td>';
            html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.5cm;"><option value="">Select Star</option>';
			<?php foreach($birth_star as $val){ ?>
			html +='<option value="<?= $val['id']; ?>"><?= $val['name_eng']." - ".$val['name_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="select2 sq_form" required style="width: 3.5cm;"><option value="">Select Pooja</option>';
            html +='</select></td>';
    		html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+')"  onkeyup="change_rate('+row_value+')" class="sq_form" placeholder="Quatity" value="1"></td>';
            html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form" placeholder="Rate" readonly value=""></td>';
            html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="return myKeyPress(event)" class="sq_form" placeholder="Amount" readonly value=""></td>';
            
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
    		$('#dataTable2').append(html);
    		$('#row_value').val(row_value);
    		$('#temple_'+row_value).val(diety);
    		$('#temple_'+row_value).focus();
    		changepooja(row_value);
    		totalcalc();
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
    
    
    function test()
    {
    document. getElementById('100'). style. backgroundColor = 'Red';
    
    }
    
    document.addEventListener("keydown", function(e) {
        if($("#mode").is(':focus') == true){
           if(e.keyCode == 9){
               e.preventDefault();
               $('#100').focus().select();
               $('#100').css("background-color",'red')
           }
        }
        if($('.datefield').is(':focus') == true){
            if(e.keyCode == 13){
               e.preventDefault();
            }
        }
    });

    
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
  <script>
$(document).on('focus', '.name', function() {
    if ($(this).data('ui-autocomplete')) {
        return; // Already initialized
    }

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
</script>