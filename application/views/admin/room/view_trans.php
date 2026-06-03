<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Room Transaction</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/room_trans" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Room Transactions </h2>
              </div>
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/trans_filter" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control col-sm-3" value="<?php if(isset($from)){echo $from;}?>" title="Date From" name="from" style="margin:10px 0;">
                      <?php echo form_error('from', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control col-sm-3" value="<?php if(isset($to)){echo $to;}?>" title="Date To" name="to" style="margin:10px 0;">
                      <?php echo form_error('to', '<div class="error">', '</div>'); ?>
                      <input class="form-control col-sm-3" name="mnth_yr" value="<?php if(isset($mnth_yr)){echo $mnth_yr;}?>" type="month" title="Month , Year" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="search" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                      	<button type="submit" class="btn btn-outline-primary" name="serch" value="print" title="Print Report"><i class="fa fa-file" aria-hidden="true"></i></button> 
                      </div>
                    </div>
                  </form>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col">SL No</th>
					  <th scope="col">Room No</th>
					  <th scope="col">Customer</th>
					  <th scope="col">Rent</th>
					  <th scope="col">Month , Year</th>
					  <th scope="col">Received Amount</th>
					  <th scope="col">Date</th>
					  <th scope="col">Balance</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($trans_list)){
	                      $i=0;
						  $rent_tot=0;
						  $rec_tot=0;
						  $bal_tot=0;
	                      foreach($trans_list as $val){ 
                          $date=$val['year']."-".$val['month']."-1";
                		$room_id=$val['room_id'];
                		$cust_id=$val['cust_id'];
                        $room = $this->db->query("SELECT * FROM room_dtl WHERE id='$room_id'")->row_array();
                        $cust = $this->db->query("SELECT * FROM room_cust WHERE id='$cust_id'")->row_array();
                          $rent_tot=$rent_tot+$val['rent'];
						  $rec_tot=$rec_tot+$val['rent_recv'];
						  $bal_tot=$bal_tot+$val['rent']-$val['rent_recv'];
                ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?= $room['room_no']; ?></td>
					  <td><?= $cust['name']; ?></td>
					  <td class="text-right"><?= $val['rent']; ?></td>
					  <td><?php echo date('F,Y',strtotime($date));?></td>
					  <td class="text-right"><?= $val['rent_recv']; ?></td>
					  <td><?php if($val['rent_recvdt']){ echo date('d-m-Y',strtotime($val['rent_recvdt']));} ?></td>
					  <td class="text-right"><?= $val['rent']-$val['rent_recv']; ?></td>
					  <td><div class="btn-group">
                      	  <a href="<?php echo base_url();?>index.php/admin/admin/print_trans/<?= $val['id']; ?>" class="btn btn-outline-primary" style="padding:6px;" title="Print"> <i class="fa fa-file"></i></a>
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_trans/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_trans/<?= $val['id']; ?>"   onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="8">No Data Found</td>
						  </tr>
				    <?php } ?>	
                	<tfoot>
                    	<tr>
                        	<th colspan="3">Total</th>
                        	<th class="text-right"><?= $rent_tot;?></th>
                        	<th class="text-right"></th>
                        	<th class="text-right"><?= $rec_tot;?></th>
                        	<th class="text-right"></th>
                        	<th class="text-right"><?= $bal_tot;?></th>
                        	<th class="text-right"></th>
                    	</tr>
                	</tfoot>
				</table>
             </div>
			</div> 
          </div>
          </div>
  </div>
<div class="clearfix"></div>
<br>
</body>