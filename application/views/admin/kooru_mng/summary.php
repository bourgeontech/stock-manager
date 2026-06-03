  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Kooru Management</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Kooru Summary</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/kooru_rpt" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($from)){echo $from;}else{echo date('Y-m-d');}?>" title="Date From" required name="from" style="margin:10px 0;">
                      <?php echo form_error('from', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($to)){echo $to;}else{echo date('Y-m-d');}?>" title="Date To" required name="to" style="margin:10px 0;">
                      <?php echo form_error('to', '<div class="error">', '</div>'); ?>
                      <select name="diety" id="diety" class="form-control" autofocus="autofocus" style="margin:10px 0;height:auto;" required>
                          <option value="">Select Diety</option>
                          <option value="0" Selected>---All---</option>
            		  <?php foreach($diety_list as $val){ ?>
            			  <option value="<?= $val['id']; ?>" <?php if(isset($diety)&&$diety==$val['id']){echo "Selected";}?>><?=$val['name']; ?></option>
            		  <?php } ?>
            		  </select>
            		  <?php echo form_error('diety', '<div class="error">', '</div>'); ?>
            		  <select id="type" name="type" class="form-control" autofocus="autofocus" style="margin:10px 0;height:auto;">
                          <option value="">Select Type</option>
                          <option value="1" <?php if(isset($type)&&$type=="1"){echo "Selected";}?>>Cash Payment</option>
                          <option value="2" <?php if(isset($type)&&$type=="2"){echo "Selected";}?>>Online Payment</option>
                      </select>
                     <select class="form-control" name="pooja_cat" style="margin:10px 0; border-radius:0">
                        <option value="">----- All -----</option>
                      	<?php foreach($pooja_cat as $cat): ?>
                      	<option value="<?= $cat['id'] ?>" <?php if(isset($cat) && $cat == $cat['id']){echo 'selected';}?>><?= $cat['name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($from)){?>
	          <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="" class="slno">SL No </th>
					  <th scope="col" width="" class="name">Name of the Pooja</th>
					  <th scope="col" width="" class="qty">Quantity</th>
					  <?php 
					  $col=count($user_list);
					  $ids=array();
					  foreach($user_list as $val){ ?>
					  	<th scope="col" width="" data-id="<?php echo $val['id']; ?>"><?=$val['name'];?></th>
					  <?php 
					  $ids[]=$val['id'];
					  $col++;
					  }?>
                      <th scope="col" style="text-align:right">Total Vihitham</th>
					  <th scope="col" style="text-align:right">Rate</th>
					  <th scope="col" style="text-align:right">Amount</th>
					</tr>
				  </thead>
					<?php 
					$tot="0"; $shanthi=0;
$shanthitot=0;
                     $kazhakam=0;
                     $devaswom=0;
                     $vadyam=0;
                     $velichapad=0;  
					if(!empty($bill_list)){
	                    $i=0;
                    	?>
                	 <tbody>
                <?php
	                   
                 //   print_r($bill_list);exit;
                    foreach($bill_list as $val){ 
	                        $qty=$val['quantity'];
	                        $pooja_rt=$val['pooja_rt'];
	                        $amt=$qty*$pooja_rt;
	                        $tot=$tot+$amt;
	                        ?>
				 
					<tr>
					 <td class="slno"><?= ++$i;?></td>
					 <td class="pooja"><?= $val['pooja'];?></td>
					 <td class="qty"><?=$val['quantity'];?></td>
					 <?php
                    
                     $total_vihitham = 0;
					 foreach ($ids as $id){
					     $this->db->select('rate');
					     $this->db->from('kooru_mng');
					     $this->db->where('user_id', $id);
					     $this->db->where('pooja_id', $val['pooja_id']);
                        
					     $query = $this->db->get()->row_array();
                    // print_r($query);
					     $user_rate=$query['rate']*$qty;
                        if($user_rate != null) {
                        	$total_vihitham += $user_rate;
                        }
                    // print $id."-".$user_rate ."<br>"; 
                    /** if($id=='2')
                     {
                       $shanthi=($user_rate);
                     $shanthitot+=$shanthi;
                       
                     }
                     if($id=='3')
                     {
                       $kazhakam+=$user_rate;
                     }
                       if($id=='4')
                     {
                       $devaswom+=$user_rate;
                     }
                       if($id=='5')
                     {
                       $vadyam+=$user_rate;
                     }
                       if($id=='6')
                     {
                       $velichapad+=$user_rate;
                     }
                     */
                    
					 ?>
					 	<td data-id="<?php echo $id; ?>"><?php  print $user_rate!= 0 ? $user_rate : '';?></td>
					 <?php 
					 }?>
                     <td style="text-align:right" class="total_vihitham"><?= number_format((float)$total_vihitham, 2, '.', '');?></td>
					 <td style="text-align:right" class="rate"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
					 <td style="text-align:right" class="amount"><?= number_format((float)$amt, 2, '.', '');?></td>
					</tr>
				  
					<?php } ?>
                    </tbody>
                    <?php }
                     else {
					?>	
					<tbody><tr><td colspan="<?php echo count($user_list)+1?>" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
<!-- 					<tfoot>
						<tr>
                        <td colspan="3">&nbsp;</td>
    			<?php for($i=0;$i<count($user_list);$i++){ ?>
                        <td><?php echo $i; ?> </td> <?php } ?>
                        <td>&nbsp;</td>
                            <th style="text-align:right"><?= number_format((float)$tot, 2, '.', '');?></th>
					    </tr>
					</tfoot> -->
                	<tfoot>
				  	  <tr>
				  	  	<th class="slno">Total</th>
				  	  	<th class="name"></th>
                      	<th class="qty"></th>

				  	  	<?php  
                             foreach ($ids as $id){
                            ?>
                            	<th data-id="<?php echo $id; ?>"></th>
                            <?php 
                            }
                            ?>
                      	<th class="total_vihitham" style="text-align:right"></th>
                        <th class="rate"></th>
                        <th class="amount"></th>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        	var sums = [];
    		var total_rate = 0;
            var total_amount = 0;
    		var gross_total_vihitham = 0;
    
			$('thead tr th:not(.slno, .name, .qty)').each(function(i, e) {
  				sums[$(e).attr('data-id')] = 0;
			});

			$('tbody tr').each(function() {
            	let rate = parseFloat($(this).find('.rate').text())
            	if (!isNaN(rate) ) {
      				total_rate +=  rate;
    			}
            
            	let amount = parseFloat($(this).find('.amount').text())
            	if (!isNaN(amount) ) {
      				total_amount +=  amount;
    			}
            	
            	let total_vihitham = parseFloat($(this).find('.total_vihitham').text())
            	if (!isNaN(total_vihitham) ) {
      				gross_total_vihitham +=  total_vihitham;
    			}
				
  				$(this).find('td[data-id]').each(function() {
    				var columnId = $(this).attr('data-id');
  					var value = parseFloat($(this).text())
    				if (!isNaN(value) && sums[columnId] !== undefined) {
      					sums[columnId] += value;
    				}
  				}); 
			});
        
        $('tfoot tr th[data-id]').each(function() {
  var columnId = $(this).attr('data-id');
  if (sums[columnId] !== undefined) {
    $(this).text(sums[columnId].toFixed(2));
  }
});
    	$('tfoot tr .rate').text(total_rate.toFixed(2))
    	$('tfoot tr .amount').text(total_amount.toFixed(2))
    	$('tfoot tr .total_vihitham').text(gross_total_vihitham.toFixed(2))
    
        });
//         $(document).ready(function () {
//             $('table thead th').each(function (i) {
//                 if(i!=0&&i!=1 && i!=2){
//                 	calculateColumn(i);
//                 }
//             });
//         });
    
//         function calculateColumn(index) {
//             var total = 0;
//             $('table tr').each(function () {
//                 var value = parseFloat($('td', this).eq(index).text());
//                 if (!isNaN(value)) {
//                     total += value;
//                 }
//             });
//             $('table tfoot th').eq(index).text(total.toFixed(2));
//         }
//         
		
    </script>