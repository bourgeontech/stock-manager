  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Issue Product</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/issue_product" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;View Issue Summary </h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <ul class="btn_ul" style="float:right;">
                  	<li> <a href="<?php echo base_url();?>index.php/admin/admin/issue_view" class="btn btn-primary">View Issue</a> </li>
                  </ul>
              </div>
             <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/is_summary" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($datef)){?>
			  <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
				  	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					Issue Summary For the Period <?php if (isset($datef)){echo date('d-m-Y',strtotime($datef));}?> to <?php if (isset($datet)){echo date('d-m-Y',strtotime($datet));};?></h4>
    					</td>
    				</tr>
					<tr>
					  <th scope="col" width="15%">SL No </th>
					  <th scope="col" width="50%">Product</th>
					  <th scope="col" width="20%">Quantity</th>
					  <th scope="col" width="15%">Unit</th>
					</tr>
				  </thead>
					<?php 
					$this->db->select('issue.*,SUM(issue.qty) as total_qty,inv_product.name as pro_nm,inv_unit.name as unit_nm');
					$this->db->from('issue');
					$this->db->join('inv_product','inv_product.id = issue.product_id');
					$this->db->join('inv_unit','inv_unit.id = issue.unit');
					$this->db->where("issue.date BETWEEN '$datef' AND '$datet'");
					$this->db->group_by('issue.product_id');
					$purchase = $this->db->get()->result_array();
					$i=0;
					foreach($purchase as $pur){
	                        ?>
				  <tbody>
					<tr>
					  <td><?php echo ++$i; ?></td>
					  <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?php echo $pur['pro_nm']; ?></strong></a></td>
					  <td><?php echo $pur['total_qty']; ?></td>
					  <td><?php echo $pur['unit_nm']; ?></td>
					</tr>
				  </tbody>
					<?php 
	                    } 
	                    ?>
				</table>
             </div>
             <?php }?>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
	<script>
        function printcontend(value) {
        	var restorpage=document.body.innerHTML;
        	var printcontend=document.getElementById(value).innerHTML;
        	document.body.innerHTML=printcontend;
        	window.print();
        	document.body.innerHTML=restorpage;
        }
	</script>