<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    

.custom-checkbox input[type=checkbox]
{
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  padding: 10px;
}


</style>
<div class="clearfix"></div>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Review </h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>

    <form action="<?php echo base_url(); ?>index.php/admin/schedulebilling/review" method="post" >
    <div class="row">
     	 <div class="col-lg-12">	
     	 <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
        	<table class="table table-hover" width="100%" border="1">
              	<thead>
            		<tr>
            			<td colspan="11" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
            			<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
            			</td>
            		</tr>
            		<tr>
            		    <td style="max-width:1cm;">#</td>
            		    <td>Name</td>
            		    <td>Name Locale</td>
            		    <td>Diety</td>
            		    <td>Star</td>
            		    <td>Poojaname</td>
            		    <td style="text-align:center">Date     </td>
            		    <td style="text-align:right">Qty</td>
            		    <td style="text-align:right">Rate</td>
                    	<td style="text-align:right">Amount</td>
                    	<td class="text-center">
                    	    <div class="form-check custom-checkbox">
            	                <input class="form-check-input" type="checkbox" id="overall">
            	            </div>
                    	</td>
                    	<td class="text-center"><button class="btn btn-danger btn-sm" type="button" id="overall_delete_btn" style="border-radius:15% !important"><i class="fa fa-trash" style="cursor: pointer;"></i></button></td>
            		</tr>
            	</thead>
            	<tbody>
            	    
            	    <?php
            	    
            	    $i=1;
            	    $total=0;
                  	$prasad_count = 0;
                	$grand_total  = 0;
                	$total_prasadam = 0;
                    $postal_charge = $temple_list[0]['postel_charge'];
                    
            	    foreach($bill_list_rate as $val){ 
            	        // $pooja_rt=$val['pooja_rt'];
            	        // $amt=$pooja_rt;
            	        $total+= ($val['pooja_rt'] * $val['qty']);
                        $total_prasadam += $val['prasadam_amt'];
            	        ?>
                 
            

            	        <tr>
            	            <td><?php echo $i;?></td>
            	            <td><?php echo $val['name'];?></td>
            	            <td><?php echo $val['name_locale'];?></td>
            	            <td><?php echo $val['diety_nm'];?></td>
            	            <td><?php echo $val['star_eng'];?></td>
            	            <td><?php echo $val['pooja_nm'];?></td>
            	            <td style="text-align:Center"><?php echo date('d-m-Y',strtotime($val['date']));?> </td>
                        
                        	<td style="text-align:right"><?php echo $val['qty'];?></td>
            	            <td style="text-align:right"><?php echo $val['pooja_rt'];?></td>
                        	<td style="text-align:right"><?php echo $val['pooja_rt'] * $val['qty'];?></td>
            	             <td class="text-center">
            	                 <div class="form-check custom-checkbox">
            	                    <input class="form-check-input child-checkbox" type="checkbox" value="<?php echo $val['id'];?>">
            	                 </div>
            	             </td>
                             <td class="text-center"><div class="mx-auto" style="background-color: red;width: 23px;height: 50%;text-align: center;color: white;border-radius: 20%;"><i class="fa fa-minus" onclick="return deletebook(this)" id="<?php echo $val['id'];?>" style="cursor: pointer;"></i><input type="hidden" id="bill_id_<?php echo $val['id'];?>"value="<?php echo $val['id'];?>"></div></td>

                        	<!-- <td><a class="deleteBook" style="background-color: red;width: 100%;height: 50%;text-align: center;color: white;border-radius: 20%;"><i class="fa fa-minus"  id="<?php echo $val['id'];?>" style="cursor: pointer;"></i></a></td> -->
            	        </tr>
                      <!-- <input type="hidden" id="bill_id_<?php echo $val['id'];?>" data-amt="<?php echo $amt;?>" value="<?php echo $val['id'];?>"> -->
                      <!-- onclick="return deletebook(this)" -->
            	    <?php 
            	        $i++;
            	    }?>
            	</tbody>
            	<tfoot>
                     <?php 
                         $i=1;
                         $tt=0;
                         $csum=0;
                		 $grand_total += $total;
                		 
                         foreach($bill_list_r as $val){
                  					$c=$val['count'];
                  					$t=$val['total'];
                  					$tt=$c*$t;
                  					$totals=$total + $tt;
                  					$csum+=$val['count'];
                  					
                		} ?>
          			 <tr>
                        <th colspan="9" style="text-align:right">Amount for Pooja</th>
                        <th style="text-align:right" id="grandtotal"><?php echo $total; ?></th>
                        <th colspan="2"></th>
                     </tr>
                
                	<?php 	
                            $grand_total += $total_prasadam;
                	?>
                    <tr>  
                        <th colspan="9" style="text-align:right">Total Postal Charge</th>
                        <th style="text-align:right"><?php echo $total_prasadam; ?> </th>
                    </tr>
                 <!--   <tr>  -->
                 <!--       <th colspan="6" style="text-align:right">Do you need Prasadham </th>-->
                 <!--       <th colspan="3">Yes <input type="radio"  name="postal_yes" class="prasadam_check" value="yes"> No <input type="radio" name="postal_yes" class="prasadam_check" value="no" checked /> </th>-->
                 <!--   </tr>-->
                 <!--   <tr class="ifYes">  -->
                 <!--       <th colspan="6" style="text-align:right">Choose the postal type </th>-->
                 <!--       <th colspan="3">Normal <input type="radio"  name="postal_type" class="postal_type" value="normal" data-rate="<?php print_r($postal_charge);?>" checked /> Air Mail <input type="radio" name="postal_type" class="postal_type" value="airmail" data-rate="<?php print_r($airmail_charge);?>" /> </th>-->
                 <!--   </tr>-->
                 <!--   <tr class="ifYes"  style="text-align:right">-->
            	    <!--    <th colspan="6">-->
                 <!--             <input type="hidden" id="main_total" value="<?php echo $grand_total;?>">-->
                 <!--             <input type="hidden" name="postel_rate" id="postel_rate" value="<?php print_r($temple_list[0]['postel_charge']);?>">-->
                 <!--             For sending prasadam <input type="number" min="0" id="count" name="count" onchange="changeamount()" onkeyup="changeamount()" value="0" style="padding:0 5px;width:15%;height:50%;color:black;"> time</th>-->
            	    <!--     <th colspan="1" style="text-align:right" name="prasadam_amt" id="postel_charge"><?php echo $pt = $csum *  $postal_charge ?> </th>-->
                 <!--        <th colspan="2"><input name="prasadam_amt" type="hidden" id="postel_charge_amt" value="<?php echo $pt = $csum *  $postal_charge ?>"> </th>-->
            	    <!--</tr>-->
            	    
                    <tr>
                        <th colspan="9" style="text-align:right">Grand total</th>
                        <th style="text-align:right" id="total"><?php echo $grand_total;?></th>
                        <th colspan="2"></th>
                    </tr>
                    
                    <tr>
                        <th colspan="4">Mode of Payment
                            <select name="mode" id="mode" class="sq_form" style="height:30px;" onchange="checkPaymentMode()" required>
