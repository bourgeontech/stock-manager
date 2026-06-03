<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/accounts/addLedger" class="btn btn-primary">Add new&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;View Ledger </h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header">
  <div class="header-right">
 
   </div>
   </div>
        </div>
			 </div>		
      
       <!-- SEARCH -->

<div class="row">
	
  
         <div class="col-lg-6 col-md-6 col-sm-6 ">
            <form action="<?php echo base_url();?>index.php/accounts/searchLedger" method="post">
            <div class="input-group mb-3">
            <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h4><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;</h4> -->
            <!-- <input type="text" class="form-control" name="keyword" value="" required placeholder="Search By Group" aria-describedby="basic-addon2"> -->
                          <select name="keyword" class="form-control" aria-label="Search By Group" aria-describedby="basic-addon2">
                          <option value="">Search By Group</option>
                    			<?php foreach($ledger_group as $val){ ?>  
                    			<option value="<?= $val['group_id']; ?>"><?= $val['group_name']; ?></option>
                    			<?php } ?>
                    			</select>   
       
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
              </div>
              </form>
      </div>
  <div class="col-lg-2 col-md-2 col-sm-2 ">
                <!-- <a href="<?php echo base_url();?>index.php/accounts/viewLedger" class="btn btn btn-outline-secondary" style="font-size: 18px;"><i class="fa fa-list-ul" aria-hidden="true"></i> View All</a> -->
              
                <ul class="btn_ul">
                  <li> <a href="<?php echo base_url();?>index.php/accounts/viewLedger" class="btn btn btn-outline-secondary">View All&nbsp;&nbsp;<i class="fa fa-list-ul" aria-hidden="true"></i></a> </li>
                </ul>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 ">
              <input id="myInput" type="text" class="sq_form" placeholder="Search..">
              </div>
	      <div class="table-responsive"><br><br>
				<table class="table  table-hover srp_table" width="100%" border="1">
			  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
                      <th scope="col" width="">LEDGER NAME</th>
                      <th scope="col" width="">MALAYALAM</th>
                      <th scope="col" width="">GROUP</th>
                      <th scope="col" width="">OPENING BALANCE</th>
        			 
					  <th scope="col" width="">ACTION</th>
					</tr>
				  </thead>
					<?php if(!empty($ledger)){
	                      $i=0;
	                      foreach($ledger as $val){
	                          $led_id=$val['led_Id'];
	                          $group_id=$val['group_id'];
	                          $name=$val['name'];
	                          $name_mal=@$val['ledger_mal'];
                            $opb=$val['opening_bal'];
                            $ob=$this->db->query("SELECT * from payment where ledger='$led_id'")->result_array();
                            $obc=count($ob);
	                          ?>
				  <tbody id="myTable">
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['name']; ?></strong></a></td>
            		  <td><span style="text-transform: capitalize;font-size: 12px;"><?= @$name_mal; ?></span></td>
            		  <td><span style="text-transform: capitalize;font-size: 12px;"><?= $val['group_name']; ?></span></td>
            		  <td><span style="text-transform: capitalize;font-size: 12px;"><?= $opb; ?></span></td>
					
					  <td><a href="#" onclick="update_ledger('<?PHP echo $led_id; ?>','<?PHP echo $group_id; ?>','<?PHP echo $name; ?>','<?PHP echo $name_mal; ?>','<?PHP echo $obc; ?>','<?PHP echo $opb; ?>');" id="<?PHP echo $led_id; ?>"class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a></td>
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
    <div class="modal fade" id="updateGroupModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h5 class="modal-title"> Update  Ledger </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span> </button>
              </div>
			  <form role="form" id="multi_table2" method="post" action="<?php echo base_url("index.php/accounts/updateLedger/")?>" >
              <div class="modal-body">

              <input type="hidden" name="pdtp_id" id="pdtp_id" value="" />
				<div class="form-group ">
                  <label for="exampleInputEmail1">Ledger Name</label>
                  <input type="text" name="name2" required  class="form-control" id="name2" placeholder="Brand Name">
                </div>
                <div class="form-group">
          			<label for="exampleInputEmail1">Name in Malayalam </label>
            		<input type="text" name="name_mal2" required  class="form-control" id="name_mal2" placeholder="Name in Malayalam">
      			</div>
      			<div class="form-group">
          			<label for="exampleInputEmail1">Group </label>
          			<select name="group" id="group" class="form-control" aria-label="Search By Group" aria-describedby="basic-addon2">
                        <option value="">Search By Group</option>
                        	<?php foreach($ledger_group as $val){ ?>  
                        		<option value="<?= $val['group_id']; ?>"><?= $val['group_name']; ?></option>
                        	<?php } ?>
                    </select>
      			</div>
            <div class="form-group openingb">
          			<label for="exampleInputEmail1">Opening Balance </label>
            		<input type="text" name="opening" required  class="form-control" id="opb" placeholder="Opening Balance">
      			</div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>

              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
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
<script type="text/javascript">
    function update_ledger(fval,group,name,name_mal,obc,opb){
        $("#pdtp_id").val(fval);
		$("#group").val(group);
		$("#name2").val(name);
		$("#name_mal2").val(name_mal);
      $("#opb").val(opb);
    if (obc<=1){
      $(".openingb").show();
    }else{
      $(".openingb").hide();
    }
        $('#updateGroupModal').modal('show') ;
	}	
</script>