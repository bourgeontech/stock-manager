<style>
.center {
  margin: auto;
  width: 50%;
  padding: 10px;
}
</style>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative;height:100%;width:100%" >
             
    

     <form action="<?php echo base_url(); ?>index.php/admin/admin/assigncounter" method="post" enctype="multipart/form-data">


      <div class="form_body">
       <div class="row">
		<div class="col-lg-6 center">
		   <div class="form-group">
			  <div class="row_form">
				<div class="div_label">
				  <label class="text_label">Select Counter <span class="red">*</span> </label>
				</div>
                 <select class="form-control" name="counter_id">
                    <option value="">Select Counter</option>
                    <?php foreach($counter_list as $key => $c) { ?>
                    <option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
                    <?php } ?>
                 </select>
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