<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once __DIR__ . '/vendor/autoload.php';
class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
      date_default_timezone_set("Asia/Calcutta");
  
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }	
        if(empty($this->session->refno)){
            $refno="AB".rand(1000,9999);
            $this->session->set_userdata('refno', $refno);
        }	
    //print_r($_SESSION);exit;
        $this->loggedIn=$this->session->admin;
        $this->amount = $this->site_model->billing_online($this->session->refno);
        $this->load->model( 'Accounts_model' );
    	$this->load->model( 'Cms_model' );
    	$this->load->model( 'billing_model' );
    
    	$site_settings 	= $this->db->select('*')->from('site_settings')->get()->row();
    
    	/***
    	 * Language Settings
    	 ***/
      	$language_settings = $this->db->field_exists('language', 'site_settings');
    
    	if($language_settings && $site_settings->language != null) {
           $this->load->language('main', $site_settings->language);
        }
    }
    // Dashboard
    public function index(){
        redirect('admin/admin/dashboard');
    }
    public function dashboard(){
    //print_r($_SESSION);exit;
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/layouts/admin_footer');
        
    }
    
    public function view(){
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/demo_view');
        $this->load->view('admin/layouts/admin_footer');
    }
    public function settings(){
        $data['settings']=$this->general_model->getSettings();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/settings',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function settings_update($id){
        $this->form_validation->set_rules('distance', 'Distance', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/settings',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'               =>$id,
                'search_distance'  =>$this->input->post('distance'),
                'customer_care'    =>$this->input->post('customer_care'),
            );
            $this->general_model->setSettings($data);
            $msg="Changes Saved";
            redirect('admin/admin/settings','refresh');
        }
    }
    public function add(){
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/demo_add');
        $this->load->view('admin/layouts/admin_footer');
    }
    // Master Settings
    
    // Category Starts
    // Temple
    
    public function add_temple(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/temple/temple_add');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'           =>$this->input->post('name'),
                'address'        =>$this->input->post('address'),
                'pincode'        =>$this->input->post('pincode'),
                'location'       =>$this->input->post('location'),
                'contact'        =>$this->input->post('contact'),
                'phone'          =>$this->input->post('phone'),
                'email'          =>$this->input->post('email'),
                'website'        =>$this->input->post('website'),
                'status'         =>'1',
                'registereddate' =>date('Y-m-d'),
                'postel_charge'  =>$this->input->post('postel_charge'),
                'payment_charge' =>$this->input->post('payment_charge'),
            );
            $id=$this->general_model->settemple($data);
            $msg="Temple Saved";
            redirect('admin/admin/temple_view');
        }
        
    }
    public function edit_temple($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['temple_list']=$this->general_model->gettemplesById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/temple/temple_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'name'        =>$this->input->post('name'),
                'address'     =>$this->input->post('address'),
                'pincode'     =>$this->input->post('pincode'),
                'location'    =>$this->input->post('location'),
                'contact'     =>$this->input->post('contact'),
                'phone'       =>$this->input->post('phone'),
                'email'       =>$this->input->post('email'),
                'website'     =>$this->input->post('website'),
                'postel_charge'=>$this->input->post('postel_charge'),
                'payment_charge' =>$this->input->post('payment_charge'),
            );
            $id=$this->general_model->settemple($data);
            $msg="Temple Updated";
            redirect('admin/admin/temple_view');
        }
        
    }
    public function temple_view(){
        $data['temple_list']=$this->general_model->gettemples();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/temple/temple_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function view_temple(){
        $id=$this->input->post('id');
        $result=$this->general_model->gettempledietyById($id);
        echo json_encode($result);
    }
    public function delete_temple($id){
        $result=$this->general_model->deletetemple($id);
        $msg="Deleted";
        redirect('admin/admin/temple_view');
    }
    public function diety_assign(){
        $this->form_validation->set_rules('temple', 'Temple', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['temple_list']=$this->general_model->gettemples();
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/temple/diety_assign',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $temple=$this->input->post('temple');
            $this->db->select('*');
            $this->db->from('temple_diety');
            $this->db->where('temple_id', $temple);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $this->db->where('temple_id', $temple);
                $this->db->delete('temple_diety');
            }
            $radio=$this->input->post('radio');
            if(!empty($radio)){
                foreach ($radio as $radios){
                    $this->db->query("INSERT INTO temple_diety(`temple_id`,`diety_id`,`status`) VALUES ('$temple','$radios', '1')");
                }
            }
            $msg="Diety Saved";
            redirect('admin/admin/diety_assign');
        }
    }
    // user
    
    public function add_user(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['role_list']=$this->general_model->getroles();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/user/user_add',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'       =>$this->input->post('name'),
                'username'   =>$this->input->post('username'),
                'password'   =>$this->input->post('password'),
                'role'       =>$this->input->post('role'),
            );
            $id=$this->general_model->setuser($data);
            $msg="User Saved";
            redirect('admin/admin/user_view');
        }
        
    }
    public function edit_user($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['user_list']=$this->general_model->getusersById($id);
            $data['role_list']=$this->general_model->getroles();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/user/user_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'         =>$id,
                'name'       =>$this->input->post('name'),
                'username'   =>$this->input->post('username'),
                'password'   =>$this->input->post('password'),
                'role'       =>$this->input->post('role'),
            );
            $id=$this->general_model->setuser($data);
            $msg="User Updated";
            redirect('admin/admin/user_view');
        }
        
    }
    public function user_view(){
        $data['user_list']=$this->general_model->getusers();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/user/user_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function delete_user($id){
        $result=$this->general_model->deleteuser($id);
        $msg="Deleted";
        redirect('admin/admin/user_view');
    }
    
    //Role
    
    public function add_role(){
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('label', 'Label', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['role_list']=$this->general_model->getroles();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/role/role_add',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'role'    =>$this->input->post('role'),
                'label'   =>$this->input->post('label'),
            );
            $id=$this->general_model->setrole($data);
            $msg="Role Saved";
            redirect('admin/admin/add_role');
        }
        
    }
    
    public function role_permission($id){
        $data['permission_list']=$this->general_model->getpermissionlist();
        $this->db->select('permission');
        $this->db->from('role_permission');
        $this->db->where('role', $id);
        $query = $this->db->get()->result_array();
        $data['checked']=$query;
        $data['id']=$id;
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/role/permission_add',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function add_permission($id){
        $this->db->select('*');
        $this->db->from('role_permission');
        $this->db->where('role', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->where('role', $id);
            $this->db->delete('role_permission');
        }
        $radio=$this->input->post('radio');
        foreach ($radio as $key=>$radios){
            $this->db->query("INSERT INTO role_permission(`role`,`permission`,`status`) VALUES ('$id','$radios', '1')");
        }
        $msg="Pooja Saved";
        redirect('admin/admin/add_role');
    }
    
    //Diety
    
    public function add_diety(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('order', 'Order', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/diety/diety_add');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
                'name_mal'  =>$this->input->post('name_mal'),
                'order_'    =>$this->input->post('order'),
            );
        
        	if($this->db->field_exists('description', 'diety')) {
            	$data['description'] = $this->input->post('description');
            }
        
        	if($this->db->field_exists('online', 'diety') && $this->input->post('online') == 1) {
            	$data['online'] = 1;
            }
              
            $id=$this->general_model->setdiety($data);
            $msg="Diety Saved";
            redirect('admin/admin/diety_view');
        }
        
    }
    public function edit_diety($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('order', 'Order', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->general_model->getdietysById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/diety/diety_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
                'name_mal'  =>$this->input->post('name_mal'),
                'order_'    =>$this->input->post('order'),
            );
        
        	if($this->db->field_exists('description', 'diety')) {
            	$data['description'] = $this->input->post('description');
            }
        	
        	if($this->db->field_exists('online', 'diety') && $this->input->post('online') == 1) {
            	$data['online'] = 1;
            } else {
            	$data['online'] = 0;
            }
        
            $id=$this->general_model->setdiety($data);
            $msg="Diety Updated";
            redirect('admin/admin/diety_view');
        }
        
    }
    public function diety_view(){
        $data['diety_list']=$this->general_model->getdietys();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/diety/diety_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function view_diety(){
        $id=$this->input->post('id');
        $result=$this->general_model->getdietypoojaById($id);
        echo json_encode($result);
    }
    public function delete_diety($id){
        $result=$this->general_model->deletediety($id);
        $msg="Deleted";
        redirect('admin/admin/diety_view');
    }
    public function pooja_assign(){
        $this->form_validation->set_rules('temple', 'Temple', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojasdortbyname();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/diety/pooja_assign',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
//             print_r($_POST);
// exit();
            $temple=$this->input->post('temple');
            $this->db->select('*');
            $this->db->from('diety_pooja');
            $this->db->where('temple_id', $temple);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $this->db->where('temple_id', $temple);
                $this->db->delete('diety_pooja');
            }
            $radio=$this->input->post('radio');
            foreach ($radio as $key => $radios){
                $rate=$this->input->post('rate_'.$radios);
                $code=$this->input->post('code_'.$radios);
                $this->db->query("INSERT INTO diety_pooja(`temple_id`,`pooja_id`,`rate`,`status`,`code`) VALUES ('$temple','$radios','$rate', '1','$code')");
            }
            $msg="Pooja Saved";
            redirect('admin/admin/pooja_assign');
        }
    }
    public function checkCodeExists(){
         $code=$this->input->post('id');
         $this->db->select('*');
         $this->db->from('diety_pooja');
         $this->db->where('code', $code);
         $query = $this->db->get();
         if ($query->num_rows() > 0) {
              echo 1;  
         }
         else{
              echo 0;
         }   
    }
    //Pooja
    
     public function add_pooja(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('name_mal', 'Name In Malayalam', 'required');
        $this->form_validation->set_rules('rate', 'Rate', 'required');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('quantity', 'Allowed quantity', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('cat', 'cat', 'required');


     	$this->db->select('*');
     	$this->db->from('pooja');
     	$this->db->order_by('id', 'desc');
     	$this->db->limit(1);
     	$last_code = $this->db->get()->row()->code;
      	$data['last_pooja_code'] = $last_code;
        if ($this->form_validation->run() === FALSE){
            $data['cat_list']=$this->general_model->getcat();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pooja/pooja_add',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
                'name_mal'  =>$this->input->post('name_mal'),
                'rate'      =>$this->input->post('rate'),
                'code'      =>$this->input->post('code'),
                'allowed_qty'=>$this->input->post('quantity'),
                'time'      =>$this->input->post('time'),
                'cat'       =>$this->input->post('cat'),
            	'pooja_cat' =>$this->input->post('pooja_cat'),
                'status'    =>'1',
            );
        
        	if($this->db->field_exists('description', 'pooja')) {
            	$data['description'] = $this->input->post('description');
            }
        
        	if($this->db->field_exists('default_date', 'pooja') && $this->input->post('default_date') && $this->input->post('default_date') != '') {
            	$data['default_date'] = $this->input->post('default_date');
            }
        
        	if($this->db->field_exists('exact_time', 'pooja') && $this->input->post('exact_time') && $this->input->post('exact_time') != '') {
            	$data['exact_time'] = $this->input->post('exact_time');
            }

            $id=$this->general_model->setpooja($data);
            $msg="Pooja Saved";
            redirect('admin/admin/pooja_view');
        }
        
    }
    public function edit_pooja($id){
    
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('rate', 'Rate', 'required');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('quantity', 'Allowed quantity', 'required');
    
        if ($this->form_validation->run() === FALSE){
            $data['pooja_list']=$this->general_model->getpoojasById($id);
            $data['cat_list']=$this->general_model->getcat();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pooja/pooja_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
        	$pooja_id = $id;
        
            $data=array(
                'id'           =>$id,
                'name'         =>$this->input->post('name'),
                'name_mal'     =>$this->input->post('name_mal'),
                'rate'         =>$this->input->post('rate'),
                'code'         =>$this->input->post('code'),
                'allowed_qty'  =>$this->input->post('quantity'),
                'time'         =>$this->input->post('time'),
                'cat'          =>$this->input->post('cat'),
            	'pooja_cat'    =>$this->input->post('pooja_cat'),
                 'online'    =>$this->input->post('online'),
            );
       
        	if($this->db->field_exists('description', 'pooja')) {
            	$data['description'] = $this->input->post('description');
            }
        
        	if($this->db->field_exists('default_date', 'pooja')) {
            	$default_date = $this->input->post('default_date') != '' ? $this->input->post('default_date') : null;
            	$data['default_date'] = $default_date;
            }
        
        	if($this->db->field_exists('exact_time', 'pooja')) {
            	$data['exact_time'] = $this->input->post('exact_time');
            }
        
            $id=$this->general_model->setpooja($data);
        
        	$this->db->where('pooja', $pooja_id);
			$query = $this->db->get('fpooja_dtl');

			$exists = ($query->num_rows() > 0);
        	
        	if($exists) {
            	$result = $query->result();
            	
            	foreach($result as $row) {
                	$qty  	= $row->nos;
                	$rate 	= $this->input->post('rate');
                	$amount = $rate * $qty;
                	
                	$this->db->where('id', $row->id);
        			$this->db->update('fpooja_dtl', array('rate'=> $rate, 'amount'=> $amount));
                }
            }
        	
            $msg="Pooja Updated";
            redirect('admin/admin/pooja_view');
        }
        
    }
    public function pooja_view(){
        $data['pooja_list']=$this->general_model->getpoojas();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/pooja/pooja_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function delete_pooja($id){
        $result=$this->general_model->deletepooja($id);
        $msg="Deleted";
        redirect('admin/admin/pooja_view');
    }
    public function print_pooja(){
        $data['temple_list']=$this->general_model->gettemples();
        $data['pooja_list']=$this->general_model->getpoojas();
        $this->load->view('admin/pooja/pooja_print',$data);
    }

	public function fetch_pooja() {
    	$poojas = $this->general_model->searchpoojas($this->input->post('search'));
    	
		$response = array();
    
		foreach ($poojas as $pooja) {
    		$response[] = array(
        		"value" => $pooja['name'] . ' - ' . $pooja['code'],
        		"label" => $pooja['name'] . ' - ' . $pooja['code'],
        		"id" => $pooja['id'],
        		"name" => $pooja['name']
    		);
		}

		$this->output
		    ->set_content_type('application/json')
		    ->set_header('Access-Control-Allow-Origin: *') // Only required if you need to allow cross-origin requests
		    ->set_output(json_encode($response));
    }

	public function pooja_availability() {
    	$pooja_id = $this->input->post('pooja_id');
    	$pooja = $this->general_model->getpoojasById($pooja_id);
    
    if($pooja[0]['allowed_qty'] == 1)
    {
    	$this->db->select('billing.*, billing_dtls.pooja, billing_dtls.date')
            ->from('billing')
            ->join('billing_dtls', 'billing.id = billing_dtls.bill_id')
            ->where('billing_dtls.pooja', $pooja_id)
            ->where('billing.deleted !=', 1)
			->order_by('billing.date', 'ASC'); // Order by billing.date in ascending order

    	$query = $this->db->get();
        $results = $query->result();
    }
    
    	$response = array();
    	if($results) {
        	foreach ($results as $value) {
    $response[] = array(
        'selectable' => false,
        'editable' => false,
        'textColor' => 'blue',
        'display' => 'background',
        'backgroundColor' => 'red',
        'start' => $value->date
    );
}
        }
		
    	$this->output
		    ->set_content_type('application/json')
		    ->set_header('Access-Control-Allow-Origin: *') // Only required if you need to allow cross-origin requests
		    ->set_output(json_encode($response));
    }

	public function pooja_calendar() {
	$data['pooja_list']=$this->general_model->getpoojas();
	$this->load->view('admin/layouts/admin_header');
	$this->load->view('admin/pooja/pooja_calendar',$data);
	$this->load->view('admin/layouts/admin_footer');
	}
    //Customer
    
//     public function add_customer(){
//         $this->form_validation->set_rules('name', 'Name', 'required');
//         $this->form_validation->set_rules('house', 'House', 'required');
//         $this->form_validation->set_rules('street', 'Street', 'required');
//       //  $this->form_validation->set_rules('post', 'Post', 'required');
//         $this->form_validation->set_rules('district', 'District', 'required');
//         $this->form_validation->set_rules('state', 'State', 'required');
//         $this->form_validation->set_rules('pincode', 'Pincode', 'required');
//         $this->form_validation->set_rules('phone', 'Phone', 'required');
//         //$this->form_validation->set_rules('email', 'Email', 'required');
//         if ($this->form_validation->run() === FALSE){
//             $this->load->view('admin/layouts/admin_header');
//             $this->load->view('admin/customer/customer_add');
//             $this->load->view('admin/layouts/admin_footer');
//         }else{
//             $data=array(
//                 'name'      =>$this->input->post('name'),
//                 'house'      =>$this->input->post('house'),
//                 'street'      =>$this->input->post('street'),
//                 'post'      =>$this->input->post('post'),
//                 'district'      =>$this->input->post('district'),
//                 'state'      =>$this->input->post('state'),
//                 'pincode'      =>$this->input->post('pincode'),
//                 'mobile'     =>$this->input->post('phone'),
//                 'email'   =>$this->input->post('email'),
//                 'status'    =>'1',
//             );
        
//         	if ($this->db->field_exists('pan_no', 'user_dtl')) {
//             	$data['pan_no'] = $this->input->post('pan_no') ?? '';
//             }
//             $id=$this->general_model->setcustomer($data);
//             $msg="Customer Saved";
        
//             // add to ledger
//             // 
//             if ($this->input->is_ajax_request() == 1) {
//             	$this->db->select('user_dtl.*, ledger.name as led_name');
// 		        $this->db->from('user_dtl');
//     	        $this->db->join('ledger','ledger.led_Id = user_dtl.led_id', 'LEFT');
//                 $this->db->where('id', $id);
//                 $query = $this->db->get();
//                 $devotee   = $query->row();
//                 $ledger_id = $devotee->led_id;

//                 $result = array(
//                 	"value" => $devotee->name.' - '.$devotee->mobile,
//                 	"label" => $devotee->name.' - '.$devotee->mobile,
//                 	"id" => $devotee->id,
//                 	"name" => $devotee->name,
//                 	"house" => $devotee->house,
//                 	"mobile" => $devotee->mobile ?? '',
//                 	"email" => $devotee->email,
//                 	"street" => $devotee->street,
//                 	"post" => $devotee->post,
//                 	"district" => $devotee->district,
//                 	"state" => $devotee->state,
//                 	"pincode" => $devotee->pincode,
//             		"led_id" => $ledger_id,
//                     "led_name" => $devotee->led_name
//     		    );
//             	echo json_encode($result);
//             } else {
//             	redirect('admin/admin/customer_view');
//             }
//         }
        
//     }
	
	/***
	 * 	Check if Customer exists 
	 ***/
	private function isCustomerExists($mobile_number) {
    	$this->db->where('mobile', $mobile_number);
    	$query = $this->db->get('user_dtl');

    	return $query->num_rows() > 0; // Returns true if ID exists, false otherwise
	}
	public function add_customer(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        // $this->form_validation->set_rules('house', 'House', 'required');
        // $this->form_validation->set_rules('street', 'Street', 'required');
        // $this->form_validation->set_rules('post', 'Post', 'required');
        // $this->form_validation->set_rules('district', 'District', 'required');
        // $this->form_validation->set_rules('state', 'State', 'required');
        // $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required');
    	// $this->form_validation->set_rules('user_type', 'User Type', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/customer_add');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $user_type = $this->input->post('user_type');
            $data=array(
                'name'      	=>$this->input->post('name'),
                'house'      	=>$this->input->post('house'),
                'street'      	=>$this->input->post('street'),
                'post'      	=>$this->input->post('post'),
                'district'      =>$this->input->post('district'),
                'state'      	=>$this->input->post('state'),
                'pincode'      	=>$this->input->post('pincode'),
                'mobile'     	=>$this->input->post('phone'),
                'email'   		=>$this->input->post('email'),
                'status'    	=>'1',
            );
        
        	if($this->isCustomerExists($this->input->post('phone'))) {
            	// Set flash data
				$this->session->set_flashdata('mobile_error', 'Mobile number is taken!');
            	redirect('admin/admin/add_customer');
            }
        
            $id=$this->general_model->setcustomer($data);
            $msg="Customer Saved";
            if ($this->input->is_ajax_request() == 1) {
                $this->db->select('user_dtl.*, ledger.name as led_name');
		        $this->db->from('user_dtl');
    	        $this->db->join('ledger','ledger.led_Id = user_dtl.led_id', 'LEFT');
                $this->db->where('id', $id);
                $query = $this->db->get();
                $devotee   = $query->row();
                $ledger_id = $devotee->led_id;
                
        	    if (!$devotee->led_id || $devotee->led_id == 0 ) {
        	        $insertData = [
        	                // 'label'     => strtolower($devotee->name),
        	                'name'      => $devotee->name,
        	                'name_mal'  => $devotee->name,
        	                'group'     => 15,
        	                'balance'   => 0,
        	                'opening_bal'=> 0
        	            ];
        	        $this->db->insert('ledger', $insertData);
        	        $ledger_id = $this->db->insert_id();
        	        
        	        $this->db->where('id', $devotee->id);
        	        $this->db->update('user_dtl', array('led_id'=>$ledger_id));
        	    }

                $result = array(
                	"value" => $devotee->name.' - '.$devotee->mobile,
                	"label" => $devotee->name.' - '.$devotee->mobile,
                	"id" => $devotee->id,
                	"name" => $devotee->name,
                	"house" => $devotee->house ?? '',
                	"mobile" => $devotee->mobile ?? '',
                	"email" => $devotee->email ?? '',
                	"street" => $devotee->street ?? '',
                	"post" => $devotee->post ?? '',
                	"district" => $devotee->district ?? '',
                	"state" => $devotee->state ?? '',
                	"pincode" => $devotee->pincode ?? '',
            		"led_id" => $ledger_id,
                    "led_name" => $devotee->led_name ?? ''
    		    );
    		    
    		    echo json_encode($result);
            } else {
                redirect('admin/admin/customer_view');
            }
        }
        
    }
    public function edit_customer($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
      //  $this->form_validation->set_rules('house', 'House', 'required');
     //   $this->form_validation->set_rules('street', 'Street', 'required');
     //   $this->form_validation->set_rules('post', 'Post', 'required');
    //    $this->form_validation->set_rules('district', 'District', 'required');
    //    $this->form_validation->set_rules('state', 'State', 'required');
    //    $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
      //  $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['customer']=$this->general_model->getcustomersById($id);
            
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/customer_edit',$data);
            $this->load->view('admin/layouts/admin_footer');

        }
        else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
                'house'      =>$this->input->post('house'),
                'street'      =>$this->input->post('street'),
                'post'      =>$this->input->post('post'),
                'district'      =>$this->input->post('district'),
                'state'      =>$this->input->post('state'),
                'pincode'      =>$this->input->post('pincode'),
                'mobile'     =>$this->input->post('phone'),
                'email'   =>$this->input->post('email'),
                
            );
        
        	/*if($this->isCustomerExists($this->input->post('phone'))) {
            	// Set flash data
				$this->session->set_flashdata('mobile_error', 'Mobile number is taken!');
            	redirect('admin/admin/edit_customer/'.$id);
            }
        */
            $id=$this->general_model->setcustomer($data);
            $msg="Customer Updated";
            redirect('admin/admin/customer_view');
        }  
    }
    public function customer_view(){
        if ($this->input->post('button')=="search"){
            $datef=$this->input->post('keyword');
            $datet=$this->input->post('datet');
            if ($datef==""){
                $data['customer_list']=$this->general_model->getcustomers();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/customer/customer_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }else{
                $data['customer_list']=$this->general_model->getcustomerbydate($datef,$datet);
                $data['date']=$datef;
                $data['datet']=$datet;
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/customer/customer_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }elseif ($this->input->post('button')=="print"){
            $datef=$this->input->post('keyword');
            $datet=$this->input->post('datet');
            if ($datef==""){
                $data['customer_list']=$this->general_model->getcustomers();
                $this->load->view('admin/customer/cust_print',$data);
            }else{
                $data['customer_list']=$this->general_model->getcustomerbydate($datef,$datet);
                $this->load->view('admin/customer/cust_print',$data);
            }
        }else{
            $data['customer_list']=$this->general_model->getcustomers();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/customer_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function print_customer(){
        $data['customer_list']=$this->general_model->getcustomers();
        $this->load->view('admin/customer/cust_print',$data);
    }
    
    public function delete_customer($id){
        $result=$this->general_model->deletecustomer($id);
        $msg="Deleted";
        redirect('admin/admin/customer_view');
    }
    
    public function customer_search(){
        if ($this->input->post('button')=="search"){
            $keyword=$this->input->post('keyword');
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            if ($keyword==""){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/customer/search');
                $this->load->view('admin/layouts/admin_footer');
            }else{
                $data['customer_list']=$this->general_model->searchcustomer($datef,$datet,$keyword);
                $data['datef']=$datef;
                $data['datet']=$datet;
                $data['keyword']=$keyword;
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/customer/search',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }else {
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/search');
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    
    // Add Category
    public function addNewCategory(){
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() === FALSE){
            
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/category/category_add');
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'name'        =>$this->input->post('name'),
                'status'      =>'1',
                'description' =>$this->input->post('description'),
            );
            
            $id=$this->category_model->setCategory($data);
            $configImage['upload_path']          = './uploads/category';
            $configImage['allowed_types']        = 'gif|jpg|png|jpeg';
            // $configImage['max_width']            = 450;
            // $configImage['max_height']           = 170;
            $configImage['remove_spaces'] = TRUE;
            
            $this->load->library('upload', $configImage);
            $this->upload->initialize($configImage);
            if (!$this->upload->do_upload('icon')){
                $imageError = array('error' => $this->upload->display_errors());
            }
            else{
                $imageData =  $this->upload->data();
                $photo = 'uploads/category/'.$imageData['file_name'];
                $upload_data = array('id' => $id, 'photo' => $photo);
                $this->category_model->updateCategoryImage($upload_data);
            }
            $msg="Category Added";
            redirect('admin/admin/category_view');
        }
        
    }
    public function birth_star(){
        $data['birth_star']=$this->general_model->getbirth_star();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/birth_star/birth_star',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function add_birth_star(){
        $this->form_validation->set_rules('file', 'File', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/birth_star/add_birth_star');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
                'phone'     =>$this->input->post('phone'),
                'address'   =>$this->input->post('address'),
                'status'    =>'1',
            );
            $id=$this->general_model->setcustomer($data);
            $msg="Customer Saved";
            redirect('admin/admin/customer_view');
        }
    }
    public function delete_birth_star($id){
        $result=$this->general_model->deletebirth_star($id);
        $msg="Deleted";
        redirect('admin/admin/birth_star');
    }
    public function getallowedqty(){
        $pooja_id = $this->input->post('pooja_id');
        $date = $this->input->post('date');
        $qty = $this->input->post('qty');
   //print $pooja_id;exit;
        $data = $this->general_model->getallowedqty($pooja_id,$date,$qty);
     echo json_encode($data);
    //return  $data;
     //echo $data;exit;
    }
    public function getPoojaByCodeNameDiety(){
        $diety=$this->input->post('diety');
        $keyword=$this->input->post('search');
    
           $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
           $this->db->from('diety_pooja');
           $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
           $this->db->join('diety','diety.id = diety_pooja.temple_id');
           if($diety){
              $this->db->where('diety_pooja.temple_id', $diety);
              $this->db->like('pooja.name', $keyword);
              $this->db->or_where('diety_pooja.code', $keyword);
           }
           else{
              $this->db->like('pooja.name', $keyword);
              $this->db->or_where('diety_pooja.code', $keyword);
           }
           $query = $this->db->get();
            //print_r($this->db->last_query());
        if ($query->num_rows() > 0) {
            $poojas = $query->result_array();
            $response = array();
            foreach($poojas as $pooja){
               $response[] = array("id"=>$pooja['pooja_id'], "value"=>$pooja['pooja_mal'].' ( '.$pooja['diety_mal'].' ) ~ '.$pooja['code'],"label"=>$pooja['code'].' | '.$pooja['pooja_mal'].' ( '.$pooja['diety_mal'].' ) ');
            }
            echo json_encode($response);
        }
        
    }
    public function getPoojaByCodeDiety(){
        $diety=$this->input->post('diety');
        $keyword=$this->input->post('search');
    
           $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
           $this->db->from('diety_pooja');
           $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
           $this->db->join('diety','diety.id = diety_pooja.temple_id');
           if($diety){
              $this->db->where('diety_pooja.temple_id', $diety);
              $this->db->where('diety_pooja.code', $keyword);
           }
           else{
              $this->db->where('diety_pooja.code', $keyword);
           }
           $query = $this->db->get();
            //print_r($this->db->last_query());
        if ($query->num_rows() > 0) {
            $pooja_data = $query->row_array();
            $response = array("code"=>$pooja_data['code'], "diety"=>$pooja_data['temple_id'],"pooja_id"=>$pooja_data['pooja_id'],"pooja"=>$pooja_data['code'].' | '.$pooja_data['pooja_mal'].'<br /> ( '.$pooja_data['diety_mal'].' ) ',"rate"=> $pooja_data['pooja_rt'],"rowcount"=> $pooja_data['rowcount']);
            echo json_encode($response);
        }
    }
    public function getPoojaByDietyPoojaCode(){
         $code=$this->input->get('data');
         $poojainfo = explode("~", $code);
         $diety_pooja_code = str_replace(' ', '', $poojainfo[1]);
         
         $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,pooja.rowcount,diety.name_mal as diety_mal');
         $this->db->from('diety_pooja');
         $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
         $this->db->join('diety','diety.id = diety_pooja.temple_id');
         $this->db->where('diety_pooja.code', $diety_pooja_code);
         $query = $this->db->get();
         $response = array();
         if ($query->num_rows() > 0) {
            $pooja_data = $query->row_array();
            $response = array("code"=>$pooja_data['code'], "diety"=>$pooja_data['temple_id'],"pooja_id"=>$pooja_data['pooja_id'],"pooja"=>$pooja_data['code'].' | '.$pooja_data['pooja_mal'].'<br /> ( '.$pooja_data['diety_mal'].' ) ',"rate"=> $pooja_data['pooja_rt'],"rowcount"=>$pooja_data['rowcount']);
         }
         echo json_encode($response);
    }
    public function getPoojaByDietyPoojaName(){
        $code=$this->input->get('data');
        $poojainfo = explode("~", $code);
        $poojainfo = explode(" ", $poojainfo[0]);
        $diety_pooja_code = $poojainfo[0];
        $deity = $poojainfo[2];
        
        $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
        $this->db->from('diety_pooja');
        $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
        $this->db->join('diety','diety.id = diety_pooja.temple_id');
        $this->db->where('pooja.name_mal', $diety_pooja_code);
        $this->db->where('diety.name_mal', $deity);
        $query = $this->db->get();
        $response = array();
        if ($query->num_rows() > 0) {
           $pooja_data = $query->row_array();
           $response = array("code"=>$pooja_data['code'], "diety"=>$pooja_data['temple_id'],"pooja_id"=>$pooja_data['pooja_id'],"pooja"=>$pooja_data['code'].' | '.$pooja_data['pooja_mal'].'<br /> ( '.$pooja_data['diety_mal'].' ) ',"rate"=> $pooja_data['pooja_rt']);
        }
        echo json_encode($response);
   }
public function getstarByCodeDiety(){
        $keyword=$this->input->post('search');

        // $this->db->select('*');
        // $this->db->from('stars');
        // $this->db->where('id', $keyword);
        // $query = $this->db->get();
        $sql = "SELECT * FROM stars 
        WHERE id = ? OR name_eng LIKE ? 
        ORDER BY CASE WHEN name_eng = ? THEN 1 ELSE 2 END ASC";

		$query = $this->db->query($sql, array($keyword, "%$keyword%", $keyword));
        //print_r($this->db->last_query());
        if ($query->num_rows() > 0) {
            $pooja_data = $query->row_array();
            $response = array("id"=>$pooja_data['id'],"star"=>$pooja_data['name_eng'].' - '.$pooja_data['name_mal']);
            echo json_encode($response);
        }
    }
  /**  public function billing(){
        $counter = $this->session->userdata("counter");  
        if($counter == ''){
            $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/billing/selectcounter',$data);
            $this->load->view('admin/layouts/admin_footer');
            return;
        }
        $this->form_validation->set_rules('date', 'Date', 'required');
        $today = date('Y-m-d');
        $query=$this->db->query("SELECT sum(billing.recv_amt) as total,sum(billing.bal_amt) as totalcre FROM `billing` WHERE billing.date='$today' AND billing.deleted!='1'");
    //print "SELECT sum(qlt*rate) as total FROM `billing_dtls` JOIN billing on billing_dtls.bill_id=billing.id WHERE billing.date='$today'";
        $collection = $query->row();
        $data['totalcollection'] = $collection->total; 
        $data['totalcredit'] = $collection->totalcre; 
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $user_id=$this->loggedIn['id'];
            $last_book=$this->general_model->getlastusedbook($user_id);
            $last_bookid=$last_book['book_issue_id'];
            if($last_bookid==""){
                $book=$this->general_model->getlastbook($user_id);
                if(isset($book)){
                    $last_bookid=$book['book_id'];
                }
            }
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $this->db->query("ALTER TABLE billing AUTO_INCREMENT=$last_id1");
            $data['book_list']=$this->general_model->getissuebooks($user_id);
        	$data['fpooja_list']=$this->general_model->getFpooja();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['site']=$this->general_model->getsite();
            $data['last_id']=$last_id1;
            $data['last_bookid']=$last_bookid;
          $data['mode']=$this->Accounts_model->getmode();
           
           // to check if code based billing or other 
            $query = $this->db->query("select * from site_settings where id =1"); 
            $row = $query->row();
            
            $this->load->view('admin/layouts/admin_header');  
           if($row->code_settings=='1'){ 
               $this->load->view('admin/billing/billingnew',$data);
           }
        
        else   if($row->code_settings=='2'){ 
       
               $this->load->view('admin/billing/billingbyname',$data);
           } 
        else  {
               $this->load->view('admin/billing/billing',$data);}
               $this->load->view('admin/layouts/admin_footer');
        }else{
      
            $this->db->trans_begin();
        
            $user_id=$this->loggedIn['id'];
            $diety=$this->input->post('temple');
            $date=$this->input->post('date');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $times=$this->input->post('time');
            $mode=$this->input->post('mode');
            $date1=$this->input->post('date1');
            $book_id=$this->input->post('book_id');
            $bill_time=date("Y-m-d H:i:s"); 
            $last_book=$this->general_model->getlastusedbook($user_id);
            $last_bookid=$last_book['book_issue_id'];
            if($last_bookid!=""&&$last_bookid!=$book_id){
                $this->db->query("UPDATE receipt_bookdtl SET book_status='Compleated' WHERE id='$last_bookid'");
            }
            $this->db->query("UPDATE receipt_bookdtl SET book_status='Active' WHERE id='$book_id'");
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`user_id`,`status`,`mode`,`bill_time`,`counter`,`book_issue_id`) VALUES ('$diety[0]','$date','---','$user_id', '1','$mode','$bill_time','$counter','$book_id')");
            
        $bill_id=$this->db->insert_id();
            $i=0;$total=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $amou=$amt[$i];
                $rata=$rate[$i];
                $time=$times[$i];
                $data=$date1[$i];
            $total+=$amou;
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1')");
         // 
            if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
                $i++;
            }
        
           $this->db->query("UPDATE billing SET total='$total',recv_amt='$total' WHERE id='$bill_id'");
            $this->db->trans_complete();
        
             if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
             }
             else{
                 $this->db->trans_commit();
             }
        //$_POST = array(); 
          //$this->db->query("UPDATE billing SET total='$total' WHERE id='$bill_id'");
            if($this->input->post('save')=="save"){
            
              $a = $this->pdfview($bill_id);
            ///$a=redirect('admin/admin/pdfview/'.$bill_id);
          
            //$a=$this->pdfview($bill_id);
            //echo $a;exit;
            redirect('admin/admin/billing/','refresh');
              //  redirect('admin/admin/billing');
            }elseif($this->input->post('save')=="print"){
                 $counter = $this->session->userdata("counter");
                 $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                 $result = $till->row_array();
                 $printer = $result['printer'];
                 // if ($_SERVER['HTTP_HOST'] == "sreevyramahakalikavukshethramkarad.in") {
                 //     redirect('admin/admin/dmbill_print/'.$bill_id);
                 // }
                 // else if($row->print_settings == 1){ 
                 if($printer == 1){ 
                     redirect('admin/admin/dmbill_print/'.$bill_id);
                 }
                 else if($printer == 2){ 
                    
                     redirect('admin/admin/bill_print/'.$bill_id);
                 }
                 else if($printer == 3){ 
                     redirect('admin/admin/receipt_print/'.$bill_id);
                 }
                 else{
                     redirect('admin/admin/bill_print/'.$bill_id);
                 }
            }
        }
    }*/

	public function update_bill_no($bill_id) {
        $new_bill_no 	= $this->billing_model->getCurrentFyBillNo();
    	$fy_no 			= $this->billing_model->getCurrentFyNo();
        $current_fy_id	= $this->billing_model->getCurrentFyId();
    
        $this->db->trans_begin();
        try {
            $this->db->set('bill_no', $new_bill_no);
            $this->db->set('fy_bill_no', $fy_no);
            $this->db->set('fy_id', $current_fy_id);
            $this->db->where('id', $bill_id);
            $this->db->update('billing');
            $this->db->trans_commit();
            return true;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            if ($e->getCode() == 1062) { // MySQL error code for duplicate entry
                $year_no = $this->general_model->getCurrentBillNo($year);
                $new_bill_no = $year."/".$year_no;
                // Retry the update once with the new values
                return $this->update_bill_no($bill_id); 
            } else {
                // Handle other types of exceptions
                error_log('Database update error: ' . $e->getMessage());
                return false;
            }
        }
    }
// 	 Billing
 	public function billing() { print "p";exit;
    
        $counter = $this->session->userdata("counter");  
        if($counter == ''){

        $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/billing/selectcounter',$data);
            $this->load->view('admin/layouts/admin_footer');
            return;
        }
        $this->form_validation->set_rules('date', 'Date', 'required');
        $today = date('Y-m-d');
        $query=$this->db->query("SELECT sum(billing.recv_amt) as total,sum(billing.bal_amt) as totalcre FROM `billing` WHERE billing.date='$today' AND billing.deleted!='1'");
    //print "SELECT sum(qlt*rate) as total FROM `billing_dtls` JOIN billing on billing_dtls.bill_id=billing.id WHERE billing.date='$today'";
        $collection = $query->row();
        $data['totalcollection'] = $collection->total; 
        $data['totalcredit'] = $collection->totalcre; 
    
    	$this->db->select('name');
        $this->db->from('counter');
        $this->db->where('id', $counter);
        	
        $data['counter'] = $this->db->get()->row()->name;
    	$data['username'] = $this->loggedIn['name'];
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $user_id=$this->loggedIn['id'];
            $last_book=$this->general_model->getlastusedbook($user_id);
            $last_bookid=$last_book['book_issue_id'];
            $data['mode']=$this->Accounts_model->getmode();
            if($last_bookid==""){
                $book=$this->general_model->getlastbook($user_id);
                if(isset($book)){
                    $last_bookid=$book['book_id'];
                }
            }
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
        
        	if($this->db->table_exists('pooja_availability')) {
            	$this->db->join('pooja', 'pooja_availability.pooja_id=pooja.id');
            	$this->db->select('pooja.name as pooja');
            	$this->db->select('SUM(pooja_availability.issued_qty) as quantity');
            	$this->db->where('pooja_date', $today);
            	$this->db->order_by('pooja_availability.id');
            	$this->db->group_by('pooja_availability.pooja_id');
            	$pooja_availability_query = $this->db->get('pooja_availability');

            	if($pooja_availability_query->num_rows() > 0 ) {
                	$pooja_availability_array = $pooja_availability_query->result_array();
            	} else {
                	$pooja_availability_array = 0;
            	}

            	$data['pooja_availability_array'] = $pooja_availability_array;
            }
        
        	if($this->db->table_exists('payment_modes')) {
            	$payment_modes = $this->db->get('payment_modes')->result_array();
            } else {
            	$payment_modes = array(
  					array('id' => '1','name' => 'Cash','slug' => 'cash'),
  					array('id' => '5','name' => 'NEFT','slug' => 'neft'),
  					array('id' => '6','name' => 'QR Code','slug' => 'qr_code'),
  					array('id' => '7','name' => 'Card','slug' => 'card'),
  					array('id' => '8','name' => 'MO','slug' => 'mo'),
  					array('id' => '10','name' => 'Endowment','slug' => 'endowment'),
  					array('id' => '11','name' => 'Cheaque','slug' => 'Cheaque'),
  					array('id' => '12','name' => 'DD','slug' => 'DD')
			    );
            }
        
        	$data['payment_modes'] = $payment_modes;
        
            $this->db->query("ALTER TABLE billing AUTO_INCREMENT=$last_id1");
            $data['book_list']=$this->general_model->getissuebooks($user_id);
        	$data['fpooja_list']=$this->general_model->getFpooja();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['site']=$this->general_model->getsite();
            $data['last_bookid']=$last_bookid;
        	// $data['order_id']=$order_id;
           
           // to check if code based billing or other 
            $query = $this->db->query("select * from site_settings where id =1"); 
            $row = $query->row();
            
        	if($this->db->field_exists('financial_year_settings', 'site_settings') && $row->financial_year_settings == 1) {
        		$current_fy_no = $this->billing_model->getCurrentFyBillNo();
            	$data['last_id']=$current_fy_no;
            } else {
            	$data['last_id']=$last_id1;
            }
        	// print_r($row->code_settings);exit;
            $this->load->view('admin/layouts/admin_header');  
            if($row->code_settings=='1'){ 
                print "ok";exit;
               $this->load->view('admin/billing/billingnew',$data);
            }
            else if($row->code_settings=='2'){ 
               $this->load->view('admin/billing/billingbyname',$data);
            }
        	else if($row->code_settings=='3'){ 
               $this->load->view('admin/billing/billing_kothamkurissi',$data);
            }
         	else if($row->code_settings=='4'){ 
               $this->load->view('admin/billing/billing4',$data);
            }
        	else if($row->code_settings=='10'){ 
               $this->load->view('admin/billing/billing_screen_5',$data);
            }
        	else if($row->code_settings=='5'){ 
               $this->load->view('admin/billing/billingbyname_starcode',$data);
            } 
        	else if($row->code_settings=='10'){ 
               $this->load->view('admin/billing/billingbyname_starcode_tamil',$data);
            } 
        	else if($row->code_settings=='6'){ 
               $this->load->view('admin/billing/billing_6',$data);
            } else if($row->code_settings=='7'){ 
               $this->load->view('admin/billing/billing_screen_6',$data);
            } else if($row->code_settings=='8'){ 
               $this->load->view('admin/billing/billing_screen_8',$data);
            }
            else{
               $this->load->view('admin/billing/billing',$data);
            }
               $this->load->view('admin/layouts/admin_footer');
        }
        else{
      
          	$token = $this->input->post('token');
    		if ($token && $token !== $this->session->userdata('form_token')) {
    			// Invalid token, handle accordingly (e.g., show error message)
    			redirect('admin/admin/billing'); // Redirect to form view to prevent further processing
    			return;
    		}
        
        	$flash_data = $this->session->flashdata('form_processed');
			if (!empty($flash_data) && $flash_data['processed']) {
    			$bill_id = $flash_data['custom_value']; // Retrieve custom value
    			redirect('admin/admin/bill_print/'.$bill_id);
    			return;
			}

        
    	  	$this->session->unset_userdata('form_token');
        
          $custom_booking_id = $this->input->post('custom_booking_id') ?? null;
          $advance_amount = $this->input->post('advance_amount') ?? null;
          
          $this->db->trans_begin();
          try {
          //	print_r($_REQUEST);exit;
            $user_id=$this->loggedIn['id'];
            $diety=$this->input->post('temple');
            $date=$this->input->post('date');
            $name=$this->input->post('name');
			$count=$this->input->post('count');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $times=$this->input->post('time');
            $mode=$this->input->post('mode');
            $date1=$this->input->post('date1') ?? date('Y-m-d');
            $book_id=$this->input->post('book_id');
            $optradio=$this->input->post('optradio');
          	$saveType = $this->input->post('save');
          	$customer_id = $this->input->post('customer_id') ?? 0;
          	$remarks = $this->input->post('remarks');
          	$gothrams = $this->input->post('gothram');
          	$appearance = $this->input->post('appearance');
          
          	$received_amount = $this->input->post('received');
          	$bal_amount 	 = $this->input->post('balance');

            $bill_time=date("Y-m-d H:i:s"); 
            $last_book=$this->general_model->getlastusedbook($user_id);
            $last_bookid=$last_book['book_issue_id'];
          	$site_settings = $this->general_model->getsite();
            if($last_bookid!=""&&$last_bookid!=$book_id){
                $this->db->query("UPDATE receipt_bookdtl SET book_status='Completed' WHERE id='$last_bookid'");
            }
            $this->db->query("UPDATE receipt_bookdtl SET book_status='Active' WHERE id='$book_id'");
          	
          	if($this->db->field_exists('appearance', 'billing')) {
            	$this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`user_id`,`status`,`mode`,`bill_time`,`counter`,`book_issue_id`, `customer_id`, `appearance`) VALUES ('$diety[0]','$date','---','$user_id', '1','$mode','$bill_time','$counter','$book_id', '$customer_id', '$appearance')");
            } else {
            	$this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`user_id`,`status`,`mode`,`bill_time`,`counter`,`book_issue_id`, `customer_id`) VALUES ('$diety[0]','$date','---','$user_id', '1','$mode','$bill_time','$counter','$book_id', '$customer_id')");
            }
          
            $bill_id=$this->db->insert_id();
          	if($this->db->field_exists('financial_year_settings', 'site_settings') && $site_settings[0]['financial_year_settings'] == 1) {
        		$current_fy_no = $this->billing_model->getCurrentFyBillNo();
            	$this->update_bill_no($bill_id);
            } 
          
          	if($this->db->field_exists('remarks', 'billing')) {
        		$this->db->where('id', $bill_id);
            	$this->db->update('billing', array('remarks'=> $remarks));
            } 
          
          
            $i=0;$total=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
				$cout=$count[$i];
            	$amou=abs($amt[$i]);
                // $rata=$rate[$i];
                $time=$times[$i];
                $data=$date1[$i];
            	$rata= $this->general_model->getpoojarate($poja);
            	
            	$gothram = '';
            	if($gothrams) 
            		$gothram = $gothrams[$i];
            	$rowcount = $this->general_model->getpooja_rowcount($poja);
            
            	if($rata > 0 ) { 
                	$amou = ((int)$qult * (float)$rata);
            	} 
            
            	if($rowcount > 1 ) {
                    $amou=$amt[$i];
                	$rata=$rate[$i];
                }
            
            	$this->load->database();
            
            	$pooja_availability = 'pooja_availability';
	
				if ($this->db->table_exists($pooja_availability)) {
            	$this->db->select('*');
            	$this->db->from('pooja_availability');
            	$this->db->where('pooja_id', $poja); 
				$this->db->where('pooja_date', $data);
            	$availabilityQuery = $this->db->get();
            	
            	if ($availabilityQuery->num_rows() > 0) {
                	$availability = $availabilityQuery->row()->issued_qty;
                	
                	$this->db->select('SUM(billing_dtls.qlt) as qty');
    	            $this->db->from('billing_dtls');
    	            $this->db->join('billing', 'billing_dtls.bill_id=billing.id');
    	            $this->db->where('billing_dtls.date', $data);
    	            $this->db->where('billing_dtls.pooja', $poja);
                	$this->db->where('billing_dtls.type !=', 'S');
    	            $this->db->where('billing_dtls.deleted', 0);
    	            $this->db->where('billing.deleted', 0);
    	            $issued_qty = $this->db->get()->row()->qty;
    	            
    	            $total_qty  = $availabilityQuery->row()->quantity;
                	$bal  = $availabilityQuery->row()->issued_qty;
					$issued = $total_qty - $bal;
                
                	if($availability == 0 || ($issued_qty+$qult) > $total_qty) {
                	    $bal_qty = $total_qty - $issued_qty;
                	    $message = $availability == 0 ? 'Pooja is not available! ' : ( ($issued_qty+$qult) > $total_qty ? 'Please choose a quantity less than or equal to '.$bal_qty.'!' : '');
                	    
                		$this->session->set_flashdata('warning', $message);
                    	$this->session->set_flashdata('post_data', json_encode($this->input->post()));
                		redirect('admin/admin/billing');
                    }
                } 
            
				$this->db->set('issued_qty', 'issued_qty - '.$qult, false); 
				$this->db->where('pooja_id', $poja); 
				$this->db->where('pooja_date', $data);
				$this->db->where('issued_qty > ', 0);
				// $this->db->order_by('id', 'desc');
				$this->db->update('pooja_availability');
                }
            
            
				$table_name = 'pooja_products';
	
				if ($this->db->table_exists($table_name)) {
        			$this->db->select('*');
        			$this->db->from('pooja_products');
        			$this->db->where('pooja_id', $poja);
        			$query = $this->db->get();
        
					$pooja_products = $query->result();
					if($_SERVER['HTTP_HOST'] != "parakkunnathtemple.com") {
                	foreach($pooja_products as $pooja_product) {
                    	if($dety == '102') {
                    		$type = 2;
                    	} else {
                    		$type = 1;
                    	}
                		
                    	$added_date = date('Y-m-d');
            			$product_id = $pooja_product->product_id;
						$product    = $this->general_model->getinv_productbyid($product_id);
            			$unit	    = $product['unit'];
            			$qty        = $pooja_product->quantity;
                 
                        $tqty=$qult*$qty;
            			$this->db->query("INSERT INTO adjustment(`bill_id`,`product_id`,`date`,`unit`,`type`,`qty`,`status`) VALUES ('$bill_id','$product_id','$date','$unit','-','$tqty', '0')");
                    	$adjustment_id=$this->db->insert_id();
                    	$this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$product_id','$unit', '-$tqty', 'AD', '$user_id', '$bill_id')");
                    }
				}
				}
            	
            
            	$total+=$amou;

            	$this->db->select('*');
            	$this->db->from('pooja');
            	$this->db->where('id', $poja);
            	$query = $this->db->get();
            
            	if ( $query->row()->has_token == 1 ) {
                	$this->db->select('token');
                	$this->db->from('billing_dtls');
                	$this->db->join('billing', 'billing_dtls.bill_id=billing.id');
                	$this->db->where('billing_dtls.date', $data);
                	$this->db->where('pooja', $poja);
                	$this->db->where('billing.deleted', 0);
                	$this->db->order_by('billing_dtls.id', 'desc');
                	$query = $this->db->get();
                
                	if ($query->num_rows() != 0) {
                    	$last_token = $query->row()->token ?? 0;
                    } else {
                    	$last_token = 0;
                    }
                
                	$token = $last_token+1;
                	
                	if($this->db->field_exists('gothram', 'billing_dtls')) {
                    	$this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`, `token`, `gothram`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1', '$token', '$gothram')");            	
                    } else {
                    	$this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`, `token`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1', '$token')");            	
                    }
                
					
                } else {
                	$nama = "".$nama."";
                	$billing_details_data = array(
                    	'bill_id' => $bill_id,
                    	'name' => $nama,
                    	'diety_id' => $dety,
                    	'star' => $ster,
                    	'pooja' => $poja,
                    	'qlt' => $qult,
                    	'time' => $time,
                    	'rate' => $rata,
                    	'amount' => $amou,
                    	'date' => $data,
                    	'status' => 1
                    );
                
                	if($this->db->field_exists('gothram', 'billing_dtls')) {
                    	$billing_details_data['gothram'] = $gothram;
                    }
                	$this->db->insert('billing_dtls', $billing_details_data);
                	
                	// $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1')");
                }
                $bill_dtls_id = $this->db->insert_id();
            	if ($this->db->field_exists('receipt_no', 'billing_dtls') && $dety == 8) {
                	$this->db->select('*');
                	$this->db->from('billing_dtls');
                	$this->db->where('diety_id', 8);
                	$this->db->where('id !=', $bill_dtls_id);
                	$this->db->order_by('id', 'desc');
                	$result = $this->db->get()->row()->receipt_no;

                	$receipt_no  = ($result+1) ?? 1;
                	$this->db->where('id', $bill_dtls_id);
                	$this->db->update('billing_dtls', array('receipt_no'=> $receipt_no));
            	}
            	
            	if ($poja=="2000"){
                    
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
            
            	if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
                    
                    	$pooja_name = $this->db->where('id', $poja)->get('pooja')->row()->name;
                    	$customer = $this->db->where('id', $customer_id)->get('user_dtl')->row();
                    	$customer_name = $customer->name;
                    	$mobile = $customer->mobile;
    					// $message = urlencode("Jai Shankara, Dear $customer_name,Your  pooja $pooja_name on $data at Kalady Sri Adi Shankara  Madom, Telangana. We look forward to your participation. For any inquiries, 8350903080 n Pranavam");
    					// $url = "http://sms.bourgeoninnovations.com/SMS_API/sendsms.php?apikey=22fae393-3f72-11ef-a4f5-e29d2b69142c&mobile=$mobile&sendername=PRNVMS&message=$message&routetype=1&tid=1607100000000317646";
    					$message = urlencode("Jai Shankara, Dear $customer_name,Your  pooja $pooja_name on $data at Kalady Sri Adi Shankara  Madom, Telangana. We look forward to your participation. For any inquiries, 8350903080 \n Pranavam");
    					$url = "http://sms.bourgeoninnovations.com/SMS_API/sendsms.php?apikey=22fae393-3f72-11ef-a4f5-e29d2b69142c&mobile=$mobile&sendername=PRNVMS&message=$message&routetype=1&tid=1607100000000317646";
                
                		$curl = curl_init($url);
        				curl_setopt($curl, CURLOPT_URL, $url);
        				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        				$resp = curl_exec($curl);
    					print_r($resp);
        				curl_close($curl);
                    }
            
                $i++;
            }
        
          	$received = $total;
          	$balance = 0;
          	if($received_amount) {
            	$received = $received_amount;
            	$balance  = $total - $received;
            }
          
            if($optradio==1){
                $this->db->query("UPDATE billing SET total='$total',recv_amt='$received',bal_amt='$balance' WHERE id='$bill_id'");
            }else{
                $this->db->query("UPDATE billing SET total='$total',recv_amt='$received',bal_amt='$balance' WHERE id='$bill_id'");
            }
          
          	if($advance_amount && $advance_amount != '') {
            	$balance_amount = $total - $advance_amount;
            	$this->db->query("UPDATE billing SET total='$total',recv_amt='$advance_amount',bal_amt='$balance_amount' WHERE id='$bill_id'");
            }
          
          	if($custom_booking_id && $custom_booking_id != '') {
            	$custom_booking = $this->db->where('id', $custom_booking_id)->get('custom_booking_details')->row();
            	$mobile_number  = $custom_booking->contact_number_1 ?? $custom_booking->contact_number_2;
            
            	$this->db->where('mobile', $mobile_number);
    			$query = $this->db->get('user_dtl');

    			$exists = $query->num_rows() > 0;
            	
            	if($exists) {
                	$customer_id = $query->row()->id;
                } else {
                	$this->db->insert('user_dtl', array('name'=> $custom_booking->name, 'mobile'=> $mobile_number, 'house'=> $custom_booking->address));
                	$customer_id = $this->db->insert_id();
                }
            	
            	$this->db->where('id', $bill_id);
            	$this->db->update('billing', array('customer_id'=> $customer_id));
            	
            	$this->db->where('id', $custom_booking_id);
            	$this->db->update('custom_booking_details', array('bill_id'=> $bill_id));
            }
          
          	$this->db->trans_commit();
          } catch (Exception $e) {
            $this->db->trans_rollback();
          }
          $this->db->trans_complete();
          
           foreach ($_POST as $key => $value) {
        		unset($_POST[$key]);
    	   }
        	
        	$this->session->set_flashdata('form_processed', array('processed' => true, 'custom_value' => $bill_id));

//              if ($this->db->trans_status() === FALSE) {
//                  $this->db->trans_rollback();
//              }
//              else{
//                  $this->db->trans_commit();
//              }
        //$_POST = array(); 
          //$this->db->query("UPDATE billing SET total='$total' WHERE id='$bill_id'");
//             if($this->input->post('save')=="save"){
//             $a = $this->pdfview($bill_id);
//             ///$a=redirect('admin/admin/pdfview/'.$bill_id);
          
//             //$a=$this->pdfview($bill_id);
//             //echo $a;exit;
//             redirect('admin/admin/billing/','refresh');
//             }
        
//         elseif($this->input->post('save')=="print"){
//         
			// $customer_query = $this->db->select('*')->from('user_dtl')->where('id', $orders[0]['customer_id'])->get();
			// if($customer_query->num_rows() > 0) {
			// $customer = $customer_query->row();
			// $email	  = $customer->email;
			// 	if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {	
			// $this->sendBillPrint2($bill_id, $email);
			// }
			// }
        
			if($custom_booking_id && $custom_booking_id != '') {
            	redirect('admin/admin/custom_bill_print/'.$bill_id.'/'.$custom_booking_id);
            }
        
        
        	if($saveType=="add_item"){
           		if($dety == '102') {
           			$type = 2;
           		} else {
           			$type = 1;
           		}
				if($_SERVER['HTTP_HOST'] == "parakkunnathtemple.com") {
				
				{
					
				foreach($pooja_products as $pooja_product) {
                    	if($dety == '102') {
                    		$type = 2;
						$typ='-';
						
                    	} else {
                    		$type = 1;
								$typ='+';
                    	}
                		
						
                    	$added_date = date('Y-m-d');
            			$product_id = $pooja_product->product_id;
						$product    = $this->general_model->getinv_productbyid($product_id);
            			$unit	    = $product['unit'];
            			$qty        = $pooja_product->quantity;
                 
                        $tqty=$qult;
						
						if($type==2) {
            			$this->db->query("INSERT INTO adjustment(`bill_id`,`product_id`,`date`,`unit`,`type`,`qty`,`status`) VALUES ('$bill_id','$product_id','$date','$unit','-','$tqty', '0')");
                    	$adjustment_id=$this->db->insert_id();
                    	$this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$product_id','$unit', '-$cout', 'SALE', '$user_id', '$bill_id')");
						}
						else {
							
						$this->db->query("INSERT INTO adjustment(`bill_id`,`product_id`,`date`,`unit`,`type`,`qty`,`status`) VALUES ('$bill_id','$product_id','$date','$unit','+','$tqty', '0')");
                    	$adjustment_id=$this->db->insert_id();
                    	$this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$product_id','$unit', '$cout', 'AD', '$user_id', '$bill_id')");
						}
                    }
					
					redirect('admin/admin/bill_print/'.$bill_id);
				}
				}
                redirect('admin/admin/adjustment/'.$bill_id.'/'.$type);
           }  else if($saveType=="a6_print"){
           		redirect('admin/admin/bill_print_a6/'.$bill_id);
           }  else {
                 $counter = $this->session->userdata("counter");
               	 $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                 $result = $till->row_array();
                 $printer = $result['printer'];
                 if($printer == 1){ 
                     redirect('admin/admin/dmbill_print/'.$bill_id);
                 }
                 else if($printer == 2){ 
                    
                     redirect('admin/admin/bill_print/'.$bill_id);
                 }
                 else if($printer == 3){ 
                     redirect('admin/admin/receipt_print/'.$bill_id);
                 }
                 else{
                     redirect('admin/admin/bill_print/'.$bill_id);
                 }
            }

        }
    }

	public function custom_bill_print($bill_id, $custom_booking_id) {
    	$this->db->select('*');
        $this->db->from('custom_booking_details');
        $this->db->where('bill_id', $bill_id);
        $query = $this->db->get();
            
        $booking_details = $query->row();
        $bill_print_type = $booking_details->type;
    
    	$data['booking_details'] = $booking_details;
    	$data['temple_list']     = $this->general_model->gettemples();
    	$data['site_settings']   = $this->db->get('site_settings')->row();
        $data['bill_list']  	 = $this->general_model->getbillingById($bill_id);
        $data['bill_dtls']  	 = $this->general_model->getbillingdtlsById($bill_id);
    	$data['bill_id']		 = $bill_id;
    
    	
    	if ( $bill_print_type == 'AUD') {
        	$this->load->view('admin/custombookings/auditorium_booking_print',$data);
        } else if ( $bill_print_type == 'ELF') {
        	$this->load->view('admin/custombookings/elephant_booking_print',$data);
        }
    }
	public function check_pooja_availability() {
        $date = $this->input->post('date');
        $pooja_id = $this->input->post('pooja_id');
        $pooja = $this->general_model->getpoojasById($pooja_id);

        $this->db->select('billing.*, billing_dtls.pooja, billing_dtls.date')
                ->from('billing')
                ->join('billing_dtls', 'billing.id = billing_dtls.bill_id')
                ->join('pooja', 'billing_dtls.pooja = pooja.id')
                ->where('billing_dtls.pooja', $pooja_id)
                ->where('billing.deleted !=', 1)
                ->where('billing_dtls.date', $date)
                ->where('pooja.allowed_qty', 1);
        
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                // The record exists
                echo json_encode([
                    'exists'=> 1,
                    'pooja'=> $pooja[0]['name']
                ]);
            } else {
                // The record does not exist
                echo json_encode(0);
            }  
    }

	public function poojaAvailabilityCheck() {
        $date = $this->input->post('date');
        $pooja_id = $this->input->post('pooja_id');
        $pooja = $this->general_model->getpoojasById($pooja_id);

        if ($_SERVER['HTTP_HOST'] == "punnyam.templesoftware.in") {
                
            if($pooja[0]['quantity_group'] == 1) {
                $this->db->select('billing.*, billing_dtls.pooja, billing_dtls.date')
                        ->from('billing')
                        ->join('billing_dtls', 'billing.id = billing_dtls.bill_id')
                        ->join('pooja', 'billing_dtls.pooja = pooja.id')
                        ->where('billing_dtls.pooja', $pooja_id)
                        ->where('billing.deleted !=', 1)
                        ->where('billing_dtls.date', $date);
            
                        // $this->db->where('pooja.allowed_qty', 1);
                
                        $query = $this->db->get();

            		$this->db->select('*');
        			$this->db->from('blocked_pooja');
        			$this->db->where('pooja_id', $pooja_id);
        			$this->db->where('date', $date);
        			$query1 = $this->db->get();
            		
                if ($query->num_rows() > 0 || $query1->num_rows() > 0) {
                    // The record exists
                    echo json_encode([
                        	'exists'=> 1,
                        	'pooja'=> $pooja[0]['name']
                    	]);
                } else {
                    // The record does not exist
                    echo json_encode(0);
                }
            } else if ($_SERVER['HTTP_HOST'] != "alathiyoor.templesoftware.in") {
            	$date = $this->input->post('date');
        $pooja_id = $this->input->post('pooja_id');
        $pooja = $this->general_model->getpoojasById($pooja_id);

        $this->db->select('billing.*, billing_dtls.pooja, billing_dtls.date')
                ->from('billing')
                ->join('billing_dtls', 'billing.id = billing_dtls.bill_id')
                ->join('pooja', 'billing_dtls.pooja = pooja.id')
                ->where('billing_dtls.pooja', $pooja_id)
                ->where('billing.deleted !=', 1)
                ->where('billing_dtls.date', $date)
                ->where('pooja.allowed_qty', 1);
        
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                // The record exists
                echo json_encode([
                    'exists'=> 1,
                    'pooja'=> $pooja[0]['name']
                ]);
            } else {
                // The record does not exist
                echo json_encode(0);
            } 
            } else {
                $this->db->select('SUM(p.default_qty) as total_qty, SUM(p.default_qty * bd.qlt) as total');
                $this->db->from('billing b');
                $this->db->join('billing_dtls bd', 'bd.bill_id = b.id');
                $this->db->join('pooja p', 'bd.pooja = p.id');
                $this->db->where('p.quantity_group', 2);
                $this->db->where('bd.date', $date);

                $query = $this->db->get();
                $result = $query->row();
                $totalQty = $result->total;
                
                if($totalQty < 5) {
                	// echo json_encode([
                	// 'default_qty'=>$pooja[0]['default_qty'],
                	// 'qty' => $this->input->post('qty'),
                	// 'current_qty' => $totalQty,
                	// 'expected' => $pooja[0]['default_qty'] * $this->input->post('qty'),
                	// 'total' => ($pooja[0]['default_qty'] * $this->input->post('qty')) + $totalQty,
                	// 'status' => (($pooja[0]['default_qty'] * $this->input->post('qty')) + $totalQty) <= 5,
                	// 'result'=>$result
                	// ]);
                
                    if((($pooja[0]['default_qty'] * $this->input->post('qty')) + $totalQty) <= 5) {
                        echo json_encode(0);
                    } else {
                        echo json_encode([
                                'exists'=> 1,
                                'pooja'=> $pooja[0]['name'],
                        		'qty' => $totalQty
                            ]);
                    }
                } else {
                    echo json_encode([
                        'exists'=> 1,
                        'pooja'=> $pooja[0]['name'],
                        'qty'=> $totalQty
                        ]);
                }
            }
        } else {
			$pooja_ids = array();
    	$flag 	   = false;
        $date 	   = $this->input->post('date');
        $pid  = $this->input->post('pooja_id');
    	$quantity  = (int)$this->input->post('qty');
    	$is_submit = $this->input->post('is_submit');
    
    	$pooja_ids[] = $pid;
    
    	foreach($pooja_ids as $pooja_id) {
        $pooja = $this->general_model->getpoojasById($pooja_id);
    
//     	$this->db->select('SUM(quantity) as qty');
//     	$this->db->from('billing_online');
//     	$this->db->where('order_id', $this->session->order_id);
//     	$this->db->where('pooja_id', $pooja_id);
//     	$this->db->where('pooja_date', $date);
//     	$this->db->where('deleted', 0);
//     	$query = $this->db->get();
    	
//     	$temp_qty = $query->row()->qty;
    
//     	if( $is_submit == 1) {
//         	$temp_qty = 0;
//         }
        $temp_qty = 0;	    
		$query = $this->db->select('SUM(billing_dtls.qlt) as qty')
                ->from('billing')
                ->join('billing_dtls', 'billing.id = billing_dtls.bill_id')
                ->join('pooja', 'billing_dtls.pooja = pooja.id')
                ->where('billing_dtls.pooja', $pooja_id)
                ->where('billing.deleted', 0)
                ->where('billing_dtls.date', $date)
                ->where('pooja.allowed_qty >', 0)
            	->get();
    	$qty = $query->row()->qty ?? 0;
    	
    	
    	if($qty == 0 && $pooja[0]['allowed_qty'] > 0) { 
        	if(($temp_qty + $quantity) > $pooja[0]['allowed_qty']) {
            	$flag = true;
            	$available_qty = ($pooja[0]['allowed_qty'] - $temp_qty);
            }
        } else if($qty > 0 && $pooja[0]['allowed_qty'] > 0) {
        	if(($qty + $temp_qty + $quantity) >= $pooja[0]['allowed_qty']) {
            	$flag = true;
            	$available_qty = ($pooja[0]['allowed_qty']- ($qty + $temp_qty));
            }
        }
    
        $hasAvailability = false;
        if($this->db->table_exists('pooja_availability')) {
    		$this->db->select('*');
    		$this->db->from('pooja_availability');
    		$this->db->where('pooja_id', $pooja_id);
    		$this->db->where('pooja_date', $date);
    		$availability_query = $this->db->get();
        	$hasAvailability = $availability_query->num_rows() > 0;
        }
    	if($hasAvailability) {
        	$availability = $availability_query->row();
        	$max_qty 	= $availability->quantity;
        	$issued_qty = (int)$availability->issued_qty;
        
        	if($issued_qty > 0 && ($issued_qty - ($quantity+$temp_qty)) < 0 ) {
            	$flag=true;
            	$available_qty = ($issued_qty-$temp_qty);
            } else if ($issued_qty == 0) {
            	$flag=true;
            	$available_qty = 0;
            }
        }
    	
        }
        if($flag) {
        	echo json_encode([
                    'exists'=> 1,
                    'pooja'=> $pooja[0]['name'],
            		'qty'  => $available_qty ?? null
                ]);
        } else {
        	echo json_encode(0);
        }
        }    
    }
    public function billing_view($id=null){
    	$this->form_validation->set_rules('type', 'Type', 'required');

        if ($id!=null){
            $data['header']=$id;
        }else{
            $data['header']="1";
        }
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/billing_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $type=$this->input->post('type');
            $keyword=$this->input->post('keyword');
            $bill=$this->input->post('bill');
            $dateto=$this->input->post('dateto');
            $data['bill_list']=$this->general_model->getbill($type,$keyword,$dateto,$bill);
            $data['type']=$type;
            $data['date']=$keyword;
            $data['bill']=$bill;
            $data['dateto']=$dateto;
        
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/billing_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/billing_print',$data);
            }elseif($this->input->post('serch')=="summary"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/billsum_print',$data);
            }
        }
    }
    
    public function deleted_bill(){
        $this->form_validation->set_rules('keyword', 'Date', 'required');
        $this->form_validation->set_rules('dateto', 'dateto', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['bill_list']=$this->general_model->getdlbill();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/deleted_bill',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $dateto=$this->input->post('dateto');
            $data['bill_list']=$this->general_model->getdlbill($keyword,$dateto);
            $data['date']=$keyword;
            $data['dateto']=$dateto;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/deleted_bill',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/deleted_print',$data);
            }
        }
    }

    public function assigncounter(){
         $counterid=$this->input->post('counter_id');
         $this->session->set_userdata("counter",$counterid);
    	 header('Location: '.$_SERVER['HTTP_REFERER']);
         // redirect('admin/admin/billing');
    }

	public function bill_print_a6($id, $reprint=null){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
    
		$data['adjustment'] = [];
    	if ($this->session->userdata('adj_ids')) {
        	$ids = $this->session->userdata('adj_ids');
        	foreach($ids as $adjustment_id) {
            	$data['adjustment'][] = $this->general_model->getadjustmentById($adjustment_id)[0];
            }
        }
		$this->load->view('admin/billing/bill_print_nhangattiri',$data);
    	$this->session->unset_userdata('adj_ids');
    }
	
    public function bill_print($id, $reprint=null){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
    	$data['bill_details']=$this->general_model->getBillById($id);
		$data['adjustment'] = [];
       	if($this->db->field_exists('bill_id', 'adjustment')) {
    	$this->db->select('id');
    	$this->db->from('adjustment');
    	$this->db->where('bill_id', $id);
    	$query = $this->db->get();
    	
    	$data['adjustment'] = [];
    	if ($this->session->userdata('adj_ids')) {
        	$ids = $this->session->userdata('adj_ids');
        	foreach($ids as $adjustment_id) {
            	$data['adjustment'][] = $this->general_model->getadjustmentById($adjustment_id)[0];
            }
        } else if($query->num_rows() > 0) {
        	$ids = $query->result();
        
        	foreach($ids as $adjustment_id) {
            	$aid = $adjustment_id->id;
            	$data['adjustment'][] = $this->general_model->getadjustmentById($aid)[0];
            }
        }
        }
    
        $bill_id=$id;
        if ($_SERVER['HTTP_HOST'] == "sreevyramahakalikavukshethramkarad.in") {
             $this->load->view('admin/billing/receiptprint',$data);
        }
        else if ($_SERVER['HTTP_HOST'] == "illathbhadhrakalitemple.com") {
              $this->load->view('admin/billing/dm_fullprint',$data);
         }
        else if ($_SERVER['HTTP_HOST'] == "puthoor.templesoftware.in") {
             $this->load->view('admin/billing/dmprint',$data);
         }
        else if($_SERVER['HTTP_HOST'] == "nhangattiribhagavathydevsawom.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_new',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_new',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    
     else if($_SERVER['HTTP_HOST'] == "ponekkavu.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
 
     else if($_SERVER['HTTP_HOST'] == "thayat.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
 
    else if($_SERVER['HTTP_HOST'] == "pp.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
    
    else if($_SERVER['HTTP_HOST'] == "malaysia.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
    
    
    else if($_SERVER['HTTP_HOST'] == "nblm.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }

    else if($_SERVER['HTTP_HOST'] == "kaithrara.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }

    else if($_SERVER['HTTP_HOST'] == "saligramam.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "punnyam.encloudconsulting.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint_shaneeswara',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }

    else if($_SERVER['HTTP_HOST'] == "nh2.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
      else if($_SERVER['HTTP_HOST'] == "nottanalukkalbhagavathi.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
    

     else if($_SERVER['HTTP_HOST'] == "manikandeswaram.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "bst.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
 
     else if($_SERVER['HTTP_HOST'] == "tripuranthaka.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                //$this->load->view('admin/billing/bill_print_nhangattiri',$data);
                 $this->load->view('admin/billing/bill_print_nhangattiri_no_header_malayalam',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                      $this->load->view('admin/billing/bill_print_nhangattiri_no_header_malayalam',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "mannursivatemple.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "chelannursivatemple.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "nottanalukkalbhagavathi.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
        
     else if($_SERVER['HTTP_HOST'] == "komangalam.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint_komangalam',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }
    
     else if($_SERVER['HTTP_HOST'] == "pavittameethal.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                  // $this->load->view('admin/billing/n_dmprint',$data);
                
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
             }
        }

    else if($_SERVER['HTTP_HOST'] == "kattakampalbhagavathikshethram.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "thayamkulangara.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "arulipuram.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "pantheerankavuvishnu.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }


else if($_SERVER['HTTP_HOST'] == "idimuzhikkal.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "mithranandapuram.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "sreevalliyoorkavubhagavathi.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }

    else if($_SERVER['HTTP_HOST'] == "asokapuram.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "asokapuram.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
   
   
    else if($_SERVER['HTTP_HOST'] == "kizhekkavu.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "thaneerbhagavathi.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "karukaputhursrenarasimhamurthitemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "shirdi.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "parambilmahavishnutemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "puthiyakavubhagavathitemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receipt_print',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "kakkad.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "kaiparambu.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "vallikkadmahadevatemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "narakathshribhagawathi.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_narakath',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_narakath',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "sobhaparambubhagavathi.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "kovoor.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 1){
                    $this->load->view('admin/billing/koovoor_dmbill_print',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "kovoorvishnutemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 1){
                    $this->load->view('admin/billing/koovoor_dmbill_print',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "parakkunnathtemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_5',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 1){
                    $this->load->view('admin/billing/koovoor_dmbill_print',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "sankaramkulangara.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
          else if($_SERVER['HTTP_HOST'] == "sreemahadevamangalam.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     
    else if($_SERVER['HTTP_HOST'] == "sreethiruvangattemple.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print2/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
  else if($_SERVER['HTTP_HOST'] == "sreeramapuramvishnudevaswom.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
    else if($_SERVER['HTTP_HOST'] == "areekulangaradevitemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
    else if($_SERVER['HTTP_HOST'] == "areekulangaradevitemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
     else if($_SERVER['HTTP_HOST'] == "areekulangara.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
    

    
    
    // else if($_SERVER['HTTP_HOST'] == "kachamkurissi.in"){
     //	redirect('admin/billing/bill_print/'.$bill_id);
//              $counter = $this->session->userdata("counter");
//              if($counter == ''){
//                  $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint',$data);
//              }
        
//              else{
//              if($data['bill_dtls']['0']['type']=='S')
//              {redirect('admin/admin/sche_print/'.$bill_id);}else{
//                 $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
//                 $result = $till->row_array();
//                 $printer = $result['printer'];
//                 if($printer == 2){
//                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_kachamkurissi',$data);
//                 }
//                 else if($printer == 3){ 
//                    $this->load->view('admin/billing/receiptprint',$data);
//                 }
//                 else{
//                    $this->load->view('admin/billing/n_dmprint',$data);
//                 }}
//              }
       // }
       //
       // 
        
       
    
    else if($_SERVER['HTTP_HOST'] == "kachamkurissi.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
             // echo $printer;exit;
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_withoutheader',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "panniyankaradurgatemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_5',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_5',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
     else if($_SERVER['HTTP_HOST'] == "lucknow.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                // $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint_alathiyoor',$data);
             $this->load->view('admin/billing/bill_print_nhangattiri_5',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                  //  $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint_alathiyoor',$data);
               $this->load->view('admin/billing/bill_print_nhangattiri_5',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
    
     else if($_SERVER['HTTP_HOST'] == "alathiyoor.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
              $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint_alathiyoor',$data);
           //  $this->load->view('admin/billing/bill_print_nhangattiri_5',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint_alathiyoor',$data);
             //  $this->load->view('admin/billing/bill_print_nhangattiri_5',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint_alathiyoor',$data);
                }}
             }
        }
    else if($_SERVER['HTTP_HOST'] == "kanchepuram.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                // $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint_alathiyoor',$data);
             $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                  //  $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint_alathiyoor',$data);
               $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
     /**else if($_SERVER['HTTP_HOST'] == "lucknow.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_plainprint',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_plainprint',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }*/
    else if($_SERVER['HTTP_HOST'] == "sreeoottukulangarabhagavathidevaswom.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
     else if($_SERVER['HTTP_HOST'] == "cherursreenarasimhamoorthy.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
 
   else if($_SERVER['HTTP_HOST'] == "vaikathursreemahadevatemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
     else if($_SERVER['HTTP_HOST'] == "vaikathur.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
   
    else if($_SERVER['HTTP_HOST'] == "vadakkantharatemple.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_vadakkanthara',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print2/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_vadakkanthara',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
   else if($_SERVER['HTTP_HOST'] == "peringavu.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print2/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        } 
    
    else if($_SERVER['HTTP_HOST'] == "perumparambasiva.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print2/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
    
       else if($_SERVER['HTTP_HOST'] == "thrikaikat.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
             if($data['bill_dtls']['0']['type']=='S')
             {redirect('admin/admin/sche_print2/'.$bill_id);}else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }}
             }
        }
     else if($_SERVER['HTTP_HOST'] == "sreerayiramangalamsivaksethram.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "sreelakshminarasimhamoorthytemple.com/"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "trikkulamsivatemple.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "kallursreemahavishnu.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "nellikodesreevishnu.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "ponnanitrikkavubhagavathi.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 1){
                    $this->load->view('admin/billing/koovoor_dmbill_print',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "sreevayambattavishnutemple.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
              
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "kodikkunnubhagavathi.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
              
                }
             }
        }
    else if($_SERVER['HTTP_HOST'] == "sreeudayakurumbabhagavathikshethram.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
              
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "chenthalavishnutemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
              
                }
             }
        }else if($_SERVER['HTTP_HOST'] == "sreesivadurgadevitemple.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
              
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "vadakkemanaliyarkavu.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
              
                }
             }
        } else if($_SERVER['HTTP_HOST'] == "amruthamangalam.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
              
                }
             }
        } else if($_SERVER['HTTP_HOST'] == "pandamangalam.templesoftware.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/dmprint_pandamangalam',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/dmprint_pandamangalam',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/dmprint_pandamangalam',$data);
              
                }
             }
        } else if($_SERVER['HTTP_HOST'] == "perumparambasiva.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 1){
                    $this->load->view('admin/billing/koovoor_dmbill_print',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
             }
        } else if($_SERVER['HTTP_HOST'] == "nenmara.templesoftware.in"){
              $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_tali_nenmara',$data);
             }
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 3){ 
                    $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_tali_nenmara',$data);
                }
    		}
        }
    	else if($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org"){
//              $counter = $this->session->userdata("counter");
//              if($counter == ''){
//                  $this->load->view('admin/billing/bill_print_tali2',$data);
//              }
        
//              else{
//                 $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
//                 $result = $till->row_array();
//                 $printer = $result['printer'];
//                 if($printer == 1){
//                     $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//                 else if($printer == 3){ 
//                    $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//                 else{
//                    $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//              }
			$query = $this->db->query("SELECT `billing_dtls`.*, `stars`.`name_eng` as `star_eng`, `pooja`.`name_mal` as `pooja_nm`, `pooja`.`name` as name_eng,`billing_dtls`.`rate` as `pooja_rt`, `diety`.`name_mal` as `deity_nm` FROM `billing_dtls` JOIN `stars` ON `stars`.`id` = `billing_dtls`.`star` JOIN `pooja` ON `pooja`.`id` = `billing_dtls`.`pooja` JOIN `diety` ON `diety`.`id` = `billing_dtls`.`diety_id` WHERE `billing_dtls`.`bill_id` = '$bill_id'");
        	$details = $query->result_array();
        	
        	$detail_array = array();
        	foreach($details as $detail) {
            	 $pooja_id  = $detail['pooja'];
        		 $detail_array[$pooja_id][] = $detail;
            }
        
        	$data['bill_dtls'] = $detail_array;
       
			$this->load->view('admin/billing/bill_print_kalady',$data);
        }
    else if($_SERVER['HTTP_HOST'] == "sdasds.org"){
//              $counter = $this->session->userdata("counter");
//              if($counter == ''){
//                  $this->load->view('admin/billing/bill_print_tali2',$data);
//              }
        
//              else{
//                 $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
//                 $result = $till->row_array();
//                 $printer = $result['printer'];
//                 if($printer == 1){
//                     $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//                 else if($printer == 3){ 
//                    $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//                 else{
//                    $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//              }
			$query = $this->db->query("SELECT `billing_dtls`.*, `stars`.`name_eng` as `star_eng`, `pooja`.`name_mal` as `pooja_nm`, `pooja`.`name` as name_eng,`billing_dtls`.`rate` as `pooja_rt`, `diety`.`name_mal` as `deity_nm` FROM `billing_dtls` JOIN `stars` ON `stars`.`id` = `billing_dtls`.`star` JOIN `pooja` ON `pooja`.`id` = `billing_dtls`.`pooja` JOIN `diety` ON `diety`.`id` = `billing_dtls`.`diety_id` WHERE `billing_dtls`.`bill_id` = '$bill_id'");
        	$details = $query->result_array();
        	
        	$detail_array = array();
        	foreach($details as $detail) {
            	 $pooja_id  = $detail['pooja'];
        		 $detail_array[$pooja_id][] = $detail;
            }
        
        	$data['bill_dtls'] = $detail_array;
       
			$this->load->view('admin/billing/bill_print_kalady_sds',$data);
        }
    else if($_SERVER['HTTP_HOST'] == "ayyappadevalayamtaramattipeta.com"||$_SERVER['HTTP_HOST'] == "ayb.kaladyshankaramadomts.org"){
//              $counter = $this->session->userdata("counter");
//              if($counter == ''){
//                  $this->load->view('admin/billing/bill_print_tali2',$data);
//              }
        
//              else{
//                 $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
//                 $result = $till->row_array();
//                 $printer = $result['printer'];
//                 if($printer == 1){
//                     $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//                 else if($printer == 3){ 
//                    $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//                 else{
//                    $this->load->view('admin/billing/bill_print_tali2',$data);
//                 }
//              }
         if($_SERVER['HTTP_HOST'] == "ayb.kaladyshankaramadomts.org"){
         	$data['url'] = "/assets/images/kalady/ayb_letter_head.jpg";
         }else{
         	$data['url'] = "/assets/images/ayyappa/letter_head_ayyappa.jpg";
         }
			$query = $this->db->query("SELECT `billing_dtls`.*, `stars`.`name_eng` as `star_eng`, `pooja`.`name_mal` as `pooja_nm`, `pooja`.`name` as name_eng,`billing_dtls`.`rate` as `pooja_rt`, `diety`.`name_mal` as `deity_nm` FROM `billing_dtls` JOIN `stars` ON `stars`.`id` = `billing_dtls`.`star` JOIN `pooja` ON `pooja`.`id` = `billing_dtls`.`pooja` JOIN `diety` ON `diety`.`id` = `billing_dtls`.`diety_id` WHERE `billing_dtls`.`bill_id` = '$bill_id'");
        	$details = $query->result_array();
        	
        	$detail_array = array();
        	foreach($details as $detail) {
            	 $pooja_id  = $detail['pooja'];
        		 $detail_array[$pooja_id][] = $detail;
            }
        
        	$data['bill_dtls'] = $detail_array;
       
			$this->load->view('admin/billing/bill_print_taramattipeta',$data);
        }
        else{
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_tali',$data);
             }
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 3){ 
                    $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_tali',$data);
                }
    }}
    	$this->session->unset_userdata('adj_ids');
    }
    public function dmbill_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
    	$data['adjustment'] = [];
    
    	if($this->db->field_exists('bill_id', 'adjustment')) {
    	$this->db->select('id');
    	$this->db->from('adjustment');
    	$this->db->where('bill_id', $id);
    	$query = $this->db->get();
    	//ends here
    	$data['adjustment'] = [];
    	if ($this->session->userdata('adj_ids')) {
        	$ids = $this->session->userdata('adj_ids');
        	foreach($ids as $adjustment_id) {
            	$data['adjustment'][] = $this->general_model->getadjustmentById($adjustment_id)[0];
            }
        } else if($query->num_rows() > 0) {
        	$ids = $query->result();
        
        	foreach($ids as $adjustment_id) {
            	$aid = $adjustment_id->id;
            	$data['adjustment'][] = $this->general_model->getadjustmentById($aid)[0];
            }
        }
        }
         if ($_SERVER['HTTP_HOST'] == "sreevyramahakalikavukshethramkarad.in") {
            $this->load->view('admin/billing/vayira_dmbill_print',$data);
         } else if ($_SERVER['HTTP_HOST'] == "amruthamangalam.templesoftware.in") {
            $this->load->view('admin/billing/dmprint_amruthamangalam',$data);
         }
    	 else if ($_SERVER['HTTP_HOST'] == "alathiyoor.templesoftware.in") {
            $this->load->view('admin/billing/bill_print_nhangattiri_date_split_pooja_cat_preprint_alathiyoor',$data);
         }else{
             $this->load->view('admin/billing/dmprint',$data);
         }
    }
    public function receipt_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
    	$data['bill_details']=$this->general_model->getBillById($id);
      if ($_SERVER['HTTP_HOST'] == "komangalamsivatemple.templesoftware.in") {
             $this->load->view('admin/billing/receiptprint_komangalam',$data);
         }
    
    else if($_SERVER['HTTP_HOST'] == "puthiyakavubhagavathitemple.com") 
    {    
   $this->load->view('admin/billing/receipt_print',$data);
    }else{ 
     $this->load->view('admin/billing/receiptprint',$data); 
    }
    }
public function receipt_print_english($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
    	$data['bill_details']=$this->general_model->getBillById($id);
        $this->load->view('admin/billing/receipt_print',$data);
    }
               
    
    public function delete_bill($id){
        $reason=$this->input->post('reason');
        $logged=$this->loggedIn['id'];
        $today=date('Y-m-d');
        $this->db->query("UPDATE billing SET deleted='1',dl_date='$today',dl_reason='$reason',dl_user='$logged=' WHERE id='$id'");
        // echo $id;exit;
        $msg="Deleted";
        redirect('admin/admin/billing_view');
    }
    
    public function daily_summary(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/daily_summary');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $date=$this->input->post('date');
            $dateto=$this->input->post('dateto');
            $data['bill_list']=$this->general_model->getdaily_summary($date,$dateto);
            $data['date']=$date;
            $data['dateto']=$dateto;
            $data['temple_list']=$this->general_model->gettemples();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/daily_summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    
    //Donation
    
    public function donation(){
       $this->form_validation->set_rules('costname', 'costname', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $a=$this->db->query("SELECT id From diety WHERE name='DONATION'");
        $diety=$a->row_array();
        $diety_id=$diety['id'];
        if ($this->form_validation->run() == FALSE){
            $data['pooja_list']=$this->general_model->getpoojasbydiety($diety_id);
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/donation',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $logged=$this->loggedIn['id'];
            $last=$this->general_model->getlastdonid();
            $last_id1=$last['id'];
            $last_id=$last_id1+1;
            $a4=$this->db->query("SELECT * From annotation WHERE name='GOLD'");
            $gold_=$a4->row_array();
            $gold_an=$gold_['lst_id']+1;
            $a5=$this->db->query("SELECT * From annotation WHERE name='SILVER'");
            $silver_=$a5->row_array();
            $silver_an=$silver_['lst_id']+1;
            $a6=$this->db->query("SELECT * From annotation WHERE name='OTHER'");
            $other_=$a6->row_array();
            $other_an=$other_['lst_id']+1;
        
        // added by priyesh for bronz 
         $a7=$this->db->query("SELECT * From annotation WHERE name='BRONZE'");
            $bronze_=$a7->row_array();
            $bronze_an=$bronze_['lst_id']+1;
            $date=$this->input->post('date');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $unit=$this->input->post('unit');
            $weight=$this->input->post('weight');
            $amt=$this->input->post('amt');
            $remark=$this->input->post('remark');
            $date1=$this->input->post('date1');
            $category=$this->input->post('category');
            $costname=$this->input->post('costname');
            $house=$this->input->post('house');
            $street=$this->input->post('street');
            $post=$this->input->post('post');
            $district=$this->input->post('district');
            $state=$this->input->post('state');
            $pincode=$this->input->post('pincode');
            $mobile=$this->input->post('mobile');
            $email=$this->input->post('email');
            $refno=$this->session->refno;
            $query = $this->db->query("SELECT * FROM user_dtl WHERE name='$costname' AND mobile='$mobile' AND status='1'");
            $cost=$query->num_rows();
            if($costname!="")
            {
            if($cost==0){
                    $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$costname','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                    $user_id=$this->db->insert_id();
                }else{
                    $this->db->query("UPDATE user_dtl SET name='$costname',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',mobile='$mobile',email='$email' WHERE customer_id='$refno'");
                    $user=$query->row_array();
                    $user_id=$user['id'];
                }
            }
            $i=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $cata=$category[$i];
                $qult=$qlt[$i];
                $unet=$unit[$i];
                $wigt=$weight[$i];
                $amot=$amt[$i];
                $rmrk=$remark[$i];
                if ($cata=="1"){
                    $annotation=$gold_an;
                    $this->db->query("UPDATE annotation SET lst_id='$annotation' WHERE name='GOLD'");
                }elseif ($cata=="2"){
                    $annotation=$silver_an;
                    $this->db->query("UPDATE annotation SET lst_id='$annotation' WHERE name='SILVER'");
                }elseif ($cata=="4"){
                    $annotation=$bronze_an;
                    $this->db->query("UPDATE annotation SET lst_id='$annotation' WHERE name='BRONZE'");
                }
         
            else{
                    $annotation=$other_an;
                    $this->db->query("UPDATE annotation SET lst_id='$annotation' WHERE name='OTHER'");
                }
                $this->db->query("INSERT INTO donation(`bill_id`,`customer_id`,`name`,`diety_id`,`star`,`pooja`,`category`,`qlt`,`unit`,`weight`,`amount`,`remark`,`annotation`,`user_id`,`date`,`created`,`status`) VALUES ('$last_id','$user_id','$nama','$diety_id','$ster','$poja','$cata','$qult','$unet','$wigt','$amot','$rmrk','$annotation',
                '$logged','$date1','$date', '1')");
          
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('admin/admin/donation_view');
            }elseif($this->input->post('save')=="print"){
                redirect('admin/admin/donation_print/'.$last_id);
            }
        }
    }

/**public function donation(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('costname', 'costname', 'required');
        // $this->form_validation->set_rules('house', 'house', 'required');
        // $this->form_validation->set_rules('street', 'street', 'required');
        // $this->form_validation->set_rules('post', 'post', 'required');
        // $this->form_validation->set_rules('district', 'district', 'required');
        // $this->form_validation->set_rules('state', 'state', 'required');
        // $this->form_validation->set_rules('email', 'email', 'required');
        // $this->form_validation->set_rules('pincode', 'pincode', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $a=$this->db->query("SELECT id From diety WHERE name='DONATION'");
        $diety_id=$a->row_array();
        if ($this->form_validation->run() === FALSE){
            $data['pooja_list']=$this->general_model->getpoojasbydiety($diety_id['id']);
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/donation',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $last=$this->general_model->getlastdonid();
            $last_id1=$last['id'];
            $last_id=$last_id1+1;
            $diety=$diety_id['id'];
            $date=$this->input->post('date');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $unit=$this->input->post('unit');
            $amt=$this->input->post('amt');
            $remark=$this->input->post('remark');
            $date1=$this->input->post('date1');
            $costname=$this->input->post('costname');
            $house=$this->input->post('house');
            $street=$this->input->post('street');
            $post=$this->input->post('post');
            $district=$this->input->post('district');
            $state=$this->input->post('state');
            $pincode=$this->input->post('pincode');
            $mobile=$this->input->post('mobile');
            $email=$this->input->post('email');
            $query = $this->db->query("SELECT * FROM user_dtl WHERE name='$costname' AND mobile='$mobile' AND status='1'");
            $cost=$query->num_rows();
            if($cost==0){
                $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$costname','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                $user_id=$this->db->insert_id();
            }else{
                $this->db->query("UPDATE user_dtl SET name='$costname',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',mobile='$mobile',email='$email' WHERE customer_id='$refno'");
                $user=$query->row_array();
                $user_id=$user['id'];
            }
            $i=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $data=$date1[$i];
                $unet=$unit[$i];
                $amot=$amt[$i];
                $rmrk=$remark[$i];
                $this->db->query("INSERT INTO donation(`bill_id`,`customer_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`unit`,`amount`,`remark`,`date`,`created`,`status`) VALUES ('$last_id','$user_id','$nama','$diety','$ster','$poja','$qult','$unet','$amot','$rmrk','$data','$date', '1')");
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('admin/admin/donation_view');
            }elseif($this->input->post('save')=="print"){
                redirect('admin/admin/donation_print/'.$last_id);
            }
        }
    }**/
    public function donation_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getdonationById($id);
        $data['bill_id']=$id;
        $this->load->view('admin/billing/donation_print',$data);
    }
    public function donation_view(){
        $data['bill_list']=$this->general_model->getdonations();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/billing/donation_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function deletedonation($id){
        $this->db->query("DELETE FROM donation WHERE bill_id='$id'");
        redirect('admin/admin/donation_view');
    }
    public function register($id){
        $this->form_validation->set_rules('datef', 'Date', 'required');
        $data['id']=$id;
        $type=$id;
        $data['type']=$type;
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/register',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['bill_list']=$this->general_model->getregister($id,$datef,$datet,$type); 
            // print_r($data['bill_list']);
            // exit;
            $data['datef']=$datef;
            $data['datet']=$datet;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/register',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/register_print',$data);
            }
        }
    }
    
    // Svhedule Billing 

    /** public function schedule(){
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        if ($this->form_validation->run() === FALSE){
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['star_list']=$this->general_model->getstars();
            $data['temple_list']=$this->general_model->gettemples();
            $data['other_list']=$this->general_model->getothers();
            $query = $this->db->query("select * from site_settings where id =1"); 
            $row = $query->row();
            $this->load->view('admin/layouts/admin_header');
         if($row->code_settings=='0'){ $this->load->view('admin/billing/schedule_billing1',$data);}else{
            $this->load->view('admin/billing/schedule_billing',$data);}
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $name      = $this->input->post('name');
            $house     = $this->input->post('house_name');
            $street    = $this->input->post('street');
            $post      = $this->input->post('post');
            $district  = $this->input->post('district');
            $state     = $this->input->post('state');
            $pincode   = $this->input->post('pincode');
            $mobile    = $this->input->post('mobile');
            $email     = $this->input->post('email');
            $refno=$this->session->refno;
            $query = $this->db->query("SELECT * FROM user_dtl WHERE name='$name' AND mobile='$mobile' AND status='1'");
            $res_count=$query->num_rows();
            if($res_count==0){
                    $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                    $user_id=$this->db->insert_id();
            }else{
                    $this->db->query("UPDATE user_dtl SET name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',email='$email' WHERE mobile='$mobile'");
                    $user=$query->row_array();
                    $user_id=$user['id'];
            }
            $logged=$this->loggedIn['id'];
            $date=$this->input->post('datee');
            $mode=$this->input->post('mode');
            $number=$this->input->post('number');
            $mode_date=$this->input->post('mode_date');
            $bill_amount = $this->input->post('bill_amount');
            $ben_name=$this->input->post('ben_name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $time=$this->input->post('time');
            $main_date = $this->input->post('main_date');
            $dates = $this->input->post('dates');
            $prasadam_yesno= $this->input->post('prasadam');   
            $parcel_amt = $this->input->post('parcel_amt');
            $recv_amt = $this->input->post('amount_received');
            $bal_amt = $this->input->post('balance');
            $action = $this->input->post('save');
            $count = count($dates);
            $counter = $this->session->userdata("counter");
         $bill_time=date("Y-m-d H:i:s"); 
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`mode`,`number`,`mode_date`,`user_id`,`status`,`recv_amt`,`bal_amt`,`counter`,`bill_time`) 
                                          VALUES ('$diety_id','$date','','$parcel_amt','$user_id','$count','$bill_amount','$mode','$number','$mode_date', '$logged', '1','$recv_amt','$bal_amt','$counter','$bill_time')");
            $bill_id=$this->db->insert_id();
            if(!empty($dates)){
                $i=0;
                while ($i<sizeof($dates)){
                    $data=$dates[$i];
                    $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_yes`,`postal_amt`) 
                             VALUES ('$bill_id','$ben_name','$diety_id','$star_id','$pooja_id','$qlt','$time','$rate','$amt','$data', '1','S','$prasadam_yesno','$parcel_amt')");
                    if ($pooja_id=="15"){
                         $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                    }
                    $i++;
                }
            }else{
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_yes`,`postal_amt`) 
                             VALUES ('$bill_id','$ben_name','$diety_id','$star_id','$pooja_id','$qlt','$time','$rate','$amt','$main_date', '1','S','$prasadam_yesno','$parcel_amt')");
            }
            if($action == 'save'){
                 redirect('admin/admin/schedule');
            }
            else{
                redirect('admin/admin/sche_print/'.$bill_id);
            }
        }
        
    }
**/
/** 29/08/2022
 public function schedule(){
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        if ($this->form_validation->run() === FALSE){
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['star_list']=$this->general_model->getstars();
            $data['site']=$this->general_model->getsite();
            $data['other_list']=$this->general_model->getothers();
            $query = $this->db->query("select * from site_settings where id =1"); 
            $row = $query->row();
            $this->load->view('admin/layouts/admin_header');
         if($row->code_settings=='0'){ $this->load->view('admin/billing/schedule_billing1',$data);}else{
            $this->load->view('admin/billing/schedule_billing',$data);}
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $name      = $this->input->post('name');
            $house     = $this->input->post('house_name');
            $street    = $this->input->post('street');
            $post      = $this->input->post('post');
            $district  = $this->input->post('district');
            $state     = $this->input->post('state');
            $pincode   = $this->input->post('pincode');
            $mobile    = $this->input->post('mobile');
            $email     = $this->input->post('email');
            $refno=$this->session->refno;
            $query = $this->db->query("SELECT * FROM user_dtl WHERE name='$name' AND mobile='$mobile' AND status='1'");
            $res_count=$query->num_rows();
            if($res_count==0){
                    $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                    $user_id=$this->db->insert_id();
            }else{
                    $this->db->query("UPDATE user_dtl SET name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',email='$email' WHERE mobile='$mobile'");
                    $user=$query->row_array();
                    $user_id=$user['id'];
            }
            $logged=$this->loggedIn['id'];
            $date=$this->input->post('datee');
            $mode=$this->input->post('mode');
            $number=$this->input->post('number');
            $mode_date=$this->input->post('mode_date');
            $bill_amount = $this->input->post('bill_amount');
            $ben_name=$this->input->post('ben_name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $time=$this->input->post('time');
            $main_date = $this->input->post('main_date');
            $dates = $this->input->post('dates');
            $prasadam_yesno= $this->input->post('prasadam');   
            $parcel_amt = $this->input->post('parcel_amt');
            $recv_amt = $this->input->post('amount_received');
            $bal_amt = $this->input->post('balance');
            $action = $this->input->post('save');
            $count = count($dates);
            $counter = $this->session->userdata("counter");
         $bill_time=date("Y-m-d H:i:s"); 
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`mode`,`number`,`mode_date`,`user_id`,`status`,`recv_amt`,`bal_amt`,`counter`,`bill_time`) 
                                          VALUES ('$diety_id','$date','','$parcel_amt','$user_id','$count','$bill_amount','$mode','$number','$mode_date', '$logged', '1','$recv_amt','$bal_amt','$counter','$bill_time')");
            $bill_id=$this->db->insert_id();
            if(!empty($dates)){
                $i=0;
                while ($i<sizeof($dates)){
                    $data=$dates[$i];
                    $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_yes`,`postal_amt`) 
                             VALUES ('$bill_id','$ben_name','$diety_id','$star_id','$pooja_id','$qlt','$time','$rate','$amt','$data', '1','S','$prasadam_yesno','$parcel_amt')");
                    if ($pooja_id=="2000"){
                         $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                    }
                    $i++;
                }
            }else{
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_yes`,`postal_amt`) 
                             VALUES ('$bill_id','$ben_name','$diety_id','$star_id','$pooja_id','$qlt','$time','$rate','$amt','$main_date', '1','S','$prasadam_yesno','$parcel_amt')");
            }
            if($action == 'save'){
                 redirect('admin/admin/schedule');
            }
            else{
                redirect('admin/admin/sche_print/'.$bill_id);
            }
        }
        
    }*/
    // End Shedule Billing
   
  /*  public function schedule(){
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        if ($this->form_validation->run() === FALSE){
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['star_list']=$this->general_model->getstars();
            $data['temple_list']=$this->general_model->gettemples();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/schedule',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $time=$this->input->post('time');
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
                    $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`time`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja_id','$amount','$time','$data', '1')");
                    $i++;
                }
            }else{
                $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`time`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja_id','$amount','$time','$main_date', '1')");
            }
            redirect('admin/admin/schedule');
        }
    }  
    */  

 public function schedule(){
 		$counter = $this->session->userdata("counter");  
        if($counter == ''){
            $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/billing/selectcounter',$data);
            $this->load->view('admin/layouts/admin_footer');
            return;
        }
 
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        if ($this->form_validation->run() === FALSE){
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['star_list']=$this->general_model->getstars();
            $data['site']=$this->general_model->getsite();
            $data['other_list']=$this->general_model->getothers();
            $query = $this->db->query("select * from site_settings where id =1"); 
            $row = $query->row();
            $this->load->view('admin/layouts/admin_header');
            if($row->code_settings=='0'){ 
                  $this->load->view('admin/billing/schedule_billing1',$data);
            } else if($row->code_settings=='2') { 
            	  $this->load->view('admin/billing/schedule_billing3',$data);
            }
            else if($row->code_settings=='4'){
                  $this->load->view('admin/billing/schedule_billing4',$data);
            }
          else if($row->code_settings=='3'){
                  $this->load->view('admin/billing/schedule_billing1',$data);
            }
            else{
                  $this->load->view('admin/billing/schedule_billing',$data);
            }
                  $this->load->view('admin/layouts/admin_footer');
        }else{
            $name      = $this->input->post('name');
            $house     = $this->input->post('house_name');
            $street    = $this->input->post('street');
            $post      = $this->input->post('post');
            $district  = $this->input->post('district');
            $state     = $this->input->post('state');
            $pincode   = $this->input->post('pincode');
            $mobile    = $this->input->post('mobile');
            $email     = $this->input->post('email');
            $bal_amt   = $this->input->post('balance');
        	
        	$this->db->trans_begin();
        
            $refno=$this->session->refno;
            $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile' AND status='1'");
            $res_count=$query->num_rows();
            if($res_count==0){
                $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                $user_id=$this->db->insert_id();

                if($bal_amt>0){
                    $this->db->select('*');
                    $this->db->from('ledger_group');
                    $this->db->where('group_name', 'Customer');
                    $query1 = $this->db->get();
                    if ($query1->num_rows() == 0) {
                        $date = date( 'Y-m-d H:i:s' );
                        $data1 = array(
                            'group_name'      =>"Customer",
                            'group_created'   =>$date,
                        );
                        $this->db->insert('ledger_group', $data1);
                        $g =$this->db->insert_id();
                    }else{
                        $user=$query1->row_array();
                        $g=$user['group_id'];
                    }
                    $this->db->query("INSERT INTO ledger(`name`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$name','$g','$bal_amt','$bal_amt','$currentDate')");
                    $led_id=$this->db->insert_id();
                    $this->db->query("UPDATE user_dtl SET led_id=$led_id WHERE id='$user_id'");
                }
            }
        	else{
                $this->db->query("UPDATE user_dtl SET name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',email='$email' WHERE mobile='$mobile'");
                $user=$query->row_array();
                $user_id=$user['id'];
            

                if($bal_amt>0){
                    $this->db->select('*');
                    $this->db->from('ledger_group');
                    $this->db->where('group_name', 'Customer');
                    $query1 = $this->db->get();
                    if ($query1->num_rows() == 0) {
                        $date = date( 'Y-m-d H:i:s' );
                        $data1 = array(
                            'group_name'      =>"Customer",
                            'group_created'   =>$date,
                        );
                        $this->db->insert('ledger_group', $data1);
                        $g =$this->db->insert_id();
                    }else{
                        $user=$query1->row_array();
                        $g=$user['group_id'];
                    }
                    $ledquery = $this->db->query("SELECT led_id FROM user_dtl WHERE `id`='$user_id'");
                    $led_id=$ledquery->result()[0]->led_id;

                    if($led_id==0){
                        $this->db->query("INSERT INTO ledger(`name`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$name','$g','$bal_amt','$bal_amt','$currentDate')");
                        $led_id=$this->db->insert_id();
                        $this->db->query("UPDATE user_dtl SET led_id=$led_id WHERE id='$user_id'");
                    }else{
                        // $led=$ledquery->row_array();
                        // $led_id=$led['id'];
                        $this->db->query("UPDATE ledger SET balance=balance+$bal_amt WHERE led_Id='$led_id'");
                    }
                }
            }
            $logged=$this->loggedIn['id'];
            $date=$this->input->post('datee');
            $mode=$this->input->post('mode');
            $number=$this->input->post('number');
            $mode_date=$this->input->post('mode_date');
            $bill_amount = $this->input->post('bill_amount');
            $ben_name=$this->input->post('ben_name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $time=$this->input->post('time');
            $main_date = $this->input->post('main_date');
            $dates = $this->input->post('dates');
            $prasadam_yesno= $this->input->post('prasadam');   
            $parcel_amt = $this->input->post('parcel_amt');
            $recv_amt = $this->input->post('amount_received');
            $action = $this->input->post('save');
            $count = count($dates);
            $counter = $this->session->userdata("counter");
            $bill_time=date("Y-m-d H:i:s"); 
        
        	$pooja = $this->general_model->getpoojasById($pooja_id);
        	
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`mode`,`number`,`mode_date`,`user_id`,`status`,`recv_amt`,`bal_amt`,`counter`,`bill_time`) 
                                          VALUES ('$diety_id','$date','','$parcel_amt','$user_id','$count','$bill_amount','$mode','$number','$mode_date', '$logged', '1','$recv_amt','$bal_amt','$counter','$bill_time')");
            $bill_id=$this->db->insert_id();
            if(!empty($dates)){
                $i=0;
                while ($i<sizeof($dates)){
                    $data=$dates[$i];
                    $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_yes`,`postal_amt`) 
                             VALUES ('$bill_id','$ben_name','$diety_id','$star_id','$pooja_id','$qlt','$time','$rate','$amt','$data', '1','S','$prasadam_yesno','$parcel_amt')");
                    
                	if ($pooja_id=="2000"){
                    	
                         $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                    }
                
                	$pooja_name = $pooja[0]['name'];
                    $pooja_date = date('d M Y', strtotime($data));
                    $message =urlencode("Your pooja $pooja_name will be done on $pooja_date For more details please contact 04832833030 Regards PUNYEM SREEVYRAMAHAKALIKAVU");
                    $send_date = date('Y-m-d', strtotime("-1 day", strtotime($data)));
                    
                    if ($send_date < date('Y-m-d')) {
                        $send_time = urlencode(date('Y-m-d')." 06:00pm");
                    } else {
                        $send_time = urlencode($send_date." 06:00pm");
                    }

                    $url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYEM&route=1&time=$send_time&number=$mobile&message=$message&templateid=1707165424023889241";

                	$site_settings = $this->Cms_model->getSitesettings();
                	
                	$sms_notification_status = $site_settings[0]->sms_notification;
                	if($sms_notification_status == 1) {
                    	$curl = curl_init($url);
                    	curl_setopt($curl, CURLOPT_URL, $url);
                    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    
                    	$resp = curl_exec($curl);
                    	curl_close($curl);
                    }
                
                    $i++;
                }
            }else{
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_yes`,`postal_amt`) 
                             VALUES ('$bill_id','$ben_name','$diety_id','$star_id','$pooja_id','$qlt','$time','$rate','$amt','$main_date', '1','S','$prasadam_yesno','$parcel_amt')");
            	if ($pooja_id=="2000"){
                    	
                         $this->db->query("UPDATE mookkolakkallu SET date='$main_date' WHERE id='1'");
                    }
            }
        
        	$this->db->trans_complete();
        
             if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
             }
             else{
                 $this->db->trans_commit();
             }
            // $sms_settings = $this->db->query("SELECT `status` FROM sms_settings WHERE setting_name='scheduled_pooja'")->num_rows();
            // if(isset($sms_settings)&&count($sms_settings)){
            //     $status=$sms_settings['status'];
            //     if ($status==1){
            //         $details = array();
            //         $details['pooja'] = $pooja_id;
            //         $details['name'] = $name;
            //         $details['mobile'] = $mobile;
            //         $details['count'] = $count;
            //         $details['amount'] = $bill_amount;
            //         $this->sent_sms_sche($details);
            //     }
            // }
            if($action == 'save'){
                 redirect('admin/admin/schedule');
            }
            else{
               // redirect('admin/admin/sche_print/'.$bill_id);
               if ($_SERVER['HTTP_HOST'] == "kachamkurissi.in") {
               		redirect('admin/admin/sche_print_kothamkurissi/'.$bill_id);
               } else {
               		redirect('admin/admin/sche_print2/'.$bill_id);
               }
            }
        }
        
    }
   /** public function multy_schedule(){
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
    
        if ($this->form_validation->run() === FALSE){
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['star_list']=$this->general_model->getstars();
            $data['temple_list']=$this->general_model->gettemples();
            $data['other_list']=$this->general_model->getothers();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/multy_
            ',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $time=$this->input->post('time');
            $main_date=$this->input->post('main_date');
            $dates=$this->input->post('dates');
            $refno=$this->session->refno;
            $a=0;
            while ($a<sizeof($pooja_id)){
                $pooja=$pooja_id[$a];
                $pooja_list=$this->site_model->getpoojasById($pooja);
                $amount=$pooja_list[0]['rate'];
                if(!empty($dates)&&$pooja!=0&&$pooja!=""){
                    $i=0;
                    while ($i<sizeof($dates)){
                        $data=$dates[$i];
                        $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`time`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja','$amount','$time','$data', '1')");
                        $i++;
                    }
                }else{
                    $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`time`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja','$amount','$time','$main_date', '1')");
                }
                $a++;
            }
            redirect('admin/admin/multy_schedule');
        }
    }
    
    public function review(){
        $this->form_validation->set_rules('total', 'total', 'required');
     $counter = $this->session->userdata("counter");  
        if ($this->form_validation->run() === FALSE){
            $refno=$this->session->refno;
            $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
            $data['temple_list']=$this->site_model->gettemples();
            $data['user_list']=$this->site_model->getuserbyrefno($refno);
            if(empty($data['bill_list'])){
                redirect('admin/admin/schedule');
            }
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/review',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            if ($this->input->post('submit')=='save'){
                $this->form_validation->set_rules('total', 'total', 'required');
                if ($this->form_validation->run() === FALSE){
                    $refno=$this->session->refno;
                    $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    $data['user_list']=$this->site_model->getuserbyrefno($refno);
                    if(empty($data['bill_list'])){
                        redirect('admin/admin/schedule');
                    }
                    $this->load->view('admin/layouts/admin_header');
                    $this->load->view('admin/billing/review',$data);
                    $this->load->view('admin/layouts/admin_footer');
                }else{
                    $logged=$this->loggedIn['id'];
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
                    $mode=$this->input->post('mode');
                    $number=$this->input->post('number');
                    $mode_date=$this->input->post('mode_date');
                    $this->db->query("UPDATE billing_online SET count='$count',total='$total' WHERE customer_id='$refno'");
                    $query = $this->db->query("SELECT * FROM user_dtl WHERE name='$name' AND mobile='$mobile' AND status='1'");
                    $cost=$query->num_rows();
                    if($cost==0){
                        $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                        $user_id=$this->db->insert_id();
                    }else{
                        $this->db->query("UPDATE user_dtl SET name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',mobile='$mobile',email='$email' WHERE customer_id='$refno'");
                        $user=$query->row_array();
                        $user_id=$user['id'];
                    }
                    $today=date('Y-m-d');
                    $orders=$this->site_model->getorderbyrefno($refno);
                    $deity=$orders[0]['diety_id'];
                    $count=$orders[0]['count'];
                    $total=$orders[0]['total'];
                 $bill_time=date("Y-m-d H:i:s"); 
                
                    $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`mode`,`number`,`mode_date`,`user_id`,`status`,`bill_time`,`recv_amt`,`bal_amt`,`counter`) VALUES ('$deity','$today','','','$user_id','$count','$total','$mode','$number','$mode_date', '$logged', 
                    '1','$bill_time','$total','0','$counter')");
                    $bill_id=$this->db->insert_id();
                    for($i=0;$i<count($orders);$i++){
                        $name=$orders[$i]['name'];
                        $dety=$orders[$i]['diety_id'];
                        $ster=$orders[$i]['star_id'];
                        $poja=$orders[$i]['pooja_id'];
                        $time=$orders[$i]['time'];
                        $rate=$orders[$i]['rate'];
                        $qult="1";
                        $data=$orders[$i]['date'];
                        $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','M','$rate','$rate','$data', '1','S')");
                        if ($poja=="2000"){
                            $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                        }
                    }
                    $query=$this->db->query("SELECT id FROM user_dtl WHERE customer_id='$refno'")->result_array();
                    $cust_id=$query[0]['id'];
                    $this->db->query("UPDATE billing SET customer_id='$cust_id' WHERE id='$bill_id'");
                    $this->db->query("DELETE FROM billing_online WHERE customer_id='$refno'");
                    redirect('admin/admin/sche_print/'.$bill_id);
                }
            }
        }
    }*/
   public function multy_schedule(){
   
   		$counter = $this->session->userdata("counter");  
        if($counter == ''){
            $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/billing/selectcounter',$data);
            $this->load->view('admin/layouts/admin_footer');
            return;
        }
   
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $refno=$this->session->refno;
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['star_list']=$this->general_model->getstars();
            $data['temple_list']=$this->general_model->gettemples();
            $data['other_list']=$this->general_model->getothers();
            $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
            $data['bill_lists']=$this->site_model->getbillsbyrefno2($refno);
            $data['ref']=$refno;
            


            // $data['bill_list']=$this->site_model->getbillsbyrefno($id);
            // if(empty($data['bill_list'])){
            //                 redirect('admin/admin/multy_schedule');
            //             }
            // $id=$this->loggedIn['id'];
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/multy_schedule',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $time=$this->input->post('time');
            $main_date=$this->input->post('main_date');
            $dates=$this->input->post('dates');
            $count=$this->input->post('count');
            $postel_charge=$this->input->post('total');
            // $prasad_amt=$this->input->post('rate');

            $refno=$this->session->refno;
          
            $a=0;
            while ($a<sizeof($pooja_id)){
                $pooja=$pooja_id[$a];
                $pooja_list=$this->site_model->getpoojasById($pooja);
                $rate=$pooja_list[0]['rate'];
                $postel=$pooja_list[0]['postel_charge'];
                $pcharge=$postel*$count;
                if(!empty($dates)&&$pooja!=0&&$pooja!=""){
                    $i=0;
                    while ($i<sizeof($dates)){
                        $data=$dates[$i];
                        $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`time`,`date`,`status`,`count`,`total`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja','$rate','$time','$data', '1','$count','$pcharge')");
                        // $this->db->query("UPDATE billing_online SET total='$pcharge' WHERE customer_id='$refno'");

                        $i++;
                    }
                }else{
                    $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`time`,`date`,`status`,`count`,`total`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja','$rate','$time','$main_date', '1','$count','$pcharge')");
                    // $this->db->query("UPDATE billing_online SET count='$count',total='$pcharge' WHERE customer_id='$refno'");

                }
                $a++;
            }
            redirect('admin/admin/multy_schedule');
        }
    }
    // public function review(){
    //     $this->form_validation->set_rules('total', 'total', 'required');
    //  $counter = $this->session->userdata("counter");  
    //     if ($this->form_validation->run() === FALSE){
    //         $refno=$this->session->refno;
    //         $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
    //         $data['temple_list']=$this->site_model->gettemples();
    //         $data['user_list']=$this->site_model->getuserbyrefno($refno);
    //         $data['mode']=$this->Accounts_model->getmode();

    //         if(empty($data['bill_list'])){
    //             redirect('admin/admin/schedule');
    //         }
    //         $this->load->view('admin/layouts/admin_header');
    //         $this->load->view('admin/billing/review',$data);
    //         $this->load->view('admin/layouts/admin_footer');
    //     }else{
    //         if ($this->input->post('submit')=='save'){
    //             $this->form_validation->set_rules('total', 'total', 'required');
    //             if ($this->form_validation->run() === FALSE){
    //                 $refno=$this->session->refno;
    //                 $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
    //                 $data['temple_list']=$this->site_model->gettemples();
    //                 $data['user_list']=$this->site_model->getuserbyrefno($refno);

    //                 if(empty($data['bill_list'])){
    //                     redirect('admin/admin/schedule');
    //                 }
    //                 $this->load->view('admin/layouts/admin_header');
    //                 $this->load->view('admin/billing/review',$data);
    //                 $this->load->view('admin/layouts/admin_footer');
    //             }else{
    //                 $logged=$this->loggedIn['id'];
    //                 $refno=$this->session->refno;
    //                 $name=$this->input->post('name');
    //                 $house=$this->input->post('house');
    //                 $street=$this->input->post('street');
    //                 $post=$this->input->post('post');
    //                 $district=$this->input->post('district');
    //                 $state=$this->input->post('state');
    //                 $pincode=$this->input->post('pincode');
    //                 $mobile=$this->input->post('mobile');
    //                 $email=$this->input->post('email');
    //                 $count=$this->input->post('count');
    //                 $total=$this->input->post('total');
    //                 $mode=$this->input->post('mode');
    //                 $number=$this->input->post('number');
    //                 $mode_date=$this->input->post('mode_date');
    //                 // $this->db->query("UPDATE billing_online SET count='$count',total='$total' WHERE customer_id='$refno'");
    //                 $query = $this->db->query("SELECT * FROM user_dtl WHERE name='$name' AND mobile='$mobile' AND status='1'");
    //                 $cost=$query->num_rows();
    //                 if($cost==0){
    //                     $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
    //                     $user_id=$this->db->insert_id();
    //                 }else{
    //                     $this->db->query("UPDATE user_dtl SET name='$name',house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',mobile='$mobile',email='$email' WHERE customer_id='$refno'");
    //                     $user=$query->row_array();
    //                     $user_id=$user['id'];
    //                 }
    //                 $today=date('Y-m-d');
    //                 $orders=$this->site_model->getorderbyrefno($refno); 
    //                 $deity=$orders[0]['diety_id'];
    //                 $count=$orders[0]['count'];
    //                 $rate=$orders[0]['rate'];
    //                 $total=$orders[0]['total'];


    //              $bill_time=date("Y-m-d H:i:s"); 
                
    //                 $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`mode`,`number`,`mode_date`,`user_id`,`status`,`bill_time`,`recv_amt`,`bal_amt`,`counter`) VALUES ('$deity','$today','','$rate  ','$user_id','$count','$rate','$mode','$number','$mode_date', '$logged', 
    //                 '1','$bill_time','$rate','$rate','$counter')");
    //                 $bill_id=$this->db->insert_id();
    //                 for($i=0;$i<count($orders);$i++){
    //                     $name=$orders[$i]['name'];
    //                     $dety=$orders[$i]['diety_id'];
    //                     $ster=$orders[$i]['star_id'];
    //                     $poja=$orders[$i]['pooja_id'];
    //                     $time=$orders[$i]['time'];
    //                     $total=$orders[$i]['total'];
    //                     $rate=$orders[$i]['rate'];
    //                     $qult="1";
    //                     $data=$orders[$i]['date'];
    //                     $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','M','$rate','$total','$data', '1','S')");
    //                     if ($poja=="2000"){
    //                         $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
    //                     }
    //                 }
    //                 $query=$this->db->query("SELECT id FROM user_dtl WHERE customer_id='$refno'")->result_array();
    //                 $cust_id=$query[0]['id'];
    //                 $this->db->query("UPDATE billing SET customer_id='$cust_id' WHERE id='$bill_id'");
    //                 $this->db->query("DELETE FROM billing_online WHERE customer_id='$refno'");
    //                 redirect('admin/admin/sche_print2/'.$bill_id);
    //             }
    //         }
    //     }
    // }


 public function review() {
        $this->form_validation->set_rules('total', 'total', 'required');
     	$counter = $this->session->userdata("counter"); 
 
        if ($this->form_validation->run() === FALSE){
            $refno=$this->session->refno;
            $data['bill_list']=$this->site_model->getbillsbyrefno1($refno);
            $data['temple_list']=$this->site_model->gettemples();
            $data['user_list']=$this->site_model->getuserbyrefno($refno);
            $data['mode']=$this->Accounts_model->getmode();
            $data['bill_list_rate']=$this->site_model->getbillsbyrefno($refno);
            $data['bill_list_r']=$this->site_model->getbillsbyrefno5($refno);

            if(empty($data['bill_list'])){
                redirect('admin/admin/multy_schedule');
            }
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/review',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            if ($this->input->post('submit')=='save'){
                $this->form_validation->set_rules('total', 'total', 'required');
                if ($this->form_validation->run() === FALSE){
                    $refno=$this->session->refno;
                    $data['bill_list']=$this->site_model->getbillsbyrefno($refno);
                    $data['temple_list']=$this->site_model->gettemples();
                    $data['user_list']=$this->site_model->getuserbyrefno($refno);
                    if(empty($data['bill_list'])){
                        redirect('admin/admin/multy_schedule');
                    }
                    $this->load->view('admin/layouts/admin_header');
                    $this->load->view('admin/billing/review',$data);
                    $this->load->view('admin/layouts/admin_footer');
                }else{
                    $logged=$this->loggedIn['id'];
               // print_r($_SESSION);exit;
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
                    $mode=$this->input->post('mode');
                    $number=$this->input->post('number');
                    $mode_date=$this->input->post('mode_date');
                	$countofpostal=$this->input->post('count');
                    $postalrate=$this->input->post('postel_rate');
                	$is_credit = $this->input->post('is_credit');
                	$bal_amt = $this->input->post('bal_amt');
                	$recv_amt = $this->input->post('recv_amt');

                	// $temple_list[0]['postel_charge']
                   $totalpostalrate=$countofpostal*$postalrate;
                    //
                                        
               //    $totalpostalrate= $this->input->post('prasadam_amt');
					$this->db->trans_begin();
                    $totaltobilling=$total+ $totalpostalrate;
                    $this->db->query("UPDATE billing_online SET count='$count' WHERE customer_id='$refno'");
                    // $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile' AND status='1'");
                    // $cost=$query->num_rows();
                    $query = $this->db->query("SELECT * FROM user_dtl WHERE mobile='$mobile' AND status='1'");
            $res_count=$query->num_rows();
            if($res_count==0){
                $this->db->query("INSERT INTO user_dtl(`customer_id`,`name`,`house`,`street`,`post`,`district`,`state`,`pincode`,`mobile`,`email`,`status`) VALUES ('$refno','$name','$house','$street','$post','$district','$state','$pincode','$mobile','$email', '1')");
                $user_id=$this->db->insert_id();
                if($bal_amt>0){
                    $this->db->select('*');
                    $this->db->from('ledger_group');
                    $this->db->where('group_name', 'Customer');
                    $query1 = $this->db->get();
                    if ($query1->num_rows() == 0) {
                        $date = date( 'Y-m-d H:i:s' );
                        $data1 = array(
                            'group_name'      =>"Customer",
                            'group_created'   =>$date,
                        );
                        $this->db->insert('ledger_group', $data1);
                        $g =$this->db->insert_id();
                    }else{
                        $user=$query1->row_array();
                        $g=$user['group_id'];
                    }
                    $this->db->query("INSERT INTO ledger(`name`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$name','$g','$bal_amt','$bal_amt','$currentDate')");
                    $led_id=$this->db->insert_id();
                    $this->db->query("UPDATE user_dtl SET led_id=$led_id WHERE id='$user_id'");
                }
            }
        	else{
                // $this->db->query("UPDATE user_dtl SET house='$house',street='$street',post='$post',district='$district',state='$state',pincode='$pincode',email='$email' WHERE mobile='$mobile'");
                $user=$query->row_array();
                $user_id=$user['id'];
                if($bal_amt>0){
                    $this->db->select('*');
                    $this->db->from('ledger_group');
                    $this->db->where('group_name', 'Customer');
                    $query1 = $this->db->get();
                    if ($query1->num_rows() == 0) {
                        $date = date( 'Y-m-d H:i:s' );
                        $data1 = array(
                            'group_name'      =>"Customer",
                            'group_created'   =>$date,
                        );
                        $this->db->insert('ledger_group', $data1);
                        $g =$this->db->insert_id();
                    }else{
                        $user=$query1->row_array();
                        $g=$user['group_id'];
                    }
                    $ledquery = $this->db->query("SELECT led_id FROM user_dtl WHERE `id`='$user_id'");
                    $led_id=$ledquery->result()[0]->led_id;

                    if($led_id==0){
                        $this->db->query("INSERT INTO ledger(`name`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$name','$g','$bal_amt','$bal_amt','$currentDate')");
                        $led_id=$this->db->insert_id();
                        $this->db->query("UPDATE user_dtl SET led_id=$led_id WHERE id='$user_id'");
                    }else{
                        // $led=$ledquery->row_array();
                        // $led_id=$led['id'];
                        $this->db->query("UPDATE ledger SET balance=balance+$bal_amt WHERE led_Id='$led_id'");
                    }
                }
            }
                    $today=date('Y-m-d');
                    $orders=$this->site_model->getorderbyrefno($refno);
                    $deity=$orders[0]['diety_id'];
                    $count=$orders[0]['count'];
                    //$pcharge=$orders[0]['total'];
                    // print_r($orders);exit;
					
                 	$bill_time=date("Y-m-d H:i:s"); 
                	if($is_credit == 'credit') {
                    	$this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`mode`,`number`,`mode_date`,`user_id`,`status`,`bill_time`,`recv_amt`,`bal_amt`,`counter`) VALUES ('$deity','$today','','','$user_id','$count','$totaltobilling','$mode','$number','$mode_date', '$logged', 
                    '1','$bill_time','$recv_amt','$bal_amt','$counter')");
                    } else {
                    	$this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`amount`,`customer_id`,`count`,`total`,`mode`,`number`,`mode_date`,`user_id`,`status`,`bill_time`,`recv_amt`,`bal_amt`,`counter`) VALUES ('$deity','$today','','','$user_id','$count','$totaltobilling','$mode','$number','$mode_date', '$logged', 
                    '1','$bill_time','$totaltobilling','0','$counter')");
                    }
                	
                    
                    $bill_id=$this->db->insert_id();
                $j=0;
                    for($i=0;$i<count($orders);$i++){
                    if($i<$countofpostal){$pcharge=$postalrate;} 
                    else{$pcharge=0;}
                        $name=$orders[$i]['name'];
                        $dety=$orders[$i]['diety_id'];
                        $ster=$orders[$i]['star_id'];
                        $poja=$orders[$i]['pooja_id'];
                        $time=$orders[$i]['time'];
                        $rate=$orders[$i]['rate'];  
                       
                        $qult = $orders[$i]['qty'];
                        $data=$orders[$i]['date'];
                     	$amount=$orders[$i]['rate']*$qult;
                    
                    	$postal = $this->input->post('checkbox')[$orders[$i]['id']] ?? 0;
                    
						$pooja_arr = $this->general_model->getpoojasById($poja);
                        $pooja_name = $pooja_arr[0]['name'];
                    
                        $message =urlencode("Your pooja $pooja_name will be done on $data For more details please contact 0000000000 Regards PUNYEM DIR");
                        $send_date = date('Y-m-d', strtotime("-1 day", strtotime($data)));
                        
                        if ($send_date < date('Y-m-d')) {
                            $send_time = urlencode(date('Y-m-d')." 06:00pm");
                        } else {
                            $send_time = urlencode($send_date." 06:00pm");
                        }
    
                        $url = "http://sms.text91msg.com/http-tokenkeyapi.php?authentic-key=3930424f555247454f4e3135361653977314&senderid=PUNYEM&route=1&time=$send_time&number=$mobile&message=$message&templateid=1707165424023889241";
                		
                    	$site_settings = $this->Cms_model->getSitesettings();
                	
                		$sms_notification_status = $site_settings[0]->sms_notification;
                		if($sms_notification_status == 1) {
                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_URL, $url);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        
                        $resp = curl_exec($curl);
                        curl_close($curl);
                        }
                    
                        if($postal != 0) {
                            $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_yes`,`postal_amt`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','M','$rate','$amount','$data', '1','S','1','$postalrate')");
                        } else {
                            $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_yes`,`postal_amt`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','M','$rate','$amount','$data', '1','S','0', '0')");
                        }
                        // $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`,`type`,`postal_amt`) VALUES ('$bill_id','$name','$dety','$ster','$poja','$qult','M','$rate','$amount','$data', '1','S','$pcharge')");
                        if ($poja=="2000"){
                            $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                        }
                    }
                    $query=$this->db->query("SELECT id FROM user_dtl WHERE mobile='$mobile'")->result_array();
                    $cust_id=$query[0]['id'];
                    // $this->db->query("UPDATE billing SET customer_id='$cust_id' WHERE id='$bill_id'");
                    $this->db->query("DELETE FROM billing_online WHERE customer_id='$refno'");
                
                	$this->db->trans_complete();
        
             		if ($this->db->trans_status() === FALSE) {
                 		$this->db->trans_rollback();
             		}
            		else{
                 		$this->db->trans_commit();
             		}
                	$this->session->unset_userdata('refno');
                
                	$counter = $this->session->userdata("counter");
               $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                 $result = $till->row_array();
                 $printer = $result['printer'];

                 if($printer == 1){ 
                     redirect('admin/admin/sche_print2_2/'.$bill_id);
                 }
                 else if($printer == 2){ 
                    redirect('admin/admin/sche_print2_2/'.$bill_id);
                 }
                 else if($printer == 3){ 
                     redirect('admin/admin/receipt_print_schedule/'.$bill_id);
                 }
                 else{
                     redirect('admin/admin/sche_print2_2/'.$bill_id);
                 }
                    
                }
            }
        }
    }

	public function search_devotee() {

	$this->db->select('*');
	$this->db->from('user_dtl');
	$this->db->like('mobile', $this->input->post('search'), 'after');
	$query = $this->db->get();

	$devotees = $query->result();
    $response = array();
	foreach ($devotees as $devotee) {
    $response[] = array(
        "value" => $devotee->name.' - '.$devotee->mobile,
        "label" => $devotee->name.' - '.$devotee->mobile,
        "id" => $devotee->id,
        "name" => $devotee->name,
        "house" => $devotee->house,
        "mobile" => $devotee->mobile ?? '',
        "email" => $devotee->email,
        "street" => $devotee->street,
        "post" => $devotee->post,
        "district" => $devotee->district,
        "state" => $devotee->state,
        "pincode" => $devotee->pincode,
    );
	}

    	echo json_encode($response);
    }

    public function sche_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
        $this->load->view('admin/billing/sche_print',$data);
    }
 	public function sche_print2($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;

        $this->load->view('admin/billing/sche_print2_2',$data);
    }

	public function sche_print_kothamkurissi($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;

        $this->load->view('admin/billing/sche_print_kothamkurissi',$data);
    }

	public function sche_print2_2($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;

        $this->load->view('admin/billing/sche_print2_2',$data);
    }

	public function receipt_print_schedule($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
		$data['bill_details']=$this->general_model->getScheduleBillById($id);
    
        $this->load->view('admin/billing/receipt_print_schedule',$data);
    }
  /**  public function bill_report(){
        $this->form_validation->set_rules('keyword', 'Date', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $bill=$this->input->post('diety');
            $type=$this->input->post('type');
            $data['date']=$keyword;
            $data['diety']=$bill;
            $data['type']=$type;
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $data['bill_list']=$this->general_model->getbillreport($keyword,$bill,$type);
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/report',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/report_print',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print',$data);
            }
        }
    }**/

public function bill_report(){
		ini_set('max_execution_time', 0);
        $this->form_validation->set_rules('keyword', 'Date', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
   
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $dateto=$this->input->post('dateto');
            $bill=$this->input->post('diety');
            $type=$this->input->post('type');
            $ampm=$this->input->post('ampm');
            $data['date']=$keyword;
            $data['dateto']=$dateto;
            $data['diety']=$bill;
            $data['ampm']=$ampm;
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $data['bill_list']=$this->general_model->getbillreport($keyword,$dateto,$bill,$type,$ampm);
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/report',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/report_print',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print',$data);
            }elseif($this->input->post('serch')=="deity_wise"){
            
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/report_print_deitywise',$data);
            }
        }
    }

public function bill_report_twodate(){
        $this->form_validation->set_rules('keyword', 'Date', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
   
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/report_datewise',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $bill=$this->input->post('diety');
            $type=$this->input->post('type');
            $ampm=$this->input->post('ampm');
            $data['date']=$keyword;
            $data['diety']=$bill;
            $data['ampm']=$ampm;
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $data['bill_list']=$this->general_model->getbillreport($keyword,$bill,$type,$ampm);
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/report_datewise',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/report_print',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print',$data);
            }
        }
    }
    public function schedule_billing_report($upto=null){
         $this->form_validation->set_rules('keyword', 'Date', 'required');
         if ($this->form_validation->run() === FALSE){
             
         	 $report = $this->general_model->getscheduledpoojas();
         	 $totalRows = count($report);
         	 $this->load->library('pagination');

			 $config['base_url']   = base_url().'/index.php/admin/admin/schedule_billing_report';
			 $config['total_rows'] = $totalRows;
			 $config['per_page']   = 10;
	
			 $this->pagination->initialize($config); 
         	
             $links   = $this->pagination->create_links();
         	 $summary = $this->general_model->getpaginatedscheduledpoojas(10, $upto);
         	 
         	 $data['scheduled_poojas'] = $summary;
         	 $data['links']			   = $links;
             $this->load->view('admin/layouts/admin_header');
             $this->load->view('admin/billing/schedule_billing_report',$data);
             $this->load->view('admin/layouts/admin_footer');
         }
         else{
             $keyword    = $this->input->post('keyword');
         	 $pooja_date = $this->input->post('pooja_date');
         	
         	 $report = $this->general_model->getscheduledpoojas($keyword, $pooja_date);
         	 $totalRows = count($report);
         	 $this->load->library('pagination');

			 $config['base_url']   = base_url().'/index.php/admin/admin/schedule_billing_report';
         	 $config['reuse_query_string'] = TRUE;
			 $config['total_rows'] = $totalRows;
			 $config['per_page']   = 10;
	
			 $this->pagination->initialize($config); 
         	
             $links   = $this->pagination->create_links();
         	 $summary = $this->general_model->getpaginatedscheduledpoojas(10, $upto, $keyword, $pooja_date);
         	 
         	 $data['scheduled_poojas'] = $summary;
         	 $data['links']			   = $links;
             $this->load->view('admin/layouts/admin_header');
             $this->load->view('admin/billing/schedule_billing_report',$data);
             $this->load->view('admin/layouts/admin_footer');
         }
    }
    public function schedule_billing_details($id){
        $data['bill']=$this->general_model->getscheduledbilluserdetails($id);
        $data['pooja']=$this->general_model->getscheduledbilldetails($id);
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/billing/schedule_billing_details',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function bill_summary($ids=null){
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            //$data['ampm']=$ampm;
            $data['bill_list']=$this->general_model->getbillsummury($from,$to,$diety,$type);
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
         	$ampm=$this->input->post('ampm');
            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
         	$data['ampm']=$ampm;
            $data['bill_list']=$this->general_model->getbillsummury($from,$to,$diety,$type,$ampm);
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $this->load->view('admin/billing/summary_print',$data);
            }
        }
    }

	public function daily_pooja_mode_wise_summary($ids=null){
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        $data['temple_list']=$this->general_model->gettemples();
    
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            //$data['ampm']=$ampm;
            $data['bill_list']=$this->general_model->get_pooja_mode_bill_summury($from,$to,$diety,$type);

            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/daily_pooja_mode_wise_summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
         	$ampm=$this->input->post('ampm');
            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
         	$data['ampm']=$ampm;
            $data['bill_list']=$this->general_model->get_pooja_mode_bill_summury($from,$to,$diety,$type,$ampm);

            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/daily_pooja_mode_wise_summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $this->load->view('admin/billing/summary_print',$data);
            }
        }
    }
    
    public function detail_summary($ids=null){
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getdetailsummury($from,$to,$diety,$type);
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/detail_summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getdetailsummury($from,$to,$diety,$type);
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/detail_summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/summary_print',$data);
            }
        }
    }
    
    /**public function detail_view($ids=null){
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getdetailview($from,$to,$diety,$type);
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/detail_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getdetailview($from,$to,$diety,$type);
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/detail_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
            //             elseif($this->input->post('serch')=="print"){
            //                 $data['temple_list']=$this->general_model->gettemples();
            //                 $this->load->view('admin/billing/summary_print',$data);
            //             }
        }
    }
    */

