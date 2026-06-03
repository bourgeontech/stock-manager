  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Billing Master</42>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Detailed Bill Summary</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/detail_summary" method="post">
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
					  <th scope="col" width="">#</th>
					  <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Booked</th>
					  <th scope="col" width="">Deity</th>
					  <th scope="col" width="">Name &amp; Address</th>
                     <th scope="col" width="">Pincode</th>
                      <th scope="col" width="">Mobile Number</th>
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Pooja Date</th>
                      <?php if($this->db->field_exists('appearance', 'billing')): ?>
                      <th scope="col" width="">Participation</th>
                      <?php endif; ?>
					  <th scope="col" width="">Time</th>
					</tr>
				  </thead>
					<?php 
					if(!empty($bill_list)){
	                    $i=0;
	                    foreach($bill_list as $val){  ?>
				  <tbody>
					<tr>
					  <td><?= ++$i;?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?= $val['bill_id']; ?></strong></a></td>
					 <td><?= date('d-m-Y',strtotime($val['booked_dt']));?></td>
					 <td><?= $val['diety'];?></td>
					 <td style="max-width:8cm;white-space: pre-wrap;"><?= $val['name']."<br>".$val['house']." , ".$val['street']." , ".$val['post']." , ".$val['district'];?></td>
					 <td><?= $val['pincode'];?></td>
                    <td><?= $val['mobile'];?></td>
                     <td><?= $val['pooja'];?></td>
					 <td><?= date('d-m-Y',strtotime($val['pooja_dt']));?></td>
                     <?php if($this->db->field_exists('appearance', 'billing')): ?>
                      <td scope="col" width=""><?= $val['appearance'];?></td>
                      <?php endif; ?>
					 <td><?= $val['time'];?></td>
					</tr>
				  </tbody>
					<?php } }
                     else {
					?>	
					<tbody><tr><td colspan="10" style="text-align:center;">No Data Found!</td></tr></tbody>	
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