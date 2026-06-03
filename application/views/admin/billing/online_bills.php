<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Online Bills </h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
        </div>
    </div>
    <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Bill </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <form  action="<?php echo base_url();?>index.php/admin/billing/online_bills" method="post">
                    <div class="input-group">
                      <select id="type" name="status" class="form-control" autofocus="autofocus" style="margin:10px 0;">
                          <option value="">Select Type *</option>
                          <option value="2" <?php if(isset($status)&&$status=="2"){echo "Selected";}?>>Success</option>
                      	  <option value="1" <?php if(isset($status)&&$status=="1"){echo "Selected";}?>>Authorized</option>
                          <option value="0" <?php if(isset($status)&&$status=="0"){echo "Selected";}?>>Failure</option>
                      </select>
                      <input type="date" class="form-control" value="<?php if(isset($dateFrom)){echo $dateFrom;}else{echo date('Y-m-d');}?>" name="date_from" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($dateTo)){echo $dateTo;}else{echo date('Y-m-d');}?>" name="date_to" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                      	<button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($bills)) {?>
	          <div class="table-responsive">
	            <small>&nbsp; Please enter the bill number and press search to view the bill details</small>
<!-- 				<form action="<?php echo base_url();?>index.php/admin/billing/approve_online_bills" method="post"> -->
					<table class="table table-bordered table-hover text-nowrap" width="100%">
					<thead>
						<tr>
						<th scope="col" width="">SL No </th>
						<th scope="col" width="">Date</th>
						<th scope="col" width="">Bill No</th>
						<th scope="col" width="">Customer</th>
						<th scope="col" width="">Diety</th>
						<th scope="col" width="">Amount</th>
						
						</tr>
					</thead>
						<?php 
							$total=0;$rtot=0;
							$role=$this->loggedIn['role'];
							$today=date('Y-m-d');
							if(!empty($bills)){
								foreach($bills as $key => $val) { 
						?>
								<tbody>
									<tr>
										<td><?= $key+1; ?></td>
										<td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
										<td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></a></td>
										<td> <?= $val['customer']; ?> </td>
										<td><?= $val['diety']; ?></td>
										<td><?= $val['total']; ?></td>
									</tr>
								</tbody>
						<?php 
									$total=(int)$total+(int)$val['total'];
								} 
							}
							else {
						?>	
							<tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
						<?php } ?>
						<tfoot>
							<tr>
								<th colspan="5">Total</th>
								<th><?php echo $total;?></th>
							</tr>
						</tfoot>	
					</table>
<!-- 				</form> -->
             </div>
             <?php } ?>
			</div> 
          </div>
	</div>
</div>

<script>
	$('#all_bills').on('click', (e) => { 
    	if(e.target.checked == true) {
        	$('.single-form-check').prop('checked', true)
        } else {
        	$('.single-form-check').prop('checked', false)
        }
    })
	$('#approveBtn').on('click', (e) => {
    	console.log(e.target.value)
    	// $.ajax({
    	// type: "POST",
    	// url: "<?php echo base_url(); ?>index.php/admin/admin/online_bills",
    	// data: {'approve': approve,'bill_ids':bill_ids},
    	// success: function (data) {
    	// data = JSON.parse(data)
    	// console.log()
    	// if(data.exists && data.exists == 1){
    	// alert('Limit exceeded for '+data.pooja+' on '+date);
    	// resolve(false);
    	// } else {
    	// resolve(true);
    	// }
    	// }
    	// });
    })
</script>