<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Search </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary">Back&nbsp;&nbsp;<i class="fa fa-left-arrow" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 ">
       <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
       	 <div class="col-lg-12 col-md-12 col-sm-12 ">
              <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
          </div>      
          <div class="col-lg-8 col-md-8 col-sm-8 ">
              <form  action="<?php echo base_url();?>index.php/admin/admin/cust_search" method="post">
                <div class="input-group">
                  <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" style="margin:10px 0;">
                  <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                  <div class="input-group-append" style="margin:10px 0;">
                    <button type="submit" class="btn btn-outline-secondary" name="button" value="search" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
                </div>
              </form>
          </div>
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Remaining Quantity</th>
					  <th scope="col" width="">Amount</th>
					</tr>
				  </thead>
					<?php if(!empty($customer_list)){
	                      $i=0;
	                       foreach($customer_list as $val){
	                           $name=$val['name'];
	                           $pooja=$val['pooja'];
	                           $today=date('Y-m-d');
	                           $this->db->select('SUM(qlt) AS quantity,SUM(amount) AS total');
	                           $this->db->from('billing_dtls');
	                           $this->db->where('date>',$today);
	                           $this->db->where("name LIKE '%$name%'");
	                           $this->db->where('pooja', $pooja);
                               $query = $this->db->get()->row_array();
	                           ?>
				  <tbody id="myTable">
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $name; ?></strong></a></td>
					  <td><?= $val['pooja_nm']; ?></td>
					  <td><?= $query['quantity']; ?></td>
					  <td><?= $query['total']; ?></td>
                    </tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="9">No Data Found</td>
						  </tr>
				    <?php } ?>	 
				</table>
             </div>
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