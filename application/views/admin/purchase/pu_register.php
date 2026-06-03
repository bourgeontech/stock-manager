  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Purchase Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/purchase" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Purchase Register</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/pu_register" class="btn btn-secondary">Purchase Register</a> </li>
                  </ul>
                  <ul class="btn_ul" style="float:right;">
                  	<li> <a href="<?php echo base_url();?>index.php/admin/admin/pu_summary" class="btn btn-primary">Purchase Summary</a> </li>
                  </ul>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/pu_register" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <select id="supplier" name="supplier" class="form-control" style="margin:10px 0;">
                          <option value="">Select Supplier</option>
                          <?php foreach($supplier as $val){ ?>
            				<option value="<?= $val['id']; ?>" <?php if(isset($suppl)&&$suppl==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
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
	         <?php if(isset($purchase_list)){?>
			  <div class="table-responsive" id="printer">
				<table class="table table-bordered text-nowrap" width="100%">
				  <thead>
				  	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					Purchase Register For the Period <?php if (isset($datef)){echo date('d-m-Y',strtotime($datef));}?> to <?php if (isset($datet)){echo date('d-m-Y',strtotime($datet));};?></h4>
    					</td>
    				</tr>
					<tr>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Supplier</th>
					  <th scope="col" width="">Item Name</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" width="">Unit</th>
					  <th scope="col" width="">Rate</th>
					  <th scope="col" width="">Tax </th>
					  <th scope="col" width="">Total </th>
					</tr>
				  </thead>
				  <tbody>
				  <?php 
				  $sub=0;
				  if(!empty($purchase_list)){
				  foreach($purchase_list as $val){
				      $id=$val['purchase_id'];
				      $name=$val['name'];
				      $sup_id=$val['sup_id'];
				      $date=$val['date'];
   				      $this->db->select('purchase_dtls.*,inv_product.name as pro,inv_product.price,inv_unit.name as unit_nm');
				      $this->db->from('purchase_dtls');
				      $this->db->join('inv_product','inv_product.id = purchase_dtls.product_id');
				      $this->db->join('inv_unit','inv_unit.id = purchase_dtls.unit');
				      $this->db->where('purchase_dtls.ref_id', $id);
				      $purchase = $this->db->get()->result_array();
				      $rowspan=sizeof($purchase);
				      ?>
				      <tr>
					   <td rowspan="<?php echo $rowspan;?>"><?= date('d-m-Y',strtotime($date)); ?></td>
					   <td rowspan="<?php echo $rowspan;?>"><a href="<?php echo base_url();?>index.php/admin/admin/su_purchase/<?php echo $sup_id;?>"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $name; ?></strong></a></td>
				      <?php
				      $total=0;
				      foreach($purchase as $key=>$pur){
				          $total=$total+$pur['sub_tot'];
				          if ($key!=0){
				            echo "<tr>";   
				          }
				  ?>
					 <td><?= $pur['pro']; ?></td>
					 <td><?= $pur['qty']; ?></td>
					 <td><?= $pur['unit_nm']; ?></td>
					 <td><?= $pur['price']; ?></td>
					 <td style="text-align: right;"><?= $pur['tax']; ?></td>
					 <td style="text-align: right;"><?= $pur['sub_tot']; ?></td>
					</tr>
					<?php 
				      }
				      ?>
				    <tr>
						<th></th>
						<th colspan="6">Total</th>
						<th style="text-align: right;"><?php echo $total;?></th>
					</tr>
					<tr>
						<td colspan="9"></td>
					</tr>
				      <?php 
				      $sub=$sub+$total;
				  }
				  }else {
					?>
					<tr>	
						<td colspan="9" style="text-align:center;">No Data Found!</td>
					</tr>	
					<?php } ?>
				  </tbody>
					<tfoot>
						<tr>
							<th colspan="7">Grand Total</th>
							<th style="text-align: right;"><?php echo $sub;?></th>
						</tr>
					</tfoot>
				</table>
             </div>
             <?php }?>
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