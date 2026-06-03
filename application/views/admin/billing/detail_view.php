  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Billing Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing_view" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Detailed View</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
<!--               <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/mookkolakallu" class="btn btn-primary">Mookkolakallu Reg</a> </li>
                  </ul>
              </div>  -->
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/detail_view" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($from)){echo $from;}else{echo date('Y-m-d');}?>" title="Date From" required name="from" style="margin:10px 0;">
                      <?php echo form_error('from', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($to)){echo $to;}else{echo date('Y-m-d');}?>" title="Date To" required name="to" style="margin:10px 0;">
                      <?php echo form_error('to', '<div class="error">', '</div>'); ?>
                      <select name="diety" id="diety" class="form-control" autofocus="autofocus" style="margin:10px 0;height:auto;" required>
                          <option value="">Select Diety</option>
                          <option value="0" Selected>---All---</option>
            		  <?php foreach($diety_list as $val){ ?>
            			  <option value="<?= $val['id']; ?>" <?php if(isset($diety)&&$diety==$val['id']){echo "Selected";}?>><?=$val['name']; ?></option>
            		  <?php } ?>
            		  </select>
                  
            		  <?php echo form_error('diety', '<div class="error">', '</div>'); ?>
            		  <select id="type" name="type" class="form-control" autofocus="autofocus" style="margin:10px 0;height:auto;">
                          <option value="">Select Type</option>
                          <option value="1" <?php if(isset($type)&&$type=="1"){echo "Selected";}?>>Cash Payment</option>
                          <option value="2" <?php if(isset($type)&&$type=="2"){echo "Selected";}?>>Online Payment</option>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                       <button type="submit" class="btn btn-outline-secondary" name="printdatewise" value="printdatewise" title="Print Datewise"><i class="fa fa-print" aria-hidden="true"></i></button>
                    </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($from)){?>
	          <div class="table-responsive">
              	<small>Pooja booking done between <?php echo date('d-m-Y',strtotime($from));?> To <?php echo date('d-m-Y',strtotime($to));?><small>
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name of the Pooja</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" style="text-align:right">Rate</th>
                      <th scope="col" style="text-align:right">Cash</th>
                      <th scope="col" style="text-align:right">UPI</th>
                     <th scope="col" style="text-align:right">NEFT</th>
                     <th scope="col" style="text-align:right">CARD</th>
                     <th scope="col" style="text-align:right">MO</th>
                     <th scope="col" style="text-align:right">Total <br/> <small>( Except postal charges )</small> </th>
                     <th scope="col" style="text-align:right">Postal Charges</th>
                      <!--  <th scope="col" style="text-align:right">Received Amount</th>
                      <th scope="col" style="text-align:right">Balance Amount</th>-->
					  <th scope="col" style="text-align:right">Amount</th>
					</tr>
				  </thead>
					<?php 
					$tot="0";$postal_amt_tot=0;  $cashtot=0;
                        $qrtot=0;$cardtot=0;$nefttot=0;$motot=0;
					$gross_total = 0;
					if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){ 
	                        $qty=$val->quantity;
	                        $pooja_rt=$val->pooja_rt;
                            $postal_amt=$val->postal_amt;
	                             
                         // $amt=$val->amt;
                         //if($val->diety_id;
                       // $amt=$val->amt;
                       
                       if($val->pooja_id=='9000'){$amt=$val->amt;}else{
                        $amt=$val->amt;}
                            $gross=$amt+$postal_amt;
	                        $tot+=$gross;
                            $postal_amt_tot+=$postal_amt;
                        	$recvd_amt = $val->recv_amt;
                        	$bal_amt = $val->bal_amt;
                      		$gross_total += $amt;
                       // $cashtot+=$val->amount_array[1];
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					 <td><?= $val->pooja; ?></td>
					 <td><?= $qty;?></td>
					 <td style="text-align:right"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[1] > 0 ){$cashtot+= $val->amount_array[1];echo $val->amount_array[1] ?? 0;}?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[6] > 0 ){$qrtot+=$val->amount_array[6];echo $val->amount_array[6] ?? 0;}?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[5] > 0 ){$nefttot+=$val->amount_array[5];echo $val->amount_array[5] ?? 0;}?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[7] > 0 ){$cardtot+=$val->amount_array[7];echo $val->amount_array[7] ?? 0;}?></td>
                     <td style="text-align:right"><?php if(@$val->amount_array[8] > 0 ){$motot+=$val->amount_array[8];echo $val->amount_array[8] ?? 0;}?></td>
                     <td style="text-align:right"><?php echo $amt;?></td>
                     <td style="text-align:right"><?php echo $postal_amt;?></td>
                  
                    <!--  <td style="text-align:right"><?php echo $recvd_amt;?></td>
                     <td style="text-align:right"><?php echo $bal_amt;?></td>-->
					 <td style="text-align:right"><?= number_format((float)$gross, 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php } }
                     else {
					?>	
					<tbody><tr><td colspan="12" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
    					<tr>
    					   
                       
    					 <th colspan="4">Total</th>
                         <th style="text-align:right"><?= number_format((float)$cashtot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$qrtot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$nefttot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$cardtot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$motot, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$gross_total, 2, '.', '');?></th>
                         <th style="text-align:right"><?= number_format((float)$postal_amt_tot, 2, '.', '');?></th>
    					 <th style="text-align:right"><?= number_format((float)$tot, 2, '.', '');?></th>
					    </tr>
                    
                    	<tr>
    					 <th colspan="12">Total Cash in Hand: <?= number_format((float)($cashtot+$motot), 2, '.', '');?></th>
                         
					    </tr>
					</tfoot>
				</table>
             <div>
             <?php if(!empty(@$bill_listdeleted)){ ?>
             <small>Pooja booking Deleted between <?php echo date('d-m-Y',strtotime($from));?> To <?php echo date('d-m-Y',strtotime($to));?><small>
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Diety</th>
					  <th scope="col" width="">Total</th>
                     <th scope="col" width="">Recvd</th>
                     <th scope="col" width="">Balance</th>
                     <th scope="col" width="">Delete Date</th>
                     <th scope="col" width="">Reason</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
					<?php 
                        $total=0;$rtot=0;
                        $role=$this->loggedIn['role'];

                                                  $today=date('Y-m-d');
                        $query1 = $this->db->query("SELECT pay_id FROM `payment` where payment_date='$today' AND (ledger='6' OR ledger='7')")->result_array();
                        if(!empty($bill_list)){
						$i=0;$baltot=0;$rtot=0;
	                    foreach($bill_listdeleted as $val){
	                        $count=$val['count'];
	                        $status=$val['status'];
	                        if ($count=="0"&&$status=="1"){
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }else {
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }
	                        $this->db->select('billing.*,SUM(billing_dtls.amount) as tot');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls ','billing_dtls.bill_id=billing.id');
	                      
	                        $this->db->where('billing.id', $val['id']);
	                        $query = $this->db->get()->result_array();
                       
                        $balance=$query[0]['tot']-$query[0]['recv_amt'];
                    
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></a></td>
					 <td><?= $val['diety']; ?></td>
					 <td><?= $query[0]['tot']; ?></td>
                     <td><?= $query[0]['recv_amt']; $rtot+=$query[0]['recv_amt'] ?></td>
                     <td><?= $balance; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['dl_date'])); ?></td>
					 <td><?= $val['dl_reason']; ?></td>
			 		  <td><div class="btn-group">
						  <a href="<?php echo $href; ?>" class="btn btn-outline-primary" title="Print"> <i class="fa fa-print"></i></a>
						 </div>
					  </td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$query[0]['tot'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="12" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="3">Total</th>
							<th><?php echo $total;?></th>
                        <th><?php echo $rtot;?></th>
                        <th><?php echo ($total-$rtot);?></th>
							<th colspan="3"></th>
						</tr>
					</tfoot>	
				</table>
             <?php }?>
             <?php }?>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>