//  public function detail_view($ids=null){
//         $this->form_validation->set_rules('from', 'Date From', 'required');
//         $this->form_validation->set_rules('to', 'Date To', 'required');
//         $this->form_validation->set_rules('diety', 'Diety', 'required');
//         if ($this->form_validation->run() === FALSE){
//             $from=date('Y-m-d');
//             $to=date('Y-m-d');
//             $diety="0";
//             $type=$ids;
//             $data['type']=$type;
//             $data['from']=$from;
//             $data['to']=$to;
//             $data['diety']=$diety;
//             $data['bill_list']=$this->general_model->getBillList($from,$to,$diety,$type);
//             $data['diety_list']=$this->general_model->getdietys();
//             $this->load->view('admin/layouts/admin_header');
//             $this->load->view('admin/billing/detail_view',$data);
//             $this->load->view('admin/layouts/admin_footer');
//         }else{
//             $from=$this->input->post('from');
//             $to=$this->input->post('to');
//             $diety=$this->input->post('diety');
//             $type=$this->input->post('type');
//         $ampm=$this->input->post('ampm');
//             if($type==""){
//                 $type=null;
//             }
//             $data['type']=$type;
//             $data['from']=$from;
//             $data['to']=$to;
//             $data['diety']=$diety;
// //$data['ampm']=$ampm;
//             $data['bill_list']=$this->general_model->getBillList($from,$to,$diety,$type);
//             if($this->input->post('serch')=="serch"){
//                 $data['diety_list']=$this->general_model->getdietys();
//                 $this->load->view('admin/layouts/admin_header');
//                 $this->load->view('admin/billing/detail_view',$data);
//                 $this->load->view('admin/layouts/admin_footer');
//             }elseif($this->input->post('serch')=="print"){
//                 $data['temple_list']=$this->general_model->gettemples();
//                 $this->load->view('admin/billing/detail_view_print',$data);
//             }
//         }
//     }

