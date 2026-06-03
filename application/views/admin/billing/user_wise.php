  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Userwise Report</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Userwise Daily Collection</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/user_wise" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}?>" title="Date From" required name="datef" style="margin:10px 0;">
                      <?php echo form_error('datef', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}?>" title="Date To" required name="datet" style="margin:10px 0;">
                      <?php echo form_error('datet', '<div class="error">', '</div>'); ?>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" onclick="printcontend('printer')" title="Print Summary"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive" id="printer" onafterprint="myFunction()">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
				  	<tr id="header12" style="display:none;">
    					<td colspan="9" style="width: 100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					<strong style="margin-bottom: 5px;color: #ea6227;">Userwise Daily Collection</strong></h4>
    					</td>
    				</tr>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">User</th>
					  <th scope="col" width="">Role</th> <th scope="col" width="">Counter</th>
					  <th scope="col" style="text-align:right">Pooja Amount</th>
                      <th scope="col" style="text-align:right">Postal Amount</th>
                     <th scope="col" style="text-align:right">Total Amount</th>
					</tr>
				  </thead>
					<?php 
					$tot_bk="0";$tpost=0;
                    $i=0;
                	$role=$this->loggedIn['role'];
                    $this->db->select('admin.name,admin.role,SUM(billing_dtls.amount) as tot_booking,sum(billing_dtls.postal_amt) as postal_amt,billing.counter,counter.name as countername');
                    $this->db->from('admin');
                    $this->db->join('billing','billing.user_id = admin.id');
                    $this->db->join('billing_dtls','billing_dtls.bill_id = billing.id');
                    $this->db->join('counter','billing.counter = counter.id');
                    $this->db->where('billing.deleted', '0');
                    if (isset($datef)&&$datef!=""&&$datet!=""){
                        $this->db->where("billing.date BETWEEN '$datef' AND '$datet'");
                    }
                	//if ($role!="superadmin"){
                    	$this->db->where('admin.role', $role);
                    //}
                    $this->db->group_by('admin.name');
                    $bill_list = $this->db->get()->result_array();
                    foreach($bill_list as $val){ 
                        $tot_booking=$val['tot_booking'];
                    $tot_postal=$val['postal_amt'];
                        $tot_bk=$tot_bk+$tot_booking;
                    $tpost+=$tot_postal;
                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					 <td><?= $val['name'];?></td>
					 <td><?= $val['role'];?></td>
                     <td><?= $val['countername'];?></td>
					 <td style="text-align:right"><?= number_format((float)$tot_booking, 2, '.', '');?></td>
                     <td style="text-align:right"><?= number_format((float)$tot_postal, 2, '.', '');?></td>
                     <td style="text-align:right"><?= number_format((float)($tot_postal+$tot_booking), 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php }?>
					<tfoot>
					  <tr>
                      <th></th>
					    <th colspan="3">Total</th>
					    <th style="text-align:right"><?= number_format((float)$tot_bk, 2, '.', '');?></th>
                      <th style="text-align:right"><?= number_format((float)$tpost, 2, '.', '');?></th>
                             <th style="text-align:right"><?= number_format((float)($tpost+$tot_bk), 2, '.', '');?></th>
					  </tr>
					</tfoot>
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
    	window.onfocus = function () { myFunction(); }
    	function myFunction(){
			$('#header12').css('display','none');
        }
    	function printcontend(value) {
    		$('#header12').removeAttr('style');
        	var restorpage=document.body.innerHTML;
        	var printcontend=document.getElementById(value).innerHTML;
        	document.body.innerHTML=printcontend;
        	window.print();
        	document.body.innerHTML=restorpage;
        }
    </script>