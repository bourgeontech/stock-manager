<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Search </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
          <form action="<?php echo base_url();?>index.php/admin/admin/customer_search" method="post">
          	<div class="row" style="padding:10px 0;">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="input-group">
            	  <input type="text" class="form-control" placeholder="Name" value="<?php if(isset($keyword)){echo $keyword;}?>" name="keyword" required="required">
                  <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}?>" name="datef">
                  <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}?>" name="datet">
                  <div class="input-group-append">
                    <button type="submit" name="button" value="search" class="btn btn-outline-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
                </div>
               </div>
            </div>
            </form>
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
					  <th scope="col" width="">Date</th>
                    <th scope="col" width="">Bill No</th>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Diety</th>
					  <th scope="col" width="">Star</th>
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Quantity</th>
					  <th scope="col" width="">Rate</th>
					  <th scope="col" width="">Amount</th>
					</tr>
				  </thead>
					<?php if(!empty($customer_list)){
	                      $i=0;
	                       foreach($customer_list as $val){ ?>
				  <tbody id="myTable">
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?=date('d-m-Y',strtotime($val['date']));?></td>
                     <td><?=  $val['bill_id'];?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['name']; ?></strong></a></td>
					  <td><?= $val['deity_nm']; ?></td>
					  <td><?= $val['star_eng']; ?></td>
					  <td><?= $val['pooja_nm']; ?></td>
					  <td><?= $val['qlt']; ?></td>
					  <td><?= $val['pooja_rt']; ?></td>
					  <td><?= $val['amount']; ?></td>
                    </tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="9">No Data Found</td>
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