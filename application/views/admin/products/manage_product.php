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
    <div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Product </h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <form action="<?php echo base_url();?>admin/admin/manageProduct" method="post">
                  <div class="input-group mb-3">
                      <input type="text" class="form-control" name="search" value="<?php echo set_value('search'); ?>"  placeholder="Search Products By Name / Product Code" aria-label="Search Products By Name / Product Code / Category" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
              </div>
			 </div>
	       <div class="table-responsive">
             <table width='100%' class="table  table-hover srp_table" style='border-collapse: collapse;'>
               <thead>
                 <tr>
                   <th width="10%">SI No.</th> 
                   <th width="20%">Image</th>
                   <th width="30%">Name</th>
                   <th width="30%">Description</th>
                   <th width="30%">Price</th>
                 </tr>
               </thead>
               <tbody>
               <?php 
               $i=1;
               foreach($product_list as $product){
                  $id = $product['id'];
                  if($product['photo']!=''){ $image = $product['photo']; } else { $image = 'assets/admin/img/yashnoproduct.png'; }
                  $name = $product['name'];
                  $code = $product['code'];
                  $description = $product['description'];
                  $price = $product['price'];
                  ?>
                 <tr>
                     <td>
                         <span><?php echo $i++; ?></span>
                     </td>
                     <td>
                         <span><img style="max-height: 100px;max-width: 100px;" src="<?php echo base_url().$image; ?>" alt="<?php echo $name; ?>" /></span>
                     </td>
                     <td>
                         <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?php echo $name; ?></strong>
                         <span><?php echo $code; ?></span>
                     </td>
                     <td>
                         <p><?php echo $description; ?></p>
                     </td>
                     <td>
                         <span class='edit' ><?php echo $price; ?></span>
                         <input type='text' class='txtedit form-control' data-id="<?php echo $id; ?>" data-field='price' id="pricetxt_<?php echo $id; ?>" value="<?php echo $price; ?>" >
                     </td>
                 </tr>
                 <?php
               }
               ?>
               </tbody>
             </table>
              </div>
	           <br>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
     <!-- Script -->
     <script type="text/javascript">
     $(document).ready(function(){
         $('.txtedit').hide();
         // On text click
               $('.edit').click(function(){
                  // Hide input element
                  $('.txtedit').hide();
        
                  // Show next input element
                  $(this).next('.txtedit').show().focus();
        
                  // Hide clicked element
                  $(this).hide();
               });

       // Focus out from a textbox
       $('.txtedit').focusout(function(){
          // Get edit id, field name and value
          var edit_id = $(this).data('id');
          var fieldname = $(this).data('field');
          var value = $(this).val();

          // assign instance to element variable
          var element = this;

          // Send AJAX request
          $.ajax({
            url: '<?= base_url() ?>admin/admin/updateProductRow',
            type: 'post',
            data: { field:fieldname, value:value, id:edit_id },
            success:function(response){
                
                $(element).hide();

              // Update viewing value and display it
                $(element).prev('.edit').show();
                $(element).prev('.edit').text(value);
            }
          });
        });
      });
      </script>

  