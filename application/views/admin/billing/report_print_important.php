 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
	        }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
    <table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center; "><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
    					</td>
    				</tr>
                <tr><th colspan="2">    ദിവസേന  നടത്തേണ്ട  പൂജകൾ </th></tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">DATE : <?php echo date('d-m-Y',strtotime($bill_list['0']['date']));?></label>
    					    <label style="float:center;">DIETY : <?php echo $bill_list[0]['deity_nm'];?></label>
    					
    				    </th>
                
                </tr>
    </thead></table>
		<div id="printer">
		  
			  <?php if(isset($bill_list)){?>
	          <div class="table-responsive">
				<table  border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
				  <thead>
					<tr>
					
                    <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Star</th>
					  <th scope="col" width="">Nos</th>
                     <th scope="col" width="">Bill No</th>
                       <th scope="col" width="">Bill Date</th>
					</tr>
				  </thead>
					<?php if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){ ?>
				  <tbody>
					<tr>
					 <td style="font-size: 1.1em"><?= $val['pooja_nm']; ?></td>
					 
					 <td style="font-size: 1.1em"><?php echo strtoupper($val['name']); ?></td>
                     <td><?php echo strtoupper($val['star_eng']); ?></td>
					
					 <td><?= $val['qlt']; ?></td>
                    <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['bill_id']; ?></strong></a></td>
                     <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?php echo date('d-m-Y',strtotime($val['billingdate'])); ?></strong></a></td>
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
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/bill_report_important" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/bill_report_important";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>