/**
 * Category Wise
 **/
    public function detail_view($ids=null){
    	$settings = $this->db->get('site_settings')->row();
    	if($this->db->field_exists('categorized_daily_pooja_summary', 'site_settings') && $settings->categorized_daily_pooja_summary == 1) {
        	$view_page = 'admin/billing/detail_view_categorized';
        } else {
        	$view_page = 'admin/billing/detail_view';
        }
    
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
 
 		$data['pooja_cat'] = $this->general_model->getpoojacategories();
 		
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
        	
        	$data['diety_list']=$this->general_model->getdietys();    
        	if($this->db->field_exists('categorized_daily_pooja_summary', 'site_settings') && $settings->categorized_daily_pooja_summary == 1) {
            	$data['bill_list']=$this->general_model->getdetailview($from,$to,$diety,$type);        
            	$data['categories']=$this->general_model->get_poojas_by_category($from,$to,$diety,$type);
            } else {
            	$data['bill_list']=$this->general_model->getBillList($from,$to,$diety,$type);
            }
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view($view_page,$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
        
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
            if($type==""){
                $type=null;
            }
        	
        	
        
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
        
            $data['diety_list']=$this->general_model->getdietys();    
        	if($this->db->field_exists('categorized_daily_pooja_summary', 'site_settings') && $settings->categorized_daily_pooja_summary == 1) {
            	if($this->input->post('pooja_category_id'))
        		{
            		$cat = $this->input->post('pooja_category_id');
        			$data['category_id']=$cat;
            		$data['categories']=$this->general_model->get_poojas_by_category($from,$to,$diety,$type,$cat);
        		} else {
            		$data['categories']=$this->general_model->get_poojas_by_category($from,$to,$diety,$type);
            	}
            } else {
            	$data['bill_list']=$this->general_model->getBillList($from,$to,$diety,$type);
            }
      		
            
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view($view_page,$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/detail_view_print',$data);
            }
        }
    }

	public function counter_wise_category(){
    	$this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
    	if ($this->form_validation->run() === FALSE){
        	$this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/counter_wise_category');
            $this->load->view('admin/layouts/admin_footer');
        }else{
        	$from=$this->input->post('from');
            $to=$this->input->post('to');
            $cat=$this->input->post('cat');
            $data['from']=$from;
            $data['to']=$to;
            $data['cat']=$cat;
        	$counter_list = $this->general_model->getcounters();
        	$list = array();
        	foreach ($counter_list as $counter){
            	$counter_array['counter'] = $counter['name'];
                $counter_array['poojas'] = $this->general_model->getpoojacountbycat($data, $counter['id']);
            	array_push($list,$counter_array);
            }
        	// print_r($list);exit;
        	$data['list'] = $list;
        	$data['temple_list']=$this->general_model->gettemples();
        	$this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/counter_wise_category',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

    public function getdatestar(){
        $from=$this->input->post('from');
        $to=$this->input->post('to');
        $noofdays=$this->input->post('noofdays');
        $result=$this->general_model->getdatestar($from,$to,$noofdays);
        echo json_encode($result);
    }
    public function getweekstar(){
        $from=$this->input->post('from');
        $to=$this->input->post('to');
        $day=$this->input->post('day');
        $dayofweek =date($day); 
        $noofweeks=$this->input->post('noofweeks');
        $result=$this->general_model->getweekstar($from,$to,$day,$noofweeks);
        echo json_encode($result);
    }
    public function getmonthstar(){
        $from=$this->input->post('from');
        $to=$this->input->post('to');
        $star=$this->input->post('star');
        $no_months=$this->input->post('month');
        $result=$this->general_model->getmonthstar($from,$to,$star,$no_months);
        echo json_encode($result);
    }
    public function getother(){
        $from=$this->input->post('from');
        $to=$this->input->post('to');
        $other=$this->input->post('other');
        $result=$this->general_model->getother($from,$to,$other);
        echo json_encode($result);
    }
    function getpoojasbydiety() {
        $diety = $this->input->post('diety'); 
        $data = array();
        $data = $this->general_model->getpoojasbydiety($diety);
        echo json_encode($data);
    }
    
    function getpoojarate() {
        $pooja = $this->input->get('pooja');
        $data = array();
        $data = $this->general_model->getpoojasById($pooja);
        echo json_encode($data);
    }
    
    function getmodeslno() {
        $mode = $this->input->get('mode');
        if($mode!=""){
            $query=$this->db->query("SELECT slno FROM `other_billing` WHERE mode='$mode' ORDER BY slno DESC LIMIT 1")->row_array();
            if(isset($query)){
                $slno=$query['slno'];
                if(isset($slno)&&$slno!=""){
                    $last=$slno+1;
                }else{
                    $last=1;
                }
            }else{
                $last=1;
            }
            $data = $last;
            echo json_encode($data);
        }
    }
    // List Category
    // Change Category Image
    public function change_category_image($id){
        $configImage['upload_path']          = './uploads/category';
        $configImage['allowed_types']        = 'gif|jpg|png|jpeg';
        // 		$configImage['max_width']            = 450;
        // 		$configImage['max_height']           = 170;
        $configImage['remove_spaces'] = TRUE;
        
        $this->load->library('upload', $configImage);
        $this->upload->initialize($configImage);
        if (!$this->upload->do_upload('image')){
            $imageError = array('error' => $this->upload->display_errors());
        }
        else{
            $imageData =  $this->upload->data();
            $photo = 'uploads/category/'.$imageData['file_name'];
            $upload_data = array('id' => $id, 'photo' => $photo);
            $this->category_model->updateCategoryImage($upload_data);
        }
        $msg="Category Updated";
        redirect('admin/admin/category_view/');
        
    }
    
    // Category Ends
    //Order
    
    public function order_view($id){
        $data['order_list']=$this->category_model->getOrders($id);
        $data['id']=$id;
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/order/order_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function view_order($id){
        $data['order_list']=$this->category_model->getOrderDetails($id);
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/order/view_order',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function order_search($id){
        $data['order_list']=$this->category_model->getOrderByKeyword($id);
        $data['id']=$id;
        $data['search']=$this->input->post('search');
        $data['date_from']=$this->input->post('date_from');
        $data['date_to']=$this->input->post('date_to');
        if($data['order_list']!=0){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/order/order_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all Orders');
            redirect('admin/admin/order_view');
        }
    }
    
    public function change_order_status(){
        $data = array(
            'id' => $this->input->post('id'),
            'order_status' =>$this->input->post('options'),
        );
        $this->category_model->changeOrderStatus($data);
        redirect('admin/admin/order_view/0');
    }
    
    //Order End
    
    // State
    
    public function state_view(){
        $data['state_list']=$this->category_model->getStates();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/state/state_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function add_state(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        
        if ($this->form_validation->run() === FALSE){
            
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/state/state_add');
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'name'        =>$this->input->post('name'),
                'status'      =>'1',
            );
            $id=$this->category_model->setState($data);
            $msg="State Saved";
            redirect('admin/admin/state_view');
        }
        
    }
    public function edit_state($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['state_list']=$this->category_model->getStatesById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/state/state_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'name'        =>$this->input->post('name'),
                'status'      =>$this->input->post('status'),
            );
            $id=$this->category_model->setState($data);
            $msg="State Updated";
            redirect('admin/admin/state_view');
        }
        
    }
    
    // District
    
    public function district_view(){
        $data['district_list']=$this->category_model->getDistricts();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/district/district_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function add_district(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['state_list']=$this->category_model->getStates();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/district/district_add',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'name'        =>$this->input->post('name'),
                'state_id'    =>$this->input->post('state'),
                'status'      =>'1',
            );
            $id=$this->category_model->setDistrict($data);
            $msg="District Saved";
            redirect('admin/admin/district_view');
        }
        
    }
    public function edit_district($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['state_list']=$this->category_model->getStates();
            $data['district_list']=$this->category_model->getDistrictById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/district/district_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'name'        =>$this->input->post('name'),
                'state_id'    =>$this->input->post('state'),
                'status'      =>$this->input->post('status'),
            );
            $id=$this->category_model->setDistrict($data);
            $msg="District Updated";
            redirect('admin/admin/district_view');
        }
        
    }
    
    //PinCode
    
    public function pincode_view(){
        $data['pincode_list']=$this->category_model->getpincodes();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/pincode/pincode_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function add_pincode(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('district', 'District', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['district_list']=$this->category_model->getDistricts();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pincode/pincode_add',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'name'        =>$this->input->post('name'),
                'district_id' =>$this->input->post('district'),
                'status'      =>'1',
            );
            $id=$this->category_model->setpincode($data);
            $msg="Pincode Saved";
            redirect('admin/admin/pincode_view');
        }
        
    }
    public function edit_pincode($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('district', 'District', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['district_list']=$this->category_model->getDistricts();
            $data['pincode_list']=$this->category_model->getpincodeById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pincode/pincode_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'name'        =>$this->input->post('name'),
                'district_id' =>$this->input->post('district'),
                'status'      =>$this->input->post('status'),
            );
            $id=$this->category_model->setpincode($data);
            $msg="Pincode Updated";
            redirect('admin/admin/pincode_view');
        }
        
    }
    // Color
    
    public function color_view(){
        $data['color_list']=$this->category_model->getColors();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/color/color_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function add_color(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('code', 'Code', 'required');
        
        if ($this->form_validation->run() === FALSE){
            
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/color/color_add');
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'name'        =>$this->input->post('name'),
                'code'        =>$this->input->post('code'),
            );
            $id=$this->category_model->setColor($data);
            $msg="Color Saved";
            redirect('admin/admin/color_view');
        }
        
    }
    public function edit_color($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('code', 'Code', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['state_list']=$this->category_model->getColorById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/color/color_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'name'        =>$this->input->post('name'),
                'code'      =>$this->input->post('code'),
            );
            $id=$this->category_model->setColor($data);
            $msg="Color Updated";
            redirect('admin/admin/color_view');
        }
        
    }
    
    
    
    // Brand Starts
    
    // Add Brand
    public function addNewBrand(){
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() === FALSE){
            
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/brand/brand_add');
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'name'        =>$this->input->post('name'),
                'status'      =>'1',
                'description' =>$this->input->post('description'),
            );
            
            $id=$this->category_model->setBrand($data);
            $configImage['upload_path']          = './uploads/brand';
            $configImage['allowed_types']        = 'gif|jpg|png|jpeg';
            $configImage['max_width']            = 450;
            $configImage['max_height']           = 170;
            $configImage['remove_spaces'] = TRUE;
            
            $this->load->library('upload', $configImage);
            $this->upload->initialize($configImage);
            if (!$this->upload->do_upload('icon')){
                $imageError = array('error' => $this->upload->display_errors());
            }
            else{
                $imageData =  $this->upload->data();
                $photo = 'uploads/brand/'.$imageData['file_name'];
                $upload_data = array('id' => $id, 'photo' => $photo);
                $this->category_model->updateBrandImage($upload_data);
            }
            $msg="Brand Added";
            redirect('admin/admin/brand_view');
        }
        
    }
    
    // List Brand
    public function brand_view(){
        $data['brand_list']=$this->category_model->getBrands();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/brand/brand_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    // Edit Brand
    public function edit_brand($id){
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['brand_list']=$this->category_model->getBrandsById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/brand/brand_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'name'        =>$this->input->post('name'),
                'status'      =>'1',
                'description' =>$this->input->post('description'),
            );
            $id=$this->category_model->setBrand($data);
            $msg="Brand Updated";
            redirect('admin/admin/brand_view');
        }
        
    }
    // Delete Brand
    public function delete_brand($id){
        $result=$this->category_model->deleteBrand($id);
        $msg="Brand Deleted";
        redirect('admin/admin/brand_view');
    }
    // Change Brand Image
    public function change_brand_image($id){
        $configImage['upload_path']          = './uploads/brand';
        $configImage['allowed_types']        = 'gif|jpg|png|jpeg';
        $configImage['remove_spaces'] = TRUE;
        
        $this->load->library('upload', $configImage);
        $this->upload->initialize($configImage);
        if (!$this->upload->do_upload('image')){
            $imageError = array('error' => $this->upload->display_errors());
        }
        else{
            $imageData =  $this->upload->data();
            $photo = 'uploads/brand/'.$imageData['file_name'];
            $upload_data = array('id' => $id, 'photo' => $photo);
            $this->category_model->updateBrandImage($upload_data);
        }
        $msg="Brand Updated";
        redirect('admin/admin/brand_view/');
        
    }
    // Brand Ends
    
    
    // Banner Starts
    
    // Add Banner
    public function addNewBanner(){
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('page', 'Page', 'required');
        
        if ($this->form_validation->run() === FALSE){
            
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/banner/banner_add');
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'name'        =>$this->input->post('name'),
                'page'        =>$this->input->post('page'),
            );
            
            $id=$this->category_model->setBanner($data);
            $configImage['upload_path']          = './uploads/banner';
            $configImage['allowed_types']        = 'gif|jpg|png|jpeg';
            $configImage['max_width']            = 1920;
            $configImage['max_height']           = 660;
            $configImage['remove_spaces'] = TRUE;
            
            $this->load->library('upload', $configImage);
            $this->upload->initialize($configImage);
            if (!$this->upload->do_upload('icon')){
                $imageError = array('error' => $this->upload->display_errors());
            }
            else{
                $imageData =  $this->upload->data();
                $photo = 'uploads/banner/'.$imageData['file_name'];
                $upload_data = array('id' => $id, 'image' => $photo);
                $this->category_model->updateBannerImage($upload_data);
            }
            $msg="Banner Added";
            redirect('admin/admin/banner_view');
        }
        
    }
    
    // List Banner
    public function banner_view(){
        $data['banner_list']=$this->category_model->getBanners();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/banner/banner_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    // Edit Banner
    public function edit_banner($id){
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['banner_list']=$this->category_model->getBannerById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/banner/banner_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'name'        =>$this->input->post('name'),
            );
            $id=$this->category_model->setBanner($data);
            $msg="Banner Updated";
            redirect('admin/admin/banner_view');
        }
        
    }
    // Delete Banner
    public function delete_banner($id){
        $result=$this->category_model->deleteBanner($id);
        $msg="Banner Deleted";
        redirect('admin/admin/banner_view');
    }
    // Change Banner Image
    public function change_banner_image($id){
        $configImage['upload_path']          = './uploads/banner';
        $configImage['allowed_types']        = 'gif|jpg|png|jpeg';
        $configImage['max_width']            = 1920;
        $configImage['max_height']           = 660;
        $configImage['remove_spaces'] = TRUE;
        
        $this->load->library('upload', $configImage);
        $this->upload->initialize($configImage);
        if (!$this->upload->do_upload('image')){
            $imageError = array('error' => $this->upload->display_errors());
        }
        else{
            $imageData =  $this->upload->data();
            $photo = 'uploads/banner/'.$imageData['file_name'];
            $upload_data = array('id' => $id, 'image' => $photo);
            $this->category_model->updateBannerImage($upload_data);
        }
        $msg="Banner Updated";
        redirect('admin/admin/banner_view/');
        
    }
    // Banner Ends
    
    
    
    //Products
    
    public function products_view(){
        $config = array();
        $config["base_url"] = base_url() . "index.php/admin/admin/products_view";
        $config["total_rows"] = $this->products_model->getProductsCount();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li  class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
        $config['prev_tag_close'] = '</li>';
        
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['category_list']=$this->category_model->getCategories();
        $data['product_list']=$this->products_model->getProducts($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/products/products_view',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function add_product(){
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('subcategory', 'Sub Category', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('code', 'Code', 'required|callback_unique_code');
        
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->category_model->getCategories();
            $data['unit_list']=$this->category_model->getUnits();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/products/products_add',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $photo='';
            $image_1='';
            $image_2='';
            $image_3='';
            $configImage['upload_path']          = './uploads/products';
            $configImage['allowed_types']        = 'gif|jpg|png';
            $configImage['max_size']             = 100;
            $configImage['max_width']            = 1024;
            $configImage['max_height']           = 768;
            $configImage['remove_spaces'] = TRUE;
            
            $this->load->library('upload', $configImage);
            $this->upload->initialize($configImage);
            if (!$this->upload->do_upload('image')){
                $imageError = array('error' => $this->upload->display_errors());
            }
            else{
                $imageData =  $this->upload->data();
                $photo = 'uploads/products/'.$imageData['file_name'];
            }
            if (!$this->upload->do_upload('image_1')){
                $imageError = array('error' => $this->upload->display_errors());
            }
            else{
                $image1Data =  $this->upload->data();
                $image_1 = 'uploads/products/'.$image1Data['file_name'];
            }
            if (!$this->upload->do_upload('image_2')){
                $imageError = array('error' => $this->upload->display_errors());
            }
            else{
                $image2Data =  $this->upload->data();
                $image_2 = 'uploads/products/'.$image2Data['file_name'];
            }
            if (!$this->upload->do_upload('image_3')){
                $imageError = array('error' => $this->upload->display_errors());
            }
            else{
                $image3Data =  $this->upload->data();
                $image_3 = 'uploads/products/'.$image3Data['file_name'];
            }
            $result=$this->products_model->setProduct($photo,$image_1,$image_2,$image_3);
            if($result === true){
                $msg="Product Saved";
                $this->session->set_flashdata('msg',$msg);
            }
            else{
                $msg="Failed To Add Product";
                $this->session->set_flashdata('msg',$msg);
            }
            redirect('admin/admin/products_view');
            
        }
    }
    public function getproductsByCategoryId(){
        $id=$this->input->post('id');
        $data = $this->category_model->getproductsByCategoryId($id);
        echo json_encode($data);
        
    }
    public function unique_code($str) {
        $code=$this->products_model->isCodeUnique($str);
        if ($code!=0) {
            $this->form_validation->set_message('unique_code', $str.' already exists! ');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    public function getSubcategoryByCategoryId(){
        $id=$this->input->post('id');
        $data = $this->category_model->getSubcategoryByCategoryId($id);
        echo json_encode($data);
    }
    public function edit_product($id){
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('subcategory', 'Sub Category', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->category_model->getCategories();
            $data['unit_list']=$this->category_model->getUnits();
            $data['product_list']=$this->products_model->getProductById($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/products/products_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            
            $id=$this->products_model->updateProduct();
            $msg="Product Updated";
            redirect('admin/admin/products_view');
            
        }
    }
    public function delete_product($id){
        $result=$this->products_model->deleteProduct($id);
        $msg="Deleted";
        redirect('admin/admin/products_view');
    }
    public function view_product($id){
        $data['product_list']=$this->products_model->getProductById($id);
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/products/view_products',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function change_product_image($id){
        $filePath=base_url().'/uploads/products/'.$id;
        delete_files($filePath);
        
        if (isset($_FILES["image"]) && !empty($_FILES['image']['name'])){
            $uploaddir = './uploads/products/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                $message="Error creating folder".$uploaddir;
            }
            else{
                $fileInfo = pathinfo($_FILES["image"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["image"]["tmp_name"], $uploaddir . $img_name);
                $upload_data = array('id' => $id, 'photo' => 'uploads/products/'.$img_name);
                $this->products_model->updateProductImage($upload_data);
                $msg="Product Saved";
                redirect('admin/admin/view_product/'.$id);
            }
        }
    }
    
    public function change_product_image1($id){
        $filePath=base_url().'/uploads/products/1'.$id;
        delete_files($filePath);
        
        if (isset($_FILES["image_1"]) && !empty($_FILES['image_1']['name'])){
            $uploaddir = './uploads/products/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                $message="Error creating folder".$uploaddir;
            }
            else{
                $fileInfo = pathinfo($_FILES["image_1"]["name"]);
                $img_name = '1'.$id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["image_1"]["tmp_name"], $uploaddir . $img_name);
                $upload_data = array('id' => $id, 'image_1' => 'uploads/products/'.$img_name);
                $this->products_model->updateProductImage($upload_data);
                $msg="Product Saved";
                redirect('admin/admin/view_product/'.$id);
            }
        }
    }
    public function change_product_image2($id){
        $filePath=base_url().'/uploads/products/2'.$id;
        delete_files($filePath);
        
        if (isset($_FILES["image_2"]) && !empty($_FILES['image_2']['name'])){
            $uploaddir = './uploads/products/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                $message="Error creating folder".$uploaddir;
            }
            else{
                $fileInfo = pathinfo($_FILES["image_2"]["name"]);
                $img_name = '2'.$id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["image_2"]["tmp_name"], $uploaddir . $img_name);
                $upload_data = array('id' => $id, 'image_2' => 'uploads/products/'.$img_name);
                $this->products_model->updateProductImage($upload_data);
                $msg="Product Saved";
                redirect('admin/admin/view_product/'.$id);
            }
        }
    }
    public function change_product_image3($id){
        $filePath=base_url().'/uploads/products/3'.$id;
        delete_files($filePath);
        
        if (isset($_FILES["image_3"]) && !empty($_FILES['image_3']['name'])){
            $uploaddir = './uploads/products/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                $message="Error creating folder".$uploaddir;
            }
            else{
                $fileInfo = pathinfo($_FILES["image_3"]["name"]);
                $img_name = '3'.$id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["image_3"]["tmp_name"], $uploaddir . $img_name);
                $upload_data = array('id' => $id, 'image_3' => 'uploads/products/'.$img_name);
                $this->products_model->updateProductImage($upload_data);
                $msg="Product Saved";
                redirect('admin/admin/view_product/'.$id);
            }
        }
    }
    public function change_product_status(){
        $data = array(
            'id' => $this->input->post('id'),
            'status' =>$this->input->post('status')
        );
        $this->products_model->changeProductStatus($data);
        return $msg="Status Changed";
        
    }
    public function product_search(){
        
        $config = array();
        $config["base_url"] = base_url() . "index.php/admin/admin/products_view";
        $config["total_rows"] = $this->products_model->getProductsCount();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['product_list']=$this->products_model->getProductByKeyword($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        if($data['product_list']!=0){
            $data['category_list']=$this->category_model->getCategories();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/products/products_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $this->session->set_flashdata('msg', 'No Data Found, Displaying all products');
            redirect('admin/admin/products_view');
        }
        
    }
    public function manageProduct(){
        $keyword=$this->input->post('search');
        $data['product_list']=$this->products_model->getAllProducts($keyword);
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/products/manage_product',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function deposite(){
        $this->form_validation->set_rules('ac_type', 'ac_type', 'required');
        $this->form_validation->set_rules('ac_no', 'ac_no', 'required');
        $this->form_validation->set_rules('ac_date', 'ac_no', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/deposite/add_deposite');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                
                'ac_type'       =>$this->input->post('ac_type'),
                'ac_no'         =>$this->input->post('ac_no'),
                'ac_date'       =>$this->input->post('ac_date'),
                'name'          =>$this->input->post('name'),
                'bank_nm'       =>$this->input->post('bank_nm'),
                'bank_address'  =>$this->input->post('bank_address'),
                'amount'        =>$this->input->post('amount'),
                'int_perc'      =>$this->input->post('int_perc'),
                'period'        =>$this->input->post('period'),
                'mat_date'      =>$this->input->post('mat_date'),
                'mat_amount'    =>$this->input->post('mat_amount'),
                'remark'        =>$this->input->post('remark'),
                'status'        =>1,
            );
            $id=$this->general_model->setdeposite($data);
            redirect('admin/admin/view_deposite');
        }
    }
    public function edit_deposite($id){
        $this->form_validation->set_rules('ac_type', 'ac_type', 'required');
        $this->form_validation->set_rules('ac_no', 'ac_no', 'required');
        $this->form_validation->set_rules('ac_date', 'ac_no', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['deposite']=$this->general_model->getdepositebyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/deposite/edit_deposite',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'            =>$id,
                'ac_type'       =>$this->input->post('ac_type'),
                'ac_no'         =>$this->input->post('ac_no'),
                'ac_date'       =>$this->input->post('ac_date'),
                'name'          =>$this->input->post('name'),
                'bank_nm'       =>$this->input->post('bank_nm'),
                'bank_address'  =>$this->input->post('bank_address'),
                'amount'        =>$this->input->post('amount'),
                'int_perc'      =>$this->input->post('int_perc'),
                'period'        =>$this->input->post('period'),
                'mat_date'      =>$this->input->post('mat_date'),
                'mat_amount'    =>$this->input->post('mat_amount'),
                'remark'        =>$this->input->post('remark'),
                'status'        =>$this->input->post('status'),
            );
            $id=$this->general_model->setdeposite($data);
            redirect('admin/admin/view_deposite');
        }
    }
    public function view_deposite(){
        $data['deposite']=$this->general_model->getdeposite();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/deposite/view_deposite',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function fd_report(){
        $this->form_validation->set_rules('datef', 'datef', 'required');
        $this->form_validation->set_rules('datet', 'datet', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['deposite']=$this->general_model->getdeposite();
            $data['temple_list']=$this->general_model->gettemples();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/deposite/fd_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $type=$this->input->post('type');
            $status=$this->input->post('status');
            $data['deposite']=$this->general_model->getdepositebydate($datef,$datet,$type,$status);
            $data['temple_list']=$this->general_model->gettemples();
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['type']=$type;
            $data['status']=$status;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/deposite/fd_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function mat_report(){
        $this->form_validation->set_rules('datef', 'datef', 'required');
        $this->form_validation->set_rules('datet', 'datet', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['deposite']=$this->general_model->getdeposite();
            $data['temple_list']=$this->general_model->gettemples();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/deposite/mat_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $type=$this->input->post('type');
            $status=$this->input->post('status');
            $data['deposite']=$this->general_model->getmatdepositebydate($datef,$datet,$type,$status);
            $data['temple_list']=$this->general_model->gettemples();
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['type']=$type;
            $data['status']=$status;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/deposite/mat_report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    
    //Ass Category
    
    public function ass_cat(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getass_cat();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/ass_cat/add_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
            );
            $id=$this->general_model->setass_cat($data);
            redirect('admin/admin/ass_cat');
        }
    }
    public function edit_ass_cat($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getass_cat();
            $data['category']=$this->general_model->getass_catbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/ass_cat/edit_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
            );
            $insert_id=$this->general_model->setass_cat($data);
            redirect('admin/admin/ass_cat');
        }
    }
    public function delete_ass_cat($id){
        $this->db->where('id', $id);
        $this->db->delete('ass_cat');
        redirect('admin/admin/ass_cat');
    }
    
    // Sub Catagory
    
    public function ass_subcat(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['sub_category_list']=$this->general_model->getass_subcat();
            $data['category_list']=$this->general_model->getass_cat();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/ass_subcat/add_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'cat_id'    =>$this->input->post('cat_id'),
                'name'      =>$this->input->post('name'),
            );
            $id=$this->general_model->setass_subcat($data);
            redirect('admin/admin/ass_subcat');
        }
    }
    public function edit_ass_subcat($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['sub_category_list']=$this->general_model->getass_subcat();
            $data['sub_category']=$this->general_model->getass_subcatbyid($id);
            $data['id']=$id;
            $data['category_list']=$this->general_model->getass_cat();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/ass_subcat/edit_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'cat_id'    =>$this->input->post('cat_id'),
                'name'      =>$this->input->post('name'),
            );
            $insert_id=$this->general_model->setass_subcat($data);
            redirect('admin/admin/ass_subcat');
        }
    }
    public function delete_ass_subcat($id){
        $this->db->where('id', $id);
        $this->db->delete('ass_subcat');
        redirect('admin/admin/ass_subcat');
    }
    public function getasssubcat(){
        $cat_id = $this->input->post('cat_id');
        $data = array();
        $data = $this->general_model->getasssubcat($cat_id);
        echo json_encode($data);
    }
    
    //Ass location
    
    public function ass_loc(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getass_loc();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/ass_loc/add_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
            );
            $id=$this->general_model->setass_loc($data);
            redirect('admin/admin/ass_loc');
        }
    }
    public function edit_ass_loc($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getass_loc();
            $data['category']=$this->general_model->getass_locbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/ass_loc/edit_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
            );
            $insert_id=$this->general_model->setass_loc($data);
            redirect('admin/admin/ass_loc');
        }
    }
    public function delete_ass_loc($id){
        $this->db->where('id', $id);
        $this->db->delete('ass_loc');
        redirect('admin/admin/ass_loc');
    }
    
    //asset
    
    public function add_asset(){
        $this->form_validation->set_rules('itemname', 'Name', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getass_cat();
            $data['location_list']=$this->general_model->getass_loc();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/asset/add_asset',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'location'    =>$this->input->post('location'),
                'docno'       =>$this->input->post('docno'),
                'date'        =>$this->input->post('date'),
                'itemcode'    =>$this->input->post('itemcode'),
                'itemname'    =>$this->input->post('itemname'),
                'ass_cat'     =>$this->input->post('ass_cat'),
                'ass_subcat'  =>$this->input->post('ass_subcat'),
                'p_from'      =>$this->input->post('p_from'),
                'bill_no'     =>$this->input->post('bill_no'),
                'bill_date'   =>$this->input->post('bill_date'),
                'period'      =>$this->input->post('period'),
                'details'     =>$this->input->post('details'),
                'qlt'         =>$this->input->post('qlt'),
                'unit'        =>$this->input->post('unit'),
                'weight'      =>$this->input->post('weight'),
                'rate'        =>$this->input->post('rate'),
                'price'       =>$this->input->post('price'),
                'remark'      =>$this->input->post('remark'),
            );
            $id=$this->general_model->setasset($data);
            redirect('admin/admin/view_asset');
        }
    }
    public function edit_asset($id){
        $this->form_validation->set_rules('itemname', 'Name', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getass_cat();
            $data['sub_category_list']=$this->general_model->getass_subcat();
            $data['asset']=$this->general_model->getassetsbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/asset/edit_asset',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'          =>$id,
                'location'    =>$this->input->post('location'),
                'docno'       =>$this->input->post('docno'),
                'date'        =>$this->input->post('date'),
                'itemcode'    =>$this->input->post('itemcode'),
                'itemname'    =>$this->input->post('itemname'),
                'ass_cat'     =>$this->input->post('ass_cat'),
                'ass_subcat'  =>$this->input->post('ass_subcat'),
                'p_from'      =>$this->input->post('p_from'),
                'bill_no'     =>$this->input->post('bill_no'),
                'bill_date'   =>$this->input->post('bill_date'),
                'period'      =>$this->input->post('period'),
                'details'     =>$this->input->post('details'),
                'qlt'         =>$this->input->post('qlt'),
                'unit'        =>$this->input->post('unit'),
                'weight'      =>$this->input->post('weight'),
                'rate'        =>$this->input->post('rate'),
                'price'       =>$this->input->post('price'),
                'remark'      =>$this->input->post('remark'),
            );
            $inid=$this->general_model->setasset($data);
            redirect('admin/admin/view_asset');
        }
    }
    public function view_asset(){
        $this->form_validation->set_rules('date', 'date', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['asset_list']=$this->general_model->getassets();
            $data['category_list']=$this->general_model->getass_cat();
            $data['location_list']=$this->general_model->getass_loc();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/asset/view_asset',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $location=$this->input->post('location');
            $ass_cat=$this->input->post('ass_cat');
            $data['category_list']=$this->general_model->getass_cat();
            $data['location_list']=$this->general_model->getass_loc();
            $data['asset_list']=$this->general_model->getassets($location,$ass_cat);
            $data['temple_list']=$this->general_model->gettemples();
            $data['location']=$location;
            $data['ass_cat']=$ass_cat;
            if ($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/asset/view_asset',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif ($this->input->post('serch')=="print"){
                $this->load->view('admin/asset/print_asset',$data);
            }
        }
    }
    public function delete_asset($id){
        $this->db->where('id', $id);
        $this->db->delete('asset_master');
        redirect('admin/admin/view_asset');
    }
    
    //Kooru Management
    
    //kooru_usr
    
    public function kooru_usr(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getkooru_usr();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/kooru_usr/add_user',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
            );
            $id=$this->general_model->setkooru_usr($data);
            redirect('admin/admin/kooru_usr');
        }
    }
    public function edit_kooru_usr($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getkooru_usr();
            $data['category']=$this->general_model->getkooru_usrbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/kooru_usr/edit_user',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
            );
            $insert_id=$this->general_model->setkooru_usr($data);
            redirect('admin/admin/kooru_usr');
        }
    }
    public function delete_kooru_usr($id){
        $this->db->where('id', $id);
        $this->db->delete('kooru_usr');
        redirect('admin/admin/kooru_usr');
    }
    
    public function kooru_mng(){
        $this->form_validation->set_rules('temple', 'User', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['user_list']=$this->general_model->getkooru_usr();
            $data['pooja_list']=$this->general_model->getpoojas();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/kooru_mng/kooru_mng',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $temple=$this->input->post('temple');
            $this->db->select('*');
            $this->db->from('kooru_mng');
            $this->db->where('user_id', $temple);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $this->db->where('user_id', $temple);
                $this->db->delete('kooru_mng');
            }
            $radio=$this->input->post('radio');
            $rates=$this->input->post('rate');
            $rate=array_values(array_filter($rates));
            // exit();
            foreach ($radio as $key=>$radios){
                $this->db->query("INSERT INTO kooru_mng(`user_id`,`pooja_id`,`rate`,`status`) VALUES ('$temple','$radios','$rate[$key]', '1')");
            }
            $msg="Pooja Saved";
            redirect('admin/admin/kooru_mng');
        }
    }
    public function view_kooru(){
        $id=$this->input->post('id');
        $result=$this->general_model->getkooruById($id);
        echo json_encode($result);
    }
    
    public function kooru_rpt($ids=null){
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
        
      $data['temple_list']=$this->general_model->gettemples();

            $data['bill_list']=$this->general_model->getbillsummuryforkoorubypooja($from,$to,$diety,$type);
            $data['diety_list']=$this->general_model->getdietys();
            $data['user_list']=$this->general_model->getkooru_usr();
        //print_r($data);exit;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/kooru_mng/summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
        
      $data['temple_list']=$this->general_model->gettemples();

            $data['bill_list']=$this->general_model->getbillsummuryforkoorubypooja($from,$to,$diety,$type);
            $data['user_list']=$this->general_model->getkooru_usr();
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/kooru_mng/summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/kooru_mng/summary_print',$data);
            }
        }
    }
    
    //Inv Category
    
    public function inv_cat(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getinv_cat();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/inv_cat/add_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
            );
            $id=$this->general_model->setinv_cat($data);
            redirect('admin/admin/inv_cat');
        }
    }
    public function edit_inv_cat($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getinv_cat();
            $data['category']=$this->general_model->getinv_catbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/inv_cat/edit_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
            );
            $insert_id=$this->general_model->setinv_cat($data);
            redirect('admin/admin/inv_cat');
        }
    }
    public function delete_inv_cat($id){
        $this->db->where('id', $id);
        $this->db->delete('inv_cat');
        redirect('admin/admin/inv_cat');
    }
    
    //Inv Unit
    
    public function inv_unit(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getinv_unit();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/inv_unit/add_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
            );
            $id=$this->general_model->setinv_unit($data);
            redirect('admin/admin/inv_unit');
        }
    }
    public function edit_inv_unit($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getinv_unit();
            $data['category']=$this->general_model->getinv_unitbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/inv_unit/edit_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
            );
            $insert_id=$this->general_model->setinv_unit($data);
            redirect('admin/admin/inv_unit');
        }
    }
    public function delete_inv_unit($id){
        $this->db->where('id', $id);
        $this->db->delete('inv_unit');
        redirect('admin/admin/inv_unit');
    }
    
    //Inv Product
    
    public function inv_product(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getinv_product();
            $data['unit_list']=$this->general_model->getinv_unit();
            $data['cat_list']=$this->general_model->getinv_cat();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/inv_product/add_product',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'code'      =>$this->input->post('code'),
                'name'      =>$this->input->post('name'),
                'name_mal'  =>$this->input->post('name_mal'),
                'unit'      =>$this->input->post('unit'),
                'cat_id'    =>$this->input->post('cat_id'),
                'price'     =>$this->input->post('price'),
            );
            $id=$this->general_model->setinv_product($data);
            redirect('admin/admin/inv_product');
        }
    }
    public function edit_inv_product($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getinv_product();
            $data['category']=$this->general_model->getinv_productbyid($id);
            $data['unit_list']=$this->general_model->getinv_unit();
            $data['cat_list']=$this->general_model->getinv_cat();
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/inv_product/edit_product',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'code'      =>$this->input->post('code'),
                'name'      =>$this->input->post('name'),
                'name_mal'  =>$this->input->post('name_mal'),
                'unit'      =>$this->input->post('unit'),
                'cat_id'    =>$this->input->post('cat_id'),
                'price'     =>$this->input->post('price'),
            );
            $insert_id=$this->general_model->setinv_product($data);
            redirect('admin/admin/inv_product');
        }
    }
    public function delete_inv_product($id){
        $this->db->where('id', $id);
        $this->db->delete('inv_product');
        redirect('admin/admin/inv_product');
    }
    
    //Inv Opening
    
    public function inv_opening(){
        $this->form_validation->set_rules('product_id', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getinv_opening();
            $query=$this->db->query("SELECT * FROM `inv_product` WHERE id NOT IN (SELECT product_id FROM inv_opening)")->result_array();
            $data['product_list']=$query;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/inv_opening/add_product',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $product_id=$this->input->post('product_id');
            $stock=$this->input->post('stock');
            $user=$this->loggedIn['id'];
            $product=$this->general_model->getinv_productbyid($product_id);
            $unit=$product['unit'];
            $data=array(
                'product_id' =>$product_id,
                'stock'      =>$stock,
                'status'     =>0,
            );
            $id=$this->general_model->setinv_opening($data);
            $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$product_id','$unit', '$stock', 'OS', '$user', '$id')");
            redirect('admin/admin/inv_opening');
        }
    }
    
    //supplier
    
    public function supplier(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getsupplier();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/supplier/add_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $currentDate = date( 'Y-m-d H:i:s' );
            $n=$this->input->post('name');
            $this->db->select('*');
            $this->db->from('ledger_group');
            $this->db->where('group_name', 'Supplier');
            $query1 = $this->db->get();
            if ($query1->num_rows() == 0) {
                $date = date( 'Y-m-d H:i:s' );
                $data1 = array(
                    'group_name'      =>"Supplier",
                    'group_created'   =>$date,
                );
                $this->db->insert('ledger_group', $data1);
                $g =$this->db->insert_id();
            }else{
                $user=$query1->row_array();
                $g=$user['group_id'];
            }
            //             print $g;
            //             exit;
            $o="0";
            $this->db->select('*');
            $this->db->from('ledger');
            $this->db->where('name', $n);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
                $this->db->query("INSERT INTO ledger(`name`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$n','$g','$o','$o','$currentDate')");
                $led_id =$this->db->insert_id();
            }else{
                $user1=$query->row_array();
                $led_id=$user1['led_Id'];
            }
            $data=array(
                'name'           =>$this->input->post('name'),
                'address'        =>$this->input->post('address'),
                'contact_no'     =>$this->input->post('contact_no'),
                'contact_person' =>$this->input->post('contact_person'),
                'sup_for'        =>$this->input->post('sup_for'),
                'led_id'         =>$led_id,
            );
            $id=$this->general_model->setsupplier($data);
            redirect('admin/admin/supplier');
        }
    }
    public function edit_supplier($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['category_list']=$this->general_model->getsupplier();
            $data['category']=$this->general_model->getsupplierbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/supplier/edit_catagory',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'             =>$id,
                'name'           =>$this->input->post('name'),
                'address'        =>$this->input->post('address'),
                'contact_no'     =>$this->input->post('contact_no'),
                'contact_person' =>$this->input->post('contact_person'),
                'sup_for'        =>$this->input->post('sup_for'),
            );
            $insert_id=$this->general_model->setsupplier($data);
            redirect('admin/admin/supplier');
        }
    }
    public function supplier_statement($id){
        $this->form_validation->set_rules('datef', 'Date From', 'required');
        $this->form_validation->set_rules('datet', 'Date To', 'required');
        $data['id']=$id;
        $data['supplier']=$this->general_model->getsupplier();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/supplier/supplier_statement',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['purchase_list']=$this->general_model->getpurchasebysup($id,$datef,$datet);
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['category']=$this->general_model->getsupplierbyid($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/supplier/supplier_statement',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function delete_supplier($id){
        $this->db->where('id', $id);
        $this->db->delete('supplier');
        redirect('admin/admin/supplier');
    }
    
    public function purchase(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('supplier_id', 'supplier', 'required');
        $this->form_validation->set_rules('invoice_no', 'Invoice No', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['supplier_list']=$this->general_model->getsupplier("1");
            $data['product_list']=$this->general_model->getinv_product();
            $data['unit_list']=$this->general_model->getinv_unit();
       
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/purchase',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $currentDate = date( 'Y-m-d H:i:s' );
            $user=$this->loggedIn['id'];
            $sup_id=$this->input->post('supplier_id');
            $date=$this->input->post('date');
            $mode=$this->input->post('mode');
            $inv_no=$this->input->post('invoice_no');
            $pro_id=$this->input->post('product_id');
            $unit=$this->input->post('unit');
            $qlt=$this->input->post('qty');
            $tax=$this->input->post('tax');
            $discount=$this->input->post('discount');
            $sub_tot=$this->input->post('sub_tot');
            $tot_tax=array_sum($tax);
            $sub_total=array_sum($sub_tot);
            $this->db->select('led_id');
            $this->db->from('supplier');
            $this->db->where('id', $sup_id);
            $query = $this->db->get();
            $user=$query->row_array();
            $led_id=$user['led_id'];
            $sub_total=$sub_total-$discount;
            if ($mode==1){
                $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`) VALUES ('$led_id','$sub_total','9','Purchase','1','$date','$currentDate')");
                $this->db->query("UPDATE ledger SET balance=balance-$sub_total WHERE led_Id='$led_id'");
            }else {
                $this->db->query("UPDATE ledger SET balance=balance+$sub_total WHERE led_Id='$led_id'");
            }
            $this->db->query("INSERT INTO purchase(`supplier_id`,`invoice_no`,`date`,`total_amt`,`discount`,`total_tax`) VALUES ('$sup_id','$inv_no','$date','$sub_total','$discount','$tot_tax')");
            $bill_id=$this->db->insert_id();
            $i=0;
            while ($i<sizeof($pro_id)){
                $proi=$pro_id[$i];
                $unet=$unit[$i];
                $qult=$qlt[$i];
                $ttax=$tax[$i];
                $stot=$sub_tot[$i];
                $this->db->query("INSERT INTO purchase_dtls(`ref_id`,`product_id`,`unit`,`qty`,`tax`,`sub_tot`,`status`) VALUES ('$bill_id','$proi','$unet','$qult','$ttax','$stot', '0')");
                $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$proi','$unet', '$qult', 'PU', '$user', '$bill_id')");
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('admin/admin/purchase');
            }elseif($this->input->post('save')=="print"){
                redirect('admin/admin/purchase/'.$bill_id);
            }
        }
    }
    
    function getproductdtls() {
        $product = $this->input->get('product');
        $data = array();
        $data = $this->general_model->getproductdtls($product);
        echo json_encode($data);
    }
    
    public function purchase_view(){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['supplier']=$this->general_model->getsupplier("1");
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/purchase_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $suppr=$this->input->post('supplier');
            $data['purchase_list']=$this->general_model->getpurchase($datef,$datet,$suppr);
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['suppl']=$suppr;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/purchase/purchase_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }
    }
    
    public function edit_purchase($id){
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('supplier_id', 'supplier', 'required');
        $this->form_validation->set_rules('invoice_no', 'Invoice No', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['purchase_list']=$this->general_model->getpurchasebyid($id);
            $data['supplier_list']=$this->general_model->getsupplier("1");
            $data['product_list']=$this->general_model->getinv_product();
            $data['unit_list']=$this->general_model->getinv_unit();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/edit_purchase',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $user=$this->loggedIn['id'];
            $sup_id=$this->input->post('supplier_id');
            $date=$this->input->post('date');
            $inv_no=$this->input->post('invoice_no');
            $pro_id=$this->input->post('product_id');
            $unit=$this->input->post('unit');
            $qlt=$this->input->post('qty');
            $tax=$this->input->post('tax');
            $sub_tot=$this->input->post('sub_tot');
            $tot_tax=array_sum($tax);
            $sub_total=array_sum($sub_tot);
            $this->db->query("UPDATE purchase SET supplier_id='$sup_id', invoice_no='$inv_no', date='$date',total_amt='$sub_total', total_tax='$tot_tax' WHERE id='$id'");
            $bill_id=$id;
            $this->db->query("DELETE FROM purchase_dtls WHERE ref_id='$bill_id'");
            $this->db->query("DELETE FROM stock WHERE ref_id='$bill_id' AND mode='PU'");
            $i=0;
            while ($i<sizeof($pro_id)){
                $proi=$pro_id[$i];
                $unet=$unit[$i];
                $qult=$qlt[$i];
                $ttax=$tax[$i];
                $stot=$sub_tot[$i];
                $this->db->query("INSERT INTO purchase_dtls(`ref_id`,`product_id`,`unit`,`qty`,`tax`,`sub_tot`,`status`) VALUES ('$bill_id','$proi','$unet','$qult','$ttax','$stot', '0')");
                $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$proi','$unet', '$qult', 'PU', '$user', '$bill_id')");
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('admin/admin/purchase_view');
            }elseif($this->input->post('save')=="print"){
                redirect('admin/admin/purchase/'.$bill_id);
            }
        }
    }
    public function delete_purchase($id){
        $this->db->query("DELETE FROM purchase WHERE id='$id'");
        $this->db->query("DELETE FROM purchase_dtls WHERE ref_id='$id'");
        $this->db->query("DELETE FROM stock WHERE ref_id='$id' AND mode='PU'");
        redirect('admin/admin/purchase_view');
    }
    
    public function issue_product(){
        $this->form_validation->set_rules('product_id', 'product_id', 'required');
        $this->form_validation->set_rules('qty', 'qty', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['product_list']=$this->general_model->getinv_product();
            $data['customer_list']=$this->general_model->getsupplier("2");
            $data['unit_list']=$this->general_model->getinv_unit();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/issue_product',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $user=$this->loggedIn['id'];
            $pro_id=$this->input->post('product_id');
            $unit=$this->input->post('unit');
            $qlt=$this->input->post('qty');
            $customer=$this->input->post('customer');
            $date=$this->input->post('date');
            $remark=$this->input->post('remark');
            $this->db->query("INSERT INTO issue(`product_id`,`unit`,`qty`,`customer`,`remark`,`date`,`status`) VALUES ('$pro_id','$unit','$qlt','$customer','$remark','$date', '0')");
            $bill_id=$this->db->insert_id();
            $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`,`added_date`) VALUES ('$pro_id','$unit', '-$qlt', 'IS', '$user', '$bill_id','$date')");
            redirect('admin/admin/issue_product');
        }
    }
    public function issue_view(){
        $this->form_validation->set_rules('product', 'product', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        $data['product_list']=$this->general_model->getinv_product();
        if ($this->form_validation->run() === FALSE){
            $data['issue_list']=$this->general_model->getissue();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/issue_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $pro_id=$this->input->post('product');
            $data['issue_list']=$this->general_model->getissue($pro_id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/issue_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    
    public function pu_register(){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['supplier']=$this->general_model->getsupplier("1");
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/pu_register',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $suppr=$this->input->post('supplier');
            $data['purchase_list']=$this->general_model->getpurchase($datef,$datet,$suppr);
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['suppl']=$suppr;
            $data['temple_list']=$this->general_model->gettemples();
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/purchase/pu_register',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }
    }
    
    public function pu_summary(){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/pu_summary');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['temple_list']=$this->general_model->gettemples();
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/purchase/pu_summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }
    }
    
    public function su_purchase($id){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        $data['id']=$id;
        if ($this->form_validation->run() === FALSE){
            $data['purchase_list']=$this->general_model->getpurchasebysup($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/su_purchase',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['purchase_list']=$this->general_model->getpurchasebysup($id,$datef,$datet);
            $data['datef']=$datef;
            $data['datet']=$datet;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/purchase/su_purchase',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }
    }
    
    public function is_summary(){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['customer_list']=$this->general_model->getsupplier("2");
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/is_summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $customer=$this->input->post('customer');
            $data['customer']=$customer;
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['customer_list']=$this->general_model->getsupplier("2");
            $data['temple_list']=$this->general_model->gettemples();
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/purchase/is_summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }
    }
    
    public function mookkolakallu(){
        $this->form_validation->set_rules('datef', 'Date From', 'required');
        $this->form_validation->set_rules('datet', 'Date To', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        if ($this->form_validation->run() === FALSE){
            $data['kallu_list']=$this->general_model->mookkolakallu();
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $key=$this->input->post('key');
            
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['key']=$key;
            $data['kallu_list']=$this->general_model->mookkolakallu($datef,$datet,$key);
        }
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/billing/mookkolakallu',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function stock_report(){
        $data['temple_list']=$this->general_model->gettemples();
    
    	$this->db->select('*');
    	$this->db->from('site_settings');
    	$query = $this->db->get();
    	$result = $query->row();
    
    	if(isset($result->dittum_for_stock_report) && $result->dittum_for_stock_report == 0) {
        		$this->form_validation->set_rules('datef', 'Date From', 'required');
        		$this->form_validation->set_rules('datet', 'Date To', 'required');
        
        		if ($this->form_validation->run() === FALSE){
            		$this->load->view('admin/layouts/admin_header');
    				$this->load->view('admin/purchase/stock_report_without_dittum',$data);
        			$this->load->view('admin/layouts/admin_footer');
        		}else {
        			$datef = $this->input->post('datef');
        	$datet = $this->input->post('datet');
        
        	$data['datef'] = $datef;
        	$data['datet'] = $datet;
            $data['stock_list']=$this->general_model->get_stock_without_dittum();
                
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/purchase/stock_report_without_dittum',$data);
        	$this->load->view('admin/layouts/admin_footer');
        }
        } else {
        		$data['stock_list']=$this->general_model->get_stock();
        		$this->load->view('admin/layouts/admin_header');
        		$this->load->view('admin/purchase/stock_report',$data);
        		$this->load->view('admin/layouts/admin_footer');
        }
       	
    
        
    }
    
    public function stock_dets($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['stock_list']=$this->general_model->get_stockdtl($id);
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/purchase/stock_dtls',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function dittum_mstr(){
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['temple_list']=$this->general_model->gettemples();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['product_list']=$this->general_model->getinv_product();
            $data['unit_list']=$this->general_model->getinv_unit();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/dittum/dittum_mstr',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            // $user=$this->loggedIn['id'];
            $pooja_id=$this->input->post('pooja_id');
            $pro_id=$this->input->post('product_id');
            $unit=$this->input->post('unit');
            $qlt=$this->input->post('qty');
            $i=0;
            while ($i<sizeof($pro_id)){
                $proi=$pro_id[$i];
                $unet=$unit[$i];
                $qult=$qlt[$i];
                $this->db->query("INSERT INTO dittum(`pooja_id`,`product_id`,`unit_id`,`qty`) VALUES ('$pooja_id','$proi','$unet','$qult')");
                // $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$proi','$unet', '-$qult', 'ISD', '$user', '$pooja_id')");
                $i++;
            }
            redirect('admin/admin/dittum_mstr');
        }
    }
    
    public function dittum_rprt(){
        $this->form_validation->set_rules('datef', 'Date From', 'required');
        $this->form_validation->set_rules('datet', 'Date To', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        $data['pooja_list']=$this->general_model->getpoojas();
        $data['product_list']=$this->general_model->getinv_product();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/dittum/dittum_rprt',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $from=$this->input->post('datef');
            $to=$this->input->post('datet');
            $diety="0";
            $type=null;
            $data['datef']=$from;
            $data['datet']=$to;
            $data['bill_list']=$this->general_model->getbillsummury($from,$to,$diety,$type);
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/dittum/dittum_rprt',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $this->load->view('admin/dittum/report_print',$data);
            }
        }
    }
    
    public function dittum_summary(){
        $this->form_validation->set_rules('datef', 'Date From', 'required');
        $this->form_validation->set_rules('datet', 'Date To', 'required');
        $this->form_validation->set_rules('product', 'Product', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        $data['pooja_list']=$this->general_model->getpoojas();
        $data['product_list']=$this->general_model->getinv_product();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/dittum/dittum_summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $from=$this->input->post('datef');
            $to=$this->input->post('datet');
            $product=$this->input->post('product');
            $diety="0";
            $type=null;
            $data['datef']=$from;
            $data['datet']=$to;
            $data['product']=$product;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/dittum/dittum_summary',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    
    public function dittum_list(){
        $data['temple_list']=$this->general_model->gettemples();
        $data['dittum_list']=$this->general_model->getdittum();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/dittum/dittum_list',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function edit_dittum($id){
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['product_list']=$this->general_model->getinv_product();
            $data['unit_list']=$this->general_model->getinv_unit();
            $data['pooja_id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/dittum/edit_dittum',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $this->db->query("DELETE FROM dittum WHERE pooja_id='$id'");
            $pooja_id=$this->input->post('pooja_id');
            $pro_id=$this->input->post('product_id');
            $unit=$this->input->post('unit');
            $qlt=$this->input->post('qty');
            $i=0;
            while ($i<sizeof($pro_id)){
                $proi=$pro_id[$i];
                $unet=$unit[$i];
                $qult=$qlt[$i];
                $this->db->query("INSERT INTO dittum(`pooja_id`,`product_id`,`unit_id`,`qty`) VALUES ('$pooja_id','$proi','$unet','$qult')");
                $i++;
            }
            redirect('admin/admin/dittum_list');
        }
    }
    
    //Bandaram
    
    public function bandaram(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['bandaram_list']=$this->general_model->getbandaram();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/bandaram/add_bandaram',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
            );
            $id=$this->general_model->setbandaram($data);
            redirect('admin/admin/bandaram');
        }
    }
    public function edit_bandaram($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['bandaram_list']=$this->general_model->getbandaram();
            $data['category']=$this->general_model->getbandarambyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/bandaram/edit_bandaram',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
            );
            $insert_id=$this->general_model->setbandaram($data);
            redirect('admin/admin/bandaram');
        }
    }
    public function delete_bandaram($id){
        $this->db->where('id', $id);
        $this->db->delete('bandaram');
        redirect('admin/admin/bandaram');
    }
    
    //amount
    
    public function amount(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['amount_list']=$this->general_model->getamount();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/bandaram/add_amount',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
                'remark'    =>$this->input->post('remark'),
                'order'     =>$this->input->post('order'),
            );
            $id=$this->general_model->setamount($data);
            redirect('admin/admin/amount');
        }
    }
    public function edit_amount($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['amount_list']=$this->general_model->getamount();
            $data['category']=$this->general_model->getamountbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/bandaram/edit_amount',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        =>$id,
                'name'      =>$this->input->post('name'),
                'remark'    =>$this->input->post('remark'),
                'order'     =>$this->input->post('order'),
            );
            $insert_id=$this->general_model->setamount($data);
            redirect('admin/admin/amount');
        }
    }
    public function delete_amount($id){
        $this->db->where('id', $id);
        $this->db->delete('amount');
        redirect('admin/admin/amount');
    }
    
    
    
    public function transaction(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('bandaram', 'Bandaram', 'required');
       
        if ($this->form_validation->run() === FALSE){
            $data['temple_list']=$this->general_model->gettemples();
            $data['bandaram_list']=$this->general_model->getbandaram();
            $data['amount_list']=$this->general_model->getamount();
            $data['gettransactiontype']=$this->general_model->gettransactiontype();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/bandaram/transaction',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $bandaram=$this->input->post('bandaram');
            $date=$this->input->post('date');
            $amount_id=$this->input->post('amount_id');
            $remark=$this->input->post('remark');
            $nos=$this->input->post('nos');
            $total=$this->input->post('total');
            $notes=$this->input->post('notes');
            $totalvalue=$this->input->post('totalvalue');
            if($totalvalue > 0){
                $this->db->query("INSERT INTO transaction(`bandaram`,`date`,`status`) VALUES ('$bandaram','$date', '0')");
            }
            $bill_id=$this->db->insert_id();
            $i=0;
            while ($i<sizeof($amount_id)){
                $amot=$amount_id[$i];
                $rmrk=$remark[$i];
                $nose=$nos[$i];
                $tota=$total[$i];
                $note=$notes[$i];
                if ($nose>0){
                    $this->db->query("INSERT INTO transaction_dtls(`trans_id`,`amount`,`remark`,`nos`,`total`,`notes`) VALUES ('$bill_id','$amot','$rmrk','$nose','$tota','$note')");
                }
                $i++;
            }
            redirect('admin/admin/transaction');
        }
    }
    
    public function edit_transaction($id){
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('bandaram', 'Bandaram', 'required');
        $data['id']=$id;
        if ($this->form_validation->run() === FALSE){
            $data['temple_list']=$this->general_model->gettemples();
            $data['bandaram_list']=$this->general_model->getbandaram();
            $data['amount_list']=$this->general_model->getamount();
            $data['trans_list']=$this->general_model->gettransbyid($id);
            $data['transdtl_list']=$this->general_model->gettransdtlbyid($id);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/bandaram/edit_transaction',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $this->db->query("DELETE FROM transaction WHERE id='$id'");
            $this->db->query("DELETE FROM transaction_dtls WHERE trans_id='$id'");
            $bandaram=$this->input->post('bandaram');
            $date=$this->input->post('date');
            $amount_id=$this->input->post('amount_id');
            $remark=$this->input->post('remark');
            $nos=$this->input->post('nos');
            $total=$this->input->post('total');
            $this->db->query("INSERT INTO transaction(`bandaram`,`date`,`status`) VALUES ('$bandaram','$date', '0')");
            $bill_id=$this->db->insert_id();
            $i=0;
            while ($i<sizeof($amount_id)){
                $amot=$amount_id[$i];
                $rmrk=$remark[$i];
                $nose=$nos[$i];
                $tota=$total[$i];
                $this->db->query("INSERT INTO transaction_dtls(`trans_id`,`amount`,`remark`,`nos`,`total`) VALUES ('$bill_id','$amot','$rmrk','$nose','$tota')");
                $i++;
            }
            redirect('admin/admin/bandaram_report');
        }
    }
    
    public function delete_transaction($id){
        $this->db->query("DELETE FROM transaction WHERE id='$id'");
        $this->db->query("DELETE FROM transaction_dtls WHERE trans_id='$id'");
        redirect('admin/admin/bandaram_report');
    }
    
    function getremark() {
        $amount = $this->input->get('amount_id');
        $data = array();
        $data = $this->general_model->getamountbyid($amount);
        echo json_encode($data);
    }
    
    public function bandaram_report(){
        $this->form_validation->set_rules('datef', 'Date', 'required');
        $this->form_validation->set_rules('datet', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['bandaram_list']=$this->general_model->getbandaram();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/bandaram/report',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $bandaram=$this->input->post('bandaram');
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['bandaram']=$bandaram;
            if($this->input->post('serch')=="serch"){
                $data['bandaram_list']=$this->general_model->getbandaram();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/bandaram/report',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/bandaram/report_print',$data);
            }
        }
    }
    
    public function bandaram_summary(){
        $this->form_validation->set_rules('datef', 'Date', 'required');
        $this->form_validation->set_rules('datet', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/bandaram/summary');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['datef']=$datef;
            $data['datet']=$datet;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/bandaram/summary',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/bandaram/summary_print',$data);
            }
        }
    }
    
    //Adjustment
    
    public function adjustment($billing_id = null, $type=null){
        $this->form_validation->set_rules('date', 'Date', 'required');
    	$data['type'] = $type ?? '';
    
    	if ($billing_id) {
        	$data['billing_id'] = $billing_id;
        
        	$bill_dtls = $this->general_model->getbillingdtlsById($billing_id)[0];
        	$data['customer'] = $bill_dtls['name'];
        	$data['star'] = $bill_dtls['star_eng'];
        	$data['pooja_id'] = $bill_dtls['pooja'];
        
        	
        }
    
        if ($this->form_validation->run() === FALSE){
            $data['supplier_list']=$this->general_model->getsupplier("1");
        	
        	if( $billing_id) {
            	if($this->db->table_exists('pooja_products')) {
                $this->db->select('inv_product.*');
                $this->db->from('pooja_products');
                $this->db->join('inv_product', 'inv_product.id=pooja_products.product_id');
                $this->db->where('pooja_id', $bill_dtls['pooja']);
                $query = $this->db->get();
            	
            	if($query->num_rows() > 0) {
                	$data['product_list']=$query->result_array();
                } else {
                	$data['product_list']=$this->general_model->getinv_product();
                }
                } else {
                	$data['product_list']=$this->general_model->getinv_product();
                }
                
            } else {
            	$data['product_list']=$this->general_model->getinv_product();
            }
            
            $data['unit_list']=$this->general_model->getinv_unit();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/adjustment',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $user	= $this->loggedIn['id'];
            $date	= $this->input->post('addeddate');
            $pro_id	= $this->input->post('product_id');
            $type	= $this->input->post('type');
            $unit	= $this->input->post('unit');
            $qlt	= $this->input->post('qty');
        	$source	= $this->input->post('source');
        
            $i=0;
            while ($i<sizeof($pro_id)){
                $proi=$pro_id[$i];
                $unet=$unit[$i];
                $ttax=$type[$i];
                $qult=$qlt[$i];
                if ($ttax=="+"){
                    $qulty=$qult;
                }elseif ($ttax=="-"){
                    $qulty="-".$qult;
                }
                // $this->db->query("INSERT INTO adjustment(`product_id`,`date`,`unit`,`type`,`qty`,`status`) VALUES ('$proi','$date','$unet','$ttax','$qult', '0')");
                // $bill_id=$this->db->insert_id();
                // $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`,`added_date`) VALUES ('$proi','$unet', '$qulty', 'AD', '$user', '$bill_id','$date')");
                // $i++;
                // 
                $billId = $this->input->post('billing_id');
                
                if ($billId) {
                    $this->db->query("INSERT INTO adjustment(`bill_id`,`product_id`,`date`,`unit`,`type`,`qty`,`status`,`source`) VALUES ('$billId','$proi','$date','$unet','$ttax','$qult', '0', '$source')");
                    $bill_id=$this->db->insert_id();
            	    $adj_ids[] = $bill_id;
                    $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`,`added_date`) VALUES ('$proi','$unet', '$qulty', 'AD', '$user', '$bill_id','$date')");
                    $i++;
                } else {
                    $this->db->query("INSERT INTO adjustment(`product_id`,`date`,`unit`,`type`,`qty`,`status`,`source`) VALUES ('$proi','$date','$unet','$ttax','$qult', '0', '$source')");
                    $bill_id=$this->db->insert_id();
            	    $adj_ids[] = $bill_id;
                    $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`,`added_date`) VALUES ('$proi','$unet', '$qulty', 'AD', '$user', '$bill_id','$date')");
                    $i++;
                }
            }
            // if($this->input->post('save')=="save"){
            //     redirect('admin/admin/adjustment');
            // }elseif($this->input->post('save')=="print"){
            //     redirect('admin/admin/purchase/'.$bill_id);
            // }
            if($this->input->post('save')=="save"){
                redirect('admin/admin/adjustment');
            }elseif($this->input->post('save')=="print"){
                redirect('admin/admin/purchase/'.$bill_id);
            } elseif($this->input->post('save')=="bill_print") {
            	$billingId = $this->input->post('billing_id');
            	$this->session->set_userdata('adj_ids', $adj_ids);
				redirect('admin/admin/bill_print/'.$billingId);
			}
        }
    }
    
    public function adjustment_view(){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['product_list']=$this->general_model->getinv_product();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/adjustment_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $product=$this->input->post('product');
            $data['purchase_list']=$this->general_model->getadjustment($datef,$datet,$product);
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['product']=$product;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/purchase/adjustment_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }
    }
    
    public function user_wise(){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/user_wise',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['datef']=$datef;
            $data['datet']=$datet;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/user_wise',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    
    public function user_wise_pooja(){
        $this->form_validation->set_rules('type', 'Type', 'required');
        $data['user_list']=$this->general_model->getusers();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/user_wise_pooja',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $role=$this->loggedIn['role'];
            if ($role=="superadmin"){
                $user_id=$this->input->post('user_id');
            }else{
                $user_id=$this->loggedIn['id'];
            }
            $type=$this->input->post('type');
            $keyword=$this->input->post('keyword');
            $bill=$this->input->post('bill');
            $dateto=$this->input->post('dateto');
            $data['bill_list']=$this->general_model->getbill($type,$keyword,$dateto,$bill,$user_id);
            $data['type']=$type;
            $data['date']=$keyword;
            $data['bill']=$bill;
            $data['user_id']=$user_id;
            $data['dateto']=$dateto;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/user_wise_pooja',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="summary"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/user_pooja_print',$data);
            }
        }
    }
    
    public function cust_search(){
        if ($this->input->post('button')=="search"){
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['customer_list']=$this->general_model->searchscheduled($datef,$datet);
            $data['datef']=$datef;
            $data['datet']=$datet;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/cust_search',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$datet=date('Y-m-d');
            $data['customer_list']=$this->general_model->searchscheduled($datef,$datet);
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/cust_search',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    // Website Settings
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('admin/','refresh');
    }
    

    public function schedule_billing(){
        $this->form_validation->set_rules('name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('diety_id', 'Diety', 'required');
        $this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
        $this->form_validation->set_rules('star_id', 'Star', 'required');
        $today = date('Y-m-d');
        
        if ($this->form_validation->run() === FALSE){
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $data['last_id']=$last_id1;
            $data['diety_list']=$this->general_model->getdietys();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['star_list']=$this->general_model->getstars();
            $data['temple_list']=$this->general_model->gettemples();
            
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/schedule_billing',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $name=$this->input->post('name');
            $diety_id=$this->input->post('diety_id');
            $pooja_id=$this->input->post('pooja_id');
            $star_id=$this->input->post('star_id');
            $time=$this->input->post('time');
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
                    $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`time`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja_id','$amount','$time','$data', '1')");
                    $i++;
                }
            }else{
                $this->db->query("INSERT INTO billing_online(`customer_id`,`name`,`diety_id`,`star_id`,`pooja_id`,`rate`,`time`,`date`,`status`) VALUES ('$refno','$name','$diety_id','$star_id','$pooja_id','$amount','$time','$main_date', '1')");
            }
            redirect('admin/admin/schedule_billing');
        }
    }
    

    public function pooja_register(){
        $data['temple_list']=$this->general_model->gettemples();
        if ($this->input->post('button')=="search"){
            $datef=$this->input->post('keyword');
            $datet=$this->input->post('datet');
            $mode=$this->input->post('mode');
            if ($datef==""){
                // $data['customer_list']=$this->general_model->getcustomers();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/pooja/pooja_register');
                $this->load->view('admin/layouts/admin_footer');
            }else{
                 $data['poojareg_list']=$this->general_model->getpoojaregisterbydate($datef,$datet,$mode);
                 $data['date']=$datef;
                 $data['datet']=$datet;
                 $data['mode']=$mode;
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/pooja/pooja_register',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }elseif ($this->input->post('button')=="print"){
            $datef=$this->input->post('keyword');
            $datet=$this->input->post('datet');
            $mode=$this->input->post('mode');
           
            if ($datef!=""){
                $data["datef"]=$datef;
                $data["datet"]=$datet;
                $data["mode"]=$mode;
                $data['poojareg_list']=$this->general_model->getpoojaregisterbydate($datef,$datet,$mode);
                $this->load->view('admin/pooja/pooja_register_print',$data);
            }
            else{
                // $data['customer_list']=$this->general_model->getcustomers();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pooja/pooja_register');
            $this->load->view('admin/layouts/admin_footer');
            }
        }else{
           // $data['customer_list']=$this->general_model->getcustomers();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pooja/pooja_register');
            $this->load->view('admin/layouts/admin_footer');
        }
    }
public function bill_report_important(){
        $this->form_validation->set_rules('keyword', 'Date', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
   
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->general_model->getdietys();
        	$data['pooja_list']=$this->general_model->get_imp_pooja();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/report_important',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $bill=$this->input->post('diety');
            $type=$this->input->post('type');
            $ampm=$this->input->post('ampm');
        	// $pooja=$this->input->post('pooja');
            $data['date']=$keyword;
            $data['diety']=$bill;
            $data['ampm']=$ampm;
        	// $data['pooja']=$pooja;
         	$data['bill_list']=$this->general_model->getbillreport_imp($keyword,$bill,$type,$ampm);
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
            	$data['pooja_list']=$this->general_model->get_imp_pooja();
                $data['bill_list']=$this->general_model->getbillreport_imp($keyword,$bill,$type,$ampm);
           
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/report_important',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $data['pooja_list']=$this->general_model->get_imp_pooja();
            
                $this->load->view('admin/billing/report_print_important',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
            	$data['isimp'] = '1';
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print',$data);
            }
        }
    }
    public function counter_settings(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('printer', 'Printer', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/counter/add_counter',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      => $this->input->post('name'),
                'printer'   => $this->input->post('printer'),
            );
            $id=$this->general_model->setcounter($data);
            redirect('admin/admin/counter_settings');
        }
    }
    public function edit_counter_settings($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('printer', 'Printer', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['counter_list']=$this->general_model->getcounters();
            $data['counter']=$this->general_model->getcountersbyid($id);
            $data['id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/counter/edit_counter',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'        => $id,
                'name'      => $this->input->post('name'),
                'printer'   => $this->input->post('printer'),
            );
            $id=$this->general_model->setcounter($data);
            redirect('admin/admin/counter_settings');
        }
    }
 public function marriage_registration_add(){

        $this->form_validation->set_rules('groom_name', 'Name', 'required');
        //$this->form_validation->set_rules('groom_star', 'Birth Star', 'required');
        $this->form_validation->set_rules('groom_DOB', 'Date Of Birth', 'required');
        //$this->form_validation->set_rules('groom_age', 'Age', 'required');
        $this->form_validation->set_rules('groom_fname', 'Name of Father', 'required');
        //$this->form_validation->set_rules('groom_mname', 'Name of Mother', 'required');
        $this->form_validation->set_rules('groom_address', 'Permenent Address', 'required');
        $this->form_validation->set_rules('groom_phone1', 'Phone1', 'required');
        //$this->form_validation->set_rules('groom_phone2', 'Phone2', 'required');
        $this->form_validation->set_rules('mdate', 'Marriage Date', 'required');
        $this->form_validation->set_rules('f_muhoortham', 'From Muhoortham', 'required');
        //$this->form_validation->set_rules('groom_id_proof', 'ID Proof', 'required');
        //$this->form_validation->set_rules('groom_id_proof_no', 'ID Proof Number', 'required');

        $this->form_validation->set_rules('bride_name', 'Name', 'required');
       // $this->form_validation->set_rules('bride_star', 'Birth Star', 'required');
        $this->form_validation->set_rules('bride_DOB', 'Date Of Birth', 'required');
       // $this->form_validation->set_rules('bride_age', 'Age', 'required');
        $this->form_validation->set_rules('bride_fname', 'Name of Father', 'required');
        //$this->form_validation->set_rules('bride_mname', 'Name of Mother', 'required');
        $this->form_validation->set_rules('bride_address', 'Permenent Address', 'required');
        $this->form_validation->set_rules('bride_phone1', 'Phone1', 'required');
        //$this->form_validation->set_rules('bride_phone2', 'Phone2', 'required');
        //$this->form_validation->set_rules('bride_id_proof', 'ID Proof', 'required');
        //$this->form_validation->set_rules('bride_id_proof_no', 'ID Proof Number', 'required');

        $data['star_list']=$this->general_model->getstars();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/marriage_registration_add',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'mdate'               =>$this->input->post('mdate'),
                'f_muhoortham'          =>$this->input->post('f_muhoortham'),
                'to_muhoortham'          =>$this->input->post('to_muhoortham'),

                'groom_name'          =>$this->input->post('groom_name'),
                'groom_star'          =>$this->input->post('groom_star'),
                'groom_DOB'           =>$this->input->post('groom_DOB'),
                'groom_age'           =>$this->input->post('groom_age'),
                'groom_fname'         =>$this->input->post('groom_fname'),
                'groom_mname'         =>$this->input->post('groom_mname'),
                'groom_address'       =>$this->input->post('groom_address'),
                'groom_phone1'        =>$this->input->post('groom_phone1'),
                'groom_phone2'        =>$this->input->post('groom_phone2'),
                'groom_id_proof'      =>$this->input->post('groom_id_proof'),
                'groom_id_proof_no'   =>$this->input->post('groom_id_proof_no'),

                'bride_name'          =>$this->input->post('bride_name'),
                'bride_star'          =>$this->input->post('bride_star'),
                'bride_DOB'           =>$this->input->post('bride_DOB'),
                'bride_age'           =>$this->input->post('bride_age'),
                'bride_fname'         =>$this->input->post('bride_fname'),
                'bride_mname'         =>$this->input->post('bride_mname'),
                'bride_address'       =>$this->input->post('bride_address'),
                'bride_phone1'        =>$this->input->post('bride_phone1'),
                'bride_phone2'        =>$this->input->post('bride_phone2'),
                'bride_id_proof'      =>$this->input->post('bride_id_proof'),
                'bride_id_proof_no'   =>$this->input->post('bride_id_proof_no'),
                'issued_date'   =>$this->input->post('issued_date'),
                'witness1'          =>$this->input->post('witness1'),
                'witness2'          =>$this->input->post('witness2'),
               
            );
            $id=$this->general_model->set_mrg_reg($data);
            $msg="Data Saved";
            redirect('admin/admin/marriage_reg_view');
        }

    }


    public function marriage_reg_view(){
        if ($this->input->post('button')=="search"){
            $datef=$this->input->post('keyword');
            $datet=$this->input->post('datet');
            if ($datef==""){
                $data['mrg_list']=$this->general_model->get_mrg_reg();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/customer/marriage_reg_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }else{
                $data['mrg_list']=$this->general_model->getmrgbydate($datef,$datet);
                $data['date']=$datef;
                $data['datet']=$datet;
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/customer/marriage_reg_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }elseif ($this->input->post('button')=="print"){
            $datef=$this->input->post('keyword');
            $datet=$this->input->post('datet');
            if ($datef==""){
                $data['mrg_list']=$this->general_model->get_mrg_reg();
                $this->load->view('admin/customer/cust_print',$data);
            }else{
                $data['mrg_list']=$this->general_model->getmrgbydate($datef,$datet);
                $this->load->view('admin/customer/cust_print',$data);
            }
        }else{
            $data['mrg_list']=$this->general_model->get_mrg_reg();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/marriage_reg_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }

    public function marriage_registration_edit($id){
        $this->form_validation->set_rules('groom_name', 'Name', 'required');
        $this->form_validation->set_rules('groom_DOB', 'Date Of Birth', 'required');
        $this->form_validation->set_rules('groom_fname', 'Name of Father', 'required');
        $this->form_validation->set_rules('groom_address', 'Permenent Address', 'required');
        $this->form_validation->set_rules('groom_phone1', 'Phone1', 'required');
        $this->form_validation->set_rules('mdate', 'Marriage Date', 'required');
        $this->form_validation->set_rules('f_muhoortham', 'From Muhoortham', 'required');

        $this->form_validation->set_rules('bride_name', 'Name', 'required');
        $this->form_validation->set_rules('bride_DOB', 'Date Of Birth', 'required');
        $this->form_validation->set_rules('bride_fname', 'Name of Father', 'required');
        $this->form_validation->set_rules('bride_address', 'Permenent Address', 'required');
        $this->form_validation->set_rules('bride_phone1', 'Phone1', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['customer']=$this->general_model->getmrgById($id);
            $data['star_list']=$this->general_model->getstars();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/marriage_registration_edit',$data);
            $this->load->view('admin/layouts/admin_footer');

        }
        else{
            $data=array(
                'id'        =>$id,
                'mdate'               =>$this->input->post('mdate'),
                'f_muhoortham'          =>$this->input->post('f_muhoortham'),
                'to_muhoortham'          =>$this->input->post('to_muhoortham'),

                'groom_name'          =>$this->input->post('groom_name'),
                'groom_star'          =>$this->input->post('groom_star'),
                'groom_DOB'           =>$this->input->post('groom_DOB'),
                'groom_age'           =>$this->input->post('groom_age'),
                'groom_fname'         =>$this->input->post('groom_fname'),
                'groom_mname'         =>$this->input->post('groom_mname'),
                'groom_address'       =>$this->input->post('groom_address'),
                'groom_phone1'        =>$this->input->post('groom_phone1'),
                'groom_phone2'        =>$this->input->post('groom_phone2'),
                'groom_id_proof'      =>$this->input->post('groom_id_proof'),
                'groom_id_proof_no'   =>$this->input->post('groom_id_proof_no'),

                'bride_name'          =>$this->input->post('bride_name'),
                'bride_star'          =>$this->input->post('bride_star'),
                'bride_DOB'           =>$this->input->post('bride_DOB'),
                'bride_age'           =>$this->input->post('bride_age'),
                'bride_fname'         =>$this->input->post('bride_fname'),
                'bride_mname'         =>$this->input->post('bride_mname'),
                'bride_address'       =>$this->input->post('bride_address'),
                'bride_phone1'        =>$this->input->post('bride_phone1'),
                'bride_phone2'        =>$this->input->post('bride_phone2'),
                'bride_id_proof'      =>$this->input->post('bride_id_proof'),
                'bride_id_proof_no'   =>$this->input->post('bride_id_proof_no'),
                'issued_date'=>date("Y-m-d"),
            
               'witness1'          =>$this->input->post('witness1'),
               'witness2'          =>$this->input->post('witness2'),
                
            );
            $id=$this->general_model->set_mrg_reg($data);
            $msg="Data Updated";
            redirect('admin/admin/marriage_reg_view');
        }  
    }
    public function print_mrg($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['customer']=$this->general_model->getmrgById($id);
       // print_r($data);exit;
        $this->load->view('admin/customer/mrg_print',$data);
    }

  /** public function customerpayments(){
        $this->form_validation->set_rules('customer_id', 'Customer', 'required');
        if ($this->form_validation->run() === FALSE){
            $data = [];
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/customerpayments',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $customer_id = $this->input->post('customer_id');
            $data['customer'] = $this->general_model->getCustomer($customer_id);
            $data['customerinvoices'] = $this->general_model->getBills($customer_id);
      
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/customerpayments',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function savepayments(){
   // print_r($_POST);exit;
         $invoice_no = $this->input->post('invoice_id');
         $payamount =  $this->input->post('payamount');
          $inv= $this->input->post('invoice_id1');
         $mo= $this->input->post('mode');
       /**  foreach($invoice_no as $key => $val){
             $id = $invoice_no[$key];
             $paid_amount = $payamount[$key];
          $this->db->query("UPDATE billing SET recv_amt=recv_amt+$paid_amount,bal_amt=bal_amt-$paid_amount WHERE id='$id'");  
         $name = $this->db->where('billing.id',$id)->join('user_dtl', 'billing.customer_id = user_dtl.id')->get('billing')->row()->name;
             $currentDate=date('Y-m-d');
             $led = 6;
            // $mo = 9;
             $na = 'Rs '.$paid_amount.' received against bill no. '. $id.' from '.$name;
             $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`ref_no`) VALUES ('$led','$paid_amount','$mo','$na','2','$currentDate','$currentDate','$id')");
         }*/
  /**  for ($i=0;$i<count($inv);$i++)
    {
    
             $id = $inv[$i];
             $paid_amount = $payamount[$i];
    //print "UPDATE billing SET recv_amt=recv_amt+$paid_amount,bal_amt=bal_amt-$paid_amount WHERE id='$id'";
         $this->db->query("UPDATE billing SET recv_amt=recv_amt+$paid_amount,bal_amt=bal_amt-$paid_amount WHERE id='$id'");  
         $name = $this->db->where('billing.id',$id)->join('user_dtl', 'billing.customer_id = user_dtl.id')->get('billing')->row()->name;
             $currentDate=date('Y-m-d');
             $led = 6;
            // $mo = 9;
             $na = 'Rs '.$paid_amount.' received against bill no. '. $id.' from '.$name;
    if($paid_amount>0){
             $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`ref_no`) VALUES ('$led','$paid_amount','$mo','$na','2','$currentDate','$currentDate','$id')");
    }
    
    }
        redirect('admin/admin/customerpayments');
    }
    public function getCustomerByNamePhoneBill(){
       $keyword = $this->input->post('keyword');
       $this->db->like('name', $keyword);
       $this->db->or_like('mobile', $keyword);
       $query = $this->db->get('user_dtl');
       if ($query->num_rows()) {
			$res = $query->result_array();
            foreach($res as $customer){
            $response[] = array("id"       =>$customer['id'], 
                                "value"    =>$customer['name'],
                                "label"    =>$customer['name'], 
                                "phone"    =>$customer['mobile'],
                                "email"    =>$customer['email']);
            }
            
		} else {
			 $response = array();
		}
        echo json_encode($response);
    }
    public function payablelist(){
         $data['customerinvoices'] = $this->general_model->getCustomerBills();
         $this->load->view('admin/layouts/admin_header');
         $this->load->view('admin/billing/customerpayables',$data);
         $this->load->view('admin/layouts/admin_footer');
    }
*/

public function customerpayments(){
        $this->form_validation->set_rules('customer_id', 'Customer', 'required');
		$data['mode']=$this->Accounts_model->getmode();
        if ($this->form_validation->run() === FALSE){
            $data = [];
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/customerpayments',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $customer_id = $this->input->post('customer_id');
            $data['customer'] = $this->general_model->getCustomer($customer_id);
            $data['customerinvoices'] = $this->general_model->getBills($customer_id);
      		
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/customerpayments',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function savepayments(){
        $invoice_no = $this->input->post('invoice_id');
        $payamount =  $this->input->post('payamount');
        $customer_id = $this->input->post('customer_id');
        $customer = $this->general_model->getCustomer($customer_id);
    	$mo=$this->input->post('mode');
    	
    	$receipts = array();
        foreach($invoice_no as $key => $val){
            $id = $val;
            $paid_amount = $payamount[$id];
    		// print_r($paid_amount);
    		// exit;
            $this->db->query("UPDATE billing SET bal_amt=bal_amt-$paid_amount WHERE id='$id'");
            $name = $this->db->where('billing.id',$id)->join('user_dtl', 'billing.customer_id = user_dtl.id')->get('billing')->row()->name;
            $currentDate=date('Y-m-d');
            $led = $customer['led_id'];
        //    $mo = 9;
            $na = 'Rs '.$paid_amount.' received against bill no. '. $id.' from '.$name;
            $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`,`ref_no`) VALUES ('$led','$paid_amount','$mo','$na','2','$currentDate','$currentDate','$id')");
        	$receipts[] = $this->db->insert_id();
        }
    	
    	if (count($receipts) > 0) {
        	foreach($receipts as $receipt) {
            	// redirect('accounts/printReceipt/'.$receipt);
            	$this->printReceipt($receipt);
        	}
        } else {
        	redirect('admin/admin/customerpayments');
        }
    	
    	
    }

	public function printReceipt($id) {
    	$data['temple_list']=$this->general_model->gettemples();
        $data['receiptData']=$this->Accounts_model->getReceiptData($id);
    	$data['loggedin']=$this->session->admin;
        $this->load->view('admin/accounts/printReceipt',$data);
    }


    public function getCustomerByNamePhoneBill(){
       $keyword = $this->input->post('keyword');
       $this->db->select('user_dtl.*');
        $this->db->from('user_dtl');
       $this->db->join('billing', 'user_dtl.id = billing.customer_id');
       $this->db->like('user_dtl.name', $keyword);
       $this->db->or_like('user_dtl.mobile', $keyword);
       $this->db->or_like('billing.id', $keyword);
       $this->db->group_by('user_dtl.id');
       $query = $this->db->get();
       if ($query->num_rows()) {
			$res = $query->result_array();
            foreach($res as $customer){
            $response[] = array("id"       =>$customer['id'], 
                                "value"    =>$customer['name'],
                                "label"    =>$customer['name'], 
                                "phone"    =>$customer['mobile'],
                                "email"    =>$customer['email']);
            }
            
		} else {
			 $response = array();
		}
        echo json_encode($response);
    }
    public function getCustomerByPhone(){
        $keyword = $this->input->post('phone');
        $this->db->like('mobile', $keyword);
        $query = $this->db->get('user_dtl');
        if ($query->num_rows()) {
             $response = $query->row_array();
         } else {
              $response = array();
         }
         echo json_encode($response);
     }
    public function payablelist(){
         $data['customerinvoices'] = $this->general_model->getCustomerBills();
         $this->load->view('admin/layouts/admin_header');
         $this->load->view('admin/billing/customerpayables',$data);
         $this->load->view('admin/layouts/admin_footer');
    }


public function counter_wise_pooja(){
        $this->form_validation->set_rules('type', 'Type', 'required');
        $data['user_list']=$this->general_model->getcounters();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing//counter_wise_pooja',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $role=$this->loggedIn['role'];
            if ($role=="superadmin"){
                $user_id=$this->input->post('user_id');
            }else{
                $user_id=$this->loggedIn['id'];
            }
            $type=$this->input->post('type');
            $keyword=$this->input->post('keyword');
            $bill=$this->input->post('bill');
            $dateto=$this->input->post('dateto');
            $data['bill_list']=$this->general_model->getcounterwisebill($type,$keyword,$dateto,$bill,$user_id);
            $data['type']=$type;
            $data['date']=$keyword;
            $data['bill']=$bill;
            $data['user_id']=$user_id;
            $data['dateto']=$dateto;
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing//counter_wise_pooja',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="summary"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/user_pooja_print',$data);
            }
        }
    }

	public function counter_wise(){
        $this->form_validation->set_rules('datef', 'Datef', 'required');
        $this->form_validation->set_rules('datet', 'Datet', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        if ($this->form_validation->run() === FALSE){
             $data['datef']=date("Y-m-d");
            $data['datet']=date("Y-m-d");
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/counter_wise',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else {
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['datef']=$datef;
            $data['datet']=$datet;
        
        	$this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/counter_wise',$data);
            $this->load->view('admin/layouts/admin_footer');
            
        }
    }


public function bill_report_poojawise(){

        $this->form_validation->set_rules('keyword', 'Date', 'required');
        $this->form_validation->set_rules('temple', 'Diety', 'required');
   
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/report_poojawise',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $dateto=$this->input->post('dateto');
            $bill=$this->input->post('temple');
            $type=$this->input->post('type');
            $ampm=$this->input->post('ampm');

            $pooja=$this->input->post('pooja');
            $data['dateto']=$dateto;
            $data['diety']=$bill;
            $data['ampm']=$ampm;
        	$data['keyword']=$keyword;
        	$data['pooja']=$pooja;
        
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $data['bill_list']=$this->general_model->getbillreport_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/report_poojawise',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
               $data['bill_list']=$this->general_model->getbillreport_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print_single',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
               $data['bill_list']=$this->general_model->getbillreport_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print_single',$data);
            }
        }
    }
   

      public function paid_billing(){
       
        $this->form_validation->set_rules('date', 'Date', 'required');
        $today = date('Y-m-d');
        date_default_timezone_set("Asia/Calcutta");
       $counter = $this->session->userdata("counter");  
        if ($this->form_validation->run() === FALSE){
       
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $this->db->query("ALTER TABLE billing AUTO_INCREMENT=$last_id1");
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['last_id']=$last_id1;
           
           // to check if code based billing or other 
            $query = $this->db->query("select * from site_settings where id =1"); 
            $row = $query->row();
            
            $this->load->view('admin/layouts/admin_header');  
           if($row->code_settings=='1'){ $this->load->view('admin/billing/paid_billing',$data);}else {
           $this->load->view('admin/billing/paid_billing',$data);}
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $paid_name = $this->input->post('bill_name');
            $paid_amount = $this->input->post('paid_amount');
            $reference = $this->input->post('ref_no');
            $bank = $this->input->post('bank');
            $branch = $this->input->post('branch');
            $user_id=$this->loggedIn['id'];
            $diety=$this->input->post('temple');
            $date=$this->input->post('date');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $times=$this->input->post('time');
            $mode=$this->input->post('mode');
            $date1=$this->input->post('date1');
            $sl_no=$this->input->post('sl_no');
          $bill_time=date("Y-m-d H:i:s"); 
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`user_id`,`status`,`mode`,`bill_time`,`counter`) VALUES ('$diety[0]','$date','---','$user_id', '1','$mode','$bill_time','$counter')");
            
        $bill_id=$this->db->insert_id();
            $i=0;$total=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $amou=$amt[$i];
                $rata=$rate[$i];
                $time=$times[$i];
                $data=$date1[$i];
            $total+=$amou;
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
                $i++;
            }
        
           $this->db->query("UPDATE billing SET total='$total',recv_amt='$total' WHERE id='$bill_id'");
           $this->db->query("INSERT INTO other_billing(`bill_id`,`mode`,`name`,`ref_no`,`amount`,`bank`,`branch`,`slno`) VALUES ('$bill_id','$mode','$paid_name','$reference','$paid_amount','$bank','$branch','$sl_no')");
           $balance = $paid_amount - $total;
           if($balance > 0){
              $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$paid_name','9000','','9000','1','','$balance','$balance','$date', '1')");
              $this->db->query("UPDATE billing SET total='$paid_amount',recv_amt='$paid_amount' WHERE id='$bill_id'");
           }
          //$this->db->query("UPDATE billing SET total='$total' WHERE id='$bill_id'");
          redirect('admin/admin/paid_billing');

        }
    }
     public function other_billing(){
          $this->db->select('other_billing.*,billing.date');
          $this->db->from('other_billing');
          $this->db->join('billing','billing.id = other_billing.bill_id');
          $this->db->order_by("other_billing.id", "desc");
          $query = $this->db->get();
		  $data['bookings'] = $query->result_array();
          $this->load->view('admin/layouts/admin_header');
          $this->load->view('admin/billing/other_bills',$data);
          $this->load->view('admin/layouts/admin_footer');
     }
     public function totalprint($id){
         $data['temple_list']=$this->general_model->gettemples();
         $data['bill_list']=$this->general_model->getbillingById($id);
         $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
         $data['bill_id']=$id;
         $query = $this->db->where('bill_id',$id)->get('other_billing');
		 $data['bookings'] = $query->row_array();
         $this->load->view('admin/billing/paid_totalprint',$data);
     }
     public function donationprint($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['donation']= $query = $this->db->where('bill_id',$id)->where('pooja','9000')->get('billing_dtls')->result_array();
        $data['bill_id']=$id;
        $this->load->view('admin/billing/paid_donationprint',$data);
     }

	 public function fpooja(){
        $this->form_validation->set_rules('fname', 'Name', 'required');
        $today = date('Y-m-d');
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
        	$data['site']=$this->general_model->getsite();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/fpooja/add_fpooja',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
        	$fname=$this->input->post('fname');
        	$address=$this->input->post('address');
        	$city=$this->input->post('city');
        	$pincode=$this->input->post('pincode');
        	$mobile=$this->input->post('mobile');
        	$email=$this->input->post('email');
            $diety=$this->input->post('temple');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
          	$bill_time=date("Y-m-d H:i:s"); 
            $this->db->query("INSERT INTO fpooja(`name`,`address`,`city`,`pincode`,`mobile`,`email`) VALUES ('$fname','$address','$city', '$pincode','$mobile','$email')");
            $bill_id=$this->db->insert_id();
            $i=0;$total=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $amou=$amt[$i];
                $rata=$rate[$i];
            	$total+=$amou;
                $this->db->query("INSERT INTO fpooja_dtl(`f_id`,`diety`,`name`,`star`,`pooja`,`nos`,`rate`,`amount`) VALUES ('$bill_id','$dety','$nama','$ster','$poja','$qult','$rata','$amou')");
                $i++;
            }
            $this->db->query("UPDATE fpooja SET total='$total' WHERE id='$bill_id'");
            redirect('admin/admin/fpooja_view');
        }
    }

	 public function edit_fpooja($id){
        $this->form_validation->set_rules('fname', 'Name', 'required');
        $today = date('Y-m-d');
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
        	$data['fpooja_list']=$this->general_model->getFpooja($id);	
        	$data['f_id']=$id;	
        	$data['fpoojadtl_list']=$this->general_model->getFpoojadtl($id);
        	$this->db->select('*');
            $this->db->from('fpooja_dtl');
            $this->db->where('f_id', $id);
            $query = $this->db->get();
            $data['row_count']=$query->num_rows();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/fpooja/edit_fpooja',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
        	$fname=$this->input->post('fname');
        	$address=$this->input->post('address');
        	$city=$this->input->post('city');
        	$pincode=$this->input->post('pincode');
        	$mobile=$this->input->post('mobile');
        	$email=$this->input->post('email');
            $diety=$this->input->post('temple');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
          	$bill_time=date("Y-m-d H:i:s"); 
            $this->db->query("UPDATE fpooja SET `name`='$fname',`address`='$address',`city`='$city',`pincode`='$pincode',`mobile`='$mobile',`email`='$email' WHERE id='$id'");           
        	$this->db->query("DELETE FROM fpooja_dtl WHERE f_id='$id'");
            $bill_id=$id;
            $i=0;$total=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $amou=$amt[$i];
                $rata=$rate[$i];
            	$total+=$amou;
                $this->db->query("INSERT INTO fpooja_dtl(`f_id`,`diety`,`name`,`star`,`pooja`,`nos`,`rate`,`amount`) VALUES ('$bill_id','$dety','$nama','$ster','$poja','$qult','$rata','$amou')");
                $i++;
            }
            $this->db->query("UPDATE fpooja SET total='$total' WHERE id='$bill_id'");
            redirect('admin/admin/fpooja_view');
        }
    }

	public function fpooja_view(){
        $data['fpooja_list']=$this->general_model->getFpooja();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/fpooja/view_fpooja',$data);
        $this->load->view('admin/layouts/admin_footer');
    }

	public function delete_fpooja($id){
        $result=$this->general_model->delete_fpooja($id);
        $msg="Deleted";
        redirect('admin/admin/fpooja_view');
    }

    function getfpoojabyfid() {
        $fid = $this->input->post('fid');
    	$this->db->select('fpooja_dtl.*,diety.name as diety_nm,pooja.name as pooja_nm,stars.name_eng as star_nm');
        $this->db->from('fpooja_dtl');
        $this->db->join('pooja','pooja.id = fpooja_dtl.pooja');
        $this->db->join('diety','diety.id = fpooja_dtl.diety');
        $this->db->join('stars','stars.id = fpooja_dtl.star');
    	$this->db->where('fpooja_dtl.f_id', $fid);
        $query = $this->db->get();
        $data = $query->result_array();
        echo json_encode($data);
    }

	// room
    
    public function add_room(){
        $this->form_validation->set_rules('room_no', 'Room Number', 'required');
        $this->form_validation->set_rules('door_no', 'Door Number', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['room_list']=$this->general_model->getrooms();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/room/add_room',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(							
                'room_no'      =>$this->input->post('room_no'),
                'room_id'      =>$this->input->post('room_id'),
                'door_no'      =>$this->input->post('door_no'),
                'room_address' =>$this->input->post('room_address'),
                'room_post'    =>$this->input->post('room_post'),
                'room_place'   =>$this->input->post('room_place'),
                'room_dist'    =>$this->input->post('room_dist'),
                'room_pincode' =>$this->input->post('room_pincode'),
            );
            $id=$this->general_model->setroom($data);
            $msg="Room Saved";
            redirect('admin/admin/view_room');
        }
        
    }
    public function edit_room($id){
        $this->form_validation->set_rules('room_no', 'Room Number', 'required');
        $this->form_validation->set_rules('door_no', 'Door Number', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['room']=$this->general_model->getroomsById($id);
            $data['room_list']=$this->general_model->getrooms();
        	$data['id'] = $id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/room/edit_room',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'           =>$id,
                'room_no'      =>$this->input->post('room_no'),
                'room_id'      =>$this->input->post('room_id'),
                'door_no'      =>$this->input->post('door_no'),
                'room_address' =>$this->input->post('room_address'),
                'room_post'    =>$this->input->post('room_post'),
                'room_place'   =>$this->input->post('room_place'),
                'room_dist'    =>$this->input->post('room_dist'),
                'room_pincode' =>$this->input->post('room_pincode'),
            );
            $id=$this->general_model->setroom($data);
            $msg="Room Updated";
            redirect('admin/admin/view_room');
        }
        
    }

	public function view_room(){
        $data['room_list']=$this->general_model->getrooms();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/room/view_room',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function delete_room($id){
        $result=$this->general_model->deleteroom($id);
        $msg="Deleted";
        redirect('admin/admin/view_room');
    }
	
	public function rend_post(){
        $this->form_validation->set_rules('mnth_yr', 'Month Year', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/room/rend_post');
            $this->load->view('admin/layouts/admin_footer');
        }else{
        	$mntyr=explode("-",$this->input->post('mnth_yr'));
        	$rec_date=$this->input->post('rec_date');
        	$cust_list =$this->general_model->getcusts();
        	foreach ($cust_list as $cust){
            	$last=$this->general_model->getlasttransid();
            	$last_id=$last['id'];
            	$last_id1=$last_id+1;
            	$this->db->query("ALTER TABLE room_trans AUTO_INCREMENT=$last_id1");
            	$data=array(									
                	'room_id'       =>$cust['room_no'],
                	'cust_id'       =>$cust['id'],
                	'rec_no'        =>$last_id1,
                	'rec_date' 	    =>$rec_date,
                	'month'    	    =>$mntyr[1],
                	'year'          =>$mntyr[0],
                	'rent'   	    =>$cust['room_rent'],
            	);
            	$id=$this->general_model->setroom_trans($data);
            }
            $msg="Room Transaction Saved";
            redirect('admin/admin/view_trans');
        }
        
    }
	
	public function room_trans(){
        $this->form_validation->set_rules('room_id', 'Room Number', 'required');
        $this->form_validation->set_rules('cust_id', 'Customer Id', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['cust_list']=$this->general_model->getcusts();
        	$data['room_list']=$this->general_model->getrooms();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/room/room_trans',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
        	$mntyr=explode("-",$this->input->post('mnth_yr'));
            $data=array(									
                'room_id'       =>$this->input->post('room_id'),
                'cust_id'       =>$this->input->post('cust_id'),
                'rec_no'        =>$this->input->post('rec_no'),
                'rec_date' 	    =>$this->input->post('rec_date'),
                'month'    	    =>$mntyr[1],
            	'year'          =>$mntyr[0],
                'rent'   	    =>$this->input->post('rent'),
                'rent_recv'    	=>$this->input->post('rent_recv'),
                'rent_recvdt' 	=>$this->input->post('rent_recvdt'),
                'instru_no' 	=>$this->input->post('instru_no'),
                'instru_date'   =>$this->input->post('instru_date'),
            );
            $id=$this->general_model->setroom_trans($data);
            $msg="Room Transaction Saved";
            redirect('admin/admin/view_trans');
        }
        
    }

    public function edit_trans($id){
        $this->form_validation->set_rules('room_id', 'Room Number', 'required');
        $this->form_validation->set_rules('cust_id', 'Customer Id', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['trans']=$this->general_model->getroom_transsById($id);
        	$data['cust_list']=$this->general_model->getcusts();
        	$data['room_list']=$this->general_model->getrooms();
        	$data['id'] = $id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/room/edit_trans',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
        	$mntyr=explode("-",$this->input->post('mnth_yr'));
            $data=array(
                'id'            =>$id,
                'room_id'       =>$this->input->post('room_id'),
                'cust_id'       =>$this->input->post('cust_id'),
                'rec_no'        =>$this->input->post('rec_no'),
                'rec_date' 	    =>$this->input->post('rec_date'),
                'month'    	    =>$mntyr[1],
            	'year'          =>$mntyr[0],
                'rent'   	    =>$this->input->post('rent'),
                'rent_recv'    	=>$this->input->post('rent_recv'),
                'rent_recvdt' 	=>$this->input->post('rent_recvdt'),
                'instru_no' 	=>$this->input->post('instru_no'),
                'instru_date'   =>$this->input->post('instru_date'),
            );
            $id=$this->general_model->setroom_trans($data);
            $msg="Room Transaction Updated";
            redirect('admin/admin/view_trans');
        }
        
    }

	public function view_trans(){
        $data['trans_list']=$this->general_model->getroom_transs();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/room/view_trans',$data);
        $this->load->view('admin/layouts/admin_footer');
    }

	public function trans_filter(){
    	$serch=$this->input->post('serch');
    	$from=$this->input->post('from');
    	$to=$this->input->post('to');
    	$mntyr=explode("-",$this->input->post('mnth_yr'));
    	$this->db->select('*');
        $this->db->from('room_trans');
    	if($from!=""&&$to!=""){
        	$this->db->where("rec_date BETWEEN '$from' AND '$to'");
        }
    	if($this->input->post('mnth_yr')!=""){
        	$this->db->where('month', $mntyr[1]);
        	$this->db->where('year', $mntyr[0]);
        }
        $query = $this->db->get();
        $data['trans_list']=$query->result_array();  
    	$data['from']=$from;  
    	$data['to']=$to;
    	$data['mnth_yr']=$this->input->post('mnth_yr');
    	$data['temple_list']=$this->general_model->gettemples();
    	if($serch=="print"){
        	$this->load->view('admin/room/print_report',$data);
        }else{
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/room/view_trans',$data);
        	$this->load->view('admin/layouts/admin_footer');
        }
    }

	public function print_trans($id){
        $this->db->select('room_trans.*,room_dtl.room_no,room_dtl.door_no,room_cust.name,room_cust.agr_no,room_cust.agr_date');
        $this->db->from('room_trans');
    	$this->db->join('room_dtl','room_dtl.id = room_trans.room_id');
    	$this->db->join('room_cust','room_cust.id = room_trans.cust_id');
        $this->db->where("room_trans.id",$id);
        $query = $this->db->get();
        $data['trans_list']=$query->row_array();  
    	$data['temple_list']=$this->general_model->gettemples();
        $this->load->view('admin/room/print_trans',$data);
    }

    public function delete_trans($id){
        $result=$this->general_model->deleteroom_trans($id);
        $msg="Deleted";
        redirect('admin/admin/view_trans');
    }

	// room_cust
    
    public function add_cust(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['cust_list']=$this->general_model->getcusts();
        	$data['room_list']=$this->general_model->getrooms();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/room_cust/add_cust',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'        =>$this->input->post('name'),
                'mobile'      =>$this->input->post('mobile'),
                'door_no'     =>$this->input->post('door_no'),
                'address' 	  =>$this->input->post('address'),
                'post'    	  =>$this->input->post('post'),
                'place'   	  =>$this->input->post('place'),
                'dist'    	  =>$this->input->post('dist'),
                'pincode' 	  =>$this->input->post('pincode'),
                'id_type' 	  =>$this->input->post('id_type'),
                'id_no' 	  =>$this->input->post('id_no'),
                'rent_stdate' =>$this->input->post('rent_stdate'),
                'ag_period'   =>$this->input->post('ag_period'),
                'rent_due'    =>$this->input->post('rent_due'),
                'room_no'     =>$this->input->post('room_no'),
                'room_rent'   =>$this->input->post('room_rent'),
                'agr_no'      =>$this->input->post('agr_no'),
                'agr_date'    =>$this->input->post('agr_date'),
            );
            $id=$this->general_model->setcust($data);
            $msg="Room Customer Saved";
            $currentDate=date("Y-m-d");
            $n= $this->input->post('name')."/".$this->input->post('room_no'); 
        $this->db->query("INSERT INTO ledger(`name`,`name_mal`,`group`,`opening_bal`,`balance`,`created`) VALUES ('$n','$n','19','0','0','$currentDate')");
            $led_id = $this->db->insert_id();
            $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`) VALUES ('$led_id','0','9','Opening Balance','3','$currentDate','$currentDate')");
            redirect('admin/admin/view_cust');
        }
        
    }
    public function edit_cust($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['cust']=$this->general_model->getcustsById($id);
            $data['cust_list']=$this->general_model->getcusts();
        	$data['room_list']=$this->general_model->getrooms();
        	$data['id'] = $id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/room_cust/edit_cust',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'name'        =>$this->input->post('name'),
                'mobile'      =>$this->input->post('mobile'),
                'door_no'     =>$this->input->post('door_no'),
                'address' 	  =>$this->input->post('address'),
                'post'    	  =>$this->input->post('post'),
                'place'   	  =>$this->input->post('place'),
                'dist'    	  =>$this->input->post('dist'),
                'pincode' 	  =>$this->input->post('pincode'),
                'id_type' 	  =>$this->input->post('id_type'),
                'id_no' 	  =>$this->input->post('id_no'),
                'rent_stdate' =>$this->input->post('rent_stdate'),
                'ag_period'   =>$this->input->post('ag_period'),
                'rent_due'    =>$this->input->post('rent_due'),
                'room_no'     =>$this->input->post('room_no'),
                'room_rent'   =>$this->input->post('room_rent'),
                'agr_no'      =>$this->input->post('agr_no'),
                'agr_date'    =>$this->input->post('agr_date'),
            );
            $id=$this->general_model->setcust($data);
            $msg="Room Customer Updated";
            redirect('admin/admin/view_cust');
        }
        
    }

	public function view_cust(){
        $data['cust_list']=$this->general_model->getcusts();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/room_cust/view_cust',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function delete_cust($id){
        $result=$this->general_model->deletecust($id);
        $msg="Deleted";
        redirect('admin/admin/view_cust');
    }

	// receipt_book
    
    public function add_book(){
        $this->form_validation->set_rules('book_no', 'Number', 'required');
        $this->form_validation->set_rules('no_bills', 'No Of Bills', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['book_list']=$this->general_model->getbooks();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/book/add_book',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'book_no'     =>$this->input->post('book_no'),
                'from_sl'     =>$this->input->post('from_sl'),
                'to_sl'       =>$this->input->post('to_sl'),
                'no_bills' 	  =>$this->input->post('no_bills'),
                'remark'      =>$this->input->post('remark'),
            );
            $id=$this->general_model->setbook($data);
            $msg="Receipt Book Saved";
            redirect('admin/admin/add_book');
        }
        
    }
    public function edit_book($id){
        $this->form_validation->set_rules('book_no', 'Number', 'required');
        $this->form_validation->set_rules('no_bills', 'No Of Bills', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['book_list']=$this->general_model->getbooks();
            $data['book']=$this->general_model->getbooksById($id);
        	$data['id'] = $id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/book/edit_book',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'          =>$id,
                'book_no'     =>$this->input->post('book_no'),
                'from_sl'     =>$this->input->post('from_sl'),
                'to_sl'       =>$this->input->post('to_sl'),
                'no_bills' 	  =>$this->input->post('no_bills'),
                'remark'      =>$this->input->post('remark'),
            );
            $id=$this->general_model->setbook($data);
            $msg="Receipt Book Updated";
            redirect('admin/admin/add_book');
        }
        
    } 

    public function delete_book($id){
        $result=$this->general_model->deletebook($id);
        $msg="Deleted";
        redirect('admin/admin/add_book');
    }

	// book_issue
    
    public function book_issue(){
        $this->form_validation->set_rules('book_id', 'Book Id', 'required');
        $this->form_validation->set_rules('is_user', 'User', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['book_list']=$this->general_model->getbooks();
            $data['user_list']=$this->general_model->getusers();
            $data['issue_list']=$this->general_model->getissues();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/book/book_issue',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'issue_id'     =>$this->input->post('issue_id'),
                'issue_date'   =>$this->input->post('issue_date'),
                'book_id'      =>$this->input->post('book_id'),
                'from_sl' 	   =>$this->input->post('from_sl'),
                'to_sl'        =>$this->input->post('to_sl'),
                'nos'          =>$this->input->post('no_bills'),
                'is_user'      =>$this->input->post('is_user'),
                'book_status'  =>$this->input->post('book_status'),
            );
            $id=$this->general_model->setissue($data);
            $msg="Receipt Book Saved";
            redirect('admin/admin/book_issue');
        }
        
    }

    public function edit_issue($id){
        $this->form_validation->set_rules('book_id', 'Book Id', 'required');
        $this->form_validation->set_rules('is_user', 'User', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['book_list']=$this->general_model->getbooks();
            $data['user_list']=$this->general_model->getusers();
            $data['issue_list']=$this->general_model->getissues();
            $data['issue']=$this->general_model->getissuesByid($id);
        	$data['id'] = $id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/book/edit_issue',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'id'           =>$id,
                'issue_id'     =>$this->input->post('issue_id'),
                'issue_date'   =>$this->input->post('issue_date'),
                'book_id'      =>$this->input->post('book_id'),
                'from_sl' 	   =>$this->input->post('from_sl'),
                'to_sl'        =>$this->input->post('to_sl'),
                'nos'          =>$this->input->post('no_bills'),
                'is_user'      =>$this->input->post('is_user'),
            );
            $id=$this->general_model->setissue($data);
            $msg="Receipt Book Saved";
            redirect('admin/admin/book_issue');
        }
        
    }

    public function delete_book_issue($id){
        $result=$this->general_model->deletebookissue($id);
        $msg="Deleted";
        redirect('admin/admin/book_issue');
    }
    
    function getbookdtl() {
        $book_id = $this->input->get('book_id');
        $data = array();
        $data = $this->general_model->getbooksById($book_id);
        echo json_encode($data);
    }
    
    function checkduplicate() {
        $book_no = $this->input->get('book_no');
        $book_list=$this->general_model->getbooks();
        foreach ($book_list as $book){
            $numbers[]=$book['book_no'];
        }
        if (in_array($book_no, $numbers)){
            $data ='1';
        }else{
            $data ='0';
        }
        echo json_encode($data);
    }
    
    function checkduplicateissue() {
        $issue_id = $this->input->get('issue_id');
        $issue_list=$this->general_model->getissues();
        foreach ($issue_list as $issue){
            $numbers[]=$issue['issue_id'];
        }
        if (in_array($issue_id, $numbers)){
            $data ='1';
        }else{
            $data ='0';
        }
        echo json_encode($data);
    }

