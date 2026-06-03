<?php ini_set('display_errors',0);?>
<?php if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {?>
<html>
<head>
    <title>
        Seva Receipt - <?php print_r($bill_id); ?>
    </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    	@media print {
        	body {
                margin-top: 320px;
            }

            @page {
        		size: A4; /* or use "letter" or other standard sizes */
         		margin: 0 !important; /* set margins */ 
    		}

        	#noteSection {
        		margin-top: auto;
        	}
        
        	.page-break {
        		page-break-after: always !important;
        	}
        
        	.page-break-before {
            	margin-top: 320px;
                page-break-before: always;
                padding-top: 320px;
        	}
		}
	
    
        body{
            background-image: url("/assets/images/kalady/letter_head1.jpg");
            background-size: contain;
background-position: center top;
background-repeat: no-repeat;
background-attachment: fixed;
overflow-x: hidden;
        }

    	.current-date {
        	margin-right: 120px;
    	}

        .jai{
            text-align: center;
        }
        .start{
            margin-top: 3px;
            margin-bottom: 0px;
            font-weight: 700;
        }
        .row-short{
            margin-top: 10px;
            margin-bottom: 42px;
        }
        .payment{
            text-align: center;
            margin-top: 40px;
        }
        .bill{
            font-weight: 600;
        }
        .bill-date{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        th{
            border: 2px solid #df7474;
        }
        td{
            border: 2px solid #df7474;
        }


        .note{
            padding-left: 92px;
            font-weight: 600;
        }
        .list{
            padding-left:147px;
        }
        ul{
            padding-left:151px;
        }
        .last{
            margin-top: 50px;
        }
        .col-md-6{
            text-align: center;
        }
        .last-section{
            display: flex;
            flex-direction: row;
            justify-content: space-around;

        }
        .for-kalady{
            padding-left: 145px;
        }
        .for{
            margin-bottom: 0px;
        }
    
    	.table-l {
    		margin: 0 4% !important;
  			width: 92% !important;
    	}
    
    	.w-95 {
    		width: 95% !important;
    	}
    
    	.w-100 {
    		width: 100% !important;
    	}
    
    	
    </style>
</head>

	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		        $this->db->select('billing_dtls.*,stars.name_eng as star_eng,pooja.name as pooja_nm,billing.bal_amt as balance, billing.mode as mode, billing_dtls.rate as pooja_rt,SUM(billing_dtls.qlt) as qlt ,sum(billing_dtls.postal_amt) as postalamt,billing_dtls.amount as prasad_rt,diety.name_mal as deity_nm,billing.count,billing.customer_id,billing.total,billing.recv_amt,(billing_dtls.date) as date, max(billing_dtls.date) as maxdate,min(billing_dtls.date) as mindate');
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
			<div class="jai">
            <h4>Jay Shankara</h4>
            <H4 class="start">Your Seva booking is confirmed.Here are the booking details. </H4>
            <h4 class="start">Stay Blessed.</h4>
        </div>
        <div class="payment">
            <h3>PAYMENT RECEIPT</h3>
        </div>
		
			<table border="1" style="border-collapse:collapse;width:94%;margin-bottom:2cm;margin-left: auto; margin-right: auto;">
			    <thead>
    				
                
    				<?php 
                	if ($query[0]['customer_id']!="0"){
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
						<td><?php echo ++$key;?></td>
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
					
				
					<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Grand Total</th>
				        <th style="text-align:right"><?php echo $totalPooja+$pra;?>/-</th>
				        <th>
						</th>
                	</tr>
                	<?php  if(is_numeric($balance_amt) && $balance_amt > 0): ?>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Received</th>
				        <th style="text-align:right"><?php echo ($totalPooja+$pra) - $balance_amt;?>/-</th>
				        <th>
						</th>
                	</tr>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Outstanding Amount</th>
				        <th style="text-align:right"><?php echo $balance_amt;?>/-</th>
				        <th>
						</th>
                	</tr>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Payment Mode</th>
				        <th style="text-align:right"><?php echo $payment_mode;?></th>
				        <th>
						</th>
                	</tr>
                	<?php endif; ?>
				    <tr>
				        <th colspan="9" >For Online Pooja booking please visit <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
				    </tr>
            	</tbody>
			</table>
			<?php }?>
        
          <section id="noteSection" class="mt-auto <?php if($pageBreak1 == 1) echo "page-break-before"; ?>">
            <div class="last">
                <p class="note">Note:-</p>
                <ul>
                    <li>
                        All pooja items will be arranged by the Madom.
                    </li>
                    <li>
                        As per tradition, we kindly request you to bring some fruits when you come, instead of arriving empty-handed.
                    </li>
                    <li>
                        Please inform us of the number of members attending from your family.
                    </li>
                    <li>
                        In case of you are unable to attend the seva-inform us-we will send prasadam to you.
                    </li>
                    <li>
                        We look forward to your presence and participation in this sacred event and wish may fulfil your worship with spiritually and peacefully.
                    </li>
                	<li>
                        Please login with OTP in https://kaladyshankaramadomts.org on your registered mobile number to be connected with Madom.
                    </li>
                </ul>
                <p class="list">With sincere thanks and warm regards,</p>
                <div class="last-section">
                    <div >
                        <img src="/assets/images/kalady/sign.jpeg" width="170px" >
                        
                    </div>
                    <div >
                        <img src="/assets/images/kalady/seal.jpeg" width="170px" >
                    </div>
                </div>
                <div class="for-kalady">
                    <p class="for">For,</p>
                    <p>Kalady Sri.Adi Shankara Madom Telangana</p>
                </div>
        	</div>
        </section>
		
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
<?php } else { ?>
<html>
	<head>
    	
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php 
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
                
    				<?php 
                	if ($query[0]['customer_id']!="0"){
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
						<td><?php echo ++$key;?></td>
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
					
				
					<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Grand Total</th>
				        <th style="text-align:right"><?php echo $totalPooja+$pra;?>/-</th>
				        <th>
						</th>
                	</tr>
                	<?php  if(is_numeric($balance_amt) && $balance_amt > 0): ?>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Received</th>
				        <th style="text-align:right"><?php echo ($totalPooja+$pra) - $balance_amt;?>/-</th>
				        <th>
						</th>
                	</tr>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Outstanding Amount</th>
				        <th style="text-align:right"><?php echo $balance_amt;?>/-</th>
				        <th>
						</th>
                	</tr>
                	<tr>
                    	<th></th>
				        <th colspan="6" style="text-align:left">Payment Mode</th>
				        <th style="text-align:right"><?php echo $payment_mode;?></th>
				        <th>
						</th>
                	</tr>
                	<?php endif; ?>
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
<?php } ?>