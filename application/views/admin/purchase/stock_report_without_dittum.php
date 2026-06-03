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
              <div class="col-lg-9 col-md-9 col-sm-9">
                  </div>
    			 <div class="col-lg-3 col-md-3 col-sm-3">
              		<input id="myInput" type="text" class="sq_form" placeholder="Search..">
              </div>
			 </div>
          	<div class="col-lg-12 col-md-12 col-sm-12 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/stock_report" method="post">
                  	<?php 
                  	$role=$this->loggedIn['role'];
                  	?>
                    <div class="input-group">
                      
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="summary" title="Print Summary"><i class="fa fa-file" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
	         <?php if(isset($stock_list)){?>
			  <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Product</th>
                      <th scope="col" width="">Opening</th>
                      <th scope="col" width="">Nadavaravu</th>
                      <th scope="col" width="">Sales</th>
					  <th scope="col" width="">Balance</th>
					</tr>
				  </thead>
					<?php 
					if(!empty($stock_list)){
						$i=0;
						foreach($stock_list as $val){

//                        	$product=$val['pro_id'];
//                         $this->db->select_sum('qty');
// 						$this->db->where('productid', $product);
// 						$this->db->where('added_date >=', $datef);
// 						$this->db->where('added_date <=', $datet);
// 						$query = $this->db->get('stock');

// 						if ($query->num_rows() > 0) {
//     						$result = $query->row_array();
//     						$sumQuantity = $result['qty'];
// 						} else {
//     						$sumQuantity = 0;
// 						}
                        
                        
                        $product=$val['pro_id'];
                        $this->db->select_sum('qty');
						$this->db->where('productid', $product);
						$this->db->where('date(added_date) <', $datef);
						$opening_query = $this->db->get('stock');

						if ($opening_query->num_rows() > 0) {
    						$result = $opening_query->row_array();
    						$opening = $result['qty'];
						} else {
    						$opening = 0;
						}
                        
                        $this->db->select_sum('qty');
						$this->db->where('productid', $product);
						$this->db->where('date(added_date) >=', $datef);
						$this->db->where('date(added_date) <=', $datet);
						$this->db->where('qty <', 0); // Include only rows where qty is negative
						$debit_query = $this->db->get('stock');

						if ($debit_query->num_rows() > 0) {
    						$result = $debit_query->row_array();
    						$debit = $result['qty'];
						} else {
    						$debit = 0;
						}
                        						
                        $this->db->select_sum('qty');
						$this->db->where('productid', $product);
						$this->db->where('date(added_date) >=', $datef);
						$this->db->where('date(added_date) <=', $datet);
						$this->db->where('qty >', 0);
						$credit_query = $this->db->get('stock');
						
						if ($credit_query->num_rows() > 0) {
    						$result = $credit_query->row_array();
    						$credit = $result['qty'];
						} else {
    						$credit = 0;
						}
                      
                        $sumQuantity = $opening + $credit - abs($debit);
                        // exit;
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
					  <td><?php echo round($opening,2); ?></td>
                      <td><?php echo round($credit,2); ?></td>
                      <td><?php echo round($debit,2); ?></td>
                      <td><?php echo round($sumQuantity,2); ?></td>
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
