<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Muthalkootu Report</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/pooja_muthalkootu" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
    <body onafterprint="viewaction()">
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Muthalkootu Report</h2>
              </div>
<!--               <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: right;">
                  <button class="btn btn-outline-secondary page_txt" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
              </div>       -->
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/pooja/muthalkootu_report" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <select class="form-control" name="pooja_category_id" style="margin:10px 0; border-radius:0">
                        <option value="">----- All -----</option>
                      	<?php foreach($pooja_cat as $cat): ?>
                      	<option value="<?= $cat['id'] ?>" <?php if(isset($category_id) && $category_id == $cat['id']){echo 'selected';}?>><?= $cat['name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
<!--      onafterprint="myFunction()"      -->
	          <div class="table-responsive" id="printer" >
              	<table class="table table-bordered table-hover text-nowrap" width="100%">
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
				<table class="table table-bordered table-hover" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">പൂജ</th>		
                    <th scope="col" width="">എണ്ണം </th>         
                    <th scope="col" width="">നിരക്ക് </th>
                    <th scope="col" width="">സംഖ്യ </th>
                    <th scope="col" width="">ദേവസ്വം ഫണ്ട് </th>
                    <th scope="col" width="">സാധനവില </th>
                    <th scope="col" width="">അവകാശ വിഹിതം</th>
					</tr>
				  </thead> 
				  <?php
                	  $grandtotal_pooja_rate = 0;
                      $grandtotal_muthalkootu = 0;
                      $grandtotal_product = 0;
					  $grandtotal_kooru = 0;
                	if($muthalkootu_list != 0): ?>
                
                	<tbody>
                    <?php 
                      

                    
                    
                    
                      foreach($muthalkootu_list as $key => $val){
                     
                           //  $this->db->select('SUM(dittum.qty * inv_product.price) as product_rate');
                           //  $this->db->from('dittum');
                           //  $this->db->join('inv_product','dittum.product_id = inv_product.id');
                           // // $this->db->join('kooru_mng','dittum.pooja_id = kooru_mng.pooja_id');
                           //  $this->db->where('dittum.pooja_id',$val['pooja_id']);
                           //  $query = $this->db->get()->result_array();
                      		$product_rate = $val['pooja_cost'];
                      		$pooja_count =$val['pooja_count'];
                      		$total_product_rate = number_format((float)$product_rate, 2, '.', '') * $pooja_count;
                      		$grandtotal_pooja_rate +=   ($val['pooja_rate'] == 0 ? $val['amount'] : $val['pooja_rate']* $pooja_count) ;
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
                       	 	<td><?= number_format((float)($val['pooja_rate'] == 0 ? $val['amount'] : ($val['pooja_rate']*$val['pooja_count'])), 2, '.', '');?> </td>
                            <td><?= number_format((float)$val['allocated_rate'], 2, '.', '')*$val['pooja_count'];?> </td>
                            <td><?= number_format((float)$total_product_rate, 2, '.', '');?> </td>
                            <td><?= number_format((float)$kooru_rate, 2, '.', '')*$val['pooja_count'];?> </td>
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
          </div>
	    </div>
	    </body>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script>
        function printcontend(value) {
        	$(".action").css("display", "none");
        	var restorpage=document.body.innerHTML;
        	var printcontend=document.getElementById(value).innerHTML;
        	document.body.innerHTML=printcontend;
        	window.print();
        	document.body.innerHTML=restorpage;
        }
        function viewaction(){
        	$(".action").removeAttr('style');;
        }
</script>