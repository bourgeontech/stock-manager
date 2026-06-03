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
                <form action="<?php echo base_url(); ?>index.php/welcome/review" method="post">
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
                                        	<?php if($is_donation != 1) { ?>
                                            	<td style="text-align:right">Date</td>
                                            <?php } ?>
                                		    <td style="text-align:right">Amount</td>
                                		</tr>
                                	</thead>
                                	<tbody>
                                	    <?php
                                	    $i=1;
                                	    $total='0';
                                	    foreach($bill_list as $val){ 
                                	        $pooja_rt=$val['pooja_rt'];
                                        	if($is_donation == 1) {
                                            	$amt=$pooja_rt;
                                            } else {
                                            	$amt=$pooja_rt;
                                            }
                                	        
                                	        $total=$total+$amt;
                                	        ?>
                                	        <tr>
                                	            <td><?php echo $i;?></td>
                                	            <td><?php echo $val['name'];?></td>
                                	            <td><?php echo $val['diety_nm'];?></td>
                                	            <td><?php echo $val['star_eng'];?></td>
                                	            <td><?php echo $val['pooja_nm'];?></td>
                                            	<?php if($is_donation != 1) { ?>
                                            	<td style="text-align:right"><?php echo date('d-m-Y',strtotime($val['date']));?></td>
                                            	<?php } ?>
                                	            
                                	            <td style="text-align:right"><?php echo $amt;?></td>
                                	        </tr>
                                	    <?php 
                                	        $i++;
                                	    }?>
                                	</tbody>
                                	<tfoot>
<!--                                 	    <tr>
                                	        <th></th>
                                	        <th colspan="5" style="text-align:right">For sending prasadam <?php echo $bill_list[0]['count'];?> time @ Rs</th>
                                	        <th style="text-align:right" id="postel_charge"><?php echo $temple_list[0]['postel_charge']*$bill_list[0]['count'];?></th>
                                	    </tr> -->
<!--                                     	<tr>
                                	        <th></th>
                                	        <th colspan="5" style="text-align:right">For Online Payment Charges <?php echo $temple_list[0]['payment_charge'];?> % Rs</th>
                                	        <th style="text-align:right" id="postel_charge"><?php echo $total_tax=$bill_list[0]['total']*$temple_list[0]['payment_charge']/100;?></th>
                                	    </tr> -->
                                        <tr>
                                            <th></th>
                                        	<?php if($is_donation != 1) { 
                                            		$colspan = 5;
                                            	} else {
													$colspan = 4;
											} ?>
                                            <th colspan="<?= $colspan; ?>" style="text-align:right">Total</th>
                                            <th style="text-align:right" id="total"><?php echo $total;?></th> <!-- $total_amd=$total_tax+$bill_list[0]['total'] -->
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
                	<div class="col-lg-4">
                      <div class="mybooking cart">
                        <div class="title"><i class="fa fa-cart-arrow-down"></i> User Details </div>
                            <div class="d-flex align-items-center justify-content-center" style="padding:1cm;">
                                <div class="entries-info text-center">
                                    <p><?php echo $user_list[0]['name'];?></p>
                                    <p><?php echo $user_list[0]['mobile'];?></p>
                                	<p><?php echo $user_list[0]['house']; ?> </p>
                                	<p><?php echo $user_list[0]['street']; ?> </p>
                                	<p><?php echo $user_list[0]['post'];?></p>
                                	<p><?php echo $user_list[0]['district']; ?></p>
                                	<p><?php echo $user_list[0]['state'];?></p>
                                	<p><?php echo $user_list[0]['pincode']?> </p>
                                    <p> <?php echo $user_list[0]['email'];?></p>
                                </div>
                            </div>
                         <div class="col-lg-12 pb-3" align="center">
                         	<?php if($is_donation != 1) { ?>
                                    <a href="<?php echo base_url(); ?>index.php/welcome/review"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
                             <?php } else { ?>
									<a href="<?php echo base_url(); ?>index.php/welcome/donation"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
							 <?php } ?>
                            
                            <input type="submit" name="date" value="Pay Amount" id="make_payment" class="btn btn-success">
                         </div>
                        </div>
                      </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
       "key": "rzp_live_DXCjymOKv4eNz0", //"rzp_live_5d2La9FhpIFuVu",
      
		//"key":"rzp_test_yt3A6ZaVAibIKS",
		"amount": "<?php echo $total*100; ?>",
        "name": "<?php print_r($temple_list[0]['name']);?>",
        "description": "Pooja Booking",
        "image": "<?php echo base_url(); ?>new_site/images/icons/icons5.png",
        "handler": function (response) {
            window.location = "<?php echo site_url("welcome/do_payment/") ?>"+response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?php echo $user_list[0]['name']; ?>",
            "email": "<?php echo $user_list[0]['email']; ?>",
            "contact": "<?php echo $user_list[0]['mobile']; ?>"
        },
        "notes": {
            "address": "<?php echo $user_list[0]['district']." , ".$user_list[0]['state']; ?>"
        },
        "theme": {
            "color": "#253237"
        }
    };
    var rzp1 = new Razorpay(options);


    document.getElementById('make_payment').onclick = function (e) {
        rzp1.open();
        e.preventDefault();
    }
</script> 