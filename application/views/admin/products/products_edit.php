 <style>
      .error{
        color: red;
      }
	  tr td input[type=text] {
		  width: 100%;
		  box-sizing: border-box;
		  -webkit-box-sizing:border-box;
		  -moz-box-sizing: border-box;
		  background:transparent !important;
		  border: 0px;
		}
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
          <h2 class="page_txt">Product Management</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url(); ?>admin/admin/products_view" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
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
            <li> <a href="<?php echo base_url(); ?>admin/admin/products_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
	   </div>	
		
	  </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit Product </h2>
                  </div>
			   </div>
				<?php foreach($product_list as $val){
				 
				?>
		      <form action="<?php echo base_url(); ?>admin/admin/edit_product/<?=$val['id']; ?>" method="post" enctype="multipart/form-data">

      <input id='sub' type="hidden" value="<?=$val['subcategory']; ?>" />
      <div class="form_body">
       <div class="row">
		 <div class="col-lg-6">
			<div class="form-group">
			  <div class="row_form">
				<div class="div_label">
				  <label class="text_label">Category <span class="red">*</span></label>
				</div>
				<select id="category" class="js-example-basic-single sq_form" name="category"  style="width: 100%">
					<?php foreach($category_list as $val1){  ?>
					  <option <?php if($val['category']===$val1['id']){ echo "selected"; }else{ echo ""; } ?> value="<?= $val1['id']; ?>"><?= $val1['name']; ?></option>
					<?php } ?>
					</select>
				 <?php echo form_error('category', '<div class="error">', '</div>'); ?> 
			  </div>
			</div>
		  </div>   
		  <div class="col-lg-6">
			<div class="form-group">
			  <div class="row_form">
				<div class="div_label">
				  <label class="text_label">Sub Category <span class="red">*</span></label>
				</div>
				<select id="subcategory" class="js-example-basic-single sq_form" name="subcategory"  style="width: 100%">
					  <option value="">Select a category</option>
					</select>
				<?php echo form_error('subcategory', '<div class="error">', '</div>'); ?>  
			  </div>
			</div>
		  </div>  
		<div class="col-lg-6">
		   <div class="form-group">
			  <div class="row_form">
				<div class="div_label">
				  <label class="text_label">Name <span class="red">*</span> </label>
				</div>
				<input class="sq_form"  name="product_id"  type="hidden" value="<?=$val['id']; ?>" >
				<input class="sq_form" placeholder="Name" id="name" name="name"  type="text" value="<?=$val['name']; ?>" >
				<?php echo form_error('name', '<div class="error">', '</div>'); ?>
			  </div>
			</div>
		  </div>	
		  <div class="col-lg-6">
		   <div class="form-group">
			  <div class="row_form">
				<div class="div_label">
				  <label class="text_label">Code <span class="red">*</span> </label>
				</div>
				<input class="sq_form" placeholder="Code" id="code" name="code"  type="text" value="<?=$val['code']; ?>" >
				<?php echo form_error('code', '<div class="error">', '</div>'); ?>
			  </div>
			</div>
		  </div> 
		<div class="col-lg-12">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Description</label>
            </div>
            <textarea class="sq_form" placeholder="Description" id="description" name="description"  ><?=$val['description']; ?></textarea>
			<?php echo form_error('description', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>   	
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Unit </label>
            </div>
            <select class="js-example-basic-single sq_form" name="unit"  style="width: 100%">
					  <option readonly>Select a unit</option>
					<?php foreach($unit_list as $val2){  ?>
					  <option  value="<?= $val2['id']; ?>"><?= $val2['name']; ?></option>
					<?php } ?>
					</select>
			<?php echo form_error('unit', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>  
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Quantity </label>
            </div>
            <input class="sq_form" type="text" name="qty" />
			<?php echo form_error('qty', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div> 
      <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> MRP </label>
            </div>
            <input class="sq_form" type="text" name="mrp" />
			<?php echo form_error('mrp', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div> <div class="col-lg-6">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Offer Price </label>
            </div>
            <input class="sq_form" type="text" name="offer_price" />
			<?php echo form_error('offer_price', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div> 
	  <div class="col-sm-12">
         <div class="form-group">
             <button type="submit" class="btn btn-success pull-right" style="margin-top:7px;">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
         </div>
        </div>
      </div>
    </div>
  </form>
				<?php } ?>
    </div>
			 <!--form-->
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

$( window ).load(function() {
                var id=$('#category').val();
	            var sub=$('#sub').val();
					console.log(sub);
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
                        $('#subcategory').val(sub);
                    }
                });
});
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
