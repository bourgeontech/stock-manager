 <html>
	<head>
	<style type="text/css">
	body {
    	font-size:9px;
    	font-weight:bold;
	}	

	</style>
<!--     <link rel="stylesheet" type"text/css" href="print.css" media="print"> -->
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php 
        		$site_settings=$this->site_model->settings();
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing.bal_amt as balance, billing.mode as mode, billing_dtls.rate as pooja_rt,SUM(billing_dtls.qlt) as qlt ,sum(billing_dtls.postal_amt) as postalamt,billing_dtls.amount as prasad_rt,diety.name_mal as deity_nm,billing.count,billing.customer_id,billing.total,billing.recv_amt,(billing_dtls.date) as date, max(billing_dtls.date) as maxdate,min(billing_dtls.date) as mindate');
		        $this->db->from('billing_dtls');
		        $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
				$this->db->group_by('billing_dtls.name,billing_dtls.pooja');

        	    $query = $this->db->get()->result_array();
              //  print_r($this->db->last_query());exit;
        	    
        		$dates = $this->db->query("SELECT date from billing_dtls WHERE bill_id='$bill_id'")->result_array();
        		$max_min_date = $this->db->query("SELECT MAX(date) as max_date, MIN(date) as min_date from billing_dtls WHERE bill_id='$bill_id'")->result_array();
        		$max_date = date('d-m-Y', strtotime($max_min_date[0]['max_date']));
        		$min_date = date('d-m-Y', strtotime($max_min_date[0]['min_date']));
        
        		$datestring = ''; 
        		foreach($dates as $key => $date) { 
                	if(count($dates) == $key+1) {
                    	$datestring.=date('d-m-Y',strtotime($date['date']));
                    } else {
                    	$datestring.=date('d-m-Y',strtotime($date['date'])).", ";
                    }
                }
        
        	    if(count($query)>0){
                 	$mode_id =$query[0]['mode'];
                
                	if($mode_id = 1) {
                    	$payment_mode = 'Cash';
                    } else if($mode_id = 5) {
                    	$payment_mode = 'NEFT';
                    } else if($mode_id = 6) {
                    	$payment_mode = 'QR Code';
                    } else if($mode_id = 7) {
                    	$payment_mode = 'Card';
                    } else if($mode_id = 8) {
                    	$payment_mode = 'MO';
                    } 
		    ?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;font-size:14px;">
			    <thead>
    				<!--<tr>
    					<td colspan="8" style="width:100%;"><div style="white-space: nowrap;">
                        <?php if($site_settings['bill_image'] != '') { $margin_top = 'margin-top:-50px'; ?>
    					<img  src="<?php echo $site_settings['bill_image'];?>" style="height: 1.5cm;width: auto;">
                        <?php } else { $margin_top= ''; } ?>
    					<h4 style="text-align:center; <?php echo $margin_top; ?>"><?php print_r($temple_list[0]['name']);?><br>
    					<span style="font-size:10px;"><?php print_r($temple_list[0]['address']." <br> ".$temple_list[0]['location']." <br> ".$temple_list[0]['phone']);?></span></h4>
    					</div></td>
    				</tr>-->
    				<tr>
    					<th colspan="8"><label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
                        	<label style="float:center;text-align:center;"><?php print_r($query[0]['deity_nm']);?></label>
    					    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
    				    </th>
    				</tr>
                	<?php 
                	if ($query[0]['customer_id']!="0"){
    				    $this->db->select('*');
    				    $this->db->from('user_dtl');
    				    $this->db->where('id', $query[0]['customer_id']);
    				    $query1 = $this->db->get()->result_array();
    				    ?>
    				<tr>
    					<td colspan="3">NAME</td>
    					<td colspan="5"><?php echo strtoupper($query1[0]['name']);?></td>
    				</tr>
    				<tr>
    					<td colspan="3">ADDRESS</td>
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
    				    <td>AMOUNT</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
                	$balance_amt = $query[0]['balance'];
                	
                	
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
						<td><?php 
                // If amt is 0 → keep same number as previous
                if ($amt > 0) {
                    echo $i++;
                } else {
                    echo $i - 1; // repeat previous number
                }
            ?></td>
						<td><?php echo strtoupper($val['name']);?></td>
						<td><?php echo $val['deity_nm'];?></td>
						<td><?php echo $val['star_eng'];?></td>
						<td ><?php echo $val['pooja_nm'];?><br><small style="word-wrap: break-word;">(<?= $min_date.' to '.$max_date;  ?>)</small></td>
						<td style="text-align:right"><?php echo $qlt;?></td>
						<td style="text-align:right"><?php echo $pooja_rt;?></td>
						<td style="text-align:right"><?php echo $amt;?>/-</td>
					</tr>
				 <?php } ?>
                   
				    <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total amount for pooja</th>
				        <th style="text-align:right"><?php echo $totalPooja;?>/-</th>
				    </tr>
					<tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total amount for prasadam</th>
				        <th style="text-align:right"><?php echo $pra; ?>/-</th>
				    </tr>
					
				
					<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Grand Total</th>
				        <th style="text-align:right"><?php echo $totalPooja+$pra;?>/-</th>
                	</tr>
                	<?php  if(is_numeric($balance_amt) && $balance_amt > 0): ?>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Received</th>
				        <th style="text-align:right"><?php echo ($totalPooja+$pra) - $balance_amt;?>/-</th>
                	</tr>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Outstanding Amount</th>
				        <th style="text-align:right"><?php echo $balance_amt;?>/-</th>
                	</tr>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Payment Mode</th>
				        <th style="text-align:right"><?php echo $payment_mode;?></th>
                	</tr>
                	<?php endif; ?>
				  
            	</tbody>
			</table>
			<?php }?>
		</div>
<!--     <div style="height:100px;">&nbsp;</div> -->
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/billing";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>