  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Donation Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/donation_view" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp; View</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<form action="<?php echo base_url(); ?>index.php/admin/admin/donation" method="post" onsubmit="return validateForm()" id="myform">
               <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-9 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Donation </h2>
                  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 ">
				  	<input type="date" name="date1" id="date" class="sq_form" placeholder="Date" value="<?php echo date('Y-m-d');?>">
                  </div>
			   </div>
      <div class="form_body">
        <div class="row">
			
      <div class="col-lg-6">
            <input class="sq_form" placeholder=" Date" id="date" name="date" value="<?php echo date('Y-m-d');?>" type="hidden" >
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            	<table class="table table-responsive-sm">
            		<thead>
            			<tr>
                			<th>Name</th>
                			<th>Star</th>
                			<th>Item</th>
                			<th>Category</th>
                			<th>Qty</th>
                			<th>Unit</th>
                			<th>Weight</th>
                			<th>Amount</th>
                			<th>Remark</th>
                			<th style="text-align:right;"><span onclick="addRow()"><i class="fa fa-plus" style="padding: 8px;"></i></span></th>
            			</tr>
            		</thead>
            		<tbody id="dataTable2">
                		<tr>
                			<td><input type="text" name="name[]" id="name_100" class="sq_form name" placeholder="Name" value="" required style="width: 3.5cm;"></td>
                			<td><select name="star[]" id="star_100" class=" sq_form" required style="width: 3.5cm;">
                                	<option value="">Select Star</option>
                    			<?php foreach($birth_star as $val){ ?>  
                    				<option value="<?= $val['id']; ?>"><?= $val['name_eng']." - ".$val['name_mal']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><select name="pooja[]" id="pooja_100" class=" sq_form" required style="width: 3.5cm;">
                                	<option value="">Select Pooja</option>
                                	<?php foreach($pooja_list as $pooja){ ?> 
                        				<option value="<?= $pooja['pooja_id']; ?>"><?= $pooja['pooja']." - ".$pooja['pooja_mal']; ?></option>
                        			<?php } ?>
                    			</select>
                			</td>
							<td><select name="category[]" id="category_100" class=" sq_form" required style="width: 3cm;">
                                	<option value="">Select Category</option>
                    				<option value="1">Gold</option>
                    				<option value="2">Silver</option>
                            	<option value="4">Bronze</option>
                    				<option value="3" selected>Other</option>
                    			</select>
                			</td>
                			<td><input type="hidden" value="100" id="row_value">
                			    <input type="text" name="qlt[]" id="qlt_100" class="sq_form" placeholder="Quatity" value="1"></td>
            			    <td><select name="unit[]" id="unit_100" class=" sq_form" required style="width: 3cm;">
                                	<option value="">Select Unit</option>
                    				<option value="kg">KG</option>
                    				<option value="gram">GRAM</option>
                    				<option value="lr">LR</option>
                    				<option value="no">NO</option>
                    				<option value="mgm">MGM</option>
                    				<option value="tin">TIN</option>
                    			</select>
                			</td>
                			<td><input type="text" name="weight[]" id="weight_100" class="sq_form" placeholder="Weight" value=""></td>
                			<td><input type="text" name="amt[]" id="amt_100" class="sq_form" onkeyup="totalcalc()" onchange="totalcalc()" placeholder="Amount" value=""></td>
                			<td><input type="text" name="remark[]" id="remark_100" class="sq_form" placeholder="Remark" value="" onkeypress="return myKeyPress(event)"></td>
                			<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>
                		</tr>
                	</tbody>
                	<tfoot>
                	    <tr>
                	        <th colspan="5" style="text-align:left">Total</th>
                	        <th style="text-align:left;padding:10px 25px" id="total">0</th>
                	        <th colspan="3"></th>
                	    </tr>
                	</tfoot>
            	</table>			
			  </div>
			</div>
			</div>	
			<div class="col-lg-12">
            <div class="form-group">
              	<div class="row_form">
                	<table class="table table-responsive-sm">
                		<tbody>
                			<tr>
                				<td><input style="border: 1px solid red;" name="costname" type="text" id="costname" placeholder="Name *" class="form-control" required></td>
                				<td><input name="house" type="text" id="house" placeholder="House Name *" class="form-control" ></td>
                				<td><input name="street" type="text" id="street" placeholder="Street Name *" class="form-control" ></td>
                				<td><input name="post" type="text" id="post" placeholder="PostOffice *" class="form-control" ></td>
                				<td><input name="district" type="text" id="district" placeholder="District *" class="form-control" ></td>
                			</tr>
                			<tr>
                				<td><input name="state" type="text" id="state" placeholder="State *" class="form-control" ></td>
                				<td><input name="pincode" type="text" id="pincode" placeholder="Pincode *" class="form-control" ></td>
                				<td><input style="border: 1px solid red;" name="mobile" type="text" id="mobile" placeholder="Mobile No *" class="form-control" required></td>
                				<td><input name="email" type="text" id="email" placeholder="Email *" class="form-control" ></td>
                				<td></td>
                			</tr>
                		</tbody>
                	</table>
            	</div>
        	</div>
           <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-success pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button>
                  <button type="submit" class="btn btn-success pull-right" name="save" value="print" style="margin:7px 4px;"> Save &amp; Print </button>
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
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
    <script>
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
    // function submitform(){
    //     $('#myform').attr("target","_blank");
    //     $('#myform').submit();
    //     window.location.reload();
    // }
    function validateForm() {
      var x = $('#temple').val();;
      if (x == "") {
        alert("Diety must be filled out");
        return false;
      }
    }
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
    }
    function myKeyPress(e){
        var keynum;
    
        if(window.event) { // IE                    
          keynum = e.keyCode;
        } else if(e.which){ // Netscape/Firefox/Opera                   
          keynum = e.which;
        }
        if(keynum==13){
            addRow();
            return false;
        }
    }   
    
    function addRow() {
        var row_value=$('#row_value').val();
        row_value++;
        var html = '<tr>';
            html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form" placeholder="Name" value="" required style="width: 3.5cm;"></td>';
            html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.5cm;"><option value="">Select Star</option>';
			<?php foreach($birth_star as $val){ ?>
			html +='<option value="<?= $val['id']; ?>"><?= $val['name_eng']." - ".$val['name_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><select name="pooja[]" id="pooja_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.5cm;"><option value="">Select Pooja</option>';
            <?php foreach($pooja_list as $pooja){ ?> 
            html +='<option value="<?= $pooja['pooja_id']; ?>"><?= $pooja['pooja']." - ".$pooja['pooja_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
			html +='<td><select name="category[]" id="category_'+row_value+'" class="sq_form" required style="width: 3cm;"><option value="">Select Category</option>';
            html +='<option value="1">Gold</option><option value="2">Silver</option><option value="3" selected>Other</option></select></td>';
    		html +='<td><input type="text" name="qlt[]" id="qlt_'+row_value+'" class="sq_form" placeholder="Quatity" value="1"></td>';
    		html +='<td><select name="unit[]" id="unit_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3cm;">';
            html +='<option value="">Select Unit</option><option value="kg">KG</option><option value="gram">GRAM</option><option value="lr">LR</option>';
            html +='<option value="no">NO</option><option value="mgm">MGM</option><option value="tin">TIN</option>';
            html +='<td><input type="text" name="weight[]" id="weight_'+row_value+'" class="sq_form" placeholder="Weight" value=""></td>';
            html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" onchange="totalcalc()" class="sq_form" placeholder="Amount" value=""></td>';
    		html +='<td><input type="text" name="remark[]" id="remark_'+row_value+'" class="sq_form" placeholder="Remark" value="" onkeypress="return myKeyPress(event)"></td>';
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
    		$('#dataTable2').append(html);
    		$('#row_value').val(row_value);
    		$('#name_'+row_value).focus();
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
    </script>