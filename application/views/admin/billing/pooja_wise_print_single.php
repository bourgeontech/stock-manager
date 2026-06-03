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
			 <?php if(isset($bill_list)){?>
	          <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				 
                
                <thead>
				<tr>
					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?>
					<br><br>Report  <?php //print_r($bill_list);exit;?> from <?php echo $keyword;?> - <?php echo $dateto;?></h4>
					</td>
				</tr>
                <tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Bill No</th>
                      <th scope="col" width="">Date</th>
                 <th scope="col" width=""> Pooja Date</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Star</th>
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Nos</th>
                     <th scope="col" width="">Amout</th> <th scope="col" width="">Mode</th>
					</tr>
				  </thead>
					<?php if(!empty($bill_list)){
	                    $i=0;  $total=0;$nos=0;
	                    foreach($bill_list as $val){
                        $subtot=$val['amount'];
                      $total+=$subtot;
               if( $val['mode']=='5') {$mode="Neft";} elseif  ($val['mode']=='6'){$mode="QR";} else {$mode="Cash";}  
               //$mode="Cash"; 
                ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['bill_id']; ?></strong></a></td>
                     <td><?= date("d-m-Y", strtotime(@$val['bill_date'])); ?></td>
                       <td><?= date("d-m-Y", strtotime(@$val['date'])); ?></td>
                     <td><?= $val['name']; ?></td>
					 <td><?= $val['star_eng']; ?></td>
					 <td><?= $val['pooja_nm']; ?></td>
					 <td><?php $nos+=$val['qlt']; echo $val['qlt']; ?></td>
                     <td><?= $subtot; ?></td>
                     <td><?= $mode; ?></td>
					</tr>
				  </tbody>
				<?php } ?>
                <tr><td colspan="7">&nbsp;</td><td><?php echo $nos ;?></td><td><?php echo $total ;?> </td></tr>
                <?php
                   }   else {
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
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/bill_report" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/bill_report_poojawise";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>