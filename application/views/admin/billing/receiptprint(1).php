<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
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
<!--             <img src="<?php echo base_url(); ?>/assets/admin/img/temple logo.jpeg" alt="Logo"> -->
            <p class="centered">
                <b><?php print_r($temple_list[0]['name']);?></b>
                <br><?php print_r($temple_list[0]['address']);?>
                <br><?php print_r($temple_list[0]['location']);?></p>
            <table>
                 <tr>
                    <tr>
                       <th class="left">Bill - <?php print_r($bill_list[0]['id']);?> </th>
                       <th class="right">Date : <?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></th>
                    </tr>
                    <tr>
                      <th class="description">Description</th>
                      <th class="price right">Amt</th>
                    </tr>
            </table>
            <hr>
           <?php 
               $total='0';
		       $a=$this->db->query("SELECT id From diety");
		       $diety_id=$a->result_array();
		       foreach ($diety_id as $id){ 
		           $id=$id['id'];
		           $this->db->select('billing_dtls.*,billing.status as bstatus,billing.total as btotal,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
        	       $this->db->from('billing_dtls');
        	       $this->db->join('stars','stars.id = billing_dtls.star');
        	       $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	       $this->db->join('diety','diety.id = billing_dtls.diety_id');
                   $this->db->join('billing','billing.id = billing_dtls.bill_id');
        	       $this->db->where('billing_dtls.bill_id', $bill_id);
        	       $this->db->where('billing_dtls.diety_id', $id);
        	       $query = $this->db->get()->result_array();
        	       if(count($query)>0){ ?>
                    <table>
                     <caption><b><?php print_r($query[0]['deity_nm']);?></b></caption>
                     <tbody>
                       <?php
				        
                        $bstatus=$query['0']['bstatus'];
				        foreach($query as $val){ 
                           $token = $val['token'];
				           $qlt=$val['qlt'];
				           $pooja_rt=$val['pooja_rt'];
                           $amt=$qlt*$pooja_rt;
				           $total=$total+$amt;
                           $amt=$val['amount'];
				        ?>
                      
                       <tr>
                         <td class="description">
                             <?php echo strtoupper($val['name']);?>-(<?php echo $val['star_eng'];?>) |
                             <?php echo $val['pooja_nm'];?><br>
                             (<?php echo $qlt;?> * <?php echo $pooja_rt;?>) | <?php print_r(date('d-m-Y',strtotime($val['date'])));?><br>
                         </td>
                         <td class="price right"><?php echo $amt;?></td>
                      </tr>
                      <tr>
                      	<td colspan="2"> 
                        <?php if($token): ?>
            				<strong style="text-align: left;margin-bottom:1cm;float:left;font-size:16px;">Token: <?= $token ?? ''; ?> </strong>
            			<?php endif; ?> 
                        </td>
                      </tr>
                     <?php } ?>
                    </tbody>
                    
                  </table>
               <?php } } ?>
                <table>
                    <tr>  
                       <td class="description"><b>Total</b></td>
                       <td class="price right"><b><?php echo $total; ?></b></td>
                    </tr>
                </table>
            <p class="centered">For Online Pooja booking
                <br><?php print_r($temple_list[0]['website'])?></p>
               <hr>
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