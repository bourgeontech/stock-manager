  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Dittum</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dittum_mstr" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Dittum</h2>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/dittum_summary" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <select name="product" id="product" class="form-control" required  style="margin:10px 0;">
                        <option value="">Select Product</option>
                        <option value="0">All</option>
                        <?php foreach($product_list as $val){ ?>
                        	<option value="<?= $val['id']; ?>" <?php if(isset($product)&&$product==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
                        <?php } ?>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
			  <div class="table-responsive" id="printer">
			  <?php 
			  if (isset($datef)&&isset($product)){
			  ?>
				<table class="table table-bordered table-hover" width="100%">
				  <thead>
<!-- 				  	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php// print_r($temple_list[0]['name']);?><br>
    					<?php// print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					</h4> -->
<!--     					</td> -->
<!--     				</tr> -->
					<tr><?php if ($product==0){?>
					  <th scope="col" width="">Product</th><?php }?>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">O/B</th>
					  <th scope="col" width="">Input</th>
                      <th scope="col" width="">Excess Inward</th>
					  <th scope="col" width="">Total</th>
                      <th scope="col" width="">Issue</th>
					  <th scope="col" width="">Usage</th>
					  <th scope="col" width="">Balance</th>
					</tr>
				  </thead>
				  <tbody>
                    <?php
                    if ($product!=0){
                    for ($date=$datef;$date<=$datet;$date=date('Y-m-d', strtotime($date. ' + 1 days'))){
                        $dit = $this->db->query("SELECT pooja_id,qty FROM `dittum` WHERE product_id='$product'")->result_array();
                        $total = 0;
                        $total1 = 0;
                        foreach($dit as $d){
                            $pid = $d['pooja_id'];
                            $dqty = $d['qty'];
                            $pqty=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' AND `date`='$date'")->row()->qty;
                            $pqty1=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' AND `date`<'$date'")->row()->qty;
                            $total = $total+$dqty*$pqty;
                            $total1 = $total1+$dqty*$pqty1;
                        }
                        $query2=$this->db->query("SELECT SUM(purchase_dtls.qty) as qty FROM `purchase_dtls` JOIN purchase ON purchase.id=purchase_dtls.ref_id WHERE purchase_dtls.product_id='$product' AND purchase.date='$date'")->row_array();
                        $query3=$this->db->query("SELECT SUM(qty) as qty FROM `stock` WHERE productid='$product' AND mode='OS'")->row_array();
                        $query4=$this->db->query("SELECT SUM(qty) as qty FROM `issue` WHERE product_id='$product' AND date='$date'")->row_array();
                        $query5=$this->db->query("SELECT SUM(purchase_dtls.qty) as qty FROM `purchase_dtls` JOIN purchase ON purchase.id=purchase_dtls.ref_id WHERE purchase_dtls.product_id='$product' AND purchase.date<'$date'")->row_array();
                        $query6=$this->db->query("SELECT qty as qty FROM `stock` WHERE productid='$product' and mode='AD'  and added_date='$date'")->row_array();   
                    	$query7=$this->db->query("SELECT qty FROM `stock` WHERE productid='$product' and mode='AD'  and added_date='$date' AND qty < 0")->row_array();   
                    
                    	$query8=$this->db->query("SELECT SUM(qty) as qty FROM `stock` WHERE productid='$product' and mode='IS'  and added_date like'$date%'")->row_array();   
                    	$query9=$this->db->query("SELECT SUM(qty) as qty FROM `stock` WHERE productid='$product' and mode='IS'  and added_date <'$date'")->row_array();  
                    	$adjust=$query6['qty'];
                    	$adjustob=$query7['qty'];
                    	$issueob=abs($query9['qty']);
                    	$issue=abs($query8['qty']);
                        $ob=$query5['qty']+$query3['qty']+$adjustob-($total1+$issueob);

                        $input=$query2['qty'];
                        $tot=$ob+$input+$adjust;
                        $usage=$total;
                        $bal=$tot-($usage+$issue);
                        $purchase=$query4['qty'];
                       ?> 
                    <tr>
                        <td><?php echo date('d-m-Y',strtotime($date));?></td>
                        <td><?php echo number_format((float)$ob, 2, '.', '');?></td>
                    	  <td><?php echo number_format((float)$input, 2, '.', '');?></td>
                       <td><?php echo number_format((float)$adjust, 2, '.', '');?></td>
                        <td><?php echo number_format((float)$tot, 2, '.', '');?></td>
                       <td><?php echo number_format((float)$issue, 2, '.', '');?></td>
                        <td><?php echo number_format((float)$usage, 2, '.', '');?></td>
                        <td><?php echo number_format((float)$bal, 2, '.', '');?></td>

                    </tr>
                    <?php 
                    }
                    }else{
                    $a=$this->db->query("SELECT id,name From inv_product");
                    $pro_ids=$a->result_array();
                    foreach ($pro_ids as $id){
                        $product=$id['id'];
                        $name=$id['name'];
                        for ($date=$datef;$date<=$datet;$date=date('Y-m-d', strtotime($date. ' + 1 days'))){
                            $dit = $this->db->query("SELECT pooja_id,qty FROM `dittum` WHERE product_id='$product'")->result_array();
                            $total = 0;
                            $total1 = 0;
                            foreach($dit as $d){
                                $pid = $d['pooja_id'];
                                $dqty = $d['qty'];
                                $pqty=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' AND `date`='$date'")->row()->qty;
                                $pqty1=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' AND `date`<'$date'")->row()->qty;
                                $total = $total+$dqty*$pqty;
                                $total1 = $total1+$dqty*$pqty1;
                            }
                            $query2=$this->db->query("SELECT SUM(purchase_dtls.qty) as qty FROM `purchase_dtls` JOIN purchase ON purchase.id=purchase_dtls.ref_id WHERE purchase_dtls.product_id='$product' AND purchase.date='$date'")->row_array();
                            $query3=$this->db->query("SELECT SUM(qty) as qty FROM `stock` WHERE productid='$product' AND mode='OS' OR mode='AD'")->row_array();
                            $query4=$this->db->query("SELECT SUM(qty) as qty FROM `issue` WHERE product_id='$product' AND date='$date'")->row_array();
                            $query5=$this->db->query("SELECT SUM(purchase_dtls.qty) as qty FROM `purchase_dtls` JOIN purchase ON purchase.id=purchase_dtls.ref_id WHERE purchase_dtls.product_id='$product' AND purchase.date<'$date'")->row_array();
                            $query6=$this->db->query("SELECT SUM(qty) as qty FROM `stock` WHERE productid='$product' and mode='AD'  and DATE(added_date)='$date' AND qty > 0")->row_array();
                        	
                        	$ob = $query5['qty']+$query3['qty']-$total1;
                            $input=$query2['qty'];
                            $tot=$ob+$input;
                            $usage=$total;	
                            $bal=$tot-$usage;
                            $purchase=$query4['qty'];
                        	$adjustment=$query6['qty'];
                        
                        	
                            ?>
                    <tr>
                    	<td><?php echo $name;?></td>
                        <td><?php echo date('d-m-Y',strtotime($date));?></td>
                        <td><?php echo number_format((float)$ob, 2, '.', '');?></td>
                    	<td><?php echo number_format((float)$input, 2, '.', '');?></td>
                        <td><?php echo number_format((float)$adjustment, 2, '.', '');?></td>
                        <td><?php echo number_format((float)$usage, 2, '.', '');?></td>
                    	<td></td>
                        <td><?php echo number_format((float)$bal, 2, '.', '');?></td>
                        <td><?php echo number_format((float)$purchase, 2, '.', '');?></td>
                    	
                    </tr>
                    <?php 
                    }
                    }
                    }
                    ?>
				  </tbody>
				</table>
				<?php 
			  }?>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script>
        function printcontend(value) {
        	var restorpage=document.body.innerHTML;
        	var printcontend=document.getElementById(value).innerHTML;
        	document.body.innerHTML=printcontend;
        	window.print();
        	document.body.innerHTML=restorpage;
        }
	</script>