<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Book Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
          <li> <a href="<?php echo base_url();?>index.php/admin/admin/book_issue" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-4 col-md-4 col-sm-4 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Issue</h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_issue/<?php echo $id;?>" method="post" >
		
      <div class="form_body">
        <div class="row">
		
      <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Book Issue Serial Number<span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="Book Issue Serial Number" id="issue_id" name="issue_id" value="<?php echo $issue['issue_id']?>" type="text" >
			<?php echo form_error('issue_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Book No <span class="red">*</span> </label>
            </div>
            <select class="sq_form" id="book_id" name="book_id" onchange="changebook()" require>
              <option value="">Select</option>
              <?php foreach($book_list as $book){?>
                <option value="<?php echo $book['id'];?>" <?php if($issue['book_id']==$book['id']){echo "selected";}?>><?php echo $book['book_no'];?></option>
              <?php }?>
            </select>
			        <?php echo form_error('book_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Sl No From<span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Sl No From" id="from_sl" name="from_sl" min="1" value="<?php echo $issue['from_sl']?>" onkeyup="changeno_bills()" onchange="changeno_bills()" type="number" >
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
            <input class="sq_form" placeholder=" Sl No To" id="to_sl" name="to_sl" value="<?php echo $issue['to_sl']?>" onkeyup="changeno_bills()" onchange="changeno_bills()" min="1" type="number" >
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
            <input class="sq_form" placeholder="No Of Bills" id="no_bills" name="no_bills" value="<?php echo $issue['nos']?>" onfocus="changeno_bills()" onclick="changeno_bills()" min="1" type="number" readonly>
			<?php echo form_error('no_bills', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Issue Date<span class="red">*</span> </label>
            </div>
            <input class="sq_form" id="issue_date" name="issue_date" type="date" value="<?php echo $issue['issue_date']?>">
			      <?php echo form_error('issue_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Issued User <span class="red">*</span> </label>
            </div>
            <select class="sq_form" id="is_user" name="is_user" require>
              <option value="">Select</option>
              <?php foreach($user_list as $user){?>
                <option value="<?php echo $user['id'];?>" <?php if($issue['is_user']==$user['id']){echo "selected";}?>><?php echo $user['name'];?></option>
              <?php }?>
            </select>
			        <?php echo form_error('is_user', '<div class="error">', '</div>'); ?>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of issue Book </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col">Issue #</th>
					  <th scope="col">Book No</th>
					  <th scope="col">No Of Bills</th>
					  <th scope="col">issue Date</th>
					  <th scope="col">Status</th>
					  <th scope="col">User</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($issue_list)){
	                      $i=0;
	                      foreach($issue_list as $val){ 
                          $status=$val['book_status'];
                          if($status=="Issued"){
                            $color="yellow";
                          }elseif($status=="Active"){
                            $color="green";
                          }elseif($status=="Compleated"){
                            $color="red";
                          }
                          ?>
				  <tbody>
					<tr style="background-color:<?= $color;?>">
					  <td><?= $val['issue_id']; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['book_no']; ?></strong></a></td>
					  <td><?= $val['nos']; ?></td>
					  <td><?= date('d-m-Y',strtotime($val['issue_date'])); ?></td>
					  <td><?= $val['book_status']; ?></td>
					  <td><?= $val['name']; ?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_issue/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_book_issue/<?= $val['id']; ?>" onclick="return confirm('Are you sure you want to delete?')"
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
  function changebook(){
    var book_id=$('#book_id').val();
    var url = "<?php echo base_url(); ?>index.php/admin/admin/getbookdtl";
    $.ajax({
        type: "GET",
        url: url,
        data: {'book_id': book_id},
        dataType: "json",
        success: function (data) {
          $('#from_sl').val(data.from_sl);
          $('#to_sl').val(data.to_sl);
          $('#no_bills').val(data.no_bills);
        }
    });
  }
</script>