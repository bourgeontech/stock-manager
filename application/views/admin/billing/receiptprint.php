<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
        @media print {
  			footer {page-break-after: always;}
		}
           * {
    font-size: 12px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 200px;
    max-width: 200px;
}


td.price,
th.price {
    width: 94.803px;
    max-width: 94.803px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}
        
.right {
    text-align: right;
    align-content: right;
}   
.left {
    text-align: left;
    align-content: left;
}  
        .flex {
        	display:flex;
        }

.ticket {
    width: 294.803px;
    max-width: 294.803px;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
   </style>
    <title><?php print_r($temple_list[0]['name']);?></title>
    </head>
    <body  onload="printcontend()" onafterprint="myFunction()">
        <div class="ticket">
           <?php 
        $remarks = $this->db->query("select remarks from billing where billing.id = $bill_id")->row();
               $total='0';$grandtotal='0';
		       $site_settings=$this->site_model->settings();
         $preparedby = $this->db->query("select admin.name,bill_time,remarks,counter.name as countername from admin join billing on 
        billing.user_id = admin.id join counter on billing.counter=counter.id where billing.id = $bill_id")->row();
  
		        foreach($bill_details as $bill) { 
             	
        	    if(sizeof($bill)>0){ ?>
        			<p class="centered">
         <img src="<?=$site_settings['bill_image']; ?>" style="height: 1.5cm;width: auto;" alt="Image 1" />
        </p>
            <p class="centered">
           
                <b><?php print_r($temple_list[0]['name']);?></b>
                <br><?php print_r($temple_list[0]['address']);?>
                <br><?php print_r($temple_list[0]['location']);?></p>
            <table>
                 <tr>
                    <tr>
                       <th class="left">Bill - <?php print_r($bill[0]['bill_no'] ?? $bill[0]['bill_id']);?> </th>
                       <th class="right">Date : <?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></th>
                    </tr>
            <?php
             if($_SERVER['HTTP_HOST'] == "vasai.templesoftware.in"||$_SERVER['HTTP_HOST'] == "dwarakamandirdelhi.templesoftware.in"){ ?>
            <tr>
                      <th class="description">Particulars </th>
                      <th class="price right">Amount</th>
                    </tr>
            
            <?php } else { ?>
                    <tr>
                      <th class="description">വഴിപാട് </th>
                      <th class="price right">തുക</th>
                    </tr>
            <?php } ?>
            </table>
            <hr>
                    <table>
                     <caption><b><?php print_r($bill[0]['deity_nm']);?></b></caption>
                     <tbody>
                       <?php
				        
                        // $bstatus=$query['0']['bstatus'];
				        foreach($bill as $val){ 
				           $qlt=$val['qlt'];
				           $pooja_rt=$val['pooja_rt'];
                           if($pooja_rt > 0) { $amt=$qlt*$pooja_rt; }
                           else { $amt=$val['amount']; }
                           $total=$total+$amt;
                        
				        ?>
                      
                       <tr>
                         <td class="description">
                           <span style="font-size:15px;font-weight:bold;"><?php echo strtoupper($val['name']);?>-(<?php echo $val['star_eng'];?>) |
                            <br><?php echo $val['pooja_nm'];?></span><br>
                             (<?php echo $qlt;?> * <?php echo $pooja_rt;?>) | <span style="font-size:18px;font-weight:bold;">
                         <?php print_r(date('d-m-Y',strtotime($val['date'])));?> </span> | <?php echo $val['time'] ?><br>
                         </td>
                         <td class="price right"><?php echo $amt;?></td>
                      </tr>
                     <?php } ?>
                     <?php if(@count($adjustment) > 0) {  ?>
                	<tr>
    					<th colspan="2">
                        	Recieved Items 
    				    </th>
    				</tr>
                	
                	<?php foreach($adjustment as $key => $adj) { ?>
                     	<tr>
                         <td class="description">
                             <?php echo strtoupper($adj['product']);?> | <?php echo $adj['qty'];?> <?= $adj['unit']; ?> 
                         </td>
                         <td class="price right"></td>
                      </tr>
                    <?php } ?>
                	<?php } ?>
                    </tbody>
                    
                  </table>
        		  <table>
                    <tr>  
                       <td class="description"><b>Total</b></td>
                       <td class="price right"><b><?php echo $total; ?></b></td>
                    </tr>
                </table>
        <?php if($remarks->remarks!='') { ?>
        <p class="centered">Remarks:  <?= $remarks->remarks ?? ''; ?></p>
        <?php } ?>
        		<p class="centered">For Online Pooja booking
                <br><?php print_r($temple_list[0]['website'])?></p>
        
        		<div class="flex">
        			<p> <?php print_r($preparedby->name); ?> </p>
        			<p style="text-align:right; padding-left:1em"> <?php echo date("d-m-Y g:i a", strtotime($preparedby->bill_time ?? '')); ?> </p>
        		</div>
               <hr> 
        		<footer></footer>
               <?php } $grandtotal+=$total;$total=0; } ?>

                
            
        </div>
      <script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing" }, 500); }
function myFunction(){
     window.location = "<?php echo base_url();?>index.php/admin/admin/billing";
     // window.history.back();
     // location.reload(); 
}
function printcontend(value) {
	window.print();
}

</script>
    </body>
</html>