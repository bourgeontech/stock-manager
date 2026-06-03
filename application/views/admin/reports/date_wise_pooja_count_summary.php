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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Date Wise Pooja Count</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/report/date_wise_pooja_count_summary" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($date_from)){echo $date_from;}?>" title="Date From" required name="date_from" style="margin:10px 0;">
                      <?php echo form_error('date_from', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($date_to)){echo $date_to;}?>" title="Date To" required name="date_to" style="margin:10px 0;">
                      <?php echo form_error('date_to', '<div class="error">', '</div>'); ?>
					  <select class="form-control" name="pooja_id"	style="margin:10px 0;" required>
                      <option value="">Select Pooja</option>
                      <?php foreach($poojas as $pooja): ?>
                      	<option value="<?php echo $pooja['id']; ?>"  <?php if (isset($pooja_id) && $pooja['id'] == $pooja_id): echo 'selected'; endif; ?>> <?php echo $pooja['name']; ?> - <?php echo $pooja['code']; ?> </option>
                      <?php endforeach; ?>
                      </select>
                    
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="search" value="search" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" onclick="printcontend('printer')" title="Print Summary"><i class="fa fa-print" aria-hidden="true"></i></button>
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
    					<th colspan="5"><label style="text-align:center;">Daily Wise Pooja Count From : <?php echo date('d-m-Y',strtotime($date_from ?? date('Y-m-d')));?> </label>
    					    <label style="float:center;">To : <?php echo date('d-m-Y',strtotime($date_to ?? date('Y-m-d')));?></label>
                        	<?php print_r('of '. ($pooja_name ?? '')); ?>
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
              
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  	<th style="width: 5%">#</th>
					  	<th style="">Date</th>
<!--                         <th style="">Pooja</th> -->
                     	<th style="">Count</th>
                    	<th style="">Pooja Rate</th>
                    	<th style="">Total</th>
					</tr>
				  </thead>
				  <tbody>
                  	<?php $i = 0; $total_amount = 0; $total_qty = 0; ?>
                  	<?php if (isset($summary)): ?>
                  	<?php foreach ($summary as $date => $result): ?>
                  	<?php $i++; $total_amount += $result['amount']; $total_qty += $result['quantity']; ?>
                  	<tr>
					  	<td style="widtd: 5%"> <?php echo $i; ?> </td>
					  	<td style=""> <?php echo date('d M Y', strtotime($date)); ?> </td>
                     	<td style=""> <?php echo $result['quantity'] ?? 0; ?> </td>
                    	<td style=""> <?php echo $result['rate']; ?> </td>
                    	<td style=""> <?php echo $result['amount']; ?> </td>
					</tr>
                  	<?php endforeach; ?>
                  	<?php endif; ?>
                  </tbody>
                  <tfoot>
					<tr>
					  	<th style="text-align:center;" colspan="2">Total</th>
                     	<th style=""> <?php echo $total_qty; ?> </th>
                    	<th style=""></th>
                    	<th style=""> <?php echo $total_amount; ?> </th>
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