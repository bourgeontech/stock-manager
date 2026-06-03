  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Dittum</h4>
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
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/dittum_mstr" method="post" id="myform">
               <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Dittum </h2>
                </div> 
			   </div>
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Pooja <span class="red">*</span> </label>
            </div>
            <select name="pooja_id" id="pooja_id" class="sq_form" required>
            	<option value="">Select Pooja</option>
			<?php foreach($pooja_list as $val){ ?>
				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
			<?php } ?>
			</select>
    		<?php echo form_error('pooja_id', '<div class="error">', '</div>'); ?>
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
                			<th>Quantity</th>
                			<th style="text-align:right;"><span onclick="addRow12()"><i class="fa fa-plus" style="padding: 8px;"></i></span></th>
            			</tr>
            		</thead>
            		<tbody id="dataTable2">
                		<tr>
                			<td><select name="product_id[]" id="product_id_100" onchange="changeprice(100)" class="sq_form" required>
                                	<option value="">Select Product</option>
                    			<?php foreach($product_list as $val){ ?>
                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><select id="unit_100" class="sq_form" required disabled>
                                	<option value="">Select Units</option>
                    			<?php foreach($unit_list as $val){ ?>  
                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                    			<input type="hidden" name="unit[]" id="unit1_100" value="">
                			</td>
                			<td><input type="hidden" value="100" id="row_value">
                			    <input type="text" name="qty[]" id="qty_100" class="sq_form" onkeypress="return myKeyPress(event)" placeholder="Quatity"></td>
                			<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>
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
    <div class="clearfix"></div>
    <br>
    <script>
	function changeprice(e){
        var product=$('#product_id_'+e).val();
        var qty=$('#qty_'+e).val();
        var tax=$('#tax_'+e).val();
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
                	$('#price_'+e).val(obj.price);
                	totalcalc(e);
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
            html +='<td><select name="unit[]" id="unit_'+row_value+'" class="js-example-basic-single sq_form" required readonly><option value="">Select Unit</option>';
            <?php foreach($unit_list as $val){ ?>  
			html +='<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select></td><input type="hidden" name="unit[]" id="unit1_'+row_value+'" value="">';
    		html +='<td><input type="text" name="qty[]" id="qty_'+row_value+'" onkeypress="return myKeyPress(event)" class="sq_form" placeholder="Quatity"></td>';
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