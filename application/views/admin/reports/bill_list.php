  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Date Wise Report</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Date wise Daily Collection</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/report/bill_report" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}?>" title="Date From" required name="datef" style="margin:10px 0;">
                      <?php echo form_error('datef', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}?>" title="Date To" required name="datet" style="margin:10px 0;">
                      <?php echo form_error('datet', '<div class="error">', '</div>'); ?>

                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="search" value="search" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary"  name="search" value="print"  title="Print Summary"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive" id="printer" onafterprint="myFunction()">
              	<table class="table table-bordered table-hover text-nowrap" width="100%">
                	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;margin-bottom:2px;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?> <br>  <br> 					
                        <?php print_r($temple_list[0]['phone']);?></h4>

    					</td>
    				</tr>
    				<tr>
    					<th colspan="5"><label style="text-align:center;">Daily Collection Report From : <?php echo date('d-m-Y',strtotime($datef));?></label>
    					    <label style="float:center;">To : <?php echo date('d-m-Y',strtotime($datet));?></label>
    				    </th>
                    	<th colspan="5">
                         <p> Generated On
                        <?php
							$date = date('d-m-y h:i:s');
							echo  $date;
							?>
                        </p>
                    	</th>
    				</tr>
              	</table>
              
               <?php $grand_total = 0; $grand_total_cash=0; $grand_total_qr=0; $grand_total_card=0; $grand_total_mo=0; $grand_total_neft=0; $grand_total_app=0;$grand_total_online=0;?>
              	<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  	<th style="width: 5%">SL No </th>
					  	<th style="width: 10%">Date</th>
                        <th style="width: 10%">Cash</th>
                     	<th style="width: 10%">Qrcode</th>
                    	<th style="width: 10%">Card</th>
                    	<th style="width: 10%">MO</th>
