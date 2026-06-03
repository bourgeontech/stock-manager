 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
            font-size:12px;
	        }
	    </style>
	</head>
 <?php  ?>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					<strong style="margin-bottom: 5px;color: #ea6227;">DELETED BILLS DATE FROM : <?php echo date('d-m-Y',strtotime($date));?> TO : <?php echo date('d-m-Y',strtotime($dateto));?></h4>
    					</td>
    				</tr>
    				<tr>
					<th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Diety</th>
					  <th scope="col" width="">Total</th>
                     <th scope="col" width="">Recvd</th>
                     <th scope="col" width="">Balance</th>
                     <th scope="col" width="">Delete Date</th>
                     <th scope="col" width="">Reason</th>
    				</tr>
				</thead>
				<?php 
                        $total=0;$rtot=0;
                        $role=$this->loggedIn['role'];
                        $today=date('Y-m-d');
                        $query1 = $this->db->query("SELECT pay_id FROM `payment` where payment_date='$today' AND (ledger='6' OR ledger='7')")->result_array();
                        if(!empty($bill_list)){
						$i=0;$baltot=0;$rtot=0;
	                    foreach($bill_list as $val){
	                        $this->db->select('billing.*,SUM(billing_dtls.amount) as tot');
	                        $this->db->from('billing');
	                        $this->db->join('billing_dtls ','billing_dtls.bill_id=billing.id');
	                      
	                        $this->db->where('billing.id', $val['id']);
	                        $query = $this->db->get()->result_array();
                       
                        $balance=$query[0]['tot']-$query[0]['recv_amt'];
                    
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['id']; ?></strong></a></td>
					 <td><?= $val['diety']; ?></td>
					 <td><?= $query[0]['tot']; ?></td>
                     <td><?= $query[0]['recv_amt']; $rtot+=$query[0]['recv_amt'] ?></td>
                     <td><?= $balance; ?></td>
					 <td><?= date('d-m-Y',strtotime($val['dl_date'])); ?></td>
					 <td><?= $val['dl_reason']; ?></td>
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
							<th colspan="3">Total</th>
							<th><?php echo $total;?></th>
                        <th><?php echo $rtot;?></th>
                        <th><?php echo ($total-$rtot);?></th>
							<th colspan="3"></th>
						</tr>
					</tfoot>	
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/deleted_bill" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/deleted_bill";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>