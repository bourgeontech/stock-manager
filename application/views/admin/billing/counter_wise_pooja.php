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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Bill </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/counter_wise_pooja" method="post">
                  	<?php 
                  	$role=$this->loggedIn['role'];
                  	?>
                    <div class="input-group">
                      <select id="type" name="type" class="form-control" autofocus="autofocus" style="margin:10px 0;">
                          <option value="">Select Type *</option>
                      	  <option value="1" <?php if(isset($type)&&$type=="1"){echo "Selected";}?>>Cash</option>
                          <option value="5" <?php if(isset($type)&&$type=="5"){echo "Selected";}?>>NEFT</option>
                      	  <option value="6" <?php if(isset($type)&&$type=="6"){echo "Selected";}?>>QR Code</option>
                      	  <option value="7" <?php if(isset($type)&&$type=="7"){echo "Selected";}?>>Card</option>
                      	  <option value="8" <?php if(isset($type)&&$type=="8"){echo "Selected";}?>>MO</option>
                      	  <option value="0" <?php if(isset($type)&&$type=="0"){echo "Selected";}?>>Online</option>
<!--                           <option value="1" <?php if(isset($type)&&$type=="1"){echo "Selected";}?>>Cash Payment</option>
                          <option value="2" <?php if(isset($type)&&$type=="2"){echo "Selected";}?>>Online Payment</option> -->
                      </select>
                      <input type="number" min="0" class="form-control" value="<?php if(isset($bill)){echo $bill;}?>" placeholder="Enter the bill no" name="bill" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}else{echo date('Y-m-d');}?>" name="keyword" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($dateto)){echo $dateto;}else{echo date('Y-m-d');}?>" name="dateto" style="margin:10px 0;">
                      <?php if ($role=="superadmin"){?>
                      <select id="user_id" name="user_id" class="form-control" style="margin:10px 0;">
                          <option value="">Select Counter *</option>
                          <?php foreach($user_list as $val){ ?>
            				  <option value="<?= $val['id']; ?>" <?php if(isset($user_id)&&$user_id==$val['id']){echo "Selected";}?>><?= $val['name']; ?></option>
            			  <?php } ?>
                      </select>
                      <?php }?>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="summary" title="Print Summary"><i class="fa fa-file" aria-hidden="true"></i></button>
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
                      <th scope="col" width="">Mode</th>
					  <th scope="col" width="">Total</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
					<?php 
                        $total=0;
                        if(!empty($bill_list)){
						$i=0;
	                    foreach($bill_list as $val){
	                        $count=$val['count'];
	                        $status=$val['status'];
	                        if ($count=="0"&&$status=="1"){
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }else {
	                            $href=base_url("index.php/admin/admin/sche_print/".$val['id']);
	                        }
	                        $this->db->select('billing.*,SUM(billing_dtls.qlt),SUM(pooja.rate),SUM(billing_dtls.amount) as tot');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls ','billing_dtls.bill_id=billing.id');
	                        $this->db->join('pooja','billing_dtls.pooja=pooja.id');
	                        $this->db->where('billing.id', $val['id']);
	                        $query = $this->db->get()->result_array();
                        
                        	if($query[0]['mode'] == 1) {
                            	$mode = 'Cash';
                            } else if($query[0]['mode'] == 5) {
                            	$mode = 'NEFT';
                            } else if($query[0]['mode'] == 7) {
                            	$mode = 'Card';
                            } else if($query[0]['mode'] == 6) {
                            	$mode = 'QR';
                            } else if($query[0]['mode'] == 8) {
                            	$mode = 'MO';
                            } 
                        
                        	if($query[0]['status'] == 2) {
                            	$mode = 'Online';
                            }
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></a></td>
					 <td><?= $val['diety']; ?></td>
                     <td><?= $mode; ?></td>
					 <td><?= $query[0]['tot']; ?></td>
			 		  <td><div class="btn-group">
						  <a href="<?php echo $href; ?>" class="btn btn-outline-primary" title="Print"> <i class="fa fa-print"></i></a>
						  <!--<a href="<?php echo base_url(); ?>index.php/admin/admin/delete_bill/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a>  -->
						  </div>
					  </td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$query[0]['tot'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="7" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="4">Total</th>
							<th><?php echo $total;?></th>
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
    <div class="clearfix"></div>
    <br>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
    <script>
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