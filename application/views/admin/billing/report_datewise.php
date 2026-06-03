  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Billing Master</42>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
   <!-- <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >-->
   <!--   <div class="clearfix"></div>-->
	  <!-- <div class="row">-->
   <!--     <div class="col-lg-6 col-md-6 col-sm-6 ">-->
   <!--       <h2 class="page_txt"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;&nbsp;Billing Report </h2>-->
   <!--     </div>-->
   <!--     <div class="col-lg-6 col-md-6 col-sm-6 ">-->
   <!--       <ul class="btn_ul">-->
   <!--         <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>-->
   <!--       </ul>-->
   <!--     </div>-->
	  <!-- </div>-->
	  <!--</div>-->
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Bill </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/bill_report" method="post">
               <div class="form-group">  
                 <table  class="table" class="form-group"><tr><td>     <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}else{echo date('Y-m-d');}?>" required name="keyword" style="margin:10px 0;">&nbsp;&nbsp;&nbsp;
                      <?php echo form_error('keyword', '<div class="error">', '</div>'); ?></td>
                  &nbsp;  <td>  <input type="date" class="form-control" value="<?php if(isset($date)){echo $date;}else{echo date('Y-m-d');}?>" required name="keyword2" style="margin:10px 0;"> </td>
               <td>    <select name="temple[]" id="temple_100" onchange="changepooja(100)" class=" sq_form" required style="width: 3.2cm;">
                                	<option value="">Select Diety</option>
                    			<?php foreach($diety_list as $val){ ?>
                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
               <?php } ?>	</select></td>
             <td>        <select name="pooja[]" id="pooja_100" onchange="change_rate(100)" onload="change_rate(100)" class="sq_form" required style="width: 3.2cm;">
                                	<option value="">Select Pooja</option>
             </select> </td>
                				
                    
                      <?php echo form_error('diety', '<div class="error">', '</div>'); ?>
            	<td>  	  <select name="type" id="type" class="form-control" style="margin:10px 0;height:auto;">
                          <option value="">Select Type All</option>
            			  <option value="1" <?php if(isset($type)&&$type=="1"){echo "Selected";}?>>Scheduled</option>
                </select> </td>
            		  <?php echo form_error('diety', '<div class="error">', '</div>'); ?>
            		<td>    <select name="ampm" id="ampm" class="form-control" style="margin:10px 0;height:auto;">
                          <option value="">Select Time All</option>
            			  <option value="M" <?php if(isset($ampm)=="M"){echo "Selected";}?>>Morning</option>
                       <option value="E" <?php if(isset($ampm)=="E"){echo "Selected";}?>>Evening</option>
                    </select> </td>
                    
                    
            	<td>  <?php echo form_error('type', '<div class="error">', '</div>'); ?>
                   
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> </td><td>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button></td><td>
                      <button type="submit" class="btn btn-outline-secondary" name="serch" value="pooja_wise" title="Pooja Wise Print"><i class="fa fa-file" aria-hidden="true"></i></button>
                      </td>
                 </tr></table>
                
                  </form>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                  <a href="<?php echo base_url();?>index.php/admin/admin/bill_summary">
                      <button class="btn btn-primary pull-right" title="Summary" style="margin:10px 0;">Summary</button> 
                  </a>
              </div>      
			 </div>
	         <?php if(isset($bill_list)){?>
	          <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Star</th>
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Nos</th>
					</tr>
				  </thead>
					<?php if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['bill_id']; ?></strong></a></td>
					 <td style="font-size: 1.1em"><?= $val['name']; ?></td>
					 <td><?= $val['star_eng']; ?></td>
					 <td><?= $val['pooja_nm']; ?></td>
					 <td><?= $val['qlt']; ?></td>
					</tr>
				  </tbody>
					<?php } }
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
    function changepooja(e){
        var diety=$('#temple_'+e).val();
        if (diety=="8" || diety=="7"|| diety=="5"){
        	$('#amt_'+e).attr('readonly', false);
        }else{
        	$('#amt_'+e).attr('readonly', true); 
        }
        $('#pooja_'+e).html("");
        var html='<option value="0">Please Select</option>';
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
                $('#pooja_'+e).append(html);
            }
        });
    }
    
    </script>