<!--                             <?php foreach($mode as $val){ ?>
                               <option value="<?= $val['led_Id']; ?>"><?= $val['name']; ?></option>
                            <?php } ?> -->
                            <?php foreach($payment_modes as $mode): ?>
                 		    <option value="<?php echo $mode['id']; ?>" <?php if($mode['slug'] == 'cash') echo 'selected'; ?>><?php echo $mode['name']; ?></option>
                 		    <?php endforeach; ?>
                    		</select>
                            <input type="text" name="number" class="mode" placeholder="Number" style="padding:0 5px;height:25px;color:black;display: none;">
                            <input type="date" name="mode_date" class="mode" style="padding:0 5px;height:25px;color:black;display: none;">
                        </th>
                        <th colspan="4">Received Amount 
							<input id="recv_amt" type="text" name="recv_amt" onkeyup="checkBal()" class="sq_form"  placeholder=""  value="<?= $this->session->advance_amount > 0 ? $this->session->advance_amount : $grand_total;?>">                            
                        </th>
                    	<th colspan="4">Balance
							<input id="bal_amt" type="text" name="bal_amt" class="sq_form" value="<?= $this->session->advance_amount > 0 ? ($this->session->advance_amount -  $grand_total): 0; ?>"  placeholder=""  readonly >                            
                        </th>
                    </tr>
                    <tr id="fordonation">
                        <th colspan="11">
                            <select class="sq_form" name="bal_amount_option" id="bal_amount_option" data-ledger_id="<?php echo $bill_lists['orders'][0]['led_id'] ?? '' ?>"> 
                            	<option value="">Choose the option that utilizes the remaining balance</option>
                        		<option value="donation">Donation</option>
                    			<option value="devotee_account">Devotee Account</option>
                            	<option value="devaswom_fund">Devaswom Fund</option>
                        	 </select>
                        	 <input type="hidden" name="customer_ledger_id" value="<?php echo $bill_lists['orders'][0]['led_id'] ?? '' ?>" />
                        	 <input id="bal" name="balance_amount" type="hidden" class="sq_form" />
                        </th>
                        <!--<th colspan="3">-->
                        <!--    <input class="sq_form" type="text" id="devotee_account_balance" placeholder="Devotee Account Balance" />-->
                        <!--</th>-->
                    </tr>
                	<tr id="ifNotCash">
                        <th colspan="12">
                            <input id="bank_reference_no" name="bank_reference_no" placeholder="Bank Reference No." type="text" class="sq_form" />
                        </th>
                    </tr>
                    <tr>
                        <th colspan="12" style="text-align:center">For Online Pooja booking please visit <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
                    </tr>
         
                </tfoot>
              </table>
              <div class="col-lg-12 csschange" align="center">
                  <input type="hidden" name="customer_id" value="<?php echo $bill_list_rate[0]['customer_id']; ?>">
                          <input type="hidden" name="total" id="tot" value="<?php echo $grand_total;?>">
                <a href="<?php echo base_url(); ?>index.php/admin/schedulebilling/multy_schedule_hierarchical_pooja"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
                <button type="submit" name="submit" value="save" class="btn btn-success">Confirm</button>
             </div>
              </div>
              </div>
        <!--<div class="col-lg-4 col-md-4 col-sm-4">	-->
        <!--<div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >-->
        <!--  <div class="mybooking cart">-->
        <!--    <div class="title" style="font-weight: bold;"><i class="fa fa-cart-arrow-down"></i> User Details </div>-->
        <!--       <div class="input-group mb-3">-->
        <!--           <input id="search-devotee" type="text" class="form-control"  placeholder="Search user by mobile number.">   -->
        <!--       		<span></span>	-->
        <!--        </div>-->
        <!--  <div id="search-indicator-devotee"></div>-->
        <!--    <div class="cart_details mt-3">-->
        <!--      <div class="form-group csschange">-->
        <!--        <select name="user_type" class="form-control">-->
        <!--            <option value="A">One Time</option>-->
        <!--            <option value="B">Recurring</option>-->
        <!--        </select>-->
        <!--        <?php echo form_error('reference_no', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="reference_no" type="text" id="reference_no" placeholder="Reference No *" class="form-control" value="<?php echo $bill_lists['orders'][0]['reference_no'] ?? '' ?>">-->
        <!--        <?php echo form_error('reference_no', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="name" type="text" id="name" placeholder="Name *" class="form-control" value="<?php echo $bill_lists['orders'][0]['name'] ?? '' ?>">-->
        <!--        <input type="hidden" name="total" id="tot" value="<?php echo $grand_total;?>">-->
        <!--        <?php echo form_error('name', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="house" type="text" id="house" placeholder="House Name *" class="form-control" value="<?php echo $bill_lists['orders'][0]['house'] ?? '' ?>">-->
        <!--        <?php echo form_error('house', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="street" type="text" id="street" placeholder="Street Name *" class="form-control" value="<?php echo $bill_lists['orders'][0]['street'] ?? '' ?>">-->
        <!--        <?php echo form_error('street', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="post" type="text" id="post" placeholder="PostOffice *" class="form-control" value="<?php echo $bill_lists['orders'][0]['post'] ?? '' ?>">-->
        <!--        <?php echo form_error('post', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="district" type="text" id="district" placeholder="District *" class="form-control" value="<?php echo $bill_lists['orders'][0]['district'] ?? '' ?>">-->
        <!--        <?php echo form_error('district', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="state" type="text" id="state" placeholder="State *" class="form-control" value="<?php echo $bill_lists['orders'][0]['state'] ?? '' ?>">-->
        <!--        <?php echo form_error('state', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="pincode" type="text" id="pincode" placeholder="Pincode *" class="form-control" value="<?php echo $bill_lists['orders'][0]['pincode'] ?? '' ?>">-->
        <!--        <?php echo form_error('pincode', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group">-->
        <!--        <input name="mobile" type="text" id="mobile" placeholder="Mobile No *" class="form-control" value="<?php echo $bill_lists['orders'][0]['mobile'] ?? '' ?>">-->
        <!--        <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--      <div class="form-group csschange">-->
        <!--        <input name="email" type="text" id="email" placeholder="Email *" class="form-control" value="<?php echo $bill_lists['orders'][0]['email'] ?? '' ?>">-->
        <!--        <?php echo form_error('email', '<div class="error">', '</div>'); ?>-->
        <!--      </div>-->
        <!--     </div> -->
        <!--     <div class="col-lg-12 cssmobile" align="center" style="display: none;">-->
        <!--        <a href="<?php echo base_url(); ?>index.php/admin/admin/schedule"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>-->
        <!--        <button type="submit" name="submit" value="otp" class="btn btn-success">Get Otp</button>-->
        <!--     </div>-->
        <!--     <div class="col-lg-12 csschange" align="center">-->
        <!--        <a href="<?php echo base_url(); ?>index.php/admin/billing/multy_schedule_hierarchical_pooja"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>-->
        <!--        <button type="submit" name="submit" value="save" class="btn btn-success">Confirm</button>-->
        <!--     </div>-->
        <!--    </div>-->
        <!--    </div>-->
          
        <!--  </div>-->
        <!--</div>-->
</form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $('.ifYes').hide();
    $('#fordonation').hide();
	$('#ifNotCash').hide();
    $('.prasadam_check').on('click', () => {
		var data = $('.prasadam_check:checked').val();
        if(data === 'yes'){
           $('.ifYes').show();
           
           var data = $('.postal_type:checked').val();
           let rate = $('.postal_type:checked').data('rate')
           $('#postel_rate').val(rate)
        }
    	else{
     		$('.ifYes').hide();
    	}
    });
    
    $('.postal_type').on('click', () => {
		var data = $('.postal_type:checked').val();
        let rate = $('.postal_type:checked').data('rate')
        $('#postel_rate').val(rate)
    });
    
    $('#overall').on('change', (e) => {
        e.target.checked ? $('.child-checkbox').prop('checked', true) : $('.child-checkbox').prop('checked', false)
        
    })
    
    $('#overall_delete_btn').on('click', () => {
        var url = '<?php echo base_url();?>index.php/admin/schedulebilling/deletebook';
        
        $('.child-checkbox').each((i, e) => {
            if(e.checked) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'id': e.value},
                    dataType: "json",
                    success: function (data) {
                        window.location.reload();
                    }
                });   
            }
        })
    	
    })

	function deletebook(obj){
		var id=document.getElementById('bill_id_'+obj.id).value;
		// var amt=document.getElementById('bill_id_'+obj.id).getAttribute('data-amt');
		// var tot=document.getElementById('total').innerHTML;
    	// var main=document.getElementById('main_total').value;
    	// var m_tot=parseInt(main)-parseInt(amt);
		// var total=parseInt(tot)-parseInt(amt);
		// var count=document.getElementById('count').value;
        var url = '<?php echo base_url();?>index.php/admin/schedulebilling/deletebook';
        window.location.reload();
    	$.ajax({
            type: "POST",
            url: url,
            data: {'id': id},
            dataType: "json",
            success: function (data) {
                window.location.reload();
            }
        });
        $(obj).closest('tr').remove();
		// document.getElementById('total').innerHTML=total;
		// document.getElementById('tot').value=total;
        // document.getElementById('main_total').value=m_tot;
        return false;

    }
//     function changeamount(){
// 	var rate=document.getElementById('postel_rate').value;
// 	var count=document.getElementById('count').value;
//     var charge=rate*count;
//     document.getElementById('postel_charge').innerHTML=charge;
// }
    function change_mode(){
    	var mode=$("#mode").val();
    	if(mode!="1"){
    		$(".mode").css("display", "inline");
    	}else{
        	$(".mode").css("display", "none");
        }
    }
	
    function checkPaymentMode(){
    	var mode=$("#mode").val();
    	if(mode!="1"){
    		$('#ifNotCash').show()
    	}else{
        	$('#ifNotCash').hide()
        }
    }

    function changeform(){
    	$("#fill").change(function() {
            if (this.checked) {
                $(".csschange").css("display", "none");
                $(".cssmobile").css("display", "block");
                $("#mobile").attr("placeholder", "Please Enter Your Registered Mobile No *");
            } else {
                $(".csschange").css("display", "block");
                $(".cssmobile").css("display", "none");
                $("#mobile").attr("placeholder", "Mobile No *");
            }
        });
    	
    }


    function checkBal(){
       var total =  parseInt($('#total').text());
       var rec_amt =  $('#recv_amt').val();
       var bal = total - rec_amt ;
       
       if(bal < 0) {
           $('#fordonation').show();
       } else {
           $('#fordonation').hide();
       }
       
       $('#bal_amt').val(Math.abs(bal));
    }
    
     $('#bal_amount_option').on('click', () => {
             if ($('#bal_amount_option').val() == 'devotee_account') {
                 $.ajax({
                   url:'<?php echo base_url(); ?>index.php/admin/admin/getDevoteeAccountBalance',
                   type: 'post',
                   dataType: "json",
                   data:{ 
                      ledger_id: $('#bal_amount_option').data('ledger_id'),
                   },
                   success: function( data ) {
                        console.log(data)
                        $('#devotee_account_balance').removeClass('d-none')
                        $('#devotee_account_balance').val(data.balance)
                   }
                });
             } else {
                 $('.devotee_account_balance').addClass('d-none')
             }
             
         })

	function changeamount(){
    	var rate=document.getElementById('postel_rate').value;
    	var count=document.getElementById('count').value;
        var tot=document.getElementById('main_total').value;
    	// alert(tot);
        var charge=rate*count;
        var total=parseInt(tot)+parseInt(charge);
        document.getElementById('postel_charge').innerHTML=charge;
 		document.getElementById('postel_charge_amt').value=charge;
        document.getElementById('total').innerHTML=total;
        document.getElementById('tot').value=total;
		$('#recv_amt').val(total)
 		var rec_amt =  $('#recv_amt').val();
       	var bal = total - rec_amt ;
       	$('#bal_amt').val(bal);
    }

// 	$('#search-devotee').on('keyup', (e) => {
    	
//    		 $.ajax({
//                 url: '<?php echo base_url();?>index.php/admin/admin/search_devotee',
//                 type: 'post',
//                 dataType: "json",
//                 data:{
//                     search: e.target.value
//                 },
//                 // beforeSend: function() {
//                 //     $('#devotee-placeholder').html('')
//                 //     $('#search-indicator-devotee').html('<small class="text-primary">Loading...Please Wait!</small><div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" aria-hidden="true"></div>');
//                 // },
//                 success: function( data ) {
//                 	console.log(data);
//                     // if(data.length > 0){
//                     //     response( data );
//                     // }
//                     // else{
//                     //     $('#search-devotee').val('');
//                     //     $('#search-indicator-devotee').html('<small class="text-danger">No Data Found!</small>');
//                     //     return false;
//                     // }
//                 }
//             });
//     })
	$("#search-devotee").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: '<?php echo base_url();?>index.php/admin/admin/search_devotee',
                type: 'post',
                dataType: "json",
                data:{
                    search: request.term
                },
                beforeSend: function() {
                    $('#devotee-placeholder').html('')
                    $('#search-indicator-devotee').html('<small class="text-primary">Loading...Please Wait!</small><div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" aria-hidden="true"></div>');
                },
                success: function( data ) {
                	
                    if(data.length > 0){
                        response( data );
                    }
                    else{
                        $('#search-devotee').val('');
                        $('#search-indicator-devotee').html('<small class="text-danger">No Data Found!</small>');
                        return false;
                    }
                }
            });
        },
        select: function (event, ui) {
            setDevotee(ui.item);
            $('#search-indicator-devotee').html('');
            return false;
        }
    });

function setDevotee(data){
    $('#name').val(data.name)
    $('#house').val(data.house)
    $('#post').val(data.post)
    $('#street').val(data.street)
    $('#district').val(data.district)
    $('#state').val(data.state)
    $('#pincode').val(data.pincode)
    $('#mobile').val(data.mobile)
    $('#email').val(data.email)
}
</script>
