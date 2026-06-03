 <html>
	<head>
	<style type="text/css">
	body{
	   width:100%;
	   height: 100%;
    font-size:11px;
	}	
	#printer{
	   max-height: 100%;
	   max-width: 100%;
	}
	</style>
    <LINK rel="stylesheet" type"text/css" href="print.css" media="print">
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
		    <?php 
		  //$diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		   
		   
		   $site_settings=$this->site_model->settings();
            $preparedby = $this->db->query("select admin.name,bill_time,counter.name as countername from admin join billing on billing.user_id = admin.id join counter on billing.counter=counter.id where billing.id = $bill_id")->row();
		   
		        $this->db->select('billing_dtls.*,billing.status as bstatus,billing.total as btotal,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star', 'left');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja', 'left');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id', 'left');
                 $this->db->join('billing','billing.id = billing_dtls.bill_id', 'left');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
                 $this->db->where('billing_dtls.pooja', '9000');
        	   
        	    $query = $this->db->get()->result_array();
        	    
        	    if(count($query)>0){
		    ?>
			<table border="1" style="border-collapse:collapse;width:98%;margin-bottom:1cm;font-size:14px;">
			    <thead>
    				<tr>
    					<td colspan="3" style="width:100%;"><div style="white-space: nowrap;">
    					<img alt="Image" src="<?php echo base_url(); ?>/assets/admin/img/temple logo.jpeg" style="height: 1.5cm;width: auto;">
    					<h4 style="text-align:center;margin-top: -1.2cm;"><?php print_r($temple_list[0]['name']);?><br>
    					<span style="font-size:10px;"><?php print_r($temple_list[0]['address']." <br> ".$temple_list[0]['location']);?></span></h4>
    					</div></td>
    				</tr>
    				<tr>
    					<th colspan="3"><label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
                        	<label style="float:center;text-align:center;"><?php print_r($query[0]['deity_nm']);?></label>
    					    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <td style="max-width:1cm;">SNo</td>
    				    <td>NAME</td>
    				    <td>AMOUNT</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
               
				    foreach($query as $val){ 
				        $qlt=$val['qlt'];
				        $pooja_rt=$val['pooja_rt'];
				       $amt=$val['amount'];
				        $total=$total+$amt;
                       
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
				            <td><?php echo strtoupper($val['name']);?></td>
				          
				            <td style="text-align:right"><?php echo $amt;?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				    <tr>
				        <th></th>
				        <th colspan="1" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $total;?></th>
				    </tr>
               
				    <tr>
				        <th colspan="3" >For Online Pooja booking<a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website'])?></a></th>
				    </tr>
                 <tr>
				        <th style="text-align: right;margin-bottom:1cm;">Prepared By : <?= $preparedby->name ?? ''; ?><?php echo  date("g:i a", strtotime($preparedby->bill_time ?? '')); ?></th><th colspan="2"style="text-align: right;margin-bottom:1cm;" >EXECUTIVE OFFICER </th>
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
            </tr></table>
			<?php }?>
		</div>
    <div style="height:100px;">&nbsp;</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/other_billing" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/other_billing";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>