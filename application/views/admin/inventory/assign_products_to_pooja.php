<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>  
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Products to Pooja</h4>
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
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Assign Products to Pooja</h2>
                  </div>

			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/inventory/assign_products_to_pooja" method="post" >
      				<div class="form_body">
        				<div class="row">
                        	<div class="col-lg-3">
        						<div class="form-group">
          							<div class="row_form">
            							<div class="div_label">
              								<label class="text_label">Deity</label>
            							</div>
          								<select class="sq_form" name="deity_id" id="deity_id" >
                                    	<?php if(!empty($deities)){
	                      						foreach($deities as $val){ ?>
                                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                                  		<?php   }
											  } ?>
                                    	</select>
										<?php echo form_error('deity_id', '<div class="error">', '</div>'); ?>
          							</div>
        						</div>
      						</div>
      						<div class="col-lg-3">
        						<div class="form-group">
          							<div class="row_form">
            							<div class="div_label">
              								<label class="text_label">Pooja</label>
            							</div>
          								<select class="sq_form js-example-basic-single" name="pooja_id" id="pooja_id" >
                                    	<?php if(!empty($poojas)){
	                      						foreach($poojas as $val){ ?>
                                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                                  		<?php   }
											  } ?>
                                    	</select>
										<?php echo form_error('pooja_id', '<div class="error">', '</div>'); ?>
          							</div>
        						</div>
      						</div>
                        	<div class="col-lg-3">
        						<div class="form-group">
          							<div class="row_form">
            							<div class="div_label">
              								<label class="text_label">Product</label>
            							</div>
          								<select class="sq_form" name="product_id" id="products" >
                                    	<?php if(!empty($products)){
	                      						foreach($products as $val){ ?>
                                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                                  		<?php   }
											  } ?>
                                    	</select>
										<?php echo form_error('product_id', '<div class="error">', '</div>'); ?>
          							</div>
        						</div>
      						</div>

          					<div class="col-sm-12">
                				<div class="form-group">
                  					<button type="submit" class="btn btn-success pull-right" style="margin-top:7px;">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const getPoojas = (deity_id) => {
	console.log(deity_id);
	const data = {
  		'diety': deity_id,
	};
	$('#pooja_id').empty()
	var html='<option value="0">Please Select</option>';
    var url = '<?php echo base_url();?>index.php/admin/admin/getpoojasbydiety';
    	$.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
            
                $.each(data, function (i, obj)
                {
                    var pooja=obj.code+' - '+obj.pooja;
                	html +='<option value="'+obj.pooja_id+'">'+pooja+' - '+obj.pooja_mal+' ('+obj.code+')</option>';
                });
                $('#pooja_id').append(html);
            }
        });
}
$('#deity_id').on('change', (e) => {
	getPoojas(e.target.value);
});


$(document).ready(() => {
	let deity_id = $('#deity_id').val()
	getPoojas(deity_id);
})

        // Check if a flash message exists and display it
        <?php if ($this->session->flashdata('warning')): ?>
            toastr.warning('<?php echo $this->session->flashdata('warning'); ?>');
        <?php endif; ?>
</script>
</body>