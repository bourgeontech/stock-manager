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
    					<td colspan="12" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					<?php if($type=="3"){echo $cat="Other";$t="OT";}elseif($type=="2"){echo $cat="Silver"; $t="SI";}elseif($type=="1"){echo $cat="Gold"; $t="GO";}?> REGISTER Between <?php echo date('d-m-Y',strtotime($datef));?> to <?php echo date('d-m-Y',strtotime($datet));?></h4>
    					</td>
    				</tr>
    				<tr>
    				    <th>SL No </th>
                        <th>Date</th>
                        <th>No</th>
                        <th>Name &amp; Address</th>
                     	<th>Item Name</th>
					    <th>Unit</th><?php if ($id=="3"){$col=7;?>
                        <th>Item</th><?php }else {$col=4;}?>
                        <th style="text-align: right;">Qty</th>
                        <th style="text-align: right;">Weight</th>
                		<th style="text-align: right;">Value </th>
                        <th>Remark</th>
    				</tr>
				</thead>
				<?php 
				$total=0;
				$total_qty=0;
                        if(!empty($bill_list)){
						$i=0;
	                    foreach($bill_list as $val){
	                        $customer_id=$val['customer_id'];
	                        $this->db->select('*');
	                        $this->db->from('user_dtl');
	                        $this->db->where('id', $customer_id);
	                        $query = $this->db->get()->result_array();
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td style="white-space: nowrap;"><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;diszplay: block;color: #ea6227;"><?= @$t."". $val['annotation']; ?></strong></a></td>
					 <td><?php echo $val['name'];?></td>
					     <td><?php echo $val['poojaname'];?></td>
                    <td><?php echo $val['unit'];?></td>
                    	
					 <?php if ($id=="3"){?>
					 <td><?php echo $val['pooja'];?></td>
					 <?php }?>
					 <td style="text-align: right;"><?= $val['qlt']; ?></td>
					 <td style="text-align: right;"><?= $val['weight']; ?></td>
					 <td style="text-align: right;"><?= $val['amount']; ?></td>
					 <td><?php echo $val['remark'];?></td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$val['amount'];
					$total_qty=$total_qty+$val['qlt'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="10" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tr>
						<th></th>
                    	<th></th>
						<th colspan="<?php echo $col;?>" style="text-align: left;">Total</th><?php if ($id!="3"){?>
						<th style="text-align: right;"><?php echo $total_qty;?></th>
                    	<th></th><?php }?>
						<th style="text-align: right;"><?php echo $total;?></th>
						<th></th>
					</tr>
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/register/<?php echo $id;?>" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/register/<?php echo $id;?>";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>