// for family pooja
// 
public function familypooja(){
        $counter = $this->session->userdata("counter");  
        if($counter == ''){
            $data['counter_list']=$this->general_model->getcounters();
            $this->load->view('admin/layouts/admin_header');  
            $this->load->view('admin/billing/selectcounter',$data);
            $this->load->view('admin/layouts/admin_footer');
            return;
        }
        $this->form_validation->set_rules('date', 'Date', 'required');
        $today = date('Y-m-d');
        $query=$this->db->query("SELECT sum(billing.recv_amt) as total,sum(billing.bal_amt) as totalcre FROM `billing` WHERE billing.date='$today' AND billing.deleted!='1'");
    //print "SELECT sum(qlt*rate) as total FROM `billing_dtls` JOIN billing on billing_dtls.bill_id=billing.id WHERE billing.date='$today'";
        $collection = $query->row();
        $data['totalcollection'] = $collection->total; 
        $data['totalcredit'] = $collection->totalcre; 
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $user_id=$this->loggedIn['id'];
            $last_book=$this->general_model->getlastusedbook($user_id);
            $last_bookid=$last_book['book_issue_id'];
            if($last_bookid==""){
                $book=$this->general_model->getlastbook($user_id);
                if(isset($book)){
                    $last_bookid=$book['book_id'];
                }
            }
            $last=$this->general_model->getlasbillid();
            $last_id=$last['id'];
            $last_id1=$last_id+1;
            $this->db->query("ALTER TABLE billing AUTO_INCREMENT=$last_id1");
            $data['book_list']=$this->general_model->getissuebooks($user_id);
        	$data['fpooja_list']=$this->general_model->getFpooja();
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['site']=$this->general_model->getsite();
            $data['last_id']=$last_id1;
            $data['last_bookid']=$last_bookid;
           
           // to check if code based billing or other 
            $query = $this->db->query("select * from site_settings where id =1"); 
            $row = $query->row();
            
            $this->load->view('admin/layouts/admin_header');  
           if($row->code_settings=='1'){ 
               $this->load->view('admin/billing/billing',$data);
           }else {
               $this->load->view('admin/billing/billing',$data);}
               $this->load->view('admin/layouts/admin_footer');
        }else{
      
            $this->db->trans_begin();
        
            $user_id=$this->loggedIn['id'];
            $diety=$this->input->post('temple');
            $date=$this->input->post('date');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $times=$this->input->post('time');
            $mode=$this->input->post('mode');
            $date1=$this->input->post('date1');
            $book_id=$this->input->post('book_id');
            $bill_time=date("Y-m-d H:i:s"); 
            $last_book=$this->general_model->getlastusedbook($user_id);
            $last_bookid=$last_book['book_issue_id'];
            if($last_bookid!=""&&$last_bookid!=$book_id){
                $this->db->query("UPDATE receipt_bookdtl SET book_status='Compleated' WHERE id='$last_bookid'");
            }
            $this->db->query("UPDATE receipt_bookdtl SET book_status='Active' WHERE id='$book_id'");
            $this->db->query("INSERT INTO billing(`diety_id`,`date`,`place`,`user_id`,`status`,`mode`,`bill_time`,`counter`,`book_issue_id`) VALUES ('$diety[0]','$date','---','$user_id', '1','$mode','$bill_time','$counter','$book_id')");
            
        $bill_id=$this->db->insert_id();
            $i=0;$total=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $amou=$amt[$i];
                $rata=$rate[$i];
                $time=$times[$i];
                $data=$date1[$i];
            $total+=$amou;
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1')");
         // 
            if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
                $i++;
            }
        
           $this->db->query("UPDATE billing SET total='$total',recv_amt='$total' WHERE id='$bill_id'");
            $this->db->trans_complete();
        
             if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
             }
             else{
                 $this->db->trans_commit();
             }
        //$_POST = array(); 
          //$this->db->query("UPDATE billing SET total='$total' WHERE id='$bill_id'");
            if($this->input->post('save')=="save"){
                redirect('admin/admin/billing');
            }elseif($this->input->post('save')=="print"){
                 $counter = $this->session->userdata("counter");
                 $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                 $result = $till->row_array();
                 $printer = $result['printer'];
                 if ($_SERVER['HTTP_HOST'] == "sreevyramahakalikavukshethramkarad.in") {
                     redirect('admin/admin/dmbill_print/'.$bill_id);
                 }
                 // else if($row->print_settings == 1){ 
                 else if($printer == 1){ 
                     redirect('admin/admin/dmbill_print/'.$bill_id);
                 }
                 else if($printer == 2){ 
                    
                     redirect('admin/admin/bill_print/'.$bill_id);
                 }
                 else if($printer == 3){ 
                     redirect('admin/admin/receipt_print/'.$bill_id);
                 }
                 else{
                     redirect('admin/admin/bill_print/'.$bill_id);
                 }
            }
        }
    }


