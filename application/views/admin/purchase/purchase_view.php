  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Purchase Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/purchase" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;View Purchase </h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/pu_register" class="btn btn-primary">Purchase Register</a> </li>
                  </ul>
                  <ul class="btn_ul" style="float:right;">
                  	<li> <a href="<?php echo base_url();?>index.php/admin/admin/pu_summary" class="btn btn-primary">Purchase Summary</a> </li>
                  </ul>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/purchase_view" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <select id="supplier" name="supplier" class="form-control" style="margin:10px 0;">
                          <option value="">Select Supplier</option>
                          <?php foreach($supplier as $val){ ?>
            				<option value="<?= $val['id']; ?>" <?php if(isset($suppl)&&$suppl==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
        				  <?php } ?>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
<!--                         <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button> -->
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($purchase_list)){?>
			  <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Invoice No</th>
					  <th scope="col" width="">Supplier</th>
					  <th scope="col" width="">Total Amount</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
					<?php 
                        $total=0;
                        if(!empty($purchase_list)){
						$i=0;
						foreach($purchase_list as $val){
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['invoice_no']; ?></strong></a></td>
					 <td><?= $val['name']; ?></td>
					 <td style="text-align: right;"><?= $val['total_amt']; ?></td>
			 		  <td><div class="btn-group">
    						  <a href="<?php echo base_url(); ?>index.php/admin/admin/edit_purchase/<?= $val['purchase_id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a>
    						  <a href="<?php echo base_url(); ?>index.php/admin/admin/delete_purchase/<?= $val['purchase_id']; ?>" onclick="return confirm('Are you sure you want to delete?')"
    						   class="btn btn-outline-danger" style="padding:6px;" title="Delete"> <i class="fa fa-trash"></i></a>
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
							<th colspan="3">Total</th>
							<th style="text-align: right;"><?php echo $total;?></th>
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