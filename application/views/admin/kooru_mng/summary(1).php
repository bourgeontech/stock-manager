  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Kooru Management</h4>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Kooru Summary</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/kooru_rpt" method="post">
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
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name of the Pooja</th>
					  <th scope="col" width="">Quantity</th>
					  <?php 
					  $col=3;
					  $ids=array();
					  foreach($user_list as $val){ ?>
					  	<th scope="col" width=""><?=$val['name'];?></th>
					  <?php 
					  $ids[]=$val['id'];
					  $col++;
					  }?>
					  <th scope="col" style="text-align:right">Rate</th>
					  <th scope="col" style="text-align:right">Amount</th>
					</tr>
				  </thead>
					<?php 
					$tot="0"; $shanthi=0;
$shanthitot=0;
                     $kazhakam=0;
                     $devaswom=0;
                     $vadyam=0;
                     $velichapad=0;  
					if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){ 
	                        $qty=$val['quantity'];
	                        $pooja_rt=$val['pooja_rt'];
	                     //   $amt=$qty*$pooja_rt;
	                     $amt=$val['amount'];
	                        $tot=$tot+$amt;
	                        ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					 <td><?= $val['pooja'];?></td>
					 <td><?= $qty;?></td>
					 <?php
                    
                        
					 foreach ($ids as $id){
					     $this->db->select('rate');
					     $this->db->from('kooru_mng');
					     $this->db->where('user_id', $id);
					     $this->db->where('pooja_id', $val['pooja_id']);
					     $query = $this->db->get()->row_array();
                   //  print_r($query);
					     $user_rate=$query['rate']*$qty;
                    // print $id."-".$user_rate ."<br>"; 
                     if($id=='2')
                     {
                        $shanthi=($user_rate);
                     	$shanthitot+=$shanthi; 
                     }
                     if($id=='3')
                     {
                       $kazhakam+=$user_rate;
                     }
                       if($id=='4')
                     {
                       $devaswom+=$user_rate;
                     }
                       if($id=='5')
                     {
                       $vadyam+=$user_rate;
                     }
                       if($id=='6')
                     {
                       $velichapad+=$user_rate;
                     }
                     
                    
					 ?>
					 	<td><?php  print $user_rate;?></td>
					 <?php 
					 }?>
					 <td style="text-align:right"><?= number_format((float)$pooja_rt, 2, '.', '');?></td>
					 <td style="text-align:right"><?= number_format((float)$amt, 2, '.', '');?></td>
					</tr>
				  </tbody>
					<?php } }
                     else {
					?>	
					<tbody><tr><td colspan="20" style="text-align:center;">No Data Found!</td></tr></tbody>	
					<?php } ?>
					<tfoot>
						<tr>
    					    <th colspan="3">&nbsp;</th> 
                        <th ><?php echo $shanthitot;?></th>
    					   <th ><?php echo $kazhakam;?></th>
                       <th ><?php echo $devaswom;?></th>
                         <th ><?php echo $vadyam;?></th>
                          <th ><?php echo $velichapad;?></th>
                         
    					    <th style="text-align:right"><?= number_format((float)$tot, 2, '.', '');?></th>
					    </tr>
					</tfoot>
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
