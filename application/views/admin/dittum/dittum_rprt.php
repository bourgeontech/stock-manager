  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Dittum</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dittum_mstr" class="btn btn-primary">Add New&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Dittum</h2>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/dittum_rprt" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
			  <div class="table-responsive" id="printer">
				<table class="table table-bordered table-hover" width="100%">
				  <thead>
<!-- 				  	<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php// print_r($temple_list[0]['name']);?><br>
    					<?php// print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					</h4> -->
<!--     					</td> -->
<!--     				</tr> -->
					<tr>
					  <th scope="col" width="">Pooja</th>
					  <th scope="col" width="">Nos</th>
					  <?php 
					  foreach($product_list as $pur){
					  ?>
					  <th scope="col" style="white-space: pre-wrap;"><?php echo $pur['name'];?></th>
					  <?php 
					  }
					  ?>
					</tr>
				  </thead>
				  <tbody>
                    <?php 
                    if (!empty($bill_list)){
                    foreach($bill_list as $pooja){
                        $pooja_qty=$pooja['quantity'];
                    ?>
                        <tr>
                            <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $pooja['pooja']; ?></strong></a></td>
                            <td><?php echo $pooja_qty;?></td>
                            <?php 
                            foreach($product_list as $pro){
                                $this->db->select('qty');
                                $this->db->from('dittum');
                                $this->db->where('pooja_id',$pooja['pooja_id']);
                                $this->db->where('product_id',$pro['id']);
                                $qty = $this->db->get()->row_array();
                                $pro_qty=$qty['qty'];
                                $tot_qty=$pooja_qty*$pro_qty;
                            ?>
                            	<td><?php if($tot_qty!=0){ echo $tot_qty;}?></td>
                            <?php 
                            }
                            ?>
                        </tr>
                    <?php 
                      }
                    }
                    ?>
				  </tbody>
				  <tfoot>
				  	  <tr>
				  	  	<th>Total</th>
				  	  	<th></th>
				  	  	<?php 
                            foreach($product_list as $pro){
                            ?>
                            	<th></th>
                            <?php 
                            }
                            ?>
				  	  </tr>
				  </tfoot>
				</table>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('table thead th').each(function (i) {
                if(i!=0&&i!=1){
                	calculateColumn(i);
                }
            });
        });
        function calculateColumn(index) {
            var total = 0;
            $('table tr').each(function () {
                var value = parseFloat($('td', this).eq(index).text());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('table tfoot th').eq(index).text(total);
        }
    </script>
    <script>
//         function printcontend(value) {
//         	var restorpage=document.body.innerHTML;
//         	var printcontend=document.getElementById(value).innerHTML;
//         	document.body.innerHTML=printcontend;
//         	window.print();
//         	document.body.innerHTML=restorpage;
//         }
	</script>