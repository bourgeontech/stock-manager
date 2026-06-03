 <html>
	<head>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm,billing.count,billing.customer_id,billing.amount,billing.total,billing.recv_amt');
		        $this->db->from('billing_dtls');
		        $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $query = $this->db->get()->result_array();
        	    
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
    				    <td>AMOUNT</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
				    foreach($query as $val){ 
				        $qlt=$val['qlt'];
				        $pooja_rt=$val['pooja_rt'];
				        $amt=$qlt*$pooja_rt;
				        $total=$total+$amt;
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
				            <td><?php echo strtoupper($val['name']);?></td>
				            <td><?php echo $val['deity_nm'];?></td>
				            <td><?php echo $val['star_eng'];?></td>
				            <td><?php echo $val['pooja_nm'];?><br><small style="white-space: nowrap;">(<?php echo date('d-m-Y',strtotime($val['date']));?>)</small></td>
				            <td style="text-align:right"><?php echo $qlt;?></td>
				            <td style="text-align:right"><?php echo $pooja_rt;?></td>
				            <td style="text-align:right"><?php echo $amt;?>/-</td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
                    <?php if($query[0]['amount'] > 0){ ?>
				    <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">For sending prasadam <?php echo $query[0]['count'];?>  time @ Rs</th>
				        <th style="text-align:right"><?php echo $charge=$query[0]['amount']*$query[0]['count']; $tot=$total+$charge;?>/-</th>
				        <th></th>
                    <!-- $temple_list[0]['postel_charge'] -->
				    </tr>
                <?php } else{ 
                       $tot=$total;
                    }?>
				    <?php if($query[0]['total'] != $query[0]['recv_amt']){ ?> 
              
                 <tr>
				     
                 <td colspan="9" style="text-align:center;"><h3>Credit  Bill</h3></td>
				   
				    </tr><?php } else {?><tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $tot;?>/-</th>
				        <th></th>
				    </tr><?php } ?>
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