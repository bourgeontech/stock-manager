  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Dittum List</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dittum_mstr" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
    <body onafterprint="viewaction()">
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Dittum List</h2>
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
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Products</th>
					  <th scope="col" width="" class="action">Action</th>
					</tr>
				  </thead>
				  <tbody>
                    <?php 
                    if (!empty($dittum_list)){
                        foreach($dittum_list as $pooja){
                            $this->db->select('dittum.*,inv_product.id as pro_id,inv_product.name as pro_nm,inv_unit.name as unit_nm');
                            $this->db->from('dittum');
                            $this->db->join('inv_product','dittum.product_id = inv_product.id');
                            $this->db->join('inv_unit','dittum.unit_id = inv_unit.id');
                            $this->db->where('dittum.pooja_id',$pooja['pooja_id']);
                            $query = $this->db->get()->result_array();
                    ?>
                        <tr>
                            <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $pooja['pooja_nm']; ?></strong></a></td>
                            <td>
                            	<?php 
                            	foreach ($query as $val){
                            	    echo $val['pro_nm']." (".$val['qty']." ".$val['unit_nm'].")<br>";
                            	}
                            	?>
                        	</td>
                        	<td class="action"><div class="btn-group">
        						  <a href="<?php echo base_url(); ?>index.php/admin/admin/edit_dittum/<?= $pooja['pooja_id']; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a>
						  		</div>
				  			</td>
                        </tr>
                    <?php 
                      }
                    }
                    ?>
				  </tbody>
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