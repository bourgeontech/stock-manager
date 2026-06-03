  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Adjustment</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/adjustment_view" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp; View</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/adjustment" method="post" id="myform">
               <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Adjust Stock </h2>
                </div> 
			   </div>
            <div id="customer_div">
                <?php if(isset($billing_id)) { ?>
            	    <input type="hidden" name="billing_id" id="billing_id" value="<?php echo $billing_id; ?>" />
                	<div class="row mt-1 mb-3">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                        	
                        	<table  class="table table-responsive-sm">
                            	<tr>
                            		<th>Customer</th>
                            		<td id="customer_name">: <?php echo $customer; ?></td>
                            	</tr>
                                <tr>
                                    <th>Star</th>
                            		<td id="star">: <?php echo $star; ?></td>
                                </tr>
                            </table>
                        </div>
    			    </div>
                <?php } ?>
                </div>
      <div class="form_body">
        <div class="row">
			
<!-- 		<div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Supplier <span class="red">*</span> </label>
            </div>
            <select name="supplier_id" id="supplier_id" class="js-example-basic-single sq_form" required>
            	<option value="">Select Supplier</option>
			<?php foreach($supplier_list as $val){ ?>
				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
			<?php } ?>
			</select>
    		<?php echo form_error('supplier_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Invoice No <span class="red">*</span> </label>
            </div>
            <input type="text" name="invoice_no" id="invoice_no" class="sq_form" placeholder="Invoice No" value="" required>
    		<?php echo form_error('invoice_no', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Mode <span class="red">*</span> </label>
            </div>
            <select name="mode" id="mode" class="js-example-basic-single sq_form" required>
                <option value="1">Cash</option>
                <option value="2">Credit</option>
			</select>
    		<?php echo form_error('mode', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div> -->
      <div class="col-lg-3" style="display: none;">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Date <span class="red">*</span> </label>
            </div>
            <input type="date" name="date" id="date" class="sq_form" value="<?php echo date('Y-m-d');?>" required>
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
                			<th>Product</th>
                			<th>Unit</th>
                			<th>Type</th>
                			<th>Quantity</th>
                        	<th>Date</th>
                        	<th>Source</th>
                			<th style="text-align:right;"><span onclick="addRow12()"><i class="fa fa-plus" style="padding: 8px;"></i></span></th>
            			</tr>
            		</thead>
            		<tbody id="dataTable2">
                		<tr>
                			<td><select name="product_id[]" id="product_id_100" onchange="changeprice(100)" class="sq_form" required>
                                
                    			<?php foreach($product_list as $val){ ?>
                    				<option value="<?= $val['id']; ?>" ><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><select id="unit_100" class=" sq_form" required >
                                	<option value="">Select Unit</option>
                    			<?php foreach($unit_list as $val){ ?>  
                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select><input type="hidden" name="unit[]" id="unit1_100" value="">
                			</td>
                			<td><select name="type[]" id="type" class=" sq_form" required>
                                    <option value="+" <?php if($type != 2) echo 'selected'; ?>>+</option>
                                    <option value="-" <?php if($type == 2) echo 'selected'; ?>>-</option>
                    			</select>
                				<td><input type="hidden" value="100" id="row_value">
                			    <input type="text" min="1" name="qty[]" id="qty_100" class="sq_form" placeholder="Quantity" value="1"></td>
                        	<td><input type="date" name="addeddate" id="date" class="sq_form" value="<?php echo date('Y-m-d');?>" required></td>
    						<?php echo form_error('date', '<div class="error">', '</div>'); ?>
                        	<td><input type="text" name="source" id="source" class="sq_form" value="" required></td>
                			<td style="text-align:right;"><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>
                		</tr>
                	</tbody>
            	</table>			
			  </div>
			</div>
			</div>	
           <div class="col-sm-12">
                <div class="form-group">
                  <?php if(isset($billing_id)) { ?>
                    	<button type="submit" class="btn btn-success pull-right" name="save" value="bill_print" style="margin:7px 4px;"> Save & Print </button>
                   <?php } else { ?>
                		<button type="submit" id="submitBtn" class="btn btn-success pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button>
                    <?php } ?>
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
    <div class="clearfix"></div>
    <br>
    <script>
    function changeprice(e){
        var product=$('#product_id_'+e).val();
        var qty=$('#qty_'+e).val();
        var url = "<?php echo base_url(); ?>index.php/admin/admin/getproductdtls";
        $.ajax({
            type: "GET",
            url: url,
            data: {'product': product},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	$('#unit_'+e).val(obj.unit);
                	$('#unit1_'+e).val(obj.unit);
                });
            }
        });
    }
    
    function addRow12() {
        var row_value=$('#row_value').val();
        row_value++;
        var html = '<tr>';
        	html +='<td><select name="product_id[]" id="product_id_'+row_value+'" onchange="changeprice('+row_value+')" class="js-example-basic-single sq_form" required><option value="">Select Product</option>';
        	<?php foreach($product_list as $val){ ?>
			html +='<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><select id="unit_'+row_value+'" class="js-example-basic-single sq_form" required disabled><option value="">Select Unit</option>';
            <?php foreach($unit_list as $val){ ?>  
			html +='<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select><input type="hidden" name="unit[]" id="unit1_'+row_value+'" value=""></td>';
            html +='<td><select name="type[]" id="type" class="js-example-basic-single sq_form" required><option value="+" selected="selected">+</option><option value="-">-</option></select></td>';
    		html +='<td><input type="text" min="1" name="qty[]" id="qty_'+row_value+'" class="sq_form" placeholder="Quatity" value="1"></td>';
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
    		$('#dataTable2').append(html);
    		$('#row_value').val(row_value);
    		$('#product_id_'+row_value).focus();
    }
    
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