<?php 
	$strNo = rand(1,10000000000);
    $strNo1 = rand(1,1000000);
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
                                	        $pooja_rt=$val['rate'];
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
                         	<div id="txnSubmitFrmDiv"></div>
                         	
                         	<?php if(isset($is_donation) && $is_donation != 1) { ?>
                                    <a href="<?php echo base_url(); ?>index.php/worldline/review"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
                             <?php } else { ?>
									<a href="<?php echo base_url(); ?>index.php/worldline/donation"><input type="button" value="Back" class="btn btn-warning cart_btn"></a>
							 <?php } ?>
                            <input type="button" name="date" value="Pay Amount" id="make_payment_btn" data-gateway="<?= $payment_gateway ?>" class="btn btn-success">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript" src="https://www.paynimo.com/Paynimocheckout/server/lib/checkout.js"></script>
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
        console.log(gateway)
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
            formData.append('payeramount', '<?php echo ($amount); ?>');
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
 			let form = $('<form method="post" id="txnSubmitFrm"></form>');
 			let formData = '<input type="hidden" name="mrctCode" value="<?php if(isset($settings['merchantCode'])){echo $settings['merchantCode'];} ?>" />'+
 						   '<input type="hidden" name="txn_id" value="<?php echo $strNo; ?>" />'+
                		   '<input type="hidden" id="myamount" name="amount" value="<?php echo $amount; ?>" />'+
            			   '<input type="hidden" name="scheme" value="<?php if(isset($settings['merchantSchemeCode'])){echo $settings['merchantSchemeCode'];} ?>" />'+
        				   '<input type="hidden" name="custID" value="<?php echo 'c'.$strNo1; ?>" />'+
                           '<input type="hidden" name="mobNo" value="" />'+
                           '<input type="hidden" name="email" value="test@gmail.com" />'+
                           '<input type="hidden" name="currency" value="<?php if(isset($settings['currency'])){echo $settings['currency'];} ?>"/>'+
                           '<input type="hidden" name="SALT" value="<?php if(isset($settings['salt'])){echo $settings['salt'];} ?>" />'+
                           '<input type="hidden" name="returnUrl" value="<?php echo $host.'://'.$_SERVER["HTTP_HOST"].'/index.php/worldline/response';?>" />'+
                           '<input type="hidden" name="accNo" value="" />'+
                           '<input type="hidden" name="accountType" value="" />'+
                           '<input type="hidden" name="accountName" value="" />'+
                           '<input type="hidden" name="aadharNumber" value="" />'+
                           '<input type="hidden" name="ifscCode" value="" />'+
                           '<input type="hidden" name="debitStartDate" value="" />'+
                           '<input type="hidden" name="maxAmount" value="" />'+
                           '<input type="hidden" name="amountType" value="" />'+
                           '<input type="hidden" name="frequency" value="" />'+
                           '<input type="hidden" name="cardNumber" value="" />'+
                           '<input type="hidden" name="expMonth" value="" />'+
                           '<input type="hidden" name="expYear" value="" />'+
                           '<input type="hidden" name="cvvCode" value="" />'+
                           '<input type="hidden" name="debitEndDate" value="" />'+
                           '<input type="hidden" name="name" value="" />';
                           // '<input type="hidden" name="mobNo" value="" />'+
                           // '<input type="hidden" name="mobNo" value="" />';
 			form.append(formData)
 			$('#txnSubmitFrmDiv').append(form)
        
        	var str = $("#txnSubmitFrm").serialize();
            $.ajax({
                    type: 'POST',
                    cache: false,
                    data: str,
                    url: "<?php echo base_url(); ?>index.php/onlinepayment/worldline_payment",                                            
                    success: function (response)
                    {
                        var obj = JSON.parse(response);
                    	
                        function handleResponse(res)
                        {
                            if (typeof res != 'undefined' && typeof res.paymentMethod != 'undefined' && typeof res.paymentMethod.paymentTransaction != 'undefined' && typeof res.paymentMethod.paymentTransaction.statusCode != 'undefined' && res.paymentMethod.paymentTransaction.statusCode == '0300') {
                        // success block
                            } else if (typeof res != 'undefined' && typeof res.paymentMethod != 'undefined' && typeof res.paymentMethod.paymentTransaction != 'undefined' && typeof res.paymentMethod.paymentTransaction.statusCode != 'undefined' && res.paymentMethod.paymentTransaction.statusCode == '0398') {
                        // initiated block
                            } else {
                        // error block
                            }   
                        };
                    
                        var configJson = 
                        {
                            'tarCall': false,
                            'features': {
                                'showPGResponseMsg': true,
                                'enableNewWindowFlow': <?php if($settings['enableNewWindowFlow'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,   //for hybrid applications please disable this by passing false
                                'enableAbortResponse': true,
                                'enableExpressPay': <?php if($settings['enableExpressPay'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,  //if unique customer identifier is passed then save card functionality for end  end customer
                                'enableInstrumentDeRegistration': <?php if($settings['enableInstrumentDeRegistration'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,  //if unique customer identifier is passed then option to delete saved card by end customer
                                'enableMerTxnDetails': true,
                                'siDetailsAtMerchantEnd': <?php if($settings['enableSIDetailsAtMerchantEnd'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'enableSI': <?php if($settings['enableEmandate'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'hideSIDetails': <?php if($settings['hideSIConfirmation'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'enableDebitDay': <?php if($settings['enableDebitDay'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'expandSIDetails': <?php if($settings['expandSIDetails'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'enableTxnForNonSICards': <?php if($settings['enableTxnForNonSICards'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'showSIConfirmation': <?php if($settings['showSIConfirmation'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'showSIResponseMsg': <?php if($settings['showSIResponseMsg'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                            },
                            
                            'consumerData': {
                                'deviceId': 'WEBSH2',
                                //possible values 'WEBSH1', 'WEBSH2' and 'WEBMD5'
                                //'debitDay':'10',
                                'token': obj['hash'],
                                'returnUrl': obj['data'][12],
                                /*'redirectOnClose': 'https://www.tekprocess.co.in/MerchantIntegrationClient/MerchantResponsePage.jsp',*/
                                'responseHandler': handleResponse,
                                'paymentMode': '<?php if(isset($settings['paymentMode'])){ echo $settings['paymentMode']; } ?>',
                                'checkoutElement': '<?php if($settings['embedPaymentGatewayOnPage'] == "1"){ echo "#worldline_embeded_popup"; } else { echo ""; } ?>',
                                'merchantLogoUrl': '<?php if(isset($settings['logoURL'])){ echo $settings['logoURL']; } ?>',  //provided merchant logo will be displayed
                                'merchantId': obj['data'][0],
                                'currency': obj['data'][15],
                                'consumerId': obj['data'][8],  //Your unique consumer identifier to register a eMandate/eNACH
                                'consumerMobileNo': obj['data'][9],
                                'consumerEmailId': obj['data'][10],
                                'txnId': obj['data'][1],   //Unique merchant transaction ID
                                'items': [{
                                    'itemId': 'FIRST', //obj['data'][14],
                                    'amount': obj['data'][2],
                                    'comAmt': '0'
                                }],
                                'cartDescription': '}{custname:'+obj['data'][13],
                                'merRefDetails': [
                                    {"name": "Txn. Ref. ID", "value": obj['data'][1]}
                                ],
                                'customStyle': {
                                    'PRIMARY_COLOR_CODE': '<?php if(isset($settings['primaryColor'])){ echo $settings['primaryColor']; } ?>',   //merchant primary color code
                                    'SECONDARY_COLOR_CODE': '<?php if(isset($settings['secondaryColor'])){ echo $settings['secondaryColor']; } ?>',   //provide merchant's suitable color code
                                    'BUTTON_COLOR_CODE_1': '<?php if(isset($settings['buttonColor1'])){ echo $settings['buttonColor1']; } ?>',   //merchant's button background color code
                                    'BUTTON_COLOR_CODE_2': '<?php if(isset($settings['buttonColor2'])){ echo $settings['buttonColor2']; } ?>'   //provide merchant's suitable color code for button text
                                },
                                'accountNo': obj['data'][11],    //Pass this if accountNo is captured at merchant side for eMandate/eNACH
                                'accountHolderName': obj['data'][16],  //Pass this if accountHolderName is captured at merchant side for ICICI eMandate & eNACH registration this is mandatory field, if not passed from merchant Customer need to enter in Checkout UI.
                                'ifscCode': obj['data'][17],        //Pass this if ifscCode is captured at merchant side.
                                'accountType': obj['data'][18],  //Required for eNACH registration this is mandatory field
                                'debitStartDate': obj['data'][3],
                                'debitEndDate': obj['data'][4],
                                'maxAmount': obj['data'][5],
                                'amountType': obj['data'][6],
                                'frequency': obj['data'][7]  //  Available options DAIL, WEEK, MNTH, QURT, MIAN, YEAR, BIMN and ADHO
                            }
                        };
                        
                        //console.log(configJson);       

                        $.pnCheckout(configJson);
                        if(configJson.features.enableNewWindowFlow)
                        {
                            pnCheckoutShared.openNewWindow();
                        }
                    }
            });
 			// $('#txnSubmitFrm').submit()
        }
        
        e.preventDefault();
        
    }
</script>
<!-- <script type="text/javascript">
    $(document).ready(function() {

        $("#btnSubmit").click(function(e){

            e.preventDefault();
            var str = $("#form").serialize();
            $.ajax({
                    type: 'POST',
                    cache: false,
                    data: str,
                    url: "payment_request.php",                                            
                    success: function (response)
                    {
                        var obj = JSON.parse(response);
                        function handleResponse(res)
                        {
                            if (typeof res != 'undefined' && typeof res.paymentMethod != 'undefined' && typeof res.paymentMethod.paymentTransaction != 'undefined' && typeof res.paymentMethod.paymentTransaction.statusCode != 'undefined' && res.paymentMethod.paymentTransaction.statusCode == '0300') {
                        // success block
                            } else if (typeof res != 'undefined' && typeof res.paymentMethod != 'undefined' && typeof res.paymentMethod.paymentTransaction != 'undefined' && typeof res.paymentMethod.paymentTransaction.statusCode != 'undefined' && res.paymentMethod.paymentTransaction.statusCode == '0398') {
                        // initiated block
                            } else {
                        // error block
                            }   
                        };

                        var configJson = 
                        {
                            'tarCall': false,
                            'features': {
                                'showPGResponseMsg': true,
                                'enableNewWindowFlow': <?php if($settings['enableNewWindowFlow'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,   //for hybrid applications please disable this by passing false
                                'enableAbortResponse': true,
                                'enableExpressPay': <?php if($settings['enableExpressPay'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,  //if unique customer identifier is passed then save card functionality for end  end customer
                                'enableInstrumentDeRegistration': <?php if($settings['enableInstrumentDeRegistration'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,  //if unique customer identifier is passed then option to delete saved card by end customer
                                'enableMerTxnDetails': true,
                                'siDetailsAtMerchantEnd': <?php if($settings['enableSIDetailsAtMerchantEnd'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'enableSI': <?php if($settings['enableEmandate'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'hideSIDetails': <?php if($settings['hideSIConfirmation'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'enableDebitDay': <?php if($settings['enableDebitDay'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'expandSIDetails': <?php if($settings['expandSIDetails'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'enableTxnForNonSICards': <?php if($settings['enableTxnForNonSICards'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'showSIConfirmation': <?php if($settings['showSIConfirmation'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                                'showSIResponseMsg': <?php if($settings['showSIResponseMsg'] == 1){ echo 'true'; }else{ echo 'false'; } ?>,
                            },
                            
                            'consumerData': {
                                'deviceId': 'WEBSH2',
                                //possible values 'WEBSH1', 'WEBSH2' and 'WEBMD5'
                                //'debitDay':'10',
                                'token': obj['hash'],
                                'returnUrl': obj['data'][12],
                                /*'redirectOnClose': 'https://www.tekprocess.co.in/MerchantIntegrationClient/MerchantResponsePage.jsp',*/
                                'responseHandler': handleResponse,
                                'paymentMode': '<?php if(isset($settings['paymentMode'])){ echo $settings['paymentMode']; } ?>',
                                'checkoutElement': '<?php if($settings['embedPaymentGatewayOnPage'] == "1"){ echo "#worldline_embeded_popup"; } else { echo ""; } ?>',
                                'merchantLogoUrl': '<?php if(isset($settings['logoURL'])){ echo $settings['logoURL']; } ?>',  //provided merchant logo will be displayed
                                'merchantId': obj['data'][0],
                                'currency': obj['data'][15],
                                'consumerId': obj['data'][8],  //Your unique consumer identifier to register a eMandate/eNACH
                                'consumerMobileNo': obj['data'][9],
                                'consumerEmailId': obj['data'][10],
                                'txnId': obj['data'][1],   //Unique merchant transaction ID
                                'items': [{
                                    'itemId': obj['data'][14],
                                    'amount': obj['data'][2],
                                    'comAmt': '0'
                                }],
                                'cartDescription': '}{custname:'+obj['data'][13],
                                'merRefDetails': [
                                    {"name": "Txn. Ref. ID", "value": obj['data'][1]}
                                ],
                                'customStyle': {
                                    'PRIMARY_COLOR_CODE': '<?php if(isset($settings['primaryColor'])){ echo $settings['primaryColor']; } ?>',   //merchant primary color code
                                    'SECONDARY_COLOR_CODE': '<?php if(isset($settings['secondaryColor'])){ echo $settings['secondaryColor']; } ?>',   //provide merchant's suitable color code
                                    'BUTTON_COLOR_CODE_1': '<?php if(isset($settings['buttonColor1'])){ echo $settings['buttonColor1']; } ?>',   //merchant's button background color code
                                    'BUTTON_COLOR_CODE_2': '<?php if(isset($settings['buttonColor2'])){ echo $settings['buttonColor2']; } ?>'   //provide merchant's suitable color code for button text
                                },
                                'accountNo': obj['data'][11],    //Pass this if accountNo is captured at merchant side for eMandate/eNACH
                                'accountHolderName': obj['data'][16],  //Pass this if accountHolderName is captured at merchant side for ICICI eMandate & eNACH registration this is mandatory field, if not passed from merchant Customer need to enter in Checkout UI.
                                'ifscCode': obj['data'][17],        //Pass this if ifscCode is captured at merchant side.
                                'accountType': obj['data'][18],  //Required for eNACH registration this is mandatory field
                                'debitStartDate': obj['data'][3],
                                'debitEndDate': obj['data'][4],
                                'maxAmount': obj['data'][5],
                                'amountType': obj['data'][6],
                                'frequency': obj['data'][7]  //  Available options DAIL, WEEK, MNTH, QURT, MIAN, YEAR, BIMN and ADHO
                            }
                        };
                        
                        //console.log(configJson);       

                        $.pnCheckout(configJson);
                        if(configJson.features.enableNewWindowFlow)
                        {
                            pnCheckoutShared.openNewWindow();
                        }
                    }
            });

        });
    });
</script> -->

</section>

 