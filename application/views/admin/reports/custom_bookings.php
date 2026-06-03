  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Custom Bookings</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Custom Bookings</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/report/customBookings" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($date_from)){echo $date_from;} else { echo date('Y-m-d'); } ?>" title="Date" required name="date_from" style="margin:10px 0;">
                      <?php echo form_error('date_from', '<div class="error">', '</div>'); ?>
                    
                      <input type="date" class="form-control" value="<?php if(isset($date_to)){echo $date_to;} else { echo date('Y-m-d'); } ?>" title="Date" required name="date_to" style="margin:10px 0;">
                      <?php echo form_error('date_to', '<div class="error">', '</div>'); ?>
                    
                      <select class="form-control" title="Pooja" required name="pooja_id" style="margin:10px 0;">
                      	<option value="">Select Pooja</option>
                      	<?php foreach($poojas as $pooja) { ?>
                      	<option value="<?php echo $pooja->pooja_id; ?>" <?php if(isset($pooja_id) && $pooja_id == $pooja->pooja_id){echo 'selected';} ?>> <?php echo $pooja->pooja_name; ?> </option>
                      	<?php } ?>
                      </select>
                      <?php echo form_error('date_to', '<div class="error">', '</div>'); ?>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="search" value="search" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="button" onclick="printcontend('printer')" class="btn btn-outline-secondary" name="search" value="print" title="Print Summary"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive" id="printer" onafterprint="myFunction()">
              	<table class="table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  	<th>
                        	<h3 class="text-center"> <?php echo $temple[0]['name']; ?> </h3>
                    	</th>
					</tr>
                  	<tr>
					  	<th>
                        	<h6 class="text-center"> <?php echo $temple[0]['address']; ?> - <?php echo $temple[0]['pincode']; ?> </h6>
                    	</th>
					</tr>
                  	<tr>
					  	<th>
                        	<h5 class="text-center"> Custom Bookings </h5>
                    	</th>
					</tr>
				  </thead>
               </table>
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  	<th style="width: 5%">#</th>
					  	<th style="">Bill No</th>
                    	<th style="">Bill Date</th>
                    	<th style="">Booked for</th>
                    	<th style="">Booked Under</th>
                    	<th style="">Customer</th>
                    	<th style="">Contact Number</th>
					</tr>
				  </thead>
                
                  <?php if (@$bookings): ?>
				  <tbody>
                  	<?php foreach ($bookings as $key => $booking): ?>
                  	<tr>
					  	<td style="width: 5%"> <?php echo $key+1; ?> </td>
					  	<td style="width: 25%"> <?php echo $booking->bill_no; ?> </td>
                    	<td style="width: 20%"> <?php echo date('d M Y', strtotime($booking->date)); ?> </td>
                    	<td style="width: 20%"> <?php echo date('d M Y', strtotime($booking->pooja_date)); ?> </td>
                    	<td style="width: 30%"> <?php echo $booking->name;?></td>
                    	<td style="width: 30%"> <?php echo $booking->customer;?></td>
                    	<td style="width: 30%"> <?php echo $booking->contact_number;?></td>
					</tr>
                  	<?php endforeach; ?>
                  	
                  </tbody>
                  <?php else: ?>
                	<tr>
                    	<th colspan="7" class="text-center py-5"> No data found! </th>
                	</tr>
                  <?php endif; ?>
				</table>
              	<h6 class="mb-4"> <?php echo $birth_star ?? ''; ?> </h6> 
              
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