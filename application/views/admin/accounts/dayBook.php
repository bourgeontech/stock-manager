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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Day Book</h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header" hidden>
  <div class="header-right">
  <a href="<?php echo base_url();?>index.php/accounts/report" class="btn btn btn-outline-secondary" style="font-size: 18px;"><i class="fa fa-list-ul" aria-hidden="true"></i> View All</a>
        
  <!-- <a href="<?php echo base_url();?>index.php/accounts/exportReportExcel" class="btn btn btn-outline-success" style="font-size: 18px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a> -->
  
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
	
			  
			  <div class="col-lg-6 col-md-6 col-sm-6 ">
                  <form action="<?php echo base_url();?>index.php/accounts/getDayBook" method="post">
                  <div class="input-group mb-3">
				  &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" name="search" value="<?php if (isset($date)){ echo $date;}else{ echo date('Y-m-d');}?>" required placeholder="Search By Date" aria-label="Search Attendance By Day" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-outline-secondary" title="Print" onclick="printcontend('printer')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    </form>
			  </div>
               
             
			  
			 </div>	<br><br>

     <?php
    
     $search_date=$this->input->post('search');
     if($search_date==""){
         $search_date=date('Y-m-d');
     }
     $convertDate = date("Y-m-d", strtotime($search_date));

     $payment = $this->db->query("SELECT sum(amount) as payment FROM `payment` WHERE `payment_date` < '$convertDate' and type='1'")->row_array();
  
     $pay=$payment['payment'];
    

        $receipt = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` < '$convertDate' and type='2'")->row_array();
        $rec=$receipt['receipt'];
          
$open_b=$rec-$pay;

        

//TOTAL DEBIT & CREDIT

$payment = $this->db->query("SELECT sum(amount) as payment FROM `payment` WHERE `payment_date` = '$convertDate' and type='1'")->result_array();
  
          foreach($payment as $val){ 
          $total_debit=$val['payment'];
        }

     $receipt = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` = '$convertDate' and type='2'")->result_array();
  
          foreach($receipt as $val){ 
          $total_credit=$val['receipt'];
        }


   ?>


	       <div class="table-responsive" id="printer">
				<table class="table  table-hover srp_table" width="100%" border="1" id="table">
				  <thead>
				  <tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?><br><br>
    					Daybook For The Date <?php if (isset($date)){echo date('d-m-Y',strtotime($date));};?></h4>
    					</td>
    				</tr>
					<tr>
					  <th scope="col" width="">SL No</th>
            <th scope="col" width=""> DATE</th>
            <th scope="col" width="">LEDGER</th>
            <th scope="col" width="" style="text-align: right;">DEBIT</th>
            <th scope="col" width="" style="text-align: right;">CREDIT</th>
                                          
					 
					</tr>
				  </thead>
				  <tr>
          <td></td>
          <td></td>
          <td><strong style="margin-bottom: 5px;display: block; color:green;">OPENING BALANCE</strong></td>
         <td style="text-align: right;">
            <?php
            if($rec<$pay){
              
               ?>
             <i class="fa fa-inr" aria-hidden="true"></i><?php echo (number_format($open_b, 2, '.', '')); ?>
             <?php } ?></td>
          <td style="text-align: right;">
            <?php
            if($rec>$pay){
              
               ?>
             <i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($open_b, 2, '.', '')); ?>
             <?php } ?></td>
            

          



				                  	<?php if(!empty($daybk)){
	                          $i=0;
	                          foreach($daybk as $val){ 
                            $originalDate = $val['payment_date'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            $type = $val['type'];
                    $ledid=$val['ledger'];
                  // echo $ledid;     
                               ?>
                               </tr>
				  <tbody>	
					<tr>
					  <td><?= ++$i; ?></td>
            <td><?= $newDate; ?></td>
					  <td><a href="<?php echo base_url();?>index.php/accounts/ledgerWiseReport/<?=$ledid?>" ><strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?= $val['name']; ?></strong></a></td>

            <td style="text-align: right;">
              <?php 
              if($type==1){
                ?>
                 <span><i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($val['amount'], 2, '.', '')); ?></span>
              
          <?php }?>
          </td>
          <td style="text-align: right;">
            <?php
            if($type==2){
              
               ?>
               <span><i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($val['amount'], 2, '.', '')); ?></span>
             <?php } ?></td>

          
					</tr>
				  </tbody>
       

					<?php } } 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } 

            ?>	  


    <tfoot>
      <tr>
      <th colspan="3" style="text-align: right;color:gray;">TOTAL</th>
      <td colspan="1" style="text-align: right;"><span id="val"></span>
       <?php
            if($rec<$pay){
             
             $deb=$total_debit+$open_b;
             $total_d=$deb;
               ?>
        <i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($deb, 2, '.', '')); ?>
<?php } 
else 
{ 
    $total_d=$total_debit;
?>
<i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($total_debit, 2, '.', '')); ?>
      </td>
      <?php } ?>
      <td style="text-align: right;"> 
            <?php
            if($rec>$pay){
             
             $cre=$total_credit+$open_b;
             $total_c=$cre;
               ?>
        <i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($cre, 2, '.', '')); ?>
<?php } 
else 
{ 
    $total_c=$total_credit;
?>
<i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($total_credit, 2, '.', '')); ?>
         </td>
        <?php } ?>
    </tr>
    <tr>
    <th colspan="3" style="text-align: right;color:gray;">Closing Balance</th>
	<?php if ($total_c>$total_d) {
	    $clossing=$total_c;?>
	<td style="text-align: right;"><span id="val"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($total_c-$total_d, 2, '.', '')); ?></span></td>
	<td></td>
	<?php }elseif ($total_c<$total_d){
	    $clossing=$total_d;?>
	<td></td>
  	<td style="text-align: right;"><span id="val"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($total_d-$total_c, 2, '.', '')); ?></span></td>
	<?php }?>
    </tr>
    <tr>
    	<th colspan="3" style="text-align: right;color:gray;">Grand Total</th>
    	<th style="text-align: right;"><?php echo (number_format($clossing, 2, '.', ''));?></th>
    	<th style="text-align: right;"><?php echo (number_format($clossing, 2, '.', ''));?></th>
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