/**public function edit_bill($id){
        $this->form_validation->set_rules('date', 'Date', 'required');
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['site']=$this->general_model->getsite();
            $data['bill_list']=$this->general_model->getbillingById($id);
            $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
            $data['bill_id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/edit_billing',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $this->db->trans_begin();
            $user_id=$this->loggedIn['id'];
            $diety=$this->input->post('temple');
            $date=$this->input->post('date');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $times=$this->input->post('time');
            $mode=$this->input->post('mode');
            $date1=$this->input->post('date1');
            $optradio=$this->input->post('optradio');
            $bill_time=date("Y-m-d H:i:s"); 
            $this->db->query("UPDATE billing SET `date`='$date',`mode`='$mode' WHERE id='$id'");
            $bill_id=$id;
            $this->db->query("DELETE FROM billing_dtls WHERE bill_id='$bill_id'");
            $i=0;$total=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $amou=$amt[$i];
                $rata=$rate[$i];
                $time=$times[$i];
                $data=$date1[$i];
                $total+=$amou;
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
                $i++;
            }
        
            if($optradio==1){
                $this->db->query("UPDATE billing SET total='$total',recv_amt='$total' WHERE id='$bill_id'");
            }else{
                $this->db->query("UPDATE billing SET total='$total',recv_amt='0',bal_amt='$total' WHERE id='$bill_id'");
            }
            $this->db->trans_complete();
        
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
            }
            redirect('admin/admin/billing_view/1');
        }
    }
    */

