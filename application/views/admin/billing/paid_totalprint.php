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
		   
			<table border="1" style="border-collapse:collapse;width:98%;margin-bottom:1cm;font-size:14px;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><div style="white-space: nowrap;">
    					<img alt="Image" src="<?php echo base_url(); ?>/assets/admin/img/temple logo.jpeg" style="height: 1.5cm;width: auto;">
    					<h4 style="text-align:center;margin-top: -1.2cm;"><?php print_r($temple_list[0]['name']);?><br>
    					<span style="font-size:10px;"><?php print_r($temple_list[0]['address']." <br> ".$temple_list[0]['location']);?></span></h4>
    					</div></td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></label>
                        	<label style="float:center;text-align:center;"></label>
    					    <label style="float:right;font-size:bold;">Bill - <?php print_r($bill_list[0]['id']);?></label>
    				    </th>
    				</tr>
                    <tr>
                       <td colspan="9" >
                          <p>Name : <?= $bookings['name'];  ?></p>
                          <p>Mode : <?php
                           if($bookings['mode'] == 2){
                                 echo 'Cheque';
                              }
                              else if($bookings['mode'] == 3){
                                 echo 'DD';
                              }
                              else if($bookings['mode'] == 4){
                                 echo 'MO';
                              }
                              else{
                                 echo 'Others';
                              }
                          ?> , Serial Number - <?= $bookings['slno'];  ?></p>
                          <p>Ref. No. : <?= $bookings['ref_no'];  ?></p>
                          <p>Total Amount Received Rs - <b><?= $bookings['amount']; ?>/-.</b><p>
                       </td>
                    </tr>
				</thead>
				<tbody>
				    <tr>
				        <th colspan="9" >For Online Pooja booking<a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website'])?></a></th>
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