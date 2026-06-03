  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Diety Master</42>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Assign Temple </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/pooja_assign" method="post" >
		
      <div class="form_body">
        <div class="row">
			
			<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Diety <span class="red">*</span> </label>
            </div>
            <select name="temple" id="temple" class="js-example-basic-single sq_form" onchange="view_diety()" style="width: 100%">
            	<option value="">Select Diety</option>
			<?php foreach($temple_diety_list as $val){ ?>
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
            		<label><input onclick="inputcontrol(this)" type="checkbox" class="radio" id="radio_<?php echo $list['id']; ?>" name="radio[]" value="<?php echo $list['id'];?>" style="vertical-align:-2;" class="cp">
        			<?php echo $list['name']." - ".$list['name_mal'];?></label>
    			</div>
    			<div class="col-lg-4">
    				<label>Rate</label> <input placeholder="Rate" id="rate_<?php echo $list['id']; ?>" name="rate_<?php echo $list['id'];?>" value="<?php echo $list['rate'];?>" type="text" >
    			</div>
                <div class="col-lg-4">
    				<label>Code</label> <input class="code" onkeyup="codecheck(<?php echo 'code_'.$list['id']; ?>)" placeholder="Code" id="code_<?php echo $list['id']; ?>" name="code_<?php echo $list['id'];?>" value="" type="text" >
                    <p id="msg_code_<?php echo $list['id']; ?>"></p>
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
    function codecheck(e){
       $('#msg_'+e.id).text('');
       var url = '<?php echo base_url(); ?>index.php/admin/admin/checkCodeExists';
       if(e.value){
          $.ajax({
             type: "POST",
             url: url,
             data: {'id': e.value},
             dataType: "json",
             success: function (data) {
                if(data === 1){
                	$('#msg_'+e.id).text('Code Already Taken!');
                    $('#msg_'+e.id).css('color', 'red');
                }
                else{
                    $('#msg_'+e.id).text('Code Available!');
                    $('#msg_'+e.id).css('color', 'green');
                }
             }
         });
       }
    }
	function view_diety(){
		var temple=$('#temple').val();
		$('.radio').prop('checked',false);
		var url = '<?php echo base_url(); ?>index.php/admin/admin/view_diety';
        $('.code').val('');
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
                    $('#code_'+obj.pooja_id).val(obj.code);
                });
            }
        });
	}
    function inputcontrol(e){
         if (e.checked) {
            $('#rate_'+e.value).prop("required", true);
            $('#code_'+e.value).prop("required", true);
         }
         else{
            $('#rate_'+e.value).prop("required", false);
            $('#code_'+e.value).prop("required", false);
         }
                    
    }
    </script>