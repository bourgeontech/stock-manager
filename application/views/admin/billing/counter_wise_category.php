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
                  <form  action="<?php echo base_url();?>index.php/admin/admin/counter_wise_category" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($from)){echo $from;}else{echo date('Y-m-d');}?>" title="Date From" required name="from" style="margin:10px 0;">
                      <?php echo form_error('from', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($to)){echo $to;}else{echo date('Y-m-d');}?>" title="Date To" required name="to" style="margin:10px 0;">
                      <?php echo form_error('to', '<div class="error">', '</div>'); ?>
                      <select id="cat" name="cat" class="form-control" autofocus="autofocus" style="margin:10px 0;height:auto;">
                          <option value="1">Para</option>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="button"class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive" id="printer">
				<table class="table table-bordered" width="98%">
				  <thead>
                  	<tr style="display:none;" id="templehead">
    					<th colspan="12" style="text-align:center;">
                        	<h4><?php print_r($temple_list[0]['name']);?><br>
    						<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
                        	Report Date <?= date('d-m-Y',strtotime($from))?> to <?= date('d-m-Y',strtotime($to))?></h4>
    					</th>
    				</tr>
					<tr>
					  <th>Name of the Pooja</th>
					  <th>Quantity</th>
					  <th style="text-align:right">Rate</th>
					  <th style="text-align:right">Amount</th>
					</tr>
				  </thead>
					<?php 
                    $g_total = 0;
					if(!empty($list)){
	                    foreach($list as $val){ 
                        	if($val['poojas']){
	                        ?>
				  <tbody>
                  	<tr>
                    	<th colspan="4" class="text-center"><?php echo $val['counter'];?></th>
                  	</tr>
                  	<?php 
                            $c_total = 0;
	                    foreach($val['poojas'] as $pooja){ 
                        	$total = $pooja['rate']*$pooja['count'];
                        	$g_total = $g_total+$total;
                        	$c_total = $c_total+$total;
	                        ?>
                    <tr>
                     <td><?= $pooja['name']; ?><br><?= $pooja['name_mal']; ?></td>
                     <td><?= $pooja['count']; ?></td>
                     <td style="text-align:right"><?= number_format((float)$pooja['rate'], 2, '.', '');?></td>
                     <td style="text-align:right"><?= number_format((float)$total, 2, '.', '');?></td>
                    </tr>
                  <?php } ?>
                     <tr>
                    	<td colspan="3">Counter Total</td>
                    	<td style="text-align:right"><?php echo number_format((float)$c_total, 2, '.', '');?></td>
                	 </tr>
				  </tbody>
					
                     <?php } } }
                     else {
					?>	
					<tbody><tr><td colspan="4" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
                <tfoot>
                	<tr>
                    	<th colspan="3">Total</th>
                    	<th style="text-align:right"><?php echo number_format((float)$g_total, 2, '.', '');?></th>
                	</tr>
                </tfoot>
				</table>
             <div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script>
        function printcontend(value) {
        	var templehead = document.getElementById("templehead");
        	templehead.removeAttribute("style");
        	var restorpage=document.body.innerHTML;
        	var printcontend=document.getElementById(value).innerHTML;
        	document.body.innerHTML=printcontend;
        	window.print();
        	document.body.innerHTML=restorpage;
        	location.reload(); 
        }
	</script>