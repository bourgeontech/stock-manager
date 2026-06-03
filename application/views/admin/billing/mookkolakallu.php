  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Mookkolakallu Register</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/schedule" class="btn btn-primary">Schedule&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Mookkolakallu </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing_view" class="btn btn-primary">Billing View</a> </li>
                  </ul>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>  
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/mookkolakallu" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                     <input type="text" class="form-control" value="<?php if(isset($key)){echo $key;}else{echo "";}?>" name="key" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-danger" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
<!--                         <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button> -->
<!--                         <button type="submit" class="btn btn-outline-secondary" name="serch" value="summary" title="Print Summary"><i class="fa fa-file" aria-hidden="true"></i></button> -->
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
                      <th scope="col" width="">Bill No</th>
                      <th scope="col" width="">Booked For </th>
					  <th scope="col" width="">Name</th>
                      <th scope="col" width="">Birth Star</th>
					  <th scope="col" width="">Address</th>
					</tr>
				  </thead>
					<?php 
                        if(!empty($kallu_list)){
						$i=0;
						foreach($kallu_list as $val){
						    $customer=$val['customer'];
						    $this->db->select('*');
						    $this->db->from('user_dtl');
						    $this->db->where('id', $customer);
						    $query1 = $this->db->get()->result_array();
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
			 		  <td><?= date('d-m-Y',strtotime($val['booked_date'])); ?></td>
                      <td><?= $val['bill_id']; ?></td>
                      <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					 <td><?= $val['name']; ?></td>
                     <td><?= $val['star_eng']; ?></td>
					 <td><?php if(!empty($query1)){ echo $query1[0]['house']." , ".$query1[0]['street']." , ".$query1[0]['post']." , ".$query1[0]['district'];}?></td> 
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