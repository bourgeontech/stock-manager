  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">POS User Wise Report</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;POS User Wise Report</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/report/pos_user_wise_report" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}?>" title="Date From" required name="datef" style="margin:10px 0;">
                      <?php echo form_error('datef', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}?>" title="Date To" required name="datet" style="margin:10px 0;">
                      <?php echo form_error('datet', '<div class="error">', '</div>'); ?>
					  <select class="form-control"  name="category_id" style="margin:10px 0;">
                      <option value="">Select Category</option>
                      	 <?php foreach($categories as $category) { ?>
                      		<option value="<?php echo $category->id; ?>" <?php if(isset($category_id) && $category_id == $category->id){echo 'selected';}?>> <?php echo $category->name; ?> </option>
                      	 <?php } ?>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" onclick="printcontend('printer')" title="Print Summary"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive" id="printer" onafterprint="myFunction()">
              	<table class="table table-bordered table-hover text-nowrap" width="100%">
                	<tr>
    					<td colspan="4" style="width:100%;"><h4 style="text-align:center;margin-bottom:2px;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?> <br>  <br> 					
                        <?php print_r($temple_list[0]['phone']);?></h4>

    					</td>
    				</tr>
    				<tr>
    					<th colspan="2"><label style="text-align:center;">POS User Wise Report From : <?php echo date('d-m-Y',strtotime($datef));?></label>
    					    <label style="float:center;">To : <?php echo date('d-m-Y',strtotime($datet));?></label>
    				    </th>
                    	<th colspan="2">
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
                    	<tr style="background: #e6e6f5;">
                        	<th>Sl. No</th>
                        	<th>User</th>
                        	<th>Counter</th>
                        	<th>Total Booking</th>
                    	</tr>
                	</thead> 
                	<tbody>
    				<?php $grand_total = 0; $key = 0; ?>
    				<?php foreach($summary as $val) { ?>
        				<?php if (!empty($val['report'])): $key++; ?>
            				<?php $rowspan = count($val['report']); ?>
            				<tr>
                				<td rowspan="<?php echo $rowspan; ?>"><?php echo $key; ?></td>
                				<td rowspan="<?php echo $rowspan; ?>"><?php echo $val['user'].'( '.$val['email'].' )'; ?></td>
                				<td><?php echo $val['report'][0]['counter']; ?></td>
                				<td class="text-right"><?php echo $val['report'][0]['total_amount']; $grand_total += $val['report'][0]['total_amount']; ?></td>
            				</tr>
            				<?php for ($i = 1; $i < $rowspan; $i++): ?>
                			<tr>
                    			<td><?php echo $val['report'][$i]['counter']; ?></td>
                    			<td class="text-right"><?php echo $val['report'][$i]['total_amount']; $grand_total += $val['report'][$i]['total_amount']; ?></td>
                			</tr>
            				<?php endfor; ?>
        				<?php endif; ?>
    				<?php } ?>
					</tbody>

                	<tfoot class="mb-5">
                    	<tr style="border:none !important">
                        	<td colspan="4" style="border:none !important"></td>
                        </tr>
                    	<tr>
                        	<td colspan="3" class="text-right"> <h5> Grand Total </h5> </td>
                        	<td colspan="1" class="text-right"> <h5> <?php echo $grand_total; ?> </h5> </td>
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