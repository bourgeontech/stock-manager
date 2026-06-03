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
            <div>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="11" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br> <?php echo date('d-m-Y',strtotime($datef)); ?> TO <?php echo date('d-m-Y',strtotime($datet)); ?><br>
    					</td>
    				</tr>
                    
    				<tr>
                      <th scope="col" width="">SL No</th>
                      <th scope="col" width="">Bill Number</th>
                      <th scope="col" width="">Bill Date</th> 
                      <th scope="col" width="">Diety</th>
                      <th scope="col" width="5px">Name</th>
					  <th scope="col" width="">Star</th>
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Pooja Date</th>
					  <th scope="col" width="">MO/Cheque No</th>
                      <th scope="col" width="10px">MO/Cheque Date</th>
                      <th scope="col" width="">Amount</th>
    				</tr>
                    </thead>
					<?php if(!empty($poojareg_list)){
	                      $i=0;
	                       foreach($poojareg_list as $val){ ?>
				  <tbody id="myTable">
					<tr>
                    <td><?= ++$i; ?></td>
                      <td><?= $val['bill_id']; ?></td>
                      <td><?= $val['bill_date']; ?></td>
                       <td><?= $val['dietyname']; ?></td>
                      <td><?= $val['name']; ?></td>
                      <td><?= $val['starname']; ?></td>
                      <td><?= $val['poojaname']; ?></td>
                      <td><?= $val['date']; ?></td>
					  <td><?= $val['number']; ?></td>
                      <td><?= $val['mode_date']; ?></td>
					  <td><?= $val['amount']; ?></td>
                      <!-- <td><div class="btn-group">
						        <a href="<?php echo base_url();?>index.php/admin/admin/edit_customer/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
                 </div></td> -->
            </tbody>	
					<?php }} ?>
			</table>
          </div>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/pooja_register" }, 500); }
function myFunction(){
   window.location = "<?php echo base_url();?>index.php/admin/admin/pooja_register";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>