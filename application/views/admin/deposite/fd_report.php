<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> DEPOSIT MODULE </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/deposite" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;FD - Report </h2>
              </div>
           	  <div class="col-lg-6 col-md-6 col-sm-6 ">
            	  <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/mat_report" class="btn btn-primary">Fd Maturity Report</a> </li>
                  </ul>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>   
              <div class="col-lg-10 col-md-10 col-sm-10 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/fd_report" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <select name="type" id="type" class="form-control" required style="margin:10px 0;">
                    	<option value="">Select Type</option>
        				<option value="FD" <?php if (isset($type)&&$type=="FD"){echo "selected";}?>>FD</option>
        				<option value="SB" <?php if (isset($type)&&$type=="SB"){echo "selected";}?>>SB</option>
        				<option value="CURRENT" <?php if (isset($type)&&$type=="CURRENT"){echo "selected";}?>>CURRENT</option>
    				  </select>
    				  <select name="status" id="status" class="form-control" required style="margin:10px 0;">
                    	<option value="">Select Status</option>
        				<option value="1" <?php if (isset($status)&&$status=="1"){echo "selected";}?>>Active</option>
        				<option value="0" <?php if (isset($status)&&$status=="0"){echo "selected";}?>>InActive</option>
    				  </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>		
	       <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
				  	<tr>
    					<td colspan="12" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					FD Register As on Date <?php if (isset($datet)){echo date('d-m-Y',strtotime($datet));}else {echo date('d-m-Y');}?></h4>
    					</td>
    				</tr>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Type</th>
					  <th scope="col" width="">A/c No</th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Bank</th>
					  <th scope="col" width="">Amount</th>
					  <th scope="col" width="">Mat.Date</th>
					  <th scope="col" width="">Mat.Amt</th>
					  <th scope="col" width="">Interest</th>
					  <th scope="col" width="">Period</th>
					</tr>
				  </thead>
					<?php 
                        $total=0;
                        $total1=0;
                		if(!empty($deposite)){
	                      $i=0;
	                      foreach($deposite as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?php echo $val['ac_type'];?></td>
					  <td><?php echo $val['ac_no'];?></td>
					  <td><?php echo date('d-m-Y',strtotime($val['ac_date']));?></td>
					  <td><?php echo $val['name'];?></td>
					  <td><a href="#"> <strong style="color: #ea6227;"><?= $val['bank_nm']; ?></strong></a><br><?= $val['bank_address']; ?></td>
					  <td><?php echo $val['amount'];?></td>
					  <td><?php echo date('d-m-Y',strtotime($val['mat_date']));?></td>
					  <td><?php echo $val['mat_amount'];?></td>
					  <td><?php echo $val['int_perc'];?>%</td>
					  <td><?php echo $val['period'];?></td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+$val['amount'];
					$total1=$total1+$val['mat_amount'];
	                      } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="15">No Data Found</td>
						  </tr>
				    <?php } ?>	
				    <tfoot>
				    	<tr>
				    		<th></th>
				    		<th colspan="5">Total</th>
				    		<th><?php echo $total;?></th>
				    		<th></th>
				    		<th><?php echo $total1;?></th>
				    		<th colspan="2"></th>
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
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>