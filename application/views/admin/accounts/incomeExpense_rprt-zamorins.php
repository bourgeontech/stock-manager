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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Income Expense Report</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header">
  <div class="header-right" hidden="">
 <!--  <a href="<?php echo base_url();?>index.php/accounts/report" class="btn btn btn-outline-secondary" style="font-size: 18px;"><i class="fa fa-list-ul" aria-hidden="true"></i> View All</a> -->
        
  <a href="<?php echo base_url();?>index.php/accounts/incomeExpenseExcel" class="btn btn btn-outline-success" style="font-size: 18px;float: right;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a>
  
   </div>
   </div>
        </div>
       </div> 
       <br>
       
       <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 ">
      <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
          

<!-- SEARCH -->

<div class="row">
  
        
        <div class="col-lg-8 col-md-8 col-sm-8">
                  <form action="<?php echo base_url();?>index.php/accounts/incomeExpense_rprt" method="post">
                  <div class="input-group mb-3">
          &nbsp;&nbsp;<input type="date" class="form-control" name="datef" value="<?php if (isset($datef)&&$datef!=""){echo $datef;}else{ echo date('Y-m-d');}?>" required placeholder="Search By Date" aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
          <input type="date" class="form-control" name="datet" value="<?php if (isset($datet)&&$datet!=""){echo $datet;}else{ echo date('Y-m-d');}?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" type="button" onclick="printcontend('printer')" onafterprint="myFunction()"><i class="fa fa-print" aria-hidden="true"></i></button>
                      	<button class="btn btn-outline-secondary" type="button" onclick="exceldownload('printer')" onafterprint="myFunction()"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
            </form>
        </div>
       </div> <br>
     <?php
      	$site_settings 	= $this->db->select('*')->from('site_settings')->get()->row();
      	$language_settings = $this->db->field_exists('language', 'site_settings');
		$search_date=$datef;
		$search_datet=$datet;
     // print $search_date;print $search_datet;exit;
     $year = date("Y", strtotime($search_date));
     
   $firstDayOfYear = mktime(0, 0, 0, 1, 1, $year);
