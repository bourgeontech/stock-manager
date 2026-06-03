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
    					<td colspan="20" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
                        Asset register as on <?php echo date('d-m-Y');?></h4>
    					</td>
    				</tr>
    				<tr>
    				    <th>#</th>
                        <th>DOCNO</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>I Code</th>
                        <th>I Name</th>
                        <th>Catagory</th>
                        <th>Sub Cat</th>
                        <th>P From</th>
                        <th>Bill No</th>
                        <th>Bill Date</th>
                        <th>Period</th>
                        <th>Details</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Weight</th>
                        <th>Rate</th>
                        <th>Price</th>
                        <th>Remark</th>
    				</tr>
				</thead>
				<?php 
                        $total=0;
                        if(!empty($asset_list)){
						$i=0;
						foreach($asset_list as $val){
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['docno']; ?></strong></td>
					  <td><?= $val['loc_nm']; ?></td>
					  <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					  <td><?= $val['itemcode']; ?></td>
					  <td><?= $val['itemname']; ?></td>
					  <td><?= $val['cat_nm']; ?></td>
					  <td><?= $val['scat_nm']; ?></td>
					  <td><?= $val['p_from']; ?></td>
					  <td><?= $val['bill_no']; ?></td>
					  <td><?= date('d-m-Y',strtotime($val['bill_date'])); ?></td>
					  <td><?= $val['period']; ?></td>
					  <td><?= $val['details']; ?></td>
					  <td><?= $val['qlt']; ?></td>
					  <td><?= $val['unit']; ?></td>
					  <td><?= $val['weight']; ?></td>
					  <td><?= $val['rate']; ?></td>
					  <td><?= $val['price']; ?></td>
					  <td><?= $val['remark']; ?></td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$val['price'];
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="20" style="text-align:right;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
							<th></th>
							<th style="text-align: left;" colspan="16">Total</th>
							<th style="text-align: right;"><?php echo $total;?></th>
							<th></th>
						</tr>
					</tfoot>
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/view_asset" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/view_asset";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>