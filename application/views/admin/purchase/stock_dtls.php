  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Stock Report</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/stock_report" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;View Stock Report </h2>
              </div>
			 </div>
	         <?php if(isset($stock_list)){?>
			  <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Mode</th>
					  <th scope="col" width="">Unit</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" width="">Ref No</th>
					</tr>
				  </thead>
					<?php 
					$total=0;
					if(!empty($stock_list)){
						$i=0;
						foreach($stock_list as $val){
	                        ?>
				  <tbody>
					<tr>
					  <td><?php echo ++$i; ?></td>
					  <td><?php echo date('d-m-Y',strtotime($val['added_date'])); ?></td>
					  <td><?php echo $val['mode']; ?></td>
					  <td><?php echo $val['unit_nm']; ?></td>
					  <td><?php echo $val['qty']; ?></td>
					  <td><?php echo $val['ref_id']; ?></td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$val['qty'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="3">Total</th>
							<th><?php echo $total; ?></th>
							<th></th>
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
