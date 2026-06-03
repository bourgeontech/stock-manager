 
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Add Group</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header">
  <div class="header-right">
 
   </div>
   </div>
        </div>
			 </div>	
       <br>
       
              
		
      <div class="form_body">
        <div class="row">
			
		<div class="col-lg-4">
        <!-- <?php echo form_open_multipart("cms/addContent"); ?> -->
	    <form action="<?php echo base_url();?>index.php/accounts/addLedgerGroup" method="post">

        <div class="form-group"
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Group Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="Group Name" id="group_name" name="group_name"  type="text" >
			<?php echo form_error('title', '<div class="error">', '</div>'); ?>
          </div>
        </div>
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label"> Name in other language <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="Name in other language" id="name_mal" name="name_mal"  type="text" >
			<?php echo form_error('name_mal', '<div class="error">', '</div>'); ?>
          </div>
        </div>
        <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-success pull-right" style="margin-top:7px;">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                </div>
              </div>
              </form>
      </div>


      <div class="col-lg-8">
        <!-- <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Image <span class="red"></span> </label>
            </div>
            <input class="sq_form" placeholder="" id="file" name="file"  type="file" >
			<?php echo form_error('file', '<div class="error">', '</div>'); ?>
          </div>
        </div> -->

        <div class="table-responsive" style="margin-top:27px;">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
                      <th scope="col" width="">GROUP NAME</th>
                      <th scope="col" width="">NAME MALAYALAM</th>
                      <th scope="col" width="">ACTION</th>
                     
					 
					</tr>
				  </thead>
					<?php if(!empty($ledger_group)){
	                      $i=0;
	                       foreach($ledger_group as $val){ 
                               $id=$val['group_id'];
                               $group=$val['group_name'];
                               $name_mal=$val['name_mal'];
                           
                               ?>
				  <tbody>
					<tr>
					  <td><?= ++$i; ?></td>
                      <td><span style="text-transform: capitalize;font-size: 12px;"><?= $val['group_name']; ?></span></td>
                      <td><?= $val['name_mal']; ?></td>
                      <td><a href="#" onclick="update_group(this.id,'<?PHP echo $group; ?>','<?PHP echo $name_mal; ?>');" id="<?PHP echo $id; ?>"class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> &nbsp;&nbsp;
                          <a href="<?php echo base_url("index.php/Accounts/deleteLedgerGroup/".$id) ?>" onclick="return vv()" class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
					</tr>
				  </tbody>
					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				</table>
             </div>


      </div>
      
			
						
          
        </div>
      </div>
		
    </div>
			 <!--form-->
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

                <h5 class="modal-title"> Update  Group </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span> </button>
              </div>
			  <form role="form" id="multi_table2" method="post" action="<?php echo base_url("index.php/accounts/updateLedgerGroup/")?>" >
              <div class="modal-body">

              <input type="hidden" name="pdtp_id" id="pdtp_id" value="" />
				<div class="form-group ">
                  <label for="exampleInputEmail1">Group Name</label>
                  <input type="text" name="name2" required  class="form-control" id="name2" placeholder="Brand Name">
                </div>
                <div class="form-group">
          			<label for="exampleInputEmail1">Name in Other Languaage </label>
            		<input type="text" name="name_mal2" required  class="form-control" id="name_mal2" placeholder="Name in Malayalam">
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

<script language="javascript" type="text/javascript">


function update_group(fval,name,name_mal){
	    $("#pdtp_id").val(fval);
				$("#name2").val(name);
				$("#name_mal2").val(name_mal);
		    $('#updateGroupModal').modal('show') ;
	}




	</script>		

<script>
$(document).ready(function() {
$('#summernote').summernote({
height: 300

});
});



function vv(){return confirm('Are you sure?'); }
</script>
