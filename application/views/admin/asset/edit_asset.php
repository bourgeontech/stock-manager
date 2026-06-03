<style>
    .label {
       cursor: pointer;
       /* Style as you please, it will become the visible UI component. */
    }
    
    #upload-photo {
       opacity: 0;
       position: absolute;
       z-index: -1;
    }
</style>
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Asset Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/view_asset" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; View</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Asset </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_asset/<?php echo $id;?>" method="post" enctype="multipart/form-data">
		
      <div class="form_body">
        <div class="row">
		
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Location </label>
            </div>
            <select name="location" id="location" class="sq_form" required>
            	<option value="">Select Location</option>
			<?php foreach($location_list as $val){ ?>
				<option value="<?= $val['id']; ?>" <?php if($asset['location']==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
			<?php } ?>
			</select>
			<?php echo form_error('location', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">DOCNO </label>
            </div>
            <input class="sq_form" placeholder=" DOCNO" id="docno" name="docno" value="<?php echo $asset['docno']?>" type="text" >
			<?php echo form_error('docno', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Date</label>
            </div>
            <input class="sq_form" placeholder=" Date" id="date" name="date" value="<?php echo $asset['date']?>" type="date" >
			<?php echo form_error('date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Itemcode</label>
            </div>
            <input class="sq_form" placeholder=" asset Publisher" id="itemcode" name="itemcode" value="<?php echo $asset['itemcode']?>" type="text" >
			<?php echo form_error('publisher', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Itemname</label>
            </div>
            <input class="sq_form" placeholder=" Itemname" id="itemname" name="itemname" value="<?php echo $asset['itemname']?>" type="text" >
			<?php echo form_error('itemname', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Category</label>
            </div>
            <select name="ass_cat" id="ass_cat" class="sq_form" onchange="change_category()" required>
            	<option value="">Select Category</option>
			<?php foreach($category_list as $val){ ?>
				<option value="<?= $val['id']; ?>" <?php if($asset['ass_cat']==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
			<?php } ?>
			</select>
			<?php echo form_error('category', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Sub Category</label>
            </div>
            <select name="ass_subcat" id="sub_category" class="sq_form" required>
            	<option value="">Select Sub Category</option>
			<?php foreach($sub_category_list as $val){ ?>
				<option value="<?= $val['id']; ?>" <?php if($asset['ass_subcat']==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
			<?php } ?>
			</select>
			<?php echo form_error('ass_subcat', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Purchase from / Received from</label>
            </div>
            <input class="sq_form" placeholder=" Purchase from / Received from" id="p_from" name="p_from" value="<?php echo $asset['p_from']?>" type="text" >
			<?php echo form_error('p_from', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Bill no</label>
            </div>
            <input class="sq_form" placeholder="Bill no" id="bill_no" name="bill_no" value="<?php echo $asset['bill_no']?>" type="text" >
			<?php echo form_error('bill_no', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Bill Date</label>
            </div>
            <input class="sq_form" placeholder=" Bill Date" id="bill_date" name="bill_date" value="<?php echo $asset['bill_date']?>" type="date" >
			<?php echo form_error('bill_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Gurrantee Period</label>
            </div>
            <input class="sq_form" placeholder=" Gurrantee Period" id="period" name="period" value="<?php echo $asset['period']?>" type="text" >
			<?php echo form_error('period', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Guarantee details</label>
            </div>
            <input class="sq_form" placeholder="Guarantee details" id="details" name="details" value="<?php echo $asset['details']?>" type="text" >
			<?php echo form_error('details', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Quantity</label>
            </div>
            <input class="sq_form" placeholder="Quantity" id="qlt" name="qlt" value="<?php echo $asset['qlt']?>" type="text" >
			<?php echo form_error('qlt', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Unit</label>
            </div>
            <input class="sq_form" placeholder="Unit" id="unit" name="unit" value="<?php echo $asset['unit']?>" type="text" >
			<?php echo form_error('unit', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Weight</label>
            </div>
            <input class="sq_form" placeholder="Weight" id="weight" name="weight" value="<?php echo $asset['weight']?>" type="text" >
			<?php echo form_error('weight', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Rate</label>
            </div>
            <input class="sq_form" placeholder="Rate" id="rate" name="rate" value="<?php echo $asset['rate']?>" type="text" >
			<?php echo form_error('rate', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Price</label>
            </div>
            <input class="sq_form" placeholder="Price" id="price" name="price" value="<?php echo $asset['price']?>" type="text" >
			<?php echo form_error('price', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Remark</label>
            </div>
            <input class="sq_form" placeholder="Remark" id="remark" name="remark" value="<?php echo $asset['remark']?>" type="text" >
			<?php echo form_error('remark', '<div class="error">', '</div>'); ?>
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
</body>
<script>
function changeimg(){
	var image=$('#upload-photo').val();
	$('#img').attr('src', image);
	$('#img').attr('alt', image);
}
</script>