<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model( 'Cms_model' );
    }

    public function index(){
    		 $this->load->view('payment/index');
    }

    public function pay(){
    //   session_start();
        $payer_name = $_POST['payername'];
        $payer_phone = $_POST['payerphone'];
        $payer_email = $_POST['payeremail'];
        $amount = $_POST['payeramount']; 

        require_once 'Eazypay.php';
        $credentials = $this->Cms_model->getEazypayCredentials();
        $eazypay_integration = new Eazypay($credentials);
        $eazypay_integration->setParameter($credentials);
        $reference_no = rand(1000,9999);
        // call The method
        // $eazypay_integration=new Eazypay();
        $payment_url=$eazypay_integration->getPaymentUrl($amount, $reference_no , $optionalField=null);
        //echo $payment_url; exit;
        // header('Location: '.$payment_url);
        // exit;
        echo json_encode(array('url' => $payment_url));
     
    }

     public function response(){
     	if(isset($_POST) && isset($_POST['Total_Amount']) && $_POST['Response_Code'] == 'E000') {
        $res = $_POST;
        // Same encryption key that we gave for generating the URL
        $credentials = $this->Cms_model->getEazypayCredentials();
        $aes_key_for_payment_success = $credentials[0]->encryption_key;//6000040201105012;

        $data = array(
            'Response_Code'=> $res['Response_Code'],
            'Unique_Ref_Number'=> $res['Unique_Ref_Number'],
            'Service_Tax_Amount'=> $res['Service_Tax_Amount'],
            'Processing_Fee_Amount'=> $res['Processing_Fee_Amount'],
            'Total_Amount'=> $res['Total_Amount'],
            'Transaction_Amount'=> $res['Transaction_Amount'],
            'Transaction_Date'=> $res['Transaction_Date'],
            'Interchange_Value'=> $res['Interchange_Value'],
            'TDR'=> $res['TDR'],
            'Payment_Mode'=> $res['Payment_Mode'],
            'SubMerchantId'=> $res['SubMerchantId'],
            'ReferenceNo'=> $res['ReferenceNo'],
            'ID'=> $res['ID'],
            'RS'=> $res['RS'],
            'TPS'=> $res['TPS'],
        );
		
        
        $verification_key = $data['ID'].'|'.$data['Response_Code'].'|'.$data['Unique_Ref_Number'].'|'.
                $data['Service_Tax_Amount'].'|'.$data['Processing_Fee_Amount'].'|'.$data['Total_Amount'].'|'.
                $data['Transaction_Amount'].'|'.$data['Transaction_Date'].'|'.$data['Interchange_Value'].'|'.
                $data['TDR'].'|'.$data['Payment_Mode'].'|'.$data['SubMerchantId'].'|'.$data['ReferenceNo'].'|'.
                $data['TPS'].'|'.$aes_key_for_payment_success;

        $encrypted_message = hash('sha512', $verification_key);

        if($encrypted_message == $data['RS']) {
        	$payment = $data['Total_Amount'];
            $amd = $payment;
            $json_encode = json_encode($payment);
            $mobile=$this->session->mobile_no;
            $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
            $user_dtl = $query->first_row();
            $customer_id = $user_dtl->id;
            $today=date('Y-m-d');
        	$key = $data['Unique_Ref_Number'];
        
            if(empty($this->session->userdata('billing_online'))){
            	$orders=$this->session->userdata('donation_online');
        	} 
        	else {
            	$orders=$this->session->userdata('billing_online');
            }
            //$this->site_model->getorderbyrefno($customer_id);
            $temple_list=$this->site_model->gettemples();
            $deity=$orders[0]['diety_id'];
            $count='0';
            $total=$this->session->userdata('total_payment');
            $this->db->query("INSERT INTO billing(`diety_id`,`transaction_date`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`bal_amt`,`counter`,`bill_time`) VALUES ('$deity','$today','$today','$key','$amd','$customer_id','$count','$total','2','$total','0','6','0000-00-00 00:00:00')");

        	$bill_id=$this->db->insert_id();
        
            for($i=0;$i<count($orders);$i++){
                $name=$orders[$i]['name'];
                $dety=$orders[$i]['diety_id'];
                $ster=$orders[$i]['star_id'];
                $poja=$orders[$i]['pooja_id'];
                $rate=$orders[$i]['rate'];
                $prasadam=$orders[$i]['prasadam'];
                $time=$orders[$i]['time'];
                $qult=$orders[$i]['qty'];
                $amount=$qult*$rate;
                $data=$orders[$i]['date'];
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','$time','$rate','$data', '1','$amount','$prasadam')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
            }
            $cust_id=$this->loggedIn['id'];
        
        	$this->session->unset_userdata('billing_online');
            $this->db->query("DELETE FROM billing_online WHERE customer_id='$customer_id'");
        
        	redirect(site_url("worldline/thankyou/".$bill_id));
        } else {
            redirect(site_url("worldline/payment"));
        }
    } else {
        	return false;
    	}
     }
}