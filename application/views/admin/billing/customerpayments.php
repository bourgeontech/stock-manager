<?php date_default_timezone_set('Asia/Kolkata'); ?><style type="text/css">
.submit:focus {
  background:blue;
}
.ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;   
    padding: 4px 0;
    margin: 0 0 10px 25px;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
}

.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}

.ui-state-hover, .ui-state-active {
    color: #ffffff;
    text-decoration: none;
    background-color: #0088cc;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    background-image: none;
}
</style>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">Customer Payments</h4>
        </div>
            <div class="col-lg-3 col-md-3 col-sm-3 ">
            <a style="float:right;" href="<?php echo base_url();?>index.php/admin/admin/payablelist" class="btn btn-primary"> Pending Payments</a> 
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	           <div class="form_body">
                           <?php if (empty($customer)){ ?>
                                   <form action="<?php echo base_url(); ?>index.php/admin/admin/customerpayments" class="formValidate0" id="custform" method="post">
                           <?php  } else { ?>
                                   <form action="<?php echo base_url(); ?>index.php/admin/admin/savepayments" class="formValidate0" id="custform" method="post">
                           <?php } ?>
                                   
                                        <?php if (empty($customer)){ ?>
                                        <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                                            <input type="text" name="customername" id="customer-search" class="validate customer-search sq_form" placeholder="Search By Customer Name / Phone No / Bill Id." autocomplete="off"/>
                                            <input type="hidden" name="customer_id" id="customer-id"/>
                                        </div>
                                       </div>
                                        <?php } else { ?>
                                       <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                                            <h6>Name : <?= $customer['name']; ?></h6>
                                            <p>Phone : <?= $customer['mobile']; ?></p>
                                            <input type="hidden" name="customer_id" id="customer-id" value="<?= $customer['id']; ?>"/>
                                            <hr>
                                        </div>
                                       </div>
                                        <?php } ?>
                                   
                                   <div class="row">
                                        <div class="col s12">
                                            <?php if (!empty($customerinvoices)){  ?>
                                          <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                <th>#</th>  
                                                <th>Bill No</th>
                                                <th>Bill Date</th>
                                                <th>Amount</th>
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th>Payable</th>
                                              </tr>
                                          </thead>  
                                          <tbody>
                                          <?php 
                                            $visible = 'hidden';   
											$total_payable = 0;

                                            foreach ($customerinvoices as $key => $item){
                                            $bill_id = $item['id'];
                                            $query = $this->db->query("SELECT SUM(amount) as paid_amount FROM payment WHERE ref_no='$bill_id'")->row();
											$paid_amount = $query->paid_amount + $item['recv_amt'];
                                            
                                            
                                            if ($item['total']!=($paid_amount)){ 
                                                    $visible = '';
                                            		if(is_numeric($paid_amount)) {  $total_payable += ($item['total'] - ($paid_amount??0)); }
                                              ?>
                                              <tr>
                                                <td><p>
                                                    <label>
                                                      <input id="<?= $key; ?>" class="checkcalc" type="checkbox" name="invoice_id[]" value="<?= $item['id']; ?>" 
                                                           data-total="<?= $item['total']; ?>" data-paid="<?= $paid_amount; ?>" data-balance="" />
                                                      <span></span>
                                                    </label>
                                                  </p></td>
                                                <td><?= $item['id']; ?></td>
                                                <td><?= date('d-m-Y',strtotime($item['date'])); ?></td>
                                                <td><input id="total-<?=$key; ?>" class="form-control" value="<?= $item['total']; ?>"  readonly/></td>
                                                <td><input id="paid-<?=$key; ?>" class="form-control" value="<?= $paid_amount ?? 0; ?>" readonly/></td>
                                                <td><input id="balance-<?=$key; ?>" class="form-control" value="<?php if(is_numeric($paid_amount)) { echo ($item['total'] - ($paid_amount??0)); } ?>" readonly/></td>
                                                <td><input id="payamount-<?=$key; ?>" class="form-control payamount" name="payamount[<?= $item['id']; ?>]" value="0.00" /></td>
                                              </tr>
                                          <?php } } ?>
                                        </tbody>
                                        <tfoot <?= $visible; ?>>
                                           <tr>
                                               <td colspan="5">Total Payable</td>
                                           	   <td><input id="payable" value="<?= $total_payable ?>"  class="form-control fw-bold" readonly/></td>
                                               <td><input id="payable-total" value="0.00"  class="form-control" readonly/></td>
                                           </tr>
                                        <tr>  <td colspan="6">Choose Mode of Payment</td><td> <select id="mode" name="mode" class="sq_form" required onchange="openpaydetails()" tabindex="11">
                         
<!--                           				<option value="9" selected="selected">Cash</option>
                          				<option value="6">QR Code</option> -->
                                        
                                        	<?php foreach($mode as $val){ ?>
                        						<option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>
                      	 					<?php } ?>
                                        </select></td></tr>
                                        </tfoot>
                                        </table>
                                        <div class="col s12" <?= $visible; ?>>
                                            <button type="submit" class="right btn waves-effect waves-light">Save</button>
                                        </div>   
                                       <?php } ?>
                                        </div>
                                         
                                    </div>
                                </form>
               </div>
			 <!--form-->
			</div> 
          </div>
	    </div>
       </div>
    <div class="clearfix"></div>
    <br>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> 
    <script>
            $.noConflict();
            jQuery(document).ready(function($) {
                    $("#checkbox-all").change(function () {
                        $("input:checkbox").prop('checked', $(this).prop("checked"));
                    });

                    $(".checkcalc").change(function () {
                        var id = $(this).prop("id");
                        if($("#"+id).is(':checked')){
                            var total = $('#total-'+id).val();
                            var paid = $('#paid-'+id).val();
                            var balance = $('#balance-'+id).val();
                            $('#payamount-'+id).val(balance);
                            calcAll();
                        } else {
                            $('#payamount-'+id).val("0.00");
                            calcAll();
                        }  
                    });
                    $(".payamount").keyup(function () {
                        var payid = $(this).prop("id");
                        var id = payid.split("-")[1];
                        $("#"+id).prop( "checked", true );
                        calcAll();
                    });

                    // Search End Product
                    var cust_url =   "<?php echo base_url(); ?>index.php/admin/admin/getCustomerByNamePhoneBill";
                     $('#customer-search').autocomplete({
                         source: function( request, response ) {
                            $.ajax({
                                url:cust_url,
                                type: 'post',
                                dataType: "json",
                                data:{
                                    _token: "", 
                                    keyword:request.term
                                },
                                success: function( data ) {
                                    response( data );
                                }
                            });
                        },
                        select: function (event, ui) {
                        	
                            $('#customer-id').val(ui.item.id); 
                            $("#custform" ).submit();
                            return false;
                        }
                     });

                     
                     
                });
                

                function calcAll(){
                    var grandTotal = 0;
                    $(".payamount").each(function() {
                        grandTotal += parseFloat($(this).val()); 
                    });
                    $("#payable-total").val(grandTotal);
                }
                


            </script>    