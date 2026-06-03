<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Print</title>
    
    <style>
        @media print {
            .page-break {
            	page-break-after: always;
        	}
        	
        	@page {
        		margin-top:  95.60629921px  !important; 
        	}
        }
        #printer {
            width:627px;
         	height:385.51181102px;
         	font-size:17px;
/*         	border: 1px solid; */
        }
/*     	#header {
    		height:  95.60629921px  !important; 
    	} */
        table {
            width: 100%;
        }
        
		.td_fourth {
        	width: 102.04724409px !important;
        	text-align:right;
    	}
    </style>
</head>
<body onload="printcontend('printer')" onafterprint="myFunction()"> 
    <?php 
				$today = date('Y-m-d');
        		$site_settings=$this->site_model->settings();
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing.bal_amt as balance, billing.mode as mode, billing_dtls.rate as pooja_rt,SUM(billing_dtls.qlt) as qlt ,sum(billing_dtls.postal_amt) as postalamt,billing_dtls.amount as prasad_rt,diety.name_mal as deity_nm,billing.count,billing.customer_id,billing.total,billing.recv_amt,(billing_dtls.date) as date, max(billing_dtls.date) as maxdate,min(billing_dtls.date) as mindate, billing.id as bill_no');
		        $this->db->from('billing_dtls');
		        $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
				$this->db->group_by('billing_dtls.name, billing_dtls.pooja');

        	    $query = $this->db->get()->result_array();
              //  print_r($this->db->last_query());exit;
              //  
              ///to get bill total and postal amount
              //added by priyesh
              $billtotal = $this->db->query("SELECT sum(amount) as amt,sum(postal_amt) as postal_amt from billing_dtls WHERE bill_id='$bill_id'")->result_array();
        	  $grosstotal   = ($billtotal[0]['amt']+$billtotal[0]['postal_amt']);  
              // added by priyesh ends here                  
        	 	$dates = $this->db->query("SELECT date from billing_dtls WHERE bill_id='$bill_id'")->result_array();
        		$max_min_date = $this->db->query("SELECT MAX(date) as max_date, MIN(date) as min_date, SUM(amount) as amount,sum(postal_amt) as postal_amt from billing_dtls WHERE bill_id='$bill_id'")->result_array();
        		$max_date = date('d-m-Y', strtotime($max_min_date[0]['max_date']));
        		$min_date = date('d-m-Y', strtotime($max_min_date[0]['min_date']));
        		$gtotal   = $max_min_date[0]['amount'];

        		$datestring = ''; 
        		foreach($dates as $key => $date) { 
                	if(count($dates) == $key+1) {
                    	$datestring.=date('d-m-Y',strtotime($date['date']));
                    } else {
                    	$datestring.=date('d-m-Y',strtotime($date['date'])).", ";
                    }
                }
				
				$details = array();
				foreach($query as $val) {
                	$pooja_id 			= $val['pooja'];
                	$details[$pooja_id][] = $val;
                }
        
        	    if(count($details)>0){

		    ?>
			<?php 
                $sub_total = 0; 
                
            ?>
            <?php 
                $pooja_total  = 0;
                $postal_total = 0;
                $grand_total  = 0;
                $temp_total   = 0;
                foreach($details as $key=> $detail) { $breakClass = (($key+1) == count($details) ? '' : 'page-break'); ?>
    <div id="printer" class="page-break">
<!--     	<div id="header"></div> -->
        <table class="header">
            <tr>
                <td class="td_first" style="width: 33.15%;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></td>
                <td class="td_second" style="width: 33.70%; text-align:center"><?php print_r($detail[0]['deity_nm']);?></td>
                <td class="td_third" style="width: 33.15%; text-align:right">Bill - <?php echo $bill_id;?></td>
            </tr>
            <tr>
                <td colspan="3" style="height:45px; width:100%"></td>
            </tr>
        </table>
        <table class="body">
            <?php 
				$count = count($detail); 
                                              
                $height = '';
                switch ($count) {
                    case 1:
                        $height = 130.28346457;
                        break;
                    case 2:
                        $height = 75.141732285;
                        break;
                    case 3:
                        $height = 10.761154857;
                        break;
                
                    default:
                        $height = 37.056692914;
                        break; 
                }
                                              
				if($billtotal[0]['postal_amt'] > 0) { 
        			$height -= 20.9;
                }
                                              
				$height = $height.'px';
                                              
				foreach($detail as $key => $val) {
                	$pageBreak = ($key+1)%3 == 0 ? 1 : 0;
                    $pageBreakClass = $pageBreak == 1 ? 'page-break' : '';
            		$pooja_amount  = $val['qlt'] * $val['pooja_rt']; 
            		$postal_amount = $val['postalamt'];
                	$amount		   = $pooja_amount + $postal_amount;
                	$pooja_total  += $pooja_amount;
                	$postal_total += $postal_amount;
                	$grand_total  += $amount;
        	?>
            <tr>
            	<td class="td_first"><?php echo $val['pooja_nm'];?> <?php if($today != $val['date']) echo '('.$val['date'].')'; ?> <br /> <small><?php print_r($min_date.' to '.$max_date); ?>   </small></td>
                <td class="td_second"><?php echo strtoupper($val['name']);?> - <?php echo $val['star_eng'];?></td>
                <td class="td_third"><?php echo $val['qlt'];?> x <?php echo $val['pooja_rt'];?></td>
                <td class="td_fourth"><?php echo $pooja_amount;?></td>
            </tr>
        	<tr style="height:<?php print_r($height); ?>">
            		<?php if($val['postal_amt'] > 0) { ?> 
            			<td class="td_first"></td>
            			<td class="td_second"> <p style="margin:0; padding:0;"> Postal Amount </p> </td>
                		<td class="td_third"></td>
                		<td class="td_fourth"><?php echo $val['postal_amt'];?> </td>
            		<?php } ?>
                   </tr>
        			<?php $temp_total += $amount; if($pageBreak == 1) { $temp_total = 0; ?>
                		<tr class="<?php echo $pageBreakClass; ?>">
				        	<td class="td_first"></td>
                			<td class="td_second"></td>
                			<td class="td_third"></td>
                			<td class="td_fourth"><?php echo $pooja_total;?> <br /> <strong><?php echo $grosstotal; ?></strong></td>
				    	</tr>
                		<?php } else {
                        	// $temp_total += $amt;
                        }  ?>
			<?php } ?>
            <tr class="total">
                <td class="td_first"></td>
                <td class="td_second"></td>
                <td class="td_third"></td>
                <td class="td_fourth"><?php echo $grand_total;?> <br /> <strong><?php echo $grosstotal; ?></strong></td>
            </tr>
            
<!--             <tr class="date">
                <td colspan="4" style="padding-left: 200.18110236px  !important;"><?php print_r($min_date.' to '.$max_date); ?></td>
            </tr> -->
            
        </table>
    </div>
<!-- 	<div class="<?php echo $breakClass; ?>"></div> -->
    <?php } } ?>
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
</body>
</html>