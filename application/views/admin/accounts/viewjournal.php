
 <style>


.header {
  overflow: hidden;
  background-color: white;
  padding: 8px 4px;
}
.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}


.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: gray;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }

}
</style>

<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/accounts/addjournal" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;View Journal </h2>
              </div>
			 </div>	

<!-- SEARCH -->

<div class="row"> 
			  <div class="col-lg-4 col-md-4 col-sm-4 ">
                  <div class="input-group mb-3">
				  &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="search" value="" required placeholder="Search By Day" aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
			  </div>
			 </div>	<br><br>



	       <div class="table-responsive">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
                      <th scope="col" width="">LEDGER FROM</th>
					  <th scope="col" width="">LEDGER TO</th>
					  <th scope="col" width="">AMOUNT</th>
					  <th scope="col" width="">NARRATION</th>
                      <th scope="col" width="">DATE</th>
					  <th scope="col" width="">ACTION</th>
					</tr>
				  </thead>
					<?php if(!empty($payment)){
	                      $i=0;
	                       foreach($payment as $val){ 
                            $originalDate = $val['payment_date'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            $ledger_to=$val['led_to'];
                            $this->db->select('name');
                            $this->db->from('ledger');
                            $this->db->where('led_Id', $ledger_to);
                            $query = $this->db->get()->row_array();
                            $led_to=$query['name'];
                               ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['name']; ?></strong></a></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $led_to; ?></strong></a></td>
					  <td><span style="text-transform: capitalize;font-size: 12px;"><?= $val['amount']; ?></span></td>
                      <td><span style="text-transform: capitalize;font-size: 12px;"><?= $val['narration']; ?></span></td>
                      <td><?= $newDate; ?></td>
					  <td><div class="btn-group">
<!-- 						  <a href="<?php echo base_url(); ?>index.php/accounts/printjournal/<?= $val['pay_Id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Print"> <i class="fa fa-print"></i></a> 
                          &nbsp;&nbsp;&nbsp;&nbsp; -->
						  <a href="<?php echo base_url(); ?>index.php/accounts/deletejournal/<?= $val['pay_Id']; ?>"  onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
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