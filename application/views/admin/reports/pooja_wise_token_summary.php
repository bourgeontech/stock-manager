  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Pooja Wise Token Report</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Pooja Wise Token Summary</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/report/pooja_wise_token_summary" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}?>" title="Date" required name="date" style="margin:10px 0;">
                      <?php echo form_error('date', '<div class="error">', '</div>'); ?>
                      <select class="form-control" name="deity_id" id="deity_id"	style="margin:10px 0;" onchange="getPoojas()" required>
                      <option value="">Select Deity</option>
                      <?php foreach($deities as $deity): ?>
                      	<option value="<?php echo $deity['id']; ?>"  <?php if (isset($deity_id) && $deity['id'] == $deity_id): echo 'selected'; endif; ?>> <?php echo $deity['name']; ?> </option>
                      <?php endforeach; ?>
                      </select>
					  <select class="form-control" name="pooja_id" id="pooja_id"	style="margin:10px 0;">
                      <option value="">Select Pooja</option>
                      
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
    					<th colspan="5"><label style="text-align:center;">Pooja Wise Token Summary : <?php echo date('d-m-Y',strtotime($date ?? date('Y-m-d')));?> </label>
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
                    	<th style="">Bill No</th>
                        <th style="">Name</th>
                     	<th style="">Pooja</th>
                    	<th style="">Token</th>
					</tr>
				  </thead>
				  <tbody>
                  	<?php $i = 0; $total_amount = 0; $total_qty = 0; ?>
                  	<?php if (isset($summary)): ?>
                  	<?php foreach ($summary as $date => $result): ?>
                  	<?php $i++; ?>
                  	<tr>
					  	<td style="widtd: 5%"> <?php echo $i; ?>  </td>
                    	<td style="font-weight:bolder;" class="text-orange"> Bill - <?php echo $result['bill_id'] ?? ''; ?> </td>
                     	<td style=""> <?php echo $result['name'] ?? ''; ?> </td>
                    	<td style=""> <?php echo $result['pooja_nm']; ?> </td>
                    	<td style="font-weight:bolder;"> <?php echo $result['token']; ?> </td>
					</tr>
                  	<?php endforeach; ?>
                  	<?php endif; ?>
                  </tbody>
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
    	function getPoojas() {
        	var deity_id = $('#deity_id').val();

        	$('#pooja_id').html("");
        
            var html='<option value="0">Please Select</option>';
        	var url = '<?php echo base_url();?>index.php/admin/admin/getpoojasbydiety';
    		$.ajax({
            	type: "POST",
            	url: url,
            	data: {'diety': deity_id},
            	dataType: "json",
            	success: function (data) {
            
                	$.each(data, function (i, obj)
                	{
                    	var pooja=obj.pooja;
                    
                		html +='<option value="'+obj.pooja_id+'">'+pooja+' - '+obj.pooja_mal+'</option>';
                	});
                	$('#pooja_id').append(html);
            	}
        	});
        }
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
            $.ajax({
    url: '<?php echo base_url();?>index.php/admin/report/set_pooja_wise_token_summary_print',
    type: 'POST',
    data: { date: "<?php echo $date; ?>", deity_id: "<?php echo $deity_id; ?>", pooja_id: "<?php echo $pooja_id; ?>" },  // Add data if needed
    success: function(response) {
        // Handle the AJAX response
        console.log(response);
    },
    error: function(error) {
        // Handle the AJAX error
        console.error(error);
    }
});
        }
</script>