  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Product Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
      <div class="clearfix"></div>
	   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;&nbsp;Product </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>admin/admin/add_product" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
	   </div>
	   <div class="row">
	       <div class="col-md-12">
	           <?php if($this->session->flashdata('msg')){ ?>
	           <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?php echo $this->session->flashdata('msg'); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php } ?>
	       </div>
	   </div>
	  </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Product </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>admin/admin/product_search" method="post">
                    <div class="input-group">
                      <select id="category" name="category" class="form-control">
                          <option value="">Select Category</option>
                          <?php if(!empty($category_list)){
                              foreach($category_list as $cat){ ?>
                                  <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                          <?php }} ?>
                      </select>
                      <select id="subcategory" name="subcategory" class="form-control">
                          <option value="">Select Sub-Category</option>
                      </select>
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
              </div>
               <div class="col-lg-4 col-md-4 col-sm-4 ">
                  <form action="<?php echo base_url();?>admin/admin/product_search" method="post">
                  <div class="input-group mb-3">
                      <input type="text" class="form-control" name="search" value="" required placeholder="Search Products By Name / Product Code" aria-label="Search Products By Name / Product Code / Category" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
              </div>
			 </div>
			 <div class="col-lg-12 col-md-12 col-sm-12 "> 
    			<nav aria-label="Page navigation example">
    			    <?php echo $links; ?>
    			 </nav>
			 </div>
	       <div class="table-responsive">
	           <small><?php echo $this->session->flashdata('msg'); ?></small>
				<table id="example" class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Code</th>
					  <th scope="col" width="">Category</th>
					  <th scope="col" width="">Sub Category</th>
					  <th scope="col" width="">Status</th>
					  <th scope="col" width="">Image</th>
					  <th scope="col" width="">Action </th>
					</tr>
				  </thead>
					<?php if(!empty($product_list)){
	                    $i=0;
	                    foreach($product_list as $val){ ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['name']; ?></strong>
						<p style="line-height: 19px; color:#000;"><?= $val['description']; ?></p>
						</a>
					  </td>
					 <td><?= $val['code']; ?></td>
					 <td><?= $val['cat_name']; ?></td>
					 <td><?= $val['subcat_name']; ?></td>
					  <td><?= ($val['status']!=0) ? '<span class="badge badge-success">In Sale</span>' : '<span class="badge badge-danger">Not In Sale</span>'; ?></td>
					  <td><img src="<?= base_url().$val['photo']; ?>" alt="<?= $val['code']; ?>" height="70px"/></td>
			 		  <td><div class="btn-group">
						  <a href="<?php echo base_url(); ?>admin/admin/view_product/<?= $val['id']; ?>" class="btn btn-outline-primary" style="padding:6px;" title="View"> <i class="fa fa-eye"></i></a>
						  <a href="<?php echo base_url(); ?>admin/admin/edit_product/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a>  
						  <a href="<?php echo base_url(); ?>admin/admin/delete_product/<?= $val['id']; ?>" class="btn btn-outline-danger" style="padding:6px;" title="Delete"  onclick="return confirm('Are you sure you want to delete?')"> <i class="fa fa-trash"></i></a> 
						  </div>
					  </td>
					</tr>
				  </tbody>
					<?php } }
                     else {
					?>	
					<tbody><tr><td>No Data Found!</td></tr></tbody>	
					<?php } ?>
				</table>
             </div>
               <div class="col-lg-12 col-md-12 col-sm-12 ">
	                 <p><?php echo $links; ?></p>
	           </div>
	           <br>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
 
            $('#category').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url: "<?=base_url(); ?>index.php/admin/admin/getSubcategoryByCategoryId",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        console.log(data);
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
                        }
                        $('#subcategory').html(html);
 
                    }
                });
                return false;
            }); 
            

        });

</script>