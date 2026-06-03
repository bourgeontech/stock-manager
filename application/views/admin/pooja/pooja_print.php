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
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					</td>
    				</tr>
    				<tr>
    				    <th style="width: 10%;">SL No</th>
                    <th style="width: 35%;">Code</th>  
                    <th style="width: 35%;">Name</th>
                        <th style="width: 35%;">Name In Malayalam</th>
                        <th style="width: 20%;">Amount</th>
    				</tr>
				</thead>
				<?php if(!empty($pooja_list)){
	                      $i=0;
	                       foreach($pooja_list as $val){ ?>
				  <tbody id="myTable">
					<tr>
					  <td><?= ++$i; ?></td>
                    <td><?= $val['code']; ?></td>
					  <td><?= $val['name']; ?></td>
					  <td><?= $val['name_mal']; ?></td>
					  <td><?= $val['rate']; ?></td>
					</tr>
				  </tbody>
					<?php 
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:right;">No Data Found!</td></tr></tbody>	
					<?php } ?>
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/pooja_view" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/pooja_view";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>