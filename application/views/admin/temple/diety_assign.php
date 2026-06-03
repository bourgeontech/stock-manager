  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt">Temple Master</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/temple_view" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	  <hr>
      <div class="clearfix"></div>
	   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;Assign Diety </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/temple_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
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
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/diety_assign" method="post" >
		
      <div class="form_body">
        <div class="row">
			
			<div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Temple <span class="red">*</span> </label>
            </div>
            <select name="temple" id="temple" class="js-example-basic-single sq_form" onchange="view_diety()" style="width: 100%">
            	<option value="">Select Temple</option>
			<?php foreach($temple_list as $val){ ?>
				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
			<?php } ?>
			</select>
    		<?php echo form_error('temple', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<?php 
		if (!empty($diety_list)){
		foreach($diety_list as $list){ ?>
		<div class="col-lg-12">
        <div class="form-group">
    		<label><input type="checkbox" class="radio" id="radio_<?php echo $list['id'];?>" name="radio[]" value="<?php echo $list['id'];?>" style="vertical-align:-2;">
			<?php echo $list['name']." - ".$list['name_mal'];?></label>
        </div>
      </div>
      <?php }}else{ ?>
          <div class="col-lg-12">
            <div class="form-group">
            	Diety Not Available
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
		var url = '<?php echo base_url(); ?>index.php/admin/admin/view_temple';
		$.ajax({
            type: "POST",
            url: url,
            data: {'id': temple},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	$('#radio_'+obj.diety_id).prop('checked',true);
                });
            }
        });
	}
    </script>