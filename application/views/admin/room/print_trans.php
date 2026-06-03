 <html>
	<head>
	<style type="text/css">
	body{
	   width:100%;
	   height: 100%;
	}	
    td{
    	padding:5px;
    }
	#printer{
	   max-height: 100%;
	   max-width: 100%;
	}
	</style>
    <LINK rel="stylesheet" type"text/css" href="print.css" media="print">
	</head>
<?php
function getIndianCurrency(float $number)
{
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
    $digits = array('', 'hundred','thousand','lakh', 'crore');
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
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' paise' : '';
    return ($Rupees ? $Rupees . 'rupees ' : '') . $paise;
}
?>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<table style="width:98%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="12" style="width:100%;">
                        	<div>
    							<h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    							<span style="font-size:10px;"><?php print_r($temple_list[0]['address'].$temple_list[0]['location']);?></span></h4>
    						</div>
                    	</td>
    				</tr>
    				<tr>
    					<th colspan="12"><label style="float:left;">Bill No - <?php echo $trans_list['id'];?></label>
    					    <label style="float:right;font-size:bold;">Bill Date - <?php echo date('d-m-Y');?></label>
    				    </th>
    				</tr>
				</thead>
				<tbody>
    				<tr>
    				    <td colspan="12">Received with thanks from Sri/Smt/Ms : <?php echo $trans_list['name'];?></td>
    				</tr>
    				<tr>
    				    <td colspan="5">A sum of Rs : <?php echo $trans_list['rent_recv'];?></td>
    				    <td colspan="7">(In words) : <?php echo getIndianCurrency($trans_list['rent_recv']);?></td>
    				</tr>
    				<tr>
                    	<?php $date=$trans_list['year']."-".$trans_list['month']."-1";?>
    				    <td colspan="5">For the month & Year : <?php echo date('F,Y',strtotime($date));?></td>
    				    <td colspan="7">For Shop Door no : <?php echo $trans_list['door_no'];?></td>
    				</tr><?php if($trans_list['instru_no']==""){?>
    				<tr>
    				    <td colspan="5">By Cash</td>
    				    <td colspan="7"></td>
    				</tr><?php }else{?>
                	<tr>
    				    <td colspan="6">By Cheque - Cheque no : <?php echo $trans_list['instru_no'];?></td>
    				    <td colspan="6">Dated : <?php echo date('d-m-Y',strtotime($trans_list['instru_date']));?></td>
    				</tr><?php }?>
    				<tr>
    				    <td colspan="7">As per letout Agreement No: <?php echo $trans_list['agr_no'];?></td>
    				    <td colspan="5">Date : <?php echo $trans_list['agr_date'];?></td>
    				</tr>
    				<tr>
    				    <td colspan="5"></td>
    				    <td colspan="7" style="padding-top: 20px;">For : <?php echo print_r($temple_list[0]['name']);?></td>
    				</tr>
    				<tr>
    				    <td colspan="5"></td>
    				    <td colspan="7" style="padding-top: 5px;text-align:center;">  (President / Secretary / Treasurer) </td>
    				</tr>
				</tbody>
            
            
			</table>
        	<table>
             <tr>
				        <td colspan="9" style="border:0px;" >&nbsp; </td>
				    </tr>
                 <tr>
				        <td colspan="9" style="border:0px;" >&nbsp;  </td>
				    </tr>
                 <tr>
				        <td colspan="9" style="border:0px;" >&nbsp;  </td>
				    </tr>
              <tr>
				        <td colspan="9" style="border:0px;" >&nbsp;  </td>
            </tr>
        </table>
		</div>
    <div style="height:100px;">&nbsp;</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/view_trans" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/view_trans";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>