$firstDayOfYear = date("Y-m-d", $firstDayOfYear);


      $first_day_this_month = date('m-01-Y'); // hard-coded '01' for first day
      $last_day_this_month  = date('m-t-Y');
    
		if(@$_POST['datef']==""){
		    $search_date=date('Y-m-d');
		    $search_datet=date('Y-m-d');
		}
      else {$search_date=$datef;
            $search_datet=$datet;
           }
		$convertDate = date("Y-m-d", strtotime($search_date));
		$convertDate1 = date("Y-m-d", strtotime($search_datet));
	
		$pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` < '$convertDate' and `type`='1'")->row_array();
 
        $pay1=$pay['payment'];
		$rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec1=$rec['receipt'];
        $open_cash=$rec1-$pay1;
      
        $pay2 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
        $pay3=$pay2['payment'];
		$rec2 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec3=$rec2['receipt'];
        $open_bank=$rec3-$pay3;
  
      //opening bank & cash ends here
      
		
        $totalpay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` < '$convertDate' and `type`='1'")->row_array();
 
        $totalpay1=$pay['payment'];
		$totalrec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $totalrec1=$rec['receipt'];
        $totalopen_cash=$rec1-$pay1;
      
        $totalpay2 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
        $totalpay3=$pay2['payment'];
		$totalrec2 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $totalrec3=$rec2['receipt'];
        $totalopen_bank=$rec3-$pay3;
     // print "SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'";
      // total opening bank and cash ends here aakethuka
      // 
      
        $closing_bank=0;
      
      	$close_cash_pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='1'")->row_array();
        $pay4=$close_cash_pay['payment'];
		$close_cash_rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='2'")->row_array();
        $rec4=$close_cash_rec['receipt'];
        $close_cash=($open_cash+$rec4)-$pay4;
    //  print $close_cash;
        $close_bank_pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='1'")->row_array();
        $pay5=$close_bank_pay['payment'];
		$close_bank_rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='2'")->row_array();
        $rec5=$close_bank_rec['receipt'];
        $closing_bank=($open_bank+$rec5)-$pay5;
   //  print "SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND  `payment_date` between '$convertDate' and '$convertDate1' and `type`='1'";

   ?>
      
			<div id="printer">
            	 <div class="row">
                	<div class="col-lg-12 col-md-12 col-sm-12 ">
                	<div style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                			<?php echo $this->lang->line('income_expense_report'); ?> (<?php if (isset($search_date)){echo date('d-m-Y',strtotime($search_date));}?> മുതൽ <?php if (isset($search_datet)){echo date('d-m-Y',strtotime($search_datet));}?> വരെ)</h4>
            		</div>		
            	</div>
            	<div class="col-md-6 col-sm-6 ">
                		<div class="table-responsive">
                			<table class="table table-hover srp_table" width="100%" border="1" id="table1">
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;"> <?php echo $this->lang->line('income'); ?> </th>
                    				</tr>
                    				<tr>
                    			    	<th scope="col" width=""></th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('item_details'); ?> </th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('amount'); ?> </th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('total_amount'); ?> </th>
                    		    	</tr>
                		    	</thead>
                            	<tbody>
                		    		<tr>
                		    			<td></td>
                		    			<td> <?php echo $this->lang->line('cash_in_hand'); ?> </td>
                                    <td style="text-align: right;"><?php echo (number_format($open_cash, 2, '.', ''))?></td>
                		    			<td style="text-align: right;"><?php echo (number_format($open_cash, 2, '.', ''));?></td>
                		    			
                	    			</tr>
                	    			<tr>
                		    			<td></td>
                		    			<td> <?php echo $this->lang->line('bank_balance'); ?> </td>
                                    <td style="text-align: right;"><?php echo (number_format($open_bank, 2, '.', ''))?></td>
                		    			<td style="text-align: right;"><?php echo (number_format($open_bank, 2, '.', ''));?></td>
                		    			
                	    			</tr>
                	    			<?php 
                	    			$i=0;
                	    			$c_tot=0;
                            		$b_tot = 0;
                            		$ledtotr=0;
                            		$ledtotp=0;
                            		$grosscash = 0;
                	    			$c_tot=$c_tot+$open_cash;
                	    			$b_tot=$b_tot+$open_bank+$open_cash;
                            		$grosscash+=$open_bank+$open_cash;
                	    			$this->db->select('*');
                	    			$this->db->from('ledger');
                	    			$this->db->where('ledger.is_delete !=', 1);
                                    $this->db->where('ledger.group !=', 2);
                                    $this->db->where('ledger.group !=', 3);
                	    			$query2 = $this->db->get()->result_array();
                            		
                            		
                            
                	    			foreach ($query2 as $val){
                	    			    $led_id=$val['led_Id'];
                                        $ledger_name=$val['name_mal'];
                                    	if($language_settings && $site_settings->language != null) {
                							if($site_settings->language == 'english') { 
                                            	$ledger_name=$val['name'];
                                            } else { 
                                                $ledger_name=$val['name_mal'];
                                            }
                                        } 
                	    			    
                	    			    $sdf = $this->db->query("SELECT sum(amount) as receipt FROM `payment`  WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and is_delete!=1 and `type`='2' and ledger='$led_id' ")->row_array();
                	    		//print "SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and  `type`='2' and is_delete!=1 and ledger='$led_id'";   
                                        $amd=$sdf['receipt'];
                	    			    $sdf1 = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$firstDayOfYear' and `payment_date` <= '$convertDate1' and `type`='2' and ledger='$led_id'  and is_delete!=1")->row_array();
                	    		//	print "SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$firstDayOfYear' and `payment_date` <= '$convertDate1' and `type`='2' and ledger='$led_id'  and is_delete!=1";   
                                    $amdtot=$sdf1['receipt'];
                	    			    $c_tot=$c_tot+$amd;
                	    			    // $b_tot=$b_tot+$amdtot;
                                        $ledtotr+=$amd;
                                    	$grosscash += $amd;
                                    	$b_tot     += $amdtot;
                                   //  $totalcashtotal=$open_cash+$amd;print $totalcashtotal;
                	    			    if ($amd!=""||$amdtot!="") {
                	    			    ?>
                	    			    <tr>
                	    			    	<td><?php echo ++$i;?></td>
                	    			    	<td><?php echo $ledger_name;?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amd, 2, '.', ''));?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amdtot, 2, '.', ''));?></td>
                	    			    </tr>
                	    			    <?php
                	    			    }
                	    			}
                            // $grosscash=$open_cash+$open_bank+$ledtotr;
                	    			?>
                	    			<tr>
                	    				<td></td>
                		    			<td></td>
                		    			<td></td>
                		    			<td></td>
                	    			</tr>
                	    			<tr>
                	    				<td></td>
                		    			<td></td>
                		    			<td></td>
                		    			<td></td>
                	    			</tr>
                	    			<tr>
                	    				<td></td>
                	    				<td> <?php echo $this->lang->line('total'); ?> </td>
                	    				<td style="text-align: right;"><?php echo (number_format($grosscash, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
                	    			</tr>
                		    	</tbody>
                			</table>
                		</div>
                	</div>
                	<div class="col-md-6 col-sm-6">
                		<div class="table-responsive">
                			<table class="table table-hover srp_table" width="100%" border="1" id="table2">
                				<thead>
                				<thead>
                    				<tr>
                    					<th colspan="9" style="text-align: center;"> <?php echo $this->lang->line('expense'); ?> </th>
                    				</tr>
                    				<tr>
                    			    	
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('item_details'); ?> </th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('amount'); ?> </th>
                    			    	<th scope="col" width=""> <?php echo $this->lang->line('total_amount'); ?> </th>
                    		    	</tr>
                		    	</thead>
                		    	<tbody>
                		    		<tr>
                		    			<td></td>
                		    			<td>&nbsp;<td>
                                
                		    			
                	    			</tr>
                	    			<tr>
                		    			<td></td>
                		    			<td>&nbsp;<td>
                                  
                		    			
                	    			</tr>
                	    			<?php 
                	    			$c_tot1=0;
                	    			$b_tot1=0;
                	    			$this->db->select('*');
                	    			$this->db->from('ledger');
                	    			$this->db->where('ledger.is_delete !=', 1);
                                    $this->db->where('ledger.group !=', 2);
                                           $this->db->where('ledger.group !=', 3);
                	    			$query2 = $this->db->get()->result_array();
                	    			foreach ($query2 as $val){
                	    			    $led_id=$val['led_Id'];
                                    	$ledger_name=$val['name_mal'];
                	    			    if($language_settings && $site_settings->language != null) {
                							if($site_settings->language == 'english') { 
                                            	$ledger_name=$val['name'];
                                            } else { 
                                                $ledger_name=$val['name_mal'];
                                            }
                                        } 
                	    			    $sdf = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$convertDate' and payment_date <='$convertDate1' and is_delete!=1 and `type`='1' and ledger='$led_id'")->row_array();
                	    			    $amd=$sdf['receipt'];
                	    			    $sdf1 = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` >= '$firstDayOfYear' and `payment_date` <= '$convertDate1' and `type`='1' and ledger='$led_id'  and is_delete!=1")->row_array();
                	    			    $amdtot=$sdf1['receipt'];
                	    			    $c_tot1=$c_tot1+$amd;
                	    			    $b_tot1=$b_tot1+$amdtot;
                	    			    if ($amd!=""||$amdtot!="") {
                	    			    ?>
                	    			    <tr>
                	    			    	<td><?php echo $ledger_name;?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amd, 2, '.', ''));?></td>
                	    			    	<td style="text-align: right;"><?php echo (number_format($amdtot, 2, '.', ''));?></td>
                	    			    </tr>
                	    			    <?php
                	    			    }
                	    			}
                                	$b_tot1 += $close_cash + $closing_bank;
                	    			?>
                	    			<tr>
                	    				<td> <?php echo $this->lang->line('cash_in_hand'); ?> </td>
                	    				<td style="text-align: right;"><?php echo (number_format($close_cash, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($close_cash, 2, '.', ''));?></td>
                	    			</tr>
                	    			<tr>
                		    			<td> <?php echo $this->lang->line('bank_balance'); ?> </td>
                		    			<td style="text-align: right;"><?php echo (number_format($closing_bank, 2, '.', ''));?></td>
                		    			<td style="text-align: right;"><?php echo (number_format($closing_bank, 2, '.', ''))?></td>
                	    			</tr>
                	    			
                                
                            		<tr>
                	    				<td> <?php echo $this->lang->line('total'); ?> </td>
                	    				<td style="text-align: right;"><?php echo (number_format($c_tot1+$close_cash+$closing_bank, 2, '.', ''));?></td>
                	    				<td style="text-align: right;"><?php echo (number_format($b_tot1, 2, '.', ''));?></td>
                	    			</tr>
                		    	</tbody>
                			</table>
                	</div>
                </div>
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
function exceldownload(value) {
	var table = document.getElementById("printer");
        var html = table.outerHTML;

        var blob = new Blob([html], {type: "application/vnd.ms-excel"});
        var url = URL.createObjectURL(blob);

        var a = document.createElement("a");
        a.href = url;
        a.download = "data.xls";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

$( document ).ready(function() {
    
var count = $('#table1 tr').length;
var count1 = $('#table2 tr').length;
var diff = count1-count;
var a;
if(count>count1){
  for(a=0;a<diff;a++){
   $('#table1').closest('table').find('tr:last').prev().after('<tr><td>&nbsp;</td><td></td><td></td><td></td></tr>');
  }
}
else{
  for(a=0;a<diff;a++){
   $('#table1').closest('table').find('tr:last').prev().after('<tr><td>&nbsp;</td><td></td><td></td><td></td></tr>');
  }
}

});

//$( document ).ready(function() { alert("ok");
       // var count = $('#table1 tr').length;
       // var count2 = $('#table2 tr').length;
       // var diff=count2-count;
       // var a = 0;
       //                          alert(a);
       // if(count2>count){
       //   alert(a);
       // }
              //for(a=0;a<diff;a++){
                         // alert(a);
                         //        $('#table2').append('<tr><td>my data</td><td>more data</td></tr>');}
                         //        else
                         //        {
                         //         $('#table1').append('<tr><td>my data</td><td>more data</td></tr>');
                         //        }
              //                 }
//});
</script>

