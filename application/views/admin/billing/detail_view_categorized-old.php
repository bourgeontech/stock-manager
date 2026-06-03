  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Daily Pooja Wise Summary</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing_view" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Detailed View</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
<!--               <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <ul class="btn_ul" style="float:right;">
                    <li> <a href="<?php echo base_url();?>index.php/admin/admin/mookkolakallu" class="btn btn-primary">Mookkolakallu Reg</a> </li>
                  </ul>
              </div>  -->
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/detail_view" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($from)){echo $from;}else{echo date('Y-m-d');}?>" title="Date From" required name="from" style="margin:10px 0;">
                      <?php echo form_error('from', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($to)){echo $to;}else{echo date('Y-m-d');}?>" title="Date To" required name="to" style="margin:10px 0;">
                      <?php echo form_error('to', '<div class="error">', '</div>'); ?>
                      <select name="diety" id="diety" class="form-control" autofocus="autofocus" style="margin:10px 0;height:auto;" required>
                          <option value="">Select Diety</option>
                          <option value="0" Selected>---All---</option>
            		  <?php foreach($diety_list as $val){ ?>
            			  <option value="<?= $val['id']; ?>" <?php if(isset($diety)&&$diety==$val['id']){echo "Selected";}?>><?=$val['name']; ?></option>
            		  <?php } ?>
            		  </select>
            		  <?php echo form_error('diety', '<div class="error">', '</div>'); ?>
            		  <select id="type" name="type" class="form-control" autofocus="autofocus" style="margin:10px 0;height:auto;">
                          <option value="">Select Type</option>
                          <option value="1" <?php if(isset($type)&&$type=="1"){echo "Selected";}?>>Cash Payment</option>
                          <option value="2" <?php if(isset($type)&&$type=="2"){echo "Selected";}?>>Online Payment</option>
                      </select>
                      <select class="form-control" name="pooja_category_id" style="margin:10px 0; border-radius:0">
                        <option value="">----- All -----</option>
                      	<?php foreach($pooja_cat as $cat): ?>
                      	<option value="<?= $cat['id'] ?>" <?php if(isset($category_id) && $category_id == $cat['id']){echo 'selected';}?>><?= $cat['name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
                      <?php if(isset($from)){?>
	          <div class="table-responsive">
              	<h4 align="center">Pooja booking done between <?php echo date('d-m-Y',strtotime($from));?> To <?php echo date('d-m-Y',strtotime($to));?></h2>
            <table  class="table table-bordered table-hover text-nowrap" width="100%">
            <?php 
						$tot = 0;
                        $postal_amt_tot = 0;
                                  

					?>
                <?php foreach ($categories as $category_name => $pooja_data): ?>
                        <?php 
							$subtot = 0;
                        	$subpostal_amt_tot = 0;
                        ?>
            		
                    <tr>
                        <th colspan="6" class="text-center" style="background-color:#f4f4f4;"><?php echo $category_name ?></th>
                    </tr>
     
            		<tr>
					  <th scope="col" width="">SL No  </th>
					  <th scope="col" width="">Name of the Pooja</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" style="text-align:right">Rate</th>
                      <th scope="col" style="text-align:right">Postal Charges</th>
					  <th scope="col" style="text-align:right">Amount</th>
					</tr>
            		
                    <?php foreach ($pooja_data as $key => $pooja): ?>
                      <?php
                                            
                           $amt = $pooja['amount']; //$pooja['rate'] * $pooja['quantity']; 
                                  
                           $gross=$amt+(float)$pooja['postal_amt'];  
                           $tot+=$gross;
                           $postal_amt_tot+=(float)$pooja['postal_amt']; 
                           $subtot+=$gross;
                           $subpostal_amt_tot+=(float)$pooja['postal_amt']; 
                           
                        ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $pooja['pooja_name'] ?></td>
                            <td><?php echo $pooja['quantity'] ?></td>							
                            <td style="text-align:right;"><?php echo $pooja['rate'] ?></td>
                            <td style="text-align:right;"><?php echo $pooja['postal_amt'] ?></td>
                            <td style="text-align:right;"><?php echo number_format((float)$gross, 2, '.', '');; ?></td>

                        </tr>
            
                    <?php endforeach; ?>
                        <tr>
                        	<td> </td>
                            <td> </td>
                        	<td> </td>
                        	<td> </td>
                        	<td style="text-align:right;" ><h4> <?= number_format((float)$subpostal_amt_tot, 2, '.', '');?> </h6> </td>
                        	<td style="text-align:right;"><h4> <?= number_format((float)$subtot, 2, '.', '');?> <h6> </td>
            			</tr>
                <?php endforeach; ?>
                         <tr >
                        	<td> </td>
                            <td> </td>
                        	<td> </td>
                        	<td> </td>
                        	<td style="text-align:right;"><h4 class="text-blue"> <br> <?= number_format((float)$postal_amt_tot, 2, '.', '');?> </h4> </td>
                        	<td style="text-align:right;"><h4 class="text-blue"> <br> <?= number_format((float)$tot, 2, '.', '');?> <h4> </td>
            			</tr>
            </table>
 <?php } ?>
          
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>