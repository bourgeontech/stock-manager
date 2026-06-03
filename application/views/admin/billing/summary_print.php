 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
	        }
	        h4 {
	            paddin-bottom:-12px;
	            margin-bottom:-12px;
	        }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php
            $amt="0";
		    if($type!=null&&$diety!="0"){
		    ?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;margin-bottom:2px;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">DATE : <?php echo date('d-m-Y',strtotime($from));?></label>
    					    <label style="float:center;">TO : <?php echo date('d-m-Y',strtotime($to));?></label>
    					    <label style="float:right;font-size:bold;">DEITY - <?php echo $bill_list[0]['diety'];?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL NO</th>
                        <th>NAME OF THE POOJA</th>
                        <th>QUANTITY</th>
                        <th>RATE</th>
                        <th style="text-align:right">AMOUNT</th>
    				</tr>
				</thead>
				<tbody>
			    <?php 
			    $tot="0";
			    if(!empty($bill_list)){
                    $i=0;
                    foreach($bill_list as $val){ 
                        $qty=$val['quantity'];
                        $pooja_rt=$val['pooja_rt'];
                        $amt=$qty*$pooja_rt;
                        $tot=$tot+$amt;
                        ?>
				        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $val['pooja']; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $pooja_rt; ?></td>
                            <td style="text-align:right"><?= $amt; ?></td>
                        </tr>
				    <?php 
				    }}else {
					?>	
					<tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr>
					<?php } ?>
				</tbody>
				<tfoot>
				    <tr>
				        <th></th>
				        <th colspan="3" style="text-align:left;">Total</th>
				        <th style="text-align:right"><?= $tot; ?></th>
			        </tr>
				</tfoot>
			</table>
			<?php }elseif($type==null&&$diety!="0"){
			$query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,B.status,P.name AS pooja,A.rate AS pooja_rt,d.name AS diety FROM billing_dtls A JOIN pooja P on A.pooja=P.id
            JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND A.diety_id='$diety' AND B.status='1' and B.deleted='0' GROUP BY A.pooja")->result_array();
			?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;text-align:center;float:center;"><h4><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4><br>
    					<span>POOJA SUMMARY - AT TEMPLE</span>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">Date : <?php echo date('d-m-Y',strtotime($from));?></label>
    					    <label style="float:center;">To : <?php echo date('d-m-Y',strtotime($to));?></label>
    					    <label style="float:right;font-size:bold;">Deity - <?php echo $bill_list[0]['diety'];?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL No</th>
                        <th>Name of the Pooja</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th style="text-align:right">Amount</th>
    				</tr>
				</thead>
				<tbody>
			    <?php 
			    $tot1="0";
			    if(!empty($query)){
                    $i=0;
                    foreach($query as $val){ 
                        $qty=$val['quantity'];
                        $pooja_rt=$val['pooja_rt'];
                        $amt=$qty*$pooja_rt;
                        $tot1=$tot1+$amt;
                        ?>
				        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $val['pooja']; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $pooja_rt; ?></td>
                            <td style="text-align:right"><?= $amt; ?></td>
                        </tr>
				    <?php 
				    }}else {
					?>	
					<tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr>
					<?php } ?>
				</tbody>
				<tfoot>
				    <tr>
				        <th></th>
				        <th colspan="3" style="text-align:left;">Total</th>
				        <th style="text-align:right"><?= $tot1; ?></th>
			        </tr>
				</tfoot>
			</table>
			<?php
			$query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,B.status,P.name AS pooja,P.rate AS pooja_rt,d.name AS diety FROM billing_dtls A JOIN pooja P on A.pooja=P.id
            JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND A.diety_id='$diety' AND B.status='2' GROUP BY A.pooja")->result_array();
			?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;text-align:center;float:center;"><h4><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4><br>
    					<span>POOJA SUMMARY - ONLINE</span>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">Date : <?php echo date('d-m-Y',strtotime($from));?></label>
    					    <label style="float:center;">To : <?php echo date('d-m-Y',strtotime($to));?></label>
    					    <label style="float:right;font-size:bold;">Deity - <?php echo $bill_list[0]['diety'];?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL No</th>
                        <th>Name of the Pooja</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th style="text-align:right">Amount</th>
    				</tr>
				</thead>
				<tbody>
			    <?php 
			    $tot2="0";
			    if(!empty($query)){
                    $i=0;
                    foreach($query as $val){ 
                        $qty=$val['quantity'];
                        $pooja_rt=$val['pooja_rt'];
                        $amt=$qty*$pooja_rt;
                        $tot2=$tot2+$amt;
                        ?>
				        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $val['pooja']; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $pooja_rt; ?></td>
                            <td style="text-align:right"><?= $amt; ?></td>
                        </tr>
				    <?php 
				    }}else {
					?>	
					<tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr>
					<?php } ?>
				</tbody>
				<tfoot>
				    <tr>
				        <th></th>
				        <th colspan="3" style="text-align:left;">Total</th>
				        <th style="text-align:right"><?= $tot2; ?></th>
			        </tr>
				</tfoot>
			</table>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;text-align:center;float:center;"><h4><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4><br>
    					<span>POOJA SUMMARY</span>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">Date : <?php echo date('d-m-Y',strtotime($from));?></label>
    					    <label style="float:center;">To : <?php echo date('d-m-Y',strtotime($to));?></label>
    					    <label style="float:right;font-size:bold;">Deity - <?php echo $bill_list[0]['diety'];?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL No</th>
                        <th>Name of the Pooja</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th style="text-align:right">Amount</th>
    				</tr>
				</thead>
				<tbody>
			    <?php 
			    $tot3="0";
			    if(!empty($bill_list)){
                    $i=0;
                    foreach($bill_list as $val){ 
                        $qty=$val['quantity'];
                        $pooja_rt=$val['pooja_rt'];
                        $amt=$qty*$pooja_rt;
                        $tot3=$tot3+$amt;
                        ?>
				        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $val['pooja']; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $pooja_rt; ?></td>
                            <td style="text-align:right"><?= $amt; ?></td>
                        </tr>
				    <?php 
				    }}else {
					?>	
					<tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr>
					<?php } ?>
				</tbody>
				<tfoot>
				    <tr>
				        <th></th>
				        <th colspan="3" style="text-align:left;">Total</th>
				        <th style="text-align:right"><?= $tot3; ?></th>
			        </tr>
				</tfoot>
			</table>
			<?php }elseif($diety=="0"){
			?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;text-align:center;float:center;"><h4><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4><br>
    					<span>POOJA SUMMARY - AT TEMPLE</span>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">Date : <?php echo date('d-m-Y',strtotime($from));?></label>
    					    <label style="float:right;">To : <?php echo date('d-m-Y',strtotime($to));?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL No</th>
    				    <th>Diety Name</th>
                        <th>Name of the Pooja</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th style="text-align:right">Amount</th>
    				</tr>
				</thead>
				<tbody>
			    <?php 
			    $tot1="0";
			    $a=$this->db->query("SELECT id From diety");
		        $diety_id=$a->result_array();
		        foreach ($diety_id as $id){
		        $id=$id['id'];
			    $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,B.status,P.name AS pooja,P.rate AS pooja_rt,d.name AS diety FROM billing_dtls A JOIN pooja P on A.pooja=P.id
                JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND A.diety_id='$id' AND B.status='1' GROUP BY A.pooja")->result_array();
			    if(!empty($query)){
                    $i=0;
                    foreach($query as $val){ 
                        $qty=$val['quantity'];
                        $pooja_rt=$val['pooja_rt'];
                        $amt=$qty*$pooja_rt;
                        $tot1=$tot1+$amt;
                        ?>
				        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $val['diety']; ?></td>
                            <td><?= $val['pooja']; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $pooja_rt; ?></td>
                            <td style="text-align:right"><?= $amt; ?></td>
                        </tr>
				    <?php 
				    }}}?>
				    <tr>
				        <th></th>
				        <th colspan="4" style="text-align:left;">Total</th>
				        <th style="text-align:right"><?= $tot1; ?></th>
			        </tr>
				</tbody>
			</table>
			<?php
			?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;text-align:center;float:center;"><h4><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4><br>
    					<span>POOJA SUMMARY - ONLINE</span>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">Date : <?php echo date('d-m-Y',strtotime($from));?></label>
    					    <label style="float:right;">To : <?php echo date('d-m-Y',strtotime($to));?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL No</th>
    				    <th>Diety Name</th>
                        <th>Name of the Pooja</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th style="text-align:right">Amount</th>
    				</tr>
				</thead>
				<tbody>
			    <?php 
			    $tot2="0";
			    $a=$this->db->query("SELECT id From diety");
		        $diety_id=$a->result_array();
		        foreach ($diety_id as $id){
		        $id=$id['id'];
			    $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,B.status,P.name AS pooja,P.rate AS pooja_rt,d.name AS diety FROM billing_dtls A JOIN pooja P on A.pooja=P.id
                JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND A.diety_id='$id' AND B.status='2' GROUP BY A.pooja")->result_array();
			    if(!empty($query)){
                    $i=0;
                    foreach($query as $val){ 
                        $qty=$val['quantity'];
                        $pooja_rt=$val['pooja_rt'];
                        $amt=$qty*$pooja_rt;
                        $tot2=$tot2+$amt;
                        ?>
				        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $val['diety']; ?></td>
                            <td><?= $val['pooja']; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $pooja_rt; ?></td>
                            <td style="text-align:right"><?= $amt; ?></td>
                        </tr>
				    <?php 
				    }}}?>
				    <tr>
				        <th></th>
				        <th colspan="4" style="text-align:left;">Total</th>
				        <th style="text-align:right"><?= $tot2; ?></th>
			        </tr>
				</tbody>
			</table>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;text-align:center;float:center;"><h4><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4><br>
    					<span>POOJA SUMMARY</span>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">Date : <?php echo date('d-m-Y',strtotime($from));?></label>
    					    <label style="float:right;">To : <?php echo date('d-m-Y',strtotime($to));?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL No</th>
    				    <th>Diety Name</th>
                        <th>Name of the Pooja</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th style="text-align:right">Amount</th>
    				</tr>
				</thead>
				<tbody>
			    <?php 
			    $tot3="0";
			    $a=$this->db->query("SELECT id From diety");
		        $diety_id=$a->result_array();
		        foreach ($diety_id as $id){
		        $id=$id['id'];
			    $query=$this->db->query("SELECT A.bill_id,sum(A.qlt) AS quantity,B.status,P.name AS pooja,P.rate AS pooja_rt,d.name AS diety FROM billing_dtls A JOIN pooja P on A.pooja=P.id
                JOIN billing B on A.bill_id=B.id JOIN diety d ON A.diety_id=d.id WHERE A.date BETWEEN '$from' AND '$to' AND A.diety_id='$id' AND B.status!='0' GROUP BY A.pooja")->result_array();
			    if(!empty($query)){
                    $i=0;
                    foreach($query as $val){ 
                        $qty=$val['quantity'];
                        $pooja_rt=$val['pooja_rt'];
                        $amt=$qty*$pooja_rt;
                        $tot3=$tot3+$amt;
                        ?>
				        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $val['diety']; ?></td>
                            <td><?= $val['pooja']; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $pooja_rt; ?></td>
                            <td style="text-align:right"><?= $amt; ?></td>
                        </tr>
				    <?php 
				    }}}?>
				    <tr>
				        <th></th>
				        <th colspan="4" style="text-align:left;">Total</th>
				        <th style="text-align:right"><?= $tot3; ?></th>
			        </tr>
				</tbody>
			</table>
			<?php }?>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/bill_summary" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/bill_summary";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>