  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Billing Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Deleted Bills </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
             	
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-6 col-md-6 col-sm-6">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/deleted_bill" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}else{echo date('Y-m-d');}?>" name="keyword" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($dateto)){echo $dateto;}else{echo date('Y-m-d');}?>" name="dateto" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
						<button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($bill_list)){?>
	          <div class="table-responsive">
	            <small>&nbsp; Please enter the bill number and press search to view the bill details</small>
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Diety</th>
					  <th scope="col" width="">Total</th>
                     <th scope="col" width="">Recvd</th>
                     <th scope="col" width="">Balance</th>
                     <th scope="col" width="">Delete Date</th>
                     <th scope="col" width="">Reason</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
					<?php 
                        $total=0;$rtot=0;
                        $role=$this->loggedIn['role'];
                        $today=date('Y-m-d');
                        $query1 = $this->db->query("SELECT pay_id FROM `payment` where payment_date='$today' AND (ledger='6' OR ledger='7')")->result_array();
                        if(!empty($bill_list)){
						$i=0;$baltot=0;$rtot=0;
	                    foreach($bill_list as $val){
	                        $count=$val['count'];
	                        $status=$val['status'];
	                        if ($count=="0"&&$status=="1"){
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }else {
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }
	                        $this->db->select('billing.*,SUM(billing_dtls.amount) as tot');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls ','billing_dtls.bill_id=billing.id');
	                      
	                        $this->db->where('billing.id', $val['id']);
	                        $query = $this->db->get()->result_array();
                       
                        $balance=$query[0]['tot']-$query[0]['recv_amt'];
                    
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></a></td>
					 <td><?= $val['diety']; ?></td>
					 <td><?= $query[0]['tot']; ?></td>
                     <td><?= $query[0]['recv_amt']; $rtot+=$query[0]['recv_amt'] ?></td>
                     <td><?= $balance; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['dl_date'])); ?></td>
					 <td><?= $val['dl_reason']; ?></td>
			 		  <td><div class="btn-group">
						  <a href="<?php echo $href; ?>" class="btn btn-outline-primary" title="Print"> <i class="fa fa-print"></i></a>
						 </div>
					  </td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$query[0]['tot'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="12" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="3">Total</th>
							<th><?php echo $total;?></th>
                        <th><?php echo $rtot;?></th>
                        <th><?php echo ($total-$rtot);?></th>
							<th colspan="3"></th>
						</tr>
					</tfoot>	
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