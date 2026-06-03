<?php  if ($_SERVER['HTTP_HOST'] == 'puthoor.templesoftware.in') { ?>
 <html>
	<head>
    	<style>
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
    	</style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		   
		  $site_settings=$this->site_model->settings();
		   $a=$this->db->query("SELECT id From diety");
		      $diety_id=$a->result_array();
		    foreach ($diety_id as $id){
		        
		        $id=$id['id'];
		        $this->db->select('billing_dtls.*,billing.status as bstatus,billing.total as btotal,billing.customer_id ,stars.name_mal as star_eng,pooja.name_mal as pooja_nm, pooja.name as pooja,billing_dtls.rate as pooja_rt,diety.name as deity,diety.name_mal as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
                $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('billing_dtls.diety_id', $id);
        	    $query = $this->db->get()->result_array();
        	    
        	    if(count($query)>0){
		    ?>
        	<?php 
                if($bill_list[0]['status'] == 2) { 
            		$bill_date = $bill_list[0]['transaction_date'] ?? $bill_list[0]['date'];
                } else {
                	$bill_date = $bill_list[0]['date'];
                }
            ?>
			<table border="0" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;">
                        	<div class="d-flex flex-row justify-content-between">
    							
    							<h4 style="text-align:center; margin-top:0">
                                	<?php //print_r($temple_list[0]['name']);?><br>
    								<span style="text-align:center;font-size:13px;"><?php //print_r($temple_list[0]['address']." <br>".$temple_list[0]['location']);?></span>
                            	</h4>
                            	<?php 
                				$emblem_right = $site_settings['emblem_right'] ?? null;
                				if($emblem_right):
                				?>
                				
                            	<?php else: ?>
                        		<div style="height: 1.5cm;width: auto;"></div>
                            	<?php endif; ?>
    						</div>
                        </td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_date)));?></label>
                        	<label style="float:center;text-align:center;"><?php print_r($query[0]['deity_nm']);?></label>
    					    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
    				    </th>
    				</tr>
                
                <?php if ($query[0]['customer_id']!="0"){
    				    $this->db->select('*');
    				    $this->db->from('user_dtl');
    				    $this->db->where('id', $query[0]['customer_id']);
    				    $query1 = $this->db->get()->result_array();
    				    ?>
    				<tr>
    					<td colspan="4">NAME</td>
    					<td colspan="5"><?php echo strtoupper($query1[0]['name'] ?? '');?></td>
    				</tr>
    				<tr>
    					<td colspan="4">ADDRESS</td>
    					<td colspan="5"><?php echo strtoupper(($query1[0]['house'] ?? '')." , ".($query1[0]['street'] ?? '')." , ".($query1[0]['post'] ?? '')." , ".($query1[0]['district'] ?? ''));?></td>
    				</tr>
    				<?php }?>
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
				    foreach($query as $val){ 
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
				            <td><?php echo $i;?></td>
				            <td><?php echo strtoupper($val['name']);?></td>
				            <td><?php echo $val['star_eng'];?></td>
				            <td><?php echo $val['pooja_nm']; if ($date!=$today){echo "(".date('d-m-Y',strtotime($date)).")";}?></td>
				          <td style="text-align:right"><?php  echo $val['time'];?></td>   
                        <td style="text-align:right"><?php echo $qlt;?></td>
				            <td style="text-align:right"><?php echo $pooja_rt;?></td>
				            <td style="text-align:right"><?php echo $amount;?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
                	<?php if(count($adjustment) > 0) {  ?>
                	<tr style="border-left:0; border-right:0; height: 30px;">
                    	<th colspan="8" ></th>
                	</tr>
                	<tr>
    					<th colspan="8">
                        	RECEIVED ITEMS 
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
				        <th style="text-align:right"><?php echo $total;?></th>
				    </tr>
                 <?php if($val['bstatus']=='2'){  ?> <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total  Collected including prasadam sending and 5 % online service charges</th>
				        <th style="text-align:right"><?php echo $val['btotal'];?></th>
				    </tr>
                <?php } ?>
				    
				</tbody>
			</table>
        	<div style="text-align: right;margin-bottom:3cm;">
				<strong>CLERK</strong>
        	</div>
        	
			<?php }}?>
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
<?php } else { ?>
<!DOCTYPE html>  
<html>  
<head>  
    <title>table</title>  
    <style> 
    table{  
       border-collapse: collapse;  			
    }
    tbody{
       min-height:3.5cm;
       min-width:12.5cm
    }
    th,td{  
  		border-radius:15px;
        border: 0px solid red;    
        padding:5px;
/*         font-size:15px; */
    } 
    #printer{
        width:12.2cm;
        font-weight:bold;
    }
               
    </style>  
  </head>  
