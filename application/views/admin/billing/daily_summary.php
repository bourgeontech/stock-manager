  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Daily Summary</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing_view" class="btn btn-primary">Back</a> </li>
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
              <div class="col-lg-10 col-md-10 col-sm-10 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/daily_summary" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}else{echo date('Y-m-d');}?>" name="date" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($dateto)){echo $dateto;}else{echo date('Y-m-d');}?>" name="dateto" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($bill_list)){?>
	          <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
				  	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					Daily Summary From <?php echo date('d-m-Y',strtotime($date));?> - <?php echo date('d-m-Y',strtotime($dateto));?></h4>
    					</td>
    				</tr>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Counter</th>
					  <th scope="col" width="">Online</th>
					  <th scope="col" width="">Total</th>
					</tr>
				  </thead>
					<?php 
                        $total=0;
                        $counter=0;
                        $online=0;
                        if(!empty($bill_list)){
						$i=0;
	                    foreach($bill_list as $val){
	                        $this->db->select('billing.*,SUM(billing_dtls.amount) AS amount');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls','billing_dtls.bill_id = billing.id');
	                        $this->db->join('pooja','pooja.id = billing_dtls.pooja');
	                        $this->db->where('billing.date',$val['date']);
	                        $this->db->where('billing.status',2);
	                        $query = $this->db->get()->row_array();
	                        $main_tot=$val['amount']+$query['amount'];
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><?= $val['amount']; ?></td>
					 <td><?= $query['amount']; ?></td>
					 <td><?= $main_tot; ?></td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$main_tot;
					$counter=$counter+$val['amount'];
					$online=$online+$query['amount'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th>Total</th>
							<th><?php echo $counter;?></th>
							<th><?php echo $online;?></th>
							<th><?php echo $total;?></th>
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
    <script>
    function printcontend(value) {
    	var restorpage=document.body.innerHTML;
    	var printcontend=document.getElementById(value).innerHTML;
    	document.body.innerHTML=printcontend;
    	window.print();
    	document.body.innerHTML=restorpage;
    }
    
    </script>
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