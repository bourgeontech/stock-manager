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
					<tr>
                      <?php if ($product==0){?>
					  <th scope="col" width="">Product</th>
                      <?php }?>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">O/B</th>
					  <th scope="col" width="">Input</th>
                      <th scope="col" width="">Excess Inward</th>
					  <th scope="col" width="">Total</th>
                      <th scope="col" width="">Issue</th>
					  <th scope="col" width="">Usage</th>
					  <th scope="col" width="">Balance</th>
                      <th scope="col" width="">Remarks</th>
					</tr>
				  </thead>
				  <tbody>
                    <?php
                    if ($product!=0){
                    for ($date=$datef;$date<=$datet;$date=date('Y-m-d', strtotime($date. ' + 1 days'))){
                    
                    
                    	$this->db->select('SUM(qty) as qty');
                    	$this->db->from('stock');
                    	$this->db->where('DATE(added_date) <', $date);
                    	$this->db->where('productid', $product);
                    	$this->db->where('mode !=', 'PU');
                    	$this->db->where('mode !=', 'DT');
                    	$opening = $this->db->get()->row()->qty;
                    	
                    	
                    	$this->db->select('SUM(qty) as qty,supplier.name as sname,purchase.invoice_no');
                    	$this->db->from('purchase_dtls');
                    	$this->db->join('purchase', 'purchase_dtls.ref_id=purchase.id');
                        $this->db->join('supplier', 'purchase.supplier_id=supplier.id');
                    	$this->db->where('purchase.date <', $date);
                    	$this->db->where('purchase_dtls.product_id', $product); 
                    	$result = $this->db->get()->row();
                    //echo $this->db->last_query();
                    	if ($result) {
                        $this->db->select('SUM(qty) as qty,supplier.name as sname,purchase.invoice_no');
                    	$this->db->from('purchase_dtls');
                    	$this->db->join('purchase', 'purchase_dtls.ref_id=purchase.id');
                        $this->db->join('supplier', 'purchase.supplier_id=supplier.id');
                    	$this->db->where('purchase.date =', $date);
                    	$this->db->where('purchase_dtls.product_id', $product); 
                    	$result1 = $this->db->get()->row();
    $purchase = $result->qty;
    $sname = $result1->sname;
    $invoice_no = $result1->invoice_no;
} else {
    $purchase = 0;
    $sname = null;
    $invoice_no = null;
}

                    
                    	
                    	// total opening for the date 
                        $this->db->select('SUM(qty) as qty');
                    	$this->db->from('purchase_dtls');
                    	$this->db->join('purchase', 'purchase_dtls.ref_id=purchase.id');
                    	$this->db->where('purchase.date', $date);
                    	$this->db->where('purchase_dtls.product_id', $product);
                    	$purchase_qty = $this->db->get()->row()->qty;
                    
                    	$this->db->select('SUM(qty) as qty');
                    	$this->db->from('stock');
                    	$this->db->where('DATE(added_date)', $date);
                    	$this->db->where('productid', $product);
                    	$this->db->where('mode', 'AD');
                    	$this->db->where('qty >', 0);
                    	$excess_inward = $this->db->get()->row()->qty;

                    
                    	$dit = $this->db->query("SELECT pooja_id,qty FROM `dittum` WHERE product_id='$product'")->result_array();
                        $usage = 0;
                        $total1 = 0;
                    	$pids = array();
                        foreach($dit as $d){
                            $pid = $d['pooja_id'];
                        	$pids[] = $pid;
                            $dqty = $d['qty'];
                       		                   
                            $pqty=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' AND `date`='$date'")->row()->qty;
                        	$pqty1=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' AND `date`<'$date'")->row()->qty;
                           
                        	$usage  += $dqty*$pqty;
                            $total1 += $dqty*$pqty1;
                        }

                  		$opening_balance = ($opening + $purchase) - ($total1);
                		$total			 = $opening_balance + $purchase_qty + $excess_inward;

                    	$this->db->select('SUM(qty) as qty');
                    	$this->db->from('stock');
                    	$this->db->where('DATE(added_date)', $date);
                    	$this->db->where('productid', $product);
                    	$this->db->where('mode', 'IS');
                    	$this->db->where('qty <', 0);
                    	$issue = abs($this->db->get()->row()->qty);
                    	$bal  = $total - ($issue + $usage);
                    	
                       ?> 
                    	<tr>
                        	<td><?php echo date('d-m-Y',strtotime($date));?></td>
                        	<td><?php echo number_format((float)$opening_balance, 3, '.', '');?></td>
                    	  	<td><?php echo number_format((float)$purchase_qty, 3, '.', '');?></td>
                       		<td><?php echo number_format((float)$excess_inward, 3, '.', '');?></td>
                        	<td><?php echo number_format((float)$total, 3, '.', '');?></td>
                       		<td><?php echo number_format((float)$issue, 3, '.', '');?></td>
                        	<td><?php echo number_format((float)$usage, 3, '.', '');?></td>
                        	<td><?php echo number_format((float)$bal, 3, '.', '');?></td>
                        <td><?php if($purchase_qty>0){echo @$sname."/".@$invoice_no;}?></td>
                    	</tr>
                    <?php 
                    }
                    }else{
					for ($date=$datef;$date<=$datet;$date=date('Y-m-d', strtotime($date. ' + 1 days'))){
                     $products = $this->db->query("SELECT product_id FROM `dittum` GROUP BY product_id")->result();
                     foreach($products as $product) {
                     	$product_id = $product->product_id;
                    	$this->db->select('SUM(qty) as qty');
                    	$this->db->from('stock');
                    	$this->db->where('DATE(added_date) <', $date);
                    	$this->db->where('productid', $product_id);
                    	$this->db->where('mode !=', 'PU');
                    	$opening = $this->db->get()->row()->qty;
                    
                    	$this->db->select('SUM(qty) as qty');
                    	$this->db->from('purchase_dtls');
                    	$this->db->join('purchase', 'purchase_dtls.ref_id=purchase.id');
                    	$this->db->where('purchase.date <', $date);
                    	$this->db->where('purchase_dtls.product_id', $product_id);
                    	$purchase = $this->db->get()->row()->qty;
                    
                    
                        $this->db->select('SUM(qty) as qty');
                    	$this->db->from('purchase_dtls');
                    	$this->db->join('purchase', 'purchase_dtls.ref_id=purchase.id');
                    	$this->db->where('purchase.date', $date);
                    	$this->db->where('purchase_dtls.product_id', $product_id);
                    	$purchase_qty = $this->db->get()->row()->qty;
                    
                    	$this->db->select('SUM(qty) as qty');
                    	$this->db->from('stock');
                    	$this->db->where('DATE(added_date)', $date);
                    	$this->db->where('productid', $product_id);
                    	$this->db->where('mode', 'AD');
                    	$this->db->where('qty >', 0);
                    	$excess_inward = $this->db->get()->row()->qty;

                    
                    	$dit = $this->db->query("SELECT pooja_id,qty FROM `dittum` WHERE product_id='$product_id'")->result_array();
                        $usage = 0;
                        $total1 = 0;
                        foreach($dit as $d){
                            $pid = $d['pooja_id'];
                            $dqty = $d['qty'];
                            $pqty=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' AND `date`='$date'")->row()->qty;
                            $pqty1=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' AND `date`<'$date'")->row()->qty;
                            
                        	$usage = $usage + $dqty*$pqty;
                            $total1 = $total1 + $dqty*$pqty1;
                        }
                    
                    	$opening_balance = $opening + $purchase - $total1;
                    
                    	$total			 = $opening_balance + $purchase_qty + $excess_inward;

                    	$this->db->select('SUM(qty) as qty');
                    	$this->db->from('stock');
                    	$this->db->where('DATE(added_date)', $date);
                    	$this->db->where('productid', $product_id);
                    	$this->db->where('mode', 'AD');
                    	$this->db->where('qty <', 0);
                    	$issue = $this->db->get()->row()->qty;
                    	
                    	
                    	$bal 			 = $total - ($issue + $usage);
                    	
                       ?> 
                    	<tr>
                        	<td><?php echo date('d-m-Y',strtotime($date));?></td>
                        	<td><?php echo number_format((float)$opening_balance, 3, '.', '');?>ee</td>
                    	  	<td><?php echo number_format((float)$purchase_qty, 3, '.', '');?></td>
                       		<td><?php echo number_format((float)$excess_inward, 3, '.', '');?></td>
                        	<td><?php echo number_format((float)$total, 3, '.', '');?></td>
                       		<td><?php echo number_format((float)$issue, 3, '.', '');?></td>
                        	<td><?php echo number_format((float)$usage, 3, '.', '');?></td>
                        	<td><?php echo number_format((float)$bal, 3, '.', '');?></td>
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