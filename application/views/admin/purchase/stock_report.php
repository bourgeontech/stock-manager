  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Stock Report</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;View Stock Report </h2>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="<?php echo base_url();?>index.php/admin/admin/stock_report" method="post" class="form-inline" style="margin-bottom:10px;">
                  <select name="store_id" class="sq_form" style="width:auto;display:inline-block;margin-right:5px;">
                    <option value="">All Stores</option>
                    <?php if(isset($store_list) && !empty($store_list)){ foreach($store_list as $s){ ?>
                    <option value="<?php echo $s['store'];?>" <?php if(isset($store_id) && $store_id==$s['store']) echo 'selected';?>><?php echo $s['name'];?></option>
                    <?php }} ?>
                  </select>
                  <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </form>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9">
              </div>
    			 <div class="col-lg-3 col-md-3 col-sm-3">
              		<input id="myInput" type="text" class="sq_form" placeholder="Search..">
              </div>
			 </div>
	         <?php if(isset($stock_list)){?>
			  <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Product</th>
					  <th scope="col" width="">Available Qty</th>
                    <th scope="col" width="">Usage as per Dittum</th>
					</tr>
				  </thead>
					<?php 
					if(!empty($stock_list)){
						$i=0;
						foreach($stock_list as $val){
                       		$product = $val['pro_id'];
                        	
                        	$query = $this->db->select('inv_unit.name as name')->from('inv_unit')->join('inv_product', 'inv_product.unit=inv_unit.id')->where('inv_product.id', $product)->get();
                            $unit  = $query->row()->name ?? '';
                        
                        	$dit = $this->db->query("SELECT pooja_id,qty FROM `dittum` WHERE product_id='$product'")->result_array();
                            $total = 0;
                            $total1 = 0;
                            foreach($dit as $d){
                                $pid = $d['pooja_id'];
                                $dqty = $d['qty']; if($dqty==''){$dqty=0;}
                                $pqty=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid'")->row()->qty;
                            if($pqty==''){$pqty=0;}
                              //  $pqty1=$this->db->query("SELECT SUM(qlt) as qty FROM `billing_dtls` WHERE pooja='$pid' ")->row()->qty;
                            //print $total ."-"."<br>";    
                            $total = (int)($total+($dqty*$pqty));
                                //$total1 = $total1+$dqty*$pqty1;
                            }
	                        ?>
				  <tbody id="myTable">
					<tr>
					  <td><?php echo ++$i; ?></td>
					  <td><a href="<?php echo base_url();?>index.php/admin/admin/stock_dets/<?php echo $val['pro_id'];?>"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?php echo $val['name']; ?></strong></a></td>
					  <td><?php echo round($val['qty'],2)." ".$unit; ?></td>
                    <td><?php echo @$total; ?></td>
					</tr>
					</tr>
				  </tbody>
					<?php 
	                    } }
                     else {
					?>	
					<tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
