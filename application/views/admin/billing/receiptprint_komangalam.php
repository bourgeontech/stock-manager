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

.ticket {
    width: 294.803px;
    max-width: 294.803px;
}

img {
    max-width: inherit;
    width: inherit;
}
.container {
  width:100% !important;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.container img {
  height: 20px; /* Adjust the height as needed */
}

.middle-content {
  flex: 1;
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
               $total='0';$grandtotal='0';
		       $site_settings=$this->site_model->settings();
  				$fields = $this->db->list_fields('pooja');
				$field_name = 'pooja_style';

				$site_settings_fields = $this->db->list_fields('site_settings');
		        foreach($bill_details as $bill) { 
             	
        	    if(sizeof($bill)>0){ ?>
        			<p class="centered">
       					<?php  if($site_settings['bill_image']!=''){?> <img src="<?= $site_settings['bill_image']; ?>" style="height: 1.5cm;width: auto;" alt="Image 1" />
       					<?php } ?> 
                    	<br />
                    	<?php if(in_array('tagline', $site_settings_fields) && $site_settings['tagline']!=''){ print_r($site_settings['tagline']);}?>
        			</p>

            <p class="centered">
           
                <b><?php print_r($temple_list[0]['name']);?></b>
                <br><?php print_r($temple_list[0]['address']);?>
                <br><?php print_r($temple_list[0]['location']);?>
            	<?php if(in_array('affiliation', $site_settings_fields) && $site_settings['affiliation']!=''){ print_r("( ".$site_settings['affiliation']." )");}?>
            </p>
            <table>
                 <tr>
                    <tr>
                       <th class="left">Bill - <?php print_r($bill_list[0]['bill_id'] ?? $bill_list[0]['id']);?> </th>
                       <th class="right">Date : <?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></th>
                    </tr>
                    <tr>
                      <th class="description">വഴിപാട്</th>
                      <th class="price right">തുക</th>
                    </tr>
            </table>
            <hr>
                    <table>
                     <caption><b><?php print_r($bill[0]['diety_ne']);?></b></caption>
                     <tbody>
                       <?php
				        
                        // $bstatus=$query['0']['bstatus'];
				        foreach($bill as $val){ 
				           $qlt=$val['qlt'];
				           $pooja_rt=$val['pooja_rt'];
                            if($pooja_rt > 0) { $amt=$qlt*$pooja_rt; }
                           else { $amt=$val['amount']; }
                           $total=$total+$amt;
						   $token = $val['token'];
				        ?>
                      
                       <tr>
                         <td class="description">
                             <?php echo strtoupper($val['name']);?>-(<?php echo $val['star_eng'];?>) |
                          
                         	 <?php if (in_array($field_name, $fields) && $val['pooja_style']) {
                         			$pooja_style = $val['pooja_style'];
                        			// Split the string into individual styles
									$styles = explode(",", $pooja_style);
									$output = '';

// Check each style and add corresponding HTML tags
foreach ($styles as $style) {
    if ($style === 'italics') {
        $output .= '<em>';
    } elseif ($style === 'bold') {
        $output .= '<strong>';
    }
}

// Your content here
$output .= $val['pooja'];

// Close HTML tags based on the styles
for ($i = count($styles) - 1; $i >= 0; $i--) {
    if ($styles[$i] === 'italics') {
        $output .= '</em>';
    } elseif ($styles[$i] === 'bold') {
        $output .= '</strong>';
    }
}

// Output the result
echo $output;
                             ?>
						     <?php } else { ?>
                         		<?php echo $val['pooja_ne']; ?>
                         	 <?php } ?>
                             <br>
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
        		  <table>
                    <tr>  
                       <td class="description"><b>Total</b></td>
                       <td class="price right"><b><?php echo $total; ?></b></td>
                    </tr>
                </table>
        		<p class="centered">For Online Pooja booking
                <br><?php print_r($temple_list[0]['website'])?></p>
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