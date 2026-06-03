 <html>
 <html>
	<head>
    <style>
    @media print {
  		.page-break {page-break-after: always;}
   
    	@page {
        	margin-top: 95.5px;
    	}
	}
     #printer{
         width: 672.75590551px;
         height: 275.63385827px;
         font-size:17px;
/*      	 border: 1px solid; */
/*         background-color:green; */
    }
     .fixed-header{
/*          */
/*         background-color:red; */
    }
    </style>
    
	</head>
	<body onload="printcontend('printer') " onafterprint="myFunction()">
    <?php   
            $site_settings=$this->site_model->settings();
    
    
    // $site_settings=$this->site_model->settings();
    		$q = $this->db->query("SELECT SUM(amount) as grand_total FROM billing_dtls WHERE bill_id = $bill_id");
		    $gtotal=$q->row();
    		$grand_total = $gtotal->grand_total;
    
            $preparedby = $this->db->query("select admin.name,bill_time,counter.name as countername from admin join billing on billing.user_id = admin.id join counter on billing.counter=counter.id where billing.id = $bill_id")->row();
            $a = $this->db->query("SELECT DISTINCT date FROM billing_dtls WHERE bill_id = $bill_id GROUP BY date ");
		    $dates=$a->result_array();
         
    	  $b = $this->db->query("SELECT DISTINCT pooja_cat FROM pooja WHERE id IN (SELECT DISTINCT pooja FROM billing_dtls WHERE bill_id = $bill_id and date='2024-04-30') GROUP BY pooja_cat");
		    $cat=$b->result_array();

          foreach ($dates as $date){
            $da = $date['date'];

	        $b = $this->db->query("SELECT DISTINCT pooja_cat FROM pooja WHERE id IN (SELECT DISTINCT pooja FROM billing_dtls WHERE bill_id = $bill_id and date='$da') GROUP BY pooja_cat");
		    $pooja_cat=$b->result_array();
          
		    foreach ($pooja_cat as $key => $id){
            	$breakClass = (($key+1) == count($pooja_cat) ? '' : 'page-break');
            	
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star','left');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('pooja.pooja_cat', $id['pooja_cat']);
                $this->db->where('billing_dtls.date', $da);
            	// $this->db->where('billing_dtls.time', $time);
                $this->db->group_by('billing_dtls.pooja');
                $this->db->group_by('billing_dtls.name');
                $this->db->group_by('billing_dtls.id');
        	    $query = $this->db->get()->result_array();
             
        	    if(sizeof($query)>0){
                
		    ?>
		<div id="printer">
         <div class="fixed-header"></div>
			<table border="0" style="border-collapse:collapse;width:100%;margin-bottom:1cm;font-size:15px;color:black;margin-right:0px;">
			    <thead>
    				<tr>
    					<th colspan="9"><label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
                        	<label style="float:center;text-align:center;"><?php print_r($query[0]['deity_nm']);?></label>
    					    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
    				    </th>
    				</tr>
                	<tr>
    					<th colspan="9" style="height:45px;">&nbsp; 
    				    </th>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
                	$temp_total = 0;
                	$count = count($query); 
                	$height = '';
                switch ($count) {
                    case 1:
                        $height = '120.28346457px';
                        break;
                    case 2:
                        $height = '63.141732285px';
                        break;
                    case 3:
                        $height = '60.761154857px';
                        break;
                    case 4:
                        $height = '49.070866143px';
                        break;
                    case 5:
                        $height = '37.056692914px'; 
                        break;   
                    
                    default:
                        $height = '37.056692914px';
                        break; 
                }	
				    foreach($query as $key => $val){ 
                    	$pageBreak = ($key+1)%5 == 0 ? 1 : 0;
                    	$pageBreakClass = $pageBreak == 1 ? 'page-break' : '';
                    	
				        $qlt=$val['qlt'];
				        $pooja_rt=$val['pooja_rt'];
				       // $amt=$qlt*$pooja_rt;
                     	$amt=$val['amount'];
				        $total=$total+$amt;
				        $date=$val['date'];
				        $today=date('Y-m-d');
                      	$amount=$val['amount'];
                    	
				        ?>
				        <tr style="text-align:center;">
				            <td ></td>
                        	<td><?php echo $val['pooja_nm']; if ($date!=$today){echo "(".date('d-m-Y',strtotime($date)).")";}?></td>
				            <td ><?php echo strtoupper($val['name']);?></td>
				            <td ><?php echo $val['star_eng'];?></td>
				            <td >&nbsp;</td>
				            <td style="text-align:right;" colspan="2"><?php echo $qlt;?> x <?php echo $pooja_rt;?></td>
                        	<td >&nbsp;</td>
				            <td style="text-align:right;float:right;margin-right:0px; width: 102.04724409px !important"><?php echo $amount;?></td>
				        </tr>
                
                		<?php $temp_total += $amt; if($pageBreak == 1) { $temp_total = 0; ?>
                			<tr class="<?php echo $pageBreakClass; ?>">
				        	<th>&nbsp;</th>
				        	<th colspan="7" style="text-align:left;font-size:20px;font-weight:bold;"></th>
				        	<th style="text-align:right;font-size:20px;font-weight:bold;"><?php echo $total;?> <br/> <span><?php echo $grand_total;?></span> </th>
				    		</tr>
                		<?php } else {
                        	// $temp_total += $amt;
                        }  ?>
				    <?php 
				        $i++;
                   		$j=$i;
				    }?>
                   <tr style="height:<?php print_r($height); ?>">
                   </tr>
				    <tr>
				        <th>&nbsp;</th>
				        <th colspan="7" style="text-align:left;font-size:20px;font-weight:bold;"></th>
				        <th style="text-align:right;font-size:20px;font-weight:bold;"><?php echo ($temp_total);?> <br/> <span><?php echo $grand_total;?></span> </th>
				    </tr>
				</tbody>
			</table>
        
         	<div class="<?php echo $breakClass; ?>"></div>
			<?php }} }?>
        	
		</div>
	</body> 
</html>
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