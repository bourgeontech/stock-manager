  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt"><?php echo $this->lang->line('treasure') ?? 'Bandaram'; ?> Summary</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Summary </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/bandaram_summary" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" required name="datef" style="margin:10px 0;">
                      <?php echo form_error('datet', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" required name="datet" style="margin:10px 0;">
                      <?php echo form_error('datet', '<div class="error">', '</div>'); ?>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($datef)){?>
	          <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Bandaram Name</th>
					  <th scope="col" width="">Amount</th>
					</tr>
				  </thead>
				  <tbody>
					<?php 
					$this->db->select('transaction.*,bandaram.name as bandaram_nm,SUM(transaction_dtls.total) as amd_tot');
					$this->db->from('transaction');
					$this->db->join('bandaram','transaction.bandaram = bandaram.id');
					$this->db->join('transaction_dtls','transaction_dtls.trans_id = transaction.id');
					$this->db->where("transaction.date BETWEEN '$datef' AND '$datet'");
					$this->db->group_by('transaction.bandaram');
					$query = $this->db->get()->result_array();
					$total=0;
					if(!empty($query)){
					    $i=0;
	                    foreach($query as $val){ 
	                        ?>
	                        <tr>
        					   	 <td><?= ++$i; ?></td>
        					     <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
            					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['bandaram_nm']; ?></strong></a></td>
            					 <td style="text-align: right;"><?= $val['amd_tot']; ?></td>
        					</tr>
	                    <?php 
	                    $total=$total+$val['amd_tot'];
	                    }
					}else{?>
						<tr><td colspan="9" style="text-align: center;">No Data Fount !</td></tr>
					<?php }?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3" style="text-align: left;">Total</th>
							<th style="text-align: right;"><?php echo $total;?></th>
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