<head>
	<style>
    	.text-right{
        	text-align:right;
    	}
    	td{
        	padding:5px;
    	}
	</style>
</head>
<body onload="printcontend('printer')" onafterprint="myFunction()">
	<div id="printer">
				<table border="1" style="border-collapse:collapse;width:100%;">
				  <thead>
                  	<tr>
    					<td colspan="12" style="width:100%;">
                        	<div>
    							<h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    							<span style="font-size:10px;"><?php print_r($temple_list[0]['address'].$temple_list[0]['location']);?></span></h4>
    						</div>
                    	</td>
    				</tr>
    				<tr>
                    	<?php 
                    	$mntyr=explode("-",$mnth_yr);
                    	if($mnth_yr!=""){
                    	$date=$mntyr['0']."-".$mntyr['1']."-1";}?>
    					<th colspan="12"><label style="text-align:center;">RENT COLLECTION REPORT <?php if($mnth_yr!=""){ echo "FOR THE MONTH ".date('F,Y',strtotime($date));}?></label>
    				    </th>
    				</tr>
					<tr>
					  <th scope="col">SL No</th>
					  <th scope="col">Room No</th>
					  <th scope="col">Customer</th>
					  <th scope="col">Rent</th>
					  <th scope="col">Month , Year</th>
					  <th scope="col">Received Amount</th>
					  <th scope="col">Date</th>
					  <th scope="col">Balance</th>
					</tr>
				  </thead>
					<?php if(!empty($trans_list)){
	                      $i=0;
						  $rent_tot=0;
						  $rec_tot=0;
						  $bal_tot=0;
	                      foreach($trans_list as $val){ 
                          $date=$val['year']."-".$val['month']."-1";
                		$room_id=$val['room_id'];
                		$cust_id=$val['cust_id'];
                        $room = $this->db->query("SELECT * FROM room_dtl WHERE id='$room_id'")->row_array();
                        $cust = $this->db->query("SELECT * FROM room_cust WHERE id='$cust_id'")->row_array();
                          $rent_tot=$rent_tot+$val['rent'];
						  $rec_tot=$rec_tot+$val['rent_recv'];
						  $bal_tot=$bal_tot+$val['rent']-$val['rent_recv'];
                ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?= $room['room_no']; ?></td>
					  <td><?= $cust['name']; ?></td>
					  <td class="text-right"><?= $val['rent']; ?></td>
					  <td class="text-right"><?php echo date('F,Y',strtotime($date));?></td>
					  <td class="text-right"><?= $val['rent_recv']; ?></td>
					  <td><?php if($val['rent_recvdt']){ echo date('d-m-Y',strtotime($val['rent_recvdt']));} ?></td>
					  <td class="text-right"><?= $val['rent']-$val['rent_recv']; ?></td>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="8">No Data Found</td>
						  </tr>
				    <?php } ?>	
                	<tfoot>
                    	<tr>
                        	<th colspan="3">Total</th>
                        	<th class="text-right"><?= $rent_tot;?></th>
                        	<th class="text-right"></th>
                        	<th class="text-right"><?= $rec_tot;?></th>
                        	<th class="text-right"></th>
                        	<th class="text-right"><?= $bal_tot;?></th>
                    	</tr>
                	</tfoot>
				</table>
	</div>
</body>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/view_trans" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/view_trans";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>