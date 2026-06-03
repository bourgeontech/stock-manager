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
        }
        #printer {
            height: 383.51181102px !important;
            width : 582.04724409px  !important;
            /*max-height: 385.51181102px  !important;*/
            border: 1px solid ;
            font-weight: bold;
            font-size: 0.9em;
        }
        
        table.header {
            /*margin-left: 56.692913386px;*/
            margin-top:  109.60629921px  !important; 
        }
        
        table.header tr {
            height: 24.566929134px  !important;
        }
        
        /*table.header tr .td_first {*/
        /*    width: 75.590551181px  !important;*/
           
        /*}*/
        
        /*table.header tr.td_second {*/
        /*    width: 296.14173228px  !important*/
        /*    max-width: 396.14173228px  !important;*/
            
           
        /*}*/
        
        /*table.header tr .td_third {*/
            width: 81.181102px; /* 151.18110236px  !important; */
           
        /*}*/
        
        /*table.header tr .td_fourth {*/
        /*    width: 94.488188976px  !important;*/
           
        /*}*/
        
        table.body  {
            margin-left: 120.5590551181px !important;
        }
        
        table.body .th_row {
            height: 18.897637795px !important;
        }
    
        table.body tr .td_first {
            width: 386.37795276px  !important;
        }
        
        table.body tr .td_second {
            width: 45.354330709px  !important;
        }
        
        table.body tr .td_third {
            width: 49.133858268px  !important;
        }
        
        table.body tr .td_fourth {
            width: 64.251968504px  !important;
        }
        
        .total {
            height: 37.015748031px  !important;
        }
        
        .date {
            height: 22.566929134px  !important;
        }

    </style>
</head>
<body onload="printcontend('printer')" onafterprint="myFunction()"> 
    <?php 
        		$site_settings=$this->site_model->settings();
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing.bal_amt as balance, billing.mode as mode, billing_dtls.rate as pooja_rt,SUM(billing_dtls.qlt) as qlt ,sum(billing_dtls.postal_amt) as postalamt,billing_dtls.amount as prasad_rt,diety.name_mal as deity_nm,billing.count,billing.customer_id,billing.total,billing.recv_amt,(billing_dtls.date) as date, max(billing_dtls.date) as maxdate,min(billing_dtls.date) as mindate, billing.id as bill_no');
		        $this->db->from('billing_dtls');
		        $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
				$this->db->group_by('billing_dtls.pooja');

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
				
				$details = array();
				foreach($query as $val) {
                	$pooja_id 			= $val['pooja'];
                	$details[$pooja_id][] = $val;
                }
        
        	    if(count($details)>0){
//                  	$mode_id =$details[0]['mode'];
                
//                 	if($mode_id = 1) {
//                     	$payment_mode = 'Cash';
//                     } else if($mode_id = 5) {
//                     	$payment_mode = 'NEFT';
//                     } else if($mode_id = 6) {
//                     	$payment_mode = 'QR Code';
//                     } else if($mode_id = 7) {
//                     	$payment_mode = 'Card';
//                     } else if($mode_id = 8) {
//                     	$payment_mode = 'MO';
//                     } 
		    ?>
			<?php 
                $sub_total = 0; 
                
            ?>
            <?php 
                $pooja_total  = 0;
                $postal_total = 0;
                $grand_total  = 0;
                foreach($details as $detail) { ?>
    <div id="printer" class="page-break">
        <table class="header">
            <tr>
                <td class="td_first" style="width: 77px  !important;"></td>
                <td class="td_second" style="width: 295px  !important; max-width: 295px  !important;"><?php print_r($detail[0]['deity_nm']);?></td>
                <td class="td_third" style="width: 60px  !important;"></td>
                <td class="td_fourth"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></td>
            </tr>
            <tr>
                <td class="td_first" style="width: 77px  !important;"></td>
                <td class="td_second" style="width: 295px  !important; max-width: 295px  !important;"><?php print_r($detail[0]['pooja_nm']);?></td>
                <td class="td_third" style="width: 60px  !important;"></td>
                <td class="td_fourth"><?php echo $bill_id;?></td>
            </tr>
        </table>
        <table class="body">
            <tr class="th_row" style="height:28.897637795px !important">
                <td class="td_first" style="height:28.897637795px !important"></td>
                <td class="td_second" style="height:28.897637795px !important"></td>
                <td class="td_third" style="height:28.897637795px !important"></td>
                <td class="td_fourth" style="height:28.897637795px !important"></td>
            </tr>
            <?php 
				$count = count($detail); 
                $height = '';
                switch ($count) {
                    case 1:
                        $height = '140.28346457px';
                        break;
                    case 2:
                        $height = '70.141732285px';
                        break;
                    case 3:
                        $height = '46.761154857px';
                        break;
                    case 4:
                        $height = '35.070866143px';
                        break;
                    case 5:
                        $height = '28.056692914px'; 
                        break;   
                    
                    default:
                        $height = '28.056692914px';
                        break; 
                }
                                              
				foreach($detail as $val) {
            		$pooja_amount  = $val['qlt'] * $val['pooja_rt']; 
            		$postal_amount = $val['postalamt'];
                	$amount		   = $pooja_amount + $postal_amount;
                	$pooja_total  += $pooja_amount;
                	$postal_total += $postal_amount;
                	$grand_total  += $amount;
        	?>
            <tr style="height:<?php print_r($height); ?>">
                <td class="td_first"><?php echo strtoupper($val['name']);?> - <?php echo $val['star_eng'];?></td>
                <td class="td_second"><?php echo $val['qlt'];?></td>
                <td class="td_third"><?php echo $val['pooja_rt'];?></td>
                <td class="td_fourth"><?php echo $pooja_amount;?></td>
            </tr>
			<?php } ?>
            <tr class="total">
                <td class="td_first"></td>
                <td class="td_second"></td>
                <td class="td_third"></td>
                <td class="td_fourth"><?php echo $grand_total;?></td>
            </tr>
            
            <tr class="date">
                <td colspan="4" style="padding-left: 200.18110236px  !important;"><?php print_r($min_date.' to '.$max_date); ?></td>
            </tr>
            
        </table>
    </div>
    <?php }} ?>
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