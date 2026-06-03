            <style>
                .more_images li {
                    float:left;
                    margin: 5px;
                }
                .more_images li figure {
                    width:100px;
                    height:100px;
                    background-color:#eee;
                    display:block;
                    position:relative;
                    
                }
                .more_images li .edit{border-radius: 50%;
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 0;
    position: absolute;
    top: 5px;
    right: 5px;}
            </style>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt">Product Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>admin/admin/products_view" class="btn btn-primary">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back</a> </li>
          </ul>
        </div>
      </div>
    </div>
	 <?php foreach($product_list as $val){ ?>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
      <div class="row">
        <div class="col-lg-12 ">
          <div class="row">
            <div class="col-lg-8 col-lg-8 col-sm-12">
              <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 text-center">
                  <div style="border-radius: 50% ; height:100px; width: 100px; 
							  background:#eee url(<?php echo base_url(); ?><?= $val['photo']; ?>);    
							  background-size: cover; display: inline-block"></div>
                </div>
                <div class="col-lg-10 col-md-8 col-sm-8">
                  <ul class="quatation_ul" style="margin-top: 5px">
                    <li style="padding-left:0">
                      <h3 style="    font-size: 20px;
    margin-bottom: 5px;
    font-weight: bold;
    color: #da251d;"><?= $val['name']; ?></h3>
                      <p style="font-size: 14px;    color: #6b6b6b;"><?= $val['code']; ?></p><br>
						<a  class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal">
						  Change Image
						</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
			  
             <div class="col-lg-4 col-lg-4 col-sm-12"> <a class="pull-right">
				<div class="btn-group btn-group-toggle" data-toggle="buttons">
				  <label class="btn btn btn btn-outline-success <?php echo ($val['status']!=0)?'active':''; ?>">
					<input type="radio" name="options"  class="status" value="1" autocomplete="off" <?php echo ($val['status']!=0)?'checked':''; ?> /> In Sale
				  </label>
				  <label class="btn btn btn btn-outline-danger <?php echo ($val['status']!=1)?'active':''; ?>">
					<input type="radio" name="options"  class="status" value="0" autocomplete="off" <?php echo ($val['status']!=1)?'checked':''; ?> /> Not In Sale
				  </label>
				</div>
				 </a> 
			</div>
          </div>
          <hr>
          <table align="left" style="font-size: 15px;" class="table table-borderless" width="" border="0">
            <tbody>
              <tr>
                <td>Category</td>
                <td><strong ><?= $val['cat_name']; ?></strong></td>
				<td>Sub Category</td>
                <td><strong ><?= $val['subcat_name']; ?></strong></td>
              </tr>
			  <tr>
                <td>Description</td>
                <td colspan="3"><strong ><?= $val['description']; ?></strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
	 <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
      <div class="row">
        <div class="col-lg-12 ">
            <ul class="more_images">
                
                <li> 
                <figure>
                    <button class="btn btn-success edit" data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-edit"></i></button>
                    <img src="<?php echo base_url().$val['image_1']; ?>" alt="<?=$val['code']; ?>" style="width:100%">
                </figure>
                
                </li>
                <li> 
                <figure>
                    <button class="btn btn-success edit" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-edit"></i></button>
                    <img src="<?php echo base_url().$val['image_2']; ?>" alt="<?=$val['code']; ?>" style="width:100%">
                </figure>
                
                </li>
                <li> 
                <figure>
                    <button class="btn btn-success edit" data-toggle="modal" data-target="#exampleModal3"><i class="fa fa-edit"></i></button>
                    <img src="<?php echo base_url().$val['image_3']; ?>" alt="<?=$val['code']; ?>" style="width:100%">
                </figure>
                
                </li>
                
                
            </ul>
            
        </div>
        </div>
        
        </div>
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose an image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	 <form action="<?php echo base_url(); ?>admin/admin/change_product_image/<?= $val['id']; ?>" method="post" enctype="multipart/form-data">	
      <div class="modal-body">
        <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <input class="sq_form" placeholder="Image" id="icon" name="image" required=""  type="file" value="<?php echo set_value('image'); ?>" >
          </div>
        </div>
      </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
		 <input type="hidden"  id="pid"  value="<?php echo $val['id']; ?>" />
	</form>	 
    </div>
  </div>
</div>
		<!-- Modal -->
	<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose an image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	 <form action="<?php echo base_url(); ?>admin/admin/change_product_image1/<?= $val['id']; ?>" method="post" enctype="multipart/form-data">	
      <div class="modal-body">
        <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <input class="sq_form" placeholder="Image" id="icon" name="image_1" required=""  type="file" value="<?php echo set_value('image_1'); ?>" >
          </div>
        </div>
      </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
		 <input type="hidden"  id="pid"  value="<?php echo $val['id']; ?>" />
	</form>	 
    </div>
  </div>
</div>
		<!-- Modal -->
	<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose an image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	 <form action="<?php echo base_url(); ?>admin/admin/change_product_image2/<?= $val['id']; ?>" method="post" enctype="multipart/form-data">	
      <div class="modal-body">
        <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <input class="sq_form" placeholder="Image" id="icon" name="image_2" required=""  type="file" value="<?php echo set_value('image_2'); ?>" >
          </div>
        </div>
      </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
		 <input type="hidden"  id="pid"  value="<?php echo $val['id']; ?>" />
	</form>	 
    </div>
  </div>
</div>
		<!-- Modal -->
	<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose an image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	 <form action="<?php echo base_url(); ?>admin/admin/change_product_image3/<?= $val['id']; ?>" method="post" enctype="multipart/form-data">	
      <div class="modal-body">
        <div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <input class="sq_form" placeholder="Image" id="icon" name="image_3" required=""  type="file" value="<?php echo set_value('image_3'); ?>" >
          </div>
        </div>
      </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
		 <input type="hidden"  id="pid"  value="<?php echo $val['id']; ?>" />
	</form>	 
    </div>
  </div>
</div>
		<!-- Modal -->		
	
	<?php } ?>
    <div class="clearfix"></div>
    <br>
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
            var id=$('#pid').val();
            $('.status').change(function(){ 
                var status=$(this).val();
				console.log(id);
				alert("<?php echo base_url(); ?>");
                $.ajax({
                    url: "<?=base_url(); ?>index.php/admin/admin/change_product_status",
                    method : "POST",
					data : {id: id,status:status},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        console.log("Status Updated");
                    }
                });
                return false;
            }); 
             
        });

</script>