<body onload="printcontend('printer')" onafterprint="myFunction()"> 
<div align="center" id="printer">
<div>
 <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		    $pooja = $this->db->query("SELECT pooja FROM billing_dtls WHERE bill_id=$bill_id GROUP BY pooja")->result_array();
            $pooja_count = sizeof($pooja);
            //print_r($pooja_count);

		    $a=$this->db->query("SELECT id From pooja");
		    $diety_id=$a->result_array();
		    foreach ($diety_id as $id){
		        $id=$id['id'];
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,
                billing_dtls.rate as pooja_rt,billing_dtls.amount as amt,
                diety.name_mal as deity_nm,billing.date as bd_date');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
               $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('billing_dtls.pooja', $id);
        	    $query = $this->db->get()->result_array(); 
        	    
        	    if(sizeof($query)>0){
		    ?>
		<table> 
        <thead style="max-width:10.2cm">
			<tr>
				<td colspan="2" style="font-size:15px;padding-left:1.5cm;"><?php print_r($query[0]['deity_nm']);?></td>
				<td colspan="3"  style="font-size:15px;padding-left:1.5cm;"><?php print_r(date('d-m-Y',strtotime($query['0']['bd_date'])));?></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:15px; padding-left:1.5cm"><?php print_r($query[0]['pooja_nm']);?> (<?php echo date('d-m-Y',strtotime($query[0]['date'])); ?>)</td>
				<td colspan="2" style="font-size:15px;padding-left:1.5cm;"><?php print_r($bill_list[0]['id']);?></td>
			</tr>
        </thead>
        <tbody>
        <tr>  
           <td style="width:8.5cm;height:0.5cm"></td>
           <td style="width:2.3cm;height:0.5cm"></td>
           <td style="width:1.1cm;height:0.5cm"></td>
           <td style="width:1.2cm;height:0.5cm"></td>
           <td style="width:1.7cm;height:0.5cm"></td> 
        </tr>	
        <?php $i=1; $total='0';
		    foreach($query as $val){ 
				    $qlt=$val['qlt'];
				    $pooja_rt=$val['pooja_rt'];
				   // $amt=$qlt*$pooja_rt;
				    $amt=$val['amt'];
				    $total=$total+$amt;
                    $count = sizeof($query);
		?>
        <tr>  
           <td style="width:8.5cm;height:0.3cm;font-size:15px"><?php echo strtoupper($val['name']);?></td>
           <td style="width:2.3cm;height:0.3cm;font-size:15px"><?php echo $val['star_eng'];?></td>
           <td style="width:1.1cm;height:0.3cm;font-size:15px"><?php echo $qlt;?></td>
           <td style="width:1.2cm;height:0.3cm;font-size:15px"><?php echo $pooja_rt;?> </td>
           <td style="width:1.7cm;height:0.3cm;font-size:15px"><?php echo $amt;?></td> 
       </tr>	
      <?php  $i++; }?>
          <?php if($count == 1){
                    echo "<tr><td style='height:1.5cm'></td></tr>";
               }
               else if($count == 2){
                   echo "<tr><td style='height:0.9cm'></td></tr>";
               }
               else if($count == 3){
                   echo "<tr><td style='height:0.6cm'></td></tr>";
               }
               else if($count == 4){
                   echo "<tr><td style='height:0.3cm'></td></tr>";
               } 
       
            ?>
         
           <tr>
              <td style='height:0.3cm' colspan="4"></td>
              <td style="align:center;height:0.3cm;font-size:15px;"><?php echo $total;?></td>
          </tr>
          <tr>  
		     <td colspan="3"  style="padding-left:4cm;height:0.3cm;font-size:15px;" ><?php //echo date('d-m-Y'); ?> </td>
		     <td align="center"colspan="3" style="height:0.3cm;" > </td>
	      </tr>
           <?php if($pooja_count > 1){ ?>
           <tr>
              <td style='height:0.6cm' colspan="5"></td>
          </tr>
          <?php } ?>
         
        
        <!--
          Top : 0.69
          Left/Right : 0.39
          Bottom : 0.5

        -->
    </tbody>      
</table> 
<?php }} ?>
</div> 
</body>  
</html>  
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

<?php } ?>