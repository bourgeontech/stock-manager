<?php ini_set('display_errors',0);?>
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
         <?php if($this->session->flashdata('error')): ?>
    	<div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
    	</div>
		<?php endif; ?>	
         <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif;?>
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Bill </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
             	<ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/daily_summary" class="btn btn-primary">Daily Summary</a> </li>
                  </ul>
                <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/detail_view" class="btn btn-primary">Detailed View</a> </li>
                  </ul>
             <?php
             
              $query4 = $this->db->query("SELECT mookola_settings, code_settings FROM  site_settings where 1 limit 0,1");
                        $result4 = $query4->result_array();
			 $adminimage=@$result4['0']['mookola_settings'];
             $code_setting=@$result4['0']['code_settings'];

if($adminimage=='1'){?>             <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/mookkolakallu" class="btn btn-primary">Mookkolakallu Reg</a> </li> <?php } ?>
                  </ul>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-10 col-md-10 col-sm-10 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/billing_view" method="post">
                    <div class="input-group">
                      <select id="type" name="type" class="form-control" autofocus="autofocus" style="margin:10px 0;">
                          <option value="">Select Type *</option>
                      	  <option value="ALL" <?php if(isset($type)&&$type=="ALL"){echo "Selected";}?>>----All----</option>
                          <option value="1" <?php if(isset($type)&&$type=="1"){echo "Selected";}?>>Cash</option>
                        <option value="6" <?php if(isset($type)&&$type=="6"){echo "Selected";}?>>QR </option>
                        <option value="5" <?php if(isset($type)&&$type=="5"){echo "Selected";}?>>NEFT </option>
                          <option value="0" <?php if(isset($type)&&$type=="0"){echo "Selected";}?>>Online</option>
                       <option value="7"  <?php if(isset($type)&&$type=="7"){echo "Selected";}?>>Card</option>
                  		  <option value="8"  <?php if(isset($type)&&$type=="8"){echo "Selected";}?>>MO</option>
                      	<?php if($code_setting == 4) { ?>
                      	<option value="10" <?php if(isset($type)&&$type=="8"){echo "Selected";}?>>Endowment</option>
                      	<?php } ?>
                      </select>
                      <input type="number" min="0" class="form-control" value="<?php if(isset($bill)){echo $bill;}?>" placeholder="Enter the bill no" name="bill" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}else{echo date('Y-m-d');}?>" name="keyword" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($dateto)){echo $dateto;}else{echo date('Y-m-d');}?>" name="dateto" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                      	<?php if ($header=="1"){?>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <?php }elseif ($header=="2"){?>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                        <?php }elseif ($header=="3"){?>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="summary" title="Print Summary"><i class="fa fa-file" aria-hidden="true"></i></button>
                        <?php }?>
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
                      <th scope="col" width="">Customer</th>
					  <th scope="col" width="">Diety</th>
                     <th scope="col" width="">Remarks</th>
					  <th scope="col" width="">Total</th>
                      <th scope="col" width="">Postal</th>
                     <th scope="col" width="">Recvd</th>
                     <th scope="col" width="">Balance</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
					<?php 
                        $total=0;$rtot=0;$post=0; $t_balance = 0;
                        $role=$this->loggedIn['role'];
                        $today=date('Y-m-d');
                        $query1 = $this->db->query("SELECT pay_id FROM `payment` where payment_date='$today' AND (ledger='6' OR ledger='7')")->result_array();
                        if(!empty($bill_list)){
						$i=0;$baltot=0;$rtot=0;
	                    foreach($bill_list as $val){
                        	$customer_id = $val['customer_id'];
                        
                        	$customer_query = $this->db->where('id', $customer_id)->get('user_dtl');
                        	if($customer_query->num_rows() > 0) {
                            	$customer = $customer_query->row()->name;
                            } else {
                            	$customer = null;
                            }
                        
	                        $count=$val['count'];
	                        $status=$val['status'];
                            $remarks=$val['remarks'];
                        
	                        if ($count=="0"&&$status=="1"){
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }else {
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }
	                        $this->db->select('billing.*,SUM(billing_dtls.amount) as tot,sum(billing_dtls.postal_amt) as postal, billing.bal_amt as balance,name');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls ','billing_dtls.bill_id=billing.id');
	                      
	                        $this->db->where('billing.id', $val['id']);
	                        $query = $this->db->get()->result_array();
                       		$name=$query[0]['name'];
                        	$balance=($query[0]['tot']+$query[0]['postal'])-$query[0]['recv_amt'];
                        	$b_balance = (float) (($query[0]['balance'] == '' ? 0 : $query[0]['balance']) ?? 0);
                    		$t_balance += $b_balance;
                        
                        	$this->db->select('billing_dtls.type');
                        	$this->db->from('billing_dtls');
                        	$this->db->where('bill_id', $val['id']);
                        	$q = $this->db->get()->row();

                        	if($q->type == 'S' && $code_setting == 5)
                        		$href=base_url("index.php/admin/schedulebilling/schedule_print/".$val['id']);
                        
                        	if($q->type == 'S' && $code_setting == 7)
                        		$href=base_url("index.php/admin/schedulebilling/schedule_print/".$val['id']);
                        
                        	if($q->type == 'S' && $_SERVER['HTTP_HOST'] == "kachamkurissi.in")
                        		$href=base_url("index.php/admin/admin/sche_print_kothamkurissi/".$val['id']);
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></a></td>
					 <td style="width:150px;"><a href="<?php echo base_url(); ?>index.php/admin/admin/edit_customer/<?php echo $customer_id; ?>"> 
                     <strong style="margin-bottom: 5px;display: block;"><?= $customer ?? $name ; ?><br><?php echo@$val['remarks']; ?></strong></a> </td>
                     <td><?= $val['diety']; ?> </td>
                      <td><?= @$remarks; ?> </td>
					 <td><?= $query[0]['tot']-@$query[0]['discount'];?></td>
                    <td><?= $query[0]['postal']; ?></td>
                     <td><?= ($query[0]['tot'] - $b_balance-@$query[0]['discount']); $rtot+=($query[0]['tot'] - $b_balance-$query[0]['discount']);  ?></td>
                     <td><?= (float)$query[0]['balance']; ?></td>
			 		  <td><div class="btn-group">
						  <a href="<?php echo $href; ?>" class="btn btn-outline-primary" title="Print"> <i class="fa fa-print"></i></a>
                       <a href="<?php echo base_url("index.php/admin/admin/edit_bill/".$val['id']);?>" class="btn btn-outline-primary" title="Print"> <i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url("index.php/admin/admin/pdfview/".$val['id']);?>" class="btn btn-outline-primary" title="Print"> <i class="fa fa-file-pdf-o"></i></a>
						  <?php //if (($header=="1" || $header=="2") && $role=="superadmin"&&count($query1)==0){
                      
                       if ($role=="superadmin"|| $role=="admin"){?>
						  <!--<a href="<?php echo base_url("index.php/admin/admin/edit_bill/".$val['id']);?>" class="btn btn-outline-info" style="padding:6px;" title="Edit">
<i class="fa fa-pencil"></i></a>-->
						  <a href="#" data-toggle="modal" data-target="#exampleModal" onclick="changevalue('<?= $val['id']; ?>')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a>
						  <?php }?>
						 </div>
					  </td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$query[0]['tot']-@$query[0]['discount'];
                     $post+=$query[0]['postal'];    
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="12" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="5">Total</th>
							<th><?php echo $total;?></th>
                        <th><?php echo $post;?></th>
                        <th><?php echo $rtot;?></th>
                        <th><?php echo $t_balance;//($total+$post)-($rtot);?></th>
							<th></th>
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