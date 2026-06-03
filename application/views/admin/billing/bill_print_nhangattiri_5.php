<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <style>
        @media print {
            .page-break {page-break-after: always;}
        }
            
   		
        .m-0 {
            margin: 0 !important;
        }
        .m-1 {
            margin: 0.25rem !important;
        }
        .m-2 {
            margin: 0.5rem !important;
        }
        .m-3 {
            margin: 1rem !important;
        }
        .m-4 {
            margin: 1.5rem !important;
        }
        .m-5 {
            margin: 3rem !important;
        }
        .m-auto {
            margin: auto !important;
        }
        .mx-0 {
            margin-right: 0 !important;
            margin-left: 0 !important;
        }
        .mx-1 {
            margin-right: 0.25rem !important;
            margin-left: 0.25rem !important;
        }
        .mx-2 {
            margin-right: 0.5rem !important;
            margin-left: 0.5rem !important;
        }
        .mx-3 {
            margin-right: 1rem !important;
            margin-left: 1rem !important;
        }
        .mx-4 {
            margin-right: 1.5rem !important;
            margin-left: 1.5rem !important;
        }
        .mx-5 {
            margin-right: 3rem !important;
            margin-left: 3rem !important;
        }
        .mx-auto {
            margin-right: auto !important;
            margin-left: auto !important;
        }
        .my-0 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }
        .my-1 {
            margin-top: 0.25rem !important;
            margin-bottom: 0.25rem !important;
        }
        .my-2 {
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }
        .my-3 {
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }
        .my-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1.5rem !important;
        }
        .my-5 {
            margin-top: 3rem !important;
            margin-bottom: 3rem !important;
        }
        .my-auto {
            margin-top: auto !important;
            margin-bottom: auto !important;
        }
        .mt-0 {
            margin-top: 0 !important;
        }
        .mt-1 {
            margin-top: 0.25rem !important;
        }
        .mt-2 {
            margin-top: 0.5rem !important;
        }
        .mt-3 {
            margin-top: 1rem !important;
        }
        .mt-4 {
            margin-top: 1.5rem !important;
        }
        .mt-5 {
            margin-top: 3rem !important;
        }
        .mt-auto {
            margin-top: auto !important;
        }
        .me-0 {
            margin-right: 0 !important;
        }
        .me-1 {
            margin-right: 0.25rem !important;
        }
        .me-2 {
            margin-right: 0.5rem !important;
        }
        .me-3 {
            margin-right: 1rem !important;
        }
        .me-4 {
            margin-right: 1.5rem !important;
        }
        .me-5 {
            margin-right: 3rem !important;
        }
        .me-auto {
            margin-right: auto !important;
        }
        .mb-0 {
            margin-bottom: 0 !important;
        }
        .mb-1 {
            margin-bottom: 0.25rem !important;
        }
        .mb-2 {
            margin-bottom: 0.5rem !important;
        }
        .mb-3 {
            margin-bottom: 1rem !important;
        }
        .mb-4 {
            margin-bottom: 1.5rem !important;
        }
        .mb-5 {
            margin-bottom: 3rem !important;
        }
        .mb-auto {
            margin-bottom: auto !important;
        }
        .ms-0 {
            margin-left: 0 !important;
        }
        .ms-1 {
            margin-left: 0.25rem !important;
        }
        .ms-2 {
            margin-left: 0.5rem !important;
        }
        .ms-3 {
            margin-left: 1rem !important;
        }
        .ms-4 {
            margin-left: 1.5rem !important;
        }
        .ms-5 {
            margin-left: 3rem !important;
        }
        .ms-auto {
            margin-left: auto !important;
        }
        .p-0 {
            padding: 0 !important;
        }
        .p-1 {
            padding: 0.25rem !important;
        }
        .p-2 {
            padding: 0.5rem !important;
        }
        .p-3 {
            padding: 1rem !important;
        }
        .p-4 {
            padding: 1.5rem !important;
        }
        .p-5 {
            padding: 3rem !important;
        }
        .px-0 {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }
        .px-1 {
            padding-right: 0.25rem !important;
            padding-left: 0.25rem !important;
        }
        .px-2 {
            padding-right: 0.5rem !important;
            padding-left: 0.5rem !important;
        }
        .px-3 {
            padding-right: 1rem !important;
            padding-left: 1rem !important;
        }
        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }
        .px-5 {
            padding-right: 3rem !important;
            padding-left: 3rem !important;
        }
        .py-0 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
        .py-1 {
            padding-top: 0.25rem !important;
            padding-bottom: 0.25rem !important;
        }
        .py-2 {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }
        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }
        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }
        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }
        .pt-0 {
            padding-top: 0 !important;
        }
        .pt-1 {
            padding-top: 0.25rem !important;
        }
        .pt-2 {
            padding-top: 0.5rem !important;
        }
        .pt-3 {
            padding-top: 1rem !important;
        }
        .pt-4 {
            padding-top: 1.5rem !important;
        }
        .pt-5 {
            padding-top: 3rem !important;
        }
        .pe-0 {
            padding-right: 0 !important;
        }
        .pe-1 {
            padding-right: 0.25rem !important;
        }
        .pe-2 {
            padding-right: 0.5rem !important;
        }
        .pe-3 {
            padding-right: 1rem !important;
        }
        .pe-4 {
            padding-right: 1.5rem !important;
        }
        .pe-5 {
            padding-right: 3rem !important;
        }
        .pb-0 {
            padding-bottom: 0 !important;
        }
        .pb-1 {
            padding-bottom: 0.25rem !important;
        }
        .pb-2 {
            padding-bottom: 0.5rem !important;
        }
        .pb-3 {
            padding-bottom: 1rem !important;
        }
        .pb-4 {
            padding-bottom: 1.5rem !important;
        }
        .pb-5 {
            padding-bottom: 3rem !important;
        }
        .ps-0 {
            padding-left: 0 !important;
        }
        .ps-1 {
            padding-left: 0.25rem !important;
        }
        .ps-2 {
            padding-left: 0.5rem !important;
        }
        .ps-3 {
            padding-left: 1rem !important;
        }
        .ps-4 {
            padding-left: 1.5rem !important;
        }
        .ps-5 {
            padding-left: 3rem !important;
            }
            
            .border {
            border: 1px solid #dee2e6 !important;
        }
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
        .justify-content-evenly {
            justify-content: space-evenly !important;
        }
        .content p {
            margin: .5em 0;
        }
        .letter-space {
            /* letter-spacing: 4px; */
        }

        .title {
            font-family: 'Karla', sans-serif;
            font-family: 'Oswald', sans-serif;
        }

        .logo {
            border-radius: 0.7em;
        }

        .receipt {
            max-width: 6em;
            border-radius: 0.6em;
        }

        .amount {
            width: 15em;
            border: 1px solid black;
        }

        .value {
            font-size: 1.1em;
            font-weight: 600;
            font-family: 'Courier New', Courier, monospace;
            margin-left: 0.5em;
        }

        .dotted {
            border-bottom: 2px dotted #000;
        }


        .small {
            font-size:12px !important;
        }
        
        .leftside {
            padding-top: .5em;
        }
    
    	#footer {
        	border-top:  0.5px solid dotted;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
