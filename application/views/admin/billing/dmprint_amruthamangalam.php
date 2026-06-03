 <html>
	<head>
	<style type="text/css">
	body {
	    width:100%;
	    height: 10.16cm;
    	font-size:15px;
    	font-weight:bold;
	}	
    
	#printer {
       width:  15.2cm;
	   max-width: 15.3cm;
       max-height:10.16cm;
       border: 1px solid #fff;
	}
	</style>
    <link rel="stylesheet" type="text/css" href="print.css" media="print">
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer" style="width:100%">
		    <?php 
		      $a=$this->db->query("SELECT id From diety");
		      $diety_id=$a->result_array();
        
		    // foreach ($diety_id as $id){
		        
		        // $b_id=$id['id'];
		        $this->db->select('billing_dtls.*,billing.status as bstatus,billing.total as btotal,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm, billing.remarks as remarks');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
                $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    // $this->db->where('billing_dtls.diety_id', $b_id);
        	    $query = $this->db->get()->result_array();
        	    
        	    if(count($query)>0){
                $remarks = $query[0]['remarks'];
		    ?>
			<table  border="1" style="border-collapse:collapse;!important;font-size:16px;" width="578.2677px;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><div style="white-space: nowrap;">
<!--     					<img alt="Image" src="<?php echo base_url(); ?>/assets/admin/img/temple logo.jpeg" style="height: 1.5cm;width: auto;"> -->
    					<h4 style="text-align:center;font-size:15px;"><?php print_r($temple_list[0]['name']);?><br>
    					<span style="font-size:15px;"><?php print_r($temple_list[0]['address']." <br> ".$temple_list[0]['location']." <br> ".$temple_list[0]['phone']);?></span></h4>
    					</div></td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
                        	<label style="float:center;text-align:center;"></label>
    					    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <td style="max-width:1cm;">SNo</td>
    				    <td>NAME</td>
    				    <td>STAR</td>
    				    <td>POOJANAME</td>
                        <td>T</td>
    				    <td>NOS</td>
    				    <td>RATE</td>
    				    <td>AMOUNT</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
					//$amt = 0;
                	$bstatus=$query['0']['bstatus'];echo $bstatus;
				    foreach($query as $val){ 
				        $qlt=$val['qlt'];
				        $pooja_rt=$val['pooja_rt'];
				        $amt=$qlt*$pooja_rt;
				        $total=$total+$amt;
                        $amt=$val['amount'];
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
				            <td><?php echo strtoupper($val['name']);?></td>
				            <td><?php echo $val['star_eng'];?></td>
				            <td><?php echo $val['pooja_nm'].'( '.date('d-m-Y',strtotime($val['date'])).' )';?></td>
                            <td><?php echo $val['time'];?></td>
				            <td style="text-align:right"><?php echo $qlt;?></td>
				            <td style="text-align:right"><?php echo $pooja_rt;?></td>
				            <td style="text-align:right"><?php echo $amt;?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				    <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $total;?></th>
				    </tr>
                	<?php if($remarks && $remarks != ''): ?> 
                	<tr>
                    	<td colspan="8" style="text-align:left"> <i> <?php echo $remarks;?> </i> </td>
				    </tr>
                	<?php endif; ?>
                 <?php if($val['bstatus']=='2'){  ?> <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total  Collected including prasadam sending and 5 % online service charges</th>
				        <th style="text-align:right"><?php echo $val['btotal'];?></th>
				    </tr>
                <?php } ?>
				   <!-- <tr>
				        <th colspan="9" >For Online Pooja booking<a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website'])?></a></th>
				    </tr>-->
                 	<tr rowspan="2">
				        <th colspan="9"style="text-align: center;margin-bottom:1cm;" >EXECUTIVE OFFICER </th>
				    </tr>
               
				</tbody>
            
            
			</table>

			<?php }?>
		</div>
<!--     <div style="height:100px;">&nbsp;</div> -->
	</body>
</html>
<script>
let printer = document.getElementById('printer');
printer.childNodes[0].data = "";

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