  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Issue Product</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/issue_view" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp; View</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/issue_product" method="post" id="myform">
               <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Issue Product </h2>
                </div> 
			   </div>
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Product <span class="red">*</span> </label>
            </div>
            <select name="product_id" id="product_id" onchange="getquantity()" class=" sq_form" required>
            	<option value="">Select Product</option>
			<?php foreach($product_list as $val){ ?>
				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
			<?php } ?>
			</select>
    		<?php echo form_error('product_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Unit</label>
            </div>
            <select id="unit" class=" sq_form" >
            	<option value="">Select Unit</option>
			<?php foreach($unit_list as $val){ ?>  
				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
			<?php } ?>
			</select><input type="hidden" name="unit" id="unit1" value="">
    		<?php echo form_error('unit', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Quantity <span class="red">*</span> </label>
              <label class="text_label" style="float: right;border:0.5px solid black;color:blue;padding:0 5px;">Available Quantity = <span id="available"></span> </label>
            </div>
            <input type="text" name="qty" id="qty" class="sq_form" onkeyup="getquantity()" placeholder="Quantity" value="" required>
    		<?php echo form_error('qty', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Supplied To</label>
            </div>
            <select name="customer" id="customer" class=" sq_form">
            	<option value="">Select </option>
			<?php foreach($customer_list as $val){ ?>  
				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
			<?php } ?>
			</select>
    		<?php echo form_error('customer', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
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
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Remark</label>
            </div>
            <textarea rows="2" name="remark" id="remark" class="sq_form"></textarea>
    		<?php echo form_error('remark', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
           <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-success pull-right" id="submit" name="save" value="save" style="margin:7px 4px;"> Save </button>
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
    
    function getquantity(){
    	var product=$('#product_id').val();
        var url = "<?php echo base_url(); ?>index.php/admin/admin/getproductdtls";
        $.ajax({
            type: "GET",
            url: url,
            data: {'product': product},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	$('#unit').val(obj.unit);
                	$('#unit1').val(obj.unit);
                	$('#available').html(obj.qty);
                	if(obj.qty == null){
                    	$("#submit").attr("disabled", true);
                    }else{
                		$('#qty').attr('max',obj.qty);
                    	$("#submit").removeAttr("disabled");
                    }
                });
            }
        });
    }
    
    </script>