/*             text-align: center; */
        	padding: 0.5em 1em;
        	justify-content: space-between;
        	font-weight: bold;
        	font-size:12px !important;
        }	
    </style>
</head>
<body onload="printcontend('printer')" onafterprint="myFunction()" id="printer">
    <?php   
        $grand_total = 0;
        $pageBreak = '';
        $site_settings=$this->site_model->settings();
        $preparedby = $this->db->query("select admin.name,bill_time,counter.name as countername from admin join billing on billing.user_id = admin.id join counter on billing.counter=counter.id where billing.id = $bill_id")->row();
        $payment_mode = $this->db->query("select mode from billing where id = $bill_id")->row()->mode;
        switch ($payment_mode) {
            case 1:
                $paymentMode = 'Cash';
                break;
            case 5:
                $paymentMode = 'NEFT';
                break;
            case 6:
                $paymentMode = 'QR Code';
                break;
            case 7:
                $paymentMode = 'Card';
                break;
            case 8:
                $paymentMode = 'MO';
                break;
            case 10:
                $paymentMode = 'Endowment';
                break;
            default:
                $paymentMode = "";
                break;
        }
        
        $deity_query = $this->db->query("SELECT DISTINCT diety_id as deity_id FROM billing_dtls WHERE bill_id = $bill_id ORDER BY diety_id");
		$deities	 = $deity_query->result();

        foreach($deities as $deity) {
            $deity_id = $deity->deity_id;

            $date_query  = $this->db->query("SELECT DISTINCT date FROM billing_dtls WHERE bill_id = $bill_id AND diety_id = $deity_id ORDER BY date");
		    $dates	     = $date_query->result();
        	
        	foreach($dates as $key => $date_arr) {
                $date = $date_arr->date;
				
            	$pageBreak = ($key+1 == count($dates) ? 1 : 0);
                $pageBreakClass = $pageBreak!= 0 ? 'page-break': '';
                $cat_query  = $this->db->query("SELECT DISTINCT pooja_cat FROM pooja WHERE id IN (SELECT pooja FROM billing_dtls WHERE bill_id = $bill_id and diety_id='$deity_id' and date='$date') GROUP BY pooja_cat");
		        $pooja_cat	= $cat_query->result();
            
            	$donation_print = $site_settings['donation_print'] ?? 0;
            
            	if ($donation_print == 1 && $deity_id == 8) {
                    if($this->db->table_exists('tax_details')) { 
                        $this->db->select('*');
                        $this->db->from('tax_details');
                        $tax_details = $this->db->get()->row();
                        $tax_detail = $tax_details->description;                
                    } else {
                        $tax_detail = '';
                    }
                
                    foreach ($pooja_cat as $key => $cat){
                        $pageBreak = ($key+1 == count($pooja_cat) ? 1 : 0);
                    	$pageBreakClass = $pageBreak!= 0 ? 'page-break': '';
                        $this->db->select('billing_dtls.*, billing_dtls.date as pooja_date, stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt ,billing_dtls.amount as pooja_amount,diety.name_mal as deity_nm, user_dtl.*');
                        $this->db->from('billing_dtls');
                        $this->db->join('stars','stars.id = billing_dtls.star','left');
                        $this->db->join('pooja','pooja.id = billing_dtls.pooja');
                        $this->db->join('diety','diety.id = billing_dtls.diety_id');
                        $this->db->join('billing','billing.id = billing_dtls.bill_id');
                        $this->db->join('user_dtl','billing.customer_id = user_dtl.id');
                        $this->db->where('billing_dtls.bill_id', $bill_id);
                        $this->db->where('pooja.pooja_cat', $cat->pooja_cat);
                        $this->db->where('billing_dtls.date', $date);
                        $this->db->where('billing_dtls.diety_id', $deity_id);
                        $this->db->group_by('billing_dtls.pooja');
                        $this->db->group_by('billing_dtls.name');
                        $this->db->group_by('billing_dtls.id');
                        $query = $this->db->get()->result_array();
                        
                        if(sizeof($query)>0) { ?>
                            <div class="donation m-4 border p-2">
                                <div class="d-flex flex-row justify-content-between">
                                    <p>Regd. No. 4/39/2018</p>
                                    <p></p>
                                    <p></p>
                                </div>
                    
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <h2 class="title py-0 my-0"><?php print_r($site_settings['templename_eng']);?></h2>
                                        <p class="letter-space my-0 py-0"><?php print_r($temple_list[0]['address']." ".$temple_list[0]['location']. " - " .$temple_list[0]['pincode']. " - " .$temple_list[0]['phone']) ;?> .</p>
                                    </div>
                                    <div class="">
                                        <div class=" logo p-1 px-2 pb-0" style="font-weight: normal; letter-spacing: 3.5px;">
                                            <img src="<?php echo base_url(); ?>assets/admin/img/donation_print_logo.jpeg" width="100" />
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="mt-0">
                                    <div class="border receipt mx-auto bg-dark text-white text-center py-2">Receipt</div>
                                </div>
                    
                                <?php 
                                foreach($query as $val) { 
                                    $number = $val['pooja_amount'];
                                    $decimal = round($number - ($no = floor($number)), 2) * 100;
                                    $hundred = null;
                                    $digits_length = strlen($no);
                                    $i = 0;
                                    $str = array();
                                    $words = array(0 => '', 1 => 'One', 2 => 'Two',
                                        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                                        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                                        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                                        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                                        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                                        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                                        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                                        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
                                    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
                                    
                                    while( $i < $digits_length ) {
                                        $divider = ($i == 2) ? 10 : 100;
                                        $number = floor($no % $divider);
                                        $no = floor($no / $divider);
                                        $i += $divider == 10 ? 1 : 2;
                                        if ($number) {
                                            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                                        } else $str[] = null;
                                    }
                    
                                    $Rupees = implode('', array_reverse($str));
                                    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
                                    $pooja_amount = ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
                                
                                    $grand_total+=$number;
                                ?>
                                    <div class="content">
                                        <div class="d-flex flex-row justify-content-between">
                                            <p>Receipt No: <span class="value"><?php print_r($val['receipt_no'] ?? '');?> </span> </p>
                                            <p>Date : <span class="value"> <?php print_r(date('d M Y',strtotime($bill_list[0]['date'])));?>  </span></p>
                                        </div>
                                        <div>
                                            <p><span class="leftside">Received with Thanks From</span> <span class="value dotted"><?php print_r($val['name']);?></span> </p>
                                        </div>
                                        <div>
                                            <p><span class="leftside">Address</span> <span class="value dotted"><?php print_r($val['house']." ".$val['post']." ".$val['street']." ".$val['district']);?></span> </p>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between">
                                            <p class="w-50 left"><span class="leftside">Mobile No.</span> <span class="value dotted"><?php print_r($val['mobile']);?></span> </p>
                                            <p class="w-50 right"><span class="leftside">PAN No.</span> <span class="value dotted"><?php print_r($val['pan_no'] ?? '');?></span> </p>
                                        </div>
                                        <div>
                                            <p><span class="leftside">A Sum of Rupees</span> <span class="value dotted"><?php print_r($pooja_amount);?> Only</span> </p>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between">
                                            <p class="w-50 left"><span class="leftside">Paid Through</span> <span class="value dotted"><?php print_r($paymentMode ?? '');?></span> </p>
                                            <p class="w-50 right"><span class="leftside">Date</span> <span class="value dotted"><?php print_r(date('d/m/Y',strtotime($val['pooja_date'])));?></span> </p>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between">
                                            <p class="w-50 left"><span class="leftside">Transaction ID</span> <span class="value dotted">N/A</span> </p>
                                            <p class="w-50 right"><span class="leftside">Towards</span> <span class="value dotted"><?php print_r($val['pooja_nm'] ?? '');?></span> </p>
                                        </div>
                    
                                        <div class="amount p-1 mb-2">
                                            <h4 class="m-0"> ₹ <?php print_r($val['pooja_amount'] ?? '');?>/-  </h4>
                                        </div>
                    
                                        <p class="small">Receipt Valid only on realization of Cheque / DD</p>
                    
                                        <p class="text-center small"><?php print_r($tax_detail); ?></p>
                                    </div>  
                                <?php 
                                } 
                                ?>
                            </div>
							<div class="<?php echo $pageBreakClass; ?>"></div>
                    <?php
                        }
                    }
                } else {
                	foreach ($pooja_cat as $key => $cat) {
                    
                    
                    $this->db->select('billing_dtls.*, billing_dtls.date as pooja_date, stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt ,billing_dtls.amount as pooja_amount,diety.name_mal as deity_nm');
                    $this->db->from('billing_dtls');
                    $this->db->join('stars','stars.id = billing_dtls.star','left');
                    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
                    $this->db->join('diety','diety.id = billing_dtls.diety_id');
                    $this->db->join('billing','billing.id = billing_dtls.bill_id');
                    $this->db->where('billing_dtls.bill_id', $bill_id);
                    $this->db->where('pooja.pooja_cat', $cat->pooja_cat);
                    $this->db->where('billing_dtls.date', $date);
                    $this->db->where('billing_dtls.diety_id', $deity_id);
                    $this->db->group_by('billing_dtls.pooja');
                    $this->db->group_by('billing_dtls.name');
                    $this->db->group_by('billing_dtls.id');
                    $query = $this->db->get()->result_array();
                    if(sizeof($query)>0) { 
                    	
                ?>
                <table border="1" style="border-collapse:collapse;width:100%;margin-bottom:5px;" class="table table-bordered ">
                    <thead>
                        <tr>
                            <td colspan="9" style="width:100%;">
                            <div style="white-space: nowrap;">
                                <img alt="Image" src="<?php echo $site_settings['bill_image'];?>" style="height: 1.5cm;width: auto;" />
                                <h4 style="text-align:center;margin-top: -1.2cm;font-size:15px;">
                                    <?php print_r($temple_list[0]['name']);?><br>
                                    <span style="text-align:center;font-size:13px;"><?php print_r($temple_list[0]['address']." <br>".$temple_list[0]['location'].",".$temple_list[0]['phone']);?></span>
                                </h4>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="9">
                                <div class="d-flex flex-row justify-content-between w-100">
                                    <label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
                                    <label style="float:center;text-align:center;"><?php print_r($query[0]['deity_nm']);?></label>
                                    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
                                </div>
                            </th>
                        </tr>
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
                            foreach($query as $k => $val) { 
                    			$pageBreak1      = ((($k+1)%4) == 0 ? 1 : 0);
                    			$pageBreakClass1 = ''; // $pageBreak1!= 0 ? 'page-break': '';
                            
                                $qlt=$val['qlt'];
                                $token = $val['token'];
                                $pooja_rt=$val['pooja_rt'];
                                $amt=$val['amount'];
                                $total=$total+$amt;
                                $date=$val['date'];
                                $today=date('Y-m-d');
                                $amount=$val['amount']; 
                           ?>
                    
<!--                     		<?php if($pageBreak1 == 1): ?>
                				</tbody>
							</table>
                    		<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:5px;" class="table table-bordered page-break">
                    <thead>
                        <tr>
                            <td colspan="9" style="width:100%;">
                            <div style="white-space: nowrap;">
                                <img alt="Image" src="<?php echo $site_settings['bill_image'];?>" style="height: 1.5cm;width: auto;" />
                                <h4 style="text-align:center;margin-top: -1.2cm;font-size:15px;">
                                    <?php print_r($temple_list[0]['name']);?><br>
                                    <span style="text-align:center;font-size:13px;"><?php print_r($temple_list[0]['address']." <br>".$temple_list[0]['location'].",".$temple_list[0]['phone']);?></span>
                                </h4>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="9">
                                <div class="d-flex flex-row justify-content-between w-100">
                                    <label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
                                    <label style="float:center;text-align:center;"><?php print_r($query[0]['deity_nm']);?></label>
                                    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
                                </div>
                            </th>
                        </tr>
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
                    		<?php endif; ?>
                     -->
                            <tr style="text-align:center;" class="<?php echo $pageBreakClass1; ?>">
                                <td><?php echo $i;?></td>
                                <td><?php echo strtoupper($val['name']);?></td>
                                <td><?php echo $val['star_eng'];?></td>
                                <td><?php echo $val['pooja_nm']; if ($date!=$today){echo "(".date('d-m-Y',strtotime($date)).")";}?></td>
                                <td style="text-align:right"><?php  echo $val['time'];?></td>   
                                <td style="text-align:right"><?php echo $qlt;?></td>
                                <td style="text-align:right"><?php echo $pooja_rt;?></td>
                                <td style="text-align:right"><?php echo $amount;?></td>
                            </tr>
                            <?php $tpost=0;if($val['postal_amt']!='0' && $val['postal_amt']!='' ){ if($val['postal_amt']=='') {$postamt=0;}else {$postamt=$val['postal_amt'];}?>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="6" >Postal amount </td>
                                <td style="text-align:right"> <?php $tpost+=$postamt;echo $postamt ?> </td>
                            </tr>
                            <?php } ?>
                            <?php 
                                $i++;
                            }?>
                    		<?php if(isset($adjustment) && count($adjustment) > 0) {  ?>
                	<tr>
                    	<th colspan="8" style="height:1em">
                        	
    				    </th>
                    </tr>
                	<tr>
    					<th colspan="8">
                        	Recieved Items 
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
                                <th style="text-align:right"><?php $grand_total+=($total+$tpost); echo $total+$tpost;?></th>
                            </tr>
                            <tr>
                                <th colspan="9" >For Online Pooja booking  <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
                            </tr>
                    </tbody>
                </table>
				
				<div style="width:100%;	height:50px; display:flex; justify-content: space-between;">
                	<?php if($pageBreak == 1): ?>
            		<h5 style="margin:0; padding:0;">Grand Total: <span style=""> <?= $grand_total ?? ''; ?> </span> </h5>
            	<?php endif; ?>
            		<?php if($token): ?>
            		<strong style="font-size:26px;">Token: <span style=""> <?= $token ?? ''; ?> </span> </strong>
            		<?php endif; ?>
        			<strong style="font-size: 13px !important">Payment Method:  <?= $paymentMode ?? ''; ?></strong>
        		</div>
				<div style="width:100%; display:flex" id="footer">
                	<div style="text-align: left;">Prepared By : <?= $preparedby->name ?? ''; ?><br><?php echo  date("g:i a", strtotime($preparedby->bill_time ?? '')); ?></div>
					<div style="text-align: right; padding-right:18px;">CLERK <br> <?= ucfirst($preparedby->countername) ?? ''; ?></div>
        		</div>
			
				<div class="page-break"></div>
                <?php   
                    }
                    }
                }
            	
            }
        }
    ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.content p').each((i, e) => {
                var leftsideWidth = $(e).find('.leftside').width();
                var dottedElement = $(e).find('.dotted');
                var balance = $(e).hasClass('w-50') ? ($(e).hasClass('left') ? 380 : 355 ) : 700;
                var remainingWidth = $(e).width() - leftsideWidth - parseFloat($(e).find('.dotted').css('margin-left')) - balance;
                dottedElement.width(remainingWidth).css('display', 'inline-block');
            });
        });
        window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view" }, 500); }
        function myFunction(){
            window.location = "<?php echo base_url();?>index.php/admin/admin/billing";
        }
        function printcontend(value) {
            $('.content p').each((i, e) => {
                    var leftsideWidth = $(e).find('.leftside').width();
                    var dottedElement = $(e).find('.dotted');
                    var balance = $(e).hasClass('w-50') ? ($(e).hasClass('left') ? 380 : 355 ) : 700;
                    var remainingWidth = $(e).width() - leftsideWidth - parseFloat($(e).find('.dotted').css('margin-left')) - balance;
                    dottedElement.width(remainingWidth).css('display', 'inline-block');
                });

            var restorpage=document.body.innerHTML;
            var printcontend=document.getElementById(value).innerHTML;
            document.body.innerHTML=printcontend;
            window.print();
            document.body.innerHTML=restorpage;
        }

    </script>
</body>
</html>