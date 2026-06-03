           <style>


/* body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
} */


.header {
  overflow: hidden;
  background-color: white;
  padding: 8px 4px;
}
.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}


.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: gray;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }

}
</style>

<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Accounts Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 " hidden>
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
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Cash & Bank </h2>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
        <div class="header">
  <div class="header-right">
    <a href="<?php echo base_url();?>index.php/accounts/viewLedger"><b>LEDGER</b></a>
    <a href="<?php echo base_url();?>index.php/accounts/viewReceipt"><b>RECEIPT</b></a>
    <a href="<?php echo base_url();?>index.php/accounts/viewPayment"><b>PAYMENT</b></a>
   </div>
   </div>
        </div>
			 </div>		
      
       <!-- SEARCH -->

<div class="row">

	      <div class="table-responsive"><br><br>
				<table class="table  table-hover srp_table" width="100%" border="1">
			  <thead>
					<tr>
					  <th scope="col" width="">SL No</th>
                      <th scope="col" width="">LEDGER GROUP</th>
                      <th scope="col" width="" style="text-align: right;"> BANK BALANCE</th>
					  <th scope="col" width="">ACTION</th>
					</tr>
				  </thead>
                    <?php 
                    
                
                         $cash_bank = $this->Accounts_model->getcash_bank();
                //print_r($cash_bank);exit;
                      //   $cash = $cash_bank[0]['cash_bal'];
                        // $bank = $cash_bank[1]['bank_bal'];
                       
                        $total_balance=0;
	                       foreach($cash_bank as $val){
                          //  $cash=$val[0]['cash_bal'];
                         //   $bank=$val['bank_bal'];
                           
                           $total_balance+=$val['balance']; ?>
                              
				  <tbody>
					<tr>
                      <td>1</td>
                      <td><a href="#"> <strong style="margin-bottom: 5px;display: block;text-transform: uppercase;"><?php echo $val['name'];?></strong></a></td>
                      <td style="text-align: right;"><span style="text-transform: capitalize;font-size: 12px;"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo (number_format($val['balance'], 2, '.', ''));?></span></td> 
                      <td><div class="btn-group">
						  <a href="" class="btn btn-outline-info" style="padding:6px;" title="Edit"> <i class="fa fa-print"></i></a> 
                          </div>
                            </td></tr>
                      <tr>
                     <?php } ?>
				  </tbody>
                  <tfoot>
      <tr>
      <th colspan="2" style="text-align: right;color:gray;"></i>TOTAL</th>
      <td style="text-align: right;"><i class="fa fa-inr" aria-hidden="true"> <?= (number_format($total_balance, 2, '.', '')); ?> </td>
          <td></td>
      
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