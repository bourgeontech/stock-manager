 <style>

.header {
  overflow: hidden;
  background-color: white;
  padding: 8px 4px;
}
.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}


.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: gray;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }

}
</style>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/accounts/viewjournal" class="btn btn-primary">View&nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Add Journal </h2>
              </div>
			 </div>	
               <br>

		       <form action="<?php echo base_url(); ?>index.php/accounts/addjournal" method="post" onsubmit="return validateForm()" id="myform">
		
      <div class="form_body">
        <div class="row">
		
      <div class="col-lg-6" hidden>
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Date <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Date" id="date" name="date" value="<?php echo date('Y-m-d');?>" type="date" >
			<?php echo form_error('date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>

		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            	<table class="table table-responsive-sm">
            		<thead style="background-color:gray;">
            			<tr>
                            <th style="width: 20%;">Ledger From</th>
                            <th style="width: 20%;">Ledger To</th>
                            <th style="width: 20%;">Amount</th>
                            <th style="width: 20%;">Narration</th>
                            <th style="width: 20%;">Date</th>
                			<th colspan="5" style="width: 5%;text-align:right;"><span onclick="addRow()"><i class="fa fa-plus" style="margin-right: 10px;"></i></span></th>
            			</tr>
            		</thead>
            		<tbody id="dataTable2">
                		<tr>
                            <td><select name="led_from[]" id="led_from_100" class="sq_form" required>
                                	<option value="">Select Ledger</option>
                    			<?php foreach($ledger as $val){ ?>  
                    				<option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><select name="led_to[]" id="led_to_100" class="sq_form" required>
                            		<option value="">Select Ledger</option>
                    			<?php foreach($ledger as $val){ ?>  
                    				<option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                      		<td><input type="number" name="amount[]" id="name_100" class="sq_form" placeholder="Amount" value="" required></td>
                			<td><input type="text" name="narration[]" id="name_100" class="sq_form" placeholder="Narration" value="" required  onkeypress="return myKeyPress(event)"></td>
                			<td><input type="date" name="date1[]" id="date_100" class="sq_form" placeholder="Date" value="<?php echo date('Y-m-d');?>" onkeypress="return myKeyPress(event)"></td>
                			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>
                		</tr>
                	</tbody>
            	</table>			
			  </div>
			</div>
			</div>	
           <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-success pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button>
                  <!-- <button type="submit" class="btn btn-success pull-right" name="save" value="print" style="margin:7px 4px;"> Save &amp; Print </button> -->
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
                    totalcalc();
                });
            }
        });
    }
    function addRow() {
        var row_value=$('#row_value').val();
        row_value++;
        var html = '<tr>';
        	html +='<td><select name="led_from[]" id="led_from_'+row_value+'" class="js-example-basic-single sq_form" style="width: 100%" required><option value="">Select Ledger</option>';
			<?php foreach($ledger as $val){ ?>
			html +='<option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><select name="led_to[]" id="led_to_'+row_value+'" class="js-example-basic-single sq_form" style="width: 100%" required><option value="">Select Ledger</option>';
			<?php foreach($ledger as $val){ ?>
			html +='<option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><input type="text" name="amount[]" id="name_'+row_value+'" class="sq_form" placeholder="Amount" value="" required></td>';
            html +='<td><input type="text" name="narration[]" id="name_'+row_value+'" class="sq_form" placeholder="Narration" value="" required></td>';
            html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form" placeholder="Date" value="<?php echo date('Y-m-d');?>" onkeypress="return myKeyPress(event)"></td>';
            html +='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
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