<!-- 						<th style="width: 10%">Online</th> -->
                     	<th style="width: 10%">NEFT</th>
                    	<th style="width: 10%">Mobile App</th>
					  <th scope="col" style="text-align:right; width: 15%">Total Booking</th>
					</tr>
				  </thead>
					<?php 

					$tot_bk="0";  $today=date("Y-m-d");
                    $i=0;;$qrtot=0;$cashtot=0;$gcashtot=0;$gapptot=0;
                	$gonline_tot=0;
                    $gqrtot=0;
                    $gcardtot=0;
                    $gmotot=0;
                    $gothertot=0;
                	$role=$this->loggedIn['role'];
                    $this->db->select('admin.name,admin.role,SUM(billing_dtls.amount) as tot_booking,billing.date as billing_date,billing.mode as mode,billing.counter');
                    $this->db->from('admin');
                    $this->db->join('billing','billing.user_id = admin.id');
                    $this->db->join('counter','billing.counter = counter.id');
                    $this->db->join('billing_dtls','billing_dtls.bill_id = billing.id');
                	$this->db->join('pooja', 'pooja.id = billing_dtls.pooja', 'LEFT');
                
                    if (isset($datef)&&$datef!=""&&$datet!=""){
                        $this->db->where("billing.date BETWEEN '$datef' AND '$datet' AND billing.deleted='0'");
                    } else { $this->db->where("billing.date = '$today' AND billing.deleted='0'"); }
                    
                    $this->db->group_by('billing.date');
                    $bill_list = $this->db->get()->result_array();
					
                    foreach($bill_list as $val) { 

                        $tot_booking=$val['tot_booking'];
                        $tot_bk=$tot_bk+$tot_booking;
                    
                    	$today=date("Y-m-d");
                    	// if (isset($datef)&&$datef!=""&&$datet!=""){
                    	//="and billing.date BETWEEN '$datef' AND '$datet' AND deleted='0'";
                    	// }else { $cond="and billing.date ='$today' AND deleted='0'";}
                    
                     	$billing_date = $val['billing_date'];

                   		$query = $this->db->query("select sum(billing_dtls.amount) as total, sum(billing_dtls.postal_amt) as postal_amt from billing join billing_dtls on billing.id=billing_dtls.bill_id left join pooja on pooja.id=billing_dtls.pooja where billing.date='$billing_date' and mode=1 and billing.deleted!=1");
                    	$collection = $query->row();
                    	$cashtot=$collection->total + $collection->postal_amt;
                    	$gcashtot+=$cashtot;
                    
                    	$online_query = $this->db->query("select sum(billing_dtls.amount) as total, sum(billing_dtls.postal_amt) as postal_amt from billing join billing_dtls on billing.id=billing_dtls.bill_id left join pooja on pooja.id=billing_dtls.pooja where billing.date='$billing_date' and billing.status=2 and billing.deleted!=1");
                    	$online_collection = $online_query->row();
                    	$online_tot=$online_collection->total  + $online_collection->postal_amt;
                    	$gonline_tot+=$online_tot;

                   		$query2 = $this->db->query("select sum(billing_dtls.amount) as total, sum(billing_dtls.postal_amt) as postal_amt from billing join billing_dtls on billing.id=billing_dtls.bill_id left join pooja on pooja.id=billing_dtls.pooja where billing.date='$billing_date' and  mode=6 and billing.deleted!=1");
                    	$collection2 = $query2->row();
                    	$qrtot=$collection2->total  + $collection2->postal_amt;
                    	$gqrtot+=$qrtot;
                    
                     	$query3 = $this->db->query("select sum(billing_dtls.amount) as total, sum(billing_dtls.postal_amt) as postal_amt from billing join billing_dtls on billing.id=billing_dtls.bill_id left join pooja on pooja.id=billing_dtls.pooja where billing.date='$billing_date' and  mode=5 and billing.deleted!=1");
                    	$collection3 = $query3->row();
                    	$othertot = $collection3->total  + $collection3->postal_amt;
                    	$gothertot += $othertot;
                    
                    	$query4=  $this->db->query("select sum(billing_dtls.amount) as total, sum(billing_dtls.postal_amt) as postal_amt from billing join billing_dtls on billing.id=billing_dtls.bill_id left join pooja on pooja.id=billing_dtls.pooja where billing.date='$billing_date' and  mode=7 and billing.deleted!=1");
                    	$collection4= $query4->row();
                    	$cardtot=$collection4->total  + $collection4->postal_amt;
                    	$gcardtot+=$cardtot;
                    
                    	$query5=  $this->db->query("select sum(billing_dtls.amount) as total, sum(billing_dtls.postal_amt) as postal_amt from billing join billing_dtls on billing.id=billing_dtls.bill_id left join pooja on pooja.id=billing_dtls.pooja where billing.date='$billing_date' and  mode=8 and billing.deleted!=1");
                    	$collection5= $query5->row();
                    	$motot=$collection5->total  + $collection5->postal_amt;
                    	$gmotot+=$motot;
                    
                    	$app_query=  $this->db->query("select sum(billing_dtls.amount) as total, sum(billing_dtls.postal_amt) as postal_amt from billing join billing_dtls on billing.id=billing_dtls.bill_id left join pooja on pooja.id=billing_dtls.pooja where billing.date='$billing_date' and mode=9 and billing.deleted!=1");
                    	$app_collection= $app_query->row();
                    	$apptot=$app_collection->total  + $app_collection->postal_amt;
                    	$gapptot+=$apptot;
                    
                    	$grand_total_cash+=$cashtot;
                    	$grand_total_qr+=$qrtot;
                    	$grand_total_card+=$cardtot;
                    	$grand_total_mo+=$motot;
                    	$grand_total_neft+=$othertot;
                    	$grand_total_app+=$apptot;
                    	$grand_total_online+=$online_tot;
                    
						$row_sum = $cashtot + $qrtot + $cardtot + $motot + $othertot  + $apptot;
                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					  <td><?= date("d-m-Y", strtotime($billing_date));;?></td>
                      <td>&nbsp;<?php echo $cashtot;?></td>
              		  <td>&nbsp;<?php  echo $qrtot;?></td>
                      <td>&nbsp;<?php  echo $cardtot;?></td>
                      <td>&nbsp;<?php echo $motot;?></td>
<!-- 					  <td>&nbsp;<?php echo $online_tot; ?></td> -->
                      <td>&nbsp;<?php  echo $othertot;?></td>
                      <td>&nbsp;<?php  echo $apptot;?></td>
					 <td style="text-align:right"><?= number_format((float)$row_sum, 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php }
                        $grand_total = $grand_total+$grand_total_cash+$grand_total_qr+$grand_total_card+$grand_total_mo+$grand_total_neft+$grand_total_app;
                        ?>
					<tfoot>
					  <tr>
                     <td colspan="2" class="text-right">Total</td>
                      <td>&nbsp;<?php echo number_format((float)$grand_total_cash, 2, '.', '');?></td>
              		  <td>&nbsp;<?php  echo number_format((float)$grand_total_qr, 2, '.', '');?></td>
                      <td>&nbsp;<?php  echo number_format((float)$grand_total_card, 2, '.', '');?></td>
                      <td>&nbsp;<?php  echo number_format((float)$grand_total_mo, 2, '.', '');?></td>
<!-- 					  <td>&nbsp;<?php  echo number_format((float)$grand_total_online, 2, '.', '');?></td> -->
                      <td>&nbsp;<?php  echo number_format((float)$grand_total_neft, 2, '.', '');?></td>
                      <td>&nbsp;<?php  echo number_format((float)$grand_total_app, 2, '.', '');?></td>
					  
					    <th style="text-align:right"><?= number_format((float)$grand_total, 2, '.', '');?></th>
					  </tr>
					</tfoot>
				</table>
              	
              	<p>Generated By <?php $name = $_SESSION['admin']['name']; echo $name; ?> </p>
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