<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/accounts/addPayment" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;View Payment </h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header">
  <div class="header-right">
  
   </div>
   </div>
        </div>
			 </div>	

<!-- SEARCH -->

<div class="row"> 
			  <div class="col-lg-4 col-md-4 col-sm-4 ">
                  <form action="<?php echo base_url();?>index.php/accounts/searchPayment" method="post">
                  <div class="input-group mb-3">
				  &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="search" value="<?php if(@$datefrom!='') { echo $datefrom; } ?>" required placeholder="Search By Day" aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
				  <input type="date" class="form-control" name="searchto" value="<?php if(@$dateto!='') { echo $dateto; } ?>" required placeholder="Search By Day" aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
			  </div>
               <div class="col-lg-4 col-md-4 col-sm-4 ">
                  <form action="<?php echo base_url();?>index.php/accounts/searchPayment" method="post">
                  <div class="input-group mb-3">
				  <!-- <input type="text" class="form-control" name="keyword" value="" required placeholder="Search By Ledger Name" aria-label="Search Ledger Name" aria-describedby="basic-addon2"> -->
          <select name="keyword" class="form-control" aria-label="Search Ledger Name" aria-describedby="basic-addon2">
                                	<option value="">Search By Ledger Name</option>
                    			<?php foreach($ledger as $val){ ?>  
                    				<option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>     
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
			  </div>
			  <div class="col-lg-2 col-md-2 col-sm-2 ">
                <!-- <a href="<?php echo base_url();?>index.php/accounts/viewPayment" class="btn btn btn-outline-secondary" style="font-size: 18px;"><i class="fa fa-list-ul" aria-hidden="true"></i> View All</a> -->
                <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>index.php/accounts/viewPayment/all" class="btn btn btn-outline-secondary">View All&nbsp;&nbsp;<i class="fa fa-list-ul" aria-hidden="true"></i></a> </li>
          </ul>  
              </div>
			  <!-- <div class="col-lg-2 col-md-2 col-sm-2 text-right">
                <a href="<?php echo base_url();?>admin/admin/exportAttendanceExcel" class="btn btn btn-outline-success" style="font-size: 18px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a>
              </div> -->
			 </div>	<br><br>



	       <div class="table-responsive">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
                      <th scope="col" width="">LEDGER NAME</th>
            <th scope="col" width="">AMOUNT</th>
            <th scope="col" width="">MODE</th>
					  <th scope="col" width="">NARRATION</th>
                      <th scope="col" width="">DATE</th>
					  <th scope="col" width="">ACTION</th>
					</tr>
				  </thead>
					<?php 
                  $role=$this->loggedIn['role'];
                if(!empty($payment)){
	                      $i=0;
	                       foreach($payment as $val){ 
                            $originalDate = $val['payment_date'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            $mo=$val['mode']; 
            				//$query = $this->db->query("SELECT * FROM ledger WHERE led_Id='$mo'")->result();
                           
                           $query = $this->db->query("SELECT * FROM ledger WHERE led_Id='$mo'");

$row = $query->row(); 
            				//$sql="select name from ledger where led_id=$mo";
                           //srint $sql;
                               ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['name']; ?></strong></a></td>
            <td><span style="text-transform: capitalize;font-size: 12px;"><?= $val['amount']; ?></span></td>
            <td><span style="text-transform: capitalize;font-size: 12px;"><?= $row->name; ?></span></td>
                      <td><span style="text-transform: capitalize;font-size: 12px;"><?= $val['narration']; ?></span></td>
                      <td><?= $newDate; ?></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url(); ?>index.php/accounts/printPayment/<?= $val['pay_Id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Print"> <i class="fa fa-print"></i></a> 
                          &nbsp;&nbsp;&nbsp;&nbsp;<?php if ($role=="superadmin"|| $role=="admin"){?><a href="<?php echo base_url(); ?>index.php/accounts/editPayment/<?= $val['pay_Id']; ?>"  
							 class="btn btn-outline-info" style="padding:6px;" title="Edit"><i class="fa fa-edit"></i></a> <?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;
						  <?php if ($role=="superadmin" || $role=="admin"){?>  <a href="<?php echo base_url(); ?>index.php/accounts/deletePayment/<?= $val['pay_Id']; ?>"  onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a><?php }?> </div></td>
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