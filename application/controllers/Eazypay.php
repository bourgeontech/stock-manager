<?php 

        class Eazypay
        {
        public $merchant_id;
        public $encryption_key;
        public $sub_merchant_id;
        public $reference_no;
        public $paymode;
        public $return_url;
        private $credentials;
        
        const DEFAULT_BASE_URL = 'https://eazypay.icicibank.com/EazyPG?';
        
        public function __construct($credentials)
        {
                $this->merchant_id              =    $credentials[0]->merchant_id;//600110;
                $this->encryption_key           =    $credentials[0]->encryption_key;//6000040201105012;
                $this->sub_merchant_id          =    $credentials[0]->sub_merchant_id;//45;
                $this->paymode                  =    $credentials[0]->paymode;//9;
                $this->return_url               =    ''.$credentials[0]->return_url.'';//'https://demo.templesoftware.in/index.php';
        }
        
        public function setParameter($credentials) {
                $this->merchant_id              =    $credentials[0]->merchant_id;//600110;
                $this->encryption_key           =    $credentials[0]->encryption_key;//6000040201105012;
                $this->sub_merchant_id          =    $credentials[0]->sub_merchant_id;//45;
                $this->paymode                  =    $credentials[0]->paymode;//9;
                $this->return_url               =    ''.$credentials[0]->return_url.'';//'https://demo.templesoftware.in/index.php';
        }

        public function getPaymentUrl($amount, $reference_no, $optionalField=null)
        {
                $mandatoryField   =    $this->getMandatoryField($amount, $reference_no);
                $optionalField    =    $this->getOptionalField($optionalField);
                $amount           =    $this->getAmount($amount);
                $reference_no     =    $this->getReferenceNo($reference_no);

                $paymentUrl = $this->generatePaymentUrl($mandatoryField, $optionalField, $amount, $reference_no);
                return $paymentUrl;
        }

        protected function generatePaymentUrl($mandatoryField, $optionalField, $amount, $reference_no)
        {
                $encryptedUrl = self::DEFAULT_BASE_URL."merchantid=".$this->merchant_id.
                "&mandatory fields=".$mandatoryField."&optional fields=".$optionalField.
                "&returnurl=".$this->getReturnUrl()."&Reference No=".$reference_no.
                "&submerchantid=".$this->getSubMerchantId()."&transaction amount=".
                $amount."&paymode=".$this->getPaymode();

                return $encryptedUrl;
        }

        protected function getMandatoryField($amount, $reference_no)
        {
                return $this->getEncryptValue($reference_no.'|'.$this->sub_merchant_id.'|'.$amount);
        }

        // optional field must be seperated with | eg. (20|20|20|20)
        protected function getOptionalField($optionalField=null)
        {
                if (!is_null($optionalField)) {
                return $this->getEncryptValue($optionalField);
                }
                return null;
        }

        protected function getAmount($amount)
        {
                return $this->getEncryptValue($amount);
        }

        protected function getReturnUrl()
        {
                return $this->getEncryptValue($this->return_url);
        }

        protected function getReferenceNo($reference_no)
        {
                return $this->getEncryptValue($reference_no);
        }

        protected function getSubMerchantId()
        {
                return $this->getEncryptValue($this->sub_merchant_id);
        }

        protected function getPaymode()
        {
                return $this->getEncryptValue($this->paymode);
        }

        // use @ to avoid php warning php 

        protected function getEncryptValue($data)
        {
                // Generate an initialization vector
                 $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
                // Encrypt the data using AES 128 encryption in ecb mode using our encryption key and initialization vector.
                $encrypted = openssl_encrypt($data, 'aes-128-ecb', $this->encryption_key, OPENSSL_RAW_DATA);
                // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
                return base64_encode($encrypted);
        }
     }
?>