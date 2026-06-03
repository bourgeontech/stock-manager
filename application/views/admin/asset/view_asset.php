<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Asset Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/add_asset" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Add</a> </li>
          </ul>
        </div>
    </div>
    <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Assets </h2>
              </div>
			 <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>   
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/view_asset" method="post">
                    <div class="input-group">
                    	<input type="hidden" name="date" value="<?php echo date('Y-m-d');?>">
                    	<select name="location" id="location" class="form-control" style="margin:10px 0;">
                        	<option value="">Select Location</option>
            			<?php foreach($location_list as $val){ ?>
            				<option value="<?= $val['id']; ?>" <?php if(isset($location)&&$location==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
            			<?php } ?>
            			</select>
            			<select name="ass_cat" id="ass_cat" class="form-control" style="margin:10px 0;">
                        	<option value="">Select Category</option>
            			<?php foreach($category_list as $val){ ?>
            				<option value="<?= $val['id']; ?>" <?php if(isset($ass_cat)&&$ass_cat==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
            			<?php } ?>
            			</select>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2">
              </div>
            <div class="col-lg-4 col-md-4 col-sm-4 ">
            	<div class="input-group mb-3">
			  		<input id="myInput" type="text" class="form-control" placeholder="Search..">
                </div>
            </div>
            </div>	
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col">SL No</th>
					  <th scope="col">Docno</th>
					  <th scope="col">Docdate</th>
					  <th scope="col">Itemcode</th>
					  <th scope="col">Itemname</th>
					  <th scope="col">Category</th>
					  <th scope="col">Location</th>
					  <th scope="col">Qty</th>
					  <th scope="col">Unit</th>
					  <th scope="col">Rate</th>
					  <th scope="col" class="action">Action</th>
					</tr>
				  </thead>
					<?php 
					$total=0;
					if(!empty($asset_list)){
	                      $i=0;
	                      foreach($asset_list as $val){ 
	                          ?>
				  <tbody id="myTable">
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['docno']; ?></strong></a></td>
					  <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
					  <td><?= $val['itemcode']; ?></td>
					  <td><?= $val['itemname']; ?></td>
					  <td><?= $val['cat_nm']; ?></td>
					  <td><?= $val['loc_nm']; ?></td>
					  <td><?= $val['qlt']; ?></td>
					  <td><?= $val['unit']; ?></td>
					  <td><?= $val['rate']; ?></td>
					  <td class="action"><div class="btn-group">
						  <a href="<?php echo base_url();?>index.php/admin/admin/edit_asset/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
						  <a href="<?php echo base_url();?>index.php/admin/admin/delete_asset/<?= $val['id']; ?>"   onclick="return confirm('Are you sure you want to delete?')"
							 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> </div></td>
					</tr>
				  </tbody>
					<?php 
					$total=$total+intval($val['rate']);
	                      } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="12">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				    <tfoot>
				    	<tr>
				    		<th></th>
				    		<th colspan="8">Total</th>
				    		<th><?php echo $total;?></th>
				    		<th class="action"></th>
				    	</tr>
				    </tfoot>
				</table>
             </div>
			</div> 
          </div>
          </div>
  </div>
<div class="clearfix"></div>
<br>
</body>
<!-- <script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/view_asset" }, 100); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/view_asset";
}
function printcontend(value) {
	$('.action').hide();
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}
</script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>