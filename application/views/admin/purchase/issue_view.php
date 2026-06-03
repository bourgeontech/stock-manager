  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Issue Product</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/issue_product" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;View Issue Product </h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <ul class="btn_ul" style="float:right;">
                  	<li> <a href="<?php echo base_url();?>index.php/admin/admin/is_summary" class="btn btn-primary">Issue Summary</a> </li>
                  </ul>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-4 col-md-4 col-sm-4 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/issue_view" method="post">
                    <div class="input-group">
                      <select id="product" name="product" class="form-control" style="margin:10px 0;">
                          <option value="">Select product</option>
                          <?php foreach($product_list as $val){ ?>
            				<option value="<?php echo $val['id']; ?>" <?php if(isset($suppl)&&$suppl==$val['id']){echo "selected";}?>><?php echo $val['name']; ?></option>
        				  <?php } ?>
                      </select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($issue_list)){?>
			  <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Customer</th>
					  <th scope="col" width="">Product</th>
					  <th scope="col" width="">Unit</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" width="">Remark </th>
					</tr>
				  </thead>
					<?php 
                        if(!empty($issue_list)){
						$i=0;
						foreach($issue_list as $val){
	                        ?>
				  <tbody>
					<tr>
					  <td><?php echo ++$i; ?></td>
					  <td><?php echo date('d-m-Y',strtotime($val['date'])); ?></td>
					  <td><?php echo $val['name'];?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?php echo $val['product_nm']; ?></strong></a></td>
					  <td><?php echo $val['unit']; ?></td>
					  <td><?php echo $val['qty']; ?></td>
					  <td><?php echo $val['remark']; ?></td>
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
             <?php }?>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
