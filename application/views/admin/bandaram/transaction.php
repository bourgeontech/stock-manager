<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Transaction Master</h4>
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
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/transaction" method="post" id="myform">
               <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Transaction </h2>
                </div> 
			   </div>
      <div class="form_body">
        <div class="row">
        <div class="col-lg-12">
        <?php echo validation_errors(); ?>
</div>
		<div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Bandaram <span class="red">*</span> </label>
            </div>
            <select name="bandaram" id="bandaram" class=" sq_form" required tabindex="1" autofocus="autofocus">
            	<option value="">Select Bandaram</option>
			<?php foreach($bandaram_list as $val){ ?>
				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
			<?php } ?>
			</select>
    		<?php echo form_error('bandaram', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Date <span class="red">*</span> </label>
            </div>
            <input type="date" name="date" id="date" value="<?php echo date('Y-m-d');?>" class="sq_form" tabindex="2">
    		<?php echo form_error('date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            	<table class="table table-responsive-sm">
            		<thead>
            			<tr>
                			<th>Amount</th>
                			<th>Type</th>
                			<th>Nos</th>
                			<th>Total</th>
                			<th>Remark</th>
                			<!-- <th style="text-align:right;"><span onclick="addRow12()"><i class="fa fa-plus" style="padding: 8px;"></i></span></th> -->
            			</tr>
            		</thead>
            		<tbody id="dataTable2">
                <?php 
                $row_val="100";
                $tab="3";
                foreach($amount_list as $val){ ?>
                		<tr>
                			<td><select name="amount_id[]" id="amount_id_<?= $row_val;?>" class=" sq_form" required>
                            <option value="<?= $val['id']; ?>" selected><?= $val['name']; ?></option>
                    			</select>
                			</td>
                			<td>
                        <select name="remark[]" class=" sq_form" required>	
                    				<option value="<?= $val['remark']; ?>" selected><?= $val['remark']; ?></option>
                    		</select>
                      </td>
                			<td><input type="hidden" value="<?= $row_val;?>" id="row_value">
                			    <input type="text" name="nos[]" id="nos_<?= $row_val;?>" tabindex="<?= $tab; ?>" onchange="changetotal('<?= $row_val;?>')" onkeyup="changetotal('<?= $row_val;?>')" class="sq_form" placeholder="Quantity"></td>
                			<td><input type="text" name="total[]" id="total_<?= $row_val;?>" placeholder="Total" onkeyup="totalcalc()" onkeypress="return myKeyPress(event)" class="sq_form"></td>
                      <td><input type="text" name="notes[]" id="notes_<?= $row_val;?>" placeholder="Remark" onkeyup="totalcalc()" onkeypress="return myKeyPress(event)" class="sq_form"></td>
                			<!-- <td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td> -->
                		</tr>
                    <?php 
                    $row_val++;
                    $tab++;
                  } ?>
                	</tbody>
                	<tfoot>
                		<tr>
                			<th colspan="3">Total <input type="hidden" name="totalvalue" id="totalvalue"></th>
                			<th id="total">0</th>
                			<th></th>
                		</tr>
                	</tfoot>
            	</table>			
			  </div>
			</div>
			</div>	
           <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-success pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button>
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
    <div class="clearfix"></div>
    <br>
    <script>
    function changeremark(e){
        var amount_id=$('#amount_id_'+e).val();
        var url = "<?php echo base_url(); ?>index.php/admin/admin/getremark";
        $.ajax({
            type: "GET",
            url: url,
            data: {'amount_id': amount_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {	
                	$('#remark_'+e).val(data.remark);
                	changetotal(e);
                });
            }
        });
    }
    function changetotal(e){
        var amount_id=$('#amount_id_'+e).val();
        var nos=$('#nos_'+e).val();
        var url = "<?php echo base_url(); ?>index.php/admin/admin/getremark";
        $.ajax({
            type: "GET",
            url: url,
            data: {'amount_id': amount_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {	
                	var value=data.value;
                	var total=nos*value;
                	$('#total_'+e).val(total.toFixed(2));
                  totalcalc();
                });
            }
        });
    }
    function totalcalc(){
        var i;
        var tot=0;
        for (i = 100; i < 1000; i++) {
          if (!isNaN(parseFloat($('#total_'+i).val()))){
              tot += parseFloat($('#total_'+i).val());
          }
        }
        $('#total').html(tot);
        $('#totalvalue').val(tot);
    }
    // function addRow12() {
    //     var row_value=$('#row_value').val();
    //     row_value++;
    //     var html = '<tr>'; 
    //     	html +='<td><select name="amount_id[]" id="amount_id_'+row_value+'" onchange="changeremark('+row_value+')" class="js-example-basic-single sq_form" required><option value="">Select Amount</option>';
    //         <?php foreach($amount_list as $val){ ?>
		// 	html +='<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>';
		// 	<?php } ?>
    //         html +='</select></td>';
           
    //        	html +='<td><select name="remark[]" id="remark_'+row_value+'" class="js-example-basic-single sq_form" required><option value="">Select Type</option>';
    //         <?php foreach($gettransactiontype as $val){ ?>
		// 	html +='<option value="<?= $val['remark']; ?>"><?= $val['remark']; ?></option>';
		// 	<?php } ?>
    //         html +='</select></td>';
    //         html +='<td><input type="text" name="nos[]" id="nos_'+row_value+'" onchange="changetotal('+row_value+')" onkeyup="changetotal('+row_value+')" class="sq_form" placeholder="Quatity"></td>';
    //         html +='<td><input type="text" name="total[]" id="total_'+row_value+'" placeholder="Total" onkeyup="totalcalc()" onkeypress="return myKeyPress(event)" class="sq_form"></td>';
    //         html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
    //         html +='</tr>';
    // 		$('#dataTable2').append(html);
    // 		$('#row_value').val(row_value);
    // 		$('#amount_id_'+row_value).focus();
    // }
    
    function remove_file_row(obj){
    	$(obj).closest('tr').remove();
    	totalcalc()
    	return false;
    }
    function myKeyPress(e){
        var keynum;
    
        if(window.event) { // IE                    
          keynum = e.keyCode;
        } else if(e.which){ // Netscape/Firefox/Opera                   
          keynum = e.which;
        }
        if(keynum==13){
            addRow12();
            return false;
        }
    }   
    
    </script>