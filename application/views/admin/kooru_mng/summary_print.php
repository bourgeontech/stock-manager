 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
	        }
	        h4 {
	            paddin-bottom:-12px;
	            margin-bottom:-12px;
	        }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		
				<table  border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;" width="100%">
				 
                <thead>
              
    				<tr>
    					<td colspan="10" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                        <?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br>
                        For the date  <?php echo date('d-m-Y',strtotime($from));?> TO  <?php echo date('d-m-Y',strtotime($to));?></h4><br>
    				
                    </td>
    				</tr>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name of the Pooja</th>
					  <th scope="col" width="">Quantity</th>
					  <?php 
					  $col=3;
					  $ids=array();
					  foreach($user_list as $val){ ?>
					  	<th scope="col" width=""><?=$val['name'];?></th>
					  <?php 
					  $ids[]=$val['id'];
					  $col++;
					  }?>
                      <th scope="col" style="text-align:right">Total Vihitham</th>
					  <th scope="col" style="text-align:right">Rate</th>
					  <th scope="col" style="text-align:right">Amount</th>
					</tr>
				  </thead>
<!-- 					<?php 
					$tot="0"; $shanthi=0;
$shanthitot=0;
                     $kazhakam=0;
                     $devaswom=0;
                     $vadyam=0;
                     $velichapad=0;  
					if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){ 
	                        $qty=$val['quantity'];
	                        $pooja_rt=$val['pooja_rt'];
	                        $amt=$qty*$pooja_rt;
	                        $tot=$tot+$amt;
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					 <td><?= $val['pooja'];?></td>
					 <td><?= $qty;?></td>
					 <?php
                    
                        
					 foreach ($ids as $id){
					     $this->db->select('rate');
					     $this->db->from('kooru_mng');
					     $this->db->where('user_id', $id);
					     $this->db->where('pooja_id', $val['pooja_id']);
					     $query = $this->db->get()->row_array();
                   //  print_r($query);
					     $user_rate=$query['rate']*$qty;
                    // print $id."-".$user_rate ."<br>"; 
                     if($id=='2')
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
                     
                    
					 ?>
					 	<td><?php  print $shanthi;?></td>
					 <?php 
					 }?>
					 <td style="text-align:right"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
					 <td style="text-align:right"><?= number_format((float)$amt, 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php } }
                     else {
					?>	
					<tbody><tr><td colspan="20" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
    					    <th colspan="3">&nbsp;</th> 
                        <th ><?php echo $shanthitot;?></th>
    				    <th ><?php echo $kazhakam;?></th>
                         <th ><?php echo $devaswom;?></th>
                         <th ><?php echo $vadyam;?></th>
                          <th ><?php echo $velichapad;?></th>
                         
    					    <th style="text-align:right"><?= number_format((float)$tot, 2, '.', '');?></th>
					    </tr>
					</tfoot>
				</table> -->
         		<?php 
					$tot="0"; $shanthi=0;
					$shanthitot=0;
                     $kazhakam=0;
                     $devaswom=0;
                     $vadyam=0;
                     $velichapad=0;  
                	 $vihitham_tot = 0;
                	 $rate_tot = 0;
                	 $amount_tot = 0;
                	 $user_tot_array = array();
                	 
                     foreach ($ids as $id){
                     	$user_tot_array[$id] = 0;
                     }
                
					if(!empty($bill_list)){
	                    $i=0;
                    	?>
                	 <tbody>
                <?php
	                   
                 
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
                   //  print_r($query);
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
                    	// $user_tot += ($user_rate ?? 0);
                     	$user_tot_array[$id] += ($user_rate ?? 0);
                     	
					 ?>
					 	<td data-id="<?php echo $id; ?>"><?php  print $user_rate!= 0 ? $user_rate : '';?></td>
					 <?php 
					 } 
                     $vihitham_tot += number_format((float)$total_vihitham, 2, '.', '');
                	 $rate_tot += number_format((float)$pooja_rt, 2, '.', '');
                	 $amount_tot += number_format((float)$amt, 2, '.', '');
                    ?>
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
                            	<th data-id="<?php echo $id; ?>"><?= $user_tot_array[$id]; ?></th>
                            <?php 
                            }
                            ?>
                      	<th class="total_vihitham" style="text-align:right"><?= $vihitham_tot; ?></th>
                        <th class="rate"><?= $rate_tot; ?></th>
                        <th class="amount"><?= $amount_tot; ?></th>
				  	  </tr>
				  	</tfoot>
				</table>
        	
         </div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/kooru_rpt" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/kooru_rpt";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>