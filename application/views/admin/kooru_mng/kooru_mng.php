  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt"><?php echo $this->lang->line('Kooru') ?? 'Kooru'; ?> Management</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Assign <?php echo $this->lang->line('Kooru') ?? 'Kooru'; ?> </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/kooru_mng" method="post" >
		
      <div class="form_body">
        <div class="row">
			
			<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">User <span class="red">*</span> </label>
            </div>
            <select name="temple" id="temple" class="js-example-basic-single sq_form" onchange="view_diety()" style="width: 100%">
            	<option value="">Select User</option>
			<?php foreach($user_list as $val){ ?>
				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
			<?php } ?>
			</select>
    		<?php echo form_error('temple', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<?php 
		if (!empty($pooja_list)){
		foreach($pooja_list as $list){ ?>
		<div class="col-lg-12">
        <div class="form-group">
            <div class="row">
            	<div class="col-lg-4">
            		<label><input type="checkbox" class="radio" id="radio_<?php echo $list['id'];?>" name="radio[]" value="<?php echo $list['id'];?>" style="vertical-align:-2;">
        			<?php echo $list['name']." - ".$list['name_mal'];?></label>
    			</div>
    			<div class="col-lg-4">
    				<label>Rate</label> <input placeholder="Rate" class="rate" id="rate_<?php echo $list['id'];?>" name="rate[]" value="" type="text" >
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