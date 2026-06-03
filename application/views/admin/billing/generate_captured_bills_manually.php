<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Captured Payments</h4>
        </div>

    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	         <?php if(isset($payments)){ ?>
	          <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Order ID</th>
					  <th scope="col" width="">Amount</th>
					  <th scope="col" width="">Payment Method</th>
                      <th scope="col" width="">Name</th>
                      <th scope="col" width="">Email</th>
                      <th scope="col" width="">Mobile Number</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
				  <tbody>
                  	<?php foreach($payments as $key => $payment) {
						$reference_no = $payment['notes']['reference_no'] ?? '';
						
						$mobile_no = substr($payment['contact'], -10);
						
                  		$user = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile_no'")->row();
						// $user_id = $user->id;
						// $date = date("Y-m-d", $payment['created_at']);
						// $amount = $payment['amount']/100;
						// $bills = $this->db->query("select id from billing_online where customer_id='$user_id' and DATE(created_at)='$date' and total='$amount'")->result_array();
                    ?>
                  	<tr>
                    	<td><?php echo $key+1; ?></td>
                    	<td><?php echo date("d M Y h:i:s A", $payment['created_at']); ?></td>
                    	<td><?php echo $payment['order_id'] ?? ''; ?></td>
                    	<td><?php echo $payment['amount']/100; ?></td>
                    	<td><?php echo $payment['method']; ?></td>
                        <td><?php echo $user->name ?? ''; ?></td>
                    	<td><?php echo $payment['email']; ?></td>
                    	<td><?php echo $payment['contact']; ?></td>
                    	<td>
                    		<a href="<?php echo base_url();?>index.php/admin/billing/generate_bill/<?php echo $payment['order_id'];?>" >Generate Bill</a>
                        
<!-- <form action="<?php echo base_url();?>index.php/admin/billing/generate_bill" method="post" id="generate_bill-<?= $key ?>">
    <input type="hidden" name="payment_id" value="<?php echo $payment['id']; ?>" />
</form> -->

                    	</td>
                  	</tr>
                    <?php } ?>
                  </tbody>
				</table>
             </div>
             <?php }?>
			</div> 
          </div>
	    </div>
       </div>
	</div>
	<!-- MESSAGE MODAL -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="" id="myform" method="post">
					<div class="modal-header">
						<h5 class="modal-title" id="example-Modal3">Delete Bill</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="message-text" class="form-control-label">Reason For Delete:</label>
							<textarea class="form-control" name="reason" rows="4" placeholder="Reason For Delete" id="reason"></textarea>
							<input type="hidden" name="bill_id" value="" id="bill_id">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" id="submit" class="btn btn-primary">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MESSAGE MODAL CLOSED -->
    <div class="clearfix"></div>
    <br>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
    <script>
    
    $('.reprint-btn').on('click', (e) => {
    	let bill_id = e.target.getAttribute('data-id')
    	let url = e.target.getAttribute('href')
    $.ajax({
      url: "<?php echo base_url(); ?>index.php/admin/admin/update_bill_reprint_count",
      method: 'POST', // or 'GET' based on your requirement
      data: {'bill_id': bill_id},
      success: function(response) {

      }
    });
    })
	function changevalue(bill_id){
		var action='<?php echo base_url();?>index.php/admin/admin/delete_bill/'+bill_id;
		$(".modal #bill_id").val(bill_id);
		$('#myform').attr('action', action);
	}
        (function(document) {
        	'use strict';
        	var LightTableFilter = (function(Arr) {
        		var _input;
        		function _onInputEvent(e) {
        			_input = e.target;
        			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
        			Arr.forEach.call(tables, function(table) {
        				Arr.forEach.call(table.tBodies, function(tbody) {
        					Arr.forEach.call(tbody.rows, _filter);
        				});
        			});
        		}
        		function _filter(row) {
        			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
        			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        		}
        		return {
        			init: function() {
        				var inputs = document.getElementsByClassName('light-table-filter');
        				Arr.forEach.call(inputs, function(input) {
        					input.oninput = _onInputEvent;
        				});
        			}
        		};
        	})(Array.prototype);
        	document.addEventListener('readystatechange', function() {
        		if (document.readyState === 'complete') {
        			LightTableFilter.init();
        		}
        	});
        })(document);
    </script>