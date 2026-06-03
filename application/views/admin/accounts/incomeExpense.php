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
                  <form action="<?php echo base_url();?>index.php/accounts/searchReport1" method="post">
                  <div class="input-group mb-3">
          &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="search" value="<?php echo date('Y-m-d');?>" required placeholder="Search By Date" aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
          <input type="date" class="form-control" name="search1" value="<?php echo date('Y-m-d');?>" required aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
        </div>
               
             
        
       </div> <br>

     <?php
    
if(@$datef!="")
{
        $search_date=$datef;
        $search_datet=$datet;}
        if(@$search_date==""){
            $search_date=date('Y-m-d');
            $search_datet=date('Y-m-d');
        }
        $convertDate = date("Y-m-d", strtotime($search_date));
        $convertDate1 = date("Y-m-d", strtotime($search_datet));
        $payment = $this->db->query("SELECT sum(opening_bal) as payment FROM `ledger` WHERE `group`='2'")->row_array();
        $open_cash=$payment['payment'];
           $open_cash=0;  

        $receipt = $this->db->query("SELECT sum(opening_bal) as receipt FROM `ledger` WHERE `group`='3'")->row_array();
        $open_bank=$receipt['receipt'];
       $open_bank=0;
      //print "SELECT sum(opening_bal) as receipt FROM `ledger` WHERE `group`='3'";
      
        // For bank
        
        $pay_bank = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
        $pay2=$pay_bank['payment'];
     // print "SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'";
        $rec_bank = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec2=$rec_bank['receipt'];
      
        $close_bank=$rec2-$pay2;
        
        $total_opening_bank=$open_bank+$close_bank;
      
        $pay = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
        $pay1=$pay['payment'];
       // print "SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'";
       
        $rec = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec1=$rec['receipt'];
        $close=$rec1-$pay1;
        $total_opening_cash=$open_cash+$close;
       
        $current_month_reciepts = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` between'$convertDate' and '$convertDate1'   and `type`='2'")->row_array();
        $current_month_cash_reciepts=$current_month_reciepts['receipt'];
    //  print $current_month_cash_reciepts."<br>";
        
        $current_month_bank_reciepts = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` between'$convertDate' and '$convertDate1'   and `type`='2'")->row_array();
        $current_month_bank_reciepts=$current_month_bank_reciepts['receipt'];
      //  print "SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` between'$convertDate' and '$convertDate1'   and `type`='2'";
       // print $current_month_cash;
       
      
        
      
      
        $current_month_payments = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` between'$convertDate' and '$convertDate1'   and `type`='1'")->row_array();
        $current_month_cash_payments=$current_month_payments['receipt'];
       //  print $current_month_cash_payments."<br>";
      
        $current_month_bank_payments = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` between'$convertDate' and '$convertDate1'   and `type`='1'")->row_array();
        $current_month_bank_payments=$current_month_bank_payments['receipt'];
      
      
       // $netcurrentmonthcash=$current_month_cash_reciepts-$current_month_cash_payments; print $netcurrentmonthcash."<br>";
        $current_month_closing_cash=($total_opening_cash+$current_month_cash_reciepts)-$current_month_cash_payments;
        $curent_month_closing_bank=($total_opening_bank+$current_month_bank_reciepts)-$current_month_bank_payments;
      
      
       // print $total_opening_bank."<br>";
       // print $total_opening_cash."<br>";
        //print $current_month_closing_cash."<br>";
        //print $curent_month_closing_bank;
       /** 
        $payments = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` <= '$convertDate' and `type`='1'")->row_array();
        $pays=$payments['payment'];
        $receipts = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` <= '$convertDate' and `type`='2'")->row_array();
        $recs=$receipts['receipt'];
        $closing_cash=$recs-$pays;
        $payments1 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` <= '$convertDate' and `type`='1'")->row_array();
        $pays1=$payments1['payment'];
        $receipts1 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` <= '$convertDate' and `type`='2'")->row_array();
        $recs1=$receipts1['receipt'];
        $closing_bank=$recs1-$pays1; 
 
 */

     $payment = $this->db->query("SELECT sum(amount) as payment FROM `payment` WHERE type='1' and is_delete=0")->result_array();
      
  //    print "SELECT sum(amount) as payment FROM `payment` WHERE type='1'";
  
          foreach($payment as $val){ 
          $pay=$val['payment'];
    
        }

     $receipt = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE type='2'  and is_delete=0")->result_array();
  
          foreach($receipt as $val){ 
          $rec=$val['receipt'];
          
        }
$open_b=$rec-$pay;

        

//TOTAL DEBIT & CREDIT

// $payment = $this->db->query("SELECT sum(amount) as payment FROM `payment` WHERE type='1'")->result_array();
  
