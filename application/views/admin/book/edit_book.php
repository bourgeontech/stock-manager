<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Unit Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/add_book" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-4 col-md-4 col-sm-4 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Receipt Book </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_book/<?php echo $id;?>" method="post" >
		
      <div class="form_body">
        <div class="row">
	
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Book No <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Book No" id="book_no" name="book_no" value="<?php echo $book['book_no']?>" type="text" >
			<?php echo form_error('book_no', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Sl No From<span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Sl No From" id="from_sl" value="<?php echo $book['from_sl']?>" name="from_sl" min="1" onkeyup="changeno_bills()" onchange="changeno_bills()" type="number" >
			<?php echo form_error('from_sl', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Sl No to<span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Sl No To" id="to_sl" name="to_sl" value="<?php echo $book['to_sl']?>" onkeyup="changeno_bills()" onchange="changeno_bills()" min="1" type="number" >
			<?php echo form_error('to_sl', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">No Of Bills<span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="No Of Bills" id="no_bills" name="no_bills" value="<?php echo $book['no_bills']?>" onfocus="changeno_bills()" onclick="changeno_bills()" min="1" type="number" readonly>
			<?php echo form_error('no_bills', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		  <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Remark</label>
            </div>
            <textarea class="sq_form" row="4" name="remark"><?php echo $book['remark']?></textarea>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Receipt Book </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col">SL No</th>
					  <th scope="col">Book No</th>
					  <th scope="col">Sl From</th>
					  <th scope="col">Sl To</th>
					  <th scope="col">No Of Bills</th>
					  <th scope="col">Remark</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($book_list)){
	                      $i=0;
	                      foreach($book_list as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['book_no']; ?></strong></a></td>
					  <td><?= $val['from_sl']; ?></td>
					  <td><?= $val['to_sl']; ?></td>
					  <td><?= $val['no_bills']; ?></td>
					  <td><?= $val['remark']; ?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_book/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_book/<?= $val['id']; ?>" onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="10">No Data Found</td>
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
<script>
  function changeno_bills(){
    var from_sl=$('#from_sl').val();
    var to_sl=$('#to_sl').val();
    var tot=to_sl-from_sl+1;
    $('#no_bills').val(tot);
  }
</script>