 <html>
	<head>
    	<style>
    		.d-flex {
    display: flex !important;
}
    .flex-row {
    flex-direction: row !important;
}
    .bg-dark {
    background-color: #212529 !important;
}
    .text-white {
    color: #fff !important;
}
    .text-center {
    text-align: center !important;
}
	.w-50 {
    width: 50% !important;
}
    
    .justify-content-start {
    justify-content: flex-start !important;
}
.justify-content-end {
    justify-content: flex-end !important;
}
.justify-content-center {
    justify-content: center !important;
}
.justify-content-between {
    justify-content: space-between !important;
}
.justify-content-around {
    justify-content: space-around !important;
}
    	</style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		   
		  $site_settings=$this->site_model->settings();
		   $a=$this->db->query("SELECT id From diety");
		      $diety_id=$a->result_array();
		    foreach ($diety_id as $id){
		        
		        $id=$id['id'];
            	if ($this->db->field_exists('discount', 'billing'))
			  
				
                {
                $this->db->select('billing_dtls.*,billing.status as bstatus,billing.discount,billing.remarks,billing.total as btotal,billing.customer_id ,stars.name_mal as star_eng,pooja.name_mal as pooja_nm, pooja.name as pooja,billing_dtls.rate as pooja_rt,diety.name as deity,diety.name_mal as deity_nm');
                }
            	else
                {
		        $this->db->select('billing_dtls.*,billing.status as bstatus,billing.total as btotal,billing.remarks,billing.customer_id ,stars.name_mal as star_eng,pooja.name_mal as pooja_nm, pooja.name as pooja,billing_dtls.rate as pooja_rt,diety.name as deity,diety.name_mal as deity_nm');
                }
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
                $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('billing_dtls.diety_id', $id);
        	    $query = $this->db->get()->result_array();
        	    
        	    if(count($query)>0){
		    ?>
        	<?php 
                if($bill_list[0]['status'] == 2) { 
            		$bill_date = $bill_list[0]['transaction_date'] ?? $bill_list[0]['date'];
                } else {
                	$bill_date = $bill_list[0]['date'];
                }
            ?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;">
                        	<div class="d-flex flex-row justify-content-between">
    							<img alt="Image" src="<?php echo $site_settings['bill_image'];?>" style="height: 1.5cm;width: auto;" />
    							<h4 style="text-align:center; margin-top:0">
                                	<?php print_r($temple_list[0]['name']);?><br>
    								<span style="text-align:center;font-size:13px;"><?php print_r($temple_list[0]['address']." <br>".$temple_list[0]['location']);?></span>
                            	</h4>
                            	<?php 
                				$emblem_right = $site_settings['emblem_right'] ?? null;
                				if($emblem_right):
                				?>
                				<img alt="Image" src="<?php echo $emblem_right;?>" style="height: 1.5cm;width: auto;" />
                            	<?php else: ?>
                        		<div style="height: 1.5cm;width: auto;"></div>
                            	<?php endif; ?>
    						</div>
                        </td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_date)));?></label>
                        	<label style="float:center;text-align:center;"><?php print_r($query[0]['deity_nm']);?></label>
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
    					<td colspan="5"><?php echo strtoupper($query1[0]['name'] ?? '');?></td>
    				</tr>
    				<tr>
    					<td colspan="4">ADDRESS</td>
    					<td colspan="5"><?php echo strtoupper(($query1[0]['house'] ?? '')." , ".($query1[0]['street'] ?? '')." , ".($query1[0]['post'] ?? '')." , ".($query1[0]['district'] ?? ''));?></td>
    				</tr>
    				<?php }?>
    				<tr style="text-align:center;">
    				    <td style="max-width:1cm;">SN</td>
    				    <td>NAME</td>
    				    <td>STAR</td>
    				    <td>POOJANAME</td>
                    	<td>T</td>
    				    <td>NO</td>
    				    <td>RATE</td>
    				    <td>AMT</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
				    foreach($query as $val){ 
				        $qlt=$val['qlt'];
				        $pooja_rt=$val['pooja_rt'];
				       // $amt=$qlt*$pooja_rt;
                     $amt=$val['amount'];
				        $total=$total+$amt;
				        $date=$val['date'];
				        $today=date('Y-m-d');
						if ($this->db->field_exists('discount', 'billing'))
			  
				{
                      $amount=$val['amount']-$val['discount'];
				}
				else
				{
				$amount=$val['amount'];	
				}
				        ?>
				        <tr style="text-align:center;">
				            <td><?php echo $i;?></td>
				            <td><?php echo strtoupper($val['name']);?></td>
				            <td><?php echo $val['star_eng'];?></td>
				            <td><?php echo $val['pooja_nm']; if ($date!=$today){echo "(".date('d-m-Y',strtotime($date)).")";}?></td>
				          <td style="text-align:right"><?php  echo $val['time'];?></td>   
                        <td style="text-align:right"><?php echo $qlt;?></td>
				            <td style="text-align:right"><?php echo $pooja_rt;?></td>
				            <td style="text-align:right"><?php echo $amount;?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
                	<?php if(count($adjustment) > 0) {  ?>
                	<tr style="border-left:0; border-right:0; height: 30px;">
                    	<th colspan="8" ></th>
                	</tr>
                	<tr>
    					<th colspan="8">
                        	RECEIVED ITEMS 
    				    </th>
    				</tr>
                	<tr>
                    	<th>SN</th>
                    	<th colspan="3">ITEM</th>
                    	<th colspan="2">QTY</th>
                    	<th colspan="2">UNIT</th>
                	</tr>
                	<?php foreach($adjustment as $key => $adj) { ?>
                    	<tr style="text-align:center;">
                        	<td><?= $key+1 ?></td>
                        	<td colspan="3"><?= $adj['product']; ?></td>
                        	<td colspan="2"><?= $adj['qty']; ?></td>
                        	<td colspan="2"><?= $adj['unit']; ?></td>
                		</tr>
                    <?php } ?>
                	<?php } ?>
				    <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php if ($this->db->field_exists('discount', 'billing'))
			  
				{ echo $total-$val['discount']; } else { echo $total;}?></th>
				    </tr>
                 <?php if($val['bstatus']=='2'){  ?> <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total  Collected including prasadam sending and 5 % online service charges</th>
				        <th style="text-align:right"><?php echo $val['btotal'];?></th>
				    </tr>
                <?php } ?>
                 <?php if($val['remarks']!=''){  ?>
					<tr>
				        <th colspan="9" >Remarks : <?php echo $val['remarks']; ?> </th>
				    </tr>
					  <?php } ?>
				    <tr>
				        <th colspan="9" >For Online Pooja booking  <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
				    </tr>
				</tbody>
			</table>
        	<div style="text-align: right;margin-bottom:1cm;">
				<strong>CLERK</strong>
        	</div>
        	
			<?php }}?>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view" }, 500); }
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