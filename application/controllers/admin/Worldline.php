<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worldline extends CI_Controller {
	public function __construct(){
        parent::__construct();
    
        date_default_timezone_set("Asia/Calcutta");
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }
    	
    	$this->loggedIn=$this->session->admin;

		$strCurDate = date('d-m-Y');

		if (isset($_SERVER['HTTPS'])) {
    		$host = 'https';
		} else {
    		$host = 'http';
		}
    
    	$this->documentRoot = $_SERVER['DOCUMENT_ROOT'];

    	$database = $this->db->database;
    	$this->database = $database;
		$admin_data = @file_get_contents("$this->documentRoot/worldline/New/worldline_AdminData_$database.json");
    	
    	if ($admin_data === false) {
        	$admin_data = file_get_contents("$this->documentRoot/worldline/New/worldline_AdminData.json");
        }
    
		$this->mer_array = json_decode($admin_data, true);
    }
	
	// Settings
	public function settings() {
    	$data['settings'] = $this->mer_array;
    	    	
    	$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/worldline/settings', $data);
    	$this->load->view('admin/layouts/admin_footer');
    }

	// Update Settings
	public function update_settings() {
    	$inputs = $this->input->post();

    	$data = array(
            'merchantCode'							=> $inputs['merchantCode'],
            'merchantSchemeCode' 					=> $inputs['merchantSchemeCode'],
            'salt'									=> $inputs['salt'],
            'typeOfPayment' 						=> $inputs['typeOfPayment'],
            'currency' 								=> $inputs['currency'],
            'primaryColor' 							=> $inputs['primaryColor'],
            'secondaryColor'						=> $inputs['secondaryColor'],
            'buttonColor1' 							=> $inputs['buttonColor1'],
            'buttonColor2' 							=> $inputs['buttonColor2'],
            'logoURL'			 					=> $inputs['logoURL'],
            'enableExpressPay' 						=> $inputs['enableExpressPay'],
            'separateCardMode' 						=> $inputs['separateCardMode'],
            'enableNewWindowFlow'		 			=> $inputs['enableNewWindowFlow'],
            'merchantMessage' 						=> $inputs['merchantMessage'],
            'disclaimerMessage' 					=> $inputs['disclaimerMessage'],
            'paymentMode' 							=> $inputs['paymentMode'],
            'paymentModeOrder' 						=> $inputs['paymentModeOrder'],
            'enableInstrumentDeRegistration' 		=> $inputs['enableInstrumentDeRegistration'],
            'transactionType'						=> $inputs['transactionType'],
            'hideSavedInstruments' 					=> $inputs['hideSavedInstruments'],
            'saveInstrument' 						=> $inputs['saveInstrument'],
            'displayTransactionMessageOnPopup' 		=> $inputs['displayTransactionMessageOnPopup'],
            'embedPaymentGatewayOnPage' 			=> $inputs['embedPaymentGatewayOnPage'],
            'enableEmandate' 						=> $inputs['enableEmandate'],
            'hideSIConfirmation'					=> $inputs['hideSIConfirmation'],
            'expandSIDetails'						=> $inputs['expandSIDetails'],
            'enableDebitDay'						=> $inputs['enableDebitDay'],
            'showSIResponseMsg' 					=> $inputs['showSIResponseMsg'],
            'showSIConfirmation'					=> $inputs['showSIConfirmation'],
            'enableTxnForNonSICards' 				=> $inputs['enableTxnForNonSICards'],
            'showAllModesWithSI' 					=> $inputs['showAllModesWithSI'],
            'enableSIDetailsAtMerchantEnd' 			=> $inputs['enableSIDetailsAtMerchantEnd']
        );
    
        $newData 	= json_encode($data);
    	$database 	= $this->database;
        $path 		= $this->documentRoot.'/worldline/New/worldline_AdminData_'.$database.'.json';

        if(file_exists($path))
        {   
            unlink($path);
            if(file_put_contents( "$path", $newData ) ) 
            { 
                redirect('admin/worldline/settings');
            }
            else
            { 
                echo 'There is some error'; 
            }
        }
        else
        {
            if(file_put_contents( "$path", $newData ) ) 
            { 
                redirect('admin/worldline/settings');
            } 
            else
            { 
                echo 'There is some error'; 
            }
        }
    }


	// 
}