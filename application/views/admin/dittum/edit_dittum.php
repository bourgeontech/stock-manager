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
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_dittum/<?php echo $pooja_id;?>" method="post" id="myform">
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
            <select name="pooja_id" id="pooja_id" class="js-example-basic-single sq_form" required readonly>
            	<option value="">Select Pooja</option>
			<?php foreach($pooja_list as $val){ ?>
				<option value="<?= $val['id']; ?>" <?php if (isset($pooja_id)&&$pooja_id==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
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
            		<?php 
                		$this->db->select('*');
                		$this->db->from('dittum');
                		$this->db->where('pooja_id',$pooja_id);
            			$query = $this->db->get()->result_array();
            			$i="100";
            			$sdf=sizeof($query);
            			$row_value=$i+$sdf;
            			foreach ($query as $purchase){
            			?>
                		<tr>
                			<td><select name="product_id[]" id="product_id_<?php echo $i;?>" onchange="changeprice('<?php echo $i;?>')" class=" sq_form" required>
                                	<option value="">Select Product</option>
                    			<?php foreach($product_list as $val){ ?>
                    				<option value="<?= $val['id']; ?>" <?php if($purchase['product_id']==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><select id="unit_<?php echo $i;?>" class=" sq_form" required >
                                	<option value="">Select Unit</option>
                    			<?php foreach($unit_list as $val){ ?>  
                    				<option value="<?= $val['id']; ?>" <?php if($purchase['unit_id']==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                    			<input type="hidden" name="unit[]" id="unit1_<?php echo $i;?>" value="<?php echo $purchase['unit_id'];?>">
                			</td>
                			<td><input type="hidden" value="<?php echo $row_value;?>" id="row_value">
                			    <input type="text" name="qty[]" id="qty_<?php echo $i;?>" class="sq_form" onkeypress="return myKeyPress(event)" placeholder="Quatity" value="<?php echo $purchase['qty'];?>"></td>
                			<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>
                		</tr>
                		<?php $i++;}?>
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
//     function subtotcalc(){
//         var i;
//         var table = document.getElementById('dataTable2');
//     	var rowCount = table.rows.length;
//         var tot=0;
//         var tax_tot=0;
//         for (i = 100; i < 1000; i++) {
//           if (!isNaN(parseInt($('#tax_'+i).val()))){
//               tax_tot += parseInt($('#tax_'+i).val());
//           }
//           if (!isNaN(parseInt($('#sub_tot_'+i).val()))){
//               tot += parseInt($('#sub_tot_'+i).val());
//           }
//         }
//         $('#tax_total').html(tax_tot);
//         $('#total').html(tot);
//     }
//     function totalcalc(e){
//         var qty=parseInt($('#qty_'+e).val());
//         var tax=parseInt($('#tax_'+e).val());
//         var price=parseInt($('#price_'+e).val());
//         var total=qty*price+tax;
//         $('#sub_tot_'+e).val(total);
//         subtotcalc()
//     }
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
            html +='<td><select id="unit_'+row_value+'" class="js-example-basic-single sq_form" required disabled><option value="">Select Unit</option>';
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