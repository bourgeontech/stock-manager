<style>
 .pagination-div a {
    margin: 0 2px !important;
  	border: 1px solid;
  	padding: 5px 10px;
 }

 .pagination-div strong {
    margin: 0 2px !important;
  	border: 1px solid;
  	padding: 5px 10px;
 }
</style>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Schedule Pooja Report</h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <h6 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Search By Bill No. / Mobile Number / Name </h6>
              </div>     
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/schedule_billing_report" method="post">
                    <div class="input-group">
                      <input type="text" class="form-control" value="" placeholder="Search By Bill No, / Mobile No. / Name" required name="keyword" style="margin:10px 0;">
                      <?php echo form_error('keyword', '<div class="error">', '</div>'); ?>
                    
                      <input type="date" class="form-control" value="" placeholder="Pooja Date"  style="margin:10px 0;">
                      <?php echo form_error('pooja_date', '<div class="error">', '</div>'); ?>
                    
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	          <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Bill No.</th>
					  <th scope="col" width="">Name</th>
                      <th scope="col" width="">Phone No.</th>
					  <th scope="col" style="text-align:right">Action</th>
					</tr>
				  </thead>
                  <tbody>
					<?php 
                       if(!empty($scheduled_poojas)){
                       $count = $this->uri->segment(4, 0) + 1;
                       
                	   foreach($scheduled_poojas as $key => $sp){ ?>
					<tr>
					   <td><?= $count++; ?></td>
					   <td><?= $sp['id']; ?></td>
					   <td><?= $sp['name']; ?></td>
                       <td><?= $sp['mobile']; ?></td>
					   <td style="text-align:right">
                          <div class="btn-group">						  
                             <a href="<?= base_url('index.php/admin/admin/schedule_billing_details/'.$sp['id']); ?>" class="btn btn-outline-info" style="padding:6px;" title="Details"> <i class="fa fa-eye"></i></a> 
						  </div>
                       </td>
					</tr>
                    <?php } } else { ?>
                     <tr>
                       <td class="text-center" colspan="5">No Data Found!</td>
                     </tr>
                    <?php } ?>
				  </tbody>
				</table>
              	<div class="text-center pagination-div">
                <?php 
              		if(!empty($scheduled_poojas)){
						echo $links;   
                    }
				?>
                </div>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>