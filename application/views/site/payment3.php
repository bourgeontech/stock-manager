<?php 
	
	$characters = '012345678901234567890123456789';
    $randomString = '';
	
    for ($i = 0; $i < 30; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

/* Populate the above DTO Object On the Basis Of The Received Values */
	$merchantId= $worldline[0]->merchant_id;
	$encKey    = $worldline[0]->encryption_key;
	$returnUrl = $worldline[0]->return_url.'/index.php/worldline/response';
	// PG MID
	// $reqMsgDTO->setMid('WL0000000027698');
	$reqMsgDTO->setMid($merchantId);
	// Merchant Unique order id
	$reqMsgDTO->setOrderId($randomString);
	//Transaction amount in paisa format
	$amount = 0;
    foreach($bill_list as $bill) {
        $amount += $bill['total']; //+($bill['total']*$data['temple_list'][0]['payment_charge']/100)
    }
	$amount = $amount * 100;
	// $amount = ($bill_list[0]['total'] + $bill_list[0]['total']*$temple_list[0]['payment_charge']/100) * 100;
	$reqMsgDTO->setTrnAmt($amount);
	//Transaction remarks
	$reqMsgDTO->setTrnRemarks("Any Remarks");
	// Merchant transaction type (S/P/R)
	$reqMsgDTO->setMeTransReqType("S");
	// Merchant encryption key
	// $reqMsgDTO->setEnckey('6375b97b954b37f956966977e5753ee6');
	$reqMsgDTO->setEnckey($encKey);
	// Merchant transaction currency
	$reqMsgDTO->setTrnCurrency('INR');
	// Recurring period, if merchant transaction type is R
	$reqMsgDTO->setRecurrPeriod('');
	// Recurring day, if merchant transaction type is R
	$reqMsgDTO->setRecurrDay('');
	// No of recurring, if merchant transaction type is R
	$reqMsgDTO->setNoOfRecurring('');
	// Merchant response URl
	// $reqMsgDTO->setResponseUrl('http://vadakkantharatemple.in/index.php/worldline/response');
	$reqMsgDTO->setResponseUrl($returnUrl);
	// Optional additional fields for merchant
	// $reqMsgDTO->setAddField1($_REQUEST['addField1']);
	// $reqMsgDTO->setAddField2($_REQUEST['addField2']);
	// $reqMsgDTO->setAddField3($_REQUEST['addField3']);
	// $reqMsgDTO->setAddField4($_REQUEST['addField4']);
	// $reqMsgDTO->setAddField5($_REQUEST['addField5']);
	// $reqMsgDTO->setAddField6($_REQUEST['addField6']);
	// $reqMsgDTO->setAddField7($_REQUEST['addField7']);
	// $reqMsgDTO->setAddField8($_REQUEST['addField8']);
	
	/* 
	 * After Making Request Message Send It To Generate Request 
	 * The variable `$urlParameter` contains encrypted request message
	 */
	 //Generate transaction request message
	$merchantRequest = "";
	
	$reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);
	
	if ($reqMsgDTO->getStatusDesc() == "Success"){
		$merchantRequest = $reqMsgDTO->getReqMsg();
	}
