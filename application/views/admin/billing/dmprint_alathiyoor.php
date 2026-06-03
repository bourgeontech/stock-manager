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
            height: 335.13385827px !important;
            width : 582.626.64566929px  !important;
            /*max-height: 385.51181102px  !important;*/
            border: 1px solid ;
/*             font-weight: bold; */
            font-size: 0.9em;
        }
    	table {
    		width: 100% !important;
    	}
        table.header {
            /*margin-left: 56.692913386px;*/
            margin-top:  95.5px  !important; 
        }
    
    	table.body .td_fourth {
    		width: 102.04724409px !important;
        	text-align:right;
    	}

    </style>
</head>
<body onload="printcontend('printer')" onafterprint="myFunction()"> 
    <?php 
		$today = date('Y-m-d');
        $this->db->select('billing.id as bill_no, billing.date as bill_date, billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
	    $this->db->from('billing_dtls');
	    $this->db->join('billing','billing.id = billing_dtls.bill_id');
	    $this->db->join('stars','stars.id = billing_dtls.star');
	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
	    $this->db->where('billing_dtls.bill_id', $bill_id);
	    $result = $this->db->get()->result();
	    
	    $details = array();
	    $grand_total = 0;
	    foreach ($result as $val) {
	        $index = $val->pooja."-".$val->date;
	        $details[$index][] = array(
	                'bill_no'=> $val->bill_no,
	                'deity'=> $val->deity_nm,
	                'pooja'=> $val->pooja_nm,
	                'name'=> $val->name,
	                'star'=> $val->star_eng,
	                'qty'=> $val->qlt,
	                'rate'=> $val->rate,
	                'amount' => $val->qlt * $val->rate,
	                'bill_date'=> $val->bill_date,
	                'pooja_date'=> $val->date
	            );
        	$grand_total += ($val->rate > 0 ? ($val->qlt * $val->rate) : $val->amount);
	    }
	    $i = 0;
    ?>
    
    <?php foreach($details as $detail) { ?>
    <?php $i++;  ?>
    <div id="printer" class="page-break">
        <table class="header">
            <tr>
                <td class="td_first" style="width: 77px  !important;"><?php print_r(date('d-m-Y',strtotime($detail[0]['bill_date'])));?></td>
                <td class="td_second" style="width: 295px  !important; max-width: 295px  !important; text-align:center"><?php print_r($detail[0]['deity']);?></td>
                <td class="td_third" style="width: 60px  !important; text-align:right !important"><?php print_r($detail[0]['bill_no']);?></td>
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
                $sub_total = 0; 
                $count = count($detail); 
                $height = '';
                switch ($count) {
                    case 1:
                        $height = '133.28346457px';
                        break;
                    case 2:
                        $height = '65.141732285px';
                        break;
                    case 3:
                        $height = '40.761154857px';
                        break;
                    case 4:
                        $height = '30.070866143px';
                        break;
                    case 5:
                        $height = '28.056692914px'; 
                        break;   
                    
                    default:
                        $height = '28.056692914px';
                        break; 
                }
            ?>
            <?php foreach($detail as $val) { ?>
            <tr style="height:<?php print_r($height); ?>">
                <td class="td_first"><?php echo strtoupper($val['pooja']);?> <?php if($today != $val['pooja_date']) echo '('.$val['pooja_date'].')'; ?> </td>
                <td class="td_second"><?php echo strtoupper($val['name']);?> - <?php echo $val['star'];?></td>
                <td class="td_third"><?php echo $val['qty'];?>x<?php echo $val['rate'];?></td>
                <td class="td_fourth"><?php $sub_total+= $val['amount']; echo $val['amount'];?></td>
            </tr>
            <?php } ?>
            <tr class="total">
                <td class="td_first"></td>
                <td class="td_second"></td>
                <td class="td_third"></td>
                <td class="td_fourth"><?php echo $sub_total;?> <br /> <?php echo $grand_total ?></td>
            </tr>
        </table>
    </div>
    <?php } ?>
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