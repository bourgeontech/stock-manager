  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt"><?php if($type=="3"){echo $cat="Other";$t="OT";}elseif($type=="4"){ $cat="Bronze";  $t="BR";}elseif($type=="2"){echo $cat="Silver"; $t="SI";}elseif($type=="1"){echo $cat="Gold"; $t="GO";}?> Register</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/donation_view" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;<?php if($type==null){echo "Other";}else{echo $cat;}?> Register </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/register/<?php echo $id;?>" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($bill_list)){?>
	          <div class="table-responsive">
	            <small>&nbsp; Please enter date and press search to view the <?php if($type==null){echo "Other";}else{echo $cat;}?> Register</small>
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">No</th>
					  <th scope="col" width="">Name &amp; Address</th>
                     <th scope="col" width="">Item Name</th>
					  <th scope="col" width="">Unit</th><?php if ($id=="3"){$col=7;?>
					  <th scope="col" width="">Item</th><?php }else {$col=5;}?>
					  <th scope="col" width="" style="text-align: right;">Qty</th>
					  <th scope="col" width="" style="text-align: right;">Weight</th>
					  <th scope="col" width="" style="text-align: right;">Value </th>
					  <th scope="col" width="">Remark</th>
					</tr>
				  </thead>
					<?php 
					$total_weight=0;
					$total_amount=0;
					$total_qty=0;
                        if(!empty($bill_list)){
						$i=0;
	                    foreach($bill_list as $val){
	                        $customer_id=$val['customer_id'];
	                        $this->db->select('*');
	                        $this->db->from('user_dtl');
	                        $this->db->where('id', $customer_id);
	                        $query = $this->db->get()->result_array();
	                                
                ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;diszplay: block;color: #ea6227;"><?= $t."". $val['annotation']; ?></strong></a></td>
					 <td><?php echo $val['name'];?></td>
						 <td><?php echo $val['poojaname'];?></td>
                    <td><?php echo $val['unit'];?></td>
					 <?php if ($id=="3"){?>
					 <td><?php echo $val['pooja'];?></td>
					 <?php }?>
					 <td style="text-align: right;"><?= $val['qlt']; ?></td>
					 <td style="text-align: right;"><?= $val['weight']; ?></td>
					 <td style="text-align: right;"><?= $val['amount']; ?></td>
					 <td><?php echo $val['remark'];?></td>
					</tr>
				  </tbody>
					<?php 

					$total_weight=$total_weight+(float)$val['weight'];
                    $total_amount=$total_amount+(float)$val['amount'];
					$total_qty=$total_qty+$val['qlt'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="8" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="<?php echo $col;?>">Total</th><?php if ($id!="3"){?>
							<th style="text-align: right;"><?php echo $total_qty;?></th><?php }?>
							<th style="text-align: right;"><?php echo $total_weight;?></th>
							<th style="text-align: right;"></th>
						</tr>
					</tfoot>	
				</table>
             </div>
             <?php }?>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
