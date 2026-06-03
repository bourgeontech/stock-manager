  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Pooja Muthalkootu</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add Pooja Muthalkootu </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/pooja/pooja_muthalkootu" method="post" >
		
      <div class="form_body">
        <div class="row">
			
           <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
               <div class="col-lg-3">
        			<div class="form-group">
        			  <div class="row_form">
           				 <div class="div_label">
             				 <label class="text_label">Reference Number <span class="red">*</span> </label>
           				 </div>
           				 <input class="sq_form" placeholder=" Enter Reference Number" id="reference_no" name="reference_no"  type="text" >
						 <?php echo form_error('reference_no', '<div class="error">', '</div>'); ?>
          			</div>
        		</div>
      		</div>
                  <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">From Date <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" From date" id="from_date" name="from_date" value="<?= $datef ?? date('Y-m-d'); ?>" type="date" >
			<?php echo form_error('from_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">To Date <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" To date" id="to_date" name="to_date" value="<?= $datet ?? date('Y-m-d'); ?>" type="date" >
			<?php echo form_error('to_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<?php 
		if (!empty($pooja_list)){
		foreach($pooja_list as $list){ ?>
		<div class="col-lg-12">
        <div class="form-group">
            <div class="row">
            	<div class="col-lg-3">
            		<label><input type="hidden" class="radio" id="radio_<?php echo $list['id'];?>" name="pooja_id[]" value="<?php echo $list['id'];?>" style="vertical-align:-2;">
        			<?php echo $list['name']." - ".$list['name_mal'];?></label>
    			</div>
    			<div class="col-lg-3">
    				<label>Rate</label> <input placeholder="Rate" class="rate" id="rate_<?php echo $list['id'];?>" name="rate[]" value="<?php echo $list['rate'];?>" type="text" >
    			</div>
            	<div class="col-lg-3">
    				<label>Allocated Rate</label> <input placeholder="Allocated Rate" class="allocated_rate" id="allocated_rate_<?php echo $list['id'];?>" name="allocated_rate[]" value="<?php echo $list['allocated_rate'] ?? '';?>" type="text" >
    			</div>
            	<div class="col-lg-3">
    				<label>Pooja Chilavu</label> <input placeholder="Pooja Chilavu" class="pooja_cost" id="pooja_cost_<?php echo $list['id'];?>" name="pooja_cost[]" value="<?php echo $list['pooja_cost'] ?? '';?>" type="text" >
    			</div>
			</div>
        </div>
      </div>
      <?php }}else{ ?>
          <div class="col-lg-12">
            <div class="form-group">
            	Pooja Not Available
            </div>
          </div>
		<?php }?>			
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
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script>
	function view_diety(){
		var temple=$('#temple').val();
		$('.radio').prop('checked',false);
		$('.rate').val("");
		var url = '<?php echo base_url(); ?>index.php/admin/admin/view_kooru';
		$.ajax({
            type: "POST",
            url: url,
            data: {'id': temple},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	$('#radio_'+obj.pooja_id).prop('checked',true);
                	$('#rate_'+obj.pooja_id).val(obj.rate);
                });
            }
        });
	}
    </script>