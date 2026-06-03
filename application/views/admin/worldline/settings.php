<style>
	.form-control {
		color: darkmagenta !important;
    	border: 1px solid grey;
	}
</style>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt mb-0"> Worldline Master </h2>
        </div>
    </div>
    
	<div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               	<div class="row">
                  	<div class="col-lg-12 col-md-12 col-sm-12 ">
                    	<h3 class="page_txt mb-0"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update Worldline Settings </h3>
                  	</div>
			  	</div>
            	
               	<div class="row mt-5"> 
                  	<div class="col-lg-12 col-md-12 col-sm-12 ">
                  		<form action="<?php echo base_url(); ?>index.php/admin/worldline/update_settings" method="post" >
      						<table class="table table-hover">
							<tr class="info">
								<th width="30%">Description</th>
								<th width="70%">Worldline ePayments is India's leading digital payment solutions company. Being a company with more than 45 years of global payment experience, we are present in India for over 20 years and are powering over 550,000 businesses with our tailored payment solution.</th>
							</tr>
							<tr>
								<td><label>Merchant Code <span style="color:red;">*</span></label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="merchantCode" value="<?php if (isset($settings['merchantCode'])) {
																											echo $settings['merchantCode'];
																										} ?>" /></td>
							</tr>
							<tr>
								<td><label>Merchant Scheme Code <span style="color:red;">*</span></label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="merchantSchemeCode" value="<?php if (isset($settings['merchantSchemeCode'])) {
																													echo $settings['merchantSchemeCode'];
																												} ?>" /></td>
							</tr>
							<tr>
								<td><label>SALT <span style="color:red;">*</span></label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="salt" value="<?php if (isset($settings['salt'])) {
																									echo $settings['salt'];
																								} ?>" /></td>
							</tr>
							<tr>
								<td><label>Type of Payment <span style="color:red;">*</span></label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="typeOfPayment">
										<option value="TEST" <?php if (isset($settings['typeOfPayment']) && $settings['typeOfPayment'] == "TEST") {
																	echo 'selected="selected"';
																} ?>>TEST</option>
										<option value="LIVE" <?php if (isset($settings['typeOfPayment']) && $settings['typeOfPayment'] == "LIVE") {
																	echo 'selected="selected"';
																} ?>>LIVE</option>
									</select>	
									<p class="w-50 pl-5">For TEST mode amount will be charge 1</p>
								</td>
							</tr>
							<tr>
								<td><label>Currency</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="currency">
										<option value="INR" <?php if (isset($settings['currency']) && $settings['currency'] == "INR") {
																echo 'selected="selected"';
															} ?>>INR</option>
										<option value="USD" <?php if (isset($settings['currency']) && $settings['currency'] == "USD") {
																echo 'selected="selected"';
															} ?>>USD</option>
										<option value="YEN" <?php if (isset($settings['currency']) && $settings['currency'] == "YEN") {
																echo 'selected="selected"';
															} ?>>YEN</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label>Primary Color</label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="primaryColor" value="<?php if (isset($settings['primaryColor'])) {
																											echo $settings['primaryColor'];
																										} ?>" />	
									<p class="w-50 pl-5">Color value can be hex, rgb or actual color name</p>
								</td>
							</tr>
							<tr>
								<td><label>Secondary Color</label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="secondaryColor" value="<?php if (isset($settings['secondaryColor'])) {
																												echo $settings['secondaryColor'];
																											} ?>" />	
									<p class="w-50 pl-5">Color value can be hex, rgb or actual color name</p>
								</td>
							</tr>
							<tr>
								<td><label>Button Color 1</label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="buttonColor1" value="<?php if (isset($settings['buttonColor1'])) {
																											echo $settings['buttonColor1'];
																										} ?>" />	
									<p class="w-50 pl-5">Color value can be hex, rgb or actual color name</p>
								</td>
							</tr>
							<tr>
								<td><label>Button Color 2</label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="buttonColor2" value="<?php if (isset($settings['buttonColor2'])) {
																											echo $settings['buttonColor2'];
																										} ?>" />	
									<p class="w-50 pl-5">Color value can be hex, rgb or actual color name</p>
								</td>
							</tr>
							<tr>
								<td><label>Logo URL</label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="logoURL" value="<?php if (isset($settings['logoURL'])) {
																										echo $settings['logoURL'];
																									} else{echo "https://www.paynimo.com/CompanyDocs/company-logo-md.png";} ?>" />	
									<p class="w-50 pl-5">An absolute URL pointing to a logo image of merchant which will show on checkout popup</p>
								</td>
							</tr>
							<tr>
								<td><label>Enable ExpressPay</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="enableExpressPay">
										<option value="1" <?php if (isset($settings['enableExpressPay']) && $settings['enableExpressPay'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['enableExpressPay']) && $settings['enableExpressPay'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">To enable saved payments set its value to yes</p>
								</td>
							</tr>
							<tr>
								<td><label>Separate Card Mode</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="separateCardMode">
										<option value="1" <?php if (isset($settings['separateCardMode']) && $settings['separateCardMode'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['separateCardMode']) && $settings['separateCardMode'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">If this feature is enabled checkout shows two separate payment mode(Credit Card and Debit Card)</p>
								</td>
							</tr>
							<tr>
								<td><label>Enable New Window Flow</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="enableNewWindowFlow">
										<option value="1" <?php if (isset($settings['enableNewWindowFlow']) && $settings['enableNewWindowFlow'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['enableNewWindowFlow']) && $settings['enableNewWindowFlow'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">If this feature is enabled, then bank page will open in new window</p>
								</td>
							</tr>
							<tr>
								<td><label>Merchant Message</label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="merchantMessage" value="<?php if (isset($settings['merchantMessage'])) {
																												echo $settings['merchantMessage'];
																											} ?>" /></td>
							</tr>
							<tr>
								<td><label>Disclaimer Message</label></td>
								<td class="d-flex flex-row"><input class="form-control w-50" type="text" name="disclaimerMessage" value="<?php if (isset($settings['disclaimerMessage'])) {
																												echo $settings['disclaimerMessage'];
																											} ?>" /></td>
							</tr>
	
							<tr>
								<td><label>Payment Mode</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="paymentMode">
										<option value="all" selected="selected">all</option>
										<option value="cards">cards</option>
										<option value="netBanking">netBanking</option>
										<option value="UPI">UPI</option>
										<option value="imps">imps</option>
										<option value="wallets">wallets</option>
										<option value="cashCards">cashCards</option>
										<option value="NEFTRTGS">NEFTRTGS</option>
										<option value="emiBanks">emiBanks</option>
									</select>	
									<p class="w-50 pl-5">If Bank selection is at worldline ePayments India Pvt. Ltd. (a Worldline brand) end then select all, if bank selection at Merchant end then pass appropriate mode respective to selected option</p>
								</td>
							</tr>
							<tr>
								<td><label>Payment Mode Order</label></td>
								<td class="d-flex flex-row"><textarea class="form-control w-50" rows="3" name="paymentModeOrder"><?php if (isset($settings['paymentModeOrder'])) {
																										echo $settings['paymentModeOrder'];
																									} ?></textarea>	
									<p class="w-50 pl-5">Please pass order in this format: cards,netBanking,imps,wallets,cashCards,UPI,MVISA,debitPin,NEFTRTGS,emiBanks. Merchant can define their payment mode order</p>
								</td>
							</tr>
							<tr>
								<td><label>Enable InstrumentDeRegistration</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="enableInstrumentDeRegistration">
										<option value="1" <?php if (isset($settings['enableInstrumentDeRegistration']) && $settings['enableInstrumentDeRegistration'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['enableInstrumentDeRegistration']) && $settings['enableInstrumentDeRegistration'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">If this feature is enabled, you will have an option to delete saved cards</p>
								</td>
							</tr>
	
							<tr>
								<td><label>Transaction Type</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="transactionType">
										<option value="SALE" <?php if (isset($settings['transactionType']) && $settings['transactionType'] == 'SALE') {
																	echo 'selected="selected"';
																} ?>>SALE</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label>Hide SavedInstruments</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="hideSavedInstruments">
										<option value="1" <?php if (isset($settings['hideSavedInstruments']) && $settings['hideSavedInstruments'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['hideSavedInstruments']) && $settings['hideSavedInstruments'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">If enabled checkout hides saved payment options even in case of enableExpressPay is enabled</p>
								</td>
							</tr>
							<tr>
								<td><label>Save Instrument</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="saveInstrument">
										<option value="1" <?php if (isset($settings['saveInstrument']) && $settings['saveInstrument'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['saveInstrument']) && $settings['saveInstrument'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable this feature to vault instrument</p>
								</td>
							</tr>
							<tr>
								<td><label>Display Transaction Message On Popup</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="displayTransactionMessageOnPopup">
										<option value="1" <?php if (isset($settings['displayTransactionMessageOnPopup']) && $settings['displayTransactionMessageOnPopup'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['displayTransactionMessageOnPopup']) && $settings['displayTransactionMessageOnPopup'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label>Embed Payment Gateway On Page</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="embedPaymentGatewayOnPage">
										<option value="1" <?php if (isset($settings['embedPaymentGatewayOnPage']) && $settings['embedPaymentGatewayOnPage'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['embedPaymentGatewayOnPage']) && $settings['embedPaymentGatewayOnPage'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label>Enable Emandate/SI</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="enableEmandate">
										<option value="1" <?php if (isset($settings['enableEmandate']) && $settings['enableEmandate'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['enableEmandate']) && $settings['enableEmandate'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable eMandate using this feature</p>
								</td>
							</tr>
							<tr>
								<td><label>Hide SI Confirmation</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="hideSIConfirmation">
										<option value="1" <?php if (isset($settings['hideSIConfirmation']) && $settings['hideSIConfirmation'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['hideSIConfirmation']) && $settings['hideSIConfirmation'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable this feature to hide SI details from the customer</p>
								</td>
							</tr>
							<tr>
								<td><label>Expand SI Details</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="expandSIDetails">
										<option value="1" <?php if (isset($settings['expandSIDetails']) && $settings['expandSIDetails'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['expandSIDetails']) && $settings['expandSIDetails'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable this feature to show eMandate/eNACH/eSign details in expanded mode by default</p>
								</td>
							</tr>
							<tr>
								<td><label>Enable Debit Day</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="enableDebitDay">
										<option value="1" <?php if (isset($settings['enableDebitDay']) && $settings['enableDebitDay'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['enableDebitDay']) && $settings['enableDebitDay'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable this feature to acccept debit day value eMandate/eNACH/eSign registration</p>
								</td>
							</tr>
							<tr>
								<td><label>Show SI Response Msg</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="showSIResponseMsg">
										<option value="1" <?php if (isset($settings['showSIResponseMsg']) && $settings['showSIResponseMsg'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['showSIResponseMsg']) && $settings['showSIResponseMsg'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable this feature to show eMandate/eNACH/eSign registrations details also in final checkout response</p>
								</td>
							</tr>
							<tr>
								<td><label>Show SI Confirmation</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="showSIConfirmation">
										<option value="1" <?php if (isset($settings['showSIConfirmation']) && $settings['showSIConfirmation'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['showSIConfirmation']) && $settings['showSIConfirmation'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable this feature to show confirmation screen for registration</p>
								</td>
							</tr>
							<tr>
								<td><label>Enable Txn For NonSI Cards</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="enableTxnForNonSICards">
										<option value="1" <?php if (isset($settings['enableTxnForNonSICards']) && $settings['enableTxnForNonSICards'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['enableTxnForNonSICards']) && $settings['enableTxnForNonSICards'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable this feature to proceed with a normal transaction with same card details</p>
								</td>
							</tr>
							<tr>
								<td><label>Show All Modes with SI</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="showAllModesWithSI">
										<option value="1" <?php if (isset($settings['showAllModesWithSI']) && $settings['showAllModesWithSI'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['showAllModesWithSI']) && $settings['showAllModesWithSI'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>	
									<p class="w-50 pl-5">Enable this feature to show all modes with SI</p>
								</td>
							</tr>
							<tr>
								<td><label>Enable SI Details At Merchant End</label></td>
								<td class="d-flex flex-row">
									<select class="form-control w-50" name="enableSIDetailsAtMerchantEnd">
										<option value="1" <?php if (isset($settings['enableSIDetailsAtMerchantEnd']) && $settings['enableSIDetailsAtMerchantEnd'] == 1) {
																echo 'selected="selected"';
															} ?>>Enable</option>
										<option value="0" <?php if (isset($settings['enableSIDetailsAtMerchantEnd']) && $settings['enableSIDetailsAtMerchantEnd'] == 0) {
																echo 'selected="selected"';
															} ?>>Disable</option>
									</select>
								</td>
							</tr>
	
							<tr>
								<td colspan=2>
									<input class="btn btn-info" type="submit" name="submit" value="Submit" />
								</td>
							</tr>
						</table>
						</form>
                  	</div>
			   	</div>
    		</div>
		</div> 
    </div>
</div>
<div class="clearfix"></div>