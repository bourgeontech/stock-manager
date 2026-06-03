  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Bandaram Report</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Report </h2>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 ">
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <h2 class="page_txt"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter </h2>
              </div>      
              <div class="col-lg-8 col-md-8 col-sm-8 ">
                  <form  action="<?php echo base_url();?>index.php/admin/admin/bandaram_report" method="post">
                    <div class="input-group">
                      <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" required name="datef" style="margin:10px 0;">
                      <?php echo form_error('datet', '<div class="error">', '</div>'); ?>
                      <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" required name="datet" style="margin:10px 0;">
                      <?php echo form_error('datet', '<div class="error">', '</div>'); ?>
                      <select name="bandaram" id="bandaram" class="form-control" style="margin:10px 0;height:auto;">
                          <option value="">All</option>
            		  <?php foreach($bandaram_list as $val){ ?>
            			  <option value="<?= $val['id']; ?>" <?php if(isset($bandaram)&&$bandaram==$val['id']){echo "Selected";}?>><?=$val['name']; ?></option>
            		  <?php } ?>
            		  </select>
            		  <?php echo form_error('bandaram', '<div class="error">', '</div>'); ?>
                      <div class="input-group-append" style="margin:10px 0;">
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                        <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
              </div>
			 </div>
	         <?php if(isset($datef)){?>
	          <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">SL No </th>
					  <th scope="col" width="">Date</th>
					  <th scope="col" width="">Amount</th>
					  <th scope="col" width="">Type</th>
					  <th scope="col" width="">Nos</th>
					  <th scope="col" width="">Remark</th>
					  <th scope="col" width="">Total</th>
					  <th scope="col" width="">Action</th>
					</tr>
				  </thead>
				  <tbody>
					<?php 
					$this->db->select('transaction.*,bandaram.name');
					$this->db->from('transaction');
					$this->db->join('bandaram','transaction.bandaram = bandaram.id');
					if($bandaram!=0){
						$this->db->where('transaction.bandaram', $bandaram);
					}
					$this->db->where("transaction.date BETWEEN '$datef' AND '$datet'");
					$query = $this->db->get()->result_array();

     // to get group
     // 
	 				$g_total=0; 
					if(!empty($query)){
					    $i=0;
					    
	                    foreach($query as $val){ 
	                       $trance_id=$val['id'];
	                       $this->db->select('transaction_dtls.*,amount.name as amount_nm');
	                       $this->db->from('transaction_dtls');
	                       $this->db->join('amount','transaction_dtls.amount = amount.id');
	                       $this->db->where('trans_id', $trance_id);
	                       $query1 = $this->db->get()->result_array();
	                       $rowspan=sizeof($query1);
						   $query2 = $this->db->query("SELECT sum(`total`) as amt,`remark` FROM `transaction` join `transaction_dtls`  on `transaction_dtls`.`trans_id`=`transaction`.id
						    WHERE `transaction`.`id` = '$trance_id' group by `remark`");
	                       if($bandaram==0){?>
						   <tr>
								<td colspan="8" style="text-align: center;"><?= $val['name'];?></td>
							</tr>
							<?php }?>
    				      <tr>
        					   <td rowspan="<?php echo $rowspan;?>"><?= ++$i; ?></td>
        					   <td rowspan="<?php echo $rowspan;?>"><?= date('d-m-Y',strtotime($val['date'])); ?></td>
    				      <?php
    				      $total=0;
	                           foreach($query1 as $key=>$val1){ 
	                               $total=$total+$val1['total'];
	                               if ($key!=0){
	                                   echo "<tr>";
	                               }
	                        ?>
            					 <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val1['amount_nm']; ?></strong></a></td>
            					 <td><?= $val1['remark']; ?></td>
            					 <td><?= $val1['nos']; ?></td>
            					 <td><?= $val1['notes']; ?></td>
            					 <td style="text-align: right;"><?= $val1['total']; ?></td>
					<?php 
                					if ($key!=0){
                					    echo "</tr>";
                					}else{
        					           ?>
        					           <td rowspan="<?php echo $rowspan;?>">
            								<div class="btn-group">
                        					  <a href="<?php echo base_url();?>index.php/admin/admin/edit_transaction/<?= $trance_id; ?>" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-edit"></i></a> 
                        					  <!-- <a href="<?php echo base_url();?>index.php/admin/admin/delete_transaction/<?= $trance_id; ?>"   onclick="return confirm('Are you sure you want to delete?')"
                        						 class="btn btn-outline-danger" style="padding:6px;" title="Delete"><i class="fa fa-trash"></i></a> --> 
                    						</div>
            							</td>
            						</tr>
        					           <?php    
                					}
	                           }
	                           $g_total=$g_total+$total;
					?>
	        		<?php  foreach ($query2->result_array() as $row) {  ?>      
                    <tr>
    						<th colspan="6"> <?php echo $row['remark'];?></th>
    						<th style="text-align: right;"><?php  echo $row['amt'];?></th>
    						<th></th>
    					</tr>
                 <?php } ?> 
                  <tr>
    						<th colspan="6">Total</th>
    						<th style="text-align: right;"><?php echo $total;?></th>
    						<th></th>
    					</tr>
    					<tr>
    						<td colspan="8"></td>
    					</tr>
	                    <?php 
	                    }
					}?>
					</tbody>
					<tfoot>
						<tr>
    						<th colspan="6">Grand Total <?php $a=numinwords($g_total); echo $a; ?></th>
    						<th style="text-align: right;"><?php echo $g_total; ?></th>
    						<th></th>
    					</tr>
					</tfoot>
				</table>
             </div>
             <?php }?>
			</div> 
          </div>
	    </div>
       </div>
	</div>
<?php 

  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
function numinwords($num)
{
$number = $num;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo "Rupees ".$result . "" . $points . " Paise";
 
}
?>
    <div class="clearfix"></div>
    <br>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
    <script>
        (function(document) {
        	'use strict';
        	var LightTableFilter = (function(Arr) {
        		var _input;
        		function _onInputEvent(e) {
        			_input = e.target;
        			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
        			Arr.forEach.call(tables, function(table) {
        				Arr.forEach.call(table.tBodies, function(tbody) {
        					Arr.forEach.call(tbody.rows, _filter);
        				});
        			});
        		}
        		function _filter(row) {
        			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
        			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        		}
        		return {
        			init: function() {
        				var inputs = document.getElementsByClassName('light-table-filter');
        				Arr.forEach.call(inputs, function(input) {
        					input.oninput = _onInputEvent;
        				});
        			}
        		};
        	})(Array.prototype);
        	document.addEventListener('readystatechange', function() {
        		if (document.readyState === 'complete') {
        			LightTableFilter.init();
        		}
        	});
        })(document);
    </script>