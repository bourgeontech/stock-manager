<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
        parent::__construct();
		
		
	}
    public function login(){
		$this->form_validation->set_rules('username', 'Userame', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
        $data['counter_list']=$this->general_model->getcounters();
	    
		if ($this->form_validation->run() === FALSE){
		     $this->load->view('admin/login_new',$data);
		}
		else{
        
        $counter=$this->input->post('counter_id');
			 $data=array(
			         'username'    =>$this->input->post('username'),
				     'password'    =>$this->input->post('password'),
                     'counter'    =>$counter
                  
			       );
        	
			 $result=$this->general_model->checkLogin($data);
        	
			 if($result!=0){
				  $session_data = array(
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'username' => $result['username'],
                    'role' => $result['role'], 
                );
                $this->session->set_userdata('admin', $session_data);
                $this->session->set_userdata('counter', $counter);
				redirect('admin/admin/dashboard');
				 
			}
			else{
				$msg="Invalid username or password !";
				redirect('admin/');
			}
		}
	}
}
