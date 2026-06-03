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
    					<td colspan="99" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
    					</td>
    				</tr>
    				<tr>
					  <th>Pooja</th>
					  <th>Nos</th>
					  <?php 
					  foreach($product_list as $pur){
					  ?>
					  <th style="white-space: pre-wrap;"><?php echo $pur['name'];?></th>
					  <?php 
					  }
					  ?>
					</tr>
				  </thead>
				  <tbody>
                    <?php 
                    if (!empty($bill_list)){
                    foreach($bill_list as $pooja){
                        $pooja_qty=$pooja['quantity'];
                    ?>
                        <tr>
                            <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $pooja['pooja']; ?></strong></a></td>
                            <td><?php echo $pooja_qty;?></td>
                            <?php 
                            foreach($product_list as $pro){
                                $this->db->select('qty');
                                $this->db->from('dittum');
                                $this->db->where('pooja_id',$pooja['pooja_id']);
                                $this->db->where('product_id',$pro['id']);
                                $qty = $this->db->get()->row_array();
                                $pro_qty=$qty['qty'];
                                $tot_qty=$pooja_qty*$pro_qty;
                            ?>
                            	<td><?php if($tot_qty!=0){ echo $tot_qty;}?></td>
                            <?php 
                            }
                            ?>
                        </tr>
                    <?php 
                      }
                    }
                    ?>
				  </tbody>
				  <tfoot>
				  	  <tr>
				  	  	<th>Total</th>
				  	  	<th></th>
				  	  	<?php 
                            foreach($product_list as $pro){
                            ?>
                            	<th style="text-align: left;"></th>
                            <?php 
                            }
                            ?>
				  	  </tr>
				  </tfoot>
				</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/dittum_rprt" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/dittum_rprt";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('table thead th').each(function (i) {
            if(i!=0&&i!=1){
            	calculateColumn(i);
            }
        });
    });
    function calculateColumn(index) {
        var total = 0;
        $('table tr').each(function () {
            var value = parseFloat($('td', this).eq(index).text());
            if (!isNaN(value)) {
                total += value;
            }
        });
        $('table tfoot th').eq(index).text(total);
    }
</script>