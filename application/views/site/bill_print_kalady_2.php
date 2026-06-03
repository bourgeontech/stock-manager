<html>
<head>
    <title>
        Kalady Bill 
    </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    	.fluid-container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.mx-auto {
    margin-right: auto !important;
    margin-left: auto !important;
}
.text-right {
    text-align: right !important;
}
.mt-3 {
    margin-top: 1rem !important;
}
.w-100 {
    width: 100% !important;
}
.text-center {
    text-align: center !important;
}

.h4 {
    font-size: 1.5rem;
    font-weight: 500;
    line-height: 1.2;
}
.mr-3 {
    margin-right: 1rem !important;
}
.mt-auto {
    margin-top: auto !important;
}
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
    border-top: 2px solid #dee2e6;
}

.table-sm th,
.table-sm td {
    padding: 0.3rem;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
    border-bottom-width: 2px;
}

.table-borderless th,
.table-borderless td,
.table-borderless thead th,
.table-borderless tbody + tbody {
    border: 0;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.table-primary,
.table-primary > th,
.table-primary > td {
    background-color: #b8daff;
}

.table-secondary,
.table-secondary > th,
.table-secondary > td {
    background-color: #d6d8db;
}

.table-success,
.table-success > th,
.table-success > td {
    background-color: #c3e6cb;
}

.table-info,
.table-info > th,
.table-info > td {
    background-color: #bee5eb;
}

.table-warning,
.table-warning > th,
.table-warning > td {
    background-color: #ffeeba;
}

.table-danger,
.table-danger > th,
.table-danger > td {
    background-color: #f5c6cb;
}

.table-light,
.table-light > th,
.table-light > td {
    background-color: #fdfdfe;
}

.table-dark,
.table-dark > th,
.table-dark > td {
    background-color: #c6c8ca;
}

.table-active,
.table-active > th,
.table-active > td {
    background-color: rgba(0, 0, 0, 0.075);
}

.table .thead-dark th {
    color: #fff;
    background-color: #343a40;
    border-color: #454d55;
}

.table .thead-light th {
    color: #495057;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.table-dark {
    color: #fff;
    background-color: #343a40;
}

.table-dark th,
.table-dark td,
.table-dark thead th {
    border-color: #454d55;
}

.table-dark.table-bordered {
    border: 0;
}

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
		
    	
        @page {
            size: A4;
            margin: 0;
        }
 
        /* Set content to fill the entire A4 page */
        html,
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;

        	padding-top:13em;
            background-image: url('<?php echo $background_image_base64; ?>');
            background-size: contain;
            background-position: center top fixed; 
            overflow-x: hidden;
        	margin: 0 !important;
        	height: 
        }
    
    	h1, h2, h3, h4, h5, h6 {
        	margin:0;
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
    
    	.page-break {
        		page-break-after: always !important;
        	}
        
        	.page-break-before {
            	margin-top: 320px;
                page-break-before: always;
        	}
    
    .d-flex {
    display: flex !important;
}
.flex-row {
    flex-direction: row !important;
}
.justify-content-end {
    justify-content: flex-end !important;
}
/*     .justify-content-between {
    justify-content: between !important;
} */
    
    </style>
</head>
<?php $pageBreak1 = 0; ?>
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
    	<?php $grand_total = 0; ?>
    	<?php if(!empty($bill_dtls) && $bill_dtls != 0): ?>
        <?php 	foreach($bill_dtls as $pooja_id => $details): $count = count($details);  $pageBreak1 = ($count > 6 || $count%6 == 0) ? 1 : 0; ?>
        <?php   	$pooja = $this->db->where('id', $pooja_id)->get('pooja')->row(); ?>
        <table class="table mt-3" style="border:0 !important; width:100%; ">
        	<tr>
           <th style="border:0 !important; ">
               <?php echo date('d/m/Y', strtotime($details[0]['date'])); ?> 
            </th>
            <th style="border:0 !important; " >
                 <?php print_r($pooja->name); ?> 
            </th>
            <th style="border:0 !important; " >
                 Bill No: <?php print_r($details[0]['bill_id']); ?> 
            </th> 
            </tr>
        </table>
		<section>
        <table class="w-100" style="border-collapse: collapse;">
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
            	<th colspan="8" class="text-center">POOJA TOTAL</th>
            	<th class="text-right"> <?php echo $pooja_total; ?> </th>
        	</tfoot>
        </table>
        <?php   endforeach; ?>
		
		<?php  if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
			if(@$discount!=0 || @$discount!=''){?>
         <div class="d-flex flex-row justify-content-end mt-3">
        	<div class="text-center h4 mr-3"> <b> TOTAL  </b> </div>
            <div class="text-right h4"> <b> <?php echo $grand_total; ?> </b> </div>
        </div>
		 <div class="d-flex flex-row justify-content-end mt-3">
        	<div class="text-center h4 mr-3"> <b> MEMBERSHIP PRIVILEGE  </b> </div>
            <div class="text-right h4"> <b> <?php echo @$discount; ?> </b> </div>
        </div>
			<?php } } ?>
        <div class="d-flex flex-row justify-content-end mt-3">
        	<div class="text-center h4 mr-3"> <b> GRAND TOTAL </b> </div>
            <div class="text-right h4"> <b> <?php echo $grand_total-@$discount; ?> </b> </div>
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
                </ul>
                <p class="list">With sincere thanks and warm regards,</p>
                <div class="last-section">
                    <div >
                        <img src="<?php echo $sign_image_base64; ?>" width="170px" >
                        
                    </div>
                    <div >
                        <img src="<?php echo $seal_image_base64; ?>" width="170px" >
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