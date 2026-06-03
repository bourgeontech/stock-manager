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
			<?php 
			$this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm,billing_dtls.postal_amt as postal_amt,billing_dtls.amount');
			$this->db->from('billing_dtls');
			$this->db->join('stars','stars.id = billing_dtls.star');
			$this->db->join('pooja','pooja.id = billing_dtls.pooja');
			$this->db->join('diety','diety.id = billing_dtls.diety_id');
			$this->db->join('billing','billing.id = billing_dtls.bill_id');
			$this->db->where("billing.date BETWEEN '$date' AND '$dateto'");
			$this->db->where('billing.status', $type);
			$this->db->where('billing.deleted', '0');
			$query = $this->db->get()->result_array();
			if(count($query)>0){
			?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="11" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					DAILY REPORT - <strong style="margin-bottom: 5px;color: #ea6227;"><?php if ($type=="1"){echo "COUNTER";}elseif ($type=="2"){echo "ONLINE";}?></strong> - AS ON : <?php echo date('d-m-Y',strtotime($date));?></h4>
    					</td>
    				</tr>
    				<tr>
    				    <th>SL N0 </th>
                        <th>BILL N0</th>
    				    <td>NAME</td>
    				    <td>DIETY</td>
                        <td>STAR</td>
    				    <td>POOJA</td>
                        <th>NOS</th>
                        <th>VALUE</th>
                    <th>POSTAL</th>
                        <th>M/E</th>
                        <th>DATE</th>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';$tpost=0;
				    foreach($query as $val){ 
				        $qlt=$val['qlt'];
				        $pooja_rt=$val['pooja_rt'];
                    	$amt=$val['amount'];
				        $total=$total+$amt;
                    $tpost+=$val['postal_amt'];
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
				            <td><?php echo $val['bill_id'];?></td>
				            <td><?php echo strtoupper($val['name']);?></td>
				            <td><?php echo $val['deity_nm'];?></td>
				            <td><?php echo $val['star_eng'];?></td>
				            <td><?php echo $val['pooja_nm'];?></td>
				            <td style="text-align:right"><?php echo $qlt;?></td>
				            <td style="text-align:right"><?php echo $amt;?></td>
                         <td style="text-align:right"><?php echo  $val['postal_amt'];;?></td>
				            <td><?php echo $val['time'];?></td>
				            <td style="text-align:right;white-space: nowrap;"><?php echo date('d-m-Y',strtotime($val['date']));?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				    <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $total;?></th>
                     <th style="text-align:right"><?php echo $tpost;?></th> <th style="text-align:right"><?php echo ($tpost+$total);?></th>
				    
				        <th></th>
				    </tr>
				    <tr>
				        <th colspan="11" >For Online Pooja booking please visite <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
				    </tr>
				</tbody>
			</table>
			<?php }?>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/user_wise_pooja" }, 500); }
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