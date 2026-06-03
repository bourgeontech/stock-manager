<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
private $siteval = null;
    public function __construct(){
        parent::__construct();
        if(empty($this->session->refno)){
            $refno="AB".rand(1000,9999);
            $this->session->set_userdata('refno', $refno);
        }
        $this->date = date('Y-m-d h:i:s');
        $this->amount = $this->site_model->billing_online($this->session->refno);
    
        $this->siteval= $this->site_model->templatesettings() ? 'site'.$this->site_model->templatesettings() : 'site';

  
        //        print_r($this->amount);
    }
    // Dashboard
    public function index(){
        $data['temple_list']=$this->site_model->gettemples();
        $data['pooja_list']=$this->site_model->getpoojas();
        $data['aboutus']=$this->site_model->getaboutus();
        $data['gallery_list']=$this->site_model->getgallery();
        $data['banner']=$this->site_model->getBanner();
        $data['advertisement']=$this->site_model->getAdvertisement();
        $data['events']=$this->site_model->geteventFestivalone();
        $data['contact']=$this->site_model->getcontact();
     	$data['templeTiming']=$this->site_model->gettempleTiming();
        $data['trusteeboard']=$this->site_model->gettrusteeboard();
    	$data['paripalanaSamithi']=$this->site_model->getparipalanaSamithi();
      
       // $this->load->view($this->siteval.'/layouts/admin_headernewhome');
        $this->load->view($this->siteval.'/home',$data);
        //$this->load->view($this->siteval.'/layouts/admin_footer');
    }
    public function dietys(){
        $data['diety_list']=$this->site_model->getdietys();
        $data['contact']=$this->site_model->getcontact();
    	$data['templeTiming']=$this->site_model->gettempleTiming();
        $this->load->view($this->siteval.'/layouts/admin_headernew');
        $this->load->view($this->siteval.'/dietys2',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function contact_form(){
        $this->load->view($this->siteval.'/layouts/admin_header');
        $data = array(); 
    $data['templeTiming']=$this->site_model->gettempleTiming();
        $data['contact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/contact_form', $data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    public function termsandconditions(){
       $data['temple_list']=$this->site_model->gettemples();
     	$data['getcontact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layouts/admin_header',$data);
       
        $this->load->view($this->siteval.'/termsandconditions');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    public function disclaimer(){
    $data['temple_list']=$this->site_model->gettemples();
     $data['getcontact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layouts/admin_header',$data);
     
        $this->load->view($this->siteval.'/disclaimer');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
public function multicancel($refno ){
        $this->db->where('customer_id', $refno);
        $this->db->delete('billing_online');
        redirect(site_url("admin/admin/multy_schedule"));
    }
    public function privacypolicy(){
    $data['temple_list']=$this->site_model->gettemples();
     $data['getcontact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layouts/admin_header',$data);
     
        $this->load->view($this->siteval.'/privacypolicy');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
     public function shop(){
    
     
        $this->load->view($this->siteval.'/shop');
     }
public function shippingpolicy(){
    $data['temple_list']=$this->site_model->gettemples();
     $data['getcontact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layouts/admin_header',$data);
     
        $this->load->view($this->siteval.'/Shippingpolicy');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    public function cancellationpolicy(){
       $data['temple_list']=$this->site_model->gettemples();
     $data['getcontact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layouts/admin_header',$data);
        $this->load->view($this->siteval.'/cancellationpolicy');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function sendSMS() {
    		
    	try {
        $mobile = '8590239045';
        $otp = '2334';
  		$message =urlencode("Your pooja Pushpanjali will be done on 17/09/2023 For more details please contact 9878898989 Regards PUNYEM DIR");
     
      // $mesa =urlencode("Dear ,Your verification code=".$otp." Regards ");
        
        $time = urlencode("2023-07-11 06:03pm");
        $send_date = "2023-07-23";
        if ($send_date <= date('Y-m-d')) {
                            $send_time = urlencode(date('Y-m-d')." 06:00pm");
                        } else {
                            $send_time = urlencode($send_date." 06:00pm");
                        }
        print_r($send_time);
        exit;
        $url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYEM&route=1&time=$time&number=$mobile&message=$message&templateid=1707166090573587020";
		
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $resp = curl_exec($curl);
        curl_close($curl);
  echo 'If you see this, the number is 1 or below';
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    }

    public function booking(){
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->site_model->getdietys();
            $data['pooja_list']=$this->site_model->getpoojas();
            $data['star_list']=$this->site_model->getstars();
            $this->load->view('site/layouts/admin_header');
            $this->load->view($this->siteval.'/booking',$data);
            $this->load->view('site/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $main_date=$this->input->post('main_date');
            $dates=$this->input->post('dates');
            // 			print_r($dates);
            // 			exit();
            $pooja=$this->site_model->getpoojasById($pooja_id);
            $amount=$pooja[0]['rate'];
            $refno=$this->session->refno;
            if(!empty($dates)){
                $i=0;
                while ($i<sizeof($dates)){
                    $data=$dates[$i];
                    $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja_id','$amount','$data', '1')");
                    $i++;
                }
            }else{
                $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja_id','$amount','$main_date', '1')");
            }
            redirect('welcome/booking');
        }
    }
    
    // $data['user_name'] = "Priyesh";
    // $data['user_email'] = "info@burgeontech.com";
    // $data['user_mobile'] = "9847139911";
    // $data['user_address'] = "Calicut, Kerala";
    
    public function review(){
    	
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        if ($this->form_validation->run() === FALSE){
            $refno=$this->session->refno;
            $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
            $data['temple_list']=$this->site_model->gettemples();
            $data['user_list']=$this->site_model->getuserbyrefno($refno);
            if(empty($data['bill_list'])){
                redirect('welcome/booking');
            }
            $this->load->view('site/layouts/admin_header');
            $this->load->view('site/review',$data);
            $this->load->view('site/layouts/admin_footer');
        }else{
            if ($this->input->post('submit')=='save'){
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('house', 'house', 'required');
                $this->form_validation->set_rules('street', 'street', 'required');
                $this->form_validation->set_rules('post', 'post', 'required');
                $this->form_validation->set_rules('district', 'district', 'required');
                $this->form_validation->set_rules('state', 'state', 'required');
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('pincode', 'pincode', 'required');
                if ($this->form_validation->run() === FALSE){
                    $refno=$this->session->refno;
                    $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    $data['user_list']=$this->site_model->getuserbyrefno($refno);
                    if(empty($data['bill_list'])){
                        redirect('welcome/booking');
                    }
                    $this->load->view($this->siteval.'/layouts/admin_header');
                    $this->load->view($this->siteval.'/review',$data);
                    $this->load->view($this->siteval.'/layouts/admin_footer');
                }else{
                    $refno=$this->session->refno;
                    $name=$this->input->post('name');
                    $house=$this->input->post('house');
                    $street=$this->input->post('street');
                    $post=$this->input->post('post');
                    $district=$this->input->post('district');
                    $state=$this->input->post('state');
                    $pincode=$this->input->post('pincode');
                    $mobile=$this->input->post('mobile');
                    $email=$this->input->post('email');
                    $count=$this->input->post('count');
                    $total=$this->input->post('total');
                    $this->db->query("UPDATE billing_online SET count='$count',total='$total' WHERE customer_id='$refno'");
                    $query = $this->db->query("SELECT * FROM user_dtl WHERE customer_id='$refno'");
                    $cost=$query->num_rows();
                    if($cost==0){
                        $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                    }else{
                        $this->db->query("UPDATE user_dtl SET name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',mobile='$mobile',email='$email' WHERE customer_id='$refno'");
                    }
                    redirect('welcome/payment');
                }
            }elseif ($this->input->post('submit')=='otp'){
                $refno=$this->session->refno;
                $mobile=$this->input->post('mobile');
                $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
                $cost=$query->num_rows();
                if($cost!=0){
                    $otp=rand(100000,999999);
                    
                    /// to send otp
                    //
                    //   $otp_st=$this->sendotp($mobile,$otp);
                    $payload = file_get_contents("https://api.msg91.com/api/v5/otp?authkey=279147AQOnnTr0R0B5fa90d9aP1&template_id=5fb76a1a18e5566b094e7050&mobile=".$mobile."&invisible=1&otp=".$otp."&userip=IPV4 User IP&email=Email ID");
                    // print_r($payload);
                    //
                    $this->db->query("UPDATE mob_otp SET status='0' WHERE mobile='$mobile'");
                    $this->db->query("INSERT INTO mob_otp(`customer_id`,`mobile`,`otp`,`status`)VALUES('$refno','$mobile','$otp','1')");
                    $data['otp']='1';
                    $data['mob']=$mobile;
                    $data['error']='0';
                }else {
                    $data['error']='1';
                }
                $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
                $data['temple_list']=$this->site_model->gettemples();
                if(empty($data['bill_list'])){
                    redirect('welcome/booking');
                }
                $this->load->view('site/layouts/admin_header');
                $this->load->view('site/review',$data);
                $this->load->view('site/layouts/admin_footer');
            }elseif ($this->input->post('submit')=='check'){
                $refno=$this->session->refno;
                $otp=$this->input->post('otp');
                $mobile=$this->input->post('mobile');
                $query = $this->db->query("SELECT * FROM mob_otp WHERE mobile='$mobile' AND otp='$otp' AND status='1'");
                $cost=$query->num_rows();
                if($cost!=0){
                    $this->db->query("UPDATE mob_otp SET status='0' WHERE mobile='$mobile'");
                    $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    $data['user_list']=$this->site_model->getuserbymobile($mobile);
                    if(empty($data['bill_list'])){
                        redirect('welcome/booking');
                    }
                    $this->load->view($this->siteval.'/layouts/admin_header');
                    $this->load->view($this->siteval.'/review',$data);
                    $this->load->view($this->siteval.'/layouts/admin_footer');
                }else {
                    $data['otp']='1';
                    $data['mob']=$mobile;
                    $data['error']='2';
                    $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    if(empty($data['bill_list'])){
                        redirect('welcome/booking');
                    }
                    $this->load->view($this->siteval.'/layouts/admin_header');
                    $this->load->view($this->siteval.'/review',$data);
                    $this->load->view($this->siteval.'/layouts/admin_footer');
                }
            }
        }
    }
    public function otp(){
        $refno=$this->session->refno;
        $mobile=$this->input->post('mobile');
        
        $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile'");
        $cost=$query->num_rows();
        if($cost!=0){
            $otp=rand(100000,999999);
            
            $otp_status=$this->sendotp($mobile,$otp);
            $this->db->query("UPDATE mob_otp SET status='0' WHERE mobile='$mobile'");
            $this->db->query("INSERT INTO mob_otp(`customer_id`,`mobile`,`otp`,`status`)VALUES('$refno','$mobile','$otp','1')");
            $data['otp']='1';
            $data['error']='0';
        }else {
            $data['error']='1';
        }
        $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
        $data['temple_list']=$this->site_model->gettemples();
        if(empty($data['bill_list'])){
            redirect('welcome/booking');
        }
        $this->load->view('site/layouts/admin_header');
        $this->load->view('site/review',$data);
        $this->load->view('site/layouts/admin_footer');
    }
    public function payment(){
        $refno=$this->session->refno;
        $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
        $data['temple_list']=$this->site_model->gettemples();
        $data['user_list']=$this->site_model->getuserbyrefno($refno);
        $this->session->set_userdata('total_payment', $data['bill_list'][0]['total']+($data['bill_list'][0]['total']*$data['temple_list'][0]['payment_charge']/100));
        //     $data['user_name'] = "Shafeeq";
        //  $data['user_email'] = "info@burgeontech.com";
        //$data['user_mobile'] = "9446889070";
        // $data['user_address'] = "Calicut, Kerala";
        if(empty($data['bill_list'])){
            redirect('welcome/booking');
        }
        $this->load->view('site/layouts/admin_header');
        $this->load->view('site/payment',$data);
        $this->load->view('site/layouts/admin_footer');
    }
    
    public function do_payment($key){
        $this->load->library('razorpay');
        $fetch = $this->razorpay->fetch($key);
        $total_payment = $this->session->userdata('total_payment')*100;
        if($fetch->amount == $total_payment && $fetch->id == $key){
            $payment = $this->razorpay->payment($key, $total_payment);
            $stts = $payment['status'];
            $amd = ($payment ['amount']/100);
            $json_encode = json_encode($payment);
            $refno=$this->session->refno;
            $today=date('Y-m-d');
            $orders=$this->site_model->getorderbyrefno($refno);
            $temple_list=$this->site_model->gettemples();
            $deity=$orders[0]['diety_id'];
            $count=$orders[0]['count'];
            $total=$orders[0]['total']+($orders[0]['total']*$temple_list[0]['payment_charge']/100);
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`status`,`recv_amt`,`counter`) VALUES ('$deity','$today','$key','$amd','0','$count','$total', '2','$total','0')");
            $bill_id=$this->db->insert_id();
            for($i=0;$i<count($orders);$i++){
                $name=$orders[$i]['name'];
                $dety=$orders[$i]['diety_id'];
                $ster=$orders[$i]['star_id'];
                $poja=$orders[$i]['pooja_id'];
                $rate=$orders[$i]['rate'];
                $qult="1";
                $data=$orders[$i]['date'];
            if($count>0) {$postal_yes='2';}else{$postal_yes='0';}
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`date`,`status`,`amount`,`postal_yes`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','$data', '1','$rate','$postal_yes')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
            }
            $query=$this->db->query("SELECT id FROM user_dtl WHERE customer_id='$refno'")->result_array();
            $cust_id=$query[0]['id'];
            $this->db->query("UPDATE billing SET customer_id='$cust_id' WHERE id='$bill_id'");
            $this->db->query("DELETE FROM billing_online WHERE customer_id='$refno'");
            redirect(site_url("welcome/thankyou/".$bill_id));
        }else{
            redirect(site_url("welcome/payment"));
        }
    }
    // public function thankyou(){
    //     $this->load->view('site/layouts/admin_header');
    //     $this->load->view('site/thankyou');
    //     $this->load->view('site/layouts/admin_footer');
    // }
    // 
    public function thankyou($bill_id=null){

        if($bill_id!=null){
            $data['bill_id']=$bill_id;
        }else{
            $data['bill_id']="";
        } 

        $this->load->view('site/layouts/admin_header');
        $this->load->view('site/thankyou', $data);
        $this->load->view('site/layouts/admin_footer');

    	$this->session->unset_userdata('total_payment');
    	$this->session->unset_userdata('refno');
    	// $this->session->unset_userdata('mobile_number');
    	$this->session->unset_userdata('amount');
        // session_unset();     
        // session_destroy(); 
    }

	public function bill_print($id){
    	
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;

        $this->load->view('site/bill_print',$data);
    }

    public function deletebook(){
        $id=$this->input->post('id');
        $this->db->query("DELETE FROM billing_online WHERE id='$id'");
    }
    
    public function getdatestar(){
        $from=$this->input->post('from');
        $to=$this->input->post('to');
        $result=$this->site_model->getdatestar($from,$to);
        echo json_encode($result);
    }
    public function getweekstar(){
        $from=$this->input->post('from');
        $to=$this->input->post('to');
        $day=$this->input->post('day');
        $result=$this->site_model->getweekstar($from,$to,$day);
        echo json_encode($result);
    }
    public function getmonthstar(){
        $from=$this->input->post('from');
        $to=$this->input->post('to');
        $star=$this->input->post('star');
        $result=$this->site_model->getmonthstar($from,$to,$star);
        echo json_encode($result);
    }
    function getpoojarate() {
        $pooja = $this->input->get('pooja');
        $data = array();
        $data = $this->site_model->getpoojasById($pooja);
        echo json_encode($data);
    }
    
    function getpoojasbydiety() {
        $diety = $this->input->post('diety');
        $data = array();
        $data = $this->site_model->getpoojasbydiety($diety);
        echo json_encode($data);
    }

	function getpoojabyid() {
        $pooja_id = $this->input->post('pooja_id');
        
    	$this->db->select('*');
    	$this->db->from('pooja');
    	$this->db->where('id', $pooja_id);
    	$data = $this->db->get()->row();
    
        echo json_encode($data);
    }
    
    function getmokkolakkalludate(){
        $pooja = $this->input->get('pooja');
        $a=$this->db->query("SELECT date From mookkolakkallu Where status='1'");
        $data=$a->row_array();
        $date=date('Y-m-d', strtotime($data['date'] . ' +1 day'));
        echo json_encode($date);
    }
    
    //CMS
    
    public function aboutus(){
        $data['aboutus']=$this->site_model->getaboutus();
        $data['contact']=$this->site_model->getcontact();
    $data['templeTiming']=$this->site_model->gettempleTiming();
        $this->load->view($this->siteval.'/layouts/admin_headernew');
        $this->load->view($this->siteval.'/about2',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    public function templeTiming(){
        $data['templeTiming']=$this->site_model->gettempleTiming();
        $data['contact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/templeTiming',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    public function priest(){
        $data['priest']=$this->site_model->getpriest();
    $data['templeTiming']=$this->site_model->gettempleTiming();
        // print_r($res);
        $this->load->view($this->siteval.'/layouts/admin_headernew');
        $this->load->view($this->siteval.'/priest2',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function trusteeboard(){
        $data['trusteeboard']=$this->site_model->gettrusteeboard();
        $data['contact']=$this->site_model->getcontact();
    $data['templeTiming']=$this->site_model->gettempleTiming();
        $data['gallery_list']=$this->site_model->getgallery();
       $this->load->view($this->siteval.'/layouts/admin_headernew');
        $this->load->view($this->siteval.'/trusteeboard2',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function festivalCommittee(){
        $data['festivalCommittee']=$this->site_model->getfestivalCommittee();
       $this->load->view($this->siteval.'/layouts/admin_headernew');
        $this->load->view($this->siteval.'/festivalCommittee2',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function paripalanaSamithi(){
        $data['paripalanaSamithi']=$this->site_model->getparipalanaSamithi();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/paripalanaSamithi',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function eventFestival(){
        $data['eventFestival']=$this->site_model->geteventFestival();
        $data['contact']=$this->site_model->getcontact();
        $data['gallery_list']=$this->site_model->getgallery();
    $data['templeTiming']=$this->site_model->gettempleTiming();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/eventFestival',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function eventDetails($id){
        $data['eventDetails']=$this->site_model->geteventDetails($id);
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/eventDetails',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function news(){
        $data['news']=$this->site_model->getnews();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/news',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function newsDetails($id){
        $data['newsDetails']=$this->site_model->getnewsDetails($id);
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/newsDetails',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function announcements(){
        $data['announcements']=$this->site_model->getannouncements();
        $data['contact']=$this->site_model->getcontact();
        $data['gallery_list']=$this->site_model->getgallery();
    $data['templeTiming']=$this->site_model->gettempleTiming();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/announcements',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function rules(){
        $data['rules']=$this->site_model->getrules();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/rules',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function gallery(){
        $data['gallery']=$this->site_model->getgallery();
        $data['contact']=$this->site_model->getcontact();
    	$data['templeTiming']=$this->site_model->gettempleTiming();
        $this->load->view($this->siteval.'/layouts/admin_headernew');
        $this->load->view($this->siteval.'/gallery2',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
    
    public function galleryDetails($id){
        $data['galleryDetails']=$this->site_model->getgalleryDetails($id);
        $this->load->view($this->siteval.'/layouts/admin_headernew');
        $this->load->view($this->siteval.'/galleryDetails2',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
	
	public function video(){
        $data['video']=$this->site_model->getvideo();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/video',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function slider(){
        // Fetch slider items directly - ordered by display_order desc
        $query = $this->db->select('*')
                          ->from('slider')
                          ->where('is_delete !=', 1)
                          ->order_by('display_order', 'desc')
                          ->get();
        $data['slider'] = ($query->num_rows() > 0) ? $query->result_array() : array();
        $data['contact'] = $this->site_model->getcontact();
        $data['templeTiming'] = $this->site_model->gettempleTiming();

        // Standalone page - does NOT use site theme header to allow full SwiperJS design
        $this->load->view('slider_page', $data);
    }
    
    public function contact(){
        $data['contact']=$this->site_model->getcontact();
    $data['templeTiming']=$this->site_model->gettempleTiming();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/contact',$data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function pooja(){
        $data['contact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layout1/header');
        $this->load->view($this->siteval.'/pooja',$data);
       $this->load->view($this->siteval.'/layout1/footer');
    }

    public function pooram(){
        $data['contact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layout1/header');
        $this->load->view($this->siteval.'/pooram',$data);
       $this->load->view($this->siteval.'/layout1/footer');
    }
    
    public function worship(){
        $data['contact']=$this->site_model->getcontact();
        $this->load->view($this->siteval.'/layout1/header');
        $this->load->view($this->siteval.'/worship',$data);
       $this->load->view($this->siteval.'/layout1/footer');
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('index.php/admin/','refresh');
    }

	// PARAKUNNATH 
	
	public function index_ml(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/index-ml');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function poojas(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/pooja');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function poojas_ml(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/pooja-ml');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function temple(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/temple');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
	public function temple_ml(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/temple-ml');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
	public function contact_ml(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/contact-ml');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
	public function festivals(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/festival');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function aboutus2(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/aboutus2');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function aboutus3(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/aboutus3');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function aboutus4(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/aboutus4');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function aboutus5(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/aboutus5');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
	

	public function mandapam(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/mandapam');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function mandapam2(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/mandapam2');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function mandapam3(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/mandapam3');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function mandapam4(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/mandapam4');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }
	
	public function nakshathravanam(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/nakshathravanam');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }	
	
	public function gowpooja(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/gowpooja');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }	

    public function member(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/member');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function sevadal(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/sevadal');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function tandc(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/tandc');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function disclaim(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/disclaim');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function privacy(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/privacy');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function crp(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/crp');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

    public function cources(){
      
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/cources');
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function trustee_board(){
      	$data['trustees'] = $this->db->order_by('displayOrder', 'asc')->get('trustee')->result();
        $this->load->view($this->siteval.'/layouts/admin_header');
        $this->load->view($this->siteval.'/trustee_board', $data);
        $this->load->view($this->siteval.'/layouts/admin_footer');
    }

	public function success() {
        $this->load->view($this->siteval.'/layouts/admin_header');
    	$this->load->view($this->siteval.'/booking_success');
     	$this->load->view($this->siteval.'/layouts/admin_footer');
	}

	public function donation_success() {
        $this->load->view($this->siteval.'/layouts/admin_header');
    	$this->load->view($this->siteval.'/donation_success');
     	$this->load->view($this->siteval.'/layouts/admin_footer');
	}
    
	public function room_booking() {
        $this->load->view($this->siteval.'/layouts/admin_header');
    	$this->load->view($this->siteval.'/room_booking');
     	$this->load->view($this->siteval.'/layouts/admin_footer');
	}


	public function book_room() {
    	$this->form_validation->set_rules('name', 'Name', 'required');
    	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    	$this->form_validation->set_rules('checkin_date', 'Check-in Date', 'required');
    	$this->form_validation->set_rules('checkout_date', 'Check-out Date', 'required');
    	$this->form_validation->set_rules('num_adults', 'Number of Adults', 'required|numeric|greater_than_equal_to[1]');
    	$this->form_validation->set_rules('num_children', 'Number of Children', 'required|numeric|greater_than_equal_to[0]');
    	$this->form_validation->set_rules('room_type', 'Room Type', 'required');

    	if ($this->form_validation->run() === FALSE) {
        	$this->load->view('booking_form');
    	} else {
        	$data = array(
            	'name' => $this->input->post('name'),
            	'email' => $this->input->post('email'),
            	'checkin_date' => $this->input->post('checkin_date'),
            	'checkout_date' => $this->input->post('checkout_date'),
            	'num_adults' => $this->input->post('num_adults'),
            	'num_children' => $this->input->post('num_children'),
            	'room_type' => $this->input->post('room_type'),
            	'special_requests' => $this->input->post('special_requests')
        	);

        	$this->general_model->book_room($data);

        	$this->send_booking_email($data);

        	redirect('welcome/success');
    	}
	}

	private function send_booking_email($data) {
    	$this->load->library('email'); 

    	// Email configuration
    	$config['protocol'] = 'smtp';
    	$config['smtp_host'] = 'smtp.gmail.com';
    	$config['smtp_port'] = 465; // or 587 for TLS
    	$config['smtp_crypto'] = 'ssl'; // or 'tls' for TLS
    	$config['smtp_user'] = 'webmasteradisankaramadom@gmail.com';
    	$config['smtp_pass'] = 'zwra quju ybmq ufuc';
    	$config['mailtype'] = 'html'; 
    	$config['charset'] = 'utf-8';
    	$config['newline'] = "\r\n"; 

    	// Initialize email config
    	$this->email->initialize($config);

    	// Set email parameters
    	$this->email->from('madaavalamkamakshi@gmail.com', 'Room Booking');
    	$this->email->to('madaavalamkamakshi@gmail.com'); 
    	$this->email->subject('Room Booking Request');

    	// Email content
    	$message = "<h1>Room Booking Request</h1>";
    	$message .= "<p><strong>Name:</strong> " . $data['name'] . "</p>";
    	$message .= "<p><strong>Email:</strong> " . $data['email'] . "</p>";
    	$message .= "<p><strong>Check-in Date:</strong> " . $data['checkin_date'] . "</p>";
    	$message .= "<p><strong>Check-out Date:</strong> " . $data['checkout_date'] . "</p>";
    	$message .= "<p><strong>Number of Adults:</strong> " . $data['num_adults'] . "</p>";
    	$message .= "<p><strong>Number of Children:</strong> " . $data['num_children'] . "</p>";
    	$message .= "<p><strong>Room Type:</strong> " . $data['room_type'] . "</p>";
    	$message .= "<p><strong>Special Requests:</strong> " . $data['special_requests'] . "</p>";

    	// Set HTML content as email message
    	$this->email->message($message);

    	if ($this->email->send()) {
        	log_message('info', 'Booking email sent successfully.');
    	} else {
        	log_message('error', 'Failed to send booking email: ' . $this->email->print_debugger());
    	}
	}

	public function donatenow() {
        $this->load->view($this->siteval.'/layouts/admin_header');
    	$this->load->view($this->siteval.'/donatenow');
     	$this->load->view($this->siteval.'/layouts/admin_footer');
	}
    public function sales()
   {
        
        $data['salesitems']=$this->site_model->getsalesproducts(); 
        $this->load->view($this->siteval.'/layouts/admin_headernew');
    	$this->load->view($this->siteval.'/shop',$data);
     	$this->load->view($this->siteval.'/layouts/admni_footernew');
	     
    
    
    }

	public function submit_donation() {
    	$this->form_validation->set_rules('beneficiary-name', 'Beneficiary Name', 'required');
    	$this->form_validation->set_rules('mobile-number', 'Mobile Number', 'required');
    	$this->form_validation->set_rules('amount', 'Amount', 'required|numeric|greater_than_equal_to[1]');
    
    	if ($this->form_validation->run() === FALSE) {
        	redirect('welcome/donatenow');
    	} else {
        	$data = array(
            	'beneficiary_name' => $this->input->post('beneficiary-name'),
            	'mobile_number' => $this->input->post('mobile-number'),
            	'birth_star' => $this->input->post('birth-star'),
            	'amount' => $this->input->post('amount')
        	);

        	$this->send_donation_email($data);

        	redirect('welcome/donation_success'); 
    	}
	}

	private function send_donation_email($data) {
    	$this->load->library('email'); 

    	$config['protocol'] = 'smtp';
    	$config['smtp_host'] = 'smtp.gmail.com';
    	$config['smtp_port'] = 465; // or 587 for TLS
    	$config['smtp_crypto'] = 'ssl'; // or 'tls' for TLS
    	$config['smtp_user'] = 'webmasteradisankaramadom@gmail.com';
    	$config['smtp_pass'] = 'zwra quju ybmq ufuc';
    	$config['mailtype'] = 'html'; // Set mailtype to html
    	$config['charset'] = 'utf-8';
    	$config['newline'] = "\r\n"; 

    	$this->email->initialize($config);

    	$this->email->from('madaavalamkamakshi@gmail.com', 'Donation');
    	$this->email->to('madaavalamkamakshi@gmail.com'); 
    	$this->email->subject('Donation Request');

    	$message = "<h1>Donation Request</h1>";
    	$message .= "<p><strong>Beneficiary Name:</strong> " . $data['beneficiary_name'] . "</p>";
    	$message .= "<p><strong>Mobile Number:</strong> " . $data['mobile_number'] . "</p>";
    	$message .= "<p><strong>Birth Star:</strong> " . $data['birth_star'] . "</p>";
    	$message .= "<p><strong>Amount:</strong> " . $data['amount'] . "</p>";

    	$this->email->message($message);

    	if ($this->email->send()) {
        	log_message('info', 'Beneficiary email sent successfully.');
    	} else {
        	log_message('error', 'Failed to send beneficiary email: ' . $this->email->print_debugger());
    	}



	}

public function addtocart() {
        $product_id = $this->input->post('product_id');


        // Example: update product rate (your original query)
        $exists = $this->db->get_where('cart', ['product_id' => $product_id])->row();

if ($exists) {
    $this->db->set('quantity', 'quantity+1', FALSE);
    $this->db->where('product_id', $product_id);
    $this->db->update('cart');
} else {
    $this->db->insert('cart', [
        'product_id' => $product_id,
        'quantity' => 1,
        'created_at' => date('Y-m-d H:i:s')
    ]);
}
    }

public function count() {
    $this->db->select_sum('quantity');
    $query = $this->db->get('cart')->row();

    $count = $query->quantity ? $query->quantity : 0;

    echo $count;
}

public function preview() {
    $cart = $this->db->get('cart')->result();

    $output = '';
    $total = 0;

    if ($cart) {
        foreach ($cart as $item) {

            // get product info
            $product = $this->db->get_where('Pooja', ['id' => $item->product_id])->row();

            $price = $product->rate;
            $subtotal = $price * $item->quantity;
            $total += $subtotal;

            $output .= '
                <div class="cart-item">
                    <strong>'.$product->name.'</strong><br>
                    Qty: '.$item->quantity.' × ₹'.$price.'<br>
                    <small>Subtotal: ₹'.$subtotal.'</small>
                </div>
            ';
        }

        $output .= '<hr><strong>Total: ₹'.$total.'</strong>';
    } else {
        $output = '<p class="text-center">Cart is empty</p>';
    }

    echo $output;
}
public function salescartview() {
    $data['cart'] = $this->db->get('cart')->result();

    foreach ($data['cart'] as &$item) {
        $product = $this->db->get_where('Pooja', ['id' => $item->product_id])->row();
        $item->name = $product->name;
        $item->price = $product->rate;
        $item->subtotal = $item->price * $item->quantity;
    }

        $this->load->view($this->siteval.'/layouts/admin_headernew');
    	$this->load->view($this->siteval.'/cart-view',$data);
     	$this->load->view($this->siteval.'/layouts/admni_footernew');
}
public function checkout() {

    $user_id = $this->session->userdata('user_id');

    if (!$user_id) {
        redirect('Welcome/search_user');
    }

    $cart = $this->db->get('cart')->result();
    $total = 0;

    foreach ($cart as $item) {
        $product = $this->db->get_where('Pooja', ['id'=>$item->product_id])->row();
        $total += $product->rate * $item->quantity;
    }

    $address = $this->db
        ->get_where('user_dtl', ['id'=>$user_id])
        ->row();

    // Save order
    $this->db->insert('orders', [
        'user_id' => $user_id,
        'total_amount' => $total,
        'address' => $address->street,
        'phone' => $address->mobile,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    $order_id = $this->db->insert_id();

    // clear cart
    $this->db->empty_table('cart');

    redirect('Welcome/ordersuccess/'.$order_id);
}


 public function search_user() {

       if($this->input->post('phone'))
       {
        $phone = $this->input->post('phone');
        $user = $this->db->get_where('user_dtl', ['mobile' => $phone])->row();
            
        if ($user) {
            //  $this->session->set_userdata('user_id', $user->id);
              echo json_encode([
                'status' => 'found',
                'data' => $user
            ]);
            
        } else {
            echo json_encode([
                'status' => 'not_found'
            ]);
        }
    }
        else {

        $this->load->view($this->siteval.'/layouts/admin_headernew');
    	$this->load->view($this->siteval.'/checkout_search');
     	$this->load->view($this->siteval.'/layouts/admni_footernew');
        }
    }

    // 💳 Process checkout
    public function process() {
       //  print_r($_REQUEST);exit;
        $user_id = $this->input->post('user_id');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');

        // If user not exists → create new
        if (!$user_id) {

            $this->db->insert('user_dtl', [
                'name' => $name,
                'mobile' => $phone,
                'street' => $address
            ]);

            $user_id = $this->db->insert_id();
        }

        // 👉 Calculate cart total
        $cart = $this->db->get('cart')->result();
        $total = 0;

        foreach ($cart as $item) {
            $product = $this->db->get_where('Pooja', ['id'=>$item->product_id])->row();
            $total += $product->rate * $item->quantity;
        }

        // 👉 Save order
        $this->db->insert('orders', [
            'user_id' => $user_id,
            'total_amount' => $total,
            'address' => $address,
            'phone' => $phone,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $order_id = $this->db->insert_id();

        // clear cart
        $this->db->empty_table('cart');

        // 👉 Redirect to payment / confirmation
        redirect('Welcome/ordersuccess/'.$order_id);
    }
 
public function ordersuccess($id) {

        $data['order'] = $this->db->get_where('orders', ['id'=>$id])->row();
        $this->load->view($this->siteval.'/layouts/admin_headernew');
    	$this->load->view($this->siteval.'/order_success',$data);
     	$this->load->view($this->siteval.'/layouts/admni_footernew');
    }

}