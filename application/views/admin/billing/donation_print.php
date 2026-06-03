 <html>
	<head>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="10" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="10"><label style="float:left;">Date : <?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
    					    <label style="float:right;font-size:bold;">NO - 
                            
                            <?php
                            $type=$bill_list[0]['category'];
                            if($type=="3"){ $cat="Other"; $t="OT";}elseif($type=="4"){ $cat="Bronze";  $t="BR";}elseif($type=="2"){ $cat="Silver";  $t="SI";}elseif($type=="1"){ $cat="Gold";  $t="GO";}?>
                            <?php echo $t."".$bill_list[0]['annotation'];?></label>
    				    </th>
    				</tr>
    				<?php if ($bill_list[0]['customer_id']!="0"){
    				    $this->db->select('*');
    				    $this->db->from('user_dtl');
    				    $this->db->where('id', $bill_list[0]['customer_id']);
    				    $query1 = $this->db->get()->result_array();
    				    ?>
    				<tr>
    					<td colspan="4">NAME</td>
    					<td colspan="6"><?php echo strtoupper($query1[0]['name']);?></td>
    				</tr>
    				<tr>
    					<td colspan="4">ADDRESS</td>
    					<td colspan="6"><?php echo strtoupper($query1[0]['house']." , ".$query1[0]['street']." , ".$query1[0]['post']." , ".$query1[0]['district']);?></td>
    				</tr>
    				<?php }?>
    				<tr>
    				    <td style="max-width:1cm;">SL NO</td>
    				    <td>NAME</td>
    				    <td>STAR</td>
    				    <td>DESCRIPTION</td>
    				    <td>ITEM</td>
    				    <td>REMARK</td>
    				    <td>QTY</td>
    				    <td>UNIT</td>
    				    <td>WEIGHT</td>
    				    <td>VALUE</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total=0;
				    foreach($bill_list as $val){ 
				        $amt=$val['amount'];
				        $total += (float)$amt;
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
				            <td><?php echo strtoupper($val['name']);?></td>
				            <td><?php echo $val['star_eng'];?></td>
				            <td><?php echo $val['deity_nm'];?></td>
				            <td><?php echo $val['pooja_nm'];?></td>
				            <td><?php echo $val['remark'];?></td>
				            <td style="text-align:right"><?php echo $val['qlt'];?></td>
				            <td style="text-align:right"><?php echo $val['unit'];?></td>
				            <td style="text-align:right"><?php echo $val['weight'];?></td>
				            <td style="text-align:right"><?php echo (float)$amt;?>/-</td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				</tbody>
				<tfoot>
				    <tr>
				        <th></th>
				        <th colspan="8" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $total;?>/-</th>
				    </tr>
				    <tr>
				        <th colspan="10" >For Online Pooja booking please visit <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
				    </tr>
				</tfoot>
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/donation_view" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/donation_view";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>