/**public function edit_bill($id){
        $this->form_validation->set_rules('date', 'Date', 'required');
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['site']=$this->general_model->getsite();
            $data['bill_list']=$this->general_model->getbillingById($id);
            $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
            $data['bill_id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/edit_billing',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $this->db->trans_begin();
            $user_id=$this->loggedIn['id'];
            $diety=$this->input->post('temple');
            $date=$this->input->post('date');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
            $pooja=$this->input->post('pooja');
            $qlt=$this->input->post('qlt');
            $rate=$this->input->post('rate');
            $amt=$this->input->post('amt');
            $times=$this->input->post('time');
            $mode=$this->input->post('mode');
            $date1=$this->input->post('date1');
            $optradio=$this->input->post('optradio');
            $bill_time=date("Y-m-d H:i:s"); 
            $this->db->query("UPDATE billing SET `date`='$date',`mode`='$mode' WHERE id='$id'");
            $bill_id=$id;
            $this->db->query("DELETE FROM billing_dtls WHERE bill_id='$bill_id'");
            $i=0;$total=0;
            while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $amou=$amt[$i];
                $rata=$rate[$i];
                $time=$times[$i];
                $data=$date1[$i];
                $total+=$amou;
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
                $i++;
            }
        
            if($optradio==1){
                $this->db->query("UPDATE billing SET total='$total',recv_amt='$total' WHERE id='$bill_id'");
            }else{
                $this->db->query("UPDATE billing SET total='$total',recv_amt='0',bal_amt='$total' WHERE id='$bill_id'");
            }
            $this->db->trans_complete();
        
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
            }
            redirect('admin/admin/billing_view/1');
        }
    }**/
