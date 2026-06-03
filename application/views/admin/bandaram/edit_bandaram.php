<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Bandaram Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/bandaram" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-4 col-md-4 col-sm-4 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Bandaram </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_bandaram/<?php echo $id;?>" method="post" >
		
      <div class="form_body">
        <div class="row">
		
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Name" id="name" name="name" value="<?php echo $category['name']?>" type="text" >
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
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
			<div class="col-lg-8 col-md-8 col-sm-8 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Bandaram </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="20%">SL No</th>
					  <th scope="col" width="60%">Name</th>
					  <th scope="col" width="20%">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($bandaram_list)){
	                      $i=0;
	                      foreach($bandaram_list as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['name']; ?></strong></a></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_bandaram/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_bandaram/<?= $val['id']; ?>"   onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="4">No Data Found</td>
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