//           foreach($payment as $val){ 
//           $total_debit=$val['payment'];
//         }

//      $receipt = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE type='2'")->result_array();
  
//           foreach($receipt as $val){ 
//           $total_credit=$val['receipt'];
//         }


   ?>


         <div class="table-responsive" id="printer">
        <table class="table  table-hover srp_table" width="100%" border="1" id="table">
          <thead>
          <tr>
			<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
			<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
			Reciepts & Payments  For The Date <?php if (isset($search_date)){echo date('d-m-Y',strtotime($search_date));}?> to <?php if (isset($search_datet)){echo date('d-m-Y',strtotime($search_datet));}?></h4>
			</td>
		</tr>
          <tr>
            <th scope="col" width="">SL No</th>  
            <th scope="col" width="">LEDGER</th>
           <th scope="col" width="">RECIEPTS</th>
            <th scope="col" width="">PAYMENTS</th>
           
                                          
           
          </tr>
          </thead>
          <!--<td></td>
          <td></td>
          <td><strong style="margin-bottom: 5px;display: block; color:green;">OPENING BALANCE</strong></td>
         <td>
//             <?php
//             if($rec<$pay){
              
//                ?>
//              <i class="fa fa-inr" aria-hidden="true"></i> <?= $open_b;?>
              <?php 
// } 
?></td>
//           <td>
//             <?php
//             if($rec>$pay){
              
//                ?>
//              <i class="fa fa-inr" aria-hidden="true"></i> <?= $open_b;?>
             <?php 
// } 
?>
					</td>
            

          

-->

                             <?php 
        					$total_debit=0;
                            $total_credit=0;
                             if(!empty($incomeExpense)){
                            $i=0;
                            
$total_credit = 0;
$total_debit = 0;
$i=0;
foreach($incomeExpense as $row){ 
    $total_credit += $row['total_receipts'];
    $total_debit  += $row['total_payments'];
?>
<tr>
    <td><?= ++$i; ?></td>
    <td><strong><?= strtoupper($row['name']); ?></strong></td>
    <td style="text-align:right;">
        <?php if($row['total_receipts'] > 0){ ?>
            <i class="fa fa-inr"></i> <?= number_format($row['total_receipts'], 2); ?>
        <?php } ?>
    </td>
    <td style="text-align:right;">
        <?php if($row['total_payments'] > 0){ ?>
            <i class="fa fa-inr"></i> <?= number_format($row['total_payments'], 2); ?>
        <?php } ?>
    </td>
</tr>
<?php } 
 } 
                else{ ?>
              <tr>
                 <td class="text-center" colspan="6">No Data Found</td>
              </tr>
            <?php } 

            ?>    


    <tfoot>
      <tr>
      <th colspan="2" style="text-align: right;color:gray;">TOTAL</th>
       <td style="text-align: right;"><i class="fa fa-inr" aria-hidden="true"></i> <?= (number_format($total_credit, 2, '.', '')); ?>
       </td><td colspan="1" style="text-align: right;"><span id="val"></span><i class="fa fa-inr" aria-hidden="true"></i> <?= (number_format($total_debit, 2, '.', '')); ?>
      </td>
     
    </tr>
     <tr>
      <th colspan="2" style="text-align: right;color:gray;">Opening /Closing Balance</th>
       <td style="text-align: right;"><i class="fa fa-inr" aria-hidden="true"></i> <?php print number_format($total_opening_cash,2); ?>
       </td><i class="fa fa-inr" aria-hidden="true"></i> <td colspan="1" style="text-align: right;"><i class="fa fa-inr" aria-hidden="true"></i><?php print number_format($current_month_closing_cash,2);?>
      </td>
     
    </tr>
      <tr>
      <th colspan="2" style="text-align: right;color:gray;"> Bank</th>
       <td style="text-align: right;"><i class="fa fa-inr" aria-hidden="true"></i> <?php print number_format($total_opening_bank,2,'.',''); ?>
       </td> <td colspan="1" style="text-align: right;"><i class="fa fa-inr" aria-hidden="true"></i><?php print number_format($curent_month_closing_bank,2,'.',''); ?>
      </td>
     
    </tr>
       <tr>
      <th colspan="2" style="text-align: right;color:gray;"> <?php $totalopening=($total_opening_cash+$total_opening_bank+$total_credit);
      $totalclosing=$total_debit+$current_month_closing_cash+$curent_month_closing_bank;?></th>
       <td style="text-align: right;"><i class="fa fa-inr" aria-hidden="true"></i> <?php print number_format($totalopening,2,'.',''); ?>
       </td> <td colspan="1" style="text-align: right;"><i class="fa fa-inr" aria-hidden="true"></i><?php print number_format($totalclosing,2,'.','');;?>
      </td>
     
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
<script>
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>