?>
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
                <form action="<?php echo base_url(); ?>index.php/worldline/review" method="post">
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
                      <div class="entries-info text-center"><p><i>Please make the payment using any UPI app and click on proceed</i></div>
                         <div class="col-lg-12 pb-3" align="center">
                         	<div id="txnSubmitFrmDiv"></div>
                         	<img src="<?php echo base_url(); ?>/assets/images/qrcode/pranavamqrcode.jpeg" width="300">
                          <!--  <input type="button" name="date" value="Pay Amount" id="make_payment_btn"  class="btn btn-success">-->
                         <a href="<?php echo base_url(); ?>index.php/worldline/thankyouqrcode" class="btn btn-success">Proceed</a>
                        
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
<!-- 	<div class="col-lg-12" align="center">
                         <div id="txnSubmitFrmDiv"></div>
                         <form action="https://cgt.in.worldline.com/ipg/doMEPayRequest" method="post" id="txnSubmitFrm">
                            <a href="<?php echo base_url(); ?>index.php/worldline/review"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
                            <input type="submit" name="date" value="Pay Amount" id="make_payment" class="btn btn-success">
                         </form> 
                         
    </div> -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
       "key": "<?php echo $razorpay[0]->key_id; ?>", //latest: rzp_live_DXCjymOKv4eNz0 //"rzp_live_5d2La9FhpIFuVu",
      
		//"key":"rzp_test_yt3A6ZaVAibIKS",
		"amount": "<?php echo $order->amount; ?>",
    	"order_id": "<?php echo $order->id; ?>",
    	"currency": "<?php echo $order->currency; ?>",
        "name": "<?php print_r($temple_list[0]['name']);?>",
        "description": "Pooja Booking",
        "image": "<?php echo base_url(); ?>new_site/images/icons/icons5.png",
        "handler": function (response) {
            window.location = "<?php echo site_url("worldline/do_payment/") ?>"+response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?php echo $user_list[0]['name']; ?>",
            "email": "<?php echo $user_list[0]['email']; ?>",
            "contact": "<?php echo $user_list[0]['mobile']; ?>"
        },
        "notes": {
            "address": "<?php echo $user_list[0]['district']." , ".$user_list[0]['state']; ?>",
        	"reference_no": "<?php echo $this->session->reference_no; ?>"
        },
        "theme": {
            "color": "#253237"
        }
    };
    var razorpay = new Razorpay(options);

	
    document.getElementById('make_payment_btn').onclick = function (e) {
        let gateway = e.target.getAttribute('data-gateway');
        
        if(gateway == 1) {
            razorpay.open();
        } 
    	else if(gateway == 2) {
            // Create a new FormData object
            var formData = new FormData();
            
            // Append form data to the FormData object
            formData.append('payername', '<?php echo $user_list[0]['name']; ?>');
            formData.append('payerphone', '<?php echo $user_list[0]['mobile']; ?>');
            formData.append('payeremail', '<?php echo $user_list[0]['email']; ?>');
            formData.append('payeramount', '<?php echo ($amount/100); ?>');
            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            
            // Set up the XMLHttpRequest object
            xhr.open('POST', '/index.php/payment/pay', true);
            
            // Set the appropriate headers if required
            // xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            
            // Handle the response
            xhr.onload = function() {
              if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.url) {
                  window.location.href = response.url;
                } else {
                  console.log('No redirect URL received.');
                }
              } else {
                // Request failed
                console.log('Form submission failed.');
              }
            };
            
            
            // Send the FormData object with the XMLHttpRequest object
            xhr.send(formData);
        
        } 
        else if(gateway == 3) {
            let form = $('<form action="https://cgt.in.worldline.com/ipg/doMEPayRequest" method="post" id="txnSubmitFrm"></form>');
 			let formData = '<input type="hidden" size="200" name="merchantRequest" id="merchantRequest" value="<?php echo $merchantRequest; ?>"  />'+
						'<input type="hidden" name="MID" id="MID" value="<?php echo $reqMsgDTO->getMid(); ?>"/>';
 			form.append(formData)
 			$('#txnSubmitFrmDiv').append(form)
 			$('#txnSubmitFrmDiv').find('form').submit()
        }
        
        e.preventDefault();
        
    }
</script>
<!-- 	<script>
 
 document.getElementById('make_payment').onclick = function (e) {
 	// document.txnSubmitFrm.submit();
 		let form = $('<form action="https://cgt.in.worldline-solutions.com/ipg/doMEPayRequest" method="post" id="txnSubmitFrm"></form>');
 		let formData = '<input type="hidden" size="200" name="merchantRequest" id="merchantRequest" value="<?php echo $merchantRequest; ?>"  />'+
						'<input type="hidden" name="MID" id="MID" value="<?php echo $reqMsgDTO->getMid(); ?>"/>';
 		form.append(formData)
 		$('#txnSubmitFrmDiv').append(form)
 		console.log($('#txnSubmitFrmDiv'))
 		$('#txnSubmitFrmDiv').find('form').submit()
        e.preventDefault();
//         var formData = new FormData();
            
//             // Append form data to the FormData object
//             formData.append('merchantRequest', '<?php echo $merchantRequest; ?>');
//             formData.append('MID', '<?php echo $reqMsgDTO->getMid(); ?>');
//             // Create an XMLHttpRequest object
//             var xhr = new XMLHttpRequest();
            
//             // Set up the XMLHttpRequest object
//             xhr.open('POST', 'https://cgt.in.worldline.com/ipg/doMEPayRequest', true);
            
//             // Set the appropriate headers if required
//             // xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            
//             // Handle the response
//             xhr.onload = function() {
//               if (xhr.status === 200) {
//                 var response = JSON.parse(xhr.responseText);
//               	console.log(response)
//                 // if (response.url) {
//                 //   window.location.href = response.url;
//                 // } else {
//                 //   console.log('No redirect URL received.');
//                 // }
//               } else {
//                 // Request failed
//                 console.log('Form submission failed.');
//               }
//             };
            
            
//             // Send the FormData object with the XMLHttpRequest object
//             xhr.send(formData);
    }
</script> -->
</section>

 