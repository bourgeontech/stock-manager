  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Adjustment Report</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/adjustment" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Adjustment </h2>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <form  action="<?php echo base_url();?>index.php/admin/report/adjustment_report" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <select name="deity_id" id="deity" class="form-control" style="margin:10px 0;">
                    	<option value="">Select Deity</option>
        			    <?php foreach($deities as $deity){ ?>
        				<option value="<?= $deity['id']; ?>" <?php if(isset($deity_id)&&$deity_id==$deity['id']){echo "selected";}?>><?= $deity['name']; ?></option>
        			    <?php } ?>
        			  </select>
        			  <select name="pooja_id" id="poojas" class="form-control" style="margin:10px 0;">
                    	<option value="">Select Pooja</option>
        			    
        			  </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" type="button" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($purchase_list)){?>
			  <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover" width="100%">
				  <thead>
				      <tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;margin-bottom:2px;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?> <br>  <br> 					
                        <?php print_r($temple_list[0]['phone']);?></h4>

    					</td>
    				</tr>
    				<tr>
    					<th colspan="5"><label style="text-align:center;">Nadavaravu Statement From : <?php echo date('d-m-Y',strtotime($datef));?></label>
    					    <label style="float:center;">To : <?php echo date('d-m-Y',strtotime($datet));?></label>

                         <div style=text-align:end;> Generated On
                        <?php
							$date = date('d-m-y h:i:s');
							echo  $date;
							?>
                        </div>
                    	</th>
    				</tr>
				  </thead>
					<?php 
                        $total=0;
                        
                        if(!empty($purchase_list)){
						$i=0;
						foreach($purchase_list as $product){
                        $type=$product['type'];
	                        ?>
				  <tbody>
					<tr>
					  <td colspan="5" class="text-center"><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;font-size:18px"><?= $product['product_nm']; ?></strong></a></td>
					</tr>
                  	<tr>
                    	<td colspan="5" class="p-0 mb-5">
                        	<table class="table table-bordered table-hover text-nowrap mb-0" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Bill Qty</th>
                      <th scope="col" width="">Recvd Qty</th>
                      <th scope="col" width="">Issued Qty</th>
					  <th scope="col" width="">Unit</th>
					</tr>
				  </thead>
					<?php 
                        $product_id = $product['product_id'];
    
						$this->db->select('billing.*,diety.name as diety,diety.name_mal as diety_mal,adjustment.qty as qty,adjustment.rcvd_qty as rcvd_qty, (adjustment.qty - adjustment.rcvd_qty) as balance_qty, inv_unit.name as unit');
            			$this->db->from('billing');
            			$this->db->join('diety','diety.id = billing.diety_id');
    					$this->db->join('billing_dtls','billing_dtls.bill_id = billing.id');
    					$this->db->join('adjustment','adjustment.bill_id = billing.id');
                        $this->db->join('inv_unit','inv_unit.id = adjustment.unit');
            			$this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
    					$this->db->where('adjustment.product_id', $product_id);
            			$this->db->where('billing.deleted', '0');
            			if($deity_id) {
            				$this->db->where('billing.diety_id', $deity_id);
            			}
    
    					if($this->input->post('pooja_id')) {
            				$this->db->where('billing_dtls.pooja', $pooja_id);
            			}
            			$this->db->order_by("id", "asc");
                        $this->db->group_by("billing.id");
            			$query = $this->db->get();
            			if ($query->num_rows() > 0) {
                			$bills = $query->result_array();
            			}
            			else {
                			$bills = 0;
            			}
    		
    					$data['bills'] = $bills;
                        
                        $total=0;$rtot=0;
                        $role=$this->loggedIn['role'];
                        $today=date('Y-m-d');
                        $query1 = $this->db->query("SELECT pay_id FROM `payment` where payment_date='$today' AND (ledger='6' OR ledger='7')")->result_array();
                        if(!empty($bills)){
						$i=0;$baltot=0;$rtot=0;
                        $bill_qty = 0;
                        $rcvd_qty = 0;
                        $issued_qty = 0;
	                    foreach($bills as $val){
	                        $count=$val['count'];
	                        $status=$val['status'];
	                        if ($count=="0"&&$status=="1"){
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }else {
	                            $href=base_url("index.php/admin/admin/bill_print/".$val['id']);
	                        }
	                        $this->db->select('billing.*,sum(billing_dtls.amount) as tot');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls ','billing_dtls.bill_id=billing.id');
	                      
	                        $this->db->where('billing.id', $val['id']);
                        	$this->db->where("billing.deleted !=",'1');
	                        $query = $this->db->get()->result_array();
                       
                        $balance=$query[0]['tot']-$query[0]['recv_amt'];
                    		if(isset($type) && $type==2)  {
                            	$date = strtotime($val['transaction_date']);
                            } else {
                            	$date = strtotime($val['date']);
                            }
                        	$bill_qty = $bill_qty + $val['qty'];
                        	$rcvd_qty = $rcvd_qty + $val['rcvd_qty'];
                        	$issued_qty = $issued_qty + $val['balance_qty'];
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',$date); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></a></td>
					 <td><?= $val['qty']; ?></td>
                     <td><?= $val['rcvd_qty']; ?></td>
                     <td><?= $val['balance_qty']; ?></td>
					 <td><?= $val['unit']; ?></td>
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
							<th colspan="2">Total </th>
							<th><?= $bill_qty ?? ''; ?></th>
							<th><?= $rcvd_qty ?? ''; ?></th>
                        	<th><?= $issued_qty ?? ''; ?></th>
						</tr>
					</tfoot>	
				</table>
                    	</td>
					</tr>
                  	
				  </tbody>
					<?php 
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
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
    <script>
        
    	
    
        $('#deity').on('change', (e) => {
            var diety=e.target.value;
        	$('.row_deity_id').val(diety)
        
            $('#poojas').empty();
            var html='<option value="0">----All----</option>';
            var url = '<?php echo base_url();?>index.php/admin/admin/getpoojasbydiety';
        	$.ajax({
                type: "POST",
                url: url,
                data: {'diety': diety},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                    	html +='<option value="'+obj.pooja_id+'">'+obj.pooja+' - '+obj.pooja_mal+'</option>';
                    });
                    $('#poojas').append(html);
                }
            });
        })
    
    	$(document).on('change', '#poojas', (e) => {
        	console.log($('.row_pooja_id'))
        	let pooja=e.target.value;
        	$('.row_pooja_id').val(pooja)
        })
        
        $(document).ready(function() {
            var diety = $('#deity').val();
        	
            $('#poojas').empty();
            var html = '<option value="0">----All----</option>';
            var url = '<?php echo base_url();?>index.php/admin/admin/getpoojasbydiety';
            $.ajax({
                type: "POST",
                url: url,
                data: {'diety': diety},
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        html += '<option value="' + obj.pooja_id + '">' + obj.pooja + ' - ' + obj.pooja_mal + '</option>';
                    });
                    $('#poojas').append(html);
                }
            });
        });

        
        
        function printcontend(value) {
        	$(".action").css("display", "none");
        	var restorpage=document.body.innerHTML;
        	var printcontend=document.getElementById(value).innerHTML;
        	document.body.innerHTML=printcontend;
        	window.print();
        	document.body.innerHTML=restorpage;
        }
        function viewaction(){
        	$(".action").removeAttr('style');;
        }

    </script>