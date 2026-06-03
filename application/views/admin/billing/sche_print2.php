 <html>
	<head>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,SUM(billing_dtls.qlt) as qlt ,sum(billing_dtls.postal_amt) as postalamt,billing_dtls.amount as prasad_rt,diety.name_mal as deity_nm,billing.count,billing.customer_id,billing.total,billing.recv_amt,max(billing_dtls.date) as maxdate,,min(billing_dtls.date) as mindate');
		        $this->db->from('billing_dtls');
		        $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
				$this->db->group_by('billing_dtls.name,billing_dtls.pooja');

        	    $query = $this->db->get()->result_array();
              //  print_r($this->db->last_query());exit;
        	    
        	    if(count($query)>0){
		    ?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">DATE : <?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
    					    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
    				    </th>
    				</tr>
    				<?php if ($query[0]['customer_id']!="0"){
    				    $this->db->select('*');
    				    $this->db->from('user_dtl');
    				    $this->db->where('id', $query[0]['customer_id']);
    				    $query1 = $this->db->get()->result_array();
    				    ?>
    				<tr>
    					<td colspan="4">NAME</td>
    					<td colspan="5"><?php echo strtoupper($query1[0]['name']);?></td>
    				</tr>
    				<tr>
    					<td colspan="4">ADDRESS</td>
    					<td colspan="5"><?php echo strtoupper($query1[0]['house']." , ".$query1[0]['street']." , ".$query1[0]['post']." , ".$query1[0]['district']);?></td>
    				</tr>
    				<?php }?>
    				<tr>
    				    <td style="max-width:1cm;">Sl No</td>
    				    <td>NAME</td>
    				    <td>DEITY</td>
    				    <td>STAR</td>
    				    <td>POOJA</td>
    				    <td>NOS</td>
    				    <td>RATE</td>
						<!-- <td>PRASADAM</td> -->
    				    <td>AMOUNT</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
					$pra=0;
					$totalPooja = 0;
					$itemCount = count($query);
					$li = $itemCount -1;
				    foreach($query as $key => $val){ 
				        $qlt=$val['qlt'];
						$co=$val['count'];
				        $pooja_rt=$val['pooja_rt'];
				        $amt=$qlt*$pooja_rt;
				        $total=$total+$amt;
						$pra += $val['postalamt'];
						$totalPooja += $amt;
				    ?>
					<tr>
						<td><?php echo ++$key;?></td>
						<td><?php echo strtoupper($val['name']);?></td>
						<td><?php echo $val['deity_nm'];?></td>
						<td><?php echo $val['star_eng'];?></td>
						<td><?php echo $val['pooja_nm'];?><br><small style="white-space: nowrap;">(<?php echo date('d-m-Y',strtotime($val['mindate']));?> to <?php echo date('d-m-Y',strtotime($val['maxdate']));?>)</small></td>
						<td style="text-align:right"><?php echo $qlt;?></td>
						<td style="text-align:right"><?php echo $pooja_rt;?></td>
						<td style="text-align:right"><?php echo $amt;?>/-</td>
					</tr>
				 <?php } ?>
                   
				    <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total amount for pooja</th>
				        <th style="text-align:right"><?php echo $totalPooja;?>/-</th>
				        <th>
						</th>
				    </tr>
					<tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total amount for prasadam</th>
				        <th style="text-align:right"><?php echo $pra; ?>/-</th>
				        <th>
						</th>
				    </tr>
					
				
					<tr><th></th>
				        <th colspan="6" style="text-align:left">Grand Total</th>
				        <th style="text-align:right"><?php echo $totalPooja+$pra;?>/-</th>
				        <th>
						</th></tr>
				    <tr>
				        <th colspan="9" >For Online Pooja booking please visit <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
				    </tr>
            	</tbody>
			</table>
			<?php }?>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/schedule" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/schedule";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>