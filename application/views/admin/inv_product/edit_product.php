<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Product Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/inv_product" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-4 col-md-4 col-sm-4 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add New Product </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_inv_product/<?php echo $id;?>" method="post" >
		
      <div class="form_body">
        <div class="row">
		
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Code</label>
            </div>
            <input class="sq_form" placeholder=" Code" id="code" name="code" value="<?php echo $category['code']?>" type="text" >
			<?php echo form_error('code', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Name" id="name" name="name" value="<?php echo $category['name']?>" type="text" required>
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">In Malayalam <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" In Malayalam" id="name_mal" name="name_mal" value="<?php echo $category['name_mal']?>" type="text" >
			<?php echo form_error('name_mal', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Unit Of Measure <span class="red">*</span></label>
            </div>
            <select name="unit" id="unit" class="sq_form" required>
            	<option value="">Select Unit</option>
			<?php foreach($unit_list as $val){ ?>
				<option value="<?= $val['id']; ?>" <?php if($category['unit']==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
			<?php } ?>
			</select>
			<?php echo form_error('unit', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Category <span class="red">*</span></label>
            </div>
            <select name="cat_id" id="cat_id" class="sq_form" required>
            	<option value="">Select Category</option>
			<?php foreach($cat_list as $val){ ?>
				<option value="<?= $val['id']; ?>" <?php if($category['cat_id']==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
			<?php } ?>
			</select>
			<?php echo form_error('cat_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Price <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Price" id="price" name="price" value="<?php echo $category['price']?>" type="text" required>
			<?php echo form_error('price', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
<!--       <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Stock</label>
            </div>
            <input class="sq_form" placeholder=" Stock" id="stock" name="stock" value="<?php echo $category['stock']?>" type="text" >
			<?php echo form_error('stock', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div> -->
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
			<div class="col-lg-8 col-md-8 col-sm-8 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Product </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Code</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Unit</th>
					  <th scope="col" width="">Category</th>
					  <th scope="col" width="">Price</th>
					  <th scope="col" width="">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($category_list)){
	                      $i=0;
	                      foreach($category_list as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['code']; ?></strong></a></td>
					  <td><?= $val['name']; ?></td>
					  <td><?= $val['unit_nm']; ?></td>
					  <td><?= $val['cat_nm']; ?></td>
					  <td><?= $val['price']; ?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_inv_product/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_inv_product/<?= $val['id']; ?>"   onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="8">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				</table>
             </div>
			</div> 
          </div>
          </div>
  </div>
<div class="clearfix"></div>
<br>
</body>