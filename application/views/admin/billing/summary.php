  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Billing Master</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Bill Summary</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/detail_summary" class="btn btn-primary">Detailed Summary</a> </li>
                  </ul>
              </div> 
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/bill_summary" method="post">
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
                      <select name="ampm" id="ampm" class="form-control" style="margin:10px 0;height:auto;">
                          <option value="">Select Time All</option>
            			  <option value="M" <?php if(isset($ampm)=="M"){echo "Selected";}?>>Morning</option>
                      <option value="N" <?php if(isset($ampm)=="N"){echo "Selected";}?>>Noon</option>
                       <option value="E" <?php if(isset($ampm)=="E"){echo "Selected";}?>>Evening</option>
            		  </select>
            		  <?php echo form_error('diety', '<div class="error">', '</div>'); ?>
            		  <select id="type" name="type" class="form-control" autofocus="autofocus" style="margin:10px 0;height:auto;">
                          <option value="">Select Type</option>
                          <option value="1" <?php if(isset($type)&&$type=="1"){echo "Selected";}?>>Cash Payment</option>
                          <option value="2" <?php if(isset($type)&&$type=="2"){echo "Selected";}?>>Online Payment</option>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" onclick="printcontend('printer')" title="Print Summary"><i class="fa fa-print" aria-hidden="true"></i></button>
                       <button type="submit" class="btn btn-outline-primary" name="printdatewise" value="printdatewise" title="Print Summary by Datewise"><i class="fa fa-print" aria-hidden="true"></i></button>
                      
                      <!-- <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-file" aria-hidden="true"></i></button>
                    -->  </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($from)){?>
	          <div class="table-responsive" id="printer" onafterprint="myFunction()">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
				  	<tr id="header12" style="display:none;">
    					<td colspan="9" style="width: 100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					<strong style="margin-bottom: 5px;color: #ea6227;">Daily Pooja Wise Summary for the date <?php echo @date("d-m-Y", strtotime($from));;?> to  <?php echo @date("d-m-Y", strtotime($to));;?></h4>
    					</td>
    				</tr>
                  
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name of the Pooja</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" style="text-align:right">Rate</th>
                      <th scope="col" style="text-align:right">Cash</th>
                      <th scope="col" style="text-align:right">Qr</th>
					  <th scope="col" style="text-align:right">Total</th>
					</tr>
				  </thead>
					<?php 
					$tot= 0;
                    $tot_cash = 0;
					$tot_qr = 0;
                                    
					if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){ 
                        	
                        	$cash = $val['cash'];
    						$qr = $val['qr'];
                        	$amount = $cash + $qr;
                        	$tot_cash += $cash;
                        	$tot_qr += $qr;
                        
	                        $qty=$val['quantity'];
	                        $pooja_rt=$val['pooja_rt'];
	                        $amt=$val['amount'];
	                        $tot=$tot+$amt;
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					 <td><?= $val['pooja'];?></td>
					 <td><?= $qty;?></td>
					 <td style="text-align:right"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
                     <td style="text-align:right"><?= number_format((float)$cash, 2, '.', '');?></td>
                     <td style="text-align:right"><?= number_format((float)$qr, 2, '.', '');?></td>
					 <td style="text-align:right"><?= number_format((float)$amount, 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
					    <th></th>
					    <th colspan="3">Total</th>
                    	<th style="text-align:right"><?= number_format((float)$tot_cash, 2, '.', '');?></th>
                    	<th style="text-align:right"><?= number_format((float)$tot_qr, 2, '.', '');?></th>
					    <th style="text-align:right"><?= number_format((float)$tot, 2, '.', '');?></th>
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