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
                       <?php if(isset($from)){?>
	          <div class="table-responsive">
              	<small>Pooja booking done between <?php echo date('d-m-Y',strtotime($from));?> To <?php echo date('d-m-Y',strtotime($to));?><small>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
            <?php 
						$tot = 0;
                        $postal_amt_tot = 0;

					?>
                <?php foreach ($categories as $category_name => $pooja_data): ?>
                    <tr>
                        <th colspan="6"><?php echo $category_name ?></th>
                    </tr>
            		<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name of the Pooja</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" style="text-align:right">Rate</th>
                      <th scope="col" style="text-align:right">Postal Charges</th>
					  <th scope="col" style="text-align:right">Amount</th>
					</tr>
            		
                    <?php foreach ($pooja_data as $key => $pooja): ?>
                      <?php
                           $amt = $pooja['rate'] * $pooja['quantity']; 
                                  
                           $gross=$amt+$pooja['postal_amt'];  
                           $tot+=$gross;
                           $postal_amt_tot+=$pooja['postal_amt']; 

                        ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $pooja['pooja_name'] ?></td>
                            <td><?php echo $pooja['quantity'] ?></td>							
                            <td><?php echo $pooja['rate'] ?></td>
                            <td><?php echo $pooja['postal_amt'] ?></td>
                            <td><?php echo $gross; ?></td>

                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
 <?php } ?>
          
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
                <thead>
                	<tr>
                    	<th>Postal Amount</th>
                    	<th>Total Amount</th>
                	</tr>
                </thead>
                <tbody>
                	<tr>
                    	<th> <?= number_format((float)$postal_amt_tot, 2, '.', '');?></th>
                    	<th> <?= number_format((float)$tot, 2, '.', '');?> </th>
                	</tr>
                </tbody>
                
                </table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>