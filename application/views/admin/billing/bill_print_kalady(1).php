<html>
<head>
    <title>
        kalady
    </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    	@media print {
    		@page {
        		size: A4; /* or use "letter" or other standard sizes */
         		margin: 0 !important; /* set margins */ 
    		}

        	#noteSection {
        		margin-top: auto;
        	}
		}
	
    
        body{
            background-image: url("/assets/images/kalady/letter_head.jpg");
            background-size: cover;
            background-position: center top; 
            overflow-x: hidden;
        }

    	.current-date {
        	margin-top: 320px;
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
        .sl{
            padding-left: 28px;
            padding-right: 28px;
        }

        .name{
            padding-left: 155px;
            padding-right:155px;
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
            margin-top: 50;
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
<body id="printer" onload="printcontend('printer')" onafterprint="myFunction()">
	<div class="fluid-container w-95 mx-auto">
    	<div class="current-date text-right">
        	<h4> <strong> <?php echo date('d/m/Y'); ?>  </strong> </h4>
		</div>
        <div class="jai">
            <h4>Jay Shankara</h4>
            <H4 class="start">Your Seva booking is confirmed.Here are the booking details. </H4>
            <h4 class="start">Stay Blessed.</h4>
        </div>
        <div class="payment">
            <h3>PAYMENT RECEIPT</h3>
        </div>
        <div class="bill-date mt-3">
           <div>
              <p class="bill"> <?php echo date('d/m/Y', strtotime($bill_list[0]['date'])); ?> </p>
            </div>
            <div >
                <p class="bill"> <?php print_r($bill_dtls[0]['pooja_nm']); ?> </p>
            </div>
            <div >
                <p class="bill"> Bill No: <?php print_r($bill_list[0]['id']); ?> </p>
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
                <th class="sl">AMOUNT</th>
            </thead>
        	<tbody>
            	<?php if(!empty($bill_dtls) && $bill_dtls != 0): ?>
            	<?php 	foreach($bill_dtls as $key => $detail): $amount = $detail['rate'] > 0 ? ($detail['qlt'] * $detail['rate']) : $detail['amount']; ?>
            	<tr class="text-center">
                	<td> <?php echo $key + 1; ?> </td>
                	<td> <?php echo $detail['name']; ?> </td>
                	<td> <?php echo $detail['star_eng']; ?> </td>
                	<td> <?php echo $detail['gothram']; ?> </td>
                	<td> <?php echo date('d/m/Y', strtotime($detail['date'])); ?> </td>
                	<td> <?php echo $detail['time']; ?> </td>
                	<td> <?php echo $detail['qlt']; ?> </td>
                	<td> <?php echo $detail['rate']; ?> </td>
                	<td> <?php echo $amount; ?> </td>
            	</tr>
            	<?php   endforeach; ?>
            	<?php endif; ?>
        	</tbody>
        </table>
		</section>
    
        <section id="noteSection" class="mt-auto">
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
    


<script>
// window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view" }, 500); }
// function myFunction(){
//     window.location = "<?php echo base_url();?>index.php/admin/admin/billing";
// }
// function printcontend(value) {
// 	var restorpage=document.body.innerHTML;
// 	var printcontend=document.getElementById(value).innerHTML;
// 	document.body.innerHTML=printcontend;
// 	window.print();
// 	document.body.innerHTML=restorpage;
// }

</script>
        </body>
</html>