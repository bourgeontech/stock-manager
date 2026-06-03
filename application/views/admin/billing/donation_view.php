  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Donation Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/donation" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Donation </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/register/3" class="btn btn-primary">Other Register</a> </li>
                  </ul>
             <ul class="btn_ul" style="float:right;">
                  	<li> <a href="<?php echo base_url();?>index.php/admin/admin/register/4" class="btn btn-primary">Bronze Register</a> </li>
                  </ul>
                  <ul class="btn_ul" style="float:right;">
                  	<li> <a href="<?php echo base_url();?>index.php/admin/admin/register/2" class="btn btn-primary">Silver Register</a> </li>
                  </ul>
                  <ul class="btn_ul" style="float:right;">
                  	<li> <a href="<?php echo base_url();?>index.php/admin/admin/register/1" class="btn btn-primary">Gold Register</a> </li>
                  </ul>
              </div>
			 </div>
	          <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
                     <th scope="col" width="">Type  </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Diety</th>
					  <th scope="col" width="">Total</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
					<?php 
                        $total=0;
                    $role=$this->loggedIn['role'];
                        $today=date('Y-m-d');
                        if(!empty($bill_list)){
						$i=0;
	                    foreach($bill_list as $val){
                        
                          $type=$val['category'];
                            if($type=="3"){ $cat="Other"; $t="OT";}elseif($type=="4"){ $cat="Bronze";  $t="BR";}elseif($type=="2"){ $cat="Silver";  $t="SI";}elseif($type=="1"){ $cat="Gold";  $t="GO";}?>
	                       
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
                     <td><?php echo $t.$val['annotation'];?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><?= $val['deity_nm']; ?></td>
					 <td><?= $val['total_amt']; ?></td>
			 		 <td><div class="btn-group">
						  <a href="<?php echo base_url(); ?>index.php/admin/admin/donation_print/<?= $val['bill_id']; ?>" target="_blank" class="btn btn-outline-primary" title="Print"> <i class="fa fa-print"></i></a>
						  <?php if ($role=="superadmin"){?> <a href="<?php echo base_url(); ?>index.php/admin/admin/deletedonation/<?= $val['bill_id']; ?>"  onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a><?php } ?>
						  </div>
					  </td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$val['total_amt'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="2">Total</th>
							<th><?php echo $total;?></th>
							<th></th>
						</tr>
					</tfoot>	
				</table>
             </div>
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