  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Muthalkootu List</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/pooja_muthalkootu" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
    <body onafterprint="viewaction()">
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Muthalkootu List</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: right;">
                  <button class="btn btn-outline-secondary page_txt" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
              </div>      
              <!-- <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/dittum_rprt" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>-->
			 </div>
			  <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">#</th>
					  <th scope="col" width="">Reference No.</th>		
                    <th scope="col" width="">From Date</th>         
                    <th scope="col" width="">To Date</th>


					  <th scope="col" width="" class="action">Action</th>
					</tr>
				  </thead>
                <?php if ($muthalkootu_list != 0): ?>
				  <tbody>
                    <?php 
                      foreach($muthalkootu_list as $key => $val){
                    ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $val['reference_no']; ?></td>
                            <td><?= $val['from_date']; ?></td>
                            <td><?= $val['to_date']; ?></td>
                        	<td class="action"><div class="btn-group">
        						  <a href="<?php echo base_url(); ?>index.php/admin/pooja/muthalkootu_view/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-eye"></i></a>
                            	  <a href="<?php echo base_url(); ?>index.php/admin/pooja/muthalkootu_edit/<?= $val['id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-pencil"></i></a>
						  	</div>
				  			</td>
                        	
                        </tr>
                    <?php 
                      
                    }
                    ?>
				  </tbody>
                <?php else: ?>
                <tbody>
                	<tr> 
                    	<td colspan="5" class=text-center>No Data Found</td>
                	</tr>
                </tbody>
                <?php endif; ?>
				</table>
             </div>
			</div> 
          </div>
	    </div>
	    </body>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script>
        function printcontend(value) {
        	$(".action").css("display", "none");
        	var restorpage=document.body.innerHTML;
        	var printcontend=document.getElementById(value).innerHTML;
        	document.body.innerHTML=printcontend;
        	window.print();
        	document.body.innerHTML=restorpage;
        }
        function viewaction(){
        	$(".action").removeAttr('style');;
        }
</script>