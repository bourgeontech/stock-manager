<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Birth Star</a></li>
		</ol>
		<div class="ml-auto">
			<a href="<?php echo base_url();?>index.php/admin/admin/birth_star" class="btn btn-primary btn-icon btn-sm text-white mr-2">
				<span>
					<i class="fe fe-plus"></i>
				</span> Add New
			</a>
		</div>
	</div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Birth Star </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Name in English</th>
					  <th scope="col" width="">Name in Malayalam</th>
					  <th scope="col" width="">Action</th>
					</tr>
				  </thead>
					<?php if(!empty($birth_star)){
	                      $i=0;
	                      foreach($birth_star as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?= $val['date']; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['name_eng']; ?></strong></a></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['name_mal']; ?></strong></a></td>
					  <td><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_birth_star/<?= $val['id']; ?>"   onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="5">No Data Found</td>
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