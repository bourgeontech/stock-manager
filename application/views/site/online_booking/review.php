<div class="clearfix"></div>
<section class="site_inner">
    <div class="home_welcome">
      <div class="row">
        <div class="col-lg-12">
          <div class="home_about_block">
            <div class="container">
            <h2 class="title1 title1_left">Pooja Booking</h2>
            </div>
            <div class="inner_pak">
              <div class="row">
                <form action="<?php echo base_url(); ?>index.php/onlinepayment/review" method="post">
                <div class="col-lg-8 offset-lg-0">
                  <div class="accordion_d">
                    <div>Pooja Booking</div>
                      <div class="booking_outer">
                          <div class="row">
                            <div class="col-sm-12">
                            	<table class="table table-hover" width="100%" border="1">
                                  	<thead>
                                		<tr>
                                			<td colspan="8" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
                                			<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
                                			</td>
                                		</tr>
                                		<tr>
                                		    <td style="max-width:1cm;">#</td>
                                		    <td>Name</td>
                                		    <td>Diety</td>
                                		    <td>Star</td>
                                		    <td>Poojaname</td>
                                		    <td style="text-align:right">Date</td>
                                		    <td style="text-align:right">Amount</td>
                                        	<td></td>
                                		</tr>
                                	</thead>
                                	<tbody>
                                	    <?php
                                	    $i=1;
                                	    $total='0';
                                	    foreach($bill_list as $key => $val){ 
                                	        $pooja_rt=$val['pooja_rt'];
                                	        $amt=$pooja_rt;
                                	        $total=$total+$amt;
                                	        ?>
                                	        <tr>
                                	            <td><?php echo $i;?></td>
                                	            <td><?php echo $val['name'];?></td>
                                	            <td><?php echo $val['diety_nm'];?></td>
                                	            <td><?php echo $val['star_eng'];?></td>
                                	            <td><?php echo $val['pooja_nm'];?></td>
                                	            <td style="text-align:right"><?php echo date('d-m-Y',strtotime($val['date']));?></td>
                                	            <td style="text-align:right"><?php echo $amt;?></td>
                                            	<td><div style="background-color: red;width: 100%;height: 50%;text-align: center;color: white;border-radius: 20%;"><i class="fa fa-minus" onclick="return deletebook(this)" data-is_donation="<?php echo $is_donation;?>" id="<?php echo $key;?>" style="cursor: pointer;"></i><input type="hidden" id="bill_id_<?php echo $key;?>" data-amt="<?php echo $amt;?>" value="<?php echo $key;?>"></div></td>
                                	        </tr>
                                	    <?php 
                                	        $i++;
                                	    }?>
                                	</tbody>
                                	<tfoot>
