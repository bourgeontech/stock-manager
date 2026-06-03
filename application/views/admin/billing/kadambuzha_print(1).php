<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Print</title>
	<style>
/*     @page {
  size: 7.48031in 4.015748in;
    
} */

@media print {
  .page-break {
    page-break-after: always;
  }
}
	.header {
/* 		height:160.6px; */
    }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        	padding:10px;
        }
    	
    	.total {
    		border-bottom: 1px solid  #111;
        	font-size: 12px;
        	font-weight: bold;
    	}
    	
    	.user, .total {
    		display: flex;
    	}
    
    	.left {
    		text-align: left;
    	}
    	
    	.right {
    		text-align: right;
    	}
    
    	.center {
    		text-align: center;
    	}
    
    	.user {
    		padding-top: 8px;
    	}
    
    	.user h4 {
    		margin-top:0;
        	padding-top: 8px;;
        	margin-bottom:0;
        	padding-bottom: 0;
            font-size:12px;
   	 	}
    	.payable {
     		font-size: 16px;
        	font-weight: bold; 
        	text-align: right;
        	display: flex;
   	 	}

    </style>
</head>
<body onload="printcontend('printer')" onafterprint="myFunction()">
    <?php 
		$user_name = $prepared_by->admin_name ?? '';
		$bill_time = $prepared_by->bill_time ?? '';
		$counter   = $prepared_by->counter ?? '';
		$bill_date = date('d M Y', strtotime($prepared_by->bill_date)) ;
		$billtime = date('d M Y h:i A', strtotime($bill_time));
		$bill_no   = $bill_id;
		
	?>

	
	
	<div id="printer">
    	<div class="header"></div>
        <table border="1" style="border-collapse:collapse;width:100%;font-family:Arial;font-size:12px;padding:1 px;">
            <thead>
            	<tr>
                	<th colspan="2" style="border-right:none; text-align:left !important;"><?php echo $bill_date ?? ''; ?></th>
                	<th colspan="4" style="border:none; text-align:center !important;" class="deity"><?php echo ''; ?></th>
                	<th colspan="2" style="border-left:none; text-align:right !important;">Bill - <?php echo $bill_id; ?></th>
            	</tr>
                <tr style="text-align:center;">
                    <td style="max-width:1cm;">SN</td>
                	<td>NAME</td>
                	<td>STAR</td>
                    <td>POOJA</td>
                    <td>T</td>
                    <td>NO</td>
                    <td>RATE</td>
                    <td style="text-align:right !important;">AMT</td>
                </tr>
            </thead>
        	<?php 
                  $i = 0; 
                  $grand_total = 0;
            ?>
        
            <?php foreach( $bills as $date => $details) { ?>
            <tbody>
                <?php 
					  $i++;
                      $j = 0; 
                      $total = 0;
					  $receipt_count  = count($bills);
					  $pageBreakClass = $receipt_count == $i ? '' : 'page-break';
                ?>
                <?php foreach($details as $pooja_cat => $detail) { ?>
                <?php 
                	  $deity_name = $detail[0]['deity_nm'];
                      $today =  date('Y-m-d');
                 foreach($detail as $pooja_detail): 
                	$j++; 
                      $total += $pooja_detail['amount'];
                ?>
                <tr style="text-align:center;">
                    <td><?php echo $j; ?></td>
                	<td><?php echo $pooja_detail['name'];?></td>  
                	<td><?php echo $pooja_detail['star_eng'];?></td>  
                    <td><?php echo $pooja_detail['pooja']."-".$pooja_detail['pooja_mal']; if ($pooja_detail['date']!=$today){echo "(".date('d-m-Y',strtotime($pooja_detail['date'])).")";}?></td>
                    <td><?php echo $pooja_detail['time'];?></td>   
                    <td><?php echo $pooja_detail['quantity'];?></td>
                    <td style="text-align:right"><?php echo $pooja_detail['rate'];?></td>
                    <td style="text-align:right"><?php echo $pooja_detail['amount'];?></td>
                </tr>
                <?php endforeach; ?>
            	<?php 
					$grand_total += $total;
				?>
                <tr>
                    <th></th>
                    <th colspan="6" style="text-align:left">Total</th>
                    <th style="text-align:right"><?php echo $total;?></th>
                </tr>
                
<!--             	<tr>
                    <th colspan="9" >Page  <?php echo $i; ?> of <?php echo count($bills); ?></th>
                </tr> -->
                <tr class="<?= $pageBreakClass; ?> break" data-deity="<?php echo $detail[0]['deity_nm']; ?>">
                    
                </tr>
            <?php } ?>
                
            	
            </tbody>
            <?php } ?>
            
        </table>
<!--     	<div class="payable">
             <div style="flex:1" class="left">Grand Total</div>
             <div style="flex:1" class="right">Rs.<?php echo $grand_total;?></div>
        </div> -->
    	<div class="footer">
<!--         	<div class="total">
                <div style="flex:1" class="left">Grand Total</div>
                <div style="flex:1" class="right">Rs.<?php echo $grand_total;?></div>
            </div> -->
            <div class="user">
                <div style="flex:1" class="left">
                    <h4>Prepared By: <?php echo $user_name;?></h4>
                    <h4><?php echo $billtime; ?></h4>
                </div>
                <div style="flex:1" class="right">
                    <h4>Clerk</h4>
                    <h4><?php echo $counter; ?></h4>
                </div>
            </div>
        	<div class="page-number"></div>
        	<!--<div class="content center">
        		<span style="font-family:Arial;font-size:12px;">For Online Pooja booking  <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   </span>
        	</div>-->
        </div>
    </div>
	
	
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