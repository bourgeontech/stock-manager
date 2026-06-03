<html>
<head>
    <title>
        Seva Receipt - <?php print_r($bill_id); ?>
    </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    	@media print {
        	body {
                margin-top: 250px;
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
            background-image: url("/assets/images/kalady/letter_head.jpg");
            background-size: contain;
            background-position: center top fixed; 
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

<?php $pageBreak1 = 0; ?>
<?php $customer = $this->db->select('user_dtl.*')->join('user_dtl', 'user_dtl.id=billing.customer_id')->where('billing.id', $bill_id)->get('billing')->row(); ?>
<body id="printer" onload="printcontend('printer')" onafterprint="myFunction()">
	<div class="fluid-container w-95 mx-auto">
    	<div class="d-flex flex-row justify-content-between">
        	<div class="pl-5">
            	<h5 class="fw-bold"> <strong> <?php echo @$customer->name; ?> </strong> </h5>
            	<h5 class="fw-bold"> <strong> <?php echo @$customer->mobile; ?> </strong> </h5>
            </div>
    		<div class="text-right pr-5">
        		<h4> <strong> <?php echo date('d/m/Y'); ?>  </strong> </h4>
			</div>
        </div>
        <div class="jai">
            <h4>Jay Shankara</h4>
            <H4 class="start">Your Seva booking is confirmed.Here are the booking details. </H4>
            <h4 class="start">Stay Blessed.</h4>
        </div>
        <div class="payment">
            <h3>PAYMENT RECEIPT</h3>
        </div>
    	<?php $grand_total = 0; ?>
    	<?php ;if(!empty($bill_dtls) && $bill_dtls != 0): ?>
        <?php 	foreach($bill_dtls as $pooja_id => $details): $count = count($details);  $pageBreak1 = ($count > 6 || $count%6 == 0) ? 1 : 0; ?>
        <?php   	$pooja = $this->db->where('id', $pooja_id)->get('pooja')->row(); ?>
        <div class="bill-date mt-3">
           <div>
              <p class="bill"> <?php echo date('d/m/Y', strtotime($details[0]['date'])); ?> </p>
            </div>
            <div >
                <p class="bill"> <?php print $details[0]['name_eng'];?></p>
            </div>
            <div >
                <p class="bill"> Bill No: <?php print_r($details[0]['bill_id']); ?> </p>
            </div> 
        </div>
		<section>
        <table class="w-100">
            <thead>
                <th class="sl">SL NO</th>
                <th class="name">NAME</th>
                <th class="sl">STAR</th>
                <th class="sl">GOTHRAM</th>
                <th class="sl">SEVA DATE</th>
                <th class="sl">SEVA TIME</th>
                <th class="sl">NOS</th>
                <th class="sl">RATE</th>
                <th class="sl text-right">AMOUNT</th>
            </thead>
        	<tbody>
            	<?php $pooja_total = 0; ?>
            	<?php 	foreach($details as $key => $detail): $pageBreak = (($key+1)%14 == 0) ? 1 : 0;  $amount = $detail['rate'] > 0 ? ($detail['qlt'] * $detail['rate']) : $detail['amount']; $pooja_total += $amount;  $grand_total += $amount; ?>
            	<tr class="text-center <?php if($pageBreak == 1) echo "page-break"; ?>">
                	<td> <?php echo $key + 1; ?> </td>
                	<td> <?php echo $detail['name']; ?> </td>
                	<td> <?php echo $detail['star_eng']; ?> </td>
                	<td> <?php echo $detail['gothram']; ?> </td>
                	<td> <?php echo date('d/m/Y', strtotime($detail['date'])); ?> </td>
                	<td> <?php echo date('h:i A', strtotime($pooja->exact_time)) ?? ''; ?> </td>
                	<td> <?php echo $detail['qlt']; ?> </td>
                	<td> <?php echo $detail['rate']; ?> </td>
                	<td class="text-right"> <?php echo $amount; ?> </td>
            	</tr>
            	<?php   endforeach; ?>
            	
        	</tbody>
        	<tfoot>
            	<th colspan="8" class="text-center">SUB TOTAL</th>
            	<th class="text-right"> <?php echo $pooja_total; ?> </th>
        	</tfoot>
        </table>
        <?php   endforeach; ?>
        <div class="d-flex flex-row justify-content-end mt-3">
        	<div class="text-center h4 mr-3"> <b> GRAND TOTAL </b> </div>
            <div class="text-right h4"> <b> <?php echo $grand_total; ?> </b> </div>
        </div>
        <?php endif; ?>
		</section>
    	
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
                    <p>SREE DHARMASHASTHA AYYAPPA DEVALAYAM SANGAREDDY</p>
                </div>
        	</div>
        </section>
        
   </div>
    


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
        </body>
</html>