<!--                                 	    <tr>
                                	        <th>
                                            <input type="hidden" id="main_total" value="<?php echo $total;?>">
                                            <input type="hidden" name="postel_rate" id="postel_rate" value="<?php print_r($temple_list[0]['postel_charge']);?>"></th>
                                	        <th colspan="5" style="text-align:right">For sending prasadam <input type="number" min="0" id="count" name="count" onchange="changeamount()" onkeyup="changeamount()" value="0" style="padding:0 5px;width:15%;height:50%;color:black;"> time @ Rs</th>
                                	        <th style="text-align:right" id="postel_charge">0</th>
                                	    </tr> -->
                                        <tr>
                                            <th></th>
                                            <th colspan="5" style="text-align:right">Total</th>
                                            <th style="text-align:right" id="total"><?php echo $total;?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="8" style="text-align:center">For Online Pooja booking please visite <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
                                        </tr>
                                    </tfoot>
                                  </table>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
                <?php 
                if (!isset($otp)){
                if(empty($user_list)){?>
                	<div class="col-lg-4">
                      <div class="mybooking cart">
                        <div class="title"><i class="fa fa-cart-arrow-down"></i> Billing Details </div>
                        <div class="cart_details">
                        <?php if (isset($error)&&$error=='1'){?>
                          <div class="form-group">
                            Sorry This Mobile No Does Not Exist
                          </div>
                        <?php }?>
                          <h6 class="fw-bold">If you have already used this site please enter mobile number and press search.</h6>
                          <div class="form-group csschange mt-3">
                          	<div class="input-group">
    							<input name="mobile" type="text" id="mobile" placeholder="Mobile" class="form-control" value="<?php echo $user_list[0]['mobile'];?>" >
   								<div class="input-group-append">
                                	<button class="btn btn-outline-dark" id="search_devotee" type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
    							</div>
							</div>
                          	<div id="search-indicator-devotee"></div>
                            <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="name" type="text" id="name" placeholder="Name *" class="form-control" >
                            <input type="hidden" name="total" id="tot" value="<?php echo $total;?>">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="house" type="text" id="house" placeholder="House Name" class="form-control" >
                            <?php echo form_error('house', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="street" type="text" id="street" placeholder="Street Name" class="form-control" >
                            <?php echo form_error('street', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="post" type="text" id="post" placeholder="PostOffice" class="form-control" >
                            <?php echo form_error('post', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="district" type="text" id="district" placeholder="District" class="form-control" >
                            <?php echo form_error('district', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="state" type="text" id="state" placeholder="State" class="form-control" >
                            <?php echo form_error('state', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="pincode" type="text" id="pincode" placeholder="Pincode" class="form-control" >
                            <?php echo form_error('pincode', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="email" type="text" id="email" placeholder="Email" class="form-control" >
                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                          </div>
                         </div> 
                         <div class="col-lg-12 cssmobile" align="center" style="display: none;">
                            <a href="<?php echo base_url(); ?>index.php/onlinepayment/booking"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
                            <button type="submit" name="submit" value="otp" class="btn btn-success">Get Otp</button>
                         </div>
                         <div class="col-lg-12 csschange" align="center">
                            <a href="<?php echo base_url(); ?>index.php/onlinepayment/booking"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
                            <button type="submit" name="submit" value="save" class="btn btn-success">Confirm</button>
                         </div>
                        </div>
                      </div>
                  <?php }else{?>
                      <div class="col-lg-4">
                      <div class="mybooking cart">
                        <div class="title"><i class="fa fa-cart-arrow-down"></i> User Details </div>
                        <div class="cart_details">
                          <h6 class="fw-bold">If you have already used this site please enter mobile number and press search.</h6>
                          <div class="form-group csschange mt-3">
                          	<div class="input-group">
    							<input name="mobile" type="text" id="mobile" placeholder="Mobile" class="form-control" value="<?php echo $user_list[0]['mobile'];?>" >
   								<div class="input-group-append">
                                	<button class="btn btn-outline-dark" id="search_devotee" type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
    							</div>
							</div>
                          	<div id="search-indicator-devotee"></div>
                            <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="name" type="text" id="name" placeholder="Name *" class="form-control" value="<?php echo $user_list[0]['name'];?>" >
                            <input type="hidden" name="total" id="tot" value="<?php echo $total;?>">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="house" type="text" id="house" placeholder="House Name" class="form-control" value="<?php echo $user_list[0]['house'];?>" >
                            <?php echo form_error('house', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="street" type="text" id="street" placeholder="Street Name" class="form-control" value="<?php echo $user_list[0]['street'];?>" >
                            <?php echo form_error('street', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="post" type="text" id="post" placeholder="Post Office" class="form-control" value="<?php echo $user_list[0]['post'];?>" >
                            <?php echo form_error('post', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="district" type="text" id="district" placeholder="District" class="form-control" value="<?php echo $user_list[0]['district'];?>" >
                            <?php echo form_error('district', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="state" type="text" id="state" placeholder="State" class="form-control" value="<?php echo $user_list[0]['state'];?>" >
                            <?php echo form_error('state', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="pincode" type="text" id="pincode" placeholder="Pincode" class="form-control" value="<?php echo $user_list[0]['pincode'];?>" >
                            <?php echo form_error('pincode', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="form-group csschange">
                            <input name="email" type="text" id="email" placeholder="Email" class="form-control" value="<?php echo $user_list[0]['email'];?>" >
                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                          </div>
                         </div> 
                         <div class="col-lg-12" align="center">
                            <a href="<?php echo base_url(); ?>index.php/onlinepayment/booking"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
                            <input type="submit"  name="submit" value="save" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-success">
                         </div>
                        </div>
                      </div>
                  <?php }}elseif(isset($otp)&&$otp=='1') {?>
                  <div class="col-lg-4">
                      <div class="mybooking cart">
                        <div class="title"><i class="fa fa-cart-arrow-down"></i> User Details </div>
                        <div class="cart_details">
                        <?php if (isset($error)&&$error=='2'){?>
                          <div class="form-group">
                            This Otp Is Incorrect
                          </div>
                        <?php }?>
                          <div class="form-group csschange">
                            <input name="otp" type="text" id="otp" placeholder="Please Enter Your otp *" class="form-control" >
                            <input name="mobile" type="hidden" id="mobile" value="<?php echo $mob;?>" class="form-control" >
                            <?php echo form_error('otp', '<div class="error">', '</div>'); ?>
                          </div>
                         </div> 
                         <div class="col-lg-12" align="center">
                            <a href="<?php echo base_url(); ?>index.php/onlinepayment/booking"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
                            <button type="submit" name="submit" value="check" class="btn btn-success">Check Otp</button>
                         </div>
                        </div>
                      </div>
                  <?php }?>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
	function deletebook(obj){
		var id=document.getElementById('bill_id_'+obj.id).value;
		var amt=document.getElementById('bill_id_'+obj.id).getAttribute('data-amt');
		var tot=document.getElementById('total').innerHTML;
    	// var main=document.getElementById('main_total').value;
    	// var m_tot=parseInt(main)-parseInt(amt);
		var total=parseInt(tot)-parseInt(amt);
		// var count=document.getElementById('count').value;
		// 
		var is_donation = obj.getAttribute('data-is_donation')
        console.log(id)
    	var url = (is_donation == 1) ? 
        				'<?php echo base_url();?>index.php/onlinepayment/discardDonation/'+id
        				: '<?php echo base_url();?>index.php/onlinepayment/discard/'+id
    	window.location.href = url
    	// $.ajax({
    	// type: "POST",
    	// url: url,
    	// data: {'id': id},
    	// dataType: "json",
    	// success: function (data) {
    	// window.location.reload();
    	// }
    	// });
        $(obj).closest('tr').remove();
		document.getElementById('total').innerHTML=total;
		document.getElementById('tot').value=total;
        // document.getElementById('main_total').value=m_tot;
        return false;
    }
    function changeamount(){
    	var rate=document.getElementById('postel_rate').value;
    	var count=document.getElementById('count').value;
        var tot=document.getElementById('main_total').value;
    	// alert(tot);
        var charge=rate*count;
        var total=parseInt(tot)+parseInt(charge);
        document.getElementById('postel_charge').innerHTML=charge;
        document.getElementById('total').innerHTML=total;
        document.getElementById('tot').value=total;
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

$('#search_devotee').on('click', () => {
		$.ajax({
                url: '<?php echo base_url();?>index.php/onlinepayment/search_devotee',
                type: 'post',
                dataType: "json",
                data:{
                    search: $('#mobile').val()
                },
                beforeSend: function() {
                    $('#devotee-placeholder').html('')
                    $('#search-indicator-devotee').html('<small class="text-primary">Loading...Please Wait!</small><div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" aria-hidden="true"></div>');
                },
                success: function( data ) {
                    if(data != 0){
                       setDevotee(data)
                       $('#search-indicator-devotee').html('')
                    }
                    else{
                        $('#search-indicator-devotee').html('<small class="text-danger">No Data Found!</small>');
                        return false;
                    }
                }
            });
})

// $("#mobile").autocomplete({
//         source: function( request, response ) {
        	
//             $.ajax({
//                 url: '<?php echo base_url();?>index.php/onlinepayment/search_devotee',
//                 type: 'post',
//                 dataType: "json",
//                 data:{
//                     search: request.term
//                 },
//                 beforeSend: function() {
//                     $('#devotee-placeholder').html('')
//                     $('#search-indicator-devotee').html('<small class="text-primary">Loading...Please Wait!</small><div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" aria-hidden="true"></div>');
//                 },
//                 success: function( data ) {
                	
//                     if(data.length > 0){
//                         response( data );
//                     }
//                     else{
//                         $('#mobile').val('');
//                         $('#search-indicator-devotee').html('<small class="text-danger">No Data Found!</small>');
//                         return false;
//                     }
//                 }
//             });
//         },
//         select: function (event, ui) {
//             setDevotee(ui.item);
//             $('#search-indicator-devotee').html('');
//             return false;
//         }
//     });

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

$(document).ready(() => {
    $('#tot').val($('#total').text())

})
</script>
