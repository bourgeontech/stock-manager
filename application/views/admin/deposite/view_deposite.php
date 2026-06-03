<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> DEPOSIT MODULE </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/deposite" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Deposit </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Type</th>
					  <th scope="col" width="">A/c No</th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Bank</th>
					  <th scope="col" width="">Amount</th>
					  <th scope="col" width="">Interest</th>
					  <th scope="col" width="">Period</th>
					  <th scope="col" width="">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($deposite)){
	                      $i=0;
	                      foreach($deposite as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?php echo $val['ac_type'];?></td>
					  <td><?php echo $val['ac_no'];?></td>
					  <td><?php echo date('d-m-Y',strtotime($val['ac_date']));?></td>
					  <td><?php echo $val['name'];?></td>
					  <td><a href="#"> <strong style="color: #ea6227;"><?= $val['bank_nm']; ?></strong></a><br><?= $val['bank_address']; ?></td>
					  <td><?php echo $val['amount'];?></td>
					  <td><?php echo $val['int_perc'];?>%</td>
					  <td><?php echo $val['period'];?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_deposite/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  </div>
					  </td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="9">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				</table>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>