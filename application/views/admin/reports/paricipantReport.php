  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Participation Report</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Participation Report</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/report/poojaParticipationReport" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($date_from)){echo $date_from;}?>" title="Date From" required name="date_from" style="margin:10px 0;">
                      <?php echo form_error('date_from', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($date_to)){echo $date_to;}?>" title="Date To" required name="date_to" style="margin:10px 0;">
                      <?php echo form_error('date_to', '<div class="error">', '</div>'); ?>
                      <select class="form-control"  name="appearance" style="margin:10px 0;">
                      	 <option value="">Select Participation</option>
                      	 <option value="P" <?php if(isset($appearance) && $appearance == 'P'){echo 'selected';}?>>Physical Participation</option>
                      	 <option value="O" <?php if(isset($appearance) && $appearance == 'O'){echo 'selected';}?>>Online Participation</option>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive" id="printer" onafterprint="myFunction()">
              	<table class="table table-bordered table-hover text-nowrap" width="100%">
                	<?php if(isset($datef)): ?>
    				<tr>
    					<th colspan="5"><label style="text-align:center;">Participant Report From : <?php echo date('d-m-Y',strtotime($datef));?></label>
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
                	<?php endif; ?>
              	</table>
              
               <?php $total_qty = 0; $grand_total = 0; $grand_total_cash=0; $grand_total_qr=0; $grand_total_card=0; $grand_total_mo=0; $grand_total_neft=0; $grand_total_app=0;$grand_total_online=0;?>
              	<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  	<th style="width: 5%"># </th>
					  	<th style="width: 10%">Bill No</th>
                        <th style="width: 10%">Name</th>
                     	<th style="width: 10%">Star</th>
                    	<th style="width: 10%">Pooja</th>
                    	<th style="width: 10%">Pooja Date</th>
                    	<th style="width: 10%">Qty</th>
                    	<th style="width: 10%">Rate</th>
                    	<th style="width: 10%">Amount</th>
					</tr>
				  </thead>
					<?php 

                    if(isset($summary) && $summary != 0) {
                    	foreach($summary as $key => $val) { 
                         $grand_total += $val->amount;
                         $total_qty   += $val->qty;
                        ?>
				  <tbody>
					<tr>
					  <td><?= $key+1;?></td>
					  <td>Bill - <?= $val->bill_id; ?></td>
                      <td>&nbsp;<?= $val->name;?></td>
              		  <td>&nbsp;<?=  $val->star;?></td>
                      <td>&nbsp;<?=  $val->pooja;?></td>
                      <td>&nbsp;<?=  date('d M Y', strtotime($val->pooja_date)); ?></td>
					  <td>&nbsp;<?=  $val->qty;?></td>
                      <td>&nbsp;<?=  $val->pooja_rate?></td>
                      <td>&nbsp;<?=  $val->qty * $val->pooja_rate;?></td>
					</tr>
				  </tbody>
					<?php } 
                    }
                        // $grand_total = $grand_total+$grand_total_cash+$grand_total_qr+$grand_total_card+$grand_total_mo+$grand_total_neft+$grand_total_app;
                        ?>
					<tfoot>
					  <tr>
                     <td colspan="6" class="text-right">Total</td>
                      <td>&nbsp;<?php  echo $total_qty;?></td>
                      <td></td>
                      <td>&nbsp;<?php  echo number_format((float)$grand_total, 2, '.', '');?></td>
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