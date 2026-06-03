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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Purchase Summary</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/pu_register" class="btn btn-primary">Purchase Register</a> </li>
                  </ul>
                  <ul class="btn_ul" style="float:right;">
                  	<li> <a href="<?php echo base_url();?>index.php/admin/admin/pu_summary" class="btn btn-secondary">Purchase Summary</a> </li>
                  </ul>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/pu_summary" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($datef)){?>
			  <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
				  	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					Purchase Summary For the Period <?php if (isset($datef)){echo date('d-m-Y',strtotime($datef));}?> to <?php if (isset($datet)){echo date('d-m-Y',strtotime($datet));};?></h4>
    					</td>
    				</tr>
					<tr>
					  <th scope="col" width="">Sl No</th>
					  <th scope="col" width="">Item Name</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" width="">Total </th>
					</tr>
				  </thead>
				  <tbody>
				  <?php 
   				      $this->db->select('purchase_dtls.*,inv_product.name as pro,inv_product.price,inv_unit.name as unit_nm');
				      $this->db->from('purchase_dtls');
				      $this->db->join('inv_product','inv_product.id = purchase_dtls.product_id');
				      $this->db->join('purchase','purchase.id = purchase_dtls.ref_id');
				      $this->db->join('inv_unit','inv_unit.id = purchase_dtls.unit');
				      $this->db->where("purchase.date BETWEEN '$datef' AND '$datet'");
				      $this->db->group_by('purchase_dtls.product_id');
				      $purchase = $this->db->get()->result_array();
				      $i=0;
				      $total=0;
				      foreach($purchase as $pur){
				          $tot=$pur['qty']*$pur['price'];
				          $total=$total+$tot;
				  ?>
					<tr>
					 <td><?= ++$i; ?></td>
					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $pur['pro']; ?></strong></a></td>
					 <td><?= $pur['qty']." . ".$pur['unit_nm']; ?></td>
					 <td><?= $tot; ?></td>
					</tr>
					<?php 
				      }
					?>
				  </tbody>
				  <tfoot>
				  	<tr>
				  		<th colspan="3">Total</th>
				  		<th><?php echo $total;?></th>
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