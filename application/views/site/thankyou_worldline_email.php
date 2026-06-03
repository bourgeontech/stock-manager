 <html>
	<head>
	<style type="text/css">
	body{
	    width:100%;
	    height: 100%;
    	font-size:11px;
	}	
	#printer{
	    max-height: 100%;
	    max-width: 100%;
	}
	</style>
    <link rel="stylesheet" type"text/css" href="print.css" media="print" />
	</head>
	<body >
		<div id="printer">
        <p>Dhanyatman ,</p>
		<p>Your  Seva booking conformed. </p>
		
		<p>Here are the booking details. </p>

		<p>Stay blessed. </p>
		<br />
		<p>Receipt details </p>
        <br />
		    <?php 
		    $a=$this->db->query("SELECT id From diety");
		    $diety_id=$a->result_array();
			$site_settings=$this->site_model->settings();
        	if ($this->db->field_exists('bill_assessed_by', 'site_settings')) {
            	$bill_assessed_by = $site_settings['bill_assessed_by'] ?? 'DEVASWOM OFFICER ';
            } else {
            	$bill_assessed_by = 'DEVASWOM OFFICER ';
            }
        
		    foreach ($diety_id as $id){
		        
		        $id=$id['id'];
		        $this->db->select('billing_dtls.*,billing.status as bstatus,billing.total as btotal,stars.name_mal as star_eng,pooja.name_mal as pooja_nm, pooja.name as pooja,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
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
			<table border="1" style="border-collapse:collapse;width:98%;margin-bottom:1cm;font-size:14px;">
			    <thead>
    				<tr>
    					<td colspan="10" style="width:100%;">
                        	<div style="white-space: nowrap;">
                            	<?php if($site_settings['bill_image'] != ''): ?>
<!--     							<img alt="Image" src="<?php echo $site_settings['bill_image']; ?>" style="height: 1.5cm;width: auto;" /> -->
                            	<?php endif; ?>
    							<h4 style="text-align:center;">
                            		<?php print_r($temple_list[0]['name']);?>
                            		<br>
    								<span style="font-size:10px;"><?php print_r($temple_list[0]['address']." <br> ".$temple_list[0]['location']." <br> ".$temple_list[0]['phone']);?></span>
                        		</h4>
    						</div>
                    	</td>
    				</tr>
    				<tr>
    					<th colspan="10" style="height:15px">
                        	<label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
                        	<label style="float:center;text-align:center;"><?php print_r($query[0]['deity_nm']);?></label>
    					    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <td style="max-width:1cm;">SNo</td>
    				    <td>NAME</td>
    				    <td>STAR</td>
                    	<td>SEVA DATE</td>
    				    <td colspan="3">SEVA NAME</td>
    				    <td>NOS</td>
    				    <td>RATE</td>
    				    <td>AMOUNT</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
                	$bstatus=$query['0']['bstatus'];
                
				    foreach($query as $val){ 
				        $qlt=$val['qlt'];
				        $pooja_rt=$val['pooja_rt'];
				       $amt=$qlt*$pooja_rt;
				        $total=$total+$amt;
                        $amt=$val['amount'];
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
				            <td><?php echo strtoupper($val['name']);?></td>
				            <td><?php echo $val['star_eng'];?></td>
                        	<td> <?php print_r(date('d-m-Y',strtotime($val['date'])));?> </td>
				            <td colspan="3"><?php echo $val['pooja'] ?? '';?></td>
				            <td style="text-align:right"><?php echo $qlt;?></td>
				            <td style="text-align:right"><?php echo $pooja_rt;?></td>
				            <td style="text-align:right"><?php echo $amt;?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				    <tr>
				        <th></th>
				        <th colspan="8" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $total;?></th>
				    </tr>
                <?php  if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
			if(@$discount!=0 || @$discount!=''){?>
			<tr>
				        <th></th>
				        <th colspan="8" style="text-align:left">Discount</th>
				        <th style="text-align:right"><?php echo $discount;?></th>
				    </tr>
					<tr>
				        <th></th>
				        <th colspan="8" style="text-align:left">Grand Total</th>
				        <th style="text-align:right"><?php echo $total-$discount;?></th>
				    </tr>
			
			
			<?php } } ?>

				    <tr>
				        <th colspan="10" >For Online Pooja booking<a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website'])?></a></th>
				    </tr>
                 <tr>
				        <th colspan="10"style="text-align: right;margin-bottom:1cm;" >
                        	<?php echo $bill_assessed_by; ?>
                 		</th>
				    </tr>
               
				</tbody>
            
            
			</table>
        	
			<?php }}?>
        	<br />
        	<p> For any assistance </p>
        	<p> 8350903080</p>
			<br />
			<p>Kalady Sri Adi Shankara Madom Telangana </p>
			<p>Sri Sri Jagadguru Adi Shankaracharya Mahasamsthanam- </p>
			<p>Venkusa Estates kowkur village Bolarum secunderabad</p>
		</div>
    
	</body>
</html>