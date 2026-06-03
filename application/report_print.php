 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
	        }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
				  	<tr>
    					<td colspan="7" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br>
    					Bandaram Counting - For The Date <?php if (isset($datef)){echo date('d-m-Y',strtotime($datef));};?> To
    					<?php if (isset($datet)){echo date('d-m-Y',strtotime($datet));};?></h4>
    					</td>
    				</tr>
					<tr>
					  <th>SL No </th>
					  <th>Date</th>
					  <th>Amount</th>
					  <th>Type</th>
					  <th>Nos</th>
					  <th>Remark</th>
					  <th>Total</th>
					</tr>
				  <tbody>
					<?php 
					$this->db->select('transaction.*,bandaram.name');
					$this->db->from('transaction');
					$this->db->join('bandaram','transaction.bandaram = bandaram.id');
					if($bandaram!=0){
						$this->db->where('transaction.bandaram', $bandaram);
					}
					$this->db->where("transaction.date BETWEEN '$datef' AND '$datet'");
					$query = $this->db->get()->result_array();

     // to get group
     // 
	 				$g_total=0; 
					if(!empty($query)){
					    $i=0;
					    
	                    foreach($query as $val){ 
	                       $trance_id=$val['id'];
	                       $this->db->select('transaction_dtls.*,amount.name as amount_nm');
	                       $this->db->from('transaction_dtls');
	                       $this->db->join('amount','transaction_dtls.amount = amount.id');
	                       $this->db->where('trans_id', $trance_id);
	                       $query1 = $this->db->get()->result_array();
	                       $rowspan=sizeof($query1);
						   $query2 = $this->db->query("SELECT sum(`total`) as amt,`remark` FROM `transaction` join `transaction_dtls`  on `transaction_dtls`.`trans_id`=`transaction`.id
						    WHERE `transaction`.`id` = '$trance_id' group by `remark`");
	                       if($bandaram==0){?>
							<tr>
								 <td colspan="8" style="text-align: center;"><?= $val['name'];?></td>
							 </tr>
							 <?php }?>
    				      <tr>
        					   <td rowspan="<?php echo $rowspan;?>"><?= ++$i; ?></td>
        					   <td rowspan="<?php echo $rowspan;?>"><?= date('d-m-Y',strtotime($val['date'])); ?></td>
    				      <?php
    				      $total=0;
	                           foreach($query1 as $key=>$val1){ 
	                               $total=$total+$val1['total'];
	                               if ($key!=0){
	                                   echo "<tr>";
	                               }
	                        ?>
            					 <td><?= $val1['amount_nm']; ?></td>
            					 <td><?= $val1['remark']; ?></td>
            					 <td><?= $val1['nos']; ?></td>
            					 <td><?= $val1['notes']; ?></td>
            					 <td style="text-align: right;"><?= $val1['total']; ?></td>
					
            						</tr>
        					           <?php    
                				
	                           }
	                           $g_total=$g_total+$total;
					?>
	        <?php  foreach ($query2->result_array() as $row) {  ?>      
                    <tr>
    						<th colspan="6" style="text-align: left;"> <?php echo $row['remark'];?></th>
    						<th style="text-align: right;"><?php  echo $row['amt'];?></th>
    					</tr>
                 <?php } ?> 
                  <tr>
    						<th colspan="6" style="text-align: left;">Total</th>
    						<th style="text-align: right;"><?php echo $total;?></th>
    					</tr>
    					<tr>
    						<td colspan="8"></td>
    					</tr>
	                    <?php 
	                    }
					}?>
					</tbody>
						<tr>
    						<th colspan="6" style="text-align: left;">Grand Total   <?php $a=numinwords($g_total); echo $a; ?></th>
    						<th style="text-align: right;"><?php echo $g_total;?></th>
    					</tr>
				</table>
        <table width="100%">
        <tr> <td width="80%"><b>In  the presence of  </b></td> <td width="20%" ><b>Exectuvie officer  </b></td></tr>	 </table>
      
		</div>
	</body>
</html>
<?php
function numinwords($num)
{
$number = $num;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo "Rupees ".$result . "" . $points . " Paise";
 
}
?>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/bandaram_report" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/bandaram_report";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>