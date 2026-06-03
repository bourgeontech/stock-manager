 <style>


.header {
  overflow: hidden;
  background-color: white;
  padding: 8px 4px;
}
.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}


.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: gray;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }

}
</style>

<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Day Closing </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
        <?php if( $dayclosing == 1) { ?>
        <form method="post" action="<?php echo base_url(); ?>index.php/accounts/dayclosing">
        	<div class="input-group mb-3">
            	<input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d', strtotime($closing_date)); ?>"   max="<?php echo date('Y-m-d'); ?>" /> <!-- min="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" max="<?php echo date('Y-m-d'); ?>" -->
        		<input type="submit" name="save" class="btn btn-primary w-25" value="Search" />
			</div>
        </form>
        <?php } ?>
        </div>
    </div>
    <form action="<?php echo base_url(); ?>index.php/accounts/acc_post" method="post">
    	<?php if( $dayclosing == 1) { ?>
        <input type="hidden" name="closing_date" class="form-control" value="<?php if(isset($closing_date)){ echo $closing_date; }  ?>"  /> <!-- min="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" max="<?php echo date('Y-m-d'); ?>" -->
        <?php } ?>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	       <div class="table-responsive">
	       		<strong>Income From Counter</strong>
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
                      <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Qty</th>
					  <th scope="col" width="">Rate</th>
                      <th scope="col" width="">Total</th>
                    
				  </thead>
					<?php 
					$tot=0;
                    $recv_tot = 0;
					if(!empty($income)){
	                      $i=0;
	                      foreach($income as $val){ 
	                          $qty=$val['quantity'];
	                          $pooja_rt=$val['pooja_rt'];
	                          //$amt=$qty*$pooja_rt;
	                          $amt=$val['amount'];
                              $recv_amt = $val['recv_amt'];
	                          $tot+=$amt;
                          	  if(is_numeric($recv_amt)) {
                              	$recv_tot += $recv_amt;
                              }
                              
                               ?>
				  <tbody>
					<tr>
        				 <td><?= $val['pooja'];?></td>
    				 	 <td><?= $qty;?></td>	
        				 <td style="text-align:right"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
        				 <td style="text-align:right"><?= number_format((float)$amt, 2, '.', '');?></td>
                       
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				    <tfoot>
				    	<tr>
        				    <th colspan="3">Total 
<!--                               <input type="hidden" name="tot" value="<?php echo $tot;?>"> -->
                            <input type="hidden" name="tot" value="<?php echo $recvd;?>">
                            </th>
        				    <th style="text-align:right"><?= number_format((float)$tot, 2, '.', '');?></th>
                           
    				    </tr>
                    	
                    	<?php 
                    		$cash = 0;
                    		$other = 0;
                    		foreach($mode as $key => $m): 
                    			if($m['mode'] != 0):
                    	?>
                    		<?php 
                    			if($m['mode'] == 1) {
                                	$mode_name = 'Cash';
                                	$cash += $m['rec'];
                                } else if($m['mode'] == 5) {
                                	$mode_name = 'NEFT';
                                	$other += $m['rec'];
                                } else if($m['mode'] == 7) {
                                	$mode_name = 'Card';
                                	$other += $m['rec'];
                                } else if($m['mode'] == 6) {
                                	$mode_name = 'QR';
                                	$other += $m['rec'];
                                } else if($m['mode'] == 8) {
                                	$mode_name = 'MO';
                                	$cash += $m['rec'];
                                }
                    		?>
                    	<tr>
        				    <th colspan="3">Recieved  <?= $mode_name; ?>
                              <input type="hidden" name="mode[<?= $m['mode']; ?>]" value="<?php echo $m['rec'];?>">
                            </th>
        				    <th style="text-align:right"><?= number_format((float)$m['rec'], 2, '.', '');?></th>
                           
    				    </tr>
           				<?php endif; endforeach; ?>
                    	<input  type="hidden" name="cash" value="<?php echo $cash;?>">
                    	<input  type="hidden" name="other" value="<?php echo $other;?>">
					</tfoot>	
				</table>
           		
             </div>
			</div> 
          </div>
	    </div>
	    
	    <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	       <div class="table-responsive">
	       		<strong>Income From Online</strong>
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
                      <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Qty</th>
					  <th scope="col" width="">Rate</th>
                      <th scope="col" width="">Total</th>
					</tr>
				  </thead>
					<?php 
					$tot1=0;
					if(!empty($onlineincome)){
	                      $i=0;
	                      foreach($onlineincome as $val){ 
	                          $qty=$val['quantity'];
	                          $pooja_rt=$val['pooja_rt'];
	                          $amt=$qty*$pooja_rt;
	                          $tot1=$tot1+$amt;
                               ?>
				  <tbody>
					<tr>
        				 <td><?= $val['pooja'];?></td>
    				 	 <td><?= $qty;?></td>	
        				 <td style="text-align:right"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
        				 <td style="text-align:right"><?= number_format((float)$amt, 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				    <tfoot>
				    	<tr>
        				    <th colspan="3">Total <input type="hidden" name="tot1" value="<?php echo $tot1;?>"> <input type="hidden" name="online_income" value="<?php echo $tot1;?>"></th>
        				    <th style="text-align:right"><?= number_format((float)$tot1, 2, '.', '');?></th>
    				    </tr>
					</tfoot>
				</table>
             </div>
			<div class="table-responsive">
       			<strong>Dittum</strong>
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
<!-- 				  	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php// print_r($temple_list[0]['name']);?><br>
    					<?php// print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					</h4> -->
<!--     					</td> -->
<!--     				</tr> -->
					<tr>
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Nos</th>
					  <?php 
					  foreach($product_list as $pur){
					  ?>
					  <th scope="col" style="white-space: pre-wrap;"><?php echo $pur['name'];?></th>
					  <?php 
					  }
					  ?>
					</tr>
				  </thead>
				  <tbody>
                    <?php 
                    if (!empty($bill_list)){
                    foreach($bill_list as $pooja){
                        $pooja_qty=$pooja['quantity'];
                    ?>
                   <tr>
     <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $pooja['pooja']; ?></strong></a></td>
                            <td><?php echo $pooja_qty;?></td>
                            <?php 
                            foreach($product_list as $pro){
                                $this->db->select('qty,unit_id');
                                $this->db->from('dittum');
                                $this->db->where('pooja_id',$pooja['pooja_id']);
                                $this->db->where('product_id',$pro['id']);
                                $qty = $this->db->get()->row_array();
                                $pro_qty=$qty['qty'];
                                $tot_qty=$pooja_qty*$pro_qty;
                                if (!empty($tot_qty)){
                            ?>
                            	<td><?php if($tot_qty!=0){ echo $tot_qty;}?>
                            	<input type="hidden" name="dittum_qty[]" value="<?php echo $tot_qty;?>">
                            	<input type="hidden" name="product[]" value="<?php echo $pro['id'];?>">
                            	<input type="hidden" name="unit[]" value="<?php echo $qty['unit_id'];?>"></td>
                            <?php 
                                }else {
                                    echo "<td>-</td>";
                                }
                            }
                            ?>
                        </tr>
                    <?php 
                      }
                    }
                    ?>
				  </tbody>
				</table>
             </div>
             <div style="text-align:center;">
            	<input type="submit" name="submit" class="btn btn-success" value="Verify &amp; Post to Accounts"> 
         	 </div>
			</div> 
          </div>
	    </div>
    </form>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>