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
        $this->loggedIn=$this->session->admin;
        $this->amount = $this->site_model->billing_online($this->session->refno);
    }
    // Dashboard
    public function index(){
        redirect('admin/admin/dashboard');
    }
    public function dashboard(){
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
            $data['pooja_list']=$this->general_model->getpoojas();
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
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pooja/pooja_add');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
                'name_mal'  =>$this->input->post('name_mal'),
                'rate'      =>$this->input->post('rate'),
                'code'      =>$this->input->post('code'),
                'allowed_qty'      =>$this->input->post('quantity'),
                'status'    =>'1',
            );
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
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pooja/pooja_edit',$data);
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            $data=array(
                'id'           =>$id,
                'name'         =>$this->input->post('name'),
                'name_mal'     =>$this->input->post('name_mal'),
                'rate'         =>$this->input->post('rate'),
                'code'         =>$this->input->post('code'),
                'allowed_qty'  =>$this->input->post('quantity'),
            );
            $id=$this->general_model->setpooja($data);
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
    //Customer
    
    public function add_customer(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('house', 'House', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('post', 'Post', 'required');
        $this->form_validation->set_rules('district', 'District', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/customer/customer_add');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $data=array(
                'name'      =>$this->input->post('name'),
                'house'      =>$this->input->post('house'),
                'street'      =>$this->input->post('street'),
                'post'      =>$this->input->post('post'),
                'district'      =>$this->input->post('district'),
                'state'      =>$this->input->post('state'),
                'pincode'      =>$this->input->post('pincode'),
                'mobile'     =>$this->input->post('phone'),
                'email'   =>$this->input->post('email'),
                'status'    =>'1',
            );
            $id=$this->general_model->setcustomer($data);
            $msg="Customer Saved";
            redirect('admin/admin/customer_view');
        }
        
    }
    public function edit_customer($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('house', 'House', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('post', 'Post', 'required');
        $this->form_validation->set_rules('district', 'District', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
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
        $data = $this->general_model->getallowedqty($pooja_id,$date,$qty);
        echo $data;
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
    
           $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
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
            $response = array("code"=>$pooja_data['code'], "diety"=>$pooja_data['temple_id'],"pooja_id"=>$pooja_data['pooja_id'],"pooja"=>$pooja_data['code'].' | '.$pooja_data['pooja_mal'].'<br /> ( '.$pooja_data['diety_mal'].' ) ',"rate"=> $pooja_data['pooja_rt']);
            echo json_encode($response);
        }
    }
    public function getPoojaByDietyPoojaCode(){
         $code=$this->input->get('data');
         $poojainfo = explode("~", $code);
         $diety_pooja_code = str_replace(' ', '', $poojainfo[1]);
         
         $this->db->select('diety_pooja.*,pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,diety.name_mal as diety_mal');
         $this->db->from('diety_pooja');
         $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
         $this->db->join('diety','diety.id = diety_pooja.temple_id');
         $this->db->where('diety_pooja.code', $diety_pooja_code);
         $query = $this->db->get();
         $response = array();
         if ($query->num_rows() > 0) {
            $pooja_data = $query->row_array();
            $response = array("code"=>$pooja_data['code'], "diety"=>$pooja_data['temple_id'],"pooja_id"=>$pooja_data['pooja_id'],"pooja"=>$pooja_data['code'].' | '.$pooja_data['pooja_mal'].'<br /> ( '.$pooja_data['diety_mal'].' ) ',"rate"=> $pooja_data['pooja_rt']);
         }
         echo json_encode($response);
    }
    public function billing(){
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
        $query=$this->db->query("SELECT sum(billing_dtls.amount) as total FROM `billing_dtls` JOIN billing on billing_dtls.bill_id=billing.id WHERE billing.date='$today' AND billing.deleted!='1'");
    //print "SELECT sum(qlt*rate) as total FROM `billing_dtls` JOIN billing on billing_dtls.bill_id=billing.id WHERE billing.date='$today'";
        $collection = $query->row();
        $data['totalcollection'] = $collection->total; 
        date_default_timezone_set("Asia/Calcutta");
        if ($this->form_validation->run() === FALSE){
            $user_id=$this->loggedIn['id'];
            $last_book=$this->general_model->getlastusedbook($user_id);
            $last_bookid=$last_book['book_issue_id'];
            if($last_bookid==""){
                $book=$this->general_model->getlastbook($user_id);
                $last_bookid=$book['book_id'];
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
               $this->load->view('admin/billing/billingnew',$data);
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
         redirect('admin/admin/billing');
    }
    public function bill_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
        $bill_id=$id;
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
    public function dmbill_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
         if ($_SERVER['HTTP_HOST'] == "sreevyramahakalikavukshethramkarad.in") {
            $this->load->view('admin/billing/vayira_dmbill_print',$data);
         }
         else{
             $this->load->view('admin/billing/dmprint',$data);
         }
    }
    public function receipt_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
        $this->load->view('admin/billing/receiptprint',$data);
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
    
    /**public function donation(){
       $this->form_validation->set_rules('date', 'Date', 'required');
     $this->form_validation->set_rules('name', 'NAme', 'required');
       $this->form_validation->set_rules('costname', 'costname', 'required');
        $this->form_validation->set_rules('house', 'house', 'required');
        $this->form_validation->set_rules('street', 'street', 'required');
        $this->form_validation->set_rules('post', 'post', 'required');
        $this->form_validation->set_rules('district', 'district', 'required');
        $this->form_validation->set_rules('state', 'state', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('pincode', 'pincode', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $a=$this->db->query("SELECT id From diety WHERE name='DONATION'");
        $diety_id=$a->row_array();
        //if ($this->form_validation->run() == FALSE){
        if(@$this->input->post('date')!="")
        {
       
            $data['pooja_list']=$this->general_model->getpoojasbydiety($diety_id['id']);
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
            $a2=$this->db->query("SELECT id From pooja WHERE name='GOLD'");
            $gold=$a2->row_array();
            $gold_id=$gold['id'];
            $a3=$this->db->query("SELECT id From pooja WHERE name='SILVER'");
            $silver=$a3->row_array();
            $silver_id=$silver['id'];
            $a4=$this->db->query("SELECT id From annotation WHERE name='GOLD'");
            $gold_=$a4->row_array();
            @$gold_an=$gold_['lst_id']+1;
            $a5=$this->db->query("SELECT id From annotation WHERE name='SILVER'");
            $silver_=$a5->row_array();
            @$silver_an=$silver_['lst_id']+1;
            $a6=$this->db->query("SELECT id From annotation WHERE name='OTHER'");
            $other_=$a3->row_array();
            @$other_an=$other_['lst_id']+1;
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
      // print "SELECT * FROM user_dtl WHERE name='$costname' AND mobile='$mobile' AND status='1'";exit;
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
                $qult=$qlt[$i];
                $data=$date1[$i];
                $unet=$unit[$i];
                $amot=$amt[$i];
                $rmrk=$remark[$i];
                if ($poja==$gold_id){
                    $annotation=$gold_an;
                    $this->db->query("UPDATE annotation SET lst_id='$annotation' WHERE name='GOLD'");
                }elseif ($pooja==$silver_id){
                    $annotation=$silver_an;
                    $this->db->query("UPDATE annotation SET lst_id='$annotation' WHERE name='SILVER'");
                }else{
                    $annotation=$other_an;
                    $this->db->query("UPDATE annotation SET lst_id='$annotation' WHERE name='OTHER'");
                }
                $this->db->query("INSERT INTO donation(`bill_id`,`customer_id`,`name`,`diety_id`,`star`,`pooja`,`qlt`,`unit`,`amount`,`remark`,`annotation`,`user_id`,`date`,`created`,`status`) VALUES ('$last_id','$user_id','$nama','$diety','$ster','$poja','$qult','$unet','$amot','$rmrk','$annotation',
                '$logged','$data','$date', '1')");
          
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('admin/admin/donation_view');
            }elseif($this->input->post('save')=="print"){
                redirect('admin/admin/donation_print/'.$last_id);
            }
        }
    }**/

public function donation(){
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
    }
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
        if ($id=="1"){
            $type="GOLD";
        }elseif ($id=="2"){
            $type="SILVER";
        }elseif ($id=="3"){
            $type="";
        }
        $data['type']=$type;
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/register',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['bill_list']=$this->general_model->getregister($id,$datef,$datet,$type); 
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
        
    }
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
    public function multy_schedule(){
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
                    '1','$bill_time','$total','$total','$counter')");
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
    }
    public function sche_print($id){
        $data['temple_list']=$this->general_model->gettemples();
        $data['bill_list']=$this->general_model->getbillingById($id);
        $data['bill_dtls']=$this->general_model->getbillingdtlsById($id);
        $data['bill_id']=$id;
        $this->load->view('admin/billing/sche_print',$data);
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
    public function schedule_billing_report(){
         $this->form_validation->set_rules('keyword', 'Date', 'required');
         if ($this->form_validation->run() === FALSE){
             $data['scheduled_poojas']=$this->general_model->getscheduledpoojas();
             $this->load->view('admin/layouts/admin_header');
             $this->load->view('admin/billing/schedule_billing_report',$data);
             $this->load->view('admin/layouts/admin_footer');
         }
         else{
             $keyword=$this->input->post('keyword');
             $data['scheduled_poojas']=$this->general_model->getscheduledpoojas($keyword);
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
            if($type==""){
                $type=null;
            }
            $data['type']=$type;
            $data['from']=$from;
            $data['to']=$to;
            $data['diety']=$diety;
            $data['bill_list']=$this->general_model->getbillsummury($from,$to,$diety,$type);
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

 public function detail_view($ids=null){
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
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/detail_view_print',$data);
            }
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

            $data['bill_list']=$this->general_model->getbillsummury($from,$to,$diety,$type);
            $data['diety_list']=$this->general_model->getdietys();
            $data['user_list']=$this->general_model->getkooru_usr();
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

            $data['bill_list']=$this->general_model->getbillsummury($from,$to,$diety,$type);
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
                $led_id=$user1['id'];
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
            $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$pro_id','$unit', '-$qlt', 'IS', '$user', '$bill_id')");
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
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/is_summary');
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $datef=$this->input->post('datef');
            $datet=$this->input->post('datet');
            $data['datef']=$datef;
            $data['datet']=$datet;
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
            $data['datef']=$datef;
            $data['datet']=$datet;
            $data['kallu_list']=$this->general_model->mookkolakallu($datef,$datet);
        }
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/billing/mookkolakallu',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    
    public function stock_report(){
        $data['temple_list']=$this->general_model->gettemples();
        $data['stock_list']=$this->general_model->get_stock();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/purchase/stock_report',$data);
        $this->load->view('admin/layouts/admin_footer');
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
            redirect('admin/admin/transaction');
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
        $this->form_validation->set_rules('bandaram', 'Bandaram', 'required');
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
                $data['bandaram_list']=$this->general_model->getbandarambyid($bandaram);
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
    
    public function adjustment(){
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE){
            $data['supplier_list']=$this->general_model->getsupplier("1");
            $data['product_list']=$this->general_model->getinv_product();
            $data['unit_list']=$this->general_model->getinv_unit();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/purchase/adjustment',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $user=$this->loggedIn['id'];
            $date=$this->input->post('date');
            $pro_id=$this->input->post('product_id');
            $type=$this->input->post('type');
            $unit=$this->input->post('unit');
            $qlt=$this->input->post('qty');
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
                $this->db->query("INSERT INTO adjustment(`product_id`,`date`,`unit`,`type`,`qty`,`status`) VALUES ('$proi','$date','$unet','$ttax','$qult', '0')");
                $bill_id=$this->db->insert_id();
                $this->db->query("INSERT INTO stock(`productid`,`unitid`,`qty`,`mode`,`user`,`ref_id`) VALUES ('$proi','$unet', '$qulty', 'AD', '$user', '$bill_id')");
                $i++;
            }
            if($this->input->post('save')=="save"){
                redirect('admin/admin/adjustment');
            }elseif($this->input->post('save')=="print"){
                redirect('admin/admin/purchase/'.$bill_id);
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
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/report_important',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $bill=$this->input->post('diety');
            $type=$this->input->post('type');
            $ampm=$this->input->post('ampm');
            $data['date']=$keyword;
            $data['diety']=$bill;
            $data['ampm']=$ampm;
         $data['bill_list']=$this->general_model->getbillreport_imp($keyword,$bill,$type,$ampm);
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                 $data['bill_list']=$this->general_model->getbillreport_imp($keyword,$bill,$type,$ampm);
           
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/report_important',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $data['temple_list']=$this->general_model->gettemples();
                
                $this->load->view('admin/billing/report_print_important',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
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

   public function customerpayments(){
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
         $invoice_no = $this->input->post('invoice_id');
         $payamount =  $this->input->post('payamount');
         foreach($invoice_no as $key => $val){
             $id = $invoice_no[$key];
             $paid_amount = $payamount[$key];
             $this->db->set('recv_amt', 'recv_amt+'. $paid_amount.'',false);
             $this->db->where('id' , $id);
             $this->db->update('billing');
             $name = $this->db->where('billing.id',$id)->join('user_dtl', 'billing.customer_id = user_dtl.id')->get('billing')->row()->name;
             $currentDate=date('Y-m-d');
             $led = 6;
             $mo = 9;
             $na = 'Rs '.$paid_amount.' received against bill no. '. $id.' from '.$name;
             $this->db->query("INSERT INTO payment(`ledger`,`amount`,`mode`,`narration`,`type`,`payment_date`,`created_Date`) VALUES ('$led','$paid_amount','$mo','$na','2','$currentDate','$currentDate')");
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
           $this->db->query("INSERT INTO other_billing(`bill_id`,`mode`,`name`,`ref_no`,`amount`,`bank`,`branch`) VALUES ('$bill_id','$mode','$paid_name','$reference','$paid_amount','$bank','$branch')");
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
          $this->db->from('other_billing');
          $this->db->order_by("id", "desc");
          $query = $this->db->get();
		  $data['bookings'] = $query->result_array();
          $this->load->view('admin/layouts/admin_header');
          $this->load->view('admin/billing/other_billing',$data);
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
    
}


