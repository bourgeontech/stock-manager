<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . '/third_party/mpdf/mpdf.php';

class M_pdf {
    public $param;
    public $pdf;
   // public function __construct($param = '"c","A4","","",0,0,0,0,6,3') {
   // 
   public function __construct($param = "'ml', 'A4-L'"){
        $this->param = $param;
        $this->pdf = new mPDF($this->param);
    }
}