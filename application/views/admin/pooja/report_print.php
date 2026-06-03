<html>
	<head>

    <style>
	@media print {
      
      tfoot {
        display: table-row-group; /* Show the tfoot on every page */
      }
      
      @page :last {
        tfoot {
          display: table-footer-group; /* Show the tfoot only on the last page */
        }
      }
    
      thead {
        display: table-row-group; /* Show the tfoot on every page */
      }
      
      @page :first {
        thead {
          display: table-header-group; /* Show the tfoot only on the last page */
        }
      }
    }
    @page {
    	margin: 2cm;
    	
	}
	        th , td{
	            padding:5px;
	        }
  </style>

	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<div class="table-responsive" id="printer" onafterprint="myFunction()">
				<table border="1" style="border-collapse:collapse;width:100%;">
                	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;margin-bottom:2px;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?> <br>  <br> 					
                        <?php print_r($temple_list[0]['phone']);?></h4>

    					</td>
    				</tr>
    				<tr>
    					<th colspan="5"><label style="text-align:center;">Muthalkootu Report From : <?php echo date('d-m-Y',strtotime($datef));?></label>
    					    <label style="float:center;">To : <?php echo date('d-m-Y',strtotime($datet));?></label>
    				    </th>
                    	<th colspan="5">
                         <p> Generated On
                        <?php
							$date = date('d-m-y h:i:s');
							echo  $date;
							?>
                        </p>
                    	</th>
    				</tr>
              	</table>
				<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
				  <thead>
					<tr>
					  <th scope="col" width="">പൂജ</th>		
                    <th scope="col" width="">എണ്ണം </th>         
                    <th scope="col" width="">നിരക്ക് </th>
                    <th scope="col" width="">സംഖ്യ </th>
                    <th scope="col" width="">േവസ്വം ഫണ്ട്  </th>
                    <th scope="col" width="">സാധനവില</th>
                    <th scope="col" width="">അവകാശ വിഹിതം  </th>

					</tr>
				  </thead> 
				  <?php if($muthalkootu_list != 0): ?>
                
                	<tbody>
                    <?php 
                      $grandtotal_pooja_rate = 0;
                      $grandtotal_muthalkootu = 0;
                      $grandtotal_product = 0;
					  $grandtotal_kooru = 0;

                    
                    
                    
                      foreach($muthalkootu_list as $key => $val){
                     
                           //  $this->db->select('SUM(dittum.qty * inv_product.price) as product_rate');
                           //  $this->db->from('dittum');
                           //  $this->db->join('inv_product','dittum.product_id = inv_product.id');
                           // // $this->db->join('kooru_mng','dittum.pooja_id = kooru_mng.pooja_id');
                           //  $this->db->where('dittum.pooja_id',$val['pooja_id']);
                           //  $query = $this->db->get()->result_array();
                      $product_rate = $val['pooja_cost'];
                      $pooja_count =$val['pooja_count'];
                      $total_product_rate = $product_rate * $pooja_count;
                      $grandtotal_pooja_rate +=   $val['pooja_rate'] * $pooja_count;
                      $grandtotal_muthalkootu += $val['allocated_rate']* $pooja_count;
                      $grandtotal_product += $total_product_rate;

                      
                      $this->db->select('sum(kooru_mng.rate) as kooru_rate');
                            $this->db->from('kooru_mng');
                           
                           // $this->db->join('kooru_mng','dittum.pooja_id = kooru_mng.pooja_id');
                            $this->db->where('kooru_mng.pooja_id',$val['pooja_id']);
                            $query2 = $this->db->get()->result_array();
                      $kooru_rate=$query2['0']['kooru_rate'];
                      $grandtotal_kooru += $kooru_rate * $pooja_count;
                    ?>
                    
                        <tr>
                            <td><?= $val['pooja_name']; ?></td>
                       	 	<td><?= $val['pooja_count']; ?></td>
                            <td><?= number_format((float)$val['pooja_rate'], 2, '.', '');?> </td>
                       	 	<td><?= number_format((float)$val['pooja_rate']*$val['pooja_count'], 2, '.', '');?> </td>
                            <td><?= number_format((float)$val['allocated_rate']*$val['pooja_count'], 2, '.', '');?> </td>
                            <td><?= number_format((float)$total_product_rate, 2, '.', '');?> </td>
                            <td><?= number_format((float)$kooru_rate*$val['pooja_count'], 2, '.', '');?> </td>

                        </tr>
                    <?php 
                      
                    }
                    ?>
				  </tbody>
                
                 <?php else: ?>
                <tbody>
                <tr><td colspan="11" class="text-center"><h6>No data found!</h6></td></tr>
                </tbody>
                <?php endif; ?>
                <tfoot>
                	<tr> 
                    	<th>Total </th>
                    	<th> </th>
                    	<th> </th>
                        <th> <?= number_format((float)$grandtotal_pooja_rate, 2, '.', '');?></th>
                        <th> <?= number_format((float)$grandtotal_muthalkootu, 2, '.', '');?></th>
                        <th> <?= number_format((float)$grandtotal_product, 2, '.', '');?></th>
                        <th> <?= number_format((float)$grandtotal_kooru, 2, '.', '');?></th>

                	</tr>
                
                </tfoot>
				</table>
             </div>
    </div>
	</body>
</html>
<script>
    $(document).ready(function () {
        $('table thead th').each(function (i) {
            if(i!=0&&i!=1){
            	calculateColumn(i);
            }
        });
    });
    function calculateColumn(index) {
        var total = 0;
        $('table tr').each(function () {
            var value = parseFloat($('td', this).eq(index).text());
            if (!isNaN(value)) {
                total += value;
            }
        });
        $('table tfoot th').eq(index).text(total.toFixed(2));
    }
</script>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/pooja/muthalkootu_report" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/pooja/muthalkootu_report";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