public function edit_bill($id)
{ 
		ob_start();
        $this->form_validation->set_rules('date', 'Date', 'required');
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['site']=$this->general_model->getsite();

            $data['bill_list']=$this->general_model->getbillingById($id);
            $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
            $data['bill_id']  = $id;
        	$customer_id      = $this->db->where('id', $id)->get('billing')->row()->customer_id ?? 0;
        	$data['customer'] = $this->general_model->getcustomersById($customer_id);
			if($this->db->table_exists('payment_modes')) {
            	$payment_modes = $this->db->get('payment_modes')->result_array();
            } else {
            	$payment_modes = array(
  					array('id' => '1','name' => 'Cash','slug' => 'cash'),
  					array('id' => '5','name' => 'NEFT','slug' => 'neft'),
  					array('id' => '6','name' => 'QR Code','slug' => 'qr_code'),
  					array('id' => '7','name' => 'Card','slug' => 'card'),
  					array('id' => '8','name' => 'MO','slug' => 'mo'),
  					array('id' => '10','name' => 'Endowment','slug' => 'endowment'),
  					array('id' => '11','name' => 'Cheaque','slug' => 'Cheaque'),
  					array('id' => '12','name' => 'DD','slug' => 'DD')
			    );
            }
        
        	$data['payment_modes'] = $payment_modes;
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/edit_bill',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $this->db->trans_begin();
            $user_id=$this->loggedIn['id'];
        
        	$customer_details = $this->input->post('customer_details');
        
        	if($customer_details && is_array($customer_details)) {
            	
            	$customer = $this->db->where('id', $customer_details['id'])->get('user_dtl')->row();
            
            	$mobile   = $customer->mobile;
            
            	if($mobile != $customer_details['mobile'] && $this->isCustomerExists($customer_details['mobile'])) {
					$this->session->set_flashdata('mobile_error', 'Mobile number '.$customer_details['mobile'].' is taken!');
            		redirect('admin/admin/edit_bill/'.$id);
            	}
            
        		$customer_data = array(
                	'name'      =>$customer_details['name'],
                	'house'     =>$customer_details['house'],
                	'street'    =>$customer_details['street'],
                	'post'      =>$customer_details['post'],
                	'district' 	=>$customer_details['district'],
                	'state'     =>$customer_details['state'],
                	'pincode'   =>$customer_details['pincode'],
                	'mobile'    =>$customer_details['mobile'],
                	'email'   	=>$customer_details['email']
                
            	);
            
            	if($this->db->table_exists('memberships')) {
            		$this->db->select('memberships.*');
            		$this->db->from('memberships');
            		$this->db->join('user_dtl', 'memberships.mobile_number=user_dtl.mobile');
            		$this->db->join('membership_transactions', 'memberships.id=membership_transactions.membership_id');
            		$this->db->where('memberships.mobile_number',  $mobile);
            		$this->db->where('membership_transactions.bill_id', $id);
            		$query = $this->db->get();
                	
                	if($query->num_rows() > 0) {
                    	$membership_id = $query->row()->id;
                    	$this->db->where('id', $membership_id);
                    	$this->db->update('memberships', array(
                    		'mobile_number'=> $customer_details['mobile'],
                    		'name'=>	$customer_details['name']
                    	));
                    }
            
            		
                }
            
            	$this->db->where('id', $customer_details['id']);
        		$this->db->update('user_dtl',    $customer_data);
            
            	
            }
        
            $date=$this->input->post('date');
            $name=$this->input->post('name');
            $star=$this->input->post('star');
			$gothram=$this->input->post('gothram');
         //   $pooja=$this->input->post('pooja');
         //   $qlt=$this->input->post('qlt');
          //  $rate=$this->input->post('rate');
          //  $amt=$this->input->post('amt');
            $times=$this->input->post('time');
            $mode=$this->input->post('mode');
            $date1=$this->input->post('date1');
            $bt=$this->input->post('bt');
        //print_r($_REQUEST);exit
           // $optradio=$this->input->post('optradio');
           // $bill_time=date("Y-m-d H:i:s"); 
          //  $this->db->query("UPDATE billing SET `date`='$date',`mode`='$mode' WHERE id='$id'");
         //   $bill_id=$id;
          //  $this->db->query("DELETE FROM billing_dtls WHERE bill_id='$bill_id'");
            $i=0;$total=0;
        //print "UPDATE billing SET `mode`='$mode' WHERE id='$id'";exit;
       		$this->db->query("UPDATE billing SET `mode`='$mode' WHERE id='$id'");
            while ($i<=sizeof($name)){
                $nama=$name[$i];
                $ster=$star[$i];
              	$time=$times[$i];
                $data=$date1[$i];
			$gothram=$gothram[$i];
                $id1=$bt[$i];
                $total+=$amou;
            if ($this->db->field_exists('gothram', 'billing_dtls'))
			  {
				$this->db->query("UPDATE billing_dtls SET `name`='$nama',`star`='$ster',`date`='$data',`time`='$time',gothram='$gothram' WHERE id='$id1'");  
			  }
			  else
			  {
			  $this->db->query("UPDATE billing_dtls SET `name`='$nama',`star`='$ster',`date`='$data',`time`='$time' WHERE id='$id1'");
			  }
           	// $this->db->query("UPDATE billing SET `mode`='$mode' WHERE id='$id'");
             // $this->db->query("UPDATE billing_dtls SET `name`='$nama',`star`='$ster',`date`='$data',`time`='$time',gothram='$gothram' WHERE id='$id1'");
           // print "UPDATE billing_dtls SET `name`='$nama',`star`='$ster',`date`='$data',`time`='$time' WHERE id='$id1'";exit;
               
            $i++;
            }
        
        	
           // if($optradio==1){
             //   $this->db->query("UPDATE billing SET total='$total',recv_amt='$total' WHERE id='$bill_id'");
           // }else{
        //        $this->db->query("UPDATE billing SET total='$total',recv_amt='0',bal_amt='$total' WHERE id='$bill_id'");
            
            $this->db->trans_complete();
        
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
            }
            redirect('admin/admin/billing_view');
        }
}
public function edit_mode($id){
        $this->form_validation->set_rules('date', 'Date', 'required');
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $data['pooja_list']=$this->general_model->getpoojas();
            $data['birth_star']=$this->general_model->getstars();
            $data['temple_diety_list']=$this->general_model->getdietys();
            $data['site']=$this->general_model->getsite();
            $data['bill_list']=$this->general_model->getbillingById($id);
            $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
            $data['bill_id']=$id;
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/edit_billing_mode',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $this->db->trans_begin();
            $user_id=$this->loggedIn['id'];
           // $diety=$this->input->post('temple');
           // $date=$this->input->post('date');
          // $name=$this->input->post('name');
          //  $star=$this->input->post('star');
          //  $pooja=$this->input->post('pooja');
          //  $qlt=$this->input->post('qlt');
          //  $rate=$this->input->post('rate');
           // $amt=$this->input->post('amt');
          //  $times=$this->input->post('time');
            $mode=$this->input->post('mode');
          //  $date1=$this->input->post('date1');
        //    $optradio=$this->input->post('optradio');
          //  $bill_time=date("Y-m-d H:i:s"); 
            $this->db->query("UPDATE billing SET `mode`='$mode' WHERE id='$id'");
            $bill_id=$id;
            /**  $this->db->query("DELETE FROM billing_dtls WHERE bill_id='$bill_id'");
            $i=0;$total=0;
          while ($i<sizeof($name)){
                $nama=$name[$i];
                $dety=$diety[$i];
                $ster=$star[$i];
                $poja=$pooja[$i];
                $qult=$qlt[$i];
                $amou=$amt[$i];
                $rata=$rate[$i];
                $time=$times[$i];
                $data=$date1[$i];
                $total+=$amou;
                $this->db->query("INSERT INTO billing_dtls(`bill_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`time`,`rate`,`amount`,`date`,`status`) VALUES ('$bill_id','$nama','$dety','$ster','$poja','$qult','$time','$rata','$amou','$data', '1')");
                if ($poja=="2000"){
                    $this->db->query("UPDATE mookkolakkallu SET date='$data' WHERE id='1'");
                }
                $i++;
            }
        
            if($optradio==1){
                $this->db->query("UPDATE billing SET total='$total',recv_amt='$total' WHERE id='$bill_id'");
            }else{
                $this->db->query("UPDATE billing SET total='$total',recv_amt='0',bal_amt='$total' WHERE id='$bill_id'");
            }
            */
            $this->db->trans_complete();
        
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
            }
            redirect('admin/admin/billing_view/1');
        }
    }

