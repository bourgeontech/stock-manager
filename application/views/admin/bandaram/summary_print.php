 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
	        }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
				  <thead>
				  	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br>
    					Bandaram Counting For The Date <?php if (isset($datef)){echo date('d-m-Y',strtotime($datef));};?> To
    					<?php if (isset($datet)){echo date('d-m-Y',strtotime($datet));};?></h4>
    					</td>
    				</tr>
					<tr>
					  <th>SL No </th>
					  <th>Date</th>
					  <th>Bandaram Name</th>
					  <th>Amount</th>
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
            					 <td><strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['bandaram_nm']; ?></strong></td>
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
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/bandaram_summary" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/bandaram_summary";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>