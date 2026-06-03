  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Upi Bill Report</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Upi Bill Report</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/report/upi_bill_report" method="post">
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
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;margin-bottom:2px;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?> <br>  <br> 					
                        <?php print_r($temple_list[0]['phone']);?></h4>

    					</td>
    				</tr>
    				<tr>
    					<th colspan="5"><label style="text-align:center;">Upi Bill Report From : <?php echo date('d-m-Y',strtotime($datef));?></label>
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
                
              	
                <table class="table table-bordered table-hover text-nowrap" width="100%">
                	<?php $grand_total = 0; ?>
                	<?php foreach($summary as $val) { ?>
                	<thead>
                    	<tr style="border:none !important">
                        	<td colspan="7" style="border:none !important"></td>
                        </tr>
                    	<tr>
                        	<th colspan="7" class="text-center py-3 bg-light"> 
                            	<h4> <?php echo $val['category']->name_mal; ?> </h4>
                        	</th>
                    	</tr>

                    	<tr style="background: #e6e6f5;">
                        	<th>Sl. No</th>
                        	<th>Bill No</th>
                        	
                        	<th>Pooja</th>
                        	<th>User</th>
                        	<th>Quantity</th>
                        	<th>Amount</th>
                    	</tr>
                	</thead>
                	<?php $total = 0; ?>
                	<?php if( $val['bills'] != 0 ): ?>
                	<tbody>
                    	<?php foreach( $val['bills'] as $key => $bill ): ?>
                    	<?php $total += $bill['total_amount'];  ?>
                    	<tr>
                        	<td> <?php echo ($key+1); ?> </td>
                        	<td> <?php echo ($bill['bill_id']); ?> </td>
                        	
                        	<td> <?php echo ($bill['pooja']." - ".$bill['pooja_locale']); ?> </td>
                        	<td> <?php echo ($bill['name']); ?> </td>
                        	<td> <?php echo ($bill['quantity']); ?> </td>
                        	<td class="text-right"> <?php echo ($bill['total_amount']); ?> </td>
                    	</tr>
                    	<?php endforeach; $grand_total+=$total; ?>
                    	<tr>
                        	<td colspan="6" class="text-right"> <h5> Total </h5> </td>
                        	<td colspan="1" class="text-right"> <h5> <?php echo $total; ?> </h5> </td>
                        </tr>
                	</tbody>
                	<?php else: ?>
                	<tbody>
                    	<tr>
                        	<td colspan="6" class="text-center">No Data Found!</td>
                        </tr>
                	</tbody>
                	<?php endif; ?>
                

                	<?php } ?>
                	<tfoot class="mb-5">
                    	<tr style="border:none !important">
                        	<td colspan="7" style="border:none !important"></td>
                        </tr>
                    	<tr>
                        	<td colspan="6" class="text-right"> <h5> Grand Total </h5> </td>
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