/**function getPoojaById(){
          $pooja = $this->input->post('pooja');
          $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
           $this->db->from('diety_pooja');
           $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
           $this->db->join('diety','diety.id = diety_pooja.temple_id');
           $this->db->where('pooja.id', $pooja);
           $query = $this->db->get();
            
        if ($query->num_rows() > 0) {
            $pooja_data = $query->row_array();
            $response = array("code"=>$pooja_data['code'], "diety"=>$pooja_data['temple_id'],"pooja_id"=>$pooja_data['pooja_id'],"pooja"=>$pooja_data['pooja'],"pooja_mal"=>$pooja_data['pooja_mal'] ,"rate"=> $pooja_data['pooja_rt'],"rowcount"=> $pooja_data['rowcount']);
            echo json_encode($response);
        }
    }**/
 function getPoojaById(){
          $pooja = $this->input->post('pooja');
           
 		   if($this->db->table_exists('custom_bookings_poojas')) {
           		$this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.time,pooja.rate as pooja_rt,diety.name_mal as diety_mal, custom_bookings_poojas.custom_form_template as template, custom_bookings_poojas.id as custom_booking');
           } else {
           		$this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rowcount,pooja.time,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
           }
           $this->db->from('diety_pooja');
           $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
           $this->db->join('diety','diety.id = diety_pooja.temple_id');
 
 		   if($this->db->table_exists('custom_bookings_poojas')) {
           		$this->db->join('custom_bookings_poojas','custom_bookings_poojas.pooja_id = pooja.id', 'left');
           }
 
           $this->db->where('pooja.id', $pooja);
           $query = $this->db->get();
            
        if ($query->num_rows() > 0) {
            $pooja_data = $query->row_array();
            $response = array("code"=>$pooja_data['code'], "diety"=>$pooja_data['temple_id'],"pooja_id"=>$pooja_data['pooja_id'],"pooja"=>$pooja_data['pooja'],"pooja_mal"=>$pooja_data['pooja_mal'] ,"rate"=> $pooja_data['pooja_rt'],"rowcount"=> $pooja_data['rowcount'],"time"=> $pooja_data['time']);
        	
        	if($this->db->table_exists('custom_bookings_poojas')) {
           		$response['template'] = $pooja_data['template'];
            	$response['custom_booking'] = $pooja_data['custom_booking'];
            }
            echo json_encode($response);
        }
    }
/**public function getPoojaByCodeNameDietyforbilling(){
        $diety=$this->input->post('diety');
        $keyword=$this->input->post('search');
    
           $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
           $this->db->from('diety_pooja');
           $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
           $this->db->join('diety','diety.id = diety_pooja.temple_id');
           if($diety){
              $this->db->where('diety_pooja.temple_id', $diety);
              $this->db->like('pooja.name', $keyword,'after');
              $this->db->or_where('diety_pooja.code', $keyword);
           }
           else{
              $this->db->like('pooja.name', $keyword,'after');
              $this->db->or_where('diety_pooja.code', $keyword);
           }
           $query = $this->db->get();
            //print_r($this->db->last_query());
        if ($query->num_rows() > 0) {
            $poojas = $query->result_array();
            $response = array();
            foreach($poojas as $pooja){
               $response[] = array("id"=>$pooja['pooja_id'], "value"=>$pooja['pooja_mal'].' ( '.$pooja['diety_mal'].' ) ~ '.$pooja['code'],"label"=>$pooja['code'].' | '.$pooja['pooja_mal'].' ( '.$pooja['diety_mal'].' ) ');
            }
            echo json_encode($response);
        }
        
    }
**/

public function getPoojaByCodeNameDietyforbilling(){
        $diety=$this->input->post('diety');
        $keyword=$this->input->post('search');

           $this->db->select('diety_pooja.*,pooja.code as code,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,diety.name_mal as diety_mal, diety.name as diety');
           $this->db->from('diety_pooja');
           $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
           $this->db->join('diety','diety.id = diety_pooja.temple_id');
		   $this->db->like('pooja.name', $keyword,'after');
           $this->db->or_where('pooja.code', $keyword);
		   if($diety){
              $this->db->where('diety_pooja.temple_id', $diety);
           }
		   $this->db->order_by('diety.order_', 'asc');
           $query = $this->db->get();
            //print_r($this->db->last_query());
        if ($query->num_rows() > 0) {
            $poojas = $query->result_array();
            $response = array();
            foreach($poojas as $pooja){
               $response[] = array("id"=>$pooja['pooja_id'], "value"=>$pooja['pooja_mal'].' ( '.$pooja['diety_mal'].' ) ~ '.$pooja['code'],"label"=>$pooja['code'].' | '.$pooja['pooja'].' - '.$pooja['pooja_mal'].' ( '.$pooja['diety'].' ) ');
            }
            echo json_encode($response);
        }
        
    }
public function getstarByCodeDietyletter(){
        $keyword=$this->input->post('search');

        $this->db->select('*');
        $this->db->from('stars');
        $this->db->like('name_eng', $keyword,'after');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        if ($query->num_rows() > 0) {
            $pooja_data = $query->result_array();
            $response = array();
            foreach($pooja_data as $pooja){
                $response[] = array("id"=>$pooja['id'],"value"=>$pooja['name_eng'].' - '.$pooja['name_mal'],"label"=>$pooja['name_eng'].' - '.$pooja['name_mal'],"star"=>$pooja['name_eng'].' - '.$pooja['name_mal']);
            }
            echo json_encode($response);
        }
    }
public function pdfview($id){
   
 // $this->load->library('M_pdf');
   //$mpdf=new mPDF();
   
      // $html = $this->load->view('GeneratePdfView', [], true);
       
		//$datas   =   array("list" => $list,"headList" => $headList);
		
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
        $bill_id=$id;
//adjustment 
$data['adjustment'] = [];
    
    	if($this->db->field_exists('bill_id', 'adjustment')) {
    	$this->db->select('id');
    	$this->db->from('adjustment');
    	$this->db->where('bill_id', $id);
    	$query = $this->db->get();
    	//ends here
    	$data['adjustment'] = [];
    	if ($this->session->userdata('adj_ids')) {
        	$ids = $this->session->userdata('adj_ids');
        	foreach($ids as $adjustment_id) {
            	$data['adjustment'][] = $this->general_model->getadjustmentById($adjustment_id)[0];
            }
        } else if($query->num_rows() > 0) {
        	$ids = $query->result();
        
        	foreach($ids as $adjustment_id) {
            	$aid = $adjustment_id->id;
            	$data['adjustment'][] = $this->general_model->getadjustmentById($aid)[0];
            }
        }
        }
    //ends here
        if ($_SERVER['HTTP_HOST'] == "sreevyramahakalikavukshethramkarad.in") {
             $this->load->view('admin/billing/vayira_dmbill_print',$data);
        }
        else if($_SERVER['HTTP_HOST'] == "nhangattiribhagavathydevsawom.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "kodikkunnubhagavathi.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
            //    $html= $this->load->view('admin/billing/bill_print_nhangattiri_pdf',$data);
             //$html = $this->load->view('monthlypdfReport', $datas , true);
		
            // $this->pdf->createPDF($html, 'mypdf');
             //$mpdf->WriteHTML($html);
        //$mpdf->Output();
     
$mpdf = new \Mpdf\Mpdf(['autoLangToFont' => true]);
                
                 $html = $this->load->view('admin/billing/bill_print_nhangattiri_pdf', $data, true);
$mpdf->WriteHTML($html);
             $fname=$id.".pdf";
$mpdf->Output($fname,'D');  
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
             /*       //$this->load->view('admin/billing/bill_print_nhangattiri_pdf',$data);
                 $html = $this->load->view('admin/billing/bill_print_nhangattiri_pdf', $data, true);
                //echo $html;exit;
             $mpdf->pdf->WriteHTML($html);
        $mpdf->pdf->Output(); */
               
   
   
        
           // $this->load->library('M_pdf');  
           //
          // $html = '<html><body><p>Hello</p></body></html>';
               
            //$this->m_pdf->pdf->WriteHTML('Hello');
           // $this->m_pdf->pdf->Output('bill.pdf','D');  
          

$mpdf = new \Mpdf\Mpdf(['autoLangToFont' => true]);
                
                 $html = $this->load->view('admin/billing/bill_print_nhangattiri_pdf', $data, true);
              //  print $html;exit;
$mpdf->WriteHTML($html);
  $fname=$id.".pdf";
$mpdf->Output($fname,'D');  
           
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/n_dmprint',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "kovoorvishnutemple.com"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 1){
                    $this->load->view('admin/billing/koovoor_dmbill_print',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
             }
        }
     else if($_SERVER['HTTP_HOST'] == "sreevayambattavishnutemple.in"){
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_nhangattiri',$data);
             }
        
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 2){
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
                }
                else if($printer == 3){ 
                   $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                    $this->load->view('admin/billing/bill_print_nhangattiri',$data);
              
                }
             }
        }
        else{
             $counter = $this->session->userdata("counter");
             if($counter == ''){
                 $this->load->view('admin/billing/bill_print_tali',$data);
             }
             else{
                $till = $this->db->select('printer')->from('counter')->where('id',$counter)->get();
                $result = $till->row_array();
                $printer = $result['printer'];
                if($printer == 3){ 
                    $this->load->view('admin/billing/receiptprint',$data);
                }
                else{
                   $this->load->view('admin/billing/bill_print_tali',$data);
                }
    }}} 
public function search_bill()
    {
        $id = $this->input->post('bill_no');
        $data['pooja_list']=$this->general_model->getpoojas();
        $data['birth_star']=$this->general_model->getstars();
        $data['temple_diety_list']=$this->general_model->getdietys();
        $data['site']=$this->general_model->getsite();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['mode']=$this->Accounts_model->getmode();

        $data['bill_id']=$id;
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/billing/edit_billing',$data);
        $this->load->view('admin/layouts/admin_footer');
    }

public function view_cat(){
    $id=$this->input->post('id');
    $result=$this->general_model->getcatById($id);
    echo json_encode($result);
}


/**function translatetext(){
    $inputText = $this->input->post('search');
    $curlSession = curl_init(); 
  curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ml&dt=t&q='.urlencode($text));
     curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
     curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
     $response = curl_exec($curlSession);
     $jsonData = json_decode($response);
     curl_close($curlSession);

     if(isset($jsonData[0][0][0])){
     		$response = array("name"=>$jsonData[0][0][0]);
             echo json_encode($response);
     }else{
         echo false;
     }

	//$suggestions = $this->fetchSuggestions($inputText, $curlSession);
	
	//curl_close($curlSession);
	//echo json_encode($suggestions);
}*/

function translatetext(){
    $text = $this->input->post('search');
    $curlSession = curl_init(); 
    curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ml&dt=t&q='.urlencode($text));
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curlSession);
    $jsonData = json_decode($response);
    curl_close($curlSession);

	$site = $this->general_model->getsite();

    if(isset($jsonData[0][0][0])){
    		if ($this->db->field_exists('need_translation', 'site_settings') && $site[0]['need_translation'] == 0) {
            	$name = $text;
            } else {
            	$name = $jsonData[0][0][0];
            }
    		$response = array("name"=> $name);
            echo json_encode($response);
    }else{
        echo false;
    }
}

function translatetext_tamil(){
    $text = $this->input->post('search');
    $curlSession = curl_init(); 
    curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ta&dt=t&q='.urlencode($text));
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curlSession);
    $jsonData = json_decode($response);
    curl_close($curlSession);

	$site = $this->general_model->getsite();

    if(isset($jsonData[0][0][0])){
    		if ($this->db->field_exists('need_translation', 'site_settings') && $site[0]['need_translation'] == 0) {
            	$name = $text;
            } else {
            	$name = $jsonData[0][0][0];
            }
    		$response = array("name"=> $name);
            echo json_encode($response);
    }else{
        echo false;
    }
}
function fetchSuggestions($text, $curlSession) {
    
    // curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ml&dt=t&q=' . urlencode($text));
   	curl_setopt($curlSession, CURLOPT_URL, 'https://inputtools.google.com/request?text='. urlencode($text) .'&itc=ml-t-i0-und&num=13&cp=0&cs=1&ie=utf-8&oe=utf-8&app=demopage');
	curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curlSession);
	
    if ($response) {
        $result = json_decode($response);

        if (isset($result[0]) && is_array($result[1])) {
            $suggestions = [];
            foreach ($result[1][0][1] as $translation) {
                $suggestions[] = $translation;
            }
            return $suggestions;
        }
    }

    return [];
}


public function bill_summary_bytime($ids=null){
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        $data['temple_list']=$this->general_model->gettemples();
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['time']=null;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getbillsummarybytime($from,$to,$diety,$type);
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/summarybytime',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
            $time=$this->input->post('time');

            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getbillsummarybytime($from,$to,$diety,$type,$time);
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/summarybytime',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $this->load->view('admin/billing/summarybytime_print',$data);
            }
        }
    }
// for puravaka reports 
    public function detail_view_cat($ids=null){
        $this->form_validation->set_rules('from', 'Date From', 'required');
        $this->form_validation->set_rules('to', 'Date To', 'required');
        $this->form_validation->set_rules('diety', 'Diety', 'required');
        if ($this->form_validation->run() === FALSE){
            $from=date('Y-m-d');
            $to=date('Y-m-d');
            $diety="0";
            $type=$ids;
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getdetailview_cat($from,$to,$diety,$type);
            $data['diety_list']=$this->general_model->getdietys();            
            $data['categories']=$this->general_model->get_poojas_by_category();
        
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pooja/detail_view',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $from=$this->input->post('from');
            $to=$this->input->post('to');
            $diety=$this->input->post('diety');
            $type=$this->input->post('type');
            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getdetailview($from,$to,$diety,$type);
            $data['categories']=$this->general_model->get_poojas_by_category();
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/pooja/detail_view',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/pooja/detail_view_print',$data);
            }
        }
    }



	    public function room_enquiries(){
        if ($this->input->post('button')=="search"){
            $datef=$this->input->post('keyword');
            $datet=$this->input->post('datet');
            if ($datef==""){
                $data['enquiry_list']=$this->general_model->getroomenquiries();
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/customer/room_enquiries',$data);
                $this->load->view('admin/layouts/admin_footer');
            }else{
                $data['enquiry_list']=$this->general_model->getroomenquiriesbydate($datef,$datet);
                $data['date']=$datef;
                $data['datet']=$datet;
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/customer/room_enquiries',$data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }elseif ($this->input->post('button')=="print"){
            $datef=$this->input->post('keyword');
            $datet=$this->input->post('datet');
            if ($datef==""){
                $data['enquiry_list']=$this->general_model->getroomenquiries();
                $this->load->view('admin/customer/cust_print',$data);
            }else{
                $data['enquiry_list']=$this->general_model->getroomenquiriesbydate($datef,$datet);
                $this->load->view('admin/customer/cust_print',$data);
            }
        }else{
            $data['enquiry_list']=$this->general_model->getroomenquiries();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/room_enquiries',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
}


