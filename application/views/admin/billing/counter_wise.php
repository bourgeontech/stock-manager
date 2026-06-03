  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Counterwise Report</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Counter wise Daily Collection</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/counter_wise" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}?>" title="Date From" required name="datef" style="margin:10px 0;">
                      <?php echo form_error('datef', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}?>" title="Date To" required name="datet" style="margin:10px 0;">
                      <?php echo form_error('datet', '<div class="error">', '</div>'); ?>
                     <select name="time" id="time" class="form-control" style="margin:10px 0;">
					  <option value="">Select Time</option>
					  <option <?php if(isset($time)){ if($time=='M') { echo "selected";} } ?>  value="M">M</option>
					  <option <?php if(isset($time)){ if($time=='E') { echo "selected";} } ?> value="E">E</option>
					  <option <?php if(isset($time)){ if($time=='A') { echo "selected";} } ?> value="A">A</option>
					  </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" onclick="printcontend('printer')" name="print" value="print" title="Print Summary"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive" id="printer" onafterprint="myFunction()">
				<table class="table table-bordered table-hover text-nowrap" width="100%" style="font-size:16px;font-weight:600;">
				  <thead>
				  	<tr id="header12" style="display:none;">
    					<td colspan="9" style="width: 100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					<strong style="margin-bottom: 5px;color: #ea6227;">Counter Wise Daily Collection</strong></h4>
                        <h5 style="text-align:center">Counter wise report between <?= date('d M Y', strtotime($datef)); ?> and <?= date('d M Y', strtotime($datet)); ?></h5>
    					</td>
    				</tr>
                  
                  <tr><td colspan="9" align="center"> Bill  No From  <?php echo $start_bill?>  Bill no to  <?php echo $end_bill; ?></td></tr>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Counter</th>
					
                        <th style="width: 20%">Cash</th>
                     <th style="width: 20%">Qrcode</th>
                    <th style="width: 20%">Postal</th>
                     <th style="width: 20%">NEFT</th>
                    <th style="width: 20%">Card</th>
                    <th style="width: 20%">MO</th>
                   <th style="width: 20%">others</th>
					  <th scope="col" style="text-align:right">Total Booking</th>
					</tr>
				  </thead>
					<?php
                	$credit_total_amount = 0;
					$tot_bk="0";  $today=date("Y-m-d");$paymentrecvd=0;
                  	$gqrtot=0;
                    $gcardtot=0;
                    $gmotot=0;
                    $gothertot=0;
                    $i=0;;$qrtot=0;$cashtot=0;$totalcash=0;$totalqr=0;$totalothers=0;$totalpostal=0;$totalneft=0;
                	$role=$this->loggedIn['role'];
                    $this->db->select('SUM(billing_dtls.amount) as tot_booking,counter.name as countername,billing.mode as mode,counter');
                    $this->db->from('billing');
                    // $this->db->join('billing','billing.user_id = admin.id');
                    $this->db->join('counter','billing.counter = counter.id');
                    $this->db->join('billing_dtls','billing_dtls.bill_id = billing.id');
                	if (@$time!=''){
					$this->db->where('billing_dtls.time', $time);	
					}
                    if (isset($datef)&&$datef!=""&&$datet!=""){
                        $this->db->where("billing.date BETWEEN '$datef' AND '$datet' AND billing.deleted='0'");
                    } else { $this->db->where("billing.date = '$today' AND billing.deleted='0'"); }
                	/**if ($role!="superadmin"){
                    	$this->db->where('admin.role', $role);
                    }*/
                    $this->db->group_by('billing.counter');
                
                    $bill_list = $this->db->get()->result_array();

               
                    //payment collected 
                //     $paymentcollected= $this->db->query("SELECT sum(payment.amount) as tot_recvd  FROM `payment` join billing on payment.ref_no=billing.id where 1
                //$cond and payment.mode=9");
                //$paymentrecvd=$paymentcollected->row()->tot_recvd;
                    
                   
                    foreach($bill_list as $val){ 
                        $tot_booking=$val['tot_booking'];
                        $tot_bk=$tot_bk+$tot_booking;
                    $counter=$val['counter'];
                    $today=date("Y-m-d");
                     if (isset($datef)&&$datef!=""&&$datet!=""){
                       $cond="and billing.date BETWEEN '$datef' AND '$datet' AND billing.deleted='0'";
                     	// $p_cond="and payment.payment_date BETWEEN '$datef' AND '$datet' AND billing.deleted='0'";
                    }else { 
                     $cond="and billing.date ='$today' AND billing.deleted='0'";
                     // $p_cond="and payment.payment_date ='$today' AND billing.deleted='0'";
                     }
                    
                    
                    $query= $this->db->query("select sum(billing_dtls.amount) as total, sum(billing.bal_amt) as totalcre, sum(billing_dtls.postal_amt) as postal_amt from billing_dtls join billing  on billing_dtls.bill_id=billing.id where counter='$counter' and mode=1 $cond ");
                //    print "select sum(total) as total from billing where counter='$counter' and mode=1 $cond ";
                    $collection = $query->row();
                    
                    $cashtot=$collection->total + $collection->postal_amt;
                    
                    $cashcre_query = $this->db->query("SELECT sum(billing.bal_amt) as totalcre from  billing where billing.counter='$counter' and mode=1 $cond");
                    $totalcashcre=$cashcre_query->row()->totalcre;
                    
                  //  print "SELECT sum(billing.bal_amt) as totalcre from  billing where billing.counter='$counter' and mode=1 $cond";
                    // print_r($totalcashcre." ".$cashtot." ".($cashtot - $totalcashcre));
                    $cashtot = $cashtot - $totalcashcre;
                    
					// print_r($totalcashcre." ".$cashtot);
                    $totalcash+=$cashtot;
                    
                    
                   $counter=$val['counter'];
                   $query2=  $this->db->query("select sum(billing_dtls.amount) as total, sum(billing.bal_amt) as totalcre, sum(billing_dtls.postal_amt) as postal_amt from billing_dtls join billing  on billing_dtls.bill_id=billing.id 
                   where  billing.counter= $counter and billing.mode=6 $cond");
                 
                    $collection2 = $query2->row();
                    $qrtot=$collection2->total+ $collection2->postal_amt;
                    $qrcre_query = $this->db->query("SELECT sum(billing.bal_amt) as totalcre from  billing where billing.counter='$counter' and mode=6 $cond");
                    $totalqrcre=$qrcre_query->row()->totalcre;
                    $qrtot = $qrtot - $totalqrcre;
                    $totalqr+=$qrtot;
                    
                     $query5=  $this->db->query("select sum(billing_dtls.amount) as total, sum(billing.bal_amt) as totalcre, sum(billing_dtls.postal_amt) as postal_amt from billing_dtls join billing  on billing_dtls.bill_id=billing.id 
                   where  billing.counter= $counter and billing.mode=5 $cond");
                 
                    $collection5 = $query5->row();
                    $nefttot=$collection5->total + $collection5->postal_amt;
                    $neftcre_query = $this->db->query("SELECT sum(billing.bal_amt) as totalcre from  billing where billing.counter='$counter' and mode=5 $cond");
                    $totalneftcre=$neftcre_query->row()->totalcre;
                    $nefttot = $nefttot - $totalneftcre;
                    $totalneft+=$nefttot;
                    
                    
                       $query3=  $this->db->query("select sum(billing_dtls.amount) as total, sum(billing.bal_amt) as totalcre, sum(billing_dtls.postal_amt) as postal_amt from billing_dtls join billing  on billing_dtls.bill_id=billing.id 
                   where  billing.counter= $counter  and billing.mode=9 $cond");
                  //  print "select sum(total) as total from billing where  counter='$counter' and (mode!='6' and  mode!='1') $cond";
                    $collection3= $query3->row();
                    $othertot=$collection3->total+ $collection3->postal_amt;
                    $othercre_query = $this->db->query("SELECT sum(billing.bal_amt) as totalcre from  billing where billing.counter='$counter' and mode=9 $cond");
                    $totalothercre=$othercre_query->row()->totalcre;
                    $othertot = $othertot - $totalothercre;
                    
                    $query4=$this->db->query("SELECT sum(postal_amt) as postal from  billing_dtls join billing on billing_dtls.bill_id=billing.id 
                    where  billing.counter='$counter' $cond");
                    
                     $collection4= $query4->row();
                    
                    $query6=  $this->db->query("select sum(billing_dtls.amount) as total, sum(billing.bal_amt) as totalcre, sum(billing_dtls.postal_amt) as postal_amt from billing_dtls join billing  on billing_dtls.bill_id=billing.id 
                   where  billing.counter= $counter  and billing.mode=7 $cond");
                  //  print "select sum(total) as total from billing where  counter='$counter' and (mode!='6' and  mode!='1') $cond";
                
                 //   print "select sum(total) as total from billing join billing_dtls on billing.id=billing_dtls.bill_id left join pooja on pooja.id=billing_dtls.pooja where  counter='$counter' and mode=7 $cond";
                    $collection6= $query6->row();
                    $cardtot=$collection6->total+ $collection6->postal_amt;
                    $cardcre_query = $this->db->query("SELECT sum(billing.bal_amt) as totalcre from  billing where billing.counter='$counter' and mode=7 $cond");
                    $totalcardcre=$cardcre_query->row()->totalcre;
                    $cardtot = $cardtot - $totalcardcre;
                   // $cardtot=$cardtot;
                    $gcardtot+=$cardtot;
                    
                    $query8=  $this->db->query("select sum(billing_dtls.amount) as total, sum(billing.bal_amt) as totalcre, sum(billing_dtls.postal_amt) as postal_amt from billing_dtls join billing  on billing_dtls.bill_id=billing.id 
                   where  billing.counter= $counter and (mode=4 or mode=8) $cond");
                  //  print "select sum(total) as total from billing where  counter='$counter' and (mode!='6' and  mode!='1') $cond";
                    $collection8= $query8->row();
                    $motot=$collection8->total+ $collection8->postal_amt;
                    $mocre_query = $this->db->query("SELECT sum(billing.bal_amt) as totalcre from  billing where billing.counter='$counter' and (mode=4 or mode=8) $cond");
                    $totalmocre=$mocre_query->row()->totalcre;
                    $motot = $motot - $totalmocre;
                    //$motot=$motot
                    $gmotot+=$motot;
                    
                    $postal_amt=$collection4->postal;
                    
                   // $othertot=$othertot+$totalcre;
                    $tot_booking=$tot_booking;
                    $totalothers+=$othertot;
                    $totalpostal+=$postal_amt;
                   // $ttotalnef+=
                        
               		$credit_total_amount = $totalcashcre + $totalqrcre + $totalneftcre + $totalothercre + $totalcardcre + $totalmocre;
                    
                ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					 <td><?= $val['countername'];?></td>
                    <td>&nbsp;<?php if($cashtot > 0 ) { echo $cashtot; }?></td>
               <td>&nbsp;<?php  echo $qrtot;?></td>
                     <td>&nbsp;<?php  echo @$postal_amt;?></td>
                     <td>&nbsp;<?php  echo @$nefttot;?></td>
                     <td>&nbsp;<?php  echo @$cardtot;?></td>
                      <td>&nbsp;<?php echo @$motot;?></td>
                   <td>&nbsp;<?php  echo @$othertot;?></td>
					 <td style="text-align:right"><?= number_format((float)(@$cashtot+@$qrtot+@$nefttot+@$cardtot+@$motot+@$othertot), 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php }?>
					<tfoot>
					  <tr>
                       <th colspan="2">&nbsp;</th>
                    <th ><?= number_format((float)($totalcash), 2, '.', '');?></th>
					    <th ><?= number_format((float)$totalqr, 2, '.', '');?></th>
					     <th ><?= number_format((float)$totalpostal, 2, '.', '');?></th>
                        <th ><?= number_format((float)$totalneft, 2, '.', '');?></th>
                       <td>&nbsp;<?php  echo number_format((float)$gcardtot, 2, '.', '');?></td>
                      <td>&nbsp;<?php  echo number_format((float)$gmotot, 2, '.', '');?></td>
                      
                       <th ><?= number_format((float)$totalothers, 2, '.', '');?></th>
					    <th style="text-align:right"><?= number_format((float)($totalcash+$totalqr+$totalneft+$gcardtot+$gmotot), 2, '.', '');?></th>
					  </tr>
                     
					</tfoot>
				</table>
              	<?php
              		$credit_total = 0;
              		$credit_total_cash = 0;
              		$credit_total_bank = 0;
              		$bill_ids = '';
              	
              		$creditArray = [];
              		$this->db->select('payment.mode as mode, ledger.name as ledger, billing.id, SUM(payment.amount) as total');
              		$this->db->from('payment');
              		$this->db->join('billing', 'billing.id=payment.ref_no');
              		$this->db->join('ledger', 'ledger.led_Id=payment.mode');
              		$this->db->where('payment.payment_date >=', $datef);
              		$this->db->where('payment.payment_date <=', $datet);
              		$this->db->where('payment.type', 2);
              		$this->db->group_by('payment.mode');
              		$query = $this->db->get();
              		
              		if($query->num_rows() > 0) {
                    	$r = $query->result();
                    	foreach($r as $key => $result) {
							if($result->mode == 9) {
                            	$credit_total_cash +=$result->total;
                            } else {
                            	$credit_total_bank +=$result->total;
                            }
                        	$credit_total += $result->total;
                        	$bill_ids .= $key == 0 ? '' : ',';
                        	$bill_ids .= $result->id;
                        }
                    }
              
              		
              	?>
              	<table  class="table table-bordered table-hover text-nowrap" width="100%">
                	 <tr>
                       		<th colspan="2">&nbsp;</th>
                    		<th colspan="7">TODAY RECEIVED(CASH)</th>
                       		<th style="text-align:right"><?= number_format((float)($totalcash), 2, '.', '');?></th>	
					 </tr>
                	 
                	 <tr>
                       		<th colspan="2">&nbsp;</th>
                    		<th colspan="7">Old Balance Recieved ( CASH)
<!--                             				( Bills: <?= $bill_ids; ?> ) -->
                     		</th>
                       		<th style="text-align:right"><?= number_format((float)$credit_total_cash, 2, '.', '');?></th>	
					  </tr>
                 <tr>
                       		<th colspan="2">&nbsp;</th>
                    		<th colspan="7">TOTAL CASH IN HAND</th>
                       		<th style="text-align:right;font-style:italic;border-bottom:1px solid #000;"><?= number_format((float)($totalcash+$credit_total_cash), 2, '.', '');?></th>	
					  </tr>
             
                	  <tr>
                       		<th colspan="2">&nbsp;</th>
                    		<th colspan="7">Old Balance Recieved ( BANK)
<!--                             				( Bills: <?= $bill_ids; ?> ) -->
                     		</th>
                       		<th style="text-align:right"><?= number_format((float)$credit_total_bank, 2, '.', '');?></th>	
					  </tr>
                	 
              	</table>
             </div>
			</div> 
         	
         	
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script>
    	window.onfocus = function () { myFunction(); }
    	function myFunction(){
			$('#header12').css('display','none');
        }
    	function printcontend(value) {
    		$('#header12').removeAttr('style');
    		var restorpage=document.body.innerHTML;
    		var printcontend=document.getElementById(value).innerHTML;
    		document.body.innerHTML=printcontend;
    		window.print();
    		document.body.innerHTML=restorpage;
    	}
    </script>