  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
    <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Schedule Pooja Report</h4>
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
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Schedule Pooja Details</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
              </div>     
			 </div>
	          <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name</th>
                      <th scope="col" width="">Star</th>
					  <th scope="col" width="">Diety</th>
                      <th scope="col" width="">Pooja</th>
                      <th scope="col" width="">Qty</th>
<!-- 					  <th scope="col" style="text-align:right">Action</th> -->
					</tr>
				  </thead>
                  <tbody>
					<?php 
                       if(!empty($bills)){ 
                       $today = date('Y-m-d');
                	   foreach($bills as $key => $sp){ 
                       $clr = 'white';
                       if($today > $sp['date']){
                          $clr = "red";
                       }
                    ?>
					<tr style="background-color:<?= $clr; ?>">
					   <td><?= ++$key; ?></td>
					   <td><?= $sp['name'].' ( '.$sp['star_eng'].' )'; ?></td>
					   <td><?= $sp['date']; ?></td>
                       <td><?= $sp['deity']; ?></td>
                       <td><?= $sp['pooja']; ?></td>
                       <td><?= $sp['qty']; ?></td>
<!-- 					   <td style="text-align:right">
                          <div class="btn-group">						  
                             <a href="<?= base_url('index.php/admin/admin/schedule_billing_details/'.$sp['id']); ?>" class="btn btn-outline-info" style="padding:6px;" title="Details"> <i class="fa fa-eye"></i></a> 
						  </div>
                       </td> -->
					</tr>
                    <?php } } else { ?>
                     <tr>
                       <td class="text-center" colspan="5">No Data Found!</td>
                     </tr>
                    <?php } ?>
				  </tbody>
				</table>
                <table class="table  srp_table" width="100%" style="border:1px solid #000">
                <?php 
                  $bill_id = $pooja['0']['bill_id'];
                  $sql1 ="SELECT * FROM billing WHERE id = $bill_id";
                  $totalamount = $this->db->query($sql1)->row()->total;
                
                  $sql2 ="SELECT * FROM billing_dtls WHERE bill_id = $bill_id AND date <= CURDATE()";
                  $completed = $this->db->query($sql2)->result_array();
                
                   $sql3 ="SELECT SUM(amount) as spend FROM billing_dtls WHERE bill_id = $bill_id AND date < CURDATE()";
                   $spend = $this->db->query($sql3)->row()->spend;
                   
                   $sql4 ="SELECT SUM(amount) as amt FROM billing_dtls WHERE bill_id = $bill_id";
                   $poojaamount = $this->db->query($sql4)->row()->amt;
                   $postal = $totalamount - $poojaamount;
                   $postperpooja = $postal / count($pooja);
                   $totalpostalspend = $postperpooja *  count($completed);
                   $balance = $totalamount - ($spend + $totalpostalspend);
                ?>
                     <tr>
                       <th>Bill Amount</th>
                       <td><?php echo $totalamount; ?></td>
                    <tr>
                    <tr>
                       <th>Pooja Completed</th>
                       <td><?php echo count($completed); ?></td>
                    <tr>
                    <tr>
                       <th>Pooja Remaining</th>
                       <td><?php echo count($pooja) - count($completed); ?></td>
                    <tr>
                    <tr>
                       <th>Balance Amount</th>
                       <td><?php echo $balance; ?></td>
                    